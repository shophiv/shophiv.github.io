<?php
require_once '../config/db.php';
require_once '../models/Product.php';
require_once '../models/Review.php';
session_start();

$productModel = new Product($pdo);
$reviewModel = new Review($pdo);

$product_id = $_GET['id'] ?? null;
if (!$product_id) {
   header('Location: index.php');
   exit;
}

$product = $productModel->getById($product_id);
$reviews = $reviewModel->getReviewsByProduct($product_id);
$user = $_SESSION['user'] ?? null;
?>

<!DOCTYPE html>
<html>

<head>
   <title><?= htmlspecialchars($product['name']) ?> - Details</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #fdf8df; color: #000;">
   <div class="container mt-4">
      <h1><?= htmlspecialchars($product['name']) ?></h1>
      <p><?= htmlspecialchars($product['description']) ?></p>
      <p><strong>Price:</strong> $<?= number_format($product['price'], 2) ?></p>
      <p><strong>Stock:</strong> <?= $product['stock'] ?></p>

      <a href="../public/index.php" class="btn btn-secondary mb-4">Back to Catalog</a>

      <!-- Existing Reviews -->
      <h3>Customer Reviews</h3>
      <?php if (empty($reviews)): ?>
         <p class="text-muted">No reviews yet.</p>
      <?php else: ?>
         <?php foreach ($reviews as $review): ?>
            <div class="border rounded p-2 mb-2">
               <strong><?= htmlspecialchars($review['firstname']) ?>:</strong>
               <span><?= str_repeat('⭐', $review['rating']) ?></span>
               <p><?= htmlspecialchars($review['comments']) ?></p>
               <small class="text-muted"><?= htmlspecialchars($review['review_date']) ?></small>
            </div>
         <?php endforeach; ?>
      <?php endif; ?>

      <!-- Add Review (If Logged In) -->
      <?php if ($user): ?>
         <h3 class="mt-4">Add Your Review</h3>
         <form action="../controllers/Review/addReview.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $product_id ?>">
            <div class="mb-3">
               <label for="rating" class="form-label">Rating</label>
               <select name="rating" id="rating" class="form-select" required>
                  <option value="">Select</option>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                     <option value="<?= $i ?>"><?= $i ?> ⭐</option>
                  <?php endfor; ?>
               </select>
            </div>
            <div class="mb-3">
               <label for="comments" class="form-label">Comments</label>
               <textarea name="comments" id="comments" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit Review</button>
         </form>
      <?php else: ?>
         <p class="text-muted">Please <a href="login.php">log in</a> to leave a review.</p>
      <?php endif; ?>
   </div>
</body>

</html>