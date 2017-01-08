-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2014 at 09:33 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `firedepot`
--
CREATE DATABASE IF NOT EXISTS `firedepot` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `firedepot`;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `itm_id` int(11) NOT NULL AUTO_INCREMENT,
  `itm_code` varchar(12) NOT NULL,
  `itm_name` text NOT NULL,
  `itm_unt` varchar(11) NOT NULL,
  `itm_price` float NOT NULL,
  `itm_desc` text NOT NULL,
  PRIMARY KEY (`itm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `items`
--

TRUNCATE TABLE `items`;
--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itm_id`, `itm_code`, `itm_name`, `itm_unt`, `itm_price`, `itm_desc`) VALUES
(1, '140420005136', 'PVC PIPES', 'pcs', 561.78, '50mm x 6m');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `prj_id` int(11) NOT NULL AUTO_INCREMENT,
  `prj_code` text NOT NULL,
  `prj_name` text NOT NULL,
  `prj_loc` text NOT NULL,
  `prj_desc` text NOT NULL,
  PRIMARY KEY (`prj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `projects`
--

TRUNCATE TABLE `projects`;
--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`prj_id`, `prj_code`, `prj_name`, `prj_loc`, `prj_desc`) VALUES
(1, '557', 'PTC South', 'Bry. Carsadang Bago, Imus, Cavite', 'Town House'),
(2, '558', 'Garden of Eden', 'Tipo-tipo , Basilan', 'Hotel and Resort');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `rec_rnum` varchar(11) NOT NULL,
  `itm_qty` float NOT NULL,
  `itm_code` varchar(12) NOT NULL,
  `itm_sup` text NOT NULL,
  `itm_price` float NOT NULL,
  `prj_code` int(11) NOT NULL,
  `rec_date` text NOT NULL,
  `rec_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rec_type` text NOT NULL,
  PRIMARY KEY (`rec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Truncate table before insert `records`
--

TRUNCATE TABLE `records`;
--
-- Dumping data for table `records`
--

INSERT INTO `records` (`rec_id`, `rec_rnum`, `itm_qty`, `itm_code`, `itm_sup`, `itm_price`, `prj_code`, `rec_date`, `rec_ts`, `rec_type`) VALUES
(1, 'PSL 3695', 7, '140420005136', '544 - PWW', 561.78, 1, '2010-09-29', '2014-04-20 00:52:00', 'RECEIVE'),
(2, '4926', 127, '140420005136', 'Moldex', 458.06, 1, '2010-11-10', '2014-04-20 00:53:05', 'RECEIVE'),
(3, '13439', 2, '140420005136', 'Waterline', 561.78, 1, '2011-01-03', '2014-04-20 01:41:17', 'ISSUE'),
(4, '13441', 22, '140420005136', 'Waterline', 561.78, 1, '2011-01-04', '2014-04-20 01:42:05', 'ISSUE'),
(5, '13447', 3, '140420005136', 'Waterline', 561.78, 1, '2011-01-10', '2014-04-20 01:42:50', 'ISSUE'),
(6, '13449', 17, '140420005136', 'Waterline', 561.78, 1, '2011-01-11', '2014-04-20 01:44:26', 'ISSUE'),
(7, '13449', 3, '140420005136', 'Waterline', 561.78, 1, '2011-01-11', '2014-04-20 01:45:07', 'ISSUE'),
(8, '13502', 4, '140420005136', 'Waterline', 561.78, 1, '2011-01-13', '2014-04-20 01:46:45', 'ISSUE'),
(9, '13510', 12, '140420005136', 'Waterline', 561.78, 1, '2011-01-22', '2014-04-20 01:47:25', 'ISSUE'),
(10, '13519', 2, '140420005136', 'Waterline', 561.78, 1, '2011-01-28', '2014-04-20 01:48:54', 'ISSUE'),
(11, '13525', 4, '140420005136', 'Waterline', 561.78, 1, '2011-02-04', '2014-04-20 01:49:32', 'ISSUE'),
(13, 'PSL 5253', 1, '140420005136', '560-MPL', 561.78, 1, '2011-03-18', '2014-04-20 01:55:48', 'ISSUE'),
(14, '13757', 5, '140420005136', '560-MPL', 355.96, 1, '2011-08-01', '2014-04-20 02:04:34', 'ISSUE'),
(15, '13778', 20, '140420005136', '-', 355.96, 1, '2011-09-15', '2014-04-20 02:06:32', 'ISSUE'),
(16, '13781', 10, '140420005136', '-', 355.96, 1, '2011-09-19', '2014-04-20 02:07:14', 'ISSUE'),
(17, '13788', 2, '140420005136', '-', 355.96, 1, '2011-10-05', '2014-04-20 02:07:48', 'ISSUE'),
(18, '13790', 4, '140420005136', '-', 355.96, 1, '2011-10-10', '2014-04-20 02:08:25', 'ISSUE'),
(19, '13799', 5, '140420005136', '-', 355.96, 1, '2011-10-25', '2014-04-20 02:11:01', 'ISSUE'),
(20, '13889', 6, '140420005136', '-', 355.96, 1, '2012-01-10', '2014-04-20 02:11:34', 'ISSUE'),
(21, '13894', 5, '140420005136', '-', 355.96, 1, '2012-01-15', '2014-04-20 02:12:06', 'ISSUE');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `itm_id` varchar(12) NOT NULL,
  `stk_qty` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  PRIMARY KEY (`stk_id`),
  KEY `prj_id` (`prj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `stocks`
--

TRUNCATE TABLE `stocks`;
--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stk_id`, `itm_id`, `stk_qty`, `prj_id`) VALUES
(1, '140420005136', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_name` text NOT NULL,
  `usr_pass` text NOT NULL,
  `usr_level` text NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_pass`, `usr_level`) VALUES
(1, 'admin', 'SrTIoUaf9Mzf1mlGV61zL4TnP9wYQn0T7nXXLes9uyo=', 'ADMIN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
