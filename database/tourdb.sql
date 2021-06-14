-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2018 at 07:53 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tourdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ADMINID` varchar(10) NOT NULL,
  `ADMIN_NAME` varchar(20) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(25) NOT NULL,
  PRIMARY KEY (`ADMINID`),
  UNIQUE KEY `ADMINID` (`ADMINID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMINID`, `ADMIN_NAME`, `EMAIL`, `PASSWORD`) VALUES
('AD-001', 'Jason Ray', 'jasonRay98@gmail.com', 'Admin98@jason'),
('AD-003', 'Mary X', 'mary43@gmailcom', 'mary43@admin'),
('AD-004', 'John Robert', 'john55@gmail.com', 'john55@Admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `BOOKINGID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `PAYMENTID` int(11) NOT NULL,
  `TRIPDETAILID` int(11) NOT NULL,
  `NO_OF_PASSENGER` int(11) DEFAULT NULL,
  `CHOOSE_SEAT_NO` varchar(10) DEFAULT NULL,
  `STATUS` varchar(15) NOT NULL,
  PRIMARY KEY (`BOOKINGID`),
  UNIQUE KEY `BOOKINGID` (`BOOKINGID`),
  KEY `USERID` (`CUSTOMER_ID`),
  KEY `PAYMENTID` (`PAYMENTID`),
  KEY `TRIPDETAILID` (`TRIPDETAILID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `BUSID` varchar(10) NOT NULL,
  `BUSNAME` varchar(60) NOT NULL,
  `BUS_CLASS` varchar(20) DEFAULT NULL,
  `NO_OF_SEAT` varchar(3) NOT NULL,
  `BUSLICENSE` varchar(50) NOT NULL,
  `USERID` varchar(100) NOT NULL,
  PRIMARY KEY (`BUSID`),
  UNIQUE KEY `BUSID` (`BUSID`),
  KEY `USERID` (`USERID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`BUSID`, `BUSNAME`, `BUS_CLASS`, `NO_OF_SEAT`, `BUSLICENSE`, `USERID`) VALUES
('B-000001', 'mm', 'Royal Class', '43', 'asasas', 'U-000004');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `USERID` varchar(100) NOT NULL,
  `COMPANYNAME` varchar(30) NOT NULL,
  `ADDRESS` text NOT NULL,
  `PROFILE_IMAGE` varchar(255) NOT NULL,
  `SHORT_DESCRIPTION` tinytext,
  `ACCOUNT_DOB` date NOT NULL,
  `STATUS` varchar(100) NOT NULL,
  `ADMINID` varchar(10) NOT NULL,
  PRIMARY KEY (`USERID`),
  UNIQUE KEY `USERID` (`USERID`),
  KEY `ADMINID` (`ADMINID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`USERID`, `COMPANYNAME`, `ADDRESS`, `PROFILE_IMAGE`, `SHORT_DESCRIPTION`, `ACCOUNT_DOB`, `STATUS`, `ADMINID`) VALUES
('U-000003', 'adf', 'af', 'photo/company_images/180813050821_7.jpg', 'dfghj', '2018-08-11', 'Pending', 'AD-001'),
('U-000004', 'gggg', 'gggggggg', 'photo/company_images/180813050842_6.jpg', 'dsfghjkl', '2018-08-12', 'Approved', 'AD-001');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `CUSTOMER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CUSTOMER_NAME` varchar(40) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `PHONE` varchar(20) NOT NULL,
  `NRC` varchar(28) DEFAULT NULL,
  `REVIEW` tinytext,
  `GENDER` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`CUSTOMER_ID`),
  UNIQUE KEY `USERID` (`CUSTOMER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERID` varchar(20) NOT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `ISSUE` varchar(60) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `ADMIN_REMARK` text NOT NULL,
  `POST_DATE` date NOT NULL,
  `SOLVED_DATE` date DEFAULT NULL,
  `STATUS` varchar(15) NOT NULL,
  `ADMINID` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`ID`, `USERID`, `USER_NAME`, `ISSUE`, `DESCRIPTION`, `ADMIN_REMARK`, `POST_DATE`, `SOLVED_DATE`, `STATUS`, `ADMINID`) VALUES
(4, 'U-000001', 'sss', 'Updating', 'afas', 'h', '2018-08-12', '2018-08-15', 'Pending', 'AD-001'),
(5, 'U-000004', 'Tony Victor', 'Registration', 'ggg', 'Pending', '2018-08-15', NULL, 'Pending', '-');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `PAYMENTID` int(11) NOT NULL,
  `PAYMENT_TYPE` varchar(40) NOT NULL,
  `CARD_HOLDER` varchar(30) NOT NULL,
  `CARD_NUMBER` varchar(30) DEFAULT NULL,
  `EXPIRE_DATE` date NOT NULL,
  `CVV_NUMBER` int(11) NOT NULL,
  `TOTAL_PRICE` float DEFAULT NULL,
  `STATUS` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`PAYMENTID`),
  UNIQUE KEY `PAYMENTID` (`PAYMENTID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seat_detail`
--

CREATE TABLE IF NOT EXISTS `seat_detail` (
  `Seat_DetailID` int(11) NOT NULL AUTO_INCREMENT,
  `SEATID` varchar(4) NOT NULL,
  `BUSID` varchar(15) NOT NULL,
  `SEAT_STATUS` varchar(17) NOT NULL,
  PRIMARY KEY (`Seat_DetailID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tour_package`
--

CREATE TABLE IF NOT EXISTS `tour_package` (
  `TRIPID` varchar(50) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `TOUR_PLACES` tinytext,
  `HOTEL` varchar(50) NOT NULL,
  `OTHER_SERVICE` varchar(100) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`TRIPID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tour_package`
--

INSERT INTO `tour_package` (`TRIPID`, `DESCRIPTION`, `TOUR_PLACES`, `HOTEL`, `OTHER_SERVICE`, `photo1`, `photo2`, `photo3`, `photo4`) VALUES
('TP-0001', 'sadf', 'adfa', 'adf', 'ad', 'photo/tour_images/180815060858_974644436.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE IF NOT EXISTS `trip` (
  `TRIPID` varchar(50) NOT NULL,
  `ORIGIN` varchar(70) DEFAULT NULL,
  `DESTINATION` varchar(70) DEFAULT NULL,
  `TRIP_TYPE` varchar(30) NOT NULL,
  `DEPARTURE_DATE` date NOT NULL,
  `DEPARTURE_TIME` varchar(10) NOT NULL,
  `VENUE` varchar(60) DEFAULT NULL,
  `DURATION` varchar(10) DEFAULT NULL,
  `PRICE` float NOT NULL,
  `USERID` varchar(100) NOT NULL,
  PRIMARY KEY (`TRIPID`),
  KEY `USERID` (`USERID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`TRIPID`, `ORIGIN`, `DESTINATION`, `TRIP_TYPE`, `DEPARTURE_DATE`, `DEPARTURE_TIME`, `VENUE`, `DURATION`, `PRICE`, `USERID`) VALUES
