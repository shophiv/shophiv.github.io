<?php
class Seller {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($firstname, $lastname, $email, $password, $c_id) {
        $stmt = $this->pdo->prepare("INSERT INTO Seller (firstname, lastname, email, password, customer_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $c_id]);
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM Seller WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return ($user && password_verify($password, $user['password'])) ? $user : false;
    }

    public function loginByCustomerId($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM Seller WHERE customer_id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch();
            return ($user) ? $user : false;
    }
}
?>