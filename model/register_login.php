<?php
// Import PHPMailer classes
require_once '../phpmailler/Exception.php';
require_once '../phpmailler/PHPMailer.php';
require_once '../phpmailler/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
require_once '../database/connect.php';

if (isset($_POST['submit'])) {

    // Lấy thông tin từ form và bảo vệ dữ liệu khỏi SQL Injection
    if (isset($_POST['username'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
    }

    if (isset($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
    }

    if (isset($_POST['password'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
    }

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $email_check);
    
    if (mysqli_num_rows($result) > 0) {
        // Nếu email đã tồn tại, hiển thị thông báo và không làm gì thêm
        echo '<script>alert("Email đã tồn tại. Vui lòng sử dụng email khác."); window.location.href="register_login.php";</script>';
        exit();
    } else {
        // Nếu email chưa tồn tại, thực hiện đăng ký người dùng mới
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        $res = mysqli_query($conn, $sql);
        
        if ($res) {
            // Đăng ký thành công, gửi email xác nhận
            if (sendRegistrationEmail($email, $username)) {
                // Đăng ký thành công và gửi email, chuyển hướng đến trang đăng nhập
                echo '<script>alert("Đăng ký thành công! Chúng tôi đã gửi một email xác nhận. Vui lòng kiểm tra email của bạn."); window.location.href="register_login.php";</script>';
            } else {
                // Gửi email thất bại
                echo '<script>alert("Đăng ký thành công nhưng không thể gửi email xác nhận. Vui lòng thử lại sau."); window.location.href="register_login.php";</script>';
            }
            exit();
        } else {
            // Đăng ký thất bại, hiển thị alert và quay lại trang đăng ký
            echo '<script>alert("Đăng ký thất bại. Vui lòng thử lại."); window.location.href="register_login.php";</script>';
            exit();
        }
    }
}

// Hàm gửi email xác nhận đăng ký
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
        $mail->setFrom('shop@sneakerhome.vn', 'Sneaker Home');
        $mail->addAddress($toEmail);  // Email người nhận (email của người dùng đã đăng ký)    

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Thông tin đăng ký tài khoản';
        $mail->Body    = "
            <h2>Chúc mừng bạn đã đăng ký thành công!</h2>
            <p>Chào <strong>$username</strong>,</p>
            <p>Chúng tôi vui mừng thông báo rằng tài khoản của bạn đã được đăng ký thành công.</p>
            <p>Vui lòng truy cập vào <a href='http://localhost:8080/PHP_Project/model/register_login.php'>đây</a> để đăng nhập vào tài khoản của bạn.</p>
            <p>Chúc bạn có một trải nghiệm tuyệt vời với chúng tôi!</p>
        ";
        $mail->SMTPDebug = 2;
        // Gửi email
        if ($mail->send()) {
            return true;
        } else {
            throw new Exception("Không thể gửi email.");
        }
    } catch (Exception $e) {
        echo "Lỗi gửi email: {$mail->ErrorInfo}";
        return false;
    }
}
?>
<?php
include('../database/connect.php'); // Kết nối cơ sở dữ liệu

// Xử lý form đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy email và password từ form
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($email) && !empty($password)) {
        // Kiểm tra thông tin trong bảng admins
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            // Lưu thông tin admin vào cookies (30 ngày)
            $cookie_expire_time = time() + (30 * 24 * 60 * 60); // 30 ngày
            setcookie('user_role', 'admin', $cookie_expire_time, '/');
            setcookie('user_id', $admin['admin_id'], $cookie_expire_time, '/');
            setcookie('username', $admin['username'], $cookie_expire_time, '/');
            setcookie('email', $admin['email'], $cookie_expire_time, '/');
            setcookie('is_login', true, $cookie_expire_time, '/'); // Đánh dấu đã đăng nhập
            $stmt->close();
            $conn->close();
            // Chuyển hướng đến trang admin
            header("Location: ../view/admin.php");
            exit();
        }

        // Kiểm tra thông tin trong bảng users
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Lưu thông tin user vào cookies (30 ngày)
            $cookie_expire_time = time() + (30 * 24 * 60 * 60); // 30 ngày
            setcookie('user_role', 'user', $cookie_expire_time, '/');
            setcookie('user_id', $user['user_id'], $cookie_expire_time, '/');
            setcookie('username', $user['username'], $cookie_expire_time, '/');
            setcookie('email', $user['email'], $cookie_expire_time, '/');
            setcookie('is_login', true, $cookie_expire_time, '/'); // Đánh dấu đã đăng nhập
            $stmt->close();
            $conn->close();
            // Chuyển hướng đến trang chính
            header("Location: ../index.php");
            exit();
        }

        // Nếu không tìm thấy email trong cả hai bảng
        $error_message = "Email hoặc mật khẩu không chính xác!";
        $stmt->close();
    } else {
        $error_message = "Vui lòng nhập đầy đủ thông tin!";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet " type="" href="../assets/css/register_login.css">
    <script src="../assets/js/navigation.js"></script>
    <title>Đăng nhập và Đăng kí</title>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <div class="container" id="container">
    <video class="video-background" autoplay loop muted>
        <source src="../assets/video/background2.mp4" type="video/mp4">
    </video>
      <div class="form-container register-container">
      <!-- <button class="close-button-register" onclick="navigateTo('./index.php')">&times;</button> -->
      <form method="POST" id="register-form" action="register_login.php">
        <h1>Đăng ký tại đây</h1>
        <div class="form-control">
            <input type="text" name="username" id="username" placeholder="Tên đăng nhập" required />
            <small id="username-error"></small>
        </div>
        <div class="form-control">
            <input type="email" name="email" id="email" placeholder="E-mail" required />
            <small id="email-error"></small>
        </div>
        <div class="form-control">
            <input type="password" name="password" id="password" placeholder="Mật khẩu" required />
            <small id="password-error"></small>
        </div>
        <div class="form-control">
            <input type="password" name="confirm_password" id="confirm-password" placeholder="Xác nhận mật khẩu" required />
            <small id="confirm-password-error"></small>
        </div>
        <button type="submit" name="submit" id="submit">Đăng ký</button>
    </form>

      </div>
      <div class="form-container login-container">
        <form class="form-lg" action="" method="POST">
            <h1>Đăng nhập tại đây</h1>
            <?php if (isset($error_message)): ?>
            <div id="error-message" class="alert alert-danger" style="display: none;">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
            <div class="form-control2">
                <input type="email" name="email" class="email-2" placeholder="E-mail" required />
                <small class="email-error-2"></small>
            </div>
            <div class="form-control2">
                <input type="password" name="password" class="password-2" placeholder="Mật khẩu" required />
                <small class="password-error-2"></small>
            </div>

            <div class="content">
                <div class="checkbox">
                    <input type="checkbox" name="remember" id="checkbox" <?php echo isset($_COOKIE['user_email']) ? 'checked' : ''; ?> />
                    <label for="checkbox">Remember me</label>
                </div>
                <div class="pass-link">
                    <a href="#">Bạn quên mật khẩu?</a>
                </div>
            </div>
            <button type="submit" value="submit">Đăng nhập</button>
            <span>Hoặc sử dụng tài khoản của bạn</span>
            <div class="social-container">
                <a href="#" class="social"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
                <a href="#" class="social"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </form>
      </div>
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1 class="title">
              Xin chào <br>
               bạn
            </h1>
            <p>Nếu bạn có tài khoản, hãy đăng nhập vào đây và vui chơi</p>
            <button class="ghost" id="login">
               Đăng nhập
              <i class="fa-solid fa-arrow-left"></i>
            </button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1 class="title">
               Bắt đầu cuộc hành trình </br>
                của bạn bây giờ
            </h1>
            <p>
              Nếu bạn chưa có tài khoản, hãy tham gia cùng chúng tôi và bắt đầu hành trình của bạn
            </p>
            <button class="ghost" id="register">
              Đăng ký
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script >
 const registerButton = document.getElementById("register");
    const loginButton = document.getElementById("login");
    registerButton.addEventListener("click", () => {
      container.classList.add("right-panel-active");
    });

    loginButton.addEventListener("click", () => {
      container.classList.remove("right-panel-active");
    });
    document.addEventListener('DOMContentLoaded', function () {
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'block';
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 4000);
        }
    });

  </script>
</html>

              