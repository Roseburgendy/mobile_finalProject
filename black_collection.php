<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black Collection 2025</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body class="home-page">
    <?php
include 'config.php';

$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$limit = 8;
$offset = ($page - 1) * $limit;

$where = "collection = 'Black Collection 2025'";
if ($category_id > 0) {
    $where .= " AND category_id = $category_id";
}
if (!empty($query)) {
    $escaped = $conn->real_escape_string($query);
    $where .= " AND (name LIKE '%$escaped%' OR description LIKE '%$escaped%')";
}

$count_sql = "SELECT COUNT(*) AS total FROM products WHERE $where";
$count_result = $conn->query($count_sql);
$total_products = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_products / $limit);

$product_sql = "SELECT * FROM products WHERE $where LIMIT $limit OFFSET $offset";
$product_result = $conn->query($product_sql);

$categories_result = $conn->query("SELECT * FROM category");
?>

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

    <section id="page-header" class="black-banner">
        <h2>Black Collection 2025</h2>
        <p>Save more with coupons & up to 70% off!</p>
    </section>

    <section class="section-p1">
        <div class="filter-bar-wrapper">
            <div class="filter-bar">
                <ul class="filter-list desktop-only">
                    <li><a href="black_collection.php" class="<?= $category_id === 0 ? 'active' : '' ?>">All</a></li>
                    <?php mysqli_data_seek($categories_result, 0); while($cat = $categories_result->fetch_assoc()): ?>
                    <li><a href="black_collection.php?category=<?= $cat['id'] ?>&query=<?= urlencode($query) ?>"
                            class="<?= $category_id == $cat['id'] ? 'active' : '' ?>">
                            <?= htmlspecialchars($cat['name']) ?></a></li>
                    <?php endwhile; ?>
                </ul>
                <select class="mobile-only category-dropdown" onchange="location = this.value;">
                    <option value="black_collection.php" <?= $category_id === 0 ? 'selected' : '' ?>>All</option>
                    <?php mysqli_data_seek($categories_result, 0); while($cat = $categories_result->fetch_assoc()): ?>
                    <option value="black_collection.php?category=<?= $cat['id'] ?>&query=<?= urlencode($query) ?>"
                        <?= $category_id == $cat['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <form method="GET" action="black_collection.php" class="search-form">
                <input type="hidden" name="category" value="<?= $category_id ?>">
                <input type="text" name="query" value="<?= htmlspecialchars($query) ?>"
                    placeholder="Search products...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">
            <?php if ($product_result->num_rows > 0): ?>
            <?php while ($row = $product_result->fetch_assoc()): ?>
            <div class="pro">
                <a href="sproduct.php?id=<?= $row['id'] ?>">
                    <img src="<?= $row['main_image_url'] ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                </a>
                <div class="des">
                    <h5><?= htmlspecialchars($row['name']) ?></h5>
                    <h4>$<?= number_format($row['price'], 2) ?></h4>
                </div>
                <a href="wishlist.php?add=<?= $row['id'] ?>">
                    <i class="far fa-heart cart" title="Add to Wishlist"></i>
                </a>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <p>No products found.</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="pagination" class="section-p1">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="black_collection.php?category=<?= $category_id ?>&query=<?= urlencode($query) ?>&page=<?= $i ?>"
            class="<?= $i == $page ? 'active' : '' ?>">
            <?= $i ?>
        </a>
        <?php endfor; ?>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="img/logo.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address: </strong> 562 Wellington Road, Street 32, San Francisco</p>
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
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="">
                <img src="img/pay/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateways </p>
            <img src="img/pay/pay.png" alt="">
        </div>
        <div class="copyright">
            <p>© 2025, Poppy Fashion</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>