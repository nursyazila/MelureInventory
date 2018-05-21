-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2018 at 04:15 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `melure`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `Agent_Id` varchar(12) NOT NULL,
  `Agent_Name` varchar(50) DEFAULT NULL,
  `Agent_Password` varchar(10) DEFAULT NULL,
  `Agent_Telno` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`Agent_Id`, `Agent_Name`, `Agent_Password`, `Agent_Telno`) VALUES
('A001', 'Elysa Binti Sayoti', '1234', '01127229691'),
('A002', 'Azyan Syahrina Abdullah', '1234', '014235678'),
('A003', 'Kamilea Arisya', '1234', '0172930091'),
('A004', 'Juliza', '1234', '01127229691');

-- --------------------------------------------------------

--
-- Table structure for table `hq`
--

CREATE TABLE `hq` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(10) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hq`
--

INSERT INTO `hq` (`id`, `admin_id`, `password`) VALUES
(1, 'admin01', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(10) NOT NULL,
  `inventory_name` varchar(30) DEFAULT NULL,
  `inventory_description` varchar(100) NOT NULL,
  `instock_quantity` int(9) DEFAULT NULL,
  `unit_price` float(5,2) DEFAULT NULL,
  `inventory_image` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `inventory_name`, `inventory_description`, `instock_quantity`, `unit_price`, `inventory_image`, `status`) VALUES
(1, 'Melure No.1', 'Inspired by Gucci Flora', 172, 35.00, 'http://172.20.10.2/Melure/1.jpeg', 'Active'),
(2, 'Melure No.2', 'Inspired by Coco Channel', 99, 35.00, 'http://172.20.10.2/Melure/2.jpeg', 'Active'),
(3, 'Melure No.3', 'Inspired by Davidoff Cool Water', 9, 35.00, 'http://172.20.10.2/Melure/3.jpeg', 'Active'),
(4, 'Melure No.4', 'Inspired by Victoria Secret Bombshell', 94, 35.00, 'http://172.20.10.2/Melure/4.jpg', 'Active'),
(5, 'Melure No.5', 'Inspired by Forbidden Rose', 78, 35.00, 'http://172.20.10.2/Melure/5.jpeg', 'Active'),
(6, 'Melure No.6', 'Inspired by Lolita Lempicka', 74, 35.00, 'http://172.20.10.2/Melure/6.jpeg', 'Active'),
(7, 'Melure No.7', 'Inspired by Dunhill Blue', 83, 35.00, 'http://172.20.10.2/Melure/7.jpg', 'Active'),
(8, 'Melure No.8', 'Inspired by Armani Sport', 92, 35.00, 'http://172.20.10.2/Melure/8.jpeg', 'Active'),
(9, 'Melure No.9', 'Inspired by Bvlgari Man Extreme', 90, 35.00, 'http://172.20.10.2/Melure/9.jpg', 'Active'),
(10, 'Melure No.10', 'Inspired by Polo Sport', 20, 35.00, 'http://172.20.10.2/Melure/10.jpeg', 'Active'),
(22, 'melure 12', 'aniin', 21, 35.00, 'http://172.20.10.2/Melure/melure12.png', 'Inactive'),
(23, 'Melure No. 11', 'Inspired by Signorina', 30, 35.00, 'http://172.20.10.2/Melure/MelureNo.11.png', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_Id` int(11) NOT NULL,
  `Agent_Id` varchar(12) DEFAULT NULL,
  `inventory_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `OrderDate` date DEFAULT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_Id`, `Agent_Id`, `inventory_id`, `quantity`, `OrderDate`, `Status`) VALUES
(1, 'A001', 1, 2, '2017-12-13', 'complete'),
(2, 'A002', 3, 2, '2017-12-01', 'Pending'),
(41, 'A001', 7, 8, '2017-12-13', 'complete'),
(42, 'A002', 1, 6, '2017-12-13', 'Pending'),
(43, 'A003', 8, 6, '2017-12-13', 'Pending'),
(53, 'A001', 8, 2, '2017-12-13', 'complete'),
(54, 'A001', 6, 5, '2017-12-13', 'complete'),
(55, 'A001', 5, 2, '2017-12-13', 'complete'),
(56, 'A001', 7, 10, '2017-12-13', 'complete'),
(57, 'A001', 1, 9, '2018-05-18', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(10) NOT NULL,
  `password` varchar(8) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role`) VALUES
('admin', '1234', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`Agent_Id`);

--
-- Indexes for table `hq`
--
ALTER TABLE `hq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hq`
--
ALTER TABLE `hq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
