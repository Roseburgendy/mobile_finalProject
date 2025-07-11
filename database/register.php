<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Register Successfully！";
    } else {
        echo "Registeration Fail：" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<h2>User Registeration</h2>
<form method="post" action="register.php">
  User Name: <input type="text" name="username" required><br>
  Email: <input type="email" name="email" required><br>
  Password: <input type="password" name="password" required><br>
  <input type="submit" value="register">
</form>
