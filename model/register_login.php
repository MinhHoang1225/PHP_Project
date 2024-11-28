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
      <!-- Form Đăng ký -->
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
          <button type="submit" name="submit" id="send-otp-btn">Đăng ký và Gửi OTP</button>
        </form>
      </div>

      <!-- Form Xác minh OTP -->
      <div class="form-container otp-container" style="display: none;">
        <form method="POST" id="otp-form">
          <label>Nhập OTP:</label>
          <div class="otp-container">
            <input type="text" name="otp1" maxlength="1" class="otp-input" required />
            <input type="text" name="otp2" maxlength="1" class="otp-input" required />
            <input type="text" name="otp3" maxlength="1" class="otp-input" required />
            <input type="text" name="otp4" maxlength="1" class="otp-input" required />
            <input type="text" name="otp5" maxlength="1" class="otp-input" required />
            <input type="text" name="otp6" maxlength="1" class="otp-input" required />
          </div>
          <button type="submit" name="verify" id="verify">Xác nhận OTP</button>
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

            