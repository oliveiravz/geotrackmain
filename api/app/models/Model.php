<?php

namespace App\models;

use App\config\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

class Model
{
    protected static $tableName = '';
    protected static $columns = [];


    public function insert($values) {

        try {
            
            $values = json_decode($values, true);

            $conn = (new Connection())->getConnection();
            $uuid = Uuid::uuid4()->toString();

            $values["id"] = $uuid;

            $placeholders = implode(', ', array_fill(0, count($values), '?'));

            $sql = "INSERT INTO " . static::$tableName . " (" . implode(', ', static::$columns) . ") VALUES ($placeholders)";
            $stmt = $conn->prepare($sql);
            
            if($stmt->execute(array_values($values))) {
                return $uuid;
            }

        } catch (Exception $e) {
            return false;
        }
    }
}