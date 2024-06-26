-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 09:44 PM
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
-- Database: `iphs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_tb`
--

CREATE TABLE `log_tb` (
  `audit_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_tb`
--

INSERT INTO `log_tb` (`audit_id`, `timestamp`, `user_id`, `fname`, `lname`, `role`, `action`) VALUES
(19, '2024-04-28 13:39:24', 8, NULL, NULL, NULL, 'logged in'),
(20, '2024-04-28 13:39:44', 8, NULL, NULL, NULL, 'logged in');

-- --------------------------------------------------------

--
-- Table structure for table `role_tb`
--

CREATE TABLE `role_tb` (
  `role_ID` int(2) NOT NULL,
  `role_name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_tb`
--

INSERT INTO `role_tb` (`role_ID`, `role_name`) VALUES
(1, 'admin'),
(2, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `strand_tb`
--

CREATE TABLE `strand_tb` (
  `strand_id` int(11) NOT NULL,
  `strand_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strand_tb`
--

INSERT INTO `strand_tb` (`strand_id`, `strand_name`) VALUES
(1, 'stem'),
(2, 'gas'),
(3, 'hums'),
(4, 'abm');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(256) NOT NULL,
  `dob` date DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `strand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `fname`, `lname`, `email`, `password`, `dob`, `role_id`, `strand_id`) VALUES
(8, 'Neil', 'Alfred', 'a@gmail.com', '$2y$10$l8sfMvWPJj0tCIW49FOb2uADMKIO09SqnTovgvOITblzX/u5ScTTe', '2024-04-18', 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_tb`
--
ALTER TABLE `log_tb`
  ADD PRIMARY KEY (`audit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role_tb`
--
ALTER TABLE `role_tb`
  ADD PRIMARY KEY (`role_ID`);

--
-- Indexes for table `strand_tb`
--
ALTER TABLE `strand_tb`
  ADD PRIMARY KEY (`strand_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `strand_id` (`strand_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_tb`
--
ALTER TABLE `log_tb`
  MODIFY `audit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `strand_tb`
--
ALTER TABLE `strand_tb`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_tb`
--
ALTER TABLE `log_tb`
  ADD CONSTRAINT `log_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`);

--
-- Constraints for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD CONSTRAINT `user_tb_ibfk_1` FOREIGN KEY (`strand_id`) REFERENCES `strand_tb` (`strand_id`),
  ADD CONSTRAINT `user_tb_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role_tb` (`role_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
