-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2017 at 03:17 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `creative_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE IF NOT EXISTS `admin_master` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`admin_id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `artist_master`
--

CREATE TABLE IF NOT EXISTS `artist_master` (
  `artist_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `art_category_id` int(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `country` int(10) NOT NULL,
  `state` int(10) NOT NULL,
  `city` int(10) NOT NULL,
  `pincode` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `artist_master`
--

INSERT INTO `artist_master` (`artist_id`, `first_name`, `last_name`, `art_category_id`, `mobile`, `email`, `password`, `country`, `state`, `city`, `pincode`, `status`) VALUES
(1, 'Tatooest', 'mk', 1, '7410546911', 'mansikachchhi171@gmail.com', '123', 1, 1, 1, 395006, 1),
(2, 'Mansudi', 'kachchhi', 2, '9874563210', 'mk.mk@gmail.com', '123', 2, 1, 1, 2589741, 1),
(3, 'Chakli', 'chiku', 3, '5789463210', 'chicu.chakli@gmail.com', '123', 3, 1, 1, 258741, 0),
(4, 'kagdi', 'koyal', 5, '9854763210', 'kinu.makadiya@gmail.com', '123', 5, 1, 1, 258746, 1),
(5, 'Manya', 'Sharma', 5, '8745693210', 'minu.minu123@gmail.com', '123', 5, 1, 1, 369874, 1);

-- --------------------------------------------------------

--
-- Table structure for table `art_category_master`
--

CREATE TABLE IF NOT EXISTS `art_category_master` (
  `art_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `art_category_name` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`art_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `art_category_master`
--

INSERT INTO `art_category_master` (`art_category_id`, `art_category_name`, `status`) VALUES
(3, 'prints', 1),
(6, 'wood print', 0),
(8, 'qwertyui', 1),
(18, 'Tatoo123', 0),
(20, 'metallllll', 0);

-- --------------------------------------------------------

--
-- Table structure for table `city_master`
--

CREATE TABLE IF NOT EXISTS `city_master` (
  `city_id` int(10) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `city_master`
--

INSERT INTO `city_master` (`city_id`, `country_id`, `state_id`, `city_name`, `status`) VALUES
(2, 1, 2, 'mumbai', 1),
(3, 2, 1, 'aakkkiii', 1),
(4, 3, 1, 'lockargil', 0),
(5, 5, 1, 'akala', 0),
(6, 1, 2, 'changa', 1),
(7, 1, 1, 'surat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment_master`
--

CREATE TABLE IF NOT EXISTS `comment_master` (
  `comment_id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country_master`
--

CREATE TABLE IF NOT EXISTS `country_master` (
  `country_id` int(10) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(20) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `country_master`
--

INSERT INTO `country_master` (`country_id`, `country_name`, `status`) VALUES
(1, 'india123', 1),
(2, 'nepal', 0),
(4, 'bhutan', 1),
(5, 'sri lanka', 0),
(7, 'test123', 1),
(10, 'usa', 1),
(15, 'minakshi', 0),
(18, 'Zafrabad...', 0),
(19, '12345678', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news_event_master`
--

CREATE TABLE IF NOT EXISTS `news_event_master` (
  `news_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `message` varchar(300) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `state_master`
--

CREATE TABLE IF NOT EXISTS `state_master` (
  `state_id` int(10) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) NOT NULL,
  `state_name` varchar(40) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `state_master`
--

INSERT INTO `state_master` (`state_id`, `country_id`, `state_name`, `status`) VALUES
(1, 1, 'Gujarat', 1),
(2, 2, 'islam', 0),
(3, 3, 'nhutuuuu', 1),
(7, 1, 'goa123', 1),
(8, 10, 'usa123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `country_id` varchar(10) NOT NULL,
  `state_id` varchar(10) NOT NULL,
  `city_id` varchar(10) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `first_name`, `last_name`, `country_id`, `state_id`, `city_id`, `pincode`, `email`, `mobile`, `password`, `status`) VALUES
(3, 'mansi', 'kachchhi', 'india', 'gujarat', 'surat', '395006', 'mansikachchhi171@gmail.com', '7405469477', '123', 1),
(6, 'Mishti', 'Khanna', 'india', 'goa', 'goa', '874562', 'minu.mk@gmail.com', '5874123690', '123', 0),
(7, 'Anvesha', 'Khurana', 'nepal', 'neno', 'newnu', '412365', 'avi.avi@gmail.com', '9877563210', '123', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
