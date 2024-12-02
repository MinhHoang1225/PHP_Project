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
    <div class="show-product">
        <?php include("../component/renderPromotion.php"); ?>
    </div>

    <?php include("../component/btn_up.php"); ?>

</body>
</html>