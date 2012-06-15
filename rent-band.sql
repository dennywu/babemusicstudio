-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2012 at 05:42 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rent-band`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE IF NOT EXISTS `paket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `detail` mediumtext NOT NULL,
  `dendaperhari` decimal(10,0) NOT NULL,
  `amount` decimal(65,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `name`, `detail`, `dendaperhari`, `amount`, `image`) VALUES
(9, 'Paket A', '1. Drum Rolling atau Santafe <br/>\r\n2. Hedcabinet Russel Gitar dan Bass<br/>\r\n3. Amplie Gitar Silvercress<br/>\r\n4. Gitar Extreme<br/>\r\n5. Gitar Bass Ibanez<br/>\r\n6. Gitar Melody Caraya<br/><br/>\r\n\r\nRusak Ganti Rugi ya', 50000, 500000, '9295211_3144171.jpg'),
(10, 'Paket B', 'test', 30000, 300000, 'bmb_cs252v-3_02.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rentalid` varchar(255) NOT NULL,
  `paymentdate` datetime NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE IF NOT EXISTS `rental` (
  `id` varchar(255) NOT NULL,
  `norental` varchar(255) NOT NULL,
  `custid` varchar(255) NOT NULL,
  `rentaldate` datetime NOT NULL,
  `expiredate` datetime NOT NULL,
  `outstanding` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `status` varchar(255) NOT NULL,
  `isreturn` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rentaldetail`
--

CREATE TABLE IF NOT EXISTS `rentaldetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paketid` int(11) NOT NULL,
  `rentalid` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `denda` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `returndate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
