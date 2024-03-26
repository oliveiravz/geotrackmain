<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

class Database {
    public $conn;

    // Método para obter a conexão com o banco de dados
    public function getConnection(){
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            return "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
