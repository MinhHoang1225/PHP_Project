<?php
session_start(); // Đảm bảo session được khởi tạo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $data = json_decode(file_get_contents('php://input'), true);
    $otp_input = $data['otp'];

    // Kiểm tra xem session có chứa OTP không
    if (isset($_SESSION['otp']) && $otp_input == $_SESSION['otp']) {
        // Kiểm tra thời gian OTP (5 phút)
        $otp_time = $_SESSION['otp_time'];
        if (time() - $otp_time > 300) { // OTP hết hạn sau 5 phút
            echo json_encode(['status' => 'error', 'message' => 'OTP đã hết hạn!']);
            exit();
        }

        echo json_encode(['status' => 'success', 'message' => 'OTP chính xác.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'OTP không đúng!']);
    }
}

?>
