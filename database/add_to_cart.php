<?php
session_start();

if (!isset($_GET['id'])) {
    echo "Invalid product ID.";
    exit();
}

$product_id = $_GET['id'];

// 初始化购物车
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 如果商品已在购物车中，数量 +1，否则设为 1
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]++;
} else {
    $_SESSION['cart'][$product_id] = 1;
}

// 跳转回商品列表页
header("Location: cart.php");
exit();
?>
