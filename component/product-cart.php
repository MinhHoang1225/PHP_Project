<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-pro">
        <div class="product-cart col-12 py-4" id="layout-page">
            <div class="main-title  mt-2 mb-5">
                <h3 class="text-center">Giỏ hàng</h3>
            </div>
            <div id="cartformpage" class="pb30">
                <table class="cart-hidden">
                    <theader>
                        <tr>
                            <th class="image">Hình ảnh</th>
                            <th class="product-Name">Sản phẩm</th>
                            <th class="qty">Số lượng</th>
                            <th class="price">Giá tiền</th>
                            <th class="remove">Xoá</th>
                        </tr>
                    </theader>
                    <tbody>
                        <tr class="item">
                            <td class="image">
                                <div class="product-image">
                                    <a href="http://t0239.store.nhanh.vn/cart">
                                        <img src="../assets/img/tải xuống.jpg" alt="áo">
                                    </a>
                                </div>
                            </td>
                            <td class="product-Name">
                                <a href="http://t0239.store.nhanh.vn/cart">
                                   <span>Áo Polo Fear Of God Essentials SS Polo String - S</span>
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
            <div class="box-totalMoney text-center text-sm-right my-4">
                <span>Tổng tiền : </span>
                <span class="font-weight-bold">1.350.000đ</span>
            </div>
            <div class="cart-buttons text-center">
                <button type="button" id="update-cart" class="button-default font-weight-bold text-uppercase">
                    <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm
                </button>
                <button type="button" id="checkout" class="button-default font-weight-bold text-uppercase">
                    Thanh toán
                </button>
            </div>

        </div>
    </div>
</body>
</html>