<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Success</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .thank-you-container {
    max-width: 800px;
    margin: 100px auto;
    padding: 40px 30px;
    background-color: #fff;
    text-align: center;
    border: 2px solid #d33;
    border-radius: 16px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.thank-you-container h1 {
    font-size: 28px;
    color: #d33;
    margin-bottom: 20px;
    letter-spacing: 1px;
}

.thank-you-container p {
    font-size: 16px;
    color: #333;
    margin-bottom: 40px;
}

.thank-you-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.btn {
    padding: 12px 24px;
    text-decoration: none;
    font-weight: bold;
    border-radius: 6px;
    transition: background-color 0.3s ease;
    font-size: 14px;
    text-align: center;
}

.black-btn {
    background-color: #111;
    color: white;
    border: none;
}

.black-btn:hover {
    background-color: #333;
}

.white-btn {
    background-color: #fff;
    color: #111;
    border: 2px solid #111;
}

.white-btn:hover {
    background-color: #f1f1f1;
}

    </style>
</head>
<body class="sub-page">
<?php include 'wy_header.php'; ?>

<section class="thank-you-container">
    <h1>THANK YOU FOR YOUR REGISTRATION</h1>
    <p>We will send you email to your registered address for your confirmation.</p>

    <div class="thank-you-buttons">
        <a href="index.php" class="btn black-btn">HOME PAGE</a>
        <a href="wy_profile.php?action=edit" class="btn white-btn">REGISTER MEMBER ADDRESS</a>
    </div>
</section>

<?php include 'wy_footer.php'; ?>
</body>
</html>
