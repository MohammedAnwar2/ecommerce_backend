-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 05:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address_usersId` int(11) NOT NULL,
  `address_name` varchar(255) NOT NULL,
  `address_city` varchar(100) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_lat` decimal(10,8) NOT NULL,
  `address_long` decimal(11,8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_usersId`, `address_name`, `address_city`, `address_street`, `address_lat`, `address_long`, `created_at`) VALUES
(1, 5, 'dooriyan', 'Bangalore ', 'Main street ', 13.14494000, 77.57451170, '2025-05-13 03:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_phone` varchar(20) DEFAULT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_verifycode` varchar(10) DEFAULT NULL,
  `admin_approve` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_phone`, `admin_password`, `admin_verifycode`, `admin_approve`, `created_at`) VALUES
(1, 'mohammed anwar', 'moanbm123@gmail.com', '7725551277', '6367c48dd193d56ea7b0baad25b19455e529f5ee', '88463', 1, '2025-05-14 02:43:59');

-- --------------------------------------------------------

--
-- Stand-in structure for view `allfavorite`
-- (See below for the actual view)
--
CREATE TABLE `allfavorite` (
`favorite_id` int(11)
,`favorite_usersId` int(11)
,`favorite_itemsId` int(11)
,`items_id` int(11)
,`items_name` varchar(255)
,`items_name_ar` varchar(255)
,`items_desc` text
,`items_desc_ar` text
,`items_count` int(11)
,`items_active` tinyint(1)
,`items_price` decimal(10,2)
,`items_discount` decimal(5,2)
,`items_image` text
,`items_isnotify` int(11)
,`items_date` datetime
,`items_cat` int(11) unsigned
,`total_price` decimal(15,2)
,`users_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_usersId` int(11) NOT NULL,
  `cart_itemsId` int(11) NOT NULL,
  `cart_itemprice` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cart_orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_usersId`, `cart_itemsId`, `cart_itemprice`, `created_at`, `cart_orders`) VALUES
(55, 5, 9, 98.00, '2025-05-14 12:48:11', 31),
(56, 5, 9, 98.00, '2025-05-14 12:48:12', 31),
(57, 5, 9, 98.00, '2025-05-14 12:48:12', 31),
(58, 5, 9, 98.00, '2025-05-15 06:32:20', 32),
(59, 5, 9, 98.00, '2025-05-15 06:34:09', 32),
(60, 5, 9, 98.00, '2025-05-15 06:41:15', 32),
(61, 5, 9, 98.00, '2025-05-15 06:41:15', 32),
(62, 5, 10, -890.01, '2025-05-15 14:06:58', 33),
(63, 5, 10, -890.01, '2025-05-15 14:06:58', 33);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cartproducts`
-- (See below for the actual view)
--
CREATE TABLE `cartproducts` (
`total_price` decimal(37,2)
,`currentItemsCount` bigint(21)
,`cart_id` int(11)
,`cart_usersId` int(11)
,`cart_itemsId` int(11)
,`cart_itemprice` decimal(10,2)
,`created_at` timestamp
,`cart_orders` int(11)
,`items_id` int(11)
,`items_name` varchar(255)
,`items_name_ar` varchar(255)
,`items_desc` text
,`items_desc_ar` text
,`items_count` int(11)
,`items_active` tinyint(1)
,`items_price` decimal(10,2)
,`items_discount` decimal(5,2)
,`items_image` text
,`items_isnotify` int(11)
,`items_date` datetime
,`items_cat` int(11) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) UNSIGNED NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_name_ar` varchar(255) NOT NULL,
  `categories_image` varchar(255) DEFAULT NULL,
  `categories_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_name_ar`, `categories_image`, `categories_datetime`) VALUES
(2, '1حذاء', 'shows ', '8473shoes-4-svgrepo-com.svg', '2025-05-14 03:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_expiredate` date DEFAULT current_timestamp(),
  `coupon_discount` decimal(5,2) DEFAULT 0.00,
  `coupon_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_name`, `coupon_expiredate`, `coupon_discount`, `coupon_count`) VALUES
