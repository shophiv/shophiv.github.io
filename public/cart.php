<?php
session_start();
require_once '../config/db.php';
require_once '../models/Cart.php';
require_once '../models/Product.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$cartModel = new Cart($pdo);
$productModel = new Product($pdo);

$cart = $cartModel->getCartByCustomerId($_SESSION['user']['customer_id']);
$items = $cart ? $cartModel->getItems($cart['cart_id']) : [];
$total = 0;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4" style="background-color:#fdf8df">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Shopping Cart</h1>
        <a href="../public/index.php" class="btn btn-outline-primary">Continue Shopping</a>
    </div>


    <?php if (empty($items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item):
                    $subtotal = $item['quantity'] * $item['price'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>
                            <form action="../controllers/Cart/updateCartItem.php" method="POST" class="d-flex" style="gap:5px;">
                                <input type="hidden" name="cart_item_id" value="<?= $item['cart_item_id'] ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stock'] ?>" class="form-control form-control-sm" style="width: 70px;">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>

                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <form action="../controllers/Cart/removeFromCart.php" method="POST" style="display:inline;">
                                <input type="hidden" name="cart_item_id" value="<?= $item['cart_item_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total: $<?= number_format($total, 2) ?></h3>

        <form action="../controllers/Order/placeOrder.php" method="POST">
            <button type="submit" class="btn btn-success">Place Order</button>
        </form>

    <?php endif; ?>
</body>

</html>