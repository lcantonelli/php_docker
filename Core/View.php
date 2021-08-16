<?php

namespace Core;

class View {

    /**
     * Caminho da view, a partir do diretorio de views
     * @var string
     */
    private $view;
    
    /**
     * Arra associativo de parametros visiveis para a view
     * @var array
     */
    private $params;

    
    public function __construct($view, $params) {

        $this->view = $view;
        $this->params = $params;
    }

    function getView() {
        return $this->view;
    }

    function getParams() {
        return $this->params;
    }

    function setView($view) {
        $this->view = $view;
    }

    function setParams($params) {
        $this->params = $params;
    }

}
