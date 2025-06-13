<?php
require_once '../config/db.php';
require_once '../models/Customer.php';
require_once '../models/Seller.php';
session_start();

$user = $_SESSION['user'];
if($_SESSION['role'] === 'buyer'){
$customer = new Customer($pdo);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            $street = empty($_POST['street']) ? null : $_POST['street'];
            $city = empty($_POST['city']) ? null : $_POST['city'];
            $state = empty($_POST['state']) ? null : $_POST['state'];
            $customer->updateCustomer(
                    $user['customer_id'],
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['email'],
                    $_POST['password'],
                    $_POST['phone'],
                    $street,
                    $city,
                    $state
            );
            $user = $customer->login($_POST['email'], $_POST['password']);
             if ($user) {
                 $_SESSION['user'] = $user;
                 $_SESSION['role'] = 'buyer';
                 header("Location: ../views/settings.php");
             }
        }
    }
}else{
$seller = new Seller($pdo);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            $street = empty($_POST['street']) ? null : $_POST['street'];
            $city = empty($_POST['city']) ? null : $_POST['city'];
            $state = empty($_POST['state']) ? null : $_POST['state'];
            $seller->updateSeller(
                    $user['seller_id'],
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['email'],
                    $_POST['password'],
                    $user['customer_id'],
                    $_POST['phone'],
                    $street,
                    $city,
                    $state
            );
            $user = $seller->login($_POST['email'], $_POST['password']);
             if ($user) {
                 $_SESSION['user'] = $user;
                 $_SESSION['role'] = 'seller';
                 header("Location: ../views/settings.php");
             }
        }
    }

}

?>