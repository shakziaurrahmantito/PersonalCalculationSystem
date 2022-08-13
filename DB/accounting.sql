-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2022 at 07:43 AM
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
-- Database: `accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `amounts`
--

CREATE TABLE `amounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `debit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memberid` int(11) NOT NULL,
  `getwayid` int(11) NOT NULL,
  `prepare_by` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amounts`
--

INSERT INTO `amounts` (`id`, `debit`, `credit`, `memberid`, `getwayid`, `prepare_by`, `date`, `created_at`, `updated_at`) VALUES
(1, NULL, '230', 1, 3, 1, '2022-08-08', '2022-08-11 04:24:44', '2022-08-12 04:18:32'),
(2, '200', NULL, 1, 4, 1, '2022-08-08', '2022-08-11 10:25:33', '2022-08-11 10:25:33'),
(3, NULL, '50000', 2, 3, 2, '2022-08-08', '2022-08-12 04:18:55', '2022-08-12 04:28:15'),
(4, NULL, '50000', 2, 1, 2, '2022-08-12', '2022-08-12 04:27:22', '2022-08-12 04:28:19'),
(5, '500', NULL, 1, 2, 1, '2022-08-02', '2022-08-12 10:33:38', '2022-08-12 04:41:31'),
(6, '10000', NULL, 1, 1, 2, '2022-08-10', '2022-08-12 10:42:32', '2022-08-12 10:42:32'),
(7, NULL, '500', 3, 4, 1, '2022-08-13', '2022-08-12 18:06:09', '2022-08-12 18:06:09'),
(8, NULL, '50', 3, 3, 1, '2022-08-13', '2022-08-12 18:06:09', '2022-08-12 18:06:09'),
(9, '250', NULL, 3, 3, 1, '2022-08-17', '2022-08-13 00:07:02', '2022-08-13 00:07:02'),
(10, '5', NULL, 3, 3, 1, '2022-08-13', '2022-08-13 00:07:02', '2022-08-13 00:07:02'),
(11, NULL, '500', 4, 1, 1, '2022-08-16', '2022-08-12 18:07:51', '2022-08-12 18:07:51'),
(12, NULL, '2', 4, 1, 1, '2022-09-06', '2022-08-12 18:07:51', '2022-08-12 18:07:51'),
(13, '23', NULL, 4, 4, 1, '2022-08-09', '2022-08-13 00:08:57', '2022-08-13 00:08:57'),
(14, '55', NULL, 4, 4, 1, '2022-08-13', '2022-08-13 00:08:57', '2022-08-13 00:08:57');

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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Md. Ziaur Rahman', 1, '2022-08-11 04:23:11', '2022-08-12 17:52:24'),
(2, 'Md. Mogibor Rahman', 1, '2022-08-11 04:23:22', '2022-08-11 04:23:26'),
(3, 'Shawon Khan', 1, '2022-08-12 17:52:00', '2022-08-12 23:34:58'),
(4, 'Rakib Mia', 1, '2022-08-12 17:52:00', '2022-08-12 23:34:48'),
(5, 'Md. Robiul Hossain', 1, '2022-08-12 23:35:30', '2022-08-12 23:35:30'),
(6, 'Md. Rajib Hossain', 1, '2022-08-12 23:35:30', '2022-08-12 23:35:30'),
(7, 'Md. Rifat Hossain', 1, '2022-08-12 23:36:27', '2022-08-12 23:36:27'),
(8, 'Md. Deleuar Hossain', 1, '2022-08-12 23:36:27', '2022-08-12 23:36:27'),
(9, 'Md. Rubel Hossain', 1, '2022-08-12 23:36:27', '2022-08-12 23:37:38'),
(10, 'Test', 0, '2022-08-12 23:36:27', '2022-08-12 23:37:38');

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
(35, '2014_10_12_000000_create_users_table', 1),
(36, '2014_10_12_100000_create_password_resets_table', 1),
(37, '2019_08_19_000000_create_failed_jobs_table', 1),
(38, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(39, '2022_08_08_235400_create_roles_table', 1),
(40, '2022_08_09_092753_create_amounts_table', 1),
(41, '2022_08_09_092833_create_paymentgetways_table', 1),
(42, '2022_08_09_092944_create_role_assigns_table', 1),
(43, '2022_08_09_234331_create_members_table', 1);

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
-- Table structure for table `paymentgetways`
--

CREATE TABLE `paymentgetways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentgetways`
--

INSERT INTO `paymentgetways` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rupali Bank', 1, '2022-08-11 04:24:08', '2022-08-11 04:24:08'),
(2, 'Nagad', 1, '2022-08-11 04:24:08', '2022-08-11 04:24:08'),
(3, 'Bkash', 1, '2022-08-11 04:24:08', '2022-08-11 04:24:08'),
(4, 'Other', 1, '2022-08-11 04:25:19', '2022-08-11 04:25:19');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '1', '2022-08-11 04:20:41', '2022-08-12 22:20:30'),
(2, 'Editor', '1', '2022-08-12 22:40:24', '2022-08-12 22:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_assigns`
--

CREATE TABLE `role_assigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_assigns`
--

INSERT INTO `role_assigns` (`id`, `name`, `roleid`, `created_at`, `updated_at`) VALUES
(21, 'edit', 1, '2022-08-12 22:40:39', '2022-08-12 22:40:39'),
(22, 'delete', 1, '2022-08-12 22:40:39', '2022-08-12 22:40:39'),
(23, 'status', 1, '2022-08-12 22:40:39', '2022-08-12 22:40:39'),
(24, 'print', 1, '2022-08-12 22:40:39', '2022-08-12 22:40:39'),
(25, 'adminarea', 1, '2022-08-12 22:40:39', '2022-08-12 22:40:39'),
(31, 'edit', 2, '2022-08-12 23:37:21', '2022-08-12 23:37:21'),
(32, 'delete', 2, '2022-08-12 23:37:21', '2022-08-12 23:37:21'),
(33, 'status', 2, '2022-08-12 23:37:21', '2022-08-12 23:37:21'),
(34, 'adminarea', 2, '2022-08-12 23:37:21', '2022-08-12 23:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roleid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `picture`, `roleid`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md. Ziaur Rahman', NULL, '01798659666', NULL, 'fcea920f7412b5da7be0cf42b8c93759', 'img/12bf1f92d7.jpg', '2', '1', NULL, '2022-08-11 04:21:00', '2022-08-12 23:08:06'),
(2, 'Md. Jiyaur Rahman', NULL, '01642941816', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'img/b061956846.jpg', '2', '1', NULL, '2022-08-11 04:22:51', '2022-08-12 22:44:34'),
(3, 'Tara Mia', NULL, '01744545901', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'img/8c02fc9e88.jpg', '1', '1', NULL, '2022-08-12 22:18:32', '2022-08-12 23:06:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amounts`
--
ALTER TABLE `amounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_name_unique` (`name`);

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
-- Indexes for table `paymentgetways`
--
ALTER TABLE `paymentgetways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paymentgetways_name_unique` (`name`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_assigns`
--
ALTER TABLE `role_assigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amounts`
--
ALTER TABLE `amounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `paymentgetways`
--
ALTER TABLE `paymentgetways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_assigns`
--
ALTER TABLE `role_assigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
