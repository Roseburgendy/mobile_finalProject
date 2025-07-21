<?php
ob_start(); // 避免 header already sent 错误
session_start();
include 'config.php';

$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users (email, password, birthday, gender) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $password, $birthday, $gender);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $conn->insert_id;
        header("Location: wy_register_success.php");
        exit();
    } else {
        $errorMsg = "Registration Failed: " . $conn->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="style.css">
    <style>
    .register-container {
        max-width: 800px;
        margin: 60px auto;
        border: 1px solid #ccc;
        padding: 40px;
        background: #fff;
    }

    .register-container h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .register-form label {
        display: block;
        font-weight: bold;
        margin-top: 20px;
    }

    .register-form input[type="text"],
    .register-form input[type="email"],
    .register-form input[type="password"],
    .register-form input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .gender-options {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }

    .register-form button {
        margin-top: 30px;
        padding: 12px 24px;
        background-color: #000;
        color: #fff;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }

    .register-form button:hover {
        background-color: #444;
    }

    .notice {
        font-size: 14px;
        color: #777;
        margin-top: 10px;
    }
    </style>
</head>

<body class="sub-page">
    <?php include 'wy_header.php'; ?>

    <div class="register-container">
        <h2>CREATE AN ACCOUNT</h2>
        <p class="notice">You will receive a confirmation mail to your email address associated with account.</p>

        <form method="post" class="register-form">
            <label>EMAIL ADDRESS *</label>
            <input type="email" name="email" required>

            <label>PASSWORD *</label>
            <input type="password" name="password" required>

            <label>BIRTHDAY</label>
            <input type="date" name="birthday">

            <label>GENDER</label>
            <div class="gender-options">
                <label><input type="radio" name="gender" value="Male"> Male</label>
                <label><input type="radio" name="gender" value="Female"> Female</label>
                <label><input type="radio" name="gender" value="Prefer not to state" checked> Prefer Not To State</label>
            </div>

            <button type="submit">REGISTER</button>
        </form>

        <?php if (!empty($errorMsg)) : ?>
        <script>
            alert("<?php echo addslashes($errorMsg); ?>");
        </script>
        <?php endif; ?>
    </div>

    <?php include 'wy_footer.php'; ?>
</body>
</html>
<?php ob_end_flush(); ?>
