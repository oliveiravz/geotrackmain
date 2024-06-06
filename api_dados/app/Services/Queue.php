<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Queue
{
    private $connection;
    private $channel;

    public function __construct($host, $port, $user, $password)
    {
        $this->connection = new AMQPStreamConnection($host, $port, $user, $password);
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
