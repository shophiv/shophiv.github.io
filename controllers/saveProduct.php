<?php
require_once '../config/db.php';
require_once '../models/Product.php';
session_start();
$productModel = new Product($pdo);
$data = $_POST;
$sellerId = $_SESSION['user']['seller_id'];

if (isset($data['delete_id'])) {
    $productModel->deleteProduct($data['delete_id']);
} else if (!empty($data['product_id'])) {
    $productModel->updateProduct(
        $data['product_id'],
        $data['name'],
        $data['description'],
        $data['price'],
        $data['category'],
        $data['stock']
    );
} else {
    $productModel->addProduct(
        $data['name'],
        $data['description'],
        $data['price'],
        $data['category'],
        $data['stock'],
        $sellerId
    );
}

header('Location: ../views/myProducts.php');
exit;
?>
