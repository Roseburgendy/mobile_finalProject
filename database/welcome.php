<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>！</h2>
<p><a href="logout.php">Logout</a></p>
