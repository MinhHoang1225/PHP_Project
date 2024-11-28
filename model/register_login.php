<?php
// Kết nối với cơ sở dữ liệu
require_once '../database/connect.php';
require_once '../phpmailler/Exception.php';
require_once '../phpmailler/PHPMailer.php';
require_once '../phpmailler/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Khởi tạo session để lưu trữ OTP tạm thời
session_start();

if (isset($_POST['submit'])) {
    // Lấy thông tin từ form
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Kiểm tra các trường bắt buộc
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }

    // Kiểm tra mật khẩu có khớp không
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Tạo mã OTP (6 chữ số)
    $otp = random_int(100000, 999999);

    // Lưu thông tin người dùng và OTP vào session
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $hashed_password;
    $_SESSION['otp'] = $otp;

    // Gửi OTP qua email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hoangdzai22@gmail.com'; // Thay bằng email của bạn
        $mail->Password = 'ppxsuuhcpijgirxv'; // Thay bằng mật khẩu email của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('hoangdzai22@gmail.com', 'Sneaker Home');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "<h1>Hello, $username!</h1>
                       <p>Your OTP for account verification is:</p>
                       <h2 style='color:blue;'>$otp</h2>
                       <p>Please enter this code on the verification page to activate your account.</p>";

        $mail->send();
        echo "Registration successful! Please check your email for the OTP.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Xử lý xác thực OTP
