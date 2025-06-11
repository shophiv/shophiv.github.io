<?php
class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addProduct($name, $desc, $price, $seller_id) {
        $stmt = $this->pdo->prepare("INSERT INTO Product (name, description, price, seller_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $desc, $price, $seller_id]);
    }

    public function getBySellerId($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM Product WHERE seller_id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ($row) ? $row : false;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM Product");
        return $stmt->fetchAll();
    }
}
?>