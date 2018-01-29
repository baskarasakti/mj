-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2017 at 08:49 AM
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
-- Database: `easylink`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(100) NOT NULL,
  `pin_mahasiswa_absensi` int(100) NOT NULL,
  `id_mahasiswa_absensi` int(100) NOT NULL,
  `id_matkul_absensi` int(100) NOT NULL,
  `tanggal_absensi` datetime NOT NULL,
  `status_absensi` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `pin_mahasiswa_absensi`, `id_mahasiswa_absensi`, `id_matkul_absensi`, `tanggal_absensi`, `status_absensi`, `created_at`, `updated_at`) VALUES
(96, 153, 1, 1, '2017-11-02 13:54:50', 'T', '2017-11-27 07:35:22', '0000-00-00 00:00:00'),
(97, 152, 2, 1, '2017-11-02 12:07:15', 'H', '2017-11-27 07:35:22', '0000-00-00 00:00:00'),
(98, 155, 3, 1, '2017-11-02 14:32:13', 'A', '2017-11-27 07:35:22', '0000-00-00 00:00:00'),
(99, 153, 1, 1, '2017-11-09 12:09:00', 'H', '2017-11-27 07:36:16', '0000-00-00 00:00:00'),
(100, 152, 2, 1, '2017-11-09 12:13:10', 'H', '2017-11-27 07:36:16', '0000-00-00 00:00:00'),
(101, 155, 3, 1, '2017-11-09 14:32:13', 'A', '2017-11-27 07:36:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `absensidosen`
--

CREATE TABLE `absensidosen` (
  `id_absensidosen` int(100) NOT NULL,
  `pin_dosen_absensidosen` int(100) NOT NULL,
  `id_dosen_absensidosen` int(100) NOT NULL,
  `id_matkul_absensidosen` int(100) NOT NULL,
  `tanggal_absensidosen` datetime NOT NULL,
  `status_absensidosen` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensidosen`
--

INSERT INTO `absensidosen` (`id_absensidosen`, `pin_dosen_absensidosen`, `id_dosen_absensidosen`, `id_matkul_absensidosen`, `tanggal_absensidosen`, `status_absensidosen`, `created_at`, `updated_at`) VALUES
(27, 111, 1, 1, '2017-11-02 12:03:15', 'H', '2017-11-27 07:35:22', '0000-00-00 00:00:00'),
(28, 111, 1, 1, '2017-11-09 12:01:28', 'H', '2017-11-27 07:36:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(100) NOT NULL,
  `pin_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `nik_dosen` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `pin_dosen`, `nama_dosen`, `nik_dosen`, `created_at`, `updated_at`) VALUES
(1, 111, 'Bejo Sugianto', '1112313131313', '2017-11-21 13:33:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `junc_dosen_mk`
--

CREATE TABLE `junc_dosen_mk` (
  `id_jdm` int(11) NOT NULL,
  `id_dosen_jdm` int(100) NOT NULL,
  `id_matkul_jdm` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `junc_dosen_mk`
--

INSERT INTO `junc_dosen_mk` (`id_jdm`, `id_dosen_jdm`, `id_matkul_jdm`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-11-21 13:33:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `junc_mhs_mk`
--

CREATE TABLE `junc_mhs_mk` (
  `id_jmm` int(11) NOT NULL,
  `id_mahasiswa_jmm` int(100) NOT NULL,
  `id_matkul_jmm` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `junc_mhs_mk`
--

INSERT INTO `junc_mhs_mk` (`id_jmm`, `id_mahasiswa_jmm`, `id_matkul_jmm`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-11-21 13:38:57', '0000-00-00 00:00:00'),
(2, 2, 1, '2017-11-21 13:39:05', '0000-00-00 00:00:00'),
(3, 3, 1, '2017-11-27 04:07:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(100) NOT NULL,
  `pin_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nrp_mahasiswa` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `pin_mahasiswa`, `nama_mahasiswa`, `nrp_mahasiswa`, `created_at`, `updated_at`) VALUES
(1, 153, 'bejo', '5213100001', '2017-11-22 04:10:18', '0000-00-00 00:00:00'),
(2, 152, 'bedu', '5213100002', '2017-11-22 04:16:51', '0000-00-00 00:00:00'),
(3, 155, 'asdasd', '5213100155', '2017-11-27 03:43:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(11) NOT NULL,
  `kode_matkul` varchar(100) NOT NULL,
  `nama_matkul` varchar(100) NOT NULL,
  `sks_matkul` int(11) NOT NULL,
  `jml_matkul` int(11) NOT NULL,
  `jam_matkul` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `terlambat_matkul` int(11) NOT NULL,
  `selesai_matkul` time NOT NULL,
  `tanggalmulai_matkul` date NOT NULL,
  `hari_matkul` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `kode_matkul`, `nama_matkul`, `sks_matkul`, `jml_matkul`, `jam_matkul`, `created_at`, `updated_at`, `terlambat_matkul`, `selesai_matkul`, `tanggalmulai_matkul`, `hari_matkul`) VALUES
(1, '	KS14167', 'Bahasa Pemrograman', 3, 16, '12:00:00', '2017-11-27 06:55:35', '0000-00-00 00:00:00', 15, '14:30:00', '2017-11-02', 'Wed');

-- --------------------------------------------------------

--
-- Table structure for table `tb_device`
--

CREATE TABLE `tb_device` (
  `No` int(11) NOT NULL,
  `server_IP` text NOT NULL,
  `server_port` text NOT NULL,
  `device_sn` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_device`
--

INSERT INTO `tb_device` (`No`, `server_IP`, `server_port`, `device_sn`) VALUES
(29, '192.168.5.1', '8080', '61627017030230');

-- --------------------------------------------------------

--
-- Table structure for table `tb_scanlog`
--

CREATE TABLE `tb_scanlog` (
  `id` int(11) NOT NULL,
  `sn` text NOT NULL,
  `scan_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pin` text NOT NULL,
  `verifymode` int(11) NOT NULL,
  `iomode` int(11) NOT NULL,
  `workcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_scanlog`
--

INSERT INTO `tb_scanlog` (`id`, `sn`, `scan_date`, `pin`, `verifymode`, `iomode`, `workcode`) VALUES
(1, '61627017030230', '2017-11-02 06:54:50', '153', 1, 1, 0),
(2, '61627017030230', '2017-11-02 05:07:15', '152', 1, 1, 0),
(3, '61627017030230', '2017-11-09 05:09:00', '153', 1, 1, 0),
(4, '61627017030230', '2017-11-09 05:13:10', '152', 1, 1, 0),
(6, '61627017030230', '2017-11-02 05:03:15', '111', 1, 1, 0),
(7, '61627017030230', '2017-11-09 05:01:28', '111', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_template`
--

CREATE TABLE `tb_template` (
  `pin` text NOT NULL,
  `finger_idx` int(11) NOT NULL,
  `alg_ver` int(11) NOT NULL,
  `template` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_template`
--

INSERT INTO `tb_template` (`pin`, `finger_idx`, `alg_ver`, `template`) VALUES
('1', 0, 19, '04:13:0F:00:95:E2:87:14:83:07:00:00:49:7B:88:20:03:06:00:00:51:63:87:21:45:07:00:00:BD:BB:86:29:46:07:00:00:59:6A:89:17:83:07:00:00:0D:5C:89:2C:82:06:00:00:51:3C:88:2E:03:07:00:00:A9:DC:88:A8:03:06:00:00:6D:3A:87:83:03:C8:0C:00:F1:D2:85:06:08:76:0C:00:E6:9C:87:43:89:D8:0C:00:1A:3D:86:B7:05:D6:0C:00:1D:75:86:42:04:D5:0C:00:9A:2D:8A:9C:92:D8:0C:00:DE:D3:89:9D:04:C6:0C:00:9A:9D:8A:96:92:6A:FA:8F:A9:45:89:9C:09:A7:FF:0F:DA:4D:8A:96:09:08:00:10:E1:C5:8A:0B:09:1A:00:10:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:57:32:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:E0:32:'),
('1', 1, 19, '04:20:10:00:71:92:E8:81:02:C6:0E:00:E5:12:E8:09:03:26:60:EC:31:6B:E9:83:C2:35:60:02:79:C3:A6:6D:47:26:5C:03:8D:1B:EA:16:85:76:64:C2:BD:7B:85:5F:86:06:00:00:C6:5B:E8:7D:05:57:68:47:0D:DC:E6:67:C7:57:70:85:31:CC:E8:82:88:79:7C:05:29:54:E9:1B:87:89:98:C7:3D:44:85:51:0A:07:00:00:65:4C:E7:5A:8C:79:98:88:8D:04:B6:4D:88:C7:98:87:AD:74:E7:48:12:89:78:8C:BE:4C:99:95:CD:2B:91:88:C5:2C:E6:45:88:D6:BC:12:CD:B4:A9:35:CA:8A:68:CD:51:15:E7:36:46:A9:AC:88:21:1C:85:D6:0C:08:00:00:05:05:EB:3C:45:68:94:CA:0D:C2:B8:83:C2:56:84:46:B5:B5:85:B4:85:06:00:00:CA:25:B7:2B:46:57:80:86:35:0A:B7:7C:84:28:6C:45:31:1A:B8:09:01:46:88:C2:29:83:84:E4:02:77:0C:00:6E:63:84:65:09:98:0C:00:A5:DB:84:E1:87:B7:0C:00:35:44:84:4F:87:58:0C:00:5E:8C:84:CC:02:27:FF:9F:D2:4C:AB:38:C9:69:74:05:99:95:7B:44:84:18:60:84:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:64:6D:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:35:6E:'),
('2', 0, 19, '04:1C:10:00:4D:EA:89:05:44:07:00:00:6D:EA:88:04:45:06:00:00:AD:C2:89:7F:C2:06:00:00:BD:F2:B7:EB:C4:07:14:00:25:6B:B8:04:86:46:7C:40:AD:1B:B8:6F:07:67:68:C4:BD:73:89:7C:C6:06:00:00:C1:83:B7:E8:C5:77:70:86:CD:0B:89:07:46:06:00:00:E6:13:B8:01:08:57:7C:07:F5:D3:89:14:85:07:00:00:11:C4:8A:1D:C4:06:00:00:21:74:8A:8B:C4:06:00:00:4E:BC:B5:D4:46:89:70:C5:46:14:8A:19:43:08:00:00:59:5B:8A:12:C3:06:00:00:C5:03:B5:55:45:67:94:08:21:A2:B7:E6:04:58:74:46:3D:FA:88:77:83:07:00:00:B6:0A:8B:83:42:09:00:00:B9:6C:85:3E:C8:09:00:00:A9:94:8A:27:08:07:00:00:69:F4:84:C9:07:87:EF:8F:55:BD:8A:33:04:19:00:10:AD:E5:89:3E:03:18:00:10:CA:5D:8A:3B:03:17:00:10:41:CC:42:CD:08:3A:08:00:95:8C:44:4F:83:77:08:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:C2:4E:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:00:D2:4F:');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `pin` text NOT NULL,
  `nama` text NOT NULL,
  `pwd` text NOT NULL,
  `rfid` text NOT NULL,
  `privilege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`pin`, `nama`, `pwd`, `rfid`, `privilege`) VALUES
('1', 'Gita', '1', '', 0),
('2', 'Ilham', '2', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `absensidosen`
--
ALTER TABLE `absensidosen`
  ADD PRIMARY KEY (`id_absensidosen`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `junc_dosen_mk`
--
ALTER TABLE `junc_dosen_mk`
  ADD PRIMARY KEY (`id_jdm`);

--
-- Indexes for table `junc_mhs_mk`
--
ALTER TABLE `junc_mhs_mk`
  ADD PRIMARY KEY (`id_jmm`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `tb_device`
--
ALTER TABLE `tb_device`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `tb_scanlog`
--
ALTER TABLE `tb_scanlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `absensidosen`
--
ALTER TABLE `absensidosen`
  MODIFY `id_absensidosen` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `junc_dosen_mk`
--
ALTER TABLE `junc_dosen_mk`
  MODIFY `id_jdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `junc_mhs_mk`
--
ALTER TABLE `junc_mhs_mk`
  MODIFY `id_jmm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_device`
--
ALTER TABLE `tb_device`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tb_scanlog`
--
ALTER TABLE `tb_scanlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
