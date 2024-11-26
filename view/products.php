<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\assets\css\bootstrap.min.css">
    <script src="..\assets\js\bootstrap.bundle.min.js"></script>
    <script src="..\assets\js\font-aware.js"></script>
    <style>
        /* Container chính */
        .container2 {
            display: flex; /* Sử dụng Flexbox */
            width: 100%;
            height: 100vh; /* Chiều cao toàn màn hình */
        }

        /* Slidebar */
        .slidebar {
            flex: 1; /* Chiếm 1 phần trong tổng layout */
            max-width: 30%; /* Giới hạn chiều rộng tối đa */
            background-color: #f4f4f4; /* Màu nền cho dễ kiểm tra */
            padding: 10px;
            box-sizing: border-box; /* Đảm bảo padding không ảnh hưởng kích thước */
        }

        /* Product Card */
        .product-card {
            flex: 3; /* Chiếm 3 phần trong tổng layout */
            max-width: 70%; /* Giới hạn chiều rộng tối đa */
            background-color: #fff; /* Màu nền */
            padding: 10px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container2">
        <div class="slidebar">
            <?php include("../component/slidebar.php"); ?>
        </div>
        <div class="product-card">
            <?php include("../component/product_card.php"); ?>
        </div>
    </div>
</body>
</html>
