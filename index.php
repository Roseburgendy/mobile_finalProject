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


<body class="home-page">
    <!-- Header/Navbar Section -->
    <header id="header">
        <!-- Logo -->
        <a href="index.php"><img src="img/Icon.png" class="logo" alt="Poppy Logo"></a>
        <!-- Desktop Navigation -->
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
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
                        <a href="lookbook.html">LookBook</a>
                        <button class="dropdown-btn"><span class="arrow">▾</span></button>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a href="editorial.html">Editorial</a></li>
                        <li><a href="style.html">Style Inspo</a></li>
                        <li><a href="video.html">Videos</a></li>
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

    <!-- Hero Section -->
    <section id="hero">
        <div class="slider">
            <div class="slide slide1">
                <img src="img/hero_section/Hero_1.webp" alt="Hero Slide">
                <div class="overlay"></div>
                <div class="caption">
                    <h3>POPPY 2025 SPRING COLLECTION</h3>
                    <p>Step into the season with soft silhouettes and blooming hues. A fresh take on effortless
                        elegance.</p>
                </div>
            </div>
            <div class="slide slide2">
                <img src="img/hero_section/Hero_2.webp" alt="Hero Slide">
                <div class="overlay"></div>
                <div class="caption">
                    <h3>POPPY BLACK COLLECTION</h3>
                    <p>Where minimal meets bold. A timeless monochrome story made for day to night transitions.</p>
                </div>
            </div>
            <div class="slide slide3">
                <img src="img/hero_section/Hero_3.webp" alt="Hero Slide">
                <div class="overlay"></div>
                <div class="caption">
                    <h3>POPPY EARLY SUMMER COLLECTION</h3>
                    <p>Breezy textures, sun-kissed tones. Feel the lightness of early summer in every movement.</p>
                </div>
            </div>
            <div class="slide slide4">
                <img src="img/hero_section/Hero_4.webp" alt="Hero Slide">
                <div class="overlay"></div>
                <div class="caption">
                    <h3>POPPY X KEITAMARUYAMA</h3>
                    <p>A fusion of cultures, colors, and craftsmanship. Discover the limited-edition collab capsule.</p>
                </div>
            </div>
        </div>
        <div class="dots" id="slider-dots">
            <span class="dot active" data-index="0"></span>
            <span class="dot" data-index="1"></span>
            <span class="dot" data-index="2"></span>
            <span class="dot" data-index="3"></span>
        </div>
    </section>

    <!-- Black Collection Products Section -->
    <section id="product1" class="section-p1">
        <h2>Black Collection 2025</h2>
        <p>Summer Collection New Morden Design</p>
        <div class="pro-container">
            <!-- PHP Query -->
            <?php
require_once 'config.php';
  // ONLY SHOW ITEMS IN COLLECTION AND LIMIT VIEW TO 4
$sql = "SELECT * FROM products WHERE collection ='Black Collection 2025' LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
            <div class="pro">
                <a href="sproduct.php?id=<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['main_image_url']; ?>"
                        alt="<?php echo htmlspecialchars($row['name']); ?>">
                </a>
                <div class="des">
                    <h5><?php echo htmlspecialchars($row['name']); ?></h5>
                    <h4>$<?php echo number_format($row['price'], 2); ?></h4>
                </div>
                <a href="wishlist.php?add=<?php echo $row['id']; ?>">
                    <i class="far fa-heart cart" title="Add to Wishlist"></i>
                </a>
            </div>
            <?php
    }
} else {
    echo "<p>No products found.</p>";
}
?>
            <!-- Read More Button -->
            <div style="text-align: center; margin-top: 20px;">
                <a href="black_collection.php" class="normal" style="text-decoration: none;">
                    <button class="white">View Full Collection →</button>
                </a>
            </div>

    </section>

    <!-- Promotional Banner Section -->
    <section id="banner" class="section-m1">
        <h2>POPPY OFFICIAL LINE</h2>
        <h3>Up to <span>3,000pt</span> for New Members</h3>
        <button class="white">Explore More</button>
    </section>

    <!-- Spring Collection Products Section -->
    <section id="product1" class="section-p1">
        <h2>Spring Collection 2025</h2>
        <p>Summer Collection New Morden Design</p>
        <div class="pro-container">
            <!-- PHP Query -->
            <?php
require_once 'config.php';
  // ONLY SHOW ITEMS IN COLLECTION AND LIMIT VIEW TO 4
$sql = "SELECT * FROM products WHERE collection ='Spring Collection 2025' LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
            <div class="pro">
                <a href="sproduct.php?id=<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['main_image_url']; ?>"
                        alt="<?php echo htmlspecialchars($row['name']); ?>">
                </a>
                <div class="des">
                    <h5><?php echo htmlspecialchars($row['name']); ?></h5>
                    <h4>$<?php echo number_format($row['price'], 2); ?></h4>
                </div>
                <a href="wishlist.php?add=<?php echo $row['id']; ?>">
                    <i class="far fa-heart cart" title="Add to Wishlist"></i>
                </a>
            </div>
            <?php
    }
} else {
    echo "<p>No products found.</p>";
}
?>
            <!-- Read More Button -->
