<?php
include '../database/connect.php';


// Kiểm tra tham số đầu vào
if (isset($_GET['new_quantity']) && isset($_GET['product_id']) && isset($_GET['cart_id'])) {

    $new_quantity = $_GET['new_quantity'];
    $product_id = $_GET['product_id'];
    $cart_id = $_GET['cart_id'];

    // Kiểm tra tính hợp lệ của số lượng
    if (!is_numeric($new_quantity) || $new_quantity <= 0) {
        echo json_encode(['success' => false, 'error' => 'Số lượng không hợp lệ']);
        exit;
    }

    // Cập nhật số lượng sản phẩm
    $update_sql = "UPDATE cart_items SET quantity = ? WHERE product_id = ? AND cart_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param('iii', $new_quantity, $product_id, $cart_id);

    if ($update_stmt->execute()) {
        // Tính lại tổng tiền của giỏ hàng
        $total_sql = "SELECT SUM((products.price * cart_items.quantity)) AS total_price
            FROM shopping_cart
            INNER JOIN cart_items ON shopping_cart.cart_id = cart_items.cart_id
            INNER JOIN products ON cart_items.product_id = products.product_id
            WHERE shopping_cart.cart_id =?";


            $total_stmt = $conn->prepare($total_sql);
            $total_stmt->bind_param('i', $cart_id);
            $total_stmt->execute();
            $total_result = $total_stmt->get_result();
            $total_row = $total_result->fetch_assoc();

        echo json_encode(['success' => true,'total_price' => number_format($total_row['total_price'], 0, ',', '.') . ' đ'
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Không thể cập nhật số lượng.']);
    }
}
?>
