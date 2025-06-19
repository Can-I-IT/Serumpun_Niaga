-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2025 at 07:52 PM
-- Server version: 8.0.40
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serumpun_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_user_type` enum('user','staff') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_password`, `customer_user_type`) VALUES
(1, 'Ali Bin Abu', 'ali@student.com', '01112345678', 'hashed_password1', 'user'),
(2, 'Siti Nur', 'siti@student.com', '01123456789', 'hashed_password2', 'user'),
(4, 'saf', 'saf@student.com', NULL, '$2y$10$yvWZvwxIaAkk0UZsBj1k0O3GoIv5iZGyDArhNJgwUz5n4pwGbZeXW', 'user'),
(6, 'Safwan', 'student1@outlook.com', '0125442298', '$2y$10$PM9p0ssMnAnzzLjgCiPtY.kZ3U//foU.xZkt/jSJkvYryjtEPB.36', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int NOT NULL,
  `printing_id` int NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_original_name` varchar(255) DEFAULT NULL,
  `file_size` int DEFAULT NULL,
  `file_upload_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `printing_id`, `file_name`, `file_original_name`, `file_size`, `file_upload_time`) VALUES
(1, 1, 'file_12345.pdf', 'assignment_final.pdf', 250000, '2025-06-13 21:05:33'),
(2, 2, 'file_67890.pdf', 'project_report.pdf', 500000, '2025-06-13 21:05:33'),
(4, 4, 'file_684e2060628cf3.50468028.pdf', 'statistical table.pdf', 844446, '2025-06-15 09:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `staff_id` int DEFAULT NULL,
  `printing_id` int NOT NULL,
  `file_id` int NOT NULL,
  `order_status` enum('pending','confirmed','completed') DEFAULT 'pending',
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `staff_id`, `printing_id`, `file_id`, `order_status`, `order_date`) VALUES
(1, 1, 1, 1, 1, 'pending', '2025-06-13 21:05:33'),
(2, 2, 1, 2, 2, 'confirmed', '2025-06-13 21:05:33'),
(4, 4, NULL, 4, 4, 'confirmed', '2025-06-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `printing_details`
--

CREATE TABLE `printing_details` (
  `printing_id` int NOT NULL,
  `number_of_copies` int NOT NULL,
  `additional_message` text,
  `print_type_id` int DEFAULT NULL,
  `paper_size_id` int DEFAULT NULL,
  `binding_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `printing_details`
--

INSERT INTO `printing_details` (`printing_id`, `number_of_copies`, `additional_message`, `print_type_id`, `paper_size_id`, `binding_id`) VALUES
(1, 2, 'Please print double-sided', 1, 3, 5),
(2, 5, 'Urgent printing for class', 2, 3, 6),
(3, 1, '', 1, 3, 5),
(4, 2, '', 1, 3, 6),
(5, 1, '', 1, 3, 5),
(6, 1, '', 2, 4, 6),
(7, 1, '', 2, 4, 7),
(8, 1, '', 1, 3, 5),
(9, 1, '', 1, 3, 5),
(10, 1, '', 1, 3, 5),
(12, 1, '', 1, 3, 5),
(13, 1, '', 1, 3, 5),
(14, 1, '', 1, 3, 5),
(15, 1, '', 1, 3, 5),
(16, 2, 'Hurry', 1, 3, 5),
(17, 1, '', 1, 3, 5),
(18, 1, '', 1, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_category` enum('Print Type','Paper Size','Binding','Laminate') NOT NULL,
  `service_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_category`, `service_price`) VALUES
(1, 'Black & White', 'Print Type', 0.10),
(2, 'Color', 'Print Type', 0.50),
(3, 'A4', 'Paper Size', 0.00),
(4, 'A3', 'Paper Size', 0.10),
(5, 'None', 'Binding', 0.00),
(6, 'Small Binding', 'Binding', 1.00),
(7, 'Large Binding', 'Binding', 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int NOT NULL,
  `staff_name` varchar(100) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `staff_password` varchar(255) NOT NULL,
  `staff_phone` varchar(20) DEFAULT NULL,
  `staff_role` varchar(50) DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_email`, `staff_password`, `staff_phone`, `staff_role`, `created_at`) VALUES
(1, 'Encik Rahman', 'rahman@staff.com', 'hashed_admin_pw', '0198765432', 'admin', '2025-06-13 13:05:33'),
(3, 'ADMIN', 'test@gmail.com', '$2y$10$ooyUy9ppvm73nOposE9DbuELNFTvmF0MDg3IN.wsuS8/qcnH4SMR6', '01194290032', 'admin', '2025-06-16 17:51:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `printing_id` (`printing_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `printing_id` (`printing_id`),
  ADD KEY `file_id` (`file_id`);

--
-- Indexes for table `printing_details`
--
ALTER TABLE `printing_details`
  ADD PRIMARY KEY (`printing_id`),
  ADD KEY `print_type_id` (`print_type_id`),
  ADD KEY `paper_size_id` (`paper_size_id`),
  ADD KEY `binding_id` (`binding_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_email` (`staff_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `printing_details`
--
ALTER TABLE `printing_details`
  MODIFY `printing_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`printing_id`) REFERENCES `printing_details` (`printing_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`printing_id`) REFERENCES `printing_details` (`printing_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE CASCADE;

--
-- Constraints for table `printing_details`
--
ALTER TABLE `printing_details`
  ADD CONSTRAINT `printing_details_ibfk_1` FOREIGN KEY (`print_type_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `printing_details_ibfk_2` FOREIGN KEY (`paper_size_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `printing_details_ibfk_3` FOREIGN KEY (`binding_id`) REFERENCES `services` (`service_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
