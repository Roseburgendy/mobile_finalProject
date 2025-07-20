<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="sub-page">

    <!-- Header/Navbar Section -->
    <header id="header">
        <!-- Logo -->
        <a href="index.php"><img src="img/Icon.png" class="logo" alt="Poppy Logo"></a>
        <!-- Desktop Navigation -->
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <!--SHOP: Dropdown Menus -->
                <li>
                    <a href="shop.php">Shop</a>
                </li>

                <!-- COLLECTION: Dropdown Menu -->
                <li class="dropdown">
                    <div class="dropdown-toggle">
                        <a href="#">Collections</a>
                        <button class="dropdown-btn"><span class="arrow">▾</span></button>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a href="black_collection.php">Black Collection 2025</a></li>
                        <li><a href="poppy_keita.php">POPPY X KEITAMARUYAMA</a></li>
                        <li><a href="summer_collection.php">Early Summer Collection</a></li>
                        <li><a href="spring_collection.php">Spring Collection</a></li>
                    </ul>
                </li>

                <li><a href="news.php">News</a></li>

                <!-- LOOKBOOK: Dropdown Menu -->
                <li class="dropdown">
                    <div class="dropdown-toggle">
                        <a href="#">LookBook</a>
                        <button class="dropdown-btn"><span class="arrow">▾</span></button>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a href="editorial.php">Editorial</a></li>
                        <li><a href="style.php">Style Inspo</a></li>
                        <li><a href="video.php">Videos</a></li>
                    </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <!-- Icons: Wishlist, Profile, Cart -->
                <li><a href="wishlist.html" title="Wishlist">
                        <i class="far fa-heart"></i>
                        <span class="link-text">Wishlist</span>
                    </a></li>
                <li><a href="wy_login.php" title="Profile">
                        <i class="far fa-user"></i>
                        <span class="link-text">Profile</span>
                    </a></li>
                <li><a href="wy_cart.php" title="Cart">
                        <i class="far fa-shopping-cart"></i>
                        <span class="link-text">Cart</span>
                    </a></li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <!-- Mobile Icons -->
        <div id="mobile">
            <a href="cart.html" title="Cart"><i class="far fa-shopping-cart"></i></a>
            <i id="bar" class="far fa-bars"></i>
        </div>
    </header>
    <section id="page-header" class="cart-banner">

        <h2>Cart</h2>

        <p>Read all case studies about our products! </p>

    </section>


    <section class="cart-container section-p1">
        <!-- CART ITEMS -->
        <div class="cart-left">
            <?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: wy_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// GET DATA FROM DATABASE
$sql = "SELECT c.product_id, c.quantity, c.size, p.name, p.price, p.main_image_url
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$item_count = 0;


// SHOW ITEMS CARD
while ($row = $result->fetch_assoc()) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $size = $row['size'];
    $name = $row['name'];
    $price = $row['price'];
    $image_url = $row['main_image_url'];
    $subtotal = $price * $quantity;
    $total += $subtotal;
    $item_count += $quantity;

    // 获取对应库存
    if ($size) {
        $stock_sql = "SELECT stock FROM product_variants WHERE product_id = ? AND size = ?";
        $stock_stmt = $conn->prepare($stock_sql);
        $stock_stmt->bind_param("is", $product_id, $size);
    } else {
        $stock_sql = "SELECT stock FROM product_variants WHERE product_id = ? AND size IS NULL";
        $stock_stmt = $conn->prepare($stock_sql);
        $stock_stmt->bind_param("i", $product_id);
    }

    $stock_stmt->execute();
    $stock_result = $stock_stmt->get_result();
    $stock = ($stock_result->num_rows > 0) ? $stock_result->fetch_assoc()['stock'] : 0;

    echo '
    <div class="cart-card">
        <div class="cart-img">
            <a href="sproduct.php?id=' . htmlspecialchars($product_id) . '">
                <img src="' . htmlspecialchars($image_url) . '" alt="">
            </a>
        </div>
        <div class="cart-info">
            <div class="cart-header">
                <div>
                    <a href="sproduct.php?id=' . htmlspecialchars($product_id) . '">
                        <h4 class="product-title">' . htmlspecialchars($name) . '</h4>' .
                        ($size ? '<p class="product-meta">Size: ' . htmlspecialchars($size) . '</p>' : '') . '
                    </a>
                    <p class="product-price">RM ' . number_format($price, 2) . '</p>
                </div>
                <form method="post" action="wy_remove_from_cart.php">
                    <input type="hidden" name="product_id" value="' . $product_id . '">
                    <input type="hidden" name="size" value="' . $size . '">
                    <button type="button" class="remove-btn" data-product-id="' . $product_id . '">&times;</button>
                </form>
            </div>
            <div class="cart-footer">
                <div class="quantity-block">
