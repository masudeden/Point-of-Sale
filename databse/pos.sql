-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2013 at 05:39 PM
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
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` int(100) NOT NULL,
  `deleted_by` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `guid`, `name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'cfd8b485f99e561408192c594f8c2e92', 'LG', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 61, 0);

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
  `created_by` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers_category`
--

CREATE TABLE IF NOT EXISTS `customers_category` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers_payment_type`
--

CREATE TABLE IF NOT EXISTS `customers_payment_type` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `active_status` int(11) NOT NULL,
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
-- Table structure for table `customers_x_payment_types_details`
--

CREATE TABLE IF NOT EXISTS `customers_x_payment_types_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `payment_type_id` varchar(100) NOT NULL,
  `limit` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `credit_days` int(11) NOT NULL,
  `monthly_limit` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `code` varchar(100) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `cost_price` varchar(50) NOT NULL,
  `mrf` varchar(50) NOT NULL,
  `landing_cost` varchar(50) NOT NULL,
  `brand_id` varchar(100) NOT NULL,
  `item_type_id` varchar(100) NOT NULL,
  `selling_price` varchar(100) NOT NULL,
  `discount_amount` varchar(50) NOT NULL,
  `start_date` varchar(25) NOT NULL,
  `end_date` varchar(25) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `tax_area_id` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `code_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `items_settings`
--

