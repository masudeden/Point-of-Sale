-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2013 at 06:35 PM
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
-- Table structure for table `branchs`
--

CREATE TABLE IF NOT EXISTS `branchs` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
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
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `branchs`
--

INSERT INTO `branchs` (`id`, `store_name`, `store_city`, `store_state`, `store_zip`, `store_country`, `store_website`, `store_phone`, `store_email`, `store_fax`, `store_tax1`, `store_tax2`, `active_status`, `delete_status`, `deleted_by`) VALUES
(1, 'K F C', 'H S R ', 'karnada', '676809', 'india', 'hkjk', '9000607666', 'jibi@pluskb.com', '04828320080', '11', '10.12', 0, 0, 99),
(2, 'Pizza Hut', 'Agra', '', '', '', '', '9000607667', '', '04828320081', '', '', 0, 0, 101),
(3, 'Mcdonalds', 'Kormangala', '', '', '', '', '9000607668', '', '04828320082', '', '', 0, 0, 101),
(4, 'Dominos', 'B T M', '', '', '', '', '9000607669', '', '04828320083', '', '', 0, 0, 101),
(13, 'Cofee House', 'H S R', '', '', '', '', '7795398584', 'cofee@yahoo.com', '0482832009', '', '', 0, 0, 99);

-- --------------------------------------------------------

--
-- Table structure for table `branchs_x_payment_modes`
--

CREATE TABLE IF NOT EXISTS `branchs_x_payment_modes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `branchs_x_payment_modes`
--

INSERT INTO `branchs_x_payment_modes` (`id`, `branch_id`, `pay_id`, `active_status`) VALUES
(1, 3, 1, 0),
(2, 3, 2, 0),
(3, 1, 3, 0),
(4, 3, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `branch_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `branch_x_page_x_permissions` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `branch_x_page_x_permissions`
--

INSERT INTO `branch_x_page_x_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(28, '1111', 27, 3),
(29, '1111', 28, 3),
(30, '1111', 29, 3),
(31, '1111', 30, 1),
(32, '1111', 31, 1),
(33, '1111', 32, 2),
(34, '1111', 33, 4),
(35, '1111', 34, 3),
(36, '1111', 35, 3),
(37, '1111', 36, 4),
(38, '1111', 37, 2),
(43, '1111', 43, 13);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'TATA1', 3, 0, 0, 0, 0),
(2, 'LG', 3, 0, 0, 0, 102),
(3, 'NOKIA', 3, 0, 0, 0, 0),
(4, 'SAMSUNG', 3, 0, 0, 0, 0),
(5, 'ACER', 3, 0, 0, 0, 0),
(6, 'THOSHIBA', 3, 0, 0, 0, 101),
(7, 'SONY', 3, 1, 0, 0, 102),
(8, 'IDEA', 3, 1, 0, 0, 102);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
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
  `category_id` int(11) NOT NULL,
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
  `created_by` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `title`, `last_name`, `address1`, `address2`, `bday`, `mday`, `city`, `state`, `zip`, `country`, `category_id`, `comments`, `company_name`, `email`, `phone`, `account_number`, `bank_name`, `bank_location`, `website`, `cst`, `gst`, `tax_no`, `created_by`, `active_status`, `delete_status`) VALUES
(21, 'jibi', 'Dr', 'gopi', 'kola', 'dsfds', 0, 0, 'dsfds', 'dsaf', 'dsf', 'ds', 2, 'gjshdgfjhws', 'hjdshk', 'julibeth@yahoo.in', '7785008584', '879', 'iuyi', 'jjh', 'kjhdsyhi', '9809', '098', '', 0, 0, 0),
(22, 'jibi', 'Mr', 'gopi', 'kolanchira', 'erumely', 1370217600, 1371081600, 'kottaym', 'kerala', '676809', 'india', 6, 'nothng', 'pluskb', 'jibi344443@yahoo.com', '7795398584', 'SBC4554646', 'STB', 'erumely', 'hahiaiu', 'CST87686', 'GST89979', '', 101, 0, 0),
(23, 'jibi', 'Mr', 'gopi', 'kolanchira', 'erumely', 1371081600, 1370476800, 'kottaym', 'kerala', '676809', 'india', 2, 'nothng', 'pluskb', 'julibeth@yahoo.in', '7795398584', 'SBT788979', 'SBT', 'erumely', 'http;//www.pluskb.com', 'CST87686', 'GST89979', 'REG7879', 101, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers_category`
--

