<?php
include '../database/connect.php';

// Kiểm tra xem cookie user_id đã được đặt chưa
if (isset($_COOKIE['user_id'])) {
    $user_id = intval($_COOKIE['user_id']);

    // Truy vấn sản phẩm yêu thích của người dùng dựa trên user_id
    $favourite_sql = "SELECT 
        favourite_products.favourite_id AS favourite_id,
        products.product_id AS product_id,
        products.name AS product_name,
        products.price AS product_price,
        products.old_price AS old_price,  
        products.img AS product_img,
        favourite_products.created_at AS added_date
    FROM favourite_products
    INNER JOIN products ON favourite_products.product_id = products.product_id
    WHERE favourite_products.user_id = ?";

    $stmt = $conn->prepare($favourite_sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Nếu user_id không tồn tại trong cookie, yêu cầu đăng nhập
    die("Bạn cần đăng nhập để xem sản phẩm yêu thích.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourite Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Các kiểu CSS đã cung cấp trước đó */
    </style>
</head>
<body>
    <div class="title-product-main">
        <h2><span>Sản Phẩm Yêu Thích</span></h2>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php
            if ($result && $result->num_rows > 0) {
                // Hiển thị từng sản phẩm yêu thích
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3 col-sm-6 text-center justify-content-center">
                        <div class="product-card">
                            <a href="detail_product.php?id=<?php echo $row['product_id']; ?>" class="hoverimage1">
                                <?php
                                $imagePath = '../assets/img/' . $row['product_img'];
                                if (file_exists($imagePath)) {
                                    echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '" class="product-image">';
                                } else {
                                    echo '<img src="uploads/default.jpg" alt="Default Image" class="product-image">';
                                }
                                ?>
                            </a>
                            <a href="#" class="container d-flex justify-content-center align-items-center">
                                <div class="heart-icon">
                                    <i class="bi bi-heart-fill"></i>
                                </div>
                            </a>
                            <a href="#" class="container d-flex justify-content-center align-items-center">
                                <div class="cart-icon">
                                    <i class="bi bi-bag-plus-fill"></i>
                                </div>
                            </a>
                            <div class="product-info">
                                <h3><?php echo htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p class="price">
                                    <span class="old-price"><?php echo number_format($row['old_price'], 0, ',', '.'); ?>₫</span>
                                    <span class="sale-price"><?php echo number_format($row['product_price'], 0, ',', '.'); ?>₫</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Nếu không có sản phẩm yêu thích nào
                echo "<p class='no-products'>Không có sản phẩm yêu thích nào.</p>";
            }

            // Đóng statement và kết nối
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
