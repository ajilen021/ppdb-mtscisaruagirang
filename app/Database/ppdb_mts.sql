-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2025 at 02:54 AM
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
(4, 2, 'siswa2', NULL, 'siswa2', '2012-12-12', NULL, 'WNI', NULL, NULL, NULL, 'SDN Parubaya', 'Baru', NULL, NULL, 'Laki-laki', 'Conto', NULL, 'Contoh', 'Example', 'Example', 'Contoh', NULL, NULL, NULL, NULL, '3232323232332323', '3232323232323232', '08574888884', '1761108037_41cc312a1a75e1be2cf3.jpeg', '1761108037_0e8fc0f3bb6d66832cc1.pdf', '1761108037_79e5f93c09500137bf37.pdf', NULL, NULL, NULL, NULL, NULL, 'Ditolak', 'Data kurang lengkap', 'Menunggu Konfirmasi', '2025-10-22 04:40:37', '2025-10-22 15:20:19'),
(9, 3, 'siswa3', 'siswa', 'siswa3', '2011-11-11', 'Islam', 'WNI', 1, NULL, 2, 'SDN 1 Sukabumi', 'Baru', NULL, NULL, 'Laki-laki', 'Sukabumi', 'Orang Tua', 'Contoh', 'Example', 'Example', 'Contoh', '', '0845454545455', '', '', '3232323232332111', '3232323232323232', '085858585858', '1761149194_e7b0bab82aeb42ed929a.jpg', NULL, NULL, '1761149194_46a4a0ea5dfc76aac150.jpeg', '1761149194_9e212d16a2be61d486e3.jpg', '1761149194_067e69e72c1a4d177dd9.jpeg', '1761149194_d32be244740b960ff2a1.jpeg', '1761149194_c655f2f51f4131b3d5c6.jpg', 'Ditolak', 'Dokumen tidak lengkap', 'Menunggu Konfirmasi', '2025-10-22 16:06:34', '2025-10-22 23:52:05'),
(12, 4, 'siswa10', 'siswaaaa', 'siswa10', '2012-12-12', 'Kristen Protestan', 'WNI', 4, 3, 1, 'SDN Bantargebang', 'Baru', NULL, NULL, 'Perempuan', 'Banung', 'Orang Tua', 'Contoh', 'Example', 'Example', 'Contoh', 'asdadw', '085858586658', 'dasdasdad', 'asdasda', '3232323232332222', '3232323232323222', '08585858585858', '1761180589_c32c3451a6c0afdc0025.png', NULL, '1761180208_b8842b263ed758114486.pdf', '1761180589_007a8736220bc3f49df3.png', '1761180208_66cf7b240070fbe430db.jpg', '1761176887_220867e65629fa786f9b.jpg', '1761180208_d3e9ff8aca452df97bb6.jpg', '1761180208_43b62a57c555bb2b4fc4.pdf', 'Menunggu Konfirmasi', NULL, 'Menunggu Konfirmasi', '2025-10-22 23:48:07', '2025-10-23 00:49:49'),
(13, 5, 'siswa4', 'siswa', 'siswa4', '2011-11-11', 'Islam', 'WNI', 4, 3, 1, 'SDN Bantargebang', 'Pindahan', 'VIII B', '2025-11-12', 'Perempuan', 'Suradi', 'Orang Tua', 'Ridwan', 'Aruna', 'Morbag', 'Morwan', '', '0845454545455', '', '', '3232323232332333', '3232323232323232', '08574888884', '1761179222_f4601f47f292e87af610.jpg', NULL, '1761179222_39901100046aef6f71de.pdf', '1761179222_cf64449562cde40d10cb.jpeg', '1761179222_4574a0ecb5b41228c903.jpeg', NULL, '1761179222_a4dcb26c9ad33233f0e6.pdf', '1761179222_8276ecaefcbb675d8542.pdf', 'Ditolak', 'Ngetest', 'Menunggu Konfirmasi', '2025-10-23 00:27:02', '2025-10-23 00:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'siswa1@example.com', '$2y$10$OrMgbX0T0Un3oM6i6GTIVeABYZJZ61g9aEKdw3CaBWT3rkl.oD.Mm', '2025-10-21 04:10:29'),
(2, 'siswa2@example.com', '$2y$10$.fV0Id2EBdfiUWPB4zbeouXw0CjnbxtruXjxbQBrFGx3SyODVpWnS', '2025-10-21 04:29:18'),
(3, 'siswa3@example.com', '$2y$10$yKp7R2eg3b9JqS/899nMEuemtMDidK07ToZn9oHoDUHz.uvP7yJPK', '2025-10-22 16:01:17'),
(4, 'siswa4@example.com', '$2y$10$iGjj.i4tx3/oARcfCOl6dOPqaB1HikuE6LAMor0MLcf0movhtr.3K', '2025-10-22 23:21:16'),
(5, 'siswa5@example.com', '$2y$10$1UHnTrfr5njBoCe0jCh6DeSofJe9r0ghaQYY9Iyxcwgxw154d5dZW', '2025-10-23 00:03:01');

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
