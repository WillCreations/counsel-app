-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27
-- ⚠️ IMPROVED DATABASE SCHEMA with better practices

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akim_secondary_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
-- ⚠️ IMPROVED: Added timestamps, proper constraints, unique email, better data types
--

CREATE TABLE `student` (
  `id` int(50) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `userid` varchar(300) UNIQUE NOT NULL,
  `dfname` varchar(255) NOT NULL,
  `duname` varchar(255) UNIQUE NOT NULL,
  `demail` varchar(255) UNIQUE NOT NULL,
  `dphone` varchar(20) NOT NULL,
  `daddress` varchar(255) NOT NULL,
  `dgender` enum('Male', 'Female', 'Other') DEFAULT NULL,
  `ddob` DATE DEFAULT NULL,
  `dgrade` varchar(50) DEFAULT NULL,
  `dsubject` varchar(200) DEFAULT NULL,
  `dscore` decimal(5,2) DEFAULT NULL,
  `dcareer` varchar(300) DEFAULT NULL,
  `dpass` varchar(300) NOT NULL,
  `dphoto` varchar(300) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_userid (userid),
  INDEX idx_email (demail),
  INDEX idx_username (duname)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `counselor`
-- ⚠️ IMPROVED: Added timestamps, proper constraints, unique fields
--

CREATE TABLE `counselor` (
  `id` int(50) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `userid` varchar(200) UNIQUE NOT NULL,
  `dfname` varchar(255) NOT NULL,
  `duname` varchar(255) UNIQUE NOT NULL,
  `demail` varchar(255) UNIQUE NOT NULL,
  `dphone` varchar(20) NOT NULL,
  `daddress` varchar(255) DEFAULT NULL,
  `dphoto` varchar(300) DEFAULT NULL,
  `dpass` varchar(300) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_userid (userid),
  INDEX idx_email (demail),
  INDEX idx_username (duname)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
-- ⚠️ IMPROVED: Added foreign key, proper datetime, status enum, counselor reference
--

CREATE TABLE `appointment` (
  `id` int(50) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `student_id` int(50) NOT NULL,
  `counselor_id` int(50) DEFAULT NULL,
  `fixer_id` int(50) DEFAULT NULL,
  `appointment_date` DATETIME NOT NULL,
  `appointment_status` enum('Pending', 'Confirmed', 'Completed', 'Cancelled') DEFAULT 'Pending',
  `notes` text DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (student_id) REFERENCES `student`(id) ON DELETE CASCADE,
  FOREIGN KEY (counselor_id) REFERENCES `counselor`(id) ON DELETE SET NULL,
  INDEX idx_student_id (student_id),
  INDEX idx_counselor_id (counselor_id),
  INDEX idx_appointment_date (appointment_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
-- ⚠️ IMPROVED: Added foreign key, proper datetime, better constraints
--

CREATE TABLE `goals` (
  `id` int(50) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `student_id` int(50) NOT NULL,
  `goal_title` varchar(255) NOT NULL,
  `goal_description` text DEFAULT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `progress` int(3) DEFAULT 0 CHECK (progress >= 0 AND progress <= 100),
  `goal_status` enum('Not Started', 'In Progress', 'Completed', 'Cancelled') DEFAULT 'Not Started',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (student_id) REFERENCES `student`(id) ON DELETE CASCADE,
  INDEX idx_student_id (student_id),
  INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Sample data for tables
--

INSERT INTO `student` (`userid`, `dfname`, `duname`, `demail`, `dphone`, `daddress`, `dgender`, `ddob`, `dgrade`, `dsubject`, `dscore`, `dcareer`, `dpass`, `dphoto`) VALUES
('20240730023235', 'MICHEAL SUSAN', 'susan', 'susanM@gmail.com', '09037496199', 'PORT HARCOURT', 'Female', '1998-05-08', 'A', 'MATHS', 100.00, 'MATHEMATICIAN', '98e15403b2b1ea5022fc42b3490cc76e', '../stu_uploads/team-4.jpg'),
('20240802080148', 'Mark Doris', 'dorisbaby', 'dodo2@gmail.com', '09037496199', 'Nwoji Port Harcourt', 'Female', '1997-07-04', 'A', 'ENGLISH LANGUAGE AND FRENCH', 100.00, 'LINGUISTICS', 'd45b4a782a7c1da2fb51a93aa068f649', '../stu_uploads/team-3.jpg');

INSERT INTO `counselor` (`userid`, `dfname`, `duname`, `demail`, `dphone`, `daddress`, `dphoto`, `dpass`) VALUES
('20240723012634', 'Blessing John', 'blessing', 'blessing@gmail.com', '0987654567890', 'Umuofeke, Umuogba', 'default-profile.png', 'f1347562011016753e18334ffe7a5c99'),
('20240727021047', 'Glory Michael', 'glory', 'glorymik@gmail.com', '09066778812', 'UMUOFEKE', '../uploads/person_3.jpg', 'c1efb154af1a3906a4d7f81f01b0828c');

-- ⚠️ IMPROVEMENTS SUMMARY:
-- 1. Added AUTO_INCREMENT PRIMARY KEYs to all tables
-- 2. Added UNIQUE constraints on email, username, userid
-- 3. Changed DATE/TIME storage from VARCHAR to proper DATE/DATETIME types
-- 4. Used ENUM for fixed values (gender, status)
-- 5. Added NOT NULL constraints where needed
-- 6. Added proper FOREIGN KEY constraints with CASCADE/SET NULL
-- 7. Added proper INDEXES for better query performance
-- 8. Added created_at and updated_at timestamps
-- 9. Changed dscore from VARCHAR to DECIMAL(5,2)
-- 10. Removed duplicate tables (studentappointment merged into appointment)
-- 11. Added CHECK constraint for progress (0-100)
-- 12. Better naming conventions for foreign keys

ALTER TABLE `appointment` AUTO_INCREMENT=3;
ALTER TABLE `counselor` AUTO_INCREMENT=3;
ALTER TABLE `goals` AUTO_INCREMENT=1;
ALTER TABLE `student` AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
