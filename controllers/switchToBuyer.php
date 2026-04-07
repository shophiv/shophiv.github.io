<?php
require_once '../config/db.php';
require_once '../models/Customer.php';
require_once '../models/Seller.php';

$customer = new Customer($pdo);
$seller = new Seller($pdo);

session_start();
$user = $_SESSION['user'];

$change = $customer->getId($user['customer_id']);
if($change){
    $_SESSION['user'] = $change;
    $_SESSION['role'] = 'buyer';
    header("Location: ../views/buyerDashboard.php");
}else{
echo('error customer_id not found');
}

?>
