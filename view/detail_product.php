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
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng!');</script>";
    }
?>

<div class="product-container">
    <div class="breadcrumb">
        <a href="#">Trang chủ</a> / <a href="#">Quần áo</a>
    </div>
    <div class="product-details" data-product-id="7">
        <div class="product-image-slider">
            <div class="slide-container">
                <div class="slide" style="display: block;">
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
            <form action="../model/addProduct.php" method="POST">
                <input type="hidden" name="product_id" value="17">
                <input type="hidden" name="product_name" value="Giày Puma Slip on Bale Bari Mule 'White'">
                <input type="hidden" name="price" value="2100000">
                <input type="hidden" name="quantity" id="quantity-hidden" value="1"> <!-- Lưu quantity vào hidden input -->
                <input type="hidden" name="redirect_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div class="product-actions">
                    <button type="submit" name="add_to_cart" class="add-to-cart">Thêm vào giỏ hàng</button>
                    <button class="buy-now">Mua ngay</button>

                </div>
                <button class="contact-btn">Liên hệ chúng tôi</button>
            </form>
        </div>
    </div>
</div>

<script>
    const incrementBtn = document.querySelector(".increment");
    const decrementBtn = document.querySelector(".decrement");
    const quantityInput = document.querySelector(".quantity-input");
    const hiddenQuantityInput = document.getElementById("quantity-hidden");

    incrementBtn.addEventListener("click", () => {
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
        hiddenQuantityInput.value = quantityInput.value;
    });

    decrementBtn.addEventListener("click", () => {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            hiddenQuantityInput.value = quantityInput.value;
        }
    });

    quantityInput.addEventListener("input", () => {
        hiddenQuantityInput.value = quantityInput.value;
    });
</script>

</body>
</html>
