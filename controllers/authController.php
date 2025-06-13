<?php
require_once '../config/db.php';
require_once '../models/Customer.php';
require_once '../models/Seller.php';

$customer = new Customer($pdo);
$seller = new Seller($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $customer->register($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'], $_POST['phone']);
        header("Location: ../views/login.php");
    }

    if (isset($_POST['login'])) {
        $user = $customer->login($_POST['email'], $_POST['password']);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;

            $_SESSION['role'] = 'buyer';
            header("Location: ../views/buyerDashboard.php");
        } else {
            echo "Invalid credentials";
        }
    }
}
?>