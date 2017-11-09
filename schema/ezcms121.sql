-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2016 at 12:49 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezcms121`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE IF NOT EXISTS `active_users` (
  `Username` varchar(45) NOT NULL DEFAULT '',
  `Time_loggedin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE IF NOT EXISTS `banned_users` (
  `Username` varchar(45) NOT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_users`
--

CREATE TABLE IF NOT EXISTS `blocked_users` (
  `Username` varchar(45) NOT NULL DEFAULT '',
  `Time_blocked` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `forum_category`
--

CREATE TABLE IF NOT EXISTS `forum_category` (
  `Id` int(11) unsigned NOT NULL,
  `CatName` varchar(255) DEFAULT NULL,
  `CatDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_category`
--

INSERT INTO `forum_category` (`Id`, `CatName`, `CatDescription`) VALUES
(1, 'Food and Nutrition', 'Healthy diet, Vitamins, and Minerals'),
(2, 'Cookies and Pastries', 'Cakes, Cookies, Biscults, Bread'),
(3, 'Computers and Information', 'Computer, Information and Data');

-- --------------------------------------------------------

--
-- Table structure for table `forum_post`
--

CREATE TABLE IF NOT EXISTS `forum_post` (
  `Id` int(11) unsigned NOT NULL,
  `PostContent` text,
  `PostDate` datetime DEFAULT NULL,
  `TopicId` int(11) DEFAULT NULL,
  `PostedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_post`
--

INSERT INTO `forum_post` (`Id`, `PostContent`, `PostDate`, `TopicId`, `PostedBy`) VALUES
(1, 'To be healthy you need to eat good food and drink a lot of water every day to avoid sickness', '2015-09-04 00:00:00', 1, 1),
(2, 'Exercise at least 5mins a day', '2015-09-04 00:00:00', 2, 1),
(3, 'More post on cookies and patries', '2015-09-10 00:00:00', 3, 1),
(4, 'This is a test post topic content for cookies and pastries category.... more and more posts', '2015-09-10 00:00:00', 4, 1),
(5, 'A Computer hardware is the physical component that can be seen and touch...', '2015-10-13 00:00:00', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_replies`
--

CREATE TABLE IF NOT EXISTS `forum_replies` (
  `Id` int(11) unsigned NOT NULL,
  `ReplyContent` text,
  `ReplyDate` date DEFAULT NULL,
  `RepliedBy` int(11) DEFAULT NULL,
  `TopicId` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_replies`
--

INSERT INTO `forum_replies` (`Id`, `ReplyContent`, `ReplyDate`, `RepliedBy`, `TopicId`) VALUES
(1, 'good food is healthy indeed.', '0000-00-00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `Id` int(11) unsigned NOT NULL,
  `TopicSubject` varchar(255) DEFAULT NULL,
  `TopicDate` datetime DEFAULT NULL,
  `Catid` int(11) DEFAULT NULL,
  `Topicby` int(11) DEFAULT NULL,
  `Views` int(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`Id`, `TopicSubject`, `TopicDate`, `Catid`, `Topicby`, `Views`) VALUES
(1, 'Eat Healty Diet', '2015-09-04 00:00:00', 1, 1, 0),
(2, 'Good Excercise', '2015-09-04 00:00:00', 1, 1, 0),
(3, 'Eat a lot of cookies is a way of good health', '2015-09-10 00:00:00', 2, 1, 0),
(4, 'Are Pastries good for our Health?', '2015-09-10 00:00:00', 2, 1, 0),
(5, 'Hardware Lessons', '2015-10-13 00:00:00', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `guest_users`
--

CREATE TABLE IF NOT EXISTS `guest_users` (
  `Ip` varchar(50) NOT NULL,
  `Guest_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mailing_list`
--

CREATE TABLE IF NOT EXISTS `mailing_list` (
  `Id` int(10) unsigned NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `DateSubscribed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `Id` int(11) unsigned NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Body` text NOT NULL,
  `Authorid` int(10) DEFAULT NULL,
  `Dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Position` int(30) DEFAULT NULL,
  `Publish` enum('Y','N') DEFAULT 'N',
  `Feature` enum('Y','N') DEFAULT 'N',
  `Views` int(30) DEFAULT '0',
  `Comments` int(30) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`Id`, `Title`, `Body`, `Authorid`, `Dateposted`, `Position`, `Publish`, `Feature`, `Views`, `Comments`) VALUES
(1, 'My New Page Title', 'How many is your information', 1, '2015-08-25 14:58:17', 1, 'N', 'Y', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `page_category`
--

CREATE TABLE IF NOT EXISTS `page_category` (
  `Id` int(10) unsigned NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Visible` enum('Y','N') DEFAULT NULL,
  `Position` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_category`
--

INSERT INTO `page_category` (`Id`, `Name`, `Description`, `Visible`, `Position`) VALUES
(1, 'News', 'news info', 'Y', 1),
(2, 'Entertainment', 'Entertainment ', 'Y', 2);

-- --------------------------------------------------------

--
-- Table structure for table `page_comments`
--

CREATE TABLE IF NOT EXISTS `page_comments` (
  `Id` int(10) unsigned NOT NULL,
  `Author` varchar(100) DEFAULT NULL,
  `Message` tinytext,
  `Pageid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `page_images`
--

CREATE TABLE IF NOT EXISTS `page_images` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Width` int(5) DEFAULT NULL,
  `Height` int(5) DEFAULT NULL,
  `Description` tinytext,
  `Mimetype` varchar(50) DEFAULT NULL,
  `Extention` varchar(10) DEFAULT NULL,
  `Pageid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_images`
--

INSERT INTO `page_images` (`Id`, `Name`, `Width`, `Height`, `Description`, `Mimetype`, `Extention`, `Pageid`) VALUES
(1, '55dc8289efca7_artic.jpg', 240, 160, '', 'image/jpeg', 'jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `Id` int(10) unsigned NOT NULL,
  `Role` varchar(50) NOT NULL,
  `AuthLevel` int(5) DEFAULT NULL,
  `Lastmodified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Id`, `Role`, `AuthLevel`, `Lastmodified`) VALUES
(1, 'Administrator', 1, '2015-08-14 19:50:51'),
(2, 'Moderator', 2, '2015-08-14 19:55:50'),
(3, 'Editor', 3, '2015-08-14 19:55:50'),
(4, 'User', 4, '2015-08-14 19:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `subnav`
--

CREATE TABLE IF NOT EXISTS `subnav` (
  `Id` int(11) unsigned NOT NULL,
  `Navid` int(11) DEFAULT NULL,
  `SubNavname` varchar(20) NOT NULL,
  `SubNavlevel` int(5) DEFAULT '2',
  `Position` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) unsigned NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(40) NOT NULL,
  `Gender` enum('M','F') NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(255) DEFAULT 'admin@example.com',
  `Authlevel` int(5) DEFAULT NULL,
  `Notification` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Firstname`, `Lastname`, `Gender`, `Username`, `Password`, `Email`, `Authlevel`, `Notification`) VALUES
(1, 'Abdul-Rahman', 'Sarpong', 'M', 'Admin', '$2y$11$PAW7BYENXXo1FeJECdfSdut/yWtA3IUl6RdZ0RHYWKbjBRcz3b5cC', 'admin@example.com', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_options`
--

CREATE TABLE IF NOT EXISTS `user_options` (
  `Id` int(11) unsigned NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Question` varchar(255) DEFAULT NULL,
  `Answer` varchar(255) DEFAULT NULL,
  `Status` enum('active','inactive','blocked') DEFAULT 'active',
  `Website` varchar(255) DEFAULT NULL,
  `TempPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `forum_category`
--
ALTER TABLE `forum_category`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `idx_catname` (`CatName`) USING BTREE;

--
-- Indexes for table `forum_post`
--
ALTER TABLE `forum_post`
  ADD PRIMARY KEY (`Id`),
  ADD FULLTEXT KEY `idx_cont` (`PostContent`);

--
-- Indexes for table `forum_replies`
--
ALTER TABLE `forum_replies`
  ADD PRIMARY KEY (`Id`),
  ADD FULLTEXT KEY `idx_cont` (`ReplyContent`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Catid` (`Catid`),
  ADD KEY `Catid_2` (`Catid`);

--
-- Indexes for table `guest_users`
--
ALTER TABLE `guest_users`
  ADD PRIMARY KEY (`Ip`),
  ADD UNIQUE KEY `Ip` (`Ip`);

--
-- Indexes for table `mailing_list`
--
ALTER TABLE `mailing_list`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Position` (`Position`),
  ADD FULLTEXT KEY `idx_body` (`Body`);

--
-- Indexes for table `page_category`
--
ALTER TABLE `page_category`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Position` (`Position`);

--
-- Indexes for table `page_comments`
--
ALTER TABLE `page_comments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `page_images`
--
ALTER TABLE `page_images`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `AuthLevel` (`AuthLevel`);

--
-- Indexes for table `subnav`
--
ALTER TABLE `subnav`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `uniq_navname` (`SubNavname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `unique_username` (`Username`),
  ADD KEY `AuthLevel` (`Authlevel`);

--
-- Indexes for table `user_options`
--
ALTER TABLE `user_options`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum_category`
--
ALTER TABLE `forum_category`
  MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `forum_post`
--
ALTER TABLE `forum_post`
  MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `forum_replies`
--
ALTER TABLE `forum_replies`
  MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mailing_list`
--
ALTER TABLE `mailing_list`
  MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `page_category`
--
ALTER TABLE `page_category`
  MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `page_comments`
--
ALTER TABLE `page_comments`
  MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `page_images`
--
ALTER TABLE `page_images`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subnav`
--
ALTER TABLE `subnav`
  MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_options`
--
ALTER TABLE `user_options`
  MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
