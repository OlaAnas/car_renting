-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 10:52 PM
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
-- Database: `rental`
--
CREATE DATABASE IF NOT EXISTS `rental` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rental`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `full_name`, `email`, `phone`, `address`, `password`, `created_at`, `role`) VALUES
(9, NULL, 'kelvin@kelvin.nl', NULL, NULL, '$2y$12$w2fuXiPg1m2jC.C9BCCB5ebeEPNUcwxVp2StqdFJa9y62xwwmfKWK', '2025-06-19 21:40:48', NULL),
(10, NULL, 'cassandra@cassandra.nl', NULL, NULL, '$2y$12$pVGqaOKe9t0QZZozeub4ueghtgx09JEKWb/ohSPhh6VCucC8Zpplm', '2025-06-19 21:40:48', NULL),
(13, NULL, 'ola.anas.alk@gmail.com', NULL, NULL, '$2y$14$KeLnlKiro/fbHWdLjh2Y6.2rF.JdlCNCFXtdG6UDH4KHLyvnKtFfi', '2025-06-19 21:40:48', NULL),
(14, NULL, 'toqa.aboshame@gmail.com', NULL, NULL, '$2y$14$zHbICJ.nI5dDy3neHqauyeRHIwqveUco6wb6PJfjbk3AW3AIJX9VS', '2025-06-19 21:40:48', NULL),
(15, 'Toqa AboShameh', 'toqa.aboshame1@gmail.com', '0684048427', 'Boezemstraat 33', '$2y$10$f3rSVq.Lyl1jVF6/LTVdQeDGTcMe7upJfeJ8WJPxP9lPjOovws3.i', '2025-06-19 21:48:12', NULL),
(16, 'Ola Alkhousi', 'ola@gmail.com', '0642394694', 'Peulenlaan', '$2y$14$KljqP48cQ6mbhWubA5EQk.rdr02vyINoUD91I44tWXdAyqkxjHEWG', '2025-06-19 23:38:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `account_id`, `car_id`, `start_date`, `end_date`, `created_at`) VALUES
(1, 15, 1, '2018-01-04', '2018-10-04', '2025-06-19 21:01:25'),
(2, 15, 2, '2025-03-03', '2025-06-03', '2025-06-19 21:05:50'),
(3, 15, 2, '2014-04-05', '2014-07-05', '2025-06-19 21:09:10'),
(4, 15, 3, '2018-02-05', '2018-12-07', '2025-06-19 21:11:19'),
(5, 15, 2, '2020-06-08', '2020-06-09', '2025-06-19 21:21:19'),
(6, 16, 2, '2025-06-21', '2025-06-29', '2025-06-20 14:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `fuel` varchar(50) DEFAULT NULL,
  `transmission` varchar(50) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `name`, `brand`, `image`, `price_per_day`, `description`, `fuel`, `transmission`, `capacity`) VALUES
(1, 'Model S', 'Tesla', 'assets/images/products/car (0).svg', 120.00, 'A premium electric sedan.', 'Electric', 'Automatic', 5),
(2, 'Mustang', 'Ford', 'assets/images/products/car (1).svg', 90.00, 'A classic American muscle car.', 'Petrol', 'Manual', 4),
(3, 'Civic', 'Honda', 'assets/images/products/car (2).svg', 60.00, 'A reliable and efficient compact car.', 'Petrol', 'Automatic', 5),
(4, 'Corolla', 'Toyota', 'assets/images/products/Car (3).svg', 55.00, 'A practical and efficient sedan.', 'Diesel', 'Manual', 5),
(5, 'A4', 'Audi', 'assets/images/products/Car (4).svg', 80.00, 'Luxury and performance in one.', 'Diesel', 'Automatic', 7),
(6, 'X5', 'BMW', 'assets/images/products/Car (5).svg', 110.00, 'Spacious and sporty SUV.', 'Hybrid', 'Automatic', 5),
(7, 'Camaro', 'Chevrolet', 'assets/images/products/Car (6).svg', 95.00, 'Aggressive style with strong performance.', 'Petrol', 'Manual', 2),
(8, 'Altima', 'Nissan', 'assets/images/products/Car (7).svg', 65.00, 'Comfort and tech combined.', 'Electric', 'Automatic', 4),
(9, 'Mazda3', 'Mazda', 'assets/images/products/Car (8).svg', 60.00, 'Fun to drive, sleek design.', 'Hybrid', 'Manual', 4),
(10, 'Charger', 'Dodge', 'assets/images/products/Car (9).svg', 85.00, 'Bold American performance.', 'Diesel', 'Manual', 5),
(11, 'Polo', 'Volkswagen', 'assets/images/products/Car (10).svg', 50.00, 'Compact, stylish, and efficient.', 'Petrol', 'Automatic', 4),
(12, 'Giulia', 'Alfa Romeo', 'assets/images/products/Car (11).svg', 100.00, 'Italian design and speed.', 'Electric', 'Automatic', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
