-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 05:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `kode_dept` varchar(3) NOT NULL,
  `nama_dept` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`kode_dept`, `nama_dept`) VALUES
('GD', 'Gudang'),
('UTM', 'Utama');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `kode_jenis_transaksi` varchar(3) NOT NULL,
  `nama_jenis_transaksi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`kode_jenis_transaksi`, `nama_jenis_transaksi`) VALUES
('JL', 'Penjualan'),
('KSR', 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kode_pelanggan` varchar(4) NOT NULL,
  `nama_pelanggan` varchar(20) NOT NULL,
  `potongan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`kode_pelanggan`, `nama_pelanggan`, `potongan`) VALUES
('0388', 'Rani Putri', 0),
('0457', 'Arifaa', 0),
('0782', 'Ratna', 0),
('0933', 'Budiman', 0),
('UMUM', 'Umum', 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_pembayaran`
--

CREATE TABLE `status_pembayaran` (
  `status_bayar` char(1) NOT NULL,
  `nama_pembayaran` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_pembayaran`
--

INSERT INTO `status_pembayaran` (`status_bayar`, `nama_pembayaran`) VALUES
('K', 'Kredit'),
('T', 'Tunai');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `no_transaksi_jual` varchar(5) NOT NULL,
  `kode_jenis_transaksi` varchar(3) NOT NULL,
  `kode_dept` varchar(3) NOT NULL,
  `kode_pelanggan` varchar(4) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jumlah_item` int(3) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `potongan` float NOT NULL,
  `pajak` float NOT NULL,
  `biaya_lain` int(10) NOT NULL,
  `status_bayar` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`no_transaksi_jual`, `kode_jenis_transaksi`, `kode_dept`, `kode_pelanggan`, `tanggal_transaksi`, `jumlah_item`, `subtotal`, `potongan`, `pajak`, `biaya_lain`, `status_bayar`) VALUES
('63481', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 24000, 0, 0, 0, 'T'),
('63482', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 25400, 0, 0, 0, 'T'),
('63483', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 26000, 0, 0, 0, 'T'),
('63484', 'KSR', 'UTM', 'UMUM', '2021-02-01', 2, 32500, 0, 0, 0, 'T'),
('63485', 'KSR', 'UTM', 'UMUM', '2021-02-01', 2, 17500, 0, 0, 0, 'T'),
('63486', 'KSR', 'UTM', 'UMUM', '2021-02-01', 24, 24000, 0, 0, 0, 'T'),
('63487', 'KSR', 'UTM', '0457', '2021-02-01', 12, 62500, 0, 0, 0, 'T'),
('63488', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 20000, 0, 0, 0, 'T'),
('63489', 'KSR', 'UTM', '0933', '2021-02-01', 4, 45400, 0, 0, 0, 'T'),
('63490', 'KSR', 'UTM', 'UMUM', '2021-02-01', 6, 48500, 0, 0, 0, 'T'),
('63491', 'KSR', 'UTM', 'UMUM', '2021-02-01', 3, 66500, 0, 0, 0, 'T'),
('63493', 'KSR', 'UTM', 'UMUM', '2021-02-01', 7, 50000, 0, 0, 0, 'T'),
('63495', 'KSR', 'UTM', '0388', '2021-02-01', 6, 51100, 0, 0, 0, 'T'),
('63496', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 2700, 0, 0, 0, 'T'),
('63497', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 5200, 0, 0, 0, 'T'),
('63498', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 25400, 0, 0, 0, 'T'),
('63499', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 24000, 0, 0, 0, 'T'),
('63500', 'KSR', 'UTM', 'UMUM', '2021-02-01', 2, 50000, 0, 0, 0, 'T'),
('63501', 'KSR', 'UTM', '0782', '2021-02-01', 1, 54400, 0, 0, 0, 'T'),
('63502', 'KSR', 'UTM', 'UMUM', '2021-02-01', 10, 73000, 0, 0, 0, 'T'),
('63503', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 4000, 0, 0, 0, 'T'),
('63504', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 1900, 0, 0, 0, 'T'),
('63505', 'KSR', 'UTM', 'UMUM', '2021-02-01', 2, 66500, 0, 0, 0, 'T'),
('63506', 'KSR', 'UTM', 'UMUM', '2021-02-01', 1, 24000, 0, 0, 0, 'T');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`kode_dept`);

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`kode_jenis_transaksi`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  ADD PRIMARY KEY (`status_bayar`);

--
-- Indexes for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`no_transaksi_jual`),
  ADD KEY `transaksi_penjualan_ibfk_1` (`kode_jenis_transaksi`),
  ADD KEY `transaksi_penjualan_ibfk_2` (`kode_dept`),
  ADD KEY `transaksi_penjualan_ibfk_3` (`kode_pelanggan`),
  ADD KEY `transaksi_penjualan_ibfk_4` (`status_bayar`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD CONSTRAINT `transaksi_penjualan_ibfk_1` FOREIGN KEY (`kode_jenis_transaksi`) REFERENCES `jenis_transaksi` (`kode_jenis_transaksi`) ON DELETE NO ACTION,
  ADD CONSTRAINT `transaksi_penjualan_ibfk_2` FOREIGN KEY (`kode_dept`) REFERENCES `departemen` (`kode_dept`) ON DELETE NO ACTION,
  ADD CONSTRAINT `transaksi_penjualan_ibfk_3` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode_pelanggan`) ON DELETE NO ACTION,
  ADD CONSTRAINT `transaksi_penjualan_ibfk_4` FOREIGN KEY (`status_bayar`) REFERENCES `status_pembayaran` (`status_bayar`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
