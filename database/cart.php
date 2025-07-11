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

// 获取商品 ID 列表
$ids = implode(',', array_keys($_SESSION['cart']));
$sql = "SELECT * FROM products WHERE id IN ($ids)";
$result = $conn->query($sql);

// 显示购物车商品
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8'><tr><th>Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $quantity = $_SESSION['cart'][$id];
        $subtotal = $row['price'] * $quantity;
        $total += $subtotal;

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>$" . $row['price'] . "</td>";
        echo "<td>
            <form action='update_cart.php' method='post' style='display:inline;'>
                <input type='hidden' name='id' value='$id'>
                <button type='submit' name='action' value='decrease'>-</button>
            </form>
            $quantity
            <form action='update_cart.php' method='post' style='display:inline;'>
                <input type='hidden' name='id' value='$id'>
                <button type='submit' name='action' value='increase'>+</button>
            </form>
        </td>";

        echo "<td>$" . number_format($subtotal, 2) . "</td>";
        echo "<td><a href='remove_from_cart.php?id=$id'>Remove</a></td>";
        echo "</tr>";
    }

    echo "<tr><td colspan='3'><strong>Total</strong></td><td colspan='2'><strong>$" . number_format($total, 2) . "</strong></td></tr>";
    echo "</table>";
} else {
    echo "Cart items not found in database.";
}

$conn->close();
echo "<p><a href='products.php'>← Back to Product List</a></p>";
?>
