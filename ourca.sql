-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2015 at 11:14 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ourca`
--

-- --------------------------------------------------------

--
-- Table structure for table `pending_cert`
--

CREATE TABLE IF NOT EXISTS `pending_cert` (
  `idpending` int(11) NOT NULL,
  `userpending` varchar(50) NOT NULL,
  `datepending` datetime NOT NULL,
  `contentpending` text NOT NULL,
  `signed` tinyint(1) NOT NULL,
  PRIMARY KEY (`idpending`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signed_cert`
--

CREATE TABLE IF NOT EXISTS `signed_cert` (
  `idsigned` int(11) NOT NULL,
  `usersigned` varchar(50) NOT NULL,
  `datesigned` datetime NOT NULL,
  `contentsigned` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`idsigned`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `userpass` varchar(30) NOT NULL,
  `usertype` tinyint(1) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
