-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jun 06, 2019 at 11:58 PM
-- Server version: 5.7.24
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garladodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `logId` int(255) NOT NULL,
  `adminId` int(255) DEFAULT NULL,
  `time` varchar(25) DEFAULT NULL,
  `date` varchar(25) DEFAULT NULL,
  `day` varchar(25) DEFAULT NULL,
  `month` varchar(3) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `event` varchar(700) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminlog`
--

INSERT INTO `adminlog` (`logId`, `adminId`, `time`, `date`, `day`, `month`, `year`, `action`, `event`) VALUES
(1, 3, '12:05:27', '20/05/2019', '20', '05', '2019', 'LOG IN', 'Successful login into adminitstration panel.'),
(2, 3, '12:05:41', '20/05/2019', '20', '05', '2019', 'CHANGED PASSWORD', 'User kevokario@gmail.com Successfuly changed password.'),
(3, 3, '12:05:26', '20/05/2019', '20', '05', '2019', 'ADDED NEW GENERAL GROUP', 'Successful addition of general group HOME AND OFFICE.'),
(4, 3, '12:05:35', '20/05/2019', '20', '05', '2019', 'ADDED NEW GENERAL GROUP', 'Successful addition of general group HEALTH AND BEAUTY.'),
(5, 3, '12:05:46', '20/05/2019', '20', '05', '2019', 'ADDED NEW GENERAL GROUP', 'Successful addition of general group GROCERY.'),
(6, 3, '12:05:56', '20/05/2019', '20', '05', '2019', 'ADDED NEW GENERAL GROUP', 'Successful addition of general group BABY PRODUCTS.'),
(7, 3, '12:05:06', '20/05/2019', '20', '05', '2019', 'ADDED NEW GENERAL GROUP', 'Successful addition of general group FASHION.'),
(8, 3, '12:05:18', '20/05/2019', '20', '05', '2019', 'ADDED NEW GENERAL GROUP', 'Successful addition of general group AUTOMOBILE.'),
(9, 3, '12:05:24', '20/05/2019', '20', '05', '2019', 'ADDED NEW GENERAL GROUP', 'Successful addition of general group GAMING.'),
(10, 3, '12:05:44', '20/05/2019', '20', '05', '2019', 'ADDED NEW GENERAL GROUP', 'Successful addition of general group OTHER CATEGORIES.'),
(11, 3, '12:05:55', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group LARGE APPLIANCE.'),
(12, 3, '12:05:01', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group COOKING APPLIANCE.'),
(13, 3, '12:05:20', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group KITCHEN AND DINNING.'),
(14, 3, '12:05:26', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group FURNITIURE.'),
(15, 3, '12:05:41', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group BEDDING.'),
(16, 3, '12:05:46', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group BATH.'),
(17, 3, '12:05:53', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group HOME PRODUCTS.'),
(18, 3, '12:05:21', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group LARGE APPLIANCE.'),
(19, 3, '12:05:25', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group COOKING APPLIANCE.'),
(20, 3, '12:05:29', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group KITCHEN AND DINNING.'),
(21, 3, '12:05:33', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group FURNITIURE.'),
(22, 3, '12:05:38', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group BEDDING.'),
(23, 3, '12:05:42', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group BATH.'),
(24, 3, '12:05:46', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group HOME PRODUCTS.'),
(25, 3, '12:05:14', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group TELEVISIONS.'),
(26, 3, '12:05:24', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group KITCHEN APPLIANCES.'),
(27, 3, '12:05:42', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group TV ACCESSORIES.'),
(28, 3, '12:05:10', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group FRAGRANCE.'),
(29, 3, '12:05:17', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group MAKE UP.'),
(30, 3, '12:05:30', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group MENS GROOMING.'),
(31, 3, '12:05:48', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group SKIN CARE.'),
(32, 3, '12:05:54', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group HAIR CARE.'),
(33, 3, '12:05:33', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group FOOD CUPBOARD.'),
(34, 3, '12:05:38', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group DRINKS.'),
(35, 3, '13:05:11', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group TELEVISIONS.'),
(36, 3, '13:05:16', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group KITCHEN APPLIANCES.'),
(37, 3, '13:05:21', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group TV ACCESSORIES.'),
(38, 3, '13:05:26', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group FRAGRANCE.'),
(39, 3, '13:05:30', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group MAKE UP.'),
(40, 3, '13:05:34', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group MENS GROOMING.'),
(41, 3, '13:05:39', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group SKIN CARE.'),
(42, 3, '13:05:44', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group HAIR CARE.'),
(43, 3, '13:05:49', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group FOOD CUPBOARD.'),
(44, 3, '13:05:53', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group DRINKS.'),
(45, 3, '13:05:19', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group SOFTWARES.'),
(46, 3, '13:05:28', '20/05/2019', '20', '05', '2019', 'ADDED NEW CATEGORY GROUP', 'Successful addition of category group PRINTERS AND ACCESSORIES.'),
(47, 3, '13:05:47', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group SOFTWARES.'),
(48, 3, '13:05:53', '20/05/2019', '20', '05', '2019', 'MODIFIED CATEGORY GROUP', 'Successful modification of categrory group PRINTERS AND ACCESSORIES.'),
(49, 3, '13:05:16', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group Two in one laptops.'),
(50, 3, '13:05:00', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group EXTERNAL HARD DRIVES.'),
(51, 3, '13:05:06', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group USB DRIVES.'),
(52, 3, '13:05:25', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group MEMORY DRIVES.'),
(53, 3, '13:05:34', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group SOLID STATE DRIVES.'),
(54, 3, '13:05:09', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group KEYBOARDS.'),
(55, 3, '13:05:14', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group MOUSE.'),
(56, 3, '13:05:35', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group MONITORS.'),
(57, 3, '13:05:07', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group LAPTOP BAGS.'),
(58, 3, '13:05:22', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group DESKTOP ACESSORIESS.'),
(59, 3, '13:05:59', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group WEBCAMS.'),
(60, 3, '13:05:29', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group ANTIVIRUS AND SECURITY.'),
(61, 3, '13:05:50', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group Two in one laptops data .'),
(62, 3, '13:05:05', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group EXTERNAL HARD DRIVES data .'),
(63, 3, '13:05:14', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group USB DRIVES data .'),
(64, 3, '13:05:20', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group MEMORY DRIVES data .'),
(65, 3, '13:05:27', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group SOLID STATE DRIVES data .'),
(66, 3, '13:05:33', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group KEYBOARDS data .'),
(67, 3, '13:05:38', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group MOUSE data .'),
(68, 3, '13:05:47', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group MONITORS data .'),
(69, 3, '13:05:51', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group LAPTOP BAGS data .'),
(70, 3, '13:05:57', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group DESKTOP ACESSORIESS data .'),
(71, 3, '13:05:03', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group ANTIVIRUS AND SECURITY data .'),
(72, 3, '13:05:09', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group WEBCAMS data .'),
(73, 3, '13:05:32', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product HUAWEI 5Y11.'),
(74, 3, '13:05:51', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product NOKIA N13.'),
(75, 3, '13:05:16', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product NOKIA C110.'),
(76, 3, '13:05:15', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product CURVED KEYBOARDS.'),
(77, 3, '13:05:34', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product HP KEYBOARDS.'),
(78, 3, '13:05:24', '20/05/2019', '20', '05', '2019', 'ADDED NEW BRAND GROUP', 'Successful addition of brand group SANDISK.'),
(79, 3, '13:05:43', '20/05/2019', '20', '05', '2019', 'MODIFIED BRAND GROUP', 'Successful modification of brand group SANDISK.'),
(80, 3, '14:05:49', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product SANDISK USB 4GB.'),
(81, 3, '14:05:27', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product SAMSUNG USB 8GB.'),
(82, 3, '14:05:12', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product SANDISK USB 32GB.'),
(83, 3, '14:05:19', '20/05/2019', '20', '05', '2019', 'MODIFIED PRODUCT SANDISK USB 4GB', 'Successful modificaion of product SANDISK USB 4GB. data'),
(84, 3, '14:05:03', '20/05/2019', '20', '05', '2019', 'ADDED NEW BRAND GROUP', 'Successful addition of brand group TOYOTA.'),
(85, 3, '14:05:09', '20/05/2019', '20', '05', '2019', 'ADDED NEW BRAND GROUP', 'Successful addition of brand group NISSAN.'),
(86, 3, '14:05:23', '20/05/2019', '20', '05', '2019', 'ADDED NEW BRAND GROUP', 'Successful addition of brand group MITSUBISHI.'),
(87, 3, '14:05:31', '20/05/2019', '20', '05', '2019', 'ADDED NEW BRAND GROUP', 'Successful addition of brand group SCANIA.'),
(88, 3, '14:05:07', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group SMART TVS.'),
(89, 3, '14:05:13', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group CURVED TVS.'),
(90, 3, '14:05:28', '20/05/2019', '20', '05', '2019', 'ADDED NEW SPECIFIC GROUP', 'Successful addition of specific group LCD AND CRT TVS.'),
(91, 3, '14:05:43', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group SMART TVS data .'),
(92, 3, '14:05:50', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group CURVED TVS data .'),
(93, 3, '14:05:57', '20/05/2019', '20', '05', '2019', 'MODIFIED SPECIFIC GROUP', 'Successful modification of specific group LCD AND CRT TVS data .'),
(94, 3, '14:05:36', '20/05/2019', '20', '05', '2019', 'ADDED NEW BRAND GROUP', 'Successful addition of brand group TAUSDA.'),
(95, 3, '14:05:41', '20/05/2019', '20', '05', '2019', 'ADDED NEW BRAND GROUP', 'Successful addition of brand group LG.'),
(96, 3, '14:05:53', '20/05/2019', '20', '05', '2019', 'ADDED NEW BRAND GROUP', 'Successful addition of brand group SAMSUNG.'),
(97, 3, '14:05:01', '20/05/2019', '20', '05', '2019', 'ADDED NEW BRAND GROUP', 'Successful addition of brand group RAMTONS.'),
(98, 3, '14:05:16', '20/05/2019', '20', '05', '2019', 'MODIFIED BRAND GROUP', 'Successful modification of brand group TAUSDA.'),
(99, 3, '14:05:26', '20/05/2019', '20', '05', '2019', 'MODIFIED BRAND GROUP', 'Successful modification of brand group LG.'),
(100, 3, '14:05:55', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product LG 24INCH.'),
(101, 3, '14:05:13', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product LG 26INCH.'),
(102, 3, '14:05:47', '20/05/2019', '20', '05', '2019', 'ADDED NEW PRODUCT', 'Successful addition of product TAUSDA 21 INCH.'),
(103, 3, '14:05:36', '20/05/2019', '20', '05', '2019', 'ADDED A PICTURE FOR PRODUCT TAUSDA 21 INCH', 'Successful additon of a picture for product TAUSDA 21 INCH. '),
(104, 3, '14:05:40', '20/05/2019', '20', '05', '2019', 'SET WEB PICTURE FOR PRODUCT TAUSDA 21 INCH', 'Successful setting of a web picture for product TAUSDA 21 INCH. '),
(105, 3, '12:05:54', '24/05/2019', '24', '05', '2019', 'LOG IN', 'Successful login into adminitstration panel.');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminId` int(255) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `level` varchar(35) DEFAULT NULL,
  `image` varchar(40) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `name`, `email`, `phone`, `password`, `level`, `image`, `status`) VALUES
