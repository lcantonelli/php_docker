<?php
namespace Core;

/**
 * Classe que possibilita o acesso a todos os parametros informados.
 *
 */
class Request {

    /**
     * Parametros GET
     * @var array
     */
    private $getParams = [];
    
    /**
     * Parametros POST
     * @var array
     */
    private $requesParams = [];
    
    
    public function __construct($getParams, $requestParams) {
        $this->getParams = is_array($getParams) ? $getParams : [];
        $this->requesParams = is_array($requestParams) ? $requestParams : [];
    }
    
    /**
     * Retorna todos os parametros informados.
     * 
     * @return type
     */
    public function all(){
        return array_merge($this->getParams, $this->requesParams);
    }
    
    /**
     * Retorna parametros GET.
     * 
     * @return type
     */
    public function getParams(){
        return $this->getParams;
    }
    
    /**
     * Retorna parametros POST, PUT, DELETE
     * 
     * @return type
     */
    public function requestParams(){
        return $this->requesParams;
    }
    
}
