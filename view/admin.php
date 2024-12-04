<?php
// Kết nối database
include '../database/connect.php';

// Thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_FILES['image']['name'];
    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $add_sql = "INSERT INTO products (name, price, stock, img) VALUES (?, ?, ?, ?)";
        $add_stmt = $conn->prepare($add_sql);
        $add_stmt->bind_param("ssss", $name, $price, $stock, $image);
        $add_stmt->execute();
        header('Location: admin.php');
    }
}

// Sửa sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_product'])) {
  $product_id = $_POST['product_id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $stock = $_POST['stock'];
  $image = $_FILES['image']['name'];

  // Kiểm tra nếu có hình ảnh mới
  if (!empty($image)) {
      $target_dir = "../assets/img/";
      $target_file = $target_dir . basename($image);
      if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
          $update_sql = "UPDATE products SET name = ?, price = ?, stock = ?, img = ? WHERE product_id = ?";
          $update_stmt = $conn->prepare($update_sql);
          $update_stmt->bind_param("ssssi", $name, $price, $stock, $image, $product_id);
      }
  } else {
      // Nếu không có hình ảnh mới
      $update_sql = "UPDATE products SET name = ?, price = ?, stock = ? WHERE product_id = ?";
      $update_stmt = $conn->prepare($update_sql);
      $update_stmt->bind_param("sssi", $name, $price, $stock, $product_id);
  }

  // Thực hiện cập nhật
  if ($update_stmt->execute()) {
      header('Location: admin.php?message=Product updated successfully');
  } else {
      echo "Error: " . $update_stmt->error;
  }
}


// Xóa sản phẩm
if (isset($_GET['delete_product'])) {
    $product_id = $_GET['delete_product'];
    $delete_sql = "DELETE FROM products WHERE product_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("s", $product_id);
    $delete_stmt->execute();
    header('Location: admin.php');
}

// Lấy dữ liệu sản phẩm
$product_sql = "SELECT * FROM products";
$product_stmt = $conn->prepare($product_sql);
$product_stmt->execute();
$product_result = $product_stmt->get_result();

// Lấy dữ liệu người dùng
$user_sql = "SELECT * FROM users";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user_sql1 = "SELECT user_id, username, email FROM users";
$user_result1 = $conn->query($user_sql1);


?>
<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn lấy đơn hàng trạng thái 'dang-giao'
$query_dang_giao = "
    SELECT 
        users.username AS username,
        orders.created_at AS created_at,
        orders.status AS status,
        orders.order_id AS order_id
    FROM orders
    JOIN users ON orders.user_id = users.user_id
    WHERE orders.status = 'dang-giao'
";

// Truy vấn lấy đơn hàng trạng thái 'da-giao'
$query_da_giao = "
    SELECT 
        users.username AS username,
        orders.created_at AS created_at,
        orders.status AS status,
        orders.order_id AS order_id
    FROM orders
    JOIN users ON orders.user_id = users.user_id
    WHERE orders.status = 'da-giao'
";

// Truy vấn lấy đơn hàng trạng thái 'thanh-toan-thanh-cong'
$query_thanh_toan_thanh_cong = "
    SELECT 
        users.username AS username,
        orders.created_at AS created_at,
        orders.status AS status,
        orders.order_id AS order_id
    FROM orders
    JOIN users ON orders.user_id = users.user_id
    WHERE orders.status = 'thanh-toan-thanh-cong'
";

$result_dang_giao = $conn->query($query_dang_giao);
$result_da_giao = $conn->query($query_da_giao);
$result_thanh_toan_thanh_cong = $conn->query($query_thanh_toan_thanh_cong);