(1, 'mohammed', '2026-05-25', 40.00, 99);

-- --------------------------------------------------------

--
-- Table structure for table `dilevery`
--

CREATE TABLE `dilevery` (
  `dilevery_id` int(11) NOT NULL,
  `dilevery_name` varchar(255) NOT NULL,
  `dilevery_email` varchar(255) NOT NULL,
  `dilevery_phone` varchar(20) DEFAULT NULL,
  `dilevery_password` varchar(255) NOT NULL,
  `dilevery_verifycode` varchar(10) DEFAULT NULL,
  `dilevery_approve` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dilevery`
--

INSERT INTO `dilevery` (`dilevery_id`, `dilevery_name`, `dilevery_email`, `dilevery_phone`, `dilevery_password`, `dilevery_verifycode`, `dilevery_approve`, `created_at`) VALUES
(1, 'm@gmail.com', 'moanbm123@gmail.com', '772555127', '6367c48dd193d56ea7b0baad25b19455e529f5ee', '18809', 1, '2025-05-13 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `favorite_id` int(11) NOT NULL,
  `favorite_usersId` int(11) NOT NULL,
  `favorite_itemsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `favoritesearch`
-- (See below for the actual view)
--
CREATE TABLE `favoritesearch` (
`items_id` int(11)
,`items_name` varchar(255)
,`items_name_ar` varchar(255)
,`items_desc` text
,`items_desc_ar` text
,`items_count` int(11)
,`items_active` tinyint(1)
,`items_price` decimal(10,2)
,`items_discount` decimal(5,2)
,`items_image` text
,`items_isnotify` int(11)
,`items_date` datetime
,`items_cat` int(11) unsigned
,`categories_id` int(11) unsigned
,`categories_name` varchar(255)
,`categories_name_ar` varchar(255)
,`categories_image` varchar(255)
,`itemspricediscount` decimal(15,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getitemsidorder`
-- (See below for the actual view)
--
CREATE TABLE `getitemsidorder` (
`cart_id` int(11)
,`cart_usersId` int(11)
,`cart_itemsId` int(11)
,`cart_itemprice` decimal(10,2)
,`created_at` timestamp
,`cart_orders` int(11)
,`currentcountitems` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `items_id` int(11) NOT NULL,
  `items_name` varchar(255) NOT NULL,
  `items_name_ar` varchar(255) NOT NULL,
  `items_desc` text DEFAULT NULL,
  `items_desc_ar` text DEFAULT NULL,
  `items_count` int(11) DEFAULT 0,
  `items_active` tinyint(1) DEFAULT 1,
  `items_price` decimal(10,2) NOT NULL,
  `items_discount` decimal(5,2) DEFAULT 0.00,
  `items_image` text NOT NULL,
  `items_isnotify` int(11) NOT NULL DEFAULT 0,
  `items_date` datetime DEFAULT current_timestamp(),
  `items_cat` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `items_name`, `items_name_ar`, `items_desc`, `items_desc_ar`, `items_count`, `items_active`, `items_price`, `items_discount`, `items_image`, `items_isnotify`, `items_date`, `items_cat`) VALUES
(9, 'وةة', 'ةةةة', 'ةةة', 'ةةة', 992, 1, 98.00, 0.00, '7034images (14).jpeg', 0, '2025-05-14 18:16:01', 2),
(10, 'ظظظظظظ', 'ةظظظظظة', 'ظظظم', 'ظظظ', 997, 1, 99.00, 999.00, '1861images (15).jpeg', 0, '2025-05-14 18:16:36', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `itemstopselling`
-- (See below for the actual view)
--
CREATE TABLE `itemstopselling` (
`top_selling` bigint(21)
,`cart_id` int(11)
,`cart_usersId` int(11)
,`cart_itemsId` int(11)
,`cart_itemprice` decimal(10,2)
,`created_at` timestamp
,`cart_orders` int(11)
,`items_id` int(11)
,`items_name` varchar(255)
,`items_name_ar` varchar(255)
,`items_desc` text
,`items_desc_ar` text
,`items_count` int(11)
,`items_active` tinyint(1)
,`items_price` decimal(10,2)
,`items_discount` decimal(5,2)
,`items_image` text
,`items_isnotify` int(11)
,`items_date` datetime
,`items_cat` int(11) unsigned
,`itemspricediscount` decimal(15,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `itemview`
-- (See below for the actual view)
--
CREATE TABLE `itemview` (
`items_id` int(11)
,`items_name` varchar(255)
,`items_name_ar` varchar(255)
,`items_desc` text
,`items_desc_ar` text
,`items_count` int(11)
,`items_active` tinyint(1)
,`items_price` decimal(10,2)
,`items_discount` decimal(5,2)
,`items_image` text
,`items_isnotify` int(11)
,`items_date` datetime
,`items_cat` int(11) unsigned
,`categories_id` int(11) unsigned
,`categories_name` varchar(255)
,`categories_name_ar` varchar(255)
,`categories_image` varchar(255)
,`itemspricediscount` decimal(15,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notifications_id` int(11) NOT NULL,
  `notifications_title` varchar(255) DEFAULT NULL,
  `notifications_body` text DEFAULT NULL,
  `notifications_usersid` int(11) DEFAULT NULL,
  `notifications_admin` int(11) DEFAULT NULL,
  `notifications_datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notifications_id`, `notifications_title`, `notifications_body`, `notifications_usersid`, `notifications_admin`, `notifications_datetime`) VALUES
(31, 'Successfully', 'The order has been approved', 5, NULL, '2025-05-14 18:36:33'),
(32, 'Successfully', 'The order number 31 has been approved', NULL, 1, '2025-05-14 18:36:35'),
(33, 'Successfully', 'The order has been approved', 5, NULL, '2025-05-14 18:38:11'),
(34, 'Successfully', 'The order has been approved', 5, NULL, '2025-05-14 18:40:11'),
(35, 'Successfully', 'The order has been approved', 5, NULL, '2025-05-14 18:41:47'),
(36, 'Successfully', 'The order has been approved', 5, NULL, '2025-05-14 18:42:56'),
(37, 'Successfully', 'The order has been approved', 5, NULL, '2025-05-14 18:44:25'),
(38, 'Successfully', 'Your Order On The Way', 5, NULL, '2025-05-14 21:16:54'),
(39, 'Successfully', 'The Order number 31 is recived by the delivery man 1', NULL, 1, '2025-05-14 21:16:59'),
(40, 'Warning', 'The order number 32 is waiting to approve ', NULL, 1, '2025-05-15 12:11:26'),
(41, 'Successfully', 'The order has been approved', 5, NULL, '2025-05-15 12:12:55'),
(42, 'Successfully', 'The order number 32 has been approved', NULL, 1, '2025-05-15 12:12:59'),
(43, 'Successfully', 'The order has been approved', 5, NULL, '2025-05-15 12:14:49'),
(44, 'Successfully', 'Your Order On The Way', 5, NULL, '2025-05-15 12:15:35'),
(45, 'Successfully', 'The Order number 32 is recived by the delivery man 1', NULL, 1, '2025-05-15 12:15:41'),
(46, 'Successfully', 'The Order has been delivered', 5, NULL, '2025-05-15 12:26:37'),
(47, 'Successfully', 'The Order number 31 has been delivered to the customer', NULL, 1, '2025-05-15 12:26:39'),
(48, 'Successfully', 'The Order has been delivered', 5, NULL, '2025-05-15 19:34:45'),
(49, 'Successfully', 'The Order number 32 has been delivered to the customer', NULL, 1, '2025-05-15 19:34:48'),
(50, 'Warning', 'The order number 33 is waiting to approve ', NULL, 1, '2025-05-15 19:37:09'),
(51, 'Successfully', 'The order has been approved', 5, NULL, '2025-05-15 20:27:35'),
(52, 'Successfully', 'The order number 33 has been approved', NULL, 1, '2025-05-15 20:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `notifyme`
--

CREATE TABLE `notifyme` (
  `notifyme_id` int(11) NOT NULL,
  `notifyme_itemsid` int(11) NOT NULL,
  `notifyme_usersid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderaddress`
--

CREATE TABLE `orderaddress` (
  `orderAddress_id` int(11) NOT NULL,
  `orderAddress_name` varchar(255) NOT NULL DEFAULT 'none',
  `orderAddress_city` varchar(255) NOT NULL DEFAULT 'none',
  `orderAddress_street` varchar(255) NOT NULL DEFAULT 'none',
  `orderAddress_lat` varchar(100) DEFAULT NULL,
  `orderAddress_long` varchar(100) DEFAULT NULL,
  `orderAddress_orderId` int(11) UNSIGNED NOT NULL,
  `orderAddress_addressId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderaddress`
--

INSERT INTO `orderaddress` (`orderAddress_id`, `orderAddress_name`, `orderAddress_city`, `orderAddress_street`, `orderAddress_lat`, `orderAddress_long`, `orderAddress_orderId`, `orderAddress_addressId`) VALUES
(1, 'dooriyan', 'Bangalore ', 'Main street ', '13.14494000', '77.57451170', 25, 1),
(2, 'dooriyan', 'Bangalore ', 'Main street ', '13.14494000', '77.57451170', 26, 1),
(3, 'dooriyan', 'Bangalore ', 'Main street ', '13.14494000', '77.57451170', 27, 1),
(4, 'dooriyan', 'Bangalore ', 'Main street ', '13.14494000', '77.57451170', 28, 1),
(5, 'dooriyan', 'Bangalore ', 'Main street ', '13.14494000', '77.57451170', 30, 1),
(6, 'dooriyan', 'Bangalore ', 'Main street ', '13.14494000', '77.57451170', 31, 1),
(7, 'dooriyan', 'Bangalore ', 'Main street ', '13.14494000', '77.57451170', 32, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `orderdetailsview`
-- (See below for the actual view)
--
CREATE TABLE `orderdetailsview` (
`total_price` decimal(37,2)
,`Itemscount` bigint(21)
,`cart_id` int(11)
,`cart_usersId` int(11)
,`cart_itemsId` int(11)
,`cart_itemprice` decimal(10,2)
,`created_at` timestamp
,`cart_orders` int(11)
,`items_id` int(11)
,`items_name` varchar(255)
,`items_name_ar` varchar(255)
,`items_desc` text
,`items_desc_ar` text
,`items_count` int(11)
,`items_active` tinyint(1)
,`items_price` decimal(10,2)
,`items_discount` decimal(5,2)
,`items_image` text
,`items_isnotify` int(11)
,`items_date` datetime
,`items_cat` int(11) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `orders_paymentmethod` varchar(50) NOT NULL COMMENT 'cach=0 , card=1',
  `orders_userId` int(11) NOT NULL,
  `orders_deliveryid` tinyint(4) NOT NULL DEFAULT 0,
  `orders_addressId` int(11) NOT NULL DEFAULT 0,
  `orders_type` varchar(50) DEFAULT NULL COMMENT 'delivery=0 , store=1',
  `orders_pricedelivery` decimal(10,2) DEFAULT 0.00,
  `orders_price` decimal(10,2) NOT NULL,
  `orders_totalprice` decimal(10,2) NOT NULL,
  `orders_coupon` int(11) DEFAULT NULL,
  `orders_status` tinyint(4) NOT NULL DEFAULT 0,
  `orders_rating` int(11) NOT NULL DEFAULT 0,
  `orders_noteRating` text DEFAULT NULL,
  `orders_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `orders_paymentmethod`, `orders_userId`, `orders_deliveryid`, `orders_addressId`, `orders_type`, `orders_pricedelivery`, `orders_price`, `orders_totalprice`, `orders_coupon`, `orders_status`, `orders_rating`, `orders_noteRating`, `orders_date`) VALUES
(32, '0', 5, 1, 1, '0', 30.00, 392.00, 422.00, 1, 4, 5, 'tfggggh', '2025-05-15 06:41:26'),
(33, '0', 5, 0, 0, '1', 0.00, -1780.02, -1780.02, 1, 4, 4, '', '2025-05-15 14:07:09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `ordersview`
-- (See below for the actual view)
--
CREATE TABLE `ordersview` (
`orders_id` int(11)
,`orders_paymentmethod` varchar(50)
,`orders_userId` int(11)
,`orders_deliveryid` tinyint(4)
,`orders_addressId` int(11)
,`orders_type` varchar(50)
,`orders_pricedelivery` decimal(10,2)
,`orders_price` decimal(10,2)
,`orders_totalprice` decimal(10,2)
,`orders_coupon` int(11)
,`orders_status` tinyint(4)
,`orders_rating` int(11)
,`orders_noteRating` text
,`orders_date` timestamp
,`orderAddress_id` int(11)
,`orderAddress_name` varchar(255)
,`orderAddress_city` varchar(255)
,`orderAddress_street` varchar(255)
,`orderAddress_lat` varchar(100)
,`orderAddress_long` varchar(100)
,`orderAddress_orderId` int(11) unsigned
,`orderAddress_addressId` int(11) unsigned
,`coupon_discount` decimal(5,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `strings`
--

CREATE TABLE `strings` (
  `strings_id` int(11) NOT NULL,
  `strings_title` varchar(255) DEFAULT NULL,
  `strings_body` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strings`
--

INSERT INTO `strings` (`strings_id`, `strings_title`, `strings_body`) VALUES
(1, 'dfgfdg', 'fdgfg'),
(2, 'fdgfd', 'fdgfd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(255) NOT NULL,
  `users_email` varchar(255) NOT NULL,
  `users_phone` varchar(20) DEFAULT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_verifycode` varchar(10) DEFAULT NULL,
  `users_approve` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `users_email`, `users_phone`, `users_password`, `users_verifycode`, `users_approve`, `created_at`) VALUES
(2, 'm@gmail.com', 'm@gmail.com', '4565464564', '7c4a8d09ca3762af61e59520943dc26494f8941b', '21719', 0, '2025-04-27 22:51:01'),
(3, 'm@gmail.com', 'mghjgjhg@gmail.com', '45654645644234', '7c4a8d09ca3762af61e59520943dc26494f8941b', '78213', 0, '2025-05-12 05:25:26'),
(5, 'mohammed anwar', 'moanbm123@gmail.com', '772555127', '6367c48dd193d56ea7b0baad25b19455e529f5ee', '92111', 1, '2025-05-12 05:28:53');

-- --------------------------------------------------------

--
-- Structure for view `allfavorite`
--
DROP TABLE IF EXISTS `allfavorite`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allfavorite`  AS SELECT `favorite`.`favorite_id` AS `favorite_id`, `favorite`.`favorite_usersId` AS `favorite_usersId`, `favorite`.`favorite_itemsId` AS `favorite_itemsId`, `items`.`items_id` AS `items_id`, `items`.`items_name` AS `items_name`, `items`.`items_name_ar` AS `items_name_ar`, `items`.`items_desc` AS `items_desc`, `items`.`items_desc_ar` AS `items_desc_ar`, `items`.`items_count` AS `items_count`, `items`.`items_active` AS `items_active`, `items`.`items_price` AS `items_price`, `items`.`items_discount` AS `items_discount`, `items`.`items_image` AS `items_image`, `items`.`items_isnotify` AS `items_isnotify`, `items`.`items_date` AS `items_date`, `items`.`items_cat` AS `items_cat`, round(`items`.`items_price` - `items`.`items_price` * `items`.`items_discount` / 100,2) AS `total_price`, `users`.`users_id` AS `users_id` FROM ((`favorite` join `items` on(`favorite`.`favorite_itemsId` = `items`.`items_id`)) join `users` on(`favorite`.`favorite_usersId` = `users`.`users_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `cartproducts`
--
DROP TABLE IF EXISTS `cartproducts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cartproducts`  AS SELECT round(sum(`items`.`items_price` - `items`.`items_price` * `items`.`items_discount` / 100),2) AS `total_price`, count(`items`.`items_price`) AS `currentItemsCount`, `cart`.`cart_id` AS `cart_id`, `cart`.`cart_usersId` AS `cart_usersId`, `cart`.`cart_itemsId` AS `cart_itemsId`, `cart`.`cart_itemprice` AS `cart_itemprice`, `cart`.`created_at` AS `created_at`, `cart`.`cart_orders` AS `cart_orders`, `items`.`items_id` AS `items_id`, `items`.`items_name` AS `items_name`, `items`.`items_name_ar` AS `items_name_ar`, `items`.`items_desc` AS `items_desc`, `items`.`items_desc_ar` AS `items_desc_ar`, `items`.`items_count` AS `items_count`, `items`.`items_active` AS `items_active`, `items`.`items_price` AS `items_price`, `items`.`items_discount` AS `items_discount`, `items`.`items_image` AS `items_image`, `items`.`items_isnotify` AS `items_isnotify`, `items`.`items_date` AS `items_date`, `items`.`items_cat` AS `items_cat` FROM ((`items` join `cart` on(`items`.`items_id` = `cart`.`cart_itemsId`)) join `users` on(`users`.`users_id` = `cart`.`cart_usersId`)) WHERE `cart`.`cart_orders` = 0 GROUP BY `items`.`items_price`, `cart`.`cart_usersId` ;

-- --------------------------------------------------------

--
-- Structure for view `favoritesearch`
--
DROP TABLE IF EXISTS `favoritesearch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `favoritesearch`  AS SELECT DISTINCT `itemview`.`items_id` AS `items_id`, `itemview`.`items_name` AS `items_name`, `itemview`.`items_name_ar` AS `items_name_ar`, `itemview`.`items_desc` AS `items_desc`, `itemview`.`items_desc_ar` AS `items_desc_ar`, `itemview`.`items_count` AS `items_count`, `itemview`.`items_active` AS `items_active`, `itemview`.`items_price` AS `items_price`, `itemview`.`items_discount` AS `items_discount`, `itemview`.`items_image` AS `items_image`, `itemview`.`items_isnotify` AS `items_isnotify`, `itemview`.`items_date` AS `items_date`, `itemview`.`items_cat` AS `items_cat`, `itemview`.`categories_id` AS `categories_id`, `itemview`.`categories_name` AS `categories_name`, `itemview`.`categories_name_ar` AS `categories_name_ar`, `itemview`.`categories_image` AS `categories_image`, `itemview`.`itemspricediscount` AS `itemspricediscount` FROM (`itemview` join `favorite` on(`itemview`.`items_id` = `favorite`.`favorite_itemsId`)) ;

-- --------------------------------------------------------

--
-- Structure for view `getitemsidorder`
--
DROP TABLE IF EXISTS `getitemsidorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getitemsidorder`  AS SELECT `cart`.`cart_id` AS `cart_id`, `cart`.`cart_usersId` AS `cart_usersId`, `cart`.`cart_itemsId` AS `cart_itemsId`, `cart`.`cart_itemprice` AS `cart_itemprice`, `cart`.`created_at` AS `created_at`, `cart`.`cart_orders` AS `cart_orders`, count(`cart`.`cart_itemsId`) AS `currentcountitems` FROM (`cart` join `ordersview` on(`cart`.`cart_orders` = `ordersview`.`orders_id`)) GROUP BY `cart`.`cart_itemsId`, `cart`.`cart_orders` ;

-- --------------------------------------------------------

--
-- Structure for view `itemstopselling`
--
DROP TABLE IF EXISTS `itemstopselling`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `itemstopselling`  AS SELECT count(`cart`.`cart_itemsId`) AS `top_selling`, `cart`.`cart_id` AS `cart_id`, `cart`.`cart_usersId` AS `cart_usersId`, `cart`.`cart_itemsId` AS `cart_itemsId`, `cart`.`cart_itemprice` AS `cart_itemprice`, `cart`.`created_at` AS `created_at`, `cart`.`cart_orders` AS `cart_orders`, `items`.`items_id` AS `items_id`, `items`.`items_name` AS `items_name`, `items`.`items_name_ar` AS `items_name_ar`, `items`.`items_desc` AS `items_desc`, `items`.`items_desc_ar` AS `items_desc_ar`, `items`.`items_count` AS `items_count`, `items`.`items_active` AS `items_active`, `items`.`items_price` AS `items_price`, `items`.`items_discount` AS `items_discount`, `items`.`items_image` AS `items_image`, `items`.`items_isnotify` AS `items_isnotify`, `items`.`items_date` AS `items_date`, `items`.`items_cat` AS `items_cat`, round(`items`.`items_price` - `items`.`items_price` * `items`.`items_discount` / 100,2) AS `itemspricediscount` FROM (`cart` join `items` on(`cart`.`cart_itemsId` = `items`.`items_id`)) WHERE `cart`.`cart_orders` <> 0 GROUP BY `cart`.`cart_itemsId` ORDER BY count(`cart`.`cart_itemsId`) ASC ;

-- --------------------------------------------------------

--
-- Structure for view `itemview`
--
DROP TABLE IF EXISTS `itemview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `itemview`  AS SELECT `items`.`items_id` AS `items_id`, `items`.`items_name` AS `items_name`, `items`.`items_name_ar` AS `items_name_ar`, `items`.`items_desc` AS `items_desc`, `items`.`items_desc_ar` AS `items_desc_ar`, `items`.`items_count` AS `items_count`, `items`.`items_active` AS `items_active`, `items`.`items_price` AS `items_price`, `items`.`items_discount` AS `items_discount`, `items`.`items_image` AS `items_image`, `items`.`items_isnotify` AS `items_isnotify`, `items`.`items_date` AS `items_date`, `items`.`items_cat` AS `items_cat`, `categories`.`categories_id` AS `categories_id`, `categories`.`categories_name` AS `categories_name`, `categories`.`categories_name_ar` AS `categories_name_ar`, `categories`.`categories_image` AS `categories_image`, round(`items`.`items_price` - `items`.`items_price` * `items`.`items_discount` / 100,2) AS `itemspricediscount` FROM (`items` join `categories` on(`items`.`items_cat` = `categories`.`categories_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `orderdetailsview`
--
DROP TABLE IF EXISTS `orderdetailsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orderdetailsview`  AS SELECT round(sum(`items`.`items_price` - `items`.`items_price` * `items`.`items_discount` / 100),2) AS `total_price`, count(`items`.`items_price`) AS `Itemscount`, `cart`.`cart_id` AS `cart_id`, `cart`.`cart_usersId` AS `cart_usersId`, `cart`.`cart_itemsId` AS `cart_itemsId`, `cart`.`cart_itemprice` AS `cart_itemprice`, `cart`.`created_at` AS `created_at`, `cart`.`cart_orders` AS `cart_orders`, `items`.`items_id` AS `items_id`, `items`.`items_name` AS `items_name`, `items`.`items_name_ar` AS `items_name_ar`, `items`.`items_desc` AS `items_desc`, `items`.`items_desc_ar` AS `items_desc_ar`, `items`.`items_count` AS `items_count`, `items`.`items_active` AS `items_active`, `items`.`items_price` AS `items_price`, `items`.`items_discount` AS `items_discount`, `items`.`items_image` AS `items_image`, `items`.`items_isnotify` AS `items_isnotify`, `items`.`items_date` AS `items_date`, `items`.`items_cat` AS `items_cat` FROM (`orders` join ((`items` join `cart` on(`items`.`items_id` = `cart`.`cart_itemsId`)) join `users` on(`users`.`users_id` = `cart`.`cart_usersId`))) WHERE `cart`.`cart_orders` <> 0 AND `orders`.`orders_id` = `cart`.`cart_orders` GROUP BY `items`.`items_price`, `cart`.`cart_usersId`, `cart`.`cart_orders` ;

-- --------------------------------------------------------

--
-- Structure for view `ordersview`
--
DROP TABLE IF EXISTS `ordersview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ordersview`  AS SELECT `orders`.`orders_id` AS `orders_id`, `orders`.`orders_paymentmethod` AS `orders_paymentmethod`, `orders`.`orders_userId` AS `orders_userId`, `orders`.`orders_deliveryid` AS `orders_deliveryid`, `orders`.`orders_addressId` AS `orders_addressId`, `orders`.`orders_type` AS `orders_type`, `orders`.`orders_pricedelivery` AS `orders_pricedelivery`, `orders`.`orders_price` AS `orders_price`, `orders`.`orders_totalprice` AS `orders_totalprice`, `orders`.`orders_coupon` AS `orders_coupon`, `orders`.`orders_status` AS `orders_status`, `orders`.`orders_rating` AS `orders_rating`, `orders`.`orders_noteRating` AS `orders_noteRating`, `orders`.`orders_date` AS `orders_date`, `orderaddress`.`orderAddress_id` AS `orderAddress_id`, `orderaddress`.`orderAddress_name` AS `orderAddress_name`, `orderaddress`.`orderAddress_city` AS `orderAddress_city`, `orderaddress`.`orderAddress_street` AS `orderAddress_street`, `orderaddress`.`orderAddress_lat` AS `orderAddress_lat`, `orderaddress`.`orderAddress_long` AS `orderAddress_long`, `orderaddress`.`orderAddress_orderId` AS `orderAddress_orderId`, `orderaddress`.`orderAddress_addressId` AS `orderAddress_addressId`, `coupon`.`coupon_discount` AS `coupon_discount` FROM ((`orders` left join `orderaddress` on(`orders`.`orders_id` = `orderaddress`.`orderAddress_orderId`)) left join `coupon` on(`coupon`.`coupon_id` = `orders`.`orders_coupon`)) ORDER BY `orders`.`orders_id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address_usersId` (`address_usersId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_usersId` (`cart_usersId`),
  ADD KEY `cart_itemsId` (`cart_itemsId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `dilevery`
--
ALTER TABLE `dilevery`
  ADD PRIMARY KEY (`dilevery_id`),
  ADD UNIQUE KEY `dilevery_email` (`dilevery_email`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `favorite_usersId` (`favorite_usersId`),
  ADD KEY `favorite_itemsId` (`favorite_itemsId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`items_id`),
  ADD KEY `items_cat` (`items_cat`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notifications_id`),
  ADD KEY `notifications_usersid` (`notifications_usersid`);

--
-- Indexes for table `notifyme`
--
ALTER TABLE `notifyme`
  ADD PRIMARY KEY (`notifyme_id`),
  ADD KEY `notifyme_itemsid` (`notifyme_itemsid`),
  ADD KEY `notifyme_usersid` (`notifyme_usersid`);

--
-- Indexes for table `orderaddress`
--
ALTER TABLE `orderaddress`
  ADD PRIMARY KEY (`orderAddress_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `orders_userId` (`orders_userId`),
  ADD KEY `orders_coupon` (`orders_coupon`);

--
-- Indexes for table `strings`
--
ALTER TABLE `strings`
  ADD PRIMARY KEY (`strings_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_email` (`users_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dilevery`
--
ALTER TABLE `dilevery`
  MODIFY `dilevery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notifications_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `notifyme`
--
ALTER TABLE `notifyme`
  MODIFY `notifyme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderaddress`
--
ALTER TABLE `orderaddress`
  MODIFY `orderAddress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `strings`
--
ALTER TABLE `strings`
  MODIFY `strings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`address_usersId`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_usersId`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cart_itemsId`) REFERENCES `items` (`items_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`favorite_usersId`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`favorite_itemsId`) REFERENCES `items` (`items_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`items_cat`) REFERENCES `categories` (`categories_id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`notifications_usersid`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifyme`
--
ALTER TABLE `notifyme`
  ADD CONSTRAINT `notifyme_ibfk_1` FOREIGN KEY (`notifyme_itemsid`) REFERENCES `items` (`items_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifyme_ibfk_2` FOREIGN KEY (`notifyme_usersid`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`orders_userId`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`orders_coupon`) REFERENCES `coupon` (`coupon_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
