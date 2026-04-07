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

    if ($cartItemId) {
        $cartModel = new Cart($pdo);
        $cartModel->removeItem($cartItemId);
        header('Location: ../../public/cart.php'); // Redirect back to cart
        exit;
    }
}
