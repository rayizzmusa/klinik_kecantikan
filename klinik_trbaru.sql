-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2025 at 07:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

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
-- Table structure for table `master_treatment`
--

CREATE TABLE `master_treatment` (
  `id` int NOT NULL,
  `layanan` varchar(255) NOT NULL,
  `hapus` int NOT NULL,
  `harga` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_treatment`
--

INSERT INTO `master_treatment` (`id`, `layanan`, `hapus`, `harga`, `deskripsi`) VALUES
(1, 'Hair Treatment', 0, '100.000', 'Perawatan rambut'),
(2, 'Salmon DNA', 0, '1.000.000', 'Kulit cerah bagaikan ikan salmon'),
(5, 'Facial', 1, '150.000', 'Biar G jerawatan'),
(6, 'Facial Treatment', 1, '150.000', 'Rawat wajahmu biar ga jerawatan'),
(7, 'Kretek', 0, '200.000', 'Hancurkan Badanmu');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `id_treatment` int NOT NULL,
  `id_layanan` int NOT NULL,
  `hapus` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `id_user`, `username`, `id_treatment`, `id_layanan`, `hapus`, `created_at`) VALUES
(1, 2, 'root', 6, 7, 1, '2025-11-18 12:27:55'),
(2, 2, 'adiw', 6, 7, 0, '2025-11-18 12:28:52'),
(3, 2, 'adiw', 2, 2, 0, '2025-11-18 12:30:26'),
(4, 2, 'adiw', 4, 1, 0, '2025-11-19 13:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `id` int NOT NULL,
  `id_layanan` int NOT NULL,
  `harga` varchar(255) NOT NULL,
  `jam` time NOT NULL,
  `hapus` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`id`, `id_layanan`, `harga`, `jam`, `hapus`) VALUES
(1, 1, '100.000', '21:00:00', 0),
(2, 2, '1.000.000', '10:00:00', 0),
(3, 2, '1.000.000', '19:00:00', 1),
(4, 1, '100.000', '10:00:00', 0),
(5, 2, '1.000.000', '13:00:00', 0),
(6, 7, '200.000', '10:00:00', 0);

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
(1, 'admin', 'admin', 'Administrator', '2025-11-13', 'admin'),
(2, 'adiw', 'adiw', 'Adi', '2025-11-09', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_treatment`
--
ALTER TABLE `master_treatment`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_treatment_master` (`id_layanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_treatment`
--
ALTER TABLE `master_treatment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_treatment` FOREIGN KEY (`id_treatment`) REFERENCES `treatment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `fk_treatment_master` FOREIGN KEY (`id_layanan`) REFERENCES `master_treatment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