CREATE TABLE IF NOT EXISTS `customers_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `customers_category`
--

INSERT INTO `customers_category` (`id`, `branch_id`, `category_name`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 3, 'Custome Sample One', 0, 0, 102, 101),
(2, 3, 'Custome Sample Two', 0, 0, 101, 0),
(3, 3, 'Custome Sample Three', 0, 0, 101, 0),
(4, 3, 'Custome Sample Four', 0, 0, 101, 0),
(6, 1, 'Custome Sample One', 0, 0, 101, 0),
(7, 1, 'Custome Sample Two', 0, 0, 101, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers_payment_type`
--

CREATE TABLE IF NOT EXISTS `customers_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `active_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customers_payment_type`
--

INSERT INTO `customers_payment_type` (`id`, `type`, `active_status`) VALUES
(1, 'Credit Only', 0),
(2, 'Both Cash And Credit', 0),
(3, 'Cash On Delivery', 0),
(4, 'Only Cash', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers_x_branchs`
--

CREATE TABLE IF NOT EXISTS `customers_x_branchs` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `customer_active` int(11) NOT NULL,
  `customer_delete` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `customers_x_branchs`
--

INSERT INTO `customers_x_branchs` (`id`, `branch_id`, `branch_name`, `customer_id`, `active_status`, `delete_status`, `customer_active`, `customer_delete`, `deleted_by`) VALUES
(15, 3, 'Mcdonalds', 21, 0, 0, 0, 0, 0),
(16, 1, 'K F C', 22, 0, 0, 0, 0, 0),
(17, 3, 'Mcdonalds', 23, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `customers_x_page_x_permissions` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `permission` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `customers_x_page_x_permissions`
--

INSERT INTO `customers_x_page_x_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(1, 1111, 27, 3),
(2, 0, 28, 3),
(3, 0, 29, 3),
(4, 1111, 30, 1),
(5, 1111, 31, 1),
(6, 0, 32, 2),
(7, 1111, 33, 4),
(8, 0, 34, 3),
(9, 0, 35, 3),
(10, 1111, 36, 4),
(11, 0, 37, 2),
(12, 0, 43, 13);

-- --------------------------------------------------------

--
-- Table structure for table `customers_x_payment_types_details`
--

CREATE TABLE IF NOT EXISTS `customers_x_payment_types_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `limit` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `credit_days` int(11) NOT NULL,
  `monthly_limit` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customers_x_payment_types_details`
--

INSERT INTO `customers_x_payment_types_details` (`id`, `branch_id`, `customer_id`, `payment_type_id`, `limit`, `balance`, `credit_days`, `monthly_limit`) VALUES
(2, 3, 21, 2, '123', '', 12, '123'),
(3, 1, 22, 3, '10000', '', 100, '10000'),
(4, 3, 23, 2, '100000', '', 1000, '100000');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `cost_price` varchar(50) NOT NULL,
  `mrf` varchar(50) NOT NULL,
  `landing_cost` varchar(50) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `selling_price` varchar(100) NOT NULL,
  `discount_amount` varchar(50) NOT NULL,
  `start_date` varchar(25) NOT NULL,
  `end_date` varchar(25) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax_area_id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `code_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `code`, `barcode`, `category_id`, `branch_id`, `supplier_id`, `name`, `description`, `cost_price`, `mrf`, `landing_cost`, `brand_id`, `item_type_id`, `selling_price`, `discount_amount`, `start_date`, `end_date`, `tax_id`, `tax_area_id`, `location`, `deleted_by`, `active_status`, `delete_status`, `added_by`, `code_status`) VALUES
