-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 10:57 PM
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
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `father_name` varchar(512) DEFAULT NULL,
  `phone` varchar(512) DEFAULT NULL,
  `batch` varchar(512) DEFAULT NULL,
  `discipline` varchar(512) DEFAULT NULL,
  `picture_path` longtext DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_semester`
--

CREATE TABLE `student_semester` (
  `id` int(11) NOT NULL,
  `semester_number` varchar(512) DEFAULT NULL,
  `student_id` varchar(512) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
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
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_semester`
--
ALTER TABLE `student_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
