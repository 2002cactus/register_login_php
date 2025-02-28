<?php
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu

    $query = "INSERT INTO users (username, password) VALUES ($1, $2)";
    $result = pg_query_params($conn, $query, [$username, $password]);

    if ($result) {
        echo "Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>";
    } else {
        echo "Lỗi: " . pg_last_error($conn);
    }

    pg_close($conn);
}
?>

<form method="POST">
    <label>Tên đăng nhập:</label>
    <input type="text" name="username" required>
    <label>Mật khẩu:</label>
    <input type="password" name="password" required>
    <button type="submit">Đăng ký</button>
</form>
