<?php
class Product
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addProduct($name, $desc, $price, $category, $stock, $seller_id)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO Product (name, description, price, category, stock, seller_id) VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$name, $desc, $price, $category, $stock, $seller_id]);
    }

    public function updateProduct($id, $name, $desc, $price, $category, $stock)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE Product SET name = ?, description = ?, price = ?, category = ?, stock = ? WHERE product_id = ?"
        );
        return $stmt->execute([$name, $desc, $price, $category, $stock, $id]);
    }

    public function deleteProduct($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Product WHERE product_id = ?");
        return $stmt->execute([$id]);
    }

    public function getBySellerId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Product WHERE seller_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function getByProductId($id){
            $stmt = $this->pdo->prepare("SELECT * FROM Product WHERE product_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }



    public function getCountBySellerId($id)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM Product WHERE seller_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['count'] : 0;
    }
    public function getAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Product");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function getById($product_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Product WHERE product_id = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
