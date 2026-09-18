SET SESSION sql_require_primary_key = 0;
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2026 at 12:54 PM
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
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `archived_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `tag`, `date`, `image`, `is_published`, `created_by`, `created_at`, `updated_at`, `is_active`, `archived_at`, `image_path`, `images`) VALUES
(1, 'VACATION REMINDERS', 'GABAY SA PAG-ALALA AT PAGNINILAY: MAHAL NA ARAW 2026 🙏\r\n\r\nIsang mapayapa at banal na paggunita sa buong komunidad ng Barangay San Miguel 2. Inaanyayahan ang lahat na makiisa sa ating mga nakatakdang aktibidad ngayong Mahal na Araw upang sama-sama tayong magnilay at magbalik-loob.', 'Announcement', NULL, 'announcements/kt3rDNL95ksi03eZ3D1pnjFVIP1sCyz1vUo4u31z.jpg', 1, 6, '2026-03-30 06:56:34', '2026-04-27 16:25:30', 0, NULL, 'announcements/kt3rDNL95ksi03eZ3D1pnjFVIP1sCyz1vUo4u31z.jpg', NULL),
(2, 'Delivery Riders', '📢 Sa lahat po ng Deliver Rider 🏍️🛵🚙\r\n\r\nNa residente po ng Barangay San Miguel 2.\r\n\r\nLALAMOVE, ANGKAS, MOVE IT, FOOD PANDA, GRAB, JOYRIDE AT IBA PA.\r\n\r\nMay kaunting handog po ang ating mahal na Mayor Jennifer Austria-Barzaga para sa inyo.\r\n\r\nPaki submit na lamang po ang mga sumusunod:\r\n\r\n☑️ PORTAL COPY (Dito na po kayo mag print sa Barangay)\r\n☑️ VOTERS ID / CERTIFICATE (Dito na po kayo mag xerox sa Barangay)\r\n- Kung wala ay pwede naman ang VOTERS LIST meron din po tayong kopya sa Barangay maliban sa bagong rehistro at paki samahan nalang po ng Photo copy Valid ID.', 'Announcement', '2026-04-15', NULL, 1, 6, '2026-04-27 08:30:39', '2026-04-27 16:24:35', 0, '2026-04-27 16:24:35', 'announcements/L3DCedeKqsYIO3FYUtDfn5MqP4lkZWpmNxtbpcbt.jpg', NULL),
(3, 'Barangay Assembly', 'Participants: All persons who are actual residents of the barangay for at least six months, at least 15 years of age, and registered voters or registered in the barangay assembly list.', 'Announcement', '2026-04-30', NULL, 1, 6, '2026-04-27 17:49:55', '2026-05-04 06:30:56', 0, '2026-05-04 06:30:56', 'announcements/iSnpxH1kou3YMKl3NK3NMPUb0wqkErGzg4j6Roqu.jpg', NULL),
(4, '🗳️ SPECIAL ELECTION 2026 | VOTING INFORMATION', '🗳️ SPECIAL ELECTION 2026 | VOTING INFORMATION\r\n📅 August 29, 2026\r\n📍 San Miguel Elementary School – Dasmariñas City\r\nFor the guidance of all registered voters, please take note of the voting center, clustered precinct numbers, assigned buildings, and room assignments indicated in the official information provided.\r\n⏰ Voting Hours:\r\n• Regular Voting: 7:00 AM – 3:00 PM\r\n• Early Voting for Senior Citizens, PWDs, their Assistors, and Pregnant Voters: 5:00 AM – 7:00 AM\r\n• Priority/PPP Voting: 5:00 AM – 12:00 NN\r\nPlease check your assigned precinct and room before election day to help ensure a smooth and orderly voting experience.\r\nLet us exercise our right to vote safely, responsibly, and peacefully. 🇵🇭 See less', 'Governance', '2026-08-29', NULL, 1, 6, '2026-08-27 17:39:34', '2026-08-29 19:27:02', 0, '2026-08-29 19:27:02', 'announcements/atu68ePTFMTP4GW1ltwHb8M2QXUBGhuF8mFbDyAO.jpg', '[\"announcements\\/atu68ePTFMTP4GW1ltwHb8M2QXUBGhuF8mFbDyAO.jpg\",\"announcements\\/cgv8UCP12367zSc6cc5YW89KfUDxTb63NB069lzM.jpg\"]');

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
-- Table structure for table `department_reports`
--

CREATE TABLE `department_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `report_title` varchar(255) NOT NULL,
  `reporting_period` varchar(255) NOT NULL,
  `report_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`report_data`)),
  `template_file` varchar(255) DEFAULT NULL,
  `submitted_by` varchar(255) NOT NULL,
  `submitted_role` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_reports`
--

