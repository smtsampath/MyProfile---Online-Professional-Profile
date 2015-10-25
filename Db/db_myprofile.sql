-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2014 at 05:54 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_myprofile`
--

-- --------------------------------------------------------

--
-- Table structure for table `up_cvs`
--

CREATE TABLE IF NOT EXISTS `up_cvs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_size` varchar(10) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `cv_location` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `up_cvs`
--

INSERT INTO `up_cvs` (`id`, `user_id`, `file_size`, `file_type`, `cv_location`) VALUES
(8, 1, '55559', 'application/pdf', 'up_cvs/smtsampath.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_basic`
--

CREATE TABLE IF NOT EXISTS `user_basic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pro_headline` text NOT NULL,
  `country` varchar(30) NOT NULL,
  `industry` text NOT NULL,
  `tel_number` varchar(12) NOT NULL,
  `tel_type` varchar(10) NOT NULL,
  `IM_name` varchar(25) NOT NULL,
  `IM_type` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `b_day` varchar(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `marital` varchar(8) NOT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_basic`
--

INSERT INTO `user_basic` (`id`, `user_id`, `pro_headline`, `country`, `industry`, `tel_number`, `tel_type`, `IM_name`, `IM_type`, `address`, `b_day`, `gender`, `marital`, `about`) VALUES
(1, 1, 'Student in Teesside University - UK', 'Sri Lankan', 'Information Services and Technology', '+94787053744', 'Mobile', 'smtsampath', 'Skype', 'No. 24/20, Balapokuna Place, Kirulapona, Colombo - 06, Sri Lanka', 'May-13-1987', 'Male', 'Single', 'I believe that I am a creative, trustworthy and a friendly person, who can manage and work effectively and who is a great team player, with good presentation skills.'),
(2, 3, 'Student', 'Sri Lankan', 'Natonal Institute Of Buisness Management', '+94717645845', 'Mobile', '', '', 'No. 306/50,sinhawasa, dadalle, galle', 'Sep-08-1988', 'Male', 'Single', 'iam a dedicate man who try to find new things..and i am a honest man'),
(3, 5, 'Student in Teesside University - UK', 'Sri Lankan', 'Information Services', '+94787053745', 'Home', '', '', 'Kurunagala', 'Jan-01-1987', 'Male', 'Single', ''),
(4, 6, 'Student in University of Adelaide', 'Sri Lankan', 'Business Management', '+94112433873', 'Home', 'sgkaruna', 'Skype', 'Rajagiriya', 'Jan-26-1988', 'Male', 'Single', ''),
(5, 7, 'Junior Software Engineer', 'Sri Lankan', 'Information Services and Technology', '+94779477814', 'Mobile', 'mkariyawasam', 'GTalk', 'Homagama', 'Jul-14-1987', 'Male', 'Single', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_edu`
--

CREATE TABLE IF NOT EXISTS `user_edu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `start_year` varchar(4) NOT NULL,
  `award_year` varchar(4) NOT NULL,
  `adi_notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_edu`
--

INSERT INTO `user_edu` (`id`, `user_id`, `school_name`, `degree`, `start_year`, `award_year`, `adi_notes`) VALUES
(1, 1, 'University of Teesside - UK', 'BSc (Hons) in Computing', '2010', '2011', ''),
(2, 1, 'Londontec City Campus - Sri lanka', 'HID in Computer Systems Engineering', '2008', '2010', ''),
(4, 3, 'NIBM', 'System Designing', '2009', '2013', ''),
(5, 6, 'University of Adelaide - AUS', 'Bsc (Hons) in Business Computing', '2008', '2012', ''),
(6, 7, 'SLIIT', 'BSc in Software Engineering', '2008', '2012', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `hashed_password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `reg_date` datetime NOT NULL,
  `s_question` varchar(5) NOT NULL,
  `s_answer` varchar(10) NOT NULL,
  `avatar_location` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `keywords` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `firstname`, `lastname`, `username`, `hashed_password`, `email`, `reg_date`, `s_question`, `s_answer`, `avatar_location`, `active`, `admin`, `keywords`) VALUES
