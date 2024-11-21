<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh toán</title>
   <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f8f8;
    }

    .container {
      display: flex;
      max-width: 100%;
      margin: 20px auto;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
    }

    .delivery-info {
      flex: 2;
      padding: 20px;
      border-right: 1px solid #ddd;
      margin-left: 150px;
    }

    .delivery-info h2 {
      margin-top: 0;
    }

    .delivery-info p {
      margin: 10px 0;
      font-size: 14px;
    }

    .delivery-info a {
      color: #007bff;
      text-decoration: none;
    }

    .delivery-info a:hover {
      text-decoration: underline;
    }

    .delivery-info form {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .delivery-info input,
    .delivery-info select,
    .delivery-info textarea {
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }

    .delivery-info textarea {
      resize: none;
      height: 60px;
    }

    .order-summary {
      flex: 1;
      padding: 20px;
      margin-right: 150px;
      margin-top: 75px;

    }

    .product {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    .product img {
      width: 60px;
      height: 60px;
      border: 1px solid #ddd;
    }

    .product p {
      flex: 1;
      margin: 0;
      font-size: 14px;
    }

    .product span {
      font-weight: bold;
      font-size: 14px;
    }

    .discount {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .discount input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .discount button {
      padding: 10px 15px;
      background: black;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .discount button:hover {
      background: #0056b3;
    }

    .price-details p {
      display: flex;
      justify-content: space-between;
      margin: 30px 0;
      font-size: 14px;
    }

    .price-details .total {
      font-weight: bold;
    }

    .checkout-btn {
      display: block;
      width: 100%;
      padding: 10px;
      background: black;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-align: center;
      font-size: 16px;
    }

    .checkout-btn:hover {
      background: #0056b3;
    }
    form input {
      width: 500px;
      height: 30px;
      margin-bottom: 5px;
    }
    textarea {
      width: 500px;
    }

   </style>
</head>
<body>
  <div class="container">
    <div class="delivery-info">
      <h2>Thông tin giao hàng</h2>
      <p>
        Bạn đã có tài khoản? <a href="#">Đăng nhập</a>
      </p>
      <form>
        <input type="text" placeholder="Họ và tên" required>
        <input type="tel" placeholder="Số điện thoại" required>
        <input type="tel" placeholder="Email" required>
        <input type="text" placeholder="Địa chỉ" required>
        <textarea placeholder="Ghi chú ..."></textarea>
      </form>
    </div>
    <div class="order-summary">
      <div class="product">
        <img src="https://pos.nvncdn.com/eb9ddb-116318/ps/20220323_XCjeXFlLuTcz8fMzWFV7ujGX.png" alt="Kính Gucci Havana">
        <p>Kính Gucci Havana - 40</p>
        <span>5,490,000₫</span>
      </div>
      <div class="discount">
        <input type="text" placeholder="Mã giảm giá">
        <button>Sử dụng</button>
      </div>
      <div class="price-details">
        <p>Tạm tính <span>5,490,000₫</span></p>
        <p>Phí vận chuyển <span>0₫</span></p>
        <p class="total">Tổng cộng <span>5,490,000₫</span></p>
      </div>
      <button class="checkout-btn">Thanh toán</button>
    </div>
  </div>
</body>
</html>
