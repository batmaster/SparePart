-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 24, 2015 at 01:57 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `sparepart`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `board`
-- 

CREATE TABLE `board` (
  `id` int(11) NOT NULL auto_increment,
  `brand` varchar(32) collate utf8_unicode_ci NOT NULL,
  `model` varchar(32) collate utf8_unicode_ci NOT NULL,
  `sn` varchar(32) collate utf8_unicode_ci NOT NULL,
  `type` varchar(32) collate utf8_unicode_ci NOT NULL,
  `date` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `board`
-- 

INSERT INTO `board` VALUES (7, 'ERICSSON', '875', 'A000001', 'เลขหมาย', '2015-11-09 15:52');
INSERT INTO `board` VALUES (8, 'ERICSSON', '875', 'A000002', 'เลขหมาย', '2015-11-09 15:53');

-- --------------------------------------------------------

-- 
-- Table structure for table `transaction`
-- 

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL auto_increment,
  `number` varchar(32) collate utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL,
  `location` varchar(32) collate utf8_unicode_ci NOT NULL,
  `date` varchar(20) collate utf8_unicode_ci NOT NULL,
  `note` varchar(32) collate utf8_unicode_ci NOT NULL,
  `done` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `transaction`
-- 

INSERT INTO `transaction` VALUES (2, 'added', 1, '', '2015-11-09 15:52', '', 0);
INSERT INTO `transaction` VALUES (3, 'added', 1, '', '2015-11-09 15:53', '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `transaction_order`
-- 

CREATE TABLE `transaction_order` (
  `id` int(11) NOT NULL auto_increment,
  `board_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `transaction_order`
-- 

INSERT INTO `transaction_order` VALUES (1, 8, 3);
