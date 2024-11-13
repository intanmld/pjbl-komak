-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 05:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akn`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun1s`
--

CREATE TABLE `akun1s` (
  `id_akun1` int(6) UNSIGNED NOT NULL,
  `kode_akun1` varchar(6) NOT NULL,
  `nama_akun1` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun1s`
--

INSERT INTO `akun1s` (`id_akun1`, `kode_akun1`, `nama_akun1`) VALUES
(2, '123', 'Nymas'),
(7, '566', 'Intan'),
(8, '21', 'Aziz'),
(9, '223', 'Liana'),
(10, '90', 'Resty');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(5, '2024-11-12-221230', 'App\\Database\\Migrations\\CreateAknDatabase', 'default', 'App', 1731451292, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pembelian`
--

CREATE TABLE `permintaan_pembelian` (
  `id_permintaan` int(11) NOT NULL,
  `no_permintaan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `pemohon` int(6) UNSIGNED NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permintaan_pembelian`
--

INSERT INTO `permintaan_pembelian` (`id_permintaan`, `no_permintaan`, `tanggal`, `pemohon`, `nama_barang`, `jumlah`, `satuan`, `harga`) VALUES
(28, 'PR-001', '2024-11-13', 7, 'Makanan', 12, 'Unit', 90000.00),
(29, 'PR-002', '2024-11-02', 7, 'Minuman', 12, 'Unit', 34000.00);

-- --------------------------------------------------------

--
-- Table structure for table `persetujuan`
--

CREATE TABLE `persetujuan` (
  `id_persetujuan` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `status` enum('Approved','Disapprove') DEFAULT 'Disapprove'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persetujuan`
--

INSERT INTO `persetujuan` (`id_persetujuan`, `id_permintaan`, `status`) VALUES
(22, 28, 'Approved'),
(23, 29, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id_po` int(11) NOT NULL,
  `id_persetujuan` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `penanggung_jawab` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id_po`, `id_persetujuan`, `keterangan`, `penanggung_jawab`, `supplier`) VALUES
(7, 22, 'ya ndak tau', 'Resty', 'Gunawan'),
(8, 23, 'barang dmwakmdjwnadniwandiowandinawiodnwaiondioawndoiwandiownaiodnwaiondiowandiowoa', 'Aziz', 'dia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin@akutansi.com', '$2y$10$Fs8ZJ5POpUgp3RkaEPNyM.36DgNyZ2cDi4AmMtksoNra8XsrewMyu', 'admin', '2024-11-12 22:43:57', '2024-11-12 22:43:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun1s`
--
ALTER TABLE `akun1s`
  ADD PRIMARY KEY (`id_akun1`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan_pembelian`
--
ALTER TABLE `permintaan_pembelian`
  ADD PRIMARY KEY (`id_permintaan`),
  ADD KEY `pemohon` (`pemohon`);

--
-- Indexes for table `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD PRIMARY KEY (`id_persetujuan`),
  ADD KEY `fk_id_permintaan` (`id_permintaan`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id_po`),
  ADD KEY `purchase_order_ibfk_1` (`id_persetujuan`);

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
-- AUTO_INCREMENT for table `akun1s`
--
ALTER TABLE `akun1s`
  MODIFY `id_akun1` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permintaan_pembelian`
--
ALTER TABLE `permintaan_pembelian`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `persetujuan`
--
ALTER TABLE `persetujuan`
  MODIFY `id_persetujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id_po` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permintaan_pembelian`
--
ALTER TABLE `permintaan_pembelian`
  ADD CONSTRAINT `permintaan_pembelian_ibfk_1` FOREIGN KEY (`pemohon`) REFERENCES `akun1s` (`id_akun1`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD CONSTRAINT `fk_id_permintaan` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan_pembelian` (`id_permintaan`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `fk_id_persetujuan` FOREIGN KEY (`id_persetujuan`) REFERENCES `persetujuan` (`id_persetujuan`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`id_persetujuan`) REFERENCES `persetujuan` (`id_persetujuan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
