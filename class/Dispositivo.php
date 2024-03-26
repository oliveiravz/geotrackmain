<?php

class Dispositivo {
    private $conn;
    private $table_name = "dispositivo";

    public $id;
    public $codigo;
    public $descricao;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function inserir() {
        $query = "INSERT INTO $this->table_name SET id=:id, codigo=:codigo, descricao=:descricao";  

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":descricao", $this->descricao);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>
