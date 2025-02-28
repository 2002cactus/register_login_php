<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Đăng ký tài khoản</h2>
    
    <form action="register_process.php" method="POST">
        <div class="form-group">
            <label>Họ và Tên</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Đăng ký</button>
    </form>

    <a href="index.php">Đã có tài khoản? Đăng nhập ngay</a>
</div>

</body>
</html>
