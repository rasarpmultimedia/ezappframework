
CREATE TABLE IF NOT EXISTS `Membership` (
  `Member_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Surname` VARCHAR(45) NULL,
  `Firstname` VARCHAR(45) NULL,
  `Gender` ENUM('M','F') NOT NULL,
  `Avatar` VARCHAR(255) NULL COMMENT '',
  `Subscribed` ENUM('Y', 'N') NULL DEFAULT 'N' ,
  PRIMARY KEY (`Member_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Member_info` (
  `Member_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `Temp_password` VARCHAR(255) NULL COMMENT '',
  `Security_Question` VARCHAR(60) NULL COMMENT '',
  `Answer` VARCHAR(45) NOT NULL)
ENGINE = InnoDB;
ALTER TABLE `member_info` DROP FOREIGN KEY `Member_id`; ALTER TABLE `member_info` ADD CONSTRAINT `idx_Member_info_id` FOREIGN KEY (`Member_id`) REFERENCES `membership`(`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE IF NOT EXISTS `Login` (
  `Login_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `Accesslevel` ENUM('Admin', 'Moderator', 'User') NULL DEFAULT 'User' COMMENT '',
  `Username` VARCHAR(45) NULL COMMENT '',
  `Email` VARCHAR(60) NOT NULL COMMENT '',
  `Password` VARCHAR(60) NULL COMMENT '',
  `Lastlogged_in` DATETIME NULL COMMENT '',
  `Member_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`Login_id`))
ENGINE = InnoDB;
ALTER TABLE `login` ADD CONSTRAINT `idx_member_login` FOREIGN KEY (`Member_id`) REFERENCES `membership`(`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

create table if not exists silvermediadb.Roles(
Id int unsigned auto_increment,
Role varchar(50) not null, 
Accesslevel int(5),
primary key(Id), 
Lastmodified timestamp default current_timestamp on update current_timestamp
)engine =innodb;

/*insert roles information
insert into roles values(1,"Administrator",1,now()),
(2,"Moderator",2,now()),
(3,"Editor",3,now()),
(4,"User",4,now()); */
CREATE TABLE IF NOT EXISTS `Subscription` (
  `Subscriber_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `Subscription_type` ENUM('Free', 'Basic', 'Silver', 'Premium') NOT NULL DEFAULT 'Free' COMMENT '',
  `Start_date` DATE NULL DEFAULT NULL COMMENT '',
  `Expiry_date` DATE NULL COMMENT '',
  `Amount` DOUBLE NULL DEFAULT 0.00 COMMENT '',
  `Member_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`Subscriber_id`))
ENGINE = InnoDB;

ALTER TABLE `subscription` ADD CONSTRAINT `idx_subscribe_id` FOREIGN KEY (`Member_id`) REFERENCES `membership`(`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE IF NOT EXISTS `Album` (
  `Album_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `Album_name` VARCHAR(45) NOT NULL COMMENT '',
  `Artist_name` VARCHAR(50) NOT NULL COMMENT '',
  `Album_description` TINYTEXT NULL COMMENT '',
  `Cover_art` VARCHAR(255) NULL COMMENT '',
  `Date_Released` VARCHAR(45) NULL COMMENT '',
  `Numof_tracks` INT(30) NULL,
  `Member_id` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`Album_id`))
ENGINE = InnoDB;

ALTER TABLE `album` ADD CONSTRAINT `idx_album_id` FOREIGN KEY (`Member_id`) REFERENCES `membership`(`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE IF NOT EXISTS `Music_genre` (
  `Genre_id` INT NOT NULL AUTO_INCREMENT ,
  `Genre` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Genre_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Music_collection` (
  `Album_id` INT NOT NULL COMMENT '',
  `Track_id` INT NOT NULL COMMENT '',
  `Genre_id` INT NOT NULL COMMENT '')
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Tracks` (
  `Track_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `Track_num` INT(10) ZEROFILL NULL COMMENT '',
  `Song_title` VARCHAR(50) NULL COMMENT '',
  `Format` VARCHAR(10) NULL COMMENT '',
  `Description` TINYTEXT NULL COMMENT '',
  `Duration` TIME NULL COMMENT '',
  `Date_added` TIMESTAMP NULL COMMENT '',
  `Quality` VARCHAR(45) NULL COMMENT '',
  `Size` VARCHAR(45) NULL COMMENT '',
  `Album_id` INT NOT NULL COMMENT '',
  `Genre_id` INT NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`Track_id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `News` (
  `News_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Title` VARCHAR(100) NULL DEFAULT NULL COMMENT '',
  `Body` TEXT NULL DEFAULT NULL COMMENT '',
  `Published` ENUM('Y', 'N') DEFAULT 'N' COMMENT '',
  `Featured`  ENUM('Y', 'N') DEFAULT 'N' COMMENT '',
  `Date_published` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Publishedby` INT UNSIGNED NOT NULL COMMENT '',
  `Source` VARCHAR(40) NULL DEFAULT NULL COMMENT '',
  `Views` INT NULL DEFAULT NULL COMMENT '',
  `NumofComments` INT NULL DEFAULT 0 COMMENT '',
  `Category_id` INT NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`News_id`))
  ENGINE = InnoDB;
ALTER TABLE `news` ADD CONSTRAINT `idx_news_id` FOREIGN KEY (`Publishedby`) REFERENCES `membership`(`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE IF NOT EXISTS `NewsImage` (
  `Image_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `Image` VARCHAR(100) NULL DEFAULT NULL COMMENT '',
  `Caption` TINYTEXT NULL DEFAULT NULL COMMENT '',
  `Size` INT NULL DEFAULT NULL COMMENT '',
  `Format` VARCHAR(10) NULL DEFAULT NULL COMMENT '',
  `Width` INT NULL DEFAULT NULL COMMENT '',
  `Height` INT NULL DEFAULT NULL COMMENT '',
  `News_id` INT(11) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`Image_id`))
ENGINE = InnoDB;
ALTER TABLE `newsimage` ADD FOREIGN KEY (`News_id`) REFERENCES `news`(`News_id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE IF NOT EXISTS `NewsCategory` (
  `Category_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `Category_name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`Category_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Blog` (
  `Blog_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `Title` VARCHAR(100) NULL DEFAULT NULL COMMENT '',
  `Posts` TEXT NULL DEFAULT NULL COMMENT '',
  `Approved` ENUM('Y', 'N') NULL DEFAULT 'N' COMMENT '',
  `Views` INT NULL DEFAULT NULL COMMENT '',
  `NumofComments` INT NULL DEFAULT NULL COMMENT '',
  `Member_id` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`Blog_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BlogComments` (
  `Comment_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `Name` VARCHAR(45) NULL COMMENT '',
  `Email` VARCHAR(60) NULL COMMENT '',
  `Comment` TINYTEXT NULL COMMENT '',
  `Comment_date` DATE NULL COMMENT '',
  `Blog_id` INT NULL COMMENT '',
  PRIMARY KEY (`Comment_id`))
  ENGINE = InnoDB;


