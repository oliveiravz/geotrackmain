<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\Queue;

class Coordinates extends Controller
{
    public function insert()
    {
        $model = $this->model('Coordinates');
        $body  = $this->getRequestBody();

        $json = json_encode($body);

        // Enviar dados para RabbitMQ
        $queue = new Queue('localhost', 5672, 'guest', 'guest');
        $queue->declareQueue('coordinates_queue');
        $queue->sendMessage('coordinates_queue', $json);
        $queue->close();

        // Opcional: Manter ou remover a lógica de curl dependendo do seu uso
        // $curl = curl_init();
    
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'http://localhost:8080/coord',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => $json,
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json'
        //     ),
        // ));
    
        // $response = curl_exec($curl);
        
        // echo $response;

        // curl_close($curl);

        // Se necessário, você pode retornar uma resposta HTTP aqui
        http_response_code(201);
        exit(json_encode(['code'=> '201', 'success' => 'Coordenadas enviadas com sucesso para a fila']));
    }
}
