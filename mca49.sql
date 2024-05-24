-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 09:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mca49`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendancedb`
--

CREATE TABLE `attendancedb` (
  `department` varchar(14) NOT NULL,
  `year` int(1) NOT NULL,
  `roll` int(7) NOT NULL,
  `day` varchar(10) NOT NULL,
  `isPresent` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendancedb`
--

INSERT INTO `attendancedb` (`department`, `year`, `roll`, `day`, `isPresent`) VALUES
('MCA', 1, 2, '2023-11-05', 'true'),
('MCA', 1, 2, '2023-11-06', 'true'),
('MCA', 1, 2, '2023-11-07', 'true'),
('MCA', 1, 2, '2023-11-08', 'true'),
('MCA', 1, 4, '2023-11-05', 'false'),
('MCA', 1, 4, '2023-11-06', 'true'),
('MCA', 1, 4, '2023-11-07', 'true'),
('MCA', 1, 4, '2023-11-08', 'false'),
('MCA', 1, 5, '2023-11-05', 'true'),
('MCA', 1, 5, '2023-11-06', 'true'),
('MCA', 1, 5, '2023-11-07', 'true'),
('MCA', 1, 5, '2023-11-08', 'true'),
('MCA', 1, 6, '2023-11-05', 'false'),
('MCA', 1, 6, '2023-11-06', 'false'),
('MCA', 1, 6, '2023-11-07', 'true'),
('MCA', 1, 6, '2023-11-08', 'false'),
('MCA', 1, 7, '2023-11-05', 'false'),
('MCA', 1, 7, '2023-11-06', 'false'),
('MCA', 1, 7, '2023-11-07', 'true'),
('MCA', 1, 7, '2023-11-08', 'true'),
('MCA', 1, 10, '2023-11-05', 'false'),
('MCA', 1, 10, '2023-11-06', 'false'),
('MCA', 1, 10, '2023-11-07', 'true'),
('MCA', 1, 10, '2023-11-08', 'false'),
('MCA', 1, 2282049, '2023-11-05', 'true'),
('MCA', 1, 2282049, '2023-11-06', 'true'),
('MCA', 1, 2282049, '2023-11-07', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `otpdb`
--

CREATE TABLE `otpdb` (
  `Email` varchar(50) NOT NULL,
  `OTP` varchar(6) DEFAULT NULL,
  `timestamp` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otpdb`
--

INSERT INTO `otpdb` (`Email`, `OTP`, `timestamp`) VALUES
('alexisgriffin@rocketmail.com', '123456', ''),
('arka.samaddar.mca24@heritageit.edu.in', '538085', '2023-11-08 09:29:24'),
('arka@20gmailc.co', NULL, ''),
('arkasama2001@gmail.com', '387304', '2023-11-08 09:18:40'),
('austin.ramirez@live.com', NULL, ''),
('b.ramirez@gmail.com', NULL, ''),
('cfclark@yahoo.com', NULL, ''),
('jjadams@hotmail.com', NULL, ''),
('joseph95@rocketmail.com', NULL, ''),
('j_w_evans84@ymail.com', NULL, ''),
('nicholas_hughes44@ymail.com', NULL, ''),
('nwroberts3@hotmail.com', NULL, ''),
('richard.e.clark@gmail.com', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `studentmaindb`
--

CREATE TABLE `studentmaindb` (
  `first_name` varchar(14) DEFAULT NULL,
  `last_name` varchar(14) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `rollno` int(7) DEFAULT NULL,
  `Date_of_Birth` varchar(10) DEFAULT NULL,
  `role` varchar(7) DEFAULT NULL,
  `year` int(1) DEFAULT NULL,
  `fee_status` varchar(5) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `Department` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentmaindb`
--

INSERT INTO `studentmaindb` (`first_name`, `last_name`, `email`, `state`, `city`, `phone`, `rollno`, `Date_of_Birth`, `role`, `year`, `fee_status`, `password`, `Department`) VALUES
('Alexis', 'Griffin', 'alexisgriffin@rocketmail.com', 'Florida', 'Orlando', '832-144-2125', NULL, '14-05-2020', 'Admin', NULL, NULL, 'arka2001', 'MCA'),
('Arka', 'Samaddar', 'arka.samaddar.mca24@heritageit.edu.in', 'West Bengal', 'Kolkata', '7980184074', NULL, '25-01-2001', 'Teacher', NULL, NULL, 'Arka@2001', 'MCA'),
('asd', 'asd', 'arka@20gmailc.co', 'west', 'kol', '6845498752', 123, '11-11-2001', 'Student', 2, 'FALSE', 'Arak@2001', 'MCA'),
('Arka', 'Samaddar', 'arkasama2001@gmail.com', 'West Bengal', 'Kolkata', '7980184074', NULL, '25-01-2001', 'Admin', NULL, NULL, 'Arka@2001', 'MCA'),
('Austin', 'Ramirez', 'austin.ramirez@live.com', 'Michigan', 'Detroit', '917-025-0536', 8, '25-07-1997', 'Teacher', 1, 'TRUE', 'asgas214', 'MCA'),
('Brittany', 'Ramirez', 'b.ramirez@gmail.com', 'Texas', 'Nolanville', '224-872-4903', 3, '18-08-2010', 'Admin', 1, 'FALSE', 'gdsfsg123', 'Administration'),
('Charles', 'Clark', 'cfclark@yahoo.com', 'Mississippi', 'Money', '7980184074', 5, '21-03-2022', 'Student', 1, 'TRUE', 'fasa231', 'MCA'),
('James', 'Adams', 'jjadams@hotmail.com', 'Texas', 'El Paso', '539-542-1523', 2, '27-11-2012', 'Student', 1, 'FALSE', 'asd2145', 'MCA'),
('Joseph', 'Adams', 'joseph95@rocketmail.com', 'South Dakota', 'Elk Point', '914-203-5899', 7, '30-08-2021', 'Student', 1, 'TRUE', 'oihas5234', 'MCA'),
('Jack', 'Evans', 'j_w_evans84@ymail.com', 'Michigan', 'Pigeon', '754-403-0304', 9, '04-11-1985', 'Teacher', 1, 'TRUE', 'asd1245', 'MCA'),
('Nicholas', 'Hughes', 'nicholas_hughes44@ymail.com', 'Montana', 'Acton', '956-699-1324', 6, '31-07-2018', 'Student', 1, 'TRUE', 'assa1241', 'MCA'),
('Nicholas', 'Roberts', 'nwroberts3@hotmail.com', 'New Jersey', 'Toms River', '530-549-6450', 4, '01-04-2010', 'Student', 1, 'FALSE', 'asf1123', 'MCA'),
('Richard', 'Clark', 'richard.e.clark@gmail.com', 'Georgia', 'Athens', '586-946-7162', 10, '30-12-2016', 'Student', 1, 'TRUE', 'gaasf2142', 'MCA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendancedb`
--
ALTER TABLE `attendancedb`
  ADD PRIMARY KEY (`roll`,`day`);

--
-- Indexes for table `otpdb`
--
ALTER TABLE `otpdb`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `studentmaindb`
--
ALTER TABLE `studentmaindb`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `rollno` (`rollno`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `otpdb`
--
ALTER TABLE `otpdb`
  ADD CONSTRAINT `otpdb_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `studentmaindb` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
