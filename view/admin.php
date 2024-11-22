<?php
// Kết nối database
include '../database/connect.php';

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

// Lấy dữ liệu giỏ hàng
$cart_sql = "SELECT 
                shopping_cart.cart_id AS cart_id,
                products.product_id AS product_id,
                products.name AS product_name,
                products.price AS product_price,
                cart_items.quantity AS cart_quantity,
                (products.price * cart_items.quantity) AS total_price
            FROM shopping_cart
            INNER JOIN cart_items ON shopping_cart.cart_id = cart_items.cart_id
            INNER JOIN products ON cart_items.product_id = products.product_id";
$cart_stmt = $conn->prepare($cart_sql);
$cart_stmt->execute();
$cart_result = $cart_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/js/admin.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
        <img src="../assets/img/header_img/logo.png" alt="" style="width: 200px;">
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
            <a href="#" data-section="orders">
                <i class="fa-solid fa-cart-shopping"></i> Đơn hàng
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
                    <p id="total-customers"><?= $user_result->num_rows ?></p>
                </div>
                <div class="stat">
                    <i class="fa-solid fa-shoe-prints"></i>
                    <h3>Sản phẩm</h3>
                    <p id="total-products"><?= $product_result->num_rows ?></p>
                </div>
                <div class="stat">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    <h3>Đơn hàng</h3>
                    <p id="total-orders"><?= $cart_result->num_rows ?></p>
                </div>
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
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên Giày</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $product_result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $product['product_id'] ?></td>
                            
                            <!-- Hiển thị hình ảnh -->
                            <td>
                                <?php if (!empty($product['img'])): ?>
                                    <img src="\PHP_Project\assets\img\<?= $product['img'] ?>" alt="" width="100pxx.">
                                <?php else: ?>
                                    <p>No image</p>
                                <?php endif; ?>
                            </td>

                            
                            <td><?= $product['name'] ?></td>
                            <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                            <td><?= $product['stock'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>

            </table>
        </section>

        <!-- Section: Đơn hàng -->
        <section id="orders" class="section">
            <h2>Đơn hàng</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Giỏ Hàng</th>
                        <th>Tên Giày</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($cart_result->num_rows > 0) {
                        while ($cart = $cart_result->fetch_assoc()) : ?>
                            <tr>
                                <td><?= $cart['cart_id'] ?></td>
                                <td><?= $cart['product_name'] ?></td>
                                <td><?= number_format($cart['product_price'], 0, ',', '.') ?> VND</td>
                                <td><?= $cart['cart_quantity'] ?></td>
                                <td><?= number_format($cart['total_price'], 0, ',', '.') ?> VND</td>
                            </tr>
                        <?php endwhile;
                    } else {
                        echo "<tr><td colspan='5'>Giỏ hàng của bạn hiện tại đang trống.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <p>Sneaker Home Admin © 2024</p>
        </footer>
    </main>
</body>
</html>
