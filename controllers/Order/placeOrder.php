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
$totalItems = $cartModel->getTotalCartItemsCount($customer_id);
$count = 0;
foreach ($items as $item) {
    if (
        $orderModel->addOrderItem($order_id, $item['product_id'], $item['seller_id'], $item['price'], $item['quantity'])==false
    ) {
        $count++;
    } else {
        // Clear cart
        $cartModel->clearCart($cart['cart_id'], $item['product_id']);
    }
}

if ($count == 0) {
    $_SESSION['message'] = "Order placed successfully!";
}
elseif($count==$totalItems){
    $_SESSION['message'] = "Order cannot be placed, All the items are out of stock!";
}
else{
    $_SESSION['message'] = "Order placed but some items are out of stock so they are not included!";
}
header("Location: ../../public/orders.php");  // Create orders.php to view order history
exit;
