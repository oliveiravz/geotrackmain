<?php

require_once __DIR__ . '/vendor/autoload.php';

use Bluerhinos\phpMQTT;

$server = 'localhost';
$port = 1883;
$username = '';
$password = '';
$client_id = 'phpMQTT-publisher';

$mqtt = new phpMQTT($server, $port, $client_id);

$latlon = [ -22.209539, -49.948460 ];

$json = json_encode($latlon);

while (true) {
    if ($mqtt->connect(true, NULL, $username, $password)) {
        $mqtt->publish("bluerhinos/phpMQTT/examples/publishtest", "Coordenadas - {$json} enviadas em: " . date("d/m/Y H:i:s"), 0, false);
        $mqtt->close();
    } else {
        echo "Time out!\n";
    }

    sleep(30);
}