<?php
include('php/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);
    
    if ($stmt->execute()) {
        header('Location: login.php');
    } else {
        $error = "Đã xảy ra lỗi. Vui lòng thử lại.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký - Bán Hàng</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Cửa Hàng Trực Tuyến</h1>
        <nav>
            <a href="index.php">Trang Chủ</a>
            <a href="php/product.php">Sản Phẩm</a>
            <a href="php/cart.php">Giỏ Hàng</a>
            <a href="php/login.php">Đăng Nhập</a>
        </nav>
    </header>

    <main>
        <h2>Đăng Ký Tài Khoản</h2>
        <form action="signup.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Đăng Ký</button>
            <?php if (isset($error)) echo '<p>' . $error . '</p>'; ?>
        </form>
        <p>Đã có tài khoản? <a href="php/login.php">Đăng nhập ngay</a></p>
    </main>

    <footer>
        <p>&copy; 2024 Cửa Hàng Trực Tuyến</p>
    </footer>
</body>
</html>
