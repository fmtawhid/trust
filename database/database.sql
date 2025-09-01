-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 17, 2025 at 08:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news365`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `batch_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `activity_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `ad_s`
--

CREATE TABLE `ad_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `page` int(11) NOT NULL,
  `ad_position` int(11) NOT NULL,
  `ad_type` int(11) NOT NULL DEFAULT 0,
  `embed_code` text NOT NULL,
  `large_status` int(11) NOT NULL DEFAULT 1,
  `mobile_status` int(11) NOT NULL DEFAULT 1,
  `theme` int(11) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_s`
--


-- --------------------------------------------------------

--
-- Table structure for table `ai_settings`
--

CREATE TABLE `ai_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_key` varchar(191) NOT NULL,
  `model` varchar(191) NOT NULL DEFAULT 'gpt-4o',
  `temperature` double(8,2) NOT NULL DEFAULT 0.70,
  `max_tokens` int(11) NOT NULL DEFAULT 500,
  `prompt_template` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `website` varchar(191) DEFAULT NULL,
  `prefix` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `tax_no` varchar(191) DEFAULT NULL,
  `rtl_ltr` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=LTR,2=RTL',
  `negative_amount_symbol` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=-,2=()',
  `floating_number` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = 0, 2 = 0.0 ,3= 0.00, 4= 0.000 ',
  `fixed_date` tinyint(1) NOT NULL DEFAULT 0,
  `footer_text` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `sidebar_logo` varchar(191) DEFAULT NULL,
  `favicon` varchar(191) DEFAULT NULL,
  `sidebar_collapsed_logo` varchar(191) DEFAULT NULL,
  `login_image` varchar(191) DEFAULT NULL,
  `footer_bg_img` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `state_income_tax` int(11) NOT NULL DEFAULT 5,
  `soc_sec_npf_tax` int(11) NOT NULL DEFAULT 0,
  `employer_contribution` int(11) NOT NULL DEFAULT 0 COMMENT 'Employer Contribution in Percent',
  `icf_amount` int(11) NOT NULL DEFAULT 0,
  `footer_logo` varchar(200) DEFAULT NULL,
  `app_logo` text DEFAULT NULL,
  `mobile_menu_image` varchar(200) DEFAULT NULL,
  `time_zone` varchar(200) DEFAULT NULL,
  `copy_right` text DEFAULT NULL,
  `newstriker_status` tinyint(4) DEFAULT NULL,
  `preloader_status` tinyint(4) DEFAULT NULL,
  `speed_optimization` tinyint(4) DEFAULT NULL,
  `breaking_news_limit` int(11) NOT NULL DEFAULT 0,
  `show_reporter_message` tinyint(4) NOT NULL DEFAULT 0,
  `web_user_can_login` tinyint(4) NOT NULL DEFAULT 0,
  `web_user_can_comment` tinyint(4) NOT NULL DEFAULT 0,
  `show_archive_post` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `language_id`, `currency_id`, `title`, `phone`, `email`, `website`, `prefix`, `address`, `tax_no`, `rtl_ltr`, `negative_amount_symbol`, `floating_number`, `fixed_date`, `footer_text`, `logo`, `sidebar_logo`, `favicon`, `sidebar_collapsed_logo`, `login_image`, `footer_bg_img`, `created_at`, `updated_at`, `deleted_at`, `state_income_tax`, `soc_sec_npf_tax`, `employer_contribution`, `icf_amount`, `footer_logo`, `app_logo`, `mobile_menu_image`, `time_zone`, `copy_right`, `newstriker_status`, `preloader_status`, `speed_optimization`, `breaking_news_limit`, `show_reporter_message`, `web_user_can_login`, `web_user_can_comment`, `show_archive_post`) VALUES
(1, 1, 1, 'Best PHP Newspaper Script - News365', '+880 123 4567890', 'info@bdtask.com', 'https://www.bdtask.com', 'BT', 'Dhaka, Bangladesh', '12345678', 1, 1, 1, 0, 'BDTASK © 2022. All Rights Reserved.', 'application/1748500132logo.png', 'application/1748501538sidebar-logo.png', 'application/1748525474favicon.png', 'application/1723374002sidebar-collapsed-logo.png', 'application/1748501575login-image.png', NULL, '2022-10-12 16:46:42', '2025-07-15 11:37:55', NULL, 5, 0, 0, 0, 'application/1748501369footer_logo.png', 'application/1723374017app_logo.png', 'application/1723374002mobile_menu_image.png', 'Asia/Dhaka', NULL, 1, 1, 1, 5, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `appsettings`
--

CREATE TABLE `appsettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `acceptablerange` varchar(191) DEFAULT NULL,
  `googleapi_authkey` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `website_title` text DEFAULT NULL,
  `footer_text` text DEFAULT NULL,
  `copy_right` text DEFAULT NULL,
  `time_zone` varchar(200) DEFAULT NULL,
  `ltl_rtl` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `footer_logo` varchar(200) DEFAULT NULL,
  `favicon` varchar(200) DEFAULT NULL,
  `app_logo` text DEFAULT NULL,
  `mobile_menu_image` varchar(200) DEFAULT NULL,
  `newstriker_status` tinyint(4) DEFAULT NULL,
  `share_status` tinyint(4) DEFAULT NULL,
  `preloader_status` tinyint(4) DEFAULT NULL,
  `speed_optimization` tinyint(4) DEFAULT NULL,
  `captcha` tinyint(4) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `uuid`, `language_id`, `website_title`, `footer_text`, `copy_right`, `time_zone`, `ltl_rtl`, `logo`, `footer_logo`, `favicon`, `app_logo`, `mobile_menu_image`, `newstriker_status`, `share_status`, `preloader_status`, `speed_optimization`, `captcha`, `version`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dfce03ab-ccc9-480d-977a-614e95f3b2ab', 1, 'Best PHP Newspaper Script - News365', 'BDTASK © 2022. All Rights Reserved.', NULL, 'Asia/Dhaka', '1', 'application/1748500132logo.png', 'application/1748501369footer_logo.png', 'application/1748525474favicon.png', 'application/1723374017app_logo.png', 'application/1723374002mobile_menu_image.png', 1, NULL, 1, 1, NULL, NULL, 2, 1, '2024-07-27 23:33:02', '2025-07-15 11:37:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auto_post_settings`
--

CREATE TABLE `auto_post_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform` varchar(191) NOT NULL,
  `page_id` varchar(191) DEFAULT NULL,
  `api_key` varchar(191) DEFAULT NULL,
  `api_secret` varchar(191) DEFAULT NULL,
  `access_token_secret` varchar(191) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `is_test_mode` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auto_post_settings`
--