(35, 'Code1233', 'I1008', 6, 3, 8, 'Item 1', 'Book', '123', '123', '15', 3, 0, '123', '12', '0', '0', 5, 2, 'dr', 3, 0, 0, 102, 1),
(36, 'Code124', '', 3, 3, 8, 'item2', 'pen', '12', '15', '14', 1, 0, '14', '', '0', '0', 1, 1, '', 0, 0, 0, 102, 1),
(37, 'U657657', '', 3, 3, 8, 'item3', 'clock', '45', '12', '12', 1, 0, '12', '', '0', '0', 1, 1, '', 3, 0, 0, 101, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items_kits_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `items_kits_x_page_x_permissions` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `permission` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `items_kits_x_page_x_permissions`
--

INSERT INTO `items_kits_x_page_x_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(1, 1111, 27, 3),
(2, 0, 28, 3),
(3, 0, 29, 3),
(4, 1111, 30, 1),
(5, 1111, 31, 1),
(6, 0, 32, 2),
(7, 1111, 33, 4),
(8, 0, 34, 3),
(9, 0, 35, 3),
(10, 1111, 36, 4),
(11, 0, 37, 2),
(12, 0, 43, 13);

-- --------------------------------------------------------

--
-- Table structure for table `items_settings`
--

CREATE TABLE IF NOT EXISTS `items_settings` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(200) NOT NULL,
  `branch_id` int(200) NOT NULL,
  `min_q` varchar(50) NOT NULL,
  `max_q` varchar(50) NOT NULL,
  `sales` int(11) NOT NULL,
  `purchase` int(11) NOT NULL,
  `salses_return` int(11) NOT NULL,
  `purchase_return` int(11) NOT NULL,
  `allow_negative` int(11) NOT NULL,
  `tax_inclusive` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `items_settings`
--

INSERT INTO `items_settings` (`id`, `item_id`, `branch_id`, `min_q`, `max_q`, `sales`, `purchase`, `salses_return`, `purchase_return`, `allow_negative`, `tax_inclusive`, `updated_by`) VALUES
(3, 35, 3, '0', '0', 0, 0, 0, 0, 1, 1, 102),
(11, 36, 3, '0', '0', 1, 1, 1, 1, 1, 1, 102),
(12, 37, 3, '0', '0', 1, 1, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE IF NOT EXISTS `item_category` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `category_name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'water', 2, 0, 0, 0, 0),
(2, 'drinks', 2, 0, 0, 0, 0),
(3, 'Books', 3, 0, 0, 0, 101),
(4, 'Pen', 3, 0, 0, 0, 102),
(5, 'TV', 3, 0, 0, 0, 102),
(6, 'Laptop', 3, 0, 0, 101, 102),
(7, 'SASI', 3, 0, 0, 102, 102);

-- --------------------------------------------------------

--
-- Table structure for table `item_upc_ean_code`
--

CREATE TABLE IF NOT EXISTS `item_upc_ean_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `code` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `item_upc_ean_code`
--

INSERT INTO `item_upc_ean_code` (`id`, `item_id`, `code`, `branch_id`, `delete_status`) VALUES
(14, 35, 'U6576575', 3, 0),
(15, 36, 'U657666', 3, 0),
(16, 37, 'U6576574', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_x_page_permissions`
--

