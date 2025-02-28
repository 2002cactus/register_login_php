<?php
session_start();

// Lấy thông tin database từ biến môi trường
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

// Kết nối đến PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

if (!$conn) {
    die("❌ Lỗi kết nối database: " . pg_last_error($conn));
}

// Kiểm tra dữ liệu đầu vào
if (!isset($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'])) {
    die("❌ Thiếu thông tin đăng ký!");
}

$name = $_POST['name'];
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Băm mật khẩu

// Kiểm tra xem username hoặc email đã tồn tại chưa
$check_query = "SELECT id FROM users WHERE username = CAST($1 AS TEXT) OR email = CAST($2 AS TEXT)";
$check_result = pg_query_params($conn, $check_query, [$username, $email]);

if (!$check_result) {
    die("❌ Lỗi truy vấn kiểm tra tài khoản: " . pg_last_error($conn));
}

if (pg_num_rows($check_result) > 0) {
    die("❌ Tên người dùng hoặc email đã tồn tại!");
}

// Chèn dữ liệu vào bảng users
$sql = "INSERT INTO users (name, username, email, password) 
        VALUES (CAST($1 AS TEXT), CAST($2 AS TEXT), CAST($3 AS TEXT), CAST($4 AS TEXT))";

$result = pg_query_params($conn, $sql, [$name, $username, $email, $password]);

if (!$result) {
    die("❌ Lỗi khi đăng ký: " . pg_last_error($conn));
} else {
    echo "✅ Đăng ký thành công!";
    header("Location: login.php");
    exit();
}


// Đóng kết nối
pg_close($conn);
?>
