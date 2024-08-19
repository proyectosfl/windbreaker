<?php
// App/Models/UserModel.php

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    protected $table = 'users';

    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        return $this->read($this->table, $id);
    }

    public function createUser($data)
    {
        return $this->create($this->table, $data);
    }

    public function updateUser($id, $data)
    {
        return $this->update($this->table, $id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($this->table, $id);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}