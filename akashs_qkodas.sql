-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2022 at 12:32 PM
-- Server version: 10.6.7-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akashs_qkodas`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutpage`
--

CREATE TABLE `aboutpage` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `dateandtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutpage`
--

INSERT INTO `aboutpage` (`id`, `title`, `description`, `dateandtime`) VALUES
(1, 'About Us', '<p>About us</p>\r\n', 1599280807);

-- --------------------------------------------------------

--
-- Table structure for table `active_pages`
--

CREATE TABLE `active_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `active_pages`
--

INSERT INTO `active_pages` (`id`, `name`, `enabled`) VALUES
(1, 'blog', 1);

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agent_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `fcmtoken` mediumtext NOT NULL,
  `ac_type` varchar(20) NOT NULL,
  `phone_1` varchar(20) NOT NULL,
  `phone_2` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agent_id`, `name`, `phone`, `address`, `email`, `status`, `fcmtoken`, `ac_type`, `phone_1`, `phone_2`, `city`) VALUES
(2, 'SIDDHI VINAYAK GROUP', '9099384773', 'bajar visatar, kareli, surat, gangadhara Rs, gujarat, 394310\r\npanchshil society, behaind rajesh society', 'vasimlook@gmail.com', 1, '', '', '', '', ''),
(3, 'b', '09099384773', 'bajar visatar, kareli, surat, gangadhara Rs, gujarat, 394310\r\npanchshil society, behaind rajesh society', 'vasimlook@gmail.com', 1, '', '', '', '', ''),
(4, 'c', '09099384773', 'bajar visatar, kareli, surat, gangadhara Rs, gujarat, 394310\r\npanchshil society, behaind rajesh society', 'vasimlook@gmail.com', 1, '', '', '', '', ''),
(5, 'd', '8585878542', 'bajar visatar, kareli, surat, gangadhara Rs, gujarat, 394310\r\npanchshil society, behaind rajesh society', 'abc@gmail.com', 0, '', '', '', '', ''),
(10, 'AASTHA AGENCY', '8866447692', '', 'test@gmail.com', 1, '', 'BROKER/AGENT', '7867867869', '9374151718', 'SURAT'),
(13, 'A P SAREE HOUSE', 'SIDDHI VINAYAK GROUP', '', '', 1, '', 'SUNDRY DEBTORS', '9014362683', '', 'HYDERABAD');

-- --------------------------------------------------------

--
-- Table structure for table `app_slider`
--

