<?php
require_once '../config/db.php';
require_once '../models/Seller.php';
session_start();

$seller = new Seller($pdo);
$user = $_SESSION['user'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registerAsSeller'])) {
        $seller->register($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'], $user['customer_id'], $_POST['phone']);
        header("Location: ../views/sellerDashboard.php");
    }
}

$user = $seller->loginByCustomerId($user['customer_id']);
if($user){
$_SESSION['user'] = $user;
$_SESSION['role'] = 'seller';
header("Location: ../views/sellerDashboard.php");

}else{
header("Location: ../views/registerAsSeller.php");
}
?>