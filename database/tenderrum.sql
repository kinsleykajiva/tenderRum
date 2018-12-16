-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2018 at 02:03 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenderrum`
--
CREATE DATABASE IF NOT EXISTS `tenderrum` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tenderrum`;

-- --------------------------------------------------------

--
-- Table structure for table `acceptable_brands`
--
-- Creation: Dec 16, 2018 at 10:35 AM
--

DROP TABLE IF EXISTS `acceptable_brands`;
CREATE TABLE IF NOT EXISTS `acceptable_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `acceptable_brands`:
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--
-- Creation: Dec 16, 2018 at 10:47 AM
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `description` varchar(225) DEFAULT NULL,
  `company_category` int(11) NOT NULL,
  `address` varchar(211) DEFAULT NULL,
  `phone_contact` varchar(89) DEFAULT NULL,
  `email` varchar(99) DEFAULT NULL,
  `company_dob` date NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `companies`:
--

-- --------------------------------------------------------

--
-- Table structure for table `company_categories`
--
-- Creation: Dec 16, 2018 at 10:55 AM
--

DROP TABLE IF EXISTS `company_categories`;
CREATE TABLE IF NOT EXISTS `company_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `description` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `company_categories`:
--

-- --------------------------------------------------------

--
-- Table structure for table `tenders`
--
-- Creation: Dec 16, 2018 at 12:27 PM
--

DROP TABLE IF EXISTS `tenders`;
CREATE TABLE IF NOT EXISTS `tenders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tender_number` varchar(222) NOT NULL,
  `title` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `catagory` int(11) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tender_number_2` (`tender_number`),
  KEY `tender_number` (`tender_number`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tenders`:
--

-- --------------------------------------------------------

--
-- Table structure for table `tender_brands_correlations`
--
-- Creation: Dec 16, 2018 at 10:41 AM
--

DROP TABLE IF EXISTS `tender_brands_correlations`;
CREATE TABLE IF NOT EXISTS `tender_brands_correlations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tender_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `weight` float NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tender_brands_correlations`:
--

-- --------------------------------------------------------

--
-- Table structure for table `tender_categories`
--
-- Creation: Dec 16, 2018 at 10:32 AM
--

DROP TABLE IF EXISTS `tender_categories`;
CREATE TABLE IF NOT EXISTS `tender_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tender_categories`:
--

-- --------------------------------------------------------

--
-- Table structure for table `tender_proposal`
--
-- Creation: Dec 16, 2018 at 10:53 AM
--

DROP TABLE IF EXISTS `tender_proposal`;
CREATE TABLE IF NOT EXISTS `tender_proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tender_id` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `time_of_service_provision` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `warrantee_period` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `was-accepted` tinyint(1) NOT NULL DEFAULT '0',
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tender_proposal`:
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Dec 16, 2018 at 07:48 AM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `users`:
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
