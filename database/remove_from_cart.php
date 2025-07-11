<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['cart'][$_GET['id']])) {
    unset($_SESSION['cart'][$_GET['id']]);
}

// 回到购物车页面
header("Location: cart.php");
exit();
?>
