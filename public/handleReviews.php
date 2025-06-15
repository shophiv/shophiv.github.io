<?php
require_once '../config/db.php';
require_once '../models/Review.php';

header('Content-Type: application/json');
$product_id = $_POST['product_id'] ?? null;

if ($product_id) {
    $reviewModel = new Review($pdo);
    echo json_encode($reviewModel->getReviewsByProductId($product_id));
} else {
    echo json_encode([]);
}
