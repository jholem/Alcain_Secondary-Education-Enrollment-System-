-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2013 at 10:28 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Enrollment_System`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Password2` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`admin_id`, `Admin_username`, `Password`, `Password2`) VALUES
(2, 'alcain', 'joanne', 'joanne');

-- --------------------------------------------------------

--
-- Table structure for table `Registered_User`
--

CREATE TABLE IF NOT EXISTS `Registered_User` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Password2` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `Registered_User`
--

INSERT INTO `Registered_User` (`user_id`, `Username`, `Position`, `Section`, `Password`, `Password2`) VALUES
(1, 'joanne', '', '', 'ako', 'ako'),
(2, 'ako', 'ako', '', 'ako', 'ako'),
(3, '', '', '', '', ''),
(4, '', '', '', '', ''),
(5, '', '', '', '', ''),
(6, '', '', '', '', ''),
(7, '', '', '', '', ''),
(8, '', '', '', '', ''),
(9, '', '', '', '', ''),
(10, '', '', '', '', ''),
(11, '', '', '', '', ''),
(12, '', '', '', '', ''),
(13, '', '', '', '', ''),
(14, '', '', '', '', ''),
(15, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Security_Password`
--

CREATE TABLE IF NOT EXISTS `Security_Password` (
  `sec_id` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`sec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Security_Password`
--

INSERT INTO `Security_Password` (`sec_id`, `Password`) VALUES
(1, 'school');

-- --------------------------------------------------------

--
-- Table structure for table `Students_Profile`
--

CREATE TABLE IF NOT EXISTS `Students_Profile` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(50) NOT NULL,
  `Middlename` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Birthday` date NOT NULL,
  `Age` int(20) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Religion` varchar(50) NOT NULL,
  `Contact` int(50) NOT NULL,
  `Year_Class` varchar(50) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `Students_Profile`
--

INSERT INTO `Students_Profile` (`student_id`, `Firstname`, `Middlename`, `Lastname`, `Birthday`, `Age`, `Gender`, `Address`, `Religion`, `Contact`, `Year_Class`) VALUES
(11, 'joanne', 'abrillo', 'alcain', '1995-04-01', 6, 'girl', 'mayorga', 'catholic', 9154588, 'grade 7'),
(12, 'lemuel', 'selliza', 'lucanas', '1995-01-17', 17, 'male', 'palo daw', 'catholic', 123, 'grade 8'),
(13, 'ako', 'ako', 'kaokdfjlkj', '2020-12-12', 0, '', '', '', 0, 'grade 7');

-- --------------------------------------------------------

--
-- Table structure for table `Tuition_Fee`
--

CREATE TABLE IF NOT EXISTS `Tuition_Fee` (
  `fee_id` int(20) NOT NULL AUTO_INCREMENT,
  `student_id` int(50) NOT NULL,
  `Tuition_Fee` int(20) NOT NULL,
  `Payment` int(20) NOT NULL,
  `Remaining_Balance` int(20) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`fee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Tuition_Fee`
--

INSERT INTO `Tuition_Fee` (`fee_id`, `student_id`, `Tuition_Fee`, `Payment`, `Remaining_Balance`, `Date`) VALUES
(1, 2, 500, 300, 200, '0000-00-00'),
(3, 4, 500, 200, 300, '2012-12-12'),
(9, 10, 0, 0, 0, '0000-00-00'),
(10, 11, 500, 200, 300, '2012-04-05'),
(11, 12, 500, 200, 300, '2013-04-02'),
(12, 13, 0, 0, 0, '0000-00-00');
