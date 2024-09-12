<?php include('php/db.php'); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sản Phẩm - Bán Hàng</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Cửa Hàng Trực Tuyến</h1>
        <nav>
            <a href="index.php">Trang Chủ</a>
            <a href="product.php">Sản Phẩm</a>
            <a href="cart.php">Giỏ Hàng</a>
            <a href="login.php">Đăng Nhập</a>
        </nav>
    </header>

    <!-- Product Content -->
    <main>
        <h2>Tất Cả Sản Phẩm</h2>
        <div class="product-grid">
            <?php
            $result = $conn->query("SELECT * FROM products");
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">
                        <img src="images/' . $row['image'] . '" alt="' . $row['name'] . '">
                        <h3>' . $row['name'] . '</h3>
                        <p>' . $row['price'] . ' VND</p>
                        <button onclick="addToCart(' . $row['id'] . ')">Thêm Vào Giỏ</button>
                      </div>';
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
