-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 01:31 PM
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
-- Database: `crimson_dawn`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `jenis`, `lokasi`, `tanggal`, `deskripsi`, `kontak`, `lat`, `lng`, `created_at`) VALUES
(3, 'kecelakaan', 'muna', '2024-12-17', 'seaorang remaja jatuh ', '', -6.942104174022484, 107.13551330147314, '2024-12-17 04:51:59'),
(5, 'kejahatan', 'concat', '2024-12-18', 'dimas pembegal hati', '24242', -6.212336448454288, 106.8390197743429, '2024-12-17 06:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'kelvin', 'kelvinramadan@gmail.com', '$2y$10$CwuhH8BmCP16BAw8o.j9/OFebtBQ85ga5Sw.dqYlJ1SJ38.3AGJ76', '2024-12-17 04:07:16'),
(2, 'sakti', 'saktinagara@gmail.com', '$2y$10$VOZ2.9pqu3fxiqFu50nRH.rRtUW9G8l4l/YQEKPNG2IMKCvTiD.2G', '2024-12-17 04:13:33'),
(3, 'saktisatya', 'sakti@gmail.com', '$2y$10$oh9454KwcNn4ehLGWv2NGOQ5qeRSs/on4WvYBKZy3oUYbIuHPfrjS', '2024-12-17 04:49:00'),
(4, 'dimas', 'dimas@gmail.com', '$2y$10$/sJGLsGUBH3914GWyg2gyunNzD5MoasIK3krbHKRgahEIPU41xque', '2024-12-17 06:00:41'),
(5, 'saktisatya', 'sakti2@gmail.com', '$2y$10$qutEYRjT0bVJHu3fiSSfHu4cyl75R6AAZe901dpFK7ZV9AfrvKjHm', '2024-12-17 06:02:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