INSERT INTO `auto_post_settings` (`id`, `platform`, `page_id`, `api_key`, `api_secret`, `access_token_secret`, `access_token`, `is_test_mode`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'facebook', NULL, NULL, NULL, NULL, NULL, 0, 0, '2025-07-24 10:21:27', '2025-07-24 11:02:05'),
(2, 'twitter', NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-07-24 10:21:27', '2025-07-24 11:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `breaking_news`
--

CREATE TABLE `breaking_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` text NOT NULL,
  `time_stamp` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `breaking_news`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `slug` text NOT NULL,
  `menu` int(11) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 1,
  `parents_id` varchar(200) DEFAULT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `category_imgae` text DEFAULT NULL,
  `img_status` tinyint(4) NOT NULL DEFAULT 0,
  `category_type` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `color_code` varchar(7) NOT NULL DEFAULT '#000000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `category_topics`
--

CREATE TABLE `category_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `cat_slug` varchar(200) DEFAULT NULL,
  `topic` varchar(100) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_topics`
--


-- --------------------------------------------------------

--
-- Table structure for table `comments_infos`
--

CREATE TABLE `comments_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `com_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `com_rating` int(11) DEFAULT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `com_user_id` int(11) NOT NULL,
  `com_replay_id` int(11) NOT NULL,
  `com_date_time` varchar(50) NOT NULL,
  `com_type` int(11) DEFAULT NULL,
  `com_status` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `country_name` varchar(191) NOT NULL,
  `country_code` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `uuid`, `country_name`, `country_code`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '69ba88c8-1e27-4d01-b974-a320dba6f4e3', 'Afghanistan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(2, '5d209625-6a42-42c5-9c1f-86d665d7d486', 'Albania', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(3, 'f9cf80d6-ec65-402d-92d2-e4c489d98baf', 'Algeria', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(4, '9a9f86f8-4c90-4ba8-96c5-a2922aa3bda7', 'Andorra', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(5, '167dca75-d5b0-4a65-b2e4-4e9a97d1d003', 'Angola', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(6, '70467888-a1f5-45f2-9cfd-273ffcd1ca65', 'Antigua and Barbuda', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(7, '0204f728-76fd-4e76-a2e7-cba8d40b8ad2', 'Argentina', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(8, '79e31d5e-fac8-4e41-9423-7afb2afc5ff5', 'Armenia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(9, '73d2516c-851e-415a-aa39-13653a449381', 'Australia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(10, 'c6dbc2f8-c3be-49f6-a4a6-ba8e4da52696', 'Austria', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(11, 'aff9b7d8-7095-4af0-b27f-fae694b02d6a', 'Azerbaijan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(12, '290c7fd4-16d4-4fa3-85d4-4cfa2b0a112e', 'Bahamas', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(13, 'c4275bd7-6947-452e-9c16-22694d392a72', 'Bahrain', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(14, '8ba1dbce-dd1e-49ed-9626-6833e8b48ebd', 'Bangladesh', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(15, '9d529e76-2ab8-484b-8d1d-51fe9cb98cbf', 'Barbados', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(16, 'ca3a0043-dfb5-4f53-b0a0-22ec3ce523cc', 'Belarus', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(17, '76ae0cee-8e6d-4d88-835f-641f93fa5127', 'Belgium', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(18, 'f351ebf5-33b1-4fdd-9521-d183f94ed75a', 'Belize', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(19, '23659e6d-9129-4f62-ba50-83f91b34ea13', 'Benin', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(20, '626f3a17-9481-412a-9791-7bdd368da5da', 'Bhutan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(21, 'c9e4d0a3-e4ef-41ad-9036-36c7216c4365', 'Bolivia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(22, '2ec76e61-66e1-455b-b88d-169e4347846a', 'Bosnia and Herzegovina', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(23, 'e021f3ea-adb4-4f1c-ba0a-5dac21aa7cca', 'Botswana', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(24, '9eb64a7f-3911-4291-aa9b-1b8801777f48', 'Brazil', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(25, 'cc1588d2-7fc1-4fc6-8b97-1c82c926112d', 'Brunei', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(26, '8af70525-2cff-4812-b7a9-9d1e9fa497b3', 'Bulgaria', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(27, '21b62226-e621-47fd-b4d9-15d289ab29db', 'Burkina Faso', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(28, 'a276a435-9273-423d-ae1a-4315cd741746', 'Burundi', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(29, 'fdfaf525-f8f3-4187-bb2f-3dbc75ae46b6', 'Cambodia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(30, 'a127d13e-099b-42ec-acfe-61a29357b17f', 'Cameroon', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(31, 'ad3402e5-cbe7-4567-b92a-86cae3ef0dd4', 'Canada', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(32, 'd3fcbbaa-44c7-47b3-b0b6-11a18938a123', 'Cape Verde', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(33, 'e180ae64-e393-43b3-a07e-7dd687e74fc6', 'Central African Republic', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(34, '38eb4c30-08fa-4cd7-ba72-928c3243f606', 'Chad', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(35, '61ef339e-7e27-44ba-8db2-f884b30b6457', 'Chile', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(36, '58187c8f-2158-4efb-9ea9-79cfb4907904', 'China', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(37, '4e8c38af-6c44-4ef6-b692-c8cad6cc1bd9', 'Colombi', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(38, '436727aa-81a9-471c-ab95-1ab0307030cd', 'Comoros', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(39, '19741b29-e9e7-41c7-bd7d-8711e8af5c2d', 'Congo (Brazzaville)', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(40, '624e2f54-5ae1-494a-ad47-752bf02f018c', 'Congo', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(41, 'bbbea94e-0d2c-4b6e-be53-49434f0a2bbc', 'Costa Rica', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(42, 'd234ae52-5a7a-4522-8f1c-f96c4c0e06a1', 'Cote d\'Ivoire', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(43, 'd7fa29b6-c87d-458d-bbbe-d76f4e2086ef', 'Croatia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(44, 'f3e7b403-d519-4009-afd8-928cfbea8c50', 'Cuba', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(45, 'a02d55f0-2f38-4e49-9382-b52362d98f71', 'Cyprus', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(46, '8e688659-f542-411c-bca9-a264fb172a69', 'Czech Republic', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(47, 'a10e88b4-fadb-49d7-b68e-190a506c0d57', 'Denmark', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(48, '1992cf51-abbb-453a-b2cb-8a87e845a6cd', 'Djibouti', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(49, 'ad7b8d7e-ab45-483f-8476-e41a62dfd943', 'Dominica', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(50, 'e17575e1-d3e1-46be-ad5a-4835da277e1c', 'Dominican Republic', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(51, 'c5da3722-3613-4f5b-b540-7f6922167225', 'East Timor (Timor Timur)', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(52, 'ca3948f8-0b8f-41db-bde9-7bfef443487b', 'Ecuador', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(53, '29d76ba7-24da-4038-bdf6-e50d293c458f', 'Egypt', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(54, 'd63cba04-b92a-4f5a-a314-8af9450378e6', 'El Salvador', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(55, 'c208d2e5-1cf1-4a2e-ae77-1fd4dcc6d797', 'Equatorial Guinea', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(56, 'f7c80da5-8664-44b9-bef0-fe5b41ee0c02', 'Eritrea', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(57, '3cfa0d34-17ac-4c33-922d-dce707d1281f', 'Estonia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(58, '99592ec1-0dc0-4db8-a220-5ffe5a0bbd01', 'Ethiopia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(59, '6a078b3e-a62b-436c-81aa-bfd67afed621', 'Fiji', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(60, 'fcb24df0-fbf1-4312-9c94-39c079024e1f', 'Finland', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(61, '5ce08abb-4ddf-439f-b972-99bf4684d5c0', 'France', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(62, 'a6a8dcdc-dfbe-4845-9dd7-039f39fc1dfa', 'Gabon', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(63, '81281a71-bd9e-456e-aefb-8b6e0eda838a', 'Gambia, The', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(64, '0b97cfa6-701d-4d1f-aad3-8b6055cdea0a', 'Georgia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(65, 'f6d926fc-2f6f-4fd1-af86-98caee7a624a', 'Germany', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(66, 'c0b38737-fa49-4b55-a2d9-9eae19f8658f', 'Ghana', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(67, '6b111be7-e916-4ae5-8777-2636c6dd3047', 'Greece', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(68, 'ef26d57f-5272-4963-9134-b78799a0304d', 'Grenada', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(69, 'dbc8dfed-959b-4818-a83c-9298112937d6', 'Guatemala', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(70, '23bf65ee-748b-46f1-8a40-fd5e21fcea2e', 'Guinea', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(71, '5d34192f-8831-4f54-bcb2-ddebae1e282b', 'Guinea-Bissau', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(72, '170af803-dfc2-4261-a729-a0f87a433b2e', 'Guyana', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(73, 'a316bc27-c358-4739-9ee1-fae6c0f2f644', 'Haiti', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(74, '9efdd469-65cb-43fd-af38-3b7a0e382d9f', 'Honduras', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(75, '6879a977-ade9-4c61-be54-1b17fa6303f2', 'Hungary', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(76, '015301a5-9d47-488f-95b5-319d9b17d501', 'Iceland', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(77, '034fc8ca-3e0c-4676-91a3-5413687a69f8', 'India', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(78, 'ee83350d-f3a3-4062-884b-12327f1fa977', 'Indonesia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(79, '8760b596-4c9a-4bb1-bb61-6a8a8e1545ab', 'Iran', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(80, '5ccbbd8c-5423-4391-b9b0-416f31ce0fb5', 'Iraq', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(81, '837eb390-3804-47b7-8e3a-3de6165be838', 'Ireland', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(82, 'cc245dc6-a7f3-4515-afb6-01c1e77df928', 'Israel', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(83, 'ed1b96f4-df91-492c-ba1f-9e2dd05da4ea', 'Italy', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(84, '12444673-8593-4d01-8a93-097ee6a268eb', 'Jamaica', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(85, '0e6eb9f1-2c5f-479d-84be-5547e9c1c15d', 'Japan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(86, '0ebd9851-d86d-41c4-b46f-e0a92a0787f5', 'Jordan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(87, '04ed7be6-a2b4-48b7-9499-5b8b802273e5', 'Kazakhstan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(88, '26ba4592-8e0c-4ce4-b169-18f585962c16', 'Kenya', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(89, 'f9df60f7-1ee3-4795-909e-ae6167d76853', 'Kiribati', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(90, '84a26fe8-d853-443d-89fd-7b9a62561ba5', 'Korea, North', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(91, 'd44a207e-f1b9-407a-92ff-f1aaee557cde', 'Korea, South', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(92, '102df1a0-2618-4125-a221-843601dfd4e0', 'Kuwait', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(93, 'a47cc161-949b-4a1d-8a6c-0b571f089df0', 'Kyrgyzstan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(94, '0a1ecad4-87b6-4601-8ef0-2de8a543872a', 'Laos', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(95, '087abadf-bf4a-410c-8bd5-22126f7e31e7', 'Latvia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(96, '6a495173-f349-48ac-9bf1-a8a3b22cd308', 'Lebanon', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(97, 'dbb1ad66-8c11-4743-a436-11728329c341', 'Lesotho', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(98, 'a2abeafc-5167-4199-8edd-3c31930053ad', 'Liberia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(99, '77d741a0-f98d-43c0-88fd-24be11a06360', 'Libya', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(100, '35e54b30-50c7-4082-a2cf-541064f7451c', 'Liechtenstein', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(101, 'cc35b8db-d745-4800-997f-f6ada2447ef5', 'Lithuania', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(102, '2e572f8a-a931-4318-ad92-7347a7d41e07', 'Luxembourg', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(103, '76ccf9df-1a99-44f2-b075-85df9c4a4ba7', 'Macedonia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(104, 'cec8c2db-ca0a-49f5-b6bc-31f59b892d05', 'Madagascar', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(105, '2a66b624-12d4-4c35-adc3-be890cba8e14', 'Malawi', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(106, '5ae73cb7-b585-4237-be06-a110c9fbc658', 'Malaysia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(107, 'ee0890fc-33e9-400d-879c-0382b4ebf94e', 'Maldives', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(108, '44c83e17-3334-4973-9b06-4b8424e32168', 'Mali', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(109, 'a0d47b91-c6e4-4ac6-89c1-bd7a53ec0635', 'Malta', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(110, '1b1eba8c-ecac-499f-a232-3d9df141daec', 'Marshall Islands', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(111, '9a4e6e33-6b41-4cd8-8a4f-8447246774ea', 'Mauritania', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(112, 'f59074d1-da9f-42c8-ac69-b9db4c844af6', 'Mauritius', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(113, 'cdb2f569-987d-4e1b-a97d-f421d8db669c', 'Mexico', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(114, 'ffc4aa68-ccf4-4316-940b-fa7779679ca8', 'Micronesia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(115, '535cd678-873d-42a8-936b-4789da94a605', 'Moldova', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(116, '5f7ddcab-e2c7-4b37-b83e-831a019f1ef9', 'Monaco', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(117, 'a0e13355-13b9-4a29-9a89-5c51c3e1286b', 'Mongolia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(118, 'aea8ff1e-2110-4ac1-9565-6cffea4a2d36', 'Morocco', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(119, 'dc15a1a1-113f-499c-ac31-46174373a016', 'Mozambique', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(120, '70eaec3c-934c-42db-9c2e-046170716b46', 'Myanmar', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(121, 'e40cb465-2525-4980-8f09-af3d89f36be0', 'Namibia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(122, '9eadf3a6-fde7-4ccc-9e3a-a5d9e56bd61f', 'Nauru', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(123, '5b4a0557-4f77-4d09-a372-4fd3f6e34b49', 'Nepal', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(124, 'bda51e35-8fc5-4ad1-aab8-428237eedb36', 'Netherlands', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(125, '5534f622-fbb9-456e-b298-3ff73ffa78cf', 'New Zealand', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(126, '9968d001-ac3f-4b14-aff6-ce2b96c031cf', 'Nicaragua', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(127, '6638cb23-c472-4d7f-be77-d9d046328c9e', 'Niger', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(128, '0152752f-7a32-4215-a9a7-8ee7ac8f3958', 'Nigeria', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(129, 'a290a3f6-4485-4f49-ae2d-77d69aeadd7d', 'Norway', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(130, '523ac8e3-742e-4556-8aa8-59f69145193c', 'Oman', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(131, '6f122b10-1163-4b53-97e6-76b6e183f62c', 'Pakistan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(132, '029764f9-69b5-490c-815e-4323817caf31', 'Palau', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(133, '54c517fd-9785-4b1d-9cb6-48cfa801305b', 'Panama', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(134, 'd85f6e94-26e7-4405-98e7-fd1216120d52', 'Papua New Guinea', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(135, 'd3ece26c-2e25-4f2f-b57a-86496e259acd', 'Paraguay', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(136, '6f91303b-36a8-4f14-98b2-20f24dca2afe', 'Peru', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(137, 'ba07cf9e-34e9-40ee-91d6-fceedfe03a9b', 'Philippines', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(138, 'e7532806-51ce-4cb1-9e76-80bc78f1c7ae', 'Poland', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(139, 'a5c3513d-0f1b-41df-964e-442a3533c001', 'Portugal', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(140, 'c133d526-3eb8-48f5-893a-2576e50c012b', 'Qatar', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(141, '7093f409-af1f-49bf-90e6-e66dca589e96', 'Romania', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(142, '3e3d30e2-f51a-4d12-a290-c52793105a9d', 'Russia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(143, '746f3f08-1558-47da-bab2-021e8ece795e', 'Rwanda', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(144, '80ab2a9d-0d08-44ae-81ca-25c08823972e', 'Saint Kitts and Nevis', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(145, 'dd416aad-0526-4ed5-bbb9-8bcab2e204bb', 'Saint Lucia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(146, '0b18800a-b950-4006-8f98-d772e2016f03', 'Saint Vincent', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(147, '2a4e5d49-b066-49df-87eb-8c156c47355a', 'Samoa', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(148, '08054fb9-e992-4fd5-a0ba-226c7125bf77', 'San Marino', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(149, 'd641fb68-5fc4-4fc0-83c7-6c878c4473aa', 'Sao Tome and Principe', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(150, '7732e9ca-008d-4a88-9e75-12233f6c83cb', 'Saudi Arabia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(151, '6749069d-de34-4838-92e7-251681d71b9d', 'Senegal', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(152, 'f8f90a0e-6b89-49c6-9e10-28da766fc9b1', 'Serbia and Montenegro', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(153, 'ed64dc48-b6d0-4e39-97d8-b5a944781704', 'Seychelles', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(154, '5ba4fc4c-4047-499c-8a22-378d3ca99497', 'Sierra Leone', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(155, 'b5f08287-71ad-473f-99ed-03b80a1ae720', 'Singapore', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(156, '58711e44-4850-4b8e-8133-94514c7c8e43', 'Slovakia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(157, 'c15fd69c-2bb0-40ec-99d9-629cb6074768', 'Slovenia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(158, 'de86c278-f0b3-4d45-84ab-9cec9d9be209', 'Solomon Islands', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(159, '8fe4aa15-4e39-4ac1-a839-a30ff047c184', 'Somalia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(160, 'de3f2f9d-ad79-4556-afd7-b3bedc7c1baf', 'South Africa', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(161, '34403eaa-7d29-45ed-acd9-8ead84bf7025', 'Spain', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(162, 'ac704b44-5da5-4772-8452-ee09bd31a5db', 'Sri Lanka', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(163, 'dd7c6b18-b739-491f-a86f-3f65c853354d', 'Sudan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(164, '974fe448-68cc-4f77-ac66-22f54dff4f25', 'Suriname', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(165, '23c902e3-215a-427c-86a5-478aeaa84ebb', 'Swaziland', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(166, 'dd9d4254-a0e3-4b91-9dba-b72684c9622c', 'Sweden', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(167, 'c3d374b9-c11d-4c65-b64a-38a9f6b6b082', 'Switzerland', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(168, '0563be1b-deba-4a16-8b30-ed38147e1ada', 'Syria', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(169, '0304e100-e382-43c2-9a48-f52a7ac39610', 'Taiwan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(170, '9061369f-a83a-4b5b-ab63-68527a605b3c', 'Tajikistan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(171, 'fa2392dc-b990-4e00-a665-af3babd45664', 'Tanzania', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(172, 'c8045da7-31ee-4486-b87b-8404ec436019', 'Thailand', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(173, '979091fc-012a-433c-ab6b-80b43a3d1a03', 'Togo', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(174, '6f0465cd-5e60-4412-9b8f-c46da777d261', 'Tonga', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(175, '333c8d05-18fd-4044-82b2-dfd6d9bf5a67', 'Trinidad and Tobago', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(176, '8b2cb979-621a-44ea-9591-defffeeaa378', 'Tunisia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(177, '7f15880e-098b-44c2-92dd-94636341b794', 'Turkey', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(178, 'b32df125-f78d-4e59-9671-6a81c66d6506', 'Turkmenistan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(179, '11b7cbe7-d50e-4ca8-87d0-d76455dbc5ce', 'Tuvalu', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(180, '95ec8dd5-65b7-411b-af0d-412653300d5b', 'Uganda', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(181, 'd773995e-06e8-482b-a6ad-006d0b9b0da2', 'Ukraine', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(182, '1261dddc-fbfd-4226-aae5-806fb1003879', 'United Arab Emirates', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(183, 'db728883-b40e-452a-a11a-d02865a2ac71', 'United Kingdom', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(184, '26716b8c-3218-4ba1-b84f-06032f5d8536', 'United States', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(185, '3cb3ccec-a942-4277-b560-cda0a90523f5', 'Uruguay', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(186, '5080a918-4985-4e85-a8f4-d26c5b9c5f9b', 'Uzbekistan', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(187, 'ed2f011c-8c60-4a9c-8854-6b191e8f35c2', 'Vanuatu', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(188, '59b8543e-d35c-452c-8ad4-a418bbb88ad8', 'Vatican City', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(189, '17cb8aa6-4f48-4b86-9edc-c9740d60d4ff', 'Venezuela', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(190, 'a6f56eec-e0ee-472b-8193-07d1d232a7cc', 'Vietnam', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(191, 'e245ca03-f33c-4b1b-8546-ac6e7ede7871', 'Yemen', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(192, '11d57872-f664-46db-93ba-1f29387b4571', 'Zambia', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL),
(193, 'f0c0a0b0-26e1-4bef-906f-acee3e9aeae3', 'Zimbabwe', NULL, 1, NULL, NULL, '2022-12-05 14:59:04', '2022-12-05 14:59:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `symbol` char(191) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `country_id`, `title`, `symbol`, `status`, `created_at`, `updated_at`) VALUES
(1, 14, 'Taka', '৳', 1, '2024-06-26 10:49:45', '2024-06-26 10:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Reporting', NULL, NULL, NULL, NULL, NULL),
(2, 'Central', NULL, NULL, NULL, NULL, NULL),
(3, 'Country', NULL, NULL, NULL, NULL, NULL),
(4, 'Feature', NULL, NULL, NULL, NULL, NULL),
(5, 'Game', NULL, NULL, NULL, NULL, NULL),
(6, 'International', NULL, NULL, NULL, NULL, NULL),
(7, 'Editorial and research', NULL, NULL, NULL, NULL, NULL),
(8, 'Business Development and Marketing Department', NULL, NULL, NULL, NULL, NULL),
(9, 'Web', NULL, NULL, NULL, NULL, NULL),
(10, 'Social media', NULL, NULL, NULL, NULL, NULL),
(11, 'Video section', NULL, NULL, NULL, NULL, NULL),
(12, 'Administration Department', NULL, NULL, NULL, NULL, NULL),
(13, 'Others', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lon` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_expired_settings`
--

CREATE TABLE `doc_expired_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `primary_expiration_alert` int(11) NOT NULL COMMENT 'Primary Expiration Alert in Days',
  `secondary_expiration_alert` int(11) NOT NULL COMMENT 'Secondary Expiration Alert in Days',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_configs`
--

CREATE TABLE `email_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `protocol` text NOT NULL,
  `smtp_host` text NOT NULL,
  `smtp_port` text NOT NULL,
  `smtp_user` varchar(191) NOT NULL,
  `smtp_pass` varchar(191) NOT NULL,
  `mailtype` varchar(191) NOT NULL,
  `isinvoice` tinyint(4) NOT NULL,
  `isservice` tinyint(4) NOT NULL,
  `isquotation` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_configs`
--


-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `font_families`
--

CREATE TABLE `font_families` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `font_style` varchar(191) NOT NULL,
  `font_path` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `font_settings`
--

CREATE TABLE `font_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source_url` mediumtext DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `font_family` varchar(191) NOT NULL,
  `source` enum('1','2') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `font_settings`
--

INSERT INTO `font_settings` (`id`, `source_url`, `name`, `font_family`, `source`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'https://fonts.googleapis.com/css2?family=Mina:wght@400;700&display=swap', 'Mina', '\"Mina\", sans-serif', '2', 1, NULL, '2025-07-07 18:30:29', '2025-07-07 18:30:29'),
(3, 'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap', 'Hind Siliguri', '\"Hind Siliguri\", sans-serif;', '2', 1, NULL, '2025-07-07 18:33:17', '2025-07-07 18:33:17'),
(4, 'https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@100..900&display=swap', 'Noto Sans Bengali', '\"Noto Sans Bengali\", sans-serif', '2', 1, NULL, '2025-07-07 18:59:23', '2025-07-07 18:59:23'),
(5, 'https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap', 'Tiro Bangla', '\"Tiro Bangla\", serif', '2', 1, NULL, '2025-07-07 19:01:12', '2025-07-07 19:01:12'),
(6, 'https://fonts.maateen.me/bensen-handwriting/font.css', 'BenSen Handwriting', '\'BenSen Handwriting\', cursive;', '2', 1, NULL, '2025-07-07 19:10:18', '2025-07-07 19:10:18'),
(7, 'https://fonts.maateen.me/baloo-da-2/font.css', 'Baloo Da 2', '\'Baloo Da 2\', sans-serif;', '2', 1, NULL, '2025-07-08 11:14:13', '2025-07-08 11:14:13'),
(8, 'https://fonts.maateen.me/solaiman-lipi/font.css', 'SolaimanLipi', '\'SolaimanLipi\', sans-serif;', '2', 1, NULL, '2025-07-08 11:14:58', '2025-07-08 11:14:58'),
(9, 'https://fonts.maateen.me/adorsho-lipi/font.css', 'Adorsho Lipi', '\'Adorsho Lipi\', sans-serif;', '2', 1, NULL, '2025-07-08 11:18:17', '2025-07-08 11:18:17'),
(10, 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap', 'Lato', '\"Lato\", sans-serif;', '2', 1, NULL, '2025-07-08 11:28:23', '2025-07-08 11:28:23'),
(11, 'https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap', 'Ubuntu', '\"Ubuntu\", sans-serif;', '2', 1, NULL, '2025-07-08 11:32:19', '2025-07-08 11:32:19'),
(12, 'https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap', 'Noto Serif', '\"Noto Serif\", serif;', '2', 1, NULL, '2025-07-08 11:37:37', '2025-07-08 11:37:37'),
(13, 'https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap', 'Cairo', '\"Cairo\", sans-serif;', '2', 1, NULL, '2025-07-08 12:28:03', '2025-07-08 12:28:03'),
(14, 'https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&display=swap', 'Alexandria', '\"Alexandria\", sans-serif;', '2', 1, NULL, '2025-07-08 12:29:29', '2025-07-08 12:29:29'),
(15, 'https://fonts.googleapis.com/css2?family=Reem+Kufi:wght@400..700&display=swap', 'Reem Kufi', '\"Reem Kufi\", sans-serif;', '2', 1, NULL, '2025-07-08 12:30:47', '2025-07-08 12:30:47'),
(16, 'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100..900&display=swap', 'Noto Sans Arabic', '\"Noto Sans Arabic\", sans-serif;', '2', 1, NULL, '2025-07-08 12:36:39', '2025-07-08 12:36:39'),
(17, 'https://fonts.google.com/specimen/Reddit+Sans', 'Reddit Sans', 'serif', '2', 1, 1, '2025-07-10 13:42:42', '2025-07-10 13:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `font_setups`
--

CREATE TABLE `font_setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `font_setting_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1: Principal, 2: Alternate, 3: Supplementary',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `font_setups`
--


-- --------------------------------------------------------

--
-- Table structure for table `home_page_positions`
--

CREATE TABLE `home_page_positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `position_no` int(11) NOT NULL,
  `cat_name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `max_news` varchar(200) DEFAULT NULL,
  `category_id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_positions`
--


-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `value` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `name`, `value`) VALUES
(1, 'English', 'en'),
(2, 'Afar', 'aa'),
(3, 'Abkhazian', 'ab'),
(4, 'Afrikaans', 'af'),
(5, 'Amharic', 'am'),
(6, 'Arabic', 'ar'),
(7, 'Assamese', 'as'),
(8, 'Aymara', 'ay'),
(9, 'Azerbaijani', 'az'),
(10, 'Bashkir', 'ba'),
(11, 'Belarusian', 'be'),
(12, 'Bulgarian', 'bg'),
(13, 'Bihari', 'bh'),
(14, 'Bislama', 'bi'),
(15, 'Bengali/Bangla', 'bn'),
(16, 'Tibetan', 'bo'),
(17, 'Breton', 'br'),
(18, 'Catalan', 'ca'),
(19, 'Corsican', 'co'),
(20, 'Czech', 'cs'),
(21, 'Welsh', 'cy'),
(22, 'Danish', 'da'),
(23, 'German', 'de'),
(24, 'Bhutani', 'dz'),
(25, 'Greek', 'el'),
(26, 'Esperanto', 'eo'),
(27, 'Spanish', 'es'),
(28, 'Estonian', 'et'),
(29, 'Basque', 'eu'),
(30, 'Persian', 'fa'),
(31, 'Finnish', 'fi'),
(32, 'Fiji', 'fj'),
(33, 'Faeroese', 'fo'),
(34, 'French', 'fr'),
(35, 'Frisian', 'fy'),
(36, 'Irish', 'ga'),
(37, 'Scots/Gaelic', 'gd'),
(38, 'Galician', 'gl'),
(39, 'Guarani', 'gn'),
(40, 'Gujarati', 'gu'),
(41, 'Hausa', 'ha'),
(42, 'Hindi', 'hi'),
(43, 'Croatian', 'hr'),
(44, 'Hungarian', 'hu'),
(45, 'Armenian', 'hy'),
(46, 'Interlingua', 'ia'),
(47, 'Interlingue', 'ie'),
(48, 'Inupiak', 'ik'),
(49, 'Indonesian', 'in'),
(50, 'Icelandic', 'is'),
(51, 'Italian', 'it'),
(52, 'Hebrew', 'iw'),
(53, 'Japanese', 'ja'),
(54, 'Yiddish', 'ji'),
(55, 'Javanese', 'jw'),
(56, 'Georgian', 'ka'),
(57, 'Kazakh', 'kk'),
(58, 'Greenlandic', 'kl'),
(59, 'Cambodian', 'km'),
(60, 'Kannada', 'kn'),
(61, 'Korean', 'ko'),
(62, 'Kashmiri', 'ks'),
(63, 'Kurdish', 'ku'),
(64, 'Kirghiz', 'ky'),
(65, 'Latin', 'la'),
(66, 'Lingala', 'ln'),
(67, 'Laothian', 'lo'),
(68, 'Lithuanian', 'lt'),
(69, 'Latvian/Lettish', 'lv'),
(70, 'Malagasy', 'mg'),
(71, 'Maori', 'mi'),
(72, 'Macedonian', 'mk'),
(73, 'Malayalam', 'ml'),
(74, 'Mongolian', 'mn'),
(75, 'Moldavian', 'mo'),
(76, 'Marathi', 'mr'),
(77, 'Malay', 'ms'),
(78, 'Maltese', 'mt'),
(79, 'Burmese', 'my'),
(80, 'Nauru', 'na'),
(81, 'Nepali', 'ne'),
(82, 'Dutch', 'nl'),
(83, 'Norwegian', 'no'),
(84, 'Occitan', 'oc'),
(85, '(Afan)/Oromoor/Oriya', 'om'),
(86, 'Punjabi', 'pa'),
(87, 'Polish', 'pl'),
(88, 'Pashto/Pushto', 'ps'),
(89, 'Portuguese', 'pt'),
(90, 'Quechua', 'qu'),
(91, 'Rhaeto-Romance', 'rm'),
(92, 'Kirundi', 'rn'),
(93, 'Romanian', 'ro'),
(94, 'Russian', 'ru'),
(95, 'Kinyarwanda', 'rw'),
(96, 'Sanskrit', 'sa'),
(97, 'Sindhi', 'sd'),
(98, 'Sangro', 'sg'),
(99, 'Serbo-Croatian', 'sh'),
(100, 'Singhalese', 'si'),
(101, 'Slovak', 'sk'),
(102, 'Slovenian', 'sl'),
(103, 'Samoan', 'sm'),
(104, 'Shona', 'sn'),
(105, 'Somali', 'so'),
(106, 'Albanian', 'sq'),
(107, 'Serbian', 'sr'),
(108, 'Siswati', 'ss'),
(109, 'Sesotho', 'st'),
(110, 'Sundanese', 'su'),
(111, 'Swedish', 'sv'),
(112, 'Swahili', 'sw'),
(113, 'Tamil', 'ta'),
(114, 'Telugu', 'te'),
(115, 'Tajik', 'tg'),
(116, 'Thai', 'th'),
(117, 'Tigrinya', 'ti'),
(118, 'Turkmen', 'tk'),
(119, 'Tagalog', 'tl'),
(120, 'Setswana', 'tn'),
(121, 'Tonga', 'to'),
(122, 'Turkish', 'tr'),
(123, 'Tsonga', 'ts'),
(124, 'Tatar', 'tt'),
(125, 'Twi', 'tw'),
(126, 'Ukrainian', 'uk'),
(127, 'Urdu', 'ur'),
(128, 'Uzbek', 'uz'),
(129, 'Vietnamese', 'vi'),
(130, 'Volapuk', 'vo'),
(131, 'Wolof', 'wo'),
(132, 'Xhosa', 'xh'),
(133, 'Yoruba', 'yo'),
(134, 'Chinese', 'zh'),
(135, 'Zulu', 'zu');

-- --------------------------------------------------------

--
-- Table structure for table `langstrings`
--

CREATE TABLE `langstrings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `langstrvals`
--

CREATE TABLE `langstrvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `localize_id` bigint(20) UNSIGNED NOT NULL,
  `langstring_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `langname` varchar(191) NOT NULL,
  `value` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `langname`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '2022-12-08 00:29:24', '2022-12-08 00:29:24'),
(2, 'Arabic', 'ar', 1, '2024-08-04 10:03:42', '2024-08-04 10:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` text NOT NULL,
  `url` varchar(120) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `links`
--


-- --------------------------------------------------------

--
-- Table structure for table `max_archive_settings`
--

CREATE TABLE `max_archive_settings` (
  `category_id` int(11) NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `max_archive` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `max_archive_settings`
--


-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `style` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `mobile_status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `position`, `style`, `status`, `mobile_status`, `created_at`, `updated_at`) VALUES
(1, 'Main Menu', 1, NULL, 1, 1, '2024-07-07 03:18:50', '2024-07-07 03:18:50'),
(2, 'Footer Category', 2, NULL, 1, 1, '2024-07-07 03:18:50', '2025-05-28 07:03:45'),
(3, 'Footer Menu', 3, NULL, 1, 1, '2024-07-07 03:18:50', '2025-05-28 07:14:02'),
(4, 'Footer Page', NULL, NULL, 1, 1, '2025-05-28 03:38:08', '2025-05-28 07:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `menu_contents`
--

CREATE TABLE `menu_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `content_type` text DEFAULT NULL,
  `content_id` bigint(20) DEFAULT NULL,
  `menu_position` int(11) DEFAULT NULL,
  `menu_level` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `menu_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_contents`
--


-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_04_06_050120_create_pictures_table', 1),
(5, '2022_04_13_032828_create_applications_table', 1),
(6, '2022_04_13_050141_create_currencies_table', 1),
(7, '2022_04_18_075935_create_email_configs_table', 1),
(8, '2022_08_06_043012_create_users_table', 1),
(9, '2022_08_06_043013_create_user_types_table', 1),
(10, '2022_08_06_054634_create_password_settings_table', 1),
(11, '2022_08_08_034517_create_countries_table', 1),
(12, '2022_10_10_100252_create_permission_tables', 1),
(13, '2022_10_10_102515_create_per_menus_table', 1),
(14, '2022_11_10_035218_create_notifications_table', 1),
(15, '2022_12_07_071056_create_languages_table', 1),
(16, '2022_12_07_094945_create_langstrings_table', 1),
(17, '2022_12_07_095044_create_langstrvals_table', 1),
(18, '2023_04_29_104322_create_zkts_table', 1),
(19, '2023_05_07_094405_create_doc_expired_settings_table', 1),
(20, '2023_07_23_103802_create_prefixes_table', 1),
(21, '2023_08_13_104855_create_activity_log_table', 1),
(22, '2023_08_13_104856_add_event_column_to_activity_log_table', 1),
(23, '2023_08_13_104857_add_batch_uuid_column_to_activity_log_table', 1),
(24, '2024_05_05_053538_update_applications_table', 1),
(25, '2024_05_16_114541_create_appsettings_table', 1),
(26, '2024_06_10_064636_create_categories_table', 1),
(27, '2024_06_10_133007_create_category_topics_table', 1),
(28, '2024_06_11_080405_create_settings_table', 1),
(29, '2024_06_11_090858_create_advertisements_table', 1),
(30, '2024_06_12_104021_create_reporters_table', 1),
(31, '2024_06_13_065421_create_departments_table', 1),
(32, '2024_06_26_103727_create_pages_table', 2),
(40, '2024_07_02_133009_create_news_msts_table', 3),
(41, '2024_07_02_134555_create_photo_libraries_table', 3),
(43, '2024_07_02_174147_create_breaking_news_table', 4),
(44, '2024_07_03_121210_create_news_positions_table', 5),
(45, '2024_07_03_141901_create_post_seo_onpages_table', 6),
(46, '2024_07_03_145656_create_post_tags_table', 6),
(47, '2024_07_03_150558_create_schema_posts_table', 7),
(48, '2024_07_04_053959_create_top_breakings_table', 8),
(50, '2024_07_07_125014_create_menus_table', 9),
(51, '2024_07_07_181536_create_menu_contents_table', 10),
(52, '2024_07_07_185148_create_links_table', 11),
(53, '2024_07_08_101512_create_max_archive_settings_table', 12),
(54, '2024_07_08_101738_create_news_archives_table', 12),
(55, '2024_07_09_121219_create_news_routings_table', 12),
(56, '2024_07_10_153917_create_photo_posts_table', 13),
(57, '2024_07_10_162533_create_photo_post_details_table', 14),
(58, '2024_07_10_095451_add_logo_to_applications_table', 15),
(60, '2024_07_13_084058_create_comments_infos_table', 16),
(61, '2024_07_13_092407_create_subscriptions_table', 16),
(62, '2024_07_13_161905_create_space_credentials_table', 16),
(63, '2024_07_15_125006_add_disk_to_photo_libraries_table', 17),
(64, '2024_07_25_123841_add_image_title_to_news_msts_table', 18),
(65, '2024_07_25_135417_create_divisions_table', 19),
(66, '2024_07_25_140746_create_districts_table', 20),
(68, '2024_07_25_145009_create_upazilas_table', 21),
(71, '2024_08_04_103232_create_home_page_positions_table', 22),
(72, '2025_04_23_144008_create_opinions_table', 23),
(73, '2025_04_23_194008_create_themes_table', 24),
(74, '2025_04_24_124118_add_colors_to_themes_table', 24),
(75, '2025_04_24_185352_create_polls_table', 25),
(76, '2025_04_27_102833_create_poll_options_table', 25),
(77, '2025_04_28_180151_create_video_news_table', 26),
(78, '2025_04_27_112012_create_stories_table', 27),
(79, '2025_04_27_115247_create_story_details_table', 27),
(80, '2025_05_05_160924_add_breaking_news_limit_to_applications_table', 28),
(81, '2025_05_06_144955_update_category_column_in_photo_posts_table', 29),
(82, '2025_05_06_184139_update_category_in_top_breakings_table', 30),
(83, '2025_05_06_124543_add_reporter_message_to_news_mst_table', 31),
(84, '2025_05_07_103741_add_category_id_to_news_positions_table', 32),
(85, '2025_05_07_190749_remove_language_id_from_polls_table', 32),
(86, '2025_05_07_192948_remove_language_id_from_video_news_table', 33),
(87, '2025_05_11_173058_add_language_id_to_categories_table', 34),
(88, '2025_05_12_102856_add_language_id_to_opinions_table', 35),
(89, '2025_05_12_123019_add_language_id_to_polls_table', 36),
(90, '2025_05_12_160639_add_language_id_to_video_news_table', 37),
(91, '2025_05_12_180608_add_language_id_to_pages_table', 38),
(92, '2025_05_13_104710_add_language_id_to_advertisements_table', 39),
(93, '2025_05_13_123558_add_language_id_to_news_msts_table', 40),
(94, '2025_05_07_124543_add_reporter_message_to_news_mst_table', 41),
(95, '2025_05_13_123550_add_reporter_message_to_news_mst_table', 42),
(96, '2025_05_13_123555_add_language_id_to_news_msts_table', 42),
(97, '2025_05_12_145308_add_language_id_to_app_settings_table', 43),
(98, '2025_05_13_160805_add_language_id_to_stories_table', 43),
(99, '2025_05_14_103414_add_language_id_to_breaking_news_table', 44),
(100, '2025_05_14_121836_add_language_id_to_photo_posts_table', 45),
(101, '2025_05_14_175235_add_color_code_to_categories_table', 46),
(102, '2025_05_14_184812_add_deleted_at_to_opinions_table', 47),
(103, '2025_05_14_191205_add_deleted_at_to_polls_table', 48),
(104, '2025_05_14_192204_add_deleted_at_to_video_news_table', 49),
(105, '2025_05_17_161102_add_foreign_key_to_comments_infos_table', 50),
(106, '2025_05_19_114809_create_news_position_maps_table', 51),
(107, '2025_05_19_174952_add_news_id_to_breaking_news_table', 52),
(108, '2025_05_27_181746_add_encode_title_to_video_news_table', 53),
(109, '2025_05_28_193745_create_subscribers_table', 54),
(110, '2025_05_29_104955_change_theme_column_type_in_advertisements_table', 54),
(111, '2025_05_29_122960_add_language_id_to_home_page_positions_table', 55),
(113, '2025_05_31_120100_create_web_users_table', 56),
(114, '2025_06_02_153428_add_slug_to_stories_table', 57),
(115, '2025_06_04_144010_create_opinions_table', 58),
(116, '2025_06_15_120109_add_language_id_to_menu_contents_table', 59),
(117, '2025_06_16_163225_create_social_login_api_keys_table', 60),
(118, '2025_06_16_194806_add_bg_image_to_web_users_table', 61),
(119, '2025_06_17_151538_create_news_comments_table', 61),
(120, '2025_06_17_151559_create_news_comment_replies_table', 61),
(121, '2025_06_16_194806_add_remember_token_to_web_users_table', 62),
(122, '2025_06_19_142842_add_opinions_id_to_news_comments_table', 62),
(123, '2025_06_19_160924_add_show_reporter_message_to_applications_table', 62),
(124, '2025_06_19_174404_add_is_approved_to_news_comment_replies_table', 62),
(125, '2025_06_22_160921_add_webuser_approval_to_applications_table', 63),
(126, '2025_06_22_165929_add_columns_to_themes_table', 63),
(127, '2025_06_23_123433_create_font_families_table', 64),
(128, '2025_06_23_165800_add_column_to_applications_table', 64),
(129, '2025_07_03_175900_create_font_settings_table', 65),
(130, '2025_07_07_120149_create_font_setups_table', 66),
(131, '2025_07_09_145740_create_rss_feeds_table', 67),
(132, '2025_07_14_160506_add_show_archive_post_to_applications_table', 68),
(133, '2025_07_15_105655_add_column_to_news_archives_table', 69),
(134, '2025_07_10_145656_ai_settings', 70),
(135, '2025_07_16_104710_add_ad_type_to_advertisements_table', 71);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_archives`
--

CREATE TABLE `news_archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `news_id` int(11) NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `encode_title` varchar(200) NOT NULL,
  `seo_title` text DEFAULT NULL,
  `stitle` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `news` longtext NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `image_base_url` varchar(250) DEFAULT NULL,
  `videos` varchar(250) DEFAULT NULL,
  `podcust_id` int(11) DEFAULT NULL,
  `image_alt` varchar(200) DEFAULT NULL,
  `image_title` varchar(200) DEFAULT NULL,
  `reporter` varchar(56) DEFAULT NULL,
  `reporter_message` text DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `ref_date` varchar(56) DEFAULT NULL,
  `post_by` varchar(56) DEFAULT NULL,
  `reporter_id` bigint(20) DEFAULT NULL,
  `update_by` varchar(56) DEFAULT NULL,
  `time_stamp` int(11) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `last_update` datetime NOT NULL,
  `is_latest` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_recommanded` tinyint(1) NOT NULL DEFAULT 0,
  `reader_hit` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_archives`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_mst_id` bigint(20) UNSIGNED DEFAULT NULL,
  `video_news_id` bigint(20) UNSIGNED DEFAULT NULL,
  `opinion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `web_user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_comment_replies`
--

CREATE TABLE `news_comment_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_comment_id` bigint(20) UNSIGNED NOT NULL,
  `web_user_id` bigint(20) UNSIGNED NOT NULL,
  `reply` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_comment_replies`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_msts`
--

CREATE TABLE `news_msts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `news_id` bigint(20) NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `encode_title` varchar(200) NOT NULL,
  `seo_title` text DEFAULT NULL,
  `stitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `news` longtext NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `image_base_url` varchar(250) DEFAULT NULL,
  `videos` varchar(250) DEFAULT NULL,
  `podcust_id` bigint(20) DEFAULT NULL,
  `image_alt` varchar(250) DEFAULT NULL,
  `image_title` varchar(250) DEFAULT NULL,
  `reporter` varchar(250) DEFAULT NULL,
  `reporter_message` text DEFAULT NULL,
  `page` varchar(250) DEFAULT NULL,
  `reference` varchar(250) DEFAULT NULL,
  `ref_date` date DEFAULT NULL,
  `post_by` varchar(250) DEFAULT NULL,
  `reporter_id` bigint(20) DEFAULT NULL,
  `update_by` varchar(250) DEFAULT NULL,
  `time_stamp` int(11) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `last_update` datetime NOT NULL,
  `is_latest` bigint(20) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_recommanded` tinyint(1) NOT NULL DEFAULT 0,
  `reader_hit` bigint(20) DEFAULT NULL,
  `is_auto_post` tinyint(1) NOT NULL DEFAULT 1,
  `is_posted_to_social` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_msts`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_positions`
--

CREATE TABLE `news_positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) NOT NULL,
  `page` varchar(100) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_positions`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_position_maps`
--

CREATE TABLE `news_position_maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `home_position` int(11) DEFAULT NULL COMMENT 'Position on the homepage',
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_position` int(11) DEFAULT NULL COMMENT 'Position within a category',
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_position` int(11) DEFAULT NULL COMMENT 'Position within a sub category',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_position_maps`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_routings`
--

CREATE TABLE `news_routings` (
  `news_id` varchar(50) NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `table_name` text DEFAULT NULL,
  `routing_id` varchar(50) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opinions`
--

CREATE TABLE `opinions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `designation` varchar(191) DEFAULT NULL,
  `encode_title` varchar(200) NOT NULL,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `person_image` varchar(191) DEFAULT NULL,
  `news_image` varchar(191) DEFAULT NULL,
  `image_alt` varchar(191) DEFAULT NULL,
  `image_title` varchar(191) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `meta_keyword` varchar(191) DEFAULT NULL,
  `meta_description` varchar(191) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opinions`
--


-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `page_id` int(11) NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `page_slug` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image_id` varchar(100) DEFAULT NULL,
  `galary_id` int(11) DEFAULT NULL,
  `video_url` varchar(100) DEFAULT NULL,
  `publishar_id` int(11) DEFAULT NULL,
  `seo_keyword` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `publish_date` datetime DEFAULT NULL,
  `reader_view` int(11) DEFAULT NULL,
  `releted_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--


-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_settings`
--

CREATE TABLE `password_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `salt` varchar(191) NOT NULL,
  `min_length` int(11) NOT NULL,
  `max_lifetime` int(11) NOT NULL,
  `password_complexcity` varchar(191) NOT NULL,
  `password_history` varchar(191) NOT NULL,
  `lock_out_duration` varchar(191) NOT NULL,
  `session_idle_logout_time` varchar(191) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `per_menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `per_menu_id`, `created_at`, `updated_at`) VALUES
(1, 'read_dashboard', 'web', 1, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(2, 'create_advertise', 'web', 2, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(3, 'read_advertise', 'web', 2, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(4, 'update_advertise', 'web', 2, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(5, 'delete_advertise', 'web', 2, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(6, 'create_update_advertise', 'web', 3, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(7, 'read_update_advertise', 'web', 3, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(8, 'update_update_advertise', 'web', 3, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(9, 'delete_update_advertise', 'web', 3, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(10, 'create_analytics', 'web', 4, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(11, 'read_analytics', 'web', 4, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(12, 'update_analytics', 'web', 4, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(13, 'delete_analytics', 'web', 4, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(14, 'create_live_now', 'web', 5, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(15, 'read_live_now', 'web', 5, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(16, 'update_live_now', 'web', 5, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(17, 'delete_live_now', 'web', 5, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(18, 'create_location_Based', 'web', 6, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(19, 'read_location_Based', 'web', 6, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(20, 'update_location_Based', 'web', 6, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(21, 'delete_location_Based', 'web', 6, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(22, 'create_news_based', 'web', 7, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(23, 'read_news_based', 'web', 7, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(24, 'update_news_based', 'web', 7, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(25, 'delete_news_based', 'web', 7, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(26, 'create_clear_analytics', 'web', 8, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(27, 'read_clear_analytics', 'web', 8, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(28, 'update_clear_analytics', 'web', 8, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(29, 'delete_clear_analytics', 'web', 8, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(30, 'create_archive_setting', 'web', 9, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(31, 'read_archive_setting', 'web', 9, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(32, 'update_archive_setting', 'web', 9, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(33, 'delete_archive_setting', 'web', 9, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(34, 'create_category', 'web', 10, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(35, 'read_category', 'web', 10, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(36, 'update_category', 'web', 10, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(37, 'delete_category', 'web', 10, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(38, 'create_comment', 'web', 11, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(39, 'read_comment', 'web', 11, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(40, 'update_comment', 'web', 11, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(41, 'delete_comment', 'web', 11, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(42, 'create_media_library', 'web', 12, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(43, 'read_media_library', 'web', 12, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(44, 'update_media_library', 'web', 12, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(45, 'delete_media_library', 'web', 12, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(46, 'create_photo_upload', 'web', 13, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(47, 'read_photo_upload', 'web', 13, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(48, 'update_photo_upload', 'web', 13, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(49, 'delete_photo_upload', 'web', 13, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(50, 'create_photo_list', 'web', 14, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(51, 'read_photo_list', 'web', 14, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(52, 'update_photo_list', 'web', 14, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(53, 'delete_photo_list', 'web', 14, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(54, 'create_menu_setup', 'web', 15, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(55, 'read_menu_setup', 'web', 15, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(56, 'update_menu_setup', 'web', 15, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(57, 'delete_menu_setup', 'web', 15, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(58, 'create_news', 'web', 16, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(59, 'read_news', 'web', 16, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(60, 'update_news', 'web', 16, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(61, 'delete_news', 'web', 16, '2024-06-26 10:49:45', '2024-06-26 10:49:45'),
(62, 'create_post', 'web', 17, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(63, 'read_post', 'web', 17, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(64, 'update_post', 'web', 17, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(65, 'delete_post', 'web', 17, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(66, 'create_breaking_news', 'web', 18, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(67, 'read_breaking_news', 'web', 18, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(68, 'update_breaking_news', 'web', 18, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(69, 'delete_breaking_news', 'web', 18, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(70, 'create_positioning', 'web', 19, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(71, 'read_positioning', 'web', 19, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(72, 'update_positioning', 'web', 19, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(73, 'delete_positioning', 'web', 19, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(74, 'create_photo_post', 'web', 20, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(75, 'read_photo_post', 'web', 20, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(76, 'update_photo_post', 'web', 20, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(77, 'delete_photo_post', 'web', 20, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(78, 'create_page', 'web', 21, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(79, 'read_page', 'web', 21, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(80, 'update_page', 'web', 21, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(81, 'delete_page', 'web', 21, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(82, 'create_page_list', 'web', 22, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(83, 'read_page_list', 'web', 22, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(84, 'update_page_list', 'web', 22, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(85, 'delete_page_list', 'web', 22, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(86, 'create_reporter', 'web', 23, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(87, 'read_reporter', 'web', 23, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(88, 'update_reporter', 'web', 23, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(89, 'delete_reporter', 'web', 23, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(90, 'create_subscribers', 'web', 24, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(91, 'read_subscribers', 'web', 24, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(92, 'update_subscribers', 'web', 24, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(93, 'delete_subscribers', 'web', 24, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(94, 'create_last_20_access', 'web', 25, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(95, 'read_last_20_access', 'web', 25, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(96, 'update_last_20_access', 'web', 25, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(97, 'delete_last_20_access', 'web', 25, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(98, 'create_seo', 'web', 26, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(99, 'read_seo', 'web', 26, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(100, 'update_seo', 'web', 26, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(101, 'delete_seo', 'web', 26, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(102, 'create_meta_setting', 'web', 27, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(103, 'read_meta_setting', 'web', 27, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(104, 'update_meta_setting', 'web', 27, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(105, 'delete_meta_setting', 'web', 27, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(106, 'create_social_site', 'web', 28, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(107, 'read_social_site', 'web', 28, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(108, 'update_social_site', 'web', 28, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(109, 'delete_social_site', 'web', 28, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(110, 'create_social_link', 'web', 29, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(111, 'read_social_link', 'web', 29, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(112, 'update_social_link', 'web', 29, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(113, 'delete_social_link', 'web', 29, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(114, 'create_rss_sitemap_link', 'web', 30, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(115, 'read_rss_sitemap_link', 'web', 30, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(116, 'update_rss_sitemap_link', 'web', 30, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(117, 'delete_rss_sitemap_link', 'web', 30, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(118, 'create_setting', 'web', 31, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(119, 'read_setting', 'web', 31, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(120, 'update_setting', 'web', 31, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(121, 'delete_setting', 'web', 31, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(122, 'create_home_page', 'web', 32, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(123, 'read_home_page', 'web', 32, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(124, 'update_home_page', 'web', 32, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(125, 'delete_home_page', 'web', 32, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(126, 'create_contact_page_setup', 'web', 33, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(127, 'read_contact_page_setup', 'web', 33, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(128, 'update_contact_page_setup', 'web', 33, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(129, 'delete_contact_page_setup', 'web', 33, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(130, 'create_404_page_setting', 'web', 34, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(131, 'read_404_page_setting', 'web', 34, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(132, 'update_404_page_setting', 'web', 34, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(133, 'delete_404_page_setting', 'web', 34, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(134, 'create_color_setting', 'web', 35, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(135, 'read_color_setting', 'web', 35, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(136, 'update_color_setting', 'web', 35, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(137, 'delete_color_setting', 'web', 35, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(138, 'create_social_auth_setting', 'web', 36, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(139, 'read_social_auth_setting', 'web', 36, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(140, 'update_social_auth_setting', 'web', 36, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(141, 'delete_social_auth_setting', 'web', 36, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(142, 'create_cache_system', 'web', 37, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(143, 'read_cache_system', 'web', 37, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(144, 'update_cache_system', 'web', 37, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(145, 'delete_cache_system', 'web', 37, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(146, 'create_date_field_setup', 'web', 38, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(147, 'read_date_field_setup', 'web', 38, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(148, 'update_date_field_setup', 'web', 38, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(149, 'delete_date_field_setup', 'web', 38, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(150, 'create_panel_face', 'web', 39, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(151, 'read_panel_face', 'web', 39, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(152, 'update_panel_face', 'web', 39, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(153, 'delete_panel_face', 'web', 39, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(154, 'create_theme_setup', 'web', 40, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(155, 'read_theme_setup', 'web', 40, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(156, 'update_theme_setup', 'web', 40, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(157, 'delete_theme_setup', 'web', 40, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(158, 'create_software_setup', 'web', 41, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(159, 'read_software_setup', 'web', 41, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(160, 'update_software_setup', 'web', 41, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(161, 'delete_software_setup', 'web', 41, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(162, 'create_application', 'web', 42, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(163, 'read_application', 'web', 42, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(164, 'update_application', 'web', 42, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(165, 'delete_application', 'web', 42, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(166, 'create_apps_setting', 'web', 43, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(167, 'read_apps_setting', 'web', 43, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(168, 'update_apps_setting', 'web', 43, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(169, 'delete_apps_setting', 'web', 43, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(170, 'create_currency', 'web', 44, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(171, 'read_currency', 'web', 44, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(172, 'update_currency', 'web', 44, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(173, 'delete_currency', 'web', 44, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(174, 'create_mail_setup', 'web', 45, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(175, 'read_mail_setup', 'web', 45, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(176, 'update_mail_setup', 'web', 45, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(177, 'delete_mail_setup', 'web', 45, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(178, 'create_sms_setup', 'web', 46, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(179, 'read_sms_setup', 'web', 46, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(180, 'update_sms_setup', 'web', 46, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(181, 'delete_sms_setup', 'web', 46, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(182, 'create_password_setting', 'web', 47, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(183, 'read_password_setting', 'web', 47, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(184, 'update_password_setting', 'web', 47, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(185, 'delete_password_setting', 'web', 47, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(186, 'create_language', 'web', 48, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(187, 'read_language', 'web', 48, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(188, 'update_language', 'web', 48, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(189, 'delete_language', 'web', 48, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(190, 'create_add_language', 'web', 49, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(191, 'read_add_language', 'web', 49, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(192, 'update_add_language', 'web', 49, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(193, 'delete_add_language', 'web', 49, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(194, 'create_language_strings', 'web', 50, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(195, 'read_language_strings', 'web', 50, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(196, 'update_language_strings', 'web', 50, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(197, 'delete_language_strings', 'web', 50, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(198, 'create_user_management', 'web', 51, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(199, 'read_user_management', 'web', 51, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(200, 'update_user_management', 'web', 51, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(201, 'delete_user_management', 'web', 51, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(202, 'create_role_list', 'web', 52, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(203, 'read_role_list', 'web', 52, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(204, 'update_role_list', 'web', 52, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(205, 'delete_role_list', 'web', 52, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(206, 'create_user_list', 'web', 53, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(207, 'read_user_list', 'web', 53, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(208, 'update_user_list', 'web', 53, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(209, 'delete_user_list', 'web', 53, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(210, 'create_factory_reset', 'web', 54, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(211, 'read_factory_reset', 'web', 54, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(212, 'update_factory_reset', 'web', 54, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(213, 'delete_factory_reset', 'web', 54, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(214, 'create_backup_and_reset', 'web', 55, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(215, 'read_backup_and_reset', 'web', 55, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(216, 'update_backup_and_reset', 'web', 55, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(217, 'delete_backup_and_reset', 'web', 55, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(218, 'create_access_log', 'web', 56, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(219, 'read_access_log', 'web', 56, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(220, 'update_access_log', 'web', 56, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(221, 'delete_access_log', 'web', 56, '2024-06-26 10:49:46', '2024-06-26 10:49:46'),
(222, 'create_opinion', 'web', 59, '2025-04-23 07:01:56', '2025-04-23 07:01:59'),
(223, 'read_opinion', 'web', 59, '2025-04-23 07:02:01', '2025-04-23 07:02:04'),
(224, 'update_opinion', 'web', 59, '2025-04-23 07:01:56', '2025-04-23 07:01:56'),
(225, 'delete_opinion', 'web', 59, '2025-04-23 07:01:56', '2025-04-23 07:01:56'),
(232, 'create_theme', 'web', 61, '2025-04-23 05:39:55', '2025-04-23 05:39:55'),
(233, 'read_theme', 'web', 61, '2025-04-23 05:40:04', '2025-04-23 05:40:04'),
(234, 'update_theme', 'web', 61, '2025-04-23 05:40:04', '2025-04-23 05:40:04'),
(235, 'delete_theme', 'web', 61, '2025-04-23 05:40:04', '2025-04-23 05:40:04'),
(236, 'create_poll', 'web', 62, '2025-04-24 12:32:46', '2025-04-24 12:32:46'),
(237, 'read_poll', 'web', 62, '2025-04-24 12:32:46', '2025-04-24 12:32:46'),
(238, 'update_poll', 'web', 62, '2025-04-24 12:32:46', '2025-04-24 12:32:46'),
(239, 'delete_poll', 'web', 62, '2025-04-24 12:32:46', '2025-04-24 12:32:46'),
(244, 'create_video_news', 'web', 64, '2025-04-28 13:25:42', '2025-04-28 13:25:42'),
(245, 'read_video_news', 'web', 64, '2025-04-28 13:25:42', '2025-04-28 13:25:42'),
(246, 'update_video_news', 'web', 64, '2025-04-28 13:25:42', '2025-04-28 13:25:42'),
(247, 'delete_video_news', 'web', 64, '2025-04-28 13:25:42', '2025-04-28 13:25:42'),
(248, 'create_video_news_list', 'web', 65, '2025-04-28 13:25:42', '2025-04-28 13:25:42'),
(249, 'read_video_news_list', 'web', 65, '2025-04-28 13:25:42', '2025-04-28 13:25:42'),
(250, 'update_video_news_list', 'web', 65, '2025-04-28 13:25:42', '2025-04-28 13:25:42'),
(251, 'delete_video_news_list', 'web', 65, '2025-04-28 13:25:42', '2025-04-28 13:25:42'),
(252, 'create_rss_feeds', 'web', 66, '2025-07-09 13:29:11', '2025-07-09 13:29:11'),
(253, 'read_rss_feeds', 'web', 66, '2025-07-09 13:29:11', '2025-07-09 13:29:11'),
(254, 'update_rss_feeds', 'web', 66, '2025-07-09 13:29:11', '2025-07-09 13:29:11'),
(255, 'delete_rss_feeds', 'web', 66, '2025-07-09 13:29:11', '2025-07-09 13:29:11'),
(256, 'create_external_rss_feeds', 'web', 67, '2025-07-09 13:29:11', '2025-07-09 13:29:11'),
(257, 'read_external_rss_feeds', 'web', 67, '2025-07-09 13:29:11', '2025-07-09 13:29:11'),
(258, 'update_external_rss_feeds', 'web', 67, '2025-07-09 13:29:11', '2025-07-09 13:29:11'),
(259, 'delete_external_rss_feeds', 'web', 67, '2025-07-09 13:29:11', '2025-07-09 13:29:11'),
(260, 'create_auto_post_settings', 'web', 68, '2025-07-22 12:49:46', '2025-07-22 12:49:46'),
(261, 'read_auto_post_settings', 'web', 68, '2025-07-22 12:49:46', '2025-07-22 12:49:46'),
(262, 'update_auto_post_settings', 'web', 68, '2025-07-22 12:49:46', '2025-07-22 12:49:46'),
(263, 'delete_auto_post_settings', 'web', 68, '2025-07-22 12:49:46', '2025-07-22 12:49:46'),
(264, 'create_auto_posting_media', 'web', 69, '2025-07-22 12:49:46', '2025-07-22 12:49:46'),
(265, 'read_auto_posting_media', 'web', 69, '2025-07-22 12:49:46', '2025-07-22 12:49:46'),
(266, 'update_auto_posting_media', 'web', 69, '2025-07-22 12:49:46', '2025-07-22 12:49:46'),
(267, 'delete_auto_posting_media', 'web', 69, '2025-07-22 12:49:46', '2025-07-22 12:49:46'),
(268, 'create_cookie_content', 'web', 70, '2025-07-26 08:33:16', '2025-07-26 08:33:16'),
(269, 'read_cookie_content', 'web', 70, '2025-07-26 08:33:16', '2025-07-26 08:33:16'),
(270, 'update_cookie_content', 'web', 70, '2025-07-26 08:33:16', '2025-07-26 08:33:16'),
(271, 'delete_cookie_content', 'web', 70, '2025-07-26 08:33:16', '2025-07-26 08:33:16'),
(272, 'create_google_recaptcha', 'web', 71, '2025-08-14 10:58:38', '2025-08-14 10:58:38'),
(273, 'update_google_recaptcha', 'web', 71, '2025-08-14 10:58:38', '2025-08-14 10:58:38'),
(274, 'read_google_recaptcha', 'web', 71, '2025-08-14 10:58:38', '2025-08-14 10:58:38'),
(275, 'delete_google_recaptcha', 'web', 71, '2025-08-14 10:58:38', '2025-08-14 10:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `per_menus`
--

CREATE TABLE `per_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `parentmenu_id` bigint(20) DEFAULT NULL,
  `lable` bigint(20) NOT NULL,
  `menu_name` varchar(191) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `per_menus`
--

INSERT INTO `per_menus` (`id`, `uuid`, `parentmenu_id`, `lable`, `menu_name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', NULL, 0, 'Dashboard', NULL, NULL, '2024-07-27 16:45:14', '2024-07-27 16:45:14', NULL),
(2, '', NULL, 0, 'Advertisement', NULL, NULL, '2024-07-27 16:45:14', '2024-07-27 16:45:14', NULL),
(3, '', 2, 0, 'Update Advertise', NULL, NULL, '2024-07-27 16:45:14', '2024-07-27 16:45:14', NULL),
(4, '', NULL, 0, 'Analytics', NULL, NULL, '2024-07-27 16:45:14', '2024-07-27 16:45:14', NULL),
(5, '', 4, 0, 'Live Now', NULL, NULL, '2024-07-27 16:45:14', '2024-07-27 16:45:14', NULL),
(6, '', 4, 0, 'Location Based', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(7, '', 4, 0, 'News Based', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(8, '', 4, 0, 'Clear Analytics', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(9, '', NULL, 0, 'Archive', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(10, '', NULL, 0, 'Category', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(11, '', NULL, 0, 'Comments', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(12, '', NULL, 0, 'Media Library', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(13, '', 12, 0, 'Photo Upload', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(14, '', 12, 0, 'Photo List', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(15, '', NULL, 0, 'Menu', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(16, '', NULL, 0, 'News', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(17, '', 16, 0, 'Post', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(18, '', 16, 0, 'Breaking News', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(19, '', 16, 0, 'Positioning', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(20, '', 16, 0, 'Photo Post', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(21, '', NULL, 0, 'Page', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(22, '', 21, 0, 'Page List', NULL, NULL, '2024-07-27 16:45:15', '2024-07-27 16:45:15', NULL),
(23, '', NULL, 0, 'Reporter', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(24, '', 23, 0, 'Subscribers', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(25, '', 23, 0, 'Last 20 Access', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(26, '', NULL, 0, 'SEO', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(27, '', 26, 0, 'Meta setting', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(28, '', 26, 0, 'Social Site', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(29, '', 26, 0, 'Social Link', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(30, '', 67, 0, 'Rss links', NULL, NULL, '2024-07-27 16:45:16', '2025-07-09 13:29:11', NULL),
(31, '', NULL, 0, 'Setting', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(32, '', 31, 0, '404 Page Setting', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(33, '', 31, 0, 'Color Setting', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(34, '', 31, 0, 'Social auth setting', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(35, '', 31, 0, 'Cache System', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(36, '', 31, 0, 'Date Field Setup', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(37, '', 31, 0, 'Panel Face', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(38, '', NULL, 0, 'Theme Setup', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(39, '', NULL, 0, 'Software Setup', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(40, '', NULL, 0, 'Application', NULL, NULL, '2024-07-27 16:45:16', '2024-07-27 16:45:16', NULL),
(41, '', NULL, 0, 'App Setting', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(42, '', NULL, 0, 'Currency', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(43, '', NULL, 0, 'Mail Setup', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(44, '', NULL, 0, 'SMS Setup', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(45, '', NULL, 0, 'Password Setting', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(46, '', NULL, 0, 'Language', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(47, '', 46, 0, 'Add Language', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(48, '', NULL, 0, 'Language Strings', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(49, '', NULL, 0, 'User Management', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(50, '', NULL, 0, 'Role List', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(51, '', NULL, 0, 'User List', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(52, '', NULL, 0, 'Factory Reset', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(53, '', NULL, 0, 'Backup And Reset', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(54, '', NULL, 0, 'Access Log', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(55, '', NULL, 0, 'Web Setup', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(56, '', 55, 0, 'Setup Top Breaking Post', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(57, '', 55, 0, 'Home Page', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(58, '', 55, 0, 'Contact Page Setup', NULL, NULL, '2024-07-27 16:45:17', '2024-07-27 16:45:17', NULL),
(59, '', NULL, 0, 'Opinions', NULL, NULL, '2025-04-23 07:01:56', '2025-04-23 07:01:56', NULL),
(61, '518a3f03-fd6d-43db-8762-d8a0c293b20d', NULL, 1, 'Theme', 1, NULL, '2025-04-23 05:39:00', '2025-04-23 05:39:00', NULL),
(62, '', NULL, 0, 'Polls', NULL, NULL, '2025-04-24 12:32:46', '2025-04-24 12:32:46', NULL),
(64, '', NULL, 0, 'Video News', NULL, NULL, '2025-04-28 13:25:42', '2025-04-28 13:25:42', NULL),
(65, '', 64, 0, 'Video News List', NULL, NULL, '2025-04-28 13:25:42', '2025-04-28 13:25:42', NULL),
(66, '', NULL, 0, 'Rss Feeds', NULL, NULL, '2025-07-09 13:29:11', '2025-07-09 13:29:11', NULL),
(67, '', 66, 0, 'External RSS Feeds', NULL, NULL, '2025-07-09 13:29:11', '2025-07-09 13:29:11', NULL),
(68, '', NULL, 0, 'Auto Post Settings', NULL, NULL, '2025-07-22 12:47:33', '2025-07-22 12:47:33', NULL),
(69, '', 68, 0, 'Social Media', NULL, NULL, '2025-07-22 12:47:33', '2025-07-22 12:47:33', NULL),
(70, '', 31, 0, 'Cookie Content', NULL, NULL, '2025-07-26 08:33:16', '2025-07-26 08:33:16', NULL),
(71, '', 31, 0, 'Google Recaptcha', NULL, NULL, '2025-08-14 10:58:38', '2025-08-14 10:58:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo_libraries`
--

CREATE TABLE `photo_libraries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `disk` varchar(199) DEFAULT NULL,
  `image_base_url` varchar(191) DEFAULT NULL,
  `actual_image_name` varchar(191) NOT NULL,
  `picture_name` varchar(191) DEFAULT NULL,
  `thumb_image` varchar(191) DEFAULT NULL,
  `large_image` varchar(191) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL,
  `reference` varchar(191) DEFAULT NULL,
  `time_stamp` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo_libraries`
--


-- --------------------------------------------------------

--
-- Table structure for table `photo_posts`
--

CREATE TABLE `photo_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `stitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `reporter` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_by` bigint(20) DEFAULT NULL,
  `update_by` bigint(20) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo_posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `photo_post_details`
--

CREATE TABLE `photo_post_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_base_url` varchar(255) DEFAULT NULL,
  `photo_reference` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo_post_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imageable_type` varchar(191) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `file_name` varchar(191) DEFAULT NULL,
  `mime_type` varchar(191) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `febicon` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive , 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(191) NOT NULL,
  `vote_permission` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 for all, 1 for registered users',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `meta_keyword` varchar(191) DEFAULT NULL,
  `meta_description` varchar(191) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polls`
--


-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE `poll_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `poll_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_vote` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poll_options`
--


-- --------------------------------------------------------

--
-- Table structure for table `post_seo_onpages`
--

CREATE TABLE `post_seo_onpages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) NOT NULL,
  `meta_keyword` varchar(191) NOT NULL,
  `meta_description` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_seo_onpages`
--


-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) NOT NULL,
  `tag` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `prefixes`
--

CREATE TABLE `prefixes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_requisition_no` varchar(191) DEFAULT NULL,
  `purchase_no` varchar(191) DEFAULT NULL,
  `purchase_received_no` varchar(191) DEFAULT NULL,
  `purchase_return_no` varchar(191) DEFAULT NULL,
  `sale_quotation_no` varchar(191) DEFAULT NULL,
  `sale_invoice_no` varchar(191) DEFAULT NULL,
  `sale_draft_no` varchar(191) DEFAULT NULL,
  `sale_return_no` varchar(191) DEFAULT NULL,
  `stock_adjustment_no` varchar(191) DEFAULT NULL,
  `wastage_no` varchar(191) DEFAULT NULL,
  `delivery_no` varchar(191) DEFAULT NULL,
  `employee_id` varchar(191) DEFAULT NULL,
  `service_invoice_no` varchar(191) DEFAULT NULL,
  `transfer_no` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reporters`
--

CREATE TABLE `reporters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `reporter_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(35) NOT NULL,
  `mobile` varchar(35) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `name` varchar(35) DEFAULT NULL,
  `nick_name` varchar(50) DEFAULT NULL,
  `pen_name` varchar(35) DEFAULT NULL,
  `sex` varchar(15) DEFAULT NULL,
  `blood` varchar(20) DEFAULT NULL,
  `birth_date` varchar(100) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `address_one` text DEFAULT NULL,
  `address_two` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `verification_id_no` varchar(100) DEFAULT NULL,
  `verification_type` varchar(100) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `post_ap_status` int(11) NOT NULL DEFAULT 0,
  `department_id` int(11) DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reporters`
--


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2025-07-17 10:49:45', '2025-07-17 10:49:45'),
(2, 'Reporter', 'web', '2025-07-17 10:49:45', '2025-07-17 10:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--


-- --------------------------------------------------------

--
-- Table structure for table `rss_feeds`
--

CREATE TABLE `rss_feeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paper_language` bigint(20) UNSIGNED NOT NULL,
  `feed_name` varchar(191) NOT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `feed_url` text NOT NULL,
  `posts` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `show_button` tinyint(4) NOT NULL DEFAULT 1,
  `button_text` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rss_feeds`
--


-- --------------------------------------------------------

--
-- Table structure for table `schema_posts`
--

CREATE TABLE `schema_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `headline` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(191) DEFAULT NULL,
  `author_type` varchar(191) DEFAULT NULL,
  `author_name` varchar(191) DEFAULT NULL,
  `publisher` varchar(191) DEFAULT NULL,
  `publisher_logo` varchar(191) DEFAULT NULL,
  `publishdate` date DEFAULT NULL,
  `modifidate` date DEFAULT NULL,
  `active_status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event` text NOT NULL,
  `details` longtext NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `event`, `details`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'main_menu', '{\"1\":{\"cat_name\":\"TECHNOLOGY\",\"slug\":\"Technology\",\"max_news\":null,\"category_id\":\"4\",\"status\":\"1\"},\"2\":{\"cat_name\":\"POLITICS\",\"slug\":\"Politics\",\"max_news\":null,\"category_id\":\"8\",\"status\":\"1\"},\"3\":{\"cat_name\":\"VIDEO\",\"slug\":\"Video\",\"max_news\":null,\"category_id\":\"7\",\"status\":\"1\"},\"4\":{\"cat_name\":\"TRAVEL\",\"slug\":\"Travel\",\"max_news\":null,\"category_id\":\"2\",\"status\":\"1\"},\"5\":{\"cat_name\":\"HEALTH\",\"slug\":\"Health\",\"max_news\":null,\"category_id\":\"14\",\"status\":\"1\"},\"6\":{\"cat_name\":\"LIFESTYLE\",\"slug\":\"Lifestyle\",\"max_news\":null,\"category_id\":\"5\",\"status\":\"1\"},\"7\":{\"cat_name\":\"TRAVEL\",\"slug\":\"Travel\",\"max_news\":null,\"category_id\":\"2\",\"status\":\"1\"},\"8\":{\"cat_name\":\"SPORTS\",\"slug\":\"Sports\",\"max_news\":null,\"category_id\":\"13\",\"status\":\"1\"},\"9\":{\"cat_name\":\"WORLD\",\"slug\":\"world\",\"max_news\":null,\"category_id\":\"10\",\"status\":\"1\"},\"10\":{\"cat_name\":\"POLITICS\",\"slug\":\"Politics\",\"max_news\":null,\"category_id\":\"8\",\"status\":\"0\"},\"11\":{\"cat_name\":\"EDITOR CHOICE\",\"slug\":\"Editor-Choice\",\"max_news\":null,\"category_id\":\"6\",\"status\":\"0\"},\"12\":{\"cat_name\":\"SCIENCE\",\"slug\":\"science\",\"max_news\":null,\"category_id\":\"11\",\"status\":\"0\"},\"14\":{\"cat_name\":\"BUSINESS\",\"slug\":\"Business\",\"max_news\":null,\"category_id\":\"12\",\"status\":\"0\"},\"15\":{\"cat_name\":\"FOOD\",\"slug\":\"Food\",\"max_news\":null,\"category_id\":\"3\",\"status\":\"0\"},\"13\":{\"cat_name\":\"POLITICS\",\"slug\":\"Politics\",\"max_news\":null,\"category_id\":\"8\",\"status\":\"0\"}}', NULL, NULL, NULL, NULL, NULL),
(3, 'lang_settings', '{\"latest_news\":\"LATEST NEWS\",\"most_read\":\"MOST POPULAR\",\"whole_country\":\"Whole Country\",\"headline\":\"Headline\",\"home\":\"HOME\",\"such_more_news\":\"Related News\",\"details\":\"Read More\"}', NULL, NULL, NULL, NULL, NULL),
(4, 'home_page_cat_style', '{\"1\":{\"cat_name\":\"Opinion\",\"slug\":\"opinion\",\"max_news\":null,\"category_id\":\"3\",\"status\":\"1\"}}', NULL, 1, NULL, '2024-08-01 07:10:45', NULL),
(5, 'meta', '{\"title\":\"Best PHP Newspaper Script - News365\",\"meta_tag\":\"news365\",\"meta_description\":\"Get the best newspaper script for your news media.\",\"google_analytics\":\"news365\",\"default_image\":\"uploads\\/images\\/2023-11-19\\/p.jpg\"}', NULL, 1, NULL, '2025-06-26 12:18:31', NULL),
(6, 'social_page', '{\"fb\":\"https://www.facebook.com/envato/\",\"tw\":\"https://twitter.com/\",\"status\":\"1\",\"mobile_status\":null}', NULL, NULL, NULL, NULL, NULL),
(8, 'user_analytics', '{\"user_analytics\":\"inactive\"}', NULL, NULL, NULL, NULL, NULL),
(16, 'default_theme', '{\"default_theme\":\"Osru-Theme\"}', NULL, NULL, NULL, NULL, NULL),
(18, 'prayer_time', '{\"prayer_time\":\"\"}', NULL, NULL, NULL, NULL, NULL),
(111, 'social_link', '{\"fb\":{\"link\":\"https:\\/\\/www.facebook.com\\/news365\",\"followers\":\"100\"},\"tw\":{\"link\":\"https:\\/\\/www.twitter.com\",\"followers\":\"2000\"},\"linkd\":{\"link\":\"https:\\/\\/www.linkedin.com\",\"followers\":\"3\"},\"instagram\":{\"link\":\"https:\\/\\/www.instagram.com\",\"followers\":\"4\"},\"pin\":{\"link\":\"https:\\/\\/au.pinterest.com\",\"followers\":\"5\"},\"vimo\":{\"link\":null,\"followers\":null},\"youtube\":{\"link\":\"https:\\/\\/www.youtube.com\",\"followers\":\"6\"},\"flickr\":{\"link\":null,\"followers\":null},\"vk\":{\"link\":null,\"followers\":null},\"whats_app\":{\"link\":null,\"followers\":null},\"google\":null}', NULL, 1, NULL, '2025-07-17 06:16:49', NULL),
(113, 'contact_page_setup', '{\"editor\":\"Editor\",\"content\":\"To learn more about News365, Please feel free to contact with us\",\"address\":\"Dhaka, Bangladesh\",\"phone\":null,\"phone_two\":null,\"email\":\"business@bdtask.com\",\"website\":\"www.news365.com\",\"latitude\":\"23.824411570033433\",\"longitude\":\"90.41929284887331\",\"map\":\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12275.142575508362!2d90.4103705716535!3d23.839154058973467!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8a4136c4b61:0x19549f5462616f04!2sBdtask%20Limited!5e0!3m2!1sen!2sbd!4v1699174239627!5m2!1sen!2sbd\"}', NULL, NULL, NULL, NULL, NULL),
(114, '404_page_setup', '{\"heading\":\"No Data Found\",\"details\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui.\",\"img404\":\"uploads/images/4.jpg\"}', NULL, NULL, NULL, NULL, NULL),
(115, 'others_settings', '{\"reg_status\":1,\"reg_mail_status\":0,\"contact_status\":1,\"contact_mail_status\":1,\"comments_status\":1}', NULL, NULL, NULL, NULL, NULL),
(116, 'dateconvert', '{\"zero\":\"\\u0660\",\"one\":\"\\u0661\",\"two\":\"\\u0662\",\"three\":\"\\u0663\",\"four\":\"\\u0664\",\"five\":\"\\u0665\",\"six\":\"\\u0666\",\"seven\":\"\\u0667\",\"eight\":\"\\u0668\",\"nine\":\"\\u0669\"}', NULL, NULL, NULL, NULL, NULL),
(117, 'panel_face', '{\"fontone\":\"\",\"fonttwo\":\"\",\"color_code\":\"\",\"body_font_size\":\"14\",\"body_line_hight\":\"1.5\",\"content_text_color\":\"#aa0909\",\"logo_text_color\":\"#871717\",\"menubg_color\":\"#7f3434\",\"menu_hover_color\":\"#b41818\",\"menu_font_color\":\"#ffffff\",\"menu_font_size\":\"16\",\"active_menu_color\":\"#000000\",\"active_menu_bgcolor\":\"#7c0909\",\"active_status\":\"0\"}', NULL, NULL, NULL, NULL, NULL),
(118, 'post_default_img', '{\"img\":\"uploads/images/2021-02-20/d.jpg\"}', NULL, NULL, NULL, NULL, NULL),
(119, 'apenai', '{\"OPENAI_API_KEY\":\"sk-xxxxxx\",\"OPENAI_ORGANIZATION\":\"org-xxxxx\",\"OPENAI_MAX_NUMBER_OF_RESULT\":\"10\",\"OPENAI_MAX_TOKENS\":\"1000\",\"active_status\":\"1\"}', NULL, NULL, NULL, NULL, NULL),
(120, 'cookie_content', '{\"alert_title\":\"We value your privacy!\",\"alert_content\":\"We use cookies to improve your experience, deliver personalized content and ads, and analyze our traffic. By continuing to browse our site, you agree to our use of cookies.\",\"page_title\":\"Cookie Policy\",\"page_url\":\"https:\\/\\/latestnews365.bdtask-demo.com\\/privacy-policy\",\"cookie_duration\":\"10\"}', NULL, 1, NULL, '2025-07-26 10:53:35', NULL),
(121, 'google_recaptcha', '{\"site_key\":\"\",\"secret_key\":\"\"}', NULL, 1, NULL, '2025-08-17 04:36:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_login_api_keys`
--

CREATE TABLE `social_login_api_keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(191) NOT NULL,
  `client_id` varchar(191) DEFAULT NULL,
  `client_secret` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_login_api_keys`
--


-- --------------------------------------------------------

--
-- Table structure for table `space_credentials`
--

CREATE TABLE `space_credentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `secret` varchar(191) NOT NULL,
  `region` varchar(191) NOT NULL,
  `bucket` varchar(191) NOT NULL,
  `url` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stories`
--


-- --------------------------------------------------------

--
-- Table structure for table `story_details`
--

CREATE TABLE `story_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `story_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `image_path` varchar(191) NOT NULL,
  `button_text` varchar(191) DEFAULT NULL,
  `button_link` varchar(191) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `story_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--


-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `subs_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` varchar(111) DEFAULT NULL,
  `phone` varchar(111) DEFAULT NULL,
  `category` text DEFAULT NULL,
  `frequency` int(11) DEFAULT NULL,
  `number_of_news` varchar(111) DEFAULT NULL,
  `subs_auth_code` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 1,
  `social_sheare` int(11) NOT NULL DEFAULT 1,
  `subscription_date` date NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image_path` varchar(191) NOT NULL,
  `background_color` varchar(191) DEFAULT NULL,
  `text_color` varchar(191) DEFAULT NULL,
  `font_family` varchar(191) DEFAULT NULL,
  `font_size` varchar(191) DEFAULT NULL,
  `footer_color` varchar(191) DEFAULT NULL,
  `hover_color` varchar(191) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `image_path`, `background_color`, `text_color`, `font_family`, `font_size`, `footer_color`, `hover_color`, `is_default`, `is_active`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Classic', 'backend/img/themes/1.png', '#000000', NULL, NULL, NULL, '#ff8585', NULL, 0, 1, 1, '2025-06-22 07:34:31', '2025-07-17 06:17:32'),
(2, 'News', 'backend/img/themes/2.png', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, '2025-06-22 07:34:31', '2025-07-17 06:17:32'),
(3, 'Magazine', 'backend/img/themes/3.png', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '2025-06-22 07:34:31', '2025-07-17 06:17:32'),
(4, 'Times', 'backend/img/themes/4.png', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, '2025-06-22 07:34:31', '2025-07-17 06:17:32'),
(5, 'Gazette', 'backend/img/themes/5.png', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, '2025-06-22 07:34:31', '2025-07-17 06:17:32'),
(6, 'Fashion', 'backend/img/themes/6.png', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, '2025-06-22 07:34:31', '2025-07-17 06:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `top_breakings`
--

CREATE TABLE `top_breakings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `background_color` varchar(200) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `top_breakings`
--


-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `user_type_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(191) NOT NULL,
  `user_name` varchar(191) NOT NULL,
  `profile_image` varchar(191) DEFAULT NULL,
  `cover_image` varchar(191) DEFAULT NULL,
  `signature` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `contact_no` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `attempt` varchar(191) DEFAULT NULL,
  `recovery_code` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `user_type_title` varchar(191) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `user_types` (`id`, `uuid`, `user_type_title`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'bf3b4b4c-78ea-11f0-963c-18c04d0cd11f', 'Admin', 1, NULL, NULL, '2025-08-14 08:43:25', '2025-08-14 08:43:25', NULL),
(2, 'bf3b724f-78ea-11f0-963c-18c04d0cd11f', 'Staff', 1, NULL, NULL, '2025-08-14 08:43:25', '2025-08-14 08:43:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video_news`
--

CREATE TABLE `video_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `reporter_id` bigint(20) UNSIGNED NOT NULL,
  `publish_date` date NOT NULL,
  `total_view` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `encode_title` varchar(200) NOT NULL,
  `title` varchar(191) NOT NULL,
  `details` longtext NOT NULL,
  `thumbnail_image` varchar(191) DEFAULT NULL,
  `image_alt` varchar(191) DEFAULT NULL,
  `image_title` varchar(191) DEFAULT NULL,
  `video` varchar(191) DEFAULT NULL,
  `video_url` varchar(191) DEFAULT NULL,
  `reference` varchar(191) DEFAULT NULL,
  `meta_keyword` varchar(191) DEFAULT NULL,
  `meta_description` varchar(191) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_news`
--


-- --------------------------------------------------------

--
-- Table structure for table `web_users`
--

CREATE TABLE `web_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `social_id` varchar(191) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `bg_image` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `zkts`
--

CREATE TABLE `zkts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_id` varchar(191) NOT NULL,
  `ip_address` varchar(191) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `ad_s`
--
ALTER TABLE `ad_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_s_language_id_foreign` (`language_id`);

--
-- Indexes for table `ai_settings`
--
ALTER TABLE `ai_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appsettings`
--
ALTER TABLE `appsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_settings_language_id_foreign` (`language_id`);

--
-- Indexes for table `auto_post_settings`
--
ALTER TABLE `auto_post_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breaking_news`
--
ALTER TABLE `breaking_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `breaking_news_language_id_foreign` (`language_id`),
  ADD KEY `breaking_news_news_id_foreign` (`news_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_language_id_foreign` (`language_id`);

--
-- Indexes for table `category_topics`
--
ALTER TABLE `category_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments_infos`
--
ALTER TABLE `comments_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_infos_news_id_foreign` (`news_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_division_id_foreign` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_expired_settings`
--
ALTER TABLE `doc_expired_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_configs`
--
ALTER TABLE `email_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `font_families`
--
ALTER TABLE `font_families`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `font_families_name_unique` (`name`);

--
-- Indexes for table `font_settings`
--
ALTER TABLE `font_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `font_setups`
--
ALTER TABLE `font_setups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `font_setups_language_id_foreign` (`language_id`),
  ADD KEY `font_setups_font_setting_id_foreign` (`font_setting_id`);

--
-- Indexes for table `home_page_positions`
--
ALTER TABLE `home_page_positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_page_positions_language_id_foreign` (`language_id`);

--
-- Indexes for table `langstrings`
--
ALTER TABLE `langstrings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `langstrvals`
--
ALTER TABLE `langstrvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `max_archive_settings`
--
ALTER TABLE `max_archive_settings`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_contents`
--
ALTER TABLE `menu_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_contents_language_id_foreign` (`language_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `news_archives`
--
ALTER TABLE `news_archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_archives_language_id_foreign` (`language_id`),
  ADD KEY `news_archives_category_id_foreign` (`category_id`),
  ADD KEY `news_archives_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_comments_news_mst_id_foreign` (`news_mst_id`),
  ADD KEY `news_comments_video_news_id_foreign` (`video_news_id`),
  ADD KEY `news_comments_web_user_id_foreign` (`web_user_id`),
  ADD KEY `news_comments_opinion_id_foreign` (`opinion_id`);

--
-- Indexes for table `news_comment_replies`
--
ALTER TABLE `news_comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_comment_replies_news_comment_id_foreign` (`news_comment_id`),
  ADD KEY `news_comment_replies_web_user_id_foreign` (`web_user_id`);

--
-- Indexes for table `news_msts`
--
ALTER TABLE `news_msts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_msts_category_id_foreign` (`category_id`),
  ADD KEY `news_msts_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `news_msts_language_id_foreign` (`language_id`);

--
-- Indexes for table `news_positions`
--
ALTER TABLE `news_positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_positions_category_id_foreign` (`category_id`);

--
-- Indexes for table `news_position_maps`
--
ALTER TABLE `news_position_maps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_position_maps_news_id_foreign` (`news_id`),
  ADD KEY `news_position_maps_category_id_foreign` (`category_id`),
  ADD KEY `news_position_maps_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `news_routings`
--
ALTER TABLE `news_routings`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `opinions`
--
ALTER TABLE `opinions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opinions_language_id_foreign` (`language_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_language_id_foreign` (`language_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_settings`
--
ALTER TABLE `password_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `per_menus`
--
ALTER TABLE `per_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_libraries`
--
ALTER TABLE `photo_libraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_posts`
--
ALTER TABLE `photo_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_posts_category_id_foreign` (`category_id`),
  ADD KEY `photo_posts_language_id_foreign` (`language_id`);

--
-- Indexes for table `photo_post_details`
--
ALTER TABLE `photo_post_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pictures_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polls_language_id_foreign` (`language_id`);

--
-- Indexes for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poll_options_poll_id_foreign` (`poll_id`);

--
-- Indexes for table `post_seo_onpages`
--
ALTER TABLE `post_seo_onpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prefixes`
--
ALTER TABLE `prefixes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reporters`
--
ALTER TABLE `reporters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `rss_feeds`
--
ALTER TABLE `rss_feeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rss_feeds_paper_language_foreign` (`paper_language`);

--
-- Indexes for table `schema_posts`
--
ALTER TABLE `schema_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_login_api_keys`
--
ALTER TABLE `social_login_api_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_login_api_keys_provider_index` (`provider`);

--
-- Indexes for table `space_credentials`
--
ALTER TABLE `space_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stories_language_id_foreign` (`language_id`);

--
-- Indexes for table `story_details`
--
ALTER TABLE `story_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `story_details_story_id_foreign` (`story_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_breakings`
--
ALTER TABLE `top_breakings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `top_breakings_category_id_foreign` (`category_id`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upazilas_district_id_foreign` (`district_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_contact_no_unique` (`contact_no`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_news`
--
ALTER TABLE `video_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_news_reporter_id_foreign` (`reporter_id`),
  ADD KEY `video_news_language_id_foreign` (`language_id`);

--
-- Indexes for table `web_users`
--
ALTER TABLE `web_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zkts`
--
ALTER TABLE `zkts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ad_s`
--
ALTER TABLE `ad_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ai_settings`
--
ALTER TABLE `ai_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appsettings`
--
ALTER TABLE `appsettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auto_post_settings`
--
ALTER TABLE `auto_post_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `breaking_news`
--
ALTER TABLE `breaking_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_topics`
--
ALTER TABLE `category_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments_infos`
--
ALTER TABLE `comments_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_expired_settings`
--
ALTER TABLE `doc_expired_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_configs`
--
ALTER TABLE `email_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `font_families`
--
ALTER TABLE `font_families`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `font_settings`
--
ALTER TABLE `font_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `font_setups`
--
ALTER TABLE `font_setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_page_positions`
--
ALTER TABLE `home_page_positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `langstrings`
--
ALTER TABLE `langstrings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `langstrvals`
--
ALTER TABLE `langstrvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu_contents`
--
ALTER TABLE `menu_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `news_archives`
--
ALTER TABLE `news_archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_comment_replies`
--
ALTER TABLE `news_comment_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_msts`
--
ALTER TABLE `news_msts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_positions`
--
ALTER TABLE `news_positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_position_maps`
--
ALTER TABLE `news_position_maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opinions`
--
ALTER TABLE `opinions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_settings`
--
ALTER TABLE `password_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `per_menus`
--
ALTER TABLE `per_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `photo_libraries`
--
ALTER TABLE `photo_libraries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_posts`
--
ALTER TABLE `photo_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_post_details`
--
ALTER TABLE `photo_post_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_seo_onpages`
--
ALTER TABLE `post_seo_onpages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prefixes`
--
ALTER TABLE `prefixes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reporters`
--
ALTER TABLE `reporters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rss_feeds`
--
ALTER TABLE `rss_feeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schema_posts`
--
ALTER TABLE `schema_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_login_api_keys`
--
ALTER TABLE `social_login_api_keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `space_credentials`
--
ALTER TABLE `space_credentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `story_details`
--
ALTER TABLE `story_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `top_breakings`
--
ALTER TABLE `top_breakings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `video_news`
--
ALTER TABLE `video_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_users`
--
ALTER TABLE `web_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zkts`
--
ALTER TABLE `zkts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad_s`
--
ALTER TABLE `ad_s`
  ADD CONSTRAINT `ad_s_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD CONSTRAINT `app_settings_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `breaking_news`
--
ALTER TABLE `breaking_news`
  ADD CONSTRAINT `breaking_news_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `breaking_news_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news_msts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments_infos`
--
ALTER TABLE `comments_infos`
  ADD CONSTRAINT `comments_infos_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news_msts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`);

--
-- Constraints for table `font_setups`
--
ALTER TABLE `font_setups`
  ADD CONSTRAINT `font_setups_font_setting_id_foreign` FOREIGN KEY (`font_setting_id`) REFERENCES `font_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `font_setups_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `home_page_positions`
--
ALTER TABLE `home_page_positions`
  ADD CONSTRAINT `home_page_positions_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_contents`
--
ALTER TABLE `menu_contents`
  ADD CONSTRAINT `menu_contents_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news_archives`
--
ALTER TABLE `news_archives`
  ADD CONSTRAINT `news_archives_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `news_archives_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `news_archives_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD CONSTRAINT `news_comments_news_mst_id_foreign` FOREIGN KEY (`news_mst_id`) REFERENCES `news_msts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_comments_opinion_id_foreign` FOREIGN KEY (`opinion_id`) REFERENCES `opinions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_comments_video_news_id_foreign` FOREIGN KEY (`video_news_id`) REFERENCES `video_news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_comments_web_user_id_foreign` FOREIGN KEY (`web_user_id`) REFERENCES `web_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news_comment_replies`
--
ALTER TABLE `news_comment_replies`
  ADD CONSTRAINT `news_comment_replies_news_comment_id_foreign` FOREIGN KEY (`news_comment_id`) REFERENCES `news_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_comment_replies_web_user_id_foreign` FOREIGN KEY (`web_user_id`) REFERENCES `web_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news_msts`
--
ALTER TABLE `news_msts`
  ADD CONSTRAINT `news_msts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `news_msts_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_msts_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `news_positions`
--
ALTER TABLE `news_positions`
  ADD CONSTRAINT `news_positions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `news_position_maps`
--
ALTER TABLE `news_position_maps`
  ADD CONSTRAINT `news_position_maps_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_position_maps_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news_msts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_position_maps_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `opinions`
--
ALTER TABLE `opinions`
  ADD CONSTRAINT `opinions_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photo_posts`
--
ALTER TABLE `photo_posts`
  ADD CONSTRAINT `photo_posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `photo_posts_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD CONSTRAINT `poll_options_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rss_feeds`
--
ALTER TABLE `rss_feeds`
  ADD CONSTRAINT `rss_feeds_paper_language_foreign` FOREIGN KEY (`paper_language`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `story_details`
--
ALTER TABLE `story_details`
  ADD CONSTRAINT `story_details_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `top_breakings`
--
ALTER TABLE `top_breakings`
  ADD CONSTRAINT `top_breakings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD CONSTRAINT `upazilas_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `video_news`
--
ALTER TABLE `video_news`
  ADD CONSTRAINT `video_news_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `video_news_reporter_id_foreign` FOREIGN KEY (`reporter_id`) REFERENCES `reporters` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
