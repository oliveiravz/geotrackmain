<?php
namespace app;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

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

    public function consumeApiAndSendToRabbitMQ($data) {

        // Consumindo a API
        if (!empty($data)) {
            $connection = new AMQPStreamConnection($this->rabbitmq_host, $this->rabbitmq_port, 'guest', 'guest');
            $channel = $connection->channel();

            // Declarando a fila RabbitMQ
            $channel->queue_declare($this->rabbitmq_queue, false, true, false, false);

            // Enviando os dados para a fila RabbitMQ
            $msg = new AMQPMessage(json_encode($data));
            $channel->basic_publish($msg, '', $this->rabbitmq_queue);
            echo "Dados enviados para RabbitMQ com sucesso!\n";

            // Fechando a conexão com RabbitMQ
            $channel->close();
            $connection->close();
        } else {
            echo "Falha ao consumir a API\n";
        }
    }
}