<?php include($_SERVER['DOCUMENT_ROOT'] . "/PHP_Project/database/connect.php"); ?><?php
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
INNER JOIN products ON cart_items.product_id = products.product_id
WHERE shopping_cart.user_id = 1;"
  ;
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
    <link rel="stylesheet" type="" href="../root/root.css">
    <link rel="stylesheet" type="" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/font-aware.js"></script>
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
.search-results {
  position: absolute;
  background: white;
  border: 1px solid #ddd;
  max-height: 300px;
  overflow-y: auto;
  width: 500px;
  z-index: 9999;
  margin-left: 300px;
  margin-top: 50px;
}

.search_inf {
  display: flex;
  padding: 10px;
  text-decoration: none;
  color: black;
  border-bottom: 1px solid #eee;
}

.search_inf:hover {
  background-color: #f5f5f5;
}

.result_img img {
  width: 50px;
  height: 50px;
}

.search_name span {
  font-size: 16px;
}

.search_price {
  font-size: 14px;
}
.user-icon-container {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.user-dropdown {
    position: absolute;
    top: 120%; 
    right: 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
    padding: 10px; 
    display: none; 
    z-index: 10;
    min-width: 400px; 
    max-height: 300px; 
    overflow-y: auto; 
    scrollbar-width: thin; 
    scrollbar-color: #ccc transparent; 
}

.user-dropdown p, .user-dropdown a, .user-dropdown button {
    display: block;
    text-decoration: none;
    color: #333;
    padding: 10px 10px;
    margin: 8px 0;
    font-size: 16px;
    border: none;
    background: none;
    cursor: pointer;
    text-align: left;
}

.user-dropdown button:hover {
    color: red;
}

.user-dropdown::-webkit-scrollbar {
    width: 8px; 
}

.user-dropdown::-webkit-scrollbar-thumb {
    background-color: #ccc; 
    border-radius: 5px; 
}

.user-dropdown::-webkit-scrollbar-thumb:hover {
    background-color: #aaa; 
}

.user-dropdown::-webkit-scrollbar-track {
    background-color: transparent; 
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
                    <li class="lv1 cate_hover" onclick="navigateTo('./index.php')">Trang chủ</li>
                    <li class="lv1 cate_hover" onclick="navigateTo('./view/accessores.php')">Sản phẩm</li>
                    <li class="lv1 cate_hover" onclick="navigateTo('./view/accesory.php')">Phụ kiện </li>  
                    <li class="lv1 cate_hover" onclick="navigateTo('./view/shoe.php')">Giày</li>
                    <li class="lv1 cate_hover" onclick="navigateTo('./view/clother.php')">Quần áo</li>
                    <li class="lv1 cate_hover" onclick="navigateTo('./view/favorite_product.php')">Yêu thích</li>
                    <li class="lv1 cate_hover" onclick="navigateTo('./view/discount.php')">Khuyến mại</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
            <div class="col-md-1 position-relative">
              <div class="p-3 d-flex justify-content-center gap-3">
                <!-- <i class="fa-solid fa-circle-user fs-2 pt-3 " onclick="navigateTo('./model/register_login.php')"></i> -->
                <div class="user-icon-container">
                    <i class="fa-solid fa-circle-user fs-2 pt-3" id="user-icon"></i>
                    <div class="user-dropdown" id="user-dropdown">
                        <!-- Nội dung sẽ được thêm động qua JavaScript -->
                    </div>
                </div>
                <div class="h-50"></div>
                <!-- Gói cart-icon và box-notifi trong container -->
                <div class="hover-area position-relative">
                  <i class="fa-solid fa-cart-shopping fs-2 pt-3 " id="cart-icon" onclick="navigateTo('./component/product-cart.php')" ></i>
                  <div class="box-notifi">
                    <div id="cart-content">
                      <h2 style="text-align: center;padding:15px;color: var(--main-color)">Giỏ hàng</h2>
                        <?php 
                          if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                  // Hiển thị thông tin sản phẩm trong một div
                                  echo '<div class="product">';
                                  
                                  // Hiển thị hình ảnh nếu có
                                  echo '<a href="./view/detail_product.php?id=' . $row['product_id'] . '">';
                                  if (!empty($row['product_img'])) {
                                      echo '<img src="/PHP_Project/assets/img/' . $row['product_img'] . '" alt="Product Image" class="product-img">';
                                  } else {
                                      echo '<p>No image</p>';
                                  }
                                  echo '</a>';
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
                        <button class="cart_btn"  onclick="navigateTo('./component/product-cart.php')">Giỏ hàng</button>
                    </div>
                  </div>
                </div>
              </div>  
            </div>
      </div>
    </div>

    <div class="container f">
  <form action="" method="get" class="d-flex form-group" role="search">
    <input 
      type="text" 
      name="q" 
      placeholder="Tìm kiếm sản phẩm" 
      class="button_gradient form-control text-center" 
      oninput="fetchSuggestions()" 
      autocomplete="off"
      id="searchInput"
    >
    <button type="submit" class="btn p-0">
      <span class="fas fa-search"></span>
    </button>
  </form>
  <div class="search-results" id="suggestionsList" style="display: none;"></div>
</div>
  </header>
  <script src="../assets/js/main.js">
</script>
<script>
 document.addEventListener("DOMContentLoaded", () => {
    const userIcon = document.getElementById("user-icon");
    const userDropdown = document.getElementById("user-dropdown");
    fetch("../component/fetch_user_info.php")
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const user = data.user;
                userDropdown.innerHTML = `
                    <p><strong>Tên người dùng:</strong> ${user.username}</p>
                    <p><strong>Email:</strong> ${user.email}</p>
                    <p><strong>Mật khẩu:</strong> ${user.password}</p>
                    <button id="logout-btn">Đăng xuất</button>
                    <hr>
                    <div id="order-history">
                        <p><strong>Lịch sử đơn hàng:</strong></p>
                        <ul id="orders-list">
                            <li>Đang tải...</li>
                        </ul>
                    </div>
                `;
                fetch("../component/fetch_orders.php", {
                    method: "POST",
                })
                    .then(response => response.json())
                    .then(orderData => {
                        const ordersList = document.getElementById("orders-list");

                        if (orderData.status === 'success') {
                            ordersList.innerHTML = '';
                            orderData.orders.forEach(order => {
                                ordersList.innerHTML += `
                                    <li>
                                        <strong>Order ID:</strong> ${order.order_id}<br>
                                        <strong>Total Amount:</strong> $${order.total_amount}<br>
                                        <strong>Status:</strong> ${order.status}<br>
                                        <strong>Date:</strong> ${order.order_date}
                                    </li>
                                    <hr>
                                `;
                            });
                        } else if (orderData.status === 'empty') {
                            ordersList.innerHTML = '<li>Chưa có đơn hàng nào.</li>';
                        }
                    })
                    .catch(err => console.error("Error fetching orders:", err));

                // Hiển thị dropdown khi click vào icon
                userIcon.addEventListener("click", () => {
                    userDropdown.style.display =
                        userDropdown.style.display === "block" ? "none" : "block";
                });

                // Xử lý sự kiện đăng xuất
                document.getElementById("logout-btn").addEventListener("click", () => {
                    document.cookie = "is_login=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "user_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "user_role=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    alert("Bạn đã đăng xuất!");
                    window.location.reload();
                });
            } else {
                // Chuyển hướng nếu chưa đăng nhập
                userIcon.addEventListener("click", () => {
                    window.location.href = "../model/register_login.php";
                });
            }
        })
        .catch(error => console.error("Error fetching user info:", error));
});
function fetchSuggestions() {
    const input = document.getElementById('searchInput').value.trim();
    const suggestionBox = document.getElementById('suggestionsList');

    if (input.length === 0) {
      suggestionBox.style.display = 'none';
      suggestionBox.innerHTML = '';
      return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../component/suggestions.php', true); // Gửi request tới file suggestions.php
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
      if (xhr.status === 200) {
        suggestionBox.innerHTML = xhr.responseText;
        suggestionBox.style.display = 'block';
      }
    };

    xhr.send('query=' + encodeURIComponent(input));
  }

  document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput');
  const searchButton = document.querySelector('.btn[type="submit"]');

  searchButton.addEventListener('click', function (event) {
    const query = searchInput.value.trim(); 
    if (query.length > 0) {
      const searchUrl = `../view/accessores.php?category_name=${encodeURIComponent(query)}`;
      window.location.href = searchUrl;
    } else {
      alert('Vui lòng nhập từ khóa tìm kiếm.');
    }
    event.preventDefault(); 
  });
});
</script>
</body>
</html>
