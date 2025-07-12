<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>！</h2>
<p><a href="logout.php">Logout</a></p>

<!-- 搜索框 -->
<form action="search.php" method="get">
    <input type="text" name="query" placeholder="Search for products..." required>
    <button type="submit">Search</button>
</form>