CREATE TABLE IF NOT EXISTS `item_x_page_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `item_x_page_permissions`
--

INSERT INTO `item_x_page_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(28, '1111', 27, 3),
(29, '1111', 28, 3),
(30, '1111', 29, 3),
(31, '1111', 30, 1),
(32, '1111', 31, 1),
(33, '1111', 32, 2),
(34, '1111', 33, 4),
(35, '1111', 34, 3),
(36, '1111', 35, 3),
(37, '1111', 36, 4),
(38, '1111', 37, 2),
(43, '1111', 43, 13);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `exp_date` int(11) NOT NULL,
  `pono` varchar(100) NOT NULL,
  `podate` int(20) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `freight` varchar(100) NOT NULL,
  `round_amt` varchar(100) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `total` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_x_page_x_permission`
--

CREATE TABLE IF NOT EXISTS `sales_x_page_x_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sales_x_page_x_permission`
--

INSERT INTO `sales_x_page_x_permission` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(1, 1111, 27, 3),
(2, 1, 28, 3),
(3, 1, 29, 3),
(4, 1111, 30, 1),
(5, 1111, 31, 1),
(6, 1, 32, 2),
(7, 1111, 33, 4),
(8, 1, 34, 3),
(9, 1, 35, 3),
(10, 1111, 36, 4),
(11, 1, 37, 2),
(12, 1, 43, 13);

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
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL,
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

INSERT INTO `stocks` (`id`, `branch_id`, `branch_name`, `item_id`, `price`, `stock`, `active_status`, `delete_status`, `item_active`, `item_delete`) VALUES
(14, 3, 'Mcdonalds', 21, '12', '91', 0, 0, 0, 0),
(15, 3, 'Mcdonalds', 22, '20', '200', 0, 0, 0, 0),
(16, 3, 'Mcdonalds', 23, '14', '20', 0, 0, 0, 0),
(17, 3, 'Mcdonalds', 24, '25', '30', 0, 0, 0, 0),
(18, 3, 'Mcdonalds', 25, '20', '100', 0, 0, 0, 0),
(19, 3, 'Mcdonalds', 26, '28', '1000', 0, 0, 0, 0),
(20, 3, 'Mcdonalds', 27, '10', '2', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stocks_history`
--

CREATE TABLE IF NOT EXISTS `stocks_history` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
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

INSERT INTO `stocks_history` (`id`, `branch_id`, `branch_name`, `item_id`, `category_id`, `supplier_id`, `added_by`, `cost`, `stock`, `price`, `Quantity`, `date`) VALUES
(5, 3, 'Mcdonalds', 21, 3, 8, 102, '10', '1000', '12', '12', '1369612800'),
(6, 3, 'Mcdonalds', 22, 3, 8, 102, '15', '2000', '20', '1', '1369612800'),
(7, 3, 'Mcdonalds', 23, 3, 8, 102, '11', '20', '14', '1', '1369612800'),
(8, 3, 'Mcdonalds', 24, 3, 8, 102, '21', '30', '25', '1', '1369612800'),
(9, 3, 'Mcdonalds', 25, 3, 8, 102, '18', '100', '20', '1', '1369612800'),
(10, 3, 'Mcdonalds', 26, 3, 8, 102, '26', '1000', '28', '2', '1369612800'),
(11, 3, 'Mcdonalds', 27, 3, 8, 102, '6', '2', '10', '1', '1369612800');

-- --------------------------------------------------------

--
-- Table structure for table `stock_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `stock_x_page_x_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `stock_x_page_x_permissions`
--

INSERT INTO `stock_x_page_x_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(1, 1111, 27, 3),
(2, 1111, 28, 3),
(3, 1111, 29, 3),
(4, 1111, 30, 1),
(5, 1111, 31, 1),
(6, 1111, 32, 2),
(7, 1111, 33, 4),
(8, 1111, 34, 3),
(9, 1111, 35, 3),
(10, 1111, 36, 4),
(11, 1111, 37, 2),
(12, 1111, 43, 13);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `website` varchar(100) NOT NULL,
  `branch_id` int(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_name`, `first_name`, `last_name`, `email`, `phone`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `comments`, `account_number`, `active_status`, `delete_status`, `website`, `branch_id`, `created_by`) VALUES
