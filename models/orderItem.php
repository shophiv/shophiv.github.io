<?php
class orderItem
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function getTotalOrdersBySellerId($id)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS count FROM OrderItem WHERE seller_id= ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['count'] : 0;
    }
}
