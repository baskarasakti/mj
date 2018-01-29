-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2017 at 04:38 PM
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
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `kategori_item` int(100) NOT NULL,
  `uom_item` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `kategori_item`, `uom_item`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2017-12-26 17:17:17', '0000-00-00 00:00:00'),
(2, 2, 1, '2017-12-26 17:17:20', '0000-00-00 00:00:00');

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
