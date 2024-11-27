<?php
    session_start();
    error_reporting(E_ALL ^ E_DEPRECATED);

    include '../database/connect.php';
    /**
     * 1. Lấy dữ liệu từ sản Phẩm sau đó so sảnh với id order -> lưu shopping cart
     * 2. Lấy dữ liệu từ shopping cart -> render ra trang giỏ hàng
     * 
     */
    
         // Lấy dữ liệu giỏ hàng
    $cart_sql = "SELECT 
            shopping_cart.cart_id AS cart_id,
            products.product_id AS product_id,
            products.name AS product_name,
            products.price AS product_price,
            products.img AS product_image,
            cart_items.quantity AS cart_quantity,
            (products.price * cart_items.quantity) AS total_price
        FROM shopping_cart
        INNER JOIN cart_items ON shopping_cart.cart_id = cart_items.cart_id
        INNER JOIN products ON cart_items.product_id = products.product_id";
    $cart_stmt = $conn->prepare($cart_sql);
    $cart_stmt->execute();
    $cart_result = $cart_stmt->get_result();
    // Total cart
    $total = 0;

?>


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
                                <?php
                                   
                                   if ($cart_result->num_rows > 0) {
                                    while ($row = $cart_result->fetch_assoc()) {
                                        $total += $row['total_price'];
                                        
                                    
                                ?>
                                <tr class="item">
                                    <td class="image">
                                        <div class="product-image">
                                            <a href="http://t0239.store.nhanh.vn/cart"> 
                                                <img src="../assets./img/<?php echo $row['product_image']?>" alt="<?php echo $row['product_name'] ?>" data-sizes="auto" style="font-size: 16px">
                                            </a>
                                        </div>
                                    </td>
                                    <td class="product-Name">
                                        <a href="http://t0239.store.nhanh.vn/cart">
                                           <span class="text-hover"><?php echo $row['product_name'] ?></span>
                                        </a>
                                    </td>
                                    <td class="qty">
                                        <input type="number" min="1" max="5000" value="<?php echo $row['cart_quantity'] ?>" class="item-quantity" data-id="37960161">
                                    </td>
                                    <td class="price"><?php echo number_format($row['product_price'], 0, ',', '.'); ?> đ</td>
                                    <td class="remove">
                                        <a href="http://t0239.store.nhanh.vn/cart">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    }else {
                                        echo "<tr><td colspan='5' class='text-center'>Giỏ hàng của bạn đang trống. <a href='/shop'><i class='fa fa-reply' aria-hidden='true'></i>Mua sắm ngay</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="total-checkout">
                        <div class="box-totalMoney">
                            <span>Tổng tiền : </span>
                            <span class="text-bold"><?php echo number_format($total, 0, ',', '.'); ?> đ</span>
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