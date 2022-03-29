-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 05:30 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporan`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `namadepan`, `namabelakang`, `level`, `pabrik`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ab', 'A', 'B', 0, 0, '$2y$10$zMbrS7qqLDEk6XjobhRb/e5iYgJVqHU0qXLEXlXFR3a2Cdc8/jwkC', NULL, '2022-03-27 17:54:19', '2022-03-27 17:54:19'),
(2, 'Admin', 'A', 'B', 1, 1, '$2y$10$XBEOwslOlpwY.2UeTaw1cOAH180lRzKpZ8bFLdpgNt1CnYzT2zcAW', NULL, '2022-03-27 17:54:54', '2022-03-27 17:54:54'),
(3, 'Babu', 'A', 'B', 2, 1, '$2y$10$gd/yckNS7bg8.DIP5zarXO6isitAWcOLAiL52woH.KncJVSbsJAq.', NULL, '2022-03-27 17:55:11', '2022-03-27 17:55:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
