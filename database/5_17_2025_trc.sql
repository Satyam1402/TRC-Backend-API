-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 10:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trc`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `utility_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `utility_id`, `name`, `created_at`, `updated_at`) VALUES
(8, 9, 'Super AQUA LLC', '2025-04-23 08:31:12', '2025-04-23 08:31:12'),
(9, 10, 'Total GAS LTD', '2025-04-23 08:31:36', '2025-04-23 08:31:36'),
(10, 11, 'Speed Electricity LLC', '2025-04-23 08:32:06', '2025-04-23 08:32:06'),
(11, 12, 'BitByte Internet LLC', '2025-04-23 08:32:32', '2025-04-23 08:32:32'),
(12, 12, 'Mega Internet LLC', '2025-04-23 08:33:10', '2025-04-23 08:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(21, 'Burundi', '2025-05-13 02:20:59', '2025-05-13 02:20:59'),
(22, 'Iraq', '2025-05-13 02:20:59', '2025-05-13 02:20:59'),
(23, 'Lebanon', '2025-05-13 02:20:59', '2025-05-13 02:20:59'),
(24, 'Panama', '2025-05-13 02:20:59', '2025-05-13 02:20:59'),
(25, 'Guyana', '2025-05-13 02:20:59', '2025-05-13 02:20:59'),
(26, 'Libyan Arab Jamahiriya', '2025-05-13 02:21:00', '2025-05-13 02:21:00'),
(27, 'Canada', '2025-05-13 02:21:00', '2025-05-13 02:21:00'),
(28, 'Heard Island and McDonald Islands', '2025-05-13 02:21:01', '2025-05-13 02:21:01'),
(29, 'Christmas Island', '2025-05-13 02:21:01', '2025-05-13 02:21:01'),
(30, 'China', '2025-05-13 02:21:01', '2025-05-13 02:21:01'),
(31, 'Tajikistan', '2025-05-13 02:21:01', '2025-05-13 02:21:01'),
(32, 'Aruba', '2025-05-13 02:21:01', '2025-05-13 02:21:01'),
(33, 'Algeria', '2025-05-13 02:21:01', '2025-05-13 02:21:01'),
(34, 'Liechtenstein', '2025-05-13 02:21:01', '2025-05-13 02:21:01'),
(35, 'Slovakia (Slovak Republic)', '2025-05-13 02:21:01', '2025-05-13 02:21:01'),
(36, 'Iran', '2025-05-13 02:21:01', '2025-05-13 02:21:01'),
(37, 'Barbados', '2025-05-13 02:21:02', '2025-05-13 02:21:02'),
(38, 'United Arab Emirates', '2025-05-13 02:21:02', '2025-05-13 02:21:02'),
(39, 'British Virgin Islands', '2025-05-13 02:21:02', '2025-05-13 02:21:02'),
(40, 'Eritrea', '2025-05-13 02:21:02', '2025-05-13 02:21:02');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_06_064352_create_top_banner_table', 2),
(6, '2024_12_06_070243_create_trusted_brands_table', 2),
(7, '2024_12_07_051220_create_services_overview_table', 3),
(8, '2024_12_07_052657_create_service_platform_table', 4),
(9, '2024_12_07_053452_create_dynamic_video_table', 5),
(11, '2024_12_07_054210_create_client_table', 6),
(12, '2024_12_07_093142_create_explore_our_service_category_table', 7),
(13, '2024_12_17_064809_create_marketing_house_categories_table', 8),
(14, '2024_12_17_104126_create_marketing_house_item_table', 8),
(15, '2024_12_17_105702_add_columns_to_marketing_house_items_table', 8),
(16, '2024_12_17_170633_create_marketing_house_images_table', 8),
(17, '2024_12_18_104639_create_marketing_house_pre_launch_activities_table', 8),
(18, '2024_12_18_122801_create_marketing_house_other_activity_category_table', 8),
(19, '2024_12_18_142503_create_marketing_house_other_activity_item_table', 8),
(20, '2024_12_18_172307_create_marketing_house_content_created_categories_table', 8),
(21, '2024_12_19_060118_create_marketing_house_content_created_items_table', 8),
(22, '2024_12_19_071338_create_marketing_house_content_created_item_carousels_table', 8),
(23, '2025_02_11_154542_create_blog_categories_table', 8),
(24, '2025_02_11_154621_create_blog_sub_categories_table', 8),
(25, '2025_02_11_154639_create_blog_items_table', 8),
(26, '2025_04_19_074319_create_properties_table', 8),
(27, '2025_04_19_075108_create_properties_table', 9),
(28, '2025_04_22_052827_create_utilities_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(59, 'App\\Models\\User', 44, 'API Token', '4d6534eb6556e4c722553a576e354c2313c92384541be37217e56b41a13007d6', '[\"*\"]', NULL, '2025-05-12 00:55:31', '2025-05-12 00:55:31', NULL),
(60, 'App\\Models\\User', 47, 'API Token', '55dc332fc3c443c170f20d48e7f67a513a3eeb6886af302edeb7777edb7f3d3b', '[\"*\"]', NULL, '2025-05-12 04:33:59', '2025-05-12 04:33:59', NULL),
(61, 'App\\Models\\User', 48, 'API Token', 'a18428ad27be61e11826a43b8a9987e6e5407da2c3112dceea1d2741c3f0aba3', '[\"*\"]', '2025-05-12 04:55:22', '2025-05-12 04:53:35', '2025-05-12 04:55:22', NULL),
(62, 'App\\Models\\User', 49, 'API Token', 'c808b2d5f3b8edc8d7f28c8b10c1df21821b6295d45f1609e3c9c22719b078f5', '[\"*\"]', '2025-05-12 05:23:02', '2025-05-12 04:55:57', '2025-05-12 05:23:02', NULL),
(63, 'App\\Models\\User', 50, 'API Token', 'a1384c06b425f1be63e7662672b544eb8e6b3714cb87f75bb1803d9efd9fb2a2', '[\"*\"]', NULL, '2025-05-12 05:48:03', '2025-05-12 05:48:03', NULL),
(64, 'App\\Models\\User', 51, 'API Token', 'fd6c8c6294564e0c5bb6c23611d4211bba84b4bdd218773d03c7d6b45edfe0e9', '[\"*\"]', NULL, '2025-05-12 06:04:04', '2025-05-12 06:04:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `unit_number` varchar(255) DEFAULT NULL,
  `street_number` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `contract_start_date` date DEFAULT NULL,
  `contract_end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `unit_number`, `street_number`, `street_name`, `suburb`, `state_id`, `country_id`, `postcode`, `contract_start_date`, `contract_end_date`, `created_at`, `updated_at`) VALUES
(1, 12, '15264', '77023', 'Abigail Street', 'Port Camillaview', 340, 26, '48305-8805', '2024-12-13', '2025-06-09', '2025-05-16 01:12:05', '2025-05-16 01:12:05'),
(2, 12, NULL, '607', 'Batz Trail', 'South Christianaside', 325, 21, '22013', '2024-08-11', '2026-03-02', '2025-05-16 01:12:05', '2025-05-16 01:12:05'),
(3, 15, '61829', '72928', 'Freeman Estate', 'Quintonton', 333, 33, '76556-4581', '2025-01-28', '2025-11-14', '2025-05-16 01:12:05', '2025-05-16 01:12:05'),
(4, 66, NULL, '4624', 'Yazmin Hollow', 'Kipborough', 275, 35, '78394-4126', '2025-01-07', '2025-12-17', '2025-05-16 01:12:05', '2025-05-16 01:12:05'),
(5, 15, '2786', '857', 'Lehner Plaza', 'West Lorenza', 287, 25, '38441-6267', '2024-10-08', '2025-12-25', '2025-05-16 01:12:05', '2025-05-16 01:12:05'),
(7, 66, '15261', '321', 'by pass', 'raipur', 256, 22, '15264', NULL, NULL, '2025-05-16 01:58:56', '2025-05-16 01:58:56'),
(15, 66, '123456', '321', 'balrampur', 'nagpur', 256, 22, '15264', NULL, NULL, '2025-05-17 02:22:39', '2025-05-17 02:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `utility_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `utility_id`, `name`, `created_at`, `updated_at`) VALUES
(7, 9, 'Crystal Water', '2025-04-23 06:54:36', '2025-04-23 07:59:43'),
(8, 10, 'ABC Gas', '2025-04-23 06:55:00', '2025-04-23 08:00:20'),
(9, 11, 'Magna Electro', '2025-04-23 06:56:23', '2025-04-23 07:58:52'),
(10, 12, 'Xfinity', '2025-04-23 06:58:14', '2025-04-23 07:51:39'),
(11, 9, 'Aqua Works', '2025-04-23 06:59:50', '2025-04-23 07:51:25'),
(12, 12, 'SifyNet', '2025-04-23 07:00:13', '2025-04-23 08:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `rent_collections`
--

CREATE TABLE `rent_collections` (
  `id` bigint(20) NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `receipt_number` varchar(255) DEFAULT NULL,
  `inspection_report` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_collections`
--

INSERT INTO `rent_collections` (`id`, `property_id`, `user_id`, `amount`, `due_date`, `status`, `receipt_number`, `inspection_report`, `created_at`, `updated_at`) VALUES
(4, 2, 11, 146.00, '2025-05-05', 'unpaid', 'REC001', 'Inspection Report 1', NULL, NULL),
(5, 4, 11, 201.00, '2025-05-14', 'unpaid', 'REC002', 'Inspection Report 2', NULL, NULL),
(6, 2, 4, 308.00, '2025-05-21', 'unpaid', 'REC003', 'Inspection Report 3', NULL, NULL),
(7, 5, 12, 104.00, '2025-05-03', 'unpaid', 'REC004', 'Inspection Report 4', NULL, NULL),
(8, 7, 14, 128.00, '2025-05-22', 'paid', 'REC005', 'Inspection Report 5', NULL, NULL),
(9, 2, 15, 158.00, '2025-05-23', 'unpaid', 'REC006', 'Inspection Report 6', NULL, NULL),
(10, 4, 14, 224.00, '2025-05-14', 'unpaid', 'REC007', 'Inspection Report 7', NULL, NULL),
(11, 1, 66, 304.00, '2025-05-04', 'paid', 'REC008', 'Inspection Report 8', NULL, NULL),
(12, 5, 66, 248.00, '2025-05-27', 'paid', 'REC009', 'Inspection Report 9', NULL, NULL),
(13, 4, 15, 344.00, '2025-05-11', 'unpaid', 'REC010', 'Inspection Report 10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resident_infos`
--

CREATE TABLE `resident_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `resident_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_media_challenges`
--

CREATE TABLE `social_media_challenges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `social_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media_challenges`
--

INSERT INTO `social_media_challenges` (`id`, `title`, `start_date`, `end_date`, `social_link`, `created_at`, `updated_at`) VALUES
(4, 'Win a holiday to Europe', '2025-04-24', '2025-05-24', 'https://www.facebook.com/', '2025-04-24 09:32:11', '2025-04-25 08:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `created_at`, `updated_at`) VALUES
(251, 21, 'Nevada', '2025-05-13 02:21:15', '2025-05-13 02:21:15'),
(252, 21, 'Texas', '2025-05-13 02:21:15', '2025-05-13 02:21:15'),
(253, 21, 'Alaska', '2025-05-13 02:21:15', '2025-05-13 02:21:15'),
(254, 21, 'Idaho', '2025-05-13 02:21:15', '2025-05-13 02:21:15'),
(255, 21, 'Tennessee', '2025-05-13 02:21:16', '2025-05-13 02:21:16'),
(256, 22, 'Illinois', '2025-05-13 02:21:17', '2025-05-13 02:21:17'),
(257, 22, 'Alabama', '2025-05-13 02:21:17', '2025-05-13 02:21:17'),
(258, 22, 'Wisconsin', '2025-05-13 02:21:17', '2025-05-13 02:21:17'),
(259, 22, 'South Carolina', '2025-05-13 02:21:17', '2025-05-13 02:21:17'),
(260, 22, 'Louisiana', '2025-05-13 02:21:17', '2025-05-13 02:21:17'),
(261, 23, 'Indiana', '2025-05-13 02:21:17', '2025-05-13 02:21:17'),
(262, 23, 'Florida', '2025-05-13 02:21:17', '2025-05-13 02:21:17'),
(263, 23, 'New Hampshire', '2025-05-13 02:21:18', '2025-05-13 02:21:18'),
(264, 23, 'Georgia', '2025-05-13 02:21:18', '2025-05-13 02:21:18'),
(265, 23, 'Kansas', '2025-05-13 02:21:18', '2025-05-13 02:21:18'),
(266, 24, 'California', '2025-05-13 02:21:18', '2025-05-13 02:21:18'),
(267, 24, 'North Dakota', '2025-05-13 02:21:18', '2025-05-13 02:21:18'),
(268, 24, 'Rhode Island', '2025-05-13 02:21:18', '2025-05-13 02:21:18'),
(269, 24, 'Iowa', '2025-05-13 02:21:18', '2025-05-13 02:21:18'),
(270, 24, 'Vermont', '2025-05-13 02:21:18', '2025-05-13 02:21:18'),
(271, 25, 'California', '2025-05-13 02:21:18', '2025-05-13 02:21:18'),
(272, 25, 'Delaware', '2025-05-13 02:21:19', '2025-05-13 02:21:19'),
(273, 25, 'Tennessee', '2025-05-13 02:21:19', '2025-05-13 02:21:19'),
(274, 25, 'District of Columbia', '2025-05-13 02:21:19', '2025-05-13 02:21:19'),
(275, 25, 'New Jersey', '2025-05-13 02:21:19', '2025-05-13 02:21:19'),
(276, 26, 'New Jersey', '2025-05-13 02:21:19', '2025-05-13 02:21:19'),
(277, 26, 'Missouri', '2025-05-13 02:21:19', '2025-05-13 02:21:19'),
(278, 26, 'Connecticut', '2025-05-13 02:21:19', '2025-05-13 02:21:19'),
(279, 26, 'Delaware', '2025-05-13 02:21:20', '2025-05-13 02:21:20'),
(280, 26, 'Rhode Island', '2025-05-13 02:21:20', '2025-05-13 02:21:20'),
(281, 27, 'Arkansas', '2025-05-13 02:21:20', '2025-05-13 02:21:20'),
(282, 27, 'Wyoming', '2025-05-13 02:21:20', '2025-05-13 02:21:20'),
(283, 27, 'Ohio', '2025-05-13 02:21:20', '2025-05-13 02:21:20'),
(284, 27, 'North Dakota', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(285, 27, 'Oklahoma', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(286, 28, 'Vermont', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(287, 28, 'South Dakota', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(288, 28, 'Iowa', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(289, 28, 'Alabama', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(290, 28, 'Idaho', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(291, 29, 'Pennsylvania', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(292, 29, 'Massachusetts', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(293, 29, 'North Dakota', '2025-05-13 02:21:21', '2025-05-13 02:21:21'),
(294, 29, 'Hawaii', '2025-05-13 02:21:22', '2025-05-13 02:21:22'),
(295, 29, 'Alabama', '2025-05-13 02:21:22', '2025-05-13 02:21:22'),
(296, 30, 'Delaware', '2025-05-13 02:21:22', '2025-05-13 02:21:22'),
(297, 30, 'Alaska', '2025-05-13 02:21:22', '2025-05-13 02:21:22'),
(298, 30, 'Wyoming', '2025-05-13 02:21:22', '2025-05-13 02:21:22'),
(299, 30, 'New York', '2025-05-13 02:21:22', '2025-05-13 02:21:22'),
(300, 30, 'Texas', '2025-05-13 02:21:23', '2025-05-13 02:21:23'),
(301, 31, 'Oregon', '2025-05-13 02:21:23', '2025-05-13 02:21:23'),
(302, 31, 'Massachusetts', '2025-05-13 02:21:23', '2025-05-13 02:21:23'),
(303, 31, 'North Carolina', '2025-05-13 02:21:23', '2025-05-13 02:21:23'),
(304, 31, 'Arkansas', '2025-05-13 02:21:23', '2025-05-13 02:21:23'),
(305, 31, 'Vermont', '2025-05-13 02:21:23', '2025-05-13 02:21:23'),
(306, 32, 'New Mexico', '2025-05-13 02:21:23', '2025-05-13 02:21:23'),
(307, 32, 'California', '2025-05-13 02:21:23', '2025-05-13 02:21:23'),
(308, 32, 'Alaska', '2025-05-13 02:21:23', '2025-05-13 02:21:23'),
(309, 32, 'Arizona', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(310, 32, 'New Mexico', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(311, 33, 'Montana', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(312, 33, 'Arizona', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(313, 33, 'Oregon', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(314, 33, 'Oklahoma', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(315, 33, 'Indiana', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(316, 34, 'Alaska', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(317, 34, 'Georgia', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(318, 34, 'California', '2025-05-13 02:21:24', '2025-05-13 02:21:24'),
(319, 34, 'Oklahoma', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(320, 34, 'District of Columbia', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(321, 35, 'Washington', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(322, 35, 'Maryland', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(323, 35, 'Wyoming', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(324, 35, 'Colorado', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(325, 35, 'Virginia', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(326, 36, 'Kentucky', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(327, 36, 'Massachusetts', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(328, 36, 'New Mexico', '2025-05-13 02:21:25', '2025-05-13 02:21:25'),
(329, 36, 'South Carolina', '2025-05-13 02:21:26', '2025-05-13 02:21:26'),
(330, 36, 'Arizona', '2025-05-13 02:21:27', '2025-05-13 02:21:27'),
(331, 37, 'Michigan', '2025-05-13 02:21:28', '2025-05-13 02:21:28'),
(332, 37, 'Rhode Island', '2025-05-13 02:21:28', '2025-05-13 02:21:28'),
(333, 37, 'South Carolina', '2025-05-13 02:21:28', '2025-05-13 02:21:28'),
(334, 37, 'Rhode Island', '2025-05-13 02:21:29', '2025-05-13 02:21:29'),
(335, 37, 'Massachusetts', '2025-05-13 02:21:29', '2025-05-13 02:21:29'),
(336, 38, 'Arkansas', '2025-05-13 02:21:29', '2025-05-13 02:21:29'),
(337, 38, 'New York', '2025-05-13 02:21:30', '2025-05-13 02:21:30'),
(338, 38, 'Florida', '2025-05-13 02:21:30', '2025-05-13 02:21:30'),
(339, 38, 'Arizona', '2025-05-13 02:21:30', '2025-05-13 02:21:30'),
(340, 38, 'California', '2025-05-13 02:21:30', '2025-05-13 02:21:30'),
(341, 39, 'Hawaii', '2025-05-13 02:21:30', '2025-05-13 02:21:30'),
(342, 39, 'Idaho', '2025-05-13 02:21:30', '2025-05-13 02:21:30'),
(343, 39, 'Oklahoma', '2025-05-13 02:21:31', '2025-05-13 02:21:31'),
(344, 39, 'West Virginia', '2025-05-13 02:21:31', '2025-05-13 02:21:31'),
(345, 39, 'New Mexico', '2025-05-13 02:21:31', '2025-05-13 02:21:31'),
(346, 40, 'Vermont', '2025-05-13 02:21:31', '2025-05-13 02:21:31'),
(347, 40, 'Alaska', '2025-05-13 02:21:31', '2025-05-13 02:21:31'),
(348, 40, 'South Carolina', '2025-05-13 02:21:31', '2025-05-13 02:21:31'),
(349, 40, 'Nevada', '2025-05-13 02:21:31', '2025-05-13 02:21:31'),
(350, 40, 'New York', '2025-05-13 02:21:31', '2025-05-13 02:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `static_contents`
--

CREATE TABLE `static_contents` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `static_contents`
--

INSERT INTO `static_contents` (`id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 'terms', 'Welcome to RentCollect! These Terms and Conditions (\"Terms\") govern your use of the RentCollect mobile application and website (collectively, the “Service”) operated by [Your Company Name] (“we,” “us,” or “our”).\n\n1. Acceptance of Terms\nBy accessing or using RentCollect, you agree to be bound by these Terms. If you do not agree, please do not use our Service.\n\n2. Eligibility\nYou must be at least 18 years old and able to enter into legally binding contracts to use the Service.\n\n3. Description of Service\nRentCollect enables landlords and tenants to manage rent payments, payment history, reminders, and rental agreements digitally.', '2025-05-15 04:47:21', '2025-05-15 04:47:21'),
(2, 'privacy', 'This Privacy Policy explains how RentCollect (\"we\", \"our\", or \"us\") collects, uses, and protects your information.\n\n1. Information We Collect\n- Personal Information: Name, email, phone number, and address.\n- Payment Information: Details provided to our third-party processors.\n- Usage Data: App activity, log data, and device information.\n\n2. How We Use Your Information\n- Facilitate rent payments.\n- Provide customer support.\n- Improve our services.\n- Comply with legal obligations.\n\n3. Sharing Your Information\n- Payment processors (e.g., Stripe, PayPal).\n- Legal authorities if required.\n- Service providers under confidentiality agreements.\n\n4. Data Security\nWe implement appropriate security measures, but no method of transmission over the Internet is 100% secure.', '2025-05-15 04:47:21', '2025-05-15 04:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `stars` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` varchar(100) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `otp_expiry` timestamp NULL DEFAULT current_timestamp(),
  `otp_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_role`, `name`, `email`, `phone`, `password`, `stars`, `status`, `otp`, `otp_expiry`, `otp_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Albert', 'Taylor', 'admin', 'Admin', 'demo@gmail.com', '234-984-3748', '$2y$10$WEIxafX0v58Kq9NwPlPpWuYF4RS1kO6/IBafNq7fKFVSn3GFQilZC', 0, '1', NULL, '2025-05-05 08:43:21', NULL, NULL, '2025-04-11 02:46:51', '2025-05-14 23:32:03'),
(11, 'Lisette', 'Collier', 'user', 'Leilani Effertz', 'lisette@example.net', '702-338-4843', '$2y$10$a1YhcxSpsxpzcYI09B5QKevrVhQrQyo0m.UtDJsvHQ6yN3lztZS66', 0, NULL, NULL, '2025-05-05 08:43:21', NULL, NULL, '2025-04-22 06:22:23', '2025-04-22 06:22:23'),
(12, 'Ocie', 'Gleichner', 'user', 'Haley Schaefer', 'ocie@example.net', '(803) 295-8487', '$2y$10$JR7xHVSo0w.OvpD3SxNZAOdGF3MjHMlQP8Lr9YuchBam1uLoUIIVW', 0, NULL, NULL, '2025-05-05 08:43:21', NULL, NULL, '2025-04-22 06:22:23', '2025-04-22 06:22:23'),
(13, 'Marisa', 'Leuschke', 'user', 'Cristobal Stamm', 'marisa@example.net', '254-562-7851', '$2y$10$ai2ktAPw3vVX/LsNbwhZde9mW48l4.s15j15ZjBl1N5aFRGW3n8UK', 0, NULL, NULL, '2025-05-05 08:43:21', NULL, NULL, '2025-04-22 06:22:23', '2025-04-22 06:22:23'),
(14, 'Johnpaul', 'Shields', 'user', 'Adonis Nienow', 'john@example.net', '351.794.4047', '$2y$10$TxCwN476VJjcCNlfEH63.u5OOBzWEDDGsP1Qt9cXMku4ek/q1cl1u', 0, NULL, NULL, '2025-05-05 08:43:21', NULL, NULL, '2025-04-22 06:22:23', '2025-04-22 06:22:23'),
(15, 'Juana', 'Luettgen', 'user', 'Osbaldo Nienow', 'juana@example.net', '283-803-9540', '$2y$10$0ZiTe4Ti.JTg65RO6YucbOBSAQE92jjqdy3pf.8X/BGAjIDKkLs26', 0, NULL, NULL, '2025-05-05 08:43:21', NULL, NULL, '2025-04-22 06:22:23', '2025-04-22 06:22:23'),
(66, 'alex', 'bob', 'tenant', 'alex bob', 'alex@gmail.com', '123456789', '$2y$10$0ZiTe4Ti.JTg65RO6YucbOBSAQE92jjqdy3pf.8X/BGAjIDKkLs26', 5, NULL, NULL, '2025-05-16 06:37:08', NULL, NULL, '2025-05-16 01:07:08', '2025-05-17 02:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_rewards`
--

CREATE TABLE `user_rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `related_id` bigint(20) UNSIGNED DEFAULT NULL,
  `related_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `token`, `expires_at`, `created_at`, `updated_at`) VALUES
(25, 15, 'TdFupfVnuchXKHlNSBKuQfS7uNKG9thKzo6R9XquCGtJ0vK8jkWr2Vy9yEkWeeXv', '2025-05-16 03:41:03', '2025-05-16 02:41:03', '2025-05-16 02:41:03'),
(28, 66, 'fdsuz5uRd8J4o7tpoF3YQywEnBiU9YHSnmL0h69O6QKkikY4CSm8dCZUxxMmQYY2', '2025-05-17 02:33:43', '2025-05-17 01:33:43', '2025-05-17 01:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `utilities`
--

CREATE TABLE `utilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilities`
--

INSERT INTO `utilities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(9, 'Water', '2025-04-22 07:33:46', '2025-04-23 07:49:35'),
(10, 'Gas', '2025-04-22 07:33:57', '2025-04-23 07:49:44'),
(11, 'Electricity', '2025-04-22 07:34:09', '2025-04-22 08:46:30'),
(12, 'Internet', '2025-04-22 07:34:17', '2025-04-23 07:49:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_utility_id_foreign` (`utility_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `providers_utility_id_foreign` (`utility_id`);

--
-- Indexes for table `rent_collections`
--
ALTER TABLE `rent_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resident_infos`
--
ALTER TABLE `resident_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `social_media_challenges`
--
ALTER TABLE `social_media_challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `static_contents`
--
ALTER TABLE `static_contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_unique` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rent_collections`
--
ALTER TABLE `rent_collections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `resident_infos`
--
ALTER TABLE `resident_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_media_challenges`
--
ALTER TABLE `social_media_challenges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- AUTO_INCREMENT for table `static_contents`
--
ALTER TABLE `static_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user_rewards`
--
ALTER TABLE `user_rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_utility_id_foreign` FOREIGN KEY (`utility_id`) REFERENCES `utilities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `Foreign_key_with_user_table` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_key_country_table` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_key_state_table` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `providers_utility_id_foreign` FOREIGN KEY (`utility_id`) REFERENCES `utilities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rent_collections`
--
ALTER TABLE `rent_collections`
  ADD CONSTRAINT `foreign-with-user-table` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_with_properties_table` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resident_infos`
--
ALTER TABLE `resident_infos`
  ADD CONSTRAINT `Foreign_key_with_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `Foreign_key_with_country_table` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD CONSTRAINT `foreign-key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `fk_usr_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
