<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Ecommerce Website</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js" defer></script>
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <ul>
                <li><a href="php/index.php">Trang Chủ</a></li>
                <li><a href="php/products.php">Sản Phẩm</a></li>
                <li><a href="php/cart.php">Giỏ Hàng</a></li>
                <li><a href="contact.php">Liên Hệ</a></li>
            </ul>
        </nav>
        <h1>Chào Mừng Đến Với Cửa Hàng Của Chúng Tôi</h1>
    </header>

    <!-- Main Content -->
    <main>
        <section id="featured-products">
            <h2>Sản Phẩm Nổi Bật</h2>
            <div class="product-list">
                <!-- Example Product Item -->
                <div class="product-item">
                    <img src="images/productA.png" alt="Sản phẩm 1">
                    <h3>Sản Phẩm 1</h3>
                    <p>Giá: $19.99</p>
                    <button class="add-to-cart-button" data-product-id="1">Thêm vào Giỏ</button>
                </div>
                <!-- Thêm các sản phẩm khác tương tự -->
            </div>
        </section>

        <section id="about-us">
            <h2>Về Chúng Tôi</h2>
            <p>Chúng tôi cung cấp những sản phẩm tốt nhất với giá cả hợp lý.</p>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Ecommerce Website. Tất cả các quyền được bảo lưu.</p>
    </footer>
</body>
</html>
