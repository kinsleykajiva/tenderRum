-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2019 at 03:34 PM
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
(1, 'HP', 'HP', '1,2', '2018-12-18 04:34:05', 0),
(2, 'Dell Inc.', 'Dell', '1', '2018-12-18 04:34:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `title`, `description`, `company_category`, `address`, `phone_contact`, `email`, `company_dob`, `isdeleted`, `date_created`) VALUES
(1, 'Local Tech', 'computer comp', 1, NULL, NULL, NULL, '1988-05-14', 0, '2018-12-16 20:36:26'),
(2, 'Fuser Tech', 'computer comp', 1, NULL, NULL, NULL, '1998-05-14', 0, '2018-12-16 20:37:02'),
(3, 'dfter', '', 1, 'dsfsdf', 'sdfsdf', 'eb@sdf.com', '2019-01-15', 0, '2019-01-04 15:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `company_categories`
--

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

CREATE TABLE IF NOT EXISTS `tenders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tender_number` varchar(222) NOT NULL,
  `title` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  `due_date` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `catagory` int(11) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tender_number_2` (`tender_number`),
  KEY `tender_number` (`tender_number`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`id`, `tender_number`, `title`, `description`, `date_created`, `due_date`, `created_by`, `catagory`, `isdeleted`) VALUES
(10, '34-JPYJU.E2AQ-38', 'Proviosn of computer mother boards', '<p><br></p><p><br></p><p>And<strong> i need to match the list of ids in table to to the id on table two. And i need to match the list of ids in ta</strong>ble to to the id on table two. And i need to match the list of ids in table to to the id on table two.</p>', '2019-01-05 15:52:20', '2019-03-28', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tender_brands_correlations`
--

CREATE TABLE IF NOT EXISTS `tender_brands_correlations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tender_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `weight` float NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender_brands_correlations`
--

INSERT INTO `tender_brands_correlations` (`id`, `tender_id`, `brand_id`, `weight`, `date_created`) VALUES
(1, 9, 3, 1, '2019-01-05 15:50:23'),
(2, 9, 4, 2, '2019-01-05 15:50:23'),
(3, 10, 3, 1, '2019-01-05 15:52:21'),
(4, 10, 4, 2, '2019-01-05 15:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `tender_categories`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender_proposal`
--

INSERT INTO `tender_proposal` (`id`, `tender_id`, `price`, `time_of_service_provision`, `company_id`, `warrantee_period`, `description`, `created_by`, `date_created`, `was_accepted`, `isdeleted`) VALUES
(21, 1, '2332423', 3, 1, 2, '<p>234324 w er we we <strong>werw er</strong></p><p>werwerwer   </p>', 1, '2018-12-30 12:04:25', 0, 0),
(22, 1, '565', 85, 1, 885, '<p>jghb v jh</p>', 2, '2018-12-30 12:18:40', 0, 0),
(23, 1, '2332423', 3, 1, 4, '<p>768</p>', 1, '2018-12-30 12:20:45', 0, 0),
(24, 1, '52', 352, 1, 5.4, '<p>counts are on tamnes jh jh cvf klfbh lsdjf lf lsjhf asnkvblsd slkjfb ;sjkf sd;fsui skhfgl fk</p>', 2, '2018-12-30 15:57:35', 0, 0),
(25, 1, '45566', 223, 1, 1.5, '<p>MHASGDC GVFKJSH KSDJ</p>', 1, '2018-12-30 16:02:17', 0, 0),
(26, 3, '433', 21, 1, 2, '<h1>l kjh ksjh dfkjdsfskljf ;kjcn; </h1><p><strong>sdijs f aosdf skjf pdsjf sldf jsfjssjsdfsdkj sfs</strong></p><p>fs sidfbsdbfskjffskfasdf</p><p>sdfhsdfsjbfasbf</p>', 1, '2019-01-01 12:45:59', 0, 0),
(27, 10, '3423', 654, 1, 2, '<p><br></p><p><br></p><p>And i need to match the list of ids in table to to the id on table two. And i need to match the list of ids in table to to the id on table two. And i need to match the list of ids in table to to the id on table two. </p><p><br></p><p>And i need to match the list of ids in table to to the id on table two. And i need to match the list of ids in table to to the id on table two. And i need to match the list of ids in table to to the id on table two.</p>', 1, '2019-01-05 15:54:51', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tender_proposal_brand_associated`
--

CREATE TABLE IF NOT EXISTS `tender_proposal_brand_associated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tender_id` int(11) NOT NULL,
  `tender_proposal_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender_proposal_brand_associated`
--

INSERT INTO `tender_proposal_brand_associated` (`id`, `tender_id`, `tender_proposal_id`, `brand_id`) VALUES
(7, 1, 21, 1),
(8, 1, 21, 2),
(9, 1, 22, 1),
(10, 1, 22, 2),
(11, 1, 23, 1),
(12, 1, 23, 2),
(13, 1, 24, 2),
(14, 1, 25, 2),
(15, 3, 26, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `date_created`) VALUES
(1, 'admin', 'qwerty', '2019-01-01 11:40:46'),
(2, 'wisdom', 'qwerty', '2019-01-01 11:40:46'),
(3, 'qw', 'sdf', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
