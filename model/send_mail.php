<?php
// Import PHPMailer classes
require_once '../phpmailler/Exception.php';
require_once '../phpmailler/PHPMailer.php';
require_once '../phpmailler/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendRegistrationEmail($toEmail, $username) {
    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // SMTP server của Gmail
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hoangdzai22@gmail.com';  // Thay thế bằng email của bạn
        $mail->Password   = 'cobw sctq cspc ttui';  // Thay bằng mật khẩu ứng dụng Gmail của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;  // Cổng SMTP cho STARTTLS (587)

        // Người gửi và người nhận email
        $mail->setFrom('hoangdzai22@gmail.com', 'Sneaker Home');
        $mail->addAddress($toEmail);  // Email người nhận (email của người dùng đã đăng ký)	

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Thông tin đăng ký tài khoản';
        $mail->Body    = "
            <h2>Chúc mừng bạn đã đăng ký thành công!</h2>
            <p>Chào <strong>$username</strong>,</p>
            <p>Chúng tôi vui mừng thông báo rằng tài khoản của bạn đã được đăng ký thành công.</p>
            <p>Vui lòng truy cập vào <a href='https://example.com/login'>đây</a> để đăng nhập vào tài khoản của bạn.</p>
            <p>Chúc bạn có một trải nghiệm tuyệt vời với chúng tôi!</p>
        ";

        // Debug mode, giúp tìm lỗi khi gửi email (có thể bỏ qua nếu không cần)
        $mail->SMTPDebug = 0;

        // Gửi email
        $mail->send();
        echo 'Email đã được gửi thành công!';
    } catch (Exception $e) {
        // Nếu có lỗi trong quá trình gửi email
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

