-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2019 at 10:13 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

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

CREATE TABLE `admin_login` (
  `id` int(3) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `deal_tag` varchar(20) NOT NULL,
  `product_price` int(5) NOT NULL,
  `product_old_price` int(100) NOT NULL,
  `product_qty` int(5) NOT NULL,
  `product_img` varchar(600) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `deal_tag`, `product_price`, `product_old_price`, `product_qty`, `product_img`, `product_brand`, `product_category`, `product_description`) VALUES
(1, 'Nike Sports Running Shoe', 'todays_deal', 1612, 2995, 0, 'product_img/8d76722e605cfebf181b46759e9abef9banner11.jpg', 'Nike', 'Shoes', 'Nike is the world\'s leading manufacturer of sports and casual wear footwear. Using high technology and design innovation, Nike continually creates what is aspired and not just what is necessary. All of Nike products are meant to deliver high performance, durability and great comfort. This Nike product is extremely stylish and gives immense comfort, Its ultra light sole gives extreme comfort during walking, jogging, running or regular wear. '),
(2, 'REHENT M3 Smart Watch', 'todays_deal', 1135, 1800, 1234, 'product_img/2ac3c40a4d6127ea8a63281f419cba0fproduct07.jpg', 'REHENT', 'Electronics', 'Features: \r\nAlways check the number of steps walking in the day, you can also be synchronized to the APP in time, view and analyse the movement data. \r\nMovement distance and calories, the equipment automatically monitors the movement of mileage, heat consumption. \r\nHealth monitoring, long press to enter the heart rate, real-time monitoring, blood pressure monitoring. '),
(5, 'Samsung Galaxy S9 - 128GB', 'todays_deal', 45940, 80393, 1212, 'product_img/6509a97657b32733b3e08124dcd22d34photo.jpg', 'Samsung', 'Mens Clothing', '31dcdccec'),
(6, 'Samsung Galaxy A30 Blue', 'todays_deal', 15092, 18000, 1202, 'product_img/e5ac88bcc745074683fe87f20a63ae77Samsung-Galaxy-A30-Blue_720x540.jpg', 'Samsung', 'Phones', 'The Samsung galaxy A30 is a powerful device that provides for a fuller visual display with the 6.4-inch (16.21 centimeters) super AMOLED - infinity u cut display, FHD+ resolution (2340 x 1080), 404 ppi with 16m colours and a dual camera setup - 16mp (f1.9)+ 5mp (2.2) wide angle camera + 5mp (2.2) with flash and 16mp (f2.0) front facing camera. ');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

CREATE TABLE `shop_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_desc` text NOT NULL,
  `product_code` varchar(60) NOT NULL,
  `product_image` varchar(60) NOT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id`, `product_name`, `product_desc`, `product_code`, `product_image`, `product_price`) VALUES
(1, 'Samsung S10', 'Samsung new phone samsung S10', '201sh1S', 'samsung-galaxy-on5.jpeg', 123);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_products`
--
ALTER TABLE `shop_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
