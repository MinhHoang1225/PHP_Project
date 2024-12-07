<?php include($_SERVER['DOCUMENT_ROOT'] . "/PHP_Project/database/connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/font-aware.js"></script>
    <title>Footer</title>
</head>
<style>
   .col-lg-3 {
        flex: 0 0 auto;
        width: 30%;
    }

    .f_widget_1, .f_widget_3 {
        width:19% !important; 
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
    
    .footer_area {
        background: #e5e5e5;
    }
    
    .footer_top {
        padding: 35px 0px 30px;
        overflow-x: hidden;
    }
    

    .logo-container .logo {
        width: 80%;
        margin: 40px 0 0 0px;
        height: auto;
    }
    
    .logo-description, .footer_top .shop_widget p{
        color: var(--second-color);
        font-size: 18px;
        margin-top: 5px;
        line-height: 1.5;
    }
    
    a:hover, a:focus, .btn:hover, .btn:focus, button:hover, button:focus {
        text-decoration: none;
        outline: none;
    }
    
    .footer_top .f_widget.shop-widget .f_list li a:hover {
        color: var(--bg-btn);
    }
    
    .footer_top .f_widget.shop-widget .f_list li {
        margin-bottom: 11px;
    }
    .f_widget.shop-widget .f_list li:last-child {
        margin-bottom: 0px;
    }
    .f_widget.shop-widget .f_list li {
        margin-bottom: 15px;
    }
    .f_widget.shop-widget .f_list {
        margin-bottom: 0px;
    }
    
    .f_subscribe_two {
        display: flex; 
        align-items: center; 
        gap: 10px; 
    } 

    .f_widget .f_subscribe_two .btn_get_two {
        -webkit-box-shadow: none;
        box-shadow: none;
        background: var(--bg-btn);
        color: #fff;
        margin-top: 1px;
    }
    
    .f_subscribe_two .form-control.memail {
        flex: 1; 
        margin: 0;
        border-radius: 5px;
        font-size: 16px;
    }
    
    .f_subscribe_two .btn_get_two {
        width:25%;
        flex-shrink: 0;
        padding: 10px 20px;
        font-size: 18px;
        border-radius: 5px;
        white-space: nowrap; 
    }

    .f_widget .f_subscribe_two .btn_get_two:hover {
        background: transparent;
        background-color: var(--bg-hover-btn);
        color: #fff;
    }
    
    .footer_top .f_social_icon a:hover {
        background: var(--bg-hover-btn);
        border-color: var(--bg-btn); 
        color:white;
    }
    .footer_top .f_social_icon a + a {
        margin-left: 4px;
    }
    .footer_top .f-title {
        margin-bottom: 30px;
        color: var(--main-color);
        font-size: 20px;
    }
    .f_600 {
        font-weight: 600;
    }
    .f_size_18 {
        font-size: 18px;
    }
    h1, h2, h3, h4, h5, h6 {
        color: #4b505e;
    }
    
    .footer_top .f_widget.shop-widget .f_list {
        font-size: 18px;
        list-style: none;
    }
    
    .footer_top .f_widget.shop-widget .f_list li,
    .footer_top .f_widget.shop-widget .f_list li i
      {
        color:  var(--second-color);
    }

    .footer_top .f_widget.shop-widget .f_list li a {
        color:  var(--second-color);
        text-decoration: none;
    }
    
    .footer_bg {
        position: relative;
        bottom: 0;
        background: url("https://p-vn.ipricegroup.com/trends-article/top-3-mau-giay-converse-duoc-cac-ngoi-sao-quoc-te-ua-chuong-medium.jpg") no-repeat scroll center 0;
        width: 100%;
        height: 320px;
        background-size: cover; 
    }
    
    .footer_bg .footer_bg_two {
        background: url("https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhyLGwEUVwPK6Vi8xXMymsc-ZXVwLWyXhogZxbcXQYSY55REw_0D4VTQnsVzCrL7nsyjd0P7RVOI5NKJbQ75koZIalD8mqbMquP20fL3DxsWngKkOLOzoOf9sMuxlbyfkIBTsDw5WFUj-YJiI50yzgVjF8cZPHhEjkOP_PRTQXDHEq8AyWpBiJdN9SfQA/s16000/cyclist.gif") no-repeat center center;
        width: 88px;
        height: 100px;
        background-size:100%;
        bottom: 0;
        left: 38%;
        position: absolute;
        animation: slide 30s linear infinite;
    }
    
    @keyframes slide {
      0% {
        left: -25%;
      }
      100% {
        left: 100%;
      }
    }
</style>
<body>
    <footer class="footer_area bg_color">
        <div class="footer_top">
            <div class="container"> 
                <div class="row">
                    <div class="col-lg-3 col-md-6 f_widget_1">
                        <div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
                            <div class="logo-container">
                                <a href="../index.php">
                                <img src="/PHP_Project/assets/img/header_img/logo.png" alt="Logo" class="logo"></a>

                            </div>
                            <!-- <p class="logo-description"><b>SNEAKER HOME </b> là cửa hàng chuyên cung cấp các mẫu giày sneaker hiện đại, phù hợp với nhiều phong cách và độ tuổi.</p> -->
                            <!-- <div class="f_social_icon">
                                <a href="#" class="social-icon facebook"><i class="fab fa-facebook"></i></a>
                                <a href="#" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-icon github"><i class="fab fa-github"></i></a>
                                <a href="#" class="social-icon github"><i class="fab fa-youtube"></i></a>
                                <a href="#" class="social-icon github"><i class="fab fa-google"></i></a>
                            </div> -->
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="f_widget shop-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                            <h3 class="f-title f_600 t_color f_size_18">Chi nhánh</h3>
                            <ul class="list-unstyled f_list">
                                <li ><i class='fas fa-map-marker-alt'></i> 80B Lê Duẩn, Thanh Khê, Đà Nẵng</li>
                                <li ><i class='fas fa-map-marker-alt'></i> 236 Lê Duẩn, Thanh Khê, Đà Nẵng</li>
                                <li ><i class='fas fa-map-marker-alt'></i> 172 Lê Duẩn, Hải Châu, Đà Nẵng</li>
                                <!-- <li ><i class='fas fa-map-marker-alt'></i> 83 Phan Đăng Lưu, Cẩm Lệ, Đà Nẵng</li> -->
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 f_widget_3 ">
                        <div class="f_widget shop-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
                            <h3 class="f-title f_600 t_color f_size_18">Hỗ trợ khách hàng</h3>
                            <ul class="list-unstyled f_list">
                                <li><a href="#">Chính sách bảo hành</a></li>
                                <li><a href="#">Điều khoản dịch vụ</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <!-- <li><a href="#">Kiểm tra tình trạng đơn hàng</a></li>
                                <li><a href="#">Chính sách thanh toán</a></li> -->
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="f_widget shop_widget wow fadeInLeft" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                            <h3 class="f-title f_600 t_color f_size_18">Đăng ký nhận Voucher</h3>
                            <p >Đừng bỏ lỡ bất kỳ cập nhật nào về các mẫu được giảm giá của chúng tôi!</p>
                            <form action="subscribe.php" class="f_subscribe_two" method="post" novalidate="true">
                                <input type="text" name="EMAIL" class="form-control memail" placeholder="Email" required>
                                <button class="btn btn_get btn_get_two" type="submit">Đăng ký</button>
                                <!-- <p class="errmessage" style="display: none;"></p>
                                <p class="sucmessage" style="display: none;"></p> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bg">
                <div class="footer_bg_two"></div>
        </div>
    </footer>
</body>
</html>