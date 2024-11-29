<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/product_card.css">
    <link rel="stylesheet" href="../assets\css\bootstrap.min.css">
    <!-- Thêm Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="assets\js\bootstrap.bundle.min.js"></script>
    <script src="assets\js\font-aware.js"></script>
    <title>Sản phẩm</title>
</head>
<body>
        <!-- <div class="container_big"> -->
            <!-- Content -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                        <div class="product-main">

                            <!-- NEW ARRIVALS -->
                            <div class="title-product-main"> 
                                <h2 class="section-title">
                                    <span class="text-uppercase fw-bold">
                                        HÀNG MỚI VỀ
                                    </span>
                                </h2> 
                            </div>
                            <div class="content-product-main">
                                <div class="row">   
                                    <?php
                                        $sql = "SELECT p.product_id, p.img, p.name as product_name, p.old_price, p.price, p.created_at, c.name as category_name 
                                                FROM products as p 
                                                INNER JOIN categories as c ON p.category_id = c.category_id
                                                WHERE c.name IN ('Ba lô', 'Giày', 'Phụ kiện', 'Quần áo')
                                                ORDER BY p.created_at DESC
                                                Limit 8";

                                        $result = mysqli_query($conn,$sql);
                                        if (!$result) {
                                            die("Lỗi truy vấn: " . mysqli_error($conn));
                                        }
                                        
                                        while ($kq = mysqli_fetch_assoc($result)) {
                                                
                                    ?>      
                                            <div class="col-md-3 col-sm-6 text-center">
                                                <div class="product-card">
                                                    <div class="product-item_image">
                                                        <div class="hoverimage1">
                                                            <img src="assets/img/<?php echo $kq['img']; ?>" alt="<?php echo $kq['product_name']; ?>" class="product-image" style="width:100%; height:auto;">
                                                        </div>
            
                                                        <a href="#" class="container d-flex justify-content-center align-items-center" >
                                                            <div class="heart-icon ">
                                                                <i class="bi bi-heart-fill"></i>
                                                            </div>
                                                        </a>
            
                                                        <a href="detail.php?id=<?php echo $kq['product_id']; ?>" class="container d-flex justify-content-center align-items-center" >
                                                            <div class="cart-icon">
                                                                <i class="bi bi-bag-plus-fill"></i>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <!-- Thông tin sản phẩm -->
                                                    <div class="product-info" style="margin-left:0px;">
                                                        <h3 class="product-name">
                                                            <?php echo $kq['product_name']; ?>
                                                        </h3>
                                                        <p class="price">
                                                            <span class="original-price">
                                                                <?php echo $kq['old_price']; ?> <sup> ₫ </sup> 
                                                            </span>
                                                            <span class="sale-price">
                                                                <?php echo $kq['price']; ?> <sup> ₫ </sup>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div><!-- product card-->
                                            </div><!-- /col -->   
                                        <?php } ?>
                                </div><!-- /row -->
                            </div><!-- NEW ARRIVALS -->

                            <!-- BEST SELLER -->
                            <div class="title-product-main">
                                <h2 class="section-title">
                                    <span class="d-inline-block text-uppercase font-weight-bold position-relative">
                                        Bán chạy nhất
                                    </span>
                                </h2>
                            </div>
                            <div class="content-product-main">
                                <div class="row">
                                    <?php
                                    $sql = "SELECT p.product_id, p.img, p.name as product_name, p.old_price, p.price, p.created_at, c.name as category_name
                                    FROM products as p 
                                    INNER JOIN categories as c ON p.category_id = c.category_id
                                    WHERE c.name IN ('Ba lô', 'Giày', 'Phụ kiện', 'Quần áo')
                                    ORDER BY p.created_at ASC
                                    Limit 8";

                                        $result = mysqli_query($conn,$sql);

                                        if (!$result) {
                                            die("Lỗi truy vấn: " . mysqli_error($conn));
                                        }
                                        
                                        while ($kq = mysqli_fetch_assoc($result)) {
                                                
                                    ?>                   
                                            <div class="col-md-3 col-sm-6 text-center">
                                                <div class="product-card">
                                                    <div class="product-item_image">
                                                        <div class="hoverimage1">
                                                            <img src="assets/img/<?php echo $kq['img']; ?>" alt="<?php echo $kq['product_name']; ?>" class="product-image" style="width:100%; height:auto;">
                                                        </div>
            
                                                        <a href="#" class="container d-flex justify-content-center align-items-center" >
                                                            <div class="heart-icon ">
                                                                <i class="bi bi-heart-fill"></i>
                                                            </div>
                                                        </a>
            
                                                        <a href="detail_product.php?id=<?php echo $kq['product_id']; ?>" class="container d-flex justify-content-center align-items-center" >
                                                            <div class="cart-icon">
                                                                <i class="bi bi-bag-plus-fill"></i>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <!-- Thông tin sản phẩm -->
                                                    <div class="product-info" style="margin-left:0;">
                                                        <h3 class="product-name">
                                                            <?php echo $kq['product_name']; ?>
                                                        </h3>
                                                        <p class="price">
                                                            <span class="original-price">
                                                                <?php echo $kq['old_price']; ?> <sup> ₫ </sup> 
                                                            </span>
                                                            <span class="sale-price">
                                                                <?php echo $kq['price']; ?> <sup> ₫ </sup>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div><!-- product card-->
                                            </div><!-- /col -->  
                                        <?php } ?>
                                </div><!-- /row -->
                            </div><!-- BEST SELLER  -->

                        </div> <!-- /product-main -->
                    </div> <!-- /col -->

                </div><!-- /row -->
            </div><!-- /container -->
        <!-- </div> /container_big -->

</body>
</html>