<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="banner.css">
    <script src="assets/js/font-aware.js"></script>

    <style>
        img{
            width: 100%;
            height: 600px;
        }

        .slider {
            position: relative;
        }

        .image {
            position: absolute;
            width: 100px;
            height:50px;
            right: 930px;
            top: 170px;
            
            
        }
        
        .button_sale{
            font-size: 12px;
            border-radius: 20px;
            width: 100px;
            font-family: Arial;
            position: absolute;
            top: 230px;
            right: 930px;
            background: linear-gradient(to bottom, #6ead39 0%, #1e5c01 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
        button.button_sale:hover {
            background: linear-gradient(to bottom, #5c9b32 0%, #174d01 100%);
        }

        button.button_sale:active {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transform: translateY(2px);
        }
        @keyframes moveUpDown {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-30px); /* Di chuyển lên */
        }
        100% {
            transform: translateY(0);
        }
        }

        img.image {
            animation: moveUpDown 1s ease-in-out infinite; /* giây lặp vô hạn */
        }  
        .promotion {
            width: 600px; 
            height: 400px; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            margin-left: 100px;
            
            
        }

        .promotion img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* Giữ nguyên tỷ lệ mà không bị cắt */
            
        }
        .program {
            text-align: center; 
            font-size: 24px; 
            margin: 20px 0; 
            color:#666666B3;
            font-family:sans-serif;
        }

        .carousel-inner {
            display: flex; 
            flex-direction: column; 
             
        }
        
    </style>
    
</head>
<body>
    
    <div class="program">CHƯƠNG TRÌNH KHUYẾN MÃI</div>
    <div class="carousel-inner">
        <div class="carousel-item active slider">
            <img src="../assets/img/1mui-ten.png" alt="" class="image">

            <a href="../view/promotion_product.php">
                <button class="button_sale" > <i> <span>NHẬN ƯU ĐÃI</span> </i></button>
            </a>
            <div class="promotion">
                <img src="../assets/img/banner/sale1.jpg" class="d-block w-100" alt="..." onclick="navigateTo('./view/promotion_product.php')">
            </div>
        </div>
        
    </div>
</body>
</html>