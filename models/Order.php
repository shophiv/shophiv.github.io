<?php

class Order
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   public function createOrder($customer_id)
   {
      $this->pdo->beginTransaction();

      $cartStmt = $this->pdo->prepare("SELECT ci.product_id, ci.quantity, p.price, p.seller_id
            FROM CartItem ci
            JOIN Cart c ON ci.cart_id = c.cart_id
            JOIN Product p ON ci.product_id = p.product_id
            WHERE c.customer_id = ?");
      $cartStmt->execute([$customer_id]);
      $cartItems = $cartStmt->fetchAll(PDO::FETCH_ASSOC);

      if (empty($cartItems)) throw new Exception("Cart is empty.");

      $total_amount = 0;
      foreach ($cartItems as $item) {
         $total_amount += $item['price'] * $item['quantity'];
      }

      $orderStmt = $this->pdo->prepare("INSERT INTO Orders (customer_id, order_date, total_amount) VALUES (?, NOW(), ?)");
      $orderStmt->execute([$customer_id, $total_amount]);
      $order_id = $this->pdo->lastInsertId();

      $itemStmt = $this->pdo->prepare("INSERT INTO OrderItem (order_id, product_id, seller_id, unit_price, quantity) VALUES (?, ?, ?, ?, ?)");

      foreach ($cartItems as $item) {
         $itemStmt->execute([$order_id, $item['product_id'], $item['seller_id'], $item['price'], $item['quantity']]);

         // Decrease stock
         $stockStmt = $this->pdo->prepare("UPDATE Product SET stock = stock - ? WHERE product_id = ?");
         $stockStmt->execute([$item['quantity'], $item['product_id']]);
      }

      // Empty the cart
      $clearCartStmt = $this->pdo->prepare("DELETE FROM CartItem WHERE cart_id = (SELECT cart_id FROM Cart WHERE customer_id = ?)");
      $clearCartStmt->execute([$customer_id]);

      $this->pdo->commit();

      return $order_id;
   }



   // Add order item to the OrderItem table
   public function addOrderItem($order_id, $product_id, $seller_id, $unit_price, $quantity)
   {
      $stmt = $this->pdo->prepare("
            INSERT INTO OrderItem (order_id, product_id, seller_id, unit_price, quantity)
            VALUES (?, ?, ?, ?, ?)
        ");
      return $stmt->execute([$order_id, $product_id, $seller_id, $unit_price, $quantity]);
   }
}
