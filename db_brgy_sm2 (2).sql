-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2026 at 12:57 PM
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
-- Database: `db_brgy_sm2`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `archived_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `tag`, `image`, `is_published`, `created_by`, `created_at`, `updated_at`, `is_active`, `archived_at`, `image_path`) VALUES
(1, 'VACATION REMINDERS', 'GABAY SA PAG-ALALA AT PAGNINILAY: MAHAL NA ARAW 2026 🙏\r\n\r\nIsang mapayapa at banal na paggunita sa buong komunidad ng Barangay San Miguel 2. Inaanyayahan ang lahat na makiisa sa ating mga nakatakdang aktibidad ngayong Mahal na Araw upang sama-sama tayong magnilay at magbalik-loob.', 'Announcement', 'announcements/kt3rDNL95ksi03eZ3D1pnjFVIP1sCyz1vUo4u31z.jpg', 1, 6, '2026-03-30 06:56:34', '2026-03-30 06:56:34', 1, NULL, 'announcements/kt3rDNL95ksi03eZ3D1pnjFVIP1sCyz1vUo4u31z.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blotter_reports`
--

CREATE TABLE `blotter_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blotter_number` varchar(255) NOT NULL,
  `complainant_name` varchar(255) NOT NULL,
  `respondent_name` varchar(255) NOT NULL,
  `incident_type` enum('Noise Complaint','Minor Accident','Theft','Dispute','Trespassing','Stray Animal','Other') NOT NULL,
  `incident_details` text NOT NULL,
  `incident_location` varchar(255) NOT NULL,
  `incident_datetime` datetime NOT NULL,
  `status` enum('Open','Under Investigation','Resolved','Closed') NOT NULL DEFAULT 'Open',
  `remarks` text DEFAULT NULL,
  `recorded_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('barangay-sm2-cache-gonzaga.hannahkhauera.kld@gmail.com|127.0.0.1', 'i:1;', 1774116641),
('barangay-sm2-cache-gonzaga.hannahkhauera.kld@gmail.com|127.0.0.1:timer', 'i:1774116641;', 1774116641),
('barangay-sm2-cache-hannahgonzaga01@gmail.com|127.0.0.1', 'i:2;', 1774614792),
('barangay-sm2-cache-hannahgonzaga01@gmail.com|127.0.0.1:timer', 'i:1774614792;', 1774614792),
('barangay-sm2-cache-ooffice@brgysm2.com|127.0.0.1', 'i:1;', 1775046780),
('barangay-sm2-cache-ooffice@brgysm2.com|127.0.0.1:timer', 'i:1775046780;', 1775046780);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `digital_ids`
--

CREATE TABLE `digital_ids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_person_number` varchar(255) NOT NULL,
  `status` enum('pending','generated') NOT NULL DEFAULT 'pending',
  `id_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `digital_ids`
--

INSERT INTO `digital_ids` (`id`, `user_id`, `contact_person`, `contact_person_number`, `status`, `id_number`, `created_at`, `updated_at`) VALUES
(1, 10, 'Hannah Khaye Gonzaga', '09168738313', 'generated', 'BSMI-2026-H41Z3F', '2026-03-20 09:38:48', '2026-03-25 08:14:34'),
(2, 8, 'Hannah Gonzaga', '09168738313', 'generated', 'BSMI-2026-2KGSUL', '2026-03-23 22:49:19', '2026-03-25 07:24:47'),
(3, 9, 'mikael', '09222223222', 'generated', 'BSMI-2026-78FXJW', '2026-03-25 19:10:18', '2026-03-27 06:56:37'),
(4, 11, 'Hannah Gonzaga', '09168738313', 'pending', NULL, '2026-04-07 00:44:14', '2026-04-07 00:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doc_number` varchar(255) NOT NULL,
  `resident_id` bigint(20) UNSIGNED NOT NULL,
  `doc_type` enum('barangay_clearance','indigency','move_in','move_out','business_permit','digital_id','other') NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `is_resident` tinyint(1) NOT NULL DEFAULT 1,
  `fee` decimal(8,2) NOT NULL DEFAULT 0.00,
  `status` enum('Pending','Processing','Ready','Released') NOT NULL DEFAULT 'Pending',
  `qr_code_path` varchar(255) DEFAULT NULL,
  `issued_by` bigint(20) UNSIGNED DEFAULT NULL,
  `issued_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_requests`
--

CREATE TABLE `document_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_first_name` varchar(255) DEFAULT NULL,
  `guest_last_name` varchar(255) DEFAULT NULL,
  `document_type` varchar(255) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `blk` varchar(255) DEFAULT NULL,
  `lot` varchar(255) DEFAULT NULL,
  `move_date` varchar(255) DEFAULT NULL,
  `landlord` varchar(255) DEFAULT NULL,
  `family_members` text DEFAULT NULL,
  `ward_name` varchar(255) DEFAULT NULL,
  `ward_age` varchar(255) DEFAULT NULL,
  `ward_relation` varchar(255) DEFAULT NULL,
  `partner_name` varchar(255) DEFAULT NULL,
  `living_since` varchar(255) DEFAULT NULL,
  `claimant_name` varchar(255) DEFAULT NULL,
  `claimant_relation` varchar(255) DEFAULT NULL,
  `birth_month` varchar(255) DEFAULT NULL,
  `birth_year` varchar(255) DEFAULT NULL,
  `child_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `birth_attendant` varchar(255) DEFAULT NULL,
  `born_from` varchar(255) DEFAULT NULL,
  `residing_since` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `nature_of_business` varchar(255) DEFAULT NULL,
  `non_op_since` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `notified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_requests`
--

INSERT INTO `document_requests` (`id`, `user_id`, `guest_first_name`, `guest_last_name`, `document_type`, `purpose`, `address`, `contact`, `blk`, `lot`, `move_date`, `landlord`, `family_members`, `ward_name`, `ward_age`, `ward_relation`, `partner_name`, `living_since`, `claimant_name`, `claimant_relation`, `birth_month`, `birth_year`, `child_name`, `father_name`, `mother_name`, `birth_attendant`, `born_from`, `residing_since`, `company_name`, `nature_of_business`, `non_op_since`, `status`, `admin_notes`, `notified_at`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, NULL, 'clearance', 'Employment', 'Blk 123 Lot 4 Subdivision', '09327359733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'released', NULL, NULL, '2026-03-19 00:35:02', '2026-03-19 02:57:51'),
(2, 9, NULL, NULL, 'residency', 'Loan', 'Blk 187 Lot 12 Phase 2', '09567984316', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, '2026-03-19 01:26:12', '2026-03-19 01:26:12'),
(3, 10, NULL, NULL, 'residency', 'Employment', 'Blk 15 Lot A R5 Cityhomes Resortville', '09327359733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ready', NULL, NULL, '2026-03-21 07:15:42', '2026-03-23 22:58:30'),
(4, 11, NULL, NULL, 'jobseeker', 'Employment', 'phase 5', '09633951836', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'processing', NULL, NULL, '2026-03-23 23:12:15', '2026-03-23 23:12:54'),
(5, 11, NULL, NULL, 'cashgift', 'Employment', 'Phase 5', '09633951836', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'October', '1983', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ready', NULL, NULL, '2026-03-23 23:35:22', '2026-03-24 00:03:31'),
(6, 8, NULL, NULL, 'indigency', 'Employment', 'Site', '09168738313', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, '2026-03-27 06:24:00', '2026-03-27 06:24:00'),
(7, 12, NULL, NULL, 'indigency', 'Loan', 'Blk 112 lot 5 ph3', '09109896215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, '2026-03-27 06:25:49', '2026-03-27 06:25:49'),
(8, 12, NULL, NULL, 'indigency', 'Loan', 'Blk 112 lot 5 ph3', '09109896215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ready', NULL, NULL, '2026-03-27 06:25:55', '2026-03-27 06:55:57'),
(9, 8, NULL, NULL, 'indigency', 'Employment', 'Site', '09168738313', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, '2026-03-30 23:06:45', '2026-03-30 23:06:45'),
(10, 15, NULL, NULL, 'movein', 'rent', 'sa tabi', '0986374382', '30', '2', 'March 2, 2026', 'duno', 'n/a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'processing', NULL, NULL, '2026-04-02 04:05:32', '2026-04-02 04:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `archived_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `day_label` varchar(255) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `time_range` varchar(255) DEFAULT NULL,
  `tag` varchar(255) NOT NULL DEFAULT 'Community',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `is_active`, `archived_at`, `title`, `description`, `location`, `day_label`, `frequency`, `time_range`, `tag`, `created_at`, `updated_at`, `image_path`) VALUES
