-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2026 at 04:55 PM
-- Server version: 8.0.44
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bag_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Túi xách tay'),
(2, 'Túi đeo vai'),
(3, 'Túi đeo chéo'),
(4, 'Túi tote'),
(18, 'Balo');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `order_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `customer_name`, `email`, `phone`, `address`, `total_amount`, `payment_method`, `status`, `created_at`) VALUES
(16, 'DH20251205034057269', ' ', '', '', 'Kim Long, Kim Long, Huế', 3250000.00, 'cod', 'Complete', '2025-12-05 03:40:57'),
(17, 'DH20251205035952921', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 2900000.00, 'cod', 'Cancelled', '2025-12-05 03:59:52'),
(18, 'DH20251205040343280', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 3900000.00, 'cod', 'Cancelled', '2025-12-05 04:03:43'),
(19, 'DH20251205040445256', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 2600000.00, 'cod', 'Complete', '2025-12-05 04:04:45'),
(20, 'DH20251205040742493', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 3400000.00, 'cod', 'Pending', '2025-12-05 04:07:42'),
(21, 'DH20251205040801894', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 2400000.00, 'cod', 'pending', '2025-12-05 04:08:01'),
(22, 'DH20251205040849907', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 4900000.00, 'cod', 'pending', '2025-12-05 04:08:49'),
(23, 'DH20251205041317108', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 2900000.00, 'cod', 'pending', '2025-12-05 04:13:17'),
(24, 'DH20251205041519934', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 2900000.00, 'cod', 'pending', '2025-12-05 04:15:19'),
(25, 'DH20251207032002302', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 5250000.00, 'cod', 'pending', '2025-12-07 03:20:02'),
(26, 'DH20251210165517464', 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', 'Nguyễn Hữu Dật, Kim Long, Huế', 9500000.00, 'cod', 'pending', '2025-12-10 16:55:17'),
(27, 'DH20251210173218941', 'Đặng Khánh Linh', 'dklinh@gmail.com', '0235697402', 'Đặng Tất, Kim Long, Huế', 2400000.00, 'cod', 'pending', '2025-12-10 17:32:18'),
(28, 'DH20251210173320686', 'Đặng Khánh Linh', 'dklinh@gmail.com', '0235697402', 'Đặng Tất, Kim Long, Huế', 13500000.00, 'cod', 'pending', '2025-12-10 17:33:20'),
(29, 'DH20251210175539938', 'Tống Phước Mỹ Hằng', 'tpmhang@gmail.com', '0356175135', 'Kim Long, Kim Long, Huế', 6600000.00, 'cod', 'Cancelled', '2025-12-10 17:55:39'),
(30, 'DH20251210180220454', 'Tống Phước Mỹ Hằng', 'tpmhang@gmail.com', '0356175155', 'Kim Long, Kim Long, Huế', 12350000.00, 'cod', 'pending', '2025-12-10 18:02:20'),
(31, 'DH20251210181216365', 'Tống Phước Mỹ Hằng', 'tpmhang@gmail.com', '0356175155', 'Kim Long, Kim Long, Huế', 4950000.00, 'cod', 'pending', '2025-12-10 18:12:16'),
(32, 'DH20251221090239896', 'khanhlinh linh', 'ssmith1@example.com', '0123456789', 'pm, a, hue', 2050000.00, 'bank-transfer', 'pending', '2025-12-21 09:02:39'),
(33, 'DH20251221091502877', 'khanh linh', 'dangkhanhlinhm10@gmail.com', '0123456789', 'mn, an, hue', 2200000.00, 'cod', 'Complete', '2025-12-21 09:15:02'),
(34, 'DH20260105152913762', 'khanh linh', 'dangkhanhlinhm10@gmail.com', '0123456789', 'mn, an, hue', 3050000.00, 'cod', 'Complete', '2026-01-05 15:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`) VALUES
(29, 16, 4, 2, 1200000.00, 2400000.00),
(30, 16, 3, 1, 850000.00, 850000.00),
(31, 17, 3, 2, 850000.00, 1700000.00),
(32, 17, 4, 1, 1200000.00, 1200000.00),
(33, 18, 4, 2, 1200000.00, 2400000.00),
(34, 18, 1, 1, 1500000.00, 1500000.00),
(35, 19, 21, 1, 1400000.00, 1400000.00),
(36, 19, 4, 1, 1200000.00, 1200000.00),
(37, 20, 2, 1, 2200000.00, 2200000.00),
(38, 20, 4, 1, 1200000.00, 1200000.00),
(39, 21, 4, 2, 1200000.00, 2400000.00),
(40, 22, 4, 2, 1200000.00, 2400000.00),
(41, 22, 3, 1, 850000.00, 850000.00),
(42, 22, 15, 1, 1650000.00, 1650000.00),
(43, 23, 3, 2, 850000.00, 1700000.00),
(44, 23, 4, 1, 1200000.00, 1200000.00),
(45, 24, 3, 2, 850000.00, 1700000.00),
(46, 24, 4, 1, 1200000.00, 1200000.00),
(47, 25, 2, 2, 2200000.00, 4400000.00),
(48, 25, 3, 1, 850000.00, 850000.00),
(49, 26, 2, 2, 2200000.00, 4400000.00),
(50, 26, 3, 3, 850000.00, 2550000.00),
(51, 26, 4, 1, 1200000.00, 1200000.00),
(52, 26, 8, 1, 1350000.00, 1350000.00),
(53, 27, 4, 2, 1200000.00, 2400000.00),
(54, 28, 8, 10, 1350000.00, 13500000.00),
(55, 29, 4, 3, 1200000.00, 3600000.00),
(56, 29, 1, 2, 1500000.00, 3000000.00),
(57, 30, 8, 5, 1350000.00, 6750000.00),
(58, 30, 6, 2, 2800000.00, 5600000.00),
(59, 31, 3, 3, 850000.00, 2550000.00),
(60, 31, 4, 2, 1200000.00, 2400000.00),
(61, 32, 3, 1, 850000.00, 850000.00),
(62, 32, 4, 1, 1200000.00, 1200000.00),
(63, 33, 2, 1, 2200000.00, 2200000.00),
(64, 34, 3, 1, 850000.00, 850000.00),
(65, 34, 2, 1, 2200000.00, 2200000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci DEFAULT 'active',
  `id_category` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `quantity`, `status`, `id_category`) VALUES
