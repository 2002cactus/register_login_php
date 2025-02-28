<?php
// Lấy thông tin database từ biến môi trường
$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'admindb';
$user = getenv('DB_USER') ?: 'postgres';
$pass = getenv('DB_PASSWORD') ?: 'password';

// Kết nối đến PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

if (!$conn) {
    die("❌ Lỗi kết nối database: " . pg_last_error());
}

// Tạo bảng `users`
$sql = "
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
";

$result = pg_query($conn, $sql);

if ($result) {
    echo "✅ Bảng `users` đã được tạo thành công!\n";
} else {
    echo "❌ Lỗi khi tạo bảng: " . pg_last_error();
}

// Đóng kết nối
pg_close($conn);
?>
