<?php
// Giả sử bạn đang sử dụng mysqli để kết nối database
include('../database/connect.php');

// Lệnh truy vấn SQL
$query = "SELECT * FROM products WHERE category_id  = '2'";


// Chuẩn bị và thực hiện truy vấn
$stmt = $conn->prepare($query,); 
if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result(); 
} else {
    echo "Lỗi: Không thể thực hiện truy vấn.";
}

// Hiển thị dữ liệu
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Danh Sách Sản phẩm</title>
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
                    /* margin-right: 270px; */
                    gap:15px;
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
                
                .price {
                    font-size: 15px;
                    color: #666;
                }
                
                .old-price {
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
            <?php
            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3 col-sm-6 text-center justify-content-center">
                    <div class="product-card">
                        <div class="product-item_image">
                            <a href="detail_product.php?id=<?php echo $row['product_id']; ?>" class="hoverimage1">
                                <?php
                                    $imagePath = '../assets/img/' . $row['img'];
                                    if (file_exists($imagePath)) {
                                        echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '" class="product-image" width="100%" height="300">';
                                    } else {
                                        echo '<img src="uploads/default.jpg" alt="Default Image" class="product-image" width="100%" height="300">';
                                    }
                                ?>
                            </a>

                            <div class="container d-flex justify-content-center align-items-center">
                                <div class="heart-icon" onclick="addToFavourites(<?php echo $row['product_id']; ?>)">
                                    <i class="bi bi-heart-fill"></i>
                                </div>
                            </div>

                            <!-- <a href="#" class="container d-flex justify-content-center align-items-center">
                                <div class="cart-icon">
                                    <i class="bi bi-bag-plus-fill"></i>
                                </div>
                            </a> -->
                        </div>
                        <div class="product-info">
                            <?php
                                echo '<p class="product-name">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</p>';
                            ?>
                            <p class="price">
                                <span class="old-price"><?php echo number_format($row['old_price'], 0, ',', '.'); ?>₫</span>
                                <span class="sale-price"><?php echo number_format($row['price'], 0, ',', '.'); ?>₫</span>
                            </p>
                        </div>
                    </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>Không có sản phẩm nào phù hợp.</p>";
            }
            ?>
        </div>
    </div>
    <script>
          function addToFavourites(productId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../view/addFavourite.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        alert(xhr.responseText); // Hiển thị thông báo từ server
                    } else {
                        alert("Đã xảy ra lỗi: " + xhr.status);
                    }
                }
            };

            xhr.send("product_id=" + productId);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
