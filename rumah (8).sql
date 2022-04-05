-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 05:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumah`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `no_kk`, `id_periode`, `hasil`) VALUES
(1, '5301192905980002', 1, 0.340883),
(2, '5371041304980001', 1, 0.267908),
(3, '5371041906960002', 1, 0.392209);

-- --------------------------------------------------------

--
-- Table structure for table `dusun`
--

CREATE TABLE `dusun` (
  `id` int(11) NOT NULL,
  `nama_dusun` varchar(20) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dusun`
--

INSERT INTO `dusun` (`id`, `nama_dusun`, `id_user`) VALUES
(5, 'Dusun 1', 10),
(7, 'Dusun 2', 11);

-- --------------------------------------------------------

--
-- Table structure for table `kep_keluarga`
--

CREATE TABLE `kep_keluarga` (
  `no_kk` varchar(16) NOT NULL,
  `nm_kpl_kel` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `rt` varchar(3) NOT NULL,
  `rw` varchar(3) NOT NULL,
  `desa` varchar(25) NOT NULL,
  `kec` varchar(25) NOT NULL,
  `kab` varchar(25) NOT NULL,
  `id_dusun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kep_keluarga`
--

INSERT INTO `kep_keluarga` (`no_kk`, `nm_kpl_kel`, `alamat`, `rt`, `rw`, `desa`, `kec`, `kab`, `id_dusun`) VALUES
('5301192905980002', 'Maximilianus Benge', 'Jl. Kelimutu', '004', '003', 'Kabuna', 'Kakuluk Mesak', 'Belu', 5),
('5371041304980001', 'Kristian Paulino', 'Jl. Perintis', '003', '001', 'Kabuna', 'Kakuluk Mesak', 'Belu', 5),
('5371041304980007', 'contoh', 'Kayu Putih, Kota Kupang', '003', '001', 'Kabuna', 'Kakuluk Mesak', 'Belu', 7),
('5371041906960002', 'Adrian Siribein', 'Jl. Keramat Jati', '003', '001', 'Kabuna', 'Kakuluk Mesak', 'Belu', 5);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kriteria` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `bobot` float NOT NULL,
  `punya_sub` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kriteria`, `jumlah`, `bobot`, `punya_sub`) VALUES
