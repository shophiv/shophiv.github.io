<?php

class Order
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   public function createOrder($customer_id, $total_amount)
   {
      $stmt = $this->pdo->prepare("
        INSERT INTO `Orders` (customer_id, order_date, total_amount, order_status)
        VALUES (:customer_id, NOW(), :total_amount, 'placed')
    ");

      $stmt->execute([
         ':customer_id' => $customer_id,
         ':total_amount' => $total_amount
      ]);

      return $this->pdo->lastInsertId();  // Returns the newly created order_id
   }
   public function getOrderNum($customer_id)
   {
      $stmt = $this->pdo->prepare("SELECT COUNT(*) AS count FROM Orders WHERE customer_id=?");
      $stmt->execute([$customer_id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result ? (int)$result['count'] : 0;
   }


   // Add order item to the OrderItem table
   public function addOrderItem($order_id, $product_id, $seller_id, $unit_price, $quantity)
   {
      $ismt = $this->pdo->prepare("
            SELECT stock FROM Product WHERE product_id = ?
        ");
      $ismt->execute([$product_id]);
      $result = $ismt->fetch(PDO::FETCH_ASSOC);
      $amount = (int)$result['stock'];
      if ($amount < $quantity) {
         return false;
      }
      $amount = $amount - $quantity;
      $ismt = $this->pdo->prepare("UPDATE product SET stock =? WHERE product_id = ?");
      $ismt->execute([$amount, $product_id]);

      $stmt = $this->pdo->prepare("
            INSERT INTO OrderItem (order_id, product_id, seller_id, unit_price, quantity)
            VALUES (?, ?, ?, ?, ?)
        ");
      return $stmt->execute([$order_id, $product_id, $seller_id, $unit_price, $quantity]);
   }


   public function getOrdersByCustomerId($customer_id)
   {
      $stmt = $this->pdo->prepare("
        SELECT * FROM `Orders` 
        WHERE customer_id = ? 
        ORDER BY order_date DESC
    ");
      $stmt->execute([$customer_id]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }


   public function getOrderItems($order_id)
   {
      $stmt = $this->pdo->prepare("
        SELECT oi.*, p.name AS product_name
        FROM OrderItem oi
        JOIN Product p ON oi.product_id = p.product_id
        WHERE oi.order_id = ?
    ");
      $stmt->execute([$order_id]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

    public function getSellerOrderItems($id){
      $stmt = $this->pdo->prepare("
        SELECT * FROM `orderitem`
        WHERE seller_id = ?
        ORDER BY order_item_id
      ");
      $stmt->execute([$id]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

}
?>