<form method="post" action="wy_update_the_cart.php">
    <input type="hidden" name="product_id" value="' . $product_id . '">
    <input type="hidden" name="size" value="' . $size . '">
    <p>In stock: ' . $stock . ' item(s)</p>
    <label for="qty">Quantity:</label>
    <input type="number" name="quantity"
           value="' . $quantity . '"
           min="1"
           max="' . $stock . '"
           onchange="this.form.submit()"
           style="width: 60px;">
</form>

                </div>

                <div class="subtotal">
                    <span>SUBTOTAL: <strong>RM ' . number_format($subtotal, 2) . '</strong></span>
                </div>
            </div>
        </div>
    </div>';
}
?>
        </div>

        <!-- Right-side Order Summary Section -->
        <div class="cart-right">
            <div class="summary-box">
                <h3>ORDER SUMMARY | <span id="cart-count"><?php echo $item_count; ?> ITEM(S)</span></h3>

                <p>Item(s) subtotal <span class="summary-right">RM
                        <?php echo number_format($total, 2); ?></span></p>

                <p><strong>SUBTOTAL</strong>
                    <span class="summary-right"><strong>RM
                            <?php echo number_format($total, 2); ?></strong></span>
                </p>

                <p><strong>ORDER TOTAL</strong>
                    <span class="summary-right"><strong>RM
                            <?php echo number_format($total, 2); ?></strong></span>
                </p>

                <button class="checkout-btn">CHECKOUT</button>
            </div>

            <div class="notice">
                <p>Place your order before 12pm for Same-Day delivery in Klang Valley (Mon-Fri).</p>
            </div>
        </div>

    </section>


    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="img/logo.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address:</strong> 562 Wellington Road, Street 32, San Francisco</p>
            <p><strong>Phone:</strong> +01 2222 365 /(+91) 01 2345 6789</p>
            <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Sat</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest-p"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>
        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play </p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="">
                <img src="img/pay/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateways </p>
            <img src="img/pay/pay.png" alt="">
        </div>

        <div class="copyright">
            <p>© 2021, Tech2 etc - HTML CSS Ecommerce Template</p>
        </div>
    </footer>


    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="deleteModal" style="display:none;">
        <div class="deleteModal-content">
            <span class="close-btn">&times;</span>
            <h3>REMOVE ITEM</h3>
            <p>Are you sure you want to remove this item from your cart?</p>
            <form id="deleteForm" method="post" action="wy_remove_from_cart.php">
                <input type="hidden" name="product_id" id="deleteProductId">
                <div class="deleteModal-buttons">
                    <button type="submit" class="confirm-btn">REMOVE</button>
                    <button type="button" class="cancel-btn">CANCEL</button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
    $(document).ready(function() {
        // 点击删除按钮 => 弹窗淡入
        $('.remove-btn').click(function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            $('#deleteProductId').val(productId);
            $('#deleteModal').fadeIn();
            $('body').css('overflow', 'hidden'); // 禁止页面滚动
        });

        // 点击取消按钮或关闭图标 => 弹窗淡出
        $('.cancel-btn, .close-btn').click(function() {
            $('#deleteModal').fadeOut();
            $('body').css('overflow', ''); // 恢复滚动
        });
    });
    </script>


</body>

</html>