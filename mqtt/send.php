<?php
 
require_once __DIR__ . '/vendor/autoload.php';

use app\Mqtt;

$rabbitmq_host = 'localhost';
$rabbitmq_port = 15672;
$rabbitmq_queue = 'coord_queue';

$cordinates = [
    'latitude' => -22.951944,
    'longitude' => -43.210556
];

$publisher = new Mqtt($rabbitmq_host, $rabbitmq_port, $rabbitmq_queue);

$publisher->consumeApiAndSendToRabbitMQ($cordinates);
// Desconectando o cliente MQTT
$mqttClient->disconnect();

?>
