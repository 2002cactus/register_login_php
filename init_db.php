<?php
// Lấy thông tin database từ biến môi trường
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

// Kết nối đến PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

if (!$conn) {
    die("❌ Lỗi kết nối database: " . pg_last_error());
}

// Xóa bảng nếu đã tồn tại
$query_drop = "DROP TABLE IF EXISTS users CASCADE;";
pg_query($conn, $query_drop);

// Tạo lại bảng users với cấu trúc đúng
$query_create = "
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";
$result = pg_query($conn, $query_create);

if ($result) {
    echo "✅ Bảng users đã được tạo lại thành công!";
} else {
    echo "❌ Lỗi khi tạo bảng: " . pg_last_error($conn);
}

// Đóng kết nối
pg_close($conn);
?>
