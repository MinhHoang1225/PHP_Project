<?php include($_SERVER['DOCUMENT_ROOT'] . "/PHP_Project/database/connect.php"); ?>
<?php
  $cart_id = 1; 
  $cart_sql = "SELECT 
    shopping_cart.cart_id AS cart_id,
    products.product_id AS product_id,
    products.name AS product_name,
    products.price AS product_price,
    products.img AS product_img,
    cart_items.quantity AS cart_quantity,
    (products.price * cart_items.quantity) AS total_price
  FROM shopping_cart
  INNER JOIN cart_items ON shopping_cart.cart_id = cart_items.cart_id
  INNER JOIN products ON cart_items.product_id = products.product_id";
  $stmt = $conn->prepare($cart_sql);
  if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
  }
  $stmt->execute();
  $result = $stmt->get_result();

 ?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" type="" href="root/root.css">
    <link rel="stylesheet" type="" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/font-aware.js"></script>
    <style>
    :root {
    --bg-header: #e5e5e5;
    --bg-btn: #0c6478;
    --bg-hover-btn: #159198;
    --main-font: sans-serif;
    --main-color: black;
    --second-color: #666666B3;
    --title-text-size: 32px;
    --main-text-size: 16px;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    line-height: 1.6;
    background-color: var(--bg-header);
    color: var(--main-color);
}

ul, ol {
    list-style: none;
}

a {
    text-decoration: none;
    color: inherit;
}

header {
    background-color: var(--bg-header);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 15px 0;
}

header img {
    max-width: 100%;
    height: auto;
    transition: transform 0.3s ease-in-out;
}

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
    color: var(--main-color);
    transition: color 0.3s ease, background-color 0.3s ease;
}

.menu-pc .lv1:hover {
    color: var(--bg-header);
    background-color: var(--bg-hover-btn);
    border-radius: 5px;
}

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
    background-color: var(--bg-hover-btn);
    color: var(--bg-header);
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
    color: var(--main-color);
    transition: background-color 0.3s, color 0.3s;
}

.wrap li:hover,
.sub-menu-2 li:hover,
.sub-menu-3 li:hover {
    background-color: var(--main-color);
    color: var(--bg-header);
    border-radius: 3px;
}

.fas.fa-caret-down, 
.fas.fa-caret-right {
    margin-left: 5px;
    font-size: 12px;
    transition: transform 0.3s ease, color 0.3s ease;
}

.cate_hover:hover .fas.fa-caret-down, 
.lv2:hover .fas.fa-caret-right, 
.lv3:hover .fas.fa-caret-right {
    color: var(--bg-header);
    transform: scale(1.2);
}

.cate_hover:hover,
.lv2:hover,
.lv3:hover {
    background-color: var(--bg-hover-btn);
}

.col-md-1 .p-3 i {
    transition: color 0.3s ease, transform 0.3s ease;
    cursor: pointer;
}

.col-md-1 .p-3 i:hover {
    color: var(--bg-hover-btn);
}

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
    max-width: 330px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.container form input {
    border: none;
    border-radius: 25px;
    font-size: 14px;
    outline: none;
    width: 330px;
}

.container form input:hover, 
.container form input:focus {
    box-shadow: 0 0 5px var(--bg-hover-btn);
}

