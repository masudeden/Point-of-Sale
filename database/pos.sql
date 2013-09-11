-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2013 at 01:51 PM
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
-- Table structure for table `branchci_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `branchci_x_page_x_permissions` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` varchar(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `branchci_x_page_x_permissions`
--

INSERT INTO `branchci_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(3, '', '0', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(4, '', '0', '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(5, '', '0', '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(6, '', '0', '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', '1111', '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE IF NOT EXISTS `branchs` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `store_city` varchar(50) NOT NULL,
  `store_state` varchar(50) NOT NULL,
  `store_zip` varchar(40) NOT NULL,
  `store_country` varchar(50) NOT NULL,
  `store_website` varchar(30) NOT NULL,
  `store_phone` varchar(15) NOT NULL,
  `store_email` varchar(100) NOT NULL,
  `store_fax` varchar(100) NOT NULL,
  `store_tax1` varchar(100) NOT NULL,
  `store_tax2` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `branchs`
--

INSERT INTO `branchs` (`id`, `guid`, `store_name`, `store_city`, `store_state`, `store_zip`, `store_country`, `store_website`, `store_phone`, `store_email`, `store_fax`, `store_tax1`, `store_tax2`, `active_status`, `delete_status`, `deleted_by`) VALUES
(1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'PIZZA HUT', '', '', '', '', '', '', '', '', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `branchs_x_payment_modes`
--

CREATE TABLE IF NOT EXISTS `branchs_x_payment_modes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` varchar(100) NOT NULL,
  `pay_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `guid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(100) NOT NULL,
  `deleted_by` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `guid`, `name`, `branch_id`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'cfd8b485f99e561408192c594f8c2e92', 'LG', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, 61, 61),
(2, '1642d900f6768119e3dd75bbf8ed0fc2', 'Nokia', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, 0, 61),
(3, '11d08dc2db3920364304c6ed1192b5ba', 'THOSHIBA', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, 0, 0),
(4, '0a1db6b7e58b53971b12790f10e27d60', 'Samsung', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `brands_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `brands_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `brands_x_page_x_permissions`
--

INSERT INTO `brands_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(7, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 1, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(11, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `title` varchar(10) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `bday` int(20) NOT NULL,
  `mday` int(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `credit_limit` int(100) NOT NULL,
  `cdays` int(100) NOT NULL,
  `month_credit_bal` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_location` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `cst` varchar(50) NOT NULL,
  `gst` varchar(50) NOT NULL,
  `tax_no` varchar(50) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `guid`, `branch_id`, `first_name`, `title`, `last_name`, `address1`, `address2`, `bday`, `mday`, `city`, `state`, `zip`, `country`, `payment`, `credit_limit`, `cdays`, `month_credit_bal`, `category_id`, `comments`, `company_name`, `email`, `phone`, `account_number`, `bank_name`, `bank_location`, `website`, `cst`, `gst`, `tax_no`, `active`, `created_by`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'ut7utuy', '', '', '', '', '', '', 0, 0, '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, '', ''),
(2, 'rb6tser6nb5er6n5b5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'jibi', 'Mr', 'gopi', '', '', 0, 0, '', '', '', '', '2', 0, 0, '0', '1', '', '', 'jibi344443@yahoo.com', '', '', '', '', '', '', '', '', 1, 0, 0, 0, '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(3, '0f7c80352b128f9a45d25e42d1ebd19e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'jibi', 'Mr', 'gopi', '', '', 0, 0, '', '', '', '', '2', 0, 0, '0', '1', '', '', 'jibi344443@yahoo.com', '', '', '', '', '', '', '', '', 1, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, '28e0bbea4b74ebc7dd397327ef8acd0c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'jibi', 'Mr', 'gopi', '', '', 0, 0, '', '', '', '', '2', 0, 0, '0', '1', '', '', 'jibi344443@yahoo.com', '', '', '', '', '', '', '', '', 1, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '315e6ee6f50a8fdfa949fdcf8918afb1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'jibi', 'Mr', 'gopi', '', '', 0, 0, 'yuiyui', 'oiuoi', '', '', '2', 0, 0, '0', '2', '', '', 'jibi344443@yahoo.com', '', '', '', '', '', '', '', '', 1, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `customers_payment_type`
--

CREATE TABLE IF NOT EXISTS `customers_payment_type` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customers_payment_type`
--

INSERT INTO `customers_payment_type` (`id`, `guid`, `type`, `branch_id`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'C56A2A7E-E8DE-43FD-BF05-1970CE5EC269', 'credit', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 1, 0, '', ''),
(2, '2639721dea1f5cd1c5557f41b4e65d46', 'Credit Only', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '', ''),
(3, '493fc9015775b69fb7b0c549a03cfc8a', 'cheques', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers_payment_type_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `customers_payment_type_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `permission` int(100) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers_x_branchs`
--

CREATE TABLE IF NOT EXISTS `customers_x_branchs` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `customer_active` int(11) NOT NULL,
  `customer_delete` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `customer_category`
--

CREATE TABLE IF NOT EXISTS `customer_category` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer_category`
--

INSERT INTO `customer_category` (`id`, `guid`, `branch_id`, `category_name`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '7879977979777987', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C-123', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, 'b07822de514011f2e7ffc12692033acb', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C-1233', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `customer_category_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `customer_category_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customer_category_x_page_x_permissions`
--

INSERT INTO `customer_category_x_page_x_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(5, 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(6, 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `cost_price` varchar(50) NOT NULL,
  `mrp` varchar(50) NOT NULL,
  `tax_Inclusive` int(11) NOT NULL,
  `brand_id` varchar(100) NOT NULL,
  `item_type_id` varchar(100) NOT NULL,
  `selling_price` varchar(100) NOT NULL,
  `discount_amount` varchar(50) NOT NULL,
  `start_date` varchar(25) NOT NULL,
  `end_date` varchar(25) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `tax_area_id` varchar(100) NOT NULL,
  `upc_ean_code` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `code_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `guid`, `code`, `barcode`, `category_id`, `branch_id`, `supplier_id`, `name`, `description`, `cost_price`, `mrp`, `tax_Inclusive`, `brand_id`, `item_type_id`, `selling_price`, `discount_amount`, `start_date`, `end_date`, `tax_id`, `tax_area_id`, `upc_ean_code`, `location`, `deleted_by`, `active`, `active_status`, `delete_status`, `added_by`, `code_status`) VALUES
(8, 'c3216f7d74d4adcf50901b8559d9a3bc', 'IC-123', 'Bar-1990', '0f1208f8b8d972183bb16bb0443ddb5e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 1', 'hjkhkhk', '45', '70', 0, 'cfd8b485f99e561408192c594f8c2e92', '', '60', '', '1372723200', '1375228800', '2ba78d7500ac92e84953cbe019741703', '2d81a2d79b828aa9e3d109184961925a', 'IBV8987987987987900', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0),
(9, 'abc049b9d095c27843b114f02ac5f640', 'IC-122', 'Bar-1991', '0f1208f8b8d972183bb16bb0443ddb5e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 2', 'dshdjhsf', '56', '78', 0, '0a1db6b7e58b53971b12790f10e27d60', '', '75', '', '1373500800', '1374883200', '2ba78d7500ac92e84953cbe019741703', '2d81a2d79b828aa9e3d109184961925a', 'IBVGGF879879879', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0),
(10, 'abyyc049b9d095c27843b114f02ac5f640', 'IC-124', 'Bar-1991', '0f1208f8b8d972183bb16bb0443ddb5e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 2', 'dshdjhsf', '56', '78', 0, '1642d900f6768119e3dd75bbf8ed0fc2', '', '75', '', '1373500800', '1374883200', '2ba78d7500ac92e84953cbe019741703', '2d81a2d79b828aa9e3d109184961925a', 'IBVGGF879879879', '', '', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0),
(11, 'ef92a1dc9701ac89a655927183a78d87', 'IC-126', '', '0f1208f8b8d972183bb16bb0443ddb5e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7988d76f85fb01646eb9d9b01530c460', 'Item 4', '87987', '12', '16', 0, '11d08dc2db3920364304c6ed1192b5ba', '', '15', '', '0', '0', '2ba78d7500ac92e84953cbe019741703', '2d81a2d79b828aa9e3d109184961925a', '', '', '', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0),
(12, '23b6fb71c13f7a53235835584c0a600f', 'IC-  127', '', '0f1208f8b8d972183bb16bb0443ddb5e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'Item 5', 'dsafdgs', '45', '49', 0, '1642d900f6768119e3dd75bbf8ed0fc2', '', '48', '', '0', '0', '2ba78d7500ac92e84953cbe019741703', '2d81a2d79b828aa9e3d109184961925a', '', '', '', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0),
(13, 'bbd6c9542b588e703bf706c30e204777', 'IC-128', '', '0f1208f8b8d972183bb16bb0443ddb5e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 9', '', '56', '59', 0, 'cfd8b485f99e561408192c594f8c2e92', '', '58', '', '0', '0', '2ba78d7500ac92e84953cbe019741703', '2d81a2d79b828aa9e3d109184961925a', '', '', '', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0),
(14, 'c709663a0324fb6175b807eb730de052', 'IC-129', '', '0f1208f8b8d972183bb16bb0443ddb5e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'Item 12', '', '12', '34', 1, 'cfd8b485f99e561408192c594f8c2e92', '', '30', '', '0', '0', '2ba78d7500ac92e84953cbe019741703', '2d81a2d79b828aa9e3d109184961925a', '', '', '', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items_category`
--

CREATE TABLE IF NOT EXISTS `items_category` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `items_category`
--

INSERT INTO `items_category` (`id`, `guid`, `category_name`, `branch_id`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '0f1208f8b8d972183bb16bb0443ddb5e', 'ball', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(2, '4a70944370a2a575487e2ad0a5adae9d', 'pen', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, '44490e4607304eaaf6f9acaf170ff290', 'book', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, '37bc41880fa0ca0de0fa2e9f37480ba0', 'Goodnight', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '7d964715c57d2df50df0a9d380c9da22', 'vicks', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(6, '5c3437e9dedbcacead642b41b4a1f214', 'weakily', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '544f4c88a4008a5e58fc3fe5104afea9', 'Box', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, 'f1cbc6905e17586f09094db931bcf75e', 'soap', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(9, '981cbacdb1bd664698bf1803878909b6', 'CD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(10, '402581a70ab59a35c0393cf2310b6f88', 'DVD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(11, '24f1b9183166e5a887c2f882a00dd529', 'sasi12', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `items_category_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `items_category_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `items_category_x_page_x_permissions`
--

INSERT INTO `items_category_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(6, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `items_kits_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `items_kits_x_page_x_permissions` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items_setting`
--

CREATE TABLE IF NOT EXISTS `items_setting` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `min_q` varchar(50) NOT NULL,
  `max_q` varchar(50) NOT NULL,
  `sales` int(11) NOT NULL,
  `purchase` int(11) NOT NULL,
  `salses_return` int(11) NOT NULL,
  `purchase_return` int(11) NOT NULL,
  `allow_negative` int(11) NOT NULL,
  `tax_inclusive` int(11) NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `set` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `items_setting`
--

INSERT INTO `items_setting` (`id`, `guid`, `item_id`, `branch_id`, `min_q`, `max_q`, `sales`, `purchase`, `salses_return`, `purchase_return`, `allow_negative`, `tax_inclusive`, `updated_by`, `set`, `added_by`, `active`, `delete_status`, `active_status`) VALUES
(8, '8fd2f0b26e43692112039645d71f1577', 'c3216f7d74d4adcf50901b8559d9a3bc', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '0', '1000', 1, 1, 1, 1, 1, 1, '', 1, '', 0, 1, 1),
(9, '44d9cc0a561f2bd92a2a21e64d5c3c87', 'abc049b9d095c27843b114f02ac5f640', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '10', '10000', 1, 1, 1, 1, 1, 0, '', 1, '', 0, 1, 1),
(10, '467eba091599ff4e3b669dfd7c36f15e', 'ef92a1dc9701ac89a655927183a78d87', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 0, 0, 0, 0, 0, '', 0, '', 0, 0, 0),
(11, '854e42db7afcc7526ae3356c86f6b571', '23b6fb71c13f7a53235835584c0a600f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 0, 0, 0, 0, 0, '', 0, '', 0, 0, 0),
(12, '467eba091599ff4e3b6699fd7c36f15e', 'abyyc049b9d095c27843b114f02ac5f640', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 0, 0, 0, 0, 0, '', 0, '', 0, 0, 0),
(13, '86b3c04f58ec4a778f284a3e13e28a2b', 'bbd6c9542b588e703bf706c30e204777', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 0, 0, 0, 0, 0, '', 0, '', 0, 0, 0),
(14, '8f28441d473f1b088b4688ed4ceb4f69', 'c709663a0324fb6175b807eb730de052', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 0, 0, 0, 0, 0, '', 0, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items_setting_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `items_setting_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `items_setting_x_page_x_permissions`
--

INSERT INTO `items_setting_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(7, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(11, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `items_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `items_x_page_x_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` varchar(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `items_x_page_x_permissions`
--

INSERT INTO `items_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(6, '', '0', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', '0', '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', '0', '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', '0', '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', '1111', '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `item_code_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `item_code_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `item_code_x_page_x_permissions`
--

INSERT INTO `item_code_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(7, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(11, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `item_upc_ean_code`
--

CREATE TABLE IF NOT EXISTS `item_upc_ean_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `code` varchar(200) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `module_name` varchar(200) NOT NULL,
  `added_date` int(20) NOT NULL,
  `deleted_date` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `guid`, `module_name`, `added_date`, `deleted_date`, `added_by`, `deleted_by`, `active_status`, `delete_status`) VALUES
(1, '80B0F0FD-B148-4C02-AFC7-7463D856714A', 'items', 0, 0, '102', '0', 0, 0),
(2, '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 'users', 0, 0, '102', '0', 0, 0),
(3, 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 'brands', 0, 0, '102', '0', 0, 0),
(4, '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 'items_setting', 102, 0, '0', '0', 0, 0),
(5, '60715722-A689-412B-A13F-ECA29FF19523', 'item_code', 102, 0, '0', '0', 0, 0),
(6, 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 'taxes', 102, 0, '0', '0', 0, 0),
(7, 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 'tax_commodity', 102, 0, '0', '0', 0, 0),
(8, 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 'items_category', 102, 0, '0', '0', 0, 0),
(9, 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 'tax_types', 102, 0, '0', '0', 0, 0),
(10, 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 'taxes_area', 102, 0, '0', '0', 0, 0),
(11, 'D33AF5EF-570D-403D-B967-A5B658675B06', 'suppliers', 102, 0, '0', '0', 0, 0),
(12, '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 'suppliers_x_items', 102, 0, '0', '0', 0, 0),
(13, '5464B2EF-92D2-4430-B366-983D7590FFC4', 'customers', 102, 0, '0', '0', 0, 0),
(14, '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 'customer_category', 102, 0, '0', '0', 0, 0),
(15, 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 'user_groupsci', 102, 0, '0', '0', 0, 0),
(16, '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 'branchCI', 102, 0, '0', '0', 0, 0),
(17, '6D825F4C-44E0-4CF4-8FD2-A5FEA57E8FC1', 'purchase_order', 102, 0, '0', '0', 0, 0),
(18, 'B299A7BB-7709-4B0B-966E-023F1CA77058', 'customers_payment_type', 102, 0, '0', '0', 0, 0),
(19, 'B499A7BB-8709-4B0B-966E-023F1CA77058', 'purchase_order', 102, 0, '0', '0', 0, 0),
(20, 'B499A7BB-7709-4B0B-966E-023F1CA77057', 'purchase_invoice', 102, 0, '0', '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `modules_x_branchs`
--

CREATE TABLE IF NOT EXISTS `modules_x_branchs` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `module_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `modules_x_branchs`
--

INSERT INTO `modules_x_branchs` (`id`, `guid`, `branch_id`, `module_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 0, 0, '0', '0'),
(2, 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 0, 0, '0', '0'),
(3, '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 0, 0, '0', '0'),
(4, '60715722-A689-412B-A13F-ECA29FF19523', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '60715722-A689-412B-A13F-ECA29FF19523', 0, 0, '0', '0'),
(5, 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 0, 0, '0', '0'),
(6, 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 0, 0, '0', '0'),
(7, 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 0, 0, '0', '0'),
(8, 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 0, 0, '0', '0'),
(9, 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 0, 0, '0', '0'),
(10, '80B0F0FD-B148-4C02-AFC7-7463D856714A', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 0, 0, '0', '0'),
(11, '80B0F0FD-B148-4C02-AFC7-7463D856714A', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '80B0F0FD-B148-4C02-AFC7-7463D856714Ass', 0, 0, '0', '0'),
(12, 'D33AF5EF-570D-403D-B967-A5B658675B06', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'D33AF5EF-570D-403D-B967-A5B658675B06', 0, 0, '0', '0'),
(13, '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 0, 0, '0', '0'),
(14, '5464B2EF-92D2-4430-B366-983D7590FFC4', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '5464B2EF-92D2-4430-B366-983D7590FFC4', 0, 0, '0', '0'),
(15, '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 0, 0, '0', '0'),
(16, 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 0, 0, '0', '0'),
(17, '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 0, 0, '0', '0'),
(18, 'B299A7BB-7709-4B0B-966E-023F1CA77058', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 0, 0, '0', '0'),
(19, 'B499A7BB-8709-4B0B-966E-023F1CA77058', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 0, 0, '0', '0'),
(20, 'B499A7BB-7709-4B0B-966E-023F1CA77057', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 0, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice`
--

CREATE TABLE IF NOT EXISTS `purchase_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `supplier_id` varchar(200) NOT NULL,
  `exp_date` int(20) NOT NULL,
  `po_no` varchar(200) NOT NULL,
  `po_date` int(20) NOT NULL,
  `discount` varchar(200) NOT NULL,
  `discount_amt` varchar(200) NOT NULL,
  `freight` varchar(200) NOT NULL,
  `round_amt` varchar(200) NOT NULL,
  `total_items` varchar(200) NOT NULL,
  `total_amt` varchar(200) NOT NULL,
  `total_item_amt` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `active` int(11) NOT NULL,
  `order_cancel` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `deleted_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `purchase_invoice`
--

INSERT INTO `purchase_invoice` (`id`, `guid`, `supplier_id`, `exp_date`, `po_no`, `po_date`, `discount`, `discount_amt`, `freight`, `round_amt`, `total_items`, `total_amt`, `total_item_amt`, `remark`, `note`, `active`, `order_cancel`, `active_status`, `delete_status`, `order_status`, `branch_id`, `added_by`, `deleted_by`) VALUES
(5, '44079c190e0e5b662592f13ad36abfaa', '2a4e7a8de41c967c9097b2e4a1a0e662', 1365465600, 'PO-No123', 1365465600, '10', '54.9', '100', '100', '3', '694.1', '549', 'nothing is importent', 'sfaasf', 0, 0, 0, 0, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `purchase_invoice_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `purchase_invoice_x_page_x_permissions`
--

INSERT INTO `purchase_invoice_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(3, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(4, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(5, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(6, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `supplier_id` varchar(200) NOT NULL,
  `exp_date` int(20) NOT NULL,
  `po_no` varchar(200) NOT NULL,
  `po_date` int(20) NOT NULL,
  `discount` varchar(200) NOT NULL,
  `discount_amt` varchar(200) NOT NULL,
  `freight` varchar(200) NOT NULL,
  `round_amt` varchar(200) NOT NULL,
  `total_items` varchar(200) NOT NULL,
  `total_amt` varchar(200) NOT NULL,
  `total_item_amt` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `active` int(11) NOT NULL,
  `order_cancel` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `deleted_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `guid`, `supplier_id`, `exp_date`, `po_no`, `po_date`, `discount`, `discount_amt`, `freight`, `round_amt`, `total_items`, `total_amt`, `total_item_amt`, `remark`, `note`, `active`, `order_cancel`, `active_status`, `delete_status`, `order_status`, `branch_id`, `added_by`, `deleted_by`) VALUES
(5, '44079c190e0e5b662592f13ad36abfaa', '2a4e7a8de41c967c9097b2e4a1a0e662', 1365465600, 'PO-No123', 1365465600, '10', '54.9', '100', '100', '3', '694.1', '549', 'nothing is importent', 'sfaasf', 0, 0, 0, 0, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE IF NOT EXISTS `purchase_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `order_id` varchar(200) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `sell` varchar(100) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` int(39) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `deleted_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `guid`, `order_id`, `branch_id`, `item`, `quty`, `cost`, `sell`, `mrp`, `amount`, `date`, `active`, `active_status`, `delete_status`, `deleted_by`) VALUES
(69, '9f67543a5e32c6b253044d09cb31731d', '44079c190e0e5b662592f13ad36abfaa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '23b6fb71c13f7a53235835584c0a600f', '1', '45', '48', '49', '45', 0, 0, 1, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(70, '9f67543a5e32c6b253044d09cb31731d', '44079c190e0e5b662592f13ad36abfaa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'abc049b9d095c27843b114f02ac5f640', '1', '56', '75', '78', '56', 0, 0, 1, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(71, '9f67543a5e32c6b253044d09cb31731d', '44079c190e0e5b662592f13ad36abfaa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'abyyc049b9d095c27843b114f02ac5f640', '8', '56', '75', '78', '448', 0, 0, 1, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(72, '9f67543a5e32c6b253044d09cb31731d', '44079c190e0e5b662592f13ad36abfaa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '23b6fb71c13f7a53235835584c0a600f', '1', '45', '48', '49', '45', 0, 0, 0, 0, ''),
(73, '9f67543a5e32c6b253044d09cb31731d', '44079c190e0e5b662592f13ad36abfaa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'abc049b9d095c27843b114f02ac5f640', '1', '56', '75', '78', '56', 0, 0, 0, 0, ''),
(74, '9f67543a5e32c6b253044d09cb31731d', '44079c190e0e5b662592f13ad36abfaa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'abyyc049b9d095c27843b114f02ac5f640', '8', '56', '75', '78', '448', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `purchase_order_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `purchase_order_x_page_x_permissions`
--

INSERT INTO `purchase_order_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(3, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(4, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(5, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(6, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `sales_x_page_x_permission`
--

CREATE TABLE IF NOT EXISTS `sales_x_page_x_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `department`, `branch`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `item_active` int(11) NOT NULL,
  `item_delete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `guid`, `branch_id`, `branch_name`, `item_id`, `price`, `stock`, `active_status`, `delete_status`, `item_active`, `item_delete`) VALUES
(14, '', '3', 'Mcdonalds', '21', '12', '91', 0, 0, 0, 0),
(15, '', '3', 'Mcdonalds', '22', '20', '200', 0, 0, 0, 0),
(16, '', '3', 'Mcdonalds', '23', '14', '20', 0, 0, 0, 0),
(17, '', '3', 'Mcdonalds', '24', '25', '30', 0, 0, 0, 0),
(18, '', '3', 'Mcdonalds', '25', '20', '100', 0, 0, 0, 0),
(19, '', '3', 'Mcdonalds', '26', '28', '1000', 0, 0, 0, 0),
(20, '', '3', 'Mcdonalds', '27', '10', '2', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stocks_history`
--

CREATE TABLE IF NOT EXISTS `stocks_history` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `Quantity` varchar(100) NOT NULL,
  `date` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `stocks_history`
--

INSERT INTO `stocks_history` (`id`, `guid`, `branch_id`, `branch_name`, `item_id`, `category_id`, `supplier_id`, `added_by`, `cost`, `stock`, `price`, `Quantity`, `date`) VALUES
(5, '', '3', 'Mcdonalds', '21', '3', '8', '102', '10', '1000', '12', '12', '1369612800'),
(6, '', '3', 'Mcdonalds', '22', '3', '8', '102', '15', '2000', '20', '1', '1369612800'),
(7, '', '3', 'Mcdonalds', '23', '3', '8', '102', '11', '20', '14', '1', '1369612800'),
(8, '', '3', 'Mcdonalds', '24', '3', '8', '102', '21', '30', '25', '1', '1369612800'),
(9, '', '3', 'Mcdonalds', '25', '3', '8', '102', '18', '100', '20', '1', '1369612800'),
(10, '', '3', 'Mcdonalds', '26', '3', '8', '102', '26', '1000', '28', '2', '1369612800'),
(11, '', '3', 'Mcdonalds', '27', '3', '8', '102', '6', '2', '10', '1', '1369612800');

-- --------------------------------------------------------

--
-- Table structure for table `stock_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `stock_x_page_x_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `guid`, `company_name`, `first_name`, `last_name`, `email`, `phone`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `comments`, `account_number`, `active`, `active_status`, `delete_status`, `deleted_by`, `website`, `branch_id`, `added_by`) VALUES
(1, 'ceab8c7d14f12aaeec1dc19b3d81212a', 'JK', 'Jayesh1', 'gopi', 'julibeth34@yahoo.in', '7795390584', 'ewrter', 'wertwe', 'ewrtwe', 'reter', 'rterter', 'rtertre', 'sdfsdfsd', 'ew43643', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'sfgedtrere', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, '7988d76f85fb01646eb9d9b01530c460', 'iouoi', 'Manu', 'km', 'jibi@pluskb.com', '7795398584', 'hjhk', 'uyiuyi', 'iuyiuyi', 'iyiuyi', 'iyiuy', 'iiuyiuy', 'uouu', 'uoiuo', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'oiuoiu', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(3, 'c76d55c21f9d4f577b26fba515a8066f', 'uytuy', 'Nijan', 'xjhk', 'jhkjhj@kjhkj.com', '7878797989', 'yiuy', 'iyiuy', 'iuyiuy', 'iuyiuy', 'iyiuy', 'iuyi', 'tutuyt', 'uytuy', 0, 0, 0, '', 'tuytuy', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(4, '6148f274388f64b43123c3598c3fcf81', 'yutu', 'Kiran', 'yutuy', 'ytghgu@jkjkl.com', '878687687', 'tuyt', 'uytuyt', 'uytuytuy', 'tuytu', 'yuytuytu', 'uytuyt', 'uytuy', 'uytuyt', 0, 0, 0, '', 'uytu', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(5, '2a4e7a8de41c967c9097b2e4a1a0e662', 'Champ', 'kumar', 'sasi', 'jibi007@gmail.com', '7795398500', '', '', '', '', '', '', '', '', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_x_branchs`
--

CREATE TABLE IF NOT EXISTS `suppliers_x_branchs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `supplier_active` int(11) NOT NULL,
  `supplier_delete` int(11) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `item_status` int(11) NOT NULL,
  `item_delete` int(11) NOT NULL,
  `item_deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_x_items`
--

CREATE TABLE IF NOT EXISTS `suppliers_x_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `quty` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `item_active` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `deactive_item` int(11) NOT NULL,
  `item_delete` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `suppliers_x_items`
--

INSERT INTO `suppliers_x_items` (`id`, `guid`, `branch_id`, `supplier_id`, `item_id`, `cost`, `quty`, `price`, `mrp`, `discount`, `active_status`, `delete_status`, `item_active`, `active`, `deactive_item`, `item_delete`, `added_by`, `deleted_by`) VALUES
(61, '5406c82acc35b1cb505ddba9c5da10a5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'abc049b9d095c27843b114f02ac5f640', '78', '78', '78', '', '8', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(62, 'f172b3411a1567c8ebe8c39c2ef972f6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'c3216f7d74d4adcf50901b8559d9a3bc', '78', '7', '78', '', '78', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(63, '0d754a691932fe1ccaac0eee69641c55', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'abyyc049b9d095c27843b114f02ac5f640', '78', '78', '78', '', '8', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(64, '47f55bea20cae16113cc42c3c359a33b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'abyyc049b9d095c27843b114f02ac5f640', '78', '78', '78', '', '8', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(65, '17b387d9642e23f9ea75b42b33fcb7ae', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'c3216f7d74d4adcf50901b8559d9a3bc', '78', '7', '78', '', '78', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(66, '3074e07af2c4b9d397d2b06212d2b204', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7988d76f85fb01646eb9d9b01530c460', 'c3216f7d74d4adcf50901b8559d9a3bc', '76', '78', '78', '', '78', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(67, '20f6e0e17503345ce7092a1714b5cdee', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c76d55c21f9d4f577b26fba515a8066f', 'c3216f7d74d4adcf50901b8559d9a3bc', '72', '7', '78', '', '78', 0, 0, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(68, '691bec25b0e8d7aadb570a5573a7cbb7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '6148f274388f64b43123c3598c3fcf81', 'c3216f7d74d4adcf50901b8559d9a3bc', '77', '78', '78', '', '78', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(69, '150d346c415b3e5fa748e61355c181b2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', '23b6fb71c13f7a53235835584c0a600f', '45', '22', '48', '49', '78', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(70, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'c709663a0324fb6175b807eb730de052', '12', '1', '30', '34', '', 1, 1, 0, 0, 0, 0, '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(71, 'e911b4e2a64bc482cd03d8a024032c43', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '11', '60', '70', '70', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(72, '5a3612bf6cdcfc7c7c019ed8dd81c7e6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '11', '60', '70', '70', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(73, 'ee72da87b6edc29b34949a808967cad9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '11', '60', '70', '70', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(74, '92b8f77a299643abde59aa5957a1d53d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'abyyc049b9d095c27843b114f02ac5f640', '56', '7', '75', '78', '', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(75, '1cf3405c91314ef25463cd61eb8608e7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'abc049b9d095c27843b114f02ac5f640', '56', '10', '75', '78', '', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(76, '35ffb5e0b4d9bb5b2a77852aea1b4a15', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'ef92a1dc9701ac89a655927183a78d87', '12', '10', '15', '16', '', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(77, '933be32d29356c3a24a22919ff47bd29', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', '23b6fb71c13f7a53235835584c0a600f', '45', '22', '48', '49', '', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(78, '01ea98def16e3c4642395da3cfc7f604', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'bbd6c9542b588e703bf706c30e204777', '56', '90', '58', '59', '', 1, 1, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(79, '3a8df3216914deb968909e30e571ed4e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '11', '60', '70', '', 0, 0, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(80, '2479c2446289f248a061785f28f38f50', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'abc049b9d095c27843b114f02ac5f640', '56', '10', '75', '78', '', 0, 0, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(81, 'bc001b6270f088d84f7ed55725267e6e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'ef92a1dc9701ac89a655927183a78d87', '12', '10', '15', '16', '', 0, 0, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(82, 'fc9171e99e7d3ec7291db234bf4e8f2b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', '23b6fb71c13f7a53235835584c0a600f', '45', '22', '48', '49', '', 0, 0, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(83, '20731530c4ef49569b8a882517e50de8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'abyyc049b9d095c27843b114f02ac5f640', '56', '100', '75', '78', '', 0, 0, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(84, '3301cc0c9b5b79e88c5f50d04a171b44', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'bbd6c9542b588e703bf706c30e204777', '56', '100', '58', '59', '', 0, 0, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(85, '58ffb91e968b9db1f8ec7a1989be70fa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a4e7a8de41c967c9097b2e4a1a0e662', 'c709663a0324fb6175b807eb730de052', '12', '100', '30', '34', '', 0, 0, 0, 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_x_items_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `suppliers_x_items_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `suppliers_x_items_x_page_x_permissions`
--

INSERT INTO `suppliers_x_items_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(5, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(6, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `suppliers_x_page_x_permissions` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `guid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `suppliers_x_page_x_permissions`
--

INSERT INTO `suppliers_x_page_x_permissions` (`id`, `permission`, `depart_id`, `branch_id`, `guid`) VALUES
(5, 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(6, 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(7, 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(8, 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(9, 111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `guid`, `value`, `branch_id`, `type`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '2ba78d7500ac92e84953cbe019741703', '5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(2, '81757ff8617e8582c3647d14a4291233', '10', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '58f48b85eaa9afb4fb023de77e2c60c4', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, '4d24f165c31f73d0244244fefc770ff8', '56', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `taxes_area`
--

CREATE TABLE IF NOT EXISTS `taxes_area` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `taxes_area`
--

INSERT INTO `taxes_area` (`id`, `guid`, `name`, `branch_id`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(2, '2d81a2d79b828aa9e3d109184961925a', 'Kerala', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(3, 'eceb529a54922e9bd0ba3d305f9520ef', 'Karanada', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(4, '60800ab1992c2df5952c54bbf19f5601', 'Poona', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(5, '9248a89e16bcf4ad98a5c50c68ca1870', 'Tamil Nad', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, 'e0c7c85f03312c7855f7052f5d5cef62', 'Gova', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(7, '1c1e20bd4d0cab963f5580b76eba6abe', 'A P', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, '22bd7f0bf66b60cfc7bda6374d873fcf', 'Rajandhan', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '810cae8bb4bfd17574f57308d3bf0062', 'Colombo', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(10, '85127b2d6897986a9175a142f154cd1a', 'kerala121', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(11, '7973b1abfb2466b4478c9d87476951cf', 'kerala121t', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `taxes_area_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `taxes_area_x_page_x_permissions` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `taxes_area_x_page_x_permissions`
--

INSERT INTO `taxes_area_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(6, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `taxes_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `taxes_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `taxes_x_page_x_permissions`
--

INSERT INTO `taxes_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(7, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(11, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `tax_commodity`
--

CREATE TABLE IF NOT EXISTS `tax_commodity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `schedule` varchar(100) NOT NULL,
  `tax_area` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `part` varchar(100) NOT NULL,
  `code` varchar(200) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tax_commodity`
--

INSERT INTO `tax_commodity` (`id`, `guid`, `branch_id`, `schedule`, `tax_area`, `description`, `part`, `code`, `tax`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(4, '4f160e2434fe0e0b01da625b4e31461c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'simple', '2', 'south', 'Pasd', 'TND-123', '81757ff8617e8582c3647d14a4291233', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, 'd7226f693d76b072f1fdf50f3089339a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'simple', '60800ab1992c2df5952c54bbf19f5601', 'North', 'Pasd', 'TND-124', '81757ff8617e8582c3647d14a4291233', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(6, 'd6e06e9618dc0c161df0150adb2743ea', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'Uttyty', '11', 'North', 'uiyi', 'TND-127', '4d24f165c31f73d0244244fefc770ff8', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `tax_commodity_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `tax_commodity_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tax_commodity_x_page_x_permissions`
--

INSERT INTO `tax_commodity_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(6, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `tax_types`
--

CREATE TABLE IF NOT EXISTS `tax_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tax_types`
--

INSERT INTO `tax_types` (`id`, `guid`, `type`, `branch_id`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '9583a13924a8e28cc35fec0650a891af', 'Vat', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, '58f48b85eaa9afb4fb023de77e2c60c4', 'Normal', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, '65cfd0dbcc7053600d5da1f688b78c06', 'sasi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `tax_types_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `tax_types_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tax_types_x_page_x_permissions`
--

INSERT INTO `tax_types_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(6, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(2) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `image` varchar(50) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `active` int(10) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `delete_status` int(10) NOT NULL,
  `user_type` int(11) NOT NULL,
  `default_branch` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `guid`, `user_id`, `password`, `first_name`, `last_name`, `address`, `sex`, `age`, `city`, `state`, `zip`, `country`, `email`, `phone`, `image`, `dob`, `active`, `created_by`, `deleted_by`, `delete_status`, `user_type`, `default_branch`) VALUES
(3, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'admin', 'f91e15dbec69fc40f81f0876e7009648', 'admin', 'admin', 'slvpg', 'Male', 23, 'bangalore', 'karnada', '676809', 'india', 'jibi344443@yahoo.com', '7795398584', '10', '654739200', 0, '99', '0', 0, 2, '2'),
(7, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B2', 'usd123', 'f91e15dbec69fc40f81f0876e7009648', 'jibi', 'gopi', 'slvpg', 'Male', 23, 'bangalore', 'karnada', '898989', 'india', 'jibigopi007@gmail.com', '7795398584', '10', '1380585600', 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '', 0, 0, ''),
(8, '8b93218367e80041c557c8f09d3dfc2d', 'usd122', 'f91e15dbec69fc40f81f0876e7009648', 'monish', 'km', '133', 'Male', 23, 'bangalore', 'karnataka', '62002', 'india', 'monish@yahoo.com', '8979797987', '0', '0', 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_x_branchs`
--

CREATE TABLE IF NOT EXISTS `users_x_branchs` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `user_delete` int(11) NOT NULL,
  `user_active` int(11) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users_x_branchs`
--

INSERT INTO `users_x_branchs` (`id`, `guid`, `branch_id`, `branch_name`, `emp_id`, `active_status`, `delete_status`, `user_delete`, `user_active`, `deleted_by`) VALUES
(1, '200C6130-78DB-44B5-890A-66E63D96411C', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'PIZZA HUT', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 0, 0, 0, '0'),
(5, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'PIZZA HUT', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B2', 0, 0, 0, 0, ''),
(11, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'PIZZA HUT', '8b93218367e80041c557c8f09d3dfc2d', 0, 0, 0, 0, ''),
(13, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'PIZZA HUT', '8', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `users_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` varchar(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users_x_page_x_permissions`
--

INSERT INTO `users_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(7, '', '0', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', '1', '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', '1', '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', '11', '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(11, '', '1111', '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `users_x_user_groups`
--

CREATE TABLE IF NOT EXISTS `users_x_user_groups` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `depart_name` varchar(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `users_x_user_groups`
--

INSERT INTO `users_x_user_groups` (`id`, `guid`, `depart_id`, `depart_name`, `emp_id`, `branch_id`, `active_status`, `delete_status`) VALUES
(1, '', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'Art', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(2, '', '1ff1de774005f8da13f42943881c655f', 'stock', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(3, '', '8e296a067a37563370ded05f5a3bf3ec', 'Manager', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(21, 'c1e9d3f4d54e83300f786cf9d9a4574a', '1ff1de774005f8da13f42943881c655f', 'stock', '8b93218367e80041c557c8f09d3dfc2d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(22, 'f9c977701a07008429a64ff67e04404a', '37693cfc748049e45d87b8c7d8b9aacd', 'sales', '8b93218367e80041c557c8f09d3dfc2d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(23, 'e5395fe4a8c521f85e4100a42b4b6fa3', '4e732ced3463d06de0ca9a15b6153677', 'Account', '8b93218367e80041c557c8f09d3dfc2d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(24, '135fa3324031a18ad240fffa444fd4bd', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'Art', '8b93218367e80041c557c8f09d3dfc2d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(25, '4292f35d120e870c8996b84fdcfd0443', '8e296a067a37563370ded05f5a3bf3ec', 'Manager', '8b93218367e80041c557c8f09d3dfc2d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(29, '1dab38122e195332d3e88e3033e2b14c', '1ff1de774005f8da13f42943881c655f', 'stock', '8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(30, 'a752c7858f27628240849c77ba88f6f2', '37693cfc748049e45d87b8c7d8b9aacd', 'sales', '8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(31, '257171a7a75a0f7b8328e9a93637af97', '4e732ced3463d06de0ca9a15b6153677', 'Account', '8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(32, 'c6b3418b75bb914c4dab576273de9593', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'Art', '7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(33, 'c257af59e96525511bbcf8638257894b', '1ff1de774005f8da13f42943881c655f', 'stock', '7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(34, 'd979f611356dbe2bf6fc950e1abee596', '8e296a067a37563370ded05f5a3bf3ec', 'Manager', '7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(35, '89cda09aa013cb62ace94dbfbd94344a', '4e732ced3463d06de0ca9a15b6153677', 'Account', '7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `dep_name` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `guid`, `dep_name`, `branch_id`, `active_status`, `delete_status`) VALUES
(22, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'Art', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(23, '37693cfc748049e45d87b8c7d8b9aacd', 'sales', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(24, '1ff1de774005f8da13f42943881c655f', 'stock', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(25, '8e296a067a37563370ded05f5a3bf3ec', 'Manager', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0),
(26, '4e732ced3463d06de0ca9a15b6153677', 'Account', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_groupsci_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `user_groupsci_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` varchar(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_groupsci_x_page_x_permissions`
--

INSERT INTO `user_groupsci_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(3, '', '0', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(4, '', '0', '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(5, '', '0', '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(6, '', '0', '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', '1111', '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups_x_branchs`
--

CREATE TABLE IF NOT EXISTS `user_groups_x_branchs` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `user_group_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `user_groups_x_branchs`
--

INSERT INTO `user_groups_x_branchs` (`id`, `guid`, `branch_id`, `user_group_id`, `active_status`, `delete_status`) VALUES
(17, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 0, 0),
(18, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 0, 0),
(19, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 0, 0),
(20, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 0, 0),
(21, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
