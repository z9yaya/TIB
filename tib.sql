-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2016 at 04:26 PM
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
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `file` varchar(254) NOT NULL,
  `lastmodified` bigint(20) NOT NULL,
  `user` varchar(254) NOT NULL,
  `online` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`file`,`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`file`, `lastmodified`, `user`, `online`) VALUES
('ze_yaya@yahoo.fr-boop@boop.com.xml', 1475205493, 'boop@boop.com', NULL),
('ze_yaya@yahoo.fr-boop@boop.com.xml', 1475205493, 'ze_yaya@yahoo.fr', 1475205595),
('ze_yaya@yahoo.fr-elias@gebre.com.xml', 1475222163, 'elias@gebre.com', 1475222172),
('ze_yaya@yahoo.fr-elias@gebre.com.xml', 1475222163, 'ze_yaya@yahoo.fr', 1475238369);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`ID`, `user`, `driver`, `origin`, `destination`, `name`, `pickup`, `dropoff`, `cost`, `type`, `paid`, `date_paid`, `fragile`, `special`, `status`) VALUES
(13, 'pop@pop.com', NULL, 'Brisbane', 'China', 'Bob', 1474502340, 1514674800, NULL, 'first', 0, NULL, 1, 'Feed Rabbot', 'Delivered'),
(14, 'elias@gebre.com', NULL, 'brisbane', 'gold coast', 'Dooo', 1474509600, 1474599600, NULL, 'first', 0, NULL, 0, 'need it', 'Awaiting Pick Up'),
(15, 'elias@gebre.com', NULL, 'brisbane', 'gold coast', 'Dooo', 1474509600, 1474599600, NULL, 'first', 0, NULL, 0, 'need it', 'Awaiting Pick Up'),
(16, 'elias@gebre.com', NULL, 'brisbane', 'gold coast', 'Dooo', 1474509600, 1474599600, NULL, 'first', 0, NULL, 0, 'need it', 'Awaiting Pick Up'),
(17, 'elias@gebre.com', NULL, 'brisbane', 'gold coast', 'Dooo', 1474509600, 1474599600, NULL, 'first', 0, NULL, 0, 'need it', 'Awaiting Pick Up'),
(18, 'elias@gebre.com', NULL, 'city', 'bries', 'hghh', 1474499340, 1474585740, NULL, 'standard', 0, NULL, 0, 'hh', 'Awaiting Pick Up'),
(19, 'ze_yaya@msn.com', 'ze_yaya@yahoo.fr', 'here', 'there', 'him', 1474499340, 1474585740, NULL, 'standard', 1, 1474527891, 0, '', 'In Transit'),
(20, 'pop@pop.com', NULL, 'QUT', 'Perth', 'Bob', 1474502340, 1483232340, NULL, 'first', 0, NULL, 1, 'Don''t put bunny with spikes', 'Awaiting Pick Up'),
(22, 'christopher.d.dare@gmail.com', NULL, 'mine', 'yers', 'Wan Ker', 1474498800, 1474585260, 100.00, 'first', 1, 1474548230, 1, 'Don''t be blunt.', 'Awaiting Pick Up'),
(23, 'bobs.burgers@gmail.com', 'ze_yaya@yahoo.fr', '14 morman st', '15 dude st', 'dudeman', 1474473540, 1474556400, NULL, 'first', 0, NULL, 1, 'be careful', 'In Transit'),
(24, 'ze_yaya@msn.com', NULL, 'place2', 'place to2', 'person2', 1474499400, 1474585800, NULL, 'first', 0, NULL, 1, 'instructions2', 'Awaiting Pick Up'),
(25, 'ze_yaya@msn.com', NULL, 'place', 'place to', 'person', 1474499340, 1474585740, NULL, 'first', 0, NULL, 1, 'instructions', 'Awaiting Pick Up'),
(26, 'test@email.com', 'ze_yaya@yahoo.fr', 'Location', 'Place', 'Person', 1474499340, 1474585740, NULL, 'first', 0, NULL, 0, '', 'In Transit'),
(27, 'christopher.d.dare@gmail.com', NULL, 'yolo', 'swag', 'these guise', 1474506660, 1475216400, NULL, 'first', 1, 1474551367, 1, '', 'Awaiting Pick Up'),
(28, 'test@email.com', NULL, 'Location2', 'Place2', 'Person2', 1474588800, 1474934400, NULL, 'first', 0, NULL, 1, 'Special Instructions typed again', 'Awaiting Pick Up'),
(29, 'gayporndirector@grindr.com', NULL, 'myanus', 'uranus', 'Amanda Luvenkiss', 1474599600, 1475305200, NULL, 'standard', 0, NULL, 0, 'lube up.', 'Awaiting Pick Up'),
(30, 'geoff@geoff.geoff', NULL, 'dbsdvsdb', 'dbsdbdsfbf', 'sdfbdsbdff', 1474596000, 943927200, NULL, 'first', 0, NULL, 1, 'bdbdbsfbsd', 'Awaiting Pick Up'),
(31, 'elias@mehari.com', NULL, 'Perth', 'Brisbane', 'SUSHI', 1475636340, 1476331140, NULL, 'first', 0, NULL, 0, 'she need it', 'Awaiting Pick Up'),
(32, 'eli@gebi.com', NULL, 'Peri', 'Bri', 'eli', 1475625600, 1483149600, NULL, 'first', 0, NULL, 0, 'hury', 'Awaiting Pick Up');

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
(19, 1474524060, 'here'),
(23, 1474527180, 'home'),
(26, 1474588440, 'Other Location');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`ID`, `delivery_ID`, `weight`, `content`) VALUES
(16, 13, 10.00, 'Rabbit'),
(17, 13, 5.00, 'Candle'),
(18, 14, 4.00, 'laptop'),
(19, 15, 4.00, 'laptop'),
(20, 16, 4.00, 'laptop'),
(21, 17, 4.00, 'laptop'),
(22, 18, 6.00, 'gg'),
(23, 19, 1.00, 'this'),
(24, 20, 5.00, 'Real Bunny'),
(25, 20, 10.00, 'Spikes'),
(27, 22, 420.00, 'Plants'),
(28, 23, 4.00, 'bugs'),
(29, 23, 2.50, 'ants'),
(30, 24, 15.00, 'package'),
(31, 24, 10.00, 'package'),
(32, 25, 15.00, 'package'),
(33, 25, 10.00, 'package'),
(34, 26, 10.00, 'Content'),
(35, 27, 10.00, 'stuff'),
(36, 28, 10.00, 'Contents'),
(37, 29, 0.60, 'AIDS'),
(38, 30, 5.00, 'cvxcccxv'),
(39, 30, 14.98, 'xcvxcvcv'),
(40, 31, 1.50, 'shilho'),
(41, 32, 10.00, 'books');

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
('bobs.burgers@gmail.com', 'Bob Dude', '4e80c0666dda80fc085ca5ece03701d37aa20ed0f43a272b52cf0ad43ac7aaef', 418966685, 1063288800, 'customer', '3705394756'),
('boop@boop.com', 'Jimbo Barnes', '05d1d62ca0e54a69075418b8005cbbc4d87ea5a3318485ea125bfdf2f8d6b4ae', 123456789, 1376092800, 'driver', '8096290859'),
('christopher.d.dare@gmail.com', 'Christopher Dare', '09a6db26dbc212784999be9aeeab0bb7d7c58cea1e3fa372251e00b51bcc925c', 487906073, 834105600, 'manager', '1675978708'),
('eli@gebi.com', 'eli gebi', 'c953fd779b264d56bf5af601414ad72296beaca41fdb850aedbbf0bce15ba33a', 411111111, -1704276000, 'customer', '3211214449'),
('elias@gebre.com', 'elias gebre', 'e8dedad7dc8071626111f7fd376c1397bda58f5d651a4031d2b4523a0e4c08f0', 411223344, 1062597600, 'driver', '8905364978'),
('elias@mehari.com', 'eg', '93f903bd704af8eeda27b44d734d43fdb6465b1a9e966b4f6edde36cf2d7d498', 411111111, 1064930400, 'customer', '1091917166'),
('gayporndirector@grindr.com', 'Wayne Kerr', '1fe60dd872032fc62b210ea423d3d2a57ab462d7629db85dcf737fc6a1201fee', 422334455, 1062511200, 'customer', '7019026535'),
('geoff@geoff.geoff', 'geoff', '7b62a15dd917e3d4aacfb671b11d93d4ff49411075323855cff3f0c985b360b8', 234234242, 943884000, 'customer', '6050932761'),
('mama@miya.com', 'Mama Miya', '6ba87687f072476ed80917ec135d5613144974cb0489ee2e05886535d339e992', 444332211, 1475193600, 'customer', '367552246'),
('pop@pop.com', 'Jimbo Barnes', 'd4998497856212f68d7e3df0b01bbd94cc6707c3c19d9d540ef2a3046c9ecccd', 123456789, 1473724800, 'customer', '9859973397'),
('test@email.com', 'Test Name', '5d0edecfbb3a6a97a41d3e6195d8013a0295953910fb9e5646dfc37760227d7c', 123456789, 1663596000, 'customer', '2323248549'),
('ze_yaya@msn.com', 'Yannick Mansuy', '507e2259057eb61d2d83b33034b83dbab7789eac857d9bae2e3873aa18ae9f1e', 415142510, 778543200, 'customer', '1273138280'),
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
