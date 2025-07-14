<?php
$servername = "sql303.infinityfree.com"; // ← 改为真实的 Host
$username = "if0_39448410";            // ← 改为真实的用户名
$password = "RdQcNRcVz6";              // ← 改为真实的密码
$dbname = "shopping_db";       // ← 改为真实的数据库名

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
