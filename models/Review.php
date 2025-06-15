<?php
class Review
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   public function getReviewsByProductId($product_id)
   {
      $stmt = $this->pdo->prepare("SELECT r.rating, r.comments, r.review_date, c.firstname, c.lastname
                                     FROM Review r
                                     JOIN Customer c ON r.customer_id = c.customer_id
                                     WHERE r.product_id = ?
                                     ORDER BY r.review_date DESC");
      $stmt->execute([$product_id]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function addReview($customer_id, $product_id, $rating, $comments)
   {
      $stmt = $this->pdo->prepare("
            INSERT INTO Review (customer_id, product_id, rating, comments, review_date)
            VALUES (?, ?, ?, ?, CURDATE())
        ");
      $stmt->execute([$customer_id, $product_id, $rating, $comments]);
   }

   public function getAverageRating($productId)
   {
      $stmt = $this->pdo->prepare("SELECT AVG(rating) as avg_rating FROM review WHERE product_id = ?");
      $stmt->execute([$productId]);
      $row = $stmt->fetch();
      return $row && $row['avg_rating'] !== null ? $row['avg_rating'] : 0;
   }


   public function getReviewsByProduct($product_id)
   {
      $stmt = $this->pdo->prepare("
            SELECT r.*, c.firstname
            FROM Review r
            JOIN Customer c ON r.customer_id = c.customer_id
            WHERE r.product_id = ?
            ORDER BY r.review_date DESC
        ");
      $stmt->execute([$product_id]);   
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function getReviewCount($productId)
   {
      $stmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM review WHERE product_id = ?");
      $stmt->execute([$productId]);
      $row = $stmt->fetch();
      return $row ? $row['count'] : 0;
   }
}
