<?php
<<<<<<< HEAD
session_start();
require_once 'database/connect.php';

// Giả sử user_id được lưu trong session
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo "<p>Bạn cần đăng nhập để xem giỏ hàng.</p>";
    exit;
}

// Truy vấn giỏ hàng từ database
$query = "SELECT p.name, c.quantity, p.price, (c.quantity * p.price) AS total_price
          FROM cart c
          JOIN products p ON c.product_id = p.id
          WHERE c.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<ul>';
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        echo '<li>' . htmlspecialchars($row['name']) . ' - ' 
             . htmlspecialchars($row['quantity']) . ' x ' 
             . number_format($row['price'], 0, ',', '.') . ' VND</li>';
        $total += $row['total_price'];
    }
    echo '</ul>';
    echo '<p>Tổng tiền: ' . number_format($total, 0, ',', '.') . ' VND</p>';
} else {
    echo '<p>Giỏ hàng trống</p>';
}
=======
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
>>>>>>> Chang/view/about
?>

