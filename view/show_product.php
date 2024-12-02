<?php
include '../database/connect.php';
$categoryName = isset($_GET['category_name']) ? trim($_GET['category_name']) : null;
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$size = isset($_GET['size']) ? $_GET['size'] : null; 
$sort_price = isset($_GET['sort_price']) ? $_GET['sort_price'] : null; 

$whereConditions = [];
$params = [];
$paramTypes = '';

// Điều kiện lọc theo ID danh mục
if ($category_id > 0) {
    $whereConditions[] = "category_id = ?";
    $params[] = $category_id;
    $paramTypes .= 'i';
}

// Điều kiện lọc theo tên danh mục (nếu có)
if (!empty($categoryName)) {
    $whereConditions[] = "name LIKE ?";
    $params[] = '%' . $categoryName . '%';
    $paramTypes .= 's';
}

// Điều kiện lọc theo giá tối thiểu
if ($min_price > 0) {
    $whereConditions[] = "price >= ?";
    $params[] = $min_price;
    $paramTypes .= 'i';
}

// Điều kiện lọc theo kích thước (nhiều kích thước)
if (!empty($size)) {
    $sizes = explode(',', $size); 
    $placeholders = implode(',', array_fill(0, count($sizes), '?'));
    $whereConditions[] = "size IN ($placeholders)";
    $params = array_merge($params, $sizes);
    $paramTypes .= str_repeat('s', count($sizes));
}

$whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

$orderClause = '';
if ($sort_price === 'asc') {
    $orderClause = 'ORDER BY price ASC'; // Giá thấp đến cao
} elseif ($sort_price === 'desc') {
    $orderClause = 'ORDER BY price DESC'; // Giá cao xuống thấp
}

// Kết hợp điều kiện WHERE và ORDER BY
$sql = "SELECT product_id, name, old_price, price, img FROM products $whereClause $orderClause";
$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($paramTypes, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../assets/css/product_card.css"> -->
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
        if ($result && $result->num_rows > 0) {
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>