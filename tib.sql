-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2016 at 11:33 PM
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
  `online` bigint(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`file`,`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`file`, `lastmodified`, `user`, `online`) VALUES
('bobs.burgers@gmail.com-alice_picksley@hotmail.com.xml', 1477551889, 'alice_picksley@hotmail.com', 1),
('bobs.burgers@gmail.com-alice_picksley@hotmail.com.xml', 1477551889, 'bobs.burgers@gmail.com', 1477551889),
('bobs.burgers@gmail.com-boop@boop.com.xml', 1477551892, 'bobs.burgers@gmail.com', 1477551892),
('bobs.burgers@gmail.com-boop@boop.com.xml', 1477551892, 'boop@boop.com', 1),
('bobs.burgers@gmail.com-ze_yaya@yahoo.fr.xml', 1477551868, 'bobs.burgers@gmail.com', 1477553782),
('bobs.burgers@gmail.com-ze_yaya@yahoo.fr.xml', 1477551868, 'ze_yaya@yahoo.fr', 1477562151),
('boop@boop.com-elias@gebre.com.xml', 1476336307, 'boop@boop.com', 1476336556),
('boop@boop.com-elias@gebre.com.xml', 1476336307, 'elias@gebre.com', 1476336874),
('boop@boop.com-gayporndirector@grindr.com.xml', 1476318979, 'boop@boop.com', 1476336470),
('boop@boop.com-gayporndirector@grindr.com.xml', 1476318979, 'gayporndirector@grindr.com', 0),
('boop@boop.com-ze_yaya@yahoo.fr.xml', 1476319088, 'boop@boop.com', 1476336471),
('boop@boop.com-ze_yaya@yahoo.fr.xml', 1476319088, 'ze_yaya@yahoo.fr', 1476336631),
('christopher.d.dare@gmail.com-driver@drop.it.xml', 1477562182, 'christopher.d.dare@gmail.com', 1477562185),
('christopher.d.dare@gmail.com-driver@drop.it.xml', 1477562182, 'driver@drop.it', 1477573032),
('christopher.d.dare@gmail.com-gayporndirector@grindr.com.xml', 1476342010, 'christopher.d.dare@gmail.com', 1476342010),
('christopher.d.dare@gmail.com-gayporndirector@grindr.com.xml', 1476342010, 'gayporndirector@grindr.com', 0),
('driver@drop.it-ze_yaya@yahoo.fr.xml', 1477490919, 'driver@drop.it', 1477492688),
('driver@drop.it-ze_yaya@yahoo.fr.xml', 1477490919, 'ze_yaya@yahoo.fr', 1477490920),
('elias@gebre.com-alice_picksley@hotmail.com.xml', 1476602574, 'alice_picksley@hotmail.com', 0),
('elias@gebre.com-alice_picksley@hotmail.com.xml', 1476602574, 'elias@gebre.com', 1476617509),
('elias@gebre.com-gayporndirector@grindr.com.xml', 1476336456, 'elias@gebre.com', 1476336490),
('elias@gebre.com-gayporndirector@grindr.com.xml', 1476336456, 'gayporndirector@grindr.com', 0),
('ze_yaya@yahoo.fr-alice_picksley@hotmail.com.xml', 1477490925, 'alice_picksley@hotmail.com', 1476436689),
('ze_yaya@yahoo.fr-alice_picksley@hotmail.com.xml', 1477490925, 'ze_yaya@yahoo.fr', 1477490925),
('ze_yaya@yahoo.fr-boop@boop.com.xml', 1476430761, 'boop@boop.com', 0),
('ze_yaya@yahoo.fr-boop@boop.com.xml', 1476430761, 'ze_yaya@yahoo.fr', 1476430761),
('ze_yaya@yahoo.fr-christopher.d.dare@gmail.com.xml', 1477562319, 'christopher.d.dare@gmail.com', 1477571298),
('ze_yaya@yahoo.fr-christopher.d.dare@gmail.com.xml', 1477562319, 'ze_yaya@yahoo.fr', 1477562368),
('ze_yaya@yahoo.fr-elias@gebre.com.xml', 1477490923, 'elias@gebre.com', 1476336857),
('ze_yaya@yahoo.fr-elias@gebre.com.xml', 1477490923, 'ze_yaya@yahoo.fr', 1477490923),
('ze_yaya@yahoo.fr-gayporndirector@grindr.com.xml', 1477381002, 'gayporndirector@grindr.com', 0),
('ze_yaya@yahoo.fr-gayporndirector@grindr.com.xml', 1477381002, 'ze_yaya@yahoo.fr', 1477381002);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`ID`, `user`, `driver`, `origin`, `destination`, `name`, `pickup`, `dropoff`, `cost`, `type`, `paid`, `date_paid`, `fragile`, `special`, `status`) VALUES
(39, 'christopher.d.dare@gmail.com', 'driver@drop.it', 'here', 'there', 'Him', 1477549320, 1477549480, 100.00, 'first', 1, 1477571741, 0, '', 'Awaiting Pick Up'),
(41, 'christopher.d.dare@gmail.com', 'driver@drop.it', 'Brisbane City', 'Logan', 'Germs', 1477553000, 1477638000, 100.00, 'standard', 0, NULL, 0, '', 'In Transit'),
(42, 'customer@drop.it', 'driver@drop.it', 'Brisbane', 'sydn', 'Tom', 1477534000, 1477580850, 43.00, 'first', 0, NULL, 0, 'hury up', 'Awaiting Pick Up'),
(43, 'customer@drop.it', NULL, 'Queens st, Brisbane , 4000 QLD', 'Albert St, Brisbane, 4000, QLD', 'Nick', 1477549980, 1477609740, 80.00, 'standard', 0, NULL, 0, '', 'Awaiting Pick Up');

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
(41, 1477549980, 'brisbane');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`ID`, `delivery_ID`, `weight`, `content`) VALUES
(49, 39, 10.00, 'dank kush'),
(51, 41, 0.50, 'Laptops'),
(52, 42, 3.00, 'boo'),
(53, 43, 0.52, 'Lollies'),
(54, 43, 0.50, 'candy');

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
('alice_picksley@hotmail.com', 'Alice Picksley', '6f0458e3b3c9442c2db7f01541d3c9fd32325aa58a3979fe95edac196f153ca4', 458527102, 691938000, 'driver', '2167879673'),
('bobo@123.com', 'momo', '38709a919261367d672f301a7bf4bf6eebbb9dc247c7089f244a27d4bfb31a85', 412324234, -20070288000, 'customer', '6304026003'),
('bobs.burgers@gmail.com', 'Bob Dude', '4e80c0666dda80fc085ca5ece03701d37aa20ed0f43a272b52cf0ad43ac7aaef', 418966685, 1063288800, 'driver', '3705394756'),
('boop@boop.com', 'Jimbo Barnes', '05d1d62ca0e54a69075418b8005cbbc4d87ea5a3318485ea125bfdf2f8d6b4ae', 123456789, 1376092800, 'driver', '8096290859'),
('christopher.d.dare@gmail.com', 'Christopher Dare', '09a6db26dbc212784999be9aeeab0bb7d7c58cea1e3fa372251e00b51bcc925c', 487906073, 834105600, 'manager', '1675978708'),
('customer@drop.it', 'Test Customer', '6b641a2940d9b60bc14be0a89f6b8ca746c6da16999361632a89950455a34caa', 411223344, 1792418400, 'customer', '8889898532'),
('driver@drop.it', 'Test Driver', '81bab50cc4f381a2a8ce6900a11a437c3ac7a34d9a00e55c8db0d5b9edb298a7', 415143226, 1065967200, 'driver', '2690176758'),
('eli@gebi.com', 'eli gebi', 'c953fd779b264d56bf5af601414ad72296beaca41fdb850aedbbf0bce15ba33a', 411111111, 1704276000, 'customer', '3211214449'),
('elias@gebre.com', 'elias gebre', 'e8dedad7dc8071626111f7fd376c1397bda58f5d651a4031d2b4523a0e4c08f0', 411223344, 1062597600, 'driver', '8905364978'),
('elias@mehari.com', 'eg', '93f903bd704af8eeda27b44d734d43fdb6465b1a9e966b4f6edde36cf2d7d498', 411111111, 1064930400, 'customer', '1091917166'),
('gayporndirector@grindr.com', 'Wayne Kerr', '1fe60dd872032fc62b210ea423d3d2a57ab462d7629db85dcf737fc6a1201fee', 422334455, 1062511200, 'driver', '7019026535'),
('geoff@geoff.geoff', 'geoff', '7b62a15dd917e3d4aacfb671b11d93d4ff49411075323855cff3f0c985b360b8', 234234242, 943884000, 'customer', '6050932761'),
('m.ramanathan@qut.edu.au', 'Muthu Ramanathan', '8e62c2d4ccb29da2c7c8def417f383953d2d70381161f213b4a1296b950a6b0e', 412345678, 979826400, 'customer', '6480240188'),
('mama@miya.com', 'Mama Miya', '6ba87687f072476ed80917ec135d5613144974cb0489ee2e05886535d339e992', 444332211, 1475193600, 'customer', '367552246'),
('nigerianprince69@notascam.com', 'Prince Abdula ', 'd4e90968cbe5b1738c2bc7111a359d6ea0a53becf1dbbe622c9419b3c9b8b14b', 469696969, 1054648800, 'customer', '8692919057'),
('pop@pop.com', 'Jimbo Barnes', 'd4998497856212f68d7e3df0b01bbd94cc6707c3c19d9d540ef2a3046c9ecccd', 123456789, 1473724800, 'customer', '9859973397'),
('test@drop.it', 'test', 'ee7ba4da91836d6ed69c1933dbd0fa0db6883536922a67781d7200fc71844f9c', 418947034, 1065103200, 'customer', '3063470977'),
('test@dropi.it', 'test', '204041bab9a9e3f329ea8a9ce30e8a9d89d7198f8c12f616b06d86b8ef89590b', 418988769, 1064930400, 'customer', '9755952288'),
('yu@tu.com', 'yu', 'c15f3aef1b387acc9d98ee65844f206e7ba88c256624badfe9f578640729ec4d', 425451123, 1047132000, 'customer', '8527280115'),
('ze_yaya@msn.com', 'Yannick Mansuy', '507e2259057eb61d2d83b33034b83dbab7789eac857d9bae2e3873aa18ae9f1e', 415142510, 778543200, 'customer', '1273138280'),
('ze_yaya@yahoo.fr', 'Yannick Mansuy', 'bf7591dfca9a8ca0003c6f3dfd8abf169b9749eb1b5fa1b594979a9ef0a10d66', 415142510, 1063893600, 'driver', '4948988030');

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
