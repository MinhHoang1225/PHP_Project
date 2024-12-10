<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra dữ liệu POST
if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Cập nhật trạng thái đơn hàng
    $query = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        echo "Trạng thái đã được cập nhật thành công!";
    } else {
        echo "Lỗi khi cập nhật trạng thái: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