(4, 'IBM', 'jibi', 'gopi', '', '7795398584', '', '', '', '', '', '', 'sasi', '', 0, 0, '', 3, 101),
(5, 'yahoo', 'nijan', 'xavier', '', '7795398580', '', '', '', '', '', '', '', '', 0, 0, '', 3, 101),
(6, 'sssi', 'kannan', 'xavier', '', '7795398584', '', '', '', '', '', '', '', '', 0, 0, '', 3, 101),
(7, 'zumi', 'kiran', 'kumar', '', '7795398583', '', '', '', '', '', '', '', '', 0, 0, '', 3, 101),
(8, 'C dac', 'libin', 'kurian', '', '7795398584', '', '', '', '', '', '', '', '', 0, 0, '', 3, 102),
(9, 'esarwe', 'jibi', 'gopi', '', '7790398584', '', '', '', '', '', '', '', '', 0, 0, '', 3, 101),
(10, 'dfsdf', 'kannan', 'xavier', '', '7095398584', '', '', '', '', '', '', '', '', 0, 0, '', 3, 101);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_x_branchs`
--

CREATE TABLE IF NOT EXISTS `suppliers_x_branchs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `supplier_active` int(11) NOT NULL,
  `supplier_delete` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `item_status` int(11) NOT NULL,
  `item_delete` int(11) NOT NULL,
  `item_deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `suppliers_x_branchs`
--

INSERT INTO `suppliers_x_branchs` (`id`, `branch_id`, `branch_name`, `supplier_id`, `active_status`, `delete_status`, `supplier_active`, `supplier_delete`, `deleted_by`, `item_status`, `item_delete`, `item_deleted_by`) VALUES
(4, 3, 'Mcdonalds', 4, 0, 0, 1, 0, 0, 0, 0, 0),
(5, 3, 'Mcdonalds', 5, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 3, 'Mcdonalds', 6, 0, 0, 0, 0, 0, 0, 0, 101),
(7, 3, 'Mcdonalds', 7, 0, 0, 1, 0, 0, 0, 0, 101),
(8, 3, 'Mcdonalds', 8, 0, 0, 0, 0, 0, 0, 0, 101),
(9, 3, 'Mcdonalds', 9, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 3, 'Mcdonalds', 10, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_x_items`
--

CREATE TABLE IF NOT EXISTS `suppliers_x_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `quty` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `suppliers_x_items`
--

INSERT INTO `suppliers_x_items` (`id`, `branch_id`, `supplier_id`, `item_id`, `cost`, `quty`, `price`, `discount`, `active_status`, `delete_status`, `active`, `added_by`, `deleted_by`) VALUES
(33, 3, 7, 37, '45  ', '0', '12', '0', 1, 0, 0, 102, 0),
(34, 3, 7, 35, '123  ', '0', '123', '0', 0, 0, 0, 102, 0),
(35, 3, 7, 36, '12  ', '0', '14', '0', 1, 0, 0, 102, 0),
(36, 3, 6, 37, '45 ', '0', '12', '0', 0, 0, 0, 102, 0),
(37, 3, 6, 35, '123', '0', '123', '0', 1, 0, 0, 102, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_x_page_permissions`
--

CREATE TABLE IF NOT EXISTS `suppliers_x_page_permissions` (
  `id` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers_x_page_permissions`
--

INSERT INTO `suppliers_x_page_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(1, 1111, 27, 3),
(2, 0, 28, 3),
(3, 0, 29, 3),
(4, 1111, 30, 1),
(5, 1111, 31, 1),
(6, 0, 32, 2),
(7, 1111, 33, 4),
(8, 0, 34, 3),
(9, 0, 35, 3),
(10, 1111, 36, 4),
(11, 0, 37, 2),
(12, 0, 43, 13);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `value`, `branch_id`, `type`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '12', '3', 'ADDITIONAL VAT', 0, 0, 0, 102),
(2, '13', '3', 'VAT', 0, 0, 0, 101),
(3, '12', '3', 'HEDUCESS', 0, 0, 0, 101),
(4, '15', '3', 'EDUCESS', 0, 0, 0, 101),
(5, '14', '3', 'VAT', 0, 0, 0, 101),
(6, '23', '3', 'ADDITIONAL VAT', 0, 0, 102, 0);

-- --------------------------------------------------------

--
-- Table structure for table `taxes_area`
--

