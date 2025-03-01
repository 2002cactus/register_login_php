<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng về login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Lấy thông tin database
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

// Kết nối database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

if (!$conn) {
    die("❌ Lỗi kết nối database: " . pg_last_error());
}

// Lấy thông tin người dùng từ database
$sql = "SELECT username FROM users WHERE id = $id";
$result = pg_query_params($conn, $sql, [$_SESSION['user_id']]);
$userData = pg_fetch_assoc($result);

// Nếu không tìm thấy user, đăng xuất
if (!$userData) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($userData['username']); // Bảo vệ XSS

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
