<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header('Location: wy_login.php');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    // 从数据库删除指定用户的购物项
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
}

header('Location: wy_cart.php');
exit();
?>