CREATE TABLE IF NOT EXISTS `taxes_area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `taxes_area`
--

INSERT INTO `taxes_area` (`id`, `name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'kearal1', 3, 0, 0, 0, 0),
(2, 'gova', 3, 0, 0, 0, 102),
(3, 'dhelhi', 3, 1, 1, 0, 101),
(4, 'kerala', 3, 0, 1, 0, 101),
(5, 'kerala', 3, 0, 1, 0, 101),
(6, 'kerala', 3, 0, 1, 0, 101),
(7, 'kerala', 3, 0, 0, 0, 0),
(8, 'andhra', 3, 0, 0, 101, 102),
(9, 'dhelhi', 3, 0, 0, 101, 102);

-- --------------------------------------------------------

--
-- Table structure for table `taxes_commodity`
--

CREATE TABLE IF NOT EXISTS `taxes_commodity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `schedule` varchar(100) NOT NULL,
  `tax_area` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `part` varchar(100) NOT NULL,
  `code` varchar(200) NOT NULL,
  `tax` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `taxes_commodity`
--

INSERT INTO `taxes_commodity` (`id`, `branch_id`, `schedule`, `tax_area`, `description`, `part`, `code`, `tax`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 3, 'starts', 2, 'sasi', 'sasi', 'C123', 1, 0, 0, 0, 102),
(2, 3, 'starts', 2, 'asfas', 'fafa', 'C124', 2, 0, 0, 0, 3),
(3, 3, 'starts', 8, 'rwr', 'rrew', 'C125', 3, 0, 0, 0, 101),
(4, 3, 'part', 1, 'orgin', 'start', 'C3455', 1, 0, 0, 101, 102),
(5, 3, 'aa', 9, 'Part', '345', 'C345', 6, 0, 0, 101, 102),
(6, 3, 'fvawer', 6, 'dis', 'vasrtw', 'C3457', 4, 0, 0, 101, 102);

-- --------------------------------------------------------

--
-- Table structure for table `tax_types`
--

CREATE TABLE IF NOT EXISTS `tax_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tax_types`
--

INSERT INTO `tax_types` (`id`, `type`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'SERVICE', 3, 0, 0, 0, 102),
(2, 'VAT', 3, 0, 0, 0, 3),
(3, 'ADDITIONAL VAT', 3, 0, 0, 0, 0),
(4, 'EDUCESS', 3, 0, 0, 0, 3),
(5, 'HEDUCESS', 3, 0, 0, 0, 101),
(7, 'SASI', 3, 0, 0, 0, 102);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
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
  `created_by` int(100) NOT NULL,
  `deleted_by` int(100) NOT NULL,
  `delete_status` int(10) NOT NULL,
  `user_type` int(11) NOT NULL,
  `default_branch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `password`, `first_name`, `last_name`, `address`, `sex`, `age`, `city`, `state`, `zip`, `country`, `email`, `phone`, `image`, `dob`, `active`, `created_by`, `deleted_by`, `delete_status`, `user_type`, `default_branch`) VALUES
