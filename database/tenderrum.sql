-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2018 at 11:09 AM
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
-- Creation: Dec 18, 2018 at 02:48 AM
--

DROP TABLE IF EXISTS `acceptable_brands`;
CREATE TABLE IF NOT EXISTS `acceptable_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `description` text NOT NULL,
  `assoc_catagory_tags` varchar(222) DEFAULT NULL COMMENT 'to have tags like 1,2,3',
  `date_created` datetime NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acceptable_brands`
--

INSERT INTO `acceptable_brands` (`id`, `title`, `description`, `assoc_catagory_tags`, `date_created`, `isdeleted`) VALUES
(1, 'HP', 'HP', NULL, '2018-12-18 04:34:05', 0),
(2, 'Dell Inc.', 'Dell', NULL, '2018-12-18 04:34:41', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `title`, `description`, `company_category`, `address`, `phone_contact`, `email`, `company_dob`, `isdeleted`, `date_created`) VALUES
(1, 'Local Tech', 'computer comp', 1, NULL, NULL, NULL, '1988-05-14', 0, '2018-12-16 20:36:26'),
(2, 'Fuser Tech', 'computer comp', 1, NULL, NULL, NULL, '1998-05-14', 0, '2018-12-16 20:37:02');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_categories`
--

INSERT INTO `company_categories` (`id`, `title`, `description`) VALUES
(1, 'I.T', 'computers , software'),
(2, 'XeRox', 'statitionary');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`id`, `tender_number`, `title`, `description`, `date_created`, `created_by`, `catagory`, `isdeleted`) VALUES
(1, '13-BGP7U.VK9-1', '544', '<p>zs das</p>', '2018-12-18 10:08:29', 1, 2, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender_brands_correlations`
--

INSERT INTO `tender_brands_correlations` (`id`, `tender_id`, `brand_id`, `weight`, `date_created`) VALUES
(1, 1, 1, 5, '2018-12-18 10:08:29'),
(2, 1, 2, 3, '2018-12-18 10:08:29');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender_categories`
--

INSERT INTO `tender_categories` (`id`, `title`, `description`) VALUES
(1, 'I.T', 'I.T'),
(2, 'Furnitures', 'Furnitures '),
(3, 'Clothing', '.'),
(4, 'Hardware', '.. ');

-- --------------------------------------------------------

--
-- Table structure for table `tender_proposal`
--
-- Creation: Dec 30, 2018 at 09:53 AM
--

DROP TABLE IF EXISTS `tender_proposal`;
CREATE TABLE IF NOT EXISTS `tender_proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tender_id` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `time_of_service_provision` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `warrantee_period` float NOT NULL,
  `description` text,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `was_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender_proposal`
--

INSERT INTO `tender_proposal` (`id`, `tender_id`, `price`, `time_of_service_provision`, `company_id`, `warrantee_period`, `description`, `created_by`, `date_created`, `was_accepted`, `isdeleted`) VALUES
(21, 1, '2332423', 3, 1, 2, '<p>234324 w er we we <strong>werw er</strong></p><p>werwerwer   </p>', 1, '2018-12-30 12:04:25', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tender_proposal_brand_associated`
--
-- Creation: Dec 30, 2018 at 10:01 AM
--

DROP TABLE IF EXISTS `tender_proposal_brand_associated`;
CREATE TABLE IF NOT EXISTS `tender_proposal_brand_associated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tender_id` int(11) NOT NULL,
  `tender_proposal_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender_proposal_brand_associated`
--

INSERT INTO `tender_proposal_brand_associated` (`id`, `tender_id`, `tender_proposal_id`, `brand_id`) VALUES
(7, 1, 21, 1),
(8, 1, 21, 2);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
