<?php
// App/Core/Model.php

namespace App\Core;

use PDO;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = $this->connect();
    }

    protected function connect()
    {
        $host = 'localhost';
        $dbname = 'mi_aplicacion';
        $username = 'usuario';
        $password = 'contraseña';

        try {
            return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        } catch (\PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Métodos genéricos CRUD que pueden ser útiles para todos los modelos
    protected function create($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        
        return $this->db->lastInsertId();
    }

    protected function read($table, $id, $idColumn = 'id')
    {
        $sql = "SELECT * FROM $table WHERE $idColumn = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function update($table, $id, $data, $idColumn = 'id')
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
        }
        $set = implode(', ', $set);
        
        $sql = "UPDATE $table SET $set WHERE $idColumn = :id";
        $data['id'] = $id;
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    protected function delete($table, $id, $idColumn = 'id')
    {
        $sql = "DELETE FROM $table WHERE $idColumn = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}