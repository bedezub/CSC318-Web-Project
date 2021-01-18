-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2021 at 11:31 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `Candidates`
--

CREATE TABLE `Candidates` (
  `candidateID` int(12) NOT NULL,
  `email` varchar(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `userpassword` varchar(80) NOT NULL,
  `profilePicture` varchar(80) NOT NULL,
  `userType` varchar(80) NOT NULL,
  `faculty` varchar(80) NOT NULL,
  `manifesto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Candidates`
--

INSERT INTO `Candidates` (`candidateID`, `email`, `username`, `userpassword`, `profilePicture`, `userType`, `faculty`, `manifesto`) VALUES
(111, 'ali@gmail.com', 'Muhd Ali', '12345', '111-1611009039.jpg', 'candidate', 'fskm', '');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `studentID` int(12) NOT NULL,
  `email` varchar(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `userpassword` varchar(80) NOT NULL,
  `isAttend` int(5) NOT NULL,
  `userType` varchar(80) NOT NULL,
  `faculty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`studentID`, `email`, `username`, `userpassword`, `isAttend`, `userType`, `faculty`) VALUES
(1111, 'admin@gmail.com', 'admin', '12345', 1, 'admin', 'fskm'),
(2222, 'zubli@gmail.com', 'zub', '123', 0, 'voter', 'fskm'),
(2018442458, 'voter', 'voter', '12345', 1, 'Admin', 'FSKM');

-- --------------------------------------------------------

--
-- Table structure for table `Vote`
--

CREATE TABLE `Vote` (
  `voteID` int(12) NOT NULL,
  `studentID` int(12) NOT NULL,
  `candidateID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Candidates`
--
ALTER TABLE `Candidates`
  ADD PRIMARY KEY (`candidateID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `Vote`
--
ALTER TABLE `Vote`
  ADD PRIMARY KEY (`voteID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `candidateID` (`candidateID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Vote`
--
ALTER TABLE `Vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `Users` (`studentID`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`candidateID`) REFERENCES `Candidates` (`candidateID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
