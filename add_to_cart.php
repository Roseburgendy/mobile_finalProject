<?php
session_start();
include 'config.php';

// HANDLE LOGIN BEHAVIOR
// IF NOT LOGIN
if (!isset($_SESSION['user_id'])) {
    // INITIALIZE THE CART
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'] ?? 1;
    $size = $_POST['size'] ?? null;

    $key = $product_id . '_' . ($size ?? 'nosize');

    if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$key] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'size' => $size
        ];
    }

    // OUT PUT CART
    echo json_encode([
        'status' => 'guest_cart',
        'cart_count' => array_sum(array_column($_SESSION['cart'], 'quantity'))
    ]);
    exit;
}


// IF THE USER LOGGED IN, READ $_POST FROM JAVA
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'] ?? 1;
$size = $_POST['size'] ?? null;
$user_id = $_SESSION['user_id'];


// INSERT THE DATA TO DATABASE
$checkSql = "SELECT id FROM cart WHERE user_id = ? AND product_id = ?" . ($size ? " AND size = ?" : "");
$checkStmt = $conn->prepare($checkSql);
if ($size) {
    $checkStmt->bind_param("iis", $user_id, $product_id, $size);
} else {
    $checkStmt->bind_param("ii", $user_id, $product_id);
}
$checkStmt->execute();
$checkStmt->store_result();

// WHEN THE ITEM EXISTS IN THE DATABASE, UPDATE QUANTITY ONLY
if ($checkStmt->num_rows > 0) {
    $updateSql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?" . ($size ? " AND size = ?" : "");
    $updateStmt = $conn->prepare($updateSql);
    if ($size) {
        $updateStmt->bind_param("iiis", $quantity, $user_id, $product_id, $size);
    } else {
        $updateStmt->bind_param("iii", $quantity, $user_id, $product_id);
    }
    $updateStmt->execute();
} 
// WHEN THE ITEM NOT EXIST IN THE DATABASE, INSERT NEW RECORDS
else {
    $insertSql = "INSERT INTO cart (user_id, product_id, quantity" . ($size ? ", size" : "") . ") VALUES (?, ?, ?" . ($size ? ", ?" : "") . ")";
    $insertStmt = $conn->prepare($insertSql);
    if ($size) {
        $insertStmt->bind_param("iiis", $user_id, $product_id, $quantity, $size);
    } else {
        $insertStmt->bind_param("iii", $user_id, $product_id, $quantity);
    }
    $insertStmt->execute();
}

// GET RECOMMENDATION ITEMS DATA
// (RULE: RANDOMLY SELECT ITEMS FROM SAME CATEGORY OR COLLECTIONS(MAX 3))
$sql = "SELECT id, name, price, main_image_url,collection FROM products 
        WHERE (category_id = (SELECT category_id FROM products WHERE id = ?) 
               OR collection = (SELECT collection FROM products WHERE id = ?)) 
        AND id != ? ORDER BY RAND()
        LIMIT 4";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $product_id, $product_id, $product_id);
$stmt->execute();
$recommendations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


//  CALCULATE THE TOTAL PRICE
$sql = "SELECT c.quantity, p.price 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$count = 0;
while ($row = $result->fetch_assoc()) {
    $total += $row['quantity'] * $row['price'];
    $count += $row['quantity'];
}

// SEND DATA TO FRONTEND
echo json_encode([
    'status' => 'success',
    'cart_count' => $count,
    'quantity_added' => $quantity,
    'cart_total' => number_format($total, 2),
    'recommendations' => $recommendations
]);
?>
