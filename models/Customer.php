<?php
class Customer {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Customer WHERE customer_id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return ($user) ? $user : false;
    }

    public function register($firstname, $lastname, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO Customer (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT)]);
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM Customer WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return ($user && password_verify($password, $user['password'])) ? $user : false;
    }
}
?>