(2, 'Collins', 'collinsmundia2001@gmail.com', '0704219247', 'collinsmundia2001@gmail.com', 'Admin', '837d09237963426a4dd023e4054bdef5.png', 1),
(3, 'Kelvin', 'kevokario@gmail.com', '0704219247', '12345', 'Super Admin', '180198d40f95de97abb3a89df307a52b.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int(255) NOT NULL,
  `majorId` int(255) DEFAULT NULL,
  `brandName` varchar(45) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `keyName` varchar(100) DEFAULT NULL,
  `brandPic` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandId`, `majorId`, `brandName`, `status`, `keyName`, `brandPic`) VALUES
(1, 1, 'SAMSUNG', 1, '1SAMSUNG', '6ed9d3613b4f275bfd2493b10348f04c.png'),
(2, 1, 'TECNO', 1, '1TECNO', '390864f396862f14bb587ba421b80af4.png'),
(3, 1, 'NOKIA', 1, '1NOKIA', '6aa7831a069ffbffa39e171b826c36ce.png'),
(4, 1, 'HUAWEI', 1, '1HUAWEI', '4ce626bb177922c6e66aae01ca54913b.png'),
(5, 2, 'HP', 1, '2HP', 'd5fe2ed1bd4a0ebc5e79cebcc9ff5872.png'),
(6, 2, 'DELL', 1, '2DELL', '1380e9e9603528bffb293476f2a18d54.png'),
(7, 2, 'TOSHIBA', 1, '2TOSHIBA', '65653f65d2583144e67029320ebc6ab4.png'),
(8, 2, 'LENOVO', 1, '2LENOVO', '87e30126c93879e0e70e89d59e7cf9be.png'),
(9, 2, 'SAMSUNG', 1, '2SAMSUNG', 'e0f53ffc600694982147d9f6e755fb57.png'),
(10, 2, 'SANDISK', 1, '2SANDISK', 'b28e3bd66676be3412ac16fc8dac04e4.png'),
(11, 9, 'TOYOTA', 0, '9TOYOTA', 'a69fcbd438c2b48e90ef70f083828504.png'),
(12, 9, 'NISSAN', 0, '9NISSAN', 'a960ae4cc0b795f473c7914ca88a9186.png'),
(13, 9, 'MITSUBISHI', 0, '9MITSUBISHI', 'c31f9bdd5215a49ace786ab5c497edc8.png'),
(14, 9, 'SCANIA', 0, '9SCANIA', '101b7f4c6a4eda5a1195a91833b33990.png'),
(15, 3, 'TAUSDA', 1, '3TAUSDA', '11dec201c94271db9af5e383c30c836d.png'),
(16, 3, 'LG', 1, '3LG', 'b7766953ba287f42a3af82a385e6502b.png'),
(17, 3, 'SAMSUNG', 0, '3SAMSUNG', '3631fcb47341a4f889e0485f3cc7bda4.png'),
(18, 3, 'RAMTONS', 0, '3RAMTONS', '338fb19d0583a493ae3c2ff3c5e899c8.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(255) NOT NULL,
  `majorId` int(255) DEFAULT NULL,
  `catName` varchar(70) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `majorId`, `catName`, `status`) VALUES
(1, 1, 'MOBILE PHONES', 1),
(2, 1, 'TABLETS', 1),
(3, 1, 'HEADPHONES', 1),
(4, 2, 'LAPTOPS', 1),
(5, 2, 'DATA STORAGE', 1),
(6, 2, 'COMPUTER ACCESSORIES', 1),
(7, 4, 'LARGE APPLIANCE', 1),
(8, 4, 'COOKING APPLIANCE', 1),
(9, 4, 'KITCHEN AND DINNING', 1),
(10, 4, 'FURNITIURE', 1),
(11, 4, 'BEDDING', 1),
(12, 4, 'BATH', 1),
(13, 4, 'HOME PRODUCTS', 1),
(14, 3, 'TELEVISIONS', 1),
(15, 3, 'KITCHEN APPLIANCES', 1),
(16, 3, 'TV ACCESSORIES', 1),
(17, 5, 'FRAGRANCE', 1),
(18, 5, 'MAKE UP', 1),
(19, 5, 'MENS GROOMING', 1),
(20, 5, 'SKIN CARE', 1),
(21, 5, 'HAIR CARE', 1),
(22, 6, 'FOOD CUPBOARD', 1),
(23, 6, 'DRINKS', 1),
(24, 2, 'SOFTWARES', 1),
(25, 2, 'PRINTERS AND ACCESSORIES', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientaddress`
--

CREATE TABLE `clientaddress` (
  `addressId` int(255) NOT NULL,
  `clientId` int(255) DEFAULT NULL,
  `constId` int(255) DEFAULT NULL,
  `fName` varchar(60) DEFAULT NULL,
  `lName` varchar(60) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `addressDetails` varchar(2000) DEFAULT NULL,
  `addressType` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clientaddress`
--

INSERT INTO `clientaddress` (`addressId`, `clientId`, `constId`, `fName`, `lName`, `phone`, `addressDetails`, `addressType`) VALUES
(2, 2, 1, 'peter', 'wanjohi', '0734567886', 'kikuyu police', 'doorstep'),
(3, 1, 1, 'Welcome', 'Home', '0704219247', 'From kikuyu pretrol station, drive/walk/ride 500m along the bypass past kikuyu town, into denderu. Then by now you have realised that i have no idea of what the place looks like and this is a demo description. Thank you for your time.', 'doorstep');

-- --------------------------------------------------------

--
-- Table structure for table `clientorders`
--

CREATE TABLE `clientorders` (
  `orderId` int(255) NOT NULL,
  `addressId` int(255) DEFAULT NULL,
  `orderNumber` varchar(70) DEFAULT NULL,
  `orderItems` text,
  `orderAmount` varchar(20) DEFAULT NULL,
  `itemCount` varchar(20) NOT NULL,
  `time` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `month` varchar(3) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `phone`, `email`, `password`, `status`) VALUES
(1, '0704219247', 'kevokario@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(2, '0724051714', 'pwpinches@gmail.com', '51dc30ddc473d43a6011e9ebba6ca770', 1);

-- --------------------------------------------------------

--
-- Table structure for table `constituency`
--

CREATE TABLE `constituency` (
  `constId` int(255) NOT NULL,
  `conId` int(255) DEFAULT NULL,
  `constName` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `constituency`
--

INSERT INTO `constituency` (`constId`, `conId`, `constName`, `status`) VALUES
(1, 1, 'kikuyu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `contId` int(255) NOT NULL,
  `contName` varchar(200) DEFAULT NULL,
  `code` varchar(8) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`contId`, `contName`, `code`, `status`) VALUES
(1, 'Kenya', ' 254', 1);

-- --------------------------------------------------------

--
-- Table structure for table `county`
--

CREATE TABLE `county` (
  `conId` int(255) NOT NULL,
  `contId` int(255) DEFAULT NULL,
  `conName` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `county`
--

INSERT INTO `county` (`conId`, `contId`, `conName`, `status`) VALUES
(1, 1, 'kiambu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `featurescomps`
--

CREATE TABLE `featurescomps` (
  `featureId` int(255) NOT NULL,
  `itemId` int(255) DEFAULT NULL,
  `ram` varchar(10) DEFAULT NULL,
  `rom` varchar(20) DEFAULT NULL,
  `displaySize` varchar(20) DEFAULT NULL,
  `operatingSystem` varchar(20) DEFAULT NULL,
  `processor` varchar(140) DEFAULT NULL,
  `simslot` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `featurescomps`
--

INSERT INTO `featurescomps` (`featureId`, `itemId`, `ram`, `rom`, `displaySize`, `operatingSystem`, `processor`, `simslot`) VALUES
(1, 1, '6gb', '580gb', '11', 'linux mint 19 tara', '2.5ghz', '0');

-- --------------------------------------------------------

--
-- Table structure for table `itemfeatures`
--

CREATE TABLE `itemfeatures` (
  `featureId` int(255) NOT NULL,
  `itemId` int(255) DEFAULT NULL,
  `keyFeatures` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemfeatures`
--

INSERT INTO `itemfeatures` (`featureId`, `itemId`, `keyFeatures`) VALUES
(1, 1, 'color red'),
(2, 1, '3 usb ports'),
(3, 1, 'front camera'),
(4, 1, 'comes with a free backpack');

-- --------------------------------------------------------

--
-- Table structure for table `itemimages`
--

CREATE TABLE `itemimages` (
  `imageId` int(255) NOT NULL,
  `itemId` int(255) DEFAULT NULL,
  `imageName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemimages`
--

INSERT INTO `itemimages` (`imageId`, `itemId`, `imageName`) VALUES
(1, 1, 'dc49a0e4ea2086f4c17ff5fc1937c1cd.jpg'),
(2, 13, '1ce1ea878a38119f2d4cb9bc6f2d8f9f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `itemlog`
--

CREATE TABLE `itemlog` (
  `logId` int(255) NOT NULL,
  `adminId` int(255) DEFAULT NULL,
  `itemId` int(255) DEFAULT NULL,
  `time` varchar(25) DEFAULT NULL,
  `date` varchar(25) DEFAULT NULL,
  `month` varchar(3) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `event` varchar(700) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(255) NOT NULL,
  `minorId` int(255) DEFAULT NULL,
  `itemName` varchar(70) DEFAULT NULL,
  `itemPic` varchar(100) DEFAULT NULL,
  `newPrice` int(100) DEFAULT NULL,
  `oldPrice` int(100) DEFAULT NULL,
  `brandId` int(255) DEFAULT NULL,
  `itemQuantity` varchar(100) DEFAULT NULL,
  `itemRating` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `minorId`, `itemName`, `itemPic`, `newPrice`, `oldPrice`, `brandId`, `itemQuantity`, `itemRating`, `status`) VALUES
(1, 4, 'hp elite book 2560p', '88fbefac6ec4639944de5bd4d3a15aa8.jpg', 23000, 27000, 5, '14', '0', 1),
(2, 4, 'hp elite book 2561p', 'fffb3c79358adf71e00232ceaa328a95.jpg', 22000, 27500, 5, '13', '0', 1),
(3, 1, 'HUAWEI 5Y11', '8f3a2218af8c7616f6516e38bbfd30b5.png', 4300, 4700, 4, '0', '0', 1),
(4, 1, 'NOKIA N13', '11f7c33694e01ade4c67b4b2cd6cd40a.png', 12500, 15700, 3, '0', '0', 1),
(5, 2, 'NOKIA C110', '80066bec71b5b4ddb42e3337e4575f42.jpeg', 3500, 4200, 3, '0', '0', 1),
(6, 12, 'CURVED KEYBOARDS', '7d02c76ddec1e9a05fe4aa20fccee32b.jpeg', 3500, 4200, 5, '0', '0', 1),
(7, 12, 'HP KEYBOARDS', '32f8fd48bb1face600703576073497e1.jpeg', 3500, 4200, 5, '0', '0', 1),
(8, 9, 'SANDISK USB 4GB', 'cb373d5bfe48e8c3b9368b2654e36762.png', 450, 600, 10, '0', '0', 1),
(9, 9, 'SAMSUNG USB 8GB', 'd919f7402501d12f61b5e43e2812cc5c.png', 450, 600, 9, '0', '0', 1),
(10, 10, 'SANDISK USB 32GB', 'ac97a1e7fe91db285de23c5aa60706f1.png', 1400, 1800, 10, '0', '0', 1),
(11, 19, 'LG 24INCH', 'dd85e83fd536791a941f6ecf8f0cdde6.jpg', 8700, 9500, 16, '0', '0', 1),
(12, 19, 'LG 26INCH', '80bb0c9dd240515f7521069dc85cc11b.jpg', 8700, 9500, 16, '0', '0', 1),
(13, 19, 'TAUSDA 21 INCH', '46c5a247e3e0921956a47996771c2a39.jpg', 8700, 9500, 15, '0', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `majorcategory`
--

CREATE TABLE `majorcategory` (
  `majorId` int(255) NOT NULL,
  `majorName` varchar(70) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `majorcategory`
--

INSERT INTO `majorcategory` (`majorId`, `majorName`, `status`) VALUES
(1, 'PHONES AND TABLETS', 1),
(2, 'COMPUTING', 1),
(3, 'ELECTRONICS', 1),
(4, 'HOME AND OFFICE', 1),
(5, 'HEALTH AND BEAUTY', 1),
(6, 'GROCERY', 1),
(7, 'BABY PRODUCTS', 1),
(8, 'FASHION', 1),
(9, 'AUTOMOBILE', 1),
(10, 'GAMING', 1),
(11, 'OTHER CATEGORIES', 1);

-- --------------------------------------------------------

--
-- Table structure for table `minorcategory`
--

CREATE TABLE `minorcategory` (
  `minorId` int(255) NOT NULL,
  `catId` int(255) DEFAULT NULL,
  `minorName` varchar(70) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `minorcategory`
--

INSERT INTO `minorcategory` (`minorId`, `catId`, `minorName`, `status`) VALUES
(1, 1, 'ANDROID PHONES', 1),
(2, 1, 'CELL PHONES', 1),
(3, 1, 'IOS PHONES', 1),
(4, 4, 'NET BOOKS', 1),
(5, 4, 'NOTE BOOKS', 1),
(6, 4, 'ULTRA BOOKS', 1),
(7, 4, 'Two in one laptops', 1),
(8, 5, 'EXTERNAL HARD DRIVES', 1),
(9, 5, 'USB DRIVES', 1),
(10, 5, 'MEMORY DRIVES', 1),
(11, 5, 'SOLID STATE DRIVES', 1),
(12, 6, 'KEYBOARDS', 1),
(13, 6, 'MOUSE', 1),
(14, 6, 'MONITORS', 1),
(15, 6, 'LAPTOP BAGS', 1),
(16, 6, 'DESKTOP ACESSORIESS', 1),
(17, 6, 'WEBCAMS', 1),
(18, 24, 'ANTIVIRUS AND SECURITY', 1),
(19, 14, 'SMART TVS', 1),
(20, 14, 'CURVED TVS', 1),
(21, 14, 'LCD AND CRT TVS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `month` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`month`) VALUES
('05');

-- --------------------------------------------------------

--
-- Table structure for table `mpesadetails`
--

CREATE TABLE `mpesadetails` (
  `mpesaId` int(255) NOT NULL,
  `TransactionType` varchar(40) DEFAULT NULL,
  `TransID` varchar(40) DEFAULT NULL,
  `TransTime` varchar(50) DEFAULT NULL,
  `TransAmount` varchar(40) DEFAULT NULL,
  `BusinessShortCode` varchar(40) DEFAULT NULL,
  `BillRefNumber` varchar(40) DEFAULT NULL,
  `InvoiceNumber` varchar(20) DEFAULT NULL,
  `OrgAccountBalance` varchar(20) DEFAULT NULL,
  `ThirdPartyTransID` varchar(40) DEFAULT NULL,
  `MSISDN` varchar(15) DEFAULT NULL,
  `FirstName` varchar(20) DEFAULT NULL,
  `MiddleName` varchar(20) DEFAULT NULL,
  `LastName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentId` int(255) NOT NULL,
  `orderId` int(255) DEFAULT NULL,
  `mpesaId` int(255) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `month` varchar(3) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pickuppoints`
--

CREATE TABLE `pickuppoints` (
  `pickupId` int(255) NOT NULL,
  `constId` int(255) DEFAULT NULL,
  `pickupAddress` varchar(70) DEFAULT NULL,
  `pickupDescription` varchar(5000) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pickuppoints`
--

INSERT INTO `pickuppoints` (`pickupId`, `constId`, `pickupAddress`, `pickupDescription`, `status`) VALUES
(1, 1, 'Jacmil Mega Plaza', 'From Jacmkil, this is some descriptiove text to direct us how to deliver our products to you', 1);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `recordId` int(255) NOT NULL,
  `itemId` int(255) DEFAULT NULL,
  `clientId` int(255) DEFAULT NULL,
  `time` varchar(25) DEFAULT NULL,
  `date` varchar(25) DEFAULT NULL,
  `day` varchar(25) DEFAULT NULL,
  `month` varchar(3) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `itemQuantity` varchar(255) DEFAULT NULL,
  `price` varchar(200) DEFAULT NULL,
  `modeOfPurchase` varchar(200) DEFAULT NULL,
  `transactionCode` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`year`) VALUES
(2019);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlog`
--
ALTER TABLE `adminlog`
  ADD PRIMARY KEY (`logId`),
  ADD KEY `adminId` (`adminId`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandId`),
  ADD KEY `majorId` (`majorId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`),
  ADD KEY `majorId` (`majorId`);

--
-- Indexes for table `clientaddress`
--
ALTER TABLE `clientaddress`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `clientId` (`clientId`),
  ADD KEY `constId` (`constId`);

--
-- Indexes for table `clientorders`
--
ALTER TABLE `clientorders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `addressId` (`addressId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `constituency`
--
ALTER TABLE `constituency`
  ADD PRIMARY KEY (`constId`),
  ADD KEY `conId` (`conId`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`contId`);

--
-- Indexes for table `county`
--
ALTER TABLE `county`
  ADD PRIMARY KEY (`conId`),
  ADD KEY `contId` (`contId`);

--
-- Indexes for table `featurescomps`
--
ALTER TABLE `featurescomps`
  ADD PRIMARY KEY (`featureId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indexes for table `itemfeatures`
--
ALTER TABLE `itemfeatures`
  ADD PRIMARY KEY (`featureId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indexes for table `itemimages`
--
ALTER TABLE `itemimages`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indexes for table `itemlog`
--
ALTER TABLE `itemlog`
  ADD PRIMARY KEY (`logId`),
  ADD KEY `adminId` (`adminId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `minorId` (`minorId`),
  ADD KEY `brandId` (`brandId`);

--
-- Indexes for table `majorcategory`
--
ALTER TABLE `majorcategory`
  ADD PRIMARY KEY (`majorId`);

--
-- Indexes for table `minorcategory`
--
ALTER TABLE `minorcategory`
  ADD PRIMARY KEY (`minorId`),
  ADD KEY `catId` (`catId`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`month`);

--
-- Indexes for table `mpesadetails`
--
ALTER TABLE `mpesadetails`
  ADD PRIMARY KEY (`mpesaId`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `mpesaId` (`mpesaId`);

--
-- Indexes for table `pickuppoints`
--
ALTER TABLE `pickuppoints`
  ADD PRIMARY KEY (`pickupId`),
  ADD KEY `constId` (`constId`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`recordId`),
  ADD KEY `clientId` (`clientId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlog`
--
ALTER TABLE `adminlog`
  MODIFY `logId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `clientaddress`
--
ALTER TABLE `clientaddress`
  MODIFY `addressId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clientorders`
--
ALTER TABLE `clientorders`
  MODIFY `orderId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `constituency`
--
ALTER TABLE `constituency`
  MODIFY `constId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `contId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `county`
--
ALTER TABLE `county`
  MODIFY `conId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `featurescomps`
--
ALTER TABLE `featurescomps`
  MODIFY `featureId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `itemfeatures`
--
ALTER TABLE `itemfeatures`
  MODIFY `featureId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `itemimages`
--
ALTER TABLE `itemimages`
  MODIFY `imageId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itemlog`
--
ALTER TABLE `itemlog`
  MODIFY `logId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `majorcategory`
--
ALTER TABLE `majorcategory`
  MODIFY `majorId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `minorcategory`
--
ALTER TABLE `minorcategory`
  MODIFY `minorId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mpesadetails`
--
ALTER TABLE `mpesadetails`
  MODIFY `mpesaId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickuppoints`
--
ALTER TABLE `pickuppoints`
  MODIFY `pickupId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `recordId` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminlog`
--
ALTER TABLE `adminlog`
  ADD CONSTRAINT `adminlog_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admins` (`adminId`) ON UPDATE CASCADE;

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`majorId`) REFERENCES `majorcategory` (`majorId`) ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`majorId`) REFERENCES `majorcategory` (`majorId`) ON UPDATE CASCADE;

--
-- Constraints for table `clientaddress`
--
ALTER TABLE `clientaddress`
  ADD CONSTRAINT `clientaddress_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `clientaddress_ibfk_2` FOREIGN KEY (`constId`) REFERENCES `constituency` (`constId`) ON UPDATE CASCADE;

--
-- Constraints for table `clientorders`
--
ALTER TABLE `clientorders`
  ADD CONSTRAINT `clientorders_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `clientaddress` (`addressId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `clientorders_ibfk_2` FOREIGN KEY (`addressId`) REFERENCES `clientaddress` (`addressId`) ON UPDATE CASCADE;

--
-- Constraints for table `constituency`
--
ALTER TABLE `constituency`
  ADD CONSTRAINT `constituency_ibfk_1` FOREIGN KEY (`conId`) REFERENCES `county` (`conId`) ON UPDATE CASCADE;

--
-- Constraints for table `county`
--
ALTER TABLE `county`
  ADD CONSTRAINT `county_ibfk_1` FOREIGN KEY (`contId`) REFERENCES `country` (`contId`) ON UPDATE CASCADE;

--
-- Constraints for table `featurescomps`
--
ALTER TABLE `featurescomps`
  ADD CONSTRAINT `featurescomps_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`) ON UPDATE CASCADE;

--
-- Constraints for table `itemfeatures`
--
ALTER TABLE `itemfeatures`
  ADD CONSTRAINT `itemfeatures_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`) ON UPDATE CASCADE;

--
-- Constraints for table `itemimages`
--
ALTER TABLE `itemimages`
  ADD CONSTRAINT `itemimages_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`) ON UPDATE CASCADE;

--
-- Constraints for table `itemlog`
--
ALTER TABLE `itemlog`
  ADD CONSTRAINT `itemlog_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admins` (`adminId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `itemlog_ibfk_2` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`) ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`minorId`) REFERENCES `minorcategory` (`minorId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `brand` (`brandId`) ON UPDATE CASCADE;

--
-- Constraints for table `minorcategory`
--
ALTER TABLE `minorcategory`
  ADD CONSTRAINT `minorcategory_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `category` (`catId`) ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `clientorders` (`orderId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `clientorders` (`orderId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`mpesaId`) REFERENCES `mpesadetails` (`mpesaId`) ON UPDATE CASCADE;

--
-- Constraints for table `pickuppoints`
--
ALTER TABLE `pickuppoints`
  ADD CONSTRAINT `pickuppoints_ibfk_1` FOREIGN KEY (`constId`) REFERENCES `constituency` (`constId`) ON UPDATE CASCADE;

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `records_ibfk_2` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
