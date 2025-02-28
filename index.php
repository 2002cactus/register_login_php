<?php
session_start();
require_once 'config/database.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Lấy thông tin người dùng
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, username, email FROM users WHERE id = $1";
$result = pg_query_params($conn, $sql, array($user_id));
$user = pg_fetch_assoc($result);

pg_close($conn);
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
    <h2>Chào mừng, <?php echo htmlspecialchars($user['name']); ?>!</h2>
    <p>Tên đăng nhập: <?php echo htmlspecialchars($user['username']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <a href="logout.php">Đăng xuất</a>
</body>
</html>