CREATE TABLE IF NOT EXISTS `items_settings` (
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `item_category`
--

CREATE TABLE IF NOT EXISTS `item_category` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `guid`, `category_name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '0f1208f8b8d972183bb16bb0443ddb5e', 'soap', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(2, '4a70944370a2a575487e2ad0a5adae9d', 'pen', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, '44490e4607304eaaf6f9acaf170ff290', 'book', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, '37bc41880fa0ca0de0fa2e9f37480ba0', 'Goodnight', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '7d964715c57d2df50df0a9d380c9da22', 'vicks', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(6, '5c3437e9dedbcacead642b41b4a1f214', 'weakily', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '544f4c88a4008a5e58fc3fe5104afea9', 'Box', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, 'f1cbc6905e17586f09094db931bcf75e', 'Tv', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(9, '981cbacdb1bd664698bf1803878909b6', 'CD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(10, '402581a70ab59a35c0393cf2310b6f88', 'DVD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `guid`, `module_name`, `added_date`, `deleted_date`, `added_by`, `deleted_by`, `active_status`, `delete_status`) VALUES
(1, '80B0F0FD-B148-4C02-AFC7-7463D856714A', 'items', 0, 0, '102', '0', 0, 0),
(2, '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 'users', 0, 0, '102', '0', 0, 0),
(3, 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 'brands', 0, 0, '102', '0', 0, 0),
(4, '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 'items_setting', 102, 0, '0', '0', 0, 0),
(5, '60715722-A689-412B-A13F-ECA29FF19523', 'item_code', 102, 0, '0', '0', 0, 0),
(6, 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 'tax', 102, 0, '0', '0', 0, 0),
(7, 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 'tax_commodity', 102, 0, '0', '0', 0, 0),
(8, 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 'items_category', 102, 0, '0', '0', 0, 0),
(9, 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 'tax_type', 102, 0, '0', '0', 0, 0),
(10, 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 'tax_area', 102, 0, '0', '0', 0, 0),
(11, 'D33AF5EF-570D-403D-B967-A5B658675B06', 'suppliers', 102, 0, '0', '0', 0, 0),
(12, '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 'supplier_vs_items', 102, 0, '0', '0', 0, 0),
(13, '5464B2EF-92D2-4430-B366-983D7590FFC4', 'customers', 102, 0, '0', '0', 0, 0),
(14, '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 'customer_category', 102, 0, '0', '0', 0, 0),
(15, 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 'user_groupsci', 102, 0, '0', '0', 0, 0),
(16, '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 'branchCI', 102, 0, '0', '0', 0, 0),
(17, '6D825F4C-44E0-4CF4-8FD2-A5FEA57E8FC1', 'purchase_oder', 102, 0, '0', '0', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

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
(18, '6D825F4C-44E0-4CF4-8FD2-A5FEA57E8FC1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '6D825F4C-44E0-4CF4-8FD2-A5FEA57E8FC1', 0, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_oder_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `purchase_oder_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `purchase_oder_x_page_x_permissions`
--

INSERT INTO `purchase_oder_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
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
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `website` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `discount` varchar(50) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `supplier_vs_items_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `supplier_vs_items_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `supplier_vs_items_x_page_x_permissions`
--

INSERT INTO `supplier_vs_items_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(5, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(6, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

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
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `taxes_area`
--

CREATE TABLE IF NOT EXISTS `taxes_area` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `taxes_area`
--

INSERT INTO `taxes_area` (`id`, `guid`, `name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(2, '2d81a2d79b828aa9e3d109184961925a', 'Kerala', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, 'eceb529a54922e9bd0ba3d305f9520ef', 'Karanada', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, '60800ab1992c2df5952c54bbf19f5601', 'Poona', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '9248a89e16bcf4ad98a5c50c68ca1870', 'Tamil Nad', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(6, 'e0c7c85f03312c7855f7052f5d5cef62', 'Gova', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '1c1e20bd4d0cab963f5580b76eba6abe', 'A P', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, '22bd7f0bf66b60cfc7bda6374d873fcf', 'Rajandhan', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `taxes_commodity`
--

CREATE TABLE IF NOT EXISTS `taxes_commodity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` varchar(100) NOT NULL,
  `schedule` varchar(100) NOT NULL,
  `tax_area` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `part` varchar(100) NOT NULL,
  `code` varchar(200) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax_area_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `tax_area_x_page_x_permissions` (
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
-- Dumping data for table `tax_area_x_page_x_permissions`
--

INSERT INTO `tax_area_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(6, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

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
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tax_types`
--

INSERT INTO `tax_types` (`id`, `guid`, `type`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '9583a13924a8e28cc35fec0650a891af', 'Vat', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '', ''),
(2, '58f48b85eaa9afb4fb023de77e2c60c4', 'Normal', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tax_type_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `tax_type_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tax_type_x_page_x_permissions`
--

INSERT INTO `tax_type_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(6, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(7, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `tax_x_page_x_permissions`
--

CREATE TABLE IF NOT EXISTS `tax_x_page_x_permissions` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `depart_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tax_x_page_x_permissions`
--

INSERT INTO `tax_x_page_x_permissions` (`id`, `guid`, `permission`, `depart_id`, `branch_id`) VALUES
(7, '', 0, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(8, '', 0, '37693cfc748049e45d87b8c7d8b9aacd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(9, '', 0, '1ff1de774005f8da13f42943881c655f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(10, '', 0, '8e296a067a37563370ded05f5a3bf3ec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(11, '', 1111, '4e732ced3463d06de0ca9a15b6153677', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `guid`, `user_id`, `password`, `first_name`, `last_name`, `address`, `sex`, `age`, `city`, `state`, `zip`, `country`, `email`, `phone`, `image`, `dob`, `active`, `created_by`, `deleted_by`, `delete_status`, `user_type`, `default_branch`) VALUES
(3, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'admin', 'f91e15dbec69fc40f81f0876e7009648', 'admin', 'admin', 'slvpg', 'Male', 23, 'bangalore', 'karnada', '676809', 'india', 'jibi344443@yahoo.com', '7795398584', '10', '654739200', 0, '99', '0', 0, 2, '2'),
(7, '', 'usd123', 'dc06698f0e2e75751545455899adccc3', 'jibi', 'gopi', 'slvpg', 'Male', 23, 'bangalore', 'karnada', '898989', 'india', 'jibigopi007@gmail.com', '7795398584', '10', '1380585600', 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '', 0, 0, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users_x_branchs`
--

INSERT INTO `users_x_branchs` (`id`, `guid`, `branch_id`, `branch_name`, `emp_id`, `active_status`, `delete_status`, `user_delete`, `user_active`, `deleted_by`) VALUES
(1, '200C6130-78DB-44B5-890A-66E63D96411C', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'PIZZA HUT', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 0, 0, 0, '0'),
(5, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'PIZZA HUT', '7', 0, 0, 0, 0, '');

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
  `emp_id` int(100) NOT NULL,
  `branch_id` int(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_x_user_groups`
--

INSERT INTO `users_x_user_groups` (`id`, `guid`, `depart_id`, `depart_name`, `emp_id`, `branch_id`, `active_status`, `delete_status`) VALUES
(1, '', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'Art', 7, 0, 0, 0),
(2, '', '1ff1de774005f8da13f42943881c655f', 'stock', 7, 0, 0, 0),
(3, '', '8e296a067a37563370ded05f5a3bf3ec', 'Manager', 7, 0, 0, 0);

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
