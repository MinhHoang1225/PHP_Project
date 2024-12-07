<?php
include '../database/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    
    if (isset($_COOKIE['user_id'])) {
        $user_id = intval($_COOKIE['user_id']);
        $stmt = $conn->prepare("SELECT * FROM favourite_products WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $stmt = $conn->prepare("INSERT INTO favourite_products (user_id, product_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $user_id, $product_id);
            if ($stmt->execute()) {
                echo "Đã thêm vào danh sách yêu thích!";
            } else {
                echo "Lỗi: Không thể thêm vào danh sách.";
            }
        } else {
            echo "Sản phẩm này đã có trong danh sách yêu thích.";
        }

        $stmt->close();
    } else {
        echo "Bạn cần đăng nhập để thêm vào danh sách yêu thích.";
    }
}
$conn->close();
?>