-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 10:35 PM
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
-- Database: `school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE `discipline` (
  `id` int(11) NOT NULL,
  `discipline_name` varchar(512) DEFAULT NULL,
  `branch` varchar(512) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL,
  `system_type` varchar(64) DEFAULT NULL,
  `num_of_semesters` int(11) DEFAULT NULL,
  `num_of_years` int(11) DEFAULT NULL,
  `status` varchar(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`id`, `discipline_name`, `branch`, `program`, `system_type`, `num_of_semesters`, `num_of_years`, `status`) VALUES
(1, 'Radiology', 'nihms', 'BS', 'semester', 8, NULL, '1'),
(2, 'Anesthesia', 'nihms', 'BS', 'semester', 8, NULL, '1'),
(3, 'Surgical', 'nihms', 'BS', 'semester', 8, NULL, '1'),
(4, 'Dental', 'nihms', 'BS', 'semester', 8, NULL, '1'),
(5, 'Pathology', 'nihms', 'BS', 'semester', 8, NULL, '1'),
(6, 'Health', 'nihms', 'BS', 'semester', 8, NULL, '1'),
(7, 'Nursing', 'ncn', 'BS', 'semester', 8, NULL, '1'),
(8, 'Post RN', 'ncn', 'BS', 'semester', 4, NULL, '1'),
(9, 'Health', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(10, 'Dental', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(11, 'Pathology', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(12, 'Radiology', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(13, 'Pharmacy', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(14, 'Physiotherapy', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(15, 'Dialysis', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(16, 'Anesthesia', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(17, 'Cardiology', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(18, 'Surgical', 'nihms', 'Diploma', 'semester', 4, NULL, '1'),
(19, 'LHV Diploma', 'ncn', 'Diploma', 'annual', NULL, 2, '1'),
(20, 'CAT-B', 'nihms', NULL, 'annual', NULL, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `head_of_accounts`
--

CREATE TABLE `head_of_accounts` (
  `id` int(11) NOT NULL,
  `account_name` varchar(512) DEFAULT NULL,
  `category` varchar(512) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `status` varchar(11) DEFAULT '1',
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `head_of_accounts`
--

INSERT INTO `head_of_accounts` (`id`, `account_name`, `category`, `amount`, `status`, `created_on`) VALUES
(1, 'Admission Fee', '1', NULL, '1', '2023-03-10 02:03:46'),
(2, 'Hostel Fee', '1', NULL, '1', '2023-03-10 02:03:46'),
(3, 'Hostel Security Fee', '1', NULL, '1', '2023-03-10 02:03:46'),
(4, 'Prospectus Fee', '1', NULL, '1', '2023-03-10 02:03:46'),
(5, 'Stamp Paper Fee', '1', NULL, '1', '2023-03-10 02:03:46'),
(6, 'Tution Fee', '1', NULL, '1', '2023-03-10 02:03:46'),
(7, 'Transport Fee', '1', NULL, '1', '2023-03-10 02:03:46'),
(8, 'Clinical Training Fee (BS)', '2', NULL, '1', '2023-03-10 02:03:46'),
(9, 'Degree Fee', '2', NULL, '1', '2023-03-10 02:03:46'),
(10, 'Exam Fee (BS)', '2', NULL, '1', '2023-03-10 02:03:46'),
(11, 'Registration Fee (BS)', '2', NULL, '1', '2023-03-10 02:03:46'),
(12, 'Retention Fee', '2', NULL, '1', '2023-03-10 02:03:46'),
(13, 'Transcript Fee (BS)', '2', NULL, '1', '2023-03-10 02:03:46'),
(14, 'Clinical Training Fee (Diploma)', '3', NULL, '1', '2023-03-10 02:03:46'),
(15, 'Diploma Fee', '3', NULL, '1', '2023-03-10 02:03:46'),
(16, 'Exam Fee (Diploma)', '3', NULL, '1', '2023-03-10 02:03:46'),
(17, 'Grace Marks Fee', '3', NULL, '1', '2023-03-10 02:03:46'),
(18, 'Registration Fee (Diploma)', '3', NULL, '1', '2023-03-10 02:03:46'),
(19, 'UFM Fee', '3', NULL, '1', '2023-03-10 02:03:46'),
(20, 'Exam Fee (CAT-B)', '4', NULL, '1', '2023-03-10 02:03:46'),
(21, 'Registration Fee (CAT-B)', '4', NULL, '1', '2023-03-10 02:03:46'),
(22, 'LHV Registration Fee', '5', NULL, '1', '2023-03-10 02:03:46'),
(23, 'PNC Registration Fee', '5', NULL, '1', '2023-03-10 02:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_category`
--

CREATE TABLE `hoa_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(512) DEFAULT NULL,
  `status` varchar(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoa_category`
--

INSERT INTO `hoa_category` (`id`, `category_name`, `status`) VALUES
(1, 'General', '1'),
(2, 'BS Degree', '1'),
(3, 'Diploma', '1'),
(4, 'CAT-B', '1'),
(5, 'Nursing', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_name` varchar(512) DEFAULT NULL,
  `father_name` varchar(512) DEFAULT NULL,
  `phone` varchar(512) DEFAULT NULL,
  `batch` varchar(512) DEFAULT NULL,
  `discipline` varchar(512) DEFAULT NULL,
  `picture_path` longtext DEFAULT NULL,
  `status` varchar(11) DEFAULT '1',
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_name`, `father_name`, `phone`, `batch`, `discipline`, `picture_path`, `status`, `created_on`) VALUES
(1, 'student1', 'fat1', '123456', '2022', '1', 'assets/images/profile_photo/2023_03_08_03_44_16.jpg', '1', '2023-03-08 03:42:14'),
(2, 'test', 'erwr', '(220)200-5', '13213', '1', 'assets/images/profile_photo/2023_03_08_03_44_16.jpg', '1', '2023-03-08 03:44:16'),
(3, 'sadasd', 'sadasd', '98310230', '2022', '16', 'assets/images/profile_photo/2023_03_08_03_44_16.jpg', '1', '2023-03-08 03:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `student_semester`
--

CREATE TABLE `student_semester` (
  `id` int(11) NOT NULL,
  `semester_number` varchar(512) DEFAULT NULL,
  `student_id` varchar(512) DEFAULT NULL,
  `status` varchar(11) DEFAULT '1',
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_semester`
--

INSERT INTO `student_semester` (`id`, `semester_number`, `student_id`, `status`, `created_on`) VALUES
(1, '1', '1', '1', '2023-03-08 03:42:14'),
(2, '8', '2', '1', '2023-03-08 03:44:16'),
(3, '7', '3', '1', '2023-03-08 03:46:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `head_of_accounts`
--
ALTER TABLE `head_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_category`
--
ALTER TABLE `hoa_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_semester`
--
ALTER TABLE `student_semester`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `head_of_accounts`
--
ALTER TABLE `head_of_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `hoa_category`
--
ALTER TABLE `hoa_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_semester`
--
ALTER TABLE `student_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
