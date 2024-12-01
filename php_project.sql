-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 05:22 PM
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
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(10,2) NOT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(15) DEFAULT NULL,
  `user_city` varchar(100) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(3, 175.00, 'on_hold', 1, '125993700', 'Seri Kembangan', 'Taman Pinggiran Putra', '2024-12-01 13:45:03'),
(9, 80.00, 'on_hold', 2, '123456789', 'Cheras', '5, jalan 57. Taman Connaught, Selangor', '2024-12-01 15:51:10'),
(10, 234.00, 'on_hold', 1, '125993700', 'Seri Kembangan', 'Taman Pinggiran Putra', '2024-12-01 15:53:40'),
(11, 75.00, 'on_hold', 4, '123456783', 'Ipoh', '3, Taman Bahagia, Ipoh, Malaysia ', '2024-12-01 16:46:48'),
(12, 70.00, 'on_hold', 4, '125993700', 'Seri Kembangan', 'Taman Pinggiran Putra', '2024-12-01 16:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_image_url` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image_url`, `user_id`, `order_date`) VALUES
(1, 3, 3, 'Nike Air Max', NULL, 1, '2024-12-01 13:45:03'),
(2, 3, 2, 'Puma Sporty Sneakers', NULL, 1, '2024-12-01 13:45:03'),
(9, 9, 2, 'Puma Sporty Sneakers', 'img/products/f2.jpg', 2, '2024-12-01 15:51:10'),
(10, 10, 6, 'Nike Air Force', 'img/products/f6.jpg', 1, '2024-12-01 15:53:40'),
(11, 11, 11, 'Converse Chuck 70', 'img/products/n3.jpg', 4, '2024-12-01 16:46:48'),
(12, 12, 14, 'Converse Chuck Taylor All-Star', 'img/products/n6.jpg', 4, '2024-12-01 16:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_brand` varchar(255) DEFAULT NULL,
  `product_image_url` varchar(255) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_rating` float DEFAULT NULL,
  `product_stock_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_brand`, `product_image_url`, `product_description`, `product_price`, `product_rating`, `product_stock_quantity`) VALUES
(1, 'Puma Classic Sneakers', 'Puma', 'img/products/f1.jpg', 'Timeless design meets all-day comfort in the Puma Classic Sneakers. Ideal for casual wear, these shoes feature a durable upper and cushioned sole.', 75.00, 4.5, 100),
(2, 'Puma Sporty Sneakers', 'Puma', 'img/products/f2.jpg', 'Designed for performance, the Puma Sporty Sneakers offer excellent support and breathability. Perfect for both workouts and casual outings.', 80.00, 5, 150),
(3, 'Nike Air Max', 'Nike', 'img/products/f3.jpg', 'Nike Air Max combines style and comfort with signature Air cushioning. Great for everyday wear and light activities.', 95.00, 4.5, 200),
(4, 'Nike Running Shoes', 'Nike', 'img/products/f4.jpg', 'High-performance Nike Running Shoes built for speed and support. A perfect choice for runners seeking comfort and durability.', 100.00, 4.5, 120),
(5, 'Nike Court Vision', 'Nike', 'img/products/f5.jpg', 'Nike Court Vision shoes blend tennis-inspired style with everyday comfort. Great for on and off the court activities.', 85.00, 5, 80),
(6, 'Nike Air Force', 'Nike', 'img/products/f6.jpg', 'Nike Air Force offers iconic style with a modern twist. Durable and comfortable, these shoes are perfect for casual wear.', 78.00, 5, 90),
(7, 'Nike Revolution', 'Nike', 'img/products/f7.jpg', 'Nike Revolution features innovative design for active lifestyles. Lightweight and supportive for running and gym sessions.', 100.00, 5, 60),
(8, 'Nike Zoom', 'Nike', 'img/products/f8.jpg', 'Step into action with Nike Zoom, featuring responsive cushioning for an energized feel. Ideal for athletes and fitness enthusiasts.', 85.00, 5, 70),
(9, 'Adidas Ultraboost', 'Adidas', 'img/products/n1.jpg', 'Adidas Ultraboost delivers exceptional comfort and energy return with its responsive midsole. Ideal for long runs and casual wear.', 120.00, 5, 50),
(10, 'Adidas Originals', 'Adidas', 'img/products/n2.jpg', 'Adidas Originals offers classic style with modern comfort. These sneakers are a great choice for fashion-forward individuals.', 110.00, 5, 65),
(11, 'Converse Chuck 70', 'Converse', 'img/products/n3.jpg', 'Converse Chuck 70 showcases timeless design and premium materials. A must-have for sneaker enthusiasts seeking a retro vibe.', 75.00, 5, 100),
(12, 'Converse All-Star', 'Converse', 'img/products/n4.jpg', 'Converse All-Star brings classic style to everyday wear. Versatile and durable, ideal for casual outings and laid-back looks.', 65.00, 5, 85),
(13, 'New Balance 574', 'New Balance', 'img/products/n5.jpg', 'New Balance 574 combines vintage style with modern comfort. Perfect for daily wear and casual outings.', 78.00, 5, 75),
(14, 'Converse Chuck Taylor All-Star', 'Converse', 'img/products/n6.jpg', 'Iconic Chuck Taylor All-Star sneakers feature classic styling and a lightweight feel. Ideal for everyday wear and casual events.', 70.00, 5, 95),
(15, 'Adidas NMD_R1', 'Adidas', 'img/products/n8.jpg', 'Adidas NMD_R1 blends modern design with innovative comfort. Great for urban adventures and casual wear.', 135.00, 5, 150),
(16, 'Reebok Classic Leather', 'Reebok', 'img/products/n7.jpg', 'Reebok Classic Leather offers timeless style and exceptional comfort. A versatile choice for both casual and athletic wear.', 85.00, 5, 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Bryan ', 'bryansong25@gmail.com', '$2y$10$SfYS/w1Pl4MTutnrCuBHfuq5eFhPU1cUtr72j/twmWSCnMTOfKor.'),
(2, 'Chloe', 'chloe28@gmail.com', '$2y$10$2y7qHSm7Nnwg3U8wsfDqCeeX3Q2pmvhAA3ugsD/kCYFQ0GJM747zK'),
(4, 'garry', 'garry65@gmail.com', '$2y$10$0FfTno6tvICu/wflOkqhleaC8SvgS09It8wu/zQIVhnpgB6JtdJ5e');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
