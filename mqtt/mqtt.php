<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use GuzzleHttp\Client as HttpClient;

$server   = 'broker.emqx.io';
$port     = 1883;
$username = 'emqx_user';
$password = null;
$clientId = 'geotrack_application';

$clean_session = false;

$http = new HttpClient();
$apiUrl  = "http://localhost:8080/coord";

// var_dump($mqtt);exit;
function insertCoordinates($latitude, $longitude, $http, $apiUrl) {
    try {

        $response = $http->post($apiUrl, [
            'json' => [
                'latitude' => $latitude,
                'longitude' => $longitude
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            echo "Coordenadas cadastradas com sucesso.\n";
        } else {
            echo "Falha ao cadastrar coodenadas.\n";
        }
    } catch (Exception $e) {
        echo "Falha ao cadastrar coodenadas: " . $e->getMessage() . "\n";
    }
}

$connectionSettings = new ConnectionSettings();
$connectionSettings
  ->setUsername($username)
  ->setPassword(null)
  ->setKeepAliveInterval(60)
  ->setLastWillTopic('emqx/test/last-will')
  ->setLastWillMessage('client disconnect')
  ->setLastWillQualityOfService(1);

// // var_dump($connectionSettings);exit;

$mqtt = new MqttClient($server, $port, $clientId);
$mqtt->connect($connectionSettings, $clean_session);
printf("client connected\n");

$mqtt->subscribe('geotrack_application', function ($topic, $message) use ($http, $apiUrl) {
    printf("Received message on topic [%s]: %s\n", $topic, $message);
    
    $data = json_decode($message, true);
        
    if (isset($data['latitude']) && isset($data['longitude'])) {
        // Insere as coordenadas na tabela usando a API
        insertCoordinates($data['latitude'], $data['longitude'], $http, $apiUrl);
    } else {
        echo "A mensagem recebida não contém dados de latitude e longitude.\n";
    }
}, 0);



$payload = array(
    'from' => 'php-mqtt client',
    'date' => date('Y-m-d H:i:s')
);
$mqtt->publish('geotrack_application', json_encode($payload), 0);


$mqtt->disconnect();