-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 04:48 PM
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
-- Database: `db_porsche_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `status` enum('active','discontinued') DEFAULT 'active',
  `name` varchar(50) NOT NULL,
  `model_id` int(11) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `color` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine` varchar(100) DEFAULT NULL,
  `horsepower` int(11) DEFAULT NULL,
  `max_speed` int(11) DEFAULT NULL,
  `transmission` enum('Automatic','Manual') DEFAULT NULL,
  `fuel_type` enum('Gasoline','Electric','Hybrid') DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `image_url` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `status`, `name`, `model_id`, `slug`, `year`, `price`, `color`, `engine`, `horsepower`, `max_speed`, `transmission`, `fuel_type`, `description`, `stock`, `image_url`, `created_at`) VALUES
(1, 'active', '911 Carrera', 1, '911-carrera', '2024', 8870000000.00, 'Silver Metallic', '3.0L Twin-Turbo Flat-6', 394, 294, 'Automatic', 'Gasoline', 'Mẫu xe thể thao huyền thoại với thiết kế tinh tế.', 5, '911_carrera_silver_metallic.png', '2025-04-20 12:23:51'),
(2, 'active', '911 Targa 4 GTS', 3, '911-targa-4-gts', '2024', 9999999999.99, 'Red', '3.0L Twin-Turbo Flat-6', 394, 294, 'Automatic', 'Gasoline', 'Mẫu xe thể thao huyền thoại với thiết kế tinh tế.', 5, '911_targa_4_gts_red.png', '2025-04-20 12:23:51'),
(4, 'active', '911 Carrera 2', 1, '911-carrera-2', '2024', 8870000000.00, 'Silver Metallic', '3.0L Twin-Turbo Flat-6', 394, 294, 'Automatic', 'Gasoline', 'Mẫu xe thể thao huyền thoại với thiết kế tinh tế.', 5, '911_carrera_silver_metallic.png', '2025-04-20 12:23:51'),
(5, 'active', '911 Carrera 3', 1, '911-carrera-3', '2024', 8870000000.00, 'Silver Metallic', '3.0L Twin-Turbo Flat-6', 394, 294, 'Automatic', 'Gasoline', 'Mẫu xe thể thao huyền thoại với thiết kế tinh tế.', 5, '911_carrera_silver_metallic.png', '2025-04-20 12:23:51'),
(6, 'active', '911 Carrera 4', 1, '911-carrera-4', '2024', 8870000000.00, 'Silver Metallic', '3.0L Twin-Turbo Flat-6', 394, 294, 'Automatic', 'Gasoline', 'Mẫu xe thể thao huyền thoại với thiết kế tinh tế.', 5, '911_carrera_silver_metallic.png', '2025-04-20 12:23:51'),
(8, 'active', '911 Targa 4 GTS 2', 3, '911-targa-4-gts-2', '2024', 9999999999.99, 'Red', '3.0L Twin-Turbo Flat-6', 394, 294, 'Automatic', 'Gasoline', 'Mẫu xe thể thao huyền thoại với thiết kế tinh tế.', 5, '911_targa_4_gts_red.png', '2025-04-20 12:23:51'),
(9, 'active', '911 Targa 4 GTS 3', 3, '911-targa-4-gts-3', '2024', 9999999999.99, 'Red', '3.0L Twin-Turbo Flat-6', 394, 294, 'Automatic', 'Gasoline', 'Mẫu xe thể thao huyền thoại với thiết kế tinh tế.', 5, '911_targa_4_gts_red.png', '2025-04-20 12:23:51'),
(11, 'active', '718 Cayman S', 4, '718-cayman-s', '2024', 1.00, 'green', 'turbo ', 300, 299, 'Automatic', 'Gasoline', '', 10, '718-cayman-s.png', '2025-04-21 17:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `car_images`
--

CREATE TABLE `car_images` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `is_thumbnail` tinyint(1) DEFAULT 0,
  `image_type` enum('noi that','ngoai that','dong co') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_images`
--

INSERT INTO `car_images` (`id`, `car_id`, `image_url`, `is_thumbnail`, `image_type`) VALUES
(1, 1, '911_carrera_front_view.png', 1, 'ngoai that'),
(2, 1, '911_carrera_rear_view.png', 0, 'ngoai that'),
(3, 1, '911_carrera_interior.png', 0, 'noi that'),
(4, 2, '911_targa_4_gts_front.png', 1, 'ngoai that'),
(5, 2, '911_targa_4_gts_interior.png', 0, 'noi that'),
(6, 2, '911_targa_4_gts_engine.png', 0, 'dong co');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image_url` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image_url`) VALUES
(1, '911', '911.png'),
(2, '718', '718.png'),
(3, 'Taycan', 'taycan.png'),
(4, 'Panamera', 'panamera.png'),
(5, 'Cayenne', 'cayenne.png');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image_url` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `name`, `image_url`, `category_id`) VALUES
(1, 'Phiên bản 911 Carrera Coupé', NULL, 1),
(2, 'Phiên bản 911 Carrera Cabriolet', NULL, 1),
(3, 'Phiên bản 911 Targa 4 GTS', NULL, 1),
(4, 'Phiên bản 718 Cayman', NULL, 2),
(5, 'Phiên bản 718 Boxster', NULL, 2),
(6, 'Phiên bản 718 Style Edition', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(12,2) NOT NULL,
  `status` enum('Pending','Confirmed','Cancelled') DEFAULT 'Pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_gateway` varchar(50) DEFAULT NULL,
  `payment_status` enum('Pending','Success','Failed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `phone`, `address`, `role`, `created_at`, `updated_at`, `is_verified`) VALUES
(1, 'admin01', 'hashed_password_1', 'admin01@example.com', 'Admin One', '0123456789', '123 Main Street, Ho Chi Minh', 'admin', '2025-04-20 11:32:19', '2025-04-20 11:32:19', 1),
(2, 'customer01', 'hashed_password_2', 'customer01@example.com', 'Nguyen Van A', '0987654321', '456 Second Street, Ha Noi', 'customer', '2025-04-20 11:32:19', '2025-04-20 11:32:19', 0),
(3, 'customer02', 'hashed_password_3', 'customer02@example.com', 'Tran Thi B', '0912345678', '789 Third Street, Da Nang', 'customer', '2025-04-20 11:32:19', '2025-04-20 11:32:19', 1),
(4, 'customer03', 'hashed_password_4', 'customer03@example.com', 'Le Van C', '0908765432', '101 Fourth Street, Can Tho', 'customer', '2025-04-20 11:32:19', '2025-04-20 11:32:19', 0),
(5, 'customer04', 'hashed_password_5', 'customer04@example.com', 'Pham D', '0923456789', '202 Fifth Street, Hai Phong', 'customer', '2025-04-20 11:32:19', '2025-04-20 11:32:19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `model_id` (`model_id`);

--
-- Indexes for table `car_images`
--
ALTER TABLE `car_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `car_images`
--
ALTER TABLE `car_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`);

--
-- Constraints for table `car_images`
--
ALTER TABLE `car_images`
  ADD CONSTRAINT `car_images_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;
CREATE TABLE `cart_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
