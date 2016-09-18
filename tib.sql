-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 18, 2016 at 03:33 AM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tib`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
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
  `status` enum('In Transit','Delivered','Awaiting Pick Up') NOT NULL DEFAULT 'Awaiting Pick Up',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`ID`, `user`, `driver`, `origin`, `destination`, `name`, `pickup`, `dropoff`, `cost`, `type`, `paid`, `date_paid`, `fragile`, `special`, `status`) VALUES
(1, 'bobs.burgers@gmail.com', 'bobs.burgers@gmail.com', 'ass', 'tits', 'balls', 1473418800, 1473512400, NULL, 'first', 0, NULL, 1, 'hurry', 'In Transit'),
(2, 'ze_yaya@msn.com', 'bobs.burgers@gmail.com', 'ass', 'tits', 'balls', 1473418800, 1473512400, NULL, 'first', 0, NULL, 1, 'hurry', 'In Transit'),
(3, 'ze_yaya@msn.com', 'bobs.burgers@gmail.com', 'ass', 'tits', 'balls', 1473418800, 1473512400, NULL, 'first', 0, NULL, 1, 'hurry', 'In Transit'),
(4, 'boop@boop.com', NULL, 'Brisbane', 'Perth', 'Bart', 1473674220, 1505293200, NULL, 'first', 0, NULL, 1, 'Feed the Elephant', 'Awaiting Pick Up'),
(5, 'bobo@123.com', NULL, 'None', 'None', 'Bob Bugs B Gone9', 253392487140, 253392570540, NULL, 'first', 0, NULL, 0, '', 'Awaiting Pick Up'),
(6, 'bobo@123.com', NULL, 'ghfgh', 'ghfgh', '', 1473762840, 5139542580, NULL, 'standard', 0, NULL, 0, '', 'Awaiting Pick Up'),
(7, 'bobo@123.com', NULL, 'dfds', 'dfsd', '', 1473757680, 24990802920, NULL, 'standard', 0, NULL, 0, '', 'Awaiting Pick Up'),
(8, 'pop@pop.com', NULL, 'brisbane', 'perth', 'bob', 1473757200, 1473843600, NULL, 'first', 0, NULL, 0, 'feed hourly', 'Awaiting Pick Up'),
(9, 'boop@boop.com', NULL, 'Sunnybank', 'Chesterfield', 'Jeremy', 1473757200, 1473843600, NULL, 'standard', 0, NULL, 0, 'Drive Fast', 'Awaiting Pick Up'),
(10, 'ze_yaya@msn.com', NULL, 'ffs', 'ew', 'him', 1473930540, 1474016940, NULL, 'standard', 0, NULL, 0, '', 'Awaiting Pick Up');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `delivery_id` int(10) NOT NULL,
  `time` int(64) NOT NULL,
  `location` varchar(300) NOT NULL,
  PRIMARY KEY (`delivery_id`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`delivery_id`, `time`, `location`) VALUES
(1, 1473426000, 'inside'),
(2, 1473426000, 'inside'),
(3, 1473426000, 'inside');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `delivery_ID` int(10) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `content` varchar(300) NOT NULL,
  PRIMARY KEY (`ID`,`delivery_ID`),
  KEY `delivery_id_package` (`delivery_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`ID`, `delivery_ID`, `weight`, `content`) VALUES
(1, 1, 1.00, 'dildos'),
(2, 4, 9.99, 'Elephant'),
(3, 4, 9.99, 'Candle'),
(4, 5, -0.05, 'None\r\n'),
(5, 5, 0.01, 'somethibg'),
(6, 6, -0.04, 'bng'),
(7, 7, -1.16, 'gh'),
(8, 8, 9.99, 'elephant'),
(9, 9, 1.00, 'clock'),
(10, 9, 5.00, 'bag of rice'),
(11, 9, 6.00, 'chair'),
(12, 10, 15.00, 'this thing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(90) NOT NULL,
  `phone` int(10) NOT NULL,
  `dob` bigint(20) NOT NULL,
  `position` enum('manager','customer','driver') NOT NULL DEFAULT 'customer',
  `salt` varchar(64) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `name`, `password`, `phone`, `dob`, `position`, `salt`) VALUES
('bobo@123.com', 'momo', '38709a919261367d672f301a7bf4bf6eebbb9dc247c7089f244a27d4bfb31a85', 412324234, -20070288000, 'customer', '6304026003'),
('bobs.burgers@gmail.com', 'yandick mansuck', 'd2edcdee995437ff5d48d01fa9a04ff1e4dc8e562e16ae3333b7cc47a9d01c33', 147483647, 1472601600, 'driver', '2925992761'),
('boop@boop.com', 'Jimbo Barnes', '05d1d62ca0e54a69075418b8005cbbc4d87ea5a3318485ea125bfdf2f8d6b4ae', 123456789, 1376092800, 'driver', '8096290859'),
('christopher.d.dare@gmail.com', 'Christopher Dare', '09a6db26dbc212784999be9aeeab0bb7d7c58cea1e3fa372251e00b51bcc925c', 487906073, 834105600, 'manager', '1675978708'),
('elias@mehari.com', 'Elias Mehri', '11d39dd7e9bb5b082b633d65ef729290f4b94d823a0208966a7c98b24ff54cae', 444332211, 1473206400, 'driver', '949023943'),
('iluvCP@darknet.ua', 'Jack Mehoff', 'b6f89bf1a495cf28f4d0c1b0acc688832b2911a4e3adec96150a14900f4a824e', 0, 978307200, 'customer', '8925973568'),
('mama@miya.com', 'Mama Miya', '6ba87687f072476ed80917ec135d5613144974cb0489ee2e05886535d339e992', 444332211, 1475193600, 'customer', '367552246'),
('pop@pop.com', 'Jimbo Barnes', 'd4998497856212f68d7e3df0b01bbd94cc6707c3c19d9d540ef2a3046c9ecccd', 123456789, 1473724800, 'customer', '9859973397'),
('ripstartfan@bebo.net', 'Wayne King', '26298d7c996036ea4509fc1a41ad29366e9109eeaf2965e760fee7179dff149d', 6969, 1473638400, 'driver', '674936552'),
('test@email.com', 'test', '3e997a911634cfc33fdc443921202a494c2765fbfd14c419254a2a226550b418', 404111222, 1473033600, 'driver', '1367969596'),
('ze_yaya@msn.com', 'Yannick Mansuy', '507e2259057eb61d2d83b33034b83dbab7789eac857d9bae2e3873aa18ae9f1e', 415142510, 778543200, 'driver', '1273138280'),
('ze_yaya@yahoo.fr', 'Yannick Mansuy', 'fb3a7713706fbc11339c0b2b86ac11395a001e20bf4ba7e17ce5aa9250c7855c', 415142510, 923608800, 'driver', '1072825338');

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
