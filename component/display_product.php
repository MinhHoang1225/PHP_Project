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
WHERE users.user_id = ?";

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
    <title>Favourite Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-header: #e5e5e5;
            --bg-btn: #0c6478;
            --bg-hover-btn: #159198;
            --main-font: sans-serif;
            --main-color: black;
            --second-color: #666666B3;
            --title-text-size: 32px;
            --main-text-size: 16px;
        }

        .title-product-main {
            margin: 1.5em 0 2em 0;
            font-family: var(--main-font);
        }

        .title-product-main h2 {
            line-height: 1.3;
            font-size: 20px;
            text-align: center;
            font-weight: 600 !important;
            font-family: var(--main-font);
            text-transform: uppercase !important;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .title-product-main h2::before,
        .title-product-main h2::after {
            content: '';
            flex: 1;
            height: 2px;
            background-color: #ddd;
            margin: 0 10px;
        }

        .product-card {
            width: 300px;
            height: 500px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 25px;
        }

        .product-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .heart-icon, .cart-icon {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .product-card:hover .heart-icon, 
        .product-card:hover .cart-icon {
            opacity: 1;
            visibility: visible;
        }

        .heart-icon {
            top: 10px;
            right: 10px;
            font-size: 24px;
            position: absolute;
            color: #ccc; 
            transition: all 0.3s ease-in-out;
        }

        .cart-icon {
            left: 10px;
            font-size: 35px;
            position: absolute;
            color: #ccc;
            transition: all 0.3s ease-in-out;
        }


        .product-info {
            padding-top: 20px;
        }

        .product-info h3 {
            font-size: 18px;
            font-weight: bold;
            height: 60px;
            padding: 10px;
            /* overflow: hidden;
            text-overflow: ellipsis; */
            /* white-space: nowrap; */
        }

        .price {
            font-size: 15px;
            color: #666;
        }

        .old-price {
            text-decoration: line-through;
            margin-right: 5px;
        }

        .sale-price {
            font-size: 18px;
            font-weight: bold;
            color: #e60000;
        }

        .no-products {
            text-align: center;
            font-size: 18px;
            color: #888;
        }
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
                echo "<p class='no-products'>Không có sản phẩm yêu thích nào.</p>";
            }
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
