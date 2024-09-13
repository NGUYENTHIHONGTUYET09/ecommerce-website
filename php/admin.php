<?php
session_start();
include('php/db.php');

// Kiểm tra nếu người dùng không phải là admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý thêm, cập nhật, hoặc xóa sản phẩm
    // Ví dụ: Thêm sản phẩm mới
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];

        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);

        $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $price, $image);
        $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Admin - Bán Hàng</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Trang Quản Lý Admin</h1>
        <nav>
            <a href="index.php">Trang Chủ</a>
            <a href="product.php">Sản Phẩm</a>
            <a href="cart.php">Giỏ Hàng</a>
            <a href="logout.php">Đăng Xuất</a>
        </nav>
    </header>

    <main>
        <h2>Thêm Sản Phẩm Mới</h2>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" required>
            <label for="price">Giá:</label>
            <input type="text" id="price" name="price" required>
            <label for="image">Hình ảnh:</label>
            <input type="file" id="image" name="image" required>
            <button type="submit" name="add_product">Thêm Sản Phẩm</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Cửa Hàng Trực Tuyến</p>
    </footer>
</body>
</html>
