<?php
session_start();
include 'config.php';

echo "<h2>Your Shopping Cart</h2>";

// 如果购物车为空
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    echo "Your cart is empty.";
    echo "<p><a href='products.php'>← Back to Product List</a></p>";
    exit();
}

$total = 0;

// 获取所有商品ID（注意需要从 "5_M" 拆出 5）
$productIds = [];

foreach ($_SESSION['cart'] as $key => $item) {
    $parts = explode('_', $key);
    $productIds[] = intval($parts[0]);
}

$ids = implode(',', array_unique($productIds));
$sql = "SELECT * FROM products WHERE id IN ($ids)";
$result = $conn->query($sql);

// 创建产品信息映射，方便快速查找
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[$row['id']] = $row;
}

// 显示购物车商品
echo "<table border='1' cellpadding='8'>
<tr><th>Name</th><th>Size</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th></tr>";

foreach ($_SESSION['cart'] as $key => $item) {
    list($id, $size) = explode('_', $key);
    $id = intval($id);

    if (!isset($products[$id])) continue;

    $product = $products[$id];
    $quantity = $item['quantity'];
    $price = $product['price'];
    $subtotal = $price * $quantity;
    $total += $subtotal;

    echo "<tr>";
    echo "<td>" . htmlspecialchars($product['name']) . "</td>";
    echo "<td>" . htmlspecialchars($size) . "</td>";
    echo "<td>$" . number_format($price, 2) . "</td>";
    echo "<td>
        <form action='update_cart.php' method='post' style='display:inline;'>
            <input type='hidden' name='id' value='$id'>
            <input type='hidden' name='size' value='" . htmlspecialchars($size) . "'>
            <button type='submit' name='action' value='decrease'>-</button> //减号
        </form>
        $quantity
        <form action='update_cart.php' method='post' style='display:inline;'>
            <input type='hidden' name='id' value='$id'>
            <input type='hidden' name='size' value='" . htmlspecialchars($size) . "'>
            <button type='submit' name='action' value='increase'>+</button>  //加号
        </form>
    </td>";
    echo "<td>$" . number_format($subtotal, 2) . "</td>";
    echo "<td><a href='remove_from_cart.php?id=$id&size=" . urlencode($size) . "'>Remove</a></td>";
    echo "</tr>";
}

echo "<tr><td colspan='4'><strong>Total</strong></td><td colspan='2'><strong>$" . number_format($total, 2) . "</strong></td></tr>";
echo "</table>";

$conn->close();

echo "<p><a href='products.php'>← Back to Product List</a></p>";
?>
