<?php include('php/db.php'); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ - Bán Hàng</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Cửa Hàng Trực Tuyến</h1>
        <nav>
            <!-- Điều hướng đến các trang khác -->
            <a href="index.php">Trang Chủ</a> <!-- Liên kết đến chính trang hiện tại -->
            <a href="php/product.php">Sản Phẩm</a> <!-- Liên kết đến trang sản phẩm -->
            <a href="php/cart.php">Giỏ Hàng</a> <!-- Liên kết đến trang giỏ hàng -->
            <a href="php/login.php">Đăng Nhập</a> <!-- Liên kết đến trang đăng nhập -->
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <h2>Sản Phẩm Nổi Bật</h2>
        <div class="product-grid">
            <?php
            // Kết nối cơ sở dữ liệu
            $result = $conn->query("SELECT * FROM products");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product">
                            <img src="images/' . $row['image'] . '" alt="' . $row['name'] . '">
                            <h3>' . $row['name'] . '</h3>
                            <p>' . $row['price'] . ' VND</p>
                            <button onclick="addToCart(' . $row['id'] . ')">Thêm Vào Giỏ</button>
                          </div>';
                }
            } else {
                echo '<p>Không có sản phẩm nào để hiển thị.</p>';
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Cửa Hàng Trực Tuyến</p>
    </footer>
</body>
</html>