if (isset($_POST['verify'])) {
    // Lấy OTP người dùng nhập
    $user_otp = trim($_POST['otp']);

    // Kiểm tra OTP
    if ($user_otp == $_SESSION['otp']) {
        // Lưu người dùng vào cơ sở dữ liệu nếu OTP đúng
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];

        // Lưu thông tin người dùng vào cơ sở dữ liệu
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            $message = "Đăng ký thành công!";
            session_unset(); // Xóa dữ liệu session
        } else {
            $message = "Lỗi: " . mysqli_error($conn);
        }
    } else {
        $message = "OTP không chính xác!";
    }

    echo $message;
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
      <div class="form-container register-container">
      <button class="close-button-register" onclick="navigateTo('./index.php')">&times;</button>
        <form>
          <h1>Đăng ký tại đây</h1>
          <div class="form-control">
            <input type="text" id="username" placeholder="Tên đăng nhập" />
            <small id="username-error"></small>
            <span></span>
          </div>
          <div class="form-control">
            <input type="email" id="email" placeholder="E-mail" />
            <small id="email-error"></small>
            <span></span>
          </div>
          <div class="form-control">
            <input type="password" id="password" placeholder="Mật khẩu" />
            <small id="password-error"></small>
            <span></span>
          </div>
          <div class="form-control">
            <input type="password" id="confirm-password" placeholder="Xác nhận mật khẩu" />
            <small id="confirm-password-error"></small>
            <span></span>
          </div>
          <div class="form-control">
            <button type="button" id="send-otp-btn">Gửi OTP</button>
          </div>
          <!-- OTP -->
          <form method="POST">
            <label style="padding-top: 10px;">Enter OTP:</label>
            <div class="otp-container">
                <input type="text" name="otp1" maxlength="1" class="otp-input" required>
                <input type="text" name="otp2" maxlength="1" class="otp-input" required>
                <input type="text" name="otp3" maxlength="1" class="otp-input" required>
                <input type="text" name="otp4" maxlength="1" class="otp-input" required>
                <input type="text" name="otp5" maxlength="1" class="otp-input" required>
                <input type="text" name="otp6" maxlength="1" class="otp-input" required>
            </div>
            <button type="submit" name="verify">Verify</button>
        </form>
      </div>




      <div class="form-container login-container">
        <button class="close-button-login " onclick="navigateTo('./index.php')">&times;</button>
        <form class="form-lg">
          <h1>Đăng nhập tại đây</h1>
          <div class="form-control2">
            <input type="email" class="email-2" placeholder="E-mail" />
            <small class="email-error-2"></small>
            <span></span>
          </div>
          <div class="form-control2">
            <input type="password" class="password-2" placeholder="Mật khẩu" />
            <small class="password-error-2"></small>
            <span></span>
          </div>

          <div class="content">
            <div class="checkbox">
              <input type="checkbox" name="checkbox" id="checkbox" />
              <label for="">Remember me</label>
            </div>
            <div class="pass-link">
              <a href="#">Bạn quên mật khẩu?</a>
            </div>
          </div>
          <button type="submit" value="submit">Đăng nhập</button>
          <span>Hoặc sử dụng tài khoản của bạn</span>
          <div class="social-container">
            <a href="#" class="social"
              ><i class="fa-brands fa-facebook-f"></i
            ></a>
            <a href="#" class = "social"><i class="fa-brands fa-google"></i></a>
            <a href="#" class="social"><i class="fa-brands fa-tiktok"></i></a>
          </div>
        </form>
      </div>




      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1 class="title">
              Xin chào <br />
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
 



























  <script>
      document.getElementById('send-otp-btn').addEventListener('click', function() {
        const email = document.getElementById('email').value;
        if (email) {
          alert('Mã OTP đã được gửi đến email của bạn.');
          document.getElementById('otp-container').style.display = 'block';
        } else {
          alert('Vui lòng nhập email trước khi yêu cầu OTP.');
        }
      });
    </script>
  <script>
    document.getElementById("navigate_index2").onclick = function() {
      setTimeout(function() {
          window.location.href = "../index.php";  
      }, 100); 
      };
  </script>

  <script >
    const registerButton = document.getElementById("register");
    const loginButton = document.getElementById("login");
    const container = document.getElementById("container");

    registerButton.addEventListener("click", () => {
      container.classList.add("right-panel-active");
    });

    loginButton.addEventListener("click", () => {
      container.classList.remove("right-panel-active");
    });

    const form = document.querySelector('form')
    const username = document.getElementById('username')
    const usernameError = document.querySelector("#username-error")
    const email = document.getElementById('email')
    const emailError = document.querySelector("#email-error")
    const password = document.getElementById('password')
    const passwordError = document.querySelector("#password-error")

    function showError(input, message) {
        const formControl = input.parentElement
        formControl.className = 'form-control error'
        const small = formControl.querySelector('small')
        small.innerText = message
    }
    function showSuccess(input) {
        const formControl = input.parentElement
        formControl.className = 'form-control success'
        const small = formControl.querySelector('small')
        small.innerText = ''
    }
    function checkEmail(email) {
        const emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
        return emailRegex.test(email);
    }

    email.addEventListener("input", function(){
        if (!checkEmail(email.value)) {
            emailError.textContent = "*Email không hợp lệ"
        }else {
            emailError.textContent = "";
        }
    })
    username.addEventListener("input", function(){
        if (username.value.length < 4) {
            usernameError.textContent = "*Tên đăng nhập phải có ít nhất 8 ký tự."
        }else if(username.value.length > 20){
            usernameError.textContent = "*Tên đăng nhập phải ít hơn 20 ký tự.";
        }else {
            usernameError.textContent = "";
        }
    })

    password.addEventListener("input", function(){
        if (password.value.length < 8) {
            passwordError.textContent = "*Mật khẩu phải có ít nhất 8 ký tự."
        }else if(password.value.length > 20){
            passwordError.textContent = "*Mật khẩu phải ít hơn 20 ký tự."
        }else {
            passwordError.textContent = "";
        }
    })

    function checkRequired(inputArr) {
        let isRequired = false
        inputArr.forEach(function(input) {
            if (input.value.trim() === '') {
                showError(input, `*${getFieldName(input)} là bắt buộc`)
                isRequired = true
            }else {
                showSuccess(input)
            }
        })

        return isRequired
    }

    function getFieldName(input) {
        return input.id.charAt(0).toUpperCase() + input.id.slice(1)
    }

    // Event listeners
    form.addEventListener('submit', function (e) {
        e.preventDefault()

        if (!checkRequired([username, email, password])) {
            // checkLength(username, 3, 15)
            // checkLength(password, 6, 25)
            // checkEmail(email)
        } 
    })

    let lgForm = document.querySelector('.form-lg')
    let lgEmail = document.querySelector('.email-2')
    let lgEmailError = document.querySelector(".email-error-2")
    let lgPassword = document.querySelector('.password-2')
    let lgPasswordError = document.querySelector(".password-error-2")

    function showError2(input, message) {
        const formControl2 = input.parentElement
        formControl2.className = 'form-control2 error'
        const small2 = formControl2.querySelector('small')
        small2.innerText = message
    }

    function showSuccess2(input) {
        const formControl2 = input.parentElement
        formControl2.className = 'form-control2 success'
        const small2 = formControl2.querySelector('small')
        small2.innerText = '';
    }

    function checkEmail2(lgEmail) {
        const emailRegex2 = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
        return emailRegex2.test(lgEmail);
    }

    lgEmail.addEventListener("input", function(){
        if (!checkEmail2(lgEmail.value)) {
            lgEmailError.textContent = "**Email không hợp lệ"
        }else {
            lgEmailError.textContent = "";
        }
    })

    lgPassword.addEventListener("input", function(){
        if (lgPassword.value.length < 8) {
            lgPasswordError.textContent = "*Mật khẩu phải có ít nhất 8 ký tự."
        }else if (lgPassword.value.length > 20){
            lgPasswordError.textContent = "*Mật khẩu phải ít hơn 20 ký tự."
        }else {
            lgPasswordError.textContent = "";
        }
    })

    function checkRequiredLg(inputArr2) {
        let isRequiredLg = false
        inputArr2.forEach(function(input){
            if (input.value.trim() === '') {
                showError2(input, `*${getFieldNameLg(input)}Vui lòng nhập thông tin vào trường này`)
                isRequiredLg = true
            }else {
                showSuccess2(input)
            }
        })

        return isRequiredLg
    }

    function getFieldNameLg(input) {
        return input.id.charAt(0).toUpperCase() + input.id.slice(1)
    }

    lgForm.addEventListener('submit', function (e){
        e.preventDefault()

        if (!checkRequiredLg([lgEmail, lgPassword])) {
            checkEmail2(lgEmail)
        }
    })    
  </script>
</html>

            