-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Feb 21, 2019 at 04:15 PM
-- Server version: 5.7.24
-- PHP Version: 7.1.23

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
  `action` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `image` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `name`, `email`, `phone`, `password`, `level`, `image`) VALUES
(1, 'Kelvin Kario', 'kevokario@gmail.com', '0704219247', '12345', 'Admin', 'nn'),
(2, 'Collins Mundia', 'Collo@gmail.com', '0704219247', 'Collo@gmail.com', 'Admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int(255) NOT NULL,
  `majorId` int(255) DEFAULT NULL,
  `brandName` varchar(45) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `keyName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandId`, `majorId`, `brandName`, `status`, `keyName`) VALUES
(1, 1, 'SAMSUNG', 1, '1SAMSUNG'),
(2, 1, 'TECNO', 1, '1TECNO'),
(3, 1, 'INFINIX', 1, '1INFINIX'),
(4, 2, 'LG', 1, '2LG'),
(5, 2, 'SAMSUNG', 1, '2SAMSUNG'),
(6, 2, 'TOSHIBA', 1, '2TOSHIBA'),
(7, 3, 'TOSHIBA', 1, '3TOSHIBA'),
(8, 3, 'HP', 1, '3HP'),
(9, 3, 'DELL', 1, '3DELL'),
(10, 3, 'LENOVO', 1, '3LENOVO'),
(11, 1, 'LENOVO', 1, '1LENOVO'),
(12, 2, 'RAMTONS', 1, '2RAMTONS'),
(13, 2, 'ELEKTA', 1, '2ELEKTA'),
(14, 2, 'TAUSDA', 1, '2TAUSDA'),
(15, 3, 'ACER', 1, '3ACER');

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
(1, 1, 'PHONES', 1),
(2, 1, 'TABLETS', 1),
(3, 1, 'PHONE ACCESSORIES', 1),
(4, 1, 'TABLET ACCESSORIES', 1),
(5, 2, 'TELEVISIONS', 1),
(6, 2, 'SPEAKERS AND SOUND SYSTEMS', 1),
(7, 2, 'TV WALL MOUNTS', 1),
(8, 2, 'PROJECTORS', 1),
(9, 2, 'PORTABLE AUDIO AND VIDEO', 1),
(10, 2, 'TELEVISION ACCESSORIES', 1),
(11, 3, 'LAPTOPS', 1),
(12, 3, 'COMPUTER DATA STORAGE', 1),
(13, 3, 'COMPUTER ACCESSORIES', 1),
(14, 3, 'PRINTERS AND ACCESSORIES', 1),
(15, 3, 'SOFTWARE', 1),
(16, 4, 'LARGE APPLIANCES', 1),
(17, 4, 'SMALL APPLIANCES', 1),
(18, 4, 'HOME DECOR', 1),
(19, 4, 'COOKING APPLIANCES', 1),
(20, 4, 'KITCHEN AND DINNING', 1),
(21, 4, 'BATH', 1),
(22, 4, 'FURNITURE', 1),
(23, 4, 'BEDDING', 1),
(24, 4, 'OFFICE PRODUCTS', 1),
(25, 4, 'EVENT AND PARTY', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(255) NOT NULL,
  `fName` varchar(60) DEFAULT NULL,
  `lName` varchar(60) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `operatingSystem` varchar(70) DEFAULT NULL,
  `processor` varchar(14) DEFAULT NULL,
  `simslot` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `featurescomps`
--

INSERT INTO `featurescomps` (`featureId`, `itemId`, `ram`, `rom`, `displaySize`, `operatingSystem`, `processor`, `simslot`) VALUES
(1, 1, '84GB', '500GB', '11.0', 'WINDOWS 7 ULTIMATE X64', '2.5GHZ', '1'),
(2, 16, '1GB', '250GB', '11.0', 'WINDOWS', '1.3GHZ', '0');

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
(6, 1, 'USB PORTS : 3'),
(7, 1, 'SATA PORTS : 1'),
(8, 1, 'VGA PORTS : 1'),
(9, 1, 'EARPHONE AND HEADSET PORT : 1'),
(10, 1, 'CAMERA INSTALLED : 1'),
(11, 1, 'LED KEYBOARD : 1'),
(12, 1, 'Wifi chips : 2'),
(13, 1, 'RAM EXPANSION SLOTS : 2'),
(14, 2, 'COLOR : RED'),
(15, 2, 'COLOR : BLUE'),
(16, 5, 'color : black'),
(17, 5, 'complete separate number pad'),
(18, 1, 'USB PORTS : 3'),
(19, 1, 'USB PORTS : 3');

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
(8, 13, 'fe9aef4934f81a399558d2901d11347c.jpeg'),
(25, 2, '8bbfa40384b6b385decf6a05cb05696d.jpeg'),
(26, 2, '6e590a75a6663fdaa4960b8b85ca5e85.jpeg'),
(31, 1, '7fd6561e1661de2822d0b6e6a7769d7d.jpeg'),
(32, 1, 'f386868c078f64100e4f9bfb108734f0.png'),
(33, 4, 'f5942461275aaf42b10c561347aec84d.jpg'),
(34, 15, 'b9684b58a288710db0f8ee62a762d39d.jpeg'),
(35, 5, 'd705fc19aca4c2f6ed5c5b9ad2eaea44.jpeg'),
(36, 5, '62cfb0733a5b7955ddb62f83672ab32e.jpeg'),
(37, 5, 'e8325a831200ffeaee527ed9083ece4e.jpeg'),
(38, 5, 'c92d94219efa3be2ad523973b21d8689.jpg'),
(39, 5, '9abc33435d8f587cb0517922fe813c5b.jpeg'),
(40, 16, '03ae97f618f4720ef69f81b8834506f5.jpeg'),
(42, 1, '722f19aedb513f4b20e9fd249333c48e.jpg'),
(43, 1, 'ae848a0c9ca7174744c576be7fb775fb.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(255) NOT NULL,
  `minorId` int(255) DEFAULT NULL,
  `itemName` varchar(70) DEFAULT NULL,
  `itemPic` varchar(100) DEFAULT NULL,
  `newPrice` varchar(100) DEFAULT NULL,
  `oldPrice` varchar(100) DEFAULT NULL,
  `brandId` int(255) DEFAULT NULL,
  `itemQuantity` varchar(100) DEFAULT NULL,
  `itemRating` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `minorId`, `itemName`, `itemPic`, `newPrice`, `oldPrice`, `brandId`, `itemQuantity`, `itemRating`, `status`) VALUES
(1, 15, 'HP ELITE BOOK 2560P', '174c31c973a9862841651fe7094384ac.jpg', '28000', '28000', 8, '0', '0', 1),
(2, 15, 'HP ELITE BOOK 2562P', '217818292d81fb882bc224500fb0cf22.jpeg', '23000', '2300', 8, '0', '0', 1),
(4, 15, 'HP ELITE BOOK 2563P', '252ebae3d3525411177b7e6ae3059fd6.png', '2300', '2300', 8, '0', '0', 1),
(5, 20, 'CURVED KEYBOARD DESIGNS', 'd705fc19aca4c2f6ed5c5b9ad2eaea44.jpeg', '2300', '2300', 8, '0', '0', 1),
(6, 15, 'ACER 123WER', 'c600f44f1f55cb7e86864d078927b0d1.jpg', '23400', '23400', 15, '0', '0', 1),
(10, 3, 'ORANGE CELL PHONE', '0e0777b02fbb8aeca1da1557f9bdcb18.jpeg', '1800', '1800', 5, '0', '0', 1),
(11, 15, 'PRO BOOK 2560P', 'ef3ed7708c3982f677cf153ded7a80e3.jpg', '23300', '23300', 8, '0', '0', 1),
(12, 19, 'JET MOUSE', '29a44616da64999b278ff3bd3bd4f21a.jpeg', '300', '300', 8, '0', '0', 1),
(13, 1, 'test', '89f35ba5fe258ffb6f3cab07d356d62b.png', '11', '11', 5, '0', '0', 0),
(14, 6, 'sdsd', '6973197e75a7b1ee5726821146f8a9a0.png', '12000', '12000', 4, '0', '0', 0),
(15, 22, 'MICROSOFT MOUSE', '5fd9c0cdb41b51edfa8d346333bc49cd.jpeg', '345', '345', 8, '0', '0', 0),
(16, 15, 'DELL ELITE BOOK 2560P', '03ae97f618f4720ef69f81b8834506f5.jpeg', '10000', '10000', 9, '0', '0', 1);

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
(2, 'ELECTRONICS', 1),
(3, 'COMPUTING', 1),
(4, 'HOME AND OFFICE', 1),
(5, 'HEALTH AND BEAUTY', 1),
(6, 'GROCERY', 1),
(7, 'BABY PRODUCTS', 1),
(8, 'FASHION', 1),
(9, 'SPORTING GOODS', 1),
(10, 'AUTOMOBILE', 1),
(11, 'GAMING', 1),
(12, 'OTHERS', 1);

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
(2, 1, 'IOS PHONES', 1),
(3, 1, 'CELL PHONES', 1),
(4, 2, 'iPads', 1),
(5, 2, 'Kids Tablets', 1),
(6, 5, 'Smart TVs', 1),
(7, 5, 'LCD and LED TVs', 1),
(8, 5, 'Curved TVs', 1),
(9, 10, 'TV Mount', 1),
(10, 10, 'HDMI Cables', 1),
(11, 10, 'TV Antenna', 1),
(12, 10, 'TV Stands', 1),
(13, 10, 'Remote Controls', 1),
(14, 11, 'MAC BOOKS', 1),
(15, 11, 'NET BOOKS', 1),
(16, 11, 'ULTRA BOOKS', 1),
(17, 11, 'TWO IN ONE LAPTOPS', 1),
(18, 13, 'WEBCAMS', 1),
(19, 13, 'DESKTOP ACCESSORIES', 1),
(20, 13, 'KEY BOARDS', 1),
(21, 13, 'LAPTOP BAGS', 1),
(22, 13, 'MOUSE', 1),
(23, 13, 'MONITORS', 1),
(24, 12, 'EXTERNAL HARD DRIVES', 1),
(25, 12, 'USB FLASH DRIVES', 1),
(26, 12, 'MEMORY CARDS', 1),
(27, 12, 'SOLID STATE DRIVES', 1);

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

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
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`recordId`),
  ADD KEY `clientId` (`clientId`),
  ADD KEY `itemId` (`itemId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlog`
--
ALTER TABLE `adminlog`
  MODIFY `logId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `featurescomps`
--
ALTER TABLE `featurescomps`
  MODIFY `featureId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itemfeatures`
--
ALTER TABLE `itemfeatures`
  MODIFY `featureId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `itemimages`
--
ALTER TABLE `itemimages`
  MODIFY `imageId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `majorcategory`
--
ALTER TABLE `majorcategory`
  MODIFY `majorId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `minorcategory`
--
ALTER TABLE `minorcategory`
  MODIFY `minorId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`majorId`) REFERENCES `majorcategory` (`majorId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `brand_ibfk_2` FOREIGN KEY (`majorId`) REFERENCES `majorcategory` (`majorId`) ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`majorId`) REFERENCES `majorcategory` (`majorId`) ON UPDATE CASCADE;

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
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `records_ibfk_2` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
