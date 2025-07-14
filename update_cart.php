<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['id']);
$size = $_POST['size'];
$action = $_POST['action'];
$key = $product_id . '_' . $size;

// 安全检查
if (!isset($_SESSION['cart'][$key])) {
    header("Location: cart.php");
    exit();
}

$current_quantity = $_SESSION['cart'][$key]['quantity'];

// 根据动作修改数量
if ($action === 'increase') {
    $_SESSION['cart'][$key]['quantity']++;
} elseif ($action === 'decrease') {
    $_SESSION['cart'][$key]['quantity']--;

    // 如果数量减到 0 或以下，删除项
    if ($_SESSION['cart'][$key]['quantity'] <= 0) {
        unset($_SESSION['cart'][$key]);

        // 同步删除数据库
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ? AND size = ?");
        $stmt->bind_param("iis", $user_id, $product_id, $size);
        $stmt->execute();

        $conn->close();
        header("Location: cart.php");
        exit();
    }
}

// 更新数据库中的数量
$new_quantity = $_SESSION['cart'][$key]['quantity'];
$check = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ? AND size = ?");
$check->bind_param("iis", $user_id, $product_id, $size);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    $upd = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ? AND size = ?");
    $upd->bind_param("iiis", $new_quantity, $user_id, $product_id, $size);
    $upd->execute();
} else {
    // 如果数据库中没有就插入（理论上应该不会）
    $ins = $conn->prepare("INSERT INTO cart (user_id, product_id, size, quantity) VALUES (?, ?, ?, ?)");
    $ins->bind_param("iisi", $user_id, $product_id, $size, $new_quantity);
    $ins->execute();
}

$conn->close();
header("Location: cart.php");
exit();
