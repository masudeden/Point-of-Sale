-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2013 at 04:36 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `customers_x_page_x_permissions` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customers_x_page_x_permissions`
--

INSERT INTO `customers_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(5, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(6, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
