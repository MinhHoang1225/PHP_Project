<?php
include('../database/connect.php');

// Kiểm tra nếu cookies user_id tồn tại
$user_id = (int) $_COOKIE['user_id'];
echo "<script>console.log('User ID: " . htmlspecialchars($user_id) . "');</script>";

// Truy vấn để lấy thông tin sản phẩm từ giỏ hàng của người dùng
$sql = "SELECT cart_items.product_id, cart_items.quantity, products.price, products.img, products.name 
        FROM cart_items
        INNER JOIN products ON cart_items.product_id = products.product_id
        WHERE cart_items.cart_id IN (SELECT shopping_cart.cart_id FROM shopping_cart WHERE shopping_cart.user_id = ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Lỗi khi chuẩn bị câu lệnh: " . $conn->error);
}
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total_amount = 0;
$products = [];
while ($row = $result->fetch_assoc()) {
    $total_amount += $row['price'] * $row['quantity'];
    $products[] = $row;  // Lưu thông tin sản phẩm vào mảng
}

$total_amount_display = $total_amount; // Khởi tạo biến $total
$total = $total_amount;
// Xử lý khi áp dụng mã giảm giá
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_voucher'])) {
    $voucher_code = $_POST['voucher_code'];
    $sql_voucher = "SELECT discount_percentage, start_date, end_date FROM Voucher WHERE voucher_id = ?";
    $stmt_voucher = $conn->prepare($sql_voucher);
    if (!$stmt_voucher) {
        die("Lỗi khi chuẩn bị câu lệnh mã giảm giá: " . $conn->error);
    }
    $stmt_voucher->bind_param('s', $voucher_code);
    $stmt_voucher->execute();
    $result_voucher = $stmt_voucher->get_result();

    if ($result_voucher->num_rows > 0) {
        $voucher = $result_voucher->fetch_assoc();
        $current_date = date('Y-m-d');
        if ($current_date >= $voucher['start_date'] && $current_date <= $voucher['end_date']) {
            $discount_percentage = $voucher['discount_percentage'];
            $discount_amount = ($total_amount * $discount_percentage) / 100;
            $total-= $discount_amount;
            echo "<script>alert('Áp dụng mã giảm giá thành công! Bạn được giảm " . $discount_percentage . "%.'); 
                  document.getElementById('totalAmount').innerText = '" . number_format($total, 0, ',', '.') . "₫';
                  </script>";
        } else {
            echo "<script>alert('Mã giảm giá không hợp lệ.');</script>";
        }
    }
}

