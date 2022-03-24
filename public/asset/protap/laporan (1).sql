-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 11:01 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahanbakus`
--

CREATE TABLE `bahanbakus` (
  `bahanbaku_id` bigint(20) UNSIGNED NOT NULL,
  `bahanbaku_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bahanbaku_kode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluars`
--

CREATE TABLE `barangkeluars` (
  `barangkeluar_id` bigint(20) UNSIGNED NOT NULL,
  `barangkeluar_tgl` date NOT NULL,
  `barangkeluar_utkproduk` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangkeluar_nobatch` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangkeluar_jumlah` int(11) NOT NULL,
  `barangkeluar_sisa` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuks`
--

CREATE TABLE `barangmasuks` (
  `barangmasuk_id` bigint(20) UNSIGNED NOT NULL,
  `barangmasuk_tgl` date NOT NULL,
  `barangmasuk_noloth` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangmasuk_pemasok` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangmasuk_jumlah` int(11) NOT NULL,
  `barangmasuk_nokontrol` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangmasuk_kadaluarsa` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catatbersihs`
--

CREATE TABLE `catatbersihs` (
  `catatbersih_id` bigint(20) UNSIGNED NOT NULL,
  `catatbersih_produk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatbersih_batchnum` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatbersih_prosedurnum` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatbersih_namaruang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatbersih_carabersih` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatbersih_pelaksana` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatbersih_periksa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatbersih_lantaidinding` tinyint(1) NOT NULL,
  `catatbersih_meja` tinyint(1) NOT NULL,
  `catatbersih_jendela` tinyint(1) NOT NULL,
  `catatbersih_plafon` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coas`
--

CREATE TABLE `coas` (
  `coa_id` bigint(20) UNSIGNED NOT NULL,
  `coa_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coa_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `company_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_telepon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_logo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dips`
--

CREATE TABLE `dips` (
  `dip_id` bigint(20) UNSIGNED NOT NULL,
  `dip_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dip_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `kemasans`
--

CREATE TABLE `kemasans` (
  `kemasan_id` bigint(20) UNSIGNED NOT NULL,
  `kemasan_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komposisis`
--

CREATE TABLE `komposisis` (
  `komposisi_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kompisisi_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komposisi_persen` int(11) NOT NULL,
  `nomor_batch` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `laporan_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laporan_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(131, '2014_10_12_000000_create_users_table', 1),
(132, '2014_10_12_100000_create_password_resets_table', 1),
(133, '2019_08_19_000000_create_failed_jobs_table', 1),
(134, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(135, '2022_02_15_011428_create_coas_table', 1),
(136, '2022_02_15_013027_create_dips_table', 1),
(137, '2022_02_15_013043_create_laporans_table', 1),
(138, '2022_02_15_013106_create_perizinans_table', 1),
(139, '2022_02_15_013127_create_pobpabriks_table', 1),
(140, '2022_02_15_013151_create_pengolahanbatches_table', 1),
(141, '2022_02_15_013209_create_penerimaanbbs_table', 1),
(142, '2022_02_15_094656_create_komposisis_table', 1),
(143, '2022_02_15_094830_create_peralatans_table', 1),
(144, '2022_02_15_094846_create_penimbangans_table', 1),
(145, '2022_02_15_100252_create_catatbersihs_table', 1),
(146, '2022_02_15_100424_create_barangmasuks_table', 1),
(147, '2022_02_15_100435_create_barangkeluars_table', 1),
(148, '2022_02_18_024533_create_produks_table', 1),
(149, '2022_02_18_024657_create_kemasans_table', 1),
(150, '2022_02_18_024717_create_bahanbakus_table', 1),
(151, '2022_02_18_024942_create_companies_table', 1),
(152, '2022_03_18_184814_create_pabriks_table', 1),
(153, '2022_03_23_164014_create_protaps_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pabriks`
--

CREATE TABLE `pabriks` (
  `pabrik_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `penerimaanbbs`
--

CREATE TABLE `penerimaanbbs` (
  `penerimaanbb` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerimaanbb_produk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerimaanbb_pobnom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengolahanbatches`
--

CREATE TABLE `pengolahanbatches` (
  `batch` bigint(20) UNSIGNED NOT NULL,
  `pob` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_batch` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `besar_batch` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bentuk_sedia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kemasan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penimbangans`
--

CREATE TABLE `penimbangans` (
  `penimbangan_id` bigint(20) UNSIGNED NOT NULL,
  `penimbangan_kodebahan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penimbangan_namabahan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penimbangan_loth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penimbangan_jumlahbutuh` int(11) NOT NULL,
  `penimbangan_jumlahtimbang` int(11) NOT NULL,
  `penimbangan_timbangoleh` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penimbangan_periksaoleh` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_batch` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peralatans`
--

CREATE TABLE `peralatans` (
  `peralatan_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peralatan_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_batch` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perizinans`
--

CREATE TABLE `perizinans` (
  `perizinan_id` bigint(20) UNSIGNED NOT NULL,
  `perizinan_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perizinan_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pobpabriks`
--

CREATE TABLE `pobpabriks` (
  `pobpabrik_id` bigint(20) UNSIGNED NOT NULL,
  `pobpabrik_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pobpabrik_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `produk_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk_kode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `protaps`
--

CREATE TABLE `protaps` (
  `protap_id` bigint(20) UNSIGNED NOT NULL,
  `protap_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `protap_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `protap_pabrik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `protap_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `protaps`
--

INSERT INTO `protaps` (`protap_id`, `protap_nama`, `protap_file`, `protap_pabrik`, `protap_jenis`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Reza', '2022_03_23_1648052507_create_catatbersihs_table.php', '0', '1', 1, NULL, NULL),
(2, 'Reza', '2022_03_23_1648052507_create_catatbersihs_table.php', '0', '1', 1, NULL, NULL),
(3, 'Reza', '2022_03_23_1648052507_create_catatbersihs_table.php', '0', '1', 1, NULL, NULL),
(4, 'Reza', '2022_03_23_1648052507_create_catatbersihs_table.php', '0', '1', 1, NULL, NULL),
(5, 'Reza', '2022_03_23_1648052507_create_catatbersihs_table.php', '0', '1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namadepan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namabelakang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `pabrik` int(11) NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `namadepan`, `namabelakang`, `level`, `pabrik`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ab', 'A', 'B', 2, 0, '$2y$10$gx5DSaLuANDMMsKAkj21geUAGnlgKIYWYBfR.JkT4YdADhCHNhFc.', NULL, '2022-03-23 09:48:51', '2022-03-23 09:48:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahanbakus`
--
ALTER TABLE `bahanbakus`
  ADD PRIMARY KEY (`bahanbaku_id`);

--
-- Indexes for table `barangkeluars`
--
ALTER TABLE `barangkeluars`
  ADD PRIMARY KEY (`barangkeluar_id`);

--
-- Indexes for table `barangmasuks`
--
ALTER TABLE `barangmasuks`
  ADD PRIMARY KEY (`barangmasuk_id`);

--
-- Indexes for table `catatbersihs`
--
ALTER TABLE `catatbersihs`
  ADD PRIMARY KEY (`catatbersih_id`);

--
-- Indexes for table `coas`
--
ALTER TABLE `coas`
  ADD PRIMARY KEY (`coa_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `dips`
--
ALTER TABLE `dips`
  ADD PRIMARY KEY (`dip_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kemasans`
--
ALTER TABLE `kemasans`
  ADD PRIMARY KEY (`kemasan_id`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`laporan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pabriks`
--
ALTER TABLE `pabriks`
  ADD PRIMARY KEY (`pabrik_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengolahanbatches`
--
ALTER TABLE `pengolahanbatches`
  ADD PRIMARY KEY (`batch`);

--
-- Indexes for table `penimbangans`
--
ALTER TABLE `penimbangans`
  ADD PRIMARY KEY (`penimbangan_id`);

--
-- Indexes for table `perizinans`
--
ALTER TABLE `perizinans`
  ADD PRIMARY KEY (`perizinan_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pobpabriks`
--
ALTER TABLE `pobpabriks`
  ADD PRIMARY KEY (`pobpabrik_id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `protaps`
--
ALTER TABLE `protaps`
  ADD PRIMARY KEY (`protap_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahanbakus`
--
ALTER TABLE `bahanbakus`
  MODIFY `bahanbaku_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangkeluars`
--
ALTER TABLE `barangkeluars`
  MODIFY `barangkeluar_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangmasuks`
--
ALTER TABLE `barangmasuks`
  MODIFY `barangmasuk_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catatbersihs`
--
ALTER TABLE `catatbersihs`
  MODIFY `catatbersih_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coas`
--
ALTER TABLE `coas`
  MODIFY `coa_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dips`
--
ALTER TABLE `dips`
  MODIFY `dip_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kemasans`
--
ALTER TABLE `kemasans`
  MODIFY `kemasan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `laporan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `pabriks`
--
ALTER TABLE `pabriks`
  MODIFY `pabrik_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengolahanbatches`
--
ALTER TABLE `pengolahanbatches`
  MODIFY `batch` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penimbangans`
--
ALTER TABLE `penimbangans`
  MODIFY `penimbangan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perizinans`
--
ALTER TABLE `perizinans`
  MODIFY `perizinan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pobpabriks`
--
ALTER TABLE `pobpabriks`
  MODIFY `pobpabrik_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `produk_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `protaps`
--
ALTER TABLE `protaps`
  MODIFY `protap_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
