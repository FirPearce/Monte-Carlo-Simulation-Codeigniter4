-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2022 at 04:49 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utspemsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `total_permintaan` int(11) NOT NULL,
  `rata_permintaan` float NOT NULL,
  `rata_pemasukan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_hasil`
--

INSERT INTO `tbl_hasil` (`id_hasil`, `id_penjual`, `total_permintaan`, `rata_permintaan`, `rata_pemasukan`, `created_at`, `updated_at`) VALUES
(1, 5, 294, 14.7, 735000, '2022-04-13 17:53:35', '2022-04-13 18:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjual`
--

CREATE TABLE `tbl_penjual` (
  `id_penjual` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `penaksiran` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penjual`
--

INSERT INTO `tbl_penjual` (`id_penjual`, `id_user`, `nama`, `penaksiran`, `harga`, `created_at`, `updated_at`) VALUES
(1, 5, 'firlytaufik', 0, NULL, '2022-04-09 03:49:31', NULL),
(2, 6, 'contoh2', 0, NULL, '2022-04-09 03:51:00', NULL),
(3, 7, 'cona', 0, NULL, '2022-04-09 03:54:35', NULL),
(4, 8, 'mencoba', 0, NULL, '2022-04-09 03:57:11', NULL),
(5, 9, 'windah', 20, 50000, '2022-04-09 04:00:40', '2022-04-13 17:37:13'),
(6, 10, 'firlytaufikurohman', 0, NULL, '2022-04-13 20:56:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permintaan`
--

CREATE TABLE `tbl_permintaan` (
  `id_permintaan` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `frekuensi` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_permintaan`
--

INSERT INTO `tbl_permintaan` (`id_permintaan`, `id_penjual`, `bulan`, `frekuensi`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 5, '2022-04-12 22:04:50', NULL),
(2, 5, 2, 3, '2022-04-12 22:25:57', NULL),
(3, 5, 3, 6, '2022-04-12 22:28:59', NULL),
(4, 5, 4, 5, '2022-04-12 22:29:15', NULL),
(5, 5, 5, 4, '2022-04-12 23:25:02', NULL),
(6, 5, 6, 7, '2022-04-13 13:01:48', NULL),
(7, 5, 7, 6, '2022-04-13 13:02:04', NULL),
(8, 5, 8, 5, '2022-04-13 13:02:08', NULL),
(9, 5, 9, 9, '2022-04-13 13:02:11', NULL),
(10, 5, 10, 10, '2022-04-13 13:02:36', NULL),
(11, 5, 11, 3, '2022-04-13 13:02:41', NULL),
(12, 5, 12, 4, '2022-04-13 13:02:47', NULL),
(13, 5, 13, 29, '2022-04-13 17:37:54', NULL),
(14, 5, 14, 5, '2022-04-13 20:10:02', NULL),
(15, 5, 14, 10, '2022-04-13 20:10:02', NULL),
(16, 5, 14, 2, '2022-04-13 20:10:02', NULL),
(17, 5, 14, 12, '2022-04-13 20:10:02', NULL),
(18, 5, 14, 6, '2022-04-13 20:10:02', NULL),
(19, 5, 19, 5, '2022-04-13 20:10:42', NULL),
(20, 5, 19, 10, '2022-04-13 20:10:42', NULL),
(21, 5, 19, 2, '2022-04-13 20:10:42', NULL),
(22, 5, 19, 12, '2022-04-13 20:10:42', NULL),
(23, 5, 19, 6, '2022-04-13 20:10:42', NULL),
(24, 5, 24, 1, '2022-04-13 20:51:22', NULL),
(25, 5, 25, 2, '2022-04-13 20:51:22', NULL),
(26, 5, 26, 3, '2022-04-13 20:51:22', NULL),
(27, 5, 27, 4, '2022-04-13 20:51:22', NULL),
(28, 5, 28, 5, '2022-04-13 20:51:22', NULL),
(29, 5, 28, 1, '2022-04-13 20:53:53', NULL),
(30, 5, 29, 2, '2022-04-13 20:53:53', NULL),
(31, 5, 30, 3, '2022-04-13 20:53:53', NULL),
(32, 5, 31, 4, '2022-04-13 20:53:53', NULL),
(33, 5, 32, 5, '2022-04-13 20:53:53', NULL),
(34, 6, 2, 1, '2022-04-13 21:23:15', NULL),
(35, 6, 4, 2, '2022-04-13 21:23:15', NULL),
(36, 6, 6, 3, '2022-04-13 21:23:15', NULL),
(37, 6, 8, 4, '2022-04-13 21:23:15', NULL),
(38, 6, 10, 5, '2022-04-13 21:23:15', NULL),
(39, 6, 5, 4, '2022-04-13 21:40:19', NULL),
(40, 6, 10, 6, '2022-04-13 21:45:42', NULL),
(41, 6, 11, 9, '2022-04-13 21:46:29', NULL),
(42, 6, 12, 4, '2022-04-13 21:46:41', NULL),
(43, 6, 14, 1, '2022-04-13 21:47:42', NULL),
(44, 6, 15, 2, '2022-04-13 21:47:42', NULL),
(45, 6, 16, 3, '2022-04-13 21:47:42', NULL),
(46, 6, 17, 4, '2022-04-13 21:47:42', NULL),
(47, 6, 18, 5, '2022-04-13 21:47:42', NULL),
(48, 6, 19, 5, '2022-04-13 21:47:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'firly', '$2y$10$a1Fizl0GwThI6I0yhnbJZuKBKvij9b8PC0eMrwLxa/Yr1Agdw1zzy', '2022-04-09 03:39:04', NULL),
(2, 'firpearce', '$2y$10$VIhjSKSO8KZuezhZCTvuCuxw.Kix9/6fakeLbszpVQaleTgFXuyKy', '2022-04-09 03:41:58', NULL),
(3, 'contoh', '$2y$10$ihpO6H0mJhb6etmwLqde1Ocm3PTjoyhwJgfCd0VBqYCBs4WLYguaG', '2022-04-09 03:46:07', NULL),
(4, 'coba', '$2y$10$aiXG68Ww2fm/L1mHkVjm3.FaNyX5P42Fhrx.tx6fqZjQXka51ueRe', '2022-04-09 03:48:41', NULL),
(5, 'firlytaufik', '$2y$10$DEnSS//xEQvLu.2zFhmZ9Oaquo/iv/4ZOSLPark14NG8Nv6pzRPGa', '2022-04-09 03:49:31', NULL),
(6, 'contoh2', '$2y$10$lRj1rz9M9PMQKB6MFe8Tau4LFyMq4dNpkOV9ZLzJr/YoFRR5WJzlG', '2022-04-09 03:51:00', NULL),
(7, 'cona', '$2y$10$TG4uapE4.UYqxhQcCpyNPushBSbGCEGPPr2ZekAOTqo7/XQif6NhO', '2022-04-09 03:54:35', NULL),
(8, 'mencoba', '$2y$10$LkQMw.uhqZPUYttd2BVg5.8ZFjmlak9Zoa5BFtWmuz5F8cxk7qyKe', '2022-04-09 03:57:11', NULL),
(9, 'basudara', '$2y$10$ru9uqbK3kIHglU9BdKUJ4OmZVtwXYY6EDYMY89yrI5akAm/yXM37q', '2022-04-09 04:00:40', NULL),
(10, '123456', '$2y$10$JYQESvtusK1sK58JHhTrn.CNegmRyYUbRxD5xbeJMHMAbikaQkCd2', '2022-04-13 20:56:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tbl_penjual`
--
ALTER TABLE `tbl_penjual`
  ADD PRIMARY KEY (`id_penjual`);

--
-- Indexes for table `tbl_permintaan`
--
ALTER TABLE `tbl_permintaan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_penjual`
--
ALTER TABLE `tbl_penjual`
  MODIFY `id_penjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_permintaan`
--
ALTER TABLE `tbl_permintaan`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
