-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 02:23 PM
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
-- Database: `handcraft_business_consulting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `businessexperts`
--

CREATE TABLE `businessexperts` (
  `ExpertID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ContactInformation` varchar(255) NOT NULL,
  `AreaOfExpertise` varchar(255) NOT NULL,
  `ConsultingHistory` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `businessexperts`
--

INSERT INTO `businessexperts` (`ExpertID`, `Name`, `ContactInformation`, `AreaOfExpertise`, `ConsultingHistory`) VALUES
(2, 'nell', '1234', 'mug', 'kigali'),
(3, 'cesar', '123456', 'sdfgh', 'sdfgh'),
(4, 'hanna', '23456', 'sdfghj,', 'fghnjmk,'),
(5, 'nzobe', '12345', 'sadfghj', 'asdfgh');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ClientID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ContactInformation` varchar(255) DEFAULT NULL,
  `BusinessName` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `BusinessSize` varchar(50) DEFAULT NULL,
  `Goals` text DEFAULT NULL,
  `Challenges` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ClientID`, `Name`, `ContactInformation`, `BusinessName`, `Location`, `BusinessSize`, `Goals`, `Challenges`) VALUES
(2, 'fdfdfg', '4567890', 'sdfgh', 'erterr', '23456', 'sdfghj', 'aserse5yy'),
(3, 'brian', '23434567', 'asd', 'as', 'qwer', 'werfg', 'edrftgyh'),
(4, 'killer', '1234', 'asdfg', 'asdfg', 'asdfg', 'asdfg', 'asdfgh');

-- --------------------------------------------------------

--
-- Table structure for table `communicationlogs`
--

CREATE TABLE `communicationlogs` (
  `LogID` int(11) NOT NULL,
  `SessionID` int(11) DEFAULT NULL,
  `Participant` varchar(10) DEFAULT NULL,
  `InteractionDetails` text DEFAULT NULL,
  `Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communicationlogs`
--

INSERT INTO `communicationlogs` (`LogID`, `SessionID`, `Participant`, `InteractionDetails`, `Time`) VALUES
(2, 3, 'asdfghj', 'asdfgbhn', '13:20:00'),
(3, 3, 'rose', 'dfghnm', '00:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `consultant`
--

CREATE TABLE `consultant` (
  `ConsultantID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ContactInformation` varchar(255) DEFAULT NULL,
  `Expertise` varchar(255) DEFAULT NULL,
  `ConsultingHistory` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultant`
--

INSERT INTO `consultant` (`ConsultantID`, `Name`, `ContactInformation`, `Expertise`, `ConsultingHistory`) VALUES
(2, 'VVVVV', '09876543', 'pot mkaing', 'fresh'),
(3, 'john', '1234', 'asdfg', 'dfghnm,'),
(4, 'asdfgbhnjm', '1234', 'sdfgh', 'asdfghn');

-- --------------------------------------------------------

--
-- Table structure for table `consultationsession`
--

CREATE TABLE `consultationsession` (
  `SessionID` int(11) NOT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `ConsultantID` int(11) DEFAULT NULL,
  `DateAndTime` datetime DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  `Agenda` varchar(10) DEFAULT NULL,
  `Outcome` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultationsession`
--

INSERT INTO `consultationsession` (`SessionID`, `ClientID`, `ConsultantID`, `DateAndTime`, `Duration`, `Agenda`, `Outcome`) VALUES
(1, 2, 2, '2024-04-27 19:43:00', 0, 'BOOM', 'FIRE'),
(2, 2, 2, '2024-04-27 00:00:00', 19, 'FIRE', 'BOOM'),
(3, 2, 3, '2024-04-18 15:31:00', 0, 'sdfghn', 'quatar'),
(4, 3, 3, '2024-04-16 00:00:00', 13, 'qwertg', 'sdfgbn');

-- --------------------------------------------------------

--
-- Table structure for table `feedbackandreviews`
--

CREATE TABLE `feedbackandreviews` (
  `FeedbackID` int(11) NOT NULL,
  `SessionID` int(11) DEFAULT NULL,
  `Participant` varchar(10) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbackandreviews`
--

INSERT INTO `feedbackandreviews` (`FeedbackID`, `SessionID`, `Participant`, `Rating`, `Comments`, `Time`) VALUES
(1, 1, 'nelly', 1, 'nell', '0000-00-00 00:00:00'),
(3, 1, 'tyhjk,', 0, 'fghn', '0000-00-00 00:00:00'),
(4, 1, 'dfg', 0, 'asdfgh', '0000-00-00 00:00:00'),
(6, 2, 'asdfghjm', 0, 'assdfghj', '0000-00-00 00:00:00'),
(7, 3, 'sdfghjm', 0, 'dfghjk', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'nelly', 'kampire', 'd222', 'kampireumuhozanoelline@gmail.com', '12345', '$2y$10$v6dePsYm6RfLgLdoDAQDYe.sjOYElp8ihFGn1kwN0xlGvNQDc33BO', '2024-04-21 14:56:37', '12', 0),
(2, 'nelly', 'Ndabarasa', 'nellynelio', 'nelly@gmail.com', '123456789', '$2y$10$Ujt7sbn/LyvAu7TheycNEuO82v1NgTh.T/gVKJLV4B.cM.Zoqa5M2', '2024-04-29 11:27:07', '1', 0),
(3, 'Rukundo', 'Yves', 'Yves1', 'yves@gmail.com', '078765432', '$2y$10$sqkiFhLYkLVrx6tShnjot.Gsl9tvDrbzz6gJQPQwbM3AFW0bQQbCO', '2024-04-30 12:16:10', '12345', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businessexperts`
--
ALTER TABLE `businessexperts`
  ADD PRIMARY KEY (`ExpertID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `communicationlogs`
--
ALTER TABLE `communicationlogs`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `SessionID` (`SessionID`);

--
-- Indexes for table `consultant`
--
ALTER TABLE `consultant`
  ADD PRIMARY KEY (`ConsultantID`);

--
-- Indexes for table `consultationsession`
--
ALTER TABLE `consultationsession`
  ADD PRIMARY KEY (`SessionID`),
  ADD KEY `ClientID` (`ClientID`),
  ADD KEY `ConsultantID` (`ConsultantID`);

--
-- Indexes for table `feedbackandreviews`
--
ALTER TABLE `feedbackandreviews`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `SessionID` (`SessionID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businessexperts`
--
ALTER TABLE `businessexperts`
  MODIFY `ExpertID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `communicationlogs`
--
ALTER TABLE `communicationlogs`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `consultant`
--
ALTER TABLE `consultant`
  MODIFY `ConsultantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `consultationsession`
--
ALTER TABLE `consultationsession`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedbackandreviews`
--
ALTER TABLE `feedbackandreviews`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `communicationlogs`
--
ALTER TABLE `communicationlogs`
  ADD CONSTRAINT `communicationlogs_ibfk_1` FOREIGN KEY (`SessionID`) REFERENCES `consultationsession` (`SessionID`);

--
-- Constraints for table `consultationsession`
--
ALTER TABLE `consultationsession`
  ADD CONSTRAINT `consultationsession_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `client` (`ClientID`),
  ADD CONSTRAINT `consultationsession_ibfk_2` FOREIGN KEY (`ConsultantID`) REFERENCES `consultant` (`ConsultantID`);

--
-- Constraints for table `feedbackandreviews`
--
ALTER TABLE `feedbackandreviews`
  ADD CONSTRAINT `feedbackandreviews_ibfk_1` FOREIGN KEY (`SessionID`) REFERENCES `consultationsession` (`SessionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
