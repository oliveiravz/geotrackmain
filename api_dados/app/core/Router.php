<?php

namespace App\Core;

class Router
{
    private $controller;
    private $method;
    private $controllerMethod;
    private $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if (isset($url[3]) && file_exists(__DIR__ . "/../controllers/" . ucfirst($url[3]) . ".php")) {
            $this->controller = $url[3];
            unset($url[3]);
        } elseif (empty($url[3])) {
            echo "Informe uma Rota";
            exit;
        } else {
            http_response_code(404);
            echo json_encode(["code" => 404, "erro" => "Rota não encontrada"]);
            exit;
        }

        $className = "\\App\\Controllers\\" . ucfirst($this->controller);
        $this->controller = new $className();

        $this->method = $_SERVER["REQUEST_METHOD"];
        
        if ($this->method == "POST") {
            $this->postRequest($url);
        } else {
            http_response_code(405);
            echo json_encode(["code" => 405, "erro" => "Método não permitido"]);
            exit;
        }
    }

    private function callback()
    {
        call_user_func_array([$this->controller, $this->controllerMethod], $this->params);
    }

    private function postRequest($url)
    {
        $this->controllerMethod = "insert";
        $this->params = $url ? array_values($url) : [];
        $this->callback();
    }

    private function parseURL()
    {
        return explode("/", trim($_SERVER["REQUEST_URI"], "/"));
    }
}
