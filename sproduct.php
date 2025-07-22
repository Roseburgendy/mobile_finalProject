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
session_start(); 
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


$wishlist_ids = [];
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT product_id FROM wishlist WHERE user_id = ?");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $wishlist_ids[] = $row['product_id'];
    }
}


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

// looking for size, stock in database
// logic: handle both no size/ have size
$variant_stmt = $conn->prepare("SELECT size, stock FROM product_variants WHERE product_id = ?");
$variant_stmt->bind_param("i", $product_id);
$variant_stmt->execute();
$variant_result = $variant_stmt->get_result();

while ($variant = $variant_result->fetch_assoc()) {
    // if no size, just leave the column empty
    // bind the key(size) with the stock
    // ex: bag: null|15
    // ex: top: M|13
    // ex: top: L|11  
    $key = $variant['size'] ?? '';
    $size_stock_map[$key] = $variant['stock'];
}



$conn->close();

?>


<body class="sub-page">

    <!-- Header/Navbar Section -->
    <?php include 'wy_header.php'; ?>
    <!-- PRODUCT DETAILS -->
    <section id="prodetails" class="section-p1">
        <!-- PRODUCT IMAGES -->
        <div class="single-pro-image">
            <!-- WISHLIST -->
            <a class='floating-wishlist'>
                <!-- 红心按钮（默认空心） -->
                <button type="button" class="wishlist-toggle" data-product-id="<?= $product_id ?>">
                    <i class="<?= in_array($product_id, $wishlist_ids) ? 'fas' : 'far' ?> fa-heart"></i>
                </button>
            </a>
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
            <!-- SIZE SELECTOR -->
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

            <!-- STOCK DISPLAY -->
            <p id="stockText" class="stockText"></p>

            <!-- QUATITY INPUT & ADD TO CART OPERATIONS-->
            <!-- IF IN STOCK -->
            <div id="cartControls">
                <input id="quantityInput" type="number" value="1" min="1" max="<?php echo $stock; ?>">
                <a href="add_to_cart.php">
                    <button class="white">Add To Cart</button>
                </a>
            </div>
            <!-- NOT IN STOCK -->
            <p id="outOfStockText" style="display: none; color: gray;">This size is currently unavailable.</p>
            <!-- DETAILS -->
            <h4>Product Details</h4>
            <span><?php echo nl2br(htmlspecialchars($product['description'])); ?></span>
        </div>
    </section>

    <div id="cartModal" class="modal">
        <div class="modal-content">
            <h3 id="cart-title"></h3>
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

    <?php include 'wy_footer.php'; ?>
    <script>
    const isLoggedIn = <?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>;
    // HANDLE IMAGE PICKER LOGIC
    $(function() {
        $('.small-img').click(function() {
            $('#MainImg').attr('src', $(this).attr('src'));
        });
    });

    // GLOBAL STOCK MAP
    const stockMap = <?php echo json_encode($size_stock_map); ?>;

    // FUNCTION TO 
    // * LIMIT QUANTITY INPUT 
    // * DISPLAY STOCK 
    // BASED ON STOCK OF SIZE OF EVERY PRODUCT
    function updateCartControlsByStock(size) {
        const cartControls = document.getElementById('cartControls');
        const outOfStockText = document.getElementById('outOfStockText');
        const quantityInput = document.getElementById('quantityInput');
        const stockText = document.getElementById('stockText');
        const maxStock = size !== null ? (stockMap[size] || 0) : (stockMap[''] || 0);

        // SHOW/ HIDE CART CONTROLS(HIDE IF NOT IN STOCK)
        if (maxStock <= 0) {
            if (cartControls) cartControls.style.display = 'none';
            if (outOfStockText) outOfStockText.style.display = 'block';
        } else {
            if (cartControls) cartControls.style.display = 'block';
            if (outOfStockText) outOfStockText.style.display = 'none';
        }

        // UPDATE STOCK TEXT
        if (stockText) {
            if (maxStock > 0) {
                stockText.innerText = `In stock: ${maxStock} item(s)`;
                stockText.style.color = '#333';
            } else {
                stockText.innerText = 'Out of stock';
                stockText.style.color = 'red';
            }
        }

        // UPDATE QUANTITY INPUT CONSTRAINTS
        if (quantityInput) {
            quantityInput.max = maxStock;
            if (parseInt(quantityInput.value) > maxStock) {
                quantityInput.value = maxStock;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const sizeButtons = document.querySelectorAll('.size-option');
        const selectedSizeInput = document.getElementById('selectedSize');
        // IF HAVE SIZE BUTTONS
        if (sizeButtons.length > 0) {
            // button behavior
            sizeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    sizeButtons.forEach(b => b.classList.remove('selected'));
                    this.classList.add('selected');
                    const size = this.dataset.size;
                    selectedSizeInput.value = size;
                    updateCartControlsByStock(size);
                });

                // disabled button
                if (btn.hasAttribute('disabled')) {
                    btn.classList.add('disabled');
                }
            });
            // load upon refresh
            const defaultBtn = document.querySelector('.size-option.selected');
            if (defaultBtn) {
                const defaultSize = defaultBtn.dataset.size;
                updateCartControlsByStock(defaultSize);
            }
            // check if all the size is out of stock
            const allOut = Object.values(stockMap).every(stock => parseInt(stock) <= 0);
            if (allOut) {
                updateCartControlsByStock(null);
            }
        }
        // NO SIZE: ACCESSORY & BAGS
        else {
            updateCartControlsByStock(null);
        }
    });

    // HANDLE ADD TO CART LOGIC
    $(document).ready(function() {
        $('.white').click(function(e) {
            e.preventDefault();

            if (!ensureLoggedIn()) return;


            const product_id = <?php echo $product_id; ?>;
            const quantity = $('#quantityInput').val();
            const selectedSize = $('#selectedSize').val();

            // SEND TO DATABASE(BACKEND)
            $.post("add_to_cart.php", {
                    product_id: product_id,
                    quantity: quantity,
                    size: selectedSize
                },
                // PARSE JSON DATA FROM DATABASE
                function(data) {
                    // IF NOT LOGGED IN, REDIRECT
                    if (data.status === 'error') {
                        alert(data.message);
                        window.location.href = 'wy_login.php';
                        return;
                    }
                    $('#cart-title').text(
                        `${quantity} Item${quantity > 1 ? 's' : ''} added to your cart`);
                    // IF NOT LOGED IN REQUIRE USER TO LOG IN


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

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.wishlist-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                fetch('wy_wishlist_toggle.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `product_id=${productId}`
                    })
                    .then(res => res.text())
                    .then(status => {
                        status = status.trim(); // 去除空格、换行
                        console.log("Server status:", status); // 打印调试
                        location.reload(); // 页面刷新会重新加载 PHP 渲染的红心状态

                        if (status === "added") {
                            this.innerHTML = '<i class="fas fa-heart"></i>';
                        } else if (status === "removed") {
                            this.innerHTML = '<i class="far fa-heart"></i>';
                        } else {
                            alert('Failed to toggle wishlist. Please try again.');
                        }
                    })
                    .catch(err => {
                        console.error("Fetch error:", err);
                        alert('Network error. Please try again.');
                    });
            });
        });
    });
    </script>




    <script src="script.js"></script>
</body>

</html>