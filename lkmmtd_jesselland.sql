-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2019 at 10:49 AM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lkmmtd_jesselland`
--
CREATE DATABASE IF NOT EXISTS `lkmmtd_jesselland` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lkmmtd_jesselland`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username_admin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`) VALUES
(1, 'admin', '4dm1n');

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE IF NOT EXISTS `airlines` (
  `id_airlines` int(11) NOT NULL AUTO_INCREMENT,
  `nama_airlines` varchar(100) NOT NULL,
  `kode_airlines` varchar(2) NOT NULL,
  `foto_airlines` varchar(100) NOT NULL,
  PRIMARY KEY (`id_airlines`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id_airlines`, `nama_airlines`, `kode_airlines`, `foto_airlines`) VALUES
(1, 'Garuda Indonesia', 'GA', 'garudaindonesia'),
(2, 'Batik Air', 'ID', 'batikair'),
(3, 'Citilink', 'QG', 'citilink'),
(4, 'Air Asia', 'QZ', 'airasia'),
(5, 'Sriwijaya Air', 'SJ', 'sriwijayaair'),
(6, 'Lion Air', 'JT', 'lionair'),
(13, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE IF NOT EXISTS `airport` (
  `id_airport` int(11) NOT NULL AUTO_INCREMENT,
  `nama_airport` varchar(100) NOT NULL,
  `kode_airport` varchar(5) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `negara` varchar(100) NOT NULL,
  PRIMARY KEY (`id_airport`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`id_airport`, `nama_airport`, `kode_airport`, `kota`, `negara`) VALUES
(1, 'Adi Sutjipto', 'JOG', 'Yogyakarta', 'Indonesia'),
(2, 'Ahmad Yani', 'SRG', 'Semarang', 'Indonesia'),
(3, 'Frans Kaisiepo', 'BIK', 'Baik', 'Indonesia'),
(4, 'I Gusti Ngurah Rai', 'DPS', 'Denpasar', 'Indonesia'),
(5, 'Juanda', 'SUB', 'Surabaya', 'Indonesia'),
(6, 'Pattimura', 'AMQ', 'Ambon', 'Indonesia'),
(7, 'Depati Amir', 'PGK', 'Pangkal Pinang', 'Indonesia'),
(8, 'Husein Sastranegara', 'BDO', 'Bandung', 'Indonesia'),
(9, 'Minangkabau', 'PDG', 'Padang', 'Indonesia'),
(10, 'Raja Haji Fisabilillah', 'TNJ', 'Tanjung Pinang', 'Indonesia'),
(21, 'Tulung agung', 'TA', 'Tulung Agung', 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `bank_debit`
--

CREATE TABLE IF NOT EXISTS `bank_debit` (
  `id_kartudebit` int(10) NOT NULL AUTO_INCREMENT,
  `nomor_kartu` varchar(20) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `tanggal_valid` date NOT NULL,
  `saldo` int(11) NOT NULL,
  PRIMARY KEY (`id_kartudebit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bank_debit`
--

INSERT INTO `bank_debit` (`id_kartudebit`, `nomor_kartu`, `nama_pemilik`, `nama_bank`, `tanggal_valid`, `saldo`) VALUES
(1, '4444-3333-2222-1', 'Joella Kurniawan', 'BCA', '2020-02-01', 18200000),
(4, '213412', 'Andhika', 'CIMB', '2022-10-21', 34234),
(6, '123', 'Jee', 'APA', '2019-06-27', -72488000);

-- --------------------------------------------------------

--
-- Table structure for table `bank_kredit`
--

CREATE TABLE IF NOT EXISTS `bank_kredit` (
  `id_kartukredit` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_kartu` varchar(20) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `tanggal_valid` date NOT NULL,
  `tiga_digit` varchar(3) NOT NULL,
  `tagihan` int(11) NOT NULL,
  PRIMARY KEY (`id_kartukredit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bank_kredit`
--

INSERT INTO `bank_kredit` (`id_kartukredit`, `nomor_kartu`, `nama_pemilik`, `nama_bank`, `tanggal_valid`, `tiga_digit`, `tagihan`) VALUES
(1, '1111222233334444', 'Joella Kurniawan', 'Mandiri', '2020-02-01', '123', 67900000),
(2, '5231241', 'Andhika', 'CIMB', '2012-02-19', '634', 12512312),
(3, '55555', 'Jessica', 'BCA', '2012-02-03', '856', 77000);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `username_customer` varchar(100) NOT NULL,
  `password_customer` varchar(100) NOT NULL,
  `email_customer` varchar(50) NOT NULL,
  `nohp_customer` varchar(12) NOT NULL,
  `fullname_customer` varchar(50) NOT NULL,
  `saldo` int(11) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id_customer`, `username_customer`, `password_customer`, `email_customer`, `nohp_customer`, `fullname_customer`, `saldo`) VALUES
(6, 'joella', 'joella', 'joella@gmail.com', '081029312111', 'Joella Kurniawan', 40800000),
(10, 'andhika', 'dhikk', 'andhika@gmail.com', '083246578', 'Andhika Evantia', 0),
(20, 'omg', 'really', 'akal@gmail.com', 'inters', 'ting', 0),
(46, 'a', 'l', 'r', 'g', 'i', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_penerbangan`
--

CREATE TABLE IF NOT EXISTS `jadwal_penerbangan` (
  `id_jdpenerbangan` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_penerbangan` date NOT NULL,
  `jam_berangkat` varchar(5) NOT NULL,
  `jam_tiba` varchar(5) NOT NULL,
  `durasi` varchar(7) NOT NULL,
  `lokasi_awal` varchar(3) NOT NULL,
  `lokasi_tujuan` varchar(3) NOT NULL,
  `id_pesawat` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id_jdpenerbangan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `jadwal_penerbangan`
--

INSERT INTO `jadwal_penerbangan` (`id_jdpenerbangan`, `tanggal_penerbangan`, `jam_berangkat`, `jam_tiba`, `durasi`, `lokasi_awal`, `lokasi_tujuan`, `id_pesawat`, `harga`) VALUES
(1, '2019-06-10', '13.00', '14.30', '1j 30m', 'SUB', 'CGK', 3, 1250000),
(2, '2019-06-12', '08.00', '11.00', '3j', 'CGK', 'SUB', 5, 1500000),
(4, '2019-06-15', '13.00', '15.00', '2j', 'CGK', 'SUB', 1, 1200000),
(5, '2019-06-15', '16.00', '17.00', '1j', 'SUB', 'DPS', 2, 1000000),
(6, '2019-06-15', '12.00', '14.30', '2j 30m', 'CGK', 'DPS', 7, 2000000),
(7, '2019-06-20', '07.00', '16.00', '7j', 'CGK', 'GMP', 1, 4000000),
(8, '2019-06-20', '10.00', '14.00', '3j', 'CGK', 'BKK', 1, 2200000),
(9, '2019-06-20', '15.00', '21.30', '5j 30m', 'BKK', 'GMP', 2, 2350000),
(10, '2019-06-20', '12.00', '16.00', '3j', 'CGK', 'KUL', 1, 2100000),
(11, '2019-06-21', '09.00', '16.40', '6j 40m', 'KUL', 'GMP', 2, 2250000),
(12, '2019-06-20', '08.00', '14.30', '5j 30m', 'CGK', 'SZX', 3, 2000000),
(13, '2019-06-20', '15.00', '17.30', '2j 30m', 'SZX', 'PVG', 4, 1200000),
(14, '2019-06-20', '19.00', '22.30', '2j 30m', 'PVG', 'GMP', 3, 2000000),
(15, '2019-06-20', '08.25', '11.20', '1j 55m', 'CGK', 'SIN', 5, 2000000),
(16, '2019-06-20', '20.45', '22.55', '2j 10m', 'SIN', 'SGN', 6, 2000000),
(17, '2019-06-21', '06.40', '11.40', '5j', 'SGN', 'GMP', 5, 2000000),
(23, '2019-06-20', '17.12', '18.12', '1j', 'ABC', 'POO', 1, 2100000),
(19, '2019-06-21', '08.00', '12.00', '4j', 'SZX', 'SHE', 4, 2100000),
(20, '2019-06-21', '14.00', '16.30', '1j 30m', 'SHE', 'GMP', 4, 3150000),
(24, '2019-06-25', '07.00', '16.00', '7j', 'GMP', 'CGK', 3, 4000000),
(25, '2019-06-25', '10.00', '14.30', '5j 30m', 'GMP', 'BKK', 3, 2200000),
(26, '2019-06-25', '16.00', '18.00', '3j', 'BKK', 'CGK', 4, 2350000),
(27, '2019-06-25', '12.00', '17.40', '6j 40m', 'GMP', 'KUL', 5, 2500000),
(28, '2019-06-26', '09.00', '11.00', '3j', 'KUL', 'CGK', 6, 2150000),
(29, '2019-06-25', '08.00', '09.30', '2j 30m', 'GMP', 'PVG', 1, 2000000),
(30, '2019-06-25', '11.00', '13.30', '2j 30m', 'PVG', 'SZX', 2, 2100000),
(31, '2019-06-25', '14.00', '19.00', '5j 30m', 'SZX', 'CGK', 2, 2000000),
(32, '2019-06-25', '08.25', '12.25', '5j', 'GMP', 'SGN', 3, 2200000),
(33, '2019-06-25', '14.00', '15.10', '2j 10m', 'SGN', 'SIN', 4, 2000000),
(34, '2019-06-26', '08.00', '9.00', '1j 55m', 'SIN', 'CGK', 4, 1900000),
(35, '2019-06-26', '07.00', '08.30', '2j 30m', 'PVG', 'SZX', 1, 2000000),
(36, '2019-06-26', '10.00', '12.00', '3j', 'SZX', 'CGK', 2, 2300000),
(37, '2019-06-21', '19.50', '20.50', '1j', 'TA', 'SUB', 1, 2000000),
(38, '2019-06-21', '19.55', '20.55', '1j', 'TA', 'SUB', 3, 1500000),
(39, '2019-06-20', '12.00', '23.00', '7j', 'CGK', 'GMP', 3, 4500000),
(40, '2019-06-10', '07.00', '15.15', '7j', 'CGK', 'GMP', 4, 4500000);

-- --------------------------------------------------------

--
-- Table structure for table `kursi`
--

CREATE TABLE IF NOT EXISTS `kursi` (
  `id_kursi` int(11) NOT NULL AUTO_INCREMENT,
  `harga` int(11) NOT NULL,
  `id_jdpenerbangan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  PRIMARY KEY (`id_kursi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE IF NOT EXISTS `penumpang` (
  `id_penumpang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penumpang` varchar(100) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  PRIMARY KEY (`id_penumpang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`id_penumpang`, `nama_penumpang`, `id_pesanan`) VALUES
(44, 'a', 42),
(43, 'a', 42),
(42, 'a', 42),
(41, 'a', 42),
(40, 'a', 42),
(39, 'a', 42),
(38, 'a', 42),
(8, 'satu', 11),
(37, 'a', 42),
(47, 'aaaa', 43),
(36, 'Lilili', 38),
(14, 'Jesselland', 16),
(35, 'Lilili', 39),
(15, 'joella', 17),
(16, 'jesselland', 17),
(19, 'aaa', 23),
(20, 'aaa', 23),
(21, 'Andhika Evantia Irawan', 28),
(22, 'Andhika Evantia Irawan', 27),
(23, 'Chelsea Islan', 28),
(24, 'Chelsea Islan', 27),
(25, 'Andhika Evantia Irawan', 32),
(26, 'Andhika Evantia Irawan', 31),
(27, 'Andhika Evantia Irawan', 34),
(28, 'Andhika Evantia Irawan', 34),
(29, 'Joella', 36),
(34, 'Lalala', 38),
(31, 'Jessica', 36),
(33, 'Lalala', 39),
(45, 'a', 42),
(46, 'a', 42);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE IF NOT EXISTS `pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `biaya_reschedule` int(11) DEFAULT NULL,
  `total_biaya` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_jdpenerbangan` int(11) NOT NULL,
  `jumlah_passenger` int(11) NOT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `biaya_reschedule`, `total_biaya`, `id_customer`, `id_jdpenerbangan`, `jumlah_passenger`) VALUES
(1, NULL, 1250000, 10, 1, 4),
(2, NULL, 1500000, 10, 1, 7),
(19, NULL, 4000000, 6, 16, 2),
(17, NULL, 0, 6, -1, 2),
(16, NULL, 4000000, 6, 7, 1),
(42, NULL, 31500000, 6, 20, 10),
(41, NULL, 21000000, 6, 19, 10),
(40, NULL, 20000000, 6, 12, 10),
(11, NULL, 1500000, 6, 2, 1),
(39, NULL, 4700000, 6, 26, 2),
(43, NULL, 1200000, 6, 4, 1),
(38, NULL, 4400000, 6, 25, 2),
(18, NULL, 4000000, 6, 15, 2),
(21, NULL, 4000000, 6, 12, 2),
(22, NULL, 4200000, 6, 19, 2),
(23, NULL, 6300000, 6, 20, 2),
(24, NULL, 4200000, 6, 10, 2),
(25, NULL, 4500000, 6, 11, 2),
(26, NULL, 4400000, 6, 32, 2),
(27, NULL, 4000000, 6, 33, 2),
(28, NULL, 3800000, 6, 34, 2),
(29, NULL, 2000000, 6, 12, 1),
(30, NULL, 1200000, 6, 13, 1),
(31, NULL, 2000000, 6, 14, 1),
(32, NULL, 4000000, 6, 24, 1),
(33, NULL, 8000000, 6, 7, 2),
(34, NULL, 8000000, 6, 24, 2),
(37, NULL, 8000000, 6, 7, 2),
(36, NULL, 3000000, 6, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pesawat`
--

CREATE TABLE IF NOT EXISTS `pesawat` (
  `id_pesawat` int(11) NOT NULL AUTO_INCREMENT,
  `kapasitas_pesawat` int(11) NOT NULL,
  `id_airlines` int(11) NOT NULL,
  `kode_pesawat` varchar(8) NOT NULL,
  PRIMARY KEY (`id_pesawat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pesawat`
--

INSERT INTO `pesawat` (`id_pesawat`, `kapasitas_pesawat`, `id_airlines`, `kode_pesawat`) VALUES
(1, 78, 6, 'JT-690'),
(2, 85, 6, 'JT-890'),
(3, 78, 1, 'GA-306'),
(4, 66, 1, 'GA-303'),
(5, 78, 2, 'ID-6572'),
(6, 66, 2, 'ID-6370'),
(7, 10, 3, 'QG-010'),
(9, 55, 2, 'ID-6572'),
(10, 424, 2, 'ID-6370');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
