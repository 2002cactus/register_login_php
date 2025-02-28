<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Chào mừng, <?php echo $_SESSION['user']; ?>!</h2>
    <p>Bạn đã đăng nhập thành công.</p>
    <a href="logout.php">Đăng xuất</a>
</div>

</body>
</html>
