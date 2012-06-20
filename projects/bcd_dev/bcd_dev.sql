-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2011 at 07:47 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bcd_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text,
  `cross_street` text,
  `neighborhood` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `frontage` int(11) DEFAULT NULL,
  `asking_rent` int(11) DEFAULT NULL,
  `asking_key` int(11) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `contact_company` varchar(255) DEFAULT NULL,
  `previous_use` text,
  `venting` tinyint(4) DEFAULT NULL,
  `venting_type` text,
  `additional_info` text,
  `delivery_date` text,
  `clients` text,
  `bcd_broker` varchar(255) DEFAULT NULL,
  `bcd_broker_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` VALUES(17, 'BCD Dev', '132 Address St.', 'Cross St.', 'Upper West Side', 3000, 3000, 3000, 3000, 'Contact Name', '412-322-3232', 'Company A', 'Restaurant', 1, 'Air', 'N/A', '2011-03-13', '[{"name":"Client1","date":"2011-03-22"},{"name":"Client2","date":"2011-03-22"},{"name":"Client3","date":"2011-03-22"},{"name":"Client4","date":"2011-03-22"}]', 'BCD Broker A', '2011-03-13');
