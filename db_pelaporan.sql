-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 11, 2025 at 07:47 AM
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
(1, 'GI TPI', 'Banjarbaru', '-1.406109', '472.915420'),
(2, 'GI TPU', 'Banjarmasin', '-1.406109', '114.080207'),
(4, 'GI AMUNTAI', 'Amuntai', '-2.416664588863216', '115.29453052574652'),
(5, 'GI MUARA TEWEH', ' MUARA TEWEH', '0.8679066966120447', '114.86571943707946'),
(6, 'GI BANGKANAI', 'BANGKANAI', '-0.622918991731756', '115.13650419267425'),
(7, 'GI BUNTOK', 'BUNTOK', '-1.7404532538058628', '114.98205277572207'),
(8, 'GI TANJUNG', 'TANJUNG', '-2.194936141395342', '115.45053012759824'),
(9, 'GI PARINGIN', 'PARINGIN', '-2.3316334788795556', '15.42270661113781'),
(10, 'GI TPI', 'TPI', '-2.232555325724653', '116.0444716677253'),
(11, 'GI BARIKIN', 'BARIKIN', '-2.68236608270015', '115.33013382120552'),
(12, 'GI RANTAU ', ' RANTAU', '-3.0289909307814815', '115.12716971782035'),
(13, 'GI CEMPAKA', 'CEMPAKA', '-3.464777975133152', '114.85172728476377'),
(14, 'GI BATI BATI', 'BATI BATI', '-3.562925977783482,', '114.74887940248048');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluhan`
--

CREATE TABLE `tb_keluhan` (
  `id_keluhan` int NOT NULL,
  `nama_pengajuan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_pegawai` int DEFAULT NULL,
  `id_perangkat` int DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_gi` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_monitoring` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `progress` text COLLATE utf8mb4_general_ci,
  `foto_progress` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_keluhan`
--

INSERT INTO `tb_keluhan` (`id_keluhan`, `nama_pengajuan`, `id_pegawai`, `id_perangkat`, `keterangan`, `id_gi`, `id_user`, `tanggal_mulai`, `tanggal_monitoring`, `tanggal_selesai`, `status`, `foto`, `progress`, `foto_progress`) VALUES
(8, 'Adin Aha', 6, 5, 'Onprocess', 1, NULL, '2025-02-10', '2025-02-11', '2025-02-11', 'Selesai', '1739190151_8e7641e348df163b79f8.jpeg', '100%', '1739241059_259b6d88cf2f87420b98.jpeg.jpeg'),
(10, 'Mas Ade', 6, 6, 'Alat Perlu Perbaikan Segera Untuk Kelancaran Pekerjaan', 2, NULL, '2025-02-11', NULL, NULL, 'Diajukan', 'foto_tidak_ada', NULL, NULL),
(11, 'Angga Yuna', 6, 5, 'Alat Rusak Berat', 5, NULL, '2025-02-11', NULL, NULL, 'Diajukan', 'foto_tidak_ada', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id` int NOT NULL,
  `nip` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id`, `nip`, `nama_pegawai`, `jabatan`) VALUES
(6, '1990 3223 23213123', 'Rahmad Diva', 'CEO');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_gangguan` int NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_progress` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `id_pegawai` int DEFAULT NULL,
  `id_perangkat` int DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_gangguan` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_gi` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lng` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `progress` text COLLATE utf8mb4_general_ci,
  `foto_progress` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_gangguan`, `tanggal_mulai`, `tanggal_progress`, `tanggal_selesai`, `id_pegawai`, `id_perangkat`, `deskripsi`, `keterangan`, `kategori_gangguan`, `id_gi`, `id_user`, `foto`, `lat`, `lng`, `status`, `progress`, `foto_progress`) VALUES
(5, '2025-02-10', '2025-02-11', '2025-02-11', 6, 5, 'Alat Usang / Rusakkk', 'Akan Segera Ditindaklanjutitt', 'Major', 1, NULL, '1739198295_8fadd6f946558ab75055.png', '-3.46955730306146', '114.82910223816721', 'Selesai', '100%', '1739243079_822ccd0decfbb2d2d17d.png'),
(6, '2025-02-11', NULL, NULL, 6, 7, 'Alat Rusak Berat ', '', 'Minor', 5, NULL, 'foto_tidak_ada', '-3.4147247646241046', '114.8812787383095', 'Diajukan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perangkat`
--

CREATE TABLE `tb_perangkat` (
  `id` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_perangkat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_perangkat`
--

INSERT INTO `tb_perangkat` (`id`, `nama`, `jenis_perangkat`) VALUES
(3, 'Radio', 'Komunikasi Suara'),
(4, 'Voip', 'Komunikasi Suara'),
(5, 'Teleproteksi', 'Komunikasi Data'),
(6, 'Multiplexer', 'Komunikasi Data'),
(7, 'Router Scada', 'Komunikasi Data'),
(8, 'Switch Multiplexer', 'Komunikasi Data');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int NOT NULL,
  `nama` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `hak` varchar(18) COLLATE utf8mb4_general_ci NOT NULL,
  `id_gi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `password`, `username`, `hak`, `id_gi`) VALUES
(3, 'admin2', '$2y$10$.eKS6xqc7aJ3XzumPY9jk.v19fiC8r5bBpz6LJbmPOfgi9mbY4ubq', 'admin2', 'admin', 1),
(5, 'Rahmad Diva', '$2y$10$BxXhNZCofYX92l22NdZB/OvVKnmu8rJuIwAzmgARMqFQp8HsUFWWe', 'rahmad11', 'user', 4),
(6, 'Angga Yuna', '$2y$10$56vA1uy8db9zELBamLgkg.tsYNAC/WkdSUoLfzkLDcSbpiRKlbY.O', 'Angga11', 'user', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_gi`
--
ALTER TABLE `tb_gi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  ADD PRIMARY KEY (`id_keluhan`),
  ADD KEY `pegawai` (`id_pegawai`),
  ADD KEY `perangkat` (`id_perangkat`),
  ADD KEY `id_gi` (`id_gi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_gangguan`),
  ADD KEY `nama_pegawai` (`id_pegawai`),
  ADD KEY `nama_perangkat` (`id_perangkat`),
  ADD KEY `id_pegawai` (`id_pegawai`,`id_perangkat`),
  ADD KEY `id_gi` (`id_gi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gi` (`id_gi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_gi`
--
ALTER TABLE `tb_gi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  MODIFY `id_keluhan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_gangguan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  ADD CONSTRAINT `tb_keluhan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_keluhan_ibfk_2` FOREIGN KEY (`id_perangkat`) REFERENCES `tb_perangkat` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_keluhan_ibfk_3` FOREIGN KEY (`id_gi`) REFERENCES `tb_gi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_keluhan_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD CONSTRAINT `tb_pengajuan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_pengajuan_ibfk_2` FOREIGN KEY (`id_perangkat`) REFERENCES `tb_perangkat` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_pengajuan_ibfk_3` FOREIGN KEY (`id_gi`) REFERENCES `tb_gi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_pengajuan_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_gi`) REFERENCES `tb_gi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
