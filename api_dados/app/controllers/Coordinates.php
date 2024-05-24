<?php

namespace App\controllers;

use App\Core\Controller;

class Coordinates extends Controller
{
    public function insert() {

        $model = $this->model('Coordinates');
        $body  = $this->getRequestBody();

        $json = json_encode($body);

        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/coord',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
    
        $response = curl_exec($curl);
        
        echo $response;

        curl_close($curl);

        // if(!$insert) {
        //     http_response_code(500);
        //     exit(json_encode(['code'=> '500', 'error' => 'Erro ao cadastrar coordenadas']));
        // }

        // http_response_code(201); // criado
        // exit(json_encode(['code'=> '201', 'success' => 'Coordenadas cadastradas com sucesso']));
    
    }
}