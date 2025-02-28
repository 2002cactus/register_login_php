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

// Nhận dữ liệu từ form
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Băm mật khẩu

// Thêm người dùng vào database
$sql = "INSERT INTO users (name, username, email, password) VALUES ($1, $2, $3, $4)";
$result = pg_query_params($conn, $sql, [$name, $username, $email, $password]);

if ($result) {
    echo "✅ Đăng ký thành công!";
} else {
    echo "❌ Lỗi: " . pg_last_error();
}

// Đóng kết nối
pg_close($conn);
?>
