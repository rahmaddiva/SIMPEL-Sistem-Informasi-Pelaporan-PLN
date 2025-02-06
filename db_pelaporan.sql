-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2025 at 11:52 AM
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
-- Database: `db_pelaporan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_gi`
--

CREATE TABLE `tb_gi` (
  `id` int NOT NULL,
  `nama_gi` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` varchar(19) COLLATE utf8mb4_general_ci NOT NULL,
  `lat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lng` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_gi`
--

INSERT INTO `tb_gi` (`id`, `nama_gi`, `lokasi`, `lat`, `lng`) VALUES
(4, 'Renjaaa', 'Banjarbaruuu', '-3.454479', '114.801634');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id` int NOT NULL,
  `nip` int NOT NULL,
  `nama_pegawai` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(18) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id`, `nip`, `nama_pegawai`, `jabatan`) VALUES
(1, 2147483647, 'Rahmad Diva', 'Direktur'),
(6, 2147483647, 'Dani Rizkianor', 'CEO');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pegawai` int NOT NULL,
  `gangguan` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_perangkat` int NOT NULL,
  `deskripsi` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lokasi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id`, `tanggal`, `nama_pegawai`, `gangguan`, `nama_perangkat`, `deskripsi`, `nama_lokasi`) VALUES
(2, '2025-02-01', 1, 'asdasd', 1, 'asdasd', 1),
(3, '2025-02-01', 1, 'sfd', 1, 'sdfsd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perangkat`
--

CREATE TABLE `tb_perangkat` (
  `id` int NOT NULL,
  `nama` varchar(18) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int NOT NULL,
  `nama` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `hak` varchar(18) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `password`, `username`, `hak`) VALUES
(1, 'ADMIN PINTAR', '$2y$10$5ltWQqHtgjzpGj4cvjzvP.7bG41UX/jXr5EFeiVyaUR1G3uaHQx5a', 'admin123', 'admin'),
(2, 'USER TOLOL', '$2y$10$05CBomAbu/kgoYyxAm/5keoo.qp9aTWez7iDfJl3a5sDg7Xoev14u', 'user123', 'user'),
(3, 'Diva', '$2y$10$AnJQz8ieu7EPaCOKBo/pF.NXp4S.3OB0Sq5WQHBVLNujDzRlGzEoC', 'Diva Ganteng', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_gi`
--
ALTER TABLE `tb_gi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_gi`
--
ALTER TABLE `tb_gi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
