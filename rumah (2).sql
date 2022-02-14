-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2022 pada 02.24
-- Versi server: 5.5.27
-- Versi PHP: 7.2.1

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
-- Struktur dari tabel `dusun`
--

CREATE TABLE `dusun` (
  `id` int(11) NOT NULL,
  `nama_dusun` varchar(20) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dusun`
--

INSERT INTO `dusun` (`id`, `nama_dusun`, `id_user`) VALUES
(5, 'Dusun 1', 10),
(7, 'Dusun 2', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kep_keluarga`
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
  `id_dusun` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kep_keluarga`
--

INSERT INTO `kep_keluarga` (`no_kk`, `nm_kpl_kel`, `alamat`, `rt`, `rw`, `desa`, `kec`, `kab`, `id_dusun`, `id_periode`) VALUES
('5301192905980002', 'Maximilianus Benge', 'Jl. Kelimutu', '004', '003', 'Kabuna', 'Kakuluk Mesak', 'Belu', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kriteria` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `kriteria`, `jumlah`, `bobot`) VALUES
(1, 'Pekerjaan', 14.33, 0.082),
(2, 'Penghasilan', 11.417, 0.115),
(3, 'Tanggungan Keluarga', 9.167, 0.127),
(4, 'Status Rumah dan Tanah', 2.833, 0.314),
(5, 'Kondisi Atap Rumah', 29, 0.034),
(6, 'Kondisi Dinding Rumah', 30.5, 0.032),
(7, 'Kondisi Lantai Rumah', 31, 0.026),
(8, 'Kondisi MCK', 23.5, 0.048),
(9, 'Status Menerima Bantuan', 5.629, 0.223);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `periode` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `jabatan`, `jk`, `username`, `foto`, `password`, `aktif`, `role_id`) VALUES
(1, 'Amos Benge', 'Admin Desa', 'Pria', 'admin', 'daniel.jpg', '$2y$10$PVtdLfTUY595pq0jkoekgOoWysq3VSfbXt2PIdsJ0C/Scgfz4FBMi', 'aktif', '1'),
(7, 'Ricky Lalo', 'Pegawai', 'Pria', 'survey', 'profile2.png', '$2y$10$SkZRGGfhoai.nx3.Dzfydu32etxx7qBcP5B.O9ONqRgjXsodpG6GS', 'aktif', '2'),
(9, 'Maria Badj', 'Kepala Dusun', 'Wanita', 'dusun', 'daniel2111.jpg', '$2y$10$JGCtHBE2cLo0xx1iq4UDSOwq8ZisLuNuopTy/ogqDUlMBnLGAke8e', 'aktif', '3'),
(10, 'Amos', 'Kepala Dusun', 'Pria', 'dusun', 'daniel2111.jpg', '$2y$10$JGCtHBE2cLo0xx1iq4UDSOwq8ZisLuNuopTy/ogqDUlMBnLGAke8e', 'aktif', '3'),
(11, 'Kevin Bhato', 'Kepala Dusun', 'Pria', 'dusun', 'daniel2111.jpg', '$2y$10$JGCtHBE2cLo0xx1iq4UDSOwq8ZisLuNuopTy/ogqDUlMBnLGAke8e', 'aktif', '3'),
(12, 'Ronny Dae', 'Kepala Dusun', 'Pria', 'dusun', 'daniel2111.jpg', '$2y$10$JGCtHBE2cLo0xx1iq4UDSOwq8ZisLuNuopTy/ogqDUlMBnLGAke8e', 'aktif', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
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
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `title`) VALUES
(1, 'Dashboard'),
(2, 'Data Master'),
(3, 'Pendukung Keputusan'),
(4, 'Survey'),
(5, 'Dusun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Surveyor'),
(3, 'Kepala Dusun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
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
-- Dumping data untuk tabel `user_sub_menu`
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
(11, 2, 'Dusun', 'admin/dusun', 'fas fa-fw fa-users', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kep_keluarga`
--
ALTER TABLE `kep_keluarga`
  ADD PRIMARY KEY (`no_kk`),
  ADD KEY `id_dusun` (`id_dusun`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