(1, 'Túi xách tay da thật cao cấp', 'tui_xach_tay_1.jpg', 1500000.00, 10, 'active', 1),
(2, 'Túi xách tay Chanel style', 'tui_xach_tay_2.jpg', 2200000.00, 5, 'active', 1),
(3, 'Túi xách tay mini cute', 'tui_xach_tay_3.jpg', 850000.00, 15, 'active', 1),
(4, 'Túi xách tay công sở', 'tui_xach_tay_4.jpg', 1200000.00, 8, 'active', 1),
(5, 'Túi xách tay vintage', 'tui_xach_tay_5.jpg', 980000.00, 12, 'active', 1),
(6, 'Túi xách tay Louis Vuitton style', 'tui_xach_tay_6.jpg', 2800000.00, 3, 'active', 1),
(7, 'Túi đeo vai da mềm', 'tui_deo_vai_1.jpg', 1100000.00, 20, 'active', 2),
(8, 'Túi đeo vai chain strap', 'tui_deo_vai_2.jpg', 1350000.00, 7, 'active', 2),
(9, 'Túi đeo vai bucket bag', 'tui_deo_vai_3.jpg', 950000.00, 18, 'active', 2),
(10, 'Túi đeo vai Gucci style', 'tui_deo_vai_4.jpg', 4500000.00, 10, 'active', 2),
(11, 'Túi đeo vai canvas', 'tui_deo_vai_5.jpg', 650000.00, 25, 'active', 2),
(12, 'Túi đeo vai quilted', 'tui_deo_vai_6.jpg', 1800000.00, 6, 'active', 2),
(13, 'Túi đeo vai mini flap', 'tui_deo_vai_7.jpg', 1050000.00, 14, 'active', 2),
(14, 'Túi đeo chéo thể thao', 'tui_deo_cheo_1.jpg', 450000.00, 30, 'active', 3),
(15, 'Túi đeo chéo da saffiano', 'tui_deo_cheo_2.jpg', 1650000.00, 9, 'active', 3),
(16, 'Túi đeo chéo belt bag', 'tui_deo_cheo_3.jpg', 750000.00, 22, 'active', 3),
(17, 'Túi đeo chéo camera bag', 'tui_deo_cheo_4.jpg', 890000.00, 16, 'active', 3),
(18, 'Túi đeo chéo nylon', 'tui_deo_cheo_5.jpg', 520000.00, 28, 'active', 3),
(19, 'Túi đeo chéo Prada style', 'tui_deo_cheo_6.jpg', 2100000.00, 5, 'active', 3),
(20, 'Túi tote canvas lớn', 'tui_tote_1.jpg', 380000.00, 35, 'active', 4),
(21, 'Túi tote da thật', 'tui_tote_2.jpg', 1400000.00, 11, 'active', 4),
(22, 'Túi tote shopping', 'tui_tote_3.jpg', 320000.00, 40, 'active', 4),
(23, 'Túi tote Hermès style', 'tui_tote_4.jpg', 3200000.00, 2, 'active', 4),
(24, 'Túi tote reversible', 'tui_tote_5.jpg', 780000.00, 20, 'active', 4),
(25, 'Túi tote structured', 'tui_tote_6.jpg', 2250000.00, 30, 'active', 4),
(52, 'Túi sách nữ đeo vai', 'tui_xach10.jpg', 1000000.00, 1, 'active', 2),
(53, 'Túi sách nữ đeo vai', 'tui_deo_vai_6.jpg', 1000000.00, 1, 'active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci DEFAULT 'user',
  `status` enum('active','blocked') COLLATE utf8mb4_general_ci DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `status`) VALUES
(1, 'Admin', 'admin@gmail.com', '0123456789', '202cb962ac59075b964b07152d234b70 ', 'admin', 'active'),
(2, 'Nguyễn Văn An', 'nvan@gmail.com', '0987654321', '202cb962ac59075b964b07152d234b70 ', 'user', 'active'),
(3, 'Trần Thị Bảo', 'ttbao@gmail.com', '0912345678', '202cb962ac59075b964b07152d234b70 ', 'user', 'active'),
(4, 'Phạm Thị Châu', 'ptchau@gmail.com', '0935440453', '202cb962ac59075b964b07152d234b70', 'user', 'active'),
(5, 'Phạm Phương nhi', 'ppnhi@gmail.com', '0125478987', '202cb962ac59075b964b07152d234b70', 'user', 'active'),
(17, 'Nguyễn Thanh Hoàng', 'nthoang@gmail.com', '0234567912', '202cb962ac59075b964b07152d234b70', 'user', 'active'),
(22, 'Đặng Khánh Linh', 'dklinh@gmail.com', '0235697402', '202cb962ac59075b964b07152d234b70', 'user', 'active'),
(27, 'Tống Phước Mỹ Hằng', 'tpmhang@gmail.com', '0356175155', '202cb962ac59075b964b07152d234b70', 'user', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
