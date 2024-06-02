-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Jun 2024 pada 11.25
-- Versi server: 5.7.33
-- Versi PHP: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:5:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:3:\"hse\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:6:\"kabeng\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"kapro\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:3:\"spv\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}}s:5:\"roles\";a:5:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:3:\"hse\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:6:\"kabeng\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"kapro\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:3:\"spv\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}}}', 1717413035);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_19_142531_create_permission_tables', 1),
(5, '2024_05_20_155628_create_ptws_table', 1),
(6, '2024_05_20_160103_create_projects_table', 1),
(7, '2024_05_20_160642_create_work_locations_table', 1),
(8, '2024_05_20_160702_create_permission_types_table', 1),
(9, '2024_05_20_160712_create_tools_types_table', 1),
(10, '2024_05_21_154847_create_ptw_permissions_table', 1),
(11, '2024_05_21_154856_create_ptw_tools_table', 1),
(12, '2024_05_26_073146_create_permission_tambahans_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'hse', 'web', '2024-06-02 04:10:10', '2024-06-02 04:10:10'),
(2, 'kabeng', 'web', '2024-06-02 04:10:11', '2024-06-02 04:10:11'),
(3, 'kapro', 'web', '2024-06-02 04:10:11', '2024-06-02 04:10:11'),
(4, 'spv', 'web', '2024-06-02 04:10:11', '2024-06-02 04:10:11'),
(5, 'admin', 'web', '2024-06-02 04:10:11', '2024-06-02 04:10:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_tambahans`
--

CREATE TABLE `permission_tambahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_tambahans`
--

INSERT INTO `permission_tambahans` (`id`, `permission_type_id`, `permission_name`, `created_at`, `updated_at`) VALUES
(1, '6', 'APAKAH KONDISI PELAKSANA DALAM KEADAAN SEHAT?', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(2, '6', 'APAKAH HANDRAIL TELAH DIPASANG UNTUK MENCEGAH TERJATUH?', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(3, '6', 'APAKAH BAGIAN TERBUKA DARI PERANCAH DAN LANTAI KERJA TELAH DILINDUNGI/DITUTUP?', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(4, '6', 'APAKAH FULL BODY HARNESS DALAM KONDISI YANG BAIK?', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(5, '6', 'APAKAH PEKERJA TELAH MENGGUNAKAAN SEPATU KESELAMATAN DENGAN LAPISAN ANTI SLIP?', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(6, '6', 'APAKAH ORANG YANG BEKERJA DI KETINGGIAN TELAH MENGGUNAKAN SABUK PENGAMAN (FULL BODY HARNESS)?', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(7, '6', 'APAKAH PEKERJA TELAH DIBERIKAN INSTRUKSI CARA PENGIKATAN DAN PEMAKAIAN FULL BODY HARNESS YANG BENAR?', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(8, '6', 'APAKAH HOOK DAN KARABINER PADA FULL BODY HARNESS BERFUNGSI DENGAN BAIK (DAPAT MEMBUKA DAN MENGUNCI)?', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(9, '7', 'PERSONIL YANG BEKERJA DI DAERAH SEKITARNYA DIBERITAHU PEKERJAAN RADIOAKTIF AKAN DILAKUKAN', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(10, '7', 'PAGAR/LAMPU KEDIP-KEDIP TERPASANG HINGGA BATAS DAERAH LARANGAN', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(11, '7', 'SUMBER RADIOAKTIF TIDAK BOLEH DITINGGAL TANPA PENGAWASAN RADIOGRAFER', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(12, '7', 'SUMBER RADIOAKTIF DISIMPAN DI TEMPAT PENYIMPANAN YANG DITENTUKAN BILA TIAK DIGUNAKAN', '2024-06-02 04:10:16', '2024-06-02 04:10:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_types`
--

CREATE TABLE `permission_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_types`
--

INSERT INTO `permission_types` (`id`, `permission_name`, `created_at`, `updated_at`) VALUES
(1, 'KERJA PANAS / HOT WORK', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(2, 'RUANG TERBATAS / CONFINED SPACE', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(3, 'PENGGALIAN / EXCAVATION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(4, 'PEKERJAAN DINGIN / COLD WORK', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(5, 'ISOLASI/LOTO / ISOLATION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(6, 'KERJA DI KETINGGIAN / WORKING AT HEIGHT', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(7, 'TES RADIOGRAFI / X-RAY', '2024-06-02 04:10:14', '2024-06-02 04:10:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `created_at`, `updated_at`) VALUES
(1, 'Barge Mounted Power Plant 2 (BMPP-2)', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(2, 'Barge Mounted Power Plant 3 (BMPP-3)', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(3, 'Single Point Mooring (SPM)', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(4, 'Metso Outotec (METSO)', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(5, 'Dharma Lautan Utama (DLU)', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(6, 'Kapal Bantu Rumah Sakit (BRS)', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(7, 'Kapal Fregat Merah Putih (FMP)', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(8, 'Kapal Landing Platform Dock (LPD)', '2024-06-02 04:10:17', '2024-06-02 04:10:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ptws`
--

CREATE TABLE `ptws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_location_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berlaku_dari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berlaku_sampai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manpower_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rejected_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ptws`
--

INSERT INTO `ptws` (`id`, `project_id`, `permission_id`, `work_location_id`, `level`, `berlaku_dari`, `berlaku_sampai`, `manpower_qty`, `remark`, `status`, `approved_by`, `rejected_by`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1', 'hse', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'hse User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(2, '1', '1', '1', 'kabeng', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kabeng User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(3, '1', '1', '1', 'kapro', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kapro User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(4, '2', '2', '2', 'hse', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'hse User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(5, '2', '2', '2', 'kabeng', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kabeng User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(6, '2', '2', '2', 'kapro', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kapro User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(7, '3', '3', '3', 'hse', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'hse User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(8, '3', '3', '3', 'kabeng', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kabeng User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(9, '3', '3', '3', 'kapro', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kapro User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(10, '4', '4', '4', 'hse', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'hse User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(11, '4', '4', '4', 'kabeng', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kabeng User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(12, '4', '4', '4', 'kapro', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kapro User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(13, '5', '5', '5', 'hse', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'hse User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(14, '5', '5', '5', 'kabeng', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kabeng User', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(15, '5', '5', '5', 'kapro', '2024-05-25', '2024-05-30', '5', 'kerja bolo', '', '', '', 'kapro User', '2024-06-02 04:10:17', '2024-06-02 04:10:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ptw_permissions`
--

CREATE TABLE `ptw_permissions` (
  `ptw_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ptw_tools`
--

CREATE TABLE `ptw_tools` (
  `ptw_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tools_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'hse', 'web', '2024-06-02 04:10:10', '2024-06-02 04:10:10'),
(2, 'kabeng', 'web', '2024-06-02 04:10:11', '2024-06-02 04:10:11'),
(3, 'kapro', 'web', '2024-06-02 04:10:11', '2024-06-02 04:10:11'),
(4, 'spv', 'web', '2024-06-02 04:10:11', '2024-06-02 04:10:11'),
(5, 'admin', 'web', '2024-06-02 04:10:11', '2024-06-02 04:10:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('wwyKVuRR3cvRVdv4thoXyZKiDxvP9gxuDto0GoV7', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNGxrckgycFFXbFpkZzNWOHBKT2tCQ3ZOdE9NdjgzM2N5NG9oZGdzdCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaW5wdXQtYXBkLzYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTcxNzMyNjYzNTt9fQ==', 1717327438);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tools_types`
--

CREATE TABLE `tools_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tools_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tools_types`
--

INSERT INTO `tools_types` (`id`, `permission_type_id`, `tools_name`, `created_at`, `updated_at`) VALUES
(1, '1', 'PELINDUNG KEPALA / HELM PROTECTION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(2, '1', 'PELINDUNG MUKA / FACESHIELD, EYE PROTECTION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(3, '1', 'PELINDUNG TELINGA / EAR PROTECTION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(4, '1', 'PELINDUNG TANGAN / SAFETY GLOVES', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(5, '1', 'PELINDUNG KAKI / SAFETY SHOES', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(6, '1', 'PELINDUNG DI KETINGGIAN / FULL BODY HARNESS', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(7, '1', 'BAJU KERJA / WEARPCAK CATTLEPAK', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(8, '1', 'PENJAGA KEBAKARAN / FIRE WATCHER', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(9, '1', 'DETEKSI GAS BERBAHAYA / GAS DETECTION TEST', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(10, '1', 'ALAT PEMADAM API / FIRE EXTINGUISHER', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(11, '1', 'ALAT BANTU PERNAPASAN / BREATHING APPARATUS', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(12, '1', 'LAINNYA / OTHERS', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(13, '2', 'PELINDUNG KEPALA / HELM PROTECTION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(14, '2', 'PELINDUNG MUKA / FACESHIELD, EYE PROTECTION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(15, '2', 'PELINDUNG TELINGA / EAR PROTECTION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(16, '2', 'PELINDUNG TANGAN / SAFETY GLOVES', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(17, '2', 'PELINDUNG KAKI / SAFETY SHOES', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(18, '2', 'PELINDUNG DI KETINGGIAN / FULL BODY HARNESS', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(19, '2', 'BAJU KERJA / WEARPCAK CATTLEPAK', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(20, '2', 'PENJAGA KEBAKARAN / FIRE WATCHER', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(21, '2', 'DETEKSI GAS BERBAHAYA / GAS DETECTION TEST', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(22, '2', 'ALAT PEMADAM API / FIRE EXTINGUISHER', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(23, '2', 'ALAT BANTU PERNAPASAN / BREATHING APPARATUS', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(24, '2', 'LAINNYA / OTHERS', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(25, '3', 'PELINDUNG KEPALA / HELM PROTECTION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(26, '3', 'PELINDUNG MUKA / FACESHIELD, EYE PROTECTION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(27, '3', 'PELINDUNG TELINGA / EAR PROTECTION', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(28, '3', 'PELINDUNG TANGAN / SAFETY GLOVES', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(29, '3', 'PELINDUNG KAKI / SAFETY SHOES', '2024-06-02 04:10:14', '2024-06-02 04:10:14'),
(30, '3', 'PELINDUNG DI KETINGGIAN / FULL BODY HARNESS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(31, '3', 'BAJU KERJA / WEARPCAK CATTLEPAK', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(32, '3', 'PENJAGA KEBAKARAN / FIRE WATCHER', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(33, '3', 'DETEKSI GAS BERBAHAYA / GAS DETECTION TEST', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(34, '3', 'ALAT PEMADAM API / FIRE EXTINGUISHER', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(35, '3', 'ALAT BANTU PERNAPASAN / BREATHING APPARATUS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(36, '3', 'LAINNYA / OTHERS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(37, '4', 'PELINDUNG KEPALA / HELM PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(38, '4', 'PELINDUNG MUKA / FACESHIELD, EYE PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(39, '4', 'PELINDUNG TELINGA / EAR PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(40, '4', 'PELINDUNG TANGAN / SAFETY GLOVES', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(41, '4', 'PELINDUNG KAKI / SAFETY SHOES', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(42, '4', 'PELINDUNG DI KETINGGIAN / FULL BODY HARNESS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(43, '4', 'BAJU KERJA / WEARPCAK CATTLEPAK', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(44, '4', 'PENJAGA KEBAKARAN / FIRE WATCHER', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(45, '4', 'DETEKSI GAS BERBAHAYA / GAS DETECTION TEST', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(46, '4', 'ALAT PEMADAM API / FIRE EXTINGUISHER', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(47, '4', 'ALAT BANTU PERNAPASAN / BREATHING APPARATUS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(48, '4', 'LAINNYA / OTHERS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(49, '5', 'PELINDUNG KEPALA / HELM PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(50, '5', 'PELINDUNG MUKA / FACESHIELD, EYE PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(51, '5', 'PELINDUNG TELINGA / EAR PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(52, '5', 'PELINDUNG TANGAN / SAFETY GLOVES', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(53, '5', 'PELINDUNG KAKI / SAFETY SHOES', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(54, '5', 'PELINDUNG DI KETINGGIAN / FULL BODY HARNESS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(55, '5', 'BAJU KERJA / WEARPCAK CATTLEPAK', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(56, '5', 'PENJAGA KEBAKARAN / FIRE WATCHER', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(57, '5', 'DETEKSI GAS BERBAHAYA / GAS DETECTION TEST', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(58, '5', 'ALAT PEMADAM API / FIRE EXTINGUISHER', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(59, '5', 'ALAT BANTU PERNAPASAN / BREATHING APPARATUS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(60, '5', 'LAINNYA / OTHERS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(61, '6', 'PELINDUNG KEPALA / HELM PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(62, '6', 'PELINDUNG MUKA / FACESHIELD, EYE PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(63, '6', 'PELINDUNG TELINGA / EAR PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(64, '6', 'PELINDUNG TANGAN / SAFETY GLOVES', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(65, '6', 'PELINDUNG KAKI / SAFETY SHOES', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(66, '6', 'PELINDUNG DI KETINGGIAN / FULL BODY HARNESS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(67, '6', 'BAJU KERJA / WEARPCAK CATTLEPAK', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(68, '6', 'PENJAGA KEBAKARAN / FIRE WATCHER', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(69, '6', 'DETEKSI GAS BERBAHAYA / GAS DETECTION TEST', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(70, '6', 'ALAT PEMADAM API / FIRE EXTINGUISHER', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(71, '6', 'ALAT BANTU PERNAPASAN / BREATHING APPARATUS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(72, '6', 'LAINNYA / OTHERS', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(73, '7', 'PELINDUNG KEPALA / HELM PROTECTION', '2024-06-02 04:10:15', '2024-06-02 04:10:15'),
(74, '7', 'PELINDUNG MUKA / FACESHIELD, EYE PROTECTION', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(75, '7', 'PELINDUNG TELINGA / EAR PROTECTION', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(76, '7', 'PELINDUNG TANGAN / SAFETY GLOVES', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(77, '7', 'PELINDUNG KAKI / SAFETY SHOES', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(78, '7', 'PELINDUNG DI KETINGGIAN / FULL BODY HARNESS', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(79, '7', 'BAJU KERJA / WEARPCAK CATTLEPAK', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(80, '7', 'PENJAGA KEBAKARAN / FIRE WATCHER', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(81, '7', 'DETEKSI GAS BERBAHAYA / GAS DETECTION TEST', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(82, '7', 'ALAT PEMADAM API / FIRE EXTINGUISHER', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(83, '7', 'ALAT BANTU PERNAPASAN / BREATHING APPARATUS', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(84, '7', 'LAINNYA / OTHERS', '2024-06-02 04:10:16', '2024-06-02 04:10:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'hse User', 'hse@example.com', '2024-06-02 04:10:12', '$2y$12$/7sX.UFTBCtvHuQtnxt7duBJ0V6v8bmL2qc55.9fFX.2tKTtmuXuO', 'LMZRtUxJ2z', '2024-06-02 04:10:12', '2024-06-02 04:10:12'),
(2, 'kabeng User', 'kabeng@example.com', '2024-06-02 04:10:12', '$2y$12$hd.fo3Y9X9phI4X3tzgWUu9cTaWzbcd4fqFyuhThMethln/6xJwrS', 'VZf7aKoQa8', '2024-06-02 04:10:12', '2024-06-02 04:10:12'),
(3, 'kapro User', 'kapro@example.com', '2024-06-02 04:10:13', '$2y$12$/JFoDOj6miDj3MB5VTrnYe89OROw0zejx5qf7TNtV.20zChRoXUSC', 'XtW4VUw9TZ', '2024-06-02 04:10:13', '2024-06-02 04:10:13'),
(4, 'spv User', 'spv@example.com', '2024-06-02 04:10:13', '$2y$12$82qhlAL7x6HcHBUKh5j.ROjG8KP5ciWaWi3Vh0tihMswL.j/R5Ke2', 'uWuNfcyQYL', '2024-06-02 04:10:13', '2024-06-02 04:10:13'),
(5, 'admin User', 'admin@example.com', '2024-06-02 04:10:14', '$2y$12$msIX/dcCtV/J08MUBKtEJ.kjnoJR2DV5LMqS.4LewkW8RnCRxDgai', 'jDaJNxidBx', '2024-06-02 04:10:14', '2024-06-02 04:10:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `work_locations`
--

CREATE TABLE `work_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `work_locations`
--

INSERT INTO `work_locations` (`id`, `location_name`, `created_at`, `updated_at`) VALUES
(1, 'Bengkel Fabrikasi & SSH', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(2, 'Bengkel Sub Assembly', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(3, 'Bengkel Assembly MPL', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(4, 'Bengkel Assembly CBL', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(5, 'Bengkel Las 1', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(6, 'Bengkel Las 2', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(7, 'Bengkel Erection 1', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(8, 'Bengkel Erection 2', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(9, 'Bengkel Block Blasting Shop ', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(10, 'Bengkel Konstruksi Plat 1', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(11, 'Bengkel Konstriksi Plat 2', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(12, 'Bengkel Pipa', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(13, 'Bengkel CNC', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(14, 'Bengkel Machinery Assembly', '2024-06-02 04:10:16', '2024-06-02 04:10:16'),
(15, 'Bengkel Machinery Outfitting', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(16, 'Bengkel Listrik', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(17, 'Bengkel Kayu', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(18, 'Dock Semarang', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(19, 'Dock Irian', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(20, 'Dock Surabaya', '2024-06-02 04:10:17', '2024-06-02 04:10:17'),
(21, 'Dock Pare-Pare', '2024-06-02 04:10:17', '2024-06-02 04:10:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `permission_tambahans`
--
ALTER TABLE `permission_tambahans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permission_types`
--
ALTER TABLE `permission_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ptws`
--
ALTER TABLE `ptws`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tools_types`
--
ALTER TABLE `tools_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `work_locations`
--
ALTER TABLE `work_locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `permission_tambahans`
--
ALTER TABLE `permission_tambahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `permission_types`
--
ALTER TABLE `permission_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `ptws`
--
ALTER TABLE `ptws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tools_types`
--
ALTER TABLE `tools_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `work_locations`
--
ALTER TABLE `work_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
