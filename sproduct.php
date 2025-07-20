<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poppy Fashion</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>


<!-- PHP QUERY -->
<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "Product ID not found.";
    exit();
}
// search for main product and categoryid
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

// Get category name
$category_name="";
$cat_stmt = $conn->prepare("SELECT name FROM category WHERE id = ?");
$cat_stmt-> bind_param("i",$product['category_id']);
$cat_stmt->execute();
$cat_result = $cat_stmt->get_result();
if ($cat_result->num_rows > 0) {
    $category_name = $cat_result->fetch_assoc()['name'];
}


$size_stock_map = [];

// 查询所有该商品的 size 和库存
$variant_stmt = $conn->prepare("SELECT size, stock FROM product_variants WHERE product_id = ?");
$variant_stmt->bind_param("i", $product_id);
$variant_stmt->execute();
$variant_result = $variant_stmt->get_result();

while ($variant = $variant_result->fetch_assoc()) {
    $size_stock_map[$variant['size']] = $variant['stock'];
}


$conn->close();

?>


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
            <h6>Home / <?php echo $product['collection']; ?>/ <?php echo htmlspecialchars($category_name); ?></h6>
            <h4><?php echo htmlspecialchars($product['name']); ?></h4>
            <h2>$<?php echo number_format($product['price'], 2); ?></h2>
            <!-- CART OPERATIONS -->
            <?php
// Get current category id
$category_id = strtolower($product['category_id']);
// Define category that no need to show the select size options
$no_size_categories = [3, 4];
// If not in the no-need-to-show category
if (!in_array($category_id, $no_size_categories)):
?>
<div class="size-selector">
    <?php
    $sizes = ['S', 'M', 'L'];
    foreach ($sizes as $size) {
        $stock = $size_stock_map[$size] ?? 0;
        $disabled = $stock <= 0 ? 'disabled' : '';
        $selected = ($size === 'M') ? 'selected' : '';
        $class = ($size === 'M') ? 'size-option selected' : 'size-option';
        echo "<button class='$class' data-size='$size' $disabled>$size</button>";
    }
    ?>
</div>
<input type="hidden" id="selectedSize" name="size" value="M">


            <?php endif; ?>

            <p id="stockText">
                <?php
if (!in_array($product['category_id'], $no_size_categories)) {
    $stock = $size_stock_map['M'] ?? 0;
    echo $stock > 0 ? "In stock: $stock item(s)" : "<span style='color:red;'>Out of stock</span>";
} else {
    // PRODUCTS THAT DONT HAVE SIZE
    $stock = $size_stock_map[NULL] ?? 0;
    echo $stock > 0 ? "In stock: $stock item(s)" : "<span style='color:red;'>Out of stock</span>";
}
?>
            </p>

            <input id="quantityInput" type="number" value="1" min="1" max="<?php echo $stock; ?>">
            <a href="add_to_cart.php">
                <button class="white">Add To Cart</button>
            </a>
            <!-- DETAILS -->
            <h4>Product Details</h4>
            <span><?php echo nl2br(htmlspecialchars($product['description'])); ?></span>
        </div>
    </section>

    <div id="cartModal" class="modal">
        <div class="modal-content">
            <h3>1 Items added to your cart</h3>
            <p><strong>Subtotal</strong> (<span id="cart-count"></span> item): RM <span id="cart-total"></span></p>

            <div class="modal-divider"></div>

            <h4>Items Purchased Together</h4>
            <div class="recommend-grid" id="recommendations">
                <!-- JS 动态注入推荐项 -->
            </div>

            <div class="modal-divider"></div>

            <div class="modal-actions">
                <a href="wy_cart.php"><button class="normal">View Cart</button></a>
                <button class="continue">Continue Shopping</button>
            </div>
        </div>
    </div>

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

    <script>
    // HANDLE IMAGE PICKER LOGIC
    $(function() {
        $('.small-img').click(function() {
            $('#MainImg').attr('src', $(this).attr('src'));
        });
    });

    // HANDLE SIZE SELECTOR LOGIC

    const stockMap = <?php echo json_encode($size_stock_map); ?>;

    document.querySelectorAll('.size-option').forEach(button => {
        button.addEventListener('click', () => {
            const size = button.dataset.size;
            const stock = stockMap[size] || 0;
            const stockText = stock > 0 ? `In stock: ${stock} item(s)` : 'Out of stock';
            document.getElementById('stockText').innerText = stockText;
        });
    });

    const sizeStock = <?php echo json_encode($size_stock_map); ?>;
    document.addEventListener('DOMContentLoaded', function() {
        const sizeButtons = document.querySelectorAll('.size-option');
        const selectedSizeInput = document.getElementById('selectedSize');
        const quantityInput = document.getElementById('quantityInput');

        sizeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                sizeButtons.forEach(b => b.classList.remove('selected'));
                this.classList.add('selected');
                const size = this.dataset.size;
                selectedSizeInput.value = size;

                // 设置数量最大值
                const maxStock = sizeStock[size] || 0;
                quantityInput.max = maxStock;
                if (parseInt(quantityInput.value) > maxStock) {
                    quantityInput.value = maxStock;
                }
            });

            // 初始禁用按钮样式
            if (btn.hasAttribute('disabled')) {
                btn.classList.add('disabled');
            }
        });
    });


    // HANDLE ADD TO CART LOGIC
    $(document).ready(function() {
        $('.white').click(function(e) {
            e.preventDefault();
            const productId = <?php echo $product_id; ?>;
            const quantity = $('#quantityInput').val();
            const selectedSize = $('#selectedSize').val();

            // SEND TO DATABASE(BACKEND)
            $.post("add_to_cart.php", {
                    product_id: productId,
                    quantity: quantity,
                    size: selectedSize
                },
                // PARSE JSON DATA FROM DATABASE
                function(response) {
                    const data = JSON.parse(response);
                    // IF NOT LOGED IN REQUIRE USER TO LOG IN
                    if (data.status === 'not_logged_in') {
                        alert("Please log in first!");
                        window.location.href = "wy_login.php";
                        return;
                    }
                    // UPDATE THE CART
                    if (data.status === 'success') {
                        $('#cart-count').text(data.cart_count);
                        $('#cart-total').text(data.cart_total);

                        // Recommendation items
                        const recHTML = data.recommendations.map(r => `
                    <div class="recommend-item">
                      <a href="sproduct.php?id=${r.id}">
                        <div class="recommend-image">
                          <img src="${r.main_image_url}" alt="">
                        </div>
                        <div class="recommend-info">
                          <div class="desc">${r.collection}</div>
                          <div class="product-name">${r.name}</div>
                          <div class="price">RM ${parseFloat(r.price).toFixed(2)}</div>
                        </div>
                      </a>
                    </div>
                `).join('');

                        $('#recommendations').html(recHTML);
                        $('#cartModal').fadeIn();

                        // FORBID BG TO MOVE
                        $('body').css('overflow', 'hidden');
                    }
                });
        });

        // close the modal window
        $('.continue').click(function() {
            $('#cartModal').fadeOut();
            $('body').css('overflow', '');
        });
    });
    </script>

    <script src="script.js"></script>
</body>

</html>