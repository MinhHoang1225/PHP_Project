<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $order_sql = "
        SELECT orders.order_id, orders.created_at, orders.status 
        FROM orders 
        WHERE orders.user_id = $user_id";
    $order_result = $conn->query($order_sql);

    if ($order_result->num_rows > 0) {
        echo "<h3>Đơn hàng của khách hàng ID: $user_id</h3>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Mã đơn hàng</th><th>Thời gian đặt hàng</th><th>Trạng thái</th></tr></thead><tbody>";
        while ($order = $order_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><a href='/PHP_Project/view/order_details.php?order_id=" . $order['order_id'] . "'>" . $order['order_id'] . "</a></td>";
            echo "<td>" . htmlspecialchars($order['created_at']) . "</td>";
            echo "<td>" . htmlspecialchars($order['status']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Không có đơn hàng nào cho khách hàng này.</p>";
    }
}
?>
