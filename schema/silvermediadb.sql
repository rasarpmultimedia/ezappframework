-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2016 at 01:54 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silvermediadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `Album_id` int(11) UNSIGNED NOT NULL,
  `Album_name` varchar(45) NOT NULL,
  `Artist_name` varchar(50) NOT NULL,
  `Album_description` tinytext,
  `Cover_art` varchar(255) DEFAULT NULL,
  `Date_released` datetime DEFAULT NULL,
  `Numof_tracks` int(30) DEFAULT NULL,
  `Member_id` int(11) UNSIGNED NOT NULL,
  `Track_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`Album_id`, `Album_name`, `Artist_name`, `Album_description`, `Cover_art`, `Date_released`, `Numof_tracks`, `Member_id`, `Track_id`) VALUES
(1, 'Break Through', 'Bisa Kdei', 'New album realease in 2016', 'bisakdie_album_cover.png', '2015-12-23 00:00:00', 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `Blog_id` int(10) UNSIGNED NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Posts` text,
  `Approved` enum('Y','N') DEFAULT 'N',
  `Views` int(11) DEFAULT NULL,
  `NumofComments` int(11) DEFAULT NULL,
  `Member_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blogcomments`
--

CREATE TABLE `blogcomments` (
  `Comment_id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Email` varchar(60) DEFAULT NULL,
  `Comment` tinytext,
  `Comment_date` date DEFAULT NULL,
  `Blog_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Login_id` int(10) UNSIGNED NOT NULL,
  `Accesslevel` enum('A','M','E','U') DEFAULT 'U',
  `Username` varchar(45) DEFAULT NULL,
  `Email` varchar(60) DEFAULT NULL,
  `Password` varchar(60) DEFAULT NULL,
  `Lastlogged_in` datetime NOT NULL,
  `Member_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Login_id`, `Accesslevel`, `Username`, `Email`, `Password`, `Lastlogged_in`, `Member_id`) VALUES
(1, 'A', 'fadanash', 'fadanash@gmail.com', '$2y$11$hz.XLMhprnVgAhGMrku38.sRViF8j5RD.lNuH.1yLESzlk0V7ZYPi', '2016-05-26 00:00:00', 1),
(3, 'M', 'enersto15', 'fadanash@yahoo.com', '$2y$11$8hwhW1mnm7oiALEIADbYR.IvD2CRqgRIiWUKORVFaOg90SMEXDuwu', '2016-06-01 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `Member_id` int(10) UNSIGNED NOT NULL,
  `Surname` varchar(45) DEFAULT NULL,
  `Firstname` varchar(45) DEFAULT NULL,
  `Gender` enum('M','F') DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `Subscribed` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`Member_id`, `Surname`, `Firstname`, `Gender`, `Avatar`, `Subscribed`) VALUES
