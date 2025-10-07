-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 10:06 PM
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
-- Database: `estorefinaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `first_name`, `last_name`, `password`) VALUES
(1, 'Mahmud', 'Ullah', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `autoincrement` int(100) NOT NULL,
  `product_id` int(10) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` int(20) NOT NULL,
  `order_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`autoincrement`, `product_id`, `size`, `user_id`, `quantity`, `total`, `order_id`) VALUES
(1, 4, NULL, 1, 1, 500, 1),
(2, 4, NULL, 1, 10, 5000, 2),
(3, 4, NULL, 1, 1, 500, 3),
(4, 4, NULL, 1, 1, 500, 4),
(5, 4, NULL, 1, 1, 800, 5),
(6, 3, NULL, 1, 1, 3000, 6),
(7, 22, NULL, 1, 1, 1690, 8),
(8, 21, NULL, 1, 1, 19990, 9),
(9, 20, NULL, 1, 1, 10000, 10),
(10, 20, NULL, 1, 1, 10000, 11),
(11, 21, NULL, 1, 1, 19990, 11);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `autoincrement` int(100) NOT NULL,
  `product_id` int(10) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Sports'),
(2, 'Casual Shoes'),
(3, 'Hiking Shoes'),
(4, 'Power Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_code` varchar(50) NOT NULL,
  `money` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `status`) VALUES
(1, 1, 'delivered'),
(2, 1, 'delivered'),
(3, 1, 'delivered'),
(4, 1, 'delivered'),
(5, 1, 'pending'),
(6, 1, 'delivered'),
(7, 1, 'pending'),
(8, 1, 'pending'),
(9, 1, 'pending'),
(10, 1, 'pending'),
(11, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `category_id` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `description` varchar(2000) NOT NULL,
  `price` int(10) NOT NULL,
  `icon_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `category_id`, `date_added`, `description`, `price`, `icon_name`) VALUES
(3, 'Nike Air Max 90', 4, '2025-09-25 14:30:00', 'Iconic running shoe with visible Air cushioning and durable rubber outsole. Crafted with premium leather and mesh upper for breathability, weighs approximately 12 oz, perfect for casual wear and light jogging with a retro aesthetic.', 3980, '1.jpg'),
(4, 'Nike Air Max 97', 4, '2025-09-26 09:15:00', 'Sleek design with full-length Air unit for comfort and style. Features a reflective upper made of synthetic materials, weighs 13 oz, ideal for urban walks and fashion-forward running with a futuristic look.', 5980, '2.jpg'),
(14, 'Nike Dunk Low', 3, '2025-09-27 10:45:00', 'Low-profile sneaker with vibrant colors and premium leather upper. Lightweight at 11 oz, offers excellent ankle support, perfect for street style and casual sports with a versatile color palette.', 9980, '3.jpg'),
(15, 'Nike LeBron 18', 1, '2025-09-24 16:20:00', 'High-performance basketball shoe with responsive Zoom Air cushioning. Constructed with knit and synthetic overlays, weighs 14 oz, designed for explosive jumps and court agility with superior traction.', 4480, '4.jpg'),
(16, 'Nike Free RN Flyknit', 1, '2025-09-25 11:10:00', 'Flexible running shoe with breathable Flyknit upper for natural movement. Features a lightweight 10 oz design, ideal for trail running and daily workouts with a sock-like fit and flexible sole.', 5480, '5.jpg'),
(17, 'Nike KD 14', 1, '2025-09-26 13:50:00', 'Lightweight basketball shoe with enhanced stability and cushioning. Made with engineered mesh upper, weighs 13 oz, optimized for speed and lateral movements on the court with a snug fit.', 7980, '6.jpg'),
(18, 'Nike Metcon 6', 1, '2025-09-27 08:30:00', 'Durable training shoe designed for crossfit and gym workouts. Features a reinforced toe cap and 12 oz weight, perfect for weightlifting and high-intensity interval training with excellent grip.', 3880, '7.jpg'),
(19, 'Nike Blazer Mid 77', 1, '2025-09-24 15:00:00', 'Retro basketball shoe with modern comfort and suede detailing. Weighs 11.5 oz, crafted with a padded collar for ankle support, ideal for casual wear and vintage-inspired street style.', 4180, '8.jpg'),
(20, 'Nike Odyssey React', 1, '2025-09-25 17:25:00', 'Supportive running shoe with React foam for a smooth ride. Features a breathable mesh upper and 11 oz weight, designed for long-distance running with added arch support and durability.', 2880, '9.jpg'),
(21, 'Nike Roshe Run', 1, '2025-09-26 12:15:00', 'Casual shoe with lightweight design and cushioned sole. Made with a single-layer mesh upper, weighs 9 oz, perfect for all-day comfort and minimalist style with a padded insole.', 12980, '10.jpg'),
(22, 'Nike Kobe 5', 1, '2025-09-27 11:00:00', 'Agile basketball shoe with low-profile cushioning and grip. Crafted with a synthetic upper, weighs 12 oz, optimized for quick cuts and jumps with a sleek, low-to-the-ground design.', 11980, '11.jpg'),
(23, 'Nike Lunar Glide', 1, '2025-09-25 14:00:00', 'Comfortable running shoe with Lunarlon foam for a soft landing. Features a supportive mesh upper and 13 oz weight, ideal for marathon training with enhanced shock absorption.', 16980, '12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `product_size_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `size` varchar(10) NOT NULL,
  `stock_quantity` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`product_size_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`product_id`, `size`, `stock_quantity`) VALUES
(3, 'US 7', 10),
(3, 'US 8', 15),
(3, 'US 9', 8),
(3, 'US 10', 12),
(4, 'US 7', 5),
(4, 'US 8', 20),
(4, 'US 9', 10),
(14, 'US 8', 15),
(14, 'US 9', 10),
(14, 'US 10', 8),
(15, 'US 9', 12),
(15, 'US 10', 15),
(15, 'US 11', 6),
(16, 'US 7', 8),
(16, 'US 8', 12),
(16, 'US 9', 10),
(17, 'US 8', 15),
(17, 'US 9', 10),
(17, 'US 10', 8),
(18, 'US 7', 10),
(18, 'US 8', 15),
(18, 'US 9', 12),
(19, 'US 8', 8),
(19, 'US 9', 10),
(19, 'US 10', 6),
(20, 'US 7', 12),
(20, 'US 8', 15),
(20, 'US 9', 10),
(21, 'US 8', 10),
(21, 'US 9', 8),
(21, 'US 10', 12),
(22, 'US 7', 6),
(22, 'US 8', 10),
(22, 'US 9', 8),
(23, 'US 8', 12),
(23, 'US 9', 15),
(23, 'US 10', 10);

-- --------------------------------------------------------

--
-- Table structure for table `userss`
--

CREATE TABLE `userss` (
  `user_id` int(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(34) NOT NULL,
  `wallet` int(20) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userss`
--

INSERT INTO `userss` (`user_id`, `first_name`, `last_name`, `password`, `wallet`, `address`) VALUES
(1, 'Mahmud', 'Ullah', '12345678', 20000, 'Uttara'),
(2, 'Dipro', 'Rahman', '12345678', 6000, 'Malibagh'),
(3, 'Aumio', 'Khan', '12345678', 10000, 'Bashundhara'),
(4, 'Rifat', 'Khan', '12345678', 1200, 'Uttara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`autoincrement`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`autoincrement`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `userss`
--
ALTER TABLE `userss`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `autoincrement` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `autoincrement` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `product_size_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userss`
--
ALTER TABLE `userss`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `buy_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `buy_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userss` (`user_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userss` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userss` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;