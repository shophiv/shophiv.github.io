<?php
session_start();
require_once '../../config/db.php';
require_once '../../models/Cart.php';
require_once '../../models/Order.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../../public/login.php');
    exit;
}

$customer_id = $_SESSION['user']['customer_id'];

$cartModel = new Cart($pdo);
$orderModel = new Order($pdo);

// Fetch the cart
$cart = $cartModel->getCartByCustomerId($customer_id);
if (!$cart) {
    $_SESSION['message'] = "No items in cart to place an order.";
    header("Location: ../../public/cart.php");
    exit;
}

$items = $cartModel->getItems($cart['cart_id']);
if (empty($items)) {
    $_SESSION['message'] = "Your cart is empty.";
    header("Location: ../../public/cart.php");
    exit;
}

// Calculate total
$total = 0;
foreach ($items as $item) {
    $total += $item['quantity'] * $item['price'];
}

// Create order
$order_id = $orderModel->createOrder($customer_id, $total);

// Add order items
foreach ($items as $item) {
    $orderModel->addOrderItem($order_id, $item['product_id'], $item['seller_id'], $item['price'], $item['quantity']);
}

// Clear cart
$cartModel->clearCart($cart['cart_id']);

$_SESSION['message'] = "Order placed successfully!";
header("Location: ../../public/orders.php");  // Create orders.php to view order history
exit;