(1, 'Sarpong', 'Abdul-Rahman', 'M', '577b94c064106_IMG_20160701_073018.jpg', 'Y'),
(3, 'Sarpong', 'Enersto', 'M', '5773bfac6dad1_cover.jpg', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `member_info`
--

CREATE TABLE `member_info` (
  `Member_id` int(11) UNSIGNED NOT NULL,
  `Temp_password` varchar(255) DEFAULT NULL,
  `Security_Question` varchar(60) DEFAULT NULL,
  `Answer` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_info`
--

INSERT INTO `member_info` (`Member_id`, `Temp_password`, `Security_Question`, `Answer`) VALUES
(1, '1345656', 'What is your first name?', 'Rahman');

-- --------------------------------------------------------

--
-- Table structure for table `music_collection`
--

CREATE TABLE `music_collection` (
  `Album_id` int(11) NOT NULL,
  `Track_id` int(11) NOT NULL,
  `Genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `music_collection`
--

INSERT INTO `music_collection` (`Album_id`, `Track_id`, `Genre_id`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `music_genre`
--

CREATE TABLE `music_genre` (
  `Genre_id` int(11) NOT NULL,
  `Genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `music_genre`
--

INSERT INTO `music_genre` (`Genre_id`, `Genre`) VALUES
(1, 'Hip Life'),
(2, 'High Life');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `News_id` int(11) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Body` text,
  `Published` enum('Y','N') DEFAULT 'N',
  `Featured` enum('Y','N') DEFAULT 'N',
  `Date_published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Publishedby` int(11) UNSIGNED NOT NULL,
  `Source` varchar(40) DEFAULT NULL,
  `Views` int(11) DEFAULT '0',
  `NumofComments` int(11) DEFAULT '0',
  `Category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`News_id`, `Title`, `Body`, `Published`, `Featured`, `Date_published`, `Publishedby`, `Source`, `Views`, `NumofComments`, `Category_id`) VALUES
(1, 'Sark and Manifest in a beef ooo paa', 'Ghanaian mu supper star sarkordie and renowned rapper manifest are having a beef with each other, the two musician has been on each other for some time now and it is appalling....', 'Y', 'Y', '2016-07-05 23:39:47', 1, 'Silvermedia gh', 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `newscategory`
--

CREATE TABLE `newscategory` (
  `Category_id` int(10) UNSIGNED NOT NULL,
  `Category_name` varchar(45) DEFAULT NULL,
  `Position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newscategory`
--

INSERT INTO `newscategory` (`Category_id`, `Category_name`, `Position`) VALUES
(1, 'News', 1),
(2, 'Celebrities Gossip', 2),
(3, 'Blogs', 3);

-- --------------------------------------------------------

--
-- Table structure for table `newsimage`
--

CREATE TABLE `newsimage` (
  `Image_id` int(10) UNSIGNED NOT NULL,
  `Image` varchar(100) DEFAULT NULL,
  `Caption` tinytext,
  `Size` int(11) DEFAULT NULL,
  `Format` varchar(10) DEFAULT NULL,
  `Width` int(11) DEFAULT NULL,
  `Height` int(11) DEFAULT NULL,
  `News_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newsimage`
--

INSERT INTO `newsimage` (`Image_id`, `Image`, `Caption`, `Size`, `Format`, `Width`, `Height`, `News_id`) VALUES
(1, '577c477624a2d.jpg', '', 27969, 'image/jpeg', 300, 218, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `Role_id` int(10) UNSIGNED NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Accesslevel` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Role_id`, `Role`, `Accesslevel`) VALUES
(1, 'Administrator', 'A'),
(2, 'Moderator', 'M'),
(3, 'Editor', 'E'),
(4, 'User', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `Subscriber_id` int(11) UNSIGNED NOT NULL,
  `Subscription_type` enum('Free','Basic','Silver','Premium') DEFAULT 'Free',
  `Start_date` date DEFAULT NULL,
  `Expiry_date` date DEFAULT NULL,
  `Amount` double DEFAULT '0',
  `Member_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`Subscriber_id`, `Subscription_type`, `Start_date`, `Expiry_date`, `Amount`, `Member_id`) VALUES
(1, 'Free', '2016-05-18', '2016-05-18', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `Track_id` int(10) UNSIGNED NOT NULL,
  `Track_num` int(2) UNSIGNED ZEROFILL DEFAULT NULL,
  `Song_title` varchar(50) DEFAULT NULL,
  `Format` varchar(10) DEFAULT NULL,
  `Description` tinytext,
  `Duration` time DEFAULT NULL,
  `Date_added` timestamp NULL DEFAULT NULL,
  `Ratings` float DEFAULT NULL,
  `Size` varchar(45) DEFAULT NULL,
  `Genre_id` int(11) NOT NULL,
  `Album_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`Track_id`, `Track_num`, `Song_title`, `Format`, `Description`, `Duration`, `Date_added`, `Ratings`, `Size`, `Genre_id`, `Album_id`) VALUES
(1, 01, 'Mansa.mp3', 'audio/mpeg', 'This song was relased in 2015 by high maker bisa kedei', '00:05:00', '2016-05-26 00:00:00', 2.5, '5.3MB', 1, 1),
(2, 03, 'Brother-brother.mp3', 'audio/mpeg', 'This song was release in 2015 and its a high award winning song.', '00:05:02', '2016-05-25 00:00:00', 4.2, '5.2MB', 1, 1),
(3, 05, 'pillow.mp3', 'audio/mpeg', 'By bisa kdei realed in 2016', '00:04:03', '2016-05-15 00:00:00', 3.6, '3.4MB', 1, 1),
(4, 04, '0fadadada.mp3', 'audio/mpeg', NULL, '00:03:01', '2016-05-30 00:00:00', 3.4, '3.0MB', 1, 1),
(5, 02, 'Odo_capenter.mp3', 'audio/mpeg', NULL, '00:03:10', '2016-05-26 00:15:08', 4.6, '5.0MB', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`Album_id`),
  ADD KEY `Member_id` (`Member_id`),
  ADD KEY `Track_id` (`Track_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`Blog_id`),
  ADD KEY `Member_id` (`Member_id`);

--
-- Indexes for table `blogcomments`
--
ALTER TABLE `blogcomments`
  ADD PRIMARY KEY (`Comment_id`),
  ADD KEY `Blog_id` (`Blog_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Login_id`),
  ADD KEY `Member_id` (`Member_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`Member_id`);

--
-- Indexes for table `member_info`
--
ALTER TABLE `member_info`
  ADD KEY `Member_idx` (`Member_id`);

--
-- Indexes for table `music_collection`
--
ALTER TABLE `music_collection`
  ADD KEY `Album_id` (`Album_id`),
  ADD KEY `Track_id` (`Track_id`) USING BTREE,
  ADD KEY `Genre_id` (`Genre_id`) USING BTREE;

--
-- Indexes for table `music_genre`
--
ALTER TABLE `music_genre`
  ADD PRIMARY KEY (`Genre_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`News_id`),
  ADD KEY `Category_id` (`Category_id`),
  ADD KEY `Publishedby` (`Publishedby`);
ALTER TABLE `news` ADD FULLTEXT KEY `Body` (`Body`);

--
-- Indexes for table `newscategory`
--
ALTER TABLE `newscategory`
  ADD PRIMARY KEY (`Category_id`),
  ADD UNIQUE KEY `cat_pos_idx` (`Position`) USING BTREE;

--
-- Indexes for table `newsimage`
--
ALTER TABLE `newsimage`
  ADD PRIMARY KEY (`Image_id`),
  ADD KEY `News_id` (`News_id`),
  ADD KEY `News_id_2` (`News_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Role_id`),
  ADD UNIQUE KEY `Role` (`Role`) USING BTREE,
  ADD UNIQUE KEY `Accesslevel` (`Accesslevel`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`Subscriber_id`),
  ADD KEY `Member_id` (`Member_id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`Track_id`),
  ADD KEY `Album_idx` (`Album_id`) USING BTREE,
  ADD KEY `Genre_id` (`Genre_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `Album_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `Blog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blogcomments`
--
ALTER TABLE `blogcomments`
  MODIFY `Comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `Login_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `Member_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `music_genre`
--
ALTER TABLE `music_genre`
  MODIFY `Genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `News_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `newscategory`
--
ALTER TABLE `newscategory`
  MODIFY `Category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `newsimage`
--
ALTER TABLE `newsimage`
  MODIFY `Image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `Subscriber_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `Track_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `idx_album_id` FOREIGN KEY (`Member_id`) REFERENCES `membership` (`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `idx_member_login` FOREIGN KEY (`Member_id`) REFERENCES `membership` (`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_info`
--
ALTER TABLE `member_info`
  ADD CONSTRAINT `idx_Member_info_id` FOREIGN KEY (`Member_id`) REFERENCES `membership` (`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `idx_news_id` FOREIGN KEY (`Publishedby`) REFERENCES `membership` (`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `idx_subscribe_id` FOREIGN KEY (`Member_id`) REFERENCES `membership` (`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `fk_idx_album` FOREIGN KEY (`Album_id`) REFERENCES `album` (`Album_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
