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

// Change Password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'password') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // 获取当前用户的密码哈希
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    if ($userData && password_verify($current_password, $userData['password'])) {
        // 新密码加密
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

        // 更新密码
        $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $update_stmt->bind_param("si", $new_password_hashed, $user_id);

        if ($update_stmt->execute()) {
            $successMsg = "Password updated successfully.";
        } else {
            $errorMsg = "Failed to update password. Please try again.";
        }
    } else {
        $errorMsg = "Current password is incorrect.";
    }
}

// Delete Account
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'withdraw') {
    if (!empty($_POST['agree'])) {
        // 从数据库删除该用户
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            // 注销 session 并跳转
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit;
        } else {
            $errorMsg = "Failed to delete your account. Please try again.";
        }
    } else {
        $errorMsg = "You must agree before withdrawing.";
    }
}


// Check order history
if ($action === 'orders') {
    $stmt = $conn->prepare("SELECT o.id, o.order_date, o.total_amount, 
                                   GROUP_CONCAT(CONCAT(p.name, IFNULL(CONCAT(' (', oi.quantity, ')'), '')) SEPARATOR ', ') AS items
                            FROM orders o
                            JOIN order_items oi ON o.id = oi.order_id
                            JOIN products p ON oi.product_id = p.id
                            WHERE o.user_id = ?
                            GROUP BY o.id
                            ORDER BY o.order_date DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $order_results = $stmt->get_result();
}

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
    <?php 
     $activePage = 'wy_profile';
    include 'wy_header.php'; 
       ?>
    <section id="page-header" class="profile-banner">

        <h2>Membership</h2>

        <p>Enjoy coupons and exclusive member benefits!</p>

    </section>
    <div id="profile-container" class="section-p1">
        <div class="sidebar">
            <div class="sidebar-sub">
                <h2>Membership</h2>
                <ul>
                    <li><a href="wy_profile.php?action=view" class="<?= $action === 'view' ? 'active' : '' ?>">
                            Profile</a></li>
                    <li><a href="#">Coupons</a></li>
                    <li><a href="wy_profile.php?action=orders" class="<?= $action === 'orders' ? 'active' : '' ?>">Order
                            history</a></li>

                </ul>
            </div>
            <div class="modal-divider"></div>

            <div class="sidebar-sub">
                <h2>Profile settings</h2>
                <ul>
                    <li><a href="wy_profile.php?action=edit" class="<?= $action === 'edit' ? 'active' : '' ?>">Edit
                            profile</a></li>
                    <li><a href="wy_profile.php?action=address"
                            class="<?= $action === 'address' ? 'active' : '' ?>">Address book</a></li>
                    <li><a href="wy_profile.php?action=password"
                            class="<?= $action === 'password' ? 'active' : '' ?>">Change password</a></li>
                    <li><a href="wy_profile.php?action=withdraw"
                            class="<?= $action === 'withdraw' ? 'active' : '' ?>">Withdraw membership</a></li>
                </ul>
            </div>
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
                </div>
                <div class="member-name"><?= htmlspecialchars($user['last_name'] . ' ' . $user['first_name']) ?>
                </div>
            </div>


            <?php elseif ($action === 'edit'): ?>
            <!-- 编辑资料模块 -->
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
                        <?= $user['gender'] == 'Prefer not to state' ? 'selected' : '' ?>>Prefer not to state
                    </option>
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

            <div class="address-card">
                <div class="address-header">
                    <strong><?= htmlspecialchars($user['first_name']) ?>
                        <?= htmlspecialchars($user['last_name']) ?></strong>
                </div>
                <div class="address-body">
                    <p>
                        <?= htmlspecialchars($user['address1']) ?><br>
                        <?= htmlspecialchars($user['address2']) ? htmlspecialchars($user['address2']) . '<br>' : '' ?>
                        <?= htmlspecialchars($user['postal_code']) ?> <?= htmlspecialchars($user['city']) ?><br>
                        <?= htmlspecialchars($user['state']) ?>, <?= htmlspecialchars($user['country']) ?>
                    </p>
                    <p><strong>Phone:</strong> +6<?= htmlspecialchars($user['phone']) ?></p>
                </div>
            </div>
            <a href="wy_profile.php?action=edit">
                <button class="white" type="submit">Edit Address</button>
            </a>


            <!-- 更改密码模块 -->
            <?php elseif ($action === 'password'): ?>
            <h3>CHANGE PASSWORD</h3>
            <?php if (!empty($successMsg)): ?>
            <p class="success-msg"><?= $successMsg ?></p>
            <?php endif; ?>
            <?php if (!empty($errorMsg)): ?>
            <p class="error-msg"><?= $errorMsg ?></p>
            <?php endif; ?>

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

            <div class="withdrawal-card">
                <p class="warning-text">
                    You are about to delete your membership and lose access to all services.
                </p>
                <?php if (!empty($successMsg)): ?>
                <p class="success-msg"><?= $successMsg ?></p>
                <?php endif; ?>
                <?php if (!empty($errorMsg)): ?>
                <p class="error-msg"><?= $errorMsg ?></p>
                <?php endif; ?>

                <form method="post" action="?action=withdraw"
                    onsubmit="return confirm('Are you sure you want to delete your account?');">
                    <label class="checkbox-label">
                        <input type="checkbox" name="agree" required> I confirm I want to withdraw and agree to the
                        terms.
                    </label>
                    <button type="submit" class="normal">Withdraw Membership</button>
                </form>
            </div>

            <!-- 历史订单 -->
            <!-- 历史订单 -->
            <?php elseif ($action === 'orders'): ?>
            <h3>ORDER HISTORY</h3>
            <?php if ($order_results->num_rows === 0): ?>
            <p>You have not placed any orders yet.</p>
            <?php else: ?>
            <div class="order-history-cards">
                <?php while ($order = $order_results->fetch_assoc()): ?>
                <div class="order-card">
                    <div class="order-header">
                        <span class="order-id">Order #<?= htmlspecialchars($order['id']) ?></span>
                        <span
                            class="order-date"><?= htmlspecialchars(date('Y-m-d', strtotime($order['order_date']))) ?></span>
                        <span class="order-total">Total: RM <?= number_format($order['total_amount'], 2) ?></span>
                    </div>
                    <div class="order-items">
                        <ul>
                            <?php
                            $items = explode(',', $order['items']);
                            foreach ($items as $item):
                            ?>
                            <li><?= htmlspecialchars(trim($item)) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>

            <?php endif; ?>

        </div>
    </div>

    <?php include 'wy_footer.php'; ?>

</body>

</html>