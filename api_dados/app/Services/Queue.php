<?php

namespace App\Services;

require_once __DIR__ . '/../../../vendor/autoload.php';

// Definindo constantes de socket se não estiverem definidas
if (!defined('SOCKET_EAGAIN')) {
    define('SOCKET_EAGAIN', 11); // Try again
}
if (!defined('SOCKET_EWOULDBLOCK')) {
    define('SOCKET_EWOULDBLOCK', 11); // Operation would block
}
if (!defined('SOCKET_EINTR')) {
    define('SOCKET_EINTR', 4); // Interrupted system call
}

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Queue
{
    private $connection;
    private $channel;

    public function __construct()
    {
        // Certifique-se de fornecer os parâmetros corretos de conexão
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
    }

    public function declareQueue($queueName)
    {
        $this->channel->queue_declare($queueName, false, true, false, false);
    }

    public function sendMessage($queueName, $message)
    {
        $msg = new AMQPMessage($message, array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
        $this->channel->basic_publish($msg, '', $queueName);
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
