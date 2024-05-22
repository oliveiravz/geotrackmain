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
    
    $topics['geotrack/mqtt/coordinates'] = array('qos' => 0, 'function' => 'messageReceive');
    $mqtt->subscribe($topics, 0);

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