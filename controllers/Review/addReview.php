

<?php
session_start();
require_once '../../config/db.php';
require_once '../../models/Review.php';

if (!isset($_SESSION['user'])) {
   header('Location: ../../views/login.php');
   exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $customer_id = $_SESSION['user']['customer_id'];
   $product_id = $_POST['product_id'] ?? null;
   $rating = $_POST['rating'] ?? null;
   $comments = trim($_POST['comments'] ?? '');

   if ($product_id && $rating && $comments) {
      $reviewModel = new Review($pdo);
      $reviewModel->addReview($customer_id, $product_id, $rating, $comments);
   }
   header("Location: ../../views/productDetails.php?id=" . $product_id);
   exit;
}
?>
