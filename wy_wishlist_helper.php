<?php
// 确保 session 启动
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * 获取当前用户愿望单中所有 product_id 的数组
 *
 * @param mysqli $conn 数据库连接对象
 * @return array 当前用户愿望单中的所有 product_id
 */
function getUserWishlistIds($conn) {
    $wishlist_ids = [];

    if (isset($_SESSION['user_id'])) {
        $uid = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT product_id FROM wishlist WHERE user_id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $uid);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $wishlist_ids[] = $row['product_id'];
            }
            $stmt->close();
        }
    }

    return $wishlist_ids;
}
