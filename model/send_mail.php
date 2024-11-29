<?php
session_start(); // Đảm bảo session được khởi tạo
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../phpmailler/Exception.php";
require "../phpmailler/PHPMailer.php";
require "../phpmailler/SMTP.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];

    // Kiểm tra định dạng email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Email không hợp lệ!']);
        exit();
    }

    // Tạo mã OTP ngẫu nhiên
    $otp = random_int(100000, 999999); // Sử dụng random_int() thay vì rand()

    // Lưu OTP và thời gian vào session để kiểm tra sau này
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_time'] = time(); // Thời gian OTP được tạo

    // Cấu hình PHPMailer để gửi email
    $mail = new PHPMailer(true);
    try {
        // Cấu hình server
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hoangdzai22@gmail.com'; // Email gửi
        $mail->Password = 'pfru bwks ifwz mwqb'; // Mật khẩu email (nên lấy từ môi trường)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Thông tin email
        $mail->setFrom('hoangdzai22@gmail.com', 'Sneaker Home');
        $mail->addAddress($email); // Nhận OTP qua email

        $mail->isHTML(true);
        $mail->Subject = 'Mã OTP đăng ký';
        $mail->Body    = 'Mã OTP của bạn là: ' . $otp;

        // Gửi email
        if ($mail->send()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Email không gửi được!']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $mail->ErrorInfo]);
    }
}

?>
