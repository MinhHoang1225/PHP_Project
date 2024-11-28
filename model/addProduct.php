<?php
    include '../database/connect.php';

if(isset($_POST['cart-to-cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];

    // Kiểm tra nếu size chưa được chọn
    if(empty($size)) {
        echo "<script>alert('Vui lòng chọn kích cỡ trước khi thêm sản phẩm vào giỏ hàng');</script>";
    } else {
        // Kiểm tra xem giỏ hàng đã có trong session chưa
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng, nếu có thì tăng số lượng
            $found = false;
           foreach ($_SESSION['cart'] as $item) {
                if($item['product_id'] == $product_id && $item['size'] == $size) {
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
           }
        }

        if(!$found) {
            $_SESSION['cart'][] = [
                'product_id' => $product_id,
                'product_name' => $product_name,
                'price' => $price,
                'size' => $size,
                'quantity' => $quantity
            ] ;

            // Thông báo đã thêm sản phẩm vào giỏ hàng
            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng');</script>";
        }
}
?>