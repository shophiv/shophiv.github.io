
<?php

class OrderController
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   public function placeOrder($customerId)
   {
      $cartModel = new Cart($this->pdo);
      $cartItems = $cartModel->getCartItems($customerId);

      if (empty($cartItems)) {
         throw new Exception("Cart is empty.");
      }

      $totalAmount = array_reduce($cartItems, function ($sum, $item) {
         return $sum + ($item['price'] * $item['quantity']);
      }, 0);

      // Start Transaction
      $this->pdo->beginTransaction();

      $stmt = $this->pdo->prepare("INSERT INTO Orders (customer_id, order_date, total_amount) VALUES (?, NOW(), ?)");
      $stmt->execute([$customerId, $totalAmount]);
      $orderId = $this->pdo->lastInsertId();

      $stmt = $this->pdo->prepare("INSERT INTO OrderItem (order_id, product_id, seller_id, unit_price, quantity) VALUES (?, ?, ?, ?, ?)");

      foreach ($cartItems as $item) {
         $stmt->execute([
            $orderId,
            $item['product_id'],
            $item['seller_id'],
            $item['price'],
            $item['quantity']
         ]);

         // Optionally reduce stock
         $this->pdo->prepare("UPDATE Product SET stock = stock - ? WHERE product_id = ?")
            ->execute([$item['quantity'], $item['product_id']]);
      }

      // Clear Cart
      $cartModel->clearCart($customerId);

      $this->pdo->commit();
      return $orderId;
   }
}
