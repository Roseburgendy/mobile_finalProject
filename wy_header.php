<?php
include_once 'session_init.php'; // 避免重复调用 session_start()
?>
<header id="header">
    <a href="index.php"><img src="img/Icon.png" class="logo" alt="Poppy Logo"></a>
    <div>
        <ul id="navbar">
            <li><a class="<?php echo ($activePage == 'home') ? 'active' : ''; ?>" href="index.php">Home</a></li>
            <li><a class="<?php echo ($activePage == 'shop') ? 'active' : ''; ?>" href="shop.php">Shop</a></li>
            <li class="dropdown">
                <div class="dropdown-toggle">
                    <a href="#">Collections</a>
                    <button class="dropdown-btn"><span class="arrow">▾</span></button>
                </div>
                <ul class="dropdown-menu">
                    <li><a class="<?php echo ($activePage == 'black_collection') ? 'active' : ''; ?>"
                            href="black_collection.php">Black Collection 2025</a></li>
                    <li><a class="<?php echo ($activePage == 'poppy_keita') ? 'active' : ''; ?>"
                            href="poppy_keita.php">POPPY X KEITAMARUYAMA</a></li>
                    <li><a class="<?php echo ($activePage == 'summer_collection') ? 'active' : ''; ?>"
                            href="summer_collection.php">Early Summer Collection</a></li>
                    <li><a class="<?php echo ($activePage == 'spring_collection') ? 'active' : ''; ?>"
                            href="spring_collection.php">Spring Collection</a></li>
                </ul>
            </li>
            <li><a class="<?php echo ($activePage == 'news') ? 'active' : ''; ?>" href="news.php">News</a></li>
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

            <!-- Wishlist -->
            <li><a class="<?php echo ($activePage == 'wishlist') ? 'active' : ''; ?>" href="wishlist.php"
                    title="Wishlist">
                    <i class="far fa-heart"></i>
                    <span class="link-text">Wishlist</span>
                </a></li>

            <!-- 用户登录状态显示 -->
            <?php if (isset($_SESSION['email'])): ?>
            <li><a class="<?php echo ($activePage == 'wy_profile') ? 'active' : ''; ?>" href="wy_profile.php"
                    title="Profile">
                    <i class="far fa-user"></i>
                    <span class="link-text">
                        <?php
    if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
        echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']);
    }  else {
        echo 'User';
    }
  ?>
                    </span>


                </a></li>
            <li><a class="<?php echo ($activePage == 'wy_logout') ? 'active' : ''; ?>" href="wy_logout.php"
                    title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="link-text">Logout</span>
                </a></li>
            <?php else: ?>
            <li><a class="<?php echo ($activePage == 'wy_login') ? 'active' : ''; ?>" href="wy_login.php" title="Login">
                    <i class="far fa-user"></i>
                    <span class="link-text">Login</span>
                </a></li>
            <li><a class="<?php echo ($activePage == 'wy_register') ? 'active' : ''; ?>" href="wy_register.php"
                    title="Register">
                    <i class="far fa-user-plus"></i>
                    <span class="link-text">Register</span>
                </a></li>
            <?php endif; ?>
            <li><a class="<?php echo ($activePage == 'wy_cart') ? 'active' : ''; ?>" href="wy_cart.php" title="Cart">
                    <i class="far fa-shopping-cart"></i>
                    <span class="link-text">Cart</span>
                </a></li>

            <a href="#" id="close"><i class="far fa-times"></i></a>
        </ul>
    </div>

    <div id="mobile">
        <a class="<?php echo ($activePage == 'wy_cart') ? 'active' : ''; ?>" href="wy_cart.php" title="Cart"><i
                class="far fa-shopping-cart"></i></a>
        <i id="bar" class="far fa-bars"></i>
    </div>
</header>