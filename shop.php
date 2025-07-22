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

<body class="sub-page">

    <?php
    session_start();
include 'config.php';

$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$limit = 8;
$offset = ($page - 1) * $limit;

$where = "1";
if ($category_id > 0) {
    $where .= " AND category_id = $category_id";
}
if (!empty($query)) {
    $escaped = $conn->real_escape_string($query);
    $where .= " AND (name LIKE '%$escaped%' OR description LIKE '%$escaped%')";
}
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

$count_sql = "SELECT COUNT(*) AS total FROM products WHERE $where";
$count_result = $conn->query($count_sql);
$total_products = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_products / $limit);

$product_sql = "SELECT * FROM products WHERE $where LIMIT $limit OFFSET $offset";
$product_result = $conn->query($product_sql);

$categories_result = $conn->query("SELECT * FROM category");
?>

    <!-- Header/Navbar Section -->
    <?php
$activePage = 'shop';
include 'wy_header.php';
?>


    <section id="page-header" class="shop-banner">
        <h2>Shop</h2>
        <p>Discover Your Style, One Click at a Time.
Dive into our curated collections and uncover the season’s must-have pieces. 
From timeless essentials to bold statement looks — your perfect wardrobe update starts here.</p>
    </section>

    <section class="section-p1">
        <div class="filter-bar-wrapper">
            <!--filter bar-->
            <div class="filter-bar">
                <ul class="filter-list desktop-only">
                    <li><a href="shop.php" class="<?= $category_id === 0 ? 'active' : '' ?>">All</a></li>
                    <?php mysqli_data_seek($categories_result, 0); while($cat = $categories_result->fetch_assoc()): ?>
                    <li><a href="shop.php?category=<?= $cat['id'] ?>&query=<?= urlencode($query) ?>"
                            class="<?= $category_id == $cat['id'] ? 'active' : '' ?>">
                            <?= htmlspecialchars($cat['name']) ?></a></li>
                    <?php endwhile; ?>
                </ul>

                <select class="mobile-only category-dropdown" onchange="location = this.value;">
                    <option value="shop.php" <?= $category_id === 0 ? 'selected' : '' ?>>All</option>
                    <?php mysqli_data_seek($categories_result, 0); while($cat = $categories_result->fetch_assoc()): ?>
                    <option value="shop.php?category=<?= $cat['id'] ?>&query=<?= urlencode($query) ?>"
                        <?= $category_id == $cat['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <!--Search bar-->
            <form method="GET" action="shop.php" class="search-form">
                <input type="hidden" name="category" value="<?= $category_id ?>">
                <input type="text" name="query" value="<?= htmlspecialchars($query) ?>"
                    placeholder="Search products...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">
            <?php if ($product_result->num_rows > 0): while ($row = $product_result->fetch_assoc()): ?>
            <div class="pro">
                <a href="sproduct.php?id=<?= $row['id'] ?>">
                    <img src="<?= htmlspecialchars($row['main_image_url']) ?>"
                        alt="<?= htmlspecialchars($row['name']) ?>">
                </a>
                <div class="des">
                    <h5><?= htmlspecialchars($row['name']) ?></h5>
                    <h4>$<?= number_format($row['price'], 2) ?></h4>
                </div>
                <button type="button" class="wishlist-toggle" data-product-id="<?= $row['id'] ?>">
                    <i class="<?= in_array($row['id'], $wishlist_ids) ? 'fas' : 'far' ?> fa-heart"></i>
                </button>

            </div>
            <?php endwhile; else: ?>
            <p>No products found.</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="pagination" class="section-p1">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="shop.php?category=<?= $category_id ?>&query=<?= urlencode($query) ?>&page=<?= $i ?>"
            class="<?= $i === $page ? 'active' : '' ?>"> <?= $i ?> </a>
        <?php endfor; ?>
        <?php if ($page < $total_pages): ?>
        <a href="shop.php?category=<?= $category_id ?>&query=<?= urlencode($query) ?>&page=<?= $page + 1 ?>">
            <i class="fas fa-chevron-right"></i>
        </a>
        <?php endif; ?>
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
        document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.wishlist-toggle').forEach(button => {
        button.addEventListener('click', function () {
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
                status = status.trim();
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