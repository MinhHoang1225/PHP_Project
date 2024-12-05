<?php
include('../database/connect.php');
require_once '../phpmailler/Exception.php';
require_once '../phpmailler/PHPMailer.php';
require_once '../phpmailler/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Truy vấn sản phẩm yêu thích của người dùng
    $favourite_sql = "SELECT 
        products.name AS product_name,
        products.price AS product_price,
        products.old_price AS old_price,
        img AS product_img,
        favourite_products.created_at AS added_date
    FROM favourite_products
    INNER JOIN products ON favourite_products.product_id = products.product_id
    WHERE favourite_products.user_id = ?";

    $stmt = $conn->prepare($favourite_sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $emailContent = "<h1>Sản phẩm yêu thích của bạn:</h1><ul>";

        while ($row = $result->fetch_assoc()) {
            $emailContent .= "<li>
                <strong>" . $row['product_name'] . "</strong> - Giá: " . number_format($row['product_price']) . " VND
                (Giá cũ: " . number_format($row['old_price']) . " VND)
                <br>
                <br>Ngày thêm: " . $row['added_date'] . "
                <br><em>Chọn ngay kẻo lỡ, không là anh Vinh hết vui nha! 😄</em>
                <br>Vinh vui vẻ tặng bạn 1 voucher, nhập mã khi thanh toán để được giảm giá: <b>VINHVUIVE</b>
            </li>";
        }
        $emailContent .= "</ul>";
        

        // Lấy email của người dùng
        $email_sql = "SELECT email FROM users WHERE user_id = ?";
        $stmt_email = $conn->prepare($email_sql);
        $stmt_email->bind_param('i', $user_id);
        $stmt_email->execute();
        $email_result = $stmt_email->get_result();
        $userEmail = $email_result->fetch_assoc()['email'];

        // Gửi email nếu hợp lệ
        if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->CharSet = 'UTF-8';
                $mail->Username = 'hoangdzai22@gmail.com'; // Thay bằng email của bạn
                $mail->Password = 'cobw sctq cspc ttui'; // Thay bằng mật khẩu email
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('sneakerhome@gmail.com', 'Sneaker Home');
                $mail->addAddress($userEmail);

                $mail->isHTML(true);
                $mail->Subject = "Chào bạn thân, Vinh Vui Vẻ gửi sản phẩm yêu thích đây! 🌟";
                $mail->Body = $emailContent;

                $mail->send();
                echo "<script>
                    alert('Email đã gửi thành công!');
                    window.location.href = 'admin.php'; 
                </script>";;
            } catch (Exception $e) {
                echo "<script>alert('Lỗi khi gửi email: {$mail->ErrorInfo}');</script>";
            }
        } else {
            echo "Email không hợp lệ.";

        }
    } else {
        echo "Không có sản phẩm yêu thích.";
    }

    $stmt->close();
    $conn->close();
}
?>
