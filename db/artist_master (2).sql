-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 01, 2018 at 10:42 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `creative_cafe`
--

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
  `country_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `pincode` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `artist_master`
--

INSERT INTO `artist_master` (`artist_id`, `first_name`, `last_name`, `art_category_id`, `mobile`, `email`, `password`, `country_id`, `state_id`, `city_id`, `pincode`, `status`) VALUES
(1, 'Tatooest', 'mk', 1, '7410546911', 'mansikachchhi171@gmail.com', '123', 1, 1, 1, 395006, 1),
(2, 'Mansudi', 'kachchhi', 2, '9874563210', 'mk.mk@gmail.com', '123', 2, 1, 1, 2589741, 1),
(3, 'Chakli', 'chiku', 3, '5789463210', 'chicu.chakli@gmail.com', '123', 3, 1, 1, 258741, 0),
(4, 'kagdi', 'koyal', 5, '9854763210', 'kinu.makadiya@gmail.com', '123', 5, 1, 1, 258746, 1),
(5, 'Manya', 'Sharma', 5, '8745693210', 'minu.minu123@gmail.com', '123', 5, 1, 1, 369874, 1);
