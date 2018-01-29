-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2018 at 05:07 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `megahjaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `bom`
--

CREATE TABLE `bom` (
  `id_bom` int(11) NOT NULL,
  `id_produk_bom` int(11) NOT NULL,
  `id_item_bom` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bom`
--

INSERT INTO `bom` (`id_bom`, `id_produk_bom`, `id_item_bom`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2018-01-22 03:28:04', '0000-00-00 00:00:00'),
(3, 1, 1, '2018-01-22 03:30:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `btkl`
--

CREATE TABLE `btkl` (
  `id_btkl` int(11) NOT NULL,
  `id_produk_btkl` int(11) NOT NULL,
  `id_proses_btkl` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `btkl`
--

INSERT INTO `btkl` (`id_btkl`, `id_produk_btkl`, `id_proses_btkl`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-01-22 03:53:49', '0000-00-00 00:00:00'),
(2, 1, 2, '2018-01-22 03:54:16', '0000-00-00 00:00:00'),
(3, 1, 5, '2018-01-22 03:54:28', '0000-00-00 00:00:00'),
(4, 1, 3, '2018-01-22 03:54:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `kategori_item` int(100) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `uom_item` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `kategori_item`, `kode_item`, `uom_item`, `created_at`, `updated_at`) VALUES
(1, 1, '35GSM', 2, '2018-01-21 12:17:53', '0000-00-00 00:00:00'),
(2, 2, 'PB953', 1, '2018-01-21 12:17:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_kertas`
--

CREATE TABLE `item_kertas` (
  `id_item_kertas` int(11) NOT NULL,
  `id_item_k` int(11) NOT NULL,
  `nama_kertas` varchar(100) NOT NULL,
  `qty_kertas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_kertas`
--

INSERT INTO `item_kertas` (`id_item_kertas`, `id_item_k`, `nama_kertas`, `qty_kertas`, `created_at`, `updated_at`) VALUES
(1, 1, 'kertas 35 gsm', 24000, '2017-12-26 16:36:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_silinder`
--

CREATE TABLE `item_silinder` (
  `id_item_silinder` int(11) NOT NULL,
  `id_item_s` int(11) NOT NULL,
  `nama_silinder` varchar(100) NOT NULL,
  `qty_silinder` int(11) NOT NULL,
  `kapasistas_silinder` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_tinta`
--

CREATE TABLE `item_tinta` (
  `id_item_tinta` int(11) NOT NULL,
  `id_item_t` int(11) NOT NULL,
  `nama_tinta` varchar(100) NOT NULL,
  `qty_tinta` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_tinta`
--

INSERT INTO `item_tinta` (`id_item_tinta`, `id_item_t`, `nama_tinta`, `qty_tinta`, `created_at`, `updated_at`) VALUES
(1, 2, 'PB953', 45, '2017-12-26 17:12:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_item`
--

CREATE TABLE `kategori_item` (
  `id_kategori_item` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_item`
--

INSERT INTO `kategori_item` (`id_kategori_item`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'kertas', '2017-12-26 16:15:07', '0000-00-00 00:00:00'),
(2, 'tinta', '2017-12-26 16:15:07', '0000-00-00 00:00:00'),
(3, 'silinder', '2017-12-26 16:15:46', '0000-00-00 00:00:00'),
(4, 'lain-lain', '2017-12-26 16:15:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty_produk` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `qty_produk`, `created_at`, `updated_at`) VALUES
(1, 'RED 124 AC', 'Red Mild', 0, '2018-01-22 02:55:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(11) NOT NULL,
  `kode_produksi` varchar(100) NOT NULL,
  `nama_produksi` varchar(100) NOT NULL,
  `proses_produksi` varchar(100) NOT NULL,
  `tanggal_produksi` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `kode_produksi`, `nama_produksi`, `proses_produksi`, `tanggal_produksi`, `created_at`, `updated_at`) VALUES
(2, 'RED 124 AC', 'Red Mild', 'Laminasi', '0000-00-00 00:00:00', '2018-01-22 04:22:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `proses`
--

CREATE TABLE `proses` (
  `id_proses` int(11) NOT NULL,
  `nama_proses` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`id_proses`, `nama_proses`, `created_at`, `updated_at`) VALUES
(1, 'Printing', '2018-01-21 11:21:14', '0000-00-00 00:00:00'),
(2, 'Sliter', '2018-01-21 11:21:14', '0000-00-00 00:00:00'),
(3, 'Perforasi', '2018-01-21 11:21:30', '0000-00-00 00:00:00'),
(4, 'Laminasi', '2018-01-21 11:21:30', '0000-00-00 00:00:00'),
(5, 'Rewind', '2018-01-21 11:21:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id_purchase` int(11) NOT NULL,
  `no_purchase` varchar(100) NOT NULL,
  `tanggal_purchase` date NOT NULL,
  `ket_purchase` varchar(100) NOT NULL,
  `vendor_pi` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id_purchase`, `no_purchase`, `tanggal_purchase`, `ket_purchase`, `vendor_pi`, `created_at`, `updated_at`) VALUES
(1, 'PO01', '0000-00-00', 'asdasd', 0, '2018-01-29 03:47:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `id_purchase_item` int(11) NOT NULL,
  `id_purchase_pi` int(11) NOT NULL,
  `id_item_pi` int(11) NOT NULL,
  `qty_pi` int(11) NOT NULL,
  `harga_pi` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `id_uom` int(11) NOT NULL,
  `nama_uom` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`id_uom`, `nama_uom`, `created_at`, `updated_at`) VALUES
(1, 'kg', '2017-12-26 17:16:37', '0000-00-00 00:00:00'),
(2, 'm', '2017-12-26 17:16:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username_user` varchar(100) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email_user` varchar(30) NOT NULL,
  `password_user` varchar(100) NOT NULL,
  `role_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username_user`, `nama_user`, `email_user`, `password_user`, `role_user`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin Megahjaya', 'megahjaya@gmail.com', '$2y$10$vjD.8/pXbqDJTGBs6/ycqOjA8UteJCRfZ7roBrv51IhD1XXfyHWhe', 1, '2017-12-26 16:28:05', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`id_bom`);

--
-- Indexes for table `btkl`
--
ALTER TABLE `btkl`
  ADD PRIMARY KEY (`id_btkl`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `item_kertas`
--
ALTER TABLE `item_kertas`
  ADD PRIMARY KEY (`id_item_kertas`);

--
-- Indexes for table `item_silinder`
--
ALTER TABLE `item_silinder`
  ADD PRIMARY KEY (`id_item_silinder`);

--
-- Indexes for table `item_tinta`
--
ALTER TABLE `item_tinta`
  ADD PRIMARY KEY (`id_item_tinta`);

--
-- Indexes for table `kategori_item`
--
ALTER TABLE `kategori_item`
  ADD PRIMARY KEY (`id_kategori_item`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`id_proses`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id_purchase`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`id_purchase_item`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`id_uom`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bom`
--
ALTER TABLE `bom`
  MODIFY `id_bom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `btkl`
--
ALTER TABLE `btkl`
  MODIFY `id_btkl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `item_kertas`
--
ALTER TABLE `item_kertas`
  MODIFY `id_item_kertas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `item_silinder`
--
ALTER TABLE `item_silinder`
  MODIFY `id_item_silinder` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_tinta`
--
ALTER TABLE `item_tinta`
  MODIFY `id_item_tinta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kategori_item`
--
ALTER TABLE `kategori_item`
  MODIFY `id_kategori_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id_purchase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `id_purchase_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `id_uom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
