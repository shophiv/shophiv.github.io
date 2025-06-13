<?php session_start();
if ($_SESSION['role'] === 'buyer') {
    header("Location: ../views/buyerDashboard.php");
    exit();
} elseif ($_SESSION['role'] === 'seller') {
    header("Location: ../views/sellerDashboard.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>