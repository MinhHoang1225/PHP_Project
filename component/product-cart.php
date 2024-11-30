<?php

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
    <script src="../assets/js/navigation.js"></script>

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
                                <!-- RENDER DATABASE -->
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
                                        <input type="number" min="1" max="5000" value="<?php echo $row['cart_quantity'] ?>" class="item-quantity" data-id="<?php echo $row['cart_id']; ?>" onchange="updateQuantity(this,'<?php echo $row['product_id']; ?>','<?php echo $row['cart_id']; ?>')">
                                    </td>
                                    <td class="price"><?php echo number_format($row['product_price'], 0, ',', '.'); ?> đ</td>
                                    <td class="remove">
                                        <a href="javascript:void(0)" 
                                            onclick="confirmDelete('<?php echo $row['product_id']; ?>', '<?php echo $row['cart_id']; ?>')">
                                                <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center'>Giỏ hàng của bạn đang trống. <a href='/shop'> </br> <i class='fa fa-reply' aria-hidden='true'></i>Mua sắm ngay</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- TOTAL -->
                    <div class="total-checkout">
                        <div class="box-totalMoney">
                            <span>Tổng tiền : </span>
                            <span class="text-bold"><?php echo number_format($total, 0, ',', '.'); ?> đ</span>
                        </div>
                        <div class="cart-buttons buttons">
                            <a href="../index.php">
                                <button type="button" id="update-cart" class="button-default">
                                    <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm
                                </button>

                            </a>
                            <button type="button" id="checkout" class="button-default" onclick="navigateTo('./component/checkout.php')">
                                Thanh toán
                            </button>
                        </div>

                    </div>
        
                </div>
        </div>

    </div>
</body>
</html>
<!-- Xoá sản phẩm -->
<script>
    function confirmDelete(productId, cartId) {
        // Hiển thị hộp thoại xác nhận
        const isConfirmed = confirm("Bạn có chắc chắn muốn xoá sản phẩm khỏi giỏ hàng không?")
        if(isConfirmed) {
            // Nếu người dùng xác nhận, chuyển hướng đến tệp PHP xử lý xoá
            window.location.href = `./delete-product-cart.php?product_id=${productId}&cart_id=${cartId}`;
        }
    }

    // <!-- Cập nhật số lượng Sản phẩm -->
    function updateQuantity(inputQuantity, productId, cartId) {
        const newQuantity = inputQuantity.value;

        // Kiểm tra số lượng nhập có hợp lệ không
        if (newQuantity <= 0) {
            alert("Số lượng không hợp lệ!");
            return;
        }

        // Gửi dữ liệu qua fetch API
        fetch(`./update-cart.php?product_id=${productId}&cart_id=${cartId}&new_quantity=${newQuantity}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật tổng tiền mới
                    document.querySelector(".box-totalMoney .text-bold").textContent = data.total_price;

                    // Có thể cập nhật các mục khác nếu cần
                    console.log("Cập nhật thành công!");
                } else {
                    alert(data.error || "Cập nhật thất bại.");
                }
            })
            .catch(error => console.error("Lỗi khi cập nhật: ", error));
    }

    // Cập nhật số lượng và làm mất focus khi nhấn Enter
        document.querySelectorAll('.item-quantity').forEach(input => {
            input.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    const productId = input.dataset.id;
                    const cartId = input.closest('tr').querySelector('.remove').dataset.cartId;
                    updateQuantity(input, productId, cartId);
                    input.blur(); // Làm mất focus khỏi input
                }
            });
        });

 </script>


