<?php
session_start();

// 清除所有 Session 数据
$_SESSION = [];

// 销毁 Session Cookie（可选但推荐）
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// 销毁 Session 本体
session_destroy();

// 跳转回首页或登录页
header("Location: wy_login.php");
exit;
?>
