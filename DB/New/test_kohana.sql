-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2012 at 10:39 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_kohana`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.'),
(3, 'company', 'Paid Pack Fulfillment Company');

-- --------------------------------------------------------

--
-- Table structure for table `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(1, 1),
(58, 1),
(59, 1),
(360, 1),
(361, 1),
(362, 1),
(363, 1),
(364, 1),
(365, 1),
(366, 1),
(367, 1),
(368, 1),
(369, 1),
(370, 1),
(371, 1),
(372, 1),
(2, 2),
(57, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE IF NOT EXISTS `tbl_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `primary_address` varchar(1) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Store the Customer Address' AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `address_1`, `address_2`, `city`, `state`, `zip`, `cust_id`, `date_added`, `primary_address`) VALUES
(18, 'Address_Edited2', 'Address 2_Edited', 'Ahmedabad_Edited', 'AL', '380001', 10, '2012-04-01 01:22:58', 'Y'),
(19, 'Address', 'Address 2', 'Ahmedabad', 'AL', '3880019', 11, '2012-04-06 21:57:26', 'Y'),
(20, 'Address1', '', '', 'AK', '', 1, '2012-06-14 10:40:57', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `cust_email` varchar(255) NOT NULL,
  `intial` varchar(255) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `tax_id` varchar(255) NOT NULL,
  `terms` varchar(255) NOT NULL,
  `cust_notes` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cust_company` varchar(255) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cust_id`, `first_name`, `last_name`, `cust_email`, `intial`, `work_phone`, `mobile_phone`, `fax`, `tax_id`, `terms`, `cust_notes`, `date_added`, `cust_company`) VALUES
(1, 'Hardik Edit', 'Bhavsar', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', 'Mobile Centrix', '343434343434', '121212121212', '365', 'Memo  Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo ', '2012-03-29 22:41:03', 'Mobile Centrix'),
(2, 'Bhavsar', 'Hardik', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', '322323232323', '343434343434', '121212121212', '365', 'Memo  Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo ', '2012-03-29 22:42:23', 'Compnay Name 2'),
(3, 'First Name', 'Hardik', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', '322323232323', '343434343434', '121212121212', '365', 'Memo  Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo ', '2012-03-29 22:43:54', 'company name'),
(4, 'Compnay name', 'Hardik', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', '322323232323', '343434343434', '121212121212', '365', 'this is notes', '2012-03-29 22:48:52', ''),
(5, 'Compnay name', 'Hardik', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', 'Compnay Name1', '343434343434', '121212121212', '365', 'this is test', '2012-03-31 17:26:12', 'Compnay Name1'),
(6, 'KInajl', 'Bhavsar', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', 'Compnay Name1', '343434343434', '121212121212', '365', 'this is test', '2012-03-31 17:27:41', 'Compnay Name1'),
(7, 'KInajl Edit', 'Bhavsar', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', 'Compnay Name1', '343434343434', '121212121212', '365', 'this is test', '2012-03-31 17:29:41', 'Compnay Name1'),
(8, 'Nikunj_Edited', 'Bhavsar_Edited', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', '322323232323', '343434343434', '121212121212', '365', 'test this is', '2012-04-01 00:20:58', 'Sincorida'),
(9, 'Nikunj _Edit', 'Bhavsar', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', 'Mobile Centrix', '343434343434', '121212121212', '365', 'Memo  Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo ', '2012-04-01 00:31:38', 'Mobile Centrix'),
(10, 'First', 'Last', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', 'New Company', '343434343434', '121212121212', '2', 'this is teset', '2012-04-01 01:22:58', 'New Company'),
(11, 'vismay', 'kapadia', 'tohkbhavsar@gmail.com', 'Mr.', '23232323', '322323232323', '343434343434', '121212121212', '13', 'this is the notes', '2012-04-06 21:57:26', 'aaaaabbbb');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory` (
  `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_type` int(11) NOT NULL,
  `manufacturer_id` varchar(255) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_coast` float(10,2) NOT NULL,
  `product_retail_price` float(10,2) NOT NULL,
  `product_repair_price` float(10,2) NOT NULL,
  `product_lowest_price` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_lowest_qty` int(11) NOT NULL,
  `state_taxed` varchar(255) NOT NULL,
  `product_exception_price` float(10,2) NOT NULL,
  `barcode_type` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inventory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`inventory_id`, `product_id`, `product_type`, `manufacturer_id`, `vendor_id`, `product_qty`, `product_coast`, `product_retail_price`, `product_repair_price`, `product_lowest_price`, `product_description`, `product_lowest_qty`, `state_taxed`, `product_exception_price`, `barcode_type`, `date_added`) VALUES
(1, 1, 1, '0', 1, 120, 100.00, 120.00, 250.00, 10, 'Test this is', 15, '0', 15.00, 'auto', '2012-06-15 15:18:40'),
(2, 1, 1, 'LG', 1, 120, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'AL', 15.00, 'auto', '2012-06-15 15:38:17'),
(3, 1, 1, 'Motorola', 1, 120, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'ID', 15.00, 'auto', '2012-06-15 15:40:23'),
(4, 1, 1, 'Motorola', 1, 120, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'ID', 15.00, 'auto', '2012-06-15 15:41:55'),
(5, 1, 1, 'Motorola', 1, 120, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'ID', 15.00, 'auto', '2012-06-15 15:42:34'),
(6, 1, 1, 'Motorola', 1, 120, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'ID', 15.00, 'auto', '2012-06-15 15:42:42'),
(7, 1, 1, 'Motorola', 1, 120, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'ID', 15.00, 'auto', '2012-06-15 15:42:58'),
(8, 1, 1, 'Motorola', 1, 120, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'ID', 15.00, 'auto', '2012-06-15 15:43:33'),
(9, 1, 1, 'Motorola', 1, 120, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'ID', 15.00, 'auto', '2012-06-15 15:43:56'),
(10, 2, 1, 'Pantech', 1, 3, 100.00, 54.00, 125.00, 20, 'Descriptiion', 15, 'AZ', 150.00, 'auto', '2012-06-15 15:58:10'),
(11, 1, 1, 'Motorola', 1, 5, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'CA', 15.00, 'auto', '2012-06-15 16:38:49'),
(12, 3, 1, 'OEM', 1, 2, 10.00, 54.00, 200.00, 50, 'this is Description', 2, 'AL', 15.00, 'auto', '2012-06-15 16:49:37'),
(13, 4, 2, '', 10, 3, 100.00, 120.00, 200.00, 10, 'Descriptiion', 15, 'DE', 15.00, 'auto', '2012-06-15 17:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_barcode`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_barcode` (
  `inventory_barcode_id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `barcode_no` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inventory_barcode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_inventory_barcode`
--

INSERT INTO `tbl_inventory_barcode` (`inventory_barcode_id`, `inventory_id`, `barcode_no`, `date_added`) VALUES
(1, 2, '0', '2012-06-15 15:38:17'),
(2, 3, '0', '2012-06-15 15:40:23'),
(3, 7, '8', '2012-06-15 15:42:58'),
(4, 8, '8', '2012-06-15 15:43:33'),
(5, 9, '55', '2012-06-15 15:43:57'),
(6, 9, '5', '2012-06-15 15:43:57'),
(7, 9, '8', '2012-06-15 15:43:57'),
(8, 9, '7', '2012-06-15 15:43:57'),
(9, 9, '8', '2012-06-15 15:43:57'),
(10, 10, '12', '2012-06-15 15:58:10'),
(11, 10, '', '2012-06-15 15:58:10'),
(12, 10, '25', '2012-06-15 15:58:10'),
(13, 11, '2', '2012-06-15 16:38:49'),
(14, 11, '2', '2012-06-15 16:38:49'),
(15, 11, '2', '2012-06-15 16:38:49'),
(16, 11, '3', '2012-06-15 16:38:49'),
(17, 11, '4', '2012-06-15 16:38:49'),
(18, 12, '2', '2012-06-15 16:49:37'),
(19, 12, '2', '2012-06-15 16:49:37'),
(20, 13, '2', '2012-06-15 17:00:01'),
(21, 13, '5', '2012-06-15 17:00:01'),
(22, 13, '3', '2012-06-15 17:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE IF NOT EXISTS `tbl_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1 = phone , 2= accesorries , 3=other',
  `sku` varchar(255) DEFAULT '',
  `model` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `cost` float(10,2) DEFAULT NULL,
  `retail_price` float(10,2) DEFAULT NULL,
  `carrier` varchar(255) DEFAULT NULL,
  `repair_price` float(10,2) DEFAULT NULL,
  `lowest_price` float(10,2) DEFAULT NULL,
  `alt_barcode` varchar(255) DEFAULT NULL,
  `lowest_qty` int(11) DEFAULT NULL,
  `states_tax` varchar(255) DEFAULT NULL,
  `exception_price` float(10,2) DEFAULT NULL,
  `description` text,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_type`, `sku`, `model`, `manufacturer`, `cost`, `retail_price`, `carrier`, `repair_price`, `lowest_price`, `alt_barcode`, `lowest_qty`, `states_tax`, `exception_price`, `description`, `date_added`) VALUES
(1, '1', '123', 's2 black', 'Samsung', 0.00, 0.00, '', 0.00, 0.00, '', 12, 'ID', 0.00, 'this is desfription', '2012-06-01 00:30:19'),
(2, '1', '458', 'Model12', 'Motorola', 457.00, 254.00, 'all_carriers', 400.00, 478.00, '45678954', 50, 'AK', 50.00, 'Domain Book - eyeqdesigns.in  - 100 MB Space in Linux', '0000-00-00 00:00:00'),
(3, '1', '123', 'balck berry', 'HTC', 457.00, 25.00, 'all_carriers', 125.00, 121.00, '23456', 12, '', 12.00, 'Domain Renewal - gkksgroup.com', '2012-06-01 18:25:52'),
(4, '2', '1457854', 'Headphone', '', NULL, NULL, NULL, NULL, NULL, NULL, 10, 'CO', NULL, 'Test this is', '2012-06-15 16:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `vendor_email` varchar(255) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `vendor_notes` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendor_address` varchar(255) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_vendor`
--

INSERT INTO `tbl_vendor` (`vendor_id`, `first_name`, `last_name`, `vendor_email`, `work_phone`, `mobile_phone`, `vendor_notes`, `date_added`, `vendor_address`) VALUES
(1, 'Hardik Edit11222', 'Bhavsar', 'tohkbhavsar1212@gmail.com', '9426302828', '9879152626', 'fssdfsdfsdfsdfsdfsfd fsdfsfsf fsdfsdf sfsdfsdf sfsdf', '2012-03-29 22:41:03', 'Address'),
(2, 'Bhavsar', 'Hardik', 'tohkbhavsar@gmail.com', '23232323', '322323232323', 'Memo  Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo ', '2012-03-29 22:42:23', 'Compnay Name 2'),
(3, 'First Name', 'Hardik', 'tohkbhavsar@gmail.com', '23232323', '322323232323', 'Memo  Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo ', '2012-03-29 22:43:54', 'company name'),
(4, 'Compnay name', 'Hardik', 'tohkbhavsar@gmail.com', '23232323', '322323232323', 'this is notes', '2012-03-29 22:48:52', ''),
(5, 'Compnay name', 'Hardik', 'tohkbhavsar@gmail.com', '23232323', 'Compnay Name1', 'this is test', '2012-03-31 17:26:12', 'Compnay Name1'),
(8, 'Nikunj_Edited', 'Bhavsar_Edited', 'tohkbhavsar@gmail.com', '23232323', '322323232323', 'test this is', '2012-04-01 00:20:58', 'Sincorida'),
(9, 'Nikunj _Edit', 'Bhavsar', 'tohkbhavsar@gmail.com', '23232323', 'Mobile Centrix', 'Memo  Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo Memo ', '2012-04-01 00:31:38', 'Mobile Centrix'),
(10, 'First', 'Last', 'tohkbhavsar@gmail.com', '23232323', 'New Company', 'this is teset', '2012-04-01 01:22:58', 'New Company'),
(12, 'New', 'Vednor', 'test@gmail.com', '9426302828', '123456789', 'This is Test Notes..', '2012-06-11 21:44:02', '12 , Arihant Nagar Soc, IOC Road');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vemma_id` bigint(20) NOT NULL,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL,
  `status` char(1) NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prospect_id` bigint(20) NOT NULL,
  `vemma_sponsor_contact_id` bigint(20) NOT NULL COMMENT 'Store the Vemma Sponsor Contact id',
  `system_sponsor_contact_id` bigint(20) NOT NULL COMMENT 'Store the System''s Sponsor Contact id',
  `vemma_enroller_contact_id` bigint(20) NOT NULL COMMENT 'Store the Vemma Enroller Contact id',
  `parent_id` bigint(20) NOT NULL COMMENT 'system user_id',
  `ancestor_id` bigint(20) NOT NULL,
  `tree_level` int(11) NOT NULL,
  `binary_side` varchar(5) NOT NULL DEFAULT 'left',
  `left_child_id` bigint(20) NOT NULL DEFAULT '0',
  `right_child_id` bigint(20) NOT NULL DEFAULT '0',
  `cc_hash` text NOT NULL,
  `err_sync` int(1) NOT NULL COMMENT 'while inserting, set it to 0, while syncing the data, if error occurs, it is set to 1',
  `training_steps` text NOT NULL,
  `advanced_allocation` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `lead_allocation_left` tinyint(4) unsigned NOT NULL DEFAULT '50',
  `distributor` tinyint(1) NOT NULL DEFAULT '1',
  `email_optout` tinyint(4) NOT NULL DEFAULT '0',
  `phone` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1= Active , 0 = Inactive',
  `lead_allowed` enum('1','0') NOT NULL DEFAULT '0',
  `gw_username` varchar(256) DEFAULT NULL,
  `gw_password` varchar(256) DEFAULT NULL,
  `gw_api_loginid` varchar(255) NOT NULL COMMENT 'Getway API Login ID',
  `gw_api_tran_key` varchar(255) NOT NULL COMMENT 'Getway Transcation Key',
  `monthly_lead_count` int(11) NOT NULL DEFAULT '0',
  `lead_purchase_day` int(11) DEFAULT NULL COMMENT 'Day of month to purchase leads for recurring  lead purchases',
  `lead_source_id` int(11) DEFAULT NULL,
  `paidpack_credit` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `vemma_id_2` (`vemma_id`),
  KEY `created_date` (`created_date`,`prospect_id`,`parent_id`,`ancestor_id`,`binary_side`),
  KEY `last_name` (`last_name`),
  KEY `left_child_id` (`left_child_id`,`right_child_id`),
  KEY `vemma_id` (`vemma_id`),
  KEY `uniq_email` (`email`),
  KEY `lead_source_id` (`lead_source_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=373 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `vemma_id`, `email`, `username`, `password`, `status`, `first_name`, `last_name`, `logins`, `last_login`, `created_date`, `prospect_id`, `vemma_sponsor_contact_id`, `system_sponsor_contact_id`, `vemma_enroller_contact_id`, `parent_id`, `ancestor_id`, `tree_level`, `binary_side`, `left_child_id`, `right_child_id`, `cc_hash`, `err_sync`, `training_steps`, `advanced_allocation`, `lead_allocation_left`, `distributor`, `email_optout`, `phone`, `is_active`, `lead_allowed`, `gw_username`, `gw_password`, `gw_api_loginid`, `gw_api_tran_key`, `monthly_lead_count`, `lead_purchase_day`, `lead_source_id`, `paidpack_credit`) VALUES
(1, 993741205, 'crystal.durham@gmail.com', 'hardik', '3282907b9fd86e9824f283deecf8736bd9d3738dda6b75d02d', '', 'Hardik', 'Bhavsar', 831, 1340101137, '2011-12-13 20:45:55', 0, 0, 0, 0, 0, 0, 0, 'left', 0, 0, 'a:6:{s:8:"cardname";s:14:"Hardik Bhavsar";s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"216";s:8:"expmonth";s:1:"2";s:7:"expyear";s:4:"2012";}', 1, '2,3,4,5,6,7,8,', 0, 50, 1, 0, '', '1', '0', NULL, NULL, '6uEAPz6w4Kwy', '49Zu8C6H656BsxT3', 100, 10, 0, 0.00),
(2, 112339306, 'joelflaker@gmail.com', 'admin', '34b9c2c1ff73c8ae36595f1d4c714c1c4e145b48b428ac6802', '', 'Admin', 'User', 482, 1331976052, '2011-12-14 20:29:33', 0, 0, 0, 0, 0, 0, 0, 'left', 0, 0, '', 1, '1c,1b,1d,1e,1a,2a,2b,', 0, 100, 1, 0, '', '1', '', '', '', '', '', 0, 0, 0, 0.00),
(57, 9937412053, 'joelflaker@gmail.com', 'Development123', '3282907b9fd86e9824f283deecf8736bd9d3738dda6b75d02d', '', 'Development', ' App Pro', 132, 1331969071, '2012-02-13 06:44:42', 521, 993621805, 0, 895640905, 59, 0, 0, 'R', 0, 0, '', 0, '2,3,4,5', 20, 50, 1, 0, '', '1', '0', NULL, NULL, '', '', 500, 2, 0, 0.00),
(58, 999993105, 'joelflaker@gmail.com', 'Newsome123', '3282907b9fd86e9824f283deecf8736bd9d3738dda6b75d02d', '', 'Newsome', ' Charles', 1, 1328640163, '2012-01-26 18:03:33', 0, 996027105, 0, 985044305, 0, 0, 0, 'L', 0, 0, '', 0, '', 0, 50, 1, 0, '', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(59, 789716205, 'crystal.durham@gmail.com', 'Durham123', '3282907b9fd86e9824f283deecf8736bd9d3738dda6b75d02d', '', ' Crystal', 'Durham', 18, 1328908982, '2012-01-26 21:32:26', 0, 783327005, 0, 786040405, 1, 0, 0, 'L', 0, 0, '', 0, '2,3,', 0, 50, 1, 0, '', '1', '0', NULL, NULL, '', '', 500, 3, 0, 0.00),
(60, 100028006, '', 'Rutherford123', '697f67d5571727852dff02c10b15396022ee7751b1d35b39cc', '', 'Ruther', 'Ford', 0, NULL, '2012-01-27 17:30:02', 0, 997491405, 0, 995235105, 0, 0, 0, 'L', 0, 0, '', 0, '1,2,3', 0, 50, 1, 0, '', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(360, 9937412052, 'joelflaker@gmail.com', 'joel2', '3282907b9fd86e9824f283deecf8736bd9d3738dda6b75d02d', '', 'Joel', 'Flaker', 421, 1329229990, '2011-12-13 20:45:55', 0, 0, 0, 0, 0, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"123";s:8:"expmonth";s:1:"2";s:7:"expyear";s:4:"2011";}', 1, '2,3,4,5,', 0, 50, 1, 0, '', '1', '0', 'demo', 'password', '6uEAPz6w4Kwy', '49Zu8C6H656BsxT3', 100, 10, 0, 0.00),
(364, 134560806, 'jeffjohnson@igmail.com', 'testuser1011', 'db2f898d66324ac75f91902d3631e7aba5fa1c5f45cfb2f397', '', 'Jeff', 'Johnson', 0, NULL, '2012-02-24 01:09:10', 547, 0, 0, 0, 1, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDMyMTQzMjE0MzI3NDMyMQ==";s:6:"cc_cvc";s:3:"321";s:8:"expmonth";s:1:"1";s:7:"expyear";s:4:"2013";}', 0, '', 0, 50, 1, 0, '3104878049', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(365, 124545454, 'joel20123@gmail.com', 'Development12356', '84ead43dcf22eaf3fe75431991b9cd69e0ba58159fdaf70054', '', 'James', 'Nielson', 0, NULL, '2012-03-09 09:30:50', 546, 0, 0, 0, 1, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"124";s:8:"expmonth";s:1:"4";s:7:"expyear";s:4:"2014";}', 0, '', 0, 50, 1, 0, '8015551213', '', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(366, 1245454548989, 'joel201255883@gmail.com', 'Development12345858', '18d1dee935df0894e7febf80f39fc330c97a69fff01e6976bf', '', 'James', 'Nielson', 0, NULL, '2012-03-09 10:12:51', 547, 0, 0, 0, 1, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"124";s:8:"expmonth";s:1:"3";s:7:"expyear";s:4:"2013";}', 0, '', 0, 50, 1, 0, '8015551213', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(367, 101445, 'joel2012358@gmail.com', 'master58', 'ff75eeba9f738bdf476324540e15c05aeec0f12c626126c057', '', 'James', 'Nielson', 0, NULL, '2012-03-09 10:14:48', 548, 0, 0, 0, 1, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"124";s:8:"expmonth";s:1:"2";s:7:"expyear";s:4:"2013";}', 0, '', 0, 50, 1, 0, '8015551213', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(368, 101611, 'joel20123589@gmail.com', 'teratrae25', '1663531061872b7d35677d42ec3a321239efe69e9c3c4276f9', '', 'James', 'Nielson', 0, NULL, '2012-03-09 10:16:15', 549, 0, 0, 0, 1, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"124";s:8:"expmonth";s:1:"3";s:7:"expyear";s:4:"2013";}', 0, '', 0, 50, 1, 0, '8015551213', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(369, 101850, 'joel2012325@gmail.com', 'terater567', 'aae65e024cb4912dd28165f56b0ee8ddefe9deb9ff7c4533ba', '', 'James', 'Nielson', 0, NULL, '2012-03-09 10:18:53', 550, 0, 0, 0, 1, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"124";s:8:"expmonth";s:1:"2";s:7:"expyear";s:4:"2013";}', 0, '', 0, 50, 1, 0, '8015551213', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(370, 102015, '125@gmail.com', 'terater567589', '7fd8676492fb04028c2210ad109327d489cf9f1d0d736f5ac7', '', 'James', 'Nielson', 0, NULL, '2012-03-09 10:20:18', 551, 0, 0, 0, 1, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"124";s:8:"expmonth";s:1:"2";s:7:"expyear";s:4:"2013";}', 0, '', 0, 50, 1, 0, '8015551213', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(371, 102138, '12525@gmail.com', '5897895', '9791a435a8333d6f91ddb9cd2f473355c5eca5e344d2860480', '', 'James', 'Nielson', 0, NULL, '2012-03-09 10:21:41', 552, 0, 0, 0, 1, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"124";s:8:"expmonth";s:1:"2";s:7:"expyear";s:4:"2013";}', 0, '', 0, 50, 1, 0, '8015551213', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00),
(372, 104026, '1251825@gmail.com', '158978895', 'c0b2fb7a0f475366d4aeb9ec04b9ceeeaed84598cca8ff63f5', '', 'James', 'Nielson', 0, NULL, '2012-03-09 10:40:31', 553, 0, 0, 0, 1, 0, 0, 'left', 0, 0, 'a:5:{s:8:"cardtype";s:4:"Visa";s:10:"cardnumber";s:24:"NDExMTExMTExMTExMTExMQ==";s:6:"cc_cvc";s:3:"124";s:8:"expmonth";s:1:"2";s:7:"expyear";s:4:"2013";}', 0, '', 0, 50, 1, 0, '8015551213', '1', '0', NULL, NULL, '', '', 0, NULL, NULL, 0.00);
