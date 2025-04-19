-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 01:03 PM
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
(27, '2025_04_19_075108_create_properties_table', 9);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_number` varchar(255) DEFAULT NULL,
  `street_number` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `unit_number`, `street_number`, `street_name`, `suburb`, `state`, `postcode`, `country`, `created_at`, `updated_at`) VALUES
(1, NULL, '99886', 'Barrows Dam', 'Lake Madysonmouth', 'New York', '62647-4330', 'Saudi Arabia', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(2, NULL, '74621', 'Jalyn Vista', 'South Opalland', 'Montana', '98354-5032', 'United Arab Emirates', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(3, '767', '662', 'Conn Port', 'Maxieborough', 'Montana', '11584-8851', 'Azerbaijan', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(4, NULL, '53273', 'Danyka Divide', 'Vicentaberg', 'Missouri', '52683', 'Pakistan', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(5, '368', '226', 'Nicklaus Turnpike', 'North Carminehaven', 'Hawaii', '42226', 'Slovenia', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(6, NULL, '1227', 'Orn Glens', 'North Khalil', 'Maryland', '87971-9094', 'Aruba', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(7, '54050', '4698', 'Randal Meadows', 'Justushaven', 'Indiana', '46654', 'Trinidad and Tobago', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(8, NULL, '71661', 'Stoltenberg Creek', 'Bridgethaven', 'Arizona', '79010', 'Canada', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(9, '2934', '43366', 'Odessa Rest', 'Port Veronica', 'Florida', '99640', 'Australia', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(10, NULL, '123', 'Turner Ways', 'Olsonmouth', 'Nebraska', '94217', 'Honduras', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(11, '854', '10687', 'Rosenbaum Inlet', 'Ruthehaven', 'Nevada', '03986-2157', 'Uzbekistan', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(12, '1750', '6980', 'Loma Meadow', 'East Marlene', 'Washington', '70652-6014', 'Antarctica (the territory South of 60 deg S)', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(13, '585', '1172', 'Willms Light', 'West Willie', 'Kansas', '99031', 'Iran', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(14, NULL, '58128', 'Raoul Drive', 'Daughertyfort', 'New Hampshire', '69083', 'Faroe Islands', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(15, NULL, '422', 'Towne Point', 'Blickfurt', 'North Carolina', '32006', 'Gabon', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(16, '7419', '73229', 'Adrien Spurs', 'Augustabury', 'South Dakota', '19423', 'Rwanda', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(17, '84963', '43968', 'McLaughlin Road', 'Bryanastad', 'West Virginia', '10158', 'French Guiana', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(18, '26242', '9577', 'Joshua Burg', 'Paoloborough', 'Idaho', '53421-8597', 'Samoa', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(19, NULL, '663', 'Schiller Mountains', 'Noehaven', 'Tennessee', '18127-2021', 'Bosnia and Herzegovina', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(20, '5451', '52808', 'Howell Grove', 'Port Shayleetown', 'Maryland', '24866-1052', 'United States of America', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(21, NULL, '520', 'Mathias Squares', 'New Zella', 'Tennessee', '23359-9388', 'Mexico', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(22, NULL, '6472', 'Wyman Passage', 'Lake Janaeton', 'New York', '43386-2438', 'Brazil', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(23, '41523', '93229', 'Christian Mill', 'Bellemouth', 'Alaska', '11937', 'Rwanda', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(24, '4892', '5984', 'Barry Ports', 'North Andreanne', 'Washington', '28977', 'Sri Lanka', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(25, NULL, '9651', 'Walker Street', 'North Cleta', 'Alabama', '09034-3643', 'Lesotho', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(26, NULL, '10375', 'Alfred Ferry', 'Tellyside', 'Washington', '18751', 'Haiti', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(27, '137', '234', 'Weimann Shoals', 'Baileeton', 'Illinois', '15578', 'Pitcairn Islands', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(28, NULL, '760', 'Collier Trail', 'West Ashtonchester', 'Louisiana', '62349-1536', 'Russian Federation', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(29, '5080', '897', 'White Overpass', 'North Grantmouth', 'Hawaii', '93683-3322', 'Singapore', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(30, NULL, '9343', 'Zulauf Islands', 'West Dawsonborough', 'Georgia', '85050', 'Angola', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(31, '68238', '5586', 'Augustine Shoal', 'Amelymouth', 'North Carolina', '49792-8564', 'Serbia', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(32, '75669', '6553', 'Wolff Pine', 'Kenville', 'Georgia', '96089-2187', 'New Zealand', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(33, '4134', '52588', 'Schuppe Club', 'North Carmen', 'West Virginia', '30095', 'Rwanda', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(34, '3137', '351', 'Antonia Throughway', 'Grahamberg', 'Oregon', '22832', 'China', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(35, NULL, '65386', 'Kshlerin Trail', 'Lake Johan', 'Arizona', '29770', 'French Guiana', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(36, NULL, '48990', 'Kenneth Loaf', 'New Hayden', 'Maine', '79241-6083', 'Namibia', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(37, NULL, '4524', 'Tressa Ramp', 'Lake Tadfurt', 'Florida', '59789', 'Bulgaria', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(38, NULL, '843', 'Orland Harbors', 'Ferrytown', 'Minnesota', '75730', 'Panama', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(39, NULL, '622', 'Brakus Prairie', 'Rowenatown', 'Kansas', '93237-7291', 'Haiti', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(40, '79374', '985', 'Narciso Parkways', 'Labadieborough', 'Arizona', '14598-0141', 'Pitcairn Islands', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(41, NULL, '5979', 'Nienow Drive', 'Kovacekfurt', 'Vermont', '60902', 'Martinique', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(42, '9763', '59076', 'Krystal Oval', 'Jaceview', 'New Mexico', '95452', 'Gabon', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(43, '77513', '64964', 'Stracke Curve', 'West Elishafurt', 'Indiana', '47655', 'French Polynesia', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(44, '4006', '3444', 'Little Views', 'Simonisbury', 'Ohio', '20294', 'Azerbaijan', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(45, '312', '587', 'Rusty Mountain', 'North Myleneland', 'Minnesota', '72355', 'Iran', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(46, '1511', '145', 'Stephan Underpass', 'Fritschside', 'Utah', '26670', 'El Salvador', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(47, '1431', '63887', 'Esteban Creek', 'Port Burnice', 'Wisconsin', '16733', 'Uganda', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(48, NULL, '10113', 'Hayley Roads', 'Croninberg', 'Colorado', '84674', 'Singapore', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(49, NULL, '526', 'Hayes Villages', 'Flavieburgh', 'Florida', '86880', 'French Guiana', '2025-04-19 02:45:29', '2025-04-19 02:45:29'),
(50, '718', '53253', 'Mueller Green', 'Elianeborough', 'Maine', '85229-7046', 'Rwanda', '2025-04-19 02:45:29', '2025-04-19 02:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_role`, `name`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'admin', 'Admin', 'demo@gmail.com', '$2y$10$WEIxafX0v58Kq9NwPlPpWuYF4RS1kO6/IBafNq7fKFVSn3GFQilZC', '1', NULL, '2025-04-11 02:46:51', '2025-04-19 05:30:32');

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
