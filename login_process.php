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
    die("❌ Lỗi kết nối database: " . pg_last_error());
}

// Nhận dữ liệu từ form
$username = $_POST['username'];
$password = $_POST['password'];

// Kiểm tra người dùng trong database
$sql = "SELECT id, password FROM users WHERE username = $username";
$result = pg_query_params($conn, $sql);

if ($row = pg_fetch_assoc($result)) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        echo "✅ Đăng nhập thành công! <br>";
        echo '<a href="index.php" class="btn">Trang chủ</a>';
    } else {
        echo "❌ Sai mật khẩu!";
    }
} else {
    echo "❌ Người dùng không tồn tại!";
}

// Đóng kết nối
pg_close($conn);
?>
