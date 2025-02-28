<?php
session_start();
require 'db_connect.php'; // Đảm bảo có file này để kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($name) && !empty($email) && !empty($password)) {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Kết nối database
        $conn = pg_connect("host=".getenv('DB_HOST')." dbname=".getenv('DB_NAME')." user=".getenv('DB_USER')." password=".getenv('DB_PASSWORD'));

        if (!$conn) {
            die("Lỗi kết nối DB: " . pg_last_error());
        }

        // Thực hiện INSERT
        $query = "INSERT INTO users (name, email, password) VALUES ($1, $2, $3)";
        $result = pg_query_params($conn, $query, [$name, $email, $hashed_password]);

        if ($result) {
            $_SESSION['user'] = $name;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Lỗi khi đăng ký: " . pg_last_error();
        }

        pg_close($conn);
    } else {
        echo "Vui lòng điền đầy đủ thông tin!";
    }
} else {
    echo "Yêu cầu không hợp lệ!";
}
?>
