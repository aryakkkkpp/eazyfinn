-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2021 at 07:43 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_manajemen_kas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `tipe` enum('Pemasukan','Pengeluaran') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`, `tipe`) VALUES
(1, 'Jasa Web Development', 'Pemasukan'),
(2, 'Jasa Web Desain', 'Pemasukan'),
(3, 'Jasa Digital Marketing', 'Pemasukan'),
(4, 'Jasa Kursus dan Pelatihan', 'Pemasukan'),
(5, 'Penjualan E-Book', 'Pemasukan'),
(6, 'Penjualan Video Tutorial', 'Pemasukan'),
(7, 'Penjualan Sourcecode', 'Pemasukan'),
(8, 'Pemasukan Lainnya', 'Pemasukan'),
(9, 'Biaya Rutin Bulanan', 'Pengeluaran'),
(10, 'Biaya Rutin Tahunan', 'Pengeluaran'),
(11, 'Transportasi', 'Pengeluaran'),
(12, 'Komunikasi', 'Pengeluaran'),
(13, 'Tagihan', 'Pengeluaran'),
(14, 'Gaji Karyawan', 'Pengeluaran'),
(15, 'Biaya Tidak Terduga', 'Pengeluaran'),
(16, 'Pengeluaran Lainnya', 'Pengeluaran');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `kategori` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `pemasukan` int(11) DEFAULT NULL,
  `pengeluaran` int(11) DEFAULT NULL,
  `bukti_transaksi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `tanggal`, `kategori`, `deskripsi`, `pemasukan`, `pengeluaran`, `bukti_transaksi`) VALUES
(1, '2021-06-01', 14, 'Gaji karyawan bulan Juni 2021', NULL, 12000000, '960a6462e0188797c0c19bf12304c14f63044833.jpg'),
(2, '2021-06-02', 13, 'Listrik', NULL, 1000000, 'ffd8cb196c208d5a93b6c5a4abf799266a70a8a1.jpg'),
(3, '2021-06-02', 13, 'Internet', NULL, 1500000, 'f149b4f6bedc7e676de075358c196bfc980e63ab.jpg'),
(4, '2021-06-03', 2, 'Pembuatan desain web company profile PT. ABeCe', 5000000, NULL, 'c0fbbb95bdc777b36a98a5136b6b2821c0147c71.jpg'),
(5, '2021-06-03', 1, 'Pembuatan web company profile PT. ABeCe', 10000000, NULL, '0af5af3cdb73e5baa18cfecb0ac9815b22d5a9cb.jpg'),
(6, '2021-06-03', 9, 'Iuran Keamanan', NULL, 50000, NULL),
(7, '2021-06-03', 9, 'Iuran Sampah', NULL, 20000, NULL),
(8, '2021-06-05', 5, 'Penjualan e-book Membuat Aplikasi Manajemen Kas Berbasis Web', 150000, NULL, '2b83686ced15a69ada90cb44b53116dac4cec97c.jpg'),
(9, '2021-06-05', 7, 'Penjualan sourcecode Aplikasi Persediaan Barang Gudang Material', 500000, NULL, '71e01768655ff398dd5762c8633f8c6e8d893fa5.jpg'),
(10, '2021-06-06', 5, 'Penjualan e-book Membuat Aplikasi Pengelolaan Arsip Surat', 150000, NULL, 'ab053f4d4f2c57ea5bda54e23c7122f1d96142e9.jpg'),
(11, '2021-06-07', 5, 'Penjualan e-book Membuat Aplikasi Manajemen Kas Berbasis Web', 150000, NULL, 'b30f11de1ee806288090e9f5229d5d34b719cd40.jpg'),
(12, '2021-06-08', 7, 'Penjualan sourcecode Aplikasi Manajemen Kas Berbasis Web', 330000, NULL, '21f28e3a655c9b3bd6054293d572ca9fc0e34721.jpg'),
(13, '2021-06-09', 6, 'Penjualan video tutorial Membuat Aplikasi Pencatatan Keuangan Pribadi dengan Codeigniter', 370000, NULL, '2770db0dbdaa648dd06b3153ac22f199855c6d40.jpg'),
(14, '2021-06-10', 6, 'Penjualan video tutorial Membuat Aplikasi Pencatatan Keuangan Pribadi dengan Codeigniter', 370000, NULL, 'ba8c5e5afc45486d77aff7d5385fc4558a2ddbea.jpg'),
(15, '2021-06-10', 7, 'Penjualan sourcecode Aplikasi Kasir Penjualan Pulsa', 330000, NULL, '4075a58f8bc08f6ef9a70b1f82456a344e50e281.jpg'),
(16, '2021-06-10', 5, 'Penjualan e-book Membuat Aplikasi Pengelolaan Arsip Surat', 150000, NULL, '93e0f29946f67b00415ab4ac1f6210914c56c2a6.jpg'),
(17, '2021-06-13', 1, 'Pembuatan Aplikasi Antrian Pengunjung', 8000000, NULL, '06c75d99f76a7cb54dba6dde7e60f340930abc55.jpg'),
(18, '2021-06-15', 1, 'Pembuatan Aplikasi Survey Kepuasan Masyarakat', 5000000, NULL, '778209d35bf0dd951ff1be5388a640fa06fa7968.jpg'),
(19, '2021-06-15', 7, 'Penjualan sourcecode Aplikasi Persediaan Barang Gudang Material', 500000, NULL, 'fc1449d5c4763af6ec8df566a945e522804ff79e.jpg'),
(20, '2021-06-17', 5, 'Penjualan e-book Membuat Aplikasi Manajemen Kas Berbasis Web', 150000, NULL, 'eec693d3bafd6e71f533cd83a75ed2f5ccc9c236.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `hak_akses`) VALUES
(1, 'Indra Styawantoro', 'admin', '$2y$12$c/Fsu8Zq0rQKdmWm83xzWeREwDRrPppmvG56qhkLpcl6mrzwf..Te', 'Admin'),
(2, 'Danang Kesuma', 'user', '$2y$12$lvF/n8t20geLr2oZxkfZ9.7.ubY2h/RuYAcid0zufB6INcIt/eRy2', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
