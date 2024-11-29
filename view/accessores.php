<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessores</title>
    <link rel="stylesheet" href="..\assets\css\bootstrap.min.css">
    <script src="..\assets\js\bootstrap.bundle.min.js"></script>
    <script src="..\assets\js\font-aware.js"></script>
    <script src="../assets/js/navigation.js"></script>
    <style>
        .container2 {
            display: flex; 
            width: 100%;
        }
        .slidebar {
            margin-top: 50px;
        }
        .price-arrange {
            margin-left: 80px;
        }
    </style>
</head>
<body>
    <div class="header">
        <?php include("../component/header.php"); ?> 
        </div>
    <div class="price-arrange">
        <?php include("../component/price_arrange.php"); ?>
        </div>
    <div class="container2">
        <div class="slidebar">
            <?php include("../component/slidebar.php"); ?>
        </div>
        <div class="show-product">
            <?php include("show_product.php"); ?>
        </div>
    </div>
</body>
</html>