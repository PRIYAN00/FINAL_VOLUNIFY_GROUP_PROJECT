-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2024 at 09:30 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `volunify`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `EVENT_ID` int(10) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(100) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `LOCATION` varchar(50) NOT NULL,
  `DATE` varchar(50) NOT NULL,
  `START_TIME` varchar(50) NOT NULL,
  `END_TIME` varchar(50) NOT NULL,
  `ORG_ID` int(10) NOT NULL,
  PRIMARY KEY (`EVENT_ID`),
  KEY `ORG_ID` (`ORG_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EVENT_ID`, `TITLE`, `DESCRIPTION`, `LOCATION`, `DATE`, `START_TIME`, `END_TIME`, `ORG_ID`) VALUES
(1, 'New Year', 'New Year', 'Dehiwala', '2024-04-13', '20:00', '20:20', 1),
(2, 'Test', 'Test', 'Test', '2024-03-06', '00:00', '00:11', 1),
(3, 'Test 2', 'Test 2', 'Test 2', '2024-05-21', '02:22', '09:02', 1),
(4, 'Test 3', 'Test 3', 'Test 3', '2024-04-23', '05:05', '06:06', 3);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `RAT_ID` int(10) NOT NULL AUTO_INCREMENT,
  `RatedUserID` int(10) NOT NULL,
  `RatedByUserID` int(10) NOT NULL,
  `RatingValue` varchar(50) NOT NULL,
  `Comments` text NOT NULL,
  `Timestamp` varchar(50) NOT NULL,
  PRIMARY KEY (`RAT_ID`),
  KEY `RatedUserID` (`RatedUserID`),
  KEY `RatedByUserID` (`RatedByUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`RAT_ID`, `RatedUserID`, `RatedByUserID`, `RatingValue`, `Comments`, `Timestamp`) VALUES
(1, 2, 1, '4stars', ' Good Work', '2024/04/06 04:02:28 AM'),
(2, 3, 1, '5stars', ' test', '2024/04/06 04:03:07 AM');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `R_ID` int(10) NOT NULL AUTO_INCREMENT,
  `R_NAME` varchar(50) NOT NULL,
  `R_LEVEL` varchar(50) NOT NULL,
  PRIMARY KEY (`R_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`R_ID`, `R_NAME`, `R_LEVEL`) VALUES
(1, 'Admin', 'All Pages'),
(2, 'Volunteer', 'Volunteer Pages'),
(3, 'Organization', 'Organization Pages');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `USERID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(50) NOT NULL,
  `FULLNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `USERTYPE` int(10) NOT NULL,
  `LOCATION` varchar(20) NOT NULL,
  `INTEREST` text NOT NULL,
  `ABILITY` text NOT NULL,
  `TALENTS` text NOT NULL,
  `CREDENTIAL` text NOT NULL,
  `REG_DATE` text NOT NULL,
  PRIMARY KEY (`USERID`),
  KEY `USERTYPE` (`USERTYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USERID`, `USERNAME`, `FULLNAME`, `PASSWORD`, `EMAIL`, `USERTYPE`, `LOCATION`, `INTEREST`, `ABILITY`, `TALENTS`, `CREDENTIAL`, `REG_DATE`) VALUES
(1, 'MAHINDAP', 'Priyanthan Mahindaraj', '202cb962ac59075b964b07152d234b70', 'e130975@esoft.academy', 1, 'Dehiwala', 'Coding', 'Quick Learner', 'N/A', 'Bsc Hon in Software Engineering ', '01/04/2024 08:25:00 AM'),
(2, 'PLGAYA', 'P. L Gayashan Pasindu Cooray', '202cb962ac59075b964b07152d234b70', 'e127949@esoft.academy', 2, 'Colombo', 'Coding', 'Coding', 'Coding', 'BSC IN SE', '02/04/2024 08:25:00 AM'),
(3, 'SAHAN', 'Sahan Jayathu', '202cb962ac59075b964b07152d234b70', 'e114762@esoft.academy', 3, 'Borella', 'Beach side clean', 'Teamwork', 'Good Communication', 'Social Work Degree', '2024/04/04 02:26:48 PM');

