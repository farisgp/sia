-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 16, 2024 at 09:14 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia2`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','siswa','guru','') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_siswa` bigint UNSIGNED DEFAULT NULL,
  `id_guru` bigint UNSIGNED DEFAULT NULL,
  `id_admin` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `isactive`, `created_at`, `updated_at`, `id_siswa`, `id_guru`, `id_admin`) VALUES
(10, '', 'admin', '$2y$10$kogkQXny1UF/RBrtntX3HOkjkYFpKswX3qU9J6hFIBOZcgY63chM.', 'admin', 0, '2024-01-05 09:32:58', '2024-05-03 00:02:40', NULL, NULL, NULL),
(495, 'John Doe', '1001', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 200, NULL, NULL),
(497, 'Michael Smith', '1003', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 202, NULL, NULL),
(498, 'Emily Johnson', '1004', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 203, NULL, NULL),
(499, 'David Williams', '1005', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 204, NULL, NULL),
(500, 'Emma Brown', '1006', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 205, NULL, NULL),
(501, 'James Wilson', '1007', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 206, NULL, NULL),
(502, 'Olivia Taylor', '1008', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 207, NULL, NULL),
(503, 'Daniel Martinez', '1009', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 208, NULL, NULL),
(504, 'Sophia Garcia', '1010', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 209, NULL, NULL),
(505, 'Alexander Rodriguez', '1011', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 210, NULL, NULL),
(506, 'Isabella Hernandez', '1012', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 211, NULL, NULL),
(507, 'William Lopez', '1013', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 212, NULL, NULL),
(508, 'Mia Martinez', '1014', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 213, NULL, NULL),
(509, 'James Gonzalez', '1015', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 214, NULL, NULL),
(510, 'Sophia Wilson', '1016', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 215, NULL, NULL),
(511, 'Benjamin Taylor', '1017', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 216, NULL, NULL),
(512, 'Olivia Brown', '1018', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 217, NULL, NULL),
(513, 'Lucas Smith', '1019', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 218, NULL, NULL),
(514, 'Amelia Johnson', '1020', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 219, NULL, NULL),
(515, 'Michael Williams', '1021', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 220, NULL, NULL),
(516, 'Charlotte Brown', '1022', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 221, NULL, NULL),
(517, 'Ethan Wilson', '1023', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 222, NULL, NULL),
(518, 'Ava Taylor', '1024', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 223, NULL, NULL),
(519, 'Mason Martinez', '1025', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 224, NULL, NULL),
(520, 'Harper Gonzalez', '1026', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 225, NULL, NULL),
(521, 'Aiden Wilson', '1027', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 226, NULL, NULL),
(522, 'Evelyn Smith', '1028', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 227, NULL, NULL),
(523, 'Logan Johnson', '1029', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 228, NULL, NULL),
(524, 'Avery Williams', '1030', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 229, NULL, NULL),
(525, 'Liam Brown', '1031', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 230, NULL, NULL),
(526, 'Ella Wilson', '1032', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 231, NULL, NULL),
(527, 'Noah Taylor', '1033', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 232, NULL, NULL),
(528, 'Grace Martinez', '1034', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 233, NULL, NULL),
(529, 'Mia Brown', '1035', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 234, NULL, NULL),
(530, 'Jack Garcia', '1036', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 235, NULL, NULL),
(531, 'Charlotte Lopez', '1037', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 236, NULL, NULL),
(532, 'Aiden Hernandez', '1038', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 237, NULL, NULL),
(533, 'Avery Wilson', '1039', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 238, NULL, NULL),
(534, 'Scarlett Taylor', '1040', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 239, NULL, NULL),
(535, 'James Brown', '1041', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 240, NULL, NULL),
(536, 'Chloe Wilson', '1042', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 241, NULL, NULL),
(537, 'Liam Smith', '1043', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 242, NULL, NULL),
(538, 'Lily Johnson', '1044', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 243, NULL, NULL),
(539, 'Noah Martinez', '1045', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 244, NULL, NULL),
(540, 'Ella Brown', '1046', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 245, NULL, NULL),
(541, 'Benjamin Garcia', '1047', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 246, NULL, NULL),
(542, 'Amelia Hernandez', '1048', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 247, NULL, NULL),
(543, 'Oliver Lopez', '1049', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 248, NULL, NULL),
(544, 'Sophia Hernandez', '1050', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 249, NULL, NULL),
(545, 'Lucas Smith', '1051', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 250, NULL, NULL),
(546, 'Ava Taylor', '1052', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 251, NULL, NULL),
(547, 'Mason Johnson', '1053', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 252, NULL, NULL),
(548, 'Charlotte Martinez', '1054', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 253, NULL, NULL),
(549, 'Ethan Garcia', '1055', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 254, NULL, NULL),
(550, 'Harper Wilson', '1056', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 255, NULL, NULL),
(551, 'Elijah Brown', '1057', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 256, NULL, NULL),
(552, 'Scarlett Taylor', '1058', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 257, NULL, NULL),
(553, 'Aiden Lopez', '1059', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 258, NULL, NULL),
(554, 'Madison Hernandez', '1060', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 259, NULL, NULL),
(555, 'Mason Smith', '1061', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 260, NULL, NULL),
(556, 'Chloe Garcia', '1062', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 261, NULL, NULL),
(557, 'Oliver Brown', '1063', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 262, NULL, NULL),
(558, 'Ella Taylor', '1064', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 263, NULL, NULL),
(559, 'Ethan Hernandez', '1065', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 264, NULL, NULL),
(560, 'Sophia Lopez', '1066', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 265, NULL, NULL),
(561, 'Logan Wilson', '1067', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 266, NULL, NULL),
(562, 'Avery Brown', '1068', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 267, NULL, NULL),
(563, 'Lucas Smith', '1069', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 268, NULL, NULL),
(564, 'Emma Garcia', '1070', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 269, NULL, NULL),
(565, 'Jackson Taylor', '1071', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 270, NULL, NULL),
(566, 'Ava Brown', '1072', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 271, NULL, NULL),
(567, 'Aiden Hernandez', '1073', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 272, NULL, NULL),
(568, 'Olivia Garcia', '1074', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 273, NULL, NULL),
(569, 'Elijah Lopez', '1075', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 274, NULL, NULL),
(570, 'Sophia Wilson', '1076', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 275, NULL, NULL),
(571, 'Jackson Smith', '1077', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 276, NULL, NULL),
(572, 'Amelia Taylor', '1078', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 277, NULL, NULL),
(573, 'Ethan Brown', '1079', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 278, NULL, NULL),
(574, 'Isabella Garcia', '1080', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 279, NULL, NULL),
(575, 'Mason Hernandez', '1081', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 280, NULL, NULL),
(576, 'Olivia Brown', '1082', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 281, NULL, NULL),
(577, 'Noah Lopez', '1083', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 282, NULL, NULL),
(578, 'Emma Garcia', '1084', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 283, NULL, NULL),
(579, 'Liam Wilson', '1085', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 284, NULL, NULL),
(580, 'Ava Taylor', '1086', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 285, NULL, NULL),
(581, 'Oliver Smith', '1087', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 286, NULL, NULL),
(582, 'Sophia Brown', '1088', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 287, NULL, NULL),
(583, 'Logan Lopez', '1089', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 288, NULL, NULL),
(584, 'Mia Garcia', '1090', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 289, NULL, NULL),
(585, 'Elijah Hernandez', '1091', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 290, NULL, NULL),
(586, 'Charlotte Lopez', '1092', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 291, NULL, NULL),
(587, 'William Brown', '1093', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 292, NULL, NULL),
(588, 'Harper Garcia', '1094', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 293, NULL, NULL),
(589, 'Benjamin Lopez', '1095', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 294, NULL, NULL),
(590, 'Amelia Hernandez', '1096', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 295, NULL, NULL),
(591, 'Ethan Smith', '1097', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 296, NULL, NULL),
(592, 'Avery Garcia', '1098', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 297, NULL, NULL),
(593, 'Olivia Lopez', '1099', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 298, NULL, NULL),
(594, 'Logan Brown', '1100', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 299, NULL, NULL),
(595, 'Ella Hernandez', '1101', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 300, NULL, NULL),
(596, 'Lucas Garcia', '1102', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 301, NULL, NULL),
(597, 'Ava Lopez', '1103', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 302, NULL, NULL),
(598, 'Oliver Brown', '1104', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 303, NULL, NULL),
(599, 'Emma Garcia', '1105', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 304, NULL, NULL),
(600, 'Sophia Hernandez', '1106', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 305, NULL, NULL),
(601, 'Noah Smith', '1107', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 306, NULL, NULL),
(602, 'Avery Garcia', '1108', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 307, NULL, NULL),
(603, 'Isabella Lopez', '1109', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 308, NULL, NULL),
(604, 'Elijah Brown', '1110', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 309, NULL, NULL),
(605, 'Charlotte Garcia', '1111', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 310, NULL, NULL),
(606, 'Jack Lopez', '1112', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 311, NULL, NULL),
(607, 'Liam Smith', '1113', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 312, NULL, NULL),
(608, 'Ava Garcia', '1114', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 313, NULL, NULL),
(609, 'Mason Brown', '1115', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 314, NULL, NULL),
(610, 'Emma Lopez', '1116', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 315, NULL, NULL),
(611, 'Ethan Smith', '1117', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 316, NULL, NULL),
(612, 'Olivia Garcia', '1118', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 317, NULL, NULL),
(613, 'Liam Brown', '1119', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 318, NULL, NULL),
(614, 'Ava Lopez', '1120', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 319, NULL, NULL),
(615, 'Oliver Smith', '1121', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 320, NULL, NULL),
(616, 'Sophia Garcia', '1122', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 321, NULL, NULL),
(617, 'Logan Brown', '1123', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 322, NULL, NULL),
(618, 'Mia Lopez', '1124', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 323, NULL, NULL),
(619, 'Lucas Smith', '1125', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 324, NULL, NULL),
(620, 'Charlotte Garcia', '1126', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 325, NULL, NULL),
(621, 'Elijah Brown', '1127', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 326, NULL, NULL),
(622, 'Ava Lopez', '1128', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 327, NULL, NULL),
(623, 'Benjamin Smith', '1129', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 328, NULL, NULL),
(624, 'Emma Garcia', '1130', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 329, NULL, NULL),
(625, 'Ethan Brown', '1131', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 330, NULL, NULL),
(626, 'Olivia Lopez', '1132', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 331, NULL, NULL),
(627, 'William Smith', '1133', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 332, NULL, NULL),
(628, 'Isabella Garcia', '1134', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 333, NULL, NULL),
(629, 'Lucas Brown', '1135', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 334, NULL, NULL),
(630, 'Olivia Lopez', '1136', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 335, NULL, NULL),
(631, 'Ethan Smith', '1137', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 336, NULL, NULL),
(632, 'Emma Garcia', '1138', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 337, NULL, NULL),
(633, 'Oliver Brown', '1139', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 338, NULL, NULL),
(634, 'Sophia Lopez', '1140', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 339, NULL, NULL),
(635, 'Noah Smith', '1141', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 340, NULL, NULL),
(636, 'Avery Garcia', '1142', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 341, NULL, NULL),
(637, 'Mia Brown', '1143', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 342, NULL, NULL),
(638, 'Elijah Lopez', '1144', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 343, NULL, NULL),
(639, 'Ava Smith', '1145', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 344, NULL, NULL),
(640, 'Oliver Garcia', '1146', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 345, NULL, NULL),
(641, 'Sophia Lopez', '1147', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 346, NULL, NULL),
(642, 'Jackson Brown', '1148', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 347, NULL, NULL),
(643, 'Emma Garcia', '1149', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 348, NULL, NULL),
(644, 'Mason Smith', '1150', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 349, NULL, NULL),
(645, 'Olivia Lopez', '1151', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 350, NULL, NULL),
(646, 'Ethan Garcia', '1152', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 351, NULL, NULL),
(647, 'Oliver Smith', '1153', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 352, NULL, NULL),
(648, 'Ava Brown', '1154', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 353, NULL, NULL),
(649, 'Lucas Lopez', '1155', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 354, NULL, NULL),
(650, 'Emma Garcia', '1156', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 355, NULL, NULL),
(651, 'Olivia Smith', '1157', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 356, NULL, NULL),
(652, 'Noah Garcia', '1158', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 357, NULL, NULL),
(653, 'Isabella Smith', '1159', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 358, NULL, NULL),
(654, 'Aiden Garcia', '1160', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 359, NULL, NULL),
(655, 'Sophia Smith', '1161', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 360, NULL, NULL),
(656, 'Elijah Brown', '1162', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 361, NULL, NULL),
(657, 'Charlotte Garcia', '1163', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 362, NULL, NULL),
(658, 'Jackson Lopez', '1164', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 363, NULL, NULL),
(659, 'Sophia Smith', '1165', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 364, NULL, NULL),
(660, 'Oliver Garcia', '1166', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 365, NULL, NULL),
(661, 'Emma Brown', '1167', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 366, NULL, NULL),
(662, 'Noah Garcia', '1168', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 367, NULL, NULL),
(663, 'Sophia Smith', '1169', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 368, NULL, NULL),
(664, 'Oliver Brown', '1170', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 369, NULL, NULL),
(665, 'Isabella Garcia', '1171', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 370, NULL, NULL),
(666, 'Aiden Smith', '1172', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 371, NULL, NULL),
(667, 'Charlotte Brown', '1173', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 372, NULL, NULL),
(668, 'Jackson Garcia', '1174', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 373, NULL, NULL),
(669, 'Sophia Smith', '1175', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 374, NULL, NULL),
(670, 'Oliver Brown', '1176', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 375, NULL, NULL),
(671, 'Isabella Garcia', '1177', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 376, NULL, NULL),
(672, 'Aiden Smith', '1178', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 377, NULL, NULL),
(673, 'Charlotte Brown', '1179', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 378, NULL, NULL),
(674, 'Jackson Garcia', '1180', '$2y$10$pW7Wg4TsJAL.P7bYEWYpy.KnULx4fvCXvonvk5sp7oIjXMg2w8HP.', 'siswa', 1, '2024-04-30 05:57:53', '2024-04-30 05:57:53', 379, NULL, NULL),
(751, 'Muhammad Sumbul. S.Pd.', 'sumbul', '$2y$10$1zha/zFhbQp/Cbv8vnc7xOCOkFQFNXUGk9yZ0.NTrtnmaB0bVvEtG', 'guru', 1, '2024-04-30 06:37:28', '2024-04-30 06:37:28', NULL, 159, NULL),
(752, 'Eva Angelina. S.Pd. SD', 'angelina', '$2y$10$h52GQEYtXS9tkx2ROWJpqOmRjtfgXvfyR6JqsXJYLLRjZ85fZGkSy', 'guru', 1, '2024-04-30 06:39:05', '2024-04-30 06:39:05', NULL, 160, NULL),
(753, 'Pratama Arhan. S.Pd', 'arhan', '$2y$10$57/FFtXzS0Kp3ohxeVG2YulAMuyXAB8IMRDDN4jhlfV0f89H4j1Cq', 'guru', 1, '2024-04-30 06:40:12', '2024-04-30 06:40:12', NULL, 161, NULL),
(754, 'Jasmine. S.Pd', 'jasmine', '$2y$10$q9I7r5XBkWzVUzd42rsDDuz3ZsPVUNA3D6cpdQz/PmubLH6wC/zVO', 'guru', 1, '2024-04-30 06:41:07', '2024-04-30 06:41:07', NULL, 162, NULL),
(755, 'Ernando Ari. S.Pd', 'ernando', '$2y$10$ugeh2fKszvKnpbkID3q2deKKuTlypXEOWOO5UdZClD5Ch3wjHpYo2', 'guru', 1, '2024-04-30 06:42:19', '2024-04-30 06:42:19', NULL, 163, NULL),
(756, 'Cinta Kasih', 'cintakasih', '$2y$10$XA4tHLt5o5oXLduhnh2GauYREs0h.eQirIR3dU0cqGdHEY9RGReQS', 'guru', 1, '2024-04-30 06:44:03', '2024-04-30 06:44:03', NULL, 164, NULL),
(757, 'Rizky Ridho. S.Pd', 'rizkyridho', '$2y$10$XCRqAinGiTzuZ9xMO1mNG.Yp6Bi95ABfcB7w6Ry5TbDSQLv6amXTm', 'guru', 1, '2024-04-30 06:45:49', '2024-04-30 06:45:49', NULL, 165, NULL),
(758, 'Asnawi Mangkualam', 'asnawi', '$2y$10$24U88bzFnsfziFo4eFdSQeeJAtnVn6gT.TlIZJVN3.XweDUWaPbxS', 'guru', 1, '2024-04-30 06:47:41', '2024-04-30 06:47:41', NULL, 166, NULL),
(759, 'Nicole Waterson', 'nc1309', '$2y$10$u2aDneamr3BwgfLhTtR.W.5IYnWlFdI0KFDQ9DXaKriIgYj/CcK5u', 'siswa', 1, '2024-05-01 03:02:31', '2024-05-01 03:02:31', 380, NULL, NULL),
(761, 'Testing', 'developer1234', '$2y$10$/DXws5L22SR4nqlUZ72cc.7ONidcMLM7iibAIHefcSscrd0qRJVl2', 'guru', 1, '2024-05-01 08:28:08', '2024-05-01 08:28:08', NULL, 168, NULL),
(762, 'syaiful rochman', 'sr', '$2y$10$0Y9HhuHCqgxWtUsH3YNg4eSgNjOCLS32nw4dl9XwKtdm5/O0.RgYC', 'siswa', 1, '2024-05-01 13:32:11', '2024-05-01 13:32:11', 381, NULL, NULL),
(768, 'birjon', 'birjon', '$2y$10$ALsROhThCJJH31mFg48ONujdMJJdJOr5UWfE7SIxMZeAMwfKOcaja', 'guru', 1, '2024-05-03 00:06:51', '2024-05-03 00:06:51', NULL, 170, NULL),
(770, 'Coba1', 'coba1', '$2y$10$wO7jtHCZPd6MBfdvLXgycOk8.cNbfLRCgSi/VcFauUsZVeFpdsMXm', 'guru', 1, '2024-05-03 01:57:13', '2024-05-03 01:57:13', NULL, 172, NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=774;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
