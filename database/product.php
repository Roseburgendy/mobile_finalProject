<?php
include 'config.php';

// 查询所有商品
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<h2>Product List</h2>

<?php
if ($result->num_rows > 0) {
    echo "<ul style='list-style: none; padding: 0;'>";

    while($row = $result->fetch_assoc()) {
        echo "<li style='border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;'>";

        // 商品名称
        echo "<strong>" . htmlspecialchars($row['name']) . "</strong><br>";

        // 商品价格
        echo "Price: $ " . $row['price'] . "<br>";

        // 库存数量
        echo "Stock: " . $row['stock'] . "<br>";

        // 商品图片（如果有）
        if (!empty($row['image_url'])) {
            echo "<img src='" . htmlspecialchars($row['image_url']) . "' width='150'><br>";
        }

        // 加入购物车按钮（暂无功能）
        echo "<a href='add_to_cart.php?id=" . $row['id'] . "'>";
        echo "<button>Add to Cart</button></a> ";


        // 查看详情按钮（跳转到详情页）
        echo "<a href='product_detail.php?id=" . $row['id'] . "'>";
        echo "<button>View Details</button>";
        echo "</a>";

        echo "</li>";
    }

    echo "</ul>";
} else {
    echo "No products available.";
}

$conn->close(); // 关闭数据库连接
?>
