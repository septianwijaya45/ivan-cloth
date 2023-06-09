-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 07:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ivans-cloth`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_04_10_215512_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_03_10_215209_create_m_gajies_table', 1),
(7, '2023_03_10_215219_create_m_ukurans_table', 1),
(8, '2023_03_26_030958_create_m_kain_rolls_table', 1),
(9, '2023_03_26_031041_create_m_kain_potongans_table', 1),
(10, '2023_03_26_031055_create_m_perlengkapans_table', 1),
(11, '2023_03_26_031114_create_m_barang_jadies_table', 1),
(12, '2023_03_26_031133_create_m_stocks_table', 1),
(13, '2023_03_26_031141_create_m_karyawans_table', 1),
(14, '2023_03_26_031152_create_m_asets_table', 1),
(15, '2023_03_26_031203_create_t_spps_table', 1),
(16, '2023_03_26_031205_create_m_film_sablons_table', 1),
(17, '2023_03_26_031232_create_t_spks_table', 1),
(18, '2023_03_26_031240_create_t_jahits_table', 1),
(19, '2023_03_26_031252_create_t_finishings_table', 1),
(20, '2023_03_26_031303_create_t_pemasukans_table', 1),
(21, '2023_03_26_031315_create_t_pengeluarans_table', 1),
(22, '2023_03_26_031326_create_t_gajies_table', 1),
(23, '2023_04_22_184111_add_columns_to_t_spks', 1),
(24, '2023_04_22_190816_add_tanggal_to_t_spks', 1),
(25, '2023_04_24_123723_add_kain_potongan_dipakai_to_t_spks', 1),
(26, '2023_04_24_151900_create_t_spk_files_table', 1),
(27, '2023_04_24_193106_add_remove_spp_id_to_t_spks', 1),
(28, '2023_04_29_150729_add_stok_m_kain_potongans', 1),
(29, '2023_05_04_141030_add_column_to_t_pemasukans', 1),
(30, '2023_05_05_004624_add_columns_to_t_jahits', 1),
(31, '2023_05_05_021611_create_m_kain_tersablons', 1),
(32, '2023_05_05_173438_add_column_to_t_pengeluarans', 1),
(33, '2023_05_10_012050_add_stok_roll_to_m_kain_rolls', 1),
(34, '2023_05_10_020725_add_kode_ukuran_to_m_ukurans', 1),
(35, '2023_05_10_022029_add_remove_kain_roll_id_to_t_spps', 1),
(36, '2023_05_10_023304_change_column_from_t_spps', 1),
(37, '2023_05_22_122019_remove_columns_from_t_spks', 1),
(38, '2023_05_22_123933_add_column_to_t_spks', 1),
(39, '2023_05_27_140809_create_t_spk_details', 2),
(40, '2023_05_27_141329_remove_column_from_t_spks', 2),
(41, '2023_05_27_162603_remove_column_from_t_pemasukans', 3),
(42, '2023_05_27_162700_add_column_from_t_pemasukans', 3),
(44, '2023_05_27_214948_remove_column_from_t_jahits', 4),
(45, '2023_05_27_220253_add_column_from_t_jahits', 5),
(48, '2023_06_01_041356_remove_column_from_t_spps', 1),
(49, '2023_06_04_013825_change_column_from_t_jahits', 6),
(50, '2023_06_04_030323_add_column_from_t_jahits', 7);

-- --------------------------------------------------------

--
-- Table structure for table `m_asets`
--

CREATE TABLE `m_asets` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode` varchar(16) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_barang_jadies`
--

CREATE TABLE `m_barang_jadies` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_barang` int(11) NOT NULL,
  `status` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_film_sablons`
--

CREATE TABLE `m_film_sablons` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `spp_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_gajis`
--

CREATE TABLE `m_gajis` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `gaji` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_gajis`
--

