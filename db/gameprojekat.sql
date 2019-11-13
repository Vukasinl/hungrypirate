-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2019 at 11:06 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameprojekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `gamestats`
--

DROP TABLE IF EXISTS `gamestats`;
CREATE TABLE IF NOT EXISTS `gamestats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heroname` tinytext NOT NULL,
  `active` int(2) DEFAULT '1',
  `coins` int(11) DEFAULT '0',
  `score` int(50) DEFAULT '0',
  `food` int(4) DEFAULT '100',
  `roomcolor` tinytext NOT NULL,
  `fridge` varchar(10) DEFAULT 'eeeeee',
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamestats`
--

INSERT INTO `gamestats` (`id`, `heroname`, `active`, `coins`, `score`, `food`, `roomcolor`, `fridge`, `userid`) VALUES
(1, 'Pera', 0, 1, 1, 99, 'white', 'eeeeee', 1),
(2, 'Perica', 0, 1, 1, 99, 'blue', 'aeeeee', 1),
(3, 'Petar', 1, 1, 1, 99, 'blue', 'eeeeee', 2),
(4, 'Miki', 0, 17, 100, 0, 'blue', 'aeeeee', 1),
(5, 'Test', 0, 154, 6, 0, 'white', 'eeeeee', 1),
(6, 'Testic', 0, 149, 140, -40, 'yellow', 'eeeeee', 1),
(7, 'Tttest', 0, 35, 5, -1, 'blue', 'eeeeee', 1),
(8, 'ldlsall', 0, 33, 12, -8, 'blue', 'eeeeee', 1),
(9, 'Marko', 1, 1200, 14, 86, 'red', 'eeeeee', 1),
(10, 'Testhero', 1, 0, 0, 2, 'green', 'eeeeee', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `pwd` longtext NOT NULL,
  `permission` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pwd`, `permission`) VALUES
(1, 'Vukasin', 'vukasin@gmail.com', '$2y$10$kFicqgZf6qiLLHQugttI4upACos/YOvWUd0o4N16BbKQQGfjMVoCq', 1),
(2, 'Testuser', 'test@gmail.com', '$2y$10$32Js8TBghrg7B0O2hN8ifeDdM4x1JiB0GtGd61TbSuIN5kfmDNQDu', 1),
(3, 'Test1', 'testtt@gmail.com', '$2y$10$on4NooDTFluQZcPkc/PXLu12aRuByZoouvpVLWeOYS/EJAHDeQj0G', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