.container form button {
    background: var(--main-color);
    color: white;
    border: none;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.container form button:hover {
    background-color: var(--bg-hover-btn);
    color: var(--bg-header);
}

.container form button span {
    font-size: 16px;
}

@media (max-width: 768px) {
    .container form {
        max-width: 100%;
        margin-right: auto;
    }
}

.hover-area {
    position: relative;
    display: inline-block;
}

.box-notifi {
    width: 500px;
    color: white;
    padding: 10px;
    border-radius: 5px;
    position: absolute;
    top: 50px;
    right: 0;
    z-index: 1;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-height: 400px;
    overflow-y: auto;
    display: block; 
    opacity: 0;
    visibility: hidden; 
    transition: opacity 0.3s ease, visibility 0.3s ease;
    background-color: var(--bg-header);
    color: var(--main-color);
}

.box-notifi::before {
    content: "";
    position: absolute;
    top: -19px;
    right: 6px;
    border-width: 10px;
    border-style: solid;
    border-color: transparent transparent var(--bg-hover-btn) transparent;
}

.hover-area:hover .box-notifi {
    opacity: 1; /* Hiển thị với hiệu ứng mờ dần */
    visibility: visible; /* Cho phép hiển thị */
}

.box-notifi h2 {
    color: var(--bg-header);
}


.product {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 15px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.product:hover {
    transform: translateY(-5px);
}

.product-img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
}

.product-info {
    flex-grow: 1;
    margin-left: 20px;
}

.product-name {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 8px;
}

.product-price {
    font-size: 16px;
    color: #f56c42;
    margin-bottom: 8px;
}

.product-quantity {
    font-size: 14px;
    color: #777;
    margin-bottom: 8px;
}

.cart_btn {
    background-color: var(--bg-btn); 
    color: var(--bg-header); 
    border: none; 
    border-radius: 50px; 
    padding: 10px 20px; 
    font-size: 16px; 
    font-weight: bold;
    cursor: pointer; 
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
}

.cart_btn:hover {
    background-color: var(--bg-hover-btn); 
    color: var(--bg-header); 
    transform: scale(1.05); 
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

.hover-area {
    position: relative;
    display: inline-block;
}

.cart-count {
    top: 0;
    right: 0;
    transform: translate(50%, -50%);
    position: absolute;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 5px 10px;
    font-size: 14px;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
}


</style>
</head>
<body>
  <header>
    <div class="container">
      <div class="row">
          <div class="col-md-2">
            <div class="pt-2">
              <img src="/PHP_Project/assets/img/header_img/logo.png" class="img-fluid w-80" alt="Logo cửa hàng" onclick="navigateTo('./index.php')"></a>
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
                    <li class="lv1 cate_hover" onclick="navigateTo('./view/favorite_product.php')">Yêu thích</li>
                    <li class="lv1 cate_hover">Quần áo</li>
                    <li class="lv1 cate_hover" onclick="navigateTo('./view/discount.php')">Khuyến mại</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
            <div class="col-md-1 position-relative">
              <div class="p-3 d-flex justify-content-center gap-3">
                <i class="fa-solid fa-circle-user fs-2 pt-3 " onclick="navigateTo('./model/register_login.php')"></i>
                <div class="h-50"></div>
                <!-- Gói cart-icon và box-notifi trong container -->
                <div class="hover-area position-relative">
                  <i class="fa-solid fa-cart-shopping fs-2 pt-3 " id="cart-icon"></i>
                  <div class="box-notifi">
                    <div id="cart-content">
                      <h2 style="text-align: center;padding:15px;color: var(--main-color)">Giỏ hàng</h2>
                        <?php 
                          if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                  // Hiển thị thông tin sản phẩm trong một div
                                  echo '<div class="product">';
                                  
                                  // Hiển thị hình ảnh nếu có
                                  if (!empty($row['product_img'])) {
                                      echo '<img src="/PHP_Project/assets/img/' . $row['product_img'] . '" alt="Product Image" class="product-img">';
                                  } else {
                                      echo '<p>No image</p>';
                                  }

                                  // Hiển thị thông tin sản phẩm
                                  echo '<div class="product-info">';
                                  echo '<h3 class="product-name">' . $row['product_name'] . '</h3>';
                                  echo '<p class="product-price">' . number_format($row['product_price'], 0, ',', '.') . ' VND</p>';
                                  echo '<p class="product-quantity">Quantity: ' . $row['cart_quantity'] . '</p>';
                                  echo '</div>';
                                  
                                  echo '</div><br>';
                              }
                          } else {
                              echo "No data found!";
                          }
                        ?>
                        <button class="cart_btn">Giỏ hàng</button>
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
  <script src="assets\js\main.js">
</script>
</script>

</body>
</html>
