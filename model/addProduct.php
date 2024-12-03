
<?php
session_start();
include '../database/connect.php'; // Kết nối cơ sở dữ liệu


if (isset($_POST['add_to_cart'])) {
    $user_id = 1; // Lấy user ID từ session
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $redirect_url = $_POST['redirect_url'] ?? '../view/detail_product.php';

    // Kiểm tra xem giỏ hàng của người dùng đã tồn tại chưa
    $query_cart = "SELECT cart_id FROM shopping_cart WHERE user_id = ?";
    $stmt_cart = $conn->prepare($query_cart);
    $stmt_cart->bind_param("i", $user_id);
    $stmt_cart->execute();
    $result_cart = $stmt_cart->get_result();

    if ($result_cart->num_rows == 0) {
        // Nếu chưa có giỏ hàng, tạo mới
        $query_create_cart = "INSERT INTO shopping_cart (user_id) VALUES (?)";
        $stmt_create_cart = $conn->prepare($query_create_cart);
        $stmt_create_cart->bind_param("i", $user_id);
        $stmt_create_cart->execute();
        $cart_id = $conn->insert_id;
    } else {
        // Lấy cart_id hiện tại
        $row_cart = $result_cart->fetch_assoc();
        $cart_id = $row_cart['cart_id'];
    }

    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
    $query_item = "SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?";
    $stmt_item = $conn->prepare($query_item);
    $stmt_item->bind_param("ii", $cart_id, $product_id);
    $stmt_item->execute();
    $result_item = $stmt_item->get_result();

    if ($result_item->num_rows > 0) {
        // Nếu sản phẩm đã tồn tại, cập nhật số lượng
        $query_update = "UPDATE cart_items SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("iii", $quantity, $cart_id, $product_id);
        $stmt_update->execute();
    } else {
        // Thêm sản phẩm mới vào giỏ hàng
        $query_insert = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($query_insert);
        $stmt_insert->bind_param("iii", $cart_id, $product_id, $quantity);
        $stmt_insert->execute();
    }

    // Chuyển hướng quay lại trang detail_product.php
    header("Location: $redirect_url?success=true");
    exit();

} else {
    echo "Yêu cầu không hợp lệ.";
}

?>