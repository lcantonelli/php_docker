<?php

namespace Core;

class Route {

    /**
     * Array que guarda rotas registradas
     * @var array 
     */
    private $routes;

    /**
     * Instancia da controller solicitada de acordo com a rota.
     * @var Controller
     */
    private $instance;

    /**
     * Namespace da controller.
     * 
     * @var String 
     */
    private $controller;

    /**
     * Metodo da controller que deve ser executado.
     * @var String 
     */
    private $action;

    /**
     * Registra rota GET
     * 
     * @param type $route
     * @param type $action
     */
    public function get($route, $action) {
        $this->registerRoute('GET', $route, $action);
    }

    /**
     * Registra rota POST
     * 
     * @param type $route
     * @param type $action
     */
    public function post($route, $action) {
        $this->registerRoute('POST', $route, $action);
    }

    /**
     * Registra rota PUT.
     * 
     * @param type $route
     * @param type $action
     */
    public function put($route, $action) {
        $this->registerRoute('PUT', $route, $action);
    }

    /**
     * Registra rota DELETE
     * 
     * @param type $route
     * @param type $action
     */
    public function delete($route, $action) {
        $this->registerRoute('DELETE', $route, $action);
    }

    /**
     * Registra rotas
     * 
     * @param type $method
     * @param type $route
     * @param type $action
     */
    private function registerRoute($method, $route, $action) {
        $route = ltrim($route, "/");
        $this->routes[$method][$route] = $action;
    }

    /**
     * Resolve rota solicitada, intancia controller e chama do metodo informado
     * apresentando a view ou string retornada pela controller.
     * 
     */
    public function run() {

        echo "<pre>";
        print_r($_SERVER);
        echo "</pre>";

        $path = ltrim($_SERVER['REDIRECT_URL'], $_SERVER['CONTEXT_PREFIX']);

        if (isset($this->routes[$_SERVER['REQUEST_METHOD']][$path])) {
            $this->instanceController($this->routes[$_SERVER['REQUEST_METHOD']][$path]);
            $response = call_user_func_array([$this->instance, $this->action], $this->prepareParameters());
            if ($response instanceof \Core\View) {
                $this->view($response);
            } else {
                echo $response;
            }
        } elseif (strpos($path, "public") !== 0) {
            header("HTTP/1.1 404 Not Found");
            echo "<h1>404 - Not found</h1>";
        }
    }

    /**
     * Instancia controller
     */
    private function instanceController($action) {
        $action = explode("@", $action);
        $this->action = $action[1];
        $this->controller = "\\App\\Controller\\" . $action[0];
        $this->instance = new $this->controller();
    }

    /**
     * Prepara parametros para a controller.
     */
    private function prepareParameters() {
        $paramsController = [];
        $postParams = $_POST;

        if ($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'DELETE') {
            parse_str(file_get_contents("php://input"), $putDelete);
            if (is_array($putDelete)) {
                $postParams = array_merge($postParams, $putDelete);
            }
        }

        $reflectorMethod = new \ReflectionMethod($this->instance, $this->action);
        $parameters = $reflectorMethod->getParameters();
        foreach ($parameters as $k => $param) {
            if (!empty($param->getClass()) && $param->getClass()->name == "Core\Request") {
                $request = new \Core\Request($_GET, $postParams);
                $paramsController[$param->name] = $request;
            }
        }

        return array_merge($paramsController, $_GET, $postParams);
    }

    /**
     * Apresenta a view informada.
     * @param type $view
     */
    private function view($view) {
        $__view = $view->getView();
        $dados = $view->getParams();
        include __DIR__ . "/../App/View/" . $__view . ".php";
        unset($__view);
    }

    /**
     * Helper para view, para que possa acessar mais facilmente o diretorio public.
     * 
     * @param type $file
     * @return type
     */
    private function asset($file) {
        return "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['CONTEXT_PREFIX'] . "/public/" . ltrim($file, "/");
    }

}
