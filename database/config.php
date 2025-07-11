<?php
// ==== 数据库配置 ====
define('DB_HOST', 'localhost');      // 默认使用 localhost（默认端口是 3306，我这里设置是3307因为3306被占用了）
define('DB_PORT', '3307');           // ！！如果你是默认配置 3306，写 3306
define('DB_USER', 'root');           // XAMPP 默认用户名是 root
define('DB_PASS', '');               // 默认密码为空
define('DB_NAME', 'shopping_db');  // 改成你创建的数据库名称

// ==== 构建连接 ====
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// ==== 错误处理 ====
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}
// echo "数据库连接成功";
?>
