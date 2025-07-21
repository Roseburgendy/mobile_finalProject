<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: wy_login.php");
    exit;
}

$action = $_GET['action'] ?? 'view';
$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'edit') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];

    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, phone=?, gender=?, birthday=?, address1=?, address2=?, city=?, state=?, postal_code=?, country=? WHERE id=?");
    $stmt->bind_param("sssssssssssi", $first_name, $last_name, $phone, $gender, $birthday, $address1, $address2, $city, $state, $postal_code, $country, $user_id);

    if ($stmt->execute()) {
        $successMsg = "Profile updated successfully!";
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
    } else {
        $errorMsg = "Update failed. Please try again.";
    }
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Membership Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
    body {
        font-family: Poppins;
        margin: 0;
        padding: 0;
        background: #f9f9f9;
    }

    .container {
        display: flex;
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .sidebar {
        width: 260px;
        background: #fff;
        padding: 30px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
    }

    .sidebar h2 {

        font-size: 22px;
        margin-bottom: 20px;
    }

    .sidebar ul {
        list-style: none;
        padding-left: 0;
    }

    .sidebar li {
        margin: 12px 0;
    }

    .sidebar a {
        text-decoration: none;
        color: #111;
    }

    .main-content {
        flex: 1;
        background: #fff;
        padding: 40px;
        margin-left: 20px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
    }

    .main-content h3 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        max-width: 600px;
        margin-bottom: 10px;
    }

    .info-label {
        font-weight: bold;
        width: 160px;
    }

    .membership-card {
        margin-top: 20px;
        width: 360px;
        height: 200px;
        background-image: url('img/banner/Line.jpg');
        background-size: cover;
        background-position: center;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
        color: #000;
        font-family: Poppins;
        text-align: center;
        background-color: #fff;
        border: 1px solid var(--text-900);
    }


    .card-content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .brand {
        color: #d33;
        font-weight: bold;
        font-size: 24px;
        margin-bottom: 10px;
        letter-spacing: 3px;
    }

    .barcode-area {
        margin: 10px 0;
    }

    .barcode-img {
        height: 60px;
    }

    .barcode-id {
        font-size: 12px;
        margin-top: 5px;
    }

    .member-name {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: #d33;
        color: white;
        padding: 6px 12px;
        font-weight: bold;
        text-align: right;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    /*FORM*/
    form label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #555;
    }

    form input,
    form select {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        transition: border 0.3s;
    }

    form input:focus,
    form select:focus {
        border-color: #111;
        outline: none;
    }

    .form-group {
        display: flex;
        gap: 20px;
    }

    .form-group>div {
        flex: 1;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 12px;
        font-size: 16px;
        background-color: #111;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-submit:hover {
        background-color: #333;
    }

    .success-msg {
        color: green;
        text-align: center;
        margin-bottom: 20px;
    }

    .error-msg {
        color: red;
        text-align: center;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <?php include 'wy_header.php'; ?>

    <div class="container">
        <div class="sidebar">
            <h2>Membership</h2>
            <ul>
                <a href="wy_profile.php?action=view">Profile</a>
                <li><a href="#">Coupons</a></li>
                <li><a href="#">Purchase history</a></li>
                <li><a href="#">Order history</a></li>
            </ul>
            <h2 style="margin-top:30px;">Profile settings</h2>
            <ul>
                <li><a href="wy_profile.php?action=edit">Edit profile</a></li>
                <li><a href="wy_profile.php?action=address">Address book</a></li>
                <li><a href="wy_profile.php?action=password">Change password</a></li>
                <li><a href="wy_profile.php?action=withdraw">Withdraw membership</a></li>
            </ul>
        </div>

        <div class="main-content">
            <?php if ($action === 'view'): ?>
            <!-- 查看个人资料模块 -->
            <h3>PROFILE</h3>
            <div class="info-row">
                <div class="info-label">NAME</div>
                <div><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">EMAIL</div>
                <div><?= htmlspecialchars($user['email']) ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">GENDER</div>
                <div><?= htmlspecialchars($user['gender']) ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">POSTAL CODE</div>
                <div><?= htmlspecialchars($user['postal_code']) ?></div>
            </div>
            <!-- Membership Card -->
            <div class="membership-card">
                <div class="card-content">
                    <h2 class="brand">POPPY</h2>
                    <div class="barcode-area">
                        <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= $user_id ?>&code=Code128&dpi=96"
                            alt="barcode" class="barcode-img">
                    </div>
                    <p class="barcode-id"><?= $user_id ?></p>
                </div>
                <div class="member-name"><?= htmlspecialchars($user['last_name'] . ' ' . $user['first_name']) ?></div>
            </div>

            <!-- 编辑资料模块 -->
            <?php elseif ($action === 'edit'): ?>
            <h3>EDIT PROFILE</h3>
            <form method="post">
                <label>First Name*</label>
                <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

                <label>Last Name*</label>
                <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

                <label>Phone*</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>

                <label>Gender*</label>
                <select name="gender" required>
                    <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Prefer not to state"
                        <?= $user['gender'] == 'Prefer not to state' ? 'selected' : '' ?>>Prefer not to state</option>
                </select>

                <label>Birthday*</label>
                <input type="date" name="birthday" value="<?= htmlspecialchars($user['birthday']) ?>" required>

                <label>Address 1*</label>
                <input type="text" name="address1" value="<?= htmlspecialchars($user['address1']) ?>" required>

                <label>Address 2</label>
                <input type="text" name="address2" value="<?= htmlspecialchars($user['address2']) ?>">

                <label>City*</label>
                <input type="text" name="city" value="<?= htmlspecialchars($user['city']) ?>" required>

                <label>State*</label>
                <input type="text" name="state" value="<?= htmlspecialchars($user['state']) ?>" required>

                <label>Postal Code*</label>
                <input type="text" name="postal_code" value="<?= htmlspecialchars($user['postal_code']) ?>" required>

                <label>Country*</label>
                <input type="text" name="country" value="<?= htmlspecialchars($user['country']) ?>" required>

                <button class="white" type="submit">Save Changes</button>
            </form>

            <!-- 地址簿模块 -->
            <?php elseif ($action === 'address'): ?>
            <h3>ADDRESS BOOK</h3>
            <p><?= htmlspecialchars($user['first_name']) ?> <?= htmlspecialchars($user['last_name']) ?></p>
            <p><?= htmlspecialchars($user['address1']) ?>, <?= htmlspecialchars($user['address2']) ?>,
                <?= htmlspecialchars($user['postal_code']) ?>, <?= htmlspecialchars($user['city']) ?>,
                <?= htmlspecialchars($user['state']) ?>,
                <?= htmlspecialchars($user['country']) ?></p>
            <p>Tel:+60-<?= htmlspecialchars($user['phone']) ?></p>

            <!-- 更改密码模块 -->
            <?php elseif ($action === 'password'): ?>
            <h3>CHANGE PASSWORD</h3>
            <form method="post" action="?action=password">
                <label>Current Password</label>
                <input type="password" name="current_password" required>
                <label>New Password</label>
                <input type="password" name="new_password" required>
                <button class="white" type="submit">Update Password</button>
            </form>

            <!-- 注销会员模块 -->
            <?php elseif ($action === 'withdraw'): ?>
            <h3>WITHDRAWAL FROM MEMBERSHIP</h3>
            <p>You will lose access to all services.</p>
            <form method="post" action="?action=withdraw"
                onsubmit="return confirm('Are you sure you want to delete your account?');">
                <label><input type="checkbox" name="agree" required> I agree to the Terms</label>
                <button class="white" type="submit" class="danger-btn">Withdraw</button>
            </form>

            <?php endif; ?>
        </div>
    </div>

    <?php include 'wy_footer.php'; ?>
</body>

</html>