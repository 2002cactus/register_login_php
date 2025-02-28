<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<h1>Chào mừng <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
<a href="logout.php">Đăng xuất</a>
