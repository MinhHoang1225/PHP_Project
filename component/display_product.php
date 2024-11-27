

<?php
    include('../database/connect.php');
    
    $favourite_id = 1; 
    
    $favourite_sql = "SELECT 
        favourite_products.favourite_id AS favourite_id,
        users.user_id AS user_id,
        products.product_id AS product_id,
        products.name AS product_name,
        products.price AS product_price,
        products.old_price AS old_price,  
        products.img AS product_img,
        favourite_products.created_at AS added_date
    FROM favourite_products
    INNER JOIN users ON favourite_products.user_id = users.user_id
    INNER JOIN products ON favourite_products.product_id = products.product_id
    where users.user_id = ?";
    
    $stmt = $conn->prepare($favourite_sql);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param('i', $favourite_id);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>favourite</title>
    <!-- <link rel="stylesheet" href="../assets\css\bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- <script src="../assets\js\bootstrap.bundle.min.js"></script>
    <script src="../assets\js\font-aware.js"></script> -->
    <style>
    
    .container {
        display: flex;          
        flex-wrap: wrap;        
        justify-content: start; 
        gap: 15px;              
        margin-left: 50px;
    }

    .product-card {
        width: 260px;           
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        text-align: center;
        margin: 15px;
        
    }

    
    .product-card img {
        width: 100%;
        height: 200px;
        
    }

    .product-info {
        padding: 0px 15px;
    }

    .product-name {
        font-size: 16px;
        font-weight: bold;
        height:50px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 10px 0;
        font-family: "Work Sans", sans-serif;

    }

    .product-price {
        color: #ff0000;
        font-size: 18px;
        font-weight: bold;
        font-family: "Work Sans", sans-serif;
    }

    .product-original-price {
        text-decoration: line-through;
        color: #a0a0a0;
        font-size: 14px;
    }

    .price-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        
    }
    .heart-icon{
        margin: 10px;
        display:flex;
        justify-content: flex-end;
        font-size: 20px;
        color: red;
    }
    .cart-icon{
        margin: 5px 10px;
        display:flex;
        justify-content: flex- stat;
        font-size: 30px;
        color: red;
    }
    .title-favourite-product{
        display: flex;
        justify-content: center;
        font-family: "Work Sans", sans-serif;
        
    }
    .title-favourite-product {
    text-align: center;
    margin: 20px 0;
    }

    .section-title {
        display: inline-block;
        position: relative;
        font-size: 20px;
        color: #555; /* Bạn có thể thay đổi màu sắc nếu cần */
    }

    .section-title::before,
    .section-title::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 100px;
        height: 2px;
        background-color: #ccc;
    }

    .section-title::before {
        left: -110px; /* Khoảng cách từ tiêu đề đến vạch trái */
    }

    .section-title::after {
        right: -110px; /* Khoảng cách từ tiêu đề đến vạch phải */
    }

</style>
</head>
<body>

    <div class="title-favourite-product"> 
        <h2 class="section-title">
            <span class="text-uppercase fw-bold">
                SẢN PHẨM YÊU THÍCH
            </span>
        </h2>
        
    </div>
    <div class="container">
    <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';

                echo '<a href="#" class=" ">
                    <div class="heart-icon ">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </a>';

                if (!empty($row['product_img'])) {
                    echo '<img src="../assets/img/' . $row['product_img'] . '" alt="Product Image">';
                } else {
                    echo '<p>No image</p>';
                }

                echo '<div class="product-info">';
                echo '<a href="#" class=" ">
                    <div class="cart-icon">
                        <i class="bi bi-bag-plus-fill"></i>
                    </div>
                </a>';

                echo '<h3 class="product-name">' . $row['product_name'] . '</h3>';

                // Hiển thị giá sản phẩm
                echo '<div class="price-wrapper">';
                if (!empty($row['old_price']) && $row['old_price'] >= $row['product_price']) {
                    echo '<p class="product-original-price">' . number_format($row['old_price'], 0, ',', '.') . ' ₫</p>';
                }
                echo '<p class="product-price">' . number_format($row['product_price'], 0, ',', '.') . ' ₫</p>';
                echo '</div>';

                echo '</div>';  // Kết thúc product-info
                echo '</div>';  // Kết thúc product-card
            }
        } else {
            echo "No favourite products found.";
        }

        $stmt->close();
        $conn->close();
    ?>
</div> <!-- Kết thúc container -->

</body>
</html>

    