INSERT INTO `m_gajis` (`uuid`, `id`, `gaji`, `created_at`, `updated_at`) VALUES
('3b52986b23264c809818c0d0f7e2e50d', 1, 500, '2023-05-27 09:31:29', '2023-05-27 09:31:29'),
('c3d4be2b151645e59bc8f5a9042b9074', 2, 1000, '2023-05-27 09:31:29', '2023-05-27 09:31:29'),
('43dd79976f4d4876973734b6f09c1a59', 3, 1500, '2023-05-27 09:31:29', '2023-05-27 09:31:29'),
('120defebc3ee4fa29537662456364966', 4, 2000, '2023-05-27 09:31:29', '2023-05-27 09:31:29'),
('4c3d056bc597490cb127f8eebfc48601', 5, 2500, '2023-05-27 09:31:29', '2023-05-27 09:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `m_kain_potongans`
--

CREATE TABLE `m_kain_potongans` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kain_roll_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `ukuran` varchar(8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kain_potongans`
--

INSERT INTO `m_kain_potongans` (`uuid`, `id`, `kain_roll_id`, `stok`, `ukuran`, `created_at`, `updated_at`) VALUES
('094c9d057c4848b69e10e3ca64015c86', 1, 1, 1, 'M', '2023-05-22 05:48:20', '2023-06-02 23:44:07'),
('4958fd3afab94bb89734788ca02005e9', 2, 2, 260, 'M', '2023-05-22 05:48:20', '2023-06-02 23:44:07'),
('00debfa4104e468c93a96e7ed1689088', 3, 3, 70, 'L', '2023-05-22 05:48:20', '2023-06-02 23:44:07'),
('5ad39089893c4405b906b2634bc0f25a', 4, 2, 60, 'S', '2023-05-27 21:56:03', '2023-06-02 23:35:35'),
('5b4446734f55400fb975f7c4a0b31ee1', 5, 2, 980, 'L', '2023-05-27 23:24:55', '2023-05-31 23:17:15'),
('281b4d7f0bf94b29be12a4479fbc6080', 6, 2, 110, 'XL', '2023-05-31 21:25:30', '2023-06-02 23:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `m_kain_rolls`
--

CREATE TABLE `m_kain_rolls` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_lot` varchar(16) NOT NULL,
  `jenis_kain` varchar(255) NOT NULL,
  `stok_roll` int(11) NOT NULL,
  `berat` double(8,2) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kain_rolls`
--

INSERT INTO `m_kain_rolls` (`uuid`, `id`, `kode_lot`, `jenis_kain`, `stok_roll`, `berat`, `warna`, `created_at`, `updated_at`) VALUES
('ac679f8428f54db9a3a2619fbe6091de', 1, 'LOT-0001', 'Katun', 90, 25.00, 'Black', NULL, '2023-05-22 05:48:20'),
('0d74ec9f993043e89300bb2d16464dba', 2, 'LOT-0002', 'Katun', 30, 20.00, 'White', NULL, '2023-06-02 23:50:52'),
('b47597696e974679a720c5df8296781d', 3, 'LOT-0003', 'Katun', 40, 23.00, 'Green', NULL, '2023-05-22 05:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `m_kain_tersablons`
--

CREATE TABLE `m_kain_tersablons` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kain_potongan_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `ukuran` varchar(8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_karyawans`
--

CREATE TABLE `m_karyawans` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(32) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `no_telepon` varchar(16) NOT NULL,
  `npwp` varchar(16) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `status_karyawan` varchar(255) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_karyawans`
--

INSERT INTO `m_karyawans` (`uuid`, `id`, `nama`, `jenis_kelamin`, `nik`, `no_telepon`, `npwp`, `posisi`, `status_karyawan`, `gaji_pokok`, `created_at`, `updated_at`) VALUES
('bdea918e79ec43d6ada8227a67173908', 1, 'Ahmad Chorul', 'Laki-Laki', '01726826182628', '081267254181', '-', 'pemotong', 'Aktif', 0, NULL, NULL),
('0494b63b539c4a228d71815d4f67f08f', 2, 'Juni Syahrul', 'Laki-Laki', '316272518261', '08571627251', '-', 'pemotong', 'Aktif', 0, NULL, NULL),
('9b4c9c9cf8cf44d897daed8d5d5d5b08', 3, 'Sablon 1', 'Laki-Laki', '01726826182628', '081267254181', '-', 'sablon', 'Aktif', 0, NULL, NULL),
('95a6d7ae9fc845888247f4bf3d9eb150', 4, 'Sablon 2', 'Laki-Laki', '01726826182628', '081267254181', '-', 'sablon', 'Aktif', 0, NULL, NULL),
('764ae639d6c14a75aba9cdacd6f6731f', 5, 'Jahit 1', 'Laki-Laki', '01726826182628', '081267254181', '-', 'jahit', 'Aktif', 0, NULL, NULL),
('70d9651551984b87b58eaec7b95331b5', 6, 'Jahit 2', 'Laki-Laki', '01726826182628', '081267254181', '-', 'jahit', 'Aktif', 0, NULL, NULL),
('29e65c18281e480bb8825bd5e3534668', 7, 'Finishing 1', 'Laki-Laki', '01726826182628', '081267254181', '-', 'finishing', 'Aktif', 0, NULL, NULL),
('613a448fad98484eadd09ac6d2a92934', 8, 'Finishing 2', 'Laki-Laki', '01726826182628', '081267254181', '-', 'finishing', 'Aktif', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_perlengkapans`
--

CREATE TABLE `m_perlengkapans` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `total_stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_stocks`
--

CREATE TABLE `m_stocks` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kain_roll_id` bigint(20) UNSIGNED NOT NULL,
  `kain_potongan_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_ukurans`
--

CREATE TABLE `m_ukurans` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_ukuran` varchar(8) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_ukurans`
--

INSERT INTO `m_ukurans` (`uuid`, `id`, `kode_ukuran`, `ukuran`, `created_at`, `updated_at`) VALUES
('55292fe6a3e246568790d533869e0afa', 1, 'S', 'Small', NULL, NULL),
('73de9f9af0dd4822a14f016350f7da24', 2, 'M', 'Medium', NULL, NULL),
('a3b9d25538fc4147a2b3751ca4a185d1', 3, 'L', 'Large', NULL, NULL),
('501bc4b64a4d48e2a5b3e3de633e6024', 4, 'XL', 'Extra Large', NULL, NULL),
('c03cdc55b96f43d4bca49a6615c3253d', 5, 'XXL', 'Extra Extra Large', NULL, NULL),
('08bfdb975ae0495285f19309fc4cee19', 6, 'B', 'Besar', '2023-05-27 23:51:51', '2023-05-27 23:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Owner', NULL, NULL),
(2, 'Admin', NULL, NULL),
(3, 'Warehouse', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_finishings`
--

CREATE TABLE `t_finishings` (
  `uuid` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `jahit_id` bigint(20) UNSIGNED NOT NULL,
  `kode_finishing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `karyawan_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `jumlah_finishing` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_gajies`
--

CREATE TABLE `t_gajies` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `gaji` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_gajies`
--

INSERT INTO `t_gajies` (`uuid`, `id`, `kode_transaksi`, `karyawan_id`, `gaji`, `created_at`, `updated_at`) VALUES
('', 1, 'SPP|2023-05-22|1', 1, 100000, '2023-05-22 05:48:20', '2023-05-22 05:48:20'),
('', 2, 'SPP|2023-05-22|1', 2, 100000, '2023-05-22 05:48:20', '2023-05-22 05:48:20'),
('', 3, 'SPP|2023-05-22|1', 1, 200000, '2023-05-22 05:48:20', '2023-05-22 05:48:20'),
('', 4, 'SPP|2023-05-22|1', 2, 200000, '2023-05-22 05:48:20', '2023-05-22 05:48:20'),
('', 5, 'SPP|2023-05-22|1', 1, 160000, '2023-05-22 05:48:20', '2023-05-22 05:48:20'),
('', 6, 'SPP|2023-05-22|1', 2, 160000, '2023-05-22 05:48:20', '2023-05-22 05:48:20'),
('', 7, 'SPK|2023-05-22|1', 3, 100000, '2023-05-22 07:58:18', '2023-05-22 07:58:18'),
('', 8, 'SPK|2023-05-22|1', 4, 100000, '2023-05-22 07:58:18', '2023-05-22 07:58:18'),
('', 9, 'SPK|2023-05-22|1', 3, 600000, '2023-05-22 07:58:18', '2023-05-22 07:58:18'),
('', 10, 'SPK|2023-05-22|1', 4, 600000, '2023-05-22 07:58:18', '2023-05-22 07:58:18'),
('', 11, 'SPK|2023-05-22|1', 3, 80000, '2023-05-22 07:58:18', '2023-05-22 07:58:18'),
('', 12, 'SPK|2023-05-22|1', 4, 80000, '2023-05-22 07:58:18', '2023-05-22 07:58:18'),
('', 13, 'SPK|2023-05-22|1', 3, 80000, '2023-05-22 08:43:54', '2023-05-22 08:43:54'),
('', 14, 'SPK|2023-05-22|1', 4, 80000, '2023-05-22 08:43:54', '2023-05-22 08:43:54'),
('', 19, 'SPK|2023-05-27|2', 3, 2500, '2023-05-27 08:40:44', '2023-05-27 08:40:44'),
('', 20, 'SPK|2023-05-27|2', 4, 2500, '2023-05-27 08:40:44', '2023-05-27 08:40:44'),
('', 25, 'SPK|2023-05-27|2', 3, 500, '2023-05-27 08:51:04', '2023-05-27 08:51:04'),
('', 26, 'SPK|2023-05-27|2', 3, 500, '2023-05-27 08:51:04', '2023-05-27 08:51:04'),
('', 27, 'SPK|2023-05-27|2', 4, 1000, '2023-05-27 08:51:04', '2023-05-27 08:51:04'),
('', 28, 'SPK|2023-05-27|2', 3, 1000, '2023-05-27 08:51:04', '2023-05-27 08:51:04'),
('', 41, 'SPP|2023-05-28|1', 1, 90000, '2023-05-27 21:56:03', '2023-05-27 21:56:03'),
('', 42, 'SPP|2023-05-28|1', 2, 90000, '2023-05-27 21:56:03', '2023-05-27 21:56:03'),
('', 43, 'SPP|2023-05-28|2', 1, 1000000, '2023-05-27 23:24:55', '2023-05-27 23:24:55'),
('', 44, 'SPP|2023-05-28|2', 2, 1000000, '2023-05-27 23:24:55', '2023-05-27 23:24:55'),
('', 45, 'SPK|2023-05-28|1', 3, 20000, '2023-05-27 23:30:36', '2023-05-27 23:30:36'),
('', 46, 'SPK|2023-05-28|1', 4, 20000, '2023-05-27 23:30:36', '2023-05-27 23:30:36'),
('', 47, 'SPK|2023-05-28|1', 3, 10000, '2023-05-27 23:30:36', '2023-05-27 23:30:36'),
('', 48, 'SPK|2023-05-28|1', 4, 10000, '2023-05-27 23:30:36', '2023-05-27 23:30:36'),
('', 49, 'SPP|2023-06-01|1', 1, 50000, '2023-05-31 21:25:30', '2023-06-02 23:50:52'),
('', 50, 'SPP|2023-06-01|1', 2, 50000, '2023-05-31 21:25:30', '2023-06-02 23:50:52'),
('', 79, 'SPK|2023-06-03|1', 3, 38000, '2023-06-02 23:36:27', '2023-06-02 23:36:27'),
('', 80, 'SPK|2023-06-03|1', 4, 38000, '2023-06-02 23:36:27', '2023-06-02 23:36:27'),
('', 81, 'SPK|2023-06-03|1', 4, 75000, '2023-06-02 23:36:27', '2023-06-02 23:36:27'),
('', 82, 'SPK|2023-06-03|1', 4, 75000, '2023-06-02 23:36:27', '2023-06-02 23:36:27'),
('', 83, 'JAHIT|2023-06-04|1', 5, 57000, '2023-06-03 22:19:34', '2023-06-03 22:19:34'),
('', 84, 'JAHIT|2023-06-04|1', 6, 57000, '2023-06-03 22:19:34', '2023-06-03 22:19:34'),
('', 85, 'JAHIT|2023-06-04|2', 5, 50000, '2023-06-03 22:21:43', '2023-06-03 22:21:43'),
('', 86, 'JAHIT|2023-06-04|2', 6, 50000, '2023-06-03 22:21:43', '2023-06-03 22:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `t_jahits`
--

CREATE TABLE `t_jahits` (
  `uuid` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_spk_id` bigint(20) UNSIGNED NOT NULL,
  `kode_spk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_jahit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `artikel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_jahit` int(11) NOT NULL,
  `satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `karyawan_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`karyawan_id`)),
  `karyawan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`karyawan`)),
  `gaji` int(11) NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_jahits`
--

INSERT INTO `t_jahits` (`uuid`, `id`, `detail_spk_id`, `kode_spk`, `kode_jahit`, `artikel`, `tanggal`, `jumlah_jahit`, `satuan`, `karyawan_id`, `karyawan`, `gaji`, `note`, `status`, `created_at`, `updated_at`) VALUES
('5e8be3f3b3f940268bbc887d7350a1b6', 3, 30, 'SPK|2023-06-03|1', 'JAHIT|2023-06-04|1', 'M44359', '2023-06-04', 38, 'PCS', '[\"764ae639d6c14a75aba9cdacd6f6731f\",\"70d9651551984b87b58eaec7b95331b5\"]', '[\"Jahit 1\",\"Jahit 2\"]', 1500, 'Test', 'Belum Menentukan Karyawan', '2023-06-03 20:16:26', '2023-06-03 22:19:34'),
('9e297996b4f6444b93312e2f03adc75d', 4, 31, 'SPK|2023-06-03|1', 'JAHIT|2023-06-04|2', 'M44359', '2023-06-04', 50, 'PCS', '[\"764ae639d6c14a75aba9cdacd6f6731f\",\"70d9651551984b87b58eaec7b95331b5\"]', '[\"Jahit 1\",\"Jahit 2\"]', 1000, 'Mantap', 'Belum Konfirmasi', '2023-06-03 20:16:26', '2023-06-03 22:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `t_pemasukans`
--

CREATE TABLE `t_pemasukans` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_pemasukan` varchar(255) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `total_uang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_pemasukans`
--

INSERT INTO `t_pemasukans` (`uuid`, `id`, `kode_pemasukan`, `metode_pembayaran`, `total_uang`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
('07e4bef142394d3f9ed0d7f0dd9b370f', 1, 'INV.27.May.2023.1', 'Transfer', 200000, '2023-05-27', 'Terkonfirmasi', '2023-05-27 09:31:29', '2023-05-27 10:35:44'),
('572c949d72f544d1adb7e6472efc1d17', 2, 'INV.27.May.2023.1', 'Tunai/Cash', 300000, '2023-05-27', 'Terkonfirmasi', '2023-05-27 09:31:29', '2023-05-27 10:35:44'),
('34af63e0c5be496983dc49ff119d5437', 3, 'INV.27.May.2023.1', 'Transfer', 250000, '2023-05-27', 'Terkonfirmasi', '2023-05-27 09:35:59', '2023-05-27 10:35:44'),
('b4d14752fb7e4c5ea161a397bbacbf91', 4, 'INV.27.May.2023.1', 'Transfer', 200500, '2023-05-27', 'Terkonfirmasi', '2023-05-27 09:35:59', '2023-05-27 10:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `t_pengeluarans`
--

CREATE TABLE `t_pengeluarans` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_pengeluaran` varchar(255) NOT NULL,
  `jenis_pengeluaran` varchar(255) NOT NULL,
  `keperluan` text NOT NULL,
  `total_uang` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_pengeluarans`
--

INSERT INTO `t_pengeluarans` (`uuid`, `id`, `kode_pengeluaran`, `jenis_pengeluaran`, `keperluan`, `total_uang`, `keterangan`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
('28687929a0714474adb07b3b0efa08e5', 1, 'INV-OUT.28.May.2023.1', 'Sablon', 'test', 200000, 'test', '2023-05-28', 'Belum Konfirmasi', '2023-05-27 23:43:12', '2023-05-27 23:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `t_spks`
--

CREATE TABLE `t_spks` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_spk` varchar(255) NOT NULL,
  `artikel` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_spks`
--

INSERT INTO `t_spks` (`uuid`, `id`, `kode_spk`, `artikel`, `tanggal`, `ukuran`, `note`, `status`, `created_at`, `updated_at`) VALUES
('f5260f7c4642432297a14e5030ecd227', 53, 'SPK|2023-05-28|1', 'L1035249113', '2023-05-28', 'L', 'Testing', 'Selesai Dikerjakan', '2023-05-27 23:30:36', '2023-05-27 23:32:59'),
('a831cd65b66447249484a9471df4d89d', 65, 'SPK|2023-06-03|1', 'M44359', '2023-06-03', 'M', NULL, 'Selesai Dikerjakan', '2023-06-02 23:36:27', '2023-06-03 20:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `t_spk_details`
--

CREATE TABLE `t_spk_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `t_spk_id` bigint(20) UNSIGNED NOT NULL,
  `kode_spk` varchar(255) NOT NULL,
  `kain_potongan_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `satuan` varchar(32) NOT NULL,
  `karyawan_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`karyawan_id`)),
  `karyawan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`karyawan`)),
  `gaji` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_spk_details`
--

INSERT INTO `t_spk_details` (`id`, `t_spk_id`, `kode_spk`, `kain_potongan_id`, `quantity`, `satuan`, `karyawan_id`, `karyawan`, `gaji`, `created_at`, `updated_at`) VALUES
(14, 53, 'SPK|2023-05-28|1', 3, 20, 'PCS', '[\"9b4c9c9cf8cf44d897daed8d5d5d5b08\",\"95a6d7ae9fc845888247f4bf3d9eb150\"]', '[\"Sablon 1\",\"Sablon 2\"]', 1000, NULL, NULL),
(15, 53, 'SPK|2023-05-28|1', 5, 20, 'PCS', '[\"9b4c9c9cf8cf44d897daed8d5d5d5b08\",\"95a6d7ae9fc845888247f4bf3d9eb150\"]', '[\"Sablon 1\",\"Sablon 2\"]', 500, NULL, NULL),
(30, 65, 'SPK|2023-06-03|1', 1, 38, 'PCS', '[\"9b4c9c9cf8cf44d897daed8d5d5d5b08\",\"95a6d7ae9fc845888247f4bf3d9eb150\"]', '[\"Sablon 1\",\"Sablon 2\"]', 1000, NULL, NULL),
(31, 65, 'SPK|2023-06-03|1', 2, 50, 'PCS', '[\"95a6d7ae9fc845888247f4bf3d9eb150\",\"95a6d7ae9fc845888247f4bf3d9eb150\"]', '[\"Sablon 2\",\"Sablon 2\"]', 1500, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_spk_files`
--

CREATE TABLE `t_spk_files` (
  `uuid` varchar(32) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_spk` varchar(255) NOT NULL,
  `nama_foto` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_spk_files`
--

INSERT INTO `t_spk_files` (`uuid`, `id`, `kode_spk`, `nama_foto`, `created_at`, `updated_at`) VALUES
('96ff48ce2c644f75bd8d24db95206482', 7, 'SPK|2023-05-28|1', '168525547374.jpg', '2023-05-27 23:31:13', '2023-05-27 23:31:13'),
('52e567cee07e49baa994e49017882d0e', 10, 'SPK|2023-06-03|1', '168577756879.jpg', '2023-06-03 00:32:48', '2023-06-03 00:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `t_spps`
--

CREATE TABLE `t_spps` (
  `uuid` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_spp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kain_roll_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `karyawan_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `tanggal` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `hasil_potongan` int(11) DEFAULT NULL,
  `karyawan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `gaji` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_spps`
--

INSERT INTO `t_spps` (`uuid`, `id`, `kode_spp`, `kain_roll_id`, `ukuran`, `karyawan_id`, `tanggal`, `quantity`, `hasil_potongan`, `karyawan`, `gaji`, `status`, `note`, `created_at`, `updated_at`) VALUES
('8be8f4484b2a4690b5716b1951f40ed1', 1, 'SPP|2023-05-22|1', 1, 'M', '[\"bdea918e79ec43d6ada8227a67173908\",\"0494b63b539c4a228d71815d4f67f08f\"]', '2023-05-22', 10, 100, '[\"Ahmad Chorul\",\"Juni Syahrul\"]', 1000, 'Belum Konfirmasi', NULL, '2023-05-22 05:48:20', '2023-05-22 05:48:20'),
('b62ee645009e468d8f9733edfdd14671', 2, 'SPP|2023-05-22|1', 2, 'M', '[\"bdea918e79ec43d6ada8227a67173908\",\"0494b63b539c4a228d71815d4f67f08f\"]', '2023-05-22', 20, 400, '[\"Ahmad Chorul\",\"Juni Syahrul\"]', 500, 'Belum Konfirmasi', NULL, '2023-05-22 05:48:20', '2023-05-22 05:48:20'),
('f33937d326364ff09aa523f11807fe98', 3, 'SPP|2023-05-22|1', 3, 'L', '[\"bdea918e79ec43d6ada8227a67173908\",\"0494b63b539c4a228d71815d4f67f08f\"]', '2023-05-22', 10, 80, '[\"Ahmad Chorul\",\"Juni Syahrul\"]', 2000, 'Belum Konfirmasi', NULL, '2023-05-22 05:48:20', '2023-05-22 05:48:20'),
('5d0504273cb64c81803062b116cad976', 5, 'SPP|2023-05-28|2', 2, 'L', '[\"bdea918e79ec43d6ada8227a67173908\",\"0494b63b539c4a228d71815d4f67f08f\"]', '2023-05-28', 50, 1000, '[\"Ahmad Chorul\",\"Juni Syahrul\"]', 1000, 'Belum Konfirmasi', 'Testing', '2023-05-27 23:24:55', '2023-05-27 23:24:55'),
('fb0f43f57ebc488ba4e205d3a49b70b6', 6, 'SPP|2023-06-01|1', 2, 'XL', '[\"bdea918e79ec43d6ada8227a67173908\",\"0494b63b539c4a228d71815d4f67f08f\"]', '2023-06-01', 100, 50, '[\"Ahmad Chorul\",\"Juni Syahrul\"]', 1000, 'Belum Konfirmasi', 'Testing', '2023-05-31 21:25:30', '2023-06-02 23:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `_token` text DEFAULT NULL,
  `remember` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `_token`, `remember`, `created_at`, `updated_at`) VALUES
(1, 1, 'owner', 'owner@gmail.com', 'owner', NULL, NULL, '$2y$10$/B4QaNO5Av5YDcE1M3wMuugr0rb061Fu6zfVOsNwvIxf78DcuY1yi', NULL, NULL, NULL, '2023-05-22 05:45:58', '2023-05-22 05:45:58'),
(2, 2, 'admin', 'admin@gmail.com', 'admin', NULL, NULL, '$2y$10$AYgA9ajGNNStTs655EmrEeWEruYajTWzYbe935d7y8MDuSDRYTSZy', NULL, NULL, NULL, '2023-05-22 05:45:58', '2023-05-22 05:45:58'),
(3, 3, 'warehouse', 'warehouse@gmail.com', 'warehouse', NULL, NULL, '$2y$10$8Rt4fzSx./Zz2Za3WsmAIePwujHiSfVnW4fnN8g8P0WqswiG5.FwW', NULL, NULL, NULL, '2023-05-22 05:45:58', '2023-05-22 05:45:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_asets`
--
ALTER TABLE `m_asets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_barang_jadies`
--
ALTER TABLE `m_barang_jadies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_film_sablons`
--
ALTER TABLE `m_film_sablons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_film_sablons_spp_id_foreign` (`spp_id`);

--
-- Indexes for table `m_gajis`
--
ALTER TABLE `m_gajis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kain_potongans`
--
ALTER TABLE `m_kain_potongans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_kain_potongans_kain_roll_id_foreign` (`kain_roll_id`);

--
-- Indexes for table `m_kain_rolls`
--
ALTER TABLE `m_kain_rolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kain_tersablons`
--
ALTER TABLE `m_kain_tersablons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_kain_tersablons_kain_potongan_id_foreign` (`kain_potongan_id`);

--
-- Indexes for table `m_karyawans`
--
ALTER TABLE `m_karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_perlengkapans`
--
ALTER TABLE `m_perlengkapans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_stocks`
--
ALTER TABLE `m_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_stocks_kain_roll_id_foreign` (`kain_roll_id`),
  ADD KEY `m_stocks_kain_potongan_id_foreign` (`kain_potongan_id`);

--
-- Indexes for table `m_ukurans`
--
ALTER TABLE `m_ukurans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_ukurans_kode_ukuran_unique` (`kode_ukuran`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_finishings`
--
ALTER TABLE `t_finishings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_finishings_jahit_id_foreign` (`jahit_id`);

--
-- Indexes for table `t_gajies`
--
ALTER TABLE `t_gajies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_gajies_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `t_jahits`
--
ALTER TABLE `t_jahits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_spk_id` (`detail_spk_id`);

--
-- Indexes for table `t_pemasukans`
--
ALTER TABLE `t_pemasukans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pengeluarans`
--
ALTER TABLE `t_pengeluarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_spks`
--
ALTER TABLE `t_spks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_spk_details`
--
ALTER TABLE `t_spk_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_spk_details_t_spk_id_foreign` (`t_spk_id`),
  ADD KEY `t_spk_details_kain_potongan_id_foreign` (`kain_potongan_id`);

--
-- Indexes for table `t_spk_files`
--
ALTER TABLE `t_spk_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_spps`
--
ALTER TABLE `t_spps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_spps_kain_roll_id_foreign` (`kain_roll_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `m_asets`
--
ALTER TABLE `m_asets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_barang_jadies`
--
ALTER TABLE `m_barang_jadies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_film_sablons`
--
ALTER TABLE `m_film_sablons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_gajis`
--
ALTER TABLE `m_gajis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_kain_potongans`
--
ALTER TABLE `m_kain_potongans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_kain_rolls`
--
ALTER TABLE `m_kain_rolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_kain_tersablons`
--
ALTER TABLE `m_kain_tersablons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_karyawans`
--
ALTER TABLE `m_karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_perlengkapans`
--
ALTER TABLE `m_perlengkapans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_stocks`
--
ALTER TABLE `m_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_ukurans`
--
ALTER TABLE `m_ukurans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_finishings`
--
ALTER TABLE `t_finishings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_gajies`
--
ALTER TABLE `t_gajies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `t_jahits`
--
ALTER TABLE `t_jahits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_pemasukans`
--
ALTER TABLE `t_pemasukans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_pengeluarans`
--
ALTER TABLE `t_pengeluarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_spks`
--
ALTER TABLE `t_spks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `t_spk_details`
--
ALTER TABLE `t_spk_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `t_spk_files`
--
ALTER TABLE `t_spk_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_spps`
--
ALTER TABLE `t_spps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_film_sablons`
--
ALTER TABLE `m_film_sablons`
  ADD CONSTRAINT `m_film_sablons_spp_id_foreign` FOREIGN KEY (`spp_id`) REFERENCES `t_spps` (`id`);

--
-- Constraints for table `m_kain_potongans`
--
ALTER TABLE `m_kain_potongans`
  ADD CONSTRAINT `m_kain_potongans_kain_roll_id_foreign` FOREIGN KEY (`kain_roll_id`) REFERENCES `m_kain_rolls` (`id`);

--
-- Constraints for table `m_kain_tersablons`
--
ALTER TABLE `m_kain_tersablons`
  ADD CONSTRAINT `m_kain_tersablons_kain_potongan_id_foreign` FOREIGN KEY (`kain_potongan_id`) REFERENCES `m_kain_potongans` (`id`);

--
-- Constraints for table `m_stocks`
--
ALTER TABLE `m_stocks`
  ADD CONSTRAINT `m_stocks_kain_potongan_id_foreign` FOREIGN KEY (`kain_potongan_id`) REFERENCES `m_kain_potongans` (`id`),
  ADD CONSTRAINT `m_stocks_kain_roll_id_foreign` FOREIGN KEY (`kain_roll_id`) REFERENCES `m_kain_rolls` (`id`);

--
-- Constraints for table `t_finishings`
--
ALTER TABLE `t_finishings`
  ADD CONSTRAINT `t_finishings_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `t_jahits` (`id`);

--
-- Constraints for table `t_gajies`
--
ALTER TABLE `t_gajies`
  ADD CONSTRAINT `t_gajies_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `m_karyawans` (`id`);

--
-- Constraints for table `t_jahits`
--
ALTER TABLE `t_jahits`
  ADD CONSTRAINT `t_jahits_kain_potongan_id_foreign` FOREIGN KEY (`detail_spk_id`) REFERENCES `t_spk_details` (`id`);

--
-- Constraints for table `t_spk_details`
--
ALTER TABLE `t_spk_details`
  ADD CONSTRAINT `t_spk_details_kain_potongan_id_foreign` FOREIGN KEY (`kain_potongan_id`) REFERENCES `m_kain_potongans` (`id`),
  ADD CONSTRAINT `t_spk_details_t_spk_id_foreign` FOREIGN KEY (`t_spk_id`) REFERENCES `t_spks` (`id`);

--
-- Constraints for table `t_spps`
--
ALTER TABLE `t_spps`
  ADD CONSTRAINT `t_spps_kain_roll_id_foreign` FOREIGN KEY (`kain_roll_id`) REFERENCES `m_kain_rolls` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
