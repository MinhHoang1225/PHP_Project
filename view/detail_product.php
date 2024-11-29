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

        // Kiểm tra sản phẩm có tồn tại trong bảng products không
        $product_check_sql = "SELECT COUNT(*) FROM products WHERE product_id = ?";
        $product_check_stmt = $conn->prepare($product_check_sql);
        $product_check_stmt->bind_param("i", $product_id);
        $product_check_stmt->execute();
        $product_check_stmt->bind_result($product_exists);
        $product_check_stmt->fetch();
        $product_check_stmt->close();

        if ($product_exists == 0) {
            echo "<script>alert('Sản phẩm không tồn tại trong hệ thống!');</script>";
            exit;
        }

        // Kiểm tra xem người dùng đã có giỏ hàng chưa
        $check_cart_sql = "SELECT cart_id FROM shopping_cart WHERE user_id = ? AND status = 'active'";
        $check_cart_stmt = $conn->prepare($check_cart_sql);
        $check_cart_stmt->bind_param("i", $user_id);
        $check_cart_stmt->execute();
        $check_cart_stmt->bind_result($cart_id);
        $check_cart_stmt->fetch();
        $check_cart_stmt->close();

        if (!$cart_id) {
            // Nếu không có giỏ hàng, tạo giỏ hàng mới
            $sql_create_cart = "INSERT INTO shopping_cart (user_id, created_at) VALUES (?, ?)";
            $stmt_create_cart = $conn->prepare($sql_create_cart);
            $stmt_create_cart->bind_param("is", $user_id, $created_at);
            $stmt_create_cart->execute();
            $cart_id = $stmt_create_cart->insert_id; // Lấy cart_id vừa tạo
            $stmt_create_cart->close();
        }

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $sql_check_cart_items = "SELECT quantity FROM cart_items WHERE cart_id = ? AND product_id = ?";
            $stmt_check_cart_items = $conn->prepare($sql_check_cart_items);
            $stmt_check_cart_items->bind_param("ii", $cart_id, $product_id);
            $stmt_check_cart_items->execute();
            $stmt_check_cart_items->bind_result($existing_quantity);
            $stmt_check_cart_items->fetch();
            $stmt_check_cart_items->close();

        if ($existing_quantity > 0) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
            $sql_update_quantity = "UPDATE cart_items SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?";
            $stmt_update_quantity = $conn->prepare($sql_update_quantity);
            $stmt_update_quantity->bind_param("iii", $quantity, $cart_id, $product_id);
            $stmt_update_quantity->execute();
            $stmt_update_quantity->close();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
            $sql_add_to_cart = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmt_add_to_cart = $conn->prepare($sql_add_to_cart);
            $stmt_add_to_cart->bind_param("iii", $cart_id, $product_id, $quantity);
            $stmt_add_to_cart->execute();
            $stmt_add_to_cart->close();
        }

        $conn->close();
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
                <input type="hidden" name="product_id" value="7">
                <input type="hidden" name="product_name" value="Quần Nike AS M NSW Club JGGR FT 'Black'">
                <input type="hidden" name="price" value="2100000">
                <input type="hidden" name="quantity" id="quantity-hidden" value="1"> <!-- Lưu quantity vào hidden input -->
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
    const hiddenQuantityInput = document.getElementById("quantity-hidden");

    incrementBtn.addEventListener("click", () => {
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
        hiddenQuantityInput.value = quantityInput.value; // Cập nhật giá trị hidden input
    });

    decrementBtn.addEventListener("click", () => {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            hiddenQuantityInput.value = quantityInput.value; // Cập nhật giá trị hidden input
        }
    });

    quantityInput.addEventListener("input", () => {
        hiddenQuantityInput.value = quantityInput.value; // Cập nhật giá trị khi người dùng nhập
    });
</script>
</body>
</html>