if (!$result_dang_giao || !$result_da_giao || !$result_thanh_toan_thanh_cong) {
    die("Lỗi truy vấn: " . $conn->error);
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <script src="../assets/js/admin.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="../assets/js/navigation.js"></script>
    <style>
  :root {
  --bg-header: #e5e5e5;
  --bg-btn: #0c6478;
  --bg-hover-btn: #159198;
  --main-font: sans-serif;
  --main-color: black;
  --second-color: #666666B3;
  --title-text-size: 32px;
  --main-text-size: 16px;
}

body {
  font-family: "Roboto", Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  height: 100vh;
  background-color: var(--bg-header);
}

/* Sidebar */
.sidebar {
  width: 240px;
  background: linear-gradient(135deg, var(--bg-header), #555);
  color: white;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  flex-direction: column;
  padding: 20px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar .logo {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--bg-hover-btn);
}

.sidebar .menu a {
  color: white;
  text-decoration: none;
  padding: 15px;
  display: flex;
  align-items: center;
  gap: 15px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.sidebar .menu a:hover {
  background-color: var(--second-color);
  color: var(--main-color);
}

.sidebar .menu a.active {
  background-color: var(--bg-hover-btn);
  color: var(--main-color);
}

.sidebar .menu a.logout {
  margin-top: auto;
  background-color: var(--bg-btn);
}

.sidebar .menu a.logout:hover {
  background-color: var(--bg-hover-btn);
}

/* Main Content */
.main {
  margin-left: 270px;
  padding: 20px;
  width: calc(100% - 270px);
}

.header {
  background-color: var(--bg-header);
  color: var(--main-color);
  padding: 15px;
  border-radius: 5px;
  font-size: 1.5rem;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
}

/* Section */
.section {
  margin-top: 20px;
}

.stats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-top: 20px;
}

.stat {
  background-color: #fff;
  border-radius: 10px;
  padding: 20px;
  text-align: center;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.stat:hover {
  transform: translateY(-5px);
}

.stat i {
  font-size: 2rem;
  color: var(--bg-hover-btn);
  margin-bottom: 10px;
}

.stat h3 {
  font-size: 1.2rem;
  color: var(--main-color);
}

.stat p {
  font-size: 1.5rem;
  font-weight: bold;
  color: var(--second-color);
}

/* Table */
.table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.table th,
.table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}

.table th {
  background-color: #333;
  color: #fff;
}

.table td {
  background-color: #fff;
}

.btn {
  padding: 5px 10px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  
}

.btn.edit {
  background-color: var(--bg-hover-btn);
  color: white;
}

.btn.delete {
  background-color: #e74c3c;
  color: white;
}

/* Footer */
.footer {
  text-align: center;
  padding: 10px;
  background-color: var(--bg-header);
  color: var(--main-color);
  border-radius: 5px;
  margin-top: 20px;
}
.add_product{
  padding: 10px;
  color: var(--main-color);
  background-color: var(--bg-btn);
  font-size: 16px;
  font-weight: bold;
}
.add_product:hover{
  color: var(--bg-header);
  background-color: var(--bg-hover-btn);
  transform: translateY(-2px);
  transition: transform 0.3s ease;
}

/* Modal background */
.modal {
    display: none; /* Mặc định không hiển thị */
    position: fixed;
    z-index: 1; /* Đảm bảo modal luôn ở trên các phần tử khác */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0); /* Màu nền đen mờ */
    background-color: rgba(0, 0, 0, 0.4); /* Nền đen mờ với độ trong suốt */
}

/* Modal content */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Chiều rộng modal */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng nhẹ */
    border-radius: 8px; /* Bo tròn các góc */
}

/* Đóng modal */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Form container */
form {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Khoảng cách giữa các trường trong form */
}

/* Label và input */
label {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
    font-family: "Work Sans", sans-serif;
}

input[type="text"],
input[type="number"],
input[type="file"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
}

/* Button */
button {
    background-color: var(--bg-btn); /* Màu nền nút */
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: var(--bg-hover-btn); /* Màu nền khi hover */
}

/* Thêm khoảng cách cho tiêu đề */
h3 {
    text-align: center;
    font-size: 24px;
    font-family: "Work Sans", sans-serif;
    color: var(--main-color);
}
a {
    color: #007bff;
    text-decoration: none;
    cursor: pointer;
}

a:hover {
    text-decoration: underline;
}
#order-details-td div {
    border: 1px solid #ddd;
    background-color: #fff;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Hiệu ứng đổ bóng nhẹ */
}