-- --------------------------------------------------------

--
-- Table structure for table `vol_opp`
--

DROP TABLE IF EXISTS `vol_opp`;
CREATE TABLE IF NOT EXISTS `vol_opp` (
  `OPP_ID` int(10) NOT NULL AUTO_INCREMENT,
  `ORG_ID` int(10) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `LOCATION` varchar(50) NOT NULL,
  `TIME_COMMITMENT` varchar(50) NOT NULL,
  `DATE_POSTED` varchar(50) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  PRIMARY KEY (`OPP_ID`),
  KEY `ORG_ID` (`ORG_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vol_opp`
--

INSERT INTO `vol_opp` (`OPP_ID`, `ORG_ID`, `TITLE`, `DESCRIPTION`, `TYPE`, `LOCATION`, `TIME_COMMITMENT`, `DATE_POSTED`, `STATUS`) VALUES
(1, 3, 'Test', 'Test', 'Long-term', 'Dehiwala', '5 hours', '2024/04/05 11:23:30 AM', 'Closed'),
(2, 3, 'Test 2', 'Test 2', 'One-time', 'Dehiwala', '2 Hours', '2024/04/06 04:31:46 AM', 'Open'),
(3, 1, 'Test 3', 'Test 3', 'Long-term', 'Test 3', '8 hours', '2024/04/06 08:58:43 AM', 'Open'),
(4, 1, 'Test 4', 'Test 4', 'Long-term', 'Test 4', '6 hours', '2024/04/06 09:05:34 AM', 'Open'),
(5, 3, 'Test 5', 'Test 5', 'Long-term', 'Test 5', '10 Hours', '2024/04/06 09:22:08 AM', 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `vol_reg`
--

DROP TABLE IF EXISTS `vol_reg`;
CREATE TABLE IF NOT EXISTS `vol_reg` (
  `REG_ID` int(10) NOT NULL AUTO_INCREMENT,
  `VOL_ID` int(10) NOT NULL,
  `OPP_ID` int(10) NOT NULL,
  `REG_DATE` varchar(50) NOT NULL,
  `STATUS` varchar(20) DEFAULT 'Pending',
  `AVAIABILITY` varchar(50) NOT NULL,
  `CONTACT_INFO` varchar(50) NOT NULL,
  `QUALICFICATION` varchar(50) NOT NULL,
  PRIMARY KEY (`REG_ID`),
  KEY `VOL_ID` (`VOL_ID`),
  KEY `OPP_ID` (`OPP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vol_reg`
--

INSERT INTO `vol_reg` (`REG_ID`, `VOL_ID`, `OPP_ID`, `REG_DATE`, `STATUS`, `AVAIABILITY`, `CONTACT_INFO`, `QUALICFICATION`) VALUES
(1, 1, 1, '05-Apr-2024', 'Pending', 'Test', 'Test', 'Test'),
(2, 2, 1, '05-Apr-2024', 'Pending', 'Test', 'Test', 'Test'),
(3, 3, 1, '05-Apr-2024', 'Pending', 'Test', 'Test', 'Test'),
(4, 2, 3, '06-Apr-2024', 'Pending', 'Test', 'Test', 'Test');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`ORG_ID`) REFERENCES `user` (`USERID`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`RatedUserID`) REFERENCES `user` (`USERID`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`RatedByUserID`) REFERENCES `user` (`USERID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`USERTYPE`) REFERENCES `role` (`R_ID`);

--
-- Constraints for table `vol_opp`
--
ALTER TABLE `vol_opp`
  ADD CONSTRAINT `vol_opp_ibfk_1` FOREIGN KEY (`ORG_ID`) REFERENCES `user` (`USERID`);

--
-- Constraints for table `vol_reg`
--
ALTER TABLE `vol_reg`
  ADD CONSTRAINT `vol_reg_ibfk_1` FOREIGN KEY (`VOL_ID`) REFERENCES `user` (`USERID`),
  ADD CONSTRAINT `vol_reg_ibfk_2` FOREIGN KEY (`OPP_ID`) REFERENCES `vol_opp` (`OPP_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
