-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2016 at 02:44 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tib`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `ID` int(10) NOT NULL,
  `user` varchar(64) NOT NULL,
  `driver` varchar(64) DEFAULT NULL,
  `origin` varchar(150) NOT NULL,
  `destination` varchar(150) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `pickup` bigint(20) NOT NULL,
  `dropoff` bigint(20) NOT NULL,
  `cost` decimal(6,2) DEFAULT NULL,
  `type` enum('first','standard') NOT NULL DEFAULT 'standard',
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `date_paid` bigint(20) DEFAULT NULL,
  `fragile` tinyint(1) NOT NULL DEFAULT '0',
  `special` varchar(300) DEFAULT NULL,
  `status` enum('In Transit','Delivered','Awaiting Pick Up') NOT NULL DEFAULT 'Awaiting Pick Up'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `delivery_id` int(10) NOT NULL,
  `time` int(64) NOT NULL,
  `location` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `ID` int(10) NOT NULL,
  `delivery_ID` int(10) NOT NULL,
  `weight` decimal(3,2) NOT NULL,
  `content` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(90) NOT NULL,
  `phone` int(10) NOT NULL,
  `dob` bigint(20) NOT NULL,
  `position` enum('manager','customer','driver') NOT NULL DEFAULT 'customer',
  `salt` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `name`, `password`, `phone`, `dob`, `position`, `salt`) VALUES
('ze_yaya@msn.com', 'Yannick Mansuy', '507e2259057eb61d2d83b33034b83dbab7789eac857d9bae2e3873aa18ae9f1e', 415142510, 778543200, 'customer', '1273138280'),
('ze_yaya@yahoo.fr', 'Yannick Mansuy', 'fb3a7713706fbc11339c0b2b86ac11395a001e20bf4ba7e17ce5aa9250c7855c', 415142510, 923608800, 'customer', '1072825338');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`delivery_id`,`time`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`ID`,`delivery_ID`),
  ADD KEY `delivery_id_package` (`delivery_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `delivery_id` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `delivery_id_package` FOREIGN KEY (`delivery_ID`) REFERENCES `delivery` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
