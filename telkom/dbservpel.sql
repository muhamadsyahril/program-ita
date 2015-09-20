-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 17. Januari 2015 jam 14:28
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbservpel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('39f2499959907b00c331bd7a66ece4cf', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0', 1421500554, 'a:4:{s:9:"user_data";s:0:"";s:9:"logged_in";s:16:"ancurYahLoginWae";s:8:"username";s:6:"merita";s:5:"level";s:1:"1";}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_area`
--

CREATE TABLE IF NOT EXISTS `tbl_area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `tbl_area`
--

INSERT INTO `tbl_area` (`id_area`, `area_name`, `kota`, `id_petugas`) VALUES
(1, 'gunung putri', 'bogor', 1),
(2, 'Depok', 'Depok', 1),
(3, 'All Area', 'ALL Area', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_keluhan`
--

CREATE TABLE IF NOT EXISTS `tbl_jenis_keluhan` (
  `id_jenis_kel` int(11) NOT NULL AUTO_INCREMENT,
  `detail` varchar(100) DEFAULT NULL,
  `id_produk` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_kel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data untuk tabel `tbl_jenis_keluhan`
--

INSERT INTO `tbl_jenis_keluhan` (`id_jenis_kel`, `detail`, `id_produk`) VALUES
(1, 'telepon mati/tidak ada nada', 3),
(2, 'Speedy tidak bisa browsing', 21),
(3, 'Speedy putus-putus', 21),
(4, 'Speedy lambat', 21),
(5, 'Suara Dengung', 3),
(6, 'Suara kemrosok', 3),
(7, 'Suara lemah atau putus-putus', 3),
(8, 'Tidak bisa SLI', 3),
(9, 'Tidak bisa SLJJ', 3),
(10, 'Tidak dapat dipanggil', 3),
(11, 'Cross talk/induksi', 3),
(12, 'Gangguan fitur', 3),
(13, 'Faksimili mati/rusak', 3),
(14, 'Gangguan PABX/hunting', 3),
(15, 'Gangguan JAPATI/IN/JASNITA', 3),
(16, 'Pesawat telepon rusak/mati', 3),
(17, 'Roset rusak', 3),
(18, 'Salah Sambung', 3),
(19, 'Tidak bisa memanggil', 3),
(20, 'eBS tidak sampai', 3),
(21, 'Terlambat buka isolir', 3),
(22, 'Tagihan melonjak', 3),
(23, 'Tidak bisa bayar tagihan jastel', 3),
(24, 'Tagihan tidak muncul', 3),
(25, 'Tagihan / gimmick tidak sesuai', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keluhan`
--

CREATE TABLE IF NOT EXISTS `tbl_keluhan` (
  `idkel` int(11) NOT NULL AUTO_INCREMENT,
  `notiket` varchar(100) DEFAULT NULL,
  `idpel` int(11) DEFAULT NULL,
  `jenis` varchar(100) NOT NULL,
  `keluhan` varchar(150) DEFAULT NULL,
  `solusi` varchar(150) DEFAULT NULL,
  `tgl_keluhan` datetime DEFAULT NULL,
  `tgl_realisasi` datetime DEFAULT NULL,
  `status` varchar(100) DEFAULT '0',
  PRIMARY KEY (`idkel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbl_keluhan`
--

INSERT INTO `tbl_keluhan` (`idkel`, `notiket`, `idpel`, `jenis`, `keluhan`, `solusi`, `tgl_keluhan`, `tgl_realisasi`, `status`) VALUES
(1, '10012015135459', 1, 'Speedy putus-putus', 'Dari hari ini speedy tidak lancar putus-putus kecepatan di bawah normal', NULL, '2015-01-10 19:54:59', NULL, 'Request');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_langganan`
--

CREATE TABLE IF NOT EXISTS `tbl_langganan` (
  `id_langganan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `nomer_langganan` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_langganan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `tbl_langganan`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `nama_pel` varchar(100) DEFAULT NULL,
  `alamat_pel` varchar(100) DEFAULT NULL,
  `telp_pel` varchar(50) DEFAULT NULL,
  `speedyno` varchar(50) DEFAULT NULL,
  `email_pel` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `id_produk`, `id_area`, `nama_pel`, `alamat_pel`, `telp_pel`, `speedyno`, `email_pel`, `tgl_lahir`, `create_date`, `update_date`) VALUES
(1, 3, 1, 'syahril', 'jl gunung putri', '02187965355', NULL, 'areil@gmail.com', '1979-08-24', '2013-11-03 20:26:55', '0000-00-00 00:00:00'),
(3, 21, 2, 'Merita', 'Jl Jatijajar', '0817423454566', NULL, 'merita@yahoo.com', '1986-11-06', '2013-11-03 20:35:17', '0000-00-00 00:00:00'),
(4, 21, 2, 'Joko Santoso', 'jl Jatijajar No.6 Depok', '02187744399', '122302203103', 'joko@yahoo.com', '1981-08-23', '2014-09-06 16:12:08', '0000-00-00 00:00:00'),
(5, 3, 2, 'johan', 'jln beji', '0218790989', '', 'johan@yahoo.com', '1981-08-21', '2015-01-17 20:15:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_petugas`
--

CREATE TABLE IF NOT EXISTS `tbl_petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `idarea` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `member` varchar(100) DEFAULT NULL,
  `no_telpon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`id_petugas`, `idarea`, `nama`, `member`, `no_telpon`) VALUES
(1, 2, 'hasan ibrahim', 'account', '081298767854'),
(2, 1, 'Joko Tarub', 'Teknisi', '082176809384'),
(3, 3, 'Mei', 'Asmen', '09879934334345'),
(4, 3, 'Jafar', 'laporan', '092423435435'),
(5, 3, 'merita', 'laporan', '76896789798');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE IF NOT EXISTS `tbl_produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `name_produk` varchar(100) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `name_produk`) VALUES
(3, 'pstn'),
(21, 'speedy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `nomerid_pel_pet` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` int(2) DEFAULT '2',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `nomerid_pel_pet`, `username`, `password`, `level`) VALUES
(1, NULL, 'admin', 'd334863dc7d5287f79a1cbb71d2afa94', 1),
(9, NULL, 'aministrator', '8544d934be304114baa4c82546fd4b5e', 1),
(12, 5, 'merita', 'd2357d68453e7e3c36868949d4b3f163', 1),
(13, 1, 'syahril', 'd2357d68453e7e3c36868949d4b3f163', 2),
(14, 2, 'joko', 'd2357d68453e7e3c36868949d4b3f163', 3),
(15, 5, 'johan', 'd2357d68453e7e3c36868949d4b3f163', 2),
(16, 1, 'ibrahim', 'd2357d68453e7e3c36868949d4b3f163', 3);
