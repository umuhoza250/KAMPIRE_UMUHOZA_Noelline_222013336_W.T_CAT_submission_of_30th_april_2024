-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 12:41 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umuhozakampirenoelline222013336hbcsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `businessexperts`
--

CREATE TABLE `businessexperts` (
  `ExpertID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ContactInformation` varchar(255) DEFAULT NULL,
  `AreaOfExpertise` varchar(255) DEFAULT NULL,
  `ConsultingHistory` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `communicationlogs`
--

CREATE TABLE `communicationlogs` (
  `LogID` int(11) NOT NULL,
  `SessionID` int(11) DEFAULT NULL,
  `Participant` enum('Client','Consultant') DEFAULT NULL,
  `InteractionDetails` text DEFAULT NULL,
  `Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Agenda` text DEFAULT NULL,
  `Outcome` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedbackandreviews`
--

CREATE TABLE `feedbackandreviews` (
  `FeedbackID` int(11) NOT NULL,
  `SessionID` int(11) DEFAULT NULL,
  `Participant` enum('Client','Consultant') DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Specialization` enum('Client','Consultant','Business Expert') NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businessexperts`
--
ALTER TABLE `businessexperts`
  MODIFY `ExpertID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `communicationlogs`
--
ALTER TABLE `communicationlogs`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultant`
--
ALTER TABLE `consultant`
  MODIFY `ConsultantID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultationsession`
--
ALTER TABLE `consultationsession`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbackandreviews`
--
ALTER TABLE `feedbackandreviews`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

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
