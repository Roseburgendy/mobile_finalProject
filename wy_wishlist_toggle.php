<?php
session_start();
include 'config.php';

header('Content-Type: text/plain'); // 强制响应为纯文本
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo "not_logged_in";
    exit;
}

if (!isset($_POST['product_id'])) {
    http_response_code(400);
    echo "missing_product_id";
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);

$stmt = $conn->prepare("SELECT 1 FROM wishlist WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$stmt->store_result(); // 更稳定

if ($stmt->num_rows > 0) {
    $delete = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
    $delete->bind_param("ii", $user_id, $product_id);
    $delete->execute();
    echo "removed";
} else {
    $insert = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
    $insert->bind_param("ii", $user_id, $product_id);
    $insert->execute();
    echo "added";
}

exit;
