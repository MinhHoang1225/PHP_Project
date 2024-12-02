<?php
// Kết nối đến cơ sở dữ liệu
include('../database/connect.php');
// Kiểm tra cookie user_id
if (!isset($_COOKIE['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Người dùng chưa đăng nhập.'
    ]);
    exit;
}

$user_id = intval($_COOKIE['user_id']); // Lấy user_id từ cookie và chuyển đổi sang số nguyên

// Truy vấn lịch sử đơn hàng của người dùng
$sql = "SELECT order_id, total_amount, status, created_at AS order_date 
        FROM orders 
        WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = [
                'order_id' => $row['order_id'],
                'total_amount' => $row['total_amount'],
                'status' => $row['status'],
                'order_date' => $row['order_date']
            ];
        }

        echo json_encode([
            'status' => 'success',
            'orders' => $orders
        ]);
    } else {
        echo json_encode([
            'status' => 'empty',
            'message' => 'Không có đơn hàng nào.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Lỗi khi truy vấn cơ sở dữ liệu.'
    ]);
}

$stmt->close();
$conn->close();
?>
