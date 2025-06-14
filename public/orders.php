<?php
session_start();
require_once '../config/db.php';
require_once '../models/Order.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$customer_id = $_SESSION['user']['customer_id'];
$orderModel = new Order($pdo);

// Fetch all orders for this customer
$orders = $orderModel->getOrdersByCustomerId($customer_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fdf8df; color: #000;">
<div class="container mt-4">
    <h1 class="mb-4">My Orders</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <p class="text-muted">You have not placed any orders yet.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-4">
                <div class="card-header bg-success text-white d-flex justify-content-between">
                    <span>Order #<?= htmlspecialchars($order['order_id']) ?></span>
                    <span>Total: $<?= number_format($order['total_amount'], 2) ?></span>
                </div>
                <div class="card-body p-3">
                    <p><strong>Placed on:</strong> <?= htmlspecialchars($order['order_date']) ?></p>

                    <!-- Product List Headings -->
                    <div class="row fw-bold border-bottom mb-2 pb-1">
                        <div class="col-8">Product Name</div>
                        <div class="col-2 text-center">Qty</div>
                        <div class="col-2 text-end">Unit Price</div>
                    </div>

                    <!-- Fetch order items for this order -->
                    <?php $items = $orderModel->getOrderItems($order['order_id']); ?>
                    <?php foreach ($items as $item): ?>
                        <div class="row mb-1">
                            <div class="col-8"><?= htmlspecialchars($item['product_name']) ?></div>
                            <div class="col-2 text-center"><?= $item['quantity'] ?></div>
                            <div class="col-2 text-end">$<?= number_format($item['unit_price'], 2) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary">Back to Catalog</a>
</div>
</body>
</html>