(1, 'Pekerjaan', 14.33, 0.082, 1),
(2, 'Penghasilan', 11.417, 0.115, 0),
(3, 'Tanggungan Keluarga', 9.167, 0.127, 0),
(4, 'Status Rumah dan Tanah', 2.833, 0.314, 0),
(5, 'Kondisi Atap Rumah', 29, 0.034, 0),
(6, 'Kondisi Dinding Rumah', 30.5, 0.032, 0),
(7, 'Kondisi Lantai Rumah', 31, 0.026, 0),
(8, 'Kondisi MCK', 23.5, 0.048, 0),
(9, 'Status Menerima Bantuan', 5.629, 0.223, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_alternatif`
--

CREATE TABLE `kriteria_alternatif` (
  `id` int(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `eigen` float NOT NULL,
  `lamda` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria_alternatif`
--

INSERT INTO `kriteria_alternatif` (`id`, `deskripsi`, `id_kriteria`, `id_alternatif`, `eigen`, `lamda`) VALUES
(10, 'Tukang', 1, 1, 0.110297, 0.992674),
(11, 'Tukang', 1, 2, 0.34595, 1.12434),
(12, 'Tukang', 1, 3, 0.543753, 0.951567),
(13, 'Rp 1.000.000 per Bulan', 2, 1, 0.119938, 0.959504),
(14, '4 orang', 3, 1, 0.282831, 1.18789),
(15, 'Milik Sendiri', 4, 1, 0.555927, 0.945076),
(16, 'Tidak Tau', 5, 1, 0.0933873, 0.933873),
(17, 'Tidak Tau', 6, 1, 0.14155, 0.990853),
(18, 'No', 7, 1, 0.14155, 0.990853),
(19, 'No', 8, 1, 0.119938, 0.959504),
(20, 'No', 9, 1, 0.405485, 0.946119),
(21, 'Rp 1.000.000 per Bulan', 2, 2, 0.272094, 1.17906),
(22, '4 orang', 3, 2, 0.0737816, 0.959161),
(23, 'Milik Sendiri', 4, 2, 0.353721, 1.13191),
(24, 'Tidak Tau', 5, 2, 0.221323, 1.18038),
(25, 'Tidak Tau', 6, 2, 0.524681, 0.961897),
(26, 'No', 7, 2, 0.333769, 1.11255),
(27, 'No', 8, 2, 0.607968, 0.962596),
(28, 'No', 9, 2, 0.114955, 1.0346),
(29, 'Rp 1.000.000 per Bulan', 2, 3, 0.607968, 0.962596),
(30, '4 orang', 3, 3, 0.643387, 0.949768),
(31, 'Milik Sendiri', 4, 3, 0.0903521, 0.993873),
(32, 'Tidak Tau', 5, 3, 0.68529, 0.970851),
(33, 'Tidak Tau', 6, 3, 0.333769, 1.11255),
(34, 'No', 7, 3, 0.524681, 0.961897),
(35, 'No', 8, 3, 0.272094, 1.17906),
(36, 'No', 9, 3, 0.47956, 1.05503);

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_alternatif`
--

CREATE TABLE `perbandingan_alternatif` (
  `id` int(11) NOT NULL,
  `id_kriteria_alternatif` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_skala` int(11) NOT NULL,
  `normalisasi` float NOT NULL,
  `skala_inverse` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perbandingan_alternatif`
--

INSERT INTO `perbandingan_alternatif` (`id`, `id_kriteria_alternatif`, `id_alternatif`, `id_skala`, `normalisasi`, `skala_inverse`) VALUES
(41, 10, 1, 1, 0, 0),
(42, 11, 1, 4, 0, 0),
(43, 10, 2, 4, 0, 1),
(44, 12, 1, 4, 0, 0),
(45, 10, 3, 4, 0, 1),
(46, 11, 2, 1, 0, 0),
(47, 12, 2, 2, 0, 0),
(48, 11, 3, 2, 0, 1),
(49, 12, 3, 1, 0, 0),
(50, 13, 1, 1, 0, 0),
(51, 21, 1, 3, 0, 0),
(52, 13, 2, 3, 0, 1),
(53, 29, 1, 4, 0, 0),
(54, 13, 3, 4, 0, 1),
(55, 21, 2, 1, 0, 0),
(56, 29, 2, 3, 0, 0),
(57, 21, 3, 3, 0, 1),
(58, 29, 3, 1, 0, 0),
(59, 14, 1, 1, 0.238095, 0),
(60, 14, 2, 5, 0.384615, 0),
(61, 22, 1, 5, 0.047619, 1),
(62, 30, 1, 3, 0.714286, 0),
(63, 14, 3, 3, 0.225782, 1),
(64, 22, 2, 1, 0.0769231, 0),
(65, 30, 2, 7, 0.538462, 0),
(66, 22, 3, 7, 0.0968026, 1),
(67, 30, 3, 1, 0.677415, 0),
(68, 15, 1, 1, 0.588235, 0),
(69, 15, 2, 2, 0.625, 0),
(70, 23, 1, 2, 0.294118, 1),
(71, 15, 3, 5, 0.454545, 0),
(72, 31, 1, 5, 0.117647, 1),
(73, 23, 2, 1, 0.3125, 0),
(74, 23, 3, 5, 0.454545, 0),
(75, 31, 2, 5, 0.0625, 1),
(76, 31, 3, 1, 0.0909091, 0),
(77, 16, 1, 1, 0.1, 0),
(78, 24, 1, 3, 0.3, 0),
(79, 16, 2, 3, 0.0624941, 1),
(80, 32, 1, 6, 0.6, 0),
(81, 16, 3, 6, 0.117668, 1),
(82, 24, 2, 1, 0.187501, 0),
(83, 32, 2, 4, 0.750005, 0),
(84, 24, 3, 4, 0.176466, 1),
(85, 32, 3, 1, 0.705866, 0),
(86, 17, 1, 1, 0.142857, 0),
(87, 25, 1, 3, 0.428571, 0),
(88, 17, 2, 3, 0.181803, 1),
(89, 33, 1, 3, 0.428571, 0),
(90, 17, 3, 3, 0.099991, 1),
(91, 25, 2, 1, 0.545464, 0),
(92, 25, 3, 2, 0.600006, 0),
(93, 33, 2, 2, 0.272732, 1),
(94, 33, 3, 1, 0.300003, 0),
(95, 18, 1, 1, 0.142857, 0),
(96, 26, 1, 3, 0.428571, 0),
(97, 18, 2, 3, 0.099991, 1),
(98, 34, 1, 3, 0.428571, 0),
(99, 18, 3, 3, 0.181803, 1),
(100, 26, 2, 1, 0.300003, 0),
(101, 34, 2, 2, 0.600006, 0),
(102, 26, 3, 2, 0.272732, 1),
(103, 34, 3, 1, 0.545464, 0),
(104, 19, 1, 1, 0.125, 0),
(105, 27, 1, 4, 0.5, 0),
(106, 19, 2, 4, 0.157898, 1),
(107, 35, 1, 3, 0.375, 0),
(108, 19, 3, 3, 0.076916, 1),
(109, 27, 2, 1, 0.631592, 0),
(110, 27, 3, 3, 0.692313, 0),
(111, 35, 2, 3, 0.21051, 1),
(112, 35, 3, 1, 0.230771, 0),
(113, 20, 1, 1, 0.428578, 0),
(114, 20, 2, 3, 0.333333, 0),
(115, 28, 1, 3, 0.142845, 1),
(116, 20, 3, 1, 0.454545, 0),
(117, 36, 1, 1, 0.428578, 1),
(118, 28, 2, 1, 0.111111, 0),
(119, 36, 2, 5, 0.555556, 0),
(120, 28, 3, 5, 0.0909091, 1),
(121, 36, 3, 1, 0.454545, 0);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `periode` year(4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `periode`, `status`) VALUES
(1, 2022, 0),
(13, 2023, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skala`
--

CREATE TABLE `skala` (
  `id` int(11) NOT NULL,
  `nama_skala` varchar(100) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skala`
--

INSERT INTO `skala` (`id`, `nama_skala`, `bobot`) VALUES
(1, '1. Elemen sama penting', 1),
(2, '2. Nilai pertimbangan antara Skala 1 dan Skala 3', 2),
(3, '3. Elemen yang satu sedikit lebih penting', 3),
(4, '4. Nilai pertimbangan antara Skala 3 dan Skala 5', 4),
(5, '5. Elemen yang satu lebih penting', 5),
(6, '6. Nilai pertimbangan antara Skala 5 dan Skala 7', 6),
(7, '7. Satu elemen jelas lebih mutlak penting', 7),
(8, '8. Nilai pertimbangan antara Skala 7 dan Skala 9', 8),
(9, '9. Satu elemen mutlak penting', 9);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_sub` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `id_kriteria`, `nama_sub`) VALUES
(1, 1, 'Tukang');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `jk` enum('Pria','Wanita','','') NOT NULL,
  `username` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `aktif` enum('aktif','tidak aktif','','') NOT NULL,
  `role_id` enum('1','2','3','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `jabatan`, `jk`, `username`, `foto`, `password`, `aktif`, `role_id`) VALUES
(1, 'Amos Benge', 'Admin Desa', 'Pria', 'admin', 'daniel.jpg', '$2y$10$PVtdLfTUY595pq0jkoekgOoWysq3VSfbXt2PIdsJ0C/Scgfz4FBMi', 'aktif', '1'),
(7, 'Ricky Lalo', 'Pegawai/Surveyor', 'Pria', 'survey', 'profile2.png', '$2y$10$SkZRGGfhoai.nx3.Dzfydu32etxx7qBcP5B.O9ONqRgjXsodpG6GS', 'aktif', '2'),
(10, 'Amos', 'Kepala Dusun 02', 'Pria', 'dusun1', 'daniel2111.jpg', '$2y$10$JGCtHBE2cLo0xx1iq4UDSOwq8ZisLuNuopTy/ogqDUlMBnLGAke8e', 'aktif', '3'),
(11, 'Kevin Bhato', 'Kepala Dusun 03', 'Pria', 'dusun2', 'daniel2111.jpg', '$2y$10$JGCtHBE2cLo0xx1iq4UDSOwq8ZisLuNuopTy/ogqDUlMBnLGAke8e', 'aktif', '3');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(6, 2, 4),
(7, 3, 1),
(8, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `title`) VALUES
(1, 'Dashboard'),
(2, 'Data Master'),
(3, 'Pendukung Keputusan'),
(4, 'Survey'),
(5, 'Dusun');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Surveyor'),
(3, 'Kepala Dusun');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `id_menu`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Home', 'admin', 'fa fa-fw fa-home', 1),
(3, 2, 'Users', 'admin/users', 'fas fa-fw fa-users', 1),
(4, 3, 'Kriteria', 'ahp', 'fas fa-fw fa-th', 1),
(5, 2, 'Kepala Keluarga', 'admin/kepkel', 'fas fa-fw fa-users', 1),
(6, 3, 'Perhitungan', 'ahp/perhitungan', 'fas fa-fw fa-calculator', 1),
(7, 3, 'Hasil', 'ahp/hasil', 'fas fa-fw fa-tasks', 1),
(8, 4, 'Perbandingan', 'surveyor/perbandingan', 'fas fa-fw fa-list', 1),
(9, 4, 'Hasil', 'surveyor/hasil', 'fas fa-fw fa-file', 1),
(10, 5, 'Kepala Keluarga', 'dusun/kep_keluarga', 'fas fa-fw fa-users', 1),
(11, 2, 'Dusun', 'admin/dusun', 'fas fa-fw fa-users', 1),
(12, 4, 'Survey Calon', 'surveyor/survey_calon', 'fas fa-fw fa-file', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_perbandingan_alt`
-- (See below for the actual view)
--
CREATE TABLE `v_perbandingan_alt` (
`id` int(11)
,`id_kriteria_alternatif` int(11)
,`id_alternatif` int(11)
,`id_skala` int(11)
,`normalisasi` float
,`skala_inverse` int(1)
,`bobot` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Structure for view `v_perbandingan_alt`
--
DROP TABLE IF EXISTS `v_perbandingan_alt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_perbandingan_alt`  AS SELECT `perbandingan_alternatif`.`id` AS `id`, `perbandingan_alternatif`.`id_kriteria_alternatif` AS `id_kriteria_alternatif`, `perbandingan_alternatif`.`id_alternatif` AS `id_alternatif`, `perbandingan_alternatif`.`id_skala` AS `id_skala`, `perbandingan_alternatif`.`normalisasi` AS `normalisasi`, `perbandingan_alternatif`.`skala_inverse` AS `skala_inverse`, if(`perbandingan_alternatif`.`skala_inverse` = 1,1 / `skala`.`bobot`,`skala`.`bobot`) AS `bobot` FROM (`perbandingan_alternatif` join `skala` on(`skala`.`id` = `perbandingan_alternatif`.`id_skala`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_kk` (`no_kk`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kep_keluarga`
--
ALTER TABLE `kep_keluarga`
  ADD PRIMARY KEY (`no_kk`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria_alternatif`
--
ALTER TABLE `kriteria_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indexes for table `perbandingan_alternatif`
--
ALTER TABLE `perbandingan_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kriteria_alternatif` (`id_kriteria_alternatif`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_skala` (`id_skala`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skala`
--
ALTER TABLE `skala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kriteria_alternatif`
--
ALTER TABLE `kriteria_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `perbandingan_alternatif`
--
ALTER TABLE `perbandingan_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `skala`
--
ALTER TABLE `skala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alternatif_ibfk_2` FOREIGN KEY (`no_kk`) REFERENCES `kep_keluarga` (`no_kk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
