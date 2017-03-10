-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2017 at 06:44 PM
-- Server version: 5.6.32-78.1-log
-- PHP Version: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `icoolsho_supreti`
--

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE IF NOT EXISTS `Books` (
  `id` tinyint(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`id`, `title`, `description`, `price`, `image`) VALUES
(1, 'Database Processing', 'For undergraduate database management courses. Get Readers Straight to the Point of Database Processing Database Processing: Fundamentals, Design, and Implementation reflects a new teaching and professional workplace environment and method that gets readers straight to the point with its thorough and modern presentation of database processing fundamentals. The Fourteenth Edition has been thoroughly updated to reflect the latest software.', 25.22, 'http://supreti.icoolshow.net/GroupProject/images/Database_Processing_book.jpg'),
(2, 'Algorithms', 'This fourth edition of Robert Sedgewick and Kevin Wayne’s Algorithms is the leading textbook on algorithms today and is widely used in colleges and universities worldwide. This book surveys the most important computer algorithms currently in use and provides a full treatment of data structures and algorithms for sorting, searching, graph processing, and string processing--including fifty algorithms every programmer should know. In this edition, new Java implementations are written in an accessible modular programming style, where all of the code is exposed to the reader and ready to use.\r\n \r\nThe algorithms in this book represent a body of knowledge developed over the last 50 years that has become indispensable, not just for professional programmers and computer science students but for any student with interests in science, mathematics, and engineering, not to mention students who use computation in the liberal arts.', 50.20, 'http://supreti.icoolshow.net/GroupProject/images/Algorithm_book.jpg'),
(3, 'Murach''s PHP and MySQL, 2nd Edition', '"I can''t count how many PHP books I have purchased over the years trying to learn the language. Murach''s was the first book that helped me grasp the concepts and got me onto actually scripting in PHP."\r\n\r\nThat''s what one developer said in an online review of the first edition of Murach''s PHP and MySQL. Now, this 2nd Edition does an even better job of delivering the real-world skills you need to develop database-driven websites using PHP and MySQL, two of today''s most popular open-source software tools.\r\n\r\nSection 1 is a quick-start course that shows how to use the latest versions of PHP, MySQL, the Apache web server, and the NetBeans IDE to build your first PHP applications. And right from the start, you''ll learn to create applications that conform to the MVC pattern, so they''ll be easier to maintain as they grow.\r\n\r\nThen, Section 2 takes you deep into PHP by covering the skills you''ll use every day in professional applications, like how to work with form data, dates, arrays, sessions, cookies, functions, objects, regular expressions, and exceptions. Likewise, Section 3 dives into MySQL, teaching you how to design and create a database, as well as how to access and maintain the data in a database like the professionals do. Finally, Section 4 teaches you important web programming skills like how to secure web pages, prevent SQL injection attacks, guard against XSS attacks, send email, upload files, process images, and access content from other websites.\r\n\r\nComplete sample applications (all using HTML5 and CSS3) along with chapter exercises provide training support throughout. A great choice for any developer who wants to master PHP without a lot of frustration and unnecessary expense.', 34.85, 'http://supreti.icoolshow.net/GroupProject/images/Murach_PHP_MySQL_book.jpg'),
(4, 'Software Engineering (10th Edition)', 'The Fundamental Practice of Software Engineering\r\nSoftware Engineering introduces readers to the overwhelmingly important subject of software programming and development. In the past few years, computer systems have come to dominate not just our technological growth, but the foundations of our world’s major industries. This text seeks to lay out the fundamental concepts of this huge and continually growing subject area in a clear and comprehensive manner.\r\n \r\nThe Tenth Edition contains new information that highlights various technological updates of recent years, providing readers with highly relevant and current information. Sommerville’s experience in system dependability and systems engineering guides the text through a traditional plan-based approach that incorporates some novel agile methods. The text strives to teach the innovators of tomorrow how to create software that will make our world a better, safer, and more advanced place to live.', 156.72, 'http://supreti.icoolshow.net/GroupProject/images/Software_Engineering_book.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `MyGuests`
--

CREATE TABLE IF NOT EXISTS `MyGuests` (
  `id` int(6) unsigned NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` tinyint(4) NOT NULL,
  `usertype` tinyint(4) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `usertype`, `username`, `password`, `email`) VALUES
(1, 1, 'supreti', 'su', 'supreti@northseattle.edu');

-- --------------------------------------------------------

--
-- Table structure for table `Usertype`
--

CREATE TABLE IF NOT EXISTS `Usertype` (
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
-- Indexes for table `Books`
--
ALTER TABLE `Books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MyGuests`
--
ALTER TABLE `MyGuests`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `Books`
--
ALTER TABLE `Books`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `MyGuests`
--
ALTER TABLE `MyGuests`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Usertype`
--
ALTER TABLE `Usertype`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
ADD CONSTRAINT `usertype_id_fk` FOREIGN KEY (`usertype`) REFERENCES `Usertype` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
