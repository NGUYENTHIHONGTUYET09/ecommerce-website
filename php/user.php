<?php
session_start(); // Bắt đầu phiên làm việc

include('db.php'); // Kết nối cơ sở dữ liệu

// Hàm xử lý đăng ký người dùng
function registerUser($conn, $username, $password, $email) {
    // Kiểm tra người dùng đã tồn tại
    $checkUserQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkUserQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Tên người dùng đã tồn tại. Vui lòng chọn tên khác.";
        return false;
    }

    // Mã hóa mật khẩu và thêm người dùng mới vào cơ sở dữ liệu
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $registerQuery = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($registerQuery);
    $stmt->bind_param("sss", $username, $hashedPassword, $email);
    
    if ($stmt->execute()) {
        echo "Đăng ký thành công! Bạn có thể đăng nhập.";
        return true;
    } else {
        echo "Đã xảy ra lỗi khi đăng ký người dùng.";
        return false;
    }
}

// Hàm xử lý đăng nhập người dùng
function loginUser($conn, $username, $password) {
    $loginQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($loginQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username']; // Lưu tên người dùng trong phiên làm việc
            echo "Đăng nhập thành công!";
            return true;
        } else {
            echo "Sai mật khẩu. Vui lòng thử lại.";
            return false;
        }
    } else {
        echo "Tên người dùng không tồn tại.";
        return false;
    }
}

// Hàm xử lý đăng xuất người dùng
function logoutUser() {
    session_destroy(); // Hủy phiên làm việc
    echo "Bạn đã đăng xuất.";
}

// Kiểm tra yêu cầu POST từ form đăng nhập, đăng ký, hoặc đăng xuất
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        registerUser($conn, $username, $password, $email);
    } elseif (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        loginUser($conn, $username, $password);
    } elseif (isset($_POST['logout'])) {
        logoutUser();
    }
}
?>
