-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 05, 2022 at 10:28 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_dhruv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` bigint(24) NOT NULL,
  `firstName` varchar(56) DEFAULT NULL,
  `lastName` varchar(56) DEFAULT NULL,
  `email` varchar(56) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Dhruv', 'Prajapati', 'dhruv@gmail.com', '123', 1, '2022-02-10 09:26:00', '2022-03-09 08:03:45'),
(70, 'Dhruv', 'Prajapati', 'dhruvdhruv7254@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '2022-03-11 06:03:03', '2022-03-31 09:03:14'),
(90, 'Dhruv', 'Prajapati', 'dhruvdhruv7254@gmail.com', '202cb962ac59075b964b07152d234b70', 2, '2022-04-01 01:04:42', '2022-04-04 11:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` bigint(24) NOT NULL,
  `customerId` bigint(24) NOT NULL,
  `taxAmount` float(11,2) NOT NULL,
  `subTotal` float(11,2) NOT NULL DEFAULT 0.00,
  `discount` float(11,2) NOT NULL,
  `shippingMethod` int(11) DEFAULT NULL,
  `shippingCharge` float(11,2) DEFAULT NULL,
  `paymentMethod` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `cartAddressId` bigint(24) NOT NULL,
  `cartId` bigint(24) NOT NULL,
  `firstName` varchar(56) NOT NULL,
  `lastName` varchar(56) NOT NULL,
  `address` varchar(256) NOT NULL,
  `zipcode` int(7) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `billingAddress` tinyint(1) NOT NULL DEFAULT 2,
  `shipingAddress` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `itemId` bigint(24) NOT NULL,
  `cartId` bigint(24) NOT NULL,
  `productId` bigint(24) NOT NULL,
  `quantity` int(11) NOT NULL,
  `taxAmount` float(11,2) NOT NULL,
  `tax` float(11,2) NOT NULL,
  `itemTotal` float(11,2) NOT NULL,
  `discount` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` bigint(24) NOT NULL,
  `parentId` bigint(24) DEFAULT NULL,
  `name` varchar(56) DEFAULT NULL,
  `base` bigint(24) DEFAULT NULL,
  `thumb` bigint(24) DEFAULT NULL,
  `small` bigint(24) DEFAULT NULL,
  `path` varchar(160) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `createdDate` datetime DEFAULT current_timestamp(),
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parentId`, `name`, `base`, `thumb`, `small`, `path`, `status`, `createdDate`, `updatedDate`) VALUES
(33, NULL, 'Bedroom', NULL, NULL, NULL, '33', 1, '2022-02-10 08:02:27', NULL),
(52, 33, 'Bed', 1, 2, 5, '33/52', 1, '2022-02-15 06:02:54', '2022-03-09 08:03:31'),
(53, 52, 'King Bed', NULL, NULL, NULL, '33/52/53', 1, '2022-02-15 06:02:15', NULL),
(57, 52, 'Sleigh bed', NULL, NULL, NULL, '33/52/57', 1, '2022-02-15 06:02:50', NULL),
(58, 33, 'Dresser', NULL, NULL, NULL, '33/58', 1, '2022-02-15 06:02:09', NULL),
(62, NULL, 'Kitchen', NULL, NULL, NULL, '62', 1, '2022-02-15 06:02:58', NULL),
(63, 62, 'Chair', NULL, NULL, NULL, '62/63', 1, '2022-02-15 06:02:07', NULL),
(65, NULL, 'Livingroom', NULL, NULL, NULL, '65', 1, '2022-02-15 07:02:14', '2022-02-15 07:02:21'),
(91, NULL, 'Electronics', NULL, NULL, NULL, '91', 1, '2022-03-08 06:03:48', NULL),
(92, 91, 'Mobiles & Accessories', NULL, NULL, NULL, '91/92', 1, '2022-03-08 06:03:34', NULL),
(93, 92, 'Smartphones123', NULL, NULL, NULL, '91/92/93', 1, '2022-03-08 06:03:59', '2022-04-05 11:04:53'),
(124, NULL, 'Garden123', NULL, NULL, NULL, '124', 1, '2022-04-03 11:04:53', '2022-04-03 11:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `mediaId` bigint(24) NOT NULL,
  `categoryId` bigint(24) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gallery` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`mediaId`, `categoryId`, `name`, `gallery`) VALUES
(1, 52, 'bed120220227024016.jpeg', 1),
(2, 52, 'bed220220227024021.jpg', 1),
(5, 52, 'bed320220228051401.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entityId` bigint(24) NOT NULL,
  `categoryId` bigint(24) NOT NULL,
  `productId` bigint(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`entityId`, `categoryId`, `productId`) VALUES
(45, 91, 3),
(56, 91, 31),
(57, 92, 31),
(58, 93, 31);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` bigint(24) NOT NULL,
  `orderId` bigint(24) NOT NULL,
  `note` varchar(256) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `customerNotified` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `orderId`, `note`, `status`, `customerNotified`, `createdDate`) VALUES
(5, 28, 'Wait Bro', 1, 1, '2022-04-05 12:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` bigint(24) NOT NULL,
  `name` varchar(104) NOT NULL,
  `code` varchar(32) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `name`, `code`, `value`, `status`, `createdDate`) VALUES
