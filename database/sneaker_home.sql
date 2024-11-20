-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 02:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sneaker_home`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `cart_id`, `product_id`, `size`, `quantity`) VALUES
(1, 1, 17, 'M', 8);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `parent_id`) VALUES
(1, 'Phụ kiện', NULL),
(2, 'Balo', NULL),
(3, 'Giày', NULL),
(4, 'Quần áo', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favourite_products`
--

CREATE TABLE `favourite_products` (
  `favourite_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('đang xử lý','hoàn thành','hủy bỏ') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('thành công','thất bại') NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock_quantity`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Mũ Adidas', 'Mũ thể thao Adidas cho mùa hè', 300000.00, 100, 1, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(2, 'Dép Nike', 'Dép Nike chính hãng, thoải mái và thời trang', 500000.00, 50, 1, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(3, 'Dép Adidas', 'Dép Adidas đế mềm, cực kỳ dễ chịu', 450000.00, 60, 1, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(4, 'Dép MLB', 'Dép MLB với thiết kế độc đáo và phong cách', 600000.00, 40, 1, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(5, 'Tất thể thao Nike', 'Tất thể thao Nike thoáng khí, thấm hút mồ hôi tốt', 100000.00, 150, 1, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(6, 'Kính mát Ray-Ban', 'Kính mát Ray-Ban phong cách thời trang cao cấp', 1200000.00, 30, 1, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(7, 'Balo Herschel', 'Balo Herschel thời trang và chắc chắn', 1500000.00, 20, 2, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(8, 'Giày Puma Mule', 'Giày Puma Mule, phong cách trẻ trung', 850000.00, 50, 3, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(9, 'Giày Puma RS', 'Giày Puma RS, mẫu giày thể thao hiện đại', 950000.00, 60, 3, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(10, 'Giày Nike Air Max 1', 'Giày Nike Air Max 1, giày thể thao phong cách', 2200000.00, 40, 3, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(11, 'Giày Nike Air Max 90', 'Giày Nike Air Max 90, mẫu giày thể thao cực kỳ nổi bật', 2500000.00, 45, 3, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(12, 'Giày Nike Air Zoom', 'Giày Nike Air Zoom, dành cho chạy bộ và thể thao', 2400000.00, 55, 3, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(13, 'Giày Adidas', 'Giày thể thao Adidas, thoải mái và bền bỉ', 1800000.00, 70, 3, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(14, 'Áo thun Nike', 'Áo thun thể thao Nike, mềm mại và thoải mái', 400000.00, 100, 4, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(15, 'Áo thun Adidas', 'Áo thun Adidas chất liệu cotton, dễ chịu', 450000.00, 80, 4, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(16, 'Quần thể thao Puma', 'Quần thể thao Puma thoải mái cho mọi hoạt động', 550000.00, 50, 4, '2024-11-15 09:51:17', '2024-11-15 09:51:17'),
(17, 'Dép Nike Air Force 1', 'Dép Nike Air Force 1, cực kỳ thoải mái và phong cách', 550000.00, 80, 1, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(18, 'Mũ Nike', 'Mũ thể thao Nike dành cho các vận động viên', 350000.00, 120, 1, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(19, 'Kính mát Oakley', 'Kính mát Oakley, bảo vệ mắt và phong cách thời trang', 1300000.00, 50, 1, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(20, 'Tất Adidas', 'Tất thể thao Adidas, thấm hút mồ hôi và thoải mái', 120000.00, 200, 1, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(21, 'Balo Adidas', 'Balo Adidas, thiết kế thời trang và tiện dụng', 1700000.00, 40, 2, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(22, 'Giày Puma Suede', 'Giày Puma Suede, chất liệu da, cực kỳ thời trang', 1600000.00, 65, 3, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(23, 'Giày Adidas Ultraboost', 'Giày Adidas Ultraboost, siêu thoải mái, tuyệt vời cho chạy bộ', 3200000.00, 50, 3, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(24, 'Giày Nike Air Max Plus', 'Giày Nike Air Max Plus, phong cách thể thao trẻ trung', 2800000.00, 40, 3, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(25, 'Giày Nike React Element 55', 'Giày Nike React Element 55, thể thao, nhẹ và bền bỉ', 2700000.00, 60, 3, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(26, 'Giày Adidas NMD', 'Giày Adidas NMD, thời trang, thoải mái và bền bỉ', 3000000.00, 50, 3, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(27, 'Áo khoác Nike', 'Áo khoác Nike thời trang, chất liệu chống thấm nước', 1300000.00, 30, 4, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(28, 'Áo thun Puma', 'Áo thun Puma chất liệu cotton, dễ chịu khi mặc', 450000.00, 150, 4, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(29, 'Quần short Adidas', 'Quần short Adidas phù hợp cho mùa hè, đi dạo, tập thể thao', 600000.00, 80, 4, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(30, 'Áo hoodie Nike', 'Áo hoodie Nike, ấm áp và thời trang', 1200000.00, 60, 4, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(31, 'Quần thể thao Adidas', 'Quần thể thao Adidas, cực kỳ thoải mái cho các hoạt động thể thao', 750000.00, 50, 4, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(32, 'Quần jeans Adidas', 'Quần jeans Adidas, thiết kế trẻ trung và năng động', 950000.00, 70, 4, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(33, 'Áo sơ mi Levi\'s', 'Áo sơ mi Levi\'s, phong cách casual cho mọi dịp', 800000.00, 90, 4, '2024-11-15 09:46:18', '2024-11-15 09:46:18'),
(34, 'Quần kaki Levi\'s', 'Quần kaki Levi\'s, chất liệu bền bỉ, phù hợp cho công sở', 1200000.00, 60, 4, '2024-11-15 09:46:18', '2024-11-15 09:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `product_size_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwordd` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `passwordd`, `created_at`, `updated_at`) VALUES
(1, 'minhhoang123123', 'minhhoang123123@gmail.com', '123123', '2024-11-15 09:48:17', '2024-11-15 09:48:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `favourite_products`
--
ALTER TABLE `favourite_products`
  ADD PRIMARY KEY (`favourite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`product_size_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `favourite_products`
--
ALTER TABLE `favourite_products`
  MODIFY `favourite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `product_size_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `shopping_cart` (`cart_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `favourite_products`
--
ALTER TABLE `favourite_products`
  ADD CONSTRAINT `favourite_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favourite_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
