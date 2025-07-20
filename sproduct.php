<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech2etc Ecommerce Tutorial</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="style.css">
</head>


<!-- PHP QUERY -->
<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "Product ID not found.";
    exit();
}
// search for main product
$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Product not found.";
    exit();
}

$product = $result->fetch_assoc();
// Search for small pics
$image_sql = "SELECT image_url FROM image_list WHERE product_id = ?";
$image_stmt = $conn->prepare($image_sql);
$image_stmt->bind_param("i", $product_id);
$image_stmt->execute();
$image_result = $image_stmt->get_result();

$images = [];
while ($img = $image_result->fetch_assoc()) {
    $images[] = $img['image_url'];
}

?>


<body class="sub-page">

    <!-- Header/Navbar Section -->
    <header id="header">
        <!-- Logo -->
        <a href="index.php"><img src="img/Icon.png" class="logo" alt="Poppy Logo"></a>
        <!-- Desktop Navigation -->
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
                <!--SHOP: Dropdown Menus -->
                <li class="dropdown">
                    <div class="dropdown-toggle">
                        <a href="#">SHOP</a>
                        <button class="dropdown-btn"><span class="arrow">▾</span></button>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a href="#">ALL-ITEMS</a></li>
                        <li><a href="#">TOPS</a></li>
                        <li><a href="#">SEE-THROUGH</a></li>
                        <li><a href="#">TUNIC</a></li>
                        <li><a href="#">DRESSES</a></li>
                        <li><a href="#">BOTTOMS</a></li>
                        <li><a href="#">BAG</a></li>
                        <li><a href="#">ACCESSORY</a></li>
                    </ul>
                </li>

                <!-- COLLECTION: Dropdown Menu -->
                <li class="dropdown">
                    <div class="dropdown-toggle">
                        <a href="#">COLLECTIONS</a>
                        <button class="dropdown-btn"><span class="arrow">▾</span></button>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a href="black_collection.php">Black Collection 2025</a></li>
                        <li><a href="poppy_keita.php">POPPY X KEITAMARUYAMA</a></li>
                        <li><a href="summer_collection.php">Early Summer Collection</a></li>
                        <li><a href="spring_collection.php">Spring Collection</a></li>
                    </ul>
                </li>

                <li><a href="blog.html">News</a></li>

                <!-- LOOKBOOK: Dropdown Menu -->
                <li class="dropdown">
                    <div class="dropdown-toggle">
                        <a href="lookbook.html">LookBook</a>
                        <button class="dropdown-btn"><span class="arrow">▾</span></button>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a href="editorial.html">Editorial</a></li>
                        <li><a href="style.html">Style Inspo</a></li>
                        <li><a href="video.html">Videos</a></li>
                    </ul>
                </li>
                <!-- Icons: Wishlist, Profile, Cart -->
                <li><a href="wishlist.html" title="Wishlist">
                        <i class="far fa-heart"></i>
                        <span class="link-text">Wishlist</span>
                    </a></li>
                <li><a href="wy_login.php" title="Profile">
                        <i class="far fa-user"></i>
                        <span class="link-text">Profile</span>
                    </a></li>
                <li><a href="cart.html" title="Cart">
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

    <!-- PRODUCT DETAILS -->
    <section id="prodetails" class="section-p1">
        <!-- PRODUCT IMAGES -->
        <div class="single-pro-image">
            <!-- MAIN IMAGE -->
            <img src="<?php echo $product['main_image_url']; ?>" width="100%" id="MainImg" alt="">
            <!--IMAGE LISTS-->
            <div class="small-img-group">
                <div class="small-img-col"><img src="<?php echo $product['main_image_url']; ?>" class="small-img"
                        width="100%"></div>
                <?php foreach ($images as $url): ?>
                <div class="small-img-col">
                    <img src="<?php echo $url; ?>" width="100%" class="small-img" alt="">
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- PRODUCT DESCRIPTIONS -->
        <div class="single-pro-details">
            <h6>Home / <?php echo $product['collection']; ?></h6>
            <h4><?php echo htmlspecialchars($product['name']); ?></h4>
            <h2>$<?php echo number_format($product['price'], 2); ?></h2>
            <!-- CART OPERATIONS -->
            <select>
                <option>Select Size</option>
                <option>XL</option>
                <option>XXL</option>
                <option>Small</option>
                <option>Large</option>
            </select>
            <input type="number" value="1">
            <button class="white">Add To Cart</button>
            <!-- DETAILS -->
            <h4>Product Details</h4>
            <span><?php echo nl2br(htmlspecialchars($product['description'])); ?></span>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products </h2>
        <p>Summer Collection New Morden Design</p>
        <div class="pro-container">
            <div class="pro">
                <img src="img/products/n1.jpg" alt="">
                <div class="des">
                    <span>adidas</span>
                    <h5>Cartoon Astronaut T-Shirts</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$78</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            <div class="pro">
                <img src="img/products/n2.jpg" alt="">
                <div class="des">
                    <span>adidas</span>
                    <h5>Cartoon Astronaut T-Shirts</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$78</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            <div class="pro">
                <img src="img/products/n3.jpg" alt="">
                <div class="des">
                    <span>adidas</span>
                    <h5>Cartoon Astronaut T-Shirts</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$78</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            <div class="pro">
                <img src="img/products/n4.jpg" alt="">
                <div class="des">
                    <span>adidas</span>
                    <h5>Cartoon Astronaut T-Shirts</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$78</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>

        </div>
    </section>


    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span> </p>
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

        <!-- Copyright Footer -->
        <div class="copyright">
            <p>© 2025, Poppy Fashion</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>