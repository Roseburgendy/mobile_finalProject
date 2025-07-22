<?php
include_once 'session_init.php';
 $activePage = 'wy_wishlist';
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('Please log in to view your wishlist.');
        window.location.href = 'wy_login.php';
    </script>";
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT p.id AS product_id, p.name,p.price, p.main_image_url, p.collection
        FROM wishlist w
        JOIN products p ON w.product_id = p.id
        WHERE w.user_id = ?";
$stmt = $conn->prepare(query: $sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$item_count = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poppy Fashion</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <!-- Main Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="sub-page">

    <?php include 'wy_header.php'; ?>

    <section id="page-header" class="wishlist-banner">

        <h2>Wishlist</h2>

        <p>Read all case studies about our products! </p>

    </section>

    <section class="cart-container section-p1">
        <div class="cart-left">
            <h4><?php echo $item_count; ?> Item(s)</h4>

            <?php
    if ($item_count === 0) {
        echo '<div class="wishlist-empty"><p><strong>Your wish list has no items.</strong><br>Press the heart mark to add items.</p></div>';
    } else {
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $name = htmlspecialchars($row['name']);
            $price = htmlspecialchars(string: $row['price']);
            $image = htmlspecialchars($row['main_image_url']);
            $collection = htmlspecialchars($row['collection']);
            echo '
<div class="cart-card">
    <div class="cart-img">
        <a href="sproduct.php?id=' . $product_id . '"><img src="' . $image . '" alt=""></a>

        <!-- WISHLIST ICON BUTTON -->
        <form method="post" action="wy_wishlist_remove.php" class="floating-wishlist">
            <input type="hidden" name="product_id" value="' . $product_id . '">
            <button type="submit" class="wishlist-toggle">
                <i class="fas fa-heart"></i>
            </button>
        </form>
    </div>

    <div class="cart-info">
        <p>Collection: ' . $collection . '</p>
        <h4>' . $name . '</h4>
        <p>Price: RM' . $price . '</p>
    </div>
</div>';

        }
        }
        ?>
        </div>
    </section>
    <?php include 'wy_footer.php'; ?>
</body>

</html>