INSERT INTO `department_reports` (`id`, `department`, `report_title`, `reporting_period`, `report_data`, `template_file`, `submitted_by`, `submitted_role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Justice', 'MONITORING REPORT ON THE IMPLEMENTATION OF KATARUNGANG PAMBARANGAY', 'SEPTEMBER 2026', '{\"province\":\"Cavite\",\"city\":\"Dasmari\\u00f1as\",\"barangay\":\"San Miguel 2\",\"monthYear\":\"SEPTEMBER 2026\",\"totalReceived\":5,\"criminalCases\":0,\"civilCases\":0,\"othersCases\":5,\"totalCases\":5,\"settledMediation\":3,\"settledConciliation\":0,\"settledArbitration\":0,\"totalSettled\":3,\"withdrawnCases\":0,\"repudiatedCases\":0,\"certToCourt\":0,\"pendingCases\":2,\"preparedBy\":\"LUPON SECRETARY\",\"preparedRole\":\"Lupon Tagapamayapa Secretary\",\"notedBy\":\"MARVIN M. BENIS\",\"notedRole\":\"Punong Barangay \\/ Lupon Chairman\"}', NULL, 'LUPON SECRETARY', 'Lupon Tagapamayapa Secretary', 'Submitted', '2026-09-02 20:23:51', '2026-09-02 20:23:51');

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
(4, 11, 'Hannah Gonzaga', '09168738313', 'generated', 'BSM2-26-04-004', '2026-04-07 00:44:14', '2026-04-09 04:40:23');

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
  `claimant_type` enum('self','authorized') NOT NULL DEFAULT 'self',
  `authorization_letter_path` varchar(255) DEFAULT NULL,
  `authorized_id_path` varchar(255) DEFAULT NULL,
  `guest_first_name` varchar(255) DEFAULT NULL,
  `guest_last_name` varchar(255) DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  `id_proof` varchar(255) DEFAULT NULL,
  `document_type` varchar(255) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
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
  `claimant_first_name` varchar(255) DEFAULT NULL,
  `claimant_middle_name` varchar(255) DEFAULT NULL,
  `claimant_last_name` varchar(255) DEFAULT NULL,
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
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `reschedule_count` int(11) NOT NULL DEFAULT 0,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `personnel_in_charge` varchar(255) DEFAULT NULL,
  `alternate_personnel` varchar(255) DEFAULT NULL,
  `disapproval_reason` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `notified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_requests`
--

INSERT INTO `document_requests` (`id`, `user_id`, `claimant_type`, `authorization_letter_path`, `authorized_id_path`, `guest_first_name`, `guest_last_name`, `guest_email`, `id_proof`, `document_type`, `purpose`, `address`, `age`, `birthday`, `contact`, `blk`, `lot`, `move_date`, `landlord`, `family_members`, `ward_name`, `ward_age`, `ward_relation`, `partner_name`, `living_since`, `claimant_name`, `claimant_relation`, `claimant_first_name`, `claimant_middle_name`, `claimant_last_name`, `birth_month`, `birth_year`, `child_name`, `father_name`, `mother_name`, `birth_attendant`, `born_from`, `residing_since`, `company_name`, `nature_of_business`, `non_op_since`, `status`, `appointment_date`, `appointment_time`, `reschedule_count`, `pickup_date`, `pickup_time`, `personnel_in_charge`, `alternate_personnel`, `disapproval_reason`, `admin_notes`, `notified_at`, `created_at`, `updated_at`) VALUES
(1, 8, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'clearance', 'Employment', 'Blk 123 Lot 4 Subdivision', NULL, NULL, '09327359733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'released', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-19 00:35:02', '2026-03-19 02:57:51'),
(2, 9, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'residency', 'Loan', 'Blk 187 Lot 12 Phase 2', NULL, NULL, '09567984316', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-19 01:26:12', '2026-03-19 01:26:12'),
(3, 10, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'residency', 'Employment', 'Blk 15 Lot A R5 Cityhomes Resortville', NULL, NULL, '09327359733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ready', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-21 07:15:42', '2026-03-23 22:58:30'),
(4, 11, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'jobseeker', 'Employment', 'phase 5', NULL, NULL, '09633951836', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'processing', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 23:12:15', '2026-03-23 23:12:54'),
(5, 11, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'cashgift', 'Employment', 'Phase 5', NULL, NULL, '09633951836', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'October', '1983', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ready', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 23:35:22', '2026-03-24 00:03:31'),
(6, 8, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'indigency', 'Employment', 'Site', NULL, NULL, '09168738313', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-27 06:24:00', '2026-03-27 06:24:00'),
(7, 12, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'indigency', 'Loan', 'Blk 112 lot 5 ph3', NULL, NULL, '09109896215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-27 06:25:49', '2026-03-27 06:25:49'),
(8, 12, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'indigency', 'Loan', 'Blk 112 lot 5 ph3', NULL, NULL, '09109896215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ready', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-27 06:25:55', '2026-03-27 06:55:57'),
(9, 8, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'indigency', 'Employment', 'Site', NULL, NULL, '09168738313', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'processing', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 23:06:45', '2026-04-21 18:18:12'),
(10, 15, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'movein', 'rent', 'sa tabi', NULL, NULL, '0986374382', '30', '2', 'March 2, 2026', 'duno', 'n/a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'processing', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 04:05:32', '2026-04-21 08:48:58'),
(11, NULL, 'self', NULL, NULL, 'Ivan', 'Paragas', 'vclparagas@gmail.com', 'guest_id_proofs/4YQlXGZQGoFLB85mVnAowlZ7ecFTkOmGuNbOugeI.jpg', 'business', 'Business permit', 'Site', NULL, NULL, '09168738313', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 17:15:43', '2026-04-22 17:15:43'),
(12, 8, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'residency', 'School', 'Blk 15a lot 8 cityhomes resortville', 23, '2003-03-28', '09168738313', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mikael Fujimoto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 07:08:27', '2026-05-04 07:08:27'),
(13, 8, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'clearance', NULL, 'Blk 123 Lot 4 Subdivision', 23, '2003-03-28', '09327359733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mikael Fujimoto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'processing', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-09 06:49:48', '2026-05-14 21:05:10'),
(14, 7, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'clearance', 'Employment', 'Blk 143 Lot 9 Phase 4', 20, '2005-06-18', '09765432152', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Shimiya Yoshida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'released', NULL, NULL, 0, '2026-05-11', '10:00:00', 'shimi', NULL, NULL, NULL, NULL, '2026-05-09 07:57:38', '2026-09-01 08:13:34'),
(15, 8, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'jobseeker', 'job', 'Blk 123 Lot 4 Subdivision', 23, '2003-03-28', '09327359733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mikael Fujimoto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ready', '2026-05-15', '09:00:00', 0, '2026-09-02', '09:00:00', NULL, NULL, NULL, NULL, NULL, '2026-05-13 08:19:36', '2026-09-01 09:36:46'),
(16, NULL, 'self', NULL, NULL, 'Mira', 'Sol', 'hannahgonzaga01@gmail.com', 'guest_ids/QVf9HWmng73cYPgpiNIGSMWhp4mvsL9kAoPfIADG.jpg', 'clearance', 'Employment', 'Site', 22, '2003-06-16', '09168738313', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mira Sol', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'released', '2026-05-22', '08:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-14 18:15:04', '2026-08-27 19:11:49'),
(17, 9, 'authorized', 'authorization_letters/Le6Mo4RRdbt7NTTbdbmS6TwL0e9XszX8MAGUZTtj.jpg', 'authorized_ids/pcmmZamraGloTOrlR7U9zWpCCaLYGAog9vEdahcc.jpg', NULL, NULL, NULL, NULL, 'clearance', 'Senior Citizen / PWD Benefit', 'Blk 178 Lot 2 Phase 4 Site', NULL, NULL, '09168738232', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Camhel Gonzaga', 'Sibling', 'Camhel', 'Ramos', 'Gonzaga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'released', '2026-08-23', '09:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-20 19:55:47', '2026-09-01 07:24:35'),
(18, 7, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'indigency', 'Employment', 'Blk 143 Lot 9 Phase 4', 20, '2005-06-18', '09765432152', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Shimiya Yoshida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'processing', '2026-09-01', '08:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 07:08:50', '2026-09-01 08:39:26'),
(19, 8, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'clearance', 'Financial / Medical Assistance', 'Blk 123 Lot 4 Subdivision', 23, '2003-03-28', '09327359733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Antonio Reyes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2026-09-02', '09:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 08:50:30', '2026-09-01 08:50:30'),
(20, 8, 'self', NULL, NULL, NULL, NULL, NULL, NULL, 'clearance', 'Financial / Medical Assistance', 'Blk 123 Lot 4 Subdivision', 23, '2003-03-28', '09327359733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Antonio Reyes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'processing', '2026-09-02', '09:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 08:50:36', '2026-09-01 08:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_sos_alerts`
--

CREATE TABLE `emergency_sos_alerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `resident_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `latitude` decimal(11,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `accuracy` varchar(255) DEFAULT NULL,
  `google_maps_url` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `responder_notes` text DEFAULT NULL,
  `dispatched_at` timestamp NULL DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `image_path` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `is_active`, `archived_at`, `title`, `description`, `location`, `day_label`, `frequency`, `time_range`, `tag`, `created_at`, `updated_at`, `image_path`, `images`) VALUES
(1, 0, '2026-04-22 20:30:49', 'Feeding Program', 'SOPAS PARA SA LAHAT!!', 'Barangay Court', 'Saturday', '2026-04-11', '6:00am-9:am', 'Community', '2026-03-23 23:47:57', '2026-04-22 20:30:49', NULL, NULL),
(2, 0, '2026-04-19 06:19:34', 'SWIMMING 2026', NULL, 'Barangay San Miguel II Covered Court', 'SUN', '2026-03-29', '9:00AM-3:00PM', 'Community', '2026-04-19 06:16:40', '2026-04-19 06:19:34', 'events/uveGEApaszRfurLdUAIOqIYvCYarnxIVDCkTdsHZ.jpg', NULL),
(4, 0, '2026-05-11 00:02:13', 'MISS BARANGAY SAN MIGUEL 2', 'Who can join?\r\n- 18 - 30yrs.old', 'Barangay Covered Court', 'SAT', '2026-05-09', '6:00-11:00PM', 'Community', '2026-04-27 17:46:37', '2026-05-11 00:02:13', 'events/5vuYgfOD1RSK4hi6EqiOmT6rLyE0APKg1s0opJzf.jpg', NULL);

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
  `guest_first_name` varchar(255) DEFAULT NULL,
  `guest_last_name` varchar(255) DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  `issue_type` varchar(255) NOT NULL,
  `complainant_name` varchar(255) NOT NULL,
  `complainant_age` varchar(255) DEFAULT NULL,
  `complainant_gender` varchar(255) DEFAULT NULL,
  `complainant_address` varchar(255) DEFAULT NULL,
  `is_on_behalf` tinyint(1) NOT NULL DEFAULT 0,
  `victim_name` varchar(255) DEFAULT NULL,
  `victim_age` int(11) DEFAULT NULL,
  `victim_gender` varchar(255) DEFAULT NULL,
  `victim_relationship` varchar(255) DEFAULT NULL,
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
  `official_document` varchar(255) DEFAULT NULL,
  `official_document_name` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL DEFAULT 'Justice',
  `status` varchar(255) NOT NULL DEFAULT 'submitted',
  `is_restricted` tinyint(1) NOT NULL DEFAULT 0,
  `transfer_count` int(11) NOT NULL DEFAULT 0,
  `transfer_reason` text DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `hearing_date` datetime DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `admin_summary` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_reports`
--

INSERT INTO `issue_reports` (`id`, `user_id`, `guest_first_name`, `guest_last_name`, `guest_email`, `issue_type`, `complainant_name`, `complainant_age`, `complainant_gender`, `complainant_address`, `is_on_behalf`, `victim_name`, `victim_age`, `victim_gender`, `victim_relationship`, `respondent_name`, `respondent_address`, `respondent_contact`, `description`, `location`, `incident_date`, `contact`, `witness_name`, `witness_contact`, `evidence`, `official_document`, `official_document_name`, `department`, `status`, `is_restricted`, `transfer_count`, `transfer_reason`, `rejection_reason`, `hearing_date`, `admin_notes`, `admin_summary`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, NULL, NULL, 'Noise Disturbance', 'Antonio Reyes', '25', 'Male', NULL, 0, NULL, NULL, NULL, NULL, 'kapitbahay', 'site lng din', NULL, 'de makatulog sa gabe', 'site', '2026-03-27T23:00', '099999997', NULL, NULL, NULL, NULL, NULL, 'Peace & Order', 'settled', 0, 0, NULL, NULL, NULL, NULL, NULL, '2026-03-27 18:42:29', '2026-09-01 06:29:11'),
(2, 9, NULL, NULL, NULL, 'VAWC – Domestic Violence', 'Anne Smith', '20', 'Female', NULL, 0, NULL, NULL, NULL, NULL, 'Sasagurl', 'Site', NULL, 'Sinisigawan ako be', 'bahay', '2026-03-28T07:00', '0927878745', NULL, NULL, NULL, NULL, NULL, 'VAWC', 'on_going', 0, 0, NULL, NULL, NULL, 'Escalated to PNP/DSWD for immediate emergency assessment.', 'According to the complainant it happens on their house that the respondent shouted her and she don\'t like it.', '2026-03-27 19:10:01', '2026-03-27 23:02:44'),
(3, 4, NULL, NULL, NULL, 'Others', 'Juan Carlos Santos', '30', 'Male', NULL, 0, NULL, NULL, NULL, NULL, 'KUNG CNO LNG', 'Site', NULL, 'WAT DAW', 'bahay', '2026-03-27T19:18', '099996767', NULL, NULL, NULL, NULL, NULL, 'Justice', 'submitted', 0, 1, NULL, NULL, NULL, NULL, '[ESCALATED TO KP / JUSTICE]\nEndorsed from Peace & Order: They want to file a case', '2026-03-28 03:18:33', '2026-09-01 09:43:56'),
(4, 4, NULL, NULL, NULL, 'Patrol Schedule', 'MANG JUAN', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10 PM CURFEW', 'AREA G', '2026-03-30', 'N/A', NULL, NULL, NULL, NULL, NULL, 'Peace & Order', 'pending', 0, 0, NULL, NULL, NULL, NULL, NULL, '2026-03-28 03:22:02', '2026-03-28 03:22:02'),
(5, NULL, NULL, NULL, NULL, 'Illegal Parking / Road Blockage', 'Maria Cecilia Santos', '25', 'Female', NULL, 0, NULL, NULL, NULL, NULL, 'Ricardo \"Rick\" Gomez', 'Blk 14, Lot 24, Phase 1, Brgy. San Miguel 2', NULL, 'On the night of March 28, at approximately 10:30 PM, the respondent, Mr. Ricardo Gomez, parked his delivery van directly in front of my driveway, completely obstructing the entrance and exit of my personal vehicle. When I approached him politely to request that he move the vehicle so my husband could leave for his night shift, the respondent became verbally aggressive and used profane language.\r\n\r\nDespite my attempts to de-escalate, the respondent refused to move the vehicle for over an hour and made threatening gestures toward our property. This is the third recorded instance of this parking violation this month. I am filing this report to request a formal mediation to settle this boundary and parking dispute permanently, as it is now affecting my family’s safety and livelihood', 'Frontage of Blk 14, Lot 22 (Complainant\'s Residence)', '2026-03-28T22:30', '09867676754', NULL, NULL, NULL, NULL, NULL, 'Justice', 'settled', 0, 0, NULL, NULL, '2026-04-04 10:00:00', NULL, NULL, '2026-03-28 21:28:46', '2026-04-21 09:02:24'),
(6, 14, NULL, NULL, NULL, 'Physical Assault', 'mamiyu minime', '23', 'Female', NULL, 0, NULL, NULL, NULL, NULL, 'Hannah Khaye Gonzaga', 'Site', NULL, 'na hurt aq', NULL, '2026-03-31T22:30', '097856565', NULL, NULL, NULL, NULL, NULL, 'Justice', 'under_review', 0, 0, NULL, NULL, '2026-09-18 10:00:00', NULL, NULL, '2026-04-01 05:31:09', '2026-09-02 20:23:52'),
(7, 8, 'Maria Clara', 'Dizon', NULL, 'Trespassing', 'Maria Clara Dizon', '23', 'Female', NULL, 0, NULL, NULL, NULL, NULL, 'Shimiya', 'Site', NULL, 'pinasok nya bahay namin', 'bahay', '2026-04-15T23:52', '09168738313', NULL, NULL, NULL, NULL, NULL, 'Justice', 'settled', 0, 0, NULL, NULL, '2026-04-25 13:00:00', NULL, 'can\'t handle this', '2026-04-15 18:52:40', '2026-09-01 06:29:11'),
(8, NULL, NULL, NULL, 'mhiecajoice@gmail.com', 'Noise Disturbance', 'Mhieca', '25', 'Female', NULL, 0, NULL, NULL, NULL, NULL, 'Cardo', 'Blk 12, Lot 6 (Neighbor), Brgy. San Miguel 2', NULL, 'Cardo was hosting a party with extremely loud karaoke music that lasted until past midnight. Despite several polite requests from neighbors to lower the volume, the noise continued, disturbing the sleep of residents and students in the area.', 'Front of Lot 6,San miguel 1', '2026-04-27T23:10', '09123456789', 'Maria Santos', NULL, '[\"issue_evidence\\/GetW7LvGVsJpvrSvB71pLaqDXAo8TzsF2gR4gheF.jpg\"]', NULL, NULL, 'Justice', 'settled', 0, 0, NULL, NULL, '2026-06-26 09:00:00', NULL, 'not settled', '2026-04-27 17:09:11', '2026-08-28 23:41:13'),
(9, 7, 'Maria Clara', 'Dizon', NULL, 'Physical Assault', 'Maria Clara Dizon', '23', 'Female', NULL, 0, NULL, NULL, NULL, NULL, 'Justin Bieber', 'Site', NULL, 'Kagabi, bandang alas-nuwebe y medya ng gabi, umuwi ang aking asawa (respondent) na lasing na lasing. Nagkaroon kami ng mainit na pagtatalo dahil sa pera hanggang sa bigla niya akong sinaktan. Pinagbuhatan niya ako ng kamay, tinulak sa pader, at sinampal ng ilang beses sa harap ng aming mga anak. Natigil lang ang pananakit niya nang dumating ang aming kapitbahay para umawat. Natatakot ako para sa kaligtasan ko at ng mga bata kaya ako nag-re-report ngayon.', 'BLK 6 LOT 2 BRGY. SAN MIGUEL 2', '2026-04-27T22:50', '09168738313', NULL, NULL, NULL, NULL, NULL, 'VAWC', 'under_review', 1, 1, NULL, NULL, NULL, NULL, NULL, '2026-04-27 18:51:29', '2026-09-02 19:43:52'),
(10, NULL, 'Maria Clara', 'Dizon', 'gonzagahkr@gmail.com', 'Theft / Robbery', 'Maria Clara Dizon', '20', 'Female', NULL, 0, NULL, NULL, NULL, NULL, 'Haru Chan', 'Site', NULL, 'I\'m about to sleep then heard someone brag in to our house and when I check the robber is about to run and somehow I recognize his face.', 'House', '2026-05-14T23:35', '09168738313', NULL, NULL, NULL, NULL, NULL, 'Peace & Order', 'pending', 0, 0, NULL, NULL, NULL, NULL, NULL, '2026-05-14 18:34:57', '2026-09-01 06:29:11');

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
(35, '2026_04_07_085706_add_months_to_pets_table', 15),
(36, '2026_04_11_133001_add_is_archived_to_pets_table', 16),
(37, '2026_04_12_071959_add_is_non_voter_to_users_and_residents_tables', 17),
(38, '2026_04_14_154045_add_voter_verification_fields_to_users_table', 18),
(40, '2026_04_14_234631_add_rejection_reason_to_issue_reports_table', 19),
(41, '2026_04_19_135604_add_date_to_announcements_table', 20),
(42, '2026_04_23_001138_create_projects_table', 21),
(43, '2026_04_23_005506_add_guest_fields_to_document_requests_table', 22),
(44, '2026_04_23_031552_add_vaccine_proof_to_pets_table', 23),
(45, '2026_04_23_031555_add_claimant_details_to_document_requests_table', 23),
(46, '2026_04_23_035249_add_fields_for_revisions', 24),
(47, '2026_04_23_044634_add_detailed_claimant_names_to_document_requests_table', 25),
(48, '2026_04_24_055122_create_carousel_slides_table', 26),
(49, '2026_04_24_055124_create_site_settings_table', 26),
(50, '2026_04_24_070131_create_patrol_schedules_table', 27),
(51, '2026_04_24_071519_refine_patrol_schedules_table', 28),
(52, '2026_04_24_072806_add_time_to_patrol_schedules', 29),
(53, '2026_04_24_074938_add_status_to_patrol_schedules', 30),
(54, '2026_04_24_085503_add_restricted_fields_to_issue_reports_table', 31),
(55, '2026_04_24_091934_add_transfer_count_to_issue_reports_table', 32),
(56, '2026_04_24_095508_add_photo_and_verification_to_pets_table', 33),
(57, '2026_04_24_100445_add_disapproval_reason_to_pets_table', 34),
(58, '2026_04_24_102910_add_bedridden_and_household_head_to_residents_table', 35),
(59, '2026_04_24_143619_add_proofs_and_verification_to_residents_table', 36),
(60, '2026_04_25_131330_add_is_bedridden_to_users_table', 37),
(61, '2026_04_25_143336_migrate_carousel_to_settings', 38),
(62, '2026_04_27_071358_add_household_id_to_residents_table', 39),
(63, '2026_04_28_002541_add_age_to_document_requests', 40),
(64, '2026_04_28_004943_add_guest_details_to_issue_reports', 41),
(65, '2026_04_30_035037_add_pickup_details_to_document_requests_table', 42),
(66, '2026_05_04_161650_change_image_path_type_in_patrol_schedules', 43),
(67, '2026_05_09_141940_add_photo_updated_at_to_users_table', 44),
(68, '2026_05_09_150339_add_photo_updated_at_to_pets_table', 45),
(69, '2026_05_09_161646_add_alternate_personnel_to_document_requests_table', 46),
(70, '2026_05_13_160429_add_appointment_details_to_document_requests_table', 47),
(71, '2026_05_13_163236_add_reschedule_count_to_document_requests_table', 48),
(72, '2026_05_15_053523_add_otp_fields_to_users_table', 49),
(73, '2026_04_25_000001_add_images_to_announcements_and_events_table', 50),
(74, '2026_08_29_104051_add_precinct_no_to_users_and_residents_tables', 50),
(75, '2026_08_30_122500_add_victim_fields_and_transfer_reason_to_issue_reports', 51),
(76, '2026_08_30_122600_create_vawc_audit_logs_table', 51),
(77, '2026_08_30_125000_add_official_document_to_issue_reports', 52),
(78, '2026_09_03_035813_create_department_reports_table', 53),
(79, '2026_09_07_000001_create_projects_table', 54),
(80, '2026_09_07_000002_create_emergency_sos_alerts_table', 54),
(81, '2026_09_07_000003_update_projects_table', 55);

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
('10a33e52-2674-4321-bf9f-8282e683b946', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"document_status_updated\",\"document_request_id\":13,\"status\":\"processing\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Clearance is now being processed. We will notify you when it\'s ready.\"}', '2026-09-01 08:49:28', '2026-05-14 21:05:20', '2026-09-01 08:49:28'),
('10bf7d8d-bfb2-47d4-92c8-167211e0cb9c', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 10, '{\"type\":\"document_received\",\"title\":\"\\ud83d\\udcc4 Document Request Received\",\"message\":\"Your request for Residency has been received and is now pending review.\"}', '2026-03-21 07:16:00', '2026-03-21 07:15:49', '2026-03-21 07:16:00'),
('124cf489-302e-4800-95e0-fccf723ae7d6', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Noise Disturbance is now Settled\",\"id\":1}', '2026-05-09 06:40:44', '2026-05-04 07:59:13', '2026-05-09 06:40:44'),
('134cccc0-9f04-40bf-a549-25d12ec06627', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Noise Disturbance is now Submitted\",\"id\":1}', '2026-03-28 21:30:32', '2026-03-28 00:50:22', '2026-03-28 21:30:32'),
('17b6e3ee-3540-4979-8315-aa3479a2bbbf', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 9, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report VAWC \\u2013 Domestic Violence is now On going\",\"id\":2}', '2026-04-28 18:55:45', '2026-04-21 17:23:21', '2026-04-28 18:55:45'),
('18a23358-0417-49d5-83b1-790739f1ba0c', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 11, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Jobseeker is now being processed. We will notify you when it\'s ready.\"}', '2026-03-24 00:06:10', '2026-03-23 23:37:37', '2026-03-24 00:06:10'),
('1a971ddf-9cf6-4f67-9a7f-e644949b6be0', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Noise Disturbance is now Pending\",\"id\":1}', '2026-03-28 21:30:32', '2026-03-28 02:05:18', '2026-03-28 21:30:32'),
('26daeb5f-e2af-48df-9706-d79ceae2467f', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 9, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Clearance has been received and is now pending review.\"}', '2026-08-20 19:55:59', '2026-08-20 19:55:52', '2026-08-20 19:55:59'),
('2da4f18e-e88b-4a1d-85bf-9e9f7bdd2f8e', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Noise Disturbance is now Under review\",\"id\":1}', '2026-03-28 21:30:32', '2026-03-27 23:47:23', '2026-03-28 21:30:32'),
('2deaa368-2bae-4525-bcc6-2e20c44307c1', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 12, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Indigency has been received and is now pending review.\"}', NULL, '2026-03-27 06:25:54', '2026-03-27 06:25:54'),
('2e92283f-a975-4eca-83d0-23ec393d2953', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 11, '{\"type\":\"document_received\",\"title\":\"\\ud83d\\udcc4 Document Request Received\",\"message\":\"Your request for Cashgift has been received and is now pending review.\"}', '2026-03-24 00:06:10', '2026-03-23 23:35:28', '2026-03-24 00:06:10'),
('343f1c3c-bbf9-4d54-8518-00b6c5780013', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 12, '{\"type\":\"document_status_updated\",\"title\":\"Ready for Pick-up! \\u2705\",\"message\":\"Your Indigency is ready! Please visit Barangay Hall (Mon\\u2013Fri, 8AM\\u20135PM) to claim it.\"}', NULL, '2026-03-27 06:56:03', '2026-03-27 06:56:03'),
('3a29a153-4814-430d-81ce-978e5b6f84e1', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"document_status_updated\",\"document_request_id\":13,\"status\":\"processing\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Clearance is now being processed. We will notify you when it\'s ready.\"}', '2026-09-01 08:49:28', '2026-05-14 21:05:25', '2026-09-01 08:49:28'),
('3c6416d5-06c5-4e55-b36f-6359806ba7cf', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"document_status_updated\",\"document_request_id\":15,\"status\":\"ready\",\"title\":\"Ready for Pick-up! \\u2705\",\"message\":\"Your Jobseeker is ready! Date: Sep 02, 2026. Time: 09:00 AM. \"}', NULL, '2026-09-01 09:36:50', '2026-09-01 09:36:50'),
('3d25c727-391e-46b7-bf86-7cd639d2f838', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Trespassing is now Settled\",\"id\":7}', '2026-04-22 20:50:21', '2026-04-21 08:56:51', '2026-04-22 20:50:21'),
('3f48db95-d90d-48f9-baf2-f639d2e02275', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 11, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Jobseeker is now being processed. We will notify you when it\'s ready.\"}', '2026-03-24 00:06:10', '2026-03-23 23:12:59', '2026-03-24 00:06:10'),
('46128d39-b500-4420-b849-0dfd77cbf0f6', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 8, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"General Inquiry\\\"\"}', '2026-04-01 05:54:50', '2026-04-01 05:54:02', '2026-04-01 05:54:50'),
('463f20d9-79ea-4c76-9186-e18c8d78eb46', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Trespassing is now Submitted\",\"id\":7}', '2026-04-22 20:50:21', '2026-04-15 19:01:23', '2026-04-22 20:50:21'),
('4c491a4a-0155-4d4c-a132-171975e4ad90', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 9, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report VAWC \\u2013 Domestic Violence is now On going\",\"id\":2}', '2026-04-28 18:55:45', '2026-03-27 22:22:46', '2026-04-28 18:55:45'),
('4d07a7b8-6d69-4896-a58d-232fbae2631a', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 15, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Movein is now being processed. We will notify you when it\'s ready.\"}', NULL, '2026-04-02 04:45:49', '2026-04-02 04:45:49'),
('5352efdc-d2af-4d8a-a28f-1f1ef55b5a6c', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 8, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Clearance has been received and is now pending review.\"}', '2026-05-09 06:51:14', '2026-05-09 06:49:54', '2026-05-09 06:51:14'),
('54a00035-d947-4db6-96a0-ab11182182c0', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 7, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Physical Assault is now Pending\",\"id\":9}', '2026-09-06 19:50:11', '2026-09-02 19:19:33', '2026-09-06 19:50:11'),
('5795ecb6-b6ca-476a-b549-5f2eda03b5f0', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"document_status_updated\",\"title\":\"Document Ready\",\"message\":\"\\ud83c\\udf89 Your Clearance is ready for pick-up at the Barangay Hall!\",\"document_type\":\"clearance\",\"status\":\"ready\",\"request_id\":1}', '2026-03-20 05:43:28', '2026-03-19 02:15:48', '2026-03-20 05:43:28'),
('608732e5-4d34-4821-9c72-ca7fa0689988', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 9, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report VAWC \\u2013 Domestic Violence is now Under review\",\"id\":2}', '2026-04-28 18:55:45', '2026-03-27 21:48:20', '2026-04-28 18:55:45'),
('6b4092ea-3ba0-4040-9340-012ab18fb3d3', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 8, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Jobseeker has been received and is now pending review.\"}', '2026-09-01 08:49:28', '2026-05-13 08:19:44', '2026-09-01 08:49:28'),
('7600f6d9-8a40-4fb0-afec-652787baa567', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"document_status_updated\",\"title\":\"Document Released\",\"message\":\"Your Clearance has been released.\",\"document_type\":\"clearance\",\"status\":\"released\",\"request_id\":1}', '2026-03-20 05:43:28', '2026-03-19 02:57:57', '2026-03-20 05:43:28'),
('7b92aac1-ebeb-462e-8e5b-31c10306ea1d', 'App\\Notifications\\DocumentAppointmentReminder', 'App\\Models\\User', 8, '{\"type\":\"appointment_reminder\",\"reminder_type\":\"1_day\",\"doc_id\":20,\"document_type\":\"clearance\",\"appointment_date\":\"2026-09-02\",\"appointment_time\":\"09:00:00\",\"title\":\"\\ud83d\\udcc5 Pick-up Reminder Tomorrow (Sep 02, 2026)\",\"message\":\"Reminder: You have an appointment tomorrow (Sep 02, 2026) at 09:00 AM to pick up your Clearance. Please bring your Valid ID.\"}', NULL, '2026-09-01 09:40:39', '2026-09-01 09:40:39'),
('897c309f-8be2-488b-97b9-417830839b70', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 11, '{\"type\":\"document_received\",\"title\":\"\\ud83d\\udcc4 Document Request Received\",\"message\":\"Your request for Jobseeker has been received and is now pending review.\"}', '2026-03-24 00:06:10', '2026-03-23 23:12:20', '2026-03-24 00:06:10'),
('8cbc2ba2-ae52-4f6d-92ff-34baaa689114', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 1, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Barangay Clearance has been received and is now pending review.\"}', NULL, '2026-09-06 20:30:06', '2026-09-06 20:30:06'),
('94cafa93-2bdf-4468-bcfc-ee4cd43af92d', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Trespassing is now Pending\",\"id\":7}', '2026-04-22 20:50:21', '2026-04-21 08:55:18', '2026-04-22 20:50:21'),
('98fadb99-b7e7-4773-a7d5-1c3051697642', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 11, '{\"type\":\"document_status_updated\",\"title\":\"Ready for Pick-up! \\u2705\",\"message\":\"Your Cashgift is ready! Please visit Barangay Hall (Mon\\u2013Fri, 8AM\\u20135PM) to claim it.\"}', '2026-03-24 00:06:10', '2026-03-24 00:03:36', '2026-03-24 00:06:10'),
('9e9f1b4d-b2b0-4742-a27c-af3eed2f3a88', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 7, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Clearance has been received and is now pending review.\"}', '2026-05-09 07:57:57', '2026-05-09 07:57:44', '2026-05-09 07:57:57'),
('9fb11d16-aa43-4314-a314-50d349669e39', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 10, '{\"type\":\"document_status_updated\",\"title\":\"Document Status Updated\\ud83d\\udccb \",\"message\":\"Your document request status has been updated to: Pending\"}', '2026-03-25 08:18:20', '2026-03-23 22:55:27', '2026-03-25 08:18:20'),
('a20f6b0e-04b4-4458-82a3-fc537b0658c8', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 15, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Movein is now being processed. We will notify you when it\'s ready.\"}', NULL, '2026-04-21 08:49:04', '2026-04-21 08:49:04'),
('a5f61b60-df82-490d-b2e8-86d3c93c7383', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 10, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Residency is now being processed. We will notify you when it\'s ready.\"}', '2026-03-25 08:18:20', '2026-03-23 22:58:10', '2026-03-25 08:18:20'),
('a6e5d754-6e8b-4f68-bb5e-3709b6929cb0', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 10, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"General Inquiry\\\"\"}', NULL, '2026-03-30 22:57:13', '2026-03-30 22:57:13'),
('a9fcf18d-5982-4191-88e6-941608a29e89', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 11, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"General Inquiry\\\"\"}', NULL, '2026-04-07 00:40:55', '2026-04-07 00:40:55'),
('aa8dc655-2c83-4947-829e-d7d988ad4ecb', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 12, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Indigency is now being processed. We will notify you when it\'s ready.\"}', NULL, '2026-03-27 06:54:12', '2026-03-27 06:54:12'),
('abd5be8b-d9b7-4697-a495-225ae224b39f', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 8, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Residency has been received and is now pending review.\"}', '2026-05-04 07:08:44', '2026-05-04 07:08:34', '2026-05-04 07:08:44'),
('ae437fb0-b94d-41d0-8bce-5eb9257f0535', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 10, '{\"type\":\"document_status_updated\",\"title\":\"Ready for Pick-up! \\u2705\",\"message\":\"Your Residency is ready! Please visit Barangay Hall (Mon\\u2013Fri, 8AM\\u20135PM) to claim it.\"}', '2026-03-25 08:18:20', '2026-03-23 22:58:34', '2026-03-25 08:18:20'),
('b5e3f971-42d9-4b81-9692-e1da8462ab36', 'App\\Notifications\\DocumentAppointmentReminder', 'App\\Models\\User', 7, '{\"type\":\"appointment_reminder\",\"reminder_type\":\"missed\",\"doc_id\":18,\"document_type\":\"indigency\",\"appointment_date\":\"2026-09-01\",\"appointment_time\":\"08:00:00\",\"title\":\"\\u26a0\\ufe0f Missed Appointment (Sep 01, 2026)\",\"message\":\"You missed your scheduled pick-up for Indigency on Sep 01, 2026 at 08:00 AM. Would you like to reschedule?\"}', '2026-09-06 19:50:11', '2026-09-01 09:40:36', '2026-09-06 19:50:11'),
('b648b89f-4de0-435c-b621-8b348b5ac441', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 8, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"Other\\\"\"}', '2026-03-23 22:33:24', '2026-03-23 22:31:37', '2026-03-23 22:33:24'),
('c28b31ce-33f6-4733-a7ea-dc7e9dd9e3e5', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Noise Disturbance is now Under review\",\"id\":1}', '2026-03-28 21:30:32', '2026-03-28 02:05:24', '2026-03-28 21:30:32'),
('c581526b-55ca-4b5c-9b67-9cb61daafa9b', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 8, '{\"type\":\"document_status_updated\",\"document_request_id\":13,\"status\":\"processing\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Clearance is now being processed. We will notify you when it\'s ready.\"}', '2026-09-01 08:49:28', '2026-05-14 21:05:15', '2026-09-01 08:49:28'),
('cf6343ec-1e6e-4158-aeda-9a53d56d07ef', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 15, '{\"type\":\"document_status_updated\",\"title\":\"Document Status Updated\\ud83d\\udccb \",\"message\":\"Your document request status has been updated to: Pending\"}', NULL, '2026-04-21 08:48:11', '2026-04-21 08:48:11'),
('d3fe58cc-baf8-4652-8057-6431aef08c19', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 4, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Others is now Submitted\",\"id\":3}', NULL, '2026-09-01 09:44:00', '2026-09-01 09:44:00'),
('d72fb430-e239-4bab-865c-b9f66606362c', 'App\\Notifications\\IssueStatusUpdated', 'App\\Models\\User', 7, '{\"type\":\"issue_status\",\"title\":\"Incident Status Updated\",\"message\":\"Status for your report Physical Assault is now Under review\",\"id\":9}', '2026-09-06 19:50:11', '2026-09-02 19:43:58', '2026-09-06 19:50:11'),
('da31d351-761d-4dc4-aaa6-3e4dbb1f5c69', 'App\\Notifications\\DocumentRequestStatusUpdated', 'App\\Models\\User', 11, '{\"type\":\"document_status_updated\",\"title\":\"Document Being Processed \\ud83d\\udd04\",\"message\":\"Your Cashgift is now being processed. We will notify you when it\'s ready.\"}', '2026-03-24 00:06:10', '2026-03-23 23:37:52', '2026-03-24 00:06:10'),
('de621455-d25d-4230-99a4-3d168f42ccfa', 'App\\Notifications\\AdminReplyNotification', 'App\\Models\\User', 11, '{\"type\":\"admin_reply\",\"title\":\"\\ud83d\\udcec Reply from Barangay Office\",\"message\":\"The office replied to your message: \\\"General Inquiry\\\"\"}', NULL, '2026-03-24 00:07:25', '2026-03-24 00:07:25'),
('e6f07a1f-51fc-4dc0-b47b-fb47d7fe129b', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 8, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Indigency has been received and is now pending review.\"}', '2026-03-27 06:24:47', '2026-03-27 06:24:07', '2026-03-27 06:24:47'),
('ee501a03-710b-4c66-856f-07e6d5a73879', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 8, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Indigency has been received and is now pending review.\"}', '2026-03-30 23:13:49', '2026-03-30 23:06:51', '2026-03-30 23:13:49'),
('f290d3ee-933f-4445-8b47-e1c5ee679c88', 'App\\Notifications\\DocumentRequestReceived', 'App\\Models\\User', 12, '{\"type\":\"document_received\",\"title\":\"Document Request Received\\u2714\\ufe0f\",\"message\":\"Your request for Indigency has been received and is now pending review.\"}', NULL, '2026-03-27 06:26:00', '2026-03-27 06:26:00'),
('ffb5e05a-7896-40c9-b1f0-3ce5563b40a2', 'App\\Notifications\\DocumentAppointmentReminder', 'App\\Models\\User', 8, '{\"type\":\"appointment_reminder\",\"reminder_type\":\"1_day\",\"doc_id\":19,\"document_type\":\"clearance\",\"appointment_date\":\"2026-09-02\",\"appointment_time\":\"09:00:00\",\"title\":\"\\ud83d\\udcc5 Pick-up Reminder Tomorrow (Sep 02, 2026)\",\"message\":\"Reminder: You have an appointment tomorrow (Sep 02, 2026) at 09:00 AM to pick up your Clearance. Please bring your Valid ID.\"}', NULL, '2026-09-01 09:40:37', '2026-09-01 09:40:37');

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
(1, 'MARVIN BENIS', 'Admin', 'Barangay Captain', 'officials/q1UAlh5GtAeonBoorDH3R0POkkuVwQBCTBP0QKSC.jpg', '2023-10-19', '2027-10-19', 1, '2026-03-25 22:40:43', '2026-04-19 06:31:06'),
(2, 'Teressa Calawin', 'VAWC', 'VAWC OFFICER', 'officials/CoAIAqfbxb7QFSolzoVv4TKudlFFhLIyxNle2743.png', '2023-10-23', '2027-10-23', 1, '2026-04-28 19:32:26', '2026-04-28 20:09:40'),
(3, 'Noel Amasa', 'Justice', 'Barangay Chief Justice', 'officials/UJn82rcItmqIJc2fZ8yrFOYcoxF1rXlIAkRMCTXB.png', '2023-10-25', '2023-10-25', 1, '2026-04-28 19:34:58', '2026-04-28 19:34:58');

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
-- Table structure for table `patrol_schedules`
--

CREATE TABLE `patrol_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'MONTHLY PATROLS SCHED',
  `team_name` varchar(255) DEFAULT NULL,
  `personnel_names` text DEFAULT NULL,
  `schedule_date` varchar(255) DEFAULT NULL,
  `patrol_time` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Scheduled',
  `image_path` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patrol_schedules`
--

INSERT INTO `patrol_schedules` (`id`, `title`, `team_name`, `personnel_names`, `schedule_date`, `patrol_time`, `status`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'MONTHLY PATROLS SCHED', 'Team A', 'Danilo Cruz, Ramon Santos, Ernesto Reyes', '2026-05-13', '10:00PM - 1:00AM', 'Completed', 'patrol_proofs/IrzjHNkeAQQCtckWKE7vr7uTtDYsumH6C9jh8zR0.png', '2026-05-04 07:38:06', '2026-05-04 07:38:27'),
(2, 'MONTHLY PATROLS SCHED', 'Team B', 'Eduardo Garcia, Rodrigo Ramos, Nestor Mendoza', '2026-05-21', '11:00PM - 12:00AM', 'Scheduled', NULL, '2026-05-04 07:44:07', '2026-05-04 07:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resident_id` bigint(20) UNSIGNED NOT NULL,
  `pet_name` varchar(255) DEFAULT NULL,
  `pet_photo` varchar(255) DEFAULT NULL,
  `photo_updated_at` timestamp NULL DEFAULT NULL,
  `pet_type` varchar(255) NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `months` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `vaccine_status` enum('Vaccinated','Unvaccinated','Partial') NOT NULL,
  `vaccine_proof_path` varchar(255) DEFAULT NULL,
  `last_vaccine_date` date DEFAULT NULL,
  `vaccine_proof` varchar(255) DEFAULT NULL,
  `vaccination_status` varchar(255) NOT NULL DEFAULT 'unvaccinated',
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('alive','deceased') NOT NULL DEFAULT 'alive',
  `is_archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `resident_id`, `pet_name`, `pet_photo`, `photo_updated_at`, `pet_type`, `breed`, `age`, `months`, `quantity`, `vaccine_status`, `vaccine_proof_path`, `last_vaccine_date`, `vaccine_proof`, `vaccination_status`, `rejection_reason`, `created_at`, `updated_at`, `status`, `is_archived`) VALUES
(5, 6, 'kiko', NULL, NULL, 'Fish', 'arowana', NULL, NULL, 1, 'Unvaccinated', NULL, NULL, NULL, 'unvaccinated', NULL, '2026-03-21 04:28:44', '2026-03-21 04:28:44', 'alive', 0),
(6, 8, 'chuchut', NULL, NULL, 'Dog', 'chihuahua', NULL, NULL, 1, 'Vaccinated', NULL, NULL, NULL, 'unvaccinated', NULL, '2026-04-02 03:15:10', '2026-04-02 03:15:10', 'alive', 0),
(7, 11, 'Mochi', NULL, NULL, 'Cat', 'Tilapia skin', NULL, NULL, 1, 'Vaccinated', NULL, NULL, NULL, 'unvaccinated', NULL, '2026-04-07 00:46:04', '2026-04-07 00:46:04', 'alive', 0),
(8, 7, 'katana', NULL, NULL, 'Cat', 'Tilapia skin', NULL, '5', 1, 'Unvaccinated', NULL, NULL, NULL, 'unvaccinated', NULL, '2026-04-07 01:23:36', '2026-04-07 01:23:36', 'alive', 0),
(9, 6, 'Kone', NULL, NULL, 'Cat', 'Ginger Cat', '4', '4', 1, 'Vaccinated', NULL, '2025-12-12', NULL, 'unvaccinated', NULL, '2026-04-11 23:14:05', '2026-04-11 23:14:05', 'alive', 0),
(10, 8, 'kalbo', NULL, NULL, 'Dog', 'chihuahua', '1', NULL, 1, 'Vaccinated', NULL, NULL, NULL, 'unvaccinated', NULL, '2026-04-21 16:29:18', '2026-04-21 16:29:18', 'alive', 0),
(28, 13, 'petite', 'pet_photos/uWS6BPeK3fGQj8r338QimAqoh3eRocRerjo3EU2e.jpg', NULL, 'Dog', 'hotdog', '1', '1', 1, 'Vaccinated', NULL, NULL, 'pet_vaccine_proofs/quXnEnxcuTUbONDjvHjm1ngHHgJZoKk5tl8gTmeH.jpg', 'verified', NULL, '2026-04-27 02:53:16', '2026-08-20 20:16:28', 'alive', 0),
(29, 2, 'phantom', 'pet_photos/SSW46vFQUOy8w04hMCzvI1Ogl6fhCJpM5yCSrkW9.jpg', NULL, 'Cat', 'bombay cat', '1', '6', 1, 'Vaccinated', NULL, NULL, 'pet_vaccine_proofs/CWtYWEqgD4BEUHSjODgJKGrb8tiXzojpFKSf1APQ.jpg', 'rejected', 'Wrong Photo Submitted (Not a Vaccination Card)', '2026-04-27 07:44:52', '2026-08-20 20:29:23', 'alive', 0),
(30, 1, 'pusa', NULL, NULL, 'Cat', 'orange', '1', '1', 1, 'Vaccinated', NULL, NULL, 'pet_vaccine_proofs/nYFWxLdpPRfYYNhAHhJLUHDLvWMLNCxh1KXS3ACy.jpg', 'pending', NULL, '2026-04-28 21:54:57', '2026-04-28 21:54:57', 'alive', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'General',
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `completion_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Planning',
  `budget` decimal(15,2) DEFAULT NULL,
  `contractor_lead` varchar(255) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `archived_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `precinct_no` varchar(255) DEFAULT NULL,
  `voter_status` varchar(255) DEFAULT NULL,
  `is_non_voter` tinyint(1) NOT NULL DEFAULT 0,
  `is_pwd` tinyint(1) NOT NULL DEFAULT 0,
  `is_senior` tinyint(1) NOT NULL DEFAULT 0,
  `is_single_parent` tinyint(1) NOT NULL DEFAULT 0,
  `is_student` tinyint(1) NOT NULL DEFAULT 0,
  `is_bedridden` tinyint(1) NOT NULL DEFAULT 0,
  `memberships` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`memberships`)),
  `address` varchar(255) NOT NULL,
  `is_household_head` tinyint(1) NOT NULL DEFAULT 0,
  `household_id` varchar(255) DEFAULT NULL,
  `household_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `archived_at` timestamp NULL DEFAULT NULL,
  `archive_reason` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `senior_proof` varchar(255) DEFAULT NULL,
  `pwd_proof` varchar(255) DEFAULT NULL,
  `bedridden_proof` varchar(255) DEFAULT NULL,
  `verification_status` varchar(255) NOT NULL DEFAULT 'approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `resident_code`, `user_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `birthday`, `birthplace`, `gender`, `civil_status`, `spouse_name`, `occupation`, `contact_number`, `photo`, `is_voter`, `precinct_no`, `voter_status`, `is_non_voter`, `is_pwd`, `is_senior`, `is_single_parent`, `is_student`, `is_bedridden`, `memberships`, `address`, `is_household_head`, `household_id`, `household_head_id`, `created_at`, `updated_at`, `archived_at`, `archive_reason`, `deleted_at`, `relationship`, `age`, `senior_proof`, `pwd_proof`, `bedridden_proof`, `verification_status`) VALUES
(1, 'RES-MEVJVMHE', 8, 'Antonio', 'Hiro', 'Reyes', NULL, '2003-03-28', 'Bahay', 'Male', 'Married', 'Shimiya Yoshida', NULL, '09327359733', 'profile_photos/9tQzalcBfDoz4byNOhqP6NghGssgffk2ijgBhJbp.jpg', 1, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'Blk 123 Lot 4 Subdivision', 0, NULL, 2, '2026-03-15 02:07:48', '2026-09-01 06:29:52', NULL, NULL, NULL, 'Husband', NULL, NULL, NULL, NULL, 'approved'),
(2, 'RES-J72D88ZN', 7, 'Patricia Angela', 'Siangco', 'David', NULL, '1990-03-20', 'Dasma, Cavite', 'Female', 'Married', NULL, NULL, '09765432152', 'residents/photos/vt7iLeDRtMdtUFua07T9mx9Jrn8s7axTJQC3iEdg.png', 0, NULL, NULL, 1, 0, 0, 0, 0, 0, NULL, 'Blk 143 Lot 9 Phase 4', 0, NULL, NULL, '2026-03-15 02:11:42', '2026-09-02 19:09:49', NULL, NULL, NULL, NULL, 36, NULL, NULL, NULL, 'approved'),
(3, 'RES-J3EKHHWG', 9, 'Anne', 'Salish', 'Smith', NULL, '2001-05-05', 'Hospital', 'Female', 'Single', NULL, NULL, '09567984316', NULL, 1, NULL, NULL, 0, 0, 0, 1, 0, 0, '\"[\\\"4Ps\\\",\\\"KDBM\\\"]\"', 'Blk 187 Lot 12 Phase 2', 0, NULL, NULL, '2026-03-15 02:29:43', '2026-03-25 19:03:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(4, 'RES-OUW38MAW', NULL, 'Orlando', 'Mimor', 'Marino', NULL, '1960-07-15', 'Reclamation', 'Male', 'Married', NULL, NULL, '09145223788', NULL, 0, NULL, NULL, 0, 0, 1, 0, 0, 0, NULL, 'Blk 136 Lot 15 Phase 3', 0, NULL, NULL, '2026-03-15 02:33:00', '2026-03-15 02:33:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(5, 'RES-TJDFTMXX', NULL, 'Millie', 'Jenner', 'Grande', NULL, '2011-02-14', 'Hospital', 'Female', 'Single', NULL, NULL, '09768645845', NULL, 0, NULL, NULL, 0, 1, 0, 0, 0, 0, NULL, 'Blk 187 Lot 12 Phase 2', 0, NULL, NULL, '2026-03-15 02:39:03', '2026-03-15 02:39:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(6, 'RES-BYDIW8OD', 10, 'Van Cornelius', 'Lobusta', 'Paragas', NULL, '2005-11-29', 'Dasmariñas, Cavite', 'Male', 'Married', 'Hannah Khaye Gonzaga', 'Chef/Baker', '09763444053', 'residents/photos/L6MbViinFSInkh98x8rl5ELyCoU9s2ZymPKQ5Mm4.jpg', 1, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'Blk 15 Lot A R5 Cityhomes Resortville', 0, NULL, NULL, '2026-03-20 07:35:05', '2026-03-21 08:41:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(7, 'RES-VPFQP9KG', 11, 'Rheamay', 'Rebay', 'Diongco', NULL, '2003-11-01', 'bahay', 'Female', 'Single', NULL, NULL, '09633951836', 'residents/photos/klgOBqKgGTLtdhJCviJELuhEonQTMitYmNAC5ysv.jpg', 1, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'phase 5 site', 0, NULL, NULL, '2026-03-23 23:09:02', '2026-04-07 00:31:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(8, 'RES-CKHHVBK9', NULL, 'Hannah', NULL, 'Gonzaga', NULL, '2026-03-26', 'bahay', 'Male', 'Single', NULL, NULL, '0999', NULL, 0, NULL, NULL, 1, 0, 0, 0, 0, 0, NULL, 'phase 5 site', 0, NULL, NULL, '2026-03-25 21:26:33', '2026-04-11 23:24:21', '2026-03-25 21:26:59', 'Archived by office staff', NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(9, 'RES-PUNSAQVO', 12, 'Joann', 'M', 'Manubis', NULL, '2026-03-28', 'bahay', 'Female', 'Married', 'lods', NULL, '091233333333', NULL, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'manubis store', 0, NULL, NULL, '2026-03-27 06:10:34', '2026-03-27 06:11:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(10, 'RES-TM7YIOX4', 13, 'Jayson', NULL, 'Rivera', NULL, '2001-03-27', 'dasma', 'Male', 'Married', 'gf nya', NULL, '0999999999999', NULL, 0, NULL, NULL, 1, 0, 0, 0, 1, 0, NULL, 'san mig 2', 0, NULL, NULL, '2026-03-27 06:12:36', '2026-04-11 23:23:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(11, 'RES-1UWOOHWJ', NULL, 'Lloyd', 'P', 'Tejano', NULL, '2004-06-16', 'dasma', 'Male', 'Single', NULL, NULL, '09786564646', NULL, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'area 1', 0, NULL, NULL, '2026-03-27 06:14:17', '2026-03-27 06:14:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(12, 'RES-OA8GVLDA', 16, 'Jennie', 'Kim', 'Manoban', NULL, '1995-04-30', 'mabuhay', 'Female', 'Single', NULL, 'Artist', '09878656346', NULL, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'Mabuhay City', 0, NULL, NULL, '2026-04-09 04:13:17', '2026-04-09 04:21:24', NULL, NULL, NULL, NULL, 30, NULL, NULL, NULL, 'approved'),
(13, 'RES-H3VOTEGN', 17, 'prince', 'revilloza', 'dela cruz', NULL, '2004-12-24', 'Dasma, Cavite', 'Male', 'Single', NULL, 'jnt', '09660136815', NULL, 0, NULL, 'declined', 1, 0, 0, 0, 0, 0, NULL, 'blk 90 lot 3 brgy san juan', 1, NULL, NULL, '2026-04-26 22:37:37', '2026-04-27 16:08:17', NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, 'approved'),
(14, 'RES-LFU44K2B', NULL, 'shany rein', 'revilloza', 'dela cruz', NULL, '2003-09-16', 'Dasma, Cavite', 'Female', 'Single', NULL, NULL, '09566123412', NULL, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, '\"[\\\"third generation\\\"]\"', 'blk 90 lot 3 brgy san juan', 0, NULL, 13, '2026-04-26 22:41:07', '2026-04-26 22:55:26', NULL, NULL, NULL, 'Sibling', 22, NULL, NULL, NULL, 'approved'),
(15, 'RES-HXJBF4BR', NULL, 'shany rein', 'revilloza', 'dela cruz', NULL, '2003-09-16', 'Dasma, Cavite', 'Female', 'Single', NULL, NULL, '09566123412', NULL, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, '\"[\\\"third generation\\\"]\"', 'blk 90 lot 3 brgy san juan', 0, NULL, NULL, '2026-04-26 22:41:08', '2026-04-27 04:27:52', '2026-04-27 04:27:52', 'Archived by office staff', NULL, NULL, 22, NULL, NULL, NULL, 'approved'),
(16, 'RES-JFLMQY64', NULL, 'Wella', NULL, 'Gaspacho', NULL, '1995-08-31', 'Dasma', 'Female', 'Married', 'Kenneth Torres', 'Teacher', '09090909090', 'residents/photos/uoa3QJseEPTGjC6fafQqlzUcuNmeK6BXVpfTFc6H.jpg', 1, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'Site', 0, NULL, NULL, '2026-04-27 07:47:27', '2026-04-27 07:47:27', NULL, NULL, NULL, NULL, 30, NULL, NULL, NULL, 'approved');

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
('IYYzIm2oe55q2DC1WU8mHMfmfxIh7Yww8bdWefIJ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS3lMeHNnVGI0M2dKRTltTDNOZTFJbjlqSVFnMTFSc3NUTzcwMXhhYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZpY2UiO3M6NToicm91dGUiO3M6MTI6Im9mZmljZS5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1787288626);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'organizational_chart', 'settings/ChoRiQ6j0mBN9od237OcFbQcXSMLwUCvGTqZUvSS.jpg', '2026-04-23 22:22:00', '2026-04-23 22:22:00'),
(2, 'carousel_data', '[]', '2026-04-25 06:39:53', '2026-04-25 06:39:53');

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
  `photo_updated_at` timestamp NULL DEFAULT NULL,
  `resident_code` varchar(255) DEFAULT NULL,
  `is_voter` tinyint(1) NOT NULL DEFAULT 0,
  `precinct_no` varchar(255) DEFAULT NULL,
  `voter_id_photo` varchar(255) DEFAULT NULL,
  `voter_status` varchar(255) DEFAULT NULL,
  `decline_reason` text DEFAULT NULL,
  `is_non_voter` tinyint(1) NOT NULL DEFAULT 0,
  `is_senior` tinyint(1) NOT NULL DEFAULT 0,
  `is_pwd` tinyint(1) NOT NULL DEFAULT 0,
  `is_single_parent` tinyint(1) NOT NULL DEFAULT 0,
  `is_student` tinyint(1) NOT NULL DEFAULT 0,
  `is_bedridden` tinyint(1) NOT NULL DEFAULT 0,
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
  `password_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`password_history`)),
  `otp` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `middle_name`, `last_name`, `contact_number`, `birthday`, `birthplace`, `gender`, `civil_status`, `spouse_name`, `address`, `occupation`, `photo`, `photo_updated_at`, `resident_code`, `is_voter`, `precinct_no`, `voter_id_photo`, `voter_status`, `decline_reason`, `is_non_voter`, `is_senior`, `is_pwd`, `is_single_parent`, `is_student`, `is_bedridden`, `email`, `role`, `status`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `security_question`, `security_answer`, `password_history`, `otp`, `otp_expires_at`) VALUES
(1, 'Office Staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'office@brgysm2.com', 'office', 'active', 1, NULL, '$2y$12$4CfzhgO0E3CSR7DHR6zZQOzIyTH7pTcmcLd2HEtwfdos3Ndmn74K.', NULL, '2026-03-14 22:03:27', '2026-09-07 22:29:15', 'What is the name of our Barangay?', 'San Miguel II', NULL, NULL, NULL),
(2, 'Justice Officer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'justice@brgysm2.com', 'justice', 'active', 1, NULL, '$2y$12$eGvFsGb9i1L/7gil4ceSJOIWrxyXFpfUd0RRAGPQY0jbGzOENx95C', NULL, '2026-03-14 22:03:28', '2026-03-30 21:51:43', 'What is the name of our Barangay?', 'San Miguel II', NULL, NULL, NULL),
(3, 'VAWC Staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'vawc@brgysm2.com', 'vawc', 'active', 1, NULL, '$2y$12$.sDQ9CD6poWWKlfEBXkO0.6281mKWGrl880lGvDiOPwOJWfY71.QW', NULL, '2026-03-14 22:03:28', '2026-03-30 21:51:43', 'What is the name of our Barangay?', 'San Miguel II', NULL, NULL, NULL),
(4, 'Peace Staff', NULL, NULL, NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'peace@brgysm2.com', 'peace', 'active', 1, NULL, '$2y$12$EsDU5OUydFiA7LeHqS4jpewaQp.PwT8nGWKLhvVJspS7cQ2AVN.L.', 'nMLiGneFOQNOkUdGQhDtBaNXYvdgf5L8n0z4jsFkpGd21Uz5n9yFuce4PqF6', '2026-03-14 22:03:29', '2026-09-01 06:38:29', 'What is the name of our Barangay?', 'San Miguel II', NULL, NULL, NULL),
(5, 'Juan Dela Cruz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'declined', 'not in the masterlist', 1, 0, 0, 0, 0, 0, 'juan@brgysm2.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', NULL, '2026-03-14 22:03:29', '2026-09-08 00:04:51', NULL, NULL, NULL, NULL, NULL),
(6, 'Admin User', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'admin@brgysm2.com', 'admin', 'active', 1, NULL, '$2y$12$Kt.HGysFCET/6hNaOgkMfOOH/V.f8P4znZP7.anROgIEMiv4dVO/S', NULL, '2026-03-14 22:03:30', '2026-03-30 21:51:43', 'What is the name of our Barangay?', 'San Miguel II', NULL, NULL, NULL),
(7, 'Maria Clara Dizon', 'Patricia Angela', 'Siangco', 'David', '09765432152', '1990-03-20', 'Dasma, Cavite', 'Female', 'Married', NULL, 'Blk 143 Lot 9 Phase 4', NULL, 'residents/photos/vt7iLeDRtMdtUFua07T9mx9Jrn8s7axTJQC3iEdg.png', NULL, 'RES-J72D88ZN', 0, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'hannahgonzaga01@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', 'HnURYL1kcayw8cRrIpPaGbsL2dLptLvnSokwQmAtCEXXHWX3FHxiJx7MjUa2', '2026-03-15 02:40:46', '2026-09-08 00:04:51', NULL, NULL, '[\"$2y$12$Ye7dYMUEnhel08H.BLrtWu00EEkTOtyQOzUkyJs1aOzK.mMIpI6gi\",\"$2y$12$RbMY9\\/EQtFtZNbSWYF2wx.nKvYigv2\\/28KIIh6ik4goMfDmyp.\\/3S\",\"$2y$12$vRrb\\/.vZnPp3vTf40kldXuFUo2ZM6y0kzZYUo8Qqv4V1z.3i5KXZi\"]', '141262', '2026-05-14 21:57:20'),
(8, 'Antonio Reyes', 'Antonio', 'Hiro', 'Reyes', '09327359733', '2003-03-28', 'Bahay', 'Male', 'Married', 'Shimiya Yoshida', 'Blk 123 Lot 4 Subdivision', NULL, 'profile_photos/9tQzalcBfDoz4byNOhqP6NghGssgffk2ijgBhJbp.jpg', '2026-05-14 20:47:37', 'RES-MEVJVMHE', 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'gonzaga.hannahkhayera.kld@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', NULL, '2026-03-19 00:15:04', '2026-09-08 00:04:51', NULL, NULL, NULL, NULL, NULL),
(9, 'Anne Smith', 'Anne', 'Salish', 'Smith', '09567984316', '2001-05-05', 'Hospital', 'Female', 'Single', NULL, 'Blk 187 Lot 12 Phase 2', NULL, NULL, NULL, 'RES-J3EKHHWG', 1, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 0, 'gonzagahkr@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', 'bkKy3QnYG89usQtwAWh5kUzcIj8cgIk54ducDrR59COCsLnI3rcME5yBSTjQ', '2026-03-19 01:24:12', '2026-09-08 00:04:51', NULL, NULL, '[\"$2y$12$fDyRm\\/.rCvs\\/tnDvKIaOXuHg3nD3yS\\/xz0SKfRhU4LTy44tuxHt9y\",\"$2y$12$kD9NXY9mRlJl9Ul.m7D.cuqlu7LA3reb1Wo\\/G7CQV.KUcdPy8YyJm\"]', NULL, NULL),
(10, 'Van Cornelius Paragas', 'Van Cornelius', 'Lobusta', 'Paragas', '09763444053', '2005-11-29', 'Dasmariñas, Cavite', 'Male', 'Married', 'Hannah Khaye Gonzaga', 'Blk 15 Lot A R5 Cityhomes Resortville', 'Chef/Baker', 'residents/photos/L6MbViinFSInkh98x8rl5ELyCoU9s2ZymPKQ5Mm4.jpg', NULL, 'RES-BYDIW8OD', 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'vclparagas@kld.edu.ph', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', NULL, '2026-03-20 07:36:44', '2026-09-08 00:04:51', NULL, NULL, NULL, NULL, NULL),
(11, 'Rheamay Diongco', 'Rheamay', 'Rebay', 'Diongco', '09633951836', '2003-11-01', 'bahay', 'Female', 'Single', NULL, 'phase 5 site', NULL, 'residents/photos/klgOBqKgGTLtdhJCviJELuhEonQTMitYmNAC5ysv.jpg', NULL, 'RES-VPFQP9KG', 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'rrdiongco@kld.edu.ph', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', 'NiZ5a5RVu0kitFPtfieSTBTGNNxpU8A8aJ0ehfmP9WpcXQPCWIwRo8uU68Ut', '2026-03-23 23:09:54', '2026-09-08 00:04:51', NULL, NULL, '[\"$2y$12$4TnPtxClgVdi99wY.txIU.VNHDBeSkuPL3Lad5m32AdjlHlU4M3\\/a\"]', NULL, NULL),
(12, 'Joann M Manubis', 'Joann', 'M', 'Manubis', '091233333333', '2026-03-28', 'bahay', 'Female', 'Married', 'lods', 'manubis store', NULL, NULL, NULL, 'RES-PUNSAQVO', 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'jowanamanubis@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', 'tDAA93El2Pfo5yeI6HMetd8lBlEHSHczWCsFGdlxXx41765vodzhjWDNtS67', '2026-03-27 06:11:37', '2026-09-08 00:04:51', NULL, NULL, NULL, NULL, NULL),
(13, 'Jayson rivera', 'Jayson', NULL, 'Rivera', '0999999999999', '2001-03-27', 'dasma', 'Male', 'Married', 'gf nya', 'san mig 2', NULL, NULL, NULL, 'RES-TM7YIOX4', 0, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 1, 0, 'riverajayson2002@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', NULL, '2026-03-27 06:16:33', '2026-09-08 00:04:51', NULL, NULL, NULL, NULL, NULL),
(14, 'mamiyu meme minime', 'mamiyu', 'meme', 'minime', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'mimiyu299@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', 'ZuLee5lVtOyXUim9A7QbIOyRX96lj5XbDG7bpR5ATGlDXOg5eOvGtuhNvKLa', '2026-04-01 04:47:48', '2026-09-08 00:04:51', NULL, NULL, '[\"$2y$12$wnraIx9eqR42jzNZqpoupuyBUNdXuueptp.TCmIprZA86vTPyj952\",\"$2y$12$VTdk4OYoDAfv3swfKDYUGewEu1gMS3UL72Auj\\/N1Iu6DBK3gH8gqG\"]', NULL, NULL),
(15, 'Nosi Sino Balasi', 'Nosi', 'Sino', 'Balasi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'declined', 'No Id uploaded', 1, 0, 0, 0, 0, 0, 'hkrgonzaga@kld.edu.ph', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', 'el2CTOeT0shfxdaIV0uFF3bxDhRC5yKB7L1Av3duhfrMf9YC0DLcFzIq5uuA', '2026-04-02 04:03:56', '2026-09-08 00:04:51', NULL, NULL, '[\"$2y$12$AEkd67PquEjLOS11gzZrm.EfdRaKlM2OKU49uxj5Xinyu1T\\/h3H7S\",\"$2y$12$X5sP3sXG8\\/hY.4EkXLdU\\/.LRMjjNLN\\/kZigjudXWt8ZpMud0SYXk.\",\"$2y$12$9cu.mB2kFdnWaUXIoaeyHe00hhDgJHyfieWPsj1JzamUO9A7TWcdO\"]', NULL, NULL),
(16, 'Jennie Kim Manoban', 'Jennie', 'Kim', 'Manoban', '09878656346', '1995-04-30', 'mabuhay', 'Female', 'Single', NULL, 'Mabuhay City', 'Artist', NULL, NULL, 'RES-OA8GVLDA', 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'vclparagas@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', NULL, '2026-04-09 04:19:00', '2026-09-08 00:04:51', NULL, NULL, '[\"$2y$12$H4qL1mBUHhm7xunlEDUJ0.dY2FIJt81cQPDk9EIbFcTe9OxcGAqAO\"]', NULL, NULL),
(17, 'prince revilloza dela cruz', 'prince', 'revilloza', 'dela cruz', '09660136815', '2004-12-24', 'Dasma, Cavite', 'Male', 'Single', NULL, 'blk 90 lot 3 brgy san juan', 'jnt', NULL, NULL, 'RES-H3VOTEGN', 0, NULL, 'voter_ids/h3SObBejkKrnqkGNSLz9faeUe6sat3msO1nDVGI5.jpg', 'declined', 'Your submitted valid ID isn\'t valid please to resubmit a VALID ID.', 1, 0, 0, 0, 0, 0, 'princedel0123@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', NULL, '2026-04-26 22:52:10', '2026-09-08 00:04:51', NULL, NULL, '[\"$2y$12$8zRIETQjn7qjtxuoRBx9XOhILbbymEOYxvBJI8LVTDzpZ3MkKSCU2\"]', NULL, NULL),
(18, 'Juan Dela Cruz', 'Juan', NULL, 'Dela Cruz', NULL, '2000-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'declined', 'not in the masterlist', 1, 0, 0, 0, 0, 0, 'juan@gmail.com', 'resident', 'active', 1, NULL, '$2y$12$bGUcDphIo1.O2Y1Exk.SueA8QEk7mBVLwlulXGTsfSpABN95aF6Bu', NULL, '2026-04-27 15:55:27', '2026-09-08 00:04:51', NULL, NULL, '[\"$2y$12$m2sVJwKaPwJvbRIG54Wwu.N5n7BY1Hf4AW23WvUtHj2psfgNaAs82\"]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vawc_audit_logs`
--

CREATE TABLE `vawc_audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `staff_name` varchar(255) NOT NULL DEFAULT 'System Officer',
  `staff_role` varchar(255) DEFAULT 'VAWC Officer',
  `action` varchar(255) NOT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `case_code` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vawc_audit_logs`
--

INSERT INTO `vawc_audit_logs` (`id`, `user_id`, `staff_name`, `staff_role`, `action`, `case_id`, `case_code`, `details`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 3, 'VAWC Staff', 'vawc', 'status_update', 9, 'VAWC-2026-009', 'Status changed from \'under_review\' to \'pending\'.', '127.0.0.1', '2026-09-02 19:19:28', '2026-09-02 19:19:28'),
(2, 3, 'VAWC Staff', 'vawc', 'status_update', 9, 'VAWC-2026-009', 'Status changed from \'pending\' to \'under_review\'.', '127.0.0.1', '2026-09-02 19:43:52', '2026-09-02 19:43:52');

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
-- Indexes for table `department_reports`
--
ALTER TABLE `department_reports`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `emergency_sos_alerts`
--
ALTER TABLE `emergency_sos_alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emergency_sos_alerts_user_id_foreign` (`user_id`);

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
-- Indexes for table `patrol_schedules`
--
ALTER TABLE `patrol_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pets_resident_id_foreign` (`resident_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `residents_resident_code_unique` (`resident_code`),
  ADD KEY `residents_user_id_foreign` (`user_id`),
  ADD KEY `residents_household_head_id_foreign` (`household_head_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vawc_audit_logs`
--
ALTER TABLE `vawc_audit_logs`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blotter_reports`
--
ALTER TABLE `blotter_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_reports`
--
ALTER TABLE `department_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `emergency_sos_alerts`
--
ALTER TABLE `emergency_sos_alerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_reports`
--
ALTER TABLE `issue_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patrol_schedules`
--
ALTER TABLE `patrol_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `vawc_audit_logs`
--
ALTER TABLE `vawc_audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `emergency_sos_alerts`
--
ALTER TABLE `emergency_sos_alerts`
  ADD CONSTRAINT `emergency_sos_alerts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `vawc_cases`
--
ALTER TABLE `vawc_cases`
  ADD CONSTRAINT `vawc_cases_handled_by_foreign` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
