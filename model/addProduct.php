<?php
session_start();
include '../database/connect.php';

if (isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user_id']; // Giả sử user_id đã được lưu trong session
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Kiểm tra giỏ hàng của người dùng
    $cart_query = "SELECT cart_id FROM shopping_cart WHERE user_id = $user_id";
    $cart_result = mysqli_query($conn, $cart_query);

    if (mysqli_num_rows($cart_result) == 0) {
        // Nếu giỏ hàng chưa tồn tại, tạo mới
        $create_cart_query = "INSERT INTO shopping_cart (user_id) VALUES ($user_id)";
        mysqli_query($conn, $create_cart_query);
        $cart_id = mysqli_insert_id($conn); // Lấy cart_id mới tạo
    } else {
        // Lấy cart_id hiện tại
        $cart_row = mysqli_fetch_assoc($cart_result);
        $cart_id = $cart_row['cart_id'];
    }

    // Kiểm tra sản phẩm đã có trong cart_items chưa
    $check_item_query = "SELECT cart_item_id FROM cart_items WHERE cart_id = $cart_id AND product_id = $product_id AND size = '$size'";
    $item_result = mysqli_query($conn, $check_item_query);

    if (mysqli_num_rows($item_result) > 0) {
        // Nếu đã có, tăng số lượng
        $update_item_query = "UPDATE cart_items SET quantity = quantity + $quantity 
                              WHERE cart_id = $cart_id AND product_id = $product_id AND size = '$size'";
        mysqli_query($conn, $update_item_query);
    } else {
        // Nếu chưa có, thêm mới
        $insert_item_query = "INSERT INTO cart_items (cart_id, product_id, size, quantity) 
                              VALUES ($cart_id, $product_id, $quantity)";
        mysqli_query($conn, $insert_item_query);
    }

    echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng');</script>";
    echo "<script>window.location.href = '../component/product-cart.php';</script>"; // Chuyển hướng đến trang giỏ hàng
}
?>
