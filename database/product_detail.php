<?php
include 'config.php';

// 判断是否传入 id 参数
if (!isset($_GET['id'])) {
    echo "Product ID not provided.";
    exit();
}

$product_id = $_GET['id'];

// 查询对应商品
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// 判断是否找到该商品
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    ?>
    
    <h2>Product Details</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
    <p><strong>Price:</strong> $ <?php echo $row['price']; ?></p>
    <p><strong>Stock:</strong> <?php echo $row['stock']; ?></p>

    <?php if (!empty($row['image_url'])): ?>
        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" width="200"><br>
    <?php endif; ?>

    <p><strong>Description:</strong></p>
    <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>

    <p><a href="products.php"><button>← Back to Product List</button></a></p>

    <h3>Select Size and Add to Cart</h3>
    <form action="add_to_cart.php" method="get">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="size">Size:</label>
        <select name="size" required>
            <option value="">--Select Size--</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select>

        <button type="submit">Add to Cart</button>
    </form>

    <?php
} else {
    echo "Product not found.";
}





$stmt->close();
$conn->close();
?>
