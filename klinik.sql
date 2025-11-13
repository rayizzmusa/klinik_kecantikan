-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2025 at 05:08 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `id_treatment` int NOT NULL,
  `layanan` varchar(255) NOT NULL,
  `hapus` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `id_user`, `username`, `id_treatment`, `layanan`, `hapus`, `created_at`) VALUES
(1, 1, 'luluk', 6, 'Hair Treatment', 0, '2025-11-13 03:40:33'),
(2, 1, 'luluk', 11, 'Facial', 0, '2025-11-13 04:31:43'),
(3, 3, 'mayden', 2, 'Treatment Acne', 0, '2025-11-13 04:37:21'),
(4, 4, 'syifa', 9, 'Facial', 0, '2025-11-13 05:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `id` int NOT NULL,
  `layanan` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `jam` time NOT NULL,
  `hapus` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`id`, `layanan`, `harga`, `jam`, `hapus`) VALUES
(1, 'Treatment Acne', '250.000', '08:00:00', 0),
(2, 'Treatment Acne', '250.000', '10:00:00', 0),
(3, 'Treatment Acne', '250.000', '12:00:00', 0),
(4, 'Treatment Acne', '250.000', '13:00:00', 0),
(5, 'Hair Treatment', '100.000', '08:00:00', 0),
(6, 'Hair Treatment', '100.000', '10:00:00', 0),
(7, 'Hair Treatment', '100.000', '12:00:00', 0),
(8, 'Hair Treatment', '100.000', '13:00:00', 0),
(9, 'Facial', '150.000', '08:00:00', 0),
(10, 'Facial', '150.000', '10:00:00', 0),
(11, 'Facial', '150.000', '13:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `tgl_lahir`, `role`) VALUES
(1, 'luluk', 'luluk', 'Luluk', '2025-10-30', 'pelanggan'),
(2, 'admin', 'admin', 'Admin', '2025-11-13', 'admin'),
(3, 'mayden', 'mayden', 'Maya', '2025-11-12', 'pelanggan'),
(4, 'syifa', 'syifa', 'Syifa', '2025-11-13', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`id_user`),
  ADD KEY `fk_treatment` (`id_treatment`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_treatment` FOREIGN KEY (`id_treatment`) REFERENCES `treatment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
