<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $qty = intval($_POST['quantity']);
    $size = $_POST['size'] ?? null;
    $user_id = $_SESSION['user_id'];

    // 查询具体库存
    if ($size !== null && $size !== '') {
        $stmt = $conn->prepare("SELECT stock FROM product_variants WHERE product_id = ? AND size = ?");
        $stmt->bind_param("is", $product_id, $size);
    } else {
        $stmt = $conn->prepare("SELECT stock FROM product_variants WHERE product_id = ? AND size IS NULL");
        $stmt->bind_param("i", $product_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $variant = $result->fetch_assoc();

    if (!$variant) {
        echo "<script>alert('Product variant not found.');history.back();</script>";
        exit;
    }

    $stock = $variant['stock'];

    // 检查购物车中是否已有该商品（以及对应 size）
    if ($size !== null && $size !== '') {
        $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ? AND size = ?");
        $stmt->bind_param("iis", $user_id, $product_id, $size);
    } else {
        $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ? AND size IS NULL");
        $stmt->bind_param("ii", $user_id, $product_id);
    }

    $stmt->execute();
    $cart_result = $stmt->get_result();
    $existing = $cart_result->fetch_assoc();
    $existing_qty = $existing ? $existing['quantity'] : 0;

    $new_total_qty =$qty;

    // 检查库存限制
    if ($new_total_qty > $stock) {
        echo "<script>alert('Quantity exceeds stock limit!');history.back();</script>";
        exit;
    }

    if ($existing) {
    if ($new_total_qty == 0) {
        // 删除该商品
        if ($size !== null && $size !== '') {
            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ? AND size = ?");
            $stmt->bind_param("iis", $user_id, $product_id, $size);
        } else {
            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ? AND size IS NULL");
            $stmt->bind_param("ii", $user_id, $product_id);
        }

        $stmt->execute();
    } 
    else {
        // 更新购物车数量
        if ($size !== null && $size !== '') {
            $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ? AND size = ?");
            $stmt->bind_param("iiis", $new_total_qty, $user_id, $product_id, $size);
        } else {
            $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ? AND size IS NULL");
            $stmt->bind_param("iii", $new_total_qty, $user_id, $product_id);
        }

        $stmt->execute();
    }
} else {
    if ($new_total_qty > 0) {
        // 插入新记录
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, size) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $user_id, $product_id, $qty, $size);
        $stmt->execute();
    }
}


    $stmt->execute();

    header("Location: wy_cart.php");
    exit();
}
?>