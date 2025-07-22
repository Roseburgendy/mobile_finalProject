<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summer Collection 2025</title>
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

$where = "collection = 'Spring Collection 2025'";
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
    <?php
    $activePage = 'spring_collection';
require_once 'wy_wishlist_helper.php';
include 'wy_header.php';
$wishlist_ids = getUserWishlistIds($conn);
?>


    <section id="page-header" class="spring-banner">
        <h2>Spring Collection 2025</h2>
        <p>Breathe new life into your wardrobe with fresh florals, soft hues, and effortless charm.</p>
    </section>

    <section class="section-p1">
        <div class="filter-bar-wrapper">
            <div class="filter-bar">
                <ul class="filter-list desktop-only">
                    <li><a href="spring_collection.php" class="<?= $category_id === 0 ? 'active' : '' ?>">All</a></li>
                    <?php mysqli_data_seek(result: $categories_result, offset: 0); while($cat = $categories_result->fetch_assoc()): ?>
                    <li><a href="spring_collection.php?category=<?= $cat['id'] ?>&query=<?= urlencode($query) ?>"
                            class="<?= $category_id == $cat['id'] ? 'active' : '' ?>">
                            <?= htmlspecialchars($cat['name']) ?></a></li>
                    <?php endwhile; ?>
                </ul>
                <select class="mobile-only category-dropdown" onchange="location = this.value;">
                    <option value="spring_collection.php" <?= $category_id === 0 ? 'selected' : '' ?>>All</option>
                    <?php mysqli_data_seek($categories_result, 0); while($cat = $categories_result->fetch_assoc()): ?>
                    <option value="spring_collection.php?category=<?= $cat['id'] ?>&query=<?= urlencode($query) ?>"
                        <?= $category_id == $cat['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <form method="GET" action="spring_collection.php" class="search-form">
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
                <!-- 红心按钮（默认空心） -->
                <button type="button" class="wishlist-toggle" data-product-id="<?= $row['id'] ?>">
                    <i class="<?= in_array($row['id'], $wishlist_ids) ? 'fas' : 'far' ?> fa-heart"></i>
                </button>

            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <p>No products found.</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="pagination" class="section-p1">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="spring_collection.php?category=<?= $category_id ?>&query=<?= urlencode($query) ?>&page=<?= $i ?>"
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

    <?php include 'wy_footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>