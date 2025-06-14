<?php

class Cart
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   public function getCartItems($customer_id)
   {
      $stmt = $this->pdo->prepare("SELECT ci.cart_item_id, p.name, p.price, ci.quantity, ci.product_id 
            FROM CartItem ci
            JOIN Product p ON ci.product_id = p.product_id
            WHERE ci.cart_id = (SELECT cart_id FROM Cart WHERE customer_id = ?)");
      $stmt->execute([$customer_id]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }


   public function addToCart($customer_id, $product_id, $quantity)
   {
      $cart_id = $this->getOrCreateCart($customer_id);

      // Check if item already in cart
      $stmt = $this->pdo->prepare("SELECT * FROM CartItem WHERE cart_id = ? AND product_id = ?");
      $stmt->execute([$cart_id, $product_id]);
      $item = $stmt->fetch();

      if ($item) {
         $stmt = $this->pdo->prepare("UPDATE CartItem SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?");
         $stmt->execute([$quantity, $cart_id, $product_id]);
      } else {
         $stmt = $this->pdo->prepare("INSERT INTO CartItem (cart_id, product_id, quantity) VALUES (?, ?, ?)");
         $stmt->execute([$cart_id, $product_id, $quantity]);
      }
   }


   public function removeFromCart($cart_item_id)
   {
      $stmt = $this->pdo->prepare("DELETE FROM CartItem WHERE cart_item_id = ?");
      return $stmt->execute([$cart_item_id]);
   }

   private function getOrCreateCart($customer_id)
   {
      $stmt = $this->pdo->prepare("SELECT cart_id FROM Cart WHERE customer_id = ?");
      $stmt->execute([$customer_id]);
      $cart = $stmt->fetch();

      if ($cart) return $cart['cart_id'];

      $stmt = $this->pdo->prepare("INSERT INTO Cart (customer_id) VALUES (?)");
      $stmt->execute([$customer_id]);
      return $this->pdo->lastInsertId();
   }



   // Returns the cart row for a given customer_id, or null if none exists
   public function getCartByCustomerId($customer_id)
   {
      $stmt = $this->pdo->prepare("SELECT * FROM Cart WHERE customer_id = ?");
      $stmt->execute([$customer_id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }


   // Get all items (with product info) in the cart by cart_id
   public function getItems($cart_id)
   {
      $stmt = $this->pdo->prepare("
            SELECT ci.cart_item_id, ci.product_id, ci.quantity, 
                   p.name, p.description, p.price, p.stock, p.seller_id
            FROM CartItem ci
            JOIN Product p ON ci.product_id = p.product_id
            WHERE ci.cart_id = ?
        ");
      $stmt->execute([$cart_id]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   // Clear cart (delete all CartItems) by cart_id
   public function clearCart($cart_id)
   {
      $stmt = $this->pdo->prepare("DELETE FROM CartItem WHERE cart_id = ?");
      return $stmt->execute([$cart_id]);
   }

   public function removeItem($cart_item_id)
   {
      $stmt = $this->pdo->prepare("DELETE FROM CartItem WHERE cart_item_id = ?");
      $stmt->execute([$cart_item_id]);
   }

   public function updateItemQuantity($cart_item_id, $quantity)
   {
      $stmt = $this->pdo->prepare("UPDATE CartItem SET quantity = ? WHERE cart_item_id = ?");
      $stmt->execute([$quantity, $cart_item_id]);
   }
}
