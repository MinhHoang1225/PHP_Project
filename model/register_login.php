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
    <title>registerAndLogin</title>
     <style>
        /* @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"); */

        * {
          box-sizing: border-box;
        }
        :root{
          --bg-header: #e5e5e5;
          --bg-btn: #0c6478;
          --bg-hover-btn: #159198;
          --main-font: sans-serif;
          /* second-font:; */
          --main-color: black;
          --second-color: #666666B3;
          --title-text-size: 32px;
          --main-text-size:16px;
          }
        body {
          /* background-color: #686c78; */
          display: flex;
          justify-content: center;
          align-items: center;
          flex-direction: column;
          font-family: "Poppins", sans-serif;
          overflow: hidden;
          height: 100vh;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; 
        }
        h1 {
          font-weight: 700;
          letter-spacing: -1.5px;
          margin: 0;
          margin-bottom: 15px;
        }

        h1.title {
          font-size: 45px;
          line-height: 45px;
          margin: 0;
          text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
        }

        p {
          font-size: 15px;
          font-weight: 400;
          line-height: 20px;
          letter-spacing: 0.5px;
          margin: 20px 0 30px;
          text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
        }

        span {
          font-size: 14px;
          margin-top: 20px;
        }

        a {
          color: #333;
          font-size: 14px;
          text-decoration: none;
          margin: 15px 0;
          transition: 0.3s ease-in-out;
        }

        a:hover {
          color: var(--bg-hover-btn);
        }

        .content {
          display: flex;
          width: 100%;
          height: 50px;
          align-items: center;
          justify-content: space-around;
        }

        .content .checkbox {
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .content input {
          accent-color: #333;
          width: 12px;
          height: 12px;
        }

        .content label {
          font-size: 14px;
          user-select: none;
          padding: 5px;
        }

        button {
          position: relative;
          border-radius: 20px;
          border: 1px solid #686c78;
          background-color: #686c78;
          color: #fff;
          font-size: 15px;
          font-weight: 700;
          margin: 5px;
          padding: 12px 80px;
          letter-spacing: 1px;
          text-transform: capitalize;
          transition: 0.3s ease-in-out;
          cursor: pointer;
        }

        button:hover {
          letter-spacing: 3px;
        }

        button:active {
          transform: scale(0.95);
        }

        button:focus {
          outline: none;
        }

        button.ghost {
          background-color: rgba(255, 255, 255, 0.2);
          border: 2px solid #fff;
          color: #fff;
        }

        #login i {
          position: absolute;
          left: 50px;
        }

        #register i {
          position: absolute;
          right: 50px;
        }

        button.ghost i {
          position: absolute;
          opacity: 1;
          transition: 0.3s ease-in-out;
          z-index: 6;
        }

        button.ghost i.register {
          right: 70px;
        }

        button.ghost i.login {
          left: 70px;
        }

        form {
          background-color: #fff;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          padding: 0 50px;
          height: 100%;
          text-align: center;
        }

        input {
          background-color: #fff;
          outline: none;
          border: none;
          border-bottom: 2px solid #adadad;
          padding: 12px 0px;
          margin: 8px 0;
          width: 100%;
        }

        .container {
          border-radius: 25px;
          box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 0px 10px rgba(0, 0, 0, 0.22);
          position: relative;
          overflow: hidden;
          width: 768px;
          max-width: 100%;
          min-height: 500px;
        }

        .form-container {
          position: absolute;
          top: 0;
          height: 100%;
          transition: all 0.6s ease-in-out;
        }

        .form-control {
          width: 100%;
          position: relative;
        }

        .form-control2 {
          width: 100%;
          position: relative;
        }

        .form-control2 span {
          position: absolute;
          border-bottom: 3px solid #2691d9;
          left: 0;
          bottom: 8px;
          width: 0%;
          transition: all 0.3s ease;
        }

        .form-control2 input:focus ~ span {
          width: 100%;
        }
        .form-control small {
          color: red;
          position: absolute;
          top: 50px;
          left: 0;
          font-size: 12px;
          z-index: 100;
        }

        .form-control span {
          position: absolute;
          border-bottom: 3px solid #2691d9;
          left: 0;
          bottom: 8px;
          width: 0%;
          transition: all 0.3s ease;
        }

        .form-control input:focus ~ span {
          width: 100%;
        }

        .form-control2 small {
          color: red;
          position: absolute;
          top: 50px;
          left: 0;
          font-size: 12px;
          z-index: 100;
        }

        .form-control2 span {
          position: absolute;
          border-bottom: 3px solid #2691d9;
          left: 0;
          bottom: 8px;
          width: 0%;
          transition: all 0.3s ease;
        }

        .form-control2 input:focus ~ span {
          width: 100%;
        }

        .login-container {
          left: 0;
          width: 50%;
          z-index: 2;
        }

        .container.right-panel-active .login-container {
          transform: translateX(100%);
        }

        .register-container {
          /* position: relative; */
          left: 0;
          width: 50%;
          opacity: 0;
          z-index: 1;
        }

        .container.right-panel-active .register-container {
          transform: translateX(100%);
          opacity: 1;
          z-index: 5;
          animation: show 0.6s;
        }

        @keyframes show {
          0%,
          49.99% {
            opacity: 0;
            z-index: 1;
          }

          50%,
          100% {
            opacity: 1;
            z-index: 5;
          }
        }

        .overlay-container {
          position: absolute;
          top: 0;
          left: 50%;
          width: 50%;
          height: 100%;
          overflow: hidden;
          transition: transform 0.6s ease-in-out;
          z-index: 100;
        }

        .container.right-panel-active .overlay-container {
          transform: translate(-100%);
        }

        .overlay {
          background-image: url("https://images.unsplash.com/photo-1621360841013-c7683c659ec6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1932&q=80");
          background-repeat: no-repeat;
          background-size: cover;
          background-position: 0 0;
          color: #fff;
          position: relative;
          left: -100%;
          height: 100%;
          width: 200%;
          transform: translateX(0);
          transition: transform 0.6s ease-in-out;
        }

        .overlay::before {
          content: "";
          position: absolute;
          left: 0;
          right: 0;
          top: 0;
          bottom: 0;
          background: linear-gradient(
            to top,
            rgba(46, 94, 109, 0.4) 40%,
            rgba(46, 94, 109, 0)
          );
        }

        .container.right-panel-active .overlay {
          transform: translateX(50%);
        }

        .overlay-panel {
          position: absolute;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          padding: 0 40px;
          text-align: center;
          top: 0;
          height: 100%;
          width: 50%;
          transform: translateX(0);
          transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
          transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
          transform: translateX(0);
        }

        .overlay-right {
          right: 0;
          transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
          transform: translateX(20%);
        }

        .social-container {
          margin: 20px 0;
        }

        .social-container a {
          border: 1px solid #dddddd;
          border-radius: 50%;
          display: inline-flex;
          justify-content: center;
          align-items: center;
          margin: 0 5px;
          height: 40px;
          width: 40px;
          transition: 0.3s ease-in-out;
        }

        .social-container a:hover {
          border: 1px solid #4bb6b7;
        }
        /* nhập mã đăng ký */
        input[type=text1] {
          --w: 1ch;   
          --g: .15em;
          --b: 2px;   
          --n: 5;     
          
          --c: #888; 
          
          font-size: 20px;
          margin-bottom: 10px !important;
          line-height: 1.5; 
          height: 20px;   
          letter-spacing: var(--w);
          font-family: monospace;   
            width: calc(var(--n) * (1ch + var(--w)));
          padding-left: calc((var(--w) - var(--g)) / 2);
          border-bottom: var(--b) solid var(--c);
            background: 
            repeating-linear-gradient(90deg,
              var(--c) 0 var(--b), 
              #0000 0 calc(1ch + var(--w) - var(--g) - var(--b)),
              var(--c) 0 calc(1ch + var(--w) - var(--g)), 
              #0000 0 2ch),
            conic-gradient(
              at calc(100% - var(--g) - 1px) var(--b),
              #0000 75%, var(--c) 0
            ) 0 0 / calc(1ch + var(--w)) calc(100% - var(--b));

          border: none; 
          outline: 0; 
        }
        input[type=text1]:focus-visible {
          --c: #000; 
        }
        .code {
          margin: 0px;
        }
        .otp-btn {
          background-color:  rgba(46, 94, 109, 0.4); 
          color: #fff;
          border: none;
          border-radius: 20px;
          cursor: pointer;
          font-size: 12px;
        }
        

     </style>
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
        <form >
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
          <button type="button" id="getOtpBtn" class="otp-btn">Gửi mã OTP</button>
          <span class="code">Nhập mã OTP: <input type="text1"  maxlength="5"></span>
          <button type="submit" value="submit">Đăng ký</button>
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

            