<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Chào mừng đến với hệ thống</h2>
        <p>Vui lòng đăng nhập hoặc đăng ký để tiếp tục.</p>
        <a href="login.php" class="btn">Đăng nhập</a>
        <a href="register.php" class="btn">Đăng ký</a>
    </div>
</body>
</html>
