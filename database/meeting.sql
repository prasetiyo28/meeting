-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2019 at 07:06 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meeting`
--

-- --------------------------------------------------------

--
-- Table structure for table `kapasitas`
--

CREATE TABLE `kapasitas` (
  `id_kapasitas` int(2) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kapasitas`
--

INSERT INTO `kapasitas` (`id_kapasitas`, `keterangan`, `deleted`) VALUES
(1, '10 < 30 Orang', 0),
(2, '30 < 50 Orang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_mitra` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `nomor_rekening` varchar(20) NOT NULL,
  `nama_akun_bank` varchar(100) NOT NULL,
  `verif` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `id_user`, `nama_mitra`, `alamat`, `no_telp`, `nama_pemilik`, `nama_bank`, `nomor_rekening`, `nama_akun_bank`, `verif`, `deleted`) VALUES
(1, 2, 'Cafe Cho Cho', 'Jalan Mataram No.28 Pesurungan Lor, Kota Tegal', '085643281778', 'Bayu Adi Prasetiyo', 'BRI (Bank Rakyat Indonesia)', '225252897878', 'Bayu Adi Prasetiyo', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `kapasitas` int(1) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail_foto` varchar(255) DEFAULT NULL,
  `verif` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `id_mitra`, `nama_ruangan`, `kapasitas`, `foto`, `detail_foto`, `verif`, `deleted`, `harga`) VALUES
(1, 1, 'Ruang Meeting 1 Cafe Cho Cho ', 1, 'ruang_1556813387.png', 'default.jpeg', 0, 0, 150000),
(2, 1, 'Ruang Meeting 2 Cafe Cho Cho ', 1, 'ruang_mitra11556816431.png', 'default.jpeg', 0, 0, 120000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_user` tinyint(1) NOT NULL DEFAULT '0',
  `verifikasi` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `no_hp`, `password`, `jenis_user`, `verifikasi`, `deleted`) VALUES
(1, 'admin', 'bayu28.bap@gmail.com', '085643281795', 'c811416626e3640491ed6a09dd9f57e9', 0, 1, 0),
(2, 'Bayu Adi Prasetiyo', 'bayu-28@live.com', '085643281795', '92360c2c392c85b23f38c188996f8d74', 1, 1, 0),
(3, 'meeting', 'meeting@meeting.com', '123123123123', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kapasitas`
--
ALTER TABLE `kapasitas`
  ADD PRIMARY KEY (`id_kapasitas`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kapasitas`
--
ALTER TABLE `kapasitas`
  MODIFY `id_kapasitas` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
