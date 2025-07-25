<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="style.css">
</head>

<body class="sub-page">

    <!-- Header/Navbar Section -->
    <?php include 'wy_header.php'; ?>

    <section id="login-form">
            <?php
include_once 'session_init.php'; // 避免重复调用 session_start()
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SEARCH FOR email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    
    $stmt->execute();
    $result = $stmt->get_result();

    // Whether find the account
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // verify the password
        if (password_verify($password, $row['password'])) {
            // successful login
           $_SESSION['user_id'] = $row['id'];
$_SESSION['email'] = $row['email'];
$_SESSION['first_name'] = $row['first_name'];
$_SESSION['last_name'] = $row['last_name'];

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ? AND size = ?");
        $stmt->bind_param("iis", $user_id, $item['product_id'], $item['size']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // 已存在，更新数量
            $new_qty = $row['quantity'] + $item['quantity'];
            $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ? AND size = ?");
            $update->bind_param("iiis", $new_qty, $user_id, $item['product_id'], $item['size']);
            $update->execute();
        } else {
            // 不存在，插入
            $insert = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, size) VALUES (?, ?, ?, ?)");
            $insert->bind_param("iiis", $user_id, $item['product_id'], $item['quantity'], $item['size']);
            $insert->execute();
        }
    }
    unset($_SESSION['cart']); // 清空 session 中的临时购物车
}



           echo "<script>alert('LOGIN Successfully!'); window.location.href='index.php';</script>";
            exit();
        } 
        else {
             $errorMsg = "Wrong Password" . $conn->error;
        }
    } else {
        $errorMsg = "The account does not exist" . $conn->error;
    }

    $stmt->close();
}
?>

        <!-- LOGIN FORM -->
        <form method="post">
            <h2>LOGIN</h2>
            <label>email</label>
            <input type="text" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button class="white">LOG IN</button>
        </form>

        <!-- REGISTER ENTRANCE -->
        <form action="wy_register.php" method="get">
            <h2>REGISTER</h2>
            <p style="margin-bottom: 30px;">If you don't have an account, you can register now to access exclusive
                content and faster checkout.</p>
            <button class="white">Register Account</button>
        </form>
    </section>
    <?php include 'wy_footer.php'; ?>


    <?php if (!empty($errorMsg)) : ?>
    <script>
    window.onload = function() {
        alert("<?php echo addslashes($errorMsg); ?>");
    };
    </script>
    <?php endif; ?>

    <script src="script.js"></script>

</body>

</html>