<?php
namespace app;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// use GuzzleHttp\Client;
// use GuzzleHttp\Request;

class Mqtt
{
    private $rabbitmq_host;
    private $rabbitmq_port;
    private $rabbitmq_queue;

    public function __construct($rabbitmq_host, $rabbitmq_port, $rabbitmq_queue) {
        $this->rabbitmq_host = $rabbitmq_host;
        $this->rabbitmq_port = $rabbitmq_port;
        $this->rabbitmq_queue = $rabbitmq_queue;
    }

    public function sendToRabbitMQ($data) {

        if (!empty($data)) {
            $connection = new AMQPStreamConnection($this->rabbitmq_host, $this->rabbitmq_port, 'guest', 'guest');

            // var_dump($connection);exit;
            $channel = $connection->channel();

            $channel->queue_declare($this->rabbitmq_queue, false, true, false, false);

            $msg = new AMQPMessage(json_encode($data));
            $channel->basic_publish($msg, '', $this->rabbitmq_queue);
            echo "Dados enviados para RabbitMQ com sucesso!\n";

            $channel->close();
            $connection->close();
        } else {
            echo "Falha ao consumir a API\n";
        }
    }

    // public function consumeApi($data) {
    //     $client = new Client();
    //     $headers = [ 'Content-Type' => 'application/json' ];

    //     $body = json_encode($data);
    //     $request = new Request('POST', 'http://localhost:8080/coord', $headers, $body);

    //     var_dump($request);exit;
    //     $res = $client->sendAsync($request)->wait();

    //     return $res->getBody();

    //     try {

    //     } catch (\Throwable $th) {
    //         return false;
    //     }
    // }
}