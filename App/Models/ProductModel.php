<?php
// App/Models/ProductModel.php

namespace App\Models;

use App\Core\Model;

class ProductModel extends Model
{
    protected $table = 'products';

    public function getAllProducts()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        return $this->read($this->table, $id);
    }

    public function createProduct($data)
    {
        return $this->create($this->table, $data);
    }

    public function updateProduct($id, $data)
    {
        return $this->update($this->table, $id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->delete($this->table, $id);
    }

    public function getProductsByCategory($category)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE category = :category");
        $stmt->execute(['category' => $category]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}