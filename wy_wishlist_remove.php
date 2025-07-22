<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['product_id'])) {
    header("Location: wy_wishlist.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);

$stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();

header("Location: wy_wishlist.php");
exit;
?>
