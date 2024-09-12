<?php
include('php/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        $_SESSION['user_id'] = $userId;
        header('Location: index.php');
    } else {
        $error = "Email hoặc mật khẩu không đúng.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập - Bán Hàng</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Cửa Hàng Trực Tuyến</h1>
        <nav>
            <a href="index.php">Trang Chủ</a>
            <a href="product.php">Sản Phẩm</a>
            <a href="cart.php">Giỏ Hàng</a>
            <a href="login.php">Đăng Nhập</a>
        </nav>
    </header>

    <main>
        <h2>Đăng Nhập</h2>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Đăng Nhập</button>
            <?php if (isset($error)) echo '<p>' . $error . '</p>'; ?>
        </form>
        <p>Chưa có tài khoản? <a href="signup.php">Đăng ký ngay</a></p>
    </main>

    <footer>
        <p>&copy; 2024 Cửa Hàng Trực Tuyến</p>
    </footer>
</body>
</html>
