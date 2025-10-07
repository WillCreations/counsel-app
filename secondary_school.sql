-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 02:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `dfname` varchar(255) DEFAULT NULL,
  `ddate` varchar(50) DEFAULT NULL,
  `dtime` varchar(50) DEFAULT NULL,
  `dstatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `dfname`, `ddate`, `dtime`, `dstatus`) VALUES
(2, 'Glory', '2024-07-29', '10:00', 'Cancelled'),
(3, 'Glory', '2024-07-31', '23:21', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `counselor`
--

CREATE TABLE `counselor` (
  `id` int(50) NOT NULL,
  `userid` varchar(200) DEFAULT NULL,
  `dfname` varchar(255) DEFAULT NULL,
  `duname` varchar(255) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `dphone` varchar(255) DEFAULT NULL,
  `daddress` varchar(255) DEFAULT NULL,
  `dphoto` varchar(300) DEFAULT NULL,
  `dpass` varchar(300) DEFAULT NULL,
  `ddate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counselor`
--

INSERT INTO `counselor` (`id`, `userid`, `dfname`, `duname`, `demail`, `dphone`, `daddress`, `dphoto`, `dpass`, `ddate`) VALUES
(2, '20240723012634', 'Blessing John', 'blessing', 'blessing@gmail.com', '0987654567890', 'Umuofeke, Umuogba', 'default-profile.png', 'f1347562011016753e18334ffe7a5c99', '2024-07-22'),
(3, '20240727021047', 'Glory Michael', 'glory', 'glorymik@gmail.com', '09066778812', 'UMUOFEKE', '../uploads/person_3.jpg', 'c1efb154af1a3906a4d7f81f01b0828c', '2024-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(50) NOT NULL,
  `userid` varchar(300) DEFAULT NULL,
  `dgoal` varchar(255) DEFAULT NULL,
  `startDate` varchar(200) DEFAULT NULL,
  `endDate` varchar(200) DEFAULT NULL,
  `dprogress` varchar(300) DEFAULT NULL,
  `goals_fk` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `userid`, `dgoal`, `startDate`, `endDate`, `dprogress`, `goals_fk`) VALUES
(2, NULL, '$goal', '$start_date', '$end_date', '$progress', NULL),
(7, NULL, 'Learn Web Development', '2024-08-08', '2024-08-31', '80%', NULL),
(10, NULL, 'Learn Use of English', '2024-08-08', '2024-08-14', '80', NULL),
(11, '', 'Learn Web Development', '2024-08-11', '2024-12-31', '100', NULL),
(14, '20240802080148', 'Learn Economics', '2024-08-20', '2024-09-20', '100', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(50) NOT NULL,
  `userid` varchar(300) DEFAULT NULL,
  `dfname` varchar(255) DEFAULT NULL,
  `duname` varchar(255) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `dphone` varchar(50) DEFAULT NULL,
  `daddress` varchar(255) DEFAULT NULL,
  `dgender` varchar(150) DEFAULT NULL,
  `ddob` varchar(200) DEFAULT NULL,
  `dgrade` varchar(250) DEFAULT NULL,
  `dsubject` varchar(200) DEFAULT NULL,
  `dscore` varchar(300) DEFAULT NULL,
  `dcareer` varchar(300) DEFAULT NULL,
  `dpass` varchar(300) DEFAULT NULL,
  `dphoto` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `userid`, `dfname`, `duname`, `demail`, `dphone`, `daddress`, `dgender`, `ddob`, `dgrade`, `dsubject`, `dscore`, `dcareer`, `dpass`, `dphoto`) VALUES
(4, '20240730023235', 'MICHEAL SUSAN', 'susan', 'susanM@gmail.com', '09037496199', 'PORT HARCOURT', 'Female', '08-May-1998', 'A', 'MATHS', '100', 'MATHEMATICIAN', '98e15403b2b1ea5022fc42b3490cc76e', '../stu_uploads/team-4.jpg'),
(5, '20240802080148', 'Mark Doris', 'dorisbaby', 'dodo2@gmail.com', '09037496199', 'Nwoji Port Harcourt', 'Female', '04-Jul-1997', 'A', 'ENGLISH LANGUAGE AND FRENCH', '100', 'LINGUISTICS', 'd45b4a782a7c1da2fb51a93aa068f649', '../stu_uploads/team-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `studentappointment`
--

CREATE TABLE `studentappointment` (
  `id` int(50) NOT NULL,
  `dfname` varchar(255) DEFAULT NULL,
  `ddate` varchar(50) DEFAULT NULL,
  `dtime` varchar(50) DEFAULT NULL,
  `dstatus` varchar(200) DEFAULT NULL,
  `studentAppointment_fk` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentappointment`
--

INSERT INTO `studentappointment` (`id`, `dfname`, `ddate`, `dtime`, `dstatus`, `studentAppointment_fk`) VALUES
(2, 'Micheal Susan', '2024-08-08', '13:02', 'Completed', NULL),
(7, 'Mark Doris', '2024-08-14', '12:09', 'Completed', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counselor`
--
ALTER TABLE `counselor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goals_fk` (`goals_fk`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentappointment`
--
ALTER TABLE `studentappointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentAppointment_fk` (`studentAppointment_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `counselor`
--
ALTER TABLE `counselor`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `studentappointment`
--
ALTER TABLE `studentappointment`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`goals_fk`) REFERENCES `student` (`id`);

--
-- Constraints for table `studentappointment`
--
ALTER TABLE `studentappointment`
  ADD CONSTRAINT `studentappointment_ibfk_1` FOREIGN KEY (`studentAppointment_fk`) REFERENCES `student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
