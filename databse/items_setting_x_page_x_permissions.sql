-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2013 at 10:15 AM
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
-- Table structure for table `purchase_oder_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `purchase_oder_x_page_x_permissions` (
  `id` varchar(50) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_oder_x_page_x_permissions`
--

INSERT INTO `brands_x_page_x_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
('9DEFBAF8-0199-4B0A-982B-F25BC9836B3E', 1111, 27, 3),
('2C7F286E-D9E4-4ADB-805C-26F964A1A3DA', 0, 28, 3),
('A45EDD70-12BE-4783-B864-5A812E64F16D', 0, 29, 3),
('5623D778-F78D-418B-A3EA-2C381CA9A1E1', 0, 30, 1),
('3BA1FA9A-1AD8-4214-BF39-50620CFA890E', 0, 31, 1),
('5BADAB20-F482-4C8E-9430-6E067507C82F', 0, 32, 2),
('0785F48B-EFC1-4B76-A4AE-4F4C2B69BD02', 0, 33, 4),
('F2CCBB99-1255-4003-B9C7-DABBA2A34722', 0, 34, 3),
('5D04C00D-8096-48E5-AA09-87E061FF6B21', 0, 35, 3),
('EFC870FD-4BFB-4D52-8DD8-8BB36CC9F481', 0, 36, 4),
('50D78D4A-7423-4CA5-8FBE-17D8D082570D', 0, 37, 2),
('3956E7D2-C6F6-422D-9632-D7E463959E4E', 0, 43, 13);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
