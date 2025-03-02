<?php
// Lấy thông tin database
require 'database.php';

$query_truncate = "TRUNCATE TABLE users RESTART IDENTITY CASCADE;";
$result_truncate = pg_query($conn, $query_truncate);

// Xóa bảng nếu đã tồn tại
$query_drop = "DROP TABLE IF EXISTS users CASCADE;";
$result_drop = pg_query($conn, $query_drop);

// Tạo lại bảng users với cấu trúc đúng
$query_create = "
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    username TEXT UNIQUE NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
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
