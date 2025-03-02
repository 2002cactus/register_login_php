<?php
// Kết nối đến database
require 'database.php';

// Truy vấn lấy tất cả user
$query = "SELECT id, name, username, email, password FROM users";
$result = pg_query($conn, $query);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die("❌ Lỗi truy vấn: " . pg_last_error($conn));
}

// Tạo file để lưu danh sách user
$file = 'users.txt';
$data = "Danh sách User đã đăng ký:\n";

// Ghi dữ liệu vào file
while ($row = pg_fetch_assoc($result)) {
    $data .= "ID: {$row['id']}, Name: {$row['name']}, Username: {$row['username']}, Email: {$row['email']}, Password: {$row['password']}\n";
}

file_put_contents($file, $data);

// Đóng kết nối
pg_close($conn);
?>
