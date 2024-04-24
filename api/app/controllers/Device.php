<?php

namespace App\controllers;

use App\Core\Controller;

class Device extends Controller
{
    public function insert() {

        $model = $this->model('Device');
        $body  = $this->getRequestBody();

        $json = json_encode($body);

        $insert = $model->newDevice($json);

        if(!$insert) {
            http_response_code(500);
            exit(json_encode(['error' => 'Erro ao cadastrar dispositivo']));
        }

        http_response_code(201); // criado
        exit(json_encode(['success' => 'Dispositivo cadastrado com sucesso']));
    
    }
}