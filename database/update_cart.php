<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['id'];
$action = $_POST['action'];

// 查询是否已有该商品
$stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $quantity = $row['quantity'];

    if ($action === 'increase') {
        $quantity++;
    } elseif ($action === 'decrease') {
        $quantity--;
    }

    if ($quantity <= 0) {
        $del = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        $del->bind_param("ii", $user_id, $product_id);
        $del->execute();
    } else {
        $upd = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $upd->bind_param("iii", $quantity, $user_id, $product_id);
        $upd->execute();
    }

} else {
    if ($action === 'increase') {
        $ins = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
        $ins->bind_param("ii", $user_id, $product_id);
        $ins->execute();
    }
}

$conn->close();
header("Location: cart.php");
exit();
?>
