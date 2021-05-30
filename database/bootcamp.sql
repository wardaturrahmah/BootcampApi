-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2021 at 01:36 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bootcamp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tx_dtl_billing`
--

CREATE TABLE `tx_dtl_billing` (
  `dtl_billing_id` int(11) NOT NULL,
  `dtl_hdr_id` int(11) NOT NULL,
  `dtl_product` varchar(250) NOT NULL,
  `dtl_qty` int(11) NOT NULL,
  `dtl_price` double NOT NULL,
  `dtl_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tx_dtl_billing`
--

INSERT INTO `tx_dtl_billing` (`dtl_billing_id`, `dtl_hdr_id`, `dtl_product`, `dtl_qty`, `dtl_price`, `dtl_created_date`) VALUES
(1, 3, 'tas', 1, 350000, '2021-05-23 15:14:25'),
(2, 3, 'sepatu', 2, 150000, '2021-05-23 15:14:25'),
(3, 5, 'Sabun', 1, 2000, '2021-05-28 11:28:27'),
(4, 5, 'Shampo', 1, 500, '2021-05-28 11:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `tx_dtl_user`
--

CREATE TABLE `tx_dtl_user` (
  `dtl_user_id` int(10) NOT NULL,
  `dtl_hdr_id` int(5) NOT NULL,
  `dtl_user_email` varchar(50) DEFAULT NULL,
  `dtl_user_address` varchar(150) DEFAULT NULL,
  `dtl_user_phone` varchar(15) DEFAULT NULL,
  `dtl_created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tx_dtl_user`
--

INSERT INTO `tx_dtl_user` (`dtl_user_id`, `dtl_hdr_id`, `dtl_user_email`, `dtl_user_address`, `dtl_user_phone`, `dtl_created_date`) VALUES
(1, 1, 'wardahamaliyah@gmail.com', 'PUCANGAN SBY', '085730346619', '2021-05-15 08:53:28'),
(2, 2, 'chalidade@gmail.com', 'pasuruan', '0876899', '2021-05-15 08:54:22'),
(3, 9, 'dila@gmail.com', 'Pucangan', '08573033333', '2021-05-23 14:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `tx_hdr_billing`
--

CREATE TABLE `tx_hdr_billing` (
  `billing_id` int(11) NOT NULL,
  `billing_name` varchar(50) NOT NULL,
  `billing_email` varchar(50) NOT NULL,
  `billing_phone` varchar(50) NOT NULL,
  `billing_information` varchar(50) NOT NULL,
  `billing_address` varchar(250) NOT NULL,
  `billing_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tx_hdr_billing`
--

INSERT INTO `tx_hdr_billing` (`billing_id`, `billing_name`, `billing_email`, `billing_phone`, `billing_information`, `billing_address`, `billing_created_date`) VALUES
(1, 'wardah', 'wardahamaliyah@gmail.com', '0857200000', 'ok', 'surabaya', '2021-05-23 21:43:53'),
(3, 'dila', 'dila@gmail.com', '08570000', 'cek out', 'surabaya', '2021-05-23 15:14:25'),
(5, 'wardah', 'wardah@gmail.com', '08573031111', 'info', 'SBY', '2021-05-28 11:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `tx_hdr_user`
--

CREATE TABLE `tx_hdr_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tx_hdr_user`
--

INSERT INTO `tx_hdr_user` (`user_id`, `user_name`, `user_password`, `user_created_date`) VALUES
(1, 'wardah', '123', '2021-05-15 08:31:43'),
(2, 'chalidade', '123', '2021-05-15 08:32:02'),
(9, 'dila', '123', '2021-05-23 14:19:35'),
(10, 'username', 'password', '2021-05-28 15:20:04'),
(11, 'liyah', '123', '2021-05-28 15:20:45'),
(12, 'hana', '123', '2021-05-28 15:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `tx_product`
--

CREATE TABLE `tx_product` (
  `product_id` int(250) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_stock` int(10) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_description` varchar(250) NOT NULL,
  `product_photo` int(11) DEFAULT NULL,
  `product_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tx_product`
--

INSERT INTO `tx_product` (`product_id`, `product_name`, `product_price`, `product_stock`, `product_category`, `product_description`, `product_photo`, `product_created_date`) VALUES
(8, 'Black bag', 50, 1000, 'Bag', 'This is bag', NULL, '2021-05-30 05:33:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tx_dtl_billing`
--
ALTER TABLE `tx_dtl_billing`
  ADD PRIMARY KEY (`dtl_billing_id`);

--
-- Indexes for table `tx_dtl_user`
--
ALTER TABLE `tx_dtl_user`
  ADD PRIMARY KEY (`dtl_user_id`);

--
-- Indexes for table `tx_hdr_billing`
--
ALTER TABLE `tx_hdr_billing`
  ADD PRIMARY KEY (`billing_id`);

--
-- Indexes for table `tx_hdr_user`
--
ALTER TABLE `tx_hdr_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tx_product`
--
ALTER TABLE `tx_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tx_dtl_billing`
--
ALTER TABLE `tx_dtl_billing`
  MODIFY `dtl_billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tx_dtl_user`
--
ALTER TABLE `tx_dtl_user`
  MODIFY `dtl_user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tx_hdr_billing`
--
ALTER TABLE `tx_hdr_billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tx_hdr_user`
--
ALTER TABLE `tx_hdr_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tx_product`
--
ALTER TABLE `tx_product`
  MODIFY `product_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
