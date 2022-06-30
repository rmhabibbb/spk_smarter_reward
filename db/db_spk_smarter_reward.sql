-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2021 at 05:06 AM
-- Server version: 5.7.23
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_smarter_reward`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
CREATE TABLE IF NOT EXISTS `akun` (
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` int(1) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`email`, `password`, `role`) VALUES
('a1@gmail.com', 'a3dcb4d229de6fde0db5686dee47145d', 4),
('a2@gmail.com', '0be2e2181e44147226f01f97c939891b', 4),
('a3@gmail.com', 'ccc0bf40a4ce6f31e511ddf16a32661b', 4),
('a4@gmail.com', 'ce46c294226006ca45dcc40fc07db941', 4),
('a5@gmail.com', '51500b906caa1422b9aeb7204aed2096', 4),
('admin.pertamina@gmail.com', '7815696ecbf1c96e6894b779456d330e', 1),
('kabag.pertamina@gmail.com', 'a3dcb4d229de6fde0db5686dee47145d', 3),
('odd.akun@gmail.com', 'a3dcb4d229de6fde0db5686dee47145d', 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_laporan`
--

DROP TABLE IF EXISTS `detail_laporan`;
CREATE TABLE IF NOT EXISTS `detail_laporan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_laporan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `nilai_preferensi` decimal(5,4) NOT NULL,
  `peringkat` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_laporan` (`id_laporan`),
  KEY `id_karyawan` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_laporan`
--

INSERT INTO `detail_laporan` (`id`, `id_laporan`, `id_karyawan`, `nilai_preferensi`, `peringkat`, `status`) VALUES
(16, 3, 733011, '0.3001', 1, 1),
(17, 3, 749097, '0.2884', 2, 1),
(18, 3, 753064, '0.1454', 3, 1),
(19, 3, 746144, '0.1331', 4, 0),
(20, 3, 747692, '0.1207', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penilaian`
--

DROP TABLE IF EXISTS `detail_penilaian`;
CREATE TABLE IF NOT EXISTS `detail_penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penilaian` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_pengawas` int(11) NOT NULL,
  `sub` int(11) NOT NULL,
  `nilai` decimal(5,4) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_penilaian` (`id_penilaian`),
  KEY `id_karyawan` (`id_karyawan`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_pengawas` (`id_pengawas`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penilaian`
--

INSERT INTO `detail_penilaian` (`id`, `id_penilaian`, `id_karyawan`, `id_kriteria`, `id_pengawas`, `sub`, `nilai`, `keterangan`) VALUES
(162, 1, 746144, 1, 1, 4, '0.4567', 'Kehadiran Full '),
(163, 1, 746144, 2, 1, 9, '0.1111', 'Sering melanggar'),
(164, 1, 746144, 3, 1, 12, '0.1458', 'Cukup'),
(165, 1, 746144, 4, 1, 18, '0.0400', '< 50% '),
(166, 1, 746144, 5, 1, 22, '0.0625', 'Slow Respon'),
(167, 1, 733011, 1, 1, 3, '0.2567', 'Full, Kesiangan 8 jam'),
(168, 1, 733011, 2, 1, 8, '0.2778', 'Taat peraturan, Kurang tepat dalam berseragam'),
(169, 1, 733011, 3, 1, 10, '0.5208', 'Sangat Tinggi '),
(170, 1, 733011, 4, 1, 15, '0.2567', 'Melebihi Target (101% - 150%) '),
(171, 1, 733011, 5, 1, 20, '0.2708', 'Cepat'),
(172, 1, 747692, 1, 1, 1, '0.1567', 'Tidak hadir 1 – 7 hari'),
(173, 1, 747692, 2, 1, 8, '0.2778', 'Taat peraturan, Kurang tepat dalam berseragam'),
(174, 1, 747692, 3, 1, 10, '0.5208', 'Sangat Tinggi '),
(175, 1, 747692, 4, 1, 16, '0.1567', 'Melebihi Target (91% - 100%) '),
(176, 1, 747692, 5, 1, 22, '0.0625', 'Slow Respon'),
(177, 1, 749097, 1, 1, 4, '0.4567', 'Kehadiran Full '),
(178, 1, 749097, 2, 1, 8, '0.2778', 'Taat peraturan, Kurang tepat dalam berseragam'),
(179, 1, 749097, 3, 1, 12, '0.1458', 'Cukup'),
(180, 1, 749097, 4, 1, 15, '0.2567', 'Melebihi Target (101% - 150%) '),
(181, 1, 749097, 5, 1, 20, '0.2708', 'Cepat'),
(182, 1, 753064, 1, 1, 6, '0.0400', 'Tidak hadir <14 hari'),
(183, 1, 753064, 2, 1, 9, '0.1111', 'Sering melanggar'),
(184, 1, 753064, 3, 1, 13, '0.0625', 'Kurang'),
(185, 1, 753064, 4, 1, 18, '0.0400', '< 50% '),
(186, 1, 753064, 5, 1, 22, '0.0625', 'Slow Respon'),
(187, 3, 733011, 1, 1, 4, '0.4567', 'Kehadiran Full '),
(188, 3, 733011, 2, 1, 9, '0.1111', 'Sering melanggar'),
(189, 3, 733011, 3, 1, 11, '0.2708', 'Tinggi'),
(190, 3, 733011, 4, 1, 16, '0.1567', 'Melebihi Target (91% - 100%) '),
(191, 3, 733011, 5, 1, 22, '0.0625', 'Slow Respon'),
(192, 3, 749097, 1, 1, 3, '0.2567', 'Full, Kesiangan 8 jam'),
(193, 3, 749097, 2, 1, 8, '0.2778', 'Taat peraturan, Kurang tepat dalam berseragam'),
(194, 3, 749097, 3, 1, 12, '0.1458', 'Cukup'),
(195, 3, 749097, 4, 1, 15, '0.2567', 'Melebihi Target (101% - 150%) '),
(196, 3, 749097, 5, 1, 21, '0.1458', 'Cukup cepat'),
(197, 3, 753064, 1, 1, 3, '0.2567', 'Full, Kesiangan 8 jam'),
(198, 3, 753064, 2, 1, 8, '0.2778', 'Taat peraturan, Kurang tepat dalam berseragam'),
(199, 3, 753064, 3, 1, 12, '0.1458', 'Cukup'),
(200, 3, 753064, 4, 1, 16, '0.1567', 'Melebihi Target (91% - 100%) '),
(201, 3, 753064, 5, 1, 22, '0.0625', 'Slow Respon');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(35) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(25) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `tl` date NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_karyawan`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1222 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `email`, `foto`, `jk`, `tl`, `jabatan`, `no_hp`, `alamat`) VALUES
(733011, 'Herman Sudrajat', 'a1@gmail.com', 'karyawan/395751.jpg', 'Perempuan', '1997-04-03', '--', '082289505466', 'Gandus'),
(746144, 'Afiz Zullah', 'a3@gmail.com', 'karyawan/default-l.jpg', 'Laki - Laki', '1990-01-01', '-', '', ''),
(747692, 'Doddy Prasetyo', 'a5@gmail.com', 'karyawan/default-l.jpg', 'Laki - Laki', '1990-01-01', '-', '', ''),
(749097, 'Mohammad Sayidin', 'a4@gmail.com', 'karyawan/default-l.jpg', 'Laki - Laki', '1990-01-01', '-', '', ''),
(753064, 'Reggy Firman Pratama', 'a2@gmail.com', 'karyawan/default-l.jpg', 'Laki - Laki', '1990-01-01', '-', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` text NOT NULL,
  `prioritas` int(3) NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `prioritas`) VALUES
(1, 'Presensi', 3),
(2, 'Kedisiplinan', 1),
(3, 'Kerjasama', 4),
(4, 'Produktivitas', 2),
(5, 'Responsive', 5);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

DROP TABLE IF EXISTS `laporan`;
CREATE TABLE IF NOT EXISTS `laporan` (
  `id_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(4) NOT NULL,
  `jumlah_penerima_reward` int(5) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_laporan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `tahun`, `jumlah_penerima_reward`, `tgl_buat`, `status`) VALUES
(3, 2021, 3, '2021-01-14 08:30:38', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengawas`
--

DROP TABLE IF EXISTS `pengawas`;
CREATE TABLE IF NOT EXISTS `pengawas` (
  `id_pengawas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengawas` varchar(35) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pengawas`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengawas`
--

INSERT INTO `pengawas` (`id_pengawas`, `nama_pengawas`, `email`, `jk`, `no_hp`) VALUES
(1, 'Odd', 'odd.akun@gmail.com', 'Perempuan', '082289505466');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_penilaian`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `bulan`, `tahun`, `status`) VALUES
(1, 1, 2021, 2),
(3, 2, 2021, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

DROP TABLE IF EXISTS `subkriteria`;
CREATE TABLE IF NOT EXISTS `subkriteria` (
  `id_sub` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `prioritas` int(3) NOT NULL,
  PRIMARY KEY (`id_sub`),
  KEY `id_kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_sub`, `id_kriteria`, `keterangan`, `prioritas`) VALUES
(1, 1, 'Tidak hadir 1 – 7 hari', 3),
(3, 1, 'Full, Kesiangan 8 jam', 2),
(4, 1, 'Kehadiran Full ', 1),
(5, 1, 'Tidak hadir 8 – 14 hari', 4),
(6, 1, 'Tidak hadir <14 hari', 5),
(7, 2, 'Taat peraturan, Tepat dalam berseragam', 1),
(8, 2, 'Taat peraturan, Kurang tepat dalam berseragam', 2),
(9, 2, 'Sering melanggar', 3),
(10, 3, 'Sangat Tinggi ', 1),
(11, 3, 'Tinggi', 2),
(12, 3, 'Cukup', 3),
(13, 3, 'Kurang', 4),
(14, 4, 'Melebihi Target >150% ', 1),
(15, 4, 'Melebihi Target (101% - 150%) ', 2),
(16, 4, 'Melebihi Target (91% - 100%) ', 3),
(17, 4, 'Melebihi Target (50% - 90%) ', 4),
(18, 4, '< 50% ', 5),
(19, 5, 'Sangat Cepat', 1),
(20, 5, 'Cepat', 2),
(21, 5, 'Cukup cepat', 3),
(22, 5, 'Slow Respon', 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_laporan`
--
ALTER TABLE `detail_laporan`
  ADD CONSTRAINT `fk_dl_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dl_laporan` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id_laporan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD CONSTRAINT `fk_dp_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dp_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dp_pengawas` FOREIGN KEY (`id_pengawas`) REFERENCES `pengawas` (`id_pengawas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dp_penilaian` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `fk_karyawan_email` FOREIGN KEY (`email`) REFERENCES `akun` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengawas`
--
ALTER TABLE `pengawas`
  ADD CONSTRAINT `fk_pengawas_email` FOREIGN KEY (`email`) REFERENCES `akun` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `fk_sub_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
