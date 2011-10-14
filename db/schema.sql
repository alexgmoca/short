-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2011 at 07:09 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `short`
--

-- --------------------------------------------------------

--
-- Table structure for table `instance`
--

CREATE TABLE IF NOT EXISTS `instance` (
  `instance_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url_id` int(10) unsigned NOT NULL,
  `strkey` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL,
  `max_hits` int(10) unsigned DEFAULT NULL,
  `notify_email` varchar(255) DEFAULT NULL,
  `notes` text,
  `notifications` tinyint(1) DEFAULT '0',
  `validation_code` varchar(32) DEFAULT NULL,
  `private_stats` tinyint(4) DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `created_by_id` int(10) NOT NULL,
  PRIMARY KEY (`instance_id`),
  UNIQUE KEY `strkey` (`strkey`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(10) unsigned NOT NULL,
  `type` enum('create','access') DEFAULT NULL,
  `outcome` enum('ok','error') DEFAULT NULL,
  `tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client_ip` varchar(25) DEFAULT NULL,
  `client_host` varchar(255) DEFAULT NULL,
  `client_agent` text,
  `created_by_id` int(10) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `url_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`url_id`),
  UNIQUE KEY `url` (`url`(100))
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `user_email` varchar(40) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validation_code` varchar(32) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;