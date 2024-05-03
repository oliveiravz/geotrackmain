<?php
require_once __DIR__ . '/vendor/autoload.php';

use Bluerhinos\phpMQTT;

$server    = 'localhost';
$port      = 1883;
$username  = '';
$password  = '';
$client_id = 'phpMQTT-subscriber';

$mqtt = new phpMQTT($server, $port, $client_id);

if(!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}

$mqtt->debug = true;

$topics['bluerhinos/phpMQTT/examples/publishtest'] = array('qos' => 0, 'function' => 'procMsg');
$mqtt->subscribe($topics, 0);

while($mqtt->proc()) {

}

$mqtt->close();

function procMsg($topic, $msg){
    echo 'Mensagem recebida: ' . date("d/m/Y H:i:s") . "\n";
    echo "Tópico: {$topic}\n\n";
    echo "\t$msg\n\n";
}