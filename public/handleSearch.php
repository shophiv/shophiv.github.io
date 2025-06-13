<?php
session_start();
require_once '../config/db.php';
require_once '../models/Product.php';

$productModel = new Product($pdo);

$data = json_decode(file_get_contents("php://input"), true);
$query = $data['search'] ?? '';

if ($query === '') {
    $products = $productModel->getAll();
}else {
    $stmt = $pdo->prepare("SELECT * FROM Product WHERE name LIKE ?");
    $stmt->execute(["%$query%"]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Store search results in session (optional)
$_SESSION['search_results'] = $products;

header('Content-Type: application/json');
echo json_encode($products);