#order-details-td div p {
    margin: 0;
    padding: 5px 0;
    color: #333;
    font-size: 14px;
}
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <img src="../assets/img/header_img/logo.png" alt="" style="width: 200px;" onclick="navigateTo('./index.php')">
        </div>
        <nav class="menu">
            <a href="#" data-section="dashboard" class="active">
                <i class="fa-solid fa-chart-line"></i> Thống kê
            </a>
            <a href="#" data-section="users">
                <i class="fa-solid fa-users"></i> Khách hàng
            </a>
            <a href="#" data-section="products">
                <i class="fa-solid fa-shoe-prints"></i> Sản phẩm
            </a>
            <a href="#" data-section="orders-by-user">
                <i class="fa-solid fa-cart-shopping"></i> QLĐH theo khách hàng
            </a>
            <a href="#" data-section="orders">
                <i class="fa-solid fa-cart-shopping"></i>QLĐH theo trạng thái
            </a>
            <a href="#" class="logout">
                <i class="fa-solid fa-sign-out-alt"></i> Đăng xuất
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
        <header class="header">
            <h1>Quản lý Bán Hàng</h1>
        </header>

        <!-- Section: Thống kê -->
        <section id="dashboard" class="section">
            <h2>Thống kê</h2>
            <div class="stats">
                <div class="stat">
                    <i class="fa-solid fa-users"></i>
                    <h3>Khách hàng</h3>
                    <p id="total-customers"><?= $user_result1->num_rows ?></p>
                </div>
                <div class="stat">
                    <i class="fa-solid fa-shoe-prints"></i>
                    <h3>Sản phẩm</h3>
                    <p id="total-products"><?= $product_result->num_rows ?></p>
                </div>
                <!-- <div class="stat">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    <h3>Đơn hàng</h3>
                    <p id="total-orders"><?= $result->num_rows ?></p>
                </div> -->
            </div>
        </section>

        <!-- Section: Khách hàng -->
        <section id="users" class="section">
            <h2>Khách hàng</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $user_result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Section: Sản phẩm -->
        <section id="products" class="section">
            <h2>Sản phẩm</h2>
            <button class="btn add_product" onclick="document.getElementById('addProductModal').style.display='block'">Thêm Sản Phẩm</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên Giày</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                  <?php while ($product = $product_result->fetch_assoc()) : ?>
                      <tr>
                          <td><?= $product['product_id'] ?></td>
                          <td>
                              <?php if (!empty($product['img'])): ?>
                                  <img src="../assets/img/<?= $product['img'] ?>" alt="Ảnh" width="100px">
                              <?php else: ?>
                                  <p>No image</p>
                              <?php endif; ?>
                          </td>
                          <td><?= $product['name'] ?></td>
                          <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                          <td><?= $product['stock'] ?></td>
                          <td>
                              <button class="btn edit" 
                                  onclick="openEditModal(
                                      <?= $product['product_id'] ?>, 
                                      '<?= addslashes($product['name']) ?>', 
                                      <?= $product['price'] ?>, 
                                      <?= $product['stock'] ?>, 
                                      '<?= $product['img'] ?>'
                                  )">Sửa</button>
                              <a href="?delete_product=<?= $product['product_id'] ?>" class="btn delete" onclick="return confirmDelete('<?= addslashes($product['name']) ?>')" style="text-decoration:none">Xóa</a>
                          </td>
                      </tr>
                  <?php endwhile; ?>
              </tbody>

            </table>
        </section>
        <!-- Section: Đơn hàng theo khách hàng -->
        <section id="orders-by-user" class="section">
            <h2>QLĐH theo khách hàng</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Mã khách hàng</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Xem đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $user_result1->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><a href="#" class="view-orders" data-user-id="<?= $user['user_id'] ?>">Xem</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div id="order-details"></div> 
        </section>
        <!-- Section: Đơn hàng -->
        <section id="orders" class="section">    
                <h2>Đang giao</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tài khoản người dùng</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result_dang_giao->fetch_assoc()) : ?>
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="fetchOrderDetails(<?= $row['order_id'] ?>)">
                                    <?= htmlspecialchars($row['order_id']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td>
                                <?= htmlspecialchars($row['status']) ?>
                                <select id="order-status-<?= $row['order_id'] ?>" name="order-status" onchange="updateOrderStatus(<?= $row['order_id'] ?>, this.value)">
                                    <option value="dang-giao" <?= $row['status'] === 'dang-giao' ? 'selected' : '' ?>>Đang giao</option>
                                    <option value="da-giao" <?= $row['status'] === 'da-giao' ? 'selected' : '' ?>>Đã giao</option>
                                    <option value="thanh-toan-thanh-cong" <?= $row['status'] === 'thanh-toan-thanh-cong' ? 'selected' : '' ?>>Thanh toán thành công</option>
                                </select>
                            </td>
                        </tr>
                        <tr id="order-details-<?= $row['order_id'] ?>" style="display: none;">
                            <td colspan="4">
                                <div></div>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                    </tbody>
                </table>

                <h2>Đã giao</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tài khoản người dùng</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_da_giao->fetch_assoc()) : ?>
                            <tr>
                                <td>
                                    <a href="javascript:void(0);" onclick="fetchOrderDetails(<?= $row['order_id'] ?>)">
                                        <?= htmlspecialchars($row['order_id']) ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <?= htmlspecialchars($row['status']) ?>
                                    <select id="order-status-<?= $row['order_id'] ?>" name="order-status" onchange="updateOrderStatus(<?= $row['order_id'] ?>, this.value)">
                                        <option value="dang-giao" <?= $row['status'] === 'dang-giao' ? 'selected' : '' ?>>Đang giao</option>
                                        <option value="da-giao" <?= $row['status'] === 'da-giao' ? 'selected' : '' ?>>Đã giao</option>
                                        <option value="thanh-toan-thanh-cong" <?= $row['status'] === 'thanh-toan-thanh-cong' ? 'selected' : '' ?>>Thanh toán thành công</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="order-details-<?= $row['order_id'] ?>" style="display: none;">
                                <td colspan="4">
                                    <div></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <h2>Thanh toán thành công</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tài khoản người dùng</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_thanh_toan_thanh_cong->fetch_assoc()) : ?>
                            <tr>
                                <td>
                                    <a href="javascript:void(0);" onclick="fetchOrderDetails(<?= $row['order_id'] ?>)">
                                        <?= htmlspecialchars($row['order_id']) ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <?= htmlspecialchars($row['status']) ?>
                                    <select id="order-status-<?= $row['order_id'] ?>" name="order-status" onchange="updateOrderStatus(<?= $row['order_id'] ?>, this.value)">
                                        <option value="dang-giao" <?= $row['status'] === 'dang-giao' ? 'selected' : '' ?>>Đang giao</option>
                                        <option value="da-giao" <?= $row['status'] === 'da-giao' ? 'selected' : '' ?>>Đã giao</option>
                                        <option value="thanh-toan-thanh-cong" <?= $row['status'] === 'thanh-toan-thanh-cong' ? 'selected' : '' ?>>Thanh toán thành công</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="order-details-<?= $row['order_id'] ?>" style="display: none;">
                                <td colspan="4">
                                    <div></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>

    </main>

    <!-- Modal: Thêm Sản Phẩm -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <span class="close " onclick="document.getElementById('addProductModal').style.display='none'">&times;</span>
            <form action="admin.php" method="POST" enctype="multipart/form-data">
                <h3 class="">Thêm Sản Phẩm</h3>
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" required>
                <label for="price">Giá:</label>
                <input type="text" id="price" name="price" required>
                <label for="stock">Số lượng:</label>
                <input type="number" id="stock" name="stock" required>
                <label for="image">Hình ảnh:</label>
                <input type="file" id="image" name="image" required>
                <button class="" type="submit" name="add_product">Thêm</button>
            </form>
        </div>
    </div>

