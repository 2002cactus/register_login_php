<?php
session_start();
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = $1";
    $result = pg_query_params($conn, $query, [$username]);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Sai tài khoản hoặc mật khẩu!";
    }
}

pg_close($conn);
?>

<form method="POST">
    <label>Tên đăng nhập:</label>
    <input type="text" name="username" required>
    <label>Mật khẩu:</label>
    <input type="password" name="password" required>
    <button type="submit">Đăng nhập</button>
</form>
