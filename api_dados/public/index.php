<?php

require_once __DIR__ . '/../vendor/autoload.php';

header('Content-type: application/json');

new App\Core\Router();