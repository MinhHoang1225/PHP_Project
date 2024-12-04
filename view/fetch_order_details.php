<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$order_id = $_POST['order_id'];

$query = "
    SELECT 
        products.name AS product_name,
        order_items.quantity,
        order_items.price
    FROM order_items
    JOIN products ON order_items.product_id = products.product_id
    WHERE order_items.order_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<table class="table">';
    echo '<thead><tr><th>Tên sản phẩm</th><th>Số lượng</th><th>Giá</th></tr></thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
        echo '<td>' . htmlspecialchars($row['price']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "Không có chi tiết đơn hàng.";
}

$stmt->close();
$conn->close();
?>
