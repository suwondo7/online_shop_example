-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 23, 2013 at 04:19 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baju_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `_admin`
--

CREATE TABLE IF NOT EXISTS `_admin` (
  `usernames` varchar(15) NOT NULL,
  `passwords` varchar(50) NOT NULL,
  `nama` varchar(40) NOT NULL,
  PRIMARY KEY (`usernames`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin`
--

INSERT INTO `_admin` (`usernames`, `passwords`, `nama`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator'),
('aku', '202cb962ac59075b964b07152d234b70', 'Aku Sendiri'),
('adm', '123', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `_baju`
--

CREATE TABLE IF NOT EXISTS `_baju` (
  `id_baju` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `id_baju_kategori` varchar(20) NOT NULL,
  `id_baju_merk` varchar(20) NOT NULL,
  `warna` varchar(40) NOT NULL,
  `ukuran` varchar(5) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `stok` tinyint(4) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id_baju`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_baju`
--

INSERT INTO `_baju` (`id_baju`, `nama`, `id_baju_kategori`, `id_baju_merk`, `warna`, `ukuran`, `harga`, `foto`, `keterangan`, `stok`, `tanggal`) VALUES
('BAJU507c305216a6a', 'Baju Gamis', 'KATE507c2d4a75108', 'MERK507c2f6944305', 'Merah', 'XL', 30000, '../resources/res51da7996c28d1-baju_product_02.png', '', 10, '2013-07-08 15:34:30'),
('BAJU507c911d8a491', 'Baju Koko', 'KATE507c2d51ef229', 'MERK507c2f5fab2f8', 'Abu - abu', 'S', 20000, '../resources/res51da79a9d1cf7-baju_product_03.png', '', 20, '2013-07-08 15:34:49'),
('BAJU507d85353342d', 'Baju Piyama', 'KATE507c2d4a75108', 'MERK507c2f5fab2f8', 'Biru', 'XL', 12000, '../resources/res51da79c9e1118-baju_product_07.png', '', 12, '2013-07-08 15:35:21'),
('BAJU50ac876c26260', 'Baju Batik', 'KATE50ac871e44aa8', 'MERK50ac870e94c65', 'Merah', 'XXL', 20000, '../resources/res51da798735695-baju_product_01.png', '', 20, '2013-07-08 15:34:15'),
('BAJU50f5f543e4e21', 'Baju Kurung', 'KATE507c2d4a75108', 'MERK507c2f5fab2f8', 'Merah Merona', 'XXL', 200000, '../resources/res51da79b81e84f-baju_product_04.png', '', 20, '2013-07-08 15:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `_baju_kategori`
--

CREATE TABLE IF NOT EXISTS `_baju_kategori` (
  `id_baju_kategori` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  PRIMARY KEY (`id_baju_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_baju_kategori`
--

INSERT INTO `_baju_kategori` (`id_baju_kategori`, `nama`) VALUES
('KATE507c2d4a75108', 'Baju Wanita'),
('KATE507c2d51ef229', 'Baju Anak - anak'),
('KATE50ac871e44aa8', 'Baju Laki - laki'),
('KATE50f5f4ea1ab43', 'Baju Umum'),
('KATE51806232ca2e2', 'Baju Olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `_baju_merk`
--

CREATE TABLE IF NOT EXISTS `_baju_merk` (
  `id_baju_merk` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  PRIMARY KEY (`id_baju_merk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_baju_merk`
--

INSERT INTO `_baju_merk` (`id_baju_merk`, `nama`) VALUES
('MERK507c2f5fab2f8', 'Hassenda'),
('MERK507c2f6944305', 'Otto - Ono'),
('MERK50ac870e94c65', 'Cardinal'),
('MERK50f5f4f8a7d91', 'Nevada'),
('MERK518062506acff', 'Leak');

-- --------------------------------------------------------

--
-- Table structure for table `_customer`
--

CREATE TABLE IF NOT EXISTS `_customer` (
  `email` varchar(40) NOT NULL,
  `passwords` varchar(50) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `gender` enum('1','0') NOT NULL DEFAULT '0',
  `foto` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_customer`
--

INSERT INTO `_customer` (`email`, `passwords`, `nama`, `gender`, `foto`, `alamat`, `telepon`) VALUES
('test@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Test', '1', 'photos/CUST51f7497b13133', 'Ok', '4543534'),
('denny.hermawan@yahoo.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Denny', '1', 'photos/CUST515d3581c28d5Angry Birds.JPG', 'Jl. WOnokusumo', '031-343434'),
('izza@yahoo.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Izza', '1', 'photos/CUST5180631c0f42aindonesia.png', 'Jl. Petemon I SUrabaya', '085633312345'),
('rica@yahoo.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Rica Indah Lestari', '0', 'photos/CUST51edd9253d097', 'Jl. Sememi', '089675463421'),
('dudin@yahoo.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Immaduddin', '1', 'photos/CUST51ef2c5f3197e', 'Jl. SUrabaya', '08967544273'),
('putri@yahoo.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Putri wahyuningtyas', '0', '../users/photos/CUST50f6232e8d1d9Sunset.jpg', 'Jl. Rungkut Menanggal Industri 17 Surabaya', '031-343434');

-- --------------------------------------------------------

--
-- Table structure for table `_pemesanan`
--

CREATE TABLE IF NOT EXISTS `_pemesanan` (
  `id_pemesanan` varchar(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  `email` varchar(40) NOT NULL,
  `tujuan_pengiriman` varchar(100) NOT NULL,
  `alamat_pengiriman` varchar(100) NOT NULL,
  `tanggal_konfirmasi` datetime NOT NULL,
  `bank_konfirmasi` varchar(100) NOT NULL,
  `nama_konfirmasi` varchar(100) NOT NULL,
  `jumlah_konfirmasi` double NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_pemesanan`
--

INSERT INTO `_pemesanan` (`id_pemesanan`, `tanggal`, `email`, `tujuan_pengiriman`, `alamat_pengiriman`, `tanggal_konfirmasi`, `bank_konfirmasi`, `nama_konfirmasi`, `jumlah_konfirmasi`, `status`) VALUES
('ORD523ff77dc65d9', '2013-09-23 15:10:37', 'izza@yahoo.com', '0', 'Ok', '0000-00-00 00:00:00', '', '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `_pemesanan_detail`
--

CREATE TABLE IF NOT EXISTS `_pemesanan_detail` (
  `id_pemesanan` varchar(20) NOT NULL,
  `id_baju` varchar(20) NOT NULL,
  `jumlah` tinyint(4) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_pemesanan_detail`
--

INSERT INTO `_pemesanan_detail` (`id_pemesanan`, `id_baju`, `jumlah`, `subtotal`) VALUES
('ORD50f5f66072714', 'BAJU507c911d8a491', 2, 40000),
('ORD50a344fc1e84d', 'BAJU507c911d8a491', 2, 40000),
('ORD50a344fc1e84d', 'BAJU507d85353342d', 5, 60000),
('ORD50f5f66072714', 'BAJU50f5f543e4e21', 1, 200000),
('ORD50f5f66072714', 'BAJU50ac876c26260', 4, 80000),
('ORD50f5f6d094c65', 'BAJU50f5f543e4e21', 1, 200000),
('ORD50f5f6d094c65', 'BAJU50ac876c26260', 1, 20000),
('ORD50f623697a0a9', 'BAJU50f5f543e4e21', 1, 200000),
('ORD50f623697a0a9', 'BAJU50ac876c26260', 3, 60000),
('ORD515d3617cdfed', 'BAJU507c911d8a491', 3, 60000),
('ORD515d3617cdfed', 'BAJU507d85353342d', 3, 36000),
('ORD51806396cdfed', 'BAJU518062bf44aa7', 2, 30000),
('ORD51806396cdfed', 'BAJU507d85353342d', 3, 36000),
('ORD51f7499444aa7', 'BAJU507c911d8a491', 1, 20000),
('ORD51f7499444aa7', 'BAJU50ac876c26260', 1, 20000),
('ORD523ff77dc65d9', 'BAJU507c911d8a491', 19, 380000);
