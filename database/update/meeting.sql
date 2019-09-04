-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2019 at 02:39 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.2.19

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
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lama` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `makan_minum` text NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `tanggal_booking` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_ruang`, `id_user`, `lama`, `tanggal`, `jam`, `makan_minum`, `total`, `bayar`, `tanggal_booking`, `status`) VALUES
(1, 2, 4, 1, '2019-07-03', '10:00:00', 'Kopi : 5,000 x 1 = 5,000\r\nEs Teh : 3,000 x 1 = 3,000\r\nRoti Bakar : 10,000 x 6 = 60,000\r\n', 188000, 0, '2019-07-03 00:28:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `makanan_minuman`
--

CREATE TABLE `makanan_minuman` (
  `id_mak_min` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `harga` int(10) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makanan_minuman`
--

INSERT INTO `makanan_minuman` (`id_mak_min`, `id_mitra`, `nama`, `harga`, `foto`, `deleted`) VALUES
(1, 1, 'Es Teh', 3000, 'minuman11562102262.jpg', 0),
(2, 1, 'Kopi', 5000, 'minuman11562102813.jpg', 0),
(3, 1, 'Roti Bakar', 10000, 'foodbev_11562105790.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `makanan_minuman`
--
ALTER TABLE `makanan_minuman`
  ADD PRIMARY KEY (`id_mak_min`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `makanan_minuman`
--
ALTER TABLE `makanan_minuman`
  MODIFY `id_mak_min` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
