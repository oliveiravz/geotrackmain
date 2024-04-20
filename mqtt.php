<?php

require_once 'vendor/autoload.php';

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;


$server = '127.0.0.1';
$port = 1883;
$clientId = 'broker';
$username = 'your_username';
$password = 'your_password';
$clean_session = false;


$mqtt = new MqttClient($server, $port, $clientId);


$connectionSettings = (new ConnectionSettings)
    ->setUsername($username)
    ->setPassword($password)
    ->setKeepAliveInterval(60)
    ->setConnectTimeout(3)
    ->setUseTls(false)
    ->setTlsSelfSignedAllowed(false);


$mqtt->connect($connectionSettings, $clean_session);


$mqtt->subscribe('php/mqtt', function ($topic, $message) {
    printf("Received message on topic [%s]: %s\n", $topic, $message);
}, 0);


$payload = array(
    'from' => 'php-mqtt client',
    'date' => date('Y-m-d H:i:s')
);
$mqtt->publish('php/mqtt', json_encode($payload), 0);


$mqtt->disconnect();