<?php
require_once '../../config/db.php'; 
require_once '../../models/Cart.php';
session_start();

$customer_id = $_SESSION['user']['customer_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'] ?? 1;

$cart = new Cart($pdo);
$cart->addToCart($customer_id, $product_id, $quantity);

header("Location: ../../public/cart.php");
exit;
