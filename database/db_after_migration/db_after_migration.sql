-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 03:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `group_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `country_id`, `email`, `status`, `group_id`, `create_at`, `update_at`) VALUES
(2, 'Nguyễn Minh Hiếu -Manager', 1, 'hieunm3103-sdfds@gmail.com', 1, 3, '2023-10-11 16:25:05', NULL),
(4, 'Nguyễn Minh Hiếu', 1, 'hieunm3103@gmail.com', 1, 2, '2023-11-11 11:30:04', NULL),
(5, 'Nguyễn Minh Hiếu - none', 1, 'hieunm3103+hjdfvhikdfx@gmail.com', 0, 1, '2023-11-11 11:31:05', NULL),
(6, 'Nguyễn Minh Hiếu(1)', 1, 'hieunm3103-1234@gmail.com', 1, 3, '2023-10-11 16:25:05', NULL),
(7, 'Nguyễn Minh Hiếu 329', 1, 'hieunm3103+170@gmail.com', 0, 1, '2023-11-11 20:33:04', NULL),
(8, 'Nguyễn Minh Hiếu 692', 2, 'hieunm3103+604@gmail.com', 0, 3, '2023-11-11 20:33:59', NULL),
(9, 'Nguyễn Minh Hiếu 20', 2, 'hieunm3103+129@gmail.com', 0, 3, '2023-11-11 20:34:02', NULL),
(10, 'Nguyễn Minh Hiếu 78', 2, 'hieunm3103+111@gmail.com', 0, 3, '2023-11-11 20:34:05', NULL),
(11, 'Nguyễn Minh Hiếu 61', 2, 'hieunm3103+719@gmail.com', 0, 3, '2023-11-11 20:34:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `country_id` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
