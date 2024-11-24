<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../assets/css/product-cart.css">
    <script src="..\assets\js\font-aware.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div id="cart">
        <div class="container-pre">
                <div class="product-cart col-12 py-4" id="layout-page">
                    <div class="main-title  mt-2 mb-5">
                        <h3 class="text-center">Giỏ hàng</h3>
                    </div>
                    <div id="cartformpage" class="pb30">
                        <table class="cart cart-hidden">
                            <thead>
                                <tr>
                                    <th class="image">Hình ảnh</th>
                                    <th class="product-Name">Sản phẩm</th>
                                    <th class="qty">Số lượng</th>
                                    <th class="price">Giá tiền</th>
                                    <th class="remove">Xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="item">
                                    <td class="image">
                                        <div class="product-image">
                                            <a href="http://t0239.store.nhanh.vn/cart">
                                                <img src="../assets/img/tải xuống.jpg" alt="áo" data-sizes="auto" sizes="102px">
                                            </a>
                                        </div>
                                    </td>
                                    <td class="product-Name">
                                        <a href="http://t0239.store.nhanh.vn/cart">
                                           <span class="text-hover">Áo Polo Fear Of God Essentials SS Polo String - S</span>
                                        </a>
                                    </td>
                                    <td class="qty">
                                        <input type="number" min="1" max="5000" value="1" class="item-quantity" data-id="37960161">
                                    </td>
                                    <td class="price">1.350.000 đ</td>
                                    <td class="remove">
                                        <a href="http://t0239.store.nhanh.vn/cart">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="total-checkout">
                        <div class="box-totalMoney">
                            <span>Tổng tiền : </span>
                            <span class="text-bold">1.350.000đ</span>
                        </div>
                        <div class="cart-buttons buttons">
                            <button type="button" id="update-cart" class="button-default">
                                <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm
                            </button>
                            <button type="button" id="checkout" class="button-default">
                                Thanh toán
                            </button>
                        </div>

                    </div>
        
                </div>
        </div>

    </div>
</body>
</html>