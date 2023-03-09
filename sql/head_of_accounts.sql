-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 10:14 PM
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
(1, 'Admission Fee', 'General', NULL, '1', '2023-03-10 02:03:46'),
(2, 'Hostel Fee', 'General', NULL, '1', '2023-03-10 02:03:46'),
(3, 'Hostel Security Fee', 'General', NULL, '1', '2023-03-10 02:03:46'),
(4, 'Prospectus Fee', 'General', NULL, '1', '2023-03-10 02:03:46'),
(5, 'Stamp Paper Fee', 'General', NULL, '1', '2023-03-10 02:03:46'),
(6, 'Tuition Fee', 'General', NULL, '1', '2023-03-10 02:03:46'),
(7, 'Transport Fee', 'General', NULL, '1', '2023-03-10 02:03:46'),
(8, 'Clinical Training Fee (BS)', 'BS Degree', NULL, '1', '2023-03-10 02:03:46'),
(9, 'Degree Fee', 'BS Degree', NULL, '1', '2023-03-10 02:03:46'),
(10, 'Exam Fee (BS)', 'BS Degree', NULL, '1', '2023-03-10 02:03:46'),
(11, 'Registration Fee (BS)', 'BS Degree', NULL, '1', '2023-03-10 02:03:46'),
(12, 'Retention Fee', 'BS Degree', NULL, '1', '2023-03-10 02:03:46'),
(13, 'Transcript Fee (BS)', 'BS Degree', NULL, '1', '2023-03-10 02:03:46'),
(14, 'Clinical Training Fee (Diploma)', 'Diploma\r\n', NULL, '1', '2023-03-10 02:03:46'),
(15, 'Diploma Fee', 'Diploma\r\n', NULL, '1', '2023-03-10 02:03:46'),
(16, 'Exam Fee (Diploma)', 'Diploma\r\n', NULL, '1', '2023-03-10 02:03:46'),
(17, 'Grace Marks Fee', 'Diploma\r\n', NULL, '1', '2023-03-10 02:03:46'),
(18, 'Registration Fee (Diploma)', 'Diploma\r\n', NULL, '1', '2023-03-10 02:03:46'),
(19, 'UFM Fee', 'Diploma\r\n', NULL, '1', '2023-03-10 02:03:46'),
(20, 'Exam Fee (CAT-B)', 'CAT-B', NULL, '1', '2023-03-10 02:03:46'),
(21, 'Registration Fee (CAT-B)', 'CAT-B', NULL, '1', '2023-03-10 02:03:46'),
(22, 'LHV Registration Fee', 'Nursing', NULL, '1', '2023-03-10 02:03:46'),
(23, 'PNC Registration Fee', 'Nursing', NULL, '1', '2023-03-10 02:03:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `head_of_accounts`
--
ALTER TABLE `head_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `head_of_accounts`
--
ALTER TABLE `head_of_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
