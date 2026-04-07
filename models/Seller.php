<?php
class Seller {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($firstname, $lastname, $email, $password, $c_id, $phone) {
        $stmt = $this->pdo->prepare("INSERT INTO Seller (firstname, lastname, email, password, customer_id, phone) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $c_id, $phone]);
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM Seller WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return ($user && password_verify($password, $user['password'])) ? $user : false;
    }

    public function updateSeller($id, $firstname, $lastname, $email, $password, $c_id, $phone, $street,$city, $state){
            $stmt = $this->pdo->prepare(
                "UPDATE seller SET firstname = ?, lastname = ?, email = ?, password = ?, customer_id = ?, phone = ?, street = ?, city = ?, state = ? WHERE seller_id = ?"
            );
            return $stmt->execute([$firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $c_id, $phone, $street, $city, $state, $id]);
    }

    public function loginByCustomerId($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM Seller WHERE customer_id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch();
            return ($user) ? $user : false;
    }
}
?>