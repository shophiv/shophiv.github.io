<?php
require_once '../../config/db.php';
require_once '../../models/Cart.php';
session_start();

if (!isset($_SESSION['user'])) {
   header('Location: login.php');
   exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $cartItemId = $_POST['cart_item_id'] ?? null;
   $quantity = $_POST['quantity'] ?? null;

   if ($cartItemId && $quantity && $quantity > 0) {
      $cartModel = new Cart($pdo);
      $cartModel->updateItemQuantity($cartItemId, $quantity);
   }
   header('Location: ../../public/cart.php');
   exit;
}
