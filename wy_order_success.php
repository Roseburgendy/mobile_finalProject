<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$order_id = $_GET['order_id'] ?? 0;
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

    <section id="thank-you-container" class="section-p1">
        <h1>ORDER PLACED SUCCESSFULLY!</h1>
        <p>Your order ID is <strong>#<?php echo htmlspecialchars($order_id); ?></strong>.</p>
        <p>Thank you for shopping with us!</p>

        <div class="thank-you-buttons">
            <a href="index.php"><button class="normal">HOME PAGE</button></a>
            <a href="wy_profile.php?action=orders"><button class="white">VIEW MY ORDERS</button></a>
        </div>
    </section>

    <?php include 'wy_footer.php'; ?>
</body>

</html>