<div style="text-align: center; margin-top: 20px;">
    <a href="spring_collection.php">
        <button class="white">View Full Collection →</button>
    </a>
</div>

    </section>

    
    <!-- Two Promotional Mini Banners -->
    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Crazy Deals</h4>
            <h2>Buy 1 Get 1 Free</h2>
            <span>The best classic dress is on sale at Poppy</span>
            <button class="white">Learn More</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>Spring/Summer</h4>
            <h2>Upcoming Season</h2>
            <span>The best classic dress is on sale at Poppy</span>
            <button class="white">Collection</button>
        </div>
    </section>

    <!-- Early Summer Collection Products Section -->
    <section id="product1" class="section-p1">
        <h2>Early Summer Collection 2025</h2>
        <p>Summer Collection New Morden Design</p>
        <div class="pro-container">
            <!-- PHP Query -->
            <?php
require_once 'config.php';
  // ONLY SHOW ITEMS IN COLLECTION AND LIMIT VIEW TO 4
$sql = "SELECT * FROM products WHERE collection ='Early Summer Collection' LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
            <div class="pro">
                <a href="sproduct.php?id=<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['main_image_url']; ?>"
                        alt="<?php echo htmlspecialchars($row['name']); ?>">
                </a>
                <div class="des">
                    <h5><?php echo htmlspecialchars($row['name']); ?></h5>
                    <h4>$<?php echo number_format($row['price'], 2); ?></h4>
                </div>
                <a href="wishlist.php?add=<?php echo $row['id']; ?>">
                    <i class="far fa-heart cart" title="Add to Wishlist"></i>
                </a>
            </div>
            <?php
    }
} else {
    echo "<p>No products found.</p>";
}

?>
            <!-- Read More Button -->
            <div style="text-align: center; margin-top: 20px;">
                <a href="summer_collection.php" class="normal" style="text-decoration: none;">
                    <button class="white">View Full Collection →</button>
                </a>
            </div>

    </section>

    <!-- Promotional Banner Section -->
    <section id="banner" class="section-m1">
        <h2>POPPY OFFICIAL LINE</h2>
        <h3>Up to <span>3,000pt</span> for New Members</h3>
        <button class="white">Explore More</button>
    </section>

    <!-- POPPY X KEITAMARUYAMA Products Section -->
    <section id="product1" class="section-p1">
        <h2>POPPY X KEITAMARUYAMA Special Collection</h2>
        <p>Summer Collection New Morden Design</p>
        <div class="pro-container">
            <!-- PHP Query -->
            <?php
require_once 'config.php';
  // ONLY SHOW ITEMS IN COLLECTION AND LIMIT VIEW TO 4
$sql = "SELECT * FROM products WHERE collection ='POPPY X KEITAMARUYAMA' LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
            <div class="pro">
                <a href="sproduct.php?id=<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['main_image_url']; ?>"
                        alt="<?php echo htmlspecialchars($row['name']); ?>">
                </a>
                <div class="des">
                    <h5><?php echo htmlspecialchars($row['name']); ?></h5>
                    <h4>$<?php echo number_format($row['price'], 2); ?></h4>
                </div>
                <a href="wishlist.php?add=<?php echo $row['id']; ?>">
                    <i class="far fa-heart cart" title="Add to Wishlist"></i>
                </a>
            </div>
            <?php
    }
} else {
    echo "<p>No products found.</p>";
}

// Close link after all query
    $conn->close();
?>
            <!-- Read More Button -->
            <div style="text-align: center; margin-top: 20px;">
                <a href="poppy_keita.php" class="normal" style="text-decoration: none;">
                     <button class="white">View Full Collection →</button>
                </a>
            </div>

    </section>

    <!-- Three Horizontal Banners Section -->
    <section id="banner3">
        <div class="banner-box">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection -50% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>NEW FOOTWEAR COLLECTION</h2>
            <h3>Spring / Summer 2022</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>T-SHIRTS</h2>
            <h3>New Trendy Prints</h3>
        </div>
    </section>

    <!-- Newsletter Subscription Section -->
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

    <!-- Footer Section -->
    <footer class="section-p1">
        <!-- Contact Information -->
        <div class="col">
            <img class="logo" src="img/Icon.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address:</strong> 1F, 6-6-5 Jingumae, Shibuya-ku, Tokyo</p>
            <p><strong>Hours:</strong> 10:00 - 19:00, Mon - Sat</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <i class="fab fa-instagram"></i>
                </div>
            </div>
        </div>

        <!-- About Links -->
        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>

        <!-- Account Links -->
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <!-- App Install Section -->
        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="">
                <img src="img/pay/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png" alt="">
        </div>

        <!-- Copyright Footer -->
        <div class="copyright">
            <p>© 2025, Poppy Fashion</p>
        </div>
    </footer>

    <!-- Main Script -->
    <script src="script.js"></script>
</body>

</html>