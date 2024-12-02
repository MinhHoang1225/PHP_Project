<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Render Products Clothes</title>
    <link rel="stylesheet" href="../assets/css/product_card.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Thêm Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="assets\js\bootstrap.bundle.min.js"></script>
    <script src="assets\js\font-aware.js"></script>

    <style>
        
        :root{
            --bg-header: #e5e5e5;
        --bg-btn: #0c6478;
        --bg-hover-btn: #159198;
        --main-font: sans-serif;
        /* second-font:; */
        --main-color: black;
        --second-color: #666666B3;
        --title-text-size: 32px;
        --main-text-size:16px;
        
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
        
        .title-product-main span {
            background: #fff;
            color: #555;
            padding: 0 15px;
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
            margin-right: 290px;
        }
        
        .product-image {
            width: 100%;
            height: auto;
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
            border: 2px solid transparent; 
            transition: all 0.3s ease-in-out; 
            cursor: pointer;
        }
        
        .cart-icon {
            left: 10px;
            font-size: 35px;
            position: absolute;
            color: #ccc; 
            border: 2px solid transparent; 
            transition: all 0.3s ease-in-out; 
            cursor: pointer;
        }
        
        .heart-icon:hover, .cart-icon:hover {
            color: red; 
            box-shadow: none; 
        }
        
        .product-info {
            padding-top: 20px
        }
        
        .product-info h3 {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            height: 60px; /* Chiều cao cố định cho tiêu đề */
            padding: 50px 10px; /* Đệm trong để chữ không sát lề */
            overflow: hidden;
            text-overflow: ellipsis;
           
        }
        
        
        .category {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            margin: 5px 0;
        }
        
        .product-name {
            font-family: var(--main-font);
            font-size: 14px;
            box-sizing: bol;
            margin: 10px 0;
            font-weight: bold;
        }
        
        .price {
            font-size: 15px;
            color: #666;
        }
        
        .original-price {
            font-family: var(--main-font) ;
            text-decoration: line-through;
            margin-right: 5px;
        }
        
        .sale-price {
            font-family: var(--main-font);
            font-size: 18px;
            font-weight: bold;
            color: #e60000;
        }
        
        
            </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="content-product-main">
                                <div class="row">   
                                    <?php
                                    include '../database/connect.php';
                                        $sql = "SELECT p.product_id, p.img, p.name as product_name, p.old_price, p.price, p.created_at, c.name as category_name 
                                                FROM products as p 
                                                INNER JOIN categories as c ON p.category_id = c.category_id
                                                WHERE c.name = 'Quần áo';";

                                        $result = mysqli_query($conn,$sql);
                                        if (!$result) {
                                            die("Lỗi truy vấn: " . mysqli_error($conn));
                                        }
                                        
                                        while ($kq = mysqli_fetch_assoc($result)) {
                                                
                                    ?>      
                                            <div class="col-md-3 col-sm-6 text-center">
                                            <div class="product-card">
                                            <div class="product-item_image">
                                                <a href="./view/detail_product.php?id=<?php echo $kq['product_id']; ?>" class="hoverimage1">
                                                    <img src="../assets/img/<?php echo $kq['img']; ?>" alt="<?php echo $kq['product_name']; ?>" class="product-image" style="width:100%; height:auto;">
                                                </a>

                                                <a href="#" class="container d-flex justify-content-center align-items-center">
                                                    <div class="heart-icon">
                                                        <i class="bi bi-heart-fill"></i>
                                                    </div>
                                                </a>

                                                <a href="detail.php?id=<?php echo $kq['product_id']; ?>" class="container d-flex justify-content-center align-items-center">
                                                    <div class="cart-icon">
                                                        <i class="bi bi-bag-plus-fill"></i>
                                                    </div>
                                                </a>
                                            </div>

                                            <!-- Thông tin sản phẩm -->
                                            <div class="product-info" style="margin-left:0px;">
                                                <h3 class="product-name" style="font-weight:bold">
                                                    <?php echo $kq['product_name']; ?>
                                                </h3>
                                                <p class="price">
                                                    <span class="original-price">
                                                        <?php echo number_format($kq['old_price'], 0, ',', '.'); ?> <sup>₫</sup>
                                                    </span>
                                                    <span class="sale-price">
                                                        <?php echo number_format($kq['price'], 0, ',', '.'); ?> <sup>₫</sup>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- product card-->
                                            </div><!-- /col -->   
                                        <?php } ?>
                                </div><!-- /row -->
                            </div><!-- NEW ARRIVALS -->
                </div>
            </div>
        </div>

    </div>
</body>
</html>