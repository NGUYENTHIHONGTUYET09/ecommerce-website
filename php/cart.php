<?php include('php/db.php'); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng - Bán Hàng</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Cửa Hàng Trực Tuyến</h1>
        <nav>
            <a href="php/index.php">Trang Chủ</a>
            <a href="php/product.php">Sản Phẩm</a>
            <a href="php/cart.php">Giỏ Hàng</a>
            <a href="php/login.php">Đăng Nhập</a>
        </nav>
    </header>

    <!-- Cart Content -->
    <main>
        <h2>Giỏ Hàng Của Bạn</h2>
        <div class="cart-items">
            <?php
            // Lấy thông tin sản phẩm từ giỏ hàng trong phiên người dùng
            session_start();
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
            foreach ($cart as $id => $quantity) {
                $result = $conn->query("SELECT * FROM products WHERE id = $id");
                $product = $result->fetch_assoc();
                echo '<div class="cart-item">
                        <img src="images/' . $product['image'] . '" alt="' . $product['name'] . '">
                        <h3>' . $product['name'] . '</h3>
                        <p>' . $product['price'] . ' VND x ' . $quantity . '</p>
                        <button onclick="removeFromCart(' . $id . ')">Xóa</button>
                      </div>';
            }
            ?>
        </div>
        <button onclick="checkout()">Thanh Toán</button>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Cửa Hàng Trực Tuyến</p>
    </footer>
</body>
</html>


<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'];
    $productId = $data['productId'];

    if ($action === 'add') {
        $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + 1;
        echo json_encode(['message' => 'Sản phẩm đã được thêm vào giỏ hàng.']);
    } elseif ($action === 'remove') {
        unset($_SESSION['cart'][$productId]);
        echo json_encode(['message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.']);
    }
}
?>
