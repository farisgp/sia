-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 08:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia_sd2sijeruk2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `nama_admin` varchar(25) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `pendidikan` varchar(10) NOT NULL,
  `jabatan` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agama` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id`, `agama`, `created_at`, `updated_at`) VALUES
(1, 'Islam', '2023-12-29 13:35:39', '2023-12-29 13:35:39'),
(2, 'Kristen', '2023-12-29 13:35:39', '2023-12-29 13:35:39'),
(3, 'Katholik', '2023-12-29 13:35:39', '2023-12-29 13:35:39'),
(4, 'Hindu', '2023-12-29 13:35:39', '2023-12-29 13:35:39'),
(5, 'Buddha', '2023-12-29 13:35:39', '2023-12-29 13:35:39'),
(6, 'Konghucu', '2023-12-29 13:35:39', '2023-12-29 13:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_guru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mapel` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_agama` bigint(20) UNSIGNED DEFAULT NULL,
  `pendidikan` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `foto` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama_guru`, `jenis_kelamin`, `id_mapel`, `id_kelas`, `alamat`, `kontak`, `id_agama`, `pendidikan`, `jabatan`, `user_id`, `foto`, `created_at`, `updated_at`) VALUES
(1, '1312414124', 'asdasdas', 'L', 6, 1, 'asdasdasd', 'weq13123', 1, 's3', 'adfwdgwa', NULL, '', '2023-12-30 06:43:42', '2023-12-31 01:22:59'),
(34, '12345678', 'Coba12', 'L', 8, 7, 'ewqsrwtd', '1423536547', 1, 's1', 'pns', NULL, '', '2023-12-31 21:15:07', NULL),
(35, '12345678314', 'Coba', 'L', 2, 7, 'qectqexe', 'weq13123', 2, 's1', 'pns', NULL, 'foto-12345678314.png', '2023-12-31 23:05:17', '2024-01-10 12:11:15'),
(38, 'a13122513123', 'Coba123', 'L', 10, 1, 'wetwtsw', '1423536547', 1, 's1', 'PNS', 2, NULL, '2024-01-04 20:18:02', NULL),
(39, '1232145635', 'Tesguru222', 'L', 7, 7, 'wrt34dtwe', 'werwe5t', 2, 's1', 'PNS', 3, 'foto-1232145635.png', '2024-01-04 21:16:19', '2024-01-10 12:01:03'),
(40, '6531479976', 'tes akun', 'L', 10, 1, 'hfcefasdfghjk', NULL, 2, 's1', 'PNS', 1, NULL, '2024-01-05 12:47:51', NULL),
(41, '452515765843', 'Coba1243', 'L', 10, 2, 'jkgfsdgjvj.', NULL, 6, 's1', 'PNS', 1, NULL, '2024-01-05 12:56:00', NULL),
(42, '1232453142354', 'cobates123', 'L', 10, 1, 'fadfwecyerter', '1423536547', 4, 's1', 'PNS', 1, NULL, '2024-01-05 19:01:55', NULL),
(43, '13124543523', 'tesguru1234', 'L', 10, 1, 'solo', '1423536547', 1, 's1', 'PNS', NULL, NULL, '2024-01-08 19:38:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pelajaran`
--

CREATE TABLE `jadwal_pelajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_mata_pelajaran` bigint(20) UNSIGNED NOT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_pelajaran`
--

INSERT INTO `jadwal_pelajaran` (`id`, `id_kelas`, `id_mata_pelajaran`, `id_guru`, `hari`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 34, 'Senin', '07:00:45', NULL, NULL),
(2, 3, 1, 1, 'Senin', '14:50:00', '2024-01-02 00:50:36', NULL),
(4, 1, 6, 34, 'Sabtu', '07:00:45', '2024-01-02 03:33:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tingkat_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `tingkat_kelas`, `created_at`, `updated_at`) VALUES
(1, 'Kelas 1', '2023-12-29 13:35:32', '2023-12-29 13:35:32'),
(2, 'Kelas 2', '2023-12-29 13:35:32', '2023-12-29 13:35:32'),
(3, 'Kelas 3', '2023-12-29 13:35:32', '2023-12-29 13:35:32'),
(4, 'Kelas 4', '2023-12-29 13:35:32', '2023-12-29 13:35:32'),
(5, 'Kelas 5', '2023-12-29 13:35:32', '2023-12-29 13:35:32'),
(6, 'Kelas 6', '2023-12-29 13:35:32', '2023-12-29 13:35:32'),
(7, 'Mata Pelajaran', '2023-12-31 13:05:07', '2023-12-31 13:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mapel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `nama_mapel`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Indonesia', '2023-12-29 13:35:36', '2023-12-29 13:35:36'),
(2, 'IPA', '2023-12-29 13:35:36', '2023-12-29 13:35:36'),
(3, 'IPS', '2023-12-29 13:35:36', '2023-12-29 13:35:36'),
(4, 'Bahasa Jawa', '2023-12-29 13:35:36', '2023-12-29 13:35:36'),
(5, 'Olahraga', '2023-12-29 13:35:36', '2023-12-29 13:35:36'),
(6, 'Agama', '2023-12-29 13:35:36', '2023-12-29 13:35:36'),
(7, 'BTQ', '2023-12-29 13:35:36', '2023-12-29 13:35:36'),
(8, 'Matematika', '2023-12-29 13:35:36', '2023-12-29 13:35:36'),
(9, 'Seni Budaya dan Keterampilan', '2023-12-29 13:35:36', '2023-12-29 13:35:36'),
(10, 'Guru Kelas / Wali Kelas', '2023-12-31 13:04:00', '2023-12-31 13:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_27_141700_create_agama_table', 1),
(6, '2023_12_27_141701_create_matapelajaran_table', 1),
(7, '2023_12_27_141702_create_kelas_table', 1),
(8, '2023_12_27_141703_create_guru_table', 1),
(9, '2023_12_27_141704_create_siswa_table', 1),
(10, '2023_12_27_141705_create_nilai_table', 1),
(11, '2023_12_27_141706_create_presensi_table', 1),
(12, '2023_12_27_141707_create_jadwal_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED DEFAULT NULL,
  `id_siswa` bigint(20) UNSIGNED DEFAULT NULL,
  `id_mapel` bigint(20) UNSIGNED DEFAULT NULL,
  `lm1` int(11) DEFAULT NULL,
  `lm2` int(11) DEFAULT NULL,
  `lm3` int(11) DEFAULT NULL,
  `lm4` int(11) DEFAULT NULL,
  `lm5` int(11) DEFAULT NULL,
  `lm6` int(11) DEFAULT NULL,
  `rata_rata_lm` int(11) DEFAULT NULL,
  `tes` int(11) DEFAULT NULL,
  `non_tes` int(11) DEFAULT NULL,
  `rata_rata_sas` int(11) DEFAULT NULL,
  `nilai_akhir` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `tanggal_presensi` date NOT NULL,
  `status` enum('Hadir','Tidak Hadir','','') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hadir',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` char(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak_ortu` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_agama` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `foto` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','siswa','guru','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_siswa` bigint(20) UNSIGNED DEFAULT NULL,
  `id_guru` bigint(20) UNSIGNED DEFAULT NULL,
  `id_admin` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `isactive`, `created_at`, `updated_at`, `id_siswa`, `id_guru`, `id_admin`) VALUES
(1, 'admin', '$2y$10$YryMwy46/ZWBOfk/MKkIP.cixBywzb7s.3CQYCr4xaouELh396IeW', 'admin', 1, '2024-01-04 08:31:16', '2024-01-04 17:34:20', NULL, 1, NULL),
(2, 'tesguru', '$2y$10$A9CUI4J0.CdhQFgjeU1B/eCD.DndjbjADzrBnh7DZ59NLpSPGhODa', 'guru', 1, '2024-01-04 17:33:23', '2024-01-04 17:34:27', NULL, 34, NULL),
(3, 'tesguru222', '$2y$10$pKGQBkKo1EEEZBX7iG6Vje31aPwzpaJHs1I7P/fGjU64XyD39FUf.', 'guru', 1, '2024-01-04 21:05:03', '2024-01-04 21:05:39', NULL, 35, NULL),
(4, 'cobaguru3', '$2y$10$1x.eGJq0D164Bw/JfAKQAeyep7NHXxlNKqJjoL1VlI4lxbGE5Uub6', 'guru', 1, '2024-01-04 23:38:27', '2024-01-04 23:39:01', NULL, 38, NULL),
(5, 'MisterBayu', '$2y$10$bryMSO0qCOH7xFfx5z4PUONaWzwr54KzC0vvuYPwoxf8KX75BqshS', 'guru', 1, '2024-01-05 00:29:43', '2024-01-05 00:29:53', NULL, 35, NULL),
(6, 'cobaini', '$2y$10$fxhgwcZh38dCj67ZWpPBsOnFHcl7kKKXW9bXZY.bZYMwxjHzY73SW', 'guru', 1, '2024-01-05 00:31:59', '2024-01-05 00:32:07', NULL, 38, NULL),
(7, 'iniuser', '$2y$10$LcTmazAtgkvqdiYPMriCTe/vYd8rkrLZvk/re6.LSe4XFynEIK3eO', 'guru', 1, '2024-01-05 03:05:21', '2024-01-05 03:05:28', NULL, 38, NULL),
(8, 'cobauser', '$2y$10$bSKHjLgROWbS1ZMZ7Zh7Kei/BLmd65tK3AiYa7ZuQcmSaagMWay0.', 'guru', 1, '2024-01-05 03:21:12', '2024-01-05 03:21:19', NULL, 42, NULL),
(9, 'tes12345', '$2y$10$R6qDcqz89ONvsgtvDhjb8uI2HNUczdfxsLazeJeMwFfb9Vs8GAUSW', 'guru', 0, '2024-01-05 04:10:06', '2024-01-08 19:41:40', NULL, 39, NULL),
(10, 'admin1', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'admin', 0, '2024-01-05 09:32:58', '2024-01-05 09:32:58', NULL, 42, NULL),
(11, 'guru1', '$2y$10$C.S4JY8PClGOExTrgmHXV.fyAdBwYXn6AaGFr00zmXXWAMMrF0zg6', 'guru', 0, '2024-01-05 09:47:33', '2024-01-05 09:47:33', NULL, 41, NULL),
(12, 'tesakun', '$2y$10$d/HLf7CqlOd7s3WrhissfO9gpsbJ/RRFIjrNSs/bqMQLOMWW7fcXW', 'guru', 1, '2024-01-05 11:05:02', '2024-01-05 11:07:46', NULL, 39, NULL),
(13, NULL, NULL, 'admin', 0, '2024-01-05 11:37:28', '2024-01-05 11:37:28', NULL, NULL, NULL),
(14, NULL, NULL, 'admin', 0, '2024-01-05 11:38:33', '2024-01-05 11:38:33', NULL, NULL, NULL),
(15, NULL, '$2y$10$3CfjBIHbu9u5diygVu8tOOUnqEjDBsN8.s1pGHzQ9OkS4c0eCDfxG', 'guru', 0, '2024-01-05 11:51:32', '2024-01-10 18:38:31', NULL, 43, NULL),
(16, NULL, '$2y$10$740j4Punv/rgiBa6spfsm.ppfL7XNL/Dk1.JNm/NI/GAdtkrhGXti', 'guru', 1, '2024-01-05 19:01:23', '2024-01-10 18:38:08', NULL, 43, NULL),
(17, NULL, '$2y$10$HUYOFRPAtrX4B4N4othVDuQK5LF89lsbzqGt7z.UGYYEjYFDrqnf6', 'guru', 0, '2024-01-06 14:02:53', '2024-01-10 17:55:12', NULL, 43, NULL),
(18, NULL, '$2y$10$4aSOmmTTnoezpGqeRhunQujYSYQRhG8WlOU0h2CqzbN1NRrMQSeBG', 'guru', 0, '2024-01-08 19:08:14', '2024-01-10 17:54:49', NULL, 43, NULL),
(19, NULL, '$2y$10$qZSLVt0c2BiZB791RcPQoeMJD7C/3fQ5/6AJW8nwGn.HsYwKQvtfu', 'guru', 0, '2024-01-08 19:46:40', '2024-01-08 19:47:50', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_nip_unique` (`nip`),
  ADD UNIQUE KEY `nama_guru` (`nama_guru`),
  ADD KEY `guru_id_agama_foreign` (`id_agama`),
  ADD KEY `guru_id_kelas_foreign` (`id_kelas`),
  ADD KEY `guru_id_mapel_foreign` (`id_mapel`),
  ADD KEY `fk_guru_user` (`user_id`);

--
-- Indexes for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_pelajaran_id_kelas_foreign` (`id_kelas`),
  ADD KEY `jadwal_pelajaran_id_mata_pelajaran_foreign` (`id_mata_pelajaran`),
  ADD KEY `jadwal_pelajaran_id_guru_foreign` (`id_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_id_kelas_foreign` (`id_kelas`),
  ADD KEY `nilai_id_siswa_foreign` (`id_siswa`),
  ADD KEY `nilai_id_mapel_foreign` (`id_mapel`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presensi_id_kelas_foreign` (`id_kelas`),
  ADD KEY `presensi_id_siswa_foreign` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nis_unique` (`nis`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`nisn`),
  ADD KEY `siswa_id_kelas_foreign` (`id_kelas`),
  ADD KEY `siswa_id_agama_foreign` (`id_agama`),
  ADD KEY `fk_siswa_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_siswa` (`id_siswa`),
  ADD KEY `fk_user_guru` (`id_guru`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `fk_guru_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `guru_id_agama_foreign` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id`),
  ADD CONSTRAINT `guru_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `guru_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id`);

--
-- Constraints for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  ADD CONSTRAINT `jadwal_pelajaran_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`),
  ADD CONSTRAINT `jadwal_pelajaran_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `jadwal_pelajaran_id_mata_pelajaran_foreign` FOREIGN KEY (`id_mata_pelajaran`) REFERENCES `mata_pelajaran` (`id`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `nilai_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `nilai_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`);

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `presensi_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_siswa_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `siswa_id_agama_foreign` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id`),
  ADD CONSTRAINT `siswa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`),
  ADD CONSTRAINT `fk_user_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
