<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng về login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Lấy thông tin database
require 'database.php';

$id = $_SESSION['user_id'];
$sql = "SELECT username FROM users WHERE id = $id";  
$result = pg_query($conn, $sql);

$userData = pg_fetch_assoc($result);

// Nếu không tìm thấy user, đăng xuất
if (!$userData) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$username = $userData['username'];

// Đóng kết nối database
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Chào mừng, <?php echo $username; ?>!</h2> 
    <p>Bạn đã đăng nhập thành công.</p>
    <a href="logout.php">Đăng xuất</a>
</div>

</body>
</html>
