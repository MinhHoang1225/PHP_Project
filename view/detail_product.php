<?php
// Kết nối tới cơ sở dữ liệu
include '../database/connect.php'; // File kết nối database

// Kiểm tra nếu có tham số `id` được truyền qua URL
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Lấy `product_id` từ URL

    // Kiểm tra xem sản phẩm có tồn tại trong bảng `products`
    $query = "SELECT product_id FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Nếu sản phẩm không tồn tại
        echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
        exit;
    }

    // Truy vấn thông tin sản phẩm (bao gồm category_name)
    $query = "SELECT products.*, categories.name as category_name FROM products INNER JOIN categories ON products.category_id = categories.category_id WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // Nếu sản phẩm không tồn tại (lặp lại check từ đầu)
    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Không có sản phẩm được chọn']);
    exit;
}

// Nhận dữ liệu JSON từ frontend
$data = json_decode(file_get_contents('php://input'), true);

// Lấy thông tin từ request
$quantity = intval($data['quantity-input'] ?? 1); // Lấy số lượng, mặc định là 1
$user_id = 1; // Giả định user_id = 1 (thay bằng session user_id nếu có đăng nhập)

// Kiểm tra điều kiện hợp lệ
if ($quantity > 0 && $product['stock'] > 0) {
    // Kiểm tra nếu người dùng đã có giỏ hàng
    $query = "SELECT cart_id FROM shopping_cart WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = $result->fetch_assoc();

    if (!$cart) {
        // Nếu chưa có giỏ hàng, tạo mới
        $query = "INSERT INTO shopping_cart (user_id) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $cart_id = $stmt->insert_id;
    } else {
        // Nếu đã có giỏ hàng, lấy cart_id
        $cart_id = $cart['cart_id'];
    }

    // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
    $query = "SELECT cart_item_id, quantity FROM cart_items WHERE cart_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $cart_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existing_item = $result->fetch_assoc();

    if ($existing_item) {
        // Cập nhật số lượng nếu sản phẩm đã tồn tại
        $new_quantity = $existing_item['quantity'] + $quantity;
        $query = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $new_quantity, $existing_item['cart_item_id']);
        $stmt->execute();
    } else {
        // Thêm sản phẩm mới vào giỏ hàng
        $query = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iii', $cart_id, $product_id, $quantity);
        $stmt->execute();
    }

    // Phản hồi JSON thành công
    // echo json_encode(['success' => true, 'message' => 'Thêm vào giỏ hàng thành công']);
} else {
    // Phản hồi lỗi nếu không hợp lệ
    echo json_encode(['success' => false, 'message' => 'Sản phẩm hết hàng hoặc số lượng không hợp lệ']);
}

// Đóng kết nối
$conn->close();
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="../assets/css/detail_product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    
    </style>
</head>
<body>

<div class="big_img_logo" style="padding-left:700px"><img src="../assets/img/header_img/logo.png" alt="" onclick="navigateTo('./index.php')"></div>
<div class="product-container">
    <div class="breadcrumb">
        <a href="../index.php">Trang chủ</a> / <a href="category.php">Quần áo</a> / <span><?php echo $product['name']; ?></span>
    </div>
    <div class="product-details" style="padding-top:70px">
        <!-- Hình ảnh sản phẩm -->
        <div class="product-image-slider">
            <div class="slide-container">
                <div class="slide">
                    <img src="../assets/img/<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                </div>
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="product-info" method="POST">
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

            <div class="product-actions">
                <button class="add-to-cart">Thêm vào giỏ hàng</button>
                <a href="../component/product-cart.php"><button class="buy-now">Mua ngay</button></a>
            </div>
            <p style="padding-top:30px">Danh mục: <?php echo htmlspecialchars($product['category_name']); ?></p>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const decrementButton = document.querySelector(".decrement");
    const incrementButton = document.querySelector(".increment");
    const quantityInput = document.querySelector(".quantity-input");
    const addToCartButton = document.querySelector(".add-to-cart");

    // Xử lý sự kiện giảm số lượng
    decrementButton.addEventListener("click", () => {
        let currentValue = parseInt(quantityInput.value, 10);
        if (!isNaN(currentValue) && currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    // Xử lý sự kiện tăng số lượng
    incrementButton.addEventListener("click", () => {
        let currentValue = parseInt(quantityInput.value, 10);
        if (!isNaN(currentValue)) {
            quantityInput.value = currentValue + 1;
        }
    });

    // Kiểm tra giá trị nhập vào trong ô input
    quantityInput.addEventListener("input", () => {
        let currentValue = parseInt(quantityInput.value, 10);
        if (isNaN(currentValue) || currentValue < 1) {
            quantityInput.value = 1; // Reset to 1 if invalid input
        }
    });

    
    // Xử lý sự kiện khi nhấn vào nút thêm vào giỏ hàng
    addToCartButton.addEventListener("click", () => {
        const quantity = parseInt(quantityInput.value, 10);
        const productId = <?php echo $product['product_id']; ?>; // Lấy product_id từ dữ liệu của sản phẩm
        alert("Đã thêm <?php echo $product["name"] ?> vào giỏ hàng")
        // Gửi số lượng và product_id qua yêu cầu AJAX
        fetch('./detail_product.php?id=' + productId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message); // Hiển thị thông báo thành công
            } else {
                alert(data.message); // Hiển thị thông báo lỗi
            }
        })
        .catch(error => console.error('Lỗi:', error));
    });
});


</script>
</body>
</html>
