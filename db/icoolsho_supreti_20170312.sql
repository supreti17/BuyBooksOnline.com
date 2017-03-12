-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 12, 2017 at 08:21 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `icoolsho_supreti`
--
CREATE DATABASE IF NOT EXISTS `icoolsho_supreti` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `icoolsho_supreti`;

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

DROP TABLE IF EXISTS `Address`;
CREATE TABLE `Address` (
`id` int(11) NOT NULL,
  `street` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zipcode` varchar(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`id`, `street`, `city`, `state`, `zipcode`) VALUES
(12, '1628 N 175th St', 'Shoreline', 'Washington', '98133'),
(13, '111', 'sea', 'se', '99999'),
(14, '111', 'sea', 'se', '99999'),
(15, '111', 'sea', 'se', '99999');

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

DROP TABLE IF EXISTS `Books`;
CREATE TABLE `Books` (
`id` tinyint(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(200) NOT NULL,
  `inventory` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`id`, `title`, `description`, `price`, `image`, `inventory`) VALUES
(1, 'Database Processing', 'For undergraduate database management courses. Get Readers Straight to the Point of Database Processing Database Processing: Fundamentals, Design, and Implementation reflects a new teaching and professional workplace environment and method that gets readers straight to the point with its thorough and modern presentation of database processing fundamentals. The Fourteenth Edition has been thoroughly updated to reflect the latest software.', 25.22, 'images/Database_Processing_book.jpg', 499),
(2, 'Algorithms', 'This fourth edition of Robert Sedgewick and Kevin Wayne’s Algorithms is the leading textbook on algorithms today and is widely used in colleges and universities worldwide. This book surveys the most important computer algorithms currently in use and provides a full treatment of data structures and algorithms for sorting, searching, graph processing, and string processing--including fifty algorithms every programmer should know. In this edition, new Java implementations are written in an accessible modular programming style, where all of the code is exposed to the reader and ready to use.\r\n \r\nThe algorithms in this book represent a body of knowledge developed over the last 50 years that has become indispensable, not just for professional programmers and computer science students but for any student with interests in science, mathematics, and engineering, not to mention students who use computation in the liberal arts.', 50.20, 'images/Algorithm_book.jpg', 500),
(3, 'Murach''s PHP and MySQL, 2nd Edition', '"I can''t count how many PHP books I have purchased over the years trying to learn the language. Murach''s was the first book that helped me grasp the concepts and got me onto actually scripting in PHP."\r\n\r\nThat''s what one developer said in an online review of the first edition of Murach''s PHP and MySQL. Now, this 2nd Edition does an even better job of delivering the real-world skills you need to develop database-driven websites using PHP and MySQL, two of today''s most popular open-source software tools.\r\n\r\nSection 1 is a quick-start course that shows how to use the latest versions of PHP, MySQL, the Apache web server, and the NetBeans IDE to build your first PHP applications. And right from the start, you''ll learn to create applications that conform to the MVC pattern, so they''ll be easier to maintain as they grow.\r\n\r\nThen, Section 2 takes you deep into PHP by covering the skills you''ll use every day in professional applications, like how to work with form data, dates, arrays, sessions, cookies, functions, objects, regular expressions, and exceptions. Likewise, Section 3 dives into MySQL, teaching you how to design and create a database, as well as how to access and maintain the data in a database like the professionals do. Finally, Section 4 teaches you important web programming skills like how to secure web pages, prevent SQL injection attacks, guard against XSS attacks, send email, upload files, process images, and access content from other websites.\r\n\r\nComplete sample applications (all using HTML5 and CSS3) along with chapter exercises provide training support throughout. A great choice for any developer who wants to master PHP without a lot of frustration and unnecessary expense.', 34.85, 'images/Murach_PHP_MySQL_book.jpg', 500),
(4, 'Software Engineering (10th Edition)', 'The Fundamental Practice of Software Engineering\r\nSoftware Engineering introduces readers to the overwhelmingly important subject of software programming and development. In the past few years, computer systems have come to dominate not just our technological growth, but the foundations of our world’s major industries. This text seeks to lay out the fundamental concepts of this huge and continually growing subject area in a clear and comprehensive manner.\r\n \r\nThe Tenth Edition contains new information that highlights various technological updates of recent years, providing readers with highly relevant and current information. Sommerville’s experience in system dependability and systems engineering guides the text through a traditional plan-based approach that incorporates some novel agile methods. The text strives to teach the innovators of tomorrow how to create software that will make our world a better, safer, and more advanced place to live.', 156.72, 'images/Software_Engineering_book.jpg', 500),
(8, 'Hello World', 'Sorry, file already exists.Sorry, only JPG, JPEG, PNG & GIF files are allowed.Sorry, your file was not uploaded.', 22.23, 'images/Screenshot 2017-02-28 15.15.00.png', 500);

-- --------------------------------------------------------

--
-- Table structure for table `UserAddress`
--

DROP TABLE IF EXISTS `UserAddress`;
CREATE TABLE `UserAddress` (
  `user_id` tinyint(4) NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserAddress`
--

INSERT INTO `UserAddress` (`user_id`, `address_id`) VALUES
(1, 12),
(2, 13),
(2, 13),
(2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
`id` tinyint(4) NOT NULL,
  `usertype` tinyint(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `usertype`, `username`, `password`, `email`) VALUES
(1, 2, 'icoolsho_supreti', 'AD320', 'upretisuraj11@gmail.com'),
(2, 1, 'su', 'su', 'upretisuraj@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `Usertype`
--

DROP TABLE IF EXISTS `Usertype`;
CREATE TABLE `Usertype` (
`id` tinyint(1) NOT NULL,
  `type` varchar(13) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Usertype`
--

INSERT INTO `Usertype` (`id`, `type`) VALUES
(1, 'administrator'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Books`
--
ALTER TABLE `Books`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `UserAddress`
--
ALTER TABLE `UserAddress`
 ADD KEY `useraddress_user_id` (`user_id`), ADD KEY `useraddress_address_id` (`address_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
 ADD PRIMARY KEY (`id`), ADD KEY `usertype` (`usertype`);

--
-- Indexes for table `Usertype`
--
ALTER TABLE `Usertype`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `Books`
--
ALTER TABLE `Books`
MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Usertype`
--
ALTER TABLE `Usertype`
MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `UserAddress`
--
ALTER TABLE `UserAddress`
ADD CONSTRAINT `useraddress_address_id_fk` FOREIGN KEY (`address_id`) REFERENCES `icoolshow_supreti`.`Address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `useraddress_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `icoolshow_supreti`.`Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
ADD CONSTRAINT `usertype_id_fk` FOREIGN KEY (`usertype`) REFERENCES `icoolshow_supreti`.`Usertype` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
