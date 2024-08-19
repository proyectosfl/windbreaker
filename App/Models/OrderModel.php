<?php
// App/Models/OrderModel.php

namespace App\Models;

use App\Core\Model;

class OrderModel extends Model
{
    protected $table = 'orders';

    public function createOrder($userId, $items)
    {
        $this->db->beginTransaction();

        try {
            $orderId = $this->create($this->table, ['user_id' => $userId, 'status' => 'pending']);

            foreach ($items as $item) {
                $this->create('order_items', [
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity']
                ]);
            }

            $this->db->commit();
            return $orderId;
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getOrderWithItems($orderId)
    {
        $order = $this->read($this->table, $orderId);
        if (!$order) return null;

        $stmt = $this->db->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $order['items'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $order;
    }

    public function getUserOrders($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}