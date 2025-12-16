-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 01, 2025 at 07:59 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secondary_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(50) NOT NULL,
  `student_id` int(50) NOT NULL,
  `counselor_id` int(50) DEFAULT NULL,
  `fixer_id` int(50) DEFAULT NULL,
  `appointment_date` datetime NOT NULL,
  `appointment_status` enum('Pending','Confirmed','Completed','Cancelled') DEFAULT 'Pending',
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `student_id`, `counselor_id`, `fixer_id`, `appointment_date`, `appointment_status`, `notes`, `created_at`, `updated_at`) VALUES
(2, 3, 2, 2, '2025-11-20 06:45:00', 'Pending', 'Make better grades in maths', '2025-11-29 14:45:55', '2025-11-30 14:20:58'),
(3, 3, 5, 5, '2025-11-19 07:19:00', 'Completed', 'We you are headed in life', '2025-11-29 16:25:34', '2025-11-30 15:06:05'),
(5, 3, 4, 4, '2025-11-27 23:41:00', 'Cancelled', 'conquer, rule your world', '2025-11-29 19:41:28', '2025-11-30 14:21:18'),
(6, 3, 4, 4, '2025-12-01 16:50:00', 'Confirmed', 'make me great in life', '2025-11-30 13:51:23', '2025-11-30 16:08:14'),
(7, 3, 5, 5, '2025-11-12 15:52:00', 'Completed', 'let\'s meet', '2025-11-30 14:53:07', '2025-11-30 19:32:44'),
(8, 3, 5, NULL, '2025-11-30 19:20:00', 'Completed', 'come here now', '2025-11-30 16:19:11', '2025-11-30 19:32:37'),
(9, 3, 5, 5, '2025-11-30 19:46:00', 'Completed', 'Come Here Now', '2025-11-30 16:21:38', '2025-11-30 19:43:57'),
(10, 3, 5, 5, '2025-12-19 08:55:00', 'Cancelled', 'new appointment confirmed', '2025-12-01 15:51:08', '2025-12-01 15:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `counselor`
--

CREATE TABLE `counselor` (
  `id` int(50) NOT NULL,
  `userid` varchar(200) NOT NULL,
  `dfname` varchar(255) NOT NULL,
  `duname` varchar(255) NOT NULL,
  `demail` varchar(255) NOT NULL,
  `dphone` varchar(20) NOT NULL,
  `daddress` varchar(255) DEFAULT NULL,
  `dphoto` varchar(300) DEFAULT NULL,
  `dpass` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counselor`
--

INSERT INTO `counselor` (`id`, `userid`, `dfname`, `duname`, `demail`, `dphone`, `daddress`, `dphoto`, `dpass`, `created_at`, `updated_at`) VALUES
(1, '20240723012634', 'Blessing John', 'blessing', 'blessing@gmail.com', '0987654567890', 'Umuofeke, Umuogba', 'default-profile.png', 'f1347562011016753e18334ffe7a5c99', '2025-11-28 09:00:05', '2025-11-28 09:00:05'),
(2, '20240727021047', 'Glory Michael', 'glory', 'glorymik@gmail.com', '09066778812', 'UMUOFEKE', '../uploads/person_3.jpg', 'c1efb154af1a3906a4d7f81f01b0828c', '2025-11-28 09:00:05', '2025-11-28 09:00:05'),
(4, 'USR-e7e289c7-5fa2-4756-bd02-69d7d6fc7bf6', 'Ricky Joe', 'rikenzy', 'rikky@gmail.com', '0819999999', 'lagos, island', '../stu_uploads/image6.png', '$2y$10$qm5U12qXLru13JouwO2r2uz4G407CcYlmJ9PavEEiqN8u1NmtzFIa', '2025-11-29 15:35:31', '2025-11-29 19:37:57'),
(5, 'USR-89d237a5-687a-41b1-be25-1df0b42a28e8', 'Amanda Kalu', 'ammy', 'ammykalu@gmail.com', '0907737378', 'lekki toll gate', '../stu_uploads/IMG_0516.JPG', '$2y$10$RpmHyAOrN2.qteipgHTvs.3Y9q9hGe7eCjkqLK9fK25GdIRD5Qb5e', '2025-11-29 16:00:19', '2025-11-29 22:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(50) NOT NULL,
  `student_id` int(50) NOT NULL,
  `goal_title` varchar(255) NOT NULL,
  `goal_description` text,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `progress` int(3) DEFAULT '0',
  `goal_status` enum('Not Started','In Progress','Completed','Cancelled') DEFAULT 'Not Started',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `student_id`, `goal_title`, `goal_description`, `start_date`, `end_date`, `progress`, `goal_status`, `created_at`, `updated_at`) VALUES
(2, 3, 'Finish Algebra', NULL, '2025-12-07', '2025-12-14', 50, 'In Progress', '2025-11-29 23:55:39', '2025-11-30 07:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(50) NOT NULL,
  `userid` varchar(300) NOT NULL,
  `dfname` varchar(255) NOT NULL,
  `duname` varchar(255) NOT NULL,
  `demail` varchar(255) NOT NULL,
  `dphone` varchar(20) NOT NULL,
  `daddress` varchar(255) NOT NULL,
  `dgender` enum('Male','Female','Other') DEFAULT NULL,
  `ddob` date DEFAULT NULL,
  `dgrade` varchar(50) DEFAULT NULL,
  `dsubject` varchar(200) DEFAULT NULL,
  `dscore` decimal(5,2) DEFAULT NULL,
  `dcareer` varchar(300) DEFAULT NULL,
  `dpass` varchar(300) NOT NULL,
  `dphoto` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `userid`, `dfname`, `duname`, `demail`, `dphone`, `daddress`, `dgender`, `ddob`, `dgrade`, `dsubject`, `dscore`, `dcareer`, `dpass`, `dphoto`, `created_at`, `updated_at`) VALUES
(1, '20240730023235', 'MICHEAL SUSAN', 'susan', 'susanM@gmail.com', '09037496199', 'PORT HARCOURT', 'Female', '1998-05-08', 'A', 'MATHS', '100.00', 'MATHEMATICIAN', '98e15403b2b1ea5022fc42b3490cc76e', '../stu_uploads/team-4.jpg', '2025-11-28 09:00:05', '2025-11-28 09:00:05'),
(2, '20240802080148', 'Mark Doris', 'dorisbaby', 'dodo2@gmail.com', '09037496199', 'Nwoji Port Harcourt', 'Female', '1997-07-04', 'A', 'ENGLISH LANGUAGE AND FRENCH', '100.00', 'LINGUISTICS', 'd45b4a782a7c1da2fb51a93aa068f649', '../stu_uploads/team-3.jpg', '2025-11-28 09:00:05', '2025-11-28 09:00:05'),
(3, 'USR-eccd4603-b605-4385-9a16-50f0765aa3e0', 'Princewill Izuchukwu Igwe', 'admin', 'princewilligwe15@gmail.com', '08137445867', 'Akoka lagos', 'Male', '2009-09-14', 'A', 'Physics', '85.00', 'Arts', '$2y$10$pc9nkHhNX1VOW5/yRsM2qemZTTaMtJQwWaCpqgaAs6wcrnBqNChpK', '../stu_uploads/birthday 2.jpg', '2025-11-29 08:30:08', '2025-11-29 08:30:08'),
(4, 'USR-36200e8f-817b-49dd-b16b-30a524992b41', 'Joseph Akah', 'joe', 'josephakah123@gmail.com', '08137445867', 'Akoka lagos', 'Male', '2017-03-03', 'A', 'Physics', '85.00', 'Engineer', '$2y$10$6IfpP485Fh1ZoTTQq4s7r.0tArjlDxrjB9y5Xpj3VFLdis0H.gnFK', '../stu_uploads/Flyer 5.png', '2025-12-01 16:27:36', '2025-12-01 16:27:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_student_id` (`student_id`),
  ADD KEY `idx_counselor_id` (`counselor_id`),
  ADD KEY `idx_appointment_date` (`appointment_date`);

--
-- Indexes for table `counselor`
--
ALTER TABLE `counselor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `duname` (`duname`),
  ADD UNIQUE KEY `demail` (`demail`),
  ADD KEY `idx_userid` (`userid`),
  ADD KEY `idx_email` (`demail`),
  ADD KEY `idx_username` (`duname`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_student_id` (`student_id`),
  ADD KEY `idx_status` (`goal_status`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `duname` (`duname`),
  ADD UNIQUE KEY `demail` (`demail`),
  ADD KEY `idx_userid` (`userid`),
  ADD KEY `idx_email` (`demail`),
  ADD KEY `idx_username` (`duname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `counselor`
--
ALTER TABLE `counselor`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`counselor_id`) REFERENCES `counselor` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
