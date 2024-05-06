<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('geotrack/mqtt/cordinates', function (Request $request, Response $response, $args) {

    $response->getBody()->write('<a href="/hello/world">Try /hello/world</a>');
    return $response;
    
});

$app->run();