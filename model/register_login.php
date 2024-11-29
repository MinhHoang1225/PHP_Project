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
    <style>
      
  #otp-container {
    padding-left: 55px;
    display: flex;
    gap: 10px;
}

#otp-container input {
    width: 20px;
    height: 20px;
    text-align: center;
    font-size: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

#otp-container input:focus {
    outline: none;
    border-color: #4d90fe;
}
    </style>
  </head>
  <body>
    <div class="container" id="container">
      <div class="form-container register-container">
      <button class="close-button-register" onclick="navigateTo('./index.php')">&times;</button>
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
// const container = document.getElementById("container");

// Hiệu ứng chuyển đổi giao diện
registerButton.addEventListener("click", () => {
    container.classList.add("right-panel-active");
});

loginButton.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
});

// // Kiểm tra trạng thái đăng ký từ URL
// window.addEventListener("load", () => {
//     const urlParams = new URLSearchParams(window.location.search);
//     const success = urlParams.get("rs");
//     if (success === "success") {
//         alert("Đăng ký thành công! Chuyển sang đăng nhập...");
//         container.classList.add("right-panel-active");
//     } else if (urlParams.get("rf") === "fail") {
//         alert("Đăng ký thất bại. Vui lòng thử lại.");
//     }
// });



    // const form = document.querySelector('form')
    // const username = document.getElementById('username')
    // const usernameError = document.querySelector("#username-error")
    // const email = document.getElementById('email')
    // const emailError = document.querySelector("#email-error")
    // const password = document.getElementById('password')
    // const passwordError = document.querySelector("#password-error")

    // function showError(input, message) {
    //     const formControl = input.parentElement
    //     formControl.className = 'form-control error'
    //     const small = formControl.querySelector('small')
    //     small.innerText = message
    // }
    // function showSuccess(input) {
    //     const formControl = input.parentElement
    //     formControl.className = 'form-control success'
    //     const small = formControl.querySelector('small')
    //     small.innerText = ''
    // }
    // function checkEmail(email) {
    //     const emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    //     return emailRegex.test(email);
    // }

    // email.addEventListener("input", function(){
    //     if (!checkEmail(email.value)) {
    //         emailError.textContent = "*Email không hợp lệ"
    //     }else {
    //         emailError.textContent = "";
    //     }
    // })
    // username.addEventListener("input", function(){
    //     if (username.value.length < 4) {
    //         usernameError.textContent = "*Tên đăng nhập phải có ít nhất 8 ký tự."
    //     }else if(username.value.length > 20){
    //         usernameError.textContent = "*Tên đăng nhập phải ít hơn 20 ký tự.";
    //     }else {
    //         usernameError.textContent = "";
    //     }
    // })

    // password.addEventListener("input", function(){
    //     if (password.value.length < 8) {
    //         passwordError.textContent = "*Mật khẩu phải có ít nhất 8 ký tự."
    //     }else if(password.value.length > 20){
    //         passwordError.textContent = "*Mật khẩu phải ít hơn 20 ký tự."
    //     }else {
    //         passwordError.textContent = "";
    //     }
    // })

    // function checkRequired(inputArr) {
    //     let isRequired = false
    //     inputArr.forEach(function(input) {
    //         if (input.value.trim() === '') {
    //             showError(input, `*${getFieldName(input)} là bắt buộc`)
    //             isRequired = true
    //         }else {
    //             showSuccess(input)
    //         }
    //     })

    //     return isRequired
    // }

    // function getFieldName(input) {
    //     return input.id.charAt(0).toUpperCase() + input.id.slice(1)
    // }

    // // Event listeners
    // form.addEventListener('submit', function (e) {
    //     e.preventDefault()

    //     if (!checkRequired([username, email, password])) {
    //         // checkLength(username, 3, 15)
    //         // checkLength(password, 6, 25)
    //         // checkEmail(email)
    //     } 
    // })

    // let lgForm = document.querySelector('.form-lg')
    // let lgEmail = document.querySelector('.email-2')
    // let lgEmailError = document.querySelector(".email-error-2")
    // let lgPassword = document.querySelector('.password-2')
    // let lgPasswordError = document.querySelector(".password-error-2")

    // function showError2(input, message) {
    //     const formControl2 = input.parentElement
    //     formControl2.className = 'form-control2 error'
    //     const small2 = formControl2.querySelector('small')
    //     small2.innerText = message
    // }

    // function showSuccess2(input) {
    //     const formControl2 = input.parentElement
    //     formControl2.className = 'form-control2 success'
    //     const small2 = formControl2.querySelector('small')
    //     small2.innerText = '';
    // }

    // function checkEmail2(lgEmail) {
    //     const emailRegex2 = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    //     return emailRegex2.test(lgEmail);
    // }

    // lgEmail.addEventListener("input", function(){
    //     if (!checkEmail2(lgEmail.value)) {
    //         lgEmailError.textContent = "**Email không hợp lệ"
    //     }else {
    //         lgEmailError.textContent = "";
    //     }
    // })

    // lgPassword.addEventListener("input", function(){
    //     if (lgPassword.value.length < 8) {
    //         lgPasswordError.textContent = "*Mật khẩu phải có ít nhất 8 ký tự."
    //     }else if (lgPassword.value.length > 20){
    //         lgPasswordError.textContent = "*Mật khẩu phải ít hơn 20 ký tự."
    //     }else {
    //         lgPasswordError.textContent = "";
    //     }
    // })

    // function checkRequiredLg(inputArr2) {
    //     let isRequiredLg = false
    //     inputArr2.forEach(function(input){
    //         if (input.value.trim() === '') {
    //             showError2(input, `*${getFieldNameLg(input)}Vui lòng nhập thông tin vào trường này`)
    //             isRequiredLg = true
    //         }else {
    //             showSuccess2(input)
    //         }
    //     })

    //     return isRequiredLg
    // }

    // function getFieldNameLg(input) {
    //     return input.id.charAt(0).toUpperCase() + input.id.slice(1)
    // }

    // lgForm.addEventListener('submit', function (e){
    //     e.preventDefault()

    //     if (!checkRequiredLg([lgEmail, lgPassword])) {
    //         checkEmail2(lgEmail)
    //     }
    // })    
  </script>
</html>

            