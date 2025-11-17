-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2025 at 06:12 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb_mts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$3zK.N.u9.g0U.wG7I/918u0Z8L5C5B.1uB3xW5A.vB3yE3X.wD5yK');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$LTUegqQ7hvdVyXVaDWRwoeCQXIbQYl0Oi6va0iUoXtRQeEgnXi45S', '2025-10-21 12:30:15', '2025-10-21 12:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nama_panggilan` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `kewarganegaraan` varchar(50) DEFAULT 'WNI',
  `anak_ke` int DEFAULT NULL,
  `jumlah_kakak` int DEFAULT NULL,
  `jumlah_adik` int DEFAULT NULL,
  `asal_sekolah` varchar(255) NOT NULL,
  `status_masuk` varchar(50) DEFAULT 'Baru',
  `diterima_kelas` varchar(10) DEFAULT NULL,
  `tanggal_diterima` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `tinggal_bersama` varchar(100) DEFAULT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `alamat_ortu` text,
  `no_hp_ortu` varchar(20) DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `alamat_wali` text,
  `nik` varchar(20) NOT NULL,
  `no_kk` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `foto_path` varchar(255) DEFAULT NULL,
  `nik_path` varchar(255) DEFAULT NULL,
  `kk_path` varchar(255) DEFAULT NULL,
  `skl_path` varchar(255) DEFAULT NULL,
  `ktp_ayah_path` varchar(255) DEFAULT NULL,
  `ktp_ibu_path` varchar(255) DEFAULT NULL,
  `akta_path` varchar(255) DEFAULT NULL,
  `skkb_path` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu Konfirmasi','Diterima','Ditolak') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `alasan_penolakan` text,
  `status_pendaftaran` varchar(50) DEFAULT 'Menunggu Konfirmasi',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendaftar`
--

INSERT INTO `pendaftar` (`id`, `user_id`, `nama_lengkap`, `nama_panggilan`, `tempat_lahir`, `tanggal_lahir`, `agama`, `kewarganegaraan`, `anak_ke`, `jumlah_kakak`, `jumlah_adik`, `asal_sekolah`, `status_masuk`, `diterima_kelas`, `tanggal_diterima`, `jenis_kelamin`, `alamat`, `tinggal_bersama`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `alamat_ortu`, `no_hp_ortu`, `nama_wali`, `alamat_wali`, `nik`, `no_kk`, `no_hp`, `foto_path`, `nik_path`, `kk_path`, `skl_path`, `ktp_ayah_path`, `ktp_ibu_path`, `akta_path`, `skkb_path`, `status`, `alasan_penolakan`, `status_pendaftaran`, `created_at`, `updated_at`) VALUES
(6, 8, 'siswa0232323', 'siswa', 'Sukabumi', '2012-12-12', 'Islam', 'WNI', 4, 3, 1, 'SDN Sukabumi', 'Baru', NULL, NULL, 'Laki-laki', 'Sukabumi', 'Orang Tua', 'Ridwan', 'Isah', 'Petani', 'ibu rumah tangga', 'Sukabumi', '085858585845', 'Radju', 'Sukabumi', '3232323232334442', '3232323232323232', '085858585844', '1761289805_64ce015a1af42a23811e.jpeg', NULL, '1761289805_db7ddc8694cce38fafd4.pdf', '1761289805_b61e83376565a8eac2aa.pdf', '1761289805_3238f60e1583d7944143.pdf', NULL, '1761289805_11c9b07786a802ebc6d3.pdf', '1761289805_a754770d5f850f24cb03.pdf', 'Ditolak', 'Dokumen SKL tidak lengkap', 'Menunggu Konfirmasi', '2025-10-24 07:10:05', '2025-10-27 04:23:52'),
(7, 2, 'siswa1', 'siswa', 'Jakarta', '2012-12-12', 'Islam', 'WNI', 4, 3, 1, 'SDN Parubaya', 'Pindahan', 'VIII C', '2001-12-31', 'Laki-laki', 'Sukabumi', 'Orang Tua', 'Contoh', 'Example', 'Example', 'Contoh', '', '', 'dasdasdad', '', '3232203020302300', '2323232323232323', '08574888884', '1761312684_4fb7de5d346c51e4e5ce.jpg', NULL, '1761312684_fb0777125f7c7650f43c.jpeg', '1761312684_822c117ebbb8f6fc1142.jpeg', '1761312684_20746b02daeb9eee3a0c.jpg', NULL, '1761312684_013b70574a549efadbb1.jpg', '1761312684_a357bc9adac9cb6a1fbb.jpg', 'Diterima', NULL, 'Menunggu Konfirmasi', '2025-10-24 13:31:24', '2025-10-24 13:34:57'),
(8, 1, 'siswa1', 'siswa', 'Jakarta', '2008-12-31', 'Islam', 'WNI', 4, 3, 1, 'SDN Bantargebang', 'Baru', NULL, NULL, 'Laki-laki', 'Sukabumi', 'Orang Tua', 'Contoh', 'Example', 'Example', 'Contoh', '', '', '', '', '3232323232323232', '3232323232323132', '08584858884', '1761312777_4e3cef3d4c7f4c3b7802.jpg', NULL, '1761312777_fb51c02296fc628d7248.jpg', '1761312777_62100b5df77eff41516e.jpeg', '1761312777_f9ec85ac7423a60ec50e.jpg', NULL, '1761312777_b1547d9d1c95bb4b53da.jpeg', '1761312777_29ea942fe5c3c4d87c0a.jpg', 'Diterima', NULL, 'Menunggu Konfirmasi', '2025-10-24 13:32:57', '2025-10-24 13:36:33'),
(9, 6, 'siswa6', 'siswa', 'Jakarta', '2012-12-12', 'Islam', 'WNI', 3, 2, 1, 'SDN Bantargebang', 'Baru', NULL, NULL, 'Laki-laki', 'Sukabumi', 'Orang Tua', 'Contoh', 'Example', 'Example', 'Contoh', '', '', '', '', '3232323232332345', '3232323232322345', '08574888884', '1761539170_148884d3cfc23758b335.jpg', NULL, '1761539170_a22db2866cd7d55e1aec.pdf', '1761539170_3cdde97d7b1f90fe728d.pdf', '1761539170_2e3ec689029dd8414f77.pdf', NULL, '1761539170_9eaf7952d0bfb1a590f7.pdf', '1761539170_2df3409385600d0cf9bc.pdf', 'Menunggu Konfirmasi', NULL, 'Menunggu Konfirmasi', '2025-10-27 04:26:10', '2025-10-27 04:28:53'),
(10, 9, 'siswa99', 'siswa', 'Sukabumi', '2002-12-03', 'Islam', 'WNI', 4, 3, 1, 'SDN Suryakencana', 'Baru', NULL, NULL, 'Laki-laki', 'Sukabumi, Jl Mayor mahmud ', 'Orang Tua', 'Alvi', 'Irma', 'Petani', 'Ibu rumah tangga', '', '', '', '', '3120232312323443', '3120323232456554', '081382302232', '1761790275_e35d3e1986179ceeac12.jpeg', NULL, '1761789763_578d53603d7d2a754f52.pdf', '1761789763_89a253ccce4c4d169992.pdf', '1761789763_1e3dd5b4928c7540efef.pdf', NULL, '1761789763_3be674c6546fa5524d45.pdf', '1761789763_dd8c0cd068f9269ebaf4.pdf', 'Diterima', NULL, 'Menunggu Konfirmasi', '2025-10-30 02:02:43', '2025-10-30 02:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `verification_token`, `is_verified`, `created_at`) VALUES
(1, 'siswa1@example.com', '$2y$10$OrMgbX0T0Un3oM6i6GTIVeABYZJZ61g9aEKdw3CaBWT3rkl.oD.Mm', NULL, 0, '2025-10-21 04:10:29'),
(2, 'siswa2@example.com', '$2y$10$.fV0Id2EBdfiUWPB4zbeouXw0CjnbxtruXjxbQBrFGx3SyODVpWnS', NULL, 0, '2025-10-21 04:29:18'),
(3, 'siswa3@example.com', '$2y$10$yKp7R2eg3b9JqS/899nMEuemtMDidK07ToZn9oHoDUHz.uvP7yJPK', NULL, 0, '2025-10-22 16:01:17'),
(4, 'siswa4@example.com', '$2y$10$iGjj.i4tx3/oARcfCOl6dOPqaB1HikuE6LAMor0MLcf0movhtr.3K', NULL, 0, '2025-10-22 23:21:16'),
(5, 'siswa5@example.com', '$2y$10$1UHnTrfr5njBoCe0jCh6DeSofJe9r0ghaQYY9Iyxcwgxw154d5dZW', NULL, 0, '2025-10-23 00:03:01'),
(6, 'siswa6@example.com', '$2y$10$4UYaki9tYGmzr27gpefBfuueJ.UhOKV80RBs.uCUh4ztRQXGJ4x.q', NULL, 0, '2025-10-23 05:19:58'),
(7, 'siswa7@example.com', '$2y$10$cjt2cp.e.cFeilqpjhqAmeO/deUJ5GRJQ96IP0SLXK00FUEY2q4O.', NULL, 0, '2025-10-23 06:55:00'),
(8, 'siswa0@example.com', '$2y$10$1WEPwodtSJi5nhW5.EAmFenJxR0.Gjph77VpCbL0jqRc1ZilL9NGS', NULL, 0, '2025-10-24 06:58:26'),
(9, 'siswa9@example.com', '$2y$10$ycxWDO31bKnYctQrhD2FIelKC88VGE.VRLI9d4djHow49ceNuz6nK', NULL, 0, '2025-10-30 01:58:31'),
(10, 'siswa10@example.com', '$2y$10$2TiC6sDYWmLQImTmL6/IM.oM3CBgtPsuTPuSAxWZQOKCnE6hYWajy', NULL, 0, '2025-10-30 02:19:02'),
(12, 'nanobeno01@gmail.com', '$2y$10$GWAOvNiEcNRXtcqrs6gVWevwPAx7XLA5gPpGVdWD8tOoD318z7isG', NULL, 0, '2025-11-17 17:30:34'),
(14, 'algamingthre@gmail.com', '$2y$10$HOGeJGsz4OGtvUQF3v/EW.xZMIgFYJLzgcwG5JEANeadYJ/2htEVO', NULL, 1, '2025-11-17 17:48:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD CONSTRAINT `pendaftar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
