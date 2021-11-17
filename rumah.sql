-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2021 at 01:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `kep_keluarga`
--

CREATE TABLE `kep_keluarga` (
  `no_kk` varchar(16) NOT NULL,
  `nm_kpl_kel` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `rt` int(11) NOT NULL,
  `rw` int(3) NOT NULL,
  `desa` varchar(25) NOT NULL,
  `kec` varchar(25) NOT NULL,
  `kab` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kriteria` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kriteria`, `jumlah`, `bobot`) VALUES
(1, 'Pekerjaan', 0, 0),
(2, 'Penghasilan', 0, 0),
(3, 'Tanggungan Keluarga', 0, 0);

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
  `tipe` enum('Admin','Surveyor','Kepala Dusun','') NOT NULL,
  `aktif` enum('aktif','tidak aktif','','') NOT NULL,
  `role_id` enum('1','2','3','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `jabatan`, `jk`, `username`, `foto`, `password`, `tipe`, `aktif`, `role_id`) VALUES
(1, 'Amos Benge', 'Admin Desa', 'Pria', 'admin', 'daniel.jpg', '$2y$10$PVtdLfTUY595pq0jkoekgOoWysq3VSfbXt2PIdsJ0C/Scgfz4FBMi', 'Admin', 'aktif', '1'),
(7, 'Ricky Lalo', 'Pegawai', 'Pria', 'survey', 'profile2.png', '$2y$10$SkZRGGfhoai.nx3.Dzfydu32etxx7qBcP5B.O9ONqRgjXsodpG6GS', 'Surveyor', 'aktif', '2'),
(9, 'Maria Badj', 'Kepala Dusun 1', 'Wanita', 'dusun', 'daniel2111.jpg', '$2y$10$JGCtHBE2cLo0xx1iq4UDSOwq8ZisLuNuopTy/ogqDUlMBnLGAke8e', 'Kepala Dusun', 'aktif', '3');

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
(3, 1, 3);

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
(2, 'User Master'),
(3, 'Pendukung Keputusan');

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
(1, 1, 'Home', 'admin', 'fas fa-fw fa-solid fa-user', 1),
(3, 2, 'Users', 'admin/users', 'fas fa-fw fa-users', 1),
(4, 3, 'Kriteria', 'ahp', 'fas fa-fw fa-th', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kep_keluarga`
--
ALTER TABLE `kep_keluarga`
  ADD PRIMARY KEY (`no_kk`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
