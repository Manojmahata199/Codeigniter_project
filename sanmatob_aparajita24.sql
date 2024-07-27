-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 11:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanmatob_aparajita24`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mail`, `phone`, `password`, `create_at`) VALUES
(1, 'Manoj Mahata', 'manojmahata.mid@gmail.com', '8637583151', 'admin@192', '0000-00-00 00:00:00.000000'),
(2, 'San', 'events@sanmarg.in', '9830829900', 'San@123', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `aparajita_detail`
--

CREATE TABLE `aparajita_detail` (
  `id` int(11) NOT NULL,
  `reg_id` varchar(50) NOT NULL,
  `unique_id` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `you_shine` varchar(255) DEFAULT NULL,
  `shine_five` text DEFAULT NULL,
  `shine_fifteen` text DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `current_profile` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `is_incorporated` varchar(255) DEFAULT NULL,
  `specified_org_type` varchar(50) DEFAULT NULL,
  `company_incorporation_date` datetime(6) DEFAULT NULL,
  `year_experience` int(11) DEFAULT NULL,
  `digital_presence` varchar(255) DEFAULT NULL,
  `digital_presence_instagram` varchar(255) DEFAULT NULL,
  `digital_presence_twitter` varchar(255) DEFAULT NULL,
  `digital_presence_facebook` varchar(255) DEFAULT NULL,
  `digital_presence_linkedin` varchar(255) DEFAULT NULL,
  `org_address` varchar(255) DEFAULT NULL,
  `org_city` varchar(255) DEFAULT NULL,
  `org_state` varchar(255) DEFAULT NULL,
  `org_pin` varchar(11) DEFAULT NULL,
  `org_email` varchar(100) DEFAULT NULL,
  `org_contactno` varchar(255) DEFAULT NULL,
  `org_website` varchar(255) DEFAULT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `school_city` varchar(100) DEFAULT NULL,
  `school_programme` varchar(100) DEFAULT NULL,
  `school_certificate` varchar(100) DEFAULT NULL,
  `another_institute` int(10) NOT NULL DEFAULT 0,
  `college_name` varchar(100) DEFAULT NULL,
  `college_city` varchar(100) DEFAULT NULL,
  `college_programme` varchar(100) DEFAULT NULL,
  `college_certificate` varchar(100) DEFAULT NULL,
  `third_institute` int(10) DEFAULT 0,
  `third_institute_name` varchar(100) DEFAULT NULL,
  `third_institute_city` varchar(50) DEFAULT NULL,
  `third_institute_programe` varchar(100) DEFAULT NULL,
  `third_institute_certificate` varchar(100) DEFAULT NULL,
  `applicant_name` varchar(255) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `social_media` varchar(255) DEFAULT NULL,
  `linkedin_profile` varchar(255) DEFAULT NULL,
  `alternate_contact_name` varchar(50) DEFAULT NULL,
  `alternate_contact` varchar(50) DEFAULT NULL,
  `alternate_contact_relationship` varchar(50) DEFAULT NULL,
  `specify_reltion` varchar(50) DEFAULT NULL,
  `your_role` text DEFAULT NULL,
  `bio_video` varchar(255) DEFAULT NULL,
  `past_organization_name1` varchar(255) DEFAULT NULL,
  `past_experience1` varchar(255) DEFAULT NULL,
  `past_organization_name2` varchar(200) DEFAULT NULL,
  `past_experience2` varchar(50) DEFAULT NULL,
  `past_organization_name3` varchar(200) DEFAULT NULL,
  `past_experience3` varchar(50) DEFAULT NULL,
  `your_thoughts` text DEFAULT NULL,
  `womans_crown` text DEFAULT NULL,
  `social_org` varchar(50) DEFAULT NULL,
  `cause_furthers` varchar(50) DEFAULT NULL,
  `org_contact` varchar(50) DEFAULT NULL,
  `social_other` varchar(50) DEFAULT NULL,
  `how_aparajita` text DEFAULT NULL,
  `support_entry` text DEFAULT NULL,
  `summarizing_work` text DEFAULT NULL,
  `awards_recognition` text DEFAULT NULL,
  `company_incorporation_certificate` text DEFAULT NULL,
  `letter_from_organization` text DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `is_active` enum('Y','N','D') NOT NULL DEFAULT 'Y',
  `declaration` varchar(50) NOT NULL DEFAULT '0',
  `terms` varchar(50) NOT NULL DEFAULT '0',
  `step1` tinyint(1) NOT NULL DEFAULT 0,
  `step2` tinyint(1) NOT NULL DEFAULT 0,
  `step3` tinyint(1) NOT NULL DEFAULT 0,
  `step4` tinyint(1) NOT NULL DEFAULT 0,
  `step5` tinyint(1) NOT NULL DEFAULT 0,
  `step6` tinyint(1) NOT NULL DEFAULT 0,
  `step7` tinyint(1) NOT NULL DEFAULT 0,
  `step8` tinyint(1) NOT NULL DEFAULT 0,
  `mail_count` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aparajita_detail`
--
ALTER TABLE `aparajita_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aparajita_detail`
--
ALTER TABLE `aparajita_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
