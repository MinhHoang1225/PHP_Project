<?php
include '../database/connect.php';

// Giả định user_id là 1 (thay bằng logic đăng nhập của bạn)
$user_id = 1;

$sql = "SELECT 
            sc.id AS cart_id,
            p.id AS product_id,
            p.name AS product_name,
            p.price,
            sc.quantity,
            (p.price * sc.quantity) AS total_price
        FROM shopping_cart sc
        JOIN products p ON sc.product_id = p.id
        WHERE sc.user_id = $user_id";

$result = $conn->query($sql);

$cart_items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }
}

// Trả về dữ liệu JSON
header('Content-Type: application/json');
echo json_encode($cart_items);

$conn->close();
?>

