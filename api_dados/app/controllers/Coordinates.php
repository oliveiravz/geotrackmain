<?php

namespace App\Controllers;

use App\Services\Queue;

class Coordinates
{
    public function insert()
    {
        // Parâmetros de conexão para o RabbitMQ
        $queue = new Queue();
        $queue->declareQueue('coordinates');
        
        // Exemplo de mensagem
        $message = json_encode(['latitude' => -23.5505, 'longitude' => -46.6333]);

        $queue->sendMessage('coordinates', $message);
        $queue->close();

        // Retornar uma resposta HTTP 201
        http_response_code(201);
        echo json_encode(['status' => 'success']);
    }
}
