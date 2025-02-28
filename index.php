<?php
session_start();

// Lấy thông tin từ biến môi trường
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');

// Kết nối database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Lỗi kết nối: " . pg_last_error());
}

// Xử lý đăng nhập
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    if (!empty($email) && !empty($pass)) {
        $query = "SELECT * FROM users WHERE email = $1";
        $result = pg_query_params($conn, $query, array($email));
        $userData = pg_fetch_assoc($result);

        if ($userData && password_verify($pass, $userData['password'])) {
            $_SESSION['user'] = $userData['name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Sai email hoặc mật khẩu!";
        }
    } else {
        $error = "Vui lòng nhập đầy đủ thông tin!";
    }
}

// Lấy danh sách người dùng
// $userListQuery = "SELECT id, name, email FROM users";
// $userListResult = pg_query($conn, $userListQuery);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Đăng nhập</h2>
    
    <?php if ($error): ?>
        <p style="color: red; text-align: center;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Đăng nhập</button>
    </form>

    <a href="register.php">Chưa có tài khoản? Đăng ký ngay</a>
</div>

<div class="container">
    <h2>Danh sách người dùng</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
        </tr>
        <?php
        if ($userListResult) {
            while ($row = pg_fetch_assoc($userListResult)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                      </tr>";
            }
            pg_free_result($userListResult);
        } else {
            echo "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php pg_close($conn); ?>
