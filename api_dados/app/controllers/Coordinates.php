<?php

namespace App\controllers;

use App\Core\Controller;

class Coordinates extends Controller
{
    public function insert() {

        $model = $this->model('Coordinates');
        $body  = $this->getRequestBody();

        // $json = json_encode($body);

        print_r($body);

        // if(!$insert) {
        //     http_response_code(500);
        //     exit(json_encode(['code'=> '500', 'error' => 'Erro ao cadastrar coordenadas']));
        // }

        // http_response_code(201); // criado
        // exit(json_encode(['code'=> '201', 'success' => 'Coordenadas cadastradas com sucesso']));
    
    }
}