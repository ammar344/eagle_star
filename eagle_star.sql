-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 06:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eagle_star`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userPass` varchar(255) DEFAULT NULL,
  `dated` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `userName`, `userEmail`, `userPass`, `dated`) VALUES
(1, 'Ammar', 'ammar344', 'ammarsohail344@gmail.com', '$2y$10$aUCShIcbvE5tRA0YQ/N61eQ9ld5qDDBQ14gTZXNJz71aFInoqoOVG', '2024-09-18 16:57:21.078056'),
(2, 'Ammar', 'ammar644', 'rajpootammar644@gmail.com', '$2y$10$6aRSunBtThl9hdDt2RO81eWroJIyQyaV3dO8AiOC48jHZJ5lNVsnu', '2024-09-18 19:59:19.669227'),
(3, 'Hassan', 'hassan44', 'hassan36@gmail.com', '$2y$10$ozr0.GAdJS199/yEUSHlh.5nMd2Opa6w9KYMhRoQpHREWLSMwV6n2', '2024-09-18 20:36:39.688739');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(255) NOT NULL,
  `cName` varchar(255) DEFAULT NULL,
  `cEmail` varchar(255) DEFAULT NULL,
  `cSubject` varchar(255) DEFAULT NULL,
  `cMessage` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `cName`, `cEmail`, `cSubject`, `cMessage`, `date`) VALUES
(4, 'Ammar', 'ammarsohail344@gmail.com', 'Complain', 'About PEL Socks', '2024-09-16 18:00:10'),
(5, 'Ammar Sohail', 'ammarsohail344@gmail.com', 'Apreciation', 'Socks quality is so good', '2024-09-16 19:01:38'),
(6, 'Ammar', 'ammarsohail344@gmail.com', 'knit wear', 'heloo', '2024-10-09 20:27:13'),
(7, 'Muhammad Ammar Sohail', 'ammarsohail344@gmail.com', 'knit wear', 'Your is gorgeous 🥰', '2024-10-14 16:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `productId` int(255) DEFAULT NULL,
  `productCode` varchar(255) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `totalAmount` int(255) DEFAULT NULL,
  `customerName` varchar(255) DEFAULT NULL,
  `customerPhone` varchar(255) DEFAULT NULL,
  `shippingAddress` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `dated` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `productId`, `productCode`, `quantity`, `totalAmount`, `customerName`, `customerPhone`, `shippingAddress`, `status`, `dated`) VALUES
