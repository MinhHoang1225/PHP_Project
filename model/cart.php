<?php
// Kết nối đến database bằng file connect.php
include '../database/connect.php';

// Truy vấn lấy danh sách sản phẩm trong giỏ hàng
$sql = "SELECT p.id, p.name, p.price, p.image_url, c.quantity 
        FROM cart c 
        INNER JOIN products p ON c.product_id = p.id";
$result = $conn->query($sql);

// Kiểm tra kết quả
if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products); // Trả về dữ liệu sản phẩm dạng JSON
} else {
    echo json_encode([]); // Nếu không có sản phẩm, trả về mảng rỗng
}

// Đóng kết nối
$conn->close();
?>
