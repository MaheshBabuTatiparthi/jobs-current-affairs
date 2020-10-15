

-- CREATE DATABASE IF NOT EXISTS `heroku_6c9b400be692e1e` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- USE `heroku_6c9b400be692e1e`;


-- Backup categories table
-- CREATE TABLE IF NOT EXISTS `categories_backup_1602743856` LIKE `categories`;
-- INSERT INTO `categories_backup_1602743856` SELECT * FROM `categories`;

-- Delete categories table
DROP TABLE IF EXISTS `categories`;

-- Create categories table
CREATE TABLE IF NOT EXISTS `categories` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`category_name` varchar(128) NOT NULL DEFAULT '',
	`category_image` longtext NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;




-- Backup chapters table
-- CREATE TABLE IF NOT EXISTS `chapters_backup_1602743856` LIKE `chapters`;
-- INSERT INTO `chapters_backup_1602743856` SELECT * FROM `chapters`;

-- Delete chapters table
DROP TABLE IF EXISTS `chapters`;

-- Create chapters table
CREATE TABLE IF NOT EXISTS `chapters` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`chapter_title` varchar(128) NOT NULL DEFAULT '',
	`chapter_image` longtext NOT NULL DEFAULT '',
	`chapter_category` varchar(128) NOT NULL DEFAULT '',
	`chapter_content` longtext NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;




-- Backup jobs table
-- CREATE TABLE IF NOT EXISTS `jobs_backup_1602743856` LIKE `jobs`;
-- INSERT INTO `jobs_backup_1602743856` SELECT * FROM `jobs`;

-- Delete jobs table
DROP TABLE IF EXISTS `jobs`;

-- Create jobs table
CREATE TABLE IF NOT EXISTS `jobs` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`job_title` varchar(128) NOT NULL DEFAULT '',
	`last_date` date NOT NULL DEFAULT '0000-00-00' ,
	`job_content` longtext NOT NULL DEFAULT '',
	`notification` varchar(128) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



-- Delete users table
DROP TABLE IF EXISTS `users`;

-- Create users table
CREATE TABLE IF NOT EXISTS `users` (
	`user_id` int(11) NOT NULL AUTO_INCREMENT,
	`user_name` varchar(32) NOT NULL,
	`user_birthday` date NOT NULL DEFAULT '0000-00-00',
	`user_first_name` varchar(128) NOT NULL DEFAULT '',
	`user_last_name` varchar(128) NOT NULL DEFAULT '',
	`user_company` varchar(128) NOT NULL DEFAULT '',
	`user_email` varchar(128) NOT NULL DEFAULT '',
	`user_website` varchar(128) NOT NULL DEFAULT '',
	`user_level` ENUM('admin','user') NOT NULL DEFAULT 'user',
	`user_password` varchar(128) NOT NULL DEFAULT '',
	`user_token` varchar(128) NOT NULL DEFAULT '',
	`user_address_1` varchar(256) NOT NULL DEFAULT '',
	`user_address_2` varchar(256) NOT NULL DEFAULT '',
	`user_city` varchar(128) NOT NULL DEFAULT '',
	`user_state` varchar(128) NOT NULL DEFAULT '',
	`user_postcode` varchar(128) NOT NULL DEFAULT '',
	`user_country` varchar(128) NOT NULL DEFAULT '',
	`user_phone` text NOT NULL DEFAULT '',
	`user_note` text NOT NULL DEFAULT '',
	`user_expired` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`user_status` ENUM('banned','active','pending') NOT NULL DEFAULT 'pending',
	PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Insert default administrator user
INSERT INTO `users` (`user_id` ,`user_name`,`user_birthday`,`user_first_name`,`user_last_name`,`user_company` ,`user_email` ,`user_website`, `user_level` ,`user_password`,`user_token`,`user_address_1`,`user_address_2`,`user_city`,`user_state`,`user_postcode`,`user_country`,`user_phone`,`user_note`,`user_expired`,`user_status`) VALUES
(4 ,'jefri ','1990-03-30','Jefry','Anaski','','user1@test.com','' , 'user', '4ac8d9aa31d6988199c12cffebad4d84ad865afd','','Jl. Simpang IV - Manggopoh','Silambau - Kinali','Pasaman Barat','Sumatera Barat','26567','Indonesia','628123456789','','2020-10-15 06:37:36','active'),
(3 ,'riziq','1995-03-30','Riziq','','','user2@test.com','' , 'user', '4ac8d9aa31d6988199c12cffebad4d84ad865afd','','','','','','','','628123456789','','2020-10-15 06:37:36','pending'),
(2 ,'zikran','1965-03-30','Zikran','Marwan','','user3@test.com','' , 'user', '4ac8d9aa31d6988199c12cffebad4d84ad865afd','','','','','','','','','Violate the rules','0000-00-00 00:00:00','banned'),
(1 , 'admin','1990-03-30','Admin', '','', 'app@godigitally.co.in','https://godigitally.co.in' , 'admin', '4ac8d9aa31d6988199c12cffebad4d84ad865afd','','','','','','','','','','0000-00-00 00:00:00','active');
