<?php
session_start();
include 'config.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

echo "<h2>Search Results for: " . htmlspecialchars($query) . "</h2>";

if (empty($query)) {
    echo "<p>No search term entered.</p>";
    echo "<p><a href='welcome.php'>← Back to Home</a></p>";
    exit();
}

// 查询匹配商品（名称或描述中包含搜索词）
$sql = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?";
$stmt = $conn->prepare($sql);
$likeQuery = "%" . $query . "%";
$stmt->bind_param("ss", $likeQuery, $likeQuery);
$stmt->execute();
$result = $stmt->get_result();

// 显示结果
if ($result->num_rows > 0) {
    echo "<ul style='list-style: none; padding: 0;'>";

    while ($row = $result->fetch_assoc()) {
        echo "<li style='border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;'>";

        echo "<strong>" . htmlspecialchars($row['name']) . "</strong><br>";
        echo "Price: $" . number_format($row['price'], 2) . "<br>";
        echo "Stock: " . $row['stock'] . "<br>";

        if (!empty($row['main_image_url'])) {
            echo "<img src='" . htmlspecialchars($row['main_image_url']) . "' width='120'><br>";
        }

        echo "<a href='product_detail.php?id=" . $row['id'] . "'><button>View Details</button></a>";
        echo "</li>";
    }

    echo "</ul>";
} else {
    echo "<p>No products matched your search.</p>";
}

echo "<p><a href='welcome.php'>← Back to Home</a></p>";

$conn->close();
?>
