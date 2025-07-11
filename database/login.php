<?php
session_start();
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 查询用户名
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    
    $stmt->execute();
    $result = $stmt->get_result();

    // 判断是否找到用户
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // 验证密码
        if (password_verify($password, $row['password'])) {
            // 登录成功
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            $error = "密码错误";
        }
    } else {
        $error = "用户名不存在";
    }

    $stmt->close();
}
?>

<h2>用户登录</h2>
<form method="post" action="login.php">
  User Name: <input type="text" name="username" required><br>
  Password: <input type="password" name="password" required><br>
  <input type="submit" value="登录">
</form>

<?php
if ($error) {
    echo "<p style='color:red;'>$error</p>";
}
?>
