-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2019 at 09:14 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `user_id` int(20) NOT NULL,
  `order_id` int(50) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_qty` int(10) NOT NULL,
  `product_img` varchar(300) NOT NULL,
  `order_total` int(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact_no` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `order_date` varchar(20) NOT NULL,
  `order_status` varchar(10) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`user_id`, `order_id`, `product_name`, `product_price`, `product_qty`, `product_img`, `order_total`, `address`, `firstname`, `lastname`, `email`, `contact_no`, `city`, `pincode`, `payment_mode`, `order_date`, `order_status`) VALUES
(1, 2, 'REHENT M3 Smart Watch', 1135, 1, 'product_img/2ac3c40a4d6127ea8a63281f419cba0fproduct07.jpg', 1135, 'Titabar', 'Mintu', 'Kurmi', 'mintu@gmail.com', '7002615437', 'Titabar', '785632', 'COD', '14-05-19', 'In Process'),
(1, 17, 'Samsung Galaxy S9 - 128GB', 45940, 2, 'product_img/6509a97657b32733b3e08124dcd22d34photo.jpg', 91880, 'Titabar', 'Mintu', 'Kurmi', 'mintu@gmail.com', '7002615437', 'Titabar', '785632', 'COD', '14-05-19', 'In Process'),
(1, 18, 'Samsung Galaxy A30 Blue', 15092, 1, 'product_img/e5ac88bcc745074683fe87f20a63ae77Samsung-Galaxy-A30-Blue_720x540.jpg', 15092, 'Titabar', 'Mintu', 'Kurmi', 'mintu@gmail.com', '7002615437', 'Titabar', '785632', 'COD', '14-05-19', 'Approved'),
(1, 10, 'All-new Echo Dot (3rd Gen)', 3000, 1, 'product_img/e518a9da3b89284a88bf6280a36ba1b561JYgCeUjXL._SL1100_.jpg', 3000, 'Titabar', 'Mintu', 'Kurmi', 'mintu@mail.com', '7002615437', 'Titabar', '785632', 'COD', '14-05-19', 'Approved'),
(3, 24, 'Nike Sports Running Shoe', 1612, 1, 'product_img/8d76722e605cfebf181b46759e9abef9banner11.jpg', 1612, 'Kolkata', 'Amit', 'Shah', 'amitshah@gmail.com', '8909123830', 'Kolkata', '700010', 'COD', '15-05-19', 'Delivered'),
(1, 19, 'Redmi 6A 2GB/16GB', 5999, 2, 'product_img/e2ab0480fefbdaea3572ff48715015a1510d4L0LYKL._SL1325_.jpg', 11998, 'Titabar', 'Mintu', 'Kurmi', 'mintu@gmail.com', '7002615437', 'Titabar', '785632', 'COD', '14-05-19', 'Delivered'),
(1, 20, 'REHENT M3 Smart Watch', 1135, 1, 'product_img/2ac3c40a4d6127ea8a63281f419cba0fproduct07.jpg', 1135, 'Teok', 'Kaushik', 'Bordoloi', 'kaushik@gmail.com', '7872901010', 'Teok', '785112', 'COD', '14-05-19', 'In Process'),
(1, 21, 'All-new Echo Dot (3rd Gen)', 3000, 2, 'product_img/e518a9da3b89284a88bf6280a36ba1b561JYgCeUjXL._SL1100_.jpg', 6000, 'Teok', 'Kaushik', 'Bordoloi', 'kaushik@gmail.com', '7872901010', 'Teok', '785112', 'COD', '14-05-19', 'Approved'),
(1, 22, 'REHENT M3 Smart Watch', 1135, 1, 'product_img/2ac3c40a4d6127ea8a63281f419cba0fproduct07.jpg', 1135, 'Jorhat', 'Amit', 'Sharma', 'amit@gmail.com', '7929304280', 'Jorhat', '785001', 'COD', '15-05-19', 'In-transit'),
(3, 23, 'REHENT M3 Smart Watch', 1135, 1, 'product_img/2ac3c40a4d6127ea8a63281f419cba0fproduct07.jpg', 1135, 'Kolkata', 'Amit', 'Shah', 'amitshah@gmail.com', '8909123830', 'Kolkata', '700010', 'COD', '15-05-19', 'In-transit'),
(1, 25, 'REHENT M3 Smart Watch', 1135, 1, 'product_img/2ac3c40a4d6127ea8a63281f419cba0fproduct07.jpg', 1135, '', '', '', '', '', '', '', 'COD', '15-05-19', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) NOT NULL,
  `product_slider` varchar(20) NOT NULL,
  `product_price` int(5) NOT NULL,
  `product_old_price` int(100) NOT NULL,
  `product_qty` int(5) NOT NULL,
  `product_img` varchar(600) NOT NULL,
  `product_preview` varchar(1000) NOT NULL,
  `product_tag` varchar(100) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_slider`, `product_price`, `product_old_price`, `product_qty`, `product_img`, `product_preview`, `product_tag`, `product_brand`, `product_category`, `product_description`) VALUES
(1, 'Nike Sports Running Shoe', 'todays_deal', 1612, 2995, 1, 'product_img/8d76722e605cfebf181b46759e9abef9banner11.jpg', 'a:4:{i:0;s:35:\"product_img/preview_img/nike-01.jpg\";i:1;s:35:\"product_img/preview_img/nike-02.jpg\";i:2;s:35:\"product_img/preview_img/nike-03.jpg\";i:3;s:35:\"product_img/preview_img/nike-04.jpg\";}', '-30%', 'Nike', 'Shoes', 'Nike is the world\'s leading manufacturer of sports and casual wear footwear. Using high technology and design innovation, Nike continually creates what is aspired and not just what is necessary. All of Nike products are meant to deliver high performance, durability and great comfort. This Nike product is extremely stylish and gives immense comfort, Its ultra light sole gives extreme comfort during walking, jogging, running or regular wear. '),
(2, 'REHENT M3 Smart Watch', 'todays_deal', 1135, 1800, 1234, 'product_img/2ac3c40a4d6127ea8a63281f419cba0fproduct07.jpg', 'a:4:{i:0;s:36:\"product_img/preview_img/rehent01.jpg\";i:1;s:36:\"product_img/preview_img/rehent02.jpg\";i:2;s:36:\"product_img/preview_img/rehent03.jpg\";i:3;s:36:\"product_img/preview_img/rehent04.jpg\";}', '-23%', 'REHENT', 'Electronics', 'Features: \r\nAlways check the number of steps walking in the day, you can also be synchronized to the APP in time, view and analyse the movement data. \r\nMovement distance and calories, the equipment automatically monitors the movement of mileage, heat consumption. \r\nHealth monitoring, long press to enter the heart rate, real-time monitoring, blood pressure monitoring. '),
(5, 'Samsung Galaxy S9 - 128GB', 'todays_deal', 45940, 80393, 1212, 'product_img/6509a97657b32733b3e08124dcd22d34photo.jpg', 'a:4:{i:0;s:39:\"product_img/preview_img/galaxys9-01.jpg\";i:1;s:39:\"product_img/preview_img/galaxys9-02.jpg\";i:2;s:39:\"product_img/preview_img/galaxys9-03.jpg\";i:3;s:39:\"product_img/preview_img/galaxys9-04.jpg\";}', '-30%', 'Samsung', 'Phones', 'Camera: 12 MP Rear camera with Dual Aperture lens (F1.5 & F2.4 modes), Super Slow-mo, AR Emojis, Optical Image Stabilisation, Live Focus, Background Blur Shapes with Rear LED Flash | 8 MP front camera\r\nDisplay: 14.73 centimeters (5.8-inch) Quad HD+ Super AMOLED Infinity display with 2960x1440 pixels and 18.5:9 aspect ratio\r\nMemory, Storage & SIM: 4GB RAM | 64GB storage expandable upto 400GB | Dual sim (nano+nano) with dual standby (4G+4G)\r\nOperating System and Processor: Android v8 Oreo Operating system with Exynos 9810 Octa-core Processor (2.7 GHz+1.7 GHz)\r\nBattery: 3000 mAH lithium ion battery\r\nWarranty: 1 year manufacturer warranty for device and 6 months manufacturer warranty for in-box accessories including batteries from the date of purchase\r\nIncluded in box: Travel Adapter, Data cable, Stereo Headset, Case, USB Connector\r\nOther features: Intelligent Scan (Face Recognition + Iris Scan), Fingerprint Sensor | Samsung Pay, Wireless Charging, IP68 Water Resistant'),
(6, 'Samsung Galaxy A30 Blue', 'todays_deal', 15092, 18000, 1202, 'product_img/e5ac88bcc745074683fe87f20a63ae77Samsung-Galaxy-A30-Blue_720x540.jpg', 'a:4:{i:0;s:45:\"product_img/preview_img/galaxy-a30-blue01.jpg\";i:1;s:45:\"product_img/preview_img/galaxy-a30-blue02.jpg\";i:2;s:45:\"product_img/preview_img/galaxy-a30-blue03.jpg\";i:3;s:45:\"product_img/preview_img/galaxy-a30-blue04.jpg\";}', 'New', 'Samsung', 'Phones', 'The Samsung galaxy A30 is a powerful device that provides for a fuller visual display with the 6.4-inch (16.21 centimeters) super AMOLED - infinity u cut display, FHD+ resolution (2340 x 1080), 404 ppi with 16m colours and a dual camera setup - 16mp (f1.9)+ 5mp (2.2) wide angle camera + 5mp (2.2) with flash and 16mp (f2.0) front facing camera. '),
(7, 'OnePlus 6T McLaren Edition', 'New', 46999, 50999, 1002, 'product_img/8d6d6fb88831b3ae809ba16072329b1451EfDWKl24L._SL1300_.jpg', 'a:4:{i:0;s:37:\"product_img/preview_img/oneplus01.jpg\";i:1;s:37:\"product_img/preview_img/oneplus02.jpg\";i:2;s:37:\"product_img/preview_img/oneplus03.jpg\";i:3;s:37:\"product_img/preview_img/oneplus04.jpg\";}', 'New', 'OnePlus', 'Phones', 'Camera: 16+20 MP Dual rear camera with Optical Image Stabilization, Super slow motion, Nightscape, and Studio Lighting | 16 MP front camera\r\nDisplay: 6.41-inch(16.2 cms) Full HD+ Optic AMOLED display with 2340 x 1080 pixels resolution and an 86% screen-to-body ratio\r\nMemory, Storage & SIM: 10GB RAM | 256GB storage | Dual nano SIM with dual standby (4G+4G)\r\nScreen Unlock: In-screen fingerprint sensor. The OnePlus 6T unlocks in 0.34s for a seamless and intuitive unlock experience\r\nOperating System and Processor: OxygenOS based on Android 9.0 Pie with 2.8GHz Qualcomm Snapdragon 845 octa-core processor\r\nBattery : 3700 mAh lithium-polymer battery with Fast Charge technology\r\nIncluded in the Box: Screen Protector (pre-applied); Translucent Case; OnePlus Fast Charge Type-C Cable; OnePlus Fast Charge Power Adapter; SIM Tray Ejector; Quick Start Guide; Safety Information; OnePlus Type-C to 3.5mm Audio Jack Adapter'),
(8, 'Redmi 6A 2GB/16GB', 'New', 5999, 6999, 100, 'product_img/e2ab0480fefbdaea3572ff48715015a1510d4L0LYKL._SL1325_.jpg', 'a:4:{i:0;s:38:\"product_img/preview_img/redmi6a-01.jpg\";i:1;s:38:\"product_img/preview_img/redmi6a-02.jpg\";i:2;s:38:\"product_img/preview_img/redmi6a-03.jpg\";i:3;s:38:\"product_img/preview_img/redmi6a-04.jpg\";}', '-20%', 'Xiaomi', 'Phones', '13MP rear camera | 5MP front camera\r\n13.8 centimeters (5.45-inch) HD+ multi-touch capacitive touchscreen with 1440 x 720 pixels resolution, 295 ppi pixel density and 18:9 aspect ratio\r\nMemory, Storage and SIM: 2GB RAM | 16GB internal memory expandable up to 256GB | Dual SIM (nano+nano) dual-standby (4G+4G)\r\nAndroid v8.1 operating system with 2.0GHz Mediatek Helio A22 quad core processor\r\n3000mAH lithium-ion battery\r\n1 year manufacturer warranty for device and 6 months manufacturer warranty for in-box accessories including batteries from the date of purchase'),
(9, 'All-new Echo Dot (3rd Gen)', 'New', 3000, 4499, 102, 'product_img/e518a9da3b89284a88bf6280a36ba1b561JYgCeUjXL._SL1100_.jpg', 'a:4:{i:0;s:37:\"product_img/preview_img/echo-dot1.jpg\";i:1;s:37:\"product_img/preview_img/echo-dot2.jpg\";i:2;s:37:\"product_img/preview_img/echo-dot3.jpg\";i:3;s:37:\"product_img/preview_img/echo-dot4.jpg\";}', '-18%', 'Amazon', 'Electronics', 'Echo Dot is Amazon\'s most popular voice-controlled speaker, now with an improved sound and a new design.\r\nEcho Dot connects to Alexa, a cloud-based voice service, to play music, answer questions, read the news, check the weather, set alarms, control compatible smart home devices, and more.\r\nStream music from Amazon Prime Music, Saavn, and TuneIn â€“ just ask for a song, artist, or genre. Fill your whole home with music with multiple Echo devices across different rooms.\r\nControl Echo Dot hands-free â€“ it can hear you from across the room with 4 far-field microphones, even in noisy environments or while playing music.\r\nCall or message family and friends who have an Echo device or the Alexa App and use Alexa to make Skype calls. Use announcements like a one-way intercom to broadcast messages to all your Echo devices.\r\nControl compatible smart lights, plugs, and remotes from Philips, Syska, TP-Link and Oakter â€“ just using your voice.\r\nUse the built-in speaker or connect to speakers thro'),
(10, 'Samsung Galaxy Note 9', 'New', 60600, 73600, 102, 'product_img/8f5b0707d6ada4a606d1cf086c95718171KIDufVRUL._SL1450_.jpg', 'a:4:{i:0;s:42:\"product_img/preview_img/galaxyNote9-01.jpg\";i:1;s:42:\"product_img/preview_img/galaxyNote9-02.jpg\";i:2;s:42:\"product_img/preview_img/galaxyNote9-03.jpg\";i:3;s:42:\"product_img/preview_img/galaxyNote9-04.jpg\";}', 'New', 'Samsung', 'Phones', '16.2 centimeters (6.4-inch) Super AMOLED Infinity Display with 18.5:9 display ratio and capacitive touchscreen with QHD+ resolution\r\nDual Rear Camera - 12MP (F1.5/F2.4) with Dual Aperture and 12MP (F2.4) and front 8MP (F1.7)camera\r\nExynos Octa core processor, 6GB RAM and dual SIM dual-standby (4G+4G)\r\n128GB internal memory expandable up to 512GB and Android v8.0 Oreo operating system\r\n4000mAH lithium-ion battery'),
(16, 'Lee Casual Shoe', 'todays_deal', 1202, 1503, 120, 'product_img/01a6c84374d75bd0b2c3aeb416a3ed0dmain-product01.jpg', 'a:4:{i:0;s:74:\"product_img/preview_img/01a6c84374d75bd0b2c3aeb416a3ed0dmain-product01.jpg\";i:1;s:74:\"product_img/preview_img/01a6c84374d75bd0b2c3aeb416a3ed0dmain-product02.jpg\";i:2;s:74:\"product_img/preview_img/01a6c84374d75bd0b2c3aeb416a3ed0dmain-product03.jpg\";i:3;s:74:\"product_img/preview_img/01a6c84374d75bd0b2c3aeb416a3ed0dmain-product04.jpg\";}', 'New', 'Lee', 'Shoes', 'This is Lee Causal Shoe.'),
(19, 'REHL T-Shirt', 'todays_deal', 399, 699, 124, 'product_img/247a3ecd6a1ea43ba4cad512b85e9269men01.jpg', 'a:4:{i:0;s:65:\"product_img/preview_img/247a3ecd6a1ea43ba4cad512b85e9269men01.jpg\";i:1;s:65:\"product_img/preview_img/247a3ecd6a1ea43ba4cad512b85e9269men02.jpg\";i:2;s:65:\"product_img/preview_img/247a3ecd6a1ea43ba4cad512b85e9269men03.jpg\";i:3;s:65:\"product_img/preview_img/247a3ecd6a1ea43ba4cad512b85e9269men04.jpg\";}', 'New', 'REHL', 'Men', 'This is test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(120) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `contact_no`) VALUES
(1, 'Mintu Moni', 'Kurmi', 'mintukurmi1@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '7002615437'),
(3, 'Amit', 'Shah', 'amitshah@gmail.com', 'c8babb64262c6076e821e1ea0afc7d306ede96cb', '7881238910');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
