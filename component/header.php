<?php require_once('../database/connect.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/font-aware.js"></script>
    <style>
      /* Reset mặc định */
:root {
    --maincolor: #000;
    --secondary-color: #009985;
    --text-color: #333;
    --bg-color: #f9f9f9;
    --hover-bg-color: #eef7f6;
}
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    line-height: 1.6;
    background-color: var(--bg-color);
    color: var(--text-color);
}

ul, ol {
    list-style: none;
}

a {
    text-decoration: none;
    color: inherit;
}

/* Header */
header {
    background-color: var(--bg-color);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

header{
    padding: 15px 0;
}

/* Logo */
header img {
    max-width: 100%;
    height: auto;
    transition: transform 0.3s ease-in-out;
}



/* Menu chính */
.menu-pc {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.menu-pc .lv1 {
    position: relative;
    padding: 10px 15px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    color: var(--text-color);
    transition: color 0.3s ease, background-color 0.3s ease;
}

.menu-pc .lv1:hover {
    color: var(--bg-color);
    background-color: var(--maincolor);
    border-radius: 5px;
}

/* Submenu */
.wrap,
.sub-menu-2,
.sub-menu-3 {
    display: none;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 10px;
    border-radius: 4px;
    z-index: 1000;
}

.cate_hover:hover > .wrap,
.lv2:hover > .sub-menu-2,
.lv3:hover > .sub-menu-3 {
    display: block;
}

.wrap, .sub-menu-2, .sub-menu-3 {
    position: absolute;
    top: 35px;
    left: 0;
    min-width: 180px;
}

.sub-menu-2 {
    left: 120px;
    top: 0;
    width: 220px;
}

.sub-menu-3 {
    left: 180px;
    top: 0;
}

.wrap li,
.sub-menu-2 li,
.sub-menu-3 li {
    padding: 5px 10px;
    font-size: 14px;
    color: var(--text-color);
    transition: background-color 0.3s, color 0.3s;
}

.wrap li:hover,
.sub-menu-2 li:hover,
.sub-menu-3 li:hover {
    background-color: var(--maincolor);
    color: #fff;
    border-radius: 3px;
}

/* Icon caret */
.fas.fa-caret-down, 
.fas.fa-caret-right {
    margin-left: 5px;
    font-size: 12px;
    color: #777;
    transition: transform 0.3s ease, color 0.3s ease;
}

.cate_hover:hover .fas.fa-caret-down, 
.lv2:hover .fas.fa-caret-right, 
.lv3:hover .fas.fa-caret-right {
    color: var(--maincolor);
    transform: scale(1.2);
}

/* Icon và thanh ngăn cách */


.col-md-1 .p-3 i {
    
    color: var(--text-color);
    transition: color 0.3s ease, transform 0.3s ease;
    cursor: pointer;
}


/* Hiệu ứng hover icon */
.col-md-1 .p-3 i:hover {
    color: gray;
}

/* Responsive */
@media (max-width: 768px) {
    .menu-pc {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    .col-md-1 .p-3 i {
        font-size: 20px;
    }
}
 

.f {
    max-width: 330px; /* Chiều rộng tối đa */
    display: flex;
    gap: 10px; /* Khoảng cách giữa input và button */
}



/* Input tìm kiếm */
.container form input {
    border: none;
    border-radius: 25px;
    font-size: 14px;
    outline: none;
    border: none;
    width: 330px;
}

/* Hiệu ứng hover và focus cho input */
.container form input:hover, 
.container form input:focus {
    box-shadow: 0 0 5px var(--maincolor);


}

/* Nút tìm kiếm */
.container form button {
    background: var(--text-color); /* Màu chính */
    color: white; /* Màu chữ */
    border: none;
    border-radius: 50%; /* Nút hình tròn */
    width: 35px; /* Kích thước nút */
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* Hiệu ứng hover cho nút */
.container form button:hover {
    background-color: var(--maincolor); /* Màu xanh sáng hơn khi hover */
}

/* Icon tìm kiếm */
.container form button span {
    font-size: 16px; /* Kích thước icon */
}

/* Responsive chỉnh sửa */
@media (max-width: 768px) {
    .container form {
        max-width: 100%; /* Để form co giãn trên màn hình nhỏ */
        margin-right: auto; /* Căn giữa */
    }
}

.hover-area {
  position: relative;
  display: inline-block;
}

.box-notifi {
  width: 300px;
  background-color: var(--bg-color);
  color: white;
  padding: 10px;
  border-radius: 5px;
  display: block;
  position: absolute;
  top: 50px; /* Xuất hiện dưới #cart-icon */
  right: 0;
  z-index: 10;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  /* Ẩn ban đầu */
  opacity: 0;
  transition: opacity 0.3s ease, transform 0.3s ease; /* Thời gian hiệu ứng */
}

/* Tạo mũi tên tam giác */
.box-notifi::before {
  content: "";
  position: absolute;
  top: -19px; /* Đặt mũi tên ngay trên hộp thông báo */
  right: 6px; /* Căn chỉnh vị trí theo chiều ngang */
  border-width: 10px; /* Kích thước mũi tên */
  border-style: solid;
  border-color: transparent transparent var(--maincolor) transparent; /* Mũi tên chỉ xuống */
}

/* Hiệu ứng khi hover */
.hover-area:hover .box-notifi {
  opacity: 1; /* Hiện ra */
  transform: translateY(0); /* Trả về vị trí ban đầu */
}
.box-notifi h2{
  color: var(--maincolor)
}

    </style>
</head>
<body>
  <header>
    <div class="container">
      <div class="row">
          <div class="col-md-2">
            <div class="pt-2">
              <a href="header.php"><img src="../assets/img/header_img/logo.png" class="img-fluid w-80" alt="Logo cửa hàng"></a>
              
            </div>
          </div>
          <div class="col-md-9">
            <div class="p-3">
              <div class="container-fluid pt-1">
                <div class="d-none d-lg-flex justify-content-center">
                  <ul class="nav menu-pc gap-3 fs-4">
                    <li class="lv1 cate_hover">
                      Accessories
                      <i class="fas fa-caret-down"></i>
                      <ul class="wrap">
                        <li class="lv2">Phụ kiện 
                          <i class="fas fa-caret-right"></i>
                          <ul class="sub-menu-2">
                            <li class="lv3">Mũ</li>
                            <li class="lv3">Dép<i class="fas fa-caret-right"></i>
                              <ul class="sub-menu-3">
                                <li class="lv4">Dép Nike</li>
                                <li class="lv4">Dép Adidas</li>
                                <li class="lv4">Dép MLB</li>
                              </ul>
                            </li>
                            <li class="lv3">Tất</li>
                            <li class="lv3">Kính</li>
                          </ul>
                        </li>
                        <li class="lv2 balo">Balo
                          <i class="fas fa-caret-right"></i>
                          <ul class="sub-menu-2">
                            <li class="lv3">Herschel</li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="lv1 cate_hover">Giày<i class="fas fa-caret-down"></i>
                      <ul class="wrap">
                        <li class="lv2">Giày Puma <i class="fas fa-caret-right"></i>
                          <ul class="sub-menu-2">
                            <li class="lv3">Puma Mule</li>
                            <li class="lv3">Puma RS</li>
                          </ul>
                        </li>
                        <li class="lv2">Giày Nike 
                          <i class="fas fa-caret-right"></i>
                          <ul class="sub-menu-2">
                            <li class="lv3">Air Max<i class="fas fa-caret-right"></i>
                              <ul class="sub-menu-3">
                                <li class="lv4">Air Max 1</li>
                                <li class="lv4">Air Max 90</li>
                              </ul>
                            </li>
                            <li class="lv3">Air Zoom</li>
                          </ul>
                        </li>
                        <li class="lv2">Giày Adidas</li>
                      </ul>
                    </li>
                    <li class="lv1 cate_hover">Yêu thích</li>
                    <li class="lv1 cate_hover">Quần áo</li>
                    <li class="lv1 cate_hover">Khuyến mại</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
            <div class="col-md-1 position-relative">
              <div class="p-3 d-flex justify-content-center gap-3">
                <i class="fa-solid fa-circle-user fs-2 pt-3"></i>
                <div class="h-50"></div>
                <!-- Gói cart-icon và box-notifi trong container -->
                <div class="hover-area position-relative">
                  <i class="fa-solid fa-cart-shopping fs-2 pt-3 " id="cart-icon"></i>
                  <div class="box-notifi">
                    <h2 class="d-flex justify-content-center">Giỏ hàng</h2>
                    <div id="cart-content">
                    <!-- Nội dung giỏ hàng sẽ được chèn vào đây thông qua JavaScript -->
                    <!-- <p class="text-center text-muted">Đang tải dữ liệu...</p> -->
                </div>
                  </div>
                </div>
              </div>  
            </div>
      </div>
    </div>


    <div class="container f">
      <form action="" method="get" class="d-flex form-group " role="search">
        <input type="text" name="q" placeholder="Tìm kiếm sản phẩm" class="button_gradient form-control text-center  ">
            <button type="submit" class="btn p-0">
            <span class="fas fa-search"></span>
        </button>
      </form>
    </div>
  </header>
</body>
</html>
