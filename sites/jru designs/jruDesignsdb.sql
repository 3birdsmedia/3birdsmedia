-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2011 at 06:45 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jruDesignsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutText`
--

CREATE TABLE IF NOT EXISTS `aboutText` (
  `about_id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `aboutHeader` varchar(25) NOT NULL,
  `aboutBody` varchar(25000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`about_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `aboutText`
--


-- --------------------------------------------------------

--
-- Table structure for table `homeText`
--

CREATE TABLE IF NOT EXISTS `homeText` (
  `text_id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `homeHeader` varchar(25) NOT NULL,
  `homeBody` varchar(25000) NOT NULL,
  `date` varchar(25) NOT NULL,
  PRIMARY KEY (`text_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `homeText`
--

INSERT INTO `homeText` (`text_id`, `homeHeader`, `homeBody`, `date`) VALUES
(1, 'Jru is up', 'What up!', '0000-00-00'),
(2, 'Jru is up', 'What up!', ''),
(3, 'Test', 'This is just a test', ''),
(4, 'Test', 'This is just a test', ''),
(5, '', '<span style="font-family: impact;">Hello</span>, testing the<span style="font-weight: bold;"> wizziwyg</span><br>', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, '1', '1');