// Xử lý dữ liệu sau khi nhấn nút thanh toán
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
    // Kiểm tra nếu giỏ hàng trống
    if (empty($products)) {
        echo "<script>alert('Giỏ hàng của bạn đang trống, không thể thanh toán.');</script>";
    } else {
        // Lấy thông tin từ form
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $notes = $_POST['notes'];
        $payment_method = $_POST['payment_method'];

        // Kiểm tra xem tất cả thông tin đã được điền
        if ($fullname && $phone && $email && $address) {
            // Lưu thông tin đơn hàng vào bảng orders
            $order_sql = "INSERT INTO orders (user_id, fullname, phone, email, address, notes, total_amount, payment_method) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $order_stmt = $conn->prepare($order_sql);
            if (!$order_stmt) {
                die("Lỗi khi chuẩn bị câu lệnh đặt hàng: " . $conn->error);
            }

            $order_stmt->bind_param('issssssd', $user_id, $fullname, $phone, $email, $address, $notes, $total, $payment_method);

            if ($order_stmt->execute()) {
                $order_id = $conn->insert_id;  // Lấy id đơn hàng vừa tạo

                // Lưu sản phẩm trong đơn hàng vào bảng order_items
                foreach ($products as $product) {
                    $item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
                    $item_stmt = $conn->prepare($item_sql);
                    if (!$item_stmt) {
                        die("Lỗi khi chuẩn bị câu lệnh sản phẩm: " . $conn->error);
                    }
                    $item_stmt->bind_param('iiid', $order_id, $product['product_id'], $product['quantity'], $product['price']);
                    $item_stmt->execute();
                }

                // Xóa giỏ hàng sau khi thanh toán
                $delete_cart_sql = "DELETE FROM cart_items WHERE cart_id IN (SELECT shopping_cart.cart_id FROM shopping_cart WHERE shopping_cart.user_id = ?)";
                $delete_cart_stmt = $conn->prepare($delete_cart_sql);
                if (!$delete_cart_stmt) {
                    die("Lỗi khi chuẩn bị câu lệnh xóa giỏ hàng: " . $conn->error);
                }
                $delete_cart_stmt->bind_param('i', $user_id);
                $delete_cart_stmt->execute();

                // Thông báo thanh toán thành công
                echo "<script>alert('Thanh toán thành công!'); window.location.href='../index.php';</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra trong quá trình thanh toán: " . $order_stmt->error . "');</script>";
            }
        } else {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh toán</title>
  <script src="../assets/js/font-aware.js"></script>
  <script src="../assets/js/navigation.js"></script>

  <style>
    /* CSS styles here */
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
      color: var(--bg-btn);
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
      padding-right:15px
    }

    .overflow{
      overflow-y: scroll;
      height: 250px;
      width: 600px;
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
      background: var(--bg-btn);
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .discount button:hover {
      background: var(--bg-hover-btn);
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
      background: var(--bg-btn);
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-align: center;
      font-size: 16px;
    }

    .checkout-btn:hover {
      background: var(--bg-hover-btn);
    }

    form input {
      width: 500px;
      height: 30px;
      margin-bottom: 5px;
    }

    textarea {
      width: 500px;
    }

    /* Thêm style cho phương thức thanh toán */
    .payment-method {
      margin-top: 20px;
      display: flex;
      align-items: center;
    }

    .payment-method label {
      font-size: 16px;
      font-weight: bold;
    }

    .payment-method input {
      /* margin-right: 10px; */
      /* font-size:15px; */
      /* display: flex;
      justify-content: flex-start; */
      width: 130px;
      font-size: 20px;
      height:20px;
    }

    .big_img_logo{
      width: 200px;
      padding-left: 700px;
    }
    .arrow-back{
      font-size: 32px;
      padding: 10px 0 0 10px;
      cursor: pointer;
      color: var(--bg-btn);
    }
    .arrow-back:hover{
      color: var(--bg-hover-btn)
    }

     /* Style form voucher */
     .voucher-form {
            display: flex;
            justify-content: space-between;
            /* align-items: center; */
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin: auto;
        }
        .voucher-form input {
           width: 450px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }
        .apply-button {
            background-color: var(--bg-btn);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .apply-button:hover {
            background-color: var(--bg-hover-btn);
        }


  </style>
</head>
<body>
<div class="container">
    <div class="delivery-info">
      <h2>Thông tin giao hàng</h2>
      <form id="orderForm" method="POST" onsubmit="return validateForm()">
        <input type="text" name="fullname" placeholder="Họ và tên" required>
        <input type="tel" name="phone" placeholder="Số điện thoại" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="address" placeholder="Địa chỉ" required>
        <textarea name="notes" placeholder="Ghi chú ..."></textarea>

        <div class="payment-method">
          <label>Phương thức thanh toán:</label><br>
          <input type="radio" name="payment_method" value="Cash on Delivery" checked> Thanh toán khi nhận hàng
        </div>

        <button type="submit" name="submit_order" class="checkout-btn">Thanh toán</button>
      </form>
    </div>
    
    <div class="order-summary">
      <div class="overflow">
      <?php if (!empty($products)) { 
        foreach ($products as $product) { ?>
        <div class="product">
          <img src="../assets/img/<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
          <p><?php echo $product['name']; ?> - <?php echo $product['quantity']; ?></p>
          <span><?php echo number_format($product['price'] * $product['quantity'], 0, ',', '.'); ?>₫</span>
        </div>
      <?php }} ?>
      </div>

      <div class="price-details">
        <p>Tạm tính <span><?php echo number_format($total_amount_display, 0, ',', '.'); ?>₫</span></p>
        <form method="POST">
          <div class="voucher-form">
            <input type="text" name="voucher_code" placeholder="Mã Voucher">
            <button type="submit" name="apply_voucher" class="apply-button">ÁP DỤNG</button>
          </div> 
        </form>
        <p class="total">Tổng cộng <span id="totalAmount"><?php echo number_format($total, 0, ',', '.'); ?>₫</span></p>
      </div>
    </div>
  </div>

  <script>
   function validateForm() {
    var fullname = document.forms["orderForm"]["fullname"].value;
    var phone = document.forms["orderForm"]["phone"].value;
    var email = document.forms["orderForm"]["email"].value;
    var address = document.forms["orderForm"]["address"].value;

    if (fullname == "" || phone == "" || email == "" || address == "") {
        alert("Vui lòng điền đầy đủ thông tin.");
        return false; // Không gửi form
    }
    return true; // Nếu tất cả các trường hợp lệ
}
</script>

</body>
</html>