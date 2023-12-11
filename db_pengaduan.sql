-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 05:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `kode` varchar(40) NOT NULL,
  `nama_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `kode`, `nama_admin`) VALUES
(1, 'KODE1', 'paang'),
(2, 'KODE3', 'ridho'),
(13, 'KODE4', 'Rifansyah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id_login` int(11) NOT NULL,
  `kode` varchar(40) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `status` enum('online','offline') NOT NULL,
  `proses` enum('aktif','non_aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id_login`, `kode`, `username`, `password`, `level`, `status`, `proses`) VALUES
(1, 'KODE1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'offline', 'aktif'),
(2, 'KODE2', 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'user', 'offline', 'aktif'),
(3, 'KODE3', 'admin3', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'offline', 'aktif'),
(5, 'USE-0003', 'bedol', '348aa8f981ef0d1d1315491e49791b11', 'user', 'online', 'aktif'),
(6, 'USE-0004', 'paang', 'd91561680ffae8a84902e5ed4ca0bf98', 'user', 'offline', 'aktif'),
(7, 'USE-0005', 'rifan', '5b374736b2f5f985fc77e54d6303b662', 'user', 'offline', 'aktif'),
(8, 'KODE4', 'rifansyah', '5b374736b2f5f985fc77e54d6303b662', 'admin', 'offline', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaduan`
--

CREATE TABLE `tb_pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul_pengaduan` text NOT NULL,
  `isi_pengaduan` varchar(50) NOT NULL,
  `gambar_pengaduan` varchar(255) NOT NULL,
  `tgl_pengaduan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengaduan`
--

INSERT INTO `tb_pengaduan` (`id_pengaduan`, `id_user`, `judul_pengaduan`, `isi_pengaduan`, `gambar_pengaduan`, `tgl_pengaduan`) VALUES
(9, 12, 'laporan', 'contoh laporan', '', '2023-12-05 23:12:46'),
(12, 12, 'contoh android', 'osas', 'android logo.png', '2023-12-05 23:12:47'),
(22, 2, 'hiu', 'hiu', 'wallhaven-qzdqvr.jpg', '2023-12-06 21:51:30'),
(23, 14, 'darth vader', 'darth vader new hope', 'wallhaven-496x2x.jpg', '2023-12-06 22:09:24'),
(24, 14, 'mabar', 'mabar ayo oi', '', '2023-12-06 22:21:42'),
(25, 2, 'maling', 'hati hati banyak sekali maling sekarang ini', '', '2023-12-06 22:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tanggapan`
--

CREATE TABLE `tb_tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `isi_tanggapan` text NOT NULL,
  `tgl_tanggapan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tanggapan`
--

INSERT INTO `tb_tanggapan` (`id_tanggapan`, `id_admin`, `id_pengaduan`, `isi_tanggapan`, `tgl_tanggapan`) VALUES
(31, 13, 24, 'hayoooo', '2023-12-11 21:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tanggapan_user`
--

CREATE TABLE `tb_tanggapan_user` (
  `id_tanggapan_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `isi_tanggapan_user` text NOT NULL,
  `tgl_tanggapan_user` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tanggapan_user`
--

INSERT INTO `tb_tanggapan_user` (`id_tanggapan_user`, `id_user`, `id_pengaduan`, `isi_tanggapan_user`, `tgl_tanggapan_user`) VALUES
(5, 12, 23, 'keren', '2023-12-11 15:08:45'),
(7, 14, 25, 'ngerii', '2023-12-11 15:10:59'),
(8, 2, 25, 'sss', '2023-12-11 15:17:35'),
(9, 14, 24, 'gasken', '2023-12-11 15:27:50'),
(11, 2, 22, 'keren', '2023-12-11 15:58:08'),
(12, 2, 24, 'haiyaaa', '2023-12-11 15:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `kode` varchar(40) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `kode`, `nama_user`, `pekerjaan`, `email`, `no_hp`, `foto`) VALUES
(2, 'KODE2', 'muhandis', 'mahasiswa', 'ridho.muhandis@gmail.com', '089765472812', '2.jfif'),
(12, 'USE-0003', 'muhandis', 'buruh', 'ridho@gmail.com', '089191912541', 'Desain tanpa judul (2).png'),
(13, 'USE-0004', 'ahmad farhan ', 'ngewibu', 'ruwaisyid@gmail.com', '08886777', 'luttfy.png'),
(14, 'USE-0005', 'rifan', 'anon', 'rifan@gnnn', '089988', 'wallhaven-mdppp9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_follow`
--

CREATE TABLE `tb_user_follow` (
  `id` int(11) NOT NULL,
  `kode` varchar(40) NOT NULL,
  `following` varchar(40) NOT NULL,
  `subscribed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_follow`
--

INSERT INTO `tb_user_follow` (`id`, `kode`, `following`, `subscribed`) VALUES
(34, 'KODE2', 'USE-0005', '2023-12-11 15:57:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_tanggapan`
--
ALTER TABLE `tb_tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `tb_tanggapan_user`
--
ALTER TABLE `tb_tanggapan_user`
  ADD PRIMARY KEY (`id_tanggapan_user`),
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `id_pengaduan` (`id_pengaduan`) USING BTREE;

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_user_follow`
--
ALTER TABLE `tb_user_follow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_tanggapan`
--
ALTER TABLE `tb_tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_tanggapan_user`
--
ALTER TABLE `tb_tanggapan_user`
  MODIFY `id_tanggapan_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_user_follow`
--
ALTER TABLE `tb_user_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD CONSTRAINT `tb_pengaduan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_tanggapan`
--
ALTER TABLE `tb_tanggapan`
  ADD CONSTRAINT `tb_tanggapan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `tb_pengaduan` (`id_pengaduan`),
  ADD CONSTRAINT `tb_tanggapan_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `tb_admin` (`id_admin`);

--
-- Constraints for table `tb_tanggapan_user`
--
ALTER TABLE `tb_tanggapan_user`
  ADD CONSTRAINT `tb_tanggapan_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_tanggapan_user_ibfk_2` FOREIGN KEY (`id_pengaduan`) REFERENCES `tb_pengaduan` (`id_pengaduan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
