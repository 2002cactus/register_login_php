<?php
session_start();

// Lấy thông tin database
require 'database.php';

// Nhận dữ liệu từ form
$username = $_POST['username'];
$password = $_POST['password'];

// Kiểm tra người dùng trong database
$sql = "SELECT id, password FROM users WHERE username = '$username'";
$result = pg_query_params($conn, $sql);

if ($row = pg_fetch_assoc($result)) {
    $_SESSION['user_id'] = $row['id'];
    echo "✅ Đăng nhập thành công! <br>";
    echo '<a href="index.php" class="btn">Trang chủ</a>';
} else {
    echo "❌ Sai thông tin đăng nhập!";
}

// Đóng kết nối
pg_close($conn);
?>
