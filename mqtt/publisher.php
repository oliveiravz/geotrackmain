<?php

require_once __DIR__ . '/vendor/autoload.php';

use Bluerhinos\phpMQTT;

$server = 'localhost';
$port = 1883;
$username = '';
$password = '';
$client_id = 'phpMQTT-publisher';

$mqtt = new phpMQTT($server, $port, $client_id);

$latlon = generateRandomCoordinates();

$json = json_encode($latlon);

while (true) {
    if ($mqtt->connect(true, NULL, $username, $password)) {
        
        $mqtt->publish("geotrack/mqtt/coordinates", "Coordenadas - {$json} enviadas em: " . date("d/m/Y H:i:s"), 0, false);

        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8081/geotrack/mqtt/coordinates',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
        echo $response;


        $mqtt->close();
    } else {
        echo "Time out!\n";
    }

    sleep(5);
}


function generateRandomCoordinates() {
    $coordinates = [];

    $latitude = rand(-9000000, 9000000) / 100000;
    $longitude = rand(-18000000, 18000000) / 100000;

    $coordinates[] = [
        'latitude' => $latitude,
        'longitude' => $longitude
    ];

    return $coordinates;
}