-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2021 at 03:06 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jumlah1` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `tglbeli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `nama_barang`, `satuan`, `harga_beli`, `jumlah1`, `stok`, `harga_jual`, `profit`, `supplier`, `tglbeli`) VALUES
('AYAM-001', 'Dada ', 'Pcs', 10000, 100, 57, 12000, 2000, 'Jehan Dwi Fahrian ', '2019-08-01'),
('AYAM-002', 'Paha', 'Pcs', 9000, 99, 59, 11000, 2000, 'Jehan Dwi Fahrian ', '2019-08-02'),
('AYAM-003', 'Sayap', 'Pcs', 8000, 100, 59, 10000, 2000, 'Fahrian', '2019-08-03'),
('AYAM-004', 'Kepala Ayam', 'Pcs', 9000, 20, 10, 12000, 3000, 'Harmaji', '2019-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jumlah`
--

CREATE TABLE `tb_jumlah` (
  `jml` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `kode_pelanggan` int(11) NOT NULL,
  `namas` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`kode_pelanggan`, `namas`, `alamat`, `telpon`, `email`) VALUES
(11, 'Jehan Dwi Fahrian ', 'Bojong utama raya blok c 25 no 9', '082125614827', 'jehandwi@gmail.com'),
(12, 'Harmaji', 'Taman Narogong Indah Jembatan 1', '081519192325', 'Harsa33@gmail.com'),
(13, 'Saputra', 'Jembatan 1 Narogong', '0822', 'Harsa33@gmail.com'),
(14, 'Dwi', 'Narogong', '021', 'jehandwi@gmail.com'),
(15, 'Fahrian', 'Narogong', '0825', 'jehandwi@gmail.com'),
(16, 'Putra', 'Narogong', '111', 'jehandwi@gmail.com'),
(17, 'Willy', 'Rawalumbu', '00', 'ardowilly12@gmail.com'),
(18, 'Ardo', 'Rawalumbu', '123123', 'ardowilly12@gmail.com'),
(19, 'Octo', 'Rawalumbu', '14045', 'ardowilly12@gmail.com'),
(20, 'Son Goku', 'Namek', '14022', 'Kamehame@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `username`, `nama`, `password`, `level`, `foto`) VALUES
(4, 'aji', 'Aji', 'admin', 'Admin', 'disain miniatur kakbah.jpg'),
(7, 'samsul', 'Samsul', 'ez', 'Kasir', 'IMG_555731.jpg'),
(8, 'jehan', 'Jehan', 'gg', 'Admin', 'Picture 001.jpg'),
(10, 'kasir', 'dadan', 'gunadarma', 'Kasir', 'tambahan 1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(25) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id`, `kode_penjualan`, `kode_barang`, `jumlah`, `total`, `tgl_penjualan`, `waktu`) VALUES
(109, 'PJ-0001 ', 'AYAM-001', 1, 12000, '2019-12-25', '01:03:19'),
(110, 'PJ-0000 ', 'AYAM-002', 1, 11000, '2019-12-25', '01:04:20'),
(111, 'PJ-0002 ', 'AYAM-003', 1, 10000, '2019-12-25', '01:07:35'),
(112, 'PJ-0003 ', 'AYAM-003', 1, 10000, '2019-12-25', '01:22:03'),
(113, 'PJ-0004 ', 'AYAM-002', 1, 11000, '2019-12-25', '09:53:03'),
(114, 'PJ-0004 ', 'AYAM-001', 1, 12000, '2019-12-25', '09:53:06'),
(115, 'PJ-0005 ', 'AYAM-003', 1, 10000, '2019-12-27', '06:49:13'),
(116, 'PJ-0005 ', 'AYAM-002', 1, 11000, '2019-12-27', '06:49:16'),
(117, 'PJ-0005 ', 'AYAM-001', 1, 12000, '2019-12-27', '06:49:19'),
(118, 'PJ-0006 ', 'AYAM-004', 1, 12000, '2019-12-27', '06:52:44'),
(119, 'PJ-0007 ', 'AYAM-004', 1, 12000, '2019-12-27', '06:57:05'),
(120, 'PJ-0008 ', 'AYAM-004', 1, 12000, '2019-12-27', '06:57:39'),
(121, 'PJ-0009 ', 'AYAM-001', 1, 12000, '2019-12-27', '06:57:59'),
(122, 'PJ-0010 ', 'AYAM-002', 1, 11000, '2019-12-27', '06:59:03'),
(123, 'PJ-0011 ', 'AYAM-003', 1, 10000, '2019-12-27', '10:06:15'),
(124, 'PJ-0012 ', 'AYAM-001', 1, 12000, '2020-04-03', '22:06:21'),
(125, 'PJ-0013 ', 'AYAM-001', 1, 12000, '2021-03-07', '20:54:40');

--
-- Triggers `tb_penjualan`
--
DELIMITER $$
CREATE TRIGGER `jual` AFTER INSERT ON `tb_penjualan` FOR EACH ROW BEGIN
UPDATE tb_barang
SET stok = stok - NEW.jumlah 
WHERE kode_barang  = NEW.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan_detail`
--

CREATE TABLE `tb_penjualan_detail` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(25) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `potongan` int(11) NOT NULL,
  `total_b` int(11) NOT NULL,
  `tgl_detail` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan_detail`
--

INSERT INTO `tb_penjualan_detail` (`id`, `kode_penjualan`, `bayar`, `kembali`, `diskon`, `potongan`, `total_b`, `tgl_detail`) VALUES
(95, 'PJ-0001', 15000, 3000, 0, 0, 0, '2019-12-25'),
(97, 'PJ-0002', 12000, 2000, 0, 0, 0, '2019-12-25'),
(98, 'PJ-0003', 12000, 2000, 0, 0, 0, '2019-12-25'),
(99, 'PJ-0004', 25000, 2000, 0, 0, 0, '2019-12-25'),
(100, 'PJ-0005', 35000, 2000, 0, 0, 0, '2019-12-27'),
(101, 'PJ-0006', 15000, 3000, 0, 0, 0, '2019-12-27'),
(102, 'PJ-0007', 15000, 3000, 0, 0, 0, '2019-12-27'),
(103, 'PJ-0008', 15000, 3000, 0, 0, 0, '2019-12-27'),
(104, 'PJ-0009', 20000, 8000, 0, 0, 0, '2019-12-27'),
(105, 'PJ-0010', 12000, 1000, 0, 0, 0, '2019-12-27'),
(106, 'PJ-0011', 15000, 5000, 0, 0, 0, '2019-12-27'),
(107, 'PJ-0012', 15000, 3000, 0, 0, 0, '2020-04-03'),
(108, 'PJ-0013', 15000, 3000, 0, 0, 0, '2021-03-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `kode_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
