<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="../assets/css/detail_product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        // Kết nối đến MySQL
        include('../database/connect.php');


        // Lấy dữ liệu từ form
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $user_id = 1; // Thay bằng session user ID nếu cần
        $quantity = $_POST['quantity'];
        $created_at = date("Y-m-d H:i:s");

        // Chuẩn bị và thực thi câu lệnh SQL
        $sql = "INSERT INTO shopping_cart (cart_id, user_id, created_at, quantity, product_name) 
                VALUES (NULL, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isis", $user_id, $created_at, $quantity, $product_name);

        if ($stmt->execute()) {
            echo "<script>alert('Đã thêm vào giỏ hàng thành công!');</script>";
        } else {
            echo "<script>alert('Không thể thêm sản phẩm vào giỏ hàng.');</script>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>

    <div class="product-container">
        <div class="breadcrumb">
            <a href="#">Trang chủ</a> / <a href="#">Quần áo</a>
        </div>
        <div class="product-details" data-product-id="123">
            <div class="product-image-slider">
                <div class="slide-container">
                    <div class="slide" style="display: block !important;">
                        <img src="../assets/img/img_giay/g2.png" alt="Sản phẩm 2">
                    </div>
                </div>
            </div>
            <div class="product-info">
                <h1>Quần Nike AS M NSW Club JGGR FT 'Black'</h1>
                <p class="product-price">2.100.000₫</p>
                <p class="stock-status">Còn hàng</p>
                <div class="quantity-control">
                    <button class="qty-btn decrement">-</button>
                    <input type="text" value="1" class="quantity-input">
                    <button class="qty-btn increment">+</button>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="product_id" value="123">
                    <input type="hidden" name="product_name" value="Quần Nike AS M NSW Club JGGR FT 'Black'">
                    <input type="hidden" name="price" value="2100000">
                    <input type="hidden" name="quantity" value="1" class="quantity-input">
                    <div class="product-actions">
                    <button type="submit" name="add_to_cart" class="add-to-cart" id="add-to-cart">Thêm vào giỏ hàng</button>
                        <button type="button" class="buy-now">Mua ngay</button>
                    </div>
                </form>
                <div class="product-meta">
                    <p>Mã: Q1203</p>
                    <p>Danh mục: Quần áo</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const incrementBtn = document.querySelector(".increment");
        const decrementBtn = document.querySelector(".decrement");
        const quantityInput = document.querySelector(".quantity-input");

        incrementBtn.addEventListener("click", () => {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });

        decrementBtn.addEventListener("click", () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) quantityInput.value = currentValue - 1;
        });
    </script>
</body>
</html>