(1, 'S. M. Thushara', 'Sampath', 'administrator', '164c70ed4e5d00661f24d332563a3c8cf3362cdb', 'smtsampath@gmail.com', '2011-01-06 19:52:35', 'SQ2', 'mallika', 'up_avatars/smtsampath.jpg', 1, 1, 'S. M. Thushara Sampath'),
(2, 'Tharindu Priyanka', 'Jayasinghe', 'tpsj001', '8a5915343dcc1a8367b19c930c0e40f93c6f2463', 'tpsj@gmail.com', '2011-01-07 08:31:54', 'SQ5', 'browni', 'up_avatars/default-avatar.gif', 0, 0, 'Tharindu Priyanka Jayasinghe'),
(3, 'Tharindu', 'Jayasinghe', 'shanbaba', '524aaf0dfb222bdf0ae428afebda672f05d39b60', 'gontharindu@gmail.com', '2011-01-07 10:52:12', 'SQ5', 'tabi', 'up_avatars/shanbaba.bmp', 1, 0, 'Tharindu Jayasinghe'),
(5, 'Nuwan', 'Chandana', 'enuwanlk', 'b4fcf3c41b0a311bc937050ae42789d424549180', 'enuwanlk@yahoo.com', '2011-01-07 11:01:17', 'SQ5', 'c', 'up_avatars/enuwanlk.jpg', 1, 0, 'Nuwan Chandana'),
(6, 'Sajitha Gihan', 'Karunagoda', 'sgkaruna', '8d4d46ea3ab7456e27356bfcceaa7e457c1f7a37', 'sgkarunagoda@live.com', '2011-01-08 14:12:19', 'SQ5', 'tomi', 'up_avatars/sgkaruna.bmp', 1, 0, 'Sajitha Gihan Karunagoda'),
(7, 'Muditha Lasantha', 'Kariyawasam', 'muditha', 'fb38c8c608161dcfaf22145a47302016a05efd13', 'mkariyawasam@yahoo.com', '2011-01-08 14:49:16', 'SQ1', '779477814', 'up_avatars/muditha.jpg', 1, 0, 'Muditha Lasantha Kariyawasam'),
(9, 'Sameera', 'Gamage', 'sudarakagamage', '64873782838f0c49d8aa661bc09347d7be550840', 'sudarakagamage@gmail.com', '2011-01-10 11:11:19', 'SQ3', 'Harry Pott', 'up_avatars/default-avatar.gif', 1, 0, 'Sameera Gamage'),
(10, 'lakshitha', 'Harshan', 'lakshij', '601f1889667efaebb33b8c12572835da3f027f78', 'lakshij@gmail.com', '2011-01-15 01:27:12', 'SQ1', '123457890', 'up_avatars/default-avatar.gif', 1, 0, 'lakshitha Harshan');

-- --------------------------------------------------------

--
-- Table structure for table `user_projects`
--

CREATE TABLE IF NOT EXISTS `user_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `about_project` text NOT NULL,
  `file_size` varchar(10) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `project_location` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_projects`
--

INSERT INTO `user_projects` (`id`, `user_id`, `project_name`, `about_project`, `file_size`, `file_type`, `project_location`) VALUES
(1, 1, 'Web Professionals', 'This Project was a build a website, that is able to access public users and they also have to make there own account and publich there professional profile. (This is a "Open Source" assignment project of Online Business module in Teesside University - UK).', '718650', 'application/octet-stream', 'up_projects/1295443515.rar');

-- --------------------------------------------------------

--
-- Table structure for table `user_works`
--

CREATE TABLE IF NOT EXISTS `user_works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `init_month` varchar(15) NOT NULL,
  `init_year` varchar(4) NOT NULL,
  `complete_month` varchar(15) NOT NULL,
  `complete_year` varchar(4) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_works`
--

INSERT INTO `user_works` (`id`, `user_id`, `company_name`, `job_title`, `init_month`, `init_year`, `complete_month`, `complete_year`, `description`) VALUES
(1, 1, 'Lanka Hospital ( Apollo ) - Colombo', 'Computer Data Entry Operator', 'March', '2009', 'October', '2010', ''),
(2, 7, 'Virtusa', 'Junior Software Engineer', 'March', '2010', 'January', '2011', ''),
(3, 3, 'Nawaloka Hospitals - Colombo', 'Pharmasist', 'September', '2007', 'December', '2009', '');
