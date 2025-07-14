<?php
session_start();

// 获取商品 ID 和尺码
if (!isset($_GET['id']) || !isset($_GET['size'])) {
    echo "Missing product ID or size.";
    exit();
}

$product_id = $_GET['id'];
$size = $_GET['size'];

// 生成购物车的唯一键（例如：5_M）
$cart_key = $product_id . '_' . $size;

// 初始化购物车数组
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 如果已存在相同商品 + 尺码，数量加 1
if (isset($_SESSION['cart'][$cart_key])) {
    $_SESSION['cart'][$cart_key]['quantity']++;
} else {
    $_SESSION['cart'][$cart_key] = [
        'quantity' => 1,
        'size' => $size
    ];
}

// 跳转回购物车页面
header("Location: cart.php");
exit();
?>
