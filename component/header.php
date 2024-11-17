<?php require_once('../database/connect.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/font-aware.js"></script>
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
          <div class="col-md-1">
            <div class="p-3 d-flex justify-content-center gap-3">
              <i class="fa-solid fa-circle-user fs-2 pt-3"></i>
              <div class="h-50 "></div>
              <i class="fa-solid fa-cart-shopping fs-2 pt-3" id="cart-icon"></i>
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
