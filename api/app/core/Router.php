<?php

namespace App\Core;

class Router
{

    private $controller;

    private $method;

    private $controllerMethod;

    private $params = [];

    function __construct()
    {

        $url = $this->parseURL();

        if (file_exists("..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR. ucfirst($url[1]) . ".php")) {
            $this->controller = $url[1];
            unset($url[1]);

        } elseif (empty($url[1])) {
            echo "Informe uma Rota";
            exit;

        } else {
            http_response_code(404);
            echo json_encode(["code" => 404, "erro" => "Rota não encontrada"]);
            exit;
        }

        $className = "\\App\\controllers\\".ucfirst($this->controller)."";
        $this->controller = new $className ;

        $this->method = $_SERVER["REQUEST_METHOD"];

        if($this->method == "POST") {
            $this->postRequest($url);
        }
        
        $this->callback();

    }

    private function callback() {
        call_user_func_array($this->controller, $this->controllerMethod, $this->params);
    }

    private function postRequest() {
        $this->controllerMethod = "insert";
        $this->callback();
    }

    private function parseURL()     {
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }

}