(1, 21, 'LMS283', 1, 2000, 'Ammar', '03067119099', 'House # 515, Defence Paradise, Faisalabad, Faisalabad City, Faisalabad', 'Delevered', '2024-09-17 22:32:01.107565'),
(2, 6, 'RMS459', 1, 2000, 'Ammar', '03067119099', 'House # 515, Defence Paradise, Faisalabad, Faisalabad City, Faisalabad', 'Delevered', '2024-09-17 22:32:14.541097'),
(3, 12, 'TTFM765', 30, 36000, 'Ammar', '03067119099', 'House # 515, Defence Paradise, Faisalabad, Faisalabad City, Faisalabad', 'Delevered', '2024-09-17 22:51:06.255262'),
(4, 9, 'TTF489', 8, 9600, 'Ammar', '03067119099', 'House # 515, Defence Paradise, Faisalabad, Faisalabad City, Faisalabad', 'Delevered', '2024-09-17 23:23:45.109143'),
(5, 21, 'LMS283', 80, 160000, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-18 20:38:04.425458'),
(6, 21, 'LMS283', 1, 0, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-28 00:28:40.241629'),
(7, 21, 'LMS283', 1, 0, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-28 00:29:42.757923'),
(8, 12, 'TTFM765', 1, 0, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-28 00:30:33.886256'),
(9, 21, 'LMS283', 1, 2000, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-28 00:36:19.022804'),
(10, 21, 'LMS283', 8, 16000, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-28 00:36:57.834739'),
(11, 5, 'PEL567', 4, 3600, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise, Faisalabad', 'Pending', '2024-09-28 00:56:24.884808'),
(12, 25, 'dsf546', 1, 56357, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-28 01:06:39.703030'),
(13, 5, 'PEL567', 3, 2700, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-28 10:13:31.270427'),
(14, 21, 'LMS283', 1, 2000, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-28 10:13:31.284488'),
(15, 11, 'TTF567', 1, 1500, 'Ammar Sohail', '03067119099', 'Plot # 515, Defence Paradise', 'Pending', '2024-09-28 10:13:31.290418'),
(16, 11, 'TTF567', 1, 1500, 'Ammar', '03067119099', 'House # 515, Defence Paradise, Faisalabad, Faisalabad City, Faisalabad', 'Pending', '2024-10-09 20:19:59.985629'),
(17, 12, 'TTFM765', 80, 96000, 'Ammar', '03067119099', 'House # 515, Defence Paradise, Faisalabad, Faisalabad City, Faisalabad', 'Delevered', '2024-10-09 20:19:59.994284'),
(18, 21, 'LMS283', 1, 2000, 'Muhammad Ammar Sohail', '03067119099', 'House # 515, Defence Paradise, Faisalabad, Faisalabad City, Faisalabad', 'Pending', '2024-10-14 16:36:52.563094'),
(19, 12, 'TTFM765', 1, 1200, 'Muhammad Ammar Sohail', '03067119099', 'House # 515, Defence Paradise, Faisalabad, Faisalabad City, Faisalabad', 'Delevered', '2024-10-14 16:36:52.569041');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  `productType` varchar(255) DEFAULT NULL,
  `price` int(255) DEFAULT NULL,
  `productCode` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` datetime(6) DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `image`, `productType`, `price`, `productCode`, `description`, `date`) VALUES
(2, 'Two Two 5 Socks', 0x494d472d32303234303931312d5741303030322e6a7067, 'common', 1500, 'ttf589', NULL, '2024-09-13 22:07:01.161537'),
(4, 'Two Two 5 kids Socks', 0x494d472d32303234303931312d5741303030332e6a7067, 'common', 1200, 'ttk438', NULL, '2024-09-14 23:07:02.871862'),
(5, 'PEL Ladies Moza', 0x494d472d32303234303931312d5741303030352e6a7067, 'Featured', 900, 'PEL567', NULL, '2024-09-14 23:08:37.976202'),
(6, 'Reebok Socks', 0x494d472d32303234303931312d5741303030362e6a7067, 'Featured', 2000, 'RMS459', NULL, '2024-09-14 23:09:47.573298'),
(7, 'Two Two 5 Socks', 0x494d472d32303234303931312d5741303030372e6a7067, 'common', 1200, 'TTF689', NULL, '2024-09-14 23:10:49.275143'),
(8, 'Tommy Socks', 0x494d472d32303234303931312d5741303030382e6a7067, 'Featured', 2000, 'THS987', NULL, '2024-09-14 23:12:55.325998'),
(9, 'Two Two 5 Socks', 0x494d472d32303234303931312d5741303030392e6a7067, 'common', 1200, 'TTF489', NULL, '2024-09-14 23:15:14.395066'),
(10, 'Nike Socks', 0x494d472d32303234303931312d5741303031302e6a7067, 'Featured', 2000, 'NS245', NULL, '2024-09-14 23:16:10.259029'),
(11, 'Two Two 5 Socks', 0x494d472d32303234303931312d5741303031312e6a7067, 'common', 1500, 'TTF567', NULL, '2024-09-14 23:18:14.416938'),
(12, 'Two Two 5 Moza', 0x494d472d32303234303931312d5741303031322e6a7067, 'Featured', 1200, 'TTFM765', NULL, '2024-09-14 23:23:39.296465'),
(26, 'Levis Mens Socks', 0x494d472d32303234303931312d5741303030312e6a7067, 'Featured', 2000, 'LMS283', 'Levis mens socks typically combine style with comfort. They are often crafted from a blend of materials like cotton, polyester, and elastane to offer durability and a snug fit. Designed for everyday wear, they usually come in various lengths', '2024-10-14 18:01:14.031423');

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` int(255) NOT NULL,
  `semail` varchar(255) DEFAULT NULL,
  `dated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `semail`, `dated`) VALUES
(1, 'ammarsohail344@gmail.com', '2024-08-16 17:49:01'),
(2, 'ammarsohail34@gmail.com', '2024-08-16 17:49:51'),
(3, 'ammarsohail345@gmail.com', '2024-08-16 18:25:03'),
(4, 'arbaz16@gmail.com', '2024-09-02 17:51:12'),
(5, 'ammar34@gmail.com', '2024-09-02 17:57:12'),
(6, 'chassaanzahid@gmail.com', '2024-09-05 10:56:33'),
(7, 'hassan36@gmail.com', '2024-09-05 10:59:57'),
(10, 'ammar344@gmai.com', '2024-09-17 21:04:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