(99, 'Usd124', 'f91e15dbec69fc40f81f0876e7009648', 'nijan', 'kumar', 'slvpg', 'Male', 23, 'bangalore', 'karnada', '676809', 'india', 'nijan@yahoo.com', '7795398584', '102.jpg', '654739200', 0, 55, 0, 0, 0, 1),
(100, 'Usd120', 'f91e15dbec69fc40f81f0876e7009648', 'jibi', 'gopi', 'slvpg', 'Male', 23, 'bangalore', 'karnada', '676809', 'india', 'jibigopi007@gmail.com', '7795398584', '10', '654739200', 0, 99, 99, 0, 0, 1),
(101, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'slvpg', 'Male', 23, 'bangalore', 'karnada', '676809', 'india', 'jibi344443@yahoo.com', '7795398584', '10', '654739200', 0, 99, 0, 0, 2, 1),
(102, 'Usd126', 'f91e15dbec69fc40f81f0876e7009648', 'monish', 'km', 'slvpg', 'Male', 23, 'bangalore', 'karnada', '676809', 'india', 'kmonish90@gmail.com', '7795398584', '10', '654739200', 0, 101, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_x_branchs`
--

CREATE TABLE IF NOT EXISTS `users_x_branchs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `user_delete` int(11) NOT NULL,
  `user_active` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `users_x_branchs`
--

INSERT INTO `users_x_branchs` (`id`, `branch_id`, `branch_name`, `emp_id`, `active_status`, `delete_status`, `user_delete`, `user_active`, `deleted_by`) VALUES
(156, 4, 'Dominos', 99, 0, 0, 0, 0, 0),
(158, 4, 'Dominos', 100, 0, 0, 0, 0, 0),
(163, 3, 'Mcdonalds', 102, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_x_user_groups`
--

CREATE TABLE IF NOT EXISTS `users_x_user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `depart_id` int(11) NOT NULL,
  `depart_name` varchar(100) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=183 ;

--
-- Dumping data for table `users_x_user_groups`
--

INSERT INTO `users_x_user_groups` (`id`, `depart_id`, `depart_name`, `emp_id`, `branch_id`, `active_status`, `delete_status`) VALUES
(172, 36, 'supplier', 99, 4, 0, 0),
(174, 33, 'Art', 100, 4, 0, 0),
(182, 27, 'Art', 102, 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `dep_name`, `branch_id`, `active_status`, `delete_status`) VALUES
(27, 'Art', 3, 0, 0),
(28, 'Sales Man', 3, 0, 0),
(29, 'Stock Man', 3, 0, 0),
(30, 'Sales Man', 1, 0, 0),
(31, 'Art', 1, 0, 0),
(32, 'supplier', 2, 0, 0),
(33, 'Art', 4, 0, 0),
(34, 'supplier one', 3, 0, 0),
(35, 'casher', 3, 0, 0),
(36, 'supplier', 4, 0, 0),
(37, 'Art', 2, 0, 0),
(43, 'Manager', 13, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups_x_branchs`
--

CREATE TABLE IF NOT EXISTS `user_groups_x_branchs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `user_groups_x_branchs`
--

INSERT INTO `user_groups_x_branchs` (`id`, `branch_id`, `user_group_id`, `active_status`, `delete_status`) VALUES
(33, 3, 27, 0, 0),
(34, 3, 28, 0, 0),
(35, 3, 29, 0, 0),
(36, 1, 30, 0, 0),
(37, 1, 31, 0, 0),
(38, 2, 32, 0, 0),
(39, 4, 33, 0, 0),
(40, 3, 34, 0, 0),
(41, 3, 35, 0, 0),
(42, 4, 36, 0, 0),
(43, 2, 37, 0, 0),
(47, 13, 43, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `user_groups_x_page_x_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `user_groups_x_page_x_permissions`
--

INSERT INTO `user_groups_x_page_x_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(28, '1111', 27, 3),
(29, '1111', 28, 3),
(30, '1111', 29, 3),
(31, '1111', 30, 1),
(32, '1111', 31, 1),
(33, '1111', 32, 2),
(34, '1111', 33, 4),
(35, '1111', 34, 3),
(36, '1111', 35, 3),
(37, '1111', 36, 4),
(38, '1111', 37, 2),
(43, '1111', 43, 13);

-- --------------------------------------------------------

--
-- Table structure for table `user_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `user_x_page_x_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `user_x_page_x_permissions`
--

INSERT INTO `user_x_page_x_permissions` (`id`, `permission`, `depart_id`, `branch_id`) VALUES
(28, '1111', 27, 3),
(29, '1101', 28, 3),
(30, '1111', 29, 3),
(31, '1111', 30, 1),
(32, '1111', 31, 1),
(33, '1111', 32, 2),
(34, '1111', 33, 4),
(35, '1111', 34, 3),
(36, '1111', 35, 3),
(37, '1111', 36, 4),
(38, '1111', 37, 2),
(43, '1111', 43, 13);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
