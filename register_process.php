<?php
session_start();

// Lấy thông tin database
require 'database.php';

// Kiểm tra dữ liệu đầu vào
if (!isset($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'])) {
    die("❌ Thiếu thông tin đăng ký!");
}

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Chèn dữ liệu vào bảng users
$sql = "INSERT INTO users (name, username, email, password) 
        VALUES ('$name', '$username', '$email', '$password')";

$result = pg_query($conn, $sql);

if (!$result) {
    die("❌ Lỗi khi đăng ký: " . pg_last_error($conn));
} else {
    echo "✅ Đăng ký thành công! <br>";
    echo '<a href="login.php" class="btn">Đăng nhập</a>';
}


// Đóng kết nối
pg_close($conn);
?>
