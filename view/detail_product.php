<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Kết nối tới cơ sở dữ liệu
    include '../database/connect.php'; // File kết nối database

    // Truy vấn lấy thông tin sản phẩm và danh mục
    $query = "
        SELECT products.*, categories.name AS category_name 
        FROM products
        INNER JOIN categories ON products.category_id = categories.category_id
        WHERE products.product_id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // Kiểm tra kết quả
    if (!$product) {
        echo "Sản phẩm không tồn tại.";
        exit;
    }
} else {
    echo "Không có sản phẩm được chọn.";
    exit;
}
?>

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
<div class="product-container">
    <div class="breadcrumb">
        <a href="../index.php">Trang chủ</a> / <a href="category.php">Quần áo</a> / <span><?php echo $product['name']; ?></span>
    </div>
    <div class="product-details" style="padding-top:70px" >
        <!-- Hình ảnh sản phẩm -->
        <div class="product-image-slider">
            <div class="slide-container">
                <div class="slide">
                    <img src="../assets/img/<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                </div>
                <!-- Nếu có nhiều hình ảnh phụ, thêm các slide khác -->
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="product-info">
            <h1><?php echo $product['name']; ?></h1>
            <p class="product-price">
                <?php echo number_format($product['price'], 0, ',', '.'); ?>₫
            </p>

            <p class="stock-status">
                <?php echo $product['stock'] > 0 ? "Còn hàng" : "Hết hàng"; ?>
            </p>
            <div class="quantity-control">
                <button class="qty-btn decrement">-</button>
                <input type="text" value="1" class="quantity-input">
                <button class="qty-btn increment">+</button>
            </div>

            <div class="product-actions" style="display: flex;">
                <form action="../model/addProduct.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                    <input type="hidden" name="quantity" class="quantity-hidden"  id="quantity-hidden" value="1">
                    <button type="submit" name="add_to_cart" class="add-to-cart">Thêm vào giỏ hàng</button>
                </form>
                <button class="buy-now">Mua ngay</button>
            </div>
                <p style="padding-top:30px">Danh mục: <?php echo htmlspecialchars($product['category_name']); ?></p>
        </div>
    </div>
</div>

 <script>
    let slideIndex = 1;
    showSlide(slideIndex);

    function changeSlide(n) {
        showSlide(slideIndex += n);
    }

    function currentSlide(n) {
        showSlide(slideIndex = n);
    }

    function showSlide(n) {
        const slides = document.querySelectorAll(".slide");
        const dots = document.querySelectorAll(".dot");

        if (n > slides.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = slides.length }

        slides.forEach(slide => slide.style.display = "none");
        dots.forEach(dot => dot.classList.remove("active"));

        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].classList.add("active");
    }

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
