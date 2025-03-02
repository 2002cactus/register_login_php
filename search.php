<?php
if (isset($_GET['q'])) {
    $search = $_GET['q']; 
    echo "<h2>Kết quả tìm kiếm cho: $search</h2>"; 
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <h1>Trang Tìm Kiếm</h1>
    <form method="GET">
        <input type="text" name="q" placeholder="Nhập từ khóa">
        <button type="submit">Tìm kiếm</button>
    </form>
</body>
</html>
