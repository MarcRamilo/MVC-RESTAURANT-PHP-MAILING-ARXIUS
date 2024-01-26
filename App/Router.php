<?php

class Router{

    private $controller;
    private $method;

    public function __construct(){
        $this->matchRoute();
    }

    public function matchRoute(){
        $url_array = explode('/',URL);
        $this->controller = !empty($url_array[1]) ? $url_array[1] : 'user';
        $this->controller = $this->controller . "Controller";
        require_once("App/Controllers/" . $this->controller . ".php");
        $this->method = !empty($url_array[2]) ? $url_array[2] : 'home';
        
        
        
    }

    public function run(){
        $controller = new $this->controller(); //$hector = new Persona();
        $method = $this->method;
        $controller->$method(); // $hector->saluda();
      
    }

}




?>