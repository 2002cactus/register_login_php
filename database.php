<?php
// Lấy thông tin từ biến môi trường
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

// Kết nối Database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

// Kiểm tra kết nối
if (!$conn) {
    die("Lỗi kết nối: " . pg_last_error());
}
?>
