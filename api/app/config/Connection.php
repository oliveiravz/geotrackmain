<?php

namespace App\config;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Connection
{
    private $conn;

    public function getConnection()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');
        $dotenv->load();

        try {
            $hostname = $_ENV['HOST'];
            $port     = $_ENV['PORT'];
            $username = $_ENV['USER'];
            $password = $_ENV['PASSWORD'];
            $database = $_ENV['DATABASE'];
        
            $this->conn = new PDO("mysql:host=$hostname;port=$port;dbname=$database", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $this->conn;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        
    }
}