CREATE TABLE `app_slider` (
  `id` int(11) NOT NULL,
  `imagename` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `productid` int(11) NOT NULL,
  `slider_type` varchar(56) COLLATE utf8mb3_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `youtubeurl` text COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `app_slider`
--

INSERT INTO `app_slider` (`id`, `imagename`, `productid`, `slider_type`, `position`, `youtubeurl`) VALUES
(43, '1646646007_CD.jpg', 33, 'Application', 1, ''),
(44, '1646646076_CD.jpg', 33, 'Application', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attributes_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `refAttributes_group_id` int(30) NOT NULL,
  `sort_order` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attributes_id`, `title`, `refAttributes_group_id`, `sort_order`, `status`) VALUES
(3, 'FANCY EXCLUSIVE LACE', 3, 1, 1),
(4, 'JAQUARD RICH LACE', 3, 2, 1),
(5, 'ANTIQUE LACES', 3, 3, 1),
(6, 'FANCY LACE', 3, 4, 1),
(7, 'DIGITAL LACE', 3, 5, 1),
(8, 'DESIGNER LACES', 3, 6, 1),
(9, 'BANARASI BORDER', 3, 7, 1),
(10, 'ANTIQUE WORK LACE', 3, 8, 1),
(11, 'PEARL DIGITAL LACE', 3, 9, 1),
(12, 'CREATIVE EXCLUSIVE LACES', 3, 10, 1),
(13, 'HEAVY DESIGNER BORDER', 3, 11, 1),
(14, 'Full Catalog', 4, 1, 1),
(15, '1 Piece', 4, 2, 1),
(16, 'JAQUARD BLOUSE', 5, 1, 1),
(17, 'Art Silk', 5, 2, 1),
(18, 'HEAVY JAQUARD BLOUSE', 5, 3, 1),
(19, 'HEAVY SOFT SILK BLOUSE', 5, 4, 1),
(20, 'Banarasi Silk', 5, 5, 1),
(21, 'HEAVY BLOUSE', 5, 6, 1),
(22, 'ANTIQUE BLOUSE', 5, 7, 1),
(23, 'EMB .BLOUSE', 5, 8, 1),
(24, 'Ceremony', 5, 9, 1),
(25, 'FANCY BLOUSE', 5, 10, 1),
(26, 'IMPORTED BLOUSE', 5, 11, 1),
(27, 'HEAVY BLOUSE', 5, 12, 1),
(28, 'FANCY BLOUSE', 5, 13, 1),
(29, 'Digital Blouse', 5, 14, 1),
(30, 'KURTI', 6, 1, 1),
(31, 'WEAVING', 6, 2, 1),
(32, 'SAREES', 6, 3, 1),
(33, 'Un Stitched', 7, 1, 1),
(34, 'Semi Stitched', 7, 2, 1),
(35, 'IVORY WORK', 8, 1, 1),
(36, 'POGO WORK', 8, 2, 1),
(37, 'Diamond Work', 8, 3, 1),
(38, 'PEARL PROCESS', 8, 4, 1),
(39, 'VALUE ADDITION', 8, 5, 1),
(40, 'Embroidered', 8, 5, 1),
(41, 'SIROSKI WORK', 8, 7, 1),
(42, 'Butti', 8, 8, 1),
(43, 'CRYSTAL IVORY MILL PRINYT', 8, 9, 1),
(44, 'Casual Wear', 9, 1, 1),
(45, 'Ceremonial', 9, 2, 1),
(46, 'Casual', 9, 3, 1),
(59, 'PURE WEIGHTLESS', 10, 1, 1),
(60, 'WEAVING JEQUARD BORDER', 10, 2, 1),
(61, 'Black Twill Dangal Chiffon', 10, 3, 1),
(62, 'FANCY PREMIUM FABRICS', 10, 4, 1),
(63, 'C*C VISCOSE PATTERN', 10, 5, 1),
(64, 'Magic Brasso', 10, 6, 1),
(65, 'MAJOR GEORGETTE', 10, 7, 1),
(66, 'Besil Silk', 10, 8, 1),
(67, 'SAUDI GEOGETTE', 10, 9, 1),
(68, 'PURE GEORGETTE', 10, 10, 1),
(69, 'BRIGHT MILANO SILK', 10, 11, 1),
(70, 'VICHITRA PATTERN', 10, 12, 1),
(71, 'FANCY FABRICS GEOGETTE BASE', 10, 13, 1),
(72, 'BRASSO PATTERN', 10, 14, 1),
(73, 'MULTI FANCY FABRICS', 10, 15, 1),
(74, 'Chiffon', 10, 16, 1),
(75, 'BUMBER GEORGEETE', 10, 18, 1),
(76, 'C*C KETONIC PATTERN', 10, 19, 1),
(77, 'PATTERN BRASSO', 10, 20, 1),
(78, 'PC TWILL PATTERN', 10, 21, 1),
(79, 'HEAVY WEIGHTLESS', 10, 22, 1),
(80, 'BRASSO', 10, 23, 1),
(81, 'PATTERN CHIFFON', 10, 24, 1),
(82, 'SATRANGI CHIFFON', 10, 25, 1),
(83, 'COTTON', 10, 26, 1),
(84, 'FOX GEORGETTE', 10, 27, 1),
(85, 'Art Silk', 10, 28, 1),
(86, 'CRAZY GEORGETTE', 10, 29, 1),
(87, 'MILKY CHIFFON', 10, 30, 1),
(88, 'GEORGETTE WITH FANCY BORDER', 10, 31, 1),
(89, 'GEORGETTE', 10, 32, 1),
(90, 'vichitra silk', 10, 33, 1),
(91, 'C*C', 10, 32, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attributes_group`
--

CREATE TABLE `attributes_group` (
  `attributesgroup_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `sort_order` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributes_group`
--

INSERT INTO `attributes_group` (`attributesgroup_id`, `title`, `sort_order`, `status`) VALUES
(3, 'LACE', 1, 1),
(4, 'MOQ', 2, 1),
(5, 'BLOUSE', 3, 1),
(6, 'CATAGORY', 4, 1),
(7, 'TYPE', 5, 1),
(8, 'WORK', 6, 1),
(9, 'OCCASION', 7, 1),
(10, 'FABRICS', 8, 1),
(11, 'a', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `bic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cartdetails`
--

CREATE TABLE `cartdetails` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ProductType` varchar(20) NOT NULL,
  `user_type` enum('user','admin') NOT NULL DEFAULT 'user',
  `comment` longtext NOT NULL,
  `hindicomment` longtext NOT NULL,
  `audiofile` text NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `confirm_links`
--

CREATE TABLE `confirm_links` (
  `id` int(11) NOT NULL,
  `link` char(32) NOT NULL,
  `for_order` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `confirm_links`
--

INSERT INTO `confirm_links` (`id`, `link`, `for_order`) VALUES
(1, '9bfdedb529d287945e42489fbfaed641', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `connproduct`
--

CREATE TABLE `connproduct` (
  `id` int(11) NOT NULL,
  `refProductId` int(30) NOT NULL,
  `connProductId` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `connproduct`
--

INSERT INTO `connproduct` (`id`, `refProductId`, `connProductId`) VALUES
(8, 33, 17),
(9, 33, 21);

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law`
--

CREATE TABLE `cookie_law` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `theme` varchar(20) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cookie_law`
--

INSERT INTO `cookie_law` (`id`, `link`, `theme`, `visibility`) VALUES
(1, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law_translations`
--

CREATE TABLE `cookie_law_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `button_text` varchar(50) NOT NULL,
  `learn_more` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cookie_law_translations`
--

INSERT INTO `cookie_law_translations` (`id`, `message`, `button_text`, `learn_more`, `abbr`, `for_id`) VALUES
(1, '', '', '', 'en', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupan`
--

CREATE TABLE `coupan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `codelimit` int(11) NOT NULL,
  `enddate` varchar(56) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `discount` int(11) NOT NULL,
  `discounttype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupan`
--

INSERT INTO `coupan` (`id`, `name`, `code`, `codelimit`, `enddate`, `isactive`, `discount`, `discounttype`) VALUES
(4, '10% offf', 'ram', 0, '1613154600', 1, 10, 'Percentage'),
(5, 'Chetan', 'TEST', 0, '1614709800', 1, 10, 'Percentage'),
(6, 'radha', 'testing', 0, '1612809000', 0, 20, 'Percentage'),
(7, 'rits', 'Flat10', 0, '1612117800', 1, 10, 'Percentage'),
(8, 'DEMO', 'DEMO1', 0, '1612809000', 1, 99, 'Percentage'),
(9, 'ram1', 'ram1', 0, '1613068200', 1, 30, 'Percentage'),
(10, 'Test', 'tst', 0, '1613586600', 1, 5, 'Percentage'),
(12, 'central bank of india', '543206', 0, '1648578600', 0, 50, 'Amount'),
(13, 'central bank of india', '543206', 0, '1648665000', 0, 500, 'Amount');

-- --------------------------------------------------------

--
-- Table structure for table `device_history`
--

CREATE TABLE `device_history` (
  `device_history_id` int(11) NOT NULL,
  `refUser_app_id` int(30) NOT NULL,
  `device_id` text NOT NULL,
  `datetime_added` datetime NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `device_history_agent`
--

CREATE TABLE `device_history_agent` (
  `device_history_id` int(11) NOT NULL,
  `refAgent_id` int(30) NOT NULL,
  `device_id` text NOT NULL,
  `datetime_added` datetime NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `directorder_chatmessenger`
--

CREATE TABLE `directorder_chatmessenger` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `read_status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `valid_from_date` int(10) UNSIGNED NOT NULL,
  `valid_to_date` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-enabled, 0-disabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(11) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `currencyKey` varchar(5) NOT NULL,
  `flag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `abbr`, `name`, `currency`, `currencyKey`, `flag`) VALUES
(2, 'en', 'english', '$', 'USD', 'en.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `likepreproduct`
--

CREATE TABLE `likepreproduct` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `likestatus` int(11) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likepreproduct`
--

INSERT INTO `likepreproduct` (`id`, `userid`, `productid`, `likestatus`, `dateandtime`) VALUES
(1, 36, 2, 0, '2022-01-24 14:42:52'),
(2, 36, 3, 0, '2022-01-24 14:42:52'),
(3, 53, 3, 1, '2022-01-24 14:42:52'),
(4, 66, 3, 1, '2022-01-24 14:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `likepreproductimg`
--

CREATE TABLE `likepreproductimg` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `imgname` text NOT NULL,
  `likestatus` varchar(256) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likepreproductimg`
--

INSERT INTO `likepreproductimg` (`id`, `userid`, `imgname`, `likestatus`, `dateandtime`) VALUES
(2, 36, '1619173243-0', '1', '2022-01-24 14:42:52'),
(3, 36, '1619173243-1', '0', '2022-01-24 14:42:52'),
(4, 36, '1619173243-10', '0', '2022-01-24 14:42:52'),
(5, 36, '1619173243-11', '1', '2022-01-24 14:42:52'),
(6, 36, '1619173243-12', '0', '2022-01-24 14:42:52'),
(7, 36, '1619173243-13', '1', '2022-01-24 14:42:52'),
(8, 36, '1619173243-14', '0', '2022-01-24 14:42:52'),
(9, 53, '1605263606-01', '0', '2022-01-24 14:42:52'),
(10, 53, '1619173243-11', '1', '2022-01-24 14:42:52'),
(11, 53, '1619173243-13', '1', '2022-01-24 14:42:52'),
(12, 53, '1619173243-1', '1', '2022-01-24 14:42:52'),
(13, 66, '1619173243-0', '1', '2022-01-24 14:42:52'),
(16, 66, '1619173243-12', '1', '2022-01-24 14:42:52'),
(21, 66, '1619173243-17', '1', '2022-01-24 14:42:52'),
(22, 66, '1619173243-2', '1', '2022-01-24 14:42:52'),
(23, 66, '1619173243-3', '0', '2022-01-24 14:42:52'),
(24, 66, '1619173243-4', '0', '2022-01-24 14:42:52'),
(25, 66, '1619173243-5', '0', '2022-01-24 14:42:52'),
(26, 66, '1619173243-6', '1', '2022-01-24 14:42:52'),
(27, 66, '1619173243-7', '0', '2022-01-24 14:42:52'),
(28, 66, '1619173243-8', '1', '2022-01-24 14:42:52'),
(29, 66, '1619173243-9', '1', '2022-01-24 14:42:52'),
(30, 36, '1619173243-15', '1', '2022-01-24 14:42:52'),
(31, 36, '1619173243-16', '1', '2022-01-24 14:42:52'),
(32, 36, '1619173243-17', '1', '2022-01-24 14:42:52'),
(33, 36, '1619173243-2', '1', '2022-01-24 14:42:52'),
(34, 36, '1619173243-3', '0', '2022-01-24 14:42:52'),
(35, 36, '1619173243-4', '0', '2022-01-24 14:42:52'),
(36, 36, '1619173243-5', '0', '2022-01-24 14:42:52'),
(37, 36, '1619173243-6', '1', '2022-01-24 14:42:52'),
(38, 36, '1619173243-7', '1', '2022-01-24 14:42:52'),
(39, 36, '1619173243-8', '1', '2022-01-24 14:42:52'),
(40, 36, '1619173243-9', '0', '2022-01-24 14:42:52'),
(41, 66, '1605263606-01', '0', '2022-01-24 14:42:52'),
(42, 66, '1619173243-10', '1', '2022-01-24 14:42:52'),
(43, 66, '1619173243-1', '0', '2022-01-24 14:42:52'),
(44, 66, '1619173243-11', '1', '2022-01-24 14:42:52'),
(45, 66, '1619173243-13', '1', '2022-01-24 14:42:52'),
(46, 66, '1619173243-14', '0', '2022-01-24 14:42:52'),
(47, 66, '1619173243-16', '1', '2022-01-24 14:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `likeproductimg`
--

CREATE TABLE `likeproductimg` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `imgname` text NOT NULL,
  `likestatus` varchar(256) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likeproductimg`
--

INSERT INTO `likeproductimg` (`id`, `userid`, `imgname`, `likestatus`, `dateandtime`) VALUES
(1, 36, '1619004207-10', '0', '2022-01-24 14:42:52'),
(2, 36, '1619004207-12', '0', '2022-01-24 14:42:52'),
(3, 36, '1619004207-14', '0', '2022-01-24 14:42:52'),
(4, 36, '1619004207-16', '0', '2022-01-24 14:42:52'),
(5, 36, '1619004207-17', '0', '2022-01-24 14:42:52'),
(6, 36, '1619004207-2', '0', '2022-01-24 14:42:52'),
(7, 36, '1619004207-3', '0', '2022-01-24 14:42:52'),
(8, 36, '1619004207-4', '0', '2022-01-24 14:42:52'),
(9, 36, '1619004207-5', '0', '2022-01-24 14:42:52'),
(10, 36, '1619004207-15', '1', '2022-01-24 14:42:52'),
(11, 36, '1619004207-0', '1', '2022-01-24 14:42:52'),
(12, 36, '1619004207-1', '0', '2022-01-24 14:42:52'),
(13, 36, '1619004207-11', '1', '2022-01-24 14:42:52'),
(14, 36, '1619004207-13', '0', '2022-01-24 14:42:52'),
(16, 53, '1610352186-12', '1', '2022-01-24 14:42:52'),
(17, 53, '1610352186-13', '1', '2022-01-24 14:42:52'),
(18, 53, '1619004207-14', '0', '2022-01-24 14:42:52'),
(19, 53, '1619004207-13', '1', '2022-01-24 14:42:52'),
(20, 53, '1619004207-16', '1', '2022-01-24 14:42:52'),
(21, 66, '1619337034-0', '1', '2022-01-24 14:42:52'),
(22, 66, '1619337034-1', '1', '2022-01-24 14:42:52'),
(23, 66, '1619337034-10', '1', '2022-01-24 14:42:52'),
(24, 66, '1619337034-11', '1', '2022-01-24 14:42:52'),
(25, 66, '1619337034-12', '1', '2022-01-24 14:42:52'),
(26, 66, '1619337034-13', '1', '2022-01-24 14:42:52'),
(27, 66, '1619337034-14', '1', '2022-01-24 14:42:52'),
(28, 66, '1619337034-15', '1', '2022-01-24 14:42:52'),
(29, 66, '1619337034-16', '1', '2022-01-24 14:42:52'),
(30, 66, '1619337034-17', '1', '2022-01-24 14:42:52'),
(31, 66, '1619337034-2', '1', '2022-01-24 14:42:52'),
(32, 66, '1619337034-3', '1', '2022-01-24 14:42:52'),
(33, 66, '1619337034-4', '1', '2022-01-24 14:42:52'),
(34, 66, '1619337034-5', '1', '2022-01-24 14:42:52'),
(35, 66, '1619337034-6', '1', '2022-01-24 14:42:52'),
(36, 66, '1619337034-7', '1', '2022-01-24 14:42:52'),
(37, 66, '1619337034-8', '1', '2022-01-24 14:42:52'),
(38, 66, '1619337034-9', '1', '2022-01-24 14:42:52'),
(49, 36, '1619337034-4', '1', '2022-01-24 14:42:52'),
(50, 36, '1619337034-5', '0', '2022-01-24 14:42:52'),
(51, 36, '1619337034-6', '1', '2022-01-24 14:42:52'),
(52, 36, '1619337034-7', '1', '2022-01-24 14:42:52'),
(53, 36, '1619337034-8', '1', '2022-01-24 14:42:52'),
(54, 36, '1619337034-9', '1', '2022-01-24 14:42:52'),
(56, 32, '1619337034-0', '0', '2022-01-24 14:42:52'),
(57, 32, '1619337034-1', '1', '2022-01-24 14:42:52'),
(58, 32, '1619337034-10', '1', '2022-01-24 14:42:52'),
(59, 32, '1619337034-11', '0', '2022-01-24 14:42:52'),
(60, 32, '1619337034-12', '1', '2022-01-24 14:42:52'),
(61, 32, '1619337034-13', '1', '2022-01-24 14:42:52'),
(62, 32, '1619337034-14', '1', '2022-01-24 14:42:52'),
(63, 32, '1619337034-15', '1', '2022-01-24 14:42:52'),
(64, 32, '1619337034-16', '1', '2022-01-24 14:42:52'),
(65, 32, '1619337034-17', '0', '2022-01-24 14:42:52'),
(66, 32, '1619337034-2', '1', '2022-01-24 14:42:52'),
(67, 32, '1619337034-3', '0', '2022-01-24 14:42:52'),
(68, 32, '1619337034-4', '1', '2022-01-24 14:42:52'),
(69, 32, '1619337034-5', '1', '2022-01-24 14:42:52'),
(70, 32, '1619337034-6', '1', '2022-01-24 14:42:52'),
(71, 32, '1619337034-7', '0', '2022-01-24 14:42:52'),
(72, 32, '1619337034-8', '1', '2022-01-24 14:42:52'),
(73, 32, '1619337034-9', '1', '2022-01-24 14:42:52'),
(75, 52, '1619337034-1', '1', '2022-01-24 14:42:52'),
(76, 52, '1619337034-10', '1', '2022-01-24 14:42:52'),
(77, 52, '1619337034-11', '1', '2022-01-24 14:42:52'),
(78, 52, '1619337034-12', '1', '2022-01-24 14:42:52'),
(79, 52, '1619337034-13', '1', '2022-01-24 14:42:52'),
(80, 52, '1619337034-14', '1', '2022-01-24 14:42:52'),
(81, 52, '1619337034-15', '1', '2022-01-24 14:42:52'),
(82, 52, '1619337034-16', '1', '2022-01-24 14:42:52'),
(83, 52, '1619337034-17', '1', '2022-01-24 14:42:52'),
(84, 52, '1619337034-2', '1', '2022-01-24 14:42:52'),
(85, 52, '1619337034-3', '1', '2022-01-24 14:42:52'),
(86, 52, '1619337034-4', '1', '2022-01-24 14:42:52'),
(87, 52, '1619337034-5', '1', '2022-01-24 14:42:52'),
(88, 52, '1619337034-6', '1', '2022-01-24 14:42:52'),
(89, 52, '1619337034-7', '1', '2022-01-24 14:42:52'),
(90, 52, '1619337034-8', '1', '2022-01-24 14:42:52'),
(91, 52, '1619337034-9', '1', '2022-01-24 14:42:52'),
(92, 36, '1619336823-15', '0', '2022-01-24 14:42:52'),
(93, 36, '1619003814-0', '1', '2022-01-24 14:42:52'),
(96, 66, '1619336823-0', '1', '2022-01-24 14:42:52'),
(98, 66, '1619336823-10', '0', '2022-01-24 14:42:52'),
(99, 66, '1619336823-11', '0', '2022-01-24 14:42:52'),
(100, 66, '1619336823-1', '0', '2022-01-24 14:42:52'),
(101, 70, '1604064582-10', '1', '2022-01-24 14:42:52'),
(102, 70, '1604064582-11', '1', '2022-01-24 14:42:52'),
(103, 70, '1604064582-12', '0', '2022-01-24 14:42:52'),
(104, 70, '1604064582-13', '1', '2022-01-24 14:42:52'),
(105, 70, '1604064582-17', '1', '2022-01-24 14:42:52'),
(110, 36, '1619337034-1', '1', '2022-01-24 14:42:52'),
(112, 3, '1619337034-0', '1', '2022-01-24 14:42:52'),
(113, 3, '1619337034-1', '1', '2022-01-24 14:42:52'),
(114, 3, '1619337034-10', '1', '2022-01-24 14:42:52'),
(115, 3, '1619337034-11', '1', '2022-01-24 14:42:52'),
(118, 52, '1622999263-1', '1', '2022-01-24 14:42:52'),
(119, 52, '1619004012-0', '1', '2022-01-24 14:42:52'),
(120, 43, '1604064972-0', '1', '2022-01-24 14:42:52'),
(121, 90, '1605263871-11', '1', '2022-01-24 14:42:52'),
(122, 52, '1628706224-0', '1', '2022-01-24 14:42:52'),
(123, 52, '1628706224-10', '1', '2022-01-24 14:42:52'),
(124, 90, '1628705312-0', '1', '2022-01-24 14:42:52'),
(125, 90, '1631037536-1', '1', '2022-01-24 14:42:52'),
(126, 120, '1616868964-0', '1', '2022-01-24 14:42:52'),
(128, 121, '1604064648-0', '1', '2022-01-24 14:42:52'),
(129, 122, '1612598428-0', '1', '2022-01-24 14:42:52'),
(130, 122, '1612599213-15', '1', '2022-01-24 14:42:52'),
(131, 122, '1612599213-16', '1', '2022-01-24 14:42:52'),
(132, 123, '1631037750-14', '1', '2022-01-24 14:42:52'),
(133, 123, '1631037750-0', '1', '2022-01-24 14:42:52'),
(135, 126, '1616869044-11', '1', '2022-01-24 14:42:52'),
(136, 133, '1631038110-0', '1', '2022-01-24 14:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `mobileuser`
--

CREATE TABLE `mobileuser` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobilenumber` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `fcmtoken` mediumtext NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobileuser`
--

INSERT INTO `mobileuser` (`id`, `name`, `mobilenumber`, `password`, `fcmtoken`, `dateandtime`) VALUES
(1, 'jignesh viradiya', '8866609172', 'e10adc3949ba59abbe56e057f20f883e', '', '2022-01-24 14:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `dateadded`) VALUES
(9, 'amitsingh7052955262@gmail.com', '2021-02-04 07:18:33'),
(10, 'Testclicktest@gmail.com', '2021-02-06 06:48:21'),
(11, 'bhavsarm713@gmail.com', '2021-02-07 07:16:10'),
(12, 'nikhilgurjar149@gmail.com', '2021-02-07 09:03:12'),
(14, 'atul.ielts@gmail.com', '2021-02-09 16:42:02'),
(15, 'Sanjeetkumarsingh68@gmail.com', '2021-02-14 07:43:52'),
(16, 'Om63pharmacist@gmail.com', '2021-02-14 08:55:19'),
(17, 'kailash5678910@gmail.com', '2021-02-15 11:04:25'),
(18, 'ravi.aswin123@gmail.com', '2021-02-15 15:54:44'),
(19, 'harendray192@gmail.com', '2021-02-16 14:17:28'),
(20, 'pushparaut4545@Gmail.com', '2021-02-16 16:41:29'),
(21, 'amankumar53690@gamal.con', '2021-02-18 12:17:43'),
(22, 'PRATEEK3445@GMAIL.COM', '2021-02-18 12:43:22'),
(23, 'brijpalgpo@gmail.com', '2021-02-20 07:25:57'),
(24, 'guptajiparas540@gmail.com', '2021-02-20 11:58:54'),
(25, 'anupguptajgd@gmail.com', '2021-02-25 04:46:55'),
(26, 'rupeshlinkedin@gmail.com', '2021-02-25 08:01:14'),
(27, 'Raj.panjwani@gmail.com', '2021-03-01 11:59:39'),
(28, 'raniu0994@gmail.com', '2021-03-02 10:31:52'),
(29, 'govinduj26@gmail.com', '2021-03-02 16:30:43'),
(30, 'Agarwal.surya695@gmail.com', '2021-03-04 07:34:19'),
(31, 'mithun_id07@rediffmail.com', '2021-03-04 09:43:03'),
(32, 'sanjaytripathi4792@gmail.com', '2021-03-11 12:15:26'),
(33, 'vickysneha007@gmail.com', '2021-03-12 13:27:18'),
(34, 'Karannikum979@gmail.com', '2021-03-19 05:49:57'),
(35, 'HSRAJPUROHIT803@GMAIL.COM', '2021-03-22 08:17:53'),
(36, 'varthalasaravana@gmail.com', '2021-03-23 15:16:28'),
(37, 'kavitapiyush0@gmail.com', '2021-03-31 14:05:31'),
(38, 'Prajapatis49@gmail.com', '2021-04-05 04:59:12'),
(39, 'gpoonkodisuruthi@g.mail.com', '2021-04-12 17:53:30'),
(40, 'sumanjangid8383@gmail.com', '2021-04-13 10:48:50'),
(41, 'nmnmhjg@gmail.com', '2021-04-15 08:22:35'),
(42, 'hgjjfff@gmail.com', '2021-04-15 08:24:32'),
(43, 'ashwiniasakhare30@gmail.com', '2021-04-26 05:46:10'),
(44, 'renutiwari2828@gmail.com', '2021-04-28 15:10:21'),
(45, 'bkass.sah60.bs@gmail.com', '2021-04-28 18:50:25'),
(47, 'Mr.adityadarshan@gmail.com', '2021-05-01 12:34:29'),
(48, 'nkmehta8987@gmail.com', '2021-05-04 06:09:01'),
(49, 'sahevealasiddiqui093@gmail.com', '2021-05-12 06:48:38'),
(50, 'r02s02@gmail.com', '2021-05-16 09:52:31'),
(51, 'biradarpriyanka2016@gmail.com', '2021-05-16 13:18:48'),
(52, 'yadavbipinkumar490@gmail.com', '2021-05-17 03:20:23'),
(53, 'lingamnandini08@gmail.com', '2021-05-23 09:24:27'),
(55, 'nishagupta6578@gmail.com', '2021-06-01 11:11:20'),
(56, 'bkraj240@gmail.com', '2021-06-05 02:38:00'),
(57, 'drsunilkumarpgdav@gmail.com', '2021-06-07 05:46:04'),
(58, 'Sonambhadouriya4304@gmail.com', '2021-06-08 12:44:36'),
(59, 'lalitv0995@gmail.com', '2021-06-11 09:01:22'),
(60, 'vikasbarde437@gmail.com', '2021-06-14 06:06:58'),
(61, 'Sandeep.pandey6300@gmail.com', '2021-06-14 16:51:40'),
(62, 'kamleshkumar90639@gmail.com', '2021-06-19 02:58:58'),
(63, 'rohinimuluk14@gmail.com', '2021-06-22 02:00:51'),
(64, 'sudhirkr10091981@gmail.com', '2021-06-22 09:57:50'),
(65, 'agarwalsangeeta154@gmail.com', '2021-06-22 11:57:15'),
(66, 'Shreeshreebalajifabrics@gmail', '2021-06-23 11:02:02'),
(67, 'Shreeshreebalajifabrics@gmail.com', '2021-06-23 11:40:46'),
(68, 'adarshverma9565131224@gmail.com', '2021-06-25 06:30:52'),
(69, 'ajaysawal443@gmail.com', '2021-06-28 01:12:55'),
(70, 'sanjeevsumandream@gmail.com', '2021-06-30 05:45:14'),
(71, 'mukeshsarswat0031@gmail.com', '2021-07-07 13:33:22'),
(72, 'soubhagyamaharana83@gmail.com', '2021-07-08 02:40:57'),
(73, 'sibaram1385@gmail.com', '2021-07-13 17:26:12'),
(74, 'sarvansingh7155@gmail.com', '2021-07-15 10:23:40'),
(75, 'thippeswamy16988@gmail.com', '2021-07-15 14:27:04'),
(76, 'ashok2singh3@gmial', '2021-07-18 17:09:41'),
(77, 'savitri.patil03@gmail.com', '2021-07-21 07:59:18'),
(78, 'shail22.1986@gmail.com', '2021-07-21 12:40:47'),
(79, 'Sales@ramrasiyasarees.com', '2021-07-22 07:05:55'),
(80, 'dinesh4941@rediffmail.com', '2021-07-22 10:39:48'),
(81, 'Mantamahormam@gmail.com', '2021-07-23 06:43:42'),
(82, 'ramany185@gmai.com', '2021-07-27 06:59:04'),
(83, 'Mahadevmahapatro@gmail.com', '2021-07-28 04:19:10'),
(84, 'Dililpbhati9500@gmail.com', '2021-07-28 05:29:03'),
(85, 'alpine.suraj@gmail.com', '2021-07-28 07:40:39'),
(86, 'mahendrakumar84502@gmail.com', '2021-07-29 13:52:53'),
(87, 'ratnakadli005@gmail.com', '2021-07-29 13:59:01'),
(88, 'moriusha1977@gmail.com', '2021-07-31 13:44:15'),
(89, 'alexanuproy141@gmail.com', '2021-08-03 07:13:46'),
(90, 'nitinupadhyay1011@gmail.com', '2021-08-04 16:41:21'),
(91, 'balenderrao01@gmail.com', '2021-08-05 06:47:11'),
(92, 'Sachinsk.sc22@gmail.com', '2021-08-05 07:25:16'),
(93, 'shubhlaxmitorpa@gmail.com', '2021-08-07 04:01:00'),
(94, 'abhinavsul@gmail.com', '2021-08-07 08:57:04'),
(95, 'bharatrouniyaar515@gmail.com', '2021-08-07 16:45:48'),
(96, 'Sunil.11hum@gmail.com', '2021-08-09 04:03:16'),
(97, 'Rk8243327@gmail.com', '2021-08-09 06:29:02'),
(98, 'Khalsamanmeet06@gmail.com', '2021-08-11 14:56:40'),
(99, 'nandinikyadav124@gmail.com', '2021-08-12 08:55:17'),
(100, 'ttcslg@gmail.com', '2021-08-13 06:40:01'),
(101, 'suvarnamp1993@gmail.com', '2021-08-13 18:17:38'),
(102, 'Ashishgarg1973@yahoo.com', '2021-08-20 08:07:49'),
(103, 'nnd_balaji@yahoo.co.in', '2021-08-23 06:01:16'),
(104, 'dipali.d.patil@gmail.com', '2021-08-25 12:52:10'),
(105, 'Dinkarraimau@gmail.com', '2021-08-25 16:01:24'),
(106, 'kritagyagupta48@gmail.com', '2021-08-26 11:55:54'),
(107, 'selvamdevanesan@gmail.com', '2021-08-29 16:11:53'),
(108, 'rk6975145@gmail.com', '2021-08-30 07:10:47'),
(109, 'ak76238@gmail.com', '2021-08-30 13:29:27'),
(110, 'princyrajput7000@gmail.com', '2021-09-04 03:50:01'),
(111, 'gauravkumarsaraf@gmail.com', '2021-09-06 08:09:57'),
(112, 'mahesh.nepal99@gmail.com', '2021-09-08 05:14:37'),
(113, 'swati.heda@yahoo.com', '2021-09-09 08:42:02'),
(114, 'rajeshssss33@gmail.com', '2021-09-15 14:22:29'),
(115, 'pintuatal315@gmail.com', '2021-09-17 11:47:31'),
(116, 'bipulgupta125@gmail.com', '2021-09-19 09:37:36'),
(117, 'priyatwaghmare30@gmail.com', '2021-09-20 13:26:57'),
(118, 'shilparajaput001@gmail.com', '2021-09-22 09:24:52'),
(119, 'shivakumar2uall@gmail.com', '2021-09-23 12:04:03'),
(120, 'boinwadsudarshan383@gmail.com', '2021-09-23 13:35:26'),
(121, 'vk620049@gmail.com', '2021-09-25 05:57:44'),
(122, 'gvkharsha99@gmail.com', '2021-09-28 08:56:04'),
(123, 'mantamahormam@gmail.co', '2021-09-28 14:39:00'),
(124, 'nivasingh1991@gmail.com', '2021-10-04 16:24:54'),
(125, 'rajeshman879654@gmail.com', '2021-10-06 08:48:06'),
(126, 'mangate.smita@gmail.com', '2021-10-06 16:51:59'),
(127, 'jagadish06_patnaik@rediffmail.com', '2021-10-08 15:33:10'),
(128, 'jagadishpatnaik36960@gmail.com', '2021-10-08 15:36:01'),
(129, 'ankitgupta.tarhasi0009@gmail.com', '2021-10-11 10:10:58'),
(130, 'Vgupta496@gmail.com', '2021-10-12 01:34:03'),
(131, 'sah.geetha@gmail.com', '2021-10-13 04:17:27'),
(132, 'vijaymore2904@gmail.com', '2021-10-13 09:40:55'),
(133, 'royalcollectionbhoom@gmail.com', '2021-10-15 10:13:37'),
(134, 'vinodsingh47928@gmail.com', '2021-10-16 13:41:14'),
(135, 'swetashish516@gmail.com', '2021-10-17 07:37:15'),
(136, 'rajkumarkedia1@gmail.com', '2021-10-17 09:37:33'),
(137, 'maheshsable75@gmail.com', '2021-10-19 15:07:34'),
(138, 'nandu.kushwaha4@gmail.com', '2021-10-25 16:51:49'),
(139, 'kumardeepa296@gmail.com', '2021-10-26 10:49:05'),
(140, 'deepakkathir124@gmail.com', '2021-10-30 12:52:54'),
(141, 'Uajay78@gmail.com', '2021-10-31 09:45:22'),
(142, 'agrawalsjay5550@gmail.com', '2021-11-01 15:52:49'),
(143, 'abhishekgautam.254@gmail.com', '2021-11-02 13:04:04'),
(144, 'sunilpatil99@ymail.com', '2021-11-03 04:45:15'),
(145, 'rksdin22@gmail.com', '2021-11-05 08:04:32'),
(146, 'krishnamurthyr2281@gmail.com', '2021-11-05 10:07:46'),
(148, '1983vijayasharma@gmail.com', '2021-11-06 15:57:01'),
(149, 'shrikantdamkondwar@gmail.com', '2021-11-07 09:11:42'),
(150, 'kavitamiri1984@gmail.com', '2021-11-08 18:15:09'),
(151, 'prasadmalgi@yahoo.com', '2021-11-09 14:00:07'),
(152, 'Swm4687@gmail.com', '2021-11-09 14:22:53'),
(153, 'akashagrahari01012001@gmail.com', '2021-11-10 11:55:14'),
(154, 'moreash34@gmail.com', '2021-11-11 14:26:12'),
(155, 'narangvarun945@gmail.com', '2021-11-11 15:30:29'),
(156, 'anand270720031@gmail.com', '2021-11-12 08:28:55'),
(157, 'gauripathare83@gmail.com', '2021-11-13 10:02:15'),
(158, 'jijamatapaithani@gmail.com', '2021-11-13 13:46:52'),
(159, 'Abhishekharkut@gmail.com', '2021-11-13 14:00:07'),
(160, 'pandeyaman50702@gmail.com', '2021-11-14 10:38:38'),
(161, 'rameshramu563@gmail.com', '2021-11-14 13:25:39'),
(162, 'Sunilkumargsunilkumarg883@Email', '2021-11-15 11:11:53'),
(163, 'harishkumar25mar@gmail.com', '2021-11-17 18:19:34'),
(164, 'guptajaya735@gmail.com', '2021-11-24 12:07:58'),
(165, 'deepa.vaingankar@gmail.com', '2021-11-25 15:40:04'),
(166, 'Shivraj.isadkar111@gmail.com', '2021-11-25 16:52:42'),
(167, 'krushnataro75@gmail.com', '2021-11-26 13:34:14'),
(168, 'mansooriboy056@gmail.com', '2021-11-27 14:05:02'),
(169, 'bgkoradia@gmail.com', '2021-11-28 05:42:10'),
(170, 'Barianarendra23@gmail.com', '2021-11-29 12:57:44'),
(171, 'rahulbhoslerb2@gmail.com', '2021-11-30 06:13:59'),
(172, 'Kanchanbhalke@gmail.com', '2021-11-30 06:20:28'),
(173, 'kolleashok33@gmail.com', '2021-12-02 02:56:01'),
(174, 'shitaldedval@gmail.com', '2021-12-02 08:42:40'),
(175, 'raghumicromax@gmail.com', '2021-12-02 12:31:15'),
(176, 'maanshvisharma2003@gmail.com', '2021-12-03 13:43:33'),
(177, 'drsonali.tidke44@gmail.com', '2021-12-04 16:07:23'),
(178, 'kdilpreet502@gmail.com', '2021-12-04 17:26:46'),
(179, 'reshmabhosale187@gmail.comcom', '2021-12-04 18:34:00'),
(180, 'kadamuma@ymail.com', '2021-12-05 12:20:50'),
(181, 'abhiram630@gmail.com', '2021-12-06 16:31:14'),
(182, 'abhiammu630@gmail.com', '2021-12-06 16:32:33'),
(183, 'rekhadubey102@gmail.com', '2021-12-07 07:27:12'),
(184, 'laxmikantdoijode2002@gmail.com', '2021-12-08 06:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `notificationdata`
--

CREATE TABLE `notificationdata` (
  `id` int(11) NOT NULL,
  `title` mediumtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `productid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `ordertype` varchar(56) COLLATE utf8mb3_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `read_status` int(11) NOT NULL,
  `dateandtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `notificationdata`
--

INSERT INTO `notificationdata` (`id`, `title`, `description`, `productid`, `orderid`, `ordertype`, `userid`, `read_status`, `dateandtime`) VALUES
(1, 'Order Status is changed to Shipped', 'Your Order ID : #5', 0, 5, 'Normal Order', 16, 1, 1613992441),
(2, 'New product added HARE RAM', '', 91, 0, 'Product', 1, 1, 1614101691),
(3, 'New product added HARE RAM', '', 91, 0, 'Product', 2, 1, 1614101691),
(4, 'New product added HARE RAM', '', 91, 0, 'Product', 3, 1, 1614101691),
(5, 'New product added HARE RAM', '', 91, 0, 'Product', 13, 1, 1614101691),
(6, 'New product added HARE RAM', '', 91, 0, 'Product', 15, 1, 1614101691),
(7, 'New product added HARE RAM', '', 91, 0, 'Product', 16, 1, 1614101691),
(8, 'New product added HARE RAM', '', 91, 0, 'Product', 17, 1, 1614101691),
(9, 'New product added PANGHAT', '', 92, 0, 'Product', 1, 1, 1614101760),
(10, 'New product added PANGHAT', '', 92, 0, 'Product', 2, 1, 1614101760),
(11, 'New product added PANGHAT', '', 92, 0, 'Product', 3, 1, 1614101760),
(12, 'New product added PANGHAT', '', 92, 0, 'Product', 13, 1, 1614101760),
(13, 'New product added PANGHAT', '', 92, 0, 'Product', 15, 1, 1614101760),
(14, 'New product added PANGHAT', '', 92, 0, 'Product', 16, 1, 1614101760),
(15, 'New product added PANGHAT', '', 92, 0, 'Product', 17, 1, 1614101760),
(16, 'New product added HARE KRISHNA ', '', 93, 0, 'Product', 1, 1, 1614101823),
(17, 'New product added HARE KRISHNA ', '', 93, 0, 'Product', 2, 1, 1614101823),
(18, 'New product added HARE KRISHNA ', '', 93, 0, 'Product', 3, 1, 1614101823),
(19, 'New product added HARE KRISHNA ', '', 93, 0, 'Product', 13, 1, 1614101823),
(20, 'New product added HARE KRISHNA ', '', 93, 0, 'Product', 15, 1, 1614101823),
(21, 'New product added HARE KRISHNA ', '', 93, 0, 'Product', 16, 1, 1614101823),
(22, 'New product added HARE KRISHNA ', '', 93, 0, 'Product', 17, 1, 1614101823),
(23, 'New product added SANWARA SILK', '', 94, 0, 'Product', 1, 1, 1614101885),
(24, 'New product added SANWARA SILK', '', 94, 0, 'Product', 2, 1, 1614101885),
(25, 'New product added SANWARA SILK', '', 94, 0, 'Product', 3, 1, 1614101885),
(26, 'New product added SANWARA SILK', '', 94, 0, 'Product', 13, 1, 1614101885),
(27, 'New product added SANWARA SILK', '', 94, 0, 'Product', 15, 1, 1614101885),
(28, 'New product added SANWARA SILK', '', 94, 0, 'Product', 16, 1, 1614101885),
(29, 'New product added SANWARA SILK', '', 94, 0, 'Product', 17, 1, 1614101885),
(30, 'New product added RANG MAHAL', '', 95, 0, 'Product', 1, 1, 1614101955),
(31, 'New product added RANG MAHAL', '', 95, 0, 'Product', 2, 1, 1614101955),
(32, 'New product added RANG MAHAL', '', 95, 0, 'Product', 3, 1, 1614101955),
(33, 'New product added RANG MAHAL', '', 95, 0, 'Product', 13, 1, 1614101955),
(34, 'New product added RANG MAHAL', '', 95, 0, 'Product', 15, 1, 1614101955),
(35, 'New product added RANG MAHAL', '', 95, 0, 'Product', 16, 1, 1614101955),
(36, 'New product added RANG MAHAL', '', 95, 0, 'Product', 17, 1, 1614101955),
(37, 'Order Status is changed to Cancelled', 'Your Order ID : #6', 0, 6, 'Normal Order', 3, 1, 1614599977),
(38, 'Order Status is changed to Cancelled', 'Your Order ID : #6', 0, 6, 'Normal Order', 3, 1, 1614599984),
(39, 'Order Status is changed to Cancelled', 'Your Order ID : #5', 0, 5, 'Normal Order', 16, 0, 1614600000),
(40, 'Order Status is changed to Cancelled', 'Your Order ID : #4', 0, 4, 'Normal Order', 16, 0, 1614600133),
(41, 'Order Status is changed to Cancelled', 'Your Order ID : #3', 0, 3, 'Normal Order', 14, 1, 1614600142),
(42, 'Order Status is changed to Complete', 'Your Order ID : #5', 0, 5, 'Normal Order', 16, 0, 1614700534),
(43, 'Order Status is changed to Cancelled', 'Your Order ID : #2', 0, 2, 'Normal Order', 3, 1, 1614700560),
(44, 'Order Status is changed to Cancelled', 'Your Order ID : #1', 0, 1, 'Normal Order', 3, 1, 1614700573),
(45, 'Order Status is changed to Processing', 'Your Order ID : #9', 0, 9, 'Normal Order', 30, 1, 1614934812),
(46, 'Order Status is changed to Pending', 'Your Order ID : #9', 0, 9, 'Normal Order', 30, 1, 1614935304),
(47, 'Order Status is changed to Pending', 'Your Order ID : #9', 0, 9, 'Normal Order', 30, 1, 1614935314),
(48, 'Order Status is changed to Processing', 'Your Order ID : #9', 0, 9, 'Normal Order', 30, 1, 1614935328),
(49, 'Order Status is changed to Processing', 'Your Order ID : #8', 0, 8, 'Normal Order', 30, 1, 1614935464),
(50, 'Order Status is changed to Processing', 'Your Order ID : #10', 0, 10, 'Normal Order', 32, 1, 1614936629),
(51, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 1, 1, 1616868055),
(52, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 2, 1, 1616868055),
(53, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 3, 1, 1616868055),
(54, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 13, 1, 1616868055),
(55, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 17, 0, 1616868055),
(56, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 24, 1, 1616868055),
(57, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 25, 0, 1616868055),
(58, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 26, 1, 1616868055),
(59, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 32, 1, 1616868055),
(60, 'New product added RAMESHWARAM', '', 96, 0, 'Product', 44, 1, 1616868055),
(61, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 1, 1, 1616868731),
(62, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 2, 1, 1616868731),
(63, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 3, 1, 1616868731),
(64, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 13, 1, 1616868731),
(65, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 17, 0, 1616868731),
(66, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 24, 1, 1616868731),
(67, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 25, 0, 1616868731),
(68, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 26, 1, 1616868731),
(69, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 32, 1, 1616868731),
(70, 'New product added KAMAL NAYAN', '', 97, 0, 'Product', 44, 0, 1616868731),
(71, 'New product added SARYU', '', 98, 0, 'Product', 1, 1, 1616868809),
(72, 'New product added SARYU', '', 98, 0, 'Product', 2, 1, 1616868809),
(73, 'New product added SARYU', '', 98, 0, 'Product', 3, 1, 1616868809),
(74, 'New product added SARYU', '', 98, 0, 'Product', 13, 1, 1616868809),
(75, 'New product added SARYU', '', 98, 0, 'Product', 17, 0, 1616868809),
(76, 'New product added SARYU', '', 98, 0, 'Product', 24, 1, 1616868809),
(77, 'New product added SARYU', '', 98, 0, 'Product', 25, 0, 1616868809),
(78, 'New product added SARYU', '', 98, 0, 'Product', 26, 1, 1616868809),
(79, 'New product added SARYU', '', 98, 0, 'Product', 32, 1, 1616868809),
(80, 'New product added SARYU', '', 98, 0, 'Product', 44, 0, 1616868809),
(81, 'New product added KASHI', '', 99, 0, 'Product', 1, 1, 1616868882),
(82, 'New product added KASHI', '', 99, 0, 'Product', 2, 1, 1616868882),
(83, 'New product added KASHI', '', 99, 0, 'Product', 3, 1, 1616868882),
(84, 'New product added KASHI', '', 99, 0, 'Product', 13, 1, 1616868882),
(85, 'New product added KASHI', '', 99, 0, 'Product', 17, 0, 1616868882),
(86, 'New product added KASHI', '', 99, 0, 'Product', 24, 1, 1616868882),
(87, 'New product added KASHI', '', 99, 0, 'Product', 25, 0, 1616868882),
(88, 'New product added KASHI', '', 99, 0, 'Product', 26, 1, 1616868882),
(89, 'New product added KASHI', '', 99, 0, 'Product', 32, 1, 1616868882),
(90, 'New product added KASHI', '', 99, 0, 'Product', 44, 0, 1616868882),
(91, 'New product added GANGA', '', 100, 0, 'Product', 1, 1, 1616868941),
(92, 'New product added GANGA', '', 100, 0, 'Product', 2, 1, 1616868941),
(93, 'New product added GANGA', '', 100, 0, 'Product', 3, 1, 1616868941),
(94, 'New product added GANGA', '', 100, 0, 'Product', 13, 1, 1616868941),
(95, 'New product added GANGA', '', 100, 0, 'Product', 17, 0, 1616868941),
(96, 'New product added GANGA', '', 100, 0, 'Product', 24, 1, 1616868941),
(97, 'New product added GANGA', '', 100, 0, 'Product', 25, 0, 1616868941),
(98, 'New product added GANGA', '', 100, 0, 'Product', 26, 1, 1616868941),
(99, 'New product added GANGA', '', 100, 0, 'Product', 32, 1, 1616868941),
(100, 'New product added GANGA', '', 100, 0, 'Product', 44, 0, 1616868941),
(101, 'New product added DEENANATH', '', 101, 0, 'Product', 1, 1, 1616869005),
(102, 'New product added DEENANATH', '', 101, 0, 'Product', 2, 1, 1616869005),
(103, 'New product added DEENANATH', '', 101, 0, 'Product', 3, 1, 1616869005),
(104, 'New product added DEENANATH', '', 101, 0, 'Product', 13, 1, 1616869005),
(105, 'New product added DEENANATH', '', 101, 0, 'Product', 17, 0, 1616869005),
(106, 'New product added DEENANATH', '', 101, 0, 'Product', 24, 1, 1616869005),
(107, 'New product added DEENANATH', '', 101, 0, 'Product', 25, 0, 1616869005),
(108, 'New product added DEENANATH', '', 101, 0, 'Product', 26, 1, 1616869005),
(109, 'New product added DEENANATH', '', 101, 0, 'Product', 32, 1, 1616869005),
(110, 'New product added DEENANATH', '', 101, 0, 'Product', 44, 0, 1616869005),
(111, 'New product added KALINDI', '', 102, 0, 'Product', 1, 1, 1616869103),
(112, 'New product added KALINDI', '', 102, 0, 'Product', 2, 1, 1616869103),
(113, 'New product added KALINDI', '', 102, 0, 'Product', 3, 1, 1616869103),
(114, 'New product added KALINDI', '', 102, 0, 'Product', 13, 1, 1616869103),
(115, 'New product added KALINDI', '', 102, 0, 'Product', 17, 0, 1616869103),
(116, 'New product added KALINDI', '', 102, 0, 'Product', 24, 1, 1616869103),
(117, 'New product added KALINDI', '', 102, 0, 'Product', 25, 0, 1616869103),
(118, 'New product added KALINDI', '', 102, 0, 'Product', 26, 1, 1616869103),
(119, 'New product added KALINDI', '', 102, 0, 'Product', 32, 1, 1616869103),
(120, 'New product added KALINDI', '', 102, 0, 'Product', 44, 0, 1616869103),
(121, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 1, 1, 1619003621),
(122, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 3, 1, 1619003621),
(123, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 13, 0, 1619003621),
(124, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 17, 0, 1619003621),
(125, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 24, 1, 1619003621),
(126, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 25, 0, 1619003621),
(127, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 26, 0, 1619003621),
(128, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 32, 1, 1619003621),
(129, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 44, 0, 1619003621),
(130, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 51, 0, 1619003621),
(131, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 52, 1, 1619003621),
(132, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 54, 0, 1619003621),
(133, 'New product added RAMESHWARAM', '', 103, 0, 'Product', 55, 0, 1619003621),
(134, 'New product added MANMOHANA', '', 104, 0, 'Product', 1, 1, 1619003713),
(135, 'New product added MANMOHANA', '', 104, 0, 'Product', 3, 1, 1619003713),
(136, 'New product added MANMOHANA', '', 104, 0, 'Product', 13, 0, 1619003713),
(137, 'New product added MANMOHANA', '', 104, 0, 'Product', 17, 0, 1619003713),
(138, 'New product added MANMOHANA', '', 104, 0, 'Product', 24, 1, 1619003713),
(139, 'New product added MANMOHANA', '', 104, 0, 'Product', 25, 0, 1619003713),
(140, 'New product added MANMOHANA', '', 104, 0, 'Product', 26, 0, 1619003713),
(141, 'New product added MANMOHANA', '', 104, 0, 'Product', 32, 1, 1619003713),
(142, 'New product added MANMOHANA', '', 104, 0, 'Product', 44, 0, 1619003713),
(143, 'New product added MANMOHANA', '', 104, 0, 'Product', 51, 0, 1619003713),
(144, 'New product added MANMOHANA', '', 104, 0, 'Product', 52, 1, 1619003713),
(145, 'New product added MANMOHANA', '', 104, 0, 'Product', 54, 0, 1619003713),
(146, 'New product added MANMOHANA', '', 104, 0, 'Product', 55, 0, 1619003713),
(147, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 1, 1, 1619003792),
(148, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 3, 1, 1619003792),
(149, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 13, 0, 1619003792),
(150, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 17, 0, 1619003792),
(151, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 24, 1, 1619003792),
(152, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 25, 0, 1619003792),
(153, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 26, 0, 1619003792),
(154, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 32, 1, 1619003792),
(155, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 44, 0, 1619003792),
(156, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 51, 0, 1619003792),
(157, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 52, 1, 1619003792),
(158, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 54, 0, 1619003792),
(159, 'New product added AYODHYA JEE', '', 105, 0, 'Product', 55, 0, 1619003792),
(160, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 1, 1, 1619003847),
(161, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 3, 1, 1619003847),
(162, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 13, 0, 1619003847),
(163, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 17, 0, 1619003847),
(164, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 24, 1, 1619003847),
(165, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 25, 0, 1619003847),
(166, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 26, 0, 1619003847),
(167, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 32, 1, 1619003847),
(168, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 44, 0, 1619003847),
(169, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 51, 0, 1619003847),
(170, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 52, 1, 1619003847),
(171, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 54, 0, 1619003847),
(172, 'New product added MEERA KE MOHAN', '', 106, 0, 'Product', 55, 0, 1619003847),
(173, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 1, 1, 1619003914),
(174, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 3, 1, 1619003914),
(175, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 13, 0, 1619003914),
(176, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 17, 0, 1619003914),
(177, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 24, 1, 1619003914),
(178, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 25, 0, 1619003914),
(179, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 26, 0, 1619003914),
(180, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 32, 1, 1619003914),
(181, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 44, 0, 1619003914),
(182, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 51, 0, 1619003914),
(183, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 52, 1, 1619003914),
(184, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 54, 0, 1619003914),
(185, 'New product added VRINDA BRASSO 3', '', 107, 0, 'Product', 55, 0, 1619003914),
(186, 'New product added AARNA', '', 108, 0, 'Product', 1, 1, 1619003987),
(187, 'New product added AARNA', '', 108, 0, 'Product', 3, 1, 1619003987),
(188, 'New product added AARNA', '', 108, 0, 'Product', 13, 0, 1619003987),
(189, 'New product added AARNA', '', 108, 0, 'Product', 17, 0, 1619003987),
(190, 'New product added AARNA', '', 108, 0, 'Product', 24, 1, 1619003987),
(191, 'New product added AARNA', '', 108, 0, 'Product', 25, 0, 1619003987),
(192, 'New product added AARNA', '', 108, 0, 'Product', 26, 0, 1619003987),
(193, 'New product added AARNA', '', 108, 0, 'Product', 32, 1, 1619003987),
(194, 'New product added AARNA', '', 108, 0, 'Product', 44, 0, 1619003987),
(195, 'New product added AARNA', '', 108, 0, 'Product', 51, 0, 1619003987),
(196, 'New product added AARNA', '', 108, 0, 'Product', 52, 1, 1619003987),
(197, 'New product added AARNA', '', 108, 0, 'Product', 54, 0, 1619003987),
(198, 'New product added AARNA', '', 108, 0, 'Product', 55, 0, 1619003987),
(199, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 1, 1, 1619004039),
(200, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 3, 1, 1619004039),
(201, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 13, 0, 1619004039),
(202, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 17, 0, 1619004039),
(203, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 24, 1, 1619004039),
(204, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 25, 0, 1619004039),
(205, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 26, 0, 1619004039),
(206, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 32, 1, 1619004039),
(207, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 44, 0, 1619004039),
(208, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 51, 0, 1619004039),
(209, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 52, 1, 1619004039),
(210, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 54, 0, 1619004039),
(211, 'New product added SIYA KE RAM', '', 109, 0, 'Product', 55, 0, 1619004039),
(212, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 1, 1, 1619004095),
(213, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 3, 1, 1619004095),
(214, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 13, 0, 1619004095),
(215, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 17, 0, 1619004095),
(216, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 24, 1, 1619004095),
(217, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 25, 0, 1619004095),
(218, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 26, 0, 1619004095),
(219, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 32, 1, 1619004095),
(220, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 44, 0, 1619004095),
(221, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 51, 0, 1619004095),
(222, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 52, 1, 1619004095),
(223, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 54, 0, 1619004095),
(224, 'New product added BRIJ MANDAL 1', '', 110, 0, 'Product', 55, 0, 1619004095),
(225, 'New product added VAIDEHI', '', 111, 0, 'Product', 1, 1, 1619004296),
(226, 'New product added VAIDEHI', '', 111, 0, 'Product', 3, 1, 1619004296),
(227, 'New product added VAIDEHI', '', 111, 0, 'Product', 13, 0, 1619004296),
(228, 'New product added VAIDEHI', '', 111, 0, 'Product', 17, 0, 1619004296),
(229, 'New product added VAIDEHI', '', 111, 0, 'Product', 24, 1, 1619004296),
(230, 'New product added VAIDEHI', '', 111, 0, 'Product', 25, 0, 1619004296),
(231, 'New product added VAIDEHI', '', 111, 0, 'Product', 26, 0, 1619004296),
(232, 'New product added VAIDEHI', '', 111, 0, 'Product', 32, 1, 1619004296),
(233, 'New product added VAIDEHI', '', 111, 0, 'Product', 44, 0, 1619004296),
(234, 'New product added VAIDEHI', '', 111, 0, 'Product', 51, 0, 1619004296),
(235, 'New product added VAIDEHI', '', 111, 0, 'Product', 52, 1, 1619004296),
(236, 'New product added VAIDEHI', '', 111, 0, 'Product', 54, 0, 1619004296),
(237, 'New product added VAIDEHI', '', 111, 0, 'Product', 55, 0, 1619004296),
(238, 'New product added VAMAN SILK', '', 112, 0, 'Product', 1, 1, 1619336900),
(239, 'New product added VAMAN SILK', '', 112, 0, 'Product', 3, 1, 1619336900),
(240, 'New product added VAMAN SILK', '', 112, 0, 'Product', 13, 0, 1619336900),
(241, 'New product added VAMAN SILK', '', 112, 0, 'Product', 17, 0, 1619336900),
(242, 'New product added VAMAN SILK', '', 112, 0, 'Product', 24, 1, 1619336900),
(243, 'New product added VAMAN SILK', '', 112, 0, 'Product', 25, 0, 1619336900),
(244, 'New product added VAMAN SILK', '', 112, 0, 'Product', 26, 0, 1619336900),
(245, 'New product added VAMAN SILK', '', 112, 0, 'Product', 32, 1, 1619336900),
(246, 'New product added VAMAN SILK', '', 112, 0, 'Product', 44, 0, 1619336900),
(247, 'New product added VAMAN SILK', '', 112, 0, 'Product', 51, 0, 1619336900),
(248, 'New product added VAMAN SILK', '', 112, 0, 'Product', 52, 1, 1619336900),
(249, 'New product added VAMAN SILK', '', 112, 0, 'Product', 53, 1, 1619336900),
(250, 'New product added VAMAN SILK', '', 112, 0, 'Product', 54, 0, 1619336900),
(251, 'New product added VAMAN SILK', '', 112, 0, 'Product', 55, 0, 1619336900),
(252, 'New product added MUDRIKA', '', 113, 0, 'Product', 1, 1, 1619337016),
(253, 'New product added MUDRIKA', '', 113, 0, 'Product', 3, 1, 1619337016),
(254, 'New product added MUDRIKA', '', 113, 0, 'Product', 13, 0, 1619337016),
(255, 'New product added MUDRIKA', '', 113, 0, 'Product', 17, 0, 1619337016),
(256, 'New product added MUDRIKA', '', 113, 0, 'Product', 24, 1, 1619337016),
(257, 'New product added MUDRIKA', '', 113, 0, 'Product', 25, 0, 1619337016),
(258, 'New product added MUDRIKA', '', 113, 0, 'Product', 26, 0, 1619337016),
(259, 'New product added MUDRIKA', '', 113, 0, 'Product', 32, 1, 1619337016),
(260, 'New product added MUDRIKA', '', 113, 0, 'Product', 44, 0, 1619337016),
(261, 'New product added MUDRIKA', '', 113, 0, 'Product', 51, 0, 1619337016),
(262, 'New product added MUDRIKA', '', 113, 0, 'Product', 52, 1, 1619337016),
(263, 'New product added MUDRIKA', '', 113, 0, 'Product', 53, 1, 1619337016),
(264, 'New product added MUDRIKA', '', 113, 0, 'Product', 54, 0, 1619337016),
(265, 'New product added MUDRIKA', '', 113, 0, 'Product', 55, 0, 1619337016),
(266, 'New product added MUDRIKA', '', 114, 0, 'Product', 1, 1, 1619337073),
(267, 'New product added MUDRIKA', '', 114, 0, 'Product', 3, 1, 1619337073),
(268, 'New product added MUDRIKA', '', 114, 0, 'Product', 13, 0, 1619337073),
(269, 'New product added MUDRIKA', '', 114, 0, 'Product', 17, 0, 1619337073),
(270, 'New product added MUDRIKA', '', 114, 0, 'Product', 24, 1, 1619337073),
(271, 'New product added MUDRIKA', '', 114, 0, 'Product', 25, 0, 1619337073),
(272, 'New product added MUDRIKA', '', 114, 0, 'Product', 26, 0, 1619337073),
(273, 'New product added MUDRIKA', '', 114, 0, 'Product', 32, 1, 1619337073),
(274, 'New product added MUDRIKA', '', 114, 0, 'Product', 44, 0, 1619337073),
(275, 'New product added MUDRIKA', '', 114, 0, 'Product', 51, 0, 1619337073),
(276, 'New product added MUDRIKA', '', 114, 0, 'Product', 52, 1, 1619337073),
(277, 'New product added MUDRIKA', '', 114, 0, 'Product', 53, 1, 1619337073),
(278, 'New product added MUDRIKA', '', 114, 0, 'Product', 54, 0, 1619337073),
(279, 'New product added MUDRIKA', '', 114, 0, 'Product', 55, 0, 1619337073),
(280, 'Order Status is changed to Cancelled', 'Your Order ID : #12', 0, 12, 'Normal Order', 53, 1, 1619593539),
(281, 'Order Status is changed to Complete', 'Your Order ID : #13', 0, 13, 'Normal Order', 53, 1, 1620277298),
(282, 'Order Status is changed to Cancelled', 'Your Order ID : #3', 0, 3, 'Direct Order', 66, 1, 1622005684),
(283, 'New product added SAKET DHAM', '', 115, 0, 'Product', 1, 1, 1622998799),
(284, 'New product added SAKET DHAM', '', 115, 0, 'Product', 3, 1, 1622998799),
(285, 'New product added SAKET DHAM', '', 115, 0, 'Product', 13, 0, 1622998799),
(286, 'New product added SAKET DHAM', '', 115, 0, 'Product', 17, 0, 1622998799),
(287, 'New product added SAKET DHAM', '', 115, 0, 'Product', 24, 1, 1622998799),
(288, 'New product added SAKET DHAM', '', 115, 0, 'Product', 25, 0, 1622998799),
(289, 'New product added SAKET DHAM', '', 115, 0, 'Product', 26, 0, 1622998799),
(290, 'New product added SAKET DHAM', '', 115, 0, 'Product', 32, 0, 1622998799),
(291, 'New product added SAKET DHAM', '', 115, 0, 'Product', 43, 0, 1622998799),
(292, 'New product added SAKET DHAM', '', 115, 0, 'Product', 44, 0, 1622998799),
(293, 'New product added SAKET DHAM', '', 115, 0, 'Product', 51, 0, 1622998799),
(294, 'New product added SAKET DHAM', '', 115, 0, 'Product', 52, 1, 1622998799),
(295, 'New product added SAKET DHAM', '', 115, 0, 'Product', 54, 0, 1622998799),
(296, 'New product added SAKET DHAM', '', 115, 0, 'Product', 55, 0, 1622998799),
(297, 'New product added SAKET DHAM', '', 115, 0, 'Product', 60, 1, 1622998799),
(298, 'New product added SAKET DHAM', '', 115, 0, 'Product', 70, 1, 1622998799),
(299, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 1, 1, 1622998989),
(300, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 3, 1, 1622998989),
(301, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 13, 0, 1622998989),
(302, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 17, 0, 1622998989),
(303, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 24, 1, 1622998989),
(304, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 25, 0, 1622998989),
(305, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 26, 0, 1622998989),
(306, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 32, 0, 1622998989),
(307, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 43, 0, 1622998989),
(308, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 44, 0, 1622998989),
(309, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 51, 0, 1622998989),
(310, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 52, 1, 1622998989),
(311, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 54, 0, 1622998989),
(312, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 55, 0, 1622998989),
(313, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 60, 1, 1622998989),
(314, 'New product added BAL KRISHNA', '', 116, 0, 'Product', 70, 1, 1622998989),
(315, 'New product added NAINA', '', 117, 0, 'Product', 1, 1, 1622999138),
(316, 'New product added NAINA', '', 117, 0, 'Product', 3, 1, 1622999138),
(317, 'New product added NAINA', '', 117, 0, 'Product', 13, 0, 1622999138),
(318, 'New product added NAINA', '', 117, 0, 'Product', 17, 0, 1622999138),
(319, 'New product added NAINA', '', 117, 0, 'Product', 24, 1, 1622999138),
(320, 'New product added NAINA', '', 117, 0, 'Product', 25, 0, 1622999138),
(321, 'New product added NAINA', '', 117, 0, 'Product', 26, 0, 1622999138),
(322, 'New product added NAINA', '', 117, 0, 'Product', 32, 0, 1622999138),
(323, 'New product added NAINA', '', 117, 0, 'Product', 43, 0, 1622999138),
(324, 'New product added NAINA', '', 117, 0, 'Product', 44, 0, 1622999138),
(325, 'New product added NAINA', '', 117, 0, 'Product', 51, 0, 1622999138),
(326, 'New product added NAINA', '', 117, 0, 'Product', 52, 1, 1622999138),
(327, 'New product added NAINA', '', 117, 0, 'Product', 54, 0, 1622999138),
(328, 'New product added NAINA', '', 117, 0, 'Product', 55, 0, 1622999138),
(329, 'New product added NAINA', '', 117, 0, 'Product', 60, 1, 1622999138),
(330, 'New product added NAINA', '', 117, 0, 'Product', 70, 1, 1622999138),
(331, 'New product added NARAYANI', '', 118, 0, 'Product', 1, 1, 1622999325),
(332, 'New product added NARAYANI', '', 118, 0, 'Product', 3, 1, 1622999325),
(333, 'New product added NARAYANI', '', 118, 0, 'Product', 13, 0, 1622999325),
(334, 'New product added NARAYANI', '', 118, 0, 'Product', 17, 0, 1622999325),
(335, 'New product added NARAYANI', '', 118, 0, 'Product', 24, 1, 1622999325),
(336, 'New product added NARAYANI', '', 118, 0, 'Product', 25, 0, 1622999325),
(337, 'New product added NARAYANI', '', 118, 0, 'Product', 26, 0, 1622999325),
(338, 'New product added NARAYANI', '', 118, 0, 'Product', 32, 0, 1622999325),
(339, 'New product added NARAYANI', '', 118, 0, 'Product', 43, 0, 1622999325),
(340, 'New product added NARAYANI', '', 118, 0, 'Product', 44, 0, 1622999325),
(341, 'New product added NARAYANI', '', 118, 0, 'Product', 51, 0, 1622999325),
(342, 'New product added NARAYANI', '', 118, 0, 'Product', 52, 1, 1622999325),
(343, 'New product added NARAYANI', '', 118, 0, 'Product', 54, 0, 1622999325),
(344, 'New product added NARAYANI', '', 118, 0, 'Product', 55, 0, 1622999325),
(345, 'New product added NARAYANI', '', 118, 0, 'Product', 60, 1, 1622999325),
(346, 'New product added NARAYANI', '', 118, 0, 'Product', 70, 1, 1622999325),
(347, 'Order Status is changed to Processing', 'Your Order ID : #1', 0, 1, 'Normal Order', 3, 1, 1624202106),
(348, 'Order Status is changed to Shipped', 'Your Order ID : #1', 0, 1, 'Normal Order', 3, 1, 1624202125),
(349, 'Order Status is changed to Delivered', 'Your Order ID : #1', 0, 1, 'Normal Order', 3, 1, 1624202130),
(350, 'Order Status is changed to Complete', 'Your Order ID : #1', 0, 1, 'Normal Order', 3, 1, 1624202135),
(351, 'Order Status is changed to Cancelled', 'Your Order ID : #1', 0, 1, 'Normal Order', 3, 1, 1624202139),
(352, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 1, 1, 1628705385),
(353, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 3, 1, 1628705385),
(354, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 13, 0, 1628705385),
(355, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 17, 0, 1628705385),
(356, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 24, 1, 1628705385),
(357, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 25, 0, 1628705385),
(358, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 26, 0, 1628705385),
(359, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 43, 0, 1628705385),
(360, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 44, 0, 1628705385),
(361, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 51, 0, 1628705385),
(362, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 52, 1, 1628705385),
(363, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 54, 0, 1628705385),
(364, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 55, 0, 1628705385),
(365, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 60, 0, 1628705385),
(366, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 78, 0, 1628705385),
(367, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 83, 0, 1628705385),
(368, 'New product added SHREE RANGNATH JEE', '', 119, 0, 'Product', 90, 1, 1628705385),
(369, 'New product added GEET GOVIND', '', 120, 0, 'Product', 1, 1, 1628705488),
(370, 'New product added GEET GOVIND', '', 120, 0, 'Product', 3, 1, 1628705488),
(371, 'New product added GEET GOVIND', '', 120, 0, 'Product', 13, 0, 1628705488),
(372, 'New product added GEET GOVIND', '', 120, 0, 'Product', 17, 0, 1628705488),
(373, 'New product added GEET GOVIND', '', 120, 0, 'Product', 24, 1, 1628705488),
(374, 'New product added GEET GOVIND', '', 120, 0, 'Product', 25, 0, 1628705488),
(375, 'New product added GEET GOVIND', '', 120, 0, 'Product', 26, 0, 1628705488),
(376, 'New product added GEET GOVIND', '', 120, 0, 'Product', 43, 0, 1628705488),
(377, 'New product added GEET GOVIND', '', 120, 0, 'Product', 44, 0, 1628705488),
(378, 'New product added GEET GOVIND', '', 120, 0, 'Product', 51, 0, 1628705488),
(379, 'New product added GEET GOVIND', '', 120, 0, 'Product', 52, 1, 1628705488),
(380, 'New product added GEET GOVIND', '', 120, 0, 'Product', 54, 0, 1628705488),
(381, 'New product added GEET GOVIND', '', 120, 0, 'Product', 55, 0, 1628705488),
(382, 'New product added GEET GOVIND', '', 120, 0, 'Product', 60, 0, 1628705488),
(383, 'New product added GEET GOVIND', '', 120, 0, 'Product', 78, 0, 1628705488),
(384, 'New product added GEET GOVIND', '', 120, 0, 'Product', 83, 0, 1628705488),
(385, 'New product added GEET GOVIND', '', 120, 0, 'Product', 90, 1, 1628705488),
(386, 'New product added RAMAYANA', '', 121, 0, 'Product', 1, 1, 1628705771),
(387, 'New product added RAMAYANA', '', 121, 0, 'Product', 3, 1, 1628705771),
(388, 'New product added RAMAYANA', '', 121, 0, 'Product', 13, 0, 1628705771),
(389, 'New product added RAMAYANA', '', 121, 0, 'Product', 17, 0, 1628705771),
(390, 'New product added RAMAYANA', '', 121, 0, 'Product', 24, 1, 1628705771),
(391, 'New product added RAMAYANA', '', 121, 0, 'Product', 25, 0, 1628705771),
(392, 'New product added RAMAYANA', '', 121, 0, 'Product', 26, 0, 1628705771),
(393, 'New product added RAMAYANA', '', 121, 0, 'Product', 43, 0, 1628705771),
(394, 'New product added RAMAYANA', '', 121, 0, 'Product', 44, 0, 1628705771),
(395, 'New product added RAMAYANA', '', 121, 0, 'Product', 51, 0, 1628705771),
(396, 'New product added RAMAYANA', '', 121, 0, 'Product', 52, 1, 1628705771),
(397, 'New product added RAMAYANA', '', 121, 0, 'Product', 54, 0, 1628705771),
(398, 'New product added RAMAYANA', '', 121, 0, 'Product', 55, 0, 1628705771),
(399, 'New product added RAMAYANA', '', 121, 0, 'Product', 60, 0, 1628705771),
(400, 'New product added RAMAYANA', '', 121, 0, 'Product', 78, 0, 1628705771),
(401, 'New product added RAMAYANA', '', 121, 0, 'Product', 83, 0, 1628705771),
(402, 'New product added RAMAYANA', '', 121, 0, 'Product', 90, 1, 1628705771),
(403, 'New product added VANSHIVAT', '', 122, 0, 'Product', 1, 1, 1628706039),
(404, 'New product added VANSHIVAT', '', 122, 0, 'Product', 3, 1, 1628706039),
(405, 'New product added VANSHIVAT', '', 122, 0, 'Product', 13, 0, 1628706039),
(406, 'New product added VANSHIVAT', '', 122, 0, 'Product', 17, 0, 1628706039),
(407, 'New product added VANSHIVAT', '', 122, 0, 'Product', 24, 1, 1628706039),
(408, 'New product added VANSHIVAT', '', 122, 0, 'Product', 25, 0, 1628706039),
(409, 'New product added VANSHIVAT', '', 122, 0, 'Product', 26, 0, 1628706039),
(410, 'New product added VANSHIVAT', '', 122, 0, 'Product', 43, 0, 1628706039),
(411, 'New product added VANSHIVAT', '', 122, 0, 'Product', 44, 0, 1628706039),
(412, 'New product added VANSHIVAT', '', 122, 0, 'Product', 51, 0, 1628706039),
(413, 'New product added VANSHIVAT', '', 122, 0, 'Product', 52, 1, 1628706039),
(414, 'New product added VANSHIVAT', '', 122, 0, 'Product', 54, 0, 1628706039),
(415, 'New product added VANSHIVAT', '', 122, 0, 'Product', 55, 0, 1628706039),
(416, 'New product added VANSHIVAT', '', 122, 0, 'Product', 60, 0, 1628706039),
(417, 'New product added VANSHIVAT', '', 122, 0, 'Product', 78, 0, 1628706039),
(418, 'New product added VANSHIVAT', '', 122, 0, 'Product', 83, 0, 1628706039),
(419, 'New product added VANSHIVAT', '', 122, 0, 'Product', 90, 1, 1628706039),
(420, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 1, 1, 1628706174),
(421, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 3, 1, 1628706174),
(422, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 13, 0, 1628706174),
(423, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 17, 0, 1628706174),
(424, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 24, 1, 1628706174),
(425, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 25, 0, 1628706174),
(426, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 26, 0, 1628706174),
(427, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 43, 0, 1628706174),
(428, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 44, 0, 1628706174),
(429, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 51, 0, 1628706174),
(430, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 52, 1, 1628706174),
(431, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 54, 0, 1628706174),
(432, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 55, 0, 1628706174),
(433, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 60, 0, 1628706174),
(434, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 78, 0, 1628706174),
(435, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 83, 0, 1628706174),
(436, 'New product added BHAGWAT JEE', '', 123, 0, 'Product', 90, 1, 1628706174),
(437, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 1, 1, 1628706296),
(438, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 3, 1, 1628706296),
(439, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 13, 0, 1628706296),
(440, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 17, 0, 1628706296),
(441, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 24, 1, 1628706296),
(442, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 25, 0, 1628706296),
(443, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 26, 0, 1628706296),
(444, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 43, 0, 1628706296),
(445, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 44, 0, 1628706296),
(446, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 51, 0, 1628706296),
(447, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 52, 1, 1628706296),
(448, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 54, 0, 1628706296),
(449, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 55, 0, 1628706296),
(450, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 60, 0, 1628706296),
(451, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 78, 0, 1628706296),
(452, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 83, 0, 1628706296),
(453, 'New product added YASODA CHUNRI', '', 124, 0, 'Product', 90, 1, 1628706296),
(454, 'New product added RAMA RAM', '', 125, 0, 'Product', 1, 0, 1631026604),
(455, 'New product added RAMA RAM', '', 125, 0, 'Product', 3, 1, 1631026604),
(456, 'New product added RAMA RAM', '', 125, 0, 'Product', 13, 0, 1631026604),
(457, 'New product added RAMA RAM', '', 125, 0, 'Product', 17, 0, 1631026604),
(458, 'New product added RAMA RAM', '', 125, 0, 'Product', 24, 1, 1631026604),
(459, 'New product added RAMA RAM', '', 125, 0, 'Product', 25, 0, 1631026604),
(460, 'New product added RAMA RAM', '', 125, 0, 'Product', 26, 0, 1631026604),
(461, 'New product added RAMA RAM', '', 125, 0, 'Product', 43, 0, 1631026604),
(462, 'New product added RAMA RAM', '', 125, 0, 'Product', 44, 0, 1631026604),
(463, 'New product added RAMA RAM', '', 125, 0, 'Product', 51, 0, 1631026604),
(464, 'New product added RAMA RAM', '', 125, 0, 'Product', 52, 1, 1631026604),
(465, 'New product added RAMA RAM', '', 125, 0, 'Product', 54, 0, 1631026604),
(466, 'New product added RAMA RAM', '', 125, 0, 'Product', 55, 0, 1631026604),
(467, 'New product added RAMA RAM', '', 125, 0, 'Product', 60, 0, 1631026604),
(468, 'New product added RAMA RAM', '', 125, 0, 'Product', 78, 0, 1631026604),
(469, 'New product added RAMA RAM', '', 125, 0, 'Product', 83, 0, 1631026604),
(470, 'New product added RAMA RAM', '', 125, 0, 'Product', 90, 1, 1631026604),
(471, 'New product added DAKOR JEE', '', 126, 0, 'Product', 1, 0, 1631037497),
(472, 'New product added DAKOR JEE', '', 126, 0, 'Product', 3, 1, 1631037497),
(473, 'New product added DAKOR JEE', '', 126, 0, 'Product', 13, 0, 1631037497),
(474, 'New product added DAKOR JEE', '', 126, 0, 'Product', 17, 0, 1631037497),
(475, 'New product added DAKOR JEE', '', 126, 0, 'Product', 24, 1, 1631037497),
(476, 'New product added DAKOR JEE', '', 126, 0, 'Product', 25, 0, 1631037497),
(477, 'New product added DAKOR JEE', '', 126, 0, 'Product', 26, 0, 1631037497),
(478, 'New product added DAKOR JEE', '', 126, 0, 'Product', 43, 0, 1631037497),
(479, 'New product added DAKOR JEE', '', 126, 0, 'Product', 44, 0, 1631037497),
(480, 'New product added DAKOR JEE', '', 126, 0, 'Product', 51, 0, 1631037497),
(481, 'New product added DAKOR JEE', '', 126, 0, 'Product', 52, 1, 1631037497),
(482, 'New product added DAKOR JEE', '', 126, 0, 'Product', 54, 0, 1631037497),
(483, 'New product added DAKOR JEE', '', 126, 0, 'Product', 55, 0, 1631037497),
(484, 'New product added DAKOR JEE', '', 126, 0, 'Product', 60, 0, 1631037497),
(485, 'New product added DAKOR JEE', '', 126, 0, 'Product', 78, 0, 1631037497),
(486, 'New product added DAKOR JEE', '', 126, 0, 'Product', 83, 0, 1631037497),
(487, 'New product added DAKOR JEE', '', 126, 0, 'Product', 90, 1, 1631037497),
(488, 'New product added HARI HARA', '', 127, 0, 'Product', 1, 0, 1631037627),
(489, 'New product added HARI HARA', '', 127, 0, 'Product', 3, 1, 1631037627),
(490, 'New product added HARI HARA', '', 127, 0, 'Product', 13, 0, 1631037627),
(491, 'New product added HARI HARA', '', 127, 0, 'Product', 17, 0, 1631037627),
(492, 'New product added HARI HARA', '', 127, 0, 'Product', 24, 1, 1631037627),
(493, 'New product added HARI HARA', '', 127, 0, 'Product', 25, 0, 1631037627),
(494, 'New product added HARI HARA', '', 127, 0, 'Product', 26, 0, 1631037627),
(495, 'New product added HARI HARA', '', 127, 0, 'Product', 43, 0, 1631037627),
(496, 'New product added HARI HARA', '', 127, 0, 'Product', 44, 0, 1631037627),
(497, 'New product added HARI HARA', '', 127, 0, 'Product', 51, 0, 1631037627),
(498, 'New product added HARI HARA', '', 127, 0, 'Product', 52, 1, 1631037627),
(499, 'New product added HARI HARA', '', 127, 0, 'Product', 54, 0, 1631037627),
(500, 'New product added HARI HARA', '', 127, 0, 'Product', 55, 0, 1631037627),
(501, 'New product added HARI HARA', '', 127, 0, 'Product', 60, 0, 1631037627),
(502, 'New product added HARI HARA', '', 127, 0, 'Product', 78, 0, 1631037627),
(503, 'New product added HARI HARA', '', 127, 0, 'Product', 83, 0, 1631037627),
(504, 'New product added HARI HARA', '', 127, 0, 'Product', 90, 1, 1631037627),
(505, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 1, 0, 1631037727),
(506, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 3, 1, 1631037727),
(507, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 13, 0, 1631037727),
(508, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 17, 0, 1631037727),
(509, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 24, 1, 1631037727),
(510, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 25, 0, 1631037727),
(511, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 26, 0, 1631037727),
(512, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 43, 0, 1631037727),
(513, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 44, 0, 1631037727),
(514, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 51, 0, 1631037727),
(515, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 52, 1, 1631037727),
(516, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 54, 0, 1631037727),
(517, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 55, 0, 1631037727),
(518, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 60, 0, 1631037727),
(519, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 78, 0, 1631037727),
(520, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 83, 0, 1631037727),
(521, 'New product added BANKE BIHARI', '', 128, 0, 'Product', 90, 1, 1631037727),
(522, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 1, 0, 1631037797),
(523, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 3, 1, 1631037797),
(524, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 13, 0, 1631037797),
(525, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 17, 0, 1631037797),
(526, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 24, 1, 1631037797),
(527, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 25, 0, 1631037797),
(528, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 26, 0, 1631037797),
(529, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 43, 0, 1631037797),
(530, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 44, 0, 1631037797),
(531, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 51, 0, 1631037797),
(532, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 52, 1, 1631037797),
(533, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 54, 0, 1631037797),
(534, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 55, 0, 1631037797),
(535, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 60, 0, 1631037797),
(536, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 78, 0, 1631037797),
(537, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 83, 0, 1631037797),
(538, 'New product added NEEL MADHAV', '', 129, 0, 'Product', 90, 1, 1631037797),
(539, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 1, 0, 1631037892),
(540, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 3, 1, 1631037892),
(541, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 13, 0, 1631037892),
(542, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 17, 0, 1631037892),
(543, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 24, 1, 1631037892),
(544, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 25, 0, 1631037892),
(545, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 26, 0, 1631037892),
(546, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 43, 0, 1631037892),
(547, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 44, 0, 1631037892),
(548, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 51, 0, 1631037892),
(549, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 52, 1, 1631037892),
(550, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 54, 0, 1631037892),
(551, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 55, 0, 1631037892),
(552, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 60, 0, 1631037892),
(553, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 78, 0, 1631037892),
(554, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 83, 0, 1631037892),
(555, 'New product added NARAYAN LEELA CHUNARI', '', 130, 0, 'Product', 90, 1, 1631037892),
(556, 'New product added Gangotri', '', 131, 0, 'Product', 1, 0, 1631037988),
(557, 'New product added Gangotri', '', 131, 0, 'Product', 3, 1, 1631037988),
(558, 'New product added Gangotri', '', 131, 0, 'Product', 13, 0, 1631037988),
(559, 'New product added Gangotri', '', 131, 0, 'Product', 17, 0, 1631037988),
(560, 'New product added Gangotri', '', 131, 0, 'Product', 24, 1, 1631037988),
(561, 'New product added Gangotri', '', 131, 0, 'Product', 25, 0, 1631037988),
(562, 'New product added Gangotri', '', 131, 0, 'Product', 26, 0, 1631037988),
(563, 'New product added Gangotri', '', 131, 0, 'Product', 43, 0, 1631037988),
(564, 'New product added Gangotri', '', 131, 0, 'Product', 44, 0, 1631037988),
(565, 'New product added Gangotri', '', 131, 0, 'Product', 51, 0, 1631037988),
(566, 'New product added Gangotri', '', 131, 0, 'Product', 52, 1, 1631037988),
(567, 'New product added Gangotri', '', 131, 0, 'Product', 54, 0, 1631037988),
(568, 'New product added Gangotri', '', 131, 0, 'Product', 55, 0, 1631037988),
(569, 'New product added Gangotri', '', 131, 0, 'Product', 60, 0, 1631037988),
(570, 'New product added Gangotri', '', 131, 0, 'Product', 78, 0, 1631037988),
(571, 'New product added Gangotri', '', 131, 0, 'Product', 83, 0, 1631037988),
(572, 'New product added Gangotri', '', 131, 0, 'Product', 90, 1, 1631037988),
(573, 'New product added MANDAP', '', 132, 0, 'Product', 1, 0, 1631038093),
(574, 'New product added MANDAP', '', 132, 0, 'Product', 3, 1, 1631038093),
(575, 'New product added MANDAP', '', 132, 0, 'Product', 13, 0, 1631038093),
(576, 'New product added MANDAP', '', 132, 0, 'Product', 17, 0, 1631038093),
(577, 'New product added MANDAP', '', 132, 0, 'Product', 24, 1, 1631038093),
(578, 'New product added MANDAP', '', 132, 0, 'Product', 25, 0, 1631038093),
(579, 'New product added MANDAP', '', 132, 0, 'Product', 26, 0, 1631038093),
(580, 'New product added MANDAP', '', 132, 0, 'Product', 43, 0, 1631038093),
(581, 'New product added MANDAP', '', 132, 0, 'Product', 44, 0, 1631038093),
(582, 'New product added MANDAP', '', 132, 0, 'Product', 51, 0, 1631038093),
(583, 'New product added MANDAP', '', 132, 0, 'Product', 52, 1, 1631038093),
(584, 'New product added MANDAP', '', 132, 0, 'Product', 54, 0, 1631038093),
(585, 'New product added MANDAP', '', 132, 0, 'Product', 55, 0, 1631038093),
(586, 'New product added MANDAP', '', 132, 0, 'Product', 60, 0, 1631038093),
(587, 'New product added MANDAP', '', 132, 0, 'Product', 78, 0, 1631038093),
(588, 'New product added MANDAP', '', 132, 0, 'Product', 83, 0, 1631038093),
(589, 'New product added MANDAP', '', 132, 0, 'Product', 90, 1, 1631038093),
(590, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 1, 0, 1631038196),
(591, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 3, 1, 1631038196),
(592, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 13, 0, 1631038196),
(593, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 17, 0, 1631038196),
(594, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 24, 1, 1631038196),
(595, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 25, 0, 1631038196),
(596, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 26, 0, 1631038196),
(597, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 43, 0, 1631038196),
(598, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 44, 0, 1631038196),
(599, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 51, 0, 1631038196),
(600, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 52, 1, 1631038196),
(601, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 54, 0, 1631038196),
(602, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 55, 0, 1631038196),
(603, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 60, 0, 1631038196),
(604, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 78, 0, 1631038196),
(605, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 83, 0, 1631038196),
(606, 'New product added CHITRAKOOT', '', 133, 0, 'Product', 90, 1, 1631038196),
(607, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 1, 0, 1631038274),
(608, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 3, 1, 1631038274),
(609, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 13, 0, 1631038274),
(610, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 17, 0, 1631038274),
(611, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 24, 1, 1631038274),
(612, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 25, 0, 1631038274),
(613, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 26, 0, 1631038274),
(614, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 43, 0, 1631038274),
(615, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 44, 0, 1631038274),
(616, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 51, 0, 1631038274),
(617, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 52, 1, 1631038274),
(618, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 54, 0, 1631038274),
(619, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 55, 0, 1631038274),
(620, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 60, 0, 1631038274),
(621, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 78, 0, 1631038274),
(622, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 83, 0, 1631038274),
(623, 'New product added SAKSHI GOPAL', '', 134, 0, 'Product', 90, 1, 1631038274),
(624, 'New product added NAND UTSAV', '', 135, 0, 'Product', 1, 0, 1631038354),
(625, 'New product added NAND UTSAV', '', 135, 0, 'Product', 3, 1, 1631038354),
(626, 'New product added NAND UTSAV', '', 135, 0, 'Product', 13, 0, 1631038354);
INSERT INTO `notificationdata` (`id`, `title`, `description`, `productid`, `orderid`, `ordertype`, `userid`, `read_status`, `dateandtime`) VALUES
(627, 'New product added NAND UTSAV', '', 135, 0, 'Product', 17, 0, 1631038354),
(628, 'New product added NAND UTSAV', '', 135, 0, 'Product', 24, 1, 1631038354),
(629, 'New product added NAND UTSAV', '', 135, 0, 'Product', 25, 0, 1631038354),
(630, 'New product added NAND UTSAV', '', 135, 0, 'Product', 26, 0, 1631038354),
(631, 'New product added NAND UTSAV', '', 135, 0, 'Product', 43, 0, 1631038354),
(632, 'New product added NAND UTSAV', '', 135, 0, 'Product', 44, 0, 1631038354),
(633, 'New product added NAND UTSAV', '', 135, 0, 'Product', 51, 0, 1631038354),
(634, 'New product added NAND UTSAV', '', 135, 0, 'Product', 52, 1, 1631038354),
(635, 'New product added NAND UTSAV', '', 135, 0, 'Product', 54, 0, 1631038354),
(636, 'New product added NAND UTSAV', '', 135, 0, 'Product', 55, 0, 1631038354),
(637, 'New product added NAND UTSAV', '', 135, 0, 'Product', 60, 0, 1631038354),
(638, 'New product added NAND UTSAV', '', 135, 0, 'Product', 78, 0, 1631038354),
(639, 'New product added NAND UTSAV', '', 135, 0, 'Product', 83, 0, 1631038354),
(640, 'New product added NAND UTSAV', '', 135, 0, 'Product', 90, 1, 1631038354),
(641, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 1, 0, 1631038436),
(642, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 3, 1, 1631038436),
(643, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 13, 0, 1631038436),
(644, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 17, 0, 1631038436),
(645, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 24, 1, 1631038436),
(646, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 25, 0, 1631038436),
(647, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 26, 0, 1631038436),
(648, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 43, 0, 1631038436),
(649, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 44, 0, 1631038436),
(650, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 51, 0, 1631038436),
(651, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 52, 1, 1631038436),
(652, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 54, 0, 1631038436),
(653, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 55, 0, 1631038436),
(654, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 60, 0, 1631038436),
(655, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 78, 0, 1631038436),
(656, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 83, 0, 1631038436),
(657, 'New product added KANAK VATIKA', '', 136, 0, 'Product', 90, 1, 1631038436),
(658, 'New product added SHIVAAY', '', 137, 0, 'Product', 1, 0, 1631038521),
(659, 'New product added SHIVAAY', '', 137, 0, 'Product', 3, 1, 1631038521),
(660, 'New product added SHIVAAY', '', 137, 0, 'Product', 13, 0, 1631038521),
(661, 'New product added SHIVAAY', '', 137, 0, 'Product', 17, 0, 1631038521),
(662, 'New product added SHIVAAY', '', 137, 0, 'Product', 24, 1, 1631038521),
(663, 'New product added SHIVAAY', '', 137, 0, 'Product', 25, 0, 1631038521),
(664, 'New product added SHIVAAY', '', 137, 0, 'Product', 26, 0, 1631038521),
(665, 'New product added SHIVAAY', '', 137, 0, 'Product', 43, 0, 1631038521),
(666, 'New product added SHIVAAY', '', 137, 0, 'Product', 44, 0, 1631038521),
(667, 'New product added SHIVAAY', '', 137, 0, 'Product', 51, 0, 1631038521),
(668, 'New product added SHIVAAY', '', 137, 0, 'Product', 52, 1, 1631038521),
(669, 'New product added SHIVAAY', '', 137, 0, 'Product', 54, 0, 1631038521),
(670, 'New product added SHIVAAY', '', 137, 0, 'Product', 55, 0, 1631038521),
(671, 'New product added SHIVAAY', '', 137, 0, 'Product', 60, 0, 1631038521),
(672, 'New product added SHIVAAY', '', 137, 0, 'Product', 78, 0, 1631038521),
(673, 'New product added SHIVAAY', '', 137, 0, 'Product', 83, 0, 1631038521),
(674, 'New product added SHIVAAY', '', 137, 0, 'Product', 90, 1, 1631038521),
(675, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 1, 0, 1634961248),
(676, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 3, 1, 1634961248),
(677, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 13, 0, 1634961248),
(678, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 17, 0, 1634961248),
(679, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 24, 1, 1634961248),
(680, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 25, 0, 1634961248),
(681, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 26, 0, 1634961248),
(682, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 43, 0, 1634961248),
(683, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 44, 0, 1634961248),
(684, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 51, 0, 1634961248),
(685, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 52, 1, 1634961248),
(686, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 54, 0, 1634961248),
(687, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 55, 0, 1634961248),
(688, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 60, 0, 1634961248),
(689, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 78, 0, 1634961248),
(690, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 83, 0, 1634961248),
(691, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 90, 1, 1634961248),
(692, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 104, 1, 1634961248),
(693, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 109, 0, 1634961248),
(694, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 110, 0, 1634961248),
(695, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 113, 0, 1634961248),
(696, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 114, 0, 1634961248),
(697, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 120, 1, 1634961248),
(698, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 121, 0, 1634961248),
(699, 'New product added SRI GAYATRI JEE', '', 138, 0, 'Product', 122, 0, 1634961248),
(700, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 1, 0, 1634961377),
(701, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 3, 1, 1634961377),
(702, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 13, 0, 1634961377),
(703, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 17, 0, 1634961377),
(704, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 24, 1, 1634961377),
(705, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 25, 0, 1634961377),
(706, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 26, 0, 1634961377),
(707, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 43, 0, 1634961377),
(708, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 44, 0, 1634961377),
(709, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 51, 0, 1634961377),
(710, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 52, 1, 1634961377),
(711, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 54, 0, 1634961377),
(712, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 55, 0, 1634961377),
(713, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 60, 0, 1634961377),
(714, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 78, 0, 1634961377),
(715, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 83, 0, 1634961377),
(716, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 90, 1, 1634961377),
(717, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 104, 1, 1634961377),
(718, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 109, 0, 1634961377),
(719, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 110, 0, 1634961377),
(720, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 113, 0, 1634961377),
(721, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 114, 0, 1634961377),
(722, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 120, 1, 1634961377),
(723, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 121, 0, 1634961377),
(724, 'New product added SRI GEETA JI', '', 139, 0, 'Product', 122, 0, 1634961377),
(725, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 1, 0, 1634961530),
(726, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 3, 1, 1634961530),
(727, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 13, 0, 1634961530),
(728, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 17, 0, 1634961530),
(729, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 24, 1, 1634961530),
(730, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 25, 0, 1634961530),
(731, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 26, 0, 1634961530),
(732, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 43, 0, 1634961530),
(733, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 44, 0, 1634961530),
(734, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 51, 0, 1634961530),
(735, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 52, 1, 1634961530),
(736, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 54, 0, 1634961530),
(737, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 55, 0, 1634961530),
(738, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 60, 0, 1634961530),
(739, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 78, 0, 1634961530),
(740, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 83, 0, 1634961530),
(741, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 90, 1, 1634961530),
(742, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 104, 1, 1634961530),
(743, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 109, 0, 1634961530),
(744, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 110, 0, 1634961530),
(745, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 113, 0, 1634961530),
(746, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 114, 0, 1634961530),
(747, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 120, 1, 1634961530),
(748, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 121, 0, 1634961530),
(749, 'New product added SHREE NIKUNJ', '', 140, 0, 'Product', 122, 0, 1634961530),
(750, 'New product added RANGEELA', '', 141, 0, 'Product', 1, 0, 1634961632),
(751, 'New product added RANGEELA', '', 141, 0, 'Product', 3, 1, 1634961632),
(752, 'New product added RANGEELA', '', 141, 0, 'Product', 13, 0, 1634961632),
(753, 'New product added RANGEELA', '', 141, 0, 'Product', 17, 0, 1634961632),
(754, 'New product added RANGEELA', '', 141, 0, 'Product', 24, 1, 1634961632),
(755, 'New product added RANGEELA', '', 141, 0, 'Product', 25, 0, 1634961632),
(756, 'New product added RANGEELA', '', 141, 0, 'Product', 26, 0, 1634961632),
(757, 'New product added RANGEELA', '', 141, 0, 'Product', 43, 0, 1634961632),
(758, 'New product added RANGEELA', '', 141, 0, 'Product', 44, 0, 1634961632),
(759, 'New product added RANGEELA', '', 141, 0, 'Product', 51, 0, 1634961632),
(760, 'New product added RANGEELA', '', 141, 0, 'Product', 52, 1, 1634961632),
(761, 'New product added RANGEELA', '', 141, 0, 'Product', 54, 0, 1634961632),
(762, 'New product added RANGEELA', '', 141, 0, 'Product', 55, 0, 1634961632),
(763, 'New product added RANGEELA', '', 141, 0, 'Product', 60, 0, 1634961632),
(764, 'New product added RANGEELA', '', 141, 0, 'Product', 78, 0, 1634961632),
(765, 'New product added RANGEELA', '', 141, 0, 'Product', 83, 0, 1634961632),
(766, 'New product added RANGEELA', '', 141, 0, 'Product', 90, 1, 1634961632),
(767, 'New product added RANGEELA', '', 141, 0, 'Product', 104, 1, 1634961632),
(768, 'New product added RANGEELA', '', 141, 0, 'Product', 109, 0, 1634961632),
(769, 'New product added RANGEELA', '', 141, 0, 'Product', 110, 0, 1634961632),
(770, 'New product added RANGEELA', '', 141, 0, 'Product', 113, 0, 1634961632),
(771, 'New product added RANGEELA', '', 141, 0, 'Product', 114, 0, 1634961632),
(772, 'New product added RANGEELA', '', 141, 0, 'Product', 120, 1, 1634961632),
(773, 'New product added RANGEELA', '', 141, 0, 'Product', 121, 0, 1634961632),
(774, 'New product added RANGEELA', '', 141, 0, 'Product', 122, 0, 1634961632),
(775, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 1, 0, 1634961727),
(776, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 3, 1, 1634961727),
(777, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 13, 0, 1634961727),
(778, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 17, 0, 1634961727),
(779, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 24, 1, 1634961727),
(780, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 25, 0, 1634961727),
(781, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 26, 0, 1634961727),
(782, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 43, 0, 1634961727),
(783, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 44, 0, 1634961727),
(784, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 51, 0, 1634961727),
(785, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 52, 1, 1634961727),
(786, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 54, 0, 1634961727),
(787, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 55, 0, 1634961727),
(788, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 60, 0, 1634961727),
(789, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 78, 0, 1634961727),
(790, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 83, 0, 1634961727),
(791, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 90, 1, 1634961727),
(792, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 104, 1, 1634961727),
(793, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 109, 0, 1634961727),
(794, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 110, 0, 1634961727),
(795, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 113, 0, 1634961727),
(796, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 114, 0, 1634961727),
(797, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 120, 1, 1634961727),
(798, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 121, 0, 1634961727),
(799, 'New product added SIYA SAKHI', '', 142, 0, 'Product', 122, 0, 1634961727),
(800, 'New product added GODAVARI', '', 143, 0, 'Product', 1, 0, 1634961870),
(801, 'New product added GODAVARI', '', 143, 0, 'Product', 3, 1, 1634961870),
(802, 'New product added GODAVARI', '', 143, 0, 'Product', 13, 0, 1634961870),
(803, 'New product added GODAVARI', '', 143, 0, 'Product', 17, 0, 1634961870),
(804, 'New product added GODAVARI', '', 143, 0, 'Product', 24, 1, 1634961870),
(805, 'New product added GODAVARI', '', 143, 0, 'Product', 25, 0, 1634961870),
(806, 'New product added GODAVARI', '', 143, 0, 'Product', 26, 0, 1634961870),
(807, 'New product added GODAVARI', '', 143, 0, 'Product', 43, 0, 1634961870),
(808, 'New product added GODAVARI', '', 143, 0, 'Product', 44, 0, 1634961870),
(809, 'New product added GODAVARI', '', 143, 0, 'Product', 51, 0, 1634961870),
(810, 'New product added GODAVARI', '', 143, 0, 'Product', 52, 1, 1634961870),
(811, 'New product added GODAVARI', '', 143, 0, 'Product', 54, 0, 1634961870),
(812, 'New product added GODAVARI', '', 143, 0, 'Product', 55, 0, 1634961870),
(813, 'New product added GODAVARI', '', 143, 0, 'Product', 60, 0, 1634961870),
(814, 'New product added GODAVARI', '', 143, 0, 'Product', 78, 0, 1634961870),
(815, 'New product added GODAVARI', '', 143, 0, 'Product', 83, 0, 1634961870),
(816, 'New product added GODAVARI', '', 143, 0, 'Product', 90, 1, 1634961870),
(817, 'New product added GODAVARI', '', 143, 0, 'Product', 104, 1, 1634961870),
(818, 'New product added GODAVARI', '', 143, 0, 'Product', 109, 0, 1634961870),
(819, 'New product added GODAVARI', '', 143, 0, 'Product', 110, 0, 1634961870),
(820, 'New product added GODAVARI', '', 143, 0, 'Product', 113, 0, 1634961870),
(821, 'New product added GODAVARI', '', 143, 0, 'Product', 114, 0, 1634961870),
(822, 'New product added GODAVARI', '', 143, 0, 'Product', 120, 1, 1634961870),
(823, 'New product added GODAVARI', '', 143, 0, 'Product', 121, 0, 1634961870),
(824, 'New product added GODAVARI', '', 143, 0, 'Product', 122, 0, 1634961870),
(825, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 1, 0, 1635657162),
(826, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 3, 1, 1635657162),
(827, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 13, 0, 1635657162),
(828, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 17, 0, 1635657162),
(829, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 24, 1, 1635657162),
(830, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 25, 0, 1635657162),
(831, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 26, 0, 1635657162),
(832, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 43, 0, 1635657162),
(833, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 44, 0, 1635657162),
(834, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 51, 0, 1635657162),
(835, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 52, 1, 1635657162),
(836, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 54, 0, 1635657162),
(837, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 55, 0, 1635657162),
(838, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 60, 0, 1635657162),
(839, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 78, 0, 1635657162),
(840, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 83, 0, 1635657162),
(841, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 90, 1, 1635657162),
(842, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 104, 1, 1635657162),
(843, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 109, 0, 1635657162),
(844, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 110, 0, 1635657162),
(845, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 113, 0, 1635657162),
(846, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 114, 0, 1635657162),
(847, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 120, 0, 1635657162),
(848, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 121, 0, 1635657162),
(849, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 122, 0, 1635657162),
(850, 'New product added SHYAMA SHYAM', '', 144, 0, 'Product', 123, 1, 1635657162),
(851, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 1, 0, 1635657299),
(852, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 3, 1, 1635657299),
(853, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 13, 0, 1635657299),
(854, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 17, 0, 1635657299),
(855, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 24, 1, 1635657299),
(856, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 25, 0, 1635657299),
(857, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 26, 0, 1635657299),
(858, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 43, 0, 1635657299),
(859, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 44, 0, 1635657299),
(860, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 51, 0, 1635657299),
(861, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 52, 1, 1635657299),
(862, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 54, 0, 1635657299),
(863, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 55, 0, 1635657299),
(864, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 60, 0, 1635657299),
(865, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 78, 0, 1635657299),
(866, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 83, 0, 1635657299),
(867, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 90, 1, 1635657299),
(868, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 104, 1, 1635657299),
(869, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 109, 0, 1635657299),
(870, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 110, 0, 1635657299),
(871, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 113, 0, 1635657299),
(872, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 114, 0, 1635657299),
(873, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 120, 0, 1635657299),
(874, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 121, 0, 1635657299),
(875, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 122, 0, 1635657299),
(876, 'New product added MAHA MANGALAM CHUNARI', '', 145, 0, 'Product', 123, 1, 1635657299),
(877, 'New product added FULVARI', '', 146, 0, 'Product', 1, 0, 1635657401),
(878, 'New product added FULVARI', '', 146, 0, 'Product', 3, 1, 1635657401),
(879, 'New product added FULVARI', '', 146, 0, 'Product', 13, 0, 1635657401),
(880, 'New product added FULVARI', '', 146, 0, 'Product', 17, 0, 1635657401),
(881, 'New product added FULVARI', '', 146, 0, 'Product', 24, 0, 1635657401),
(882, 'New product added FULVARI', '', 146, 0, 'Product', 25, 0, 1635657401),
(883, 'New product added FULVARI', '', 146, 0, 'Product', 26, 0, 1635657401),
(884, 'New product added FULVARI', '', 146, 0, 'Product', 43, 0, 1635657401),
(885, 'New product added FULVARI', '', 146, 0, 'Product', 44, 0, 1635657401),
(886, 'New product added FULVARI', '', 146, 0, 'Product', 51, 0, 1635657401),
(887, 'New product added FULVARI', '', 146, 0, 'Product', 52, 1, 1635657401),
(888, 'New product added FULVARI', '', 146, 0, 'Product', 54, 0, 1635657401),
(889, 'New product added FULVARI', '', 146, 0, 'Product', 55, 0, 1635657401),
(890, 'New product added FULVARI', '', 146, 0, 'Product', 60, 0, 1635657401),
(891, 'New product added FULVARI', '', 146, 0, 'Product', 78, 0, 1635657401),
(892, 'New product added FULVARI', '', 146, 0, 'Product', 83, 0, 1635657401),
(893, 'New product added FULVARI', '', 146, 0, 'Product', 90, 1, 1635657401),
(894, 'New product added FULVARI', '', 146, 0, 'Product', 104, 1, 1635657401),
(895, 'New product added FULVARI', '', 146, 0, 'Product', 109, 0, 1635657401),
(896, 'New product added FULVARI', '', 146, 0, 'Product', 110, 0, 1635657401),
(897, 'New product added FULVARI', '', 146, 0, 'Product', 113, 0, 1635657401),
(898, 'New product added FULVARI', '', 146, 0, 'Product', 114, 0, 1635657401),
(899, 'New product added FULVARI', '', 146, 0, 'Product', 120, 0, 1635657401),
(900, 'New product added FULVARI', '', 146, 0, 'Product', 121, 0, 1635657401),
(901, 'New product added FULVARI', '', 146, 0, 'Product', 122, 0, 1635657401),
(902, 'New product added FULVARI', '', 146, 0, 'Product', 123, 1, 1635657401),
(903, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 1, 0, 1638768307),
(904, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 3, 1, 1638768307),
(905, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 13, 0, 1638768307),
(906, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 17, 0, 1638768307),
(907, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 24, 0, 1638768307),
(908, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 25, 0, 1638768307),
(909, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 26, 0, 1638768307),
(910, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 41, 0, 1638768307),
(911, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 43, 0, 1638768307),
(912, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 44, 0, 1638768307),
(913, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 51, 0, 1638768307),
(914, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 52, 0, 1638768307),
(915, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 54, 0, 1638768307),
(916, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 55, 0, 1638768307),
(917, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 60, 0, 1638768307),
(918, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 78, 0, 1638768307),
(919, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 83, 0, 1638768307),
(920, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 90, 0, 1638768307),
(921, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 104, 0, 1638768307),
(922, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 105, 0, 1638768307),
(923, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 109, 0, 1638768307),
(924, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 110, 0, 1638768307),
(925, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 113, 0, 1638768307),
(926, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 114, 0, 1638768307),
(927, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 120, 0, 1638768307),
(928, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 121, 0, 1638768307),
(929, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 122, 0, 1638768307),
(930, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 123, 0, 1638768307),
(931, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 124, 0, 1638768307),
(932, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 126, 0, 1638768307),
(933, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 130, 0, 1638768307),
(934, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 131, 0, 1638768307),
(935, 'New product added LAXMI SWAYAMBAR', '', 147, 0, 'Product', 132, 0, 1638768307),
(936, 'Order Status is changed to Accepted_by_Agent', 'Your Order ID : #1', 0, 1, 'Direct Order', 83, 0, 1643703451),
(937, 'Order Status is changed to Accepted_by_kodas', 'Your Order ID : #1', 0, 1, 'Direct Order', 83, 0, 1643703470),
(938, 'Order Status is changed to Accepted_by_Agent', 'Your Order ID : #2', 0, 2, 'Normal Order', 114, 0, 1643703502),
(939, 'New product added Chabili', '', 34, 0, 'Product', 2, 0, 1646720037),
(940, 'New product added Chabili', '', 35, 0, 'Product', 2, 0, 1646720429),
(941, 'Order Status is changed to Accepted_by_Agent', 'Your Order ID : #6', 0, 6, 'Normal Order', 32, 0, 1647331230),
(942, 'Order Status is changed to Accepted_by_kodas', 'Your Order ID : #5', 0, 5, 'Normal Order', 32, 0, 1647331244),
(943, 'Order Status is changed to Processing', 'Your Order ID : #4', 0, 4, 'Normal Order', 32, 0, 1647331252),
(944, 'Order Status is changed to Processing', 'Your Order ID : #3', 0, 3, 'Normal Order', 32, 0, 1647331262),
(945, 'Order Status is changed to Shipped', 'Your Order ID : #2', 0, 2, 'Normal Order', 32, 0, 1647331270),
(946, 'Order Status is changed to Cancelled', 'Your Order ID : #3', 0, 3, 'Normal Order', 32, 0, 1647331280);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'point to public_users ID',
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `transactionid` varchar(256) NOT NULL,
  `discountamount` double NOT NULL,
  `coupancode` varchar(256) DEFAULT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `totalqty` int(11) NOT NULL,
  `finaltotal` float NOT NULL,
  `gst` double NOT NULL,
  `gstamount` double NOT NULL,
  `gstwithamount` double NOT NULL,
  `processed` varchar(25) NOT NULL DEFAULT '0',
  `viewed` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'viewed status is change when change processed status',
  `orderaudio` text NOT NULL,
  `description` text NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `discount_code` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `products`, `date`, `referrer`, `clean_referrer`, `payment_type`, `transactionid`, `discountamount`, `coupancode`, `paypal_status`, `totalqty`, `finaltotal`, `gst`, `gstamount`, `gstwithamount`, `processed`, `viewed`, `orderaudio`, `description`, `confirmed`, `discount_code`) VALUES
(1, 1234, 32, '', 1647354375, '', '', 'credit card', '1234', 0, '', NULL, 10, 8000, 5, 101, 8400, 'Pending', 1, '1647354375_sample-3s.mp3', '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderstatuslist`
--

CREATE TABLE `orderstatuslist` (
  `id` int(11) NOT NULL,
  `name` varchar(56) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderstatuslist`
--

INSERT INTO `orderstatuslist` (`id`, `name`, `dateandtime`) VALUES
(1, 'Pending', '2022-01-24 14:42:52'),
(2, 'Accepted by Agent', '2022-03-15 13:05:07'),
(3, 'Accepted by kodas', '2022-03-15 13:05:14'),
(4, 'Shipped', '2022-03-15 13:05:21'),
(6, 'Cancelled', '2022-01-24 14:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders_clients`
--

CREATE TABLE `orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `shiptoid` text NOT NULL,
  `billtoid` text NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orders_clients`
--

INSERT INTO `orders_clients` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `city`, `post_code`, `shiptoid`, `billtoid`, `notes`, `for_id`) VALUES
(1, 'jaimish', '', 'j@gmail.com', '8160402366', '120, sarkari solution', '', '', 'a:1:{i:0;a:4:{s:2:\"Id\";s:2:\"43\";s:11:\"Companyname\";s:3:\"cdx\";s:7:\"Address\";s:10:\"120, surat\";s:9:\"Gstnumber\";s:6:\"123456\";}}', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_chatmessenger`
--

CREATE TABLE `order_chatmessenger` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `read_status` int(11) NOT NULL,
  `usertype` varchar(56) NOT NULL,
  `type` varchar(25) NOT NULL,
  `time` int(11) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_chatmessenger`
--

INSERT INTO `order_chatmessenger` (`id`, `sender_id`, `receiver_id`, `order_id`, `message`, `read_status`, `usertype`, `type`, `time`, `dateandtime`) VALUES
(1, 1, 32, 6, 'Order is shifted to Accepted_by_Agent', 0, 'admin', 'Normal Order', 1647331230, '2022-03-15 08:00:30'),
(2, 1, 32, 5, 'Order is shifted to Accepted_by_kodas', 0, 'admin', 'Normal Order', 1647331244, '2022-03-15 08:00:44'),
(3, 1, 32, 4, 'Order is shifted to Processing', 0, 'admin', 'Normal Order', 1647331252, '2022-03-15 08:00:52'),
(4, 1, 32, 3, 'Order is shifted to Processing', 0, 'admin', 'Normal Order', 1647331262, '2022-03-15 08:01:02'),
(5, 1, 32, 2, 'Order is shifted to Shipped', 0, 'admin', 'Normal Order', 1647331270, '2022-03-15 08:01:10'),
(6, 1, 32, 3, 'Order is shifted to Cancelled', 0, 'admin', 'Normal Order', 1647331280, '2022-03-15 08:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `refOrder_id` int(30) NOT NULL,
  `itemid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ProductType` varchar(20) NOT NULL,
  `comment` longtext NOT NULL,
  `hindicomment` longtext NOT NULL,
  `audiofile` text NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `refOrder_id`, `itemid`, `qty`, `ProductType`, `comment`, `hindicomment`, `audiofile`, `updatetime`) VALUES
(1, 1, 33, 10, 'box', 'no comment', '', '1647354213_sample-3s.mp3', '2022-03-15 14:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `packagingtype`
--

CREATE TABLE `packagingtype` (
  `packagingtype_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `pcs` int(30) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packagingtype`
--

INSERT INTO `packagingtype` (`packagingtype_id`, `title`, `pcs`, `status`) VALUES
(1, 'box 1', 60, 1),
(2, 'Box 2', 72, 1),
(3, 'Box 3', 84, 1);

-- --------------------------------------------------------

--
-- Table structure for table `photoordercreate`
--

CREATE TABLE `photoordercreate` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `hindicomment` text NOT NULL,
  `address` text NOT NULL,
  `transportname` text NOT NULL,
  `orderphoto` text NOT NULL,
  `orderaudio` text NOT NULL,
  `userid` int(11) NOT NULL,
  `shiptoid` text NOT NULL,
  `billtoid` text NOT NULL,
  `orderstatus` varchar(56) NOT NULL,
  `viewed` tinyint(4) NOT NULL,
  `datetime` int(11) NOT NULL,
  `curenttimedate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photoordercreate`
--

INSERT INTO `photoordercreate` (`id`, `title`, `description`, `hindicomment`, `address`, `transportname`, `orderphoto`, `orderaudio`, `userid`, `shiptoid`, `billtoid`, `orderstatus`, `viewed`, `datetime`, `curenttimedate`) VALUES
(1, 'Chetan 29 June, 2021', 'iyiyd', '', '', '', '1624943867_image_picker2438455272914437597.jpg', '', 83, 'a:1:{i:0;a:4:{s:2:\"Id\";s:2:\"32\";s:11:\"Companyname\";s:8:\"Premware\";s:7:\"Address\";s:19:\"23jngf sdp gdfg nkj\";s:9:\"Gstnumber\";s:11:\"kjhdr4nhfdg\";}}', 'a:1:{i:0;a:4:{s:2:\"Id\";s:2:\"31\";s:11:\"Companyname\";s:8:\"Premware\";s:7:\"Address\";s:19:\"23jngf sdp gdfg nkj\";s:9:\"Gstnumber\";s:11:\"kjhdr4nhfdg\";}}', 'Accepted by kodas', 1, 1624943868, '2022-03-15 13:07:07'),
(2, 'jaimish jaimis 15 March, 2022', '', '', '', '', '', '1647338646_flutter_sound.mp4', 32, 'a:1:{i:0;a:4:{s:2:\"Id\";s:2:\"21\";s:11:\"Companyname\";s:8:\"premware\";s:7:\"Address\";s:4:\"vesu\";s:9:\"Gstnumber\";s:15:\"24RGTUH2486A2ZC\";}}', 'a:1:{i:0;a:4:{s:2:\"Id\";s:2:\"22\";s:11:\"Companyname\";s:8:\"premware\";s:7:\"Address\";s:4:\"vesu\";s:9:\"Gstnumber\";s:15:\"24RGTUH2486A2ZC\";}}', 'Pending', 0, 1647338646, '2022-03-15 13:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `pre_products`
--

CREATE TABLE `pre_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `folder` int(10) UNSIGNED DEFAULT NULL COMMENT 'folder with images',
  `image` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL COMMENT 'time created',
  `time_update` int(10) UNSIGNED NOT NULL COMMENT 'time updated',
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `basic_description` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `old_price` varchar(20) NOT NULL,
  `shop_categorie` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `procurement` int(10) UNSIGNED NOT NULL,
  `in_slider` tinyint(1) NOT NULL DEFAULT 0,
  `product_type` varchar(10) NOT NULL,
  `product_pcs` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `min_qty` int(11) NOT NULL,
  `videoid` varchar(256) NOT NULL,
  `url` varchar(255) NOT NULL,
  `virtual_products` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `pre_products_translations`
--

CREATE TABLE `pre_products_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `basic_description` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `old_price` varchar(20) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `privacypage`
--

CREATE TABLE `privacypage` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `dateandtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacypage`
--

INSERT INTO `privacypage` (`id`, `title`, `description`, `dateandtime`) VALUES
(1, 'Privacy Policy', '<p>Privacy Policy</p>\r\n', 1614589559);

-- --------------------------------------------------------

--
-- Table structure for table `productcat`
--

CREATE TABLE `productcat` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `timeanddate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productcat`
--

INSERT INTO `productcat` (`id`, `productid`, `catid`, `timeanddate`) VALUES
(8, 56, 1, 1603434444),
(9, 55, 5, 1603434456),
(10, 55, 2, 1603434456),
(11, 54, 3, 1603434465),
(12, 53, 3, 1603434477),
(13, 53, 5, 1603434477),
(14, 52, 1, 1603434656),
(15, 51, 3, 1603434668),
(16, 51, 1, 1603434668),
(17, 50, 4, 1603434679),
(18, 49, 3, 1603434692),
(19, 49, 4, 1603434692),
(22, 47, 3, 1603435381),
(23, 48, 4, 1603438695),
(24, 48, 5, 1603438695),
(25, 57, 3, 1603445159),
(26, 57, 4, 1603445159),
(27, 57, 1, 1603445159),
(40, 68, 6, 1604583457),
(126, 69, 1, 1610352771),
(165, 61, 1, 1610363715),
(297, 83, 1, 1611856679),
(374, 92, 1, 1614101760),
(375, 93, 1, 1614101823),
(376, 94, 1, 1614101885),
(378, 90, 1, 1614599146),
(379, 89, 1, 1614599155),
(380, 88, 1, 1614599163),
(382, 86, 1, 1614599184),
(383, 85, 1, 1614599205),
(384, 84, 1, 1614599218),
(386, 82, 1, 1614599322),
(387, 80, 1, 1614599362),
(389, 78, 1, 1614599391),
(408, 87, 1, 1614785296),
(410, 77, 1, 1614849724),
(428, 103, 1, 1619003623),
(429, 104, 1, 1619003715),
(437, 110, 1, 1619004713),
(441, 108, 1, 1619013416),
(442, 106, 1, 1619013517),
(443, 107, 1, 1619013649),
(444, 105, 1, 1619013868),
(446, 58, 1, 1619015429),
(447, 59, 1, 1619015452),
(448, 60, 1, 1619015477),
(449, 62, 1, 1619015499),
(450, 63, 1, 1619015538),
(451, 64, 1, 1619015549),
(452, 65, 1, 1619015570),
(453, 66, 1, 1619015589),
(454, 67, 1, 1619015602),
(455, 76, 1, 1619015622),
(456, 71, 1, 1619015645),
(457, 72, 1, 1619015662),
(458, 74, 1, 1619015678),
(459, 75, 1, 1619015692),
(460, 101, 1, 1619072828),
(462, 102, 1, 1619074402),
(463, 112, 1, 1619336902),
(465, 114, 1, 1619337301),
(470, 70, 1, 1620278558),
(473, 95, 1, 1622197825),
(479, 116, 1, 1622999479),
(480, 117, 1, 1622999599),
(481, 118, 1, 1622999678),
(484, 120, 1, 1628705538),
(485, 119, 1, 1628705552),
(487, 121, 1, 1628705931),
(488, 122, 1, 1628706041),
(489, 123, 1, 1628706175),
(490, 124, 1, 1628706298),
(491, 100, 1, 1628706343),
(492, 99, 1, 1628706362),
(494, 98, 1, 1628706400),
(495, 97, 1, 1628706418),
(496, 79, 1, 1628706441),
(497, 73, 1, 1628706463),
(500, 109, 1, 1631026146),
(501, 111, 1, 1631026252),
(514, 137, 1, 1631038522),
(515, 115, 1, 1631038565),
(517, 126, 1, 1631038933),
(518, 127, 1, 1631038987),
(519, 128, 1, 1631039076),
(520, 129, 1, 1631039119),
(521, 130, 1, 1631039238),
(522, 132, 1, 1631039304),
(523, 131, 1, 1631039347),
(524, 133, 1, 1631039476),
(525, 134, 1, 1631039563),
(526, 136, 1, 1631039611),
(527, 135, 1, 1631039651),
(528, 125, 1, 1631039713),
(529, 138, 1, 1634961249),
(530, 139, 1, 1634961378),
(532, 141, 1, 1634961634),
(534, 143, 1, 1634961871),
(536, 145, 1, 1635657301),
(538, 142, 1, 1635658439),
(539, 140, 1, 1635659371),
(558, 146, 1, 1643741141),
(565, 81, 1, 1645260455),
(566, 147, 1, 1645268239),
(567, 91, 1, 1645268288),
(568, 144, 1, 1645421638),
(579, 15, 5, 1645496169),
(591, 1, 5, 1645508683),
(593, 17, 5, 1645509269),
(594, 18, 5, 1645509458),
(596, 19, 1, 1645510145),
(600, 21, 1, 1645510437),
(602, 22, 1, 1645510569),
(604, 23, 1, 1645510709),
(605, 24, 1, 1645510850),
(607, 25, 1, 1645594618),
(608, 20, 1, 1645598015),
(609, 16, 5, 1645693321),
(661, 2, 6, 1646724179),
(662, 2, 1, 1646724179),
(663, 35, 5, 1646724187),
(664, 34, 5, 1646724194),
(669, 33, 6, 1646887536),
(670, 33, 1, 1646887536);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `designNo` varchar(255) NOT NULL,
  `folder` int(10) UNSIGNED DEFAULT NULL COMMENT 'folder with images',
  `image` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL COMMENT 'time created',
  `time_update` int(10) UNSIGNED NOT NULL COMMENT 'time updated',
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `shop_categorie` int(11) NOT NULL,
  `connectedProduct` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `procurement` int(10) UNSIGNED NOT NULL,
  `in_slider` tinyint(1) NOT NULL DEFAULT 0,
  `product_type` varchar(10) NOT NULL,
  `product_pcs` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `min_qty` int(11) NOT NULL,
  `videoid` varchar(256) NOT NULL,
  `price1` double NOT NULL COMMENT 'This price is for guest user',
  `price2` double NOT NULL COMMENT 'This price is for Retailer user',
  `price3` double NOT NULL COMMENT 'This price is for Wholseller user',
  `price4` double NOT NULL,
  `theli_price1` double NOT NULL,
  `theli_price2` double NOT NULL,
  `theli_price3` double NOT NULL,
  `url` varchar(255) NOT NULL,
  `virtual_products` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `productviewtype` varchar(256) NOT NULL,
  `productoffertype` varchar(256) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT 0,
  `refPackagingtype_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `designNo`, `folder`, `image`, `time`, `time_update`, `visibility`, `title`, `shop_categorie`, `connectedProduct`, `quantity`, `procurement`, `in_slider`, `product_type`, `product_pcs`, `view_count`, `min_qty`, `videoid`, `price1`, `price2`, `price3`, `price4`, `theli_price1`, `theli_price2`, `theli_price3`, `url`, `virtual_products`, `brand_id`, `productviewtype`, `productoffertype`, `position`, `vendor_id`, `refPackagingtype_id`) VALUES
(2, '1234abc', 1645440838, 'IMG-20220204-WA0058.jpg', 1645440851, 1646724179, 1, '', 0, 0, 0, 0, 0, 'loose', 18, 1, 1, '', 800, 800, 800, 800, 0, 0, 0, 'Chabili_2', NULL, NULL, 'guest', 'latest,trending,recommended', 0, 0, 1),
(33, '1234abc', 1646308287, 'IMG-20220204-WA00702.jpg', 1646308334, 1646887536, 1, '', 0, 0, 0, 0, 0, '', 18, 0, 2, '', 800, 1000, 400, 0, 500, 200, 300, 'Chabili_33', NULL, NULL, 'guest,retailer', 'latest,trending,recommended', 0, 0, 2),
(34, '1234abc', 1646719996, 'C.jpg', 1646720037, 1646724194, 1, '', 0, 0, 0, 0, 0, '', 18, 0, 2, '', 800, 800, 1000, 0, 500, 200, 300, 'Chabili_34', NULL, NULL, 'guest', 'latest,trending,recommended', 0, 0, 1),
(35, '1234abc', 1646719996, 'C1.jpg', 1646720429, 1646724187, 1, '', 0, 0, 0, 0, 0, '', 18, 0, 2, '', 800, 800, 1000, 0, 500, 200, 300, 'Chabili_35', NULL, NULL, 'guest', 'latest,trending,recommended', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_translations`
--

CREATE TABLE `products_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `theli_title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `basic_description` text NOT NULL,
  `price` double NOT NULL,
  `old_price` varchar(20) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products_translations`
--

INSERT INTO `products_translations` (`id`, `title`, `theli_title`, `description`, `basic_description`, `price`, `old_price`, `abbr`, `for_id`) VALUES
(3, 'Chabili', '', '<p><b>Meteria</b></p>\r\n\r\n<ul>\r\n	<li>Silk</li>\r\n</ul>\r\n\r\n<p><strong>Work</strong></p>\r\n\r\n<ul>\r\n	<li>Diamond</li>\r\n</ul>\r\n\r\n<p><strong>Pattern</strong></p>\r\n\r\n<ul>\r\n	<li>Woven Handloom Silk Saree With Zari&nbsp;</li>\r\n</ul>\r\n\r\n<p><strong>Occasion</strong></p>\r\n\r\n<ul>\r\n	<li>Party Wear Festive Wear&nbsp;</li>\r\n</ul>\r\n\r\n<p><strong>Pack Contain</strong></p>\r\n\r\n<ul>\r\n	<li>1 Set = 6 Pcs</li>\r\n</ul>\r\n\r\n<p><strong>Care Instructions</strong></p>\r\n\r\n<ul>\r\n	<li>Hand Wash</li>\r\n</ul>\r\n\r\n<p><strong>Colours</strong></p>\r\n\r\n<ul>\r\n	<li>Red Rama Tomato Blue Orange Voilet</li>\r\n</ul>\r\n', '', 1000, '', 'en', 2),
(20, 'Chabili', 'abcdef', '<p>asas</p>\r\n', '', 0, '', 'en', 33),
(21, 'Chabili', 'abcdef', '<p>asas</p>\r\n', '', 0, '', 'en', 34),
(22, 'Chabili', 'abcdef', '<p>asas</p>\r\n', '', 0, '', 'en', 35);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `preproductid` int(11) NOT NULL,
  `keyid` int(11) NOT NULL,
  `valueid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute1`
--

CREATE TABLE `product_attribute1` (
  `product_attribute_id` int(11) NOT NULL,
  `refattributes_id` int(30) NOT NULL,
  `refAttributesgroup_id` int(30) NOT NULL,
  `refProduct_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attribute1`
--

INSERT INTO `product_attribute1` (`product_attribute_id`, `refattributes_id`, `refAttributesgroup_id`, `refProduct_id`) VALUES
(22, 33, 7, 15),
(49, 41, 8, 1),
(50, 83, 10, 1),
(53, 40, 8, 17),
(54, 44, 9, 17),
(55, 83, 10, 17),
(56, 37, 8, 18),
(57, 44, 9, 18),
(58, 83, 10, 18),
(61, 45, 9, 19),
(62, 66, 10, 19),
(66, 41, 8, 21),
(67, 45, 9, 21),
(68, 66, 10, 21),
(72, 37, 8, 22),
(73, 45, 9, 22),
(74, 66, 10, 22),
(78, 37, 8, 23),
(79, 44, 9, 23),
(80, 83, 10, 23),
(81, 37, 8, 24),
(82, 44, 9, 24),
(83, 83, 10, 24),
(87, 37, 8, 25),
(88, 45, 9, 25),
(89, 66, 10, 25),
(90, 44, 9, 16),
(91, 83, 10, 16),
(168, 30, 6, 2),
(169, 37, 8, 2),
(170, 44, 9, 2),
(171, 66, 10, 2),
(172, 35, 8, 35),
(173, 35, 8, 34),
(180, 3, 3, 33),
(181, 4, 3, 33),
(182, 14, 4, 33),
(183, 44, 9, 33);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(11) NOT NULL,
  `img_name` text NOT NULL,
  `refProduct_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `img_name`, `refProduct_id`) VALUES
(3, 'uploads-25729-1645450472-20220221-070432pm.jpg', 15),
(14, 'uploads-35912-1645507790-20220222-105950am.jpg', 1),
(15, 'uploads-42617-1645507790-20220222-105950am.jpg', 1),
(16, 'uploads-81533-1645507790-20220222-105950am.jpg', 1),
(17, 'uploads-36112-1645507790-20220222-105950am.jpg', 1),
(18, 'uploads-87388-1645507791-20220222-105951am.jpg', 1),
(19, 'uploads-40735-1645507791-20220222-105951am.jpg', 1),
(24, 'uploads-16959-1645508627-20220222-111347am.jpg', 1),
(25, 'uploads-60214-1645508628-20220222-111348am.jpg', 1),
(26, 'uploads-66793-1645508849-20220222-111729am.jpg', 16),
(27, 'uploads-21383-1645508849-20220222-111729am.jpg', 16),
(34, 'uploads-95086-1645509269-20220222-112429am.jpg', 17),
(35, 'uploads-63670-1645509269-20220222-112429am.jpg', 17),
(36, 'uploads-71825-1645509455-20220222-112735am.jpg', 18),
(37, 'uploads-53196-1645509455-20220222-112735am.jpg', 18),
(38, 'uploads-79092-1645509456-20220222-112736am.jpg', 18),
(39, 'uploads-11277-1645509456-20220222-112736am.jpg', 18),
(40, 'uploads-55418-1645509456-20220222-112736am.jpg', 18),
(41, 'uploads-22614-1645509456-20220222-112736am.jpg', 18),
(42, 'uploads-56767-1645509457-20220222-112737am.jpg', 18),
(43, 'uploads-71850-1645509457-20220222-112737am.jpg', 18),
(44, 'uploads-82197-1645510119-20220222-113839am.jpg', 19),
(45, 'uploads-72754-1645510121-20220222-113841am.jpg', 19),
(46, 'uploads-61683-1645510123-20220222-113843am.jpg', 19),
(47, 'uploads-83085-1645510145-20220222-113905am.jpg', 19),
(48, 'uploads-74873-1645510145-20220222-113905am.jpg', 19),
(49, 'uploads-57868-1645510146-20220222-113906am.jpg', 19),
(50, 'uploads-26844-1645510148-20220222-113908am.jpg', 19),
(51, 'uploads-88832-1645510150-20220222-113910am.jpg', 19),
(52, 'uploads-40188-1645510249-20220222-114049am.jpg', 20),
(53, 'uploads-36653-1645510251-20220222-114051am.jpg', 20),
(54, 'uploads-61469-1645510253-20220222-114053am.jpg', 20),
(55, 'uploads-61629-1645510268-20220222-114108am.jpg', 20),
(56, 'uploads-24184-1645510268-20220222-114108am.jpg', 20),
(57, 'uploads-82844-1645510269-20220222-114109am.jpg', 20),
(58, 'uploads-88829-1645510271-20220222-114111am.jpg', 20),
(59, 'uploads-28440-1645510273-20220222-114113am.jpg', 20),
(60, 'uploads-97095-1645510424-20220222-114344am.jpg', 21),
(61, 'uploads-13466-1645510425-20220222-114345am.jpg', 21),
(62, 'uploads-28952-1645510425-20220222-114345am.jpg', 21),
(63, 'uploads-42199-1645510437-20220222-114357am.jpg', 21),
(64, 'uploads-86248-1645510437-20220222-114357am.jpg', 21),
(65, 'uploads-52525-1645510437-20220222-114357am.jpg', 21),
(66, 'uploads-36361-1645510438-20220222-114358am.jpg', 21),
(67, 'uploads-20388-1645510438-20220222-114358am.jpg', 21),
(68, 'uploads-42874-1645510556-20220222-114556am.jpg', 22),
(69, 'uploads-90492-1645510557-20220222-114557am.jpg', 22),
(70, 'uploads-24098-1645510557-20220222-114557am.jpg', 22),
(71, 'uploads-80958-1645510557-20220222-114557am.jpg', 22),
(72, 'uploads-14330-1645510569-20220222-114609am.jpg', 22),
(73, 'uploads-35722-1645510569-20220222-114609am.jpg', 22),
(74, 'uploads-73378-1645510570-20220222-114610am.jpg', 22),
(75, 'uploads-19937-1645510570-20220222-114610am.jpg', 22),
(76, 'uploads-86144-1645510570-20220222-114610am.jpg', 22),
(77, 'uploads-65128-1645510571-20220222-114611am.jpg', 22),
(78, 'uploads-45925-1645510694-20220222-114814am.jpg', 23),
(79, 'uploads-52858-1645510694-20220222-114814am.jpg', 23),
(80, 'uploads-74355-1645510695-20220222-114815am.jpg', 23),
(81, 'uploads-74127-1645510709-20220222-114829am.jpg', 23),
(82, 'uploads-15913-1645510709-20220222-114829am.jpg', 23),
(83, 'uploads-19635-1645510709-20220222-114829am.jpg', 23),
(84, 'uploads-70383-1645510710-20220222-114830am.jpg', 23),
(85, 'uploads-67858-1645510849-20220222-115049am.jpg', 24),
(86, 'uploads-37635-1645510849-20220222-115049am.jpg', 24),
(104, 'uploads-12134-1646308334-20220303-052214pm.jpg', 33),
(105, 'uploads-30385-1646308334-20220303-052214pm.jpg', 33),
(106, 'uploads-71741-1646654426-20220307-053026pm.jpg', 2),
(107, 'uploads-41062-1646654427-20220307-053027pm.jpg', 2),
(108, 'uploads-98453-1646654427-20220307-053027pm.jpg', 2),
(109, 'uploads-28837-1646654427-20220307-053027pm.jpg', 2),
(110, 'uploads-37637-1646654427-20220307-053027pm.jpg', 2),
(111, 'uploads-67380-1646654428-20220307-053028pm.jpg', 2),
(112, 'uploads-16084-1646654428-20220307-053028pm.jpg', 2),
(113, 'uploads-38365-1646654428-20220307-053028pm.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `refundpage`
--

CREATE TABLE `refundpage` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `dateandtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refundpage`
--

INSERT INTO `refundpage` (`id`, `title`, `description`, `dateandtime`) VALUES
(2, 'Refund Policy', '<p>Refund Policy</p>\r\n', 1614596514);

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages`
--

CREATE TABLE `seo_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `seo_pages`
--

INSERT INTO `seo_pages` (`id`, `name`) VALUES
(1, 'home'),
(2, 'checkout'),
(3, 'contacts'),
(4, 'blog');

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages_translations`
--

CREATE TABLE `seo_pages_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `page_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `shop_attribute`
--

CREATE TABLE `shop_attribute` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_for` int(11) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `shop_attribute`
--

INSERT INTO `shop_attribute` (`id`, `sub_for`, `position`) VALUES
(2, 0, 3),
(3, 2, 0),
(4, 2, 0),
(5, 2, 0),
(6, 0, 2),
(7, 6, 0),
(8, 6, 0),
(9, 6, 0),
(10, 21, 0),
(11, 0, 1),
(12, 11, 0),
(13, 11, 0),
(14, 11, 0),
(15, 0, 0),
(16, 15, 0),
(17, 15, 0),
(18, 0, 0),
(19, 18, 0),
(20, 18, 0),
(21, 0, 0),
(22, 21, 0),
(23, 21, 0),
(49, 46, 0),
(45, 21, 0),
(46, 0, 0),
(47, 46, 0),
(50, 2, 0),
(51, 2, 0),
(52, 21, 2),
(53, 2, 3),
(54, 46, 4),
(55, 2, 5),
(56, 21, 6),
(57, 11, 3),
(58, 21, 7),
(59, 2, 7),
(60, 2, 8),
(61, 2, 0),
(62, 2, 0),
(63, 21, 0),
(64, 21, 0),
(65, 11, 0),
(66, 2, 0),
(67, 2, 0),
(68, 2, 0),
(69, 2, 0),
(70, 2, 0),
(71, 2, 0),
(72, 2, 0),
(73, 2, 0),
(74, 2, 0),
(75, 2, 0),
(76, 2, 0),
(77, 2, 0),
(78, 2, 0),
(79, 2, 0),
(80, 2, 0),
(81, 11, 0),
(82, 21, 0),
(83, 11, 0),
(84, 2, 0),
(85, 11, 0),
(86, 2, 0),
(87, 2, 0),
(88, 0, 0),
(89, 88, 0),
(90, 2, 0),
(91, 88, 0),
(92, 21, 0),
(93, 88, 0),
(94, 2, 0),
(95, 88, 0),
(96, 88, 0),
(97, 21, 0),
(98, 88, 0),
(99, 2, 0),
(100, 88, 0),
(101, 88, 0),
(102, 88, 0),
(103, 2, 0),
(104, 11, 0),
(105, 88, 0),
(106, 21, 0),
(107, 21, 0),
(108, 88, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_attribute_translations`
--

CREATE TABLE `shop_attribute_translations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `shop_attribute_translations`
--

INSERT INTO `shop_attribute_translations` (`id`, `name`, `abbr`, `for_id`) VALUES
(2, 'FABRICS', 'en', 2),
(3, 'Art Silk ', 'en', 3),
(4, 'Besil Silk ', 'en', 4),
(5, 'Chiffon', 'en', 5),
(6, 'OCCASION', 'en', 6),
(7, 'Casual', 'en', 7),
(8, 'Casual Wear', 'en', 8),
(9, 'Ceremonial', 'en', 9),
(10, 'Ceremony', 'en', 10),
(11, 'WORK', 'en', 11),
(12, 'Butti', 'en', 12),
(13, 'Diamond Work ', 'en', 13),
(14, 'Embroidered', 'en', 14),
(15, 'TYPE', 'en', 15),
(16, 'Semi Stitched', 'en', 16),
(17, 'Un Stitched', 'en', 17),
(18, 'MOQ', 'en', 18),
(19, '1 Piece', 'en', 19),
(20, 'Full Catalog', 'en', 20),
(21, 'BLOUSE', 'en', 21),
(22, 'Art Silk', 'en', 22),
(23, 'Banarasi Silk', 'en', 23),
(45, 'EMB .BLOUSE', 'en', 45),
(46, 'CATAGORY', 'en', 46),
(47, 'WEAVING', 'en', 47),
(49, 'KURTI', 'en', 49),
(50, 'COTTON', 'en', 50),
(51, 'Magic Brasso ', 'en', 51),
(52, 'HEAVY BLOUSE', 'en', 52),
(53, 'GEORGETTE WITH FANCY BORDER', 'en', 53),
(54, 'SAREES', 'en', 54),
(55, 'GEORGETTE', 'en', 55),
(56, 'FANCY BLOUSE', 'en', 56),
(57, 'CRYSTAL IVORY MILL PRINYT', 'en', 57),
(58, 'Digital Blouse', 'en', 58),
(59, 'vichitra silk', 'en', 59),
(60, 'C*C', 'en', 60),
(61, 'BRASSO', 'en', 61),
(62, 'Black Twill Dangal Chiffon', 'en', 62),
(63, 'JAQUARD BLOUSE', 'en', 63),
(64, 'HEAVY SOFT SILK BLOUSE', 'en', 64),
(65, 'POGO WORK', 'en', 65),
(66, 'VICHITRA PATTERN ', 'en', 66),
(67, 'PC TWILL PATTERN', 'en', 67),
(68, 'PURE WEIGHTLESS', 'en', 68),
(69, 'PURE GEORGETTE', 'en', 69),
(70, 'C*C KETONIC PATTERN', 'en', 70),
(71, 'CRAZY GEORGETTE', 'en', 71),
(72, 'SAUDI GEOGETTE', 'en', 72),
(73, 'BUMBER GEORGEETE', 'en', 73),
(74, 'FOX GEORGETTE', 'en', 74),
(75, 'MAJOR GEORGETTE', 'en', 75),
(76, 'MULTI FANCY FABRICS', 'en', 76),
(77, 'SATRANGI CHIFFON', 'en', 77),
(78, 'C*C VISCOSE PATTERN', 'en', 78),
(79, 'BRASSO PATTERN', 'en', 79),
(80, 'PATTERN CHIFFON', 'en', 80),
(81, 'VALUE ADDITION', 'en', 81),
(82, 'ANTIQUE BLOUSE', 'en', 82),
(83, 'SIROSKI WORK', 'en', 83),
(84, 'FANCY PREMIUM FABRICS', 'en', 84),
(85, 'IVORY WORK', 'en', 85),
(86, 'FANCY FABRICS GEOGETTE BASE', 'en', 86),
(87, 'HEAVY WEIGHTLESS', 'en', 87),
(88, 'LACE', 'en', 88),
(89, 'CREATIVE EXCLUSIVE LACES', 'en', 89),
(90, 'WEAVING JEQUARD BORDER', 'en', 90),
(91, 'ANTIQUE LACES', 'en', 91),
(92, 'IMPORTED BLOUSE', 'en', 92),
(93, 'DESIGNER LACES', 'en', 93),
(94, 'BRIGHT MILANO SILK', 'en', 94),
(95, 'PEARL DIGITAL LACE', 'en', 95),
(96, 'JAQUARD RICH LACE', 'en', 96),
(97, 'HEAVY JAQUARD BLOUSE', 'en', 97),
(98, 'DIGITAL LACE', 'en', 98),
(99, 'PATTERN BRASSO', 'en', 99),
(100, 'ANTIQUE WORK LACE', 'en', 100),
(101, 'FANCY EXCLUSIVE LACE', 'en', 101),
(102, 'FANCY LACE', 'en', 102),
(103, 'MILKY CHIFFON', 'en', 103),
(104, 'PEARL PROCESS', 'en', 104),
(105, 'BANARASI BORDER', 'en', 105),
(106, 'HEAVY BLOUSE', 'en', 106),
(107, 'FANCY BLOUSE', 'en', 107),
(108, 'HEAVY DESIGNER BORDER', 'en', 108);

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_for` int(11) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `catimg` text NOT NULL,
  `websiteimg` text NOT NULL,
  `visibility` tinyint(4) NOT NULL,
  `dateandtime` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`id`, `sub_for`, `position`, `catimg`, `websiteimg`, `visibility`, `dateandtime`) VALUES
(1, 1, 1, '1631024286_cat_image.jpeg', '1604473938_2001.jpg', 1, '1631025790'),
(2, 2, 2, '1603429459_1_1507x_progressive.jpg', '1603429459_1_1507x_progressive1.jpg', 1, '1603429459'),
(3, 3, 0, '1603433973_skdba1208a-dusty-pink-net-designer-thread-embroidered-flared-anarkali-gown.jpg', '1603433974_skdba1208a-dusty-pink-net-designer-thread-embroidered-flared-anarkali-gown.jpg', 0, '1603433974'),
(4, 4, 0, '1603434239_CV-9453-MZEEL20835452930-1599927246-Craftsvilla_1.jpg', '1603434239_CV-9453-MZEEL20835452930-1599927246-Craftsvilla_11.jpg', 0, '1603434239'),
(5, 5, 0, '1603434375_httpswww_bharatsthali_compubmediaimportbagss1003_7.jpg', '1603434375_httpswww_bharatsthali_compubmediaimportbagss1003_71.jpg', 1, '1603434375'),
(6, 6, 0, '1604572621_Capture1.PNG', '1604572621_Capture11.PNG', 1, '1604572621'),
(9, 0, 2, '', '', 1, '1645634437');

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories_translations`
--

CREATE TABLE `shop_categories_translations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `shop_categories_translations`
--

INSERT INTO `shop_categories_translations` (`id`, `name`, `abbr`, `for_id`) VALUES
(1, 'CATALOGUES', 'en', 1),
(2, 'Kurti', 'en', 2),
(3, 'Salwar Suits', 'en', 3),
(4, 'Lehenga Choli', 'en', 4),
(5, 'Cotton Saree', 'en', 5),
(6, 'Printed Saree', 'en', 6),
(8, 'test', 'en', 8),
(9, 'central bank of india', 'en', 9),
(10, 'vasims', 'en', 10);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `refProduct_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `timeanddate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `refProduct_id`, `qty`, `timeanddate`) VALUES
(1, 40, 500, '1646804274');

-- --------------------------------------------------------

--
-- Table structure for table `subscribed`
--

CREATE TABLE `subscribed` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `termpage`
--

CREATE TABLE `termpage` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `dateandtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `termpage`
--

INSERT INTO `termpage` (`id`, `title`, `description`, `dateandtime`) VALUES
(3, 'Terms & Condition', '<p><b>Terms &amp; Condition</b></p>\r\n', 1614596746);

-- --------------------------------------------------------

--
-- Table structure for table `textual_pages_tanslations`
--

CREATE TABLE `textual_pages_tanslations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `useraddress`
--

CREATE TABLE `useraddress` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `addresstype` varchar(256) NOT NULL,
  `companyname` varchar(556) NOT NULL,
  `address` text NOT NULL,
  `gstnumber` varchar(56) NOT NULL,
  `dateandtime` int(11) NOT NULL,
  `with_gst` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraddress`
--

INSERT INTO `useraddress` (`id`, `userid`, `addresstype`, `companyname`, `address`, `gstnumber`, `dateandtime`, `with_gst`) VALUES
(1, 8, 'Shipping', 'CDXX', '121, surat', '789897', 1613629933, 0),
(2, 8, 'Billing', 'premware', 'vesu, surat', '24AAXFP1567A1Z6', 1613629933, 0),
(3, 12, 'Shipping', 'previous', 'surat', '24AAXFP1567A1Z6', 1613631101, 0),
(4, 12, 'Billing', 'previous', 'surat', '24AAXFP1567A1Z6', 1613631101, 0),
(5, 3, 'Shipping', 'Jay sankatmochan sarees', '1041 nstm', '24AHAPA7348C1ZY', 1613656498, 0),
(6, 3, 'Billing', 'Jay sankatmochan sarees', '1041 nstm', '24AHAPA7348C1ZY', 1613656498, 0),
(7, 3, 'Shipping', 'Jay sankatmochan sarees', '1041 nstm', '24AHAPA7348C1ZY', 1613656498, 0),
(8, 3, 'Billing', 'Jay sankatmochan sarees', '1041 nstm', '24AHAPA7348C1ZY', 1613656498, 0),
(9, 13, 'Shipping', 'pranjal', 'althan', '24DCRPP5294P1ZH', 1613656984, 0),
(10, 13, 'Billing', 'pranjal', 'althan', '24DCRPP5294P1ZH', 1613656984, 0),
(11, 14, 'Shipping', 'Test', 'bsbsbs', '24AMLPX4863D1Z6', 1613990681, 0),
(12, 14, 'Billing', 'Test', 'bsbsbs', '24AMLPX4863D1Z6', 1613990681, 0),
(13, 16, 'Shipping', 'premware', 'Testing', '24ASDFG1234F2ZK', 1613991530, 0),
(14, 16, 'Billing', 'premware', 'Testing', '24ASDFG1234F2ZK', 1613991530, 0),
(16, 2, 'Billing', 'raj trade', 'mtm', '24AAUFM9464G1Z0', 1614102187, 0),
(17, 15, 'Shipping', 'demo', 'ghf', '12AAAAA0000A1Z5', 1614144018, 0),
(18, 15, 'Billing', 'demo', 'ghf', '12AAAAA0000A1Z5', 1614144018, 0),
(19, 30, 'Shipping', 'Premware Services', 'Test Test', '24AMLPC4862D1Z6', 1614783592, 0),
(20, 30, 'Billing', 'Premware Services', 'Test Test', '24AMLPC4862D1Z6', 1614783592, 0),
(21, 32, 'Shipping', 'premware', 'vesu', '24RGTUH2486A2ZC', 1614936544, 0),
(22, 32, 'Billing', 'premware', 'vesu', '24RGTUH2486A2ZC', 1614936544, 0),
(23, 36, 'Shipping', 'test', 'test', '12AAAAA0000A1Z5', 1618309742, 0),
(24, 36, 'Billing', 'test', 'test', '12AAAAA0000A1Z5', 1618309742, 0),
(25, 53, 'Shipping', 'Premware', 'From Admin Side Added', '232sdhy272jsjfs4', 1619592969, 0),
(26, 53, 'Shipping', 'premware', 'from application', '07AAECR2971C1Z5', 1619593355, 0),
(27, 53, 'Billing', 'premware', 'from application', '07AAECR2971C1Z5', 1619593355, 0),
(28, 53, 'Shipping', 'premware test', 'test gstvalid', '07AAECR2971C1Z5', 1619593451, 0),
(29, 66, 'Billing', 'Premware', 'From Admin Side Added', '232sdhy272jsjfs4', 1622005620, 0),
(30, 66, 'Shipping', 'Premware', 'From Admin Side Added', '232sdhy272jsjfs4', 1622005620, 0),
(31, 83, 'Billing', 'Premware', '23jngf sdp gdfg nkj', 'kjhdr4nhfdg', 1624943854, 0),
(32, 83, 'Shipping', 'Premware', '23jngf sdp gdfg nkj', 'kjhdr4nhfdg', 1624943854, 0),
(33, 114, 'Shipping', 'swasthik garments', 'challakere', '29EALPK9628F1Z4', 1632920610, 0),
(34, 114, 'Billing', 'swasthik garments', 'challakere', '29EALPK9628F1Z4', 1632920610, 0),
(35, 126, 'Shipping', 'R H HARKUT CLOTH MERCHANT', '3-3-31 Main Road, Sedam, Karnataka-585222', '29AFYPK3050M1ZQ', 1636812698, 0),
(36, 126, 'Billing', 'R H HARKUT CLOTH MERCHANT', '3-3-31 Main Road, Sedam, Karnataka-585222', '29AFYPK3050M1ZQ', 1636812698, 0),
(37, 128, 'Billing', 'abc', 'bajar visatar, kareli, surat, gangadhara Rs, gujarat, 394310', 'ss54544', 1643603810, 0),
(38, 128, 'Shipping', 'as', 'sas', 'ss54544', 1643603820, 0),
(39, 64, 'Billing', 'abc', 'ssass asa sasa', 'czgpp5283c', 1643662093, 0),
(43, 1, 'Shipping', 'cdx', '120, surat', '123456', 1645418128, 0),
(47, 1, 'Billing', 'CDX', 'ABCD', '123456', 1645499566, 0),
(49, 32, 'Billing', 'Diamond Expo', 'near Railway station', '2564DFG565EERC5DSF', 1646960656, 0),
(50, 32, 'Billing', 'Reshma sarees', 'near Bomaby market', '2496DFG685ASDFRC5DSF', 1646960723, 0),
(51, 32, 'Shipping', 'Atul sarees mmmmmmmmmmm', 'near Texttile market', '22AAAAA0000A1Z5', 1646960757, 0),
(53, 32, 'Shipping', 'Vastuui', 'Near Airport', '22AAAAA0000A1Z5', 1646987841, 0),
(54, 32, 'Shipping', 'Hekkkkk', 'hdhdjjd djvdjd dj djs dj dj', '22AABBA0000A1Z5', 1646987881, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userrecentview`
--

CREATE TABLE `userrecentview` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userrecentview`
--

INSERT INTO `userrecentview` (`id`, `userid`, `productid`, `dateandtime`) VALUES
(41, 10, 66, '2022-01-24 14:42:52'),
(44, 10, 59, '2022-01-24 14:42:52'),
(54, 10, 65, '2022-01-24 14:42:52'),
(55, 10, 60, '2022-01-24 14:42:52'),
(66, 16, 65, '2022-01-24 14:42:52'),
(67, 16, 64, '2022-01-24 14:42:52'),
(68, 16, 67, '2022-01-24 14:42:52'),
(69, 16, 66, '2022-01-24 14:42:52'),
(70, 15, 67, '2022-01-24 14:42:52'),
(71, 5, 67, '2022-01-24 14:42:52'),
(72, 5, 62, '2022-01-24 14:42:52'),
(115, 5, 66, '2022-01-24 14:42:52'),
(135, 74, 74, '2022-01-24 14:42:52'),
(170, 10, 74, '2022-01-24 14:42:52'),
(173, 5, 74, '2022-01-24 14:42:52'),
(175, 5, 73, '2022-01-24 14:42:52'),
(176, 5, 71, '2022-01-24 14:42:52'),
(179, 5, 64, '2022-01-24 14:42:52'),
(181, 10, 64, '2022-01-24 14:42:52'),
(182, 10, 72, '2022-01-24 14:42:52'),
(183, 10, 71, '2022-01-24 14:42:52'),
(212, 35, 63, '2022-01-24 14:42:52'),
(213, 35, 74, '2022-01-24 14:42:52'),
(229, 12, 65, '2022-01-24 14:42:52'),
(230, 12, 73, '2022-01-24 14:42:52'),
(241, 14, 63, '2022-01-24 14:42:52'),
(243, 14, 67, '2022-01-24 14:42:52'),
(245, 14, 72, '2022-01-24 14:42:52'),
(247, 7, 64, '2022-01-24 14:42:52'),
(248, 5, 60, '2022-01-24 14:42:52'),
(251, 7, 59, '2022-01-24 14:42:52'),
(252, 7, 71, '2022-01-24 14:42:52'),
(253, 7, 70, '2022-01-24 14:42:52'),
(259, 40, 59, '2022-01-24 14:42:52'),
(260, 40, 73, '2022-01-24 14:42:52'),
(262, 40, 74, '2022-01-24 14:42:52'),
(263, 40, 65, '2022-01-24 14:42:52'),
(264, 14, 70, '2022-01-24 14:42:52'),
(265, 40, 63, '2022-01-24 14:42:52'),
(270, 35, 76, '2022-01-24 14:42:52'),
(272, 7, 75, '2022-01-24 14:42:52'),
(273, 14, 79, '2022-01-24 14:42:52'),
(301, 8, 75, '2022-01-24 14:42:52'),
(302, 14, 75, '2022-01-24 14:42:52'),
(309, 7, 79, '2022-01-24 14:42:52'),
(310, 8, 79, '2022-01-24 14:42:52'),
(313, 47, 75, '2022-01-24 14:42:52'),
(316, 14, 82, '2022-01-24 14:42:52'),
(327, 54, 82, '2022-01-24 14:42:52'),
(337, 58, 79, '2022-01-24 14:42:52'),
(338, 58, 58, '2022-01-24 14:42:52'),
(339, 58, 72, '2022-01-24 14:42:52'),
(340, 8, 66, '2022-01-24 14:42:52'),
(342, 60, 79, '2022-01-24 14:42:52'),
(379, 8, 81, '2022-01-24 14:42:52'),
(380, 11, 75, '2022-01-24 14:42:52'),
(381, 11, 79, '2022-01-24 14:42:52'),
(412, 11, 74, '2022-01-24 14:42:52'),
(413, 11, 77, '2022-01-24 14:42:52'),
(414, 11, 59, '2022-01-24 14:42:52'),
(417, 7, 82, '2022-01-24 14:42:52'),
(426, 11, 82, '2022-01-24 14:42:52'),
(427, 7, 81, '2022-01-24 14:42:52'),
(428, 5, 75, '2022-01-24 14:42:52'),
(429, 42, 75, '2022-01-24 14:42:52'),
(430, 60, 75, '2022-01-24 14:42:52'),
(431, 5, 79, '2022-01-24 14:42:52'),
(434, 11, 76, '2022-01-24 14:42:52'),
(435, 11, 81, '2022-01-24 14:42:52'),
(436, 11, 80, '2022-01-24 14:42:52'),
(446, 42, 79, '2022-01-24 14:42:52'),
(447, 8, 77, '2022-01-24 14:42:52'),
(448, 8, 78, '2022-01-24 14:42:52'),
(450, 11, 63, '2022-01-24 14:42:52'),
(454, 7, 90, '2022-01-24 14:42:52'),
(459, 13, 85, '2022-01-24 14:42:52'),
(460, 13, 79, '2022-01-24 14:42:52'),
(468, 8, 90, '2022-01-24 14:42:52'),
(473, 8, 74, '2022-01-24 14:42:52'),
(474, 42, 63, '2022-01-24 14:42:52'),
(475, 42, 78, '2022-01-24 14:42:52'),
(477, 13, 70, '2022-01-24 14:42:52'),
(478, 8, 59, '2022-01-24 14:42:52'),
(481, 13, 74, '2022-01-24 14:42:52'),
(482, 13, 59, '2022-01-24 14:42:52'),
(483, 70, 74, '2022-01-24 14:42:52'),
(489, 72, 79, '2022-01-24 14:42:52'),
(490, 72, 75, '2022-01-24 14:42:52'),
(491, 72, 87, '2022-01-24 14:42:52'),
(492, 42, 87, '2022-01-24 14:42:52'),
(493, 13, 75, '2022-01-24 14:42:52'),
(494, 13, 76, '2022-01-24 14:42:52'),
(495, 13, 58, '2022-01-24 14:42:52'),
(496, 72, 74, '2022-01-24 14:42:52'),
(497, 72, 66, '2022-01-24 14:42:52'),
(498, 42, 90, '2022-01-24 14:42:52'),
(499, 42, 74, '2022-01-24 14:42:52'),
(500, 42, 76, '2022-01-24 14:42:52'),
(501, 7, 77, '2022-01-24 14:42:52'),
(509, 14, 66, '2022-01-24 14:42:52'),
(510, 13, 63, '2022-01-24 14:42:52'),
(525, 12, 79, '2022-01-24 14:42:52'),
(526, 12, 70, '2022-01-24 14:42:52'),
(527, 8, 76, '2022-01-24 14:42:52'),
(528, 1, 75, '2022-01-24 14:42:52'),
(529, 16, 79, '2022-01-24 14:42:52'),
(532, 17, 63, '2022-01-24 14:42:52'),
(537, 2, 76, '2022-01-24 14:42:52'),
(538, 2, 86, '2022-01-24 14:42:52'),
(539, 2, 87, '2022-01-24 14:42:52'),
(540, 16, 63, '2022-01-24 14:42:52'),
(542, 2, 91, '2022-01-24 14:42:52'),
(543, 2, 95, '2022-01-24 14:42:52'),
(544, 15, 95, '2022-01-24 14:42:52'),
(545, 15, 94, '2022-01-24 14:42:52'),
(546, 15, 93, '2022-01-24 14:42:52'),
(547, 15, 91, '2022-01-24 14:42:52'),
(548, 14, 76, '2022-01-24 14:42:52'),
(549, 14, 92, '2022-01-24 14:42:52'),
(561, 17, 87, '2022-01-24 14:42:52'),
(562, 23, 90, '2022-01-24 14:42:52'),
(563, 23, 59, '2022-01-24 14:42:52'),
(564, 23, 65, '2022-01-24 14:42:52'),
(565, 23, 74, '2022-01-24 14:42:52'),
(566, 1, 71, '2022-01-24 14:42:52'),
(567, 1, 90, '2022-01-24 14:42:52'),
(568, 1, 64, '2022-01-24 14:42:52'),
(569, 1, 87, '2022-01-24 14:42:52'),
(570, 1, 66, '2022-01-24 14:42:52'),
(571, 24, 88, '2022-01-24 14:42:52'),
(573, 26, 58, '2022-01-24 14:42:52'),
(574, 26, 62, '2022-01-24 14:42:52'),
(575, 26, 65, '2022-01-24 14:42:52'),
(576, 30, 79, '2022-01-24 14:42:52'),
(577, 30, 86, '2022-01-24 14:42:52'),
(578, 30, 87, '2022-01-24 14:42:52'),
(579, 30, 63, '2022-01-24 14:42:52'),
(580, 30, 59, '2022-01-24 14:42:52'),
(581, 30, 77, '2022-01-24 14:42:52'),
(582, 30, 80, '2022-01-24 14:42:52'),
(583, 30, 90, '2022-01-24 14:42:52'),
(584, 32, 95, '2022-01-24 14:42:52'),
(585, 2, 65, '2022-01-24 14:42:52'),
(589, 26, 71, '2022-01-24 14:42:52'),
(591, 26, 59, '2022-01-24 14:42:52'),
(593, 17, 70, '2022-01-24 14:42:52'),
(594, 17, 78, '2022-01-24 14:42:52'),
(595, 17, 89, '2022-01-24 14:42:52'),
(596, 2, 71, '2022-01-24 14:42:52'),
(597, 44, 63, '2022-01-24 14:42:52'),
(602, 44, 96, '2022-01-24 14:42:52'),
(603, 2, 101, '2022-01-24 14:42:52'),
(611, 17, 64, '2022-01-24 14:42:52'),
(612, 13, 77, '2022-01-24 14:42:52'),
(616, 54, 102, '2022-01-24 14:42:52'),
(644, 55, 75, '2022-01-24 14:42:52'),
(645, 55, 76, '2022-01-24 14:42:52'),
(646, 55, 78, '2022-01-24 14:42:52'),
(647, 55, 79, '2022-01-24 14:42:52'),
(648, 55, 90, '2022-01-24 14:42:52'),
(649, 55, 81, '2022-01-24 14:42:52'),
(650, 55, 84, '2022-01-24 14:42:52'),
(651, 55, 86, '2022-01-24 14:42:52'),
(652, 55, 63, '2022-01-24 14:42:52'),
(653, 55, 59, '2022-01-24 14:42:52'),
(668, 60, 112, '2022-01-24 14:42:52'),
(669, 60, 108, '2022-01-24 14:42:52'),
(671, 26, 114, '2022-01-24 14:42:52'),
(672, 26, 112, '2022-01-24 14:42:52'),
(673, 53, 77, '2022-01-24 14:42:52'),
(674, 53, 109, '2022-01-24 14:42:52'),
(675, 53, 114, '2022-01-24 14:42:52'),
(676, 53, 111, '2022-01-24 14:42:52'),
(677, 43, 63, '2022-01-24 14:42:52'),
(678, 43, 114, '2022-01-24 14:42:52'),
(679, 43, 98, '2022-01-24 14:42:52'),
(680, 53, 70, '2022-01-24 14:42:52'),
(682, 66, 114, '2022-01-24 14:42:52'),
(683, 32, 114, '2022-01-24 14:42:52'),
(692, 25, 101, '2022-01-24 14:42:52'),
(693, 25, 81, '2022-01-24 14:42:52'),
(694, 25, 79, '2022-01-24 14:42:52'),
(695, 25, 59, '2022-01-24 14:42:52'),
(762, 66, 112, '2022-01-24 14:42:52'),
(769, 36, 63, '2022-01-24 14:42:52'),
(774, 70, 58, '2022-01-24 14:42:52'),
(775, 70, 95, '2022-01-24 14:42:52'),
(782, 17, 114, '2022-01-24 14:42:52'),
(783, 17, 73, '2022-01-24 14:42:52'),
(786, 1, 114, '2022-01-24 14:42:52'),
(800, 70, 105, '2022-01-24 14:42:52'),
(813, 43, 118, '2022-01-24 14:42:52'),
(814, 43, 59, '2022-01-24 14:42:52'),
(815, 43, 77, '2022-01-24 14:42:52'),
(819, 36, 118, '2022-01-24 14:42:52'),
(852, 36, 117, '2022-01-24 14:42:52'),
(856, 83, 118, '2022-01-24 14:42:52'),
(882, 60, 63, '2022-01-24 14:42:52'),
(883, 60, 117, '2022-01-24 14:42:52'),
(884, 60, 116, '2022-01-24 14:42:52'),
(885, 60, 115, '2022-01-24 14:42:52'),
(886, 60, 118, '2022-01-24 14:42:52'),
(1199, 25, 124, '2022-01-24 14:42:52'),
(1200, 25, 120, '2022-01-24 14:42:52'),
(1201, 25, 110, '2022-01-24 14:42:52'),
(1202, 25, 105, '2022-01-24 14:42:52'),
(1203, 25, 104, '2022-01-24 14:42:52'),
(1204, 25, 89, '2022-01-24 14:42:52'),
(1301, 24, 125, '2022-01-24 14:42:52'),
(1310, 17, 130, '2022-01-24 14:42:52'),
(1328, 52, 135, '2022-01-24 14:42:52'),
(1329, 52, 134, '2022-01-24 14:42:52'),
(1330, 52, 133, '2022-01-24 14:42:52'),
(1331, 52, 129, '2022-01-24 14:42:52'),
(1332, 52, 128, '2022-01-24 14:42:52'),
(1333, 52, 127, '2022-01-24 14:42:52'),
(1334, 52, 125, '2022-01-24 14:42:52'),
(1335, 3, 135, '2022-01-24 14:42:52'),
(1356, 3, 119, '2022-01-24 14:42:52'),
(1370, 36, 137, '2022-01-24 14:42:52'),
(1371, 36, 135, '2022-01-24 14:42:52'),
(1403, 90, 128, '2022-01-24 14:42:52'),
(1404, 3, 86, '2022-01-24 14:42:52'),
(1422, 90, 137, '2022-01-24 14:42:52'),
(1423, 90, 134, '2022-01-24 14:42:52'),
(1424, 90, 127, '2022-01-24 14:42:52'),
(1425, 90, 112, '2022-01-24 14:42:52'),
(1429, 113, 128, '2022-01-24 14:42:52'),
(1430, 113, 81, '2022-01-24 14:42:52'),
(1431, 113, 80, '2022-01-24 14:42:52'),
(1432, 113, 70, '2022-01-24 14:42:52'),
(1433, 113, 105, '2022-01-24 14:42:52'),
(1434, 113, 124, '2022-01-24 14:42:52'),
(1435, 113, 134, '2022-01-24 14:42:52'),
(1436, 113, 107, '2022-01-24 14:42:52'),
(1437, 113, 106, '2022-01-24 14:42:52'),
(1475, 3, 129, '2022-01-24 14:42:52'),
(1483, 3, 111, '2022-01-24 14:42:52'),
(1484, 3, 70, '2022-01-24 14:42:52'),
(1495, 114, 135, '2022-01-24 14:42:52'),
(1496, 114, 130, '2022-01-24 14:42:52'),
(1497, 114, 129, '2022-01-24 14:42:52'),
(1498, 114, 128, '2022-01-24 14:42:52'),
(1499, 114, 127, '2022-01-24 14:42:52'),
(1500, 114, 122, '2022-01-24 14:42:52'),
(1501, 114, 112, '2022-01-24 14:42:52'),
(1502, 110, 107, '2022-01-24 14:42:52'),
(1507, 90, 130, '2022-01-24 14:42:52'),
(1509, 113, 114, '2022-01-24 14:42:52'),
(1512, 3, 137, '2022-01-24 14:42:52'),
(1513, 3, 120, '2022-01-24 14:42:52'),
(1514, 3, 109, '2022-01-24 14:42:52'),
(1521, 109, 130, '2022-01-24 14:42:52'),
(1568, 120, 101, '2022-01-24 14:42:52'),
(1569, 120, 84, '2022-01-24 14:42:52'),
(1585, 114, 136, '2022-01-24 14:42:52'),
(1586, 114, 137, '2022-01-24 14:42:52'),
(1593, 121, 75, '2022-01-24 14:42:52'),
(1594, 121, 59, '2022-01-24 14:42:52'),
(1597, 122, 77, '2022-01-24 14:42:52'),
(1598, 122, 82, '2022-01-24 14:42:52'),
(1599, 122, 84, '2022-01-24 14:42:52'),
(1600, 122, 85, '2022-01-24 14:42:52'),
(1601, 122, 86, '2022-01-24 14:42:52'),
(1618, 90, 124, '2022-01-24 14:42:52'),
(1619, 90, 78, '2022-01-24 14:42:52'),
(1620, 120, 125, '2022-01-24 14:42:52'),
(1628, 122, 129, '2022-01-24 14:42:52'),
(1629, 122, 130, '2022-01-24 14:42:52'),
(1686, 120, 141, '2022-01-24 14:42:52'),
(1689, 123, 126, '2022-01-24 14:42:52'),
(1690, 123, 125, '2022-01-24 14:42:52'),
(1691, 123, 119, '2022-01-24 14:42:52'),
(1692, 123, 116, '2022-01-24 14:42:52'),
(1693, 123, 104, '2022-01-24 14:42:52'),
(1699, 123, 130, '2022-01-24 14:42:52'),
(1700, 123, 102, '2022-01-24 14:42:52'),
(1701, 123, 86, '2022-01-24 14:42:52'),
(1704, 52, 142, '2022-01-24 14:42:52'),
(1705, 52, 140, '2022-01-24 14:42:52'),
(1706, 104, 143, '2022-01-24 14:42:52'),
(1707, 104, 142, '2022-01-24 14:42:52'),
(1717, 24, 144, '2022-01-24 14:42:52'),
(1725, 52, 146, '2022-01-24 14:42:52'),
(1732, 90, 146, '2022-01-24 14:42:52'),
(1733, 90, 145, '2022-01-24 14:42:52'),
(1749, 124, 137, '2022-01-24 14:42:52'),
(1750, 124, 144, '2022-01-24 14:42:52'),
(1751, 124, 125, '2022-01-24 14:42:52'),
(1752, 124, 143, '2022-01-24 14:42:52'),
(1753, 124, 141, '2022-01-24 14:42:52'),
(1754, 124, 140, '2022-01-24 14:42:52'),
(1755, 124, 139, '2022-01-24 14:42:52'),
(1756, 124, 128, '2022-01-24 14:42:52'),
(1758, 104, 133, '2022-01-24 14:42:52'),
(1759, 104, 146, '2022-01-24 14:42:52'),
(1760, 104, 139, '2022-01-24 14:42:52'),
(1761, 104, 128, '2022-01-24 14:42:52'),
(1773, 105, 144, '2022-01-24 14:42:52'),
(1774, 105, 110, '2022-01-24 14:42:52'),
(1775, 105, 146, '2022-01-24 14:42:52'),
(1810, 126, 143, '2022-01-24 14:42:52'),
(1811, 126, 141, '2022-01-24 14:42:52'),
(1812, 126, 108, '2022-01-24 14:42:52'),
(1813, 126, 106, '2022-01-24 14:42:52'),
(1820, 130, 86, '2022-01-24 14:42:52'),
(1821, 126, 135, '2022-01-24 14:42:52'),
(1822, 126, 144, '2022-01-24 14:42:52'),
(1823, 126, 125, '2022-01-24 14:42:52'),
(1824, 126, 86, '2022-01-24 14:42:52'),
(1825, 126, 81, '2022-01-24 14:42:52'),
(1832, 131, 144, '2022-01-24 14:42:52'),
(1833, 131, 134, '2022-01-24 14:42:52'),
(1834, 131, 117, '2022-01-24 14:42:52'),
(1835, 131, 77, '2022-01-24 14:42:52'),
(1839, 126, 140, '2022-01-24 14:42:52'),
(1846, 36, 146, '2022-01-24 14:42:52'),
(1847, 36, 145, '2022-01-24 14:42:52'),
(1848, 36, 144, '2022-01-24 14:42:52'),
(1849, 36, 142, '2022-01-24 14:42:52'),
(1850, 36, 143, '2022-01-24 14:42:52'),
(1872, 132, 145, '2022-01-24 14:42:52'),
(1875, 123, 146, '2022-01-24 14:42:52'),
(1876, 123, 144, '2022-01-24 14:42:52'),
(1929, 132, 109, '2022-01-24 14:42:52'),
(1933, 3, 130, '2022-01-24 14:42:52'),
(1939, 133, 143, '2022-01-24 14:42:52'),
(1940, 133, 133, '2022-01-24 14:42:52'),
(1941, 133, 147, '2022-01-24 14:42:52'),
(1950, 0, 94, '2022-01-24 14:42:52'),
(1951, 0, 76, '2022-01-24 14:42:52'),
(1952, 0, 67, '2022-01-24 14:42:52'),
(1953, 0, 97, '2022-01-24 14:42:52'),
(1954, 0, 92, '2022-01-24 14:42:52'),
(1955, 0, 79, '2022-01-24 14:42:52'),
(1956, 0, 135, '2022-01-24 14:42:52'),
(1957, 1, 81, '2022-02-17 04:29:13'),
(1958, 0, 81, '2022-02-17 04:29:20'),
(1959, 0, 147, '2022-02-17 06:32:02'),
(1960, 1, 147, '2022-02-17 06:33:42'),
(1961, 1, 91, '2022-02-19 10:55:50'),
(1963, 2, 2, '2022-03-07 12:26:19'),
(1964, 32, 2, '2022-03-08 07:17:36'),
(1965, 0, 2, '2022-03-08 07:17:43'),
(1966, 32, 33, '2022-03-08 07:31:54'),
(1967, 32, 34, '2022-03-08 11:17:06'),
(1968, 32, 35, '2022-03-08 11:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(256) NOT NULL,
  `mobilenumber` varchar(15) NOT NULL,
  `usertype` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `userrole` text NOT NULL,
  `adminstatus` int(11) NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'notifications by email',
  `adminrole` int(11) NOT NULL,
  `fcmtoken` mediumtext NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `mobilenumber`, `usertype`, `email`, `userrole`, `adminstatus`, `notify`, `adminrole`, `fcmtoken`, `last_login`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '', '8866609172', '', 'your@email.com', 'addproduct,editproduct,deleteproduct,addagent,editagent,deleteagent,addattributes,editattributes,deleteattributes,addattributesgroup,editattributesgroup,deleteattributesgroup,addcategories,editcategories,deletecategories,addpackagingtype,editpackagingtype,deletepackagingtype,addprelaunch,editprelaunch,deleteprelaunch,addcat,editcat,deletecat,addattribute,deleteattribute,vieworder,viewdirectorder,addcustomer,editcustomer,delcustomer,addabout,editabout,delabout,addterm,editterm,delterm,addrefund,editrefund,delrefund,addprivacy,editprivacy,delprivacy,addcoupan,editcoupan,delcoupan,addslider,editslider,deleteslider,editsettings', 1, 0, 1, 'dgg2Oz95TKy3VSeHzkGGyf:APA91bHil6bdZHGG2mHUQUfus3zFF9pt6ajqfyRQQkM13w2l3jRA52KABYyIjBmsJA347LazIQvKyUX73CR7TG9NohcG7X4RPanUmCiCqyVCjp8cGuvHm34iif159z52D81YIJgplQVJ', 1647407578),
(5, 'chetan', '57d8b29467574c80eb860a774862b83f', 'chetan', '9313807743', 'mobileuser', '', '', 0, 0, 0, 'c-SHVtBVSIa7r4sZFUVKSv:APA91bEulMnjFA7vJdZaTwGT9DpnITXRxC3KPWPnffaEycVFzOZ2WNowLcqOhKUWRXcIkMrKr8Fcw8EIyVFddhlShFOILIsaT-kg-dEyefHNUSwTNHPffIp6w5QxhPw7BW8b3yQ-5J4c', NULL),
(6, 'RAJ', 'fb88e77886930c5e4070f3eea3bd36dd', 'RAJ', '8401727252', 'mobileuser', '', '', 0, 0, 0, 'eoVM-wZAQEWdB686d0vSiI:APA91bE9O1V-WXWDwWGAmyNo_7OcICIJMiT0c096gea9heQsdxuNqW-7qvif6swN5q_kZtsUXHEgrC78Gq_HBdTHaKsAeQ3-vCXT-raqwuUjTTIYMvmyMTFE1P8llYNYNEwwBBag37SC', NULL),
(7, 'PRATEEK', 'da56b4b800bba9738a7b68907eaa2b7e', 'PRATEEK', '9879653445', 'mobileuser', '', '', 0, 0, 0, 'daQwzyyDS_alUc9rsrgh1B:APA91bE7PsMM447FHJT8uCFETMlF8CvsoTpWEig_6ZmJXWp-f43FhrWhWz41-kcwjGxWiq9zCc1r0AUEBqh33m3h8a34sp3qfcy8kE7BA-c_bx6JvOkWU8w5-nfimYnxF8hN2BhmVvFi', NULL),
(8, 'PRATEEK', 'da56b4b800bba9738a7b68907eaa2b7e', 'PRATEEK', '9328453445', 'mobileuser', '', '', 0, 0, 0, '', NULL),
(9, 'PRATEEK', 'da56b4b800bba9738a7b68907eaa2b7e', 'PRATEEK', '9377166633', 'mobileuser', '', '', 0, 0, 0, '', NULL),
(10, 'Nirmit', 'e10adc3949ba59abbe56e057f20f883e', 'Nirmit', '9375186540', 'mobileuser', '', '', 0, 0, 0, 'fq1WHmfDQaK1vtuoXM0h0m:APA91bFIwNfxJPqdT-PhpyHih_e3PhAiTR20MIBqK5nV9pr62YBxqEKnjoP9IlqR83wymZQcDoIyjAB9mkrqDH1rJ_m9Y5_QkBqkt3WrSgQBwTjyUK7pqUKrtZDZDjCYAPmMCP58MN_X', NULL),
(12, 'vijay soni', '5e4c0e217562040800dd85815920448a', 'vijay soni', '9978892252', 'mobileuser', '', '', 0, 0, 0, 'c-tTR94rTay4yL010tMYR5:APA91bG9q3QLNjjM4fleWeYTt_PMqMrXTZtK17xXFx8TvAnYv1qch8pr57zF9DIbDZ1NG_bjnIR0XDA0PxdA5Mo1jdi7_9LCnK3WUq6AI0OSFGJCknVc9Ko5oU3no9rS_dQ-50Bvcl3T', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_public`
--

CREATE TABLE `users_public` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `userviewproduct`
--

CREATE TABLE `userviewproduct` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userviewproduct`
--

INSERT INTO `userviewproduct` (`id`, `productid`, `userid`, `dateandtime`) VALUES
(1, 59, 1, '2022-01-24 14:42:52'),
(2, 79, 1, '2022-01-24 14:42:52'),
(3, 79, 2, '2022-01-24 14:42:52'),
(4, 79, 3, '2022-01-24 14:42:52'),
(5, 81, 3, '2022-01-24 14:42:52'),
(6, 75, 8, '2022-01-24 14:42:52'),
(7, 79, 12, '2022-01-24 14:42:52'),
(8, 70, 12, '2022-01-24 14:42:52'),
(9, 76, 8, '2022-01-24 14:42:52'),
(10, 79, 8, '2022-01-24 14:42:52'),
(11, 79, 2, '2022-01-24 14:42:52'),
(12, 75, 1, '2022-01-24 14:42:52'),
(13, 75, 13, '2022-01-24 14:42:52'),
(14, 79, 1, '2022-01-24 14:42:52'),
(15, 79, 16, '2022-01-24 14:42:52'),
(16, 79, 2, '2022-01-24 14:42:52'),
(17, 79, 2, '2022-01-24 14:42:52'),
(18, 59, 3, '2022-01-24 14:42:52'),
(19, 75, 2, '2022-01-24 14:42:52'),
(20, 63, 17, '2022-01-24 14:42:52'),
(21, 79, 3, '2022-01-24 14:42:52'),
(22, 63, 2, '2022-01-24 14:42:52'),
(23, 63, 2, '2022-01-24 14:42:52'),
(24, 77, 2, '2022-01-24 14:42:52'),
(25, 59, 2, '2022-01-24 14:42:52'),
(26, 59, 2, '2022-01-24 14:42:52'),
(27, 77, 2, '2022-01-24 14:42:52'),
(28, 76, 2, '2022-01-24 14:42:52'),
(29, 86, 2, '2022-01-24 14:42:52'),
(30, 87, 2, '2022-01-24 14:42:52'),
(31, 75, 14, '2022-01-24 14:42:52'),
(32, 79, 16, '2022-01-24 14:42:52'),
(33, 79, 16, '2022-01-24 14:42:52'),
(34, 66, 16, '2022-01-24 14:42:52'),
(35, 63, 16, '2022-01-24 14:42:52'),
(36, 86, 2, '2022-01-24 14:42:52'),
(37, 91, 2, '2022-01-24 14:42:52'),
(38, 95, 2, '2022-01-24 14:42:52'),
(39, 95, 2, '2022-01-24 14:42:52'),
(40, 95, 2, '2022-01-24 14:42:52'),
(41, 86, 2, '2022-01-24 14:42:52'),
(42, 95, 2, '2022-01-24 14:42:52'),
(43, 86, 2, '2022-01-24 14:42:52'),
(44, 0, 15, '2022-01-24 14:42:52'),
(45, 95, 15, '2022-01-24 14:42:52'),
(46, 94, 15, '2022-01-24 14:42:52'),
(47, 93, 15, '2022-01-24 14:42:52'),
(48, 91, 15, '2022-01-24 14:42:52'),
(49, 76, 14, '2022-01-24 14:42:52'),
(50, 79, 14, '2022-01-24 14:42:52'),
(51, 92, 14, '2022-01-24 14:42:52'),
(52, 92, 14, '2022-01-24 14:42:52'),
(53, 92, 14, '2022-01-24 14:42:52'),
(54, 92, 14, '2022-01-24 14:42:52'),
(55, 75, 2, '2022-01-24 14:42:52'),
(56, 86, 2, '2022-01-24 14:42:52'),
(57, 89, 3, '2022-01-24 14:42:52'),
(58, 90, 3, '2022-01-24 14:42:52'),
(59, 86, 3, '2022-01-24 14:42:52'),
(60, 75, 2, '2022-01-24 14:42:52'),
(61, 75, 2, '2022-01-24 14:42:52'),
(62, 79, 3, '2022-01-24 14:42:52'),
(63, 87, 17, '2022-01-24 14:42:52'),
(64, 90, 23, '2022-01-24 14:42:52'),
(65, 59, 23, '2022-01-24 14:42:52'),
(66, 65, 23, '2022-01-24 14:42:52'),
(67, 74, 23, '2022-01-24 14:42:52'),
(68, 71, 1, '2022-01-24 14:42:52'),
(69, 90, 1, '2022-01-24 14:42:52'),
(70, 64, 1, '2022-01-24 14:42:52'),
(71, 64, 1, '2022-01-24 14:42:52'),
(72, 87, 1, '2022-01-24 14:42:52'),
(73, 66, 1, '2022-01-24 14:42:52'),
(74, 66, 1, '2022-01-24 14:42:52'),
(75, 88, 24, '2022-01-24 14:42:52'),
(76, 67, 25, '2022-01-24 14:42:52'),
(77, 58, 26, '2022-01-24 14:42:52'),
(78, 62, 26, '2022-01-24 14:42:52'),
(79, 62, 26, '2022-01-24 14:42:52'),
(80, 65, 26, '2022-01-24 14:42:52'),
(81, 65, 26, '2022-01-24 14:42:52'),
(82, 79, 30, '2022-01-24 14:42:52'),
(83, 86, 30, '2022-01-24 14:42:52'),
(84, 87, 30, '2022-01-24 14:42:52'),
(85, 63, 30, '2022-01-24 14:42:52'),
(86, 87, 30, '2022-01-24 14:42:52'),
(87, 59, 30, '2022-01-24 14:42:52'),
(88, 77, 30, '2022-01-24 14:42:52'),
(89, 80, 30, '2022-01-24 14:42:52'),
(90, 77, 30, '2022-01-24 14:42:52'),
(91, 77, 30, '2022-01-24 14:42:52'),
(92, 59, 2, '2022-01-24 14:42:52'),
(93, 95, 2, '2022-01-24 14:42:52'),
(94, 95, 2, '2022-01-24 14:42:52'),
(95, 95, 2, '2022-01-24 14:42:52'),
(96, 90, 30, '2022-01-24 14:42:52'),
(97, 90, 30, '2022-01-24 14:42:52'),
(98, 90, 30, '2022-01-24 14:42:52'),
(99, 90, 30, '2022-01-24 14:42:52'),
(100, 90, 30, '2022-01-24 14:42:52'),
(101, 90, 30, '2022-01-24 14:42:52'),
(102, 90, 30, '2022-01-24 14:42:52'),
(103, 90, 30, '2022-01-24 14:42:52'),
(104, 90, 30, '2022-01-24 14:42:52'),
(105, 90, 30, '2022-01-24 14:42:52'),
(106, 90, 30, '2022-01-24 14:42:52'),
(107, 95, 32, '2022-01-24 14:42:52'),
(108, 95, 32, '2022-01-24 14:42:52'),
(109, 65, 2, '2022-01-24 14:42:52'),
(110, 73, 3, '2022-01-24 14:42:52'),
(111, 79, 3, '2022-01-24 14:42:52'),
(112, 63, 3, '2022-01-24 14:42:52'),
(113, 77, 3, '2022-01-24 14:42:52'),
(114, 59, 3, '2022-01-24 14:42:52'),
(115, 59, 3, '2022-01-24 14:42:52'),
(116, 63, 17, '2022-01-24 14:42:52'),
(117, 71, 26, '2022-01-24 14:42:52'),
(118, 67, 3, '2022-01-24 14:42:52'),
(119, 59, 26, '2022-01-24 14:42:52'),
(120, 90, 36, '2022-01-24 14:42:52'),
(121, 70, 17, '2022-01-24 14:42:52'),
(122, 78, 17, '2022-01-24 14:42:52'),
(123, 89, 17, '2022-01-24 14:42:52'),
(124, 75, 2, '2022-01-24 14:42:52'),
(125, 71, 2, '2022-01-24 14:42:52'),
(126, 63, 44, '2022-01-24 14:42:52'),
(127, 81, 36, '2022-01-24 14:42:52'),
(128, 78, 36, '2022-01-24 14:42:52'),
(129, 67, 36, '2022-01-24 14:42:52'),
(130, 67, 36, '2022-01-24 14:42:52'),
(131, 65, 36, '2022-01-24 14:42:52'),
(132, 96, 44, '2022-01-24 14:42:52'),
(133, 101, 2, '2022-01-24 14:42:52'),
(134, 58, 3, '2022-01-24 14:42:52'),
(135, 98, 3, '2022-01-24 14:42:52'),
(136, 100, 3, '2022-01-24 14:42:52'),
(137, 86, 2, '2022-01-24 14:42:52'),
(138, 101, 3, '2022-01-24 14:42:52'),
(139, 89, 3, '2022-01-24 14:42:52'),
(140, 89, 3, '2022-01-24 14:42:52'),
(141, 90, 3, '2022-01-24 14:42:52'),
(142, 90, 3, '2022-01-24 14:42:52'),
(143, 76, 3, '2022-01-24 14:42:52'),
(144, 89, 3, '2022-01-24 14:42:52'),
(145, 64, 17, '2022-01-24 14:42:52'),
(146, 77, 13, '2022-01-24 14:42:52'),
(147, 58, 36, '2022-01-24 14:42:52'),
(148, 62, 36, '2022-01-24 14:42:52'),
(149, 58, 36, '2022-01-24 14:42:52'),
(150, 102, 55, '2022-01-24 14:42:52'),
(151, 102, 55, '2022-01-24 14:42:52'),
(152, 102, 55, '2022-01-24 14:42:52'),
(153, 102, 54, '2022-01-24 14:42:52'),
(154, 102, 55, '2022-01-24 14:42:52'),
(155, 101, 55, '2022-01-24 14:42:52'),
(156, 101, 55, '2022-01-24 14:42:52'),
(157, 102, 55, '2022-01-24 14:42:52'),
(158, 102, 54, '2022-01-24 14:42:52'),
(159, 102, 55, '2022-01-24 14:42:52'),
(160, 58, 36, '2022-01-24 14:42:52'),
(161, 102, 55, '2022-01-24 14:42:52'),
(162, 58, 36, '2022-01-24 14:42:52'),
(163, 67, 36, '2022-01-24 14:42:52'),
(164, 66, 36, '2022-01-24 14:42:52'),
(165, 102, 36, '2022-01-24 14:42:52'),
(166, 101, 36, '2022-01-24 14:42:52'),
(167, 102, 36, '2022-01-24 14:42:52'),
(168, 101, 36, '2022-01-24 14:42:52'),
(169, 102, 36, '2022-01-24 14:42:52'),
(170, 77, 36, '2022-01-24 14:42:52'),
(171, 65, 55, '2022-01-24 14:42:52'),
(172, 102, 55, '2022-01-24 14:42:52'),
(173, 65, 55, '2022-01-24 14:42:52'),
(174, 64, 55, '2022-01-24 14:42:52'),
(175, 79, 55, '2022-01-24 14:42:52'),
(176, 65, 55, '2022-01-24 14:42:52'),
(177, 79, 55, '2022-01-24 14:42:52'),
(178, 67, 55, '2022-01-24 14:42:52'),
(179, 79, 55, '2022-01-24 14:42:52'),
(180, 58, 55, '2022-01-24 14:42:52'),
(181, 65, 55, '2022-01-24 14:42:52'),
(182, 66, 55, '2022-01-24 14:42:52'),
(183, 66, 55, '2022-01-24 14:42:52'),
(184, 79, 55, '2022-01-24 14:42:52'),
(185, 60, 55, '2022-01-24 14:42:52'),
(186, 76, 55, '2022-01-24 14:42:52'),
(187, 75, 55, '2022-01-24 14:42:52'),
(188, 78, 55, '2022-01-24 14:42:52'),
(189, 90, 55, '2022-01-24 14:42:52'),
(190, 75, 55, '2022-01-24 14:42:52'),
(191, 82, 55, '2022-01-24 14:42:52'),
(192, 82, 55, '2022-01-24 14:42:52'),
(193, 75, 55, '2022-01-24 14:42:52'),
(194, 82, 55, '2022-01-24 14:42:52'),
(195, 102, 55, '2022-01-24 14:42:52'),
(196, 102, 55, '2022-01-24 14:42:52'),
(197, 58, 55, '2022-01-24 14:42:52'),
(198, 60, 55, '2022-01-24 14:42:52'),
(199, 62, 55, '2022-01-24 14:42:52'),
(200, 63, 55, '2022-01-24 14:42:52'),
(201, 101, 55, '2022-01-24 14:42:52'),
(202, 71, 55, '2022-01-24 14:42:52'),
(203, 65, 55, '2022-01-24 14:42:52'),
(204, 70, 55, '2022-01-24 14:42:52'),
(205, 88, 55, '2022-01-24 14:42:52'),
(206, 66, 55, '2022-01-24 14:42:52'),
(207, 85, 55, '2022-01-24 14:42:52'),
(208, 82, 55, '2022-01-24 14:42:52'),
(209, 75, 55, '2022-01-24 14:42:52'),
(210, 76, 55, '2022-01-24 14:42:52'),
(211, 78, 55, '2022-01-24 14:42:52'),
(212, 78, 55, '2022-01-24 14:42:52'),
(213, 79, 55, '2022-01-24 14:42:52'),
(214, 90, 55, '2022-01-24 14:42:52'),
(215, 90, 55, '2022-01-24 14:42:52'),
(216, 82, 55, '2022-01-24 14:42:52'),
(217, 81, 55, '2022-01-24 14:42:52'),
(218, 84, 55, '2022-01-24 14:42:52'),
(219, 85, 55, '2022-01-24 14:42:52'),
(220, 86, 55, '2022-01-24 14:42:52'),
(221, 86, 55, '2022-01-24 14:42:52'),
(222, 75, 55, '2022-01-24 14:42:52'),
(223, 76, 55, '2022-01-24 14:42:52'),
(224, 78, 55, '2022-01-24 14:42:52'),
(225, 79, 55, '2022-01-24 14:42:52'),
(226, 90, 55, '2022-01-24 14:42:52'),
(227, 63, 55, '2022-01-24 14:42:52'),
(228, 59, 55, '2022-01-24 14:42:52'),
(229, 63, 36, '2022-01-24 14:42:52'),
(230, 67, 36, '2022-01-24 14:42:52'),
(231, 58, 36, '2022-01-24 14:42:52'),
(232, 58, 36, '2022-01-24 14:42:52'),
(233, 58, 36, '2022-01-24 14:42:52'),
(234, 58, 36, '2022-01-24 14:42:52'),
(235, 77, 36, '2022-01-24 14:42:52'),
(236, 58, 36, '2022-01-24 14:42:52'),
(237, 67, 36, '2022-01-24 14:42:52'),
(238, 66, 36, '2022-01-24 14:42:52'),
(239, 65, 36, '2022-01-24 14:42:52'),
(240, 65, 36, '2022-01-24 14:42:52'),
(241, 64, 36, '2022-01-24 14:42:52'),
(242, 102, 36, '2022-01-24 14:42:52'),
(243, 79, 36, '2022-01-24 14:42:52'),
(244, 58, 36, '2022-01-24 14:42:52'),
(245, 0, 3, '2022-01-24 14:42:52'),
(246, 80, 3, '2022-01-24 14:42:52'),
(247, 98, 52, '2022-01-24 14:42:52'),
(248, 111, 52, '2022-01-24 14:42:52'),
(249, 110, 52, '2022-01-24 14:42:52'),
(250, 105, 52, '2022-01-24 14:42:52'),
(251, 58, 36, '2022-01-24 14:42:52'),
(252, 58, 36, '2022-01-24 14:42:52'),
(253, 102, 3, '2022-01-24 14:42:52'),
(254, 104, 36, '2022-01-24 14:42:52'),
(255, 104, 36, '2022-01-24 14:42:52'),
(256, 101, 36, '2022-01-24 14:42:52'),
(257, 111, 36, '2022-01-24 14:42:52'),
(258, 111, 52, '2022-01-24 14:42:52'),
(259, 111, 52, '2022-01-24 14:42:52'),
(260, 111, 52, '2022-01-24 14:42:52'),
(261, 111, 52, '2022-01-24 14:42:52'),
(262, 111, 36, '2022-01-24 14:42:52'),
(263, 111, 36, '2022-01-24 14:42:52'),
(264, 111, 36, '2022-01-24 14:42:52'),
(265, 111, 36, '2022-01-24 14:42:52'),
(266, 111, 36, '2022-01-24 14:42:52'),
(267, 111, 36, '2022-01-24 14:42:52'),
(268, 111, 36, '2022-01-24 14:42:52'),
(269, 111, 36, '2022-01-24 14:42:52'),
(270, 102, 52, '2022-01-24 14:42:52'),
(271, 111, 36, '2022-01-24 14:42:52'),
(272, 110, 36, '2022-01-24 14:42:52'),
(273, 111, 36, '2022-01-24 14:42:52'),
(274, 111, 36, '2022-01-24 14:42:52'),
(275, 111, 36, '2022-01-24 14:42:52'),
(276, 111, 52, '2022-01-24 14:42:52'),
(277, 111, 36, '2022-01-24 14:42:52'),
(278, 111, 36, '2022-01-24 14:42:52'),
(279, 111, 36, '2022-01-24 14:42:52'),
(280, 110, 36, '2022-01-24 14:42:52'),
(281, 110, 36, '2022-01-24 14:42:52'),
(282, 110, 36, '2022-01-24 14:42:52'),
(283, 111, 36, '2022-01-24 14:42:52'),
(284, 110, 36, '2022-01-24 14:42:52'),
(285, 110, 36, '2022-01-24 14:42:52'),
(286, 111, 36, '2022-01-24 14:42:52'),
(287, 111, 36, '2022-01-24 14:42:52'),
(288, 111, 36, '2022-01-24 14:42:52'),
(289, 111, 36, '2022-01-24 14:42:52'),
(290, 111, 36, '2022-01-24 14:42:52'),
(291, 111, 36, '2022-01-24 14:42:52'),
(292, 111, 36, '2022-01-24 14:42:52'),
(293, 111, 36, '2022-01-24 14:42:52'),
(294, 111, 36, '2022-01-24 14:42:52'),
(295, 111, 36, '2022-01-24 14:42:52'),
(296, 111, 36, '2022-01-24 14:42:52'),
(297, 111, 36, '2022-01-24 14:42:52'),
(298, 111, 36, '2022-01-24 14:42:52'),
(299, 111, 36, '2022-01-24 14:42:52'),
(300, 111, 36, '2022-01-24 14:42:52'),
(301, 111, 36, '2022-01-24 14:42:52'),
(302, 111, 36, '2022-01-24 14:42:52'),
(303, 111, 36, '2022-01-24 14:42:52'),
(304, 111, 36, '2022-01-24 14:42:52'),
(305, 111, 36, '2022-01-24 14:42:52'),
(306, 111, 36, '2022-01-24 14:42:52'),
(307, 111, 36, '2022-01-24 14:42:52'),
(308, 111, 36, '2022-01-24 14:42:52'),
(309, 111, 36, '2022-01-24 14:42:52'),
(310, 111, 36, '2022-01-24 14:42:52'),
(311, 111, 36, '2022-01-24 14:42:52'),
(312, 111, 36, '2022-01-24 14:42:52'),
(313, 111, 36, '2022-01-24 14:42:52'),
(314, 111, 36, '2022-01-24 14:42:52'),
(315, 111, 36, '2022-01-24 14:42:52'),
(316, 111, 36, '2022-01-24 14:42:52'),
(317, 111, 36, '2022-01-24 14:42:52'),
(318, 111, 36, '2022-01-24 14:42:52'),
(319, 111, 36, '2022-01-24 14:42:52'),
(320, 111, 36, '2022-01-24 14:42:52'),
(321, 111, 36, '2022-01-24 14:42:52'),
(322, 111, 36, '2022-01-24 14:42:52'),
(323, 111, 36, '2022-01-24 14:42:52'),
(324, 111, 36, '2022-01-24 14:42:52'),
(325, 111, 36, '2022-01-24 14:42:52'),
(326, 111, 36, '2022-01-24 14:42:52'),
(327, 111, 36, '2022-01-24 14:42:52'),
(328, 111, 36, '2022-01-24 14:42:52'),
(329, 111, 36, '2022-01-24 14:42:52'),
(330, 111, 36, '2022-01-24 14:42:52'),
(331, 111, 36, '2022-01-24 14:42:52'),
(332, 111, 36, '2022-01-24 14:42:52'),
(333, 111, 36, '2022-01-24 14:42:52'),
(334, 111, 36, '2022-01-24 14:42:52'),
(335, 111, 36, '2022-01-24 14:42:52'),
(336, 111, 36, '2022-01-24 14:42:52'),
(337, 111, 36, '2022-01-24 14:42:52'),
(338, 111, 36, '2022-01-24 14:42:52'),
(339, 0, 52, '2022-01-24 14:42:52'),
(340, 0, 52, '2022-01-24 14:42:52'),
(341, 0, 52, '2022-01-24 14:42:52'),
(342, 114, 52, '2022-01-24 14:42:52'),
(343, 111, 36, '2022-01-24 14:42:52'),
(344, 112, 60, '2022-01-24 14:42:52'),
(345, 108, 60, '2022-01-24 14:42:52'),
(346, 114, 36, '2022-01-24 14:42:52'),
(347, 114, 36, '2022-01-24 14:42:52'),
(348, 114, 36, '2022-01-24 14:42:52'),
(349, 114, 36, '2022-01-24 14:42:52'),
(350, 114, 36, '2022-01-24 14:42:52'),
(351, 114, 26, '2022-01-24 14:42:52'),
(352, 112, 26, '2022-01-24 14:42:52'),
(353, 77, 53, '2022-01-24 14:42:52'),
(354, 109, 53, '2022-01-24 14:42:52'),
(355, 109, 53, '2022-01-24 14:42:52'),
(356, 109, 53, '2022-01-24 14:42:52'),
(357, 114, 53, '2022-01-24 14:42:52'),
(358, 114, 36, '2022-01-24 14:42:52'),
(359, 114, 36, '2022-01-24 14:42:52'),
(360, 114, 36, '2022-01-24 14:42:52'),
(361, 114, 36, '2022-01-24 14:42:52'),
(362, 114, 36, '2022-01-24 14:42:52'),
(363, 111, 53, '2022-01-24 14:42:52'),
(364, 111, 53, '2022-01-24 14:42:52'),
(365, 111, 53, '2022-01-24 14:42:52'),
(366, 104, 36, '2022-01-24 14:42:52'),
(367, 114, 36, '2022-01-24 14:42:52'),
(368, 111, 36, '2022-01-24 14:42:52'),
(369, 111, 36, '2022-01-24 14:42:52'),
(370, 111, 36, '2022-01-24 14:42:52'),
(371, 111, 36, '2022-01-24 14:42:52'),
(372, 111, 36, '2022-01-24 14:42:52'),
(373, 63, 43, '2022-01-24 14:42:52'),
(374, 114, 43, '2022-01-24 14:42:52'),
(375, 98, 43, '2022-01-24 14:42:52'),
(376, 70, 53, '2022-01-24 14:42:52'),
(377, 70, 53, '2022-01-24 14:42:52'),
(378, 70, 36, '2022-01-24 14:42:52'),
(379, 70, 36, '2022-01-24 14:42:52'),
(380, 70, 36, '2022-01-24 14:42:52'),
(381, 114, 53, '2022-01-24 14:42:52'),
(382, 114, 66, '2022-01-24 14:42:52'),
(383, 114, 36, '2022-01-24 14:42:52'),
(384, 114, 32, '2022-01-24 14:42:52'),
(385, 114, 32, '2022-01-24 14:42:52'),
(386, 112, 36, '2022-01-24 14:42:52'),
(387, 114, 36, '2022-01-24 14:42:52'),
(388, 114, 36, '2022-01-24 14:42:52'),
(389, 77, 36, '2022-01-24 14:42:52'),
(390, 88, 25, '2022-01-24 14:42:52'),
(391, 89, 25, '2022-01-24 14:42:52'),
(392, 98, 25, '2022-01-24 14:42:52'),
(393, 99, 25, '2022-01-24 14:42:52'),
(394, 100, 25, '2022-01-24 14:42:52'),
(395, 108, 25, '2022-01-24 14:42:52'),
(396, 114, 25, '2022-01-24 14:42:52'),
(397, 101, 25, '2022-01-24 14:42:52'),
(398, 101, 25, '2022-01-24 14:42:52'),
(399, 99, 25, '2022-01-24 14:42:52'),
(400, 81, 25, '2022-01-24 14:42:52'),
(401, 81, 25, '2022-01-24 14:42:52'),
(402, 79, 25, '2022-01-24 14:42:52'),
(403, 98, 25, '2022-01-24 14:42:52'),
(404, 59, 25, '2022-01-24 14:42:52'),
(405, 114, 66, '2022-01-24 14:42:52'),
(406, 114, 66, '2022-01-24 14:42:52'),
(407, 114, 66, '2022-01-24 14:42:52'),
(408, 114, 66, '2022-01-24 14:42:52'),
(409, 114, 52, '2022-01-24 14:42:52'),
(410, 114, 52, '2022-01-24 14:42:52'),
(411, 114, 36, '2022-01-24 14:42:52'),
(412, 114, 36, '2022-01-24 14:42:52'),
(413, 112, 36, '2022-01-24 14:42:52'),
(414, 114, 36, '2022-01-24 14:42:52'),
(415, 114, 36, '2022-01-24 14:42:52'),
(416, 114, 36, '2022-01-24 14:42:52'),
(417, 111, 36, '2022-01-24 14:42:52'),
(418, 114, 36, '2022-01-24 14:42:52'),
(419, 114, 36, '2022-01-24 14:42:52'),
(420, 114, 36, '2022-01-24 14:42:52'),
(421, 114, 36, '2022-01-24 14:42:52'),
(422, 114, 36, '2022-01-24 14:42:52'),
(423, 114, 36, '2022-01-24 14:42:52'),
(424, 106, 36, '2022-01-24 14:42:52'),
(425, 109, 36, '2022-01-24 14:42:52'),
(426, 114, 36, '2022-01-24 14:42:52'),
(427, 114, 36, '2022-01-24 14:42:52'),
(428, 114, 36, '2022-01-24 14:42:52'),
(429, 114, 36, '2022-01-24 14:42:52'),
(430, 114, 36, '2022-01-24 14:42:52'),
(431, 114, 36, '2022-01-24 14:42:52'),
(432, 112, 36, '2022-01-24 14:42:52'),
(433, 112, 36, '2022-01-24 14:42:52'),
(434, 114, 52, '2022-01-24 14:42:52'),
(435, 114, 36, '2022-01-24 14:42:52'),
(436, 114, 52, '2022-01-24 14:42:52'),
(437, 114, 36, '2022-01-24 14:42:52'),
(438, 114, 36, '2022-01-24 14:42:52'),
(439, 114, 36, '2022-01-24 14:42:52'),
(440, 114, 36, '2022-01-24 14:42:52'),
(441, 114, 36, '2022-01-24 14:42:52'),
(442, 111, 36, '2022-01-24 14:42:52'),
(443, 114, 36, '2022-01-24 14:42:52'),
(444, 114, 36, '2022-01-24 14:42:52'),
(445, 114, 36, '2022-01-24 14:42:52'),
(446, 112, 66, '2022-01-24 14:42:52'),
(447, 63, 36, '2022-01-24 14:42:52'),
(448, 114, 36, '2022-01-24 14:42:52'),
(449, 111, 36, '2022-01-24 14:42:52'),
(450, 58, 70, '2022-01-24 14:42:52'),
(451, 95, 70, '2022-01-24 14:42:52'),
(452, 95, 70, '2022-01-24 14:42:52'),
(453, 95, 70, '2022-01-24 14:42:52'),
(454, 95, 70, '2022-01-24 14:42:52'),
(455, 95, 70, '2022-01-24 14:42:52'),
(456, 114, 36, '2022-01-24 14:42:52'),
(457, 111, 36, '2022-01-24 14:42:52'),
(458, 114, 36, '2022-01-24 14:42:52'),
(459, 111, 36, '2022-01-24 14:42:52'),
(460, 114, 52, '2022-01-24 14:42:52'),
(461, 114, 36, '2022-01-24 14:42:52'),
(462, 114, 36, '2022-01-24 14:42:52'),
(463, 114, 36, '2022-01-24 14:42:52'),
(464, 114, 3, '2022-01-24 14:42:52'),
(465, 114, 17, '2022-01-24 14:42:52'),
(466, 114, 17, '2022-01-24 14:42:52'),
(467, 73, 17, '2022-01-24 14:42:52'),
(468, 112, 36, '2022-01-24 14:42:52'),
(469, 111, 36, '2022-01-24 14:42:52'),
(470, 114, 36, '2022-01-24 14:42:52'),
(471, 114, 36, '2022-01-24 14:42:52'),
(472, 112, 36, '2022-01-24 14:42:52'),
(473, 111, 36, '2022-01-24 14:42:52'),
(474, 111, 36, '2022-01-24 14:42:52'),
(475, 114, 1, '2022-01-24 14:42:52'),
(476, 114, 1, '2022-01-24 14:42:52'),
(477, 114, 1, '2022-01-24 14:42:52'),
(478, 114, 1, '2022-01-24 14:42:52'),
(479, 110, 52, '2022-01-24 14:42:52'),
(480, 0, 3, '2022-01-24 14:42:52'),
(481, 0, 52, '2022-01-24 14:42:52'),
(482, 0, 52, '2022-01-24 14:42:52'),
(483, 118, 52, '2022-01-24 14:42:52'),
(484, 117, 52, '2022-01-24 14:42:52'),
(485, 109, 52, '2022-01-24 14:42:52'),
(486, 118, 52, '2022-01-24 14:42:52'),
(487, 118, 52, '2022-01-24 14:42:52'),
(488, 105, 70, '2022-01-24 14:42:52'),
(489, 63, 3, '2022-01-24 14:42:52'),
(490, 118, 43, '2022-01-24 14:42:52'),
(491, 63, 43, '2022-01-24 14:42:52'),
(492, 59, 43, '2022-01-24 14:42:52'),
(493, 63, 43, '2022-01-24 14:42:52'),
(494, 77, 43, '2022-01-24 14:42:52'),
(495, 63, 43, '2022-01-24 14:42:52'),
(496, 77, 43, '2022-01-24 14:42:52'),
(497, 63, 43, '2022-01-24 14:42:52'),
(498, 59, 43, '2022-01-24 14:42:52'),
(499, 59, 43, '2022-01-24 14:42:52'),
(500, 118, 36, '2022-01-24 14:42:52'),
(501, 118, 36, '2022-01-24 14:42:52'),
(502, 118, 36, '2022-01-24 14:42:52'),
(503, 108, 3, '2022-01-24 14:42:52'),
(504, 117, 3, '2022-01-24 14:42:52'),
(505, 116, 3, '2022-01-24 14:42:52'),
(506, 116, 3, '2022-01-24 14:42:52'),
(507, 118, 52, '2022-01-24 14:42:52'),
(508, 117, 36, '2022-01-24 14:42:52'),
(509, 118, 83, '2022-01-24 14:42:52'),
(510, 63, 60, '2022-01-24 14:42:52'),
(511, 117, 60, '2022-01-24 14:42:52'),
(512, 116, 60, '2022-01-24 14:42:52'),
(513, 115, 60, '2022-01-24 14:42:52'),
(514, 118, 60, '2022-01-24 14:42:52'),
(515, 117, 60, '2022-01-24 14:42:52'),
(516, 117, 52, '2022-01-24 14:42:52'),
(517, 73, 90, '2022-01-24 14:42:52'),
(518, 85, 90, '2022-01-24 14:42:52'),
(519, 117, 90, '2022-01-24 14:42:52'),
(520, 100, 90, '2022-01-24 14:42:52'),
(521, 79, 90, '2022-01-24 14:42:52'),
(522, 119, 90, '2022-01-24 14:42:52'),
(523, 121, 90, '2022-01-24 14:42:52'),
(524, 122, 90, '2022-01-24 14:42:52'),
(525, 123, 90, '2022-01-24 14:42:52'),
(526, 0, 90, '2022-01-24 14:42:52'),
(527, 124, 52, '2022-01-24 14:42:52'),
(528, 123, 52, '2022-01-24 14:42:52'),
(529, 122, 52, '2022-01-24 14:42:52'),
(530, 120, 52, '2022-01-24 14:42:52'),
(531, 124, 52, '2022-01-24 14:42:52'),
(532, 122, 52, '2022-01-24 14:42:52'),
(533, 121, 52, '2022-01-24 14:42:52'),
(534, 123, 90, '2022-01-24 14:42:52'),
(535, 119, 90, '2022-01-24 14:42:52'),
(536, 124, 25, '2022-01-24 14:42:52'),
(537, 120, 25, '2022-01-24 14:42:52'),
(538, 110, 25, '2022-01-24 14:42:52'),
(539, 105, 25, '2022-01-24 14:42:52'),
(540, 104, 25, '2022-01-24 14:42:52'),
(541, 89, 25, '2022-01-24 14:42:52'),
(542, 59, 25, '2022-01-24 14:42:52'),
(543, 63, 3, '2022-01-24 14:42:52'),
(544, 63, 52, '2022-01-24 14:42:52'),
(545, 125, 52, '2022-01-24 14:42:52'),
(546, 0, 24, '2022-01-24 14:42:52'),
(547, 125, 24, '2022-01-24 14:42:52'),
(548, 132, 52, '2022-01-24 14:42:52'),
(549, 130, 52, '2022-01-24 14:42:52'),
(550, 59, 52, '2022-01-24 14:42:52'),
(551, 59, 52, '2022-01-24 14:42:52'),
(552, 59, 52, '2022-01-24 14:42:52'),
(553, 130, 17, '2022-01-24 14:42:52'),
(554, 130, 52, '2022-01-24 14:42:52'),
(555, 132, 52, '2022-01-24 14:42:52'),
(556, 63, 17, '2022-01-24 14:42:52'),
(557, 59, 52, '2022-01-24 14:42:52'),
(558, 62, 52, '2022-01-24 14:42:52'),
(559, 62, 3, '2022-01-24 14:42:52'),
(560, 62, 3, '2022-01-24 14:42:52'),
(561, 132, 3, '2022-01-24 14:42:52'),
(562, 109, 3, '2022-01-24 14:42:52'),
(563, 130, 3, '2022-01-24 14:42:52'),
(564, 125, 3, '2022-01-24 14:42:52'),
(565, 109, 3, '2022-01-24 14:42:52'),
(566, 125, 3, '2022-01-24 14:42:52'),
(567, 62, 3, '2022-01-24 14:42:52'),
(568, 109, 52, '2022-01-24 14:42:52'),
(569, 130, 52, '2022-01-24 14:42:52'),
(570, 109, 52, '2022-01-24 14:42:52'),
(571, 135, 52, '2022-01-24 14:42:52'),
(572, 134, 52, '2022-01-24 14:42:52'),
(573, 133, 52, '2022-01-24 14:42:52'),
(574, 129, 52, '2022-01-24 14:42:52'),
(575, 128, 52, '2022-01-24 14:42:52'),
(576, 127, 52, '2022-01-24 14:42:52'),
(577, 109, 52, '2022-01-24 14:42:52'),
(578, 130, 52, '2022-01-24 14:42:52'),
(579, 125, 52, '2022-01-24 14:42:52'),
(580, 135, 52, '2022-01-24 14:42:52'),
(581, 130, 3, '2022-01-24 14:42:52'),
(582, 109, 3, '2022-01-24 14:42:52'),
(583, 125, 3, '2022-01-24 14:42:52'),
(584, 135, 3, '2022-01-24 14:42:52'),
(585, 109, 3, '2022-01-24 14:42:52'),
(586, 135, 3, '2022-01-24 14:42:52'),
(587, 130, 3, '2022-01-24 14:42:52'),
(588, 125, 3, '2022-01-24 14:42:52'),
(589, 109, 3, '2022-01-24 14:42:52'),
(590, 130, 3, '2022-01-24 14:42:52'),
(591, 125, 3, '2022-01-24 14:42:52'),
(592, 135, 3, '2022-01-24 14:42:52'),
(593, 109, 3, '2022-01-24 14:42:52'),
(594, 130, 3, '2022-01-24 14:42:52'),
(595, 125, 3, '2022-01-24 14:42:52'),
(596, 135, 3, '2022-01-24 14:42:52'),
(597, 119, 3, '2022-01-24 14:42:52'),
(598, 137, 36, '2022-01-24 14:42:52'),
(599, 137, 36, '2022-01-24 14:42:52'),
(600, 137, 36, '2022-01-24 14:42:52'),
(601, 135, 36, '2022-01-24 14:42:52'),
(602, 109, 52, '2022-01-24 14:42:52'),
(603, 133, 90, '2022-01-24 14:42:52'),
(604, 132, 90, '2022-01-24 14:42:52'),
(605, 128, 90, '2022-01-24 14:42:52'),
(606, 133, 90, '2022-01-24 14:42:52'),
(607, 86, 3, '2022-01-24 14:42:52'),
(608, 137, 90, '2022-01-24 14:42:52'),
(609, 134, 90, '2022-01-24 14:42:52'),
(610, 127, 90, '2022-01-24 14:42:52'),
(611, 112, 90, '2022-01-24 14:42:52'),
(612, 132, 113, '2022-01-24 14:42:52'),
(613, 130, 113, '2022-01-24 14:42:52'),
(614, 130, 113, '2022-01-24 14:42:52'),
(615, 129, 113, '2022-01-24 14:42:52'),
(616, 128, 113, '2022-01-24 14:42:52'),
(617, 81, 113, '2022-01-24 14:42:52'),
(618, 80, 113, '2022-01-24 14:42:52'),
(619, 70, 113, '2022-01-24 14:42:52'),
(620, 105, 113, '2022-01-24 14:42:52'),
(621, 124, 113, '2022-01-24 14:42:52'),
(622, 134, 113, '2022-01-24 14:42:52'),
(623, 132, 113, '2022-01-24 14:42:52'),
(624, 124, 113, '2022-01-24 14:42:52'),
(625, 129, 113, '2022-01-24 14:42:52'),
(626, 107, 113, '2022-01-24 14:42:52'),
(627, 106, 113, '2022-01-24 14:42:52'),
(628, 129, 3, '2022-01-24 14:42:52'),
(629, 135, 3, '2022-01-24 14:42:52'),
(630, 119, 3, '2022-01-24 14:42:52'),
(631, 111, 3, '2022-01-24 14:42:52'),
(632, 70, 3, '2022-01-24 14:42:52'),
(633, 133, 90, '2022-01-24 14:42:52'),
(634, 134, 90, '2022-01-24 14:42:52'),
(635, 135, 114, '2022-01-24 14:42:52'),
(636, 130, 114, '2022-01-24 14:42:52'),
(637, 129, 114, '2022-01-24 14:42:52'),
(638, 128, 114, '2022-01-24 14:42:52'),
(639, 127, 114, '2022-01-24 14:42:52'),
(640, 122, 114, '2022-01-24 14:42:52'),
(641, 112, 114, '2022-01-24 14:42:52'),
(642, 128, 114, '2022-01-24 14:42:52'),
(643, 130, 114, '2022-01-24 14:42:52'),
(644, 107, 110, '2022-01-24 14:42:52'),
(645, 107, 110, '2022-01-24 14:42:52'),
(646, 130, 90, '2022-01-24 14:42:52'),
(647, 137, 90, '2022-01-24 14:42:52'),
(648, 133, 90, '2022-01-24 14:42:52'),
(649, 114, 113, '2022-01-24 14:42:52'),
(650, 137, 3, '2022-01-24 14:42:52'),
(651, 135, 3, '2022-01-24 14:42:52'),
(652, 125, 3, '2022-01-24 14:42:52'),
(653, 120, 3, '2022-01-24 14:42:52'),
(654, 119, 3, '2022-01-24 14:42:52'),
(655, 111, 3, '2022-01-24 14:42:52'),
(656, 109, 3, '2022-01-24 14:42:52'),
(657, 127, 90, '2022-01-24 14:42:52'),
(658, 134, 113, '2022-01-24 14:42:52'),
(659, 137, 90, '2022-01-24 14:42:52'),
(660, 130, 109, '2022-01-24 14:42:52'),
(661, 134, 90, '2022-01-24 14:42:52'),
(662, 127, 90, '2022-01-24 14:42:52'),
(663, 101, 120, '2022-01-24 14:42:52'),
(664, 84, 120, '2022-01-24 14:42:52'),
(665, 136, 114, '2022-01-24 14:42:52'),
(666, 137, 114, '2022-01-24 14:42:52'),
(667, 135, 114, '2022-01-24 14:42:52'),
(668, 75, 121, '2022-01-24 14:42:52'),
(669, 75, 121, '2022-01-24 14:42:52'),
(670, 59, 121, '2022-01-24 14:42:52'),
(671, 59, 121, '2022-01-24 14:42:52'),
(672, 59, 121, '2022-01-24 14:42:52'),
(673, 59, 121, '2022-01-24 14:42:52'),
(674, 59, 121, '2022-01-24 14:42:52'),
(675, 77, 122, '2022-01-24 14:42:52'),
(676, 82, 122, '2022-01-24 14:42:52'),
(677, 84, 122, '2022-01-24 14:42:52'),
(678, 85, 122, '2022-01-24 14:42:52'),
(679, 86, 122, '2022-01-24 14:42:52'),
(680, 137, 90, '2022-01-24 14:42:52'),
(681, 127, 90, '2022-01-24 14:42:52'),
(682, 124, 90, '2022-01-24 14:42:52'),
(683, 78, 90, '2022-01-24 14:42:52'),
(684, 101, 120, '2022-01-24 14:42:52'),
(685, 125, 120, '2022-01-24 14:42:52'),
(686, 133, 90, '2022-01-24 14:42:52'),
(687, 129, 122, '2022-01-24 14:42:52'),
(688, 130, 122, '2022-01-24 14:42:52'),
(689, 0, 90, '2022-01-24 14:42:52'),
(690, 85, 122, '2022-01-24 14:42:52'),
(691, 86, 122, '2022-01-24 14:42:52'),
(692, 139, 123, '2022-01-24 14:42:52'),
(693, 135, 123, '2022-01-24 14:42:52'),
(694, 70, 123, '2022-01-24 14:42:52'),
(695, 70, 123, '2022-01-24 14:42:52'),
(696, 70, 123, '2022-01-24 14:42:52'),
(697, 143, 123, '2022-01-24 14:42:52'),
(698, 142, 123, '2022-01-24 14:42:52'),
(699, 141, 123, '2022-01-24 14:42:52'),
(700, 121, 123, '2022-01-24 14:42:52'),
(701, 119, 123, '2022-01-24 14:42:52'),
(702, 126, 123, '2022-01-24 14:42:52'),
(703, 110, 123, '2022-01-24 14:42:52'),
(704, 101, 123, '2022-01-24 14:42:52'),
(705, 70, 123, '2022-01-24 14:42:52'),
(706, 77, 123, '2022-01-24 14:42:52'),
(707, 80, 123, '2022-01-24 14:42:52'),
(708, 84, 123, '2022-01-24 14:42:52'),
(709, 137, 123, '2022-01-24 14:42:52'),
(710, 142, 123, '2022-01-24 14:42:52'),
(711, 136, 123, '2022-01-24 14:42:52'),
(712, 129, 123, '2022-01-24 14:42:52'),
(713, 129, 123, '2022-01-24 14:42:52'),
(714, 121, 123, '2022-01-24 14:42:52'),
(715, 120, 123, '2022-01-24 14:42:52'),
(716, 111, 123, '2022-01-24 14:42:52'),
(717, 77, 123, '2022-01-24 14:42:52'),
(718, 121, 123, '2022-01-24 14:42:52'),
(719, 129, 123, '2022-01-24 14:42:52'),
(720, 126, 123, '2022-01-24 14:42:52'),
(721, 108, 123, '2022-01-24 14:42:52'),
(722, 137, 123, '2022-01-24 14:42:52'),
(723, 137, 123, '2022-01-24 14:42:52'),
(724, 115, 123, '2022-01-24 14:42:52'),
(725, 107, 123, '2022-01-24 14:42:52'),
(726, 102, 123, '2022-01-24 14:42:52'),
(727, 103, 123, '2022-01-24 14:42:52'),
(728, 101, 123, '2022-01-24 14:42:52'),
(729, 89, 123, '2022-01-24 14:42:52'),
(730, 81, 123, '2022-01-24 14:42:52'),
(731, 70, 123, '2022-01-24 14:42:52'),
(732, 110, 123, '2022-01-24 14:42:52'),
(733, 109, 123, '2022-01-24 14:42:52'),
(734, 141, 123, '2022-01-24 14:42:52'),
(735, 141, 120, '2022-01-24 14:42:52'),
(736, 139, 123, '2022-01-24 14:42:52'),
(737, 129, 123, '2022-01-24 14:42:52'),
(738, 126, 123, '2022-01-24 14:42:52'),
(739, 125, 123, '2022-01-24 14:42:52'),
(740, 119, 123, '2022-01-24 14:42:52'),
(741, 116, 123, '2022-01-24 14:42:52'),
(742, 104, 123, '2022-01-24 14:42:52'),
(743, 130, 123, '2022-01-24 14:42:52'),
(744, 102, 123, '2022-01-24 14:42:52'),
(745, 86, 123, '2022-01-24 14:42:52'),
(746, 142, 52, '2022-01-24 14:42:52'),
(747, 140, 52, '2022-01-24 14:42:52'),
(748, 143, 104, '2022-01-24 14:42:52'),
(749, 142, 104, '2022-01-24 14:42:52'),
(750, 0, 24, '2022-01-24 14:42:52'),
(751, 144, 24, '2022-01-24 14:42:52'),
(752, 0, 24, '2022-01-24 14:42:52'),
(753, 0, 110, '2022-01-24 14:42:52'),
(754, 135, 52, '2022-01-24 14:42:52'),
(755, 146, 52, '2022-01-24 14:42:52'),
(756, 146, 90, '2022-01-24 14:42:52'),
(757, 145, 90, '2022-01-24 14:42:52'),
(758, 137, 124, '2022-01-24 14:42:52'),
(759, 144, 124, '2022-01-24 14:42:52'),
(760, 125, 124, '2022-01-24 14:42:52'),
(761, 144, 124, '2022-01-24 14:42:52'),
(762, 143, 124, '2022-01-24 14:42:52'),
(763, 141, 124, '2022-01-24 14:42:52'),
(764, 140, 124, '2022-01-24 14:42:52'),
(765, 139, 124, '2022-01-24 14:42:52'),
(766, 128, 124, '2022-01-24 14:42:52'),
(767, 133, 104, '2022-01-24 14:42:52'),
(768, 146, 104, '2022-01-24 14:42:52'),
(769, 139, 104, '2022-01-24 14:42:52'),
(770, 128, 104, '2022-01-24 14:42:52'),
(771, 144, 105, '2022-01-24 14:42:52'),
(772, 110, 105, '2022-01-24 14:42:52'),
(773, 146, 105, '2022-01-24 14:42:52'),
(774, 145, 90, '2022-01-24 14:42:52'),
(775, 146, 90, '2022-01-24 14:42:52'),
(776, 137, 36, '2022-01-24 14:42:52'),
(777, 146, 126, '2022-01-24 14:42:52'),
(778, 146, 126, '2022-01-24 14:42:52'),
(779, 146, 126, '2022-01-24 14:42:52'),
(780, 146, 126, '2022-01-24 14:42:52'),
(781, 128, 126, '2022-01-24 14:42:52'),
(782, 102, 126, '2022-01-24 14:42:52'),
(783, 146, 126, '2022-01-24 14:42:52'),
(784, 143, 126, '2022-01-24 14:42:52'),
(785, 141, 126, '2022-01-24 14:42:52'),
(786, 143, 126, '2022-01-24 14:42:52'),
(787, 143, 126, '2022-01-24 14:42:52'),
(788, 108, 126, '2022-01-24 14:42:52'),
(789, 106, 126, '2022-01-24 14:42:52'),
(790, 86, 130, '2022-01-24 14:42:52'),
(791, 135, 126, '2022-01-24 14:42:52'),
(792, 144, 126, '2022-01-24 14:42:52'),
(793, 125, 126, '2022-01-24 14:42:52'),
(794, 86, 126, '2022-01-24 14:42:52'),
(795, 102, 126, '2022-01-24 14:42:52'),
(796, 81, 126, '2022-01-24 14:42:52'),
(797, 144, 131, '2022-01-24 14:42:52'),
(798, 134, 131, '2022-01-24 14:42:52'),
(799, 117, 131, '2022-01-24 14:42:52'),
(800, 77, 131, '2022-01-24 14:42:52'),
(801, 140, 126, '2022-01-24 14:42:52'),
(802, 146, 36, '2022-01-24 14:42:52'),
(803, 145, 36, '2022-01-24 14:42:52'),
(804, 146, 36, '2022-01-24 14:42:52'),
(805, 144, 36, '2022-01-24 14:42:52'),
(806, 142, 36, '2022-01-24 14:42:52'),
(807, 143, 36, '2022-01-24 14:42:52'),
(808, 145, 132, '2022-01-24 14:42:52'),
(809, 145, 132, '2022-01-24 14:42:52'),
(810, 145, 132, '2022-01-24 14:42:52'),
(811, 146, 123, '2022-01-24 14:42:52'),
(812, 144, 123, '2022-01-24 14:42:52'),
(813, 0, 132, '2022-01-24 14:42:52'),
(814, 109, 132, '2022-01-24 14:42:52'),
(815, 130, 3, '2022-01-24 14:42:52'),
(816, 143, 133, '2022-01-24 14:42:52'),
(817, 133, 133, '2022-01-24 14:42:52'),
(818, 147, 133, '2022-01-24 14:42:52'),
(819, 146, 90, '2022-01-24 14:42:52'),
(820, 1, 1, '2022-02-17 04:28:57'),
(821, 81, 1, '2022-02-17 04:29:13'),
(822, 81, 1, '2022-02-17 04:35:33'),
(823, 81, 1, '2022-02-17 04:39:12'),
(824, 147, 1, '2022-02-17 06:33:42'),
(825, 147, 1, '2022-02-19 06:19:18'),
(826, 147, 1, '2022-02-19 06:25:22'),
(827, 147, 1, '2022-02-19 06:28:31'),
(828, 147, 1, '2022-02-19 06:29:32'),
(829, 91, 1, '2022-02-19 10:55:50'),
(830, 91, 1, '2022-02-21 06:59:50'),
(831, 91, 1, '2022-02-21 07:01:02'),
(832, 91, 1, '2022-02-21 07:18:05'),
(833, 91, 1, '2022-02-21 07:18:22'),
(834, 91, 1, '2022-02-21 07:19:03'),
(835, 91, 1, '2022-03-06 23:29:05'),
(836, 91, 1, '2022-03-06 23:30:50'),
(837, 91, 1, '2022-03-07 02:20:07'),
(838, 23, 2, '2022-03-07 10:30:06'),
(839, 23, 2, '2022-03-07 10:45:49'),
(840, 23, 2, '2022-03-07 10:47:48'),
(841, 2, 2, '2022-03-07 12:26:19'),
(842, 2, 2, '2022-03-07 12:30:18'),
(843, 2, 2, '2022-03-08 03:58:51'),
(844, 23, 2, '2022-03-08 04:21:09'),
(845, 23, 2, '2022-03-08 05:31:54'),
(846, 2, 2, '2022-03-08 05:32:14'),
(847, 2, 2, '2022-03-08 07:13:48'),
(848, 2, 2, '2022-03-08 07:16:45'),
(849, 2, 2, '2022-03-08 07:17:03'),
(850, 2, 32, '2022-03-08 07:17:36'),
(851, 2, 32, '2022-03-08 07:17:38'),
(852, 2, 32, '2022-03-08 07:19:13'),
(853, 2, 32, '2022-03-08 07:19:27'),
(854, 2, 32, '2022-03-08 07:20:15'),
(855, 33, 32, '2022-03-08 07:31:54'),
(856, 33, 32, '2022-03-08 07:38:09'),
(857, 33, 32, '2022-03-08 07:51:53'),
(858, 33, 32, '2022-03-08 07:54:04'),
(859, 33, 32, '2022-03-08 08:21:34'),
(860, 2, 32, '2022-03-08 08:37:17'),
(861, 33, 32, '2022-03-08 08:47:11'),
(862, 33, 32, '2022-03-08 09:20:30'),
(863, 33, 32, '2022-03-08 09:24:15'),
(864, 33, 32, '2022-03-08 10:07:52'),
(865, 33, 32, '2022-03-08 10:10:13'),
(866, 33, 32, '2022-03-08 10:30:28'),
(867, 2, 32, '2022-03-08 11:16:53'),
(868, 34, 32, '2022-03-08 11:17:06'),
(869, 35, 32, '2022-03-08 11:18:00'),
(870, 2, 32, '2022-03-09 05:05:20'),
(871, 2, 32, '2022-03-09 12:53:39'),
(872, 2, 32, '2022-03-09 13:00:21'),
(873, 33, 32, '2022-03-09 13:00:49'),
(874, 2, 32, '2022-03-10 09:57:48'),
(875, 2, 32, '2022-03-10 11:37:38'),
(876, 2, 32, '2022-03-10 11:51:50'),
(877, 2, 32, '2022-03-10 11:53:55'),
(878, 2, 32, '2022-03-10 11:59:04'),
(879, 2, 32, '2022-03-10 12:35:25'),
(880, 2, 32, '2022-03-10 12:49:55'),
(881, 2, 32, '2022-03-10 12:54:09'),
(882, 2, 32, '2022-03-10 12:55:51'),
(883, 2, 32, '2022-03-10 13:00:21'),
(884, 2, 32, '2022-03-10 13:01:38'),
(885, 2, 32, '2022-03-10 13:12:41'),
(886, 2, 32, '2022-03-10 13:19:33'),
(887, 2, 32, '2022-03-10 13:25:17'),
(888, 2, 32, '2022-03-10 13:25:46'),
(889, 2, 32, '2022-03-10 13:27:16'),
(890, 2, 32, '2022-03-10 13:28:55'),
(891, 2, 32, '2022-03-10 14:09:14'),
(892, 2, 32, '2022-03-10 14:12:14'),
(893, 2, 32, '2022-03-10 14:16:27'),
(894, 2, 32, '2022-03-10 14:22:42'),
(895, 2, 32, '2022-03-10 14:42:00'),
(896, 2, 32, '2022-03-10 14:43:22'),
(897, 2, 32, '2022-03-10 14:52:28'),
(898, 2, 32, '2022-03-10 15:32:48'),
(899, 2, 32, '2022-03-10 15:34:05'),
(900, 2, 32, '2022-03-10 15:47:36'),
(901, 2, 32, '2022-03-10 15:49:02'),
(902, 2, 32, '2022-03-10 15:50:46'),
(903, 2, 32, '2022-03-11 03:29:40'),
(904, 2, 32, '2022-03-11 04:01:10'),
(905, 2, 32, '2022-03-11 12:47:05'),
(906, 2, 32, '2022-03-11 12:49:27'),
(907, 33, 32, '2022-03-11 12:57:52'),
(908, 35, 32, '2022-03-11 16:05:50'),
(909, 34, 32, '2022-03-12 05:01:28'),
(910, 35, 32, '2022-03-12 05:09:31'),
(911, 35, 32, '2022-03-14 11:17:09'),
(912, 35, 32, '2022-03-14 11:23:03'),
(913, 35, 32, '2022-03-14 11:27:52'),
(914, 35, 32, '2022-03-14 11:37:17'),
(915, 35, 32, '2022-03-14 11:41:26'),
(916, 35, 32, '2022-03-15 06:18:43'),
(917, 33, 32, '2022-03-15 06:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_app`
--

CREATE TABLE `user_app` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobilenumber` varchar(40) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contactid` varchar(56) NOT NULL,
  `compnay` varchar(256) NOT NULL,
  `profileimg` mediumtext NOT NULL,
  `tranportname` varchar(255) NOT NULL,
  `gstin` varchar(25) NOT NULL,
  `pviewcount` int(11) NOT NULL DEFAULT 0,
  `fcmtoken` mediumtext NOT NULL,
  `deviceid` varchar(556) NOT NULL,
  `devicecount` int(11) NOT NULL,
  `isverified` varchar(25) NOT NULL DEFAULT 'false',
  `premiumuser` int(11) NOT NULL DEFAULT 0,
  `businessname` varchar(255) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `coupan` tinyint(1) NOT NULL,
  `guestuser` tinyint(4) NOT NULL,
  `approvedby` int(11) NOT NULL,
  `read_status` int(11) NOT NULL,
  `userprice` varchar(56) NOT NULL,
  `smsflg` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `alocation_agent_id` int(30) NOT NULL DEFAULT 0,
  `user_group` text NOT NULL,
  `reguleruser` tinyint(4) NOT NULL DEFAULT 0,
  `guest` tinyint(4) NOT NULL DEFAULT 0,
  `retailer` tinyint(4) NOT NULL DEFAULT 0,
  `wholesaller` tinyint(4) NOT NULL DEFAULT 0,
  `ac_type` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `whatsapp` varchar(15) NOT NULL DEFAULT '0',
  `phone_1` varchar(20) NOT NULL,
  `phone_2` varchar(30) NOT NULL,
  `sms_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_app`
--

INSERT INTO `user_app` (`id`, `name`, `mobilenumber`, `emailid`, `address`, `contactid`, `compnay`, `profileimg`, `tranportname`, `gstin`, `pviewcount`, `fcmtoken`, `deviceid`, `devicecount`, `isverified`, `premiumuser`, `businessname`, `jobtitle`, `credit`, `coupan`, `guestuser`, `approvedby`, `read_status`, `userprice`, `smsflg`, `created`, `alocation_agent_id`, `user_group`, `reguleruser`, `guest`, `retailer`, `wholesaller`, `ac_type`, `city`, `whatsapp`, `phone_1`, `phone_2`, `sms_no`) VALUES
(32, 'jaimish', '8160402366', 'j@gmail.com', '', '', '', '1647352335_image_picker2132079616704031016.jpg', '', '36BRSPA0780K1ZI', 500, 'd-_3PGuXS9isGiKnFk94zw:APA91bGO1WI4bfyaiZ9KV4g5tk9Hp01XrTKoQxOXnJnhsfOHQMSG__XEfYwahTEMpVtCwwqj2B1bBxEWhrKCBquQBaEM5PjAqyNLKpHy--6HS3BO68QTJlyhdCveXGLE50vp5jZ8SeuY', '0e2c350f53f3285e', 4, 'true', 0, 'Sun', '', 0, 0, 0, 0, 0, '', 1, '2022-03-15 13:52:37', 2, 'guest', 0, 1, 0, 0, 'SUNDRY DEBTORS', 'HYDERABAD', '9085754248', '', '', ''),
(38, 'A P SAREE HOUSE', '9014362683', '', '', '', '', '', '', '36BRSPA0780K1ZI', 0, '', '', 0, 'true', 0, '', '', 0, 0, 0, 0, 0, '', 0, '2022-03-08 10:45:03', 2, '', 0, 1, 0, 0, 'SUNDRY DEBTORS', 'HYDERABAD', '9014362683', '', '', ''),
(39, 'vasim', '9099999999', '', '', '', '', '', '', '36BRSPA0780K1ZI', 0, '', '', 0, 'true', 0, '', '', 0, 0, 0, 0, 0, '', 0, '2022-03-08 10:45:03', 5, '', 0, 1, 0, 0, 'SUNDRY DEBTORS', 'HYDERABAD', '9099999999', '', '', ''),
(40, 'akash', '9088888888', '', '', '', '', '', '', '36BRSPA0780K1ZI', 0, '', '', 0, 'true', 0, '', '', 0, 0, 0, 0, 0, '', 0, '2022-03-08 10:45:03', 4, '', 0, 1, 0, 0, 'SUNDRY DEBTORS', 'HYDERABAD', '9088888888', '', '', ''),
(41, '', '', '', '', '', '', '', '', '', 0, '', '', 0, 'true', 0, '', '', 0, 0, 0, 0, 0, '', 0, '2022-03-08 10:45:03', 0, '', 0, 1, 0, 0, '', '', '', '', '', ''),
(42, 'Jaimis', '9784569856', 'testung@gmail.com', 'Railway station', '', '', '', '', '24A0000GH7830', 0, '', '', 0, 'false', 0, 'Jurad', '', 0, 0, 0, 0, 0, '', 0, '2022-03-15 13:45:49', 0, '', 0, 0, 0, 0, '', '', '0', '', '', ''),
(43, 'Jaimis', '9898989898', 'jemish@gmail.com', 'behind you', '', '', '', '', '24AAAAA0000A1Z5', 0, '', '', 0, '0', 0, 'janvi', '', 0, 0, 0, 0, 0, '', 0, '2022-03-15 13:28:40', 0, '', 0, 0, 0, 0, '', '', '0', '', '', ''),
(44, 'jemish', '9696969696', 'jemu@gmail.com', 'beautiful', '', '', '', '', '24AAAAA0000A1Z5', 0, '', '', 0, '0', 0, 'janvi sarees', '', 0, 0, 0, 0, 0, '', 0, '2022-03-15 13:31:17', 0, '', 0, 0, 0, 0, '', '', '0', '', '', ''),
(45, 'heyyyy', '9879879879', 'heyyy@gmail.com', 'vah bahi bhai', '', '', '', '', '24AAAAA0000A1Z5', 0, '', '', 0, '0', 0, 'vah bhai', '', 0, 0, 0, 0, 0, '', 0, '2022-03-15 13:33:10', 0, '', 0, 0, 0, 0, '', '', '0', '', '', ''),
(46, 'ooooooo', '9632587412', 'bhai@gmail.com', 'hsjsbd sjdbdjd dj dj', '', '', '', '', '24AAAAA0000A1Z5', 0, '', '', 0, 'false', 0, 'Joo joo', '', 0, 0, 0, 0, 0, '', 0, '2022-03-15 13:38:47', 0, '', 0, 0, 0, 0, '', '', '0', '', '', ''),
(47, 'heyyy', '9877899877', 'hello@gmail.com', 'ooops', '', '', '', '', '24AAAAA0000A1Z5', 0, 'eYaCEXhGRGaiDMhJ253dZl:APA91bGLvdlCQUUZeELVCJpFv90EdfWOOU6GQhaacY_846tYlSRDYzuUtmDuI_8j1Y-IfLVHHMd_4N1vRVILNjPD3idXxXnCgPNfh_v8ip-dXGe23RDk5n1jGRZV9b993J4CEYRUY9qD', '0e2c350f53f3285e', 1, 'true', 0, 'vah bhai', '', 0, 0, 0, 0, 0, '', 0, '2022-03-15 14:17:01', 0, '', 0, 1, 0, 0, '', '', '0', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_firmlist`
--

CREATE TABLE `user_firmlist` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `firmname` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `value_store`
--

CREATE TABLE `value_store` (
  `id` int(10) UNSIGNED NOT NULL,
  `thekey` varchar(50) NOT NULL,
  `apivalue` varchar(56) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `value_store`
--

INSERT INTO `value_store` (`id`, `thekey`, `apivalue`, `value`) VALUES
(1, 'sitelogo', '', '250_Width.png'),
(2, 'navitext', '', ''),
(3, 'footercopyright', '', 'Kodas Sarees © All right reserved. '),
(4, 'contactspage', '', 'Hello dear client'),
(5, 'footerContactAddr', 'Latlong', '21.3070991,73.282751'),
(6, 'footerContactEmail', 'Email', 'sales@kodas.com'),
(7, 'footerContactPhone', 'Mobile', '8347782201'),
(8, 'googleMaps', '', '42.671840, 83.279163'),
(9, 'footerAboutUs', '', ''),
(10, 'footerSocialFacebook', '', 'https://www.facebook.com'),
(11, 'footerSocialTwitter', '', 'https://twitter.com'),
(12, 'footerSocialGooglePlus', '', ''),
(13, 'footerSocialPinterest', '', 'https://www.pinterest.com'),
(14, 'footerSocialYoutube', '', 'https://www.youtube.com'),
(16, 'contactsEmailTo', '', 'contacts@shop.dev'),
(17, 'shippingOrder', '', '1'),
(18, 'addJs', '', ''),
(19, 'publicQuantity', '', '0'),
(20, 'paypal_email', '', ''),
(21, 'paypal_sandbox', '', '0'),
(22, 'publicDateAdded', '', '0'),
(23, 'googleApi', '', ''),
(24, 'template', '', 'redlabel'),
(25, 'cashondelivery_visibility', '', '1'),
(26, 'showBrands', '', '0'),
(27, 'showInSlider', '', '0'),
(28, 'codeDiscounts', '', '1'),
(29, 'virtualProducts', '', '0'),
(30, 'multiVendor', '', '0'),
(31, 'outOfStock', '', '1'),
(32, 'hideBuyButtonsOfOutOfStock', '', '0'),
(33, 'moreInfoBtn', '', ''),
(34, 'refreshAfterAddToCart', '', '0'),
(35, 'footerContactStoname', 'Name', 'Kodas'),
(36, 'footerContactwPhone', 'WhatsappNo', '8347782201'),
(37, 'footerContactwAddress', 'Address', 'KODAS GROUP(Bharat Creation Pvt. Ltd.), G-2365/66 Millenium Market, Ring Rd, Surat, Gujarat'),
(38, 'footerContactwWeblink', 'WebsiteLink', 'https://kodas.com/'),
(39, 'footerContactAccNo', 'AccountNumber', 'XXXXXX'),
(40, 'footerContactIFSCode', 'IFSCCode', 'XXXXXX'),
(41, 'footerContactHoldname', 'HolderName', 'Kodas'),
(42, 'footerContactGSTno', 'GSTNo', '24GTRSDE'),
(43, 'banner1', '', 'CD.jpg'),
(44, 'banner2', '', 'C.jpg'),
(45, 'footerSocialInstagram', '', 'https://www.instagram.com'),
(46, 'banner', '', 'New '),
(47, 'bannerheading', '', 'Latest Sarees '),
(48, 'bannersubheading', '', 'New Collection'),
(49, 'bannerlink1', '', 'https://kodas.com/catalogdetail?catalog_id=71'),
(50, 'bannerlink2', '', 'https://kodas.com/catalogdetail?catalog_id=67'),
(51, 'cartlimitset', '', '72'),
(52, 'prelaunchimg', '', 'COMMING_SOON1.png'),
(53, 'addgst', '', '5'),
(54, 'footerSocialLinkedin', '', 'https://www.linkedin.com');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `url`, `email`, `password`, `updated_at`, `created_at`) VALUES
(2, NULL, '', 'vasim@gmail.com', '$2y$10$UnUc/fzuz3ksQhhbcpaLQeFkRFQyjIhsNSYPvtIxAawA5aOsWngIG', '2022-01-30 09:04:29', '2022-01-30 09:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders`
--

CREATE TABLE `vendors_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT 0,
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `discount_code` varchar(20) NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders_clients`
--

CREATE TABLE `vendors_orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wpn_chatmessenger`
--

CREATE TABLE `wpn_chatmessenger` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `audiofile` text NOT NULL,
  `read_status` int(11) NOT NULL,
  `usertype` varchar(56) NOT NULL,
  `userid` int(11) NOT NULL,
  `timeanddate` int(11) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wpn_chatmessenger`
--

INSERT INTO `wpn_chatmessenger` (`id`, `sender_id`, `receiver_id`, `message`, `audiofile`, `read_status`, `usertype`, `userid`, `timeanddate`, `dateandtime`) VALUES
(1, 1, 2, 'helo', '', 1, 'admin', 2, 1645520098, '2022-02-22 09:07:36'),
(2, 1, 2, 'hi', '', 1, 'admin', 2, 1645520109, '2022-02-22 09:07:36'),
(3, 1, 2, 'hi', '', 1, 'admin', 2, 1645520843, '2022-02-22 09:07:36'),
(4, 1, 2, 'helo', '', 1, 'admin', 2, 1645520861, '2022-02-22 12:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `wpn_chatmessenger1`
--

CREATE TABLE `wpn_chatmessenger1` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `audiofile` text NOT NULL,
  `read_status` int(11) NOT NULL,
  `usertype` varchar(56) NOT NULL,
  `userid` int(11) NOT NULL,
  `timeanddate` int(11) NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wpn_chatmessenger1`
--

INSERT INTO `wpn_chatmessenger1` (`id`, `sender_id`, `receiver_id`, `message`, `audiofile`, `read_status`, `usertype`, `userid`, `timeanddate`, `dateandtime`) VALUES
(1, 1, 2, 'hi', '', 0, 'admin', 2, 1645520926, '2022-02-22 09:08:46'),
(2, 1, 2, 'helo', '', 0, 'admin', 2, 1645521071, '2022-02-22 09:11:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutpage`
--
ALTER TABLE `aboutpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `active_pages`
--
ALTER TABLE `active_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `app_slider`
--
ALTER TABLE `app_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attributes_id`);

--
-- Indexes for table `attributes_group`
--
ALTER TABLE `attributes_group`
  ADD PRIMARY KEY (`attributesgroup_id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartdetails`
--
ALTER TABLE `cartdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirm_links`
--
ALTER TABLE `confirm_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `connproduct`
--
ALTER TABLE `connproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_law`
--
ALTER TABLE `cookie_law`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`abbr`,`for_id`) USING BTREE;

--
-- Indexes for table `coupan`
--
ALTER TABLE `coupan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_history`
--
ALTER TABLE `device_history`
  ADD PRIMARY KEY (`device_history_id`);

--
-- Indexes for table `device_history_agent`
--
ALTER TABLE `device_history_agent`
  ADD PRIMARY KEY (`device_history_id`);

--
-- Indexes for table `directorder_chatmessenger`
--
ALTER TABLE `directorder_chatmessenger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likepreproduct`
--
ALTER TABLE `likepreproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likepreproductimg`
--
ALTER TABLE `likepreproductimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likeproductimg`
--
ALTER TABLE `likeproductimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobileuser`
--
ALTER TABLE `mobileuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificationdata`
--
ALTER TABLE `notificationdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderstatuslist`
--
ALTER TABLE `orderstatuslist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_clients`
--
ALTER TABLE `orders_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_chatmessenger`
--
ALTER TABLE `order_chatmessenger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packagingtype`
--
ALTER TABLE `packagingtype`
  ADD PRIMARY KEY (`packagingtype_id`);

--
-- Indexes for table `photoordercreate`
--
ALTER TABLE `photoordercreate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_products`
--
ALTER TABLE `pre_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_products_translations`
--
ALTER TABLE `pre_products_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacypage`
--
ALTER TABLE `privacypage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productcat`
--
ALTER TABLE `productcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_translations`
--
ALTER TABLE `products_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute1`
--
ALTER TABLE `product_attribute1`
  ADD PRIMARY KEY (`product_attribute_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`);

--
-- Indexes for table `refundpage`
--
ALTER TABLE `refundpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages`
--
ALTER TABLE `seo_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_attribute`
--
ALTER TABLE `shop_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_attribute_translations`
--
ALTER TABLE `shop_attribute_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `subscribed`
--
ALTER TABLE `subscribed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termpage`
--
ALTER TABLE `termpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useraddress`
--
ALTER TABLE `useraddress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userrecentview`
--
ALTER TABLE `userrecentview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_public`
--
ALTER TABLE `users_public`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userviewproduct`
--
ALTER TABLE `userviewproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_app`
--
ALTER TABLE `user_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_firmlist`
--
ALTER TABLE `user_firmlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `value_store`
--
ALTER TABLE `value_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`thekey`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpn_chatmessenger`
--
ALTER TABLE `wpn_chatmessenger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpn_chatmessenger1`
--
ALTER TABLE `wpn_chatmessenger1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutpage`
--
ALTER TABLE `aboutpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `active_pages`
--
ALTER TABLE `active_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `app_slider`
--
ALTER TABLE `app_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attributes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `attributes_group`
--
ALTER TABLE `attributes_group`
  MODIFY `attributesgroup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cartdetails`
--
ALTER TABLE `cartdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `confirm_links`
--
ALTER TABLE `confirm_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `connproduct`
--
ALTER TABLE `connproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cookie_law`
--
ALTER TABLE `cookie_law`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupan`
--
ALTER TABLE `coupan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `device_history`
--
ALTER TABLE `device_history`
  MODIFY `device_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_history_agent`
--
ALTER TABLE `device_history_agent`
  MODIFY `device_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directorder_chatmessenger`
--
ALTER TABLE `directorder_chatmessenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likepreproduct`
--
ALTER TABLE `likepreproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likepreproductimg`
--
ALTER TABLE `likepreproductimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `likeproductimg`
--
ALTER TABLE `likeproductimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `mobileuser`
--
ALTER TABLE `mobileuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `notificationdata`
--
ALTER TABLE `notificationdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=947;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderstatuslist`
--
ALTER TABLE `orderstatuslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_clients`
--
ALTER TABLE `orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_chatmessenger`
--
ALTER TABLE `order_chatmessenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packagingtype`
--
ALTER TABLE `packagingtype`
  MODIFY `packagingtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photoordercreate`
--
ALTER TABLE `photoordercreate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pre_products`
--
ALTER TABLE `pre_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pre_products_translations`
--
ALTER TABLE `pre_products_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `privacypage`
--
ALTER TABLE `privacypage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `productcat`
--
ALTER TABLE `productcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=671;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products_translations`
--
ALTER TABLE `products_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_attribute1`
--
ALTER TABLE `product_attribute1`
  MODIFY `product_attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `refundpage`
--
ALTER TABLE `refundpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seo_pages`
--
ALTER TABLE `seo_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_attribute`
--
ALTER TABLE `shop_attribute`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `shop_attribute_translations`
--
ALTER TABLE `shop_attribute_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribed`
--
ALTER TABLE `subscribed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `termpage`
--
ALTER TABLE `termpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraddress`
--
ALTER TABLE `useraddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `userrecentview`
--
ALTER TABLE `userrecentview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1969;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_public`
--
ALTER TABLE `users_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userviewproduct`
--
ALTER TABLE `userviewproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=918;

--
-- AUTO_INCREMENT for table `user_app`
--
ALTER TABLE `user_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_firmlist`
--
ALTER TABLE `user_firmlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `value_store`
--
ALTER TABLE `value_store`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wpn_chatmessenger`
--
ALTER TABLE `wpn_chatmessenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wpn_chatmessenger1`
--
ALTER TABLE `wpn_chatmessenger1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