(1, 1, NULL, 'Feeding Program', 'SOPAS PARA SA LAHAT!!', 'Barangay Court', 'Saturday', 'Weekly', '6:00am-9:am', 'Community', '2026-03-23 23:47:57', '2026-03-23 23:47:57', NULL);

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
-- Table structure for table `issue_reports`
--

CREATE TABLE `issue_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `issue_type` varchar(255) NOT NULL,
  `complainant_name` varchar(255) NOT NULL,
  `complainant_age` varchar(255) DEFAULT NULL,
  `complainant_gender` varchar(255) DEFAULT NULL,
  `complainant_address` varchar(255) DEFAULT NULL,
  `respondent_name` varchar(255) DEFAULT NULL,
  `respondent_address` varchar(255) DEFAULT NULL,
  `respondent_contact` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `incident_date` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `witness_name` varchar(255) DEFAULT NULL,
  `witness_contact` varchar(255) DEFAULT NULL,
  `evidence` text DEFAULT NULL,
  `department` varchar(255) NOT NULL DEFAULT 'Justice',
  `status` varchar(255) NOT NULL DEFAULT 'submitted',
  `hearing_date` datetime DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `admin_summary` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_reports`
--

INSERT INTO `issue_reports` (`id`, `user_id`, `issue_type`, `complainant_name`, `complainant_age`, `complainant_gender`, `complainant_address`, `respondent_name`, `respondent_address`, `respondent_contact`, `description`, `location`, `incident_date`, `contact`, `witness_name`, `witness_contact`, `evidence`, `department`, `status`, `hearing_date`, `admin_notes`, `admin_summary`, `created_at`, `updated_at`) VALUES
(1, 8, 'Noise Disturbance', 'Mikael Fujimoto', '25', 'Male', NULL, 'kapitbahay', 'site lng din', NULL, 'de makatulog sa gabe', 'site', '2026-03-27T23:00', '099999997', NULL, NULL, NULL, 'Peace & Order', 'under_review', NULL, NULL, NULL, '2026-03-27 18:42:29', '2026-03-28 02:05:19'),
(2, 9, 'VAWC – Domestic Violence', 'Anne Smith', '20', 'Female', NULL, 'Sasagurl', 'Site', NULL, 'Sinisigawan ako be', 'bahay', '2026-03-28T07:00', '0927878745', NULL, NULL, NULL, 'VAWC', 'on_going', NULL, 'Escalated to PNP/DSWD for immediate emergency assessment.', 'According to the complainant it happens on their house that the respondent shouted her and she don\'t like it.', '2026-03-27 19:10:01', '2026-03-27 23:02:44'),
(3, 4, 'Others', 'JUAN DAW', '30', 'Male', NULL, 'KUNG CNO LNG', 'Site', NULL, 'WAT DAW', 'bahay', '2026-03-27T19:18', '099996767', NULL, NULL, NULL, 'Peace & Order', 'submitted', NULL, NULL, NULL, '2026-03-28 03:18:33', '2026-03-28 03:18:33'),
(4, 4, 'Patrol Schedule', 'MANG JUAN', NULL, NULL, NULL, NULL, NULL, NULL, '10 PM CURFEW', 'AREA G', '2026-03-30', 'N/A', NULL, NULL, NULL, 'Peace & Order', 'pending', NULL, NULL, NULL, '2026-03-28 03:22:02', '2026-03-28 03:22:02'),
(5, NULL, 'Illegal Parking / Road Blockage', 'Maria Cecilia Santos', '25', 'Female', NULL, 'Ricardo \"Rick\" Gomez', 'Blk 14, Lot 24, Phase 1, Brgy. San Miguel 2', NULL, 'On the night of March 28, at approximately 10:30 PM, the respondent, Mr. Ricardo Gomez, parked his delivery van directly in front of my driveway, completely obstructing the entrance and exit of my personal vehicle. When I approached him politely to request that he move the vehicle so my husband could leave for his night shift, the respondent became verbally aggressive and used profane language.\r\n\r\nDespite my attempts to de-escalate, the respondent refused to move the vehicle for over an hour and made threatening gestures toward our property. This is the third recorded instance of this parking violation this month. I am filing this report to request a formal mediation to settle this boundary and parking dispute permanently, as it is now affecting my family’s safety and livelihood', 'Frontage of Blk 14, Lot 22 (Complainant\'s Residence)', '2026-03-28T22:30', '09867676754', NULL, NULL, NULL, 'Justice', 'under_review', '2026-04-04 10:00:00', NULL, NULL, '2026-03-28 21:28:46', '2026-04-01 05:25:56'),
(6, 14, 'Physical Assault', 'mamiyu minime', '23', 'Female', NULL, 'Hannah Khaye Gonzaga', 'Site', NULL, 'na hurt aq', NULL, '2026-03-31T22:30', '097856565', NULL, NULL, NULL, 'Justice', 'under_review', '2026-04-04 11:00:00', NULL, NULL, '2026-04-01 05:31:09', '2026-04-01 05:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mediation_cases`
--

CREATE TABLE `mediation_cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `case_number` varchar(255) NOT NULL,
  `complainant_name` varchar(255) NOT NULL,
  `respondent_name` varchar(255) NOT NULL,
  `case_description` text NOT NULL,
  `status` enum('Pending','Scheduled','Settled','Unresolved','Escalated') NOT NULL DEFAULT 'Pending',
  `hearing_date` date DEFAULT NULL,
  `resolution` text DEFAULT NULL,
  `handled_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_01_000001_create_document_requests_table', 1),
(5, '2026_01_01_000002_create_issue_reports_table', 1),
(6, '2026_02_22_122128_add_role_to_users_table', 1),
(7, '2026_02_22_124824_create_residents_table', 1),
(8, '2026_02_22_125309_create_pets_table', 1),
(9, '2026_02_22_125523_create_documents_table', 1),
(10, '2026_02_22_125622_create_blotter_reports_table', 1),
(11, '2026_02_22_125703_create_mediation_cases_table', 1),
(12, '2026_02_22_125741_create_vawc_cases_table', 1),
(14, '2026_02_26_125037_add_security_fields_to_users_table', 1),
(15, '2026_02_26_142829_add_status_to_users_table', 1),
(16, '2026_02_27_155946_update_user_roles_list', 1),
(17, '2026_03_12_050308_add_age_to_pets_table', 1),
(18, '2026_03_12_082242_add_pet_name_to_pets_table', 1),
(19, '2026_01_01_000003_add_archived_at_to_residents', 2),
(20, '2026_03_15_161347_create_digital_ids_table', 2),
(21, '2026_03_15_184655_create_officials_table', 3),
(22, '2026_03_19_024618_create_notifications_table', 4),
(23, '2026_03_20_171145_add_spouse_name_to_residents_and_users_tables', 5),
(24, '2026_03_21_174627_create_resident_messages_table', 6),
(25, '2026_03_28_065658_add_admin_summary_to_issue_reports_table', 7),
(28, '2026_03_28_105634_add_complainant_address_to_issue_reports', 8),
(29, '2026_03_29_113828_add_relationship_to_residents_table', 9),
(30, '2026_03_29_141333_add_image_path_to_announcements_and_events_table', 10),
(31, '2026_03_29_153408_add_password_history_to_users_table', 11),
(32, '2026_03_30_143021_add_tag_to_announcements_table', 12),
(33, '2026_03_30_155139_add_department_to_officials_table', 13),
(34, '2026_04_01_131227_add_hearing_date_to_issue_reports_table', 14),
(35, '2026_04_07_085706_add_months_to_pets_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('059b36f1-ca90-48b7-a8ce-076f409ffb9c', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 14, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Physical Assault is now Submitted\",\"id\":6}', NULL, '2026-04-01 05:32:21', '2026-04-01 05:32:21'),
('098380c5-eecf-4f67-908d-87d835841bd1', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 15, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Movein has been received and is now pending review.\"}', NULL, '2026-04-02 04:05:37', '2026-04-02 04:05:37'),
('10bf7d8d-bfb2-47d4-92c8-167211e0cb9c', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 10, '{\"type\":\"document_received\",\"title\":\"\\ud83d\\udcc4 Document Request Received\",\"message\":\"Your request for Residency has been received and is now pending review.\"}', '2026-03-21 07:16:00', '2026-03-21 07:15:49', '2026-03-21 07:16:00'),
('134cccc0-9f04-40bf-a549-25d12ec06627', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Noise Disturbance is now Submitted\",\"id\":1}', '2026-03-28 21:30:32', '2026-03-28 00:50:22', '2026-03-28 21:30:32'),
('18a23358-0417-49d5-83b1-790739f1ba0c', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 11, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Jobseeker is now being processed. We will notify you when it\'s ready.\"}', '2026-03-24 00:06:10', '2026-03-23 23:37:37', '2026-03-24 00:06:10'),
('1a971ddf-9cf6-4f67-9a7f-e644949b6be0', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Noise Disturbance is now Pending\",\"id\":1}', '2026-03-28 21:30:32', '2026-03-28 02:05:18', '2026-03-28 21:30:32'),
('2da4f18e-e88b-4a1d-85bf-9e9f7bdd2f8e', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Noise Disturbance is now Under review\",\"id\":1}', '2026-03-28 21:30:32', '2026-03-27 23:47:23', '2026-03-28 21:30:32'),
('2deaa368-2bae-4525-bcc6-2e20c44307c1', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 12, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Indigency has been received and is now pending review.\"}', NULL, '2026-03-27 06:25:54', '2026-03-27 06:25:54'),
('2e92283f-a975-4eca-83d0-23ec393d2953', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 11, '{\"type\":\"document_received\",\"title\":\"\\ud83d\\udcc4 Document Request Received\",\"message\":\"Your request for Cashgift has been received and is now pending review.\"}', '2026-03-24 00:06:10', '2026-03-23 23:35:28', '2026-03-24 00:06:10'),
('343f1c3c-bbf9-4d54-8518-00b6c5780013', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 12, '{\"type\":\"document_status_updated\",\"title\":\"Ready for Pick-up! \\u2705\",\"message\":\"Your Indigency is ready! Please visit Barangay Hall (Mon\\u2013Fri, 8AM\\u20135PM) to claim it.\"}', NULL, '2026-03-27 06:56:03', '2026-03-27 06:56:03'),
('3f48db95-d90d-48f9-baf2-f639d2e02275', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 11, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Jobseeker is now being processed. We will notify you when it\'s ready.\"}', '2026-03-24 00:06:10', '2026-03-23 23:12:59', '2026-03-24 00:06:10'),
('46128d39-b500-4420-b849-0dfd77cbf0f6', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 8, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"General Inquiry\\\"\"}', '2026-04-01 05:54:50', '2026-04-01 05:54:02', '2026-04-01 05:54:50'),
('4c491a4a-0155-4d4c-a132-171975e4ad90', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 9, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report VAWC \\u2013 Domestic Violence is now On going\",\"id\":2}', NULL, '2026-03-27 22:22:46', '2026-03-27 22:22:46'),
('4d07a7b8-6d69-4896-a58d-232fbae2631a', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 15, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Movein is now being processed. We will notify you when it\'s ready.\"}', NULL, '2026-04-02 04:45:49', '2026-04-02 04:45:49'),
('5795ecb6-b6ca-476a-b549-5f2eda03b5f0', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"document_status_updated\",\"title\":\"Document Ready\",\"message\":\"\\ud83c\\udf89 Your Clearance is ready for pick-up at the Barangay Hall!\",\"document_type\":\"clearance\",\"status\":\"ready\",\"request_id\":1}', '2026-03-20 05:43:28', '2026-03-19 02:15:48', '2026-03-20 05:43:28'),
('608732e5-4d34-4821-9c72-ca7fa0689988', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 9, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report VAWC \\u2013 Domestic Violence is now Under review\",\"id\":2}', NULL, '2026-03-27 21:48:20', '2026-03-27 21:48:20'),
('7600f6d9-8a40-4fb0-afec-652787baa567', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"document_status_updated\",\"title\":\"Document Released\",\"message\":\"Your Clearance has been released.\",\"document_type\":\"clearance\",\"status\":\"released\",\"request_id\":1}', '2026-03-20 05:43:28', '2026-03-19 02:57:57', '2026-03-20 05:43:28'),
('897c309f-8be2-488b-97b9-417830839b70', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 11, '{\"type\":\"document_received\",\"title\":\"\\ud83d\\udcc4 Document Request Received\",\"message\":\"Your request for Jobseeker has been received and is now pending review.\"}', '2026-03-24 00:06:10', '2026-03-23 23:12:20', '2026-03-24 00:06:10'),
('98fadb99-b7e7-4773-a7d5-1c3051697642', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 11, '{\"type\":\"document_status_updated\",\"title\":\"Ready for Pick-up! \\u2705\",\"message\":\"Your Cashgift is ready! Please visit Barangay Hall (Mon\\u2013Fri, 8AM\\u20135PM) to claim it.\"}', '2026-03-24 00:06:10', '2026-03-24 00:03:36', '2026-03-24 00:06:10'),
('9fb11d16-aa43-4314-a314-50d349669e39', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 10, '{\"type\":\"document_status_updated\",\"title\":\"Document Status Updated\\ud83d\\udccb \",\"message\":\"Your document request status has been updated to: Pending\"}', '2026-03-25 08:18:20', '2026-03-23 22:55:27', '2026-03-25 08:18:20'),
('a5f61b60-df82-490d-b2e8-86d3c93c7383', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 10, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Residency is now being processed. We will notify you when it\'s ready.\"}', '2026-03-25 08:18:20', '2026-03-23 22:58:10', '2026-03-25 08:18:20'),
('a6e5d754-6e8b-4f68-bb5e-3709b6929cb0', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 10, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"General Inquiry\\\"\"}', NULL, '2026-03-30 22:57:13', '2026-03-30 22:57:13'),
('a9fcf18d-5982-4191-88e6-941608a29e89', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 11, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"General Inquiry\\\"\"}', NULL, '2026-04-07 00:40:55', '2026-04-07 00:40:55'),
('aa8dc655-2c83-4947-829e-d7d988ad4ecb', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 12, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Indigency is now being processed. We will notify you when it\'s ready.\"}', NULL, '2026-03-27 06:54:12', '2026-03-27 06:54:12'),
('ae437fb0-b94d-41d0-8bce-5eb9257f0535', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 10, '{\"type\":\"document_status_updated\",\"title\":\"Ready for Pick-up! \\u2705\",\"message\":\"Your Residency is ready! Please visit Barangay Hall (Mon\\u2013Fri, 8AM\\u20135PM) to claim it.\"}', '2026-03-25 08:18:20', '2026-03-23 22:58:34', '2026-03-25 08:18:20'),
('b648b89f-4de0-435c-b621-8b348b5ac441', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 8, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"Other\\\"\"}', '2026-03-23 22:33:24', '2026-03-23 22:31:37', '2026-03-23 22:33:24'),
('c28b31ce-33f6-4733-a7ea-dc7e9dd9e3e5', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Noise Disturbance is now Under review\",\"id\":1}', '2026-03-28 21:30:32', '2026-03-28 02:05:24', '2026-03-28 21:30:32'),
('da31d351-761d-4dc4-aaa6-3e4dbb1f5c69', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 11, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Cashgift is now being processed. We will notify you when it\'s ready.\"}', '2026-03-24 00:06:10', '2026-03-23 23:37:52', '2026-03-24 00:06:10'),
('de621455-d25d-4230-99a4-3d168f42ccfa', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 11, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"General Inquiry\\\"\"}', NULL, '2026-03-24 00:07:25', '2026-03-24 00:07:25'),
('e6f07a1f-51fc-4dc0-b47b-fb47d7fe129b', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 8, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Indigency has been received and is now pending review.\"}', '2026-03-27 06:24:47', '2026-03-27 06:24:07', '2026-03-27 06:24:47'),
('ee501a03-710b-4c66-856f-07e6d5a73879', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 8, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Indigency has been received and is now pending review.\"}', '2026-03-30 23:13:49', '2026-03-30 23:06:51', '2026-03-30 23:13:49'),
('f290d3ee-933f-4445-8b47-e1c5ee679c88', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 12, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Indigency has been received and is now pending review.\"}', NULL, '2026-03-27 06:26:00', '2026-03-27 06:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `term_start` date DEFAULT NULL,
  `term_end` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `name`, `department`, `position`, `photo`, `term_start`, `term_end`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'HUYU', 'Peace', 'staff', 'officials/JOBNIP4zaov0uvy4Mzz1kY3PziAqJNwu8yOeQ8CJ.jpg', '2025-08-05', '2027-08-05', 1, '2026-03-25 22:40:43', '2026-04-01 05:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('gonzaga.hannahkhayera.kld@gmail.com', '$2y$12$x7ZmrCADlp3IfneJE7oqJ.g4YL5.cU7plxYPMmrcWhwqOfJxrgpIS', '2026-03-20 05:25:16'),
('justice@brgysm2.com', '$2y$12$dtz9HKGWf/PYFSbVB34jae9KytzHQY0MjyG.WlPO/Wv4DzzxRbl8S', '2026-03-30 21:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resident_id` bigint(20) UNSIGNED NOT NULL,
  `pet_name` varchar(255) DEFAULT NULL,
  `pet_type` varchar(255) NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `months` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `vaccine_status` enum('Vaccinated','Unvaccinated','Partial') NOT NULL,
  `last_vaccine_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('alive','deceased') NOT NULL DEFAULT 'alive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `resident_id`, `pet_name`, `pet_type`, `breed`, `age`, `months`, `quantity`, `vaccine_status`, `last_vaccine_date`, `created_at`, `updated_at`, `status`) VALUES
(5, 6, 'kiko', 'Fish', 'arowana', NULL, NULL, 1, 'Unvaccinated', NULL, '2026-03-21 04:28:44', '2026-03-21 04:28:44', 'alive'),
(6, 8, 'chuchut', 'Dog', 'chihuahua', NULL, NULL, 1, 'Vaccinated', NULL, '2026-04-02 03:15:10', '2026-04-02 03:15:10', 'alive'),
(7, 11, 'Mochi', 'Cat', 'Tilapia skin', NULL, NULL, 1, 'Vaccinated', NULL, '2026-04-07 00:46:04', '2026-04-07 00:46:04', 'alive'),
(8, 7, 'katana', 'Cat', 'Tilapia skin', NULL, '5', 1, 'Unvaccinated', NULL, '2026-04-07 01:23:36', '2026-04-07 01:23:36', 'alive');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resident_code` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `birthday` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Prefer not to say') NOT NULL,
  `civil_status` enum('Single','Married','Widowed','Separated','Divorced') NOT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_voter` tinyint(1) NOT NULL DEFAULT 0,
  `is_pwd` tinyint(1) NOT NULL DEFAULT 0,
  `is_senior` tinyint(1) NOT NULL DEFAULT 0,
  `is_single_parent` tinyint(1) NOT NULL DEFAULT 0,
  `is_student` tinyint(1) NOT NULL DEFAULT 0,
  `memberships` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`memberships`)),
  `address` varchar(255) NOT NULL,
  `is_household_head` tinyint(1) NOT NULL DEFAULT 0,
  `household_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `archived_at` timestamp NULL DEFAULT NULL,
  `archive_reason` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `resident_code`, `user_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `birthday`, `birthplace`, `gender`, `civil_status`, `spouse_name`, `occupation`, `contact_number`, `photo`, `is_voter`, `is_pwd`, `is_senior`, `is_single_parent`, `is_student`, `memberships`, `address`, `is_household_head`, `household_head_id`, `created_at`, `updated_at`, `archived_at`, `archive_reason`, `deleted_at`, `relationship`, `age`) VALUES
(1, 'RES-MEVJVMHE', 8, 'Mikael', 'Hiro', 'Fujimoto', NULL, '2003-03-28', 'Bahay', 'Male', 'Married', NULL, NULL, '09327359733', 'residents/photos/Q7ysmb55USRAoi4mtb2RxHGNOEmRFEKl4TAvg3Nl.jpg', 1, 0, 0, 0, 0, NULL, 'Blk 123 Lot 4 Subdivision', 0, NULL, '2026-03-15 02:07:48', '2026-03-20 07:20:06', NULL, NULL, NULL, NULL, NULL),
(2, 'RES-J72D88ZN', NULL, 'Shimiya', 'Furu', 'Yoshida', NULL, '2000-03-15', 'Dasma, Cavite', 'Female', 'Married', NULL, NULL, '09765432152', 'residents/photos/5jv4F69czwKTd0eDvnAqfndPTIdOZV10nmv7UwST.jpg', 0, 0, 0, 0, 0, NULL, 'Blk 143 Lot 9 Phase 4', 0, NULL, '2026-03-15 02:11:42', '2026-03-19 02:48:48', NULL, NULL, NULL, NULL, NULL),
(3, 'RES-J3EKHHWG', 9, 'Anne', 'Salish', 'Smith', NULL, '2001-05-05', 'Hospital', 'Female', 'Single', NULL, NULL, '09567984316', NULL, 1, 0, 0, 1, 0, '\"[\\\"4Ps\\\",\\\"KDBM\\\"]\"', 'Blk 187 Lot 12 Phase 2', 0, NULL, '2026-03-15 02:29:43', '2026-03-25 19:03:48', NULL, NULL, NULL, NULL, NULL),
(4, 'RES-OUW38MAW', NULL, 'Orlando', 'Mimor', 'Marino', NULL, '1960-07-15', 'Reclamation', 'Male', 'Married', NULL, NULL, '09145223788', NULL, 0, 0, 1, 0, 0, NULL, 'Blk 136 Lot 15 Phase 3', 0, NULL, '2026-03-15 02:33:00', '2026-03-15 02:33:00', NULL, NULL, NULL, NULL, NULL),
(5, 'RES-TJDFTMXX', NULL, 'Millie', 'Jenner', 'Grande', NULL, '2011-02-14', 'Hospital', 'Female', 'Single', NULL, NULL, '09768645845', NULL, 0, 1, 0, 0, 0, NULL, 'Blk 187 Lot 12 Phase 2', 0, NULL, '2026-03-15 02:39:03', '2026-03-15 02:39:03', NULL, NULL, NULL, NULL, NULL),
(6, 'RES-BYDIW8OD', 10, 'Van Cornelius', 'Lobusta', 'Paragas', NULL, '2005-11-29', 'Dasmariñas, Cavite', 'Male', 'Married', 'Hannah Khaye Gonzaga', 'Chef/Baker', '09763444053', 'residents/photos/L6MbViinFSInkh98x8rl5ELyCoU9s2ZymPKQ5Mm4.jpg', 1, 0, 0, 0, 0, NULL, 'Blk 15 Lot A R5 Cityhomes Resortville', 0, NULL, '2026-03-20 07:35:05', '2026-03-21 08:41:53', NULL, NULL, NULL, NULL, NULL),
(7, 'RES-VPFQP9KG', 11, 'Rheamay', 'Rebay', 'Diongco', NULL, '2003-11-01', 'bahay', 'Female', 'Single', NULL, NULL, '09633951836', 'residents/photos/klgOBqKgGTLtdhJCviJELuhEonQTMitYmNAC5ysv.jpg', 1, 0, 0, 0, 0, NULL, 'phase 5 site', 0, NULL, '2026-03-23 23:09:02', '2026-04-07 00:31:59', NULL, NULL, NULL, NULL, NULL),
(8, 'RES-CKHHVBK9', NULL, 'Hannah', NULL, 'Gonzaga', NULL, '2026-03-26', 'bahay', 'Male', 'Single', NULL, NULL, '0999', NULL, 0, 0, 0, 0, 0, NULL, 'phase 5 site', 0, NULL, '2026-03-25 21:26:33', '2026-03-25 21:26:59', '2026-03-25 21:26:59', 'Archived by office staff', NULL, NULL, NULL),
(9, 'RES-PUNSAQVO', 12, 'Joann', 'M', 'Manubis', NULL, '2026-03-28', 'bahay', 'Female', 'Married', 'lods', NULL, '091233333333', NULL, 1, 0, 0, 0, 0, NULL, 'manubis store', 0, NULL, '2026-03-27 06:10:34', '2026-03-27 06:11:37', NULL, NULL, NULL, NULL, NULL),
(10, 'RES-TM7YIOX4', 13, 'Jayson', NULL, 'Rivera', NULL, '2001-03-27', 'dasma', 'Male', 'Married', 'gf nya', NULL, '0999999999999', NULL, 0, 0, 0, 0, 1, NULL, 'san mig 2', 0, NULL, '2026-03-27 06:12:36', '2026-03-27 06:16:33', NULL, NULL, NULL, NULL, NULL),
(11, 'RES-1UWOOHWJ', NULL, 'Lloyd', 'P', 'Tejano', NULL, '2004-06-16', 'dasma', 'Male', 'Single', NULL, NULL, '09786564646', NULL, 1, 0, 0, 0, 0, NULL, 'area 1', 0, NULL, '2026-03-27 06:14:17', '2026-03-27 06:14:17', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resident_messages`
--

CREATE TABLE `resident_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `resident_code` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `admin_reply` text DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resident_messages`
--

INSERT INTO `resident_messages` (`id`, `user_id`, `name`, `email`, `resident_code`, `subject`, `message`, `admin_reply`, `read_at`, `replied_at`, `created_at`, `updated_at`) VALUES
(1, 8, 'Mikael Fujimoto', 'gonzaga.hannahkhayera.kld@gmail.com', 'RES-MEVJVMHE', 'Other', 'antok nko', 'sleep well', '2026-03-21 10:20:11', '2026-03-23 22:31:32', '2026-03-21 10:12:41', '2026-03-23 22:31:32'),
(2, 10, 'Van Cornelius Paragas', 'vclparagas@kld.edu.ph', 'RES-BYDIW8OD', 'General Inquiry', 'sana marecieve', 'recieved successfully', '2026-03-23 23:21:15', '2026-03-30 22:57:06', '2026-03-23 23:20:38', '2026-03-30 22:57:06'),
(3, 11, 'Rheamay Diongco', 'rrdiongco@kld.edu.ph', 'RES-VPFQP9KG', 'General Inquiry', 'hawak mo ang beat', 'oo be', '2026-03-24 00:06:52', '2026-04-07 00:40:50', '2026-03-24 00:06:00', '2026-04-07 00:40:50'),
(4, 8, 'Mikael Fujimoto', 'gonzaga.hannahkhayera.kld@gmail.com', 'RES-MEVJVMHE', 'Other', 'hello', NULL, '2026-03-27 06:50:07', NULL, '2026-03-27 05:43:37', '2026-03-27 06:50:07'),
(5, 8, 'Mikael Fujimoto', 'gonzaga.hannahkhayera.kld@gmail.com', 'RES-MEVJVMHE', 'General Inquiry', 'hi ho', NULL, '2026-03-27 06:49:53', NULL, '2026-03-27 05:47:13', '2026-03-27 06:49:53'),
(6, 8, 'Mikael Fujimoto', 'gonzaga.hannahkhayera.kld@gmail.com', 'RES-MEVJVMHE', 'Other', 'hawak mo ang beat', NULL, '2026-03-27 06:49:40', NULL, '2026-03-27 06:28:10', '2026-03-27 06:49:40'),
(7, 8, 'Mikael Fujimoto', 'gonzaga.hannahkhayera.kld@gmail.com', 'RES-MEVJVMHE', 'General Inquiry', 'hello', 'hi', '2026-04-01 05:53:49', '2026-04-01 05:53:56', '2026-03-30 23:12:39', '2026-04-01 05:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9KZo0vbOlv9iWLAg6XTIypykefSVBQbWN0ye3Zqr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia01iR2tsV1QzRlR3M1JOSGVLRUVtUUc1Ym9RSzl1c3lDNTRDd2dIMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775549958),
('Nr31Jd091uILmA4kLjm7bgKkIdVkFqoqFMKqhq0w', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRDhEeFhHMFF5Z2pOUDA5aExpa3RWMlY2Mjk4Wm1HbnFPTU1haGxWbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1775554511),
('xtx6sdIcCCkdDbfOVm1V5DJJl7AndaDbLop6QDnC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1dXaDluRTlPZ1Z0eWlkY3Jqcktvbmw4Z0lOMEN1eUwxNUpPNm9yMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXNpZGVudCI7czo1OiJyb3V0ZSI7czoxNDoicmVzaWRlbnQuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775644468);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `resident_code` varchar(255) DEFAULT NULL,
  `is_voter` tinyint(1) NOT NULL DEFAULT 0,
  `is_senior` tinyint(1) NOT NULL DEFAULT 0,
  `is_pwd` tinyint(1) NOT NULL DEFAULT 0,
  `is_single_parent` tinyint(1) NOT NULL DEFAULT 0,
  `is_student` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','office','justice','vawc','peace','resident') NOT NULL DEFAULT 'resident',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `password_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`password_history`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `middle_name`, `last_name`, `contact_number`, `birthday`, `birthplace`, `gender`, `civil_status`, `spouse_name`, `address`, `occupation`, `photo`, `resident_code`, `is_voter`, `is_senior`, `is_pwd`, `is_single_parent`, `is_student`, `email`, `role`, `status`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `security_question`, `security_answer`, `password_history`) VALUES
(1, 'Office Staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'office@brgysm2.com', 'office', 'active', 1, NULL, '$2y$12$24PnilfhEs6l/RVpt.OwH.YFheC01u06ebqDp9S2tWtgoSwMxU/Aq', NULL, '2026-03-14 22:03:27', '2026-03-30 21:51:43', 'What is the name of our Barangay?', 'San Miguel II', NULL),
(2, 'Justice Officer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'justice@brgysm2.com', 'justice', 'active', 1, NULL, '$2y$12$eGvFsGb9i1L/7gil4ceSJOIWrxyXFpfUd0RRAGPQY0jbGzOENx95C', NULL, '2026-03-14 22:03:28', '2026-03-30 21:51:43', 'What is the name of our Barangay?', 'San Miguel II', NULL),
(3, 'VAWC Staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'vawc@brgysm2.com', 'vawc', 'active', 1, NULL, '$2y$12$.sDQ9CD6poWWKlfEBXkO0.6281mKWGrl880lGvDiOPwOJWfY71.QW', NULL, '2026-03-14 22:03:28', '2026-03-30 21:51:43', 'What is the name of our Barangay?', 'San Miguel II', NULL),
(4, 'Peace and Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'peace@brgysm2.com', 'peace', 'active', 1, NULL, '$2y$12$EsDU5OUydFiA7LeHqS4jpewaQp.PwT8nGWKLhvVJspS7cQ2AVN.L.', NULL, '2026-03-14 22:03:29', '2026-03-30 21:51:43', 'What is the name of our Barangay?', 'San Miguel II', NULL),
(5, 'Juan Dela Cruz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'juan@brgysm2.com', 'resident', 'active', 1, NULL, '$2y$12$5/1C5EJ3K.2FRgHRnMxgN.54kwPqUBXxnavjnP6zb.2EjwJPiRh2K', NULL, '2026-03-14 22:03:29', '2026-03-15 07:42:44', NULL, NULL, NULL),
(6, 'Admin User', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'admin@brgysm2.com', 'admin', 'active', 1, NULL, '$2y$12$Kt.HGysFCET/6hNaOgkMfOOH/V.f8P4znZP7.anROgIEMiv4dVO/S', NULL, '2026-03-14 22:03:30', '2026-03-30 21:51:43', 'What is the name of our Barangay?', 'San Miguel II', NULL),
(7, 'shimiya', 'Shimiya', 'Furu', 'Yoshida', '09765432152', '2000-03-15', 'Dasma, Cavite', 'Female', 'Married', NULL, 'Blk 143 Lot 9 Phase 4', NULL, NULL, NULL, 0, 0, 0, 0, 0, 'hannahgonzaga01@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$UcW11HU1Ji96HRi5oinkYuoui12nRed801yC.2n97/fT00tuSwEn2', 'YLIdo6pY1git5UN2qiz9a8ORlKtQarr9AhDDiqrChHJoOgEpkw8b1SxuDmTf', '2026-03-15 02:40:46', '2026-03-25 18:33:30', NULL, NULL, NULL),
(8, 'Mikael Fujimoto', 'Mikael', 'Hiro', 'Fujimoto', '09327359733', '2003-03-28', 'Bahay', 'Male', 'Married', NULL, 'Blk 123 Lot 4 Subdivision', NULL, 'residents/photos/Q7ysmb55USRAoi4mtb2RxHGNOEmRFEKl4TAvg3Nl.jpg', 'RES-MEVJVMHE', 1, 0, 0, 0, 0, 'gonzaga.hannahkhayera.kld@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$ibSQ83myqiBqtVCcauXeZOxypOQy5B1VZh6jc2zEm6xN8k2g5cmHi', NULL, '2026-03-19 00:15:04', '2026-03-21 07:31:08', NULL, NULL, NULL),
(9, 'Anne Smith', 'Anne', 'Salish', 'Smith', '09567984316', '2001-05-05', 'Hospital', 'Female', 'Single', NULL, 'Blk 187 Lot 12 Phase 2', NULL, NULL, 'RES-J3EKHHWG', 1, 0, 0, 1, 0, 'gonzagahkr@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$tzLtJR/wYpCwSRz2CFnqjeCzg95U9ER9N8ss3SDkl.gyIlJSIhL8u', 'jcaI7SQXCbcHgkmJXGWxFNcwXRCss5QUCWeq67RN1oxPgmIyDsQURZJQNz0Q', '2026-03-19 01:24:12', '2026-03-27 19:06:49', NULL, NULL, NULL),
(10, 'Van Cornelius Paragas', 'Van Cornelius', 'Lobusta', 'Paragas', '09763444053', '2005-11-29', 'Dasmariñas, Cavite', 'Male', 'Married', 'Hannah Khaye Gonzaga', 'Blk 15 Lot A R5 Cityhomes Resortville', 'Chef/Baker', 'residents/photos/L6MbViinFSInkh98x8rl5ELyCoU9s2ZymPKQ5Mm4.jpg', 'RES-BYDIW8OD', 1, 0, 0, 0, 0, 'vclparagas@kld.edu.ph', 'resident', 'active', 1, NULL, '$2y$12$qinZ50H0qhnNCfj5Vi3rpujZlKDt3meKEQ8f3YuIj7EIN2CnhENWW', NULL, '2026-03-20 07:36:44', '2026-03-21 08:41:53', NULL, NULL, NULL),
(11, 'Rheamay Diongco', 'Rheamay', 'Rebay', 'Diongco', '09633951836', '2003-11-01', 'bahay', 'Female', 'Single', NULL, 'phase 5 site', NULL, 'residents/photos/klgOBqKgGTLtdhJCviJELuhEonQTMitYmNAC5ysv.jpg', 'RES-VPFQP9KG', 1, 0, 0, 0, 0, 'rrdiongco@kld.edu.ph', 'resident', 'active', 1, NULL, '$2y$12$4TnPtxClgVdi99wY.txIU.VNHDBeSkuPL3Lad5m32AdjlHlU4M3/a', '5M0hkhvE58LHMwxJjcTaAGQyHFXBZ05us316MZ9xmhvB5pahwgbqZGyzWA4g', '2026-03-23 23:09:54', '2026-04-07 00:31:59', NULL, NULL, '[\"$2y$12$4TnPtxClgVdi99wY.txIU.VNHDBeSkuPL3Lad5m32AdjlHlU4M3\\/a\"]'),
(12, 'Joann M Manubis', 'Joann', 'M', 'Manubis', '091233333333', '2026-03-28', 'bahay', 'Female', 'Married', 'lods', 'manubis store', NULL, NULL, 'RES-PUNSAQVO', 1, 0, 0, 0, 0, 'jowanamanubis@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$V0/7roKCF5iQTrKigwQBre6eSwR/sS6sAEY0C52aVKT0mAnFP0roG', 'tDAA93El2Pfo5yeI6HMetd8lBlEHSHczWCsFGdlxXx41765vodzhjWDNtS67', '2026-03-27 06:11:37', '2026-03-27 06:11:38', NULL, NULL, NULL),
(13, 'Jayson rivera', 'Jayson', NULL, 'Rivera', '0999999999999', '2001-03-27', 'dasma', 'Male', 'Married', 'gf nya', 'san mig 2', NULL, NULL, 'RES-TM7YIOX4', 0, 0, 0, 0, 1, 'riverajayson2002@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$O4jjAt5J6wULcYix4DvGh.eZHS1lRrlYcdXFumS.dvyGQfPckjq3q', NULL, '2026-03-27 06:16:33', '2026-03-27 06:16:36', NULL, NULL, NULL),
(14, 'mamiyu meme minime', 'mamiyu', 'meme', 'minime', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 'mimiyu299@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$VTdk4OYoDAfv3swfKDYUGewEu1gMS3UL72Auj/N1Iu6DBK3gH8gqG', NULL, '2026-04-01 04:47:48', '2026-04-01 04:47:48', NULL, NULL, '[\"$2y$12$VTdk4OYoDAfv3swfKDYUGewEu1gMS3UL72Auj\\/N1Iu6DBK3gH8gqG\"]'),
(15, 'Nosi Sino Balasi', 'Nosi', 'Sino', 'Balasi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'hkrgonzaga@kld.edu.ph', 'resident', 'active', 1, NULL, '$2y$12$9cu.mB2kFdnWaUXIoaeyHe00hhDgJHyfieWPsj1JzamUO9A7TWcdO', NULL, '2026-04-02 04:03:56', '2026-04-02 04:03:56', NULL, NULL, '[\"$2y$12$9cu.mB2kFdnWaUXIoaeyHe00hhDgJHyfieWPsj1JzamUO9A7TWcdO\"]');

-- --------------------------------------------------------

--
-- Table structure for table `vawc_cases`
--

CREATE TABLE `vawc_cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `case_number` varchar(255) NOT NULL,
  `victim_name` varchar(255) NOT NULL,
  `suspect_name` varchar(255) NOT NULL,
  `case_description` text NOT NULL,
  `case_type` enum('Physical Abuse','Emotional Abuse','Sexual Abuse','Economic Abuse') NOT NULL,
  `status` enum('Reported','Under Assessment','For Referral','Closed') NOT NULL DEFAULT 'Reported',
  `protection_order_filed` tinyint(1) NOT NULL DEFAULT 0,
  `counseling_notes` text DEFAULT NULL,
  `police_referral` varchar(255) DEFAULT NULL,
  `handled_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_created_by_foreign` (`created_by`);

--
-- Indexes for table `blotter_reports`
--
ALTER TABLE `blotter_reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blotter_reports_blotter_number_unique` (`blotter_number`),
  ADD KEY `blotter_reports_recorded_by_foreign` (`recorded_by`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `digital_ids`
--
ALTER TABLE `digital_ids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `digital_ids_user_id_foreign` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documents_doc_number_unique` (`doc_number`),
  ADD KEY `documents_resident_id_foreign` (`resident_id`),
  ADD KEY `documents_issued_by_foreign` (`issued_by`);

--
-- Indexes for table `document_requests`
--
ALTER TABLE `document_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `issue_reports`
--
ALTER TABLE `issue_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mediation_cases`
--
ALTER TABLE `mediation_cases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mediation_cases_case_number_unique` (`case_number`),
  ADD KEY `mediation_cases_handled_by_foreign` (`handled_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pets_resident_id_foreign` (`resident_id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `residents_resident_code_unique` (`resident_code`),
  ADD KEY `residents_user_id_foreign` (`user_id`),
  ADD KEY `residents_household_head_id_foreign` (`household_head_id`);

--
-- Indexes for table `resident_messages`
--
ALTER TABLE `resident_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vawc_cases`
--
ALTER TABLE `vawc_cases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vawc_cases_case_number_unique` (`case_number`),
  ADD KEY `vawc_cases_handled_by_foreign` (`handled_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blotter_reports`
--
ALTER TABLE `blotter_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `digital_ids`
--
ALTER TABLE `digital_ids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_requests`
--
ALTER TABLE `document_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_reports`
--
ALTER TABLE `issue_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mediation_cases`
--
ALTER TABLE `mediation_cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `resident_messages`
--
ALTER TABLE `resident_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vawc_cases`
--
ALTER TABLE `vawc_cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `blotter_reports`
--
ALTER TABLE `blotter_reports`
  ADD CONSTRAINT `blotter_reports_recorded_by_foreign` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `digital_ids`
--
ALTER TABLE `digital_ids`
  ADD CONSTRAINT `digital_ids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_issued_by_foreign` FOREIGN KEY (`issued_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `documents_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`);

--
-- Constraints for table `document_requests`
--
ALTER TABLE `document_requests`
  ADD CONSTRAINT `document_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `issue_reports`
--
ALTER TABLE `issue_reports`
  ADD CONSTRAINT `issue_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `mediation_cases`
--
ALTER TABLE `mediation_cases`
  ADD CONSTRAINT `mediation_cases_handled_by_foreign` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `residents_household_head_id_foreign` FOREIGN KEY (`household_head_id`) REFERENCES `residents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `residents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `resident_messages`
--
ALTER TABLE `resident_messages`
  ADD CONSTRAINT `resident_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vawc_cases`
--
ALTER TABLE `vawc_cases`
  ADD CONSTRAINT `vawc_cases_handled_by_foreign` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
