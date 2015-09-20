-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2013 at 01:17 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contoh_akuntansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('3a50cf205b0e05705c244c342efc613c', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/536.26.17 (KHTML, like Gecko) Version/6.0.2 Safari/536.26.17', 1364385785, 'a:4:{s:9:"user_data";s:0:"";s:9:"logged_in";s:22:"aingLoginAkuntansiYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";}'),
('47f4cba2632bf12252734c67f3753e20', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/536.26.17 (KHTML, like Gecko) Version/6.0.2 Safari/536.26.17', 1364380668, 'a:4:{s:9:"user_data";s:0:"";s:9:"logged_in";s:22:"aingLoginAkuntansiYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";}'),
('7a1987b8ba549c64f8526e0088271199', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/536.26.17 (KHTML, like Gecko) Version/6.0.2 Safari/536.26.17', 1364386180, 'a:4:{s:9:"user_data";s:0:"";s:9:"logged_in";s:22:"aingLoginAkuntansiYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";}'),
('b4527f8153593d8ccd998d379e6abf17', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/536.26.17 (KHTML, like Gecko) Version/6.0.2 Safari/536.26.17', 1364386461, 'a:4:{s:9:"user_data";s:0:"";s:9:"logged_in";s:22:"aingLoginAkuntansiYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";}');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_penyesuaian`
--

CREATE TABLE `jurnal_penyesuaian` (
  `no_jurnal` varchar(20) NOT NULL,
  `tgl_jurnal` date NOT NULL,
  `no_rek` char(10) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`no_jurnal`,`no_rek`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_penyesuaian`
--

INSERT INTO `jurnal_penyesuaian` (`no_jurnal`, `tgl_jurnal`, `no_rek`, `debet`, `kredit`, `username`, `tgl_insert`) VALUES
('031300001', '2013-03-27', '172', 0, 300000, 'admin', '2013-03-27 06:03:51'),
('031300001', '2013-03-27', '521', 300000, 0, 'admin', '2013-03-27 06:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `no_jurnal` varchar(20) NOT NULL,
  `tgl_jurnal` date NOT NULL,
  `ket` varchar(255) NOT NULL,
  `no_bukti` varchar(100) NOT NULL,
  `no_rek` char(10) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`no_jurnal`,`no_rek`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`no_jurnal`, `tgl_jurnal`, `ket`, `no_bukti`, `no_rek`, `debet`, `kredit`, `username`, `tgl_insert`) VALUES
('031300001', '2013-03-26', 'Modal Awal', 'A', '111', 25000000, 0, 'admin', '2013-03-26 03:03:45'),
('031300001', '2013-03-26', 'Modal Awal', 'A', '311', 0, 25000000, 'admin', '2013-03-26 03:03:00'),
('031300002', '2013-03-26', 'Pembelian Gedung', 'B', '111', 0, 10000000, 'admin', '2013-03-26 03:03:37'),
('031300002', '2013-03-26', 'Pembelian Gedung', 'B', '171', 10000000, 0, 'admin', '2013-03-26 03:03:49'),
('031300003', '2013-03-26', 'Beli peralatan kantor', 'C', '111', 0, 7200000, 'admin', '2013-03-26 03:03:55'),
('031300003', '2013-03-26', 'Beli peralatan kantor', 'C', '181', 7200000, 0, 'admin', '2013-03-26 03:03:16'),
('031300004', '2013-03-26', 'Biaya Asuransi', 'C', '111', 0, 8400000, 'admin', '2013-03-26 03:03:10'),
('031300004', '2013-03-26', 'Biaya Asuransi', 'C', '542', 8400000, 0, 'admin', '2013-03-26 03:03:51'),
('031300005', '2013-03-27', 'f', 'F', '111', 2500, 0, 'admin', '2013-03-27 04:03:24'),
('031300005', '2013-03-27', 'f', 'F', '450', 0, 2500, 'admin', '2013-03-27 04:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `no_rek` char(10) NOT NULL DEFAULT '',
  `induk` char(10) NOT NULL DEFAULT '0',
  `level` smallint(6) DEFAULT '0',
  `nama_rek` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no_rek`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`no_rek`, `induk`, `level`, `nama_rek`) VALUES
('111', '0', 0, 'Kas'),
('112', '0', 0, 'Bank BNI'),
('121', '0', 0, 'Piutang Usaha'),
('131', '0', 0, 'Persediaan Barang Dagang'),
('141', '0', 0, 'Asuransi Dibayar Dimuka'),
('151', '0', 0, 'Perlengkapan'),
('161', '0', 0, 'Tanah'),
('171', '0', 0, 'Gedung'),
('172', '0', 0, 'Akumulasi Penyusutan Gedung'),
('181', '0', 0, 'Peralatan'),
('182', '0', 0, 'Akumulasi Penyusutan Peralatan'),
('211', '0', 0, 'Utang Usaha'),
('212', '0', 0, 'Utang Deviden'),
('213', '0', 0, 'Utang Pajak Penghasilan'),
('214', '0', 0, 'Utang Bunga'),
('215', '0', 0, 'Wesel Bayar'),
('311', '0', 0, 'Modal Uang'),
('312', '0', 0, 'Laba Ditahan'),
('410', '0', 0, 'Ikhtisar Rugi-laba'),
('411', '0', 0, 'Penjualan'),
('412', '0', 0, 'Retur Penjualan dan Pot Harga'),
('450', '0', 0, 'Pendapatan Sewa'),
('511', '0', 0, 'Pembelian'),
('512', '0', 0, 'Retur Pembelian dan Pot Harga'),
('513', '0', 0, 'Beban Angkut Pembelian'),
('520', '0', 0, 'Beban Administrasi dan Umum'),
('521', '0', 0, 'Beban Penyusutan Gedung'),
('522', '0', 0, 'Beban Penyusutan Peralatan'),
('530', '0', 0, 'Beban Penjualan'),
('531', '0', 0, 'Beban Pengiriman Barang'),
('540', '0', 0, 'Pajak Penghasilan'),
('541', '0', 0, 'Beban Perlengkapan'),
('542', '0', 0, 'Beban Asuransi'),
('550', '0', 0, 'Beban Bunga');

-- --------------------------------------------------------

--
-- Table structure for table `saldo_awal`
--

CREATE TABLE `saldo_awal` (
  `periode` year(4) NOT NULL,
  `no_rek` char(10) NOT NULL,
  `debet` int(11) NOT NULL DEFAULT '0',
  `kredit` int(11) NOT NULL DEFAULT '0',
  `tgl_insert` date NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`periode`,`no_rek`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo_awal`
--

INSERT INTO `saldo_awal` (`periode`, `no_rek`, `debet`, `kredit`, `tgl_insert`, `username`) VALUES
(2012, '111', 5140000, 0, '2013-03-26', 'admin'),
(2012, '121', 5880000, 0, '2013-03-26', 'admin'),
(2012, '131', 23780000, 0, '2013-03-26', 'admin'),
(2012, '141', 160000, 0, '2013-03-26', 'admin'),
(2012, '151', 440000, 0, '2013-03-26', 'admin'),
(2012, '161', 13000000, 0, '2013-03-26', 'admin'),
(2012, '171', 23020000, 0, '2013-03-26', 'admin'),
(2012, '172', 0, 2320000, '2013-03-26', 'admin'),
(2012, '181', 6000000, 0, '2013-03-26', 'admin'),
(2012, '182', 0, 2040000, '2013-03-26', 'admin'),
(2012, '211', 0, 18880000, '2013-03-26', 'admin'),
(2012, '212', 0, 300000, '2013-03-26', 'admin'),
(2012, '213', 0, 1000000, '2013-03-26', 'admin'),
(2012, '214', 0, 0, '2013-03-26', 'admin'),
(2012, '215', 0, 20000000, '2013-03-26', 'admin'),
(2012, '311', 0, 20000000, '2013-03-26', 'admin'),
(2012, '312', 0, 12880000, '2013-03-26', 'admin'),
(2012, '410', 0, 0, '2013-03-26', 'admin'),
(2012, '411', 0, 0, '2013-03-26', 'admin'),
(2012, '412', 0, 0, '2013-03-26', 'admin'),
(2012, '450', 0, 0, '2013-03-26', 'admin'),
(2012, '511', 0, 0, '2013-03-26', 'admin'),
(2012, '512', 0, 0, '2013-03-26', 'admin'),
(2012, '513', 0, 0, '2013-03-26', 'admin'),
(2012, '520', 0, 0, '2013-03-26', 'admin'),
(2012, '521', 0, 0, '2013-03-26', 'admin'),
(2012, '522', 0, 0, '2013-03-26', 'admin'),
(2012, '530', 0, 0, '2013-03-26', 'admin'),
(2012, '531', 0, 0, '2013-03-26', 'admin'),
(2012, '540', 0, 0, '2013-03-26', 'admin'),
(2012, '541', 0, 0, '2013-03-26', 'admin'),
(2012, '542', 0, 0, '2013-03-26', 'admin'),
(2012, '550', 0, 0, '2013-03-26', 'admin'),
(2012, 'undefined', 0, 0, '2013-03-26', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
