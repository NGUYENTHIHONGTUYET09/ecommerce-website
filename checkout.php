<?php
session_start();
include('php/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart = $_SESSION['cart'] ?? [];
    $userId = $_SESSION['user_id'] ?? null; // Giả định người dùng đã đăng nhập

    if ($userId) {
        foreach ($cart as $productId => $quantity) {
            // Lưu đơn hàng vào cơ sở dữ liệu
            $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $userId, $productId, $quantity);
            $stmt->execute();
        }
        $_SESSION['cart'] = []; // Xóa giỏ hàng sau khi thanh toán
        echo json_encode(['message' => 'Đơn hàng của bạn đã được đặt thành công!']);
    } else {
        echo json_encode(['message' => 'Bạn cần đăng nhập để thanh toán.']);
    }
}
?>
