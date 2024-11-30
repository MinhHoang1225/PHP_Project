<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="payment-success-container">
        <div class="payment-success-message">
            <i class="fa-regular fa-circle-check"></i>
            <h1>Thanh toán thành công</h1>
            <p>Đơn hàng của bạn đã được xác nhận và đang được xử lý.</p>
        </div>
    </div>
    <div class="btn">
        <button type="submit">Tranng Chủ</button>
    </div>
    

    <style>
        :root{
            --bg-header: #e5e5e5;
            --bg-btn: #0c6478;
            --bg-hover-btn: #159198;
            --main-font: sans-serif;
            --main-color: black;
            --second-color: #666666B3;
            --title-text-size: 32px;
            --main-text-size:16px;  
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .payment-success-container {
            text-align: center;
            padding: 50px;
            background-color: #fff;
            margin: 50px auto;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .payment-success-message h1 {
            color: var(--bg-hover-btn);

        }

        .payment-success-message .fa-regular {
            font-size: 50px;
            color: var(--bg-hover-btn);
        }
        
      
    </style>
