<?php
session_start();
include '../database/connect.php'; // Kết nối cơ sở dữ liệu

if (isset($_POST['add_to_cart'])) {
    // // Kiểm tra cookie user_id
    // $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;
    // if (!$user_id) {
    //     echo "Người dùng chưa đăng nhập.";
    //     exit();
    // }

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : '../view/detail_product.php';

    // Kiểm tra hoặc tạo giỏ hàng
    $query_cart = "SELECT cart_id FROM shopping_cart WHERE user_id = ?";
    $stmt_cart = $conn->prepare($query_cart);
    $stmt_cart->bind_param("i", $user_id);
    if (!$stmt_cart->execute()) {
        echo "Lỗi khi truy xuất giỏ hàng: " . $conn->error;
        exit();
    }
    $result_cart = $stmt_cart->get_result();

    if ($result_cart->num_rows == 0) {
        // Nếu chưa có giỏ hàng, tạo mới
        $query_create_cart = "INSERT INTO shopping_cart (user_id) VALUES (?)";
        $stmt_create_cart = $conn->prepare($query_create_cart);
        $stmt_create_cart->bind_param("i", $user_id);
        if (!$stmt_create_cart->execute()) {
            echo "Lỗi khi tạo giỏ hàng: " . $conn->error;
            exit();
        }
        $cart_id = $conn->insert_id;
    } else {
        // Lấy cart_id hiện tại
        $row_cart = $result_cart->fetch_assoc();
        $cart_id = $row_cart['cart_id'];
    }

    // Kiểm tra sản phẩm trong giỏ hàng
    $query_item = "SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?";
    $stmt_item = $conn->prepare($query_item);
    $stmt_item->bind_param("ii", $cart_id, $product_id);
    if (!$stmt_item->execute()) {
        echo "Lỗi khi kiểm tra sản phẩm trong giỏ hàng: " . $conn->error;
        exit();
    }
    $result_item = $stmt_item->get_result();

    if ($result_item->num_rows > 0) {
        // Nếu sản phẩm đã tồn tại, cập nhật số lượng
        $query_update = "UPDATE cart_items SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("iii", $quantity, $cart_id, $product_id);
        if (!$stmt_update->execute()) {
            echo "Lỗi khi cập nhật số lượng: " . $conn->error;
            exit();
        }
    } else {
        // Thêm sản phẩm mới vào giỏ hàng
        $query_insert = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($query_insert);
        $stmt_insert->bind_param("iii", $cart_id, $product_id, $quantity);
        if (!$stmt_insert->execute()) {
            echo "Lỗi khi thêm sản phẩm vào giỏ hàng: " . $conn->error;
            exit();
        }
    }

    // Chuyển hướng quay lại trang detail_product.php
    header("Location: $redirect_url?success=true");
    exit();

} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