<!-- Modal: Sửa Sản Phẩm -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form method="POST" enctype="multipart/form-data">
            <h3>Sửa Sản Phẩm</h3>
            <input type="hidden" id="product_id" name="product_id">
            <label for="name">Tên sản phẩm</label>
            <input type="text" id="edit_name" name="name" required>
            <label for="price">Giá</label>
            <input type="number" id="edit_price" name="price" required>
            <label for="stock">Số lượng</label>
            <input type="number" id="edit_stock" name="stock" required>
            <label for="image">Hình ảnh</label>
            <input type="file" id="edit_image" name="image">
            <button type="submit" name="edit_product">Cập nhật</button>
        </form>
    </div>
</div>


<script>
function openEditModal(productId, name, price, stock, img) {
    // Hiển thị modal
    const modal = document.getElementById('editModal');
    modal.style.display = 'block';

    // Điền thông tin sản phẩm vào form
    document.getElementById('product_id').value = productId;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_price').value = price;
    document.getElementById('edit_stock').value = stock;

    // Đặt hình ảnh cũ nếu có
    if (img) {
        document.getElementById('edit_image_preview').src = `../assets/img/${img}`;
        document.getElementById('edit_image_preview').style.display = 'block';
    } else {
        document.getElementById('edit_image_preview').style.display = 'none';
    }
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

</script>


    <script>
        // JS cho modal
        var modal = document.getElementById("addProductModal");
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
      const menuItems = document.querySelectorAll(".menu a");
      const sections = document.querySelectorAll(".section");
      menuItems.forEach((item) => {
        item.addEventListener("click", (event) => {
          event.preventDefault();
          menuItems.forEach((menuItem) => menuItem.classList.remove("active"));
          item.classList.add("active");
          sections.forEach((section) => {
            section.style.display = "none";
          });
          const sectionId = item.getAttribute("data-section");
          const activeSection = document.getElementById(sectionId);
          if (activeSection) {
            activeSection.style.display = "block";
          }
        });
      });
      document.addEventListener("DOMContentLoaded", () => {
        sections.forEach((section) => (section.style.display = "none"));
        document.getElementById("dashboard").style.display = "block";
      });
    </script>
<script>
    function confirmDelete(productName) {
    return confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${productName}" không?`); }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateOrderStatus(orderId, newStatus) {
        // Tạo đối tượng XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Mở kết nối POST
        xhr.open('POST', '../view/update_order_status.php', true);

        // Định nghĩa kiểu dữ liệu mà bạn sẽ gửi (x-www-form-urlencoded là kiểu phổ biến cho POST)
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Lắng nghe phản hồi từ server
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText); // In ra phản hồi từ PHP
                alert(xhr.responseText); // Hiển thị thông báo phản hồi
                location.reload();
            }
        };

        // Gửi dữ liệu (dưới dạng x-www-form-urlencoded)
        var data = "order_id=" + orderId + "&status=" + encodeURIComponent(newStatus);
        xhr.send(data);
    }
</script>
<script>
    function fetchOrderDetails(orderId) {
        var detailsRow = document.getElementById('order-details-' + orderId);
        var detailsDiv = detailsRow.querySelector('div');

        // Kiểm tra nếu đã ẩn thì hiển thị và gọi AJAX
        if (detailsRow.style.display === 'none') {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../view/fetch_order_details.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    detailsDiv.innerHTML = xhr.responseText; // Đưa nội dung vào div
                    detailsRow.style.display = 'table-row'; // Hiển thị hàng
                }
            };
            xhr.send('order_id=' + orderId); // Gửi order_id đến PHP
        } else {
            // Ẩn chi tiết nếu đã hiển thị
            detailsRow.style.display = 'none';
        }
    }
</script>
<script>
document.querySelectorAll('.view-orders').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        const userId = this.getAttribute('data-user-id');

        fetch(`../view/get_user_orders.php?user_id=${userId}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('order-details').innerHTML = data;
            })
            .catch(error => console.error('Lỗi khi tải đơn hàng:', error));
    });
});
</script>



</body>
</html>
