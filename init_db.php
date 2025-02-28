<?php
require_once '../config/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
";

$result = pg_query($conn, $sql);

if ($result) {
    echo "Bảng `users` đã được tạo thành công!";
} else {
    echo "Lỗi khi tạo bảng: " . pg_last_error();
}

pg_close($conn);
?>
