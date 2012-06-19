-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2012 at 09:00 AM
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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `title`, `name`, `address`, `city`, `state`, `telp`, `email`) VALUES
('4fd0967945431', 'mr', 'Denny', 'Gak tau', 'Batam', 'Indonesia', '08566584915', 'denny@inforsys.co.id');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE IF NOT EXISTS `paket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `detail` mediumtext NOT NULL,
  `amount` decimal(65,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `name`, `detail`, `amount`, `image`) VALUES
(9, 'Paket A', '1. Drum Rolling atau Santafe <br/>\r\n2. Hedcabinet Russel Gitar dan Bass<br/>\r\n3. Amplie Gitar Silvercress<br/>\r\n4. Gitar Extreme<br/>\r\n5. Gitar Bass Ibanez<br/>\r\n6. Gitar Melody Caraya<br/><br/>\r\n\r\nRusak Ganti Rugi ya', 500000, '9295211_3144171.jpg');

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
  `total` decimal(10,0) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id`, `norental`, `custid`, `rentaldate`, `expiredate`, `total`, `status`) VALUES
('4fd0967956f10', '4fd0967956ee9', '4fd0967945431', '2012-06-07 18:54:33', '2012-06-08 18:54:33', 400000, 'Booking');

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
  `total` decimal(10,0) NOT NULL,
  `returndate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `rentaldetail`
--

INSERT INTO `rentaldetail` (`id`, `paketid`, `rentalid`, `qty`, `term`, `total`, `returndate`) VALUES
(55, 9, '4fd0967956f10', 1, 1, 400000, '0000-00-00');

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
