<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: wy_login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// 查询所有订单
$orderStmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
$orderStmt->bind_param("i", $user_id);
$orderStmt->execute();
$orders = $orderStmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<h2>My Orders</h2>
<?php foreach ($orders as $order): ?>
    <div class="order-block">
        <h3>Order #<?= $order['id'] ?> - <?= $order['order_date'] ?> - RM <?= number_format($order['total_amount'], 2) ?></h3>
        <ul>
            <?php
            $itemStmt = $conn->prepare("SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE order_id = ?");
            $itemStmt->bind_param("i", $order['id']);
            $itemStmt->execute();
            $items = $itemStmt->get_result()->fetch_all(MYSQLI_ASSOC);
            foreach ($items as $item):
            ?>
                <li><?= $item['name'] ?> x <?= $item['quantity'] ?> @ RM<?= $item['price'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>
