<?php

    include '../database/connect.php';


    // Kiểm tra tham số đầu vào
    if(isset($_GET['product_id']) && isset($_GET['cart_id'])){


        // Lấy các id của sản phẩm
        $product_id = $_GET['product_id'];
        $cart_id = $_GET['cart_id'];

        // Xoá sản phẩm
        $delete_sql = "DELETE FROM cart_items WHERE product_id = ? AND cart_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param('ii',$product_id,$cart_id);

        // Thực thi câu lệnh xoá
        if ($delete_stmt->execute()) {
            // Nếu xoá thành công
            header('Location: product-cart.php');
                exit();
            } else {
                // In ra lỗi nếu có
                echo "Lỗi SQL: " . $delete_stmt->error;
            }
        
        } else {
            echo "Thông tin sản phẩm không hợp lệ!";
        }

?>