('T-000001', 'aaaa', 'aaaa', 'Trip', '2018-07-04', '18:16:', 'ggg', '17 and 15', 0, 'U-000004'),
('TP-0001', 'as', 'adf', 'Tour', '2018-07-13', '2:10', 'adf', '2', 0, 'U-000004');

-- --------------------------------------------------------

--
-- Table structure for table `trip_details`
--

CREATE TABLE IF NOT EXISTS `trip_details` (
  `TRIPDETAILID` int(11) NOT NULL AUTO_INCREMENT,
  `BUSID` varchar(10) NOT NULL,
  `TRIPID` varchar(50) NOT NULL,
  PRIMARY KEY (`TRIPDETAILID`),
  UNIQUE KEY `TRIPDETAILID` (`TRIPDETAILID`),
  KEY `BUSID` (`BUSID`),
  KEY `TRIPID` (`TRIPID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USERID` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(25) NOT NULL,
  `PHONENO` varchar(20) NOT NULL,
  `ROLE` varchar(15) NOT NULL,
  `USERNAME` varchar(40) NOT NULL,
  PRIMARY KEY (`USERID`),
  UNIQUE KEY `USERID` (`USERID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USERID`, `EMAIL`, `PASSWORD`, `PHONENO`, `ROLE`, `USERNAME`) VALUES
('U-000003', 'ggg@gmail.com', 'ggg', '234567890', 'Company', 'dfg'),
('U-000004', 'aaa@gmail.com', 'aaa', '2345678', 'Company', 'gggg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`PAYMENTID`) REFERENCES `payment` (`PAYMENTID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`TRIPDETAILID`) REFERENCES `trip_details` (`TRIPDETAILID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `customer` (`CUSTOMER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `company` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_package`
--
ALTER TABLE `tour_package`
  ADD CONSTRAINT `tour_package_ibfk_1` FOREIGN KEY (`TRIPID`) REFERENCES `trip` (`TRIPID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `company` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip_details`
--
ALTER TABLE `trip_details`
  ADD CONSTRAINT `trip_details_ibfk_1` FOREIGN KEY (`BUSID`) REFERENCES `bus` (`BUSID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_details_ibfk_2` FOREIGN KEY (`TRIPID`) REFERENCES `trip` (`TRIPID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
