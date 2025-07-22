<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

// 获取购物车内容（包含size和价格）
$stmt = $conn->prepare("SELECT c.product_id, c.quantity, c.size, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Cart is empty']);
    exit;
}

$items = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
    $total += $row['price'] * $row['quantity'];
}

// 插入订单
$orderStmt = $conn->prepare("INSERT INTO orders (order_date, total_amount, user_id) VALUES (NOW(), ?, ?)");
$orderStmt->bind_param("di", $total, $user_id);
$orderStmt->execute();
$order_id = $conn->insert_id;

// 插入订单明细
$itemStmt = $conn->prepare("INSERT INTO order_items (quantity, price, product_id, order_id) VALUES (?, ?, ?, ?)");
$variantUpdateStmt = $conn->prepare("UPDATE product_variants SET stock = stock - ? WHERE product_id = ? AND size = ?");

foreach ($items as $item) {
    $itemStmt->bind_param("idii", $item['quantity'], $item['price'], $item['product_id'], $order_id);
    $itemStmt->execute();

    // 更新库存：无论有无 size，都传空字符串
    $size = $item['size'] ?? '';
    $variantUpdateStmt->bind_param("iis", $item['quantity'], $item['product_id'], $size);
    $variantUpdateStmt->execute();
}

// 清空购物车
$clearCartStmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
$clearCartStmt->bind_param("i", $user_id);
$clearCartStmt->execute();

// ✅ 使用 header() 跳转到订单成功页面
header("Location: wy_order_success.php?order_id=" . $order_id);
exit;
?>
