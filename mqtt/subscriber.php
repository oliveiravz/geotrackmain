<?php
require_once __DIR__ . '/vendor/autoload.php';

use Bluerhinos\phpMQTT;

$server    = 'localhost';
$port      = 1883;
$username  = '';
$password  = '';
$client_id = 'phpMQTT-subscriber';

$mqtt = new phpMQTT($server, $port, $client_id);

if($mqtt->connect(true, NULL, $username, $password)) {
	
    $mqtt->debug = true;
    
    $topics['geotrack/mqtt/cordinates'] = array('qos' => 0, 'function' => 'messageReceive');
    $mqtt->subscribe($topics, 0);
    
    sendToApi($topics);

    while($mqtt->proc()) {
    
    }
    
    $mqtt->close();

}else{
    exit(1);
}


function messageReceive($topic, $msg){
    echo 'Mensagem recebida: ' . date("d/m/Y H:i:s") . "\n";
    echo "Tópico: {$topic}\n\n";
    echo "\t$msg\n\n";
}

function sendToApi($data) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8080/geotrack/mqtt/cordinates',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response; 
    
}