(90, 'Config 1', 'Config1', 'Config 1', 1, '2022-04-05 11:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` bigint(24) NOT NULL,
  `firstName` varchar(56) DEFAULT NULL,
  `lastName` varchar(56) DEFAULT NULL,
  `email` varchar(56) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `salesmanId` bigint(24) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `email`, `mobile`, `salesmanId`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Dhruv165', 'Prajapati', 'dhruv123@gmail.com', 9879032378, 1, 1, '2022-02-03 00:00:00', '2022-04-05 11:59:33'),
(3, 'Dhruv12', 'Prajapati', 'dhruvdhruv7254@gmail.com', 7458632486, 1, 1, '2022-02-04 07:02:49', '2022-03-15 01:47:29'),
(87, 'Dhruv21', 'Prajapati', 'dhruvdhruv7254@gmail.com', 9879014253, NULL, 2, '2022-03-08 07:03:28', '2022-03-15 01:47:40'),
(95, 'Dhruv', 'Prajapati', 'dhruvdhruv7254@gmail.com', 9879012345, NULL, 2, '2022-03-09 05:03:17', '2022-03-15 10:39:30'),
(105, 'Temp Data', 'Temp Data', 'Temp Data', 1111, NULL, 2, '2022-03-16 09:03:37', '2022-03-19 09:46:17'),
(162, 'Dhruv', 'Prajapati', 'temp@gmail.com', 987, 4, 1, '2022-04-05 12:04:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` bigint(24) NOT NULL,
  `customerId` bigint(24) NOT NULL,
  `address` varchar(256) NOT NULL,
  `zipcode` int(7) DEFAULT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `billingAddress` tinyint(1) DEFAULT 2,
  `shipingAddress` tinyint(1) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `zipcode`, `city`, `state`, `country`, `billingAddress`, `shipingAddress`) VALUES
(3, 1, 'A/15, Morli Manohar Park Soc.,\r\nB/H Ajay Ten.-3, rabari Colony Cross Road, Amrai', 380026, 'AHMEDABAD', 'Gujarat', 'India', 2, 1),
(4, 3, 'Shri Ram', 380024, 'Karnavati', 'Gujarat', 'India', 1, 2),
(55, 87, 'A/15, Morli Manohar Park Soc.,\r\nB/H Ajay Ten.-3, rabari Colony Cross Road, Amrai', 380026, 'AHMEDABAD', 'Gujarat', 'India', 1, 2),
(63, 95, 'A/15, Morli Manohar Park Soc.,\r\nB/H Ajay Ten.-3, rabari Colony Cross Road, Amrai', 380026, 'AHMEDABAD', 'Gujarat', 'India', 2, 2),
(69, 95, 'A/30, Morli Manohar Park Soc.,\r\nB/H Ajay Ten.-3, rabari Colony Cross Road, Amrai', 380027, 'AHMEDABAD', 'Gujarat', 'India', 1, 2),
(70, 95, 'A/15, Morli Manohar Park Soc.,\r\nB/H Ajay Ten.-3, rabari Colony Cross Road, Amrai', 380027, 'AHMEDABAD', 'Gujarat', 'India', 2, 1),
(73, 3, 'Shri Ram', 380024, 'Karnavati', 'Gujarat', 'India', 2, 1),
(74, 87, 'A/15, Morli Manohar Park Soc.,\r\nB/H Ajay Ten.-3, rabari Colony Cross Road, Amrai', 380026, 'AHMEDABAD', 'Gujarat', 'India', 2, 1),
(76, 105, 'Billing', 222, 'Billing', 'Billing', 'Billing', 1, 2),
(77, 105, 'Shiping ', 2222, 'Shiping ', 'Shiping ', 'Shiping ', 2, 1),
(78, 1, 'A/15, Morli Manohar Park Soc.,\r\nB/H Ajay Ten.-3, rabari Colony Cross Road, Amrai', 380026, 'AHMEDABAD', 'Gujarat', 'India', 1, 2),
(173, 162, '', NULL, '', '', '', 1, 2),
(174, 162, '', NULL, '', '', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` bigint(24) NOT NULL,
  `customerId` bigint(24) NOT NULL,
  `productId` bigint(24) NOT NULL,
  `price` float(7,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`entityId`, `customerId`, `productId`, `price`) VALUES
(25, 87, 1, 100.00),
(26, 87, 2, 0.00),
(27, 87, 3, 0.00),
(28, 87, 31, 0.00),
(41, 95, 1, 999.99),
(42, 95, 2, 270.00),
(43, 95, 3, 135.00),
(44, 95, 31, 999.99),
(85, 3, 1, 35000.00),
(86, 3, 2, 300.00),
(87, 3, 3, 150.00),
(88, 3, 31, 80000.00),
(109, 1, 1, 35000.00),
(110, 1, 2, 300.00),
(111, 1, 3, 150.00),
(112, 1, 31, 80000.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `addressId` bigint(24) NOT NULL,
  `orderId` bigint(24) NOT NULL,
  `firstName` varchar(56) NOT NULL,
  `lastName` varchar(56) NOT NULL,
  `email` varchar(256) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `state` varchar(256) NOT NULL,
  `country` varchar(256) NOT NULL,
  `zipcode` bigint(7) NOT NULL,
  `billingAddress` tinyint(1) NOT NULL DEFAULT 2,
  `shipingAddress` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`addressId`, `orderId`, `firstName`, `lastName`, `email`, `mobile`, `address`, `city`, `state`, `country`, `zipcode`, `billingAddress`, `shipingAddress`, `createdDate`) VALUES
(49, 28, 'Temp Data Billing', 'Temp Data Billing', 'Temp Data', 1111, 'Billing Address', 'Billing', 'Billing', 'Billing', 222, 1, 2, '2022-04-05 12:12:34'),
(50, 28, 'Temp Data Shipping', 'Temp Data Shipping', 'Temp Data', 1111, 'Shipping Address', 'Shipping', 'Shipping', 'Shipping', 222, 2, 1, '2022-04-05 12:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `itemId` bigint(24) NOT NULL,
  `orderId` bigint(24) NOT NULL,
  `productId` bigint(24) NOT NULL,
  `name` varchar(256) NOT NULL,
  `sku` varchar(256) NOT NULL,
  `price` float(11,2) NOT NULL,
  `taxAmount` float(11,2) NOT NULL,
  `tax` float(11,2) NOT NULL,
  `discount` float(11,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`itemId`, `orderId`, `productId`, `name`, `sku`, `price`, `taxAmount`, `tax`, `discount`, `quantity`, `createdDate`) VALUES
(25, 28, 2, 'Keyboard', 'Keyboard', 600.00, 6.00, 1.00, 20.00, 2, '2022-04-05 12:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `order_record`
--

CREATE TABLE `order_record` (
  `orderId` bigint(24) NOT NULL,
  `customerId` bigint(24) NOT NULL,
  `firstName` varchar(56) NOT NULL,
  `lastName` varchar(56) NOT NULL,
  `email` varchar(56) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `taxAmount` float(11,2) NOT NULL,
  `grandTotal` float(11,2) NOT NULL,
  `discount` float(11,2) NOT NULL,
  `shippingId` bigint(24) NOT NULL,
  `shippingCharge` float(11,2) NOT NULL,
  `paymentId` bigint(24) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_record`
--

INSERT INTO `order_record` (`orderId`, `customerId`, `firstName`, `lastName`, `email`, `mobile`, `taxAmount`, `grandTotal`, `discount`, `shippingId`, `shippingCharge`, `paymentId`, `state`, `status`, `createdDate`) VALUES
(28, 105, 'Temp Data', 'Temp Data', 'Temp Data', 1111, 6.00, 686.00, 20.00, 1, 100.00, 1, 1, 1, '2022-04-05 12:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` bigint(24) NOT NULL,
  `name` varchar(80) NOT NULL,
  `code` varchar(80) NOT NULL,
  `content` varchar(256) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `name`, `code`, `content`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Page1', 'page1', 'page1', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(2, 'Page2', 'page2', 'page2', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(3, 'Page3', 'page3', 'page3', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(4, 'Page4', 'page4', 'page4', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(5, 'Page5', 'page5', 'page5', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(6, 'Page6', 'page6', 'page6', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(7, 'Page7', 'page7', 'page7', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(8, 'Page8', 'page8', 'page8', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(9, 'Page9', 'page9', 'page9', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(10, 'Page10', 'page10', 'page10', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(11, 'Page11', 'page11', 'page11', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(12, 'Page12', 'page12', 'page12', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(13, 'Page13', 'page13', 'page13', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(14, 'Page14', 'page14', 'page14', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(15, 'Page15', 'page15', 'page15', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(16, 'Page16', 'page16', 'page16', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(17, 'Page17', 'page17', 'page17', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(18, 'Page18', 'page18', 'page18', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(19, 'Page19', 'page19', 'page19', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(20, 'Page20', 'page20', 'page20', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(21, 'Page21', 'page21', 'page21', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(22, 'Page22', 'page22', 'page22', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(23, 'Page23', 'page23', 'page23', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(24, 'Page24', 'page24', 'page24', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(25, 'Page25', 'page25', 'page25', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(26, 'Page26', 'page26', 'page26', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(27, 'Page27', 'page27', 'page27', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(28, 'Page28', 'page28', 'page28', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(29, 'Page29', 'page29', 'page29', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(30, 'Page30', 'page30', 'page30', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(31, 'Page31', 'page31', 'page31', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(32, 'Page32', 'page32', 'page32', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(33, 'Page33', 'page33', 'page33', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(34, 'Page34', 'page34', 'page34', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(35, 'Page35', 'page35', 'page35', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(36, 'Page36', 'page36', 'page36', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(37, 'Page37', 'page37', 'page37', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(38, 'Page38', 'page38', 'page38', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(39, 'Page39', 'page39', 'page39', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(40, 'Page40', 'page40', 'page40', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(41, 'Page41', 'page41', 'page41', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(42, 'Page42', 'page42', 'page42', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(43, 'Page43', 'page43', 'page43', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(44, 'Page44', 'page44', 'page44', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(45, 'Page45', 'page45', 'page45', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(46, 'Page46', 'page46', 'page46', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(47, 'Page47', 'page47', 'page47', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(48, 'Page48', 'page48', 'page48', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(49, 'Page49', 'page49', 'page49', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(50, 'Page50', 'page50', 'page50', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(51, 'Page51', 'page51', 'page51', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(52, 'Page52', 'page52', 'page52', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(53, 'Page53', 'page53', 'page53', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(54, 'Page54', 'page54', 'page54', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(55, 'Page55', 'page55', 'page55', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(56, 'Page56', 'page56', 'page56', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(57, 'Page57', 'page57', 'page57', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(58, 'Page58', 'page58', 'page58', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(59, 'Page59', 'page59', 'page59', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(60, 'Page60', 'page60', 'page60', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(61, 'Page61', 'page61', 'page61', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(62, 'Page62', 'page62', 'page62', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(63, 'Page63', 'page63', 'page63', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(64, 'Page64', 'page64', 'page64', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(65, 'Page65', 'page65', 'page65', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(66, 'Page66', 'page66', 'page66', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(67, 'Page67', 'page67', 'page67', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(68, 'Page68', 'page68', 'page68', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(69, 'Page69', 'page69', 'page69', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(70, 'Page70', 'page70', 'page70', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(71, 'Page71', 'page71', 'page71', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(72, 'Page72', 'page72', 'page72', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(73, 'Page73', 'page73', 'page73', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(74, 'Page74', 'page74', 'page74', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(75, 'Page75', 'page75', 'page75', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(76, 'Page76', 'page76', 'page76', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(77, 'Page77', 'page77', 'page77', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(78, 'Page78', 'page78', 'page78', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(79, 'Page79', 'page79', 'page79', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(80, 'Page80', 'page80', 'page80', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(81, 'Page81', 'page81', 'page81', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(82, 'Page82', 'page82', 'page82', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(83, 'Page83', 'page83', 'page83', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(84, 'Page84', 'page84', 'page84', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(85, 'Page85', 'page85', 'page85', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(86, 'Page86', 'page86', 'page86', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(87, 'Page87', 'page87', 'page87', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00'),
(88, 'Page88', 'page88', 'page88', 1, '2022-03-01 00:00:00', '2022-03-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `methodId` bigint(24) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`methodId`, `name`) VALUES
(1, 'Card Payment'),
(2, 'UPI'),
(3, 'QR'),
(4, 'Cash On Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` bigint(24) NOT NULL,
  `name` varchar(56) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `base` bigint(24) DEFAULT NULL,
  `thumb` bigint(24) DEFAULT NULL,
  `small` bigint(24) DEFAULT NULL,
  `price` float(11,2) NOT NULL DEFAULT 0.00,
  `msp` int(8) NOT NULL,
  `costPrice` int(8) NOT NULL,
  `tax` float(11,2) NOT NULL,
  `discount` float(11,2) NOT NULL,
  `quantity` int(5) NOT NULL DEFAULT 0,
  `status` enum('1','2') DEFAULT '1',
  `createdDate` datetime DEFAULT current_timestamp(),
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `sku`, `base`, `thumb`, `small`, `price`, `msp`, `costPrice`, `tax`, `discount`, `quantity`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Laptop', 'Laptop', 58, 59, 59, 35000.00, 30000, 20000, 0.00, 0.00, 10, '1', '2022-02-02 00:00:00', '2022-02-25 08:02:31'),
(2, 'Keyboard', 'Keyboard', 35, 36, 37, 300.00, 250, 200, 1.00, 10.00, 25, '1', '2022-02-02 00:00:00', '2022-02-02 00:00:00'),
(3, 'Mouse', 'Mouse', 43, 44, 45, 150.00, 140, 130, 10.00, 0.00, 70, '1', '2022-02-02 11:29:00', '2022-03-23 01:03:59'),
(31, 'iPhone 13', 'iPhone 13', 22, 23, 24, 80000.00, 70000, 60000, 10.00, 8000.00, 50, '1', '2022-02-25 09:02:50', '2022-03-23 10:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `mediaId` bigint(24) NOT NULL,
  `productId` bigint(24) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gallery` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`mediaId`, `productId`, `name`, `gallery`) VALUES
(22, 31, 'iPhone13Pro120220225091600.jpeg', 1),
(23, 31, 'iPhone13Pro220220225091606.jpeg', 1),
(24, 31, 'iPhone13Pro320220225091612.jpeg', 1),
(35, 2, 'keyboard120220228055521.jpg', 1),
(36, 2, 'keyboard220220228055526.jpg', 2),
(37, 2, 'keyboard320220228055531.jpeg', 2),
(43, 3, 'Mouse120220228074516.jpg', 1),
(44, 3, 'Mouse220220228074521.jpg', 1),
(45, 3, 'Mouse320220228074526.jpg', 1),
(46, 3, 'Mouse420220228074532.jpg', 1),
(58, 1, 'Laptop120220313063417.jpg', 1),
(59, 1, 'Laptop220220313063425.png', 1),
(60, 1, 'Laptop320220313063431.jpg', 1),
(61, 1, 'Laptop420220313063436.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesmanId` bigint(24) NOT NULL,
  `firstName` varchar(56) NOT NULL,
  `lastName` varchar(56) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `discount` float(11,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `discount`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Dhruv', 'Prajapati', 'dhruvdhruv7254@gmail.com', 9879012345, 0.00, 1, '2022-02-28 07:02:10', '2022-04-02 10:58:12'),
(4, 'Dhruv', 'Prajapati', 'dhruvdhruv7254@gmail.com', 9879045678, 5.00, 1, '2022-03-08 07:03:49', '2022-04-05 12:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `methodId` bigint(24) NOT NULL,
  `name` varchar(256) NOT NULL,
  `charge` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`methodId`, `name`, `charge`) VALUES
(1, 'Same Day Delivery', 100.00),
(2, 'Express Delivery', 70.00),
(3, 'Normal Delivery', 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` bigint(24) NOT NULL,
  `firstName` varchar(56) NOT NULL,
  `lastName` varchar(56) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`, `updatedDate`) VALUES
(3, 'Dhruv', 'Prajapati', 'prajapatidhruv789@gmail.com', 9879032378, 1, '2022-03-01 07:03:00', '2022-03-04 05:41:40'),
(10, 'Dhruv', 'Prajapati', 'dhruvdhruv7254@gmail.com', 123123123, 2, '2022-03-15 11:03:50', '2022-03-15 11:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `addressId` bigint(24) NOT NULL,
  `vendorId` bigint(24) NOT NULL,
  `address` varchar(256) NOT NULL,
  `zipcode` bigint(7) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`addressId`, `vendorId`, `address`, `zipcode`, `city`, `state`, `country`) VALUES
(3, 3, 'A/15, MORLI MANOHAR PARK, B/H. AJAY TEN. PART-3,', 380026, 'AHMEDABAD', 'Gujarat', 'India'),
(9, 10, 'A/15, Morli Manohar Park Soc.,\r\nB/H Ajay Ten.-3, rabari Colony Cross Road, Amrai', 380026, 'Ahmedabad', 'Gujarat', 'India');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `cart_ibfk_1` (`customerId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `cart_address_ibfk_1` (`cartId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `cart_item_ibfk_1` (`cartId`),
  ADD KEY `cart_item_ibfk_2` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentID` (`parentId`),
  ADD KEY `categoryBase` (`base`),
  ADD KEY `categoryThumb` (`thumb`),
  ADD KEY `categorySmall` (`small`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `salesmanId` (`salesmanId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customerID` (`customerId`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `order_record`
--
ALTER TABLE `order_record`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `paymentId` (`paymentId`),
  ADD KEY `shippingId` (`shippingId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `baseProduct` (`base`),
  ADD KEY `thumbProduct` (`thumb`),
  ADD KEY `smallProduct` (`small`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `productID` (`productId`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesmanId`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorId`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `vendor_address_ibfk_1` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `cartAddressId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `mediaId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `addressId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_record`
--
ALTER TABLE `order_record`
  MODIFY `orderId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `methodId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `mediaId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `methodId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cart_address_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `categoryBase` FOREIGN KEY (`base`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `categorySmall` FOREIGN KEY (`small`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `categoryThumb` FOREIGN KEY (`thumb`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parentID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `category_media_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_record` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`salesmanId`) REFERENCES `salesman` (`salesmanId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customer_price_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_price_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_record` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_record` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_record`
--
ALTER TABLE `order_record`
  ADD CONSTRAINT `order_record_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_record_ibfk_2` FOREIGN KEY (`paymentId`) REFERENCES `payment_method` (`methodId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_record_ibfk_3` FOREIGN KEY (`shippingId`) REFERENCES `shipping_method` (`methodId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `baseProduct` FOREIGN KEY (`base`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `smallProduct` FOREIGN KEY (`small`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `thumbProduct` FOREIGN KEY (`thumb`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `vendor` (`vendorId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
