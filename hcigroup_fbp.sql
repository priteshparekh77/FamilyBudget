-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2015 at 09:06 AM
-- Server version: 5.0.96
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hcigroup_fbp`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(5) NOT NULL auto_increment,
  `category_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Food'),
(2, 'Rent'),
(3, 'Hospital'),
(4, 'Education'),
(5, 'Gas'),
(6, 'Entertainment'),
(7, 'Custom Category');

-- --------------------------------------------------------

--
-- Table structure for table `cst_category`
--

CREATE TABLE IF NOT EXISTS `cst_category` (
  `cst_category_id` int(5) NOT NULL auto_increment,
  `category_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `cst_category_name` varchar(25) NOT NULL,
  PRIMARY KEY  (`cst_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cst_category`
--

INSERT INTO `cst_category` (`cst_category_id`, `category_id`, `user_id`, `cst_category_name`) VALUES
(1, 7, 1, 'Select Custom Category'),
(7, 7, 35, 'clothes'),
(10, 7, 20, 'Nexus 6');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `expense_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `cst_category_id` int(5) NOT NULL,
  `expense_amount` int(10) NOT NULL,
  `expense_date` varchar(20) NOT NULL,
  `category_id` int(5) NOT NULL,
  `expense_description` varchar(500) NOT NULL,
  PRIMARY KEY  (`expense_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `user_id`, `cst_category_id`, `expense_amount`, `expense_date`, `category_id`, `expense_description`) VALUES
(1, 1, 0, 500, '2014-11-05', 1, ''),
(4, 24, 0, 200, '0000-00-00', 2, ''),
(9, 25, 0, 15, '0000-00-00', 1, ''),
(10, 25, 0, 43, '0000-00-00', 3, ''),
(16, 27, 0, 15151, '', 1, ''),
(17, 27, 0, 54654654, '', 4, 'asdfasdf'),
(18, 27, 0, 234, '12/19/2014', 6, 'asdfasdfasd'),
(20, 21, 0, 34, '12/16/2014', 3, ''),
(21, 21, 0, 66677, '12/29/2014', 1, ''),
(44, 21, 8, 45, '12/05/2014', 7, 'i love food'),
(45, 22, 10, 50, '12/05/2014', 7, 'i love to read'),
(46, 22, 0, 40, '12/05/2014', 1, 'ilove food'),
(47, 22, 0, 70, '12/05/2014', 2, 'rent'),
(48, 22, 0, 150, '12/05/2014', 6, 'entertainment'),
(63, 21, 8, 34, '12/10/2014', 7, 'mine'),
(71, 29, 0, 300, '12/10/2014', 1, 'des'),
(72, 29, 0, 300, '10/28/2013', 2, 'ren'),
(73, 29, 0, 100, '12/26/2014', 3, 'res'),
(74, 22, 0, 23, '12/13/2014', 1, 'fghj'),
(75, 31, 0, 45, '12/09/2014', 1, 'test '),
(76, 31, 0, 67, '12/09/2014', 2, 'rent test'),
(77, 21, 0, 100000, '12/09/2014', 3, 'dfghjk'),
(85, 20, 4, 2500, '12/20/2014', 7, 'Gas'),
(86, 34, 0, 34, '12/09/2014', 3, 'let do it'),
(87, 20, 0, 4000, '12/02/2014', 1, 'baby'),
(88, 35, 0, 2, '12/29/2014', 2, 'Dinner'),
(89, 35, 7, 50, '12/03/2014', 7, 'bought new pants'),
(90, 20, 9, 2, '12/15/2014', 7, 'a'),
(91, 20, 0, 4444, '12/11/2014', 3, 'ecvdf'),
(92, 40, 0, 100, '01/22/2015', 1, 'junk'),
(93, 40, 0, 150, '01/28/2015', 2, 'House rent'),
(94, 40, 0, 500, '01/28/2015', 3, 'Medical Checkup'),
(95, 22, 0, 70, '02/11/2015', 1, 'sdfghjkl;ljhgfdxdfghjkl;ljgfdxfghjkl');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `income_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `income_amount` int(10) NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY  (`income_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `user_id`, `income_amount`, `date`) VALUES
(3, 25, 100, '0000-00-00'),
(4, 25, 25, '0000-00-00'),
(5, 26, 34, '0000-00-00'),
(7, 21, 333, '0000-00-00'),
(8, 22, 777, '0000-00-00'),
(9, 25, 555, '0000-00-00'),
(10, 22, 45, '0000-00-00'),
(23, 22, 45, '0000-00-00'),
(24, 22, 800, '0000-00-00'),
(26, 22, 67, '0000-00-00'),
(32, 20, 500, '12/25/2014'),
(33, 20, 700, '11/10/2014'),
(34, 20, 10000, '12/26/2014'),
(36, 29, 1000, '12/01/2014'),
(37, 29, 1000, '12/01/2014'),
(38, 31, 400, '12/09/2014'),
(41, 20, 33, '12/01/2014'),
(42, 20, 50, '12/03/2014'),
(43, 34, 38, '12/09/2014'),
(44, 34, 55, '12/09/2014'),
(45, 20, 25900, '12/17/2014'),
(46, 35, 10, '12/17/2014'),
(47, 35, 5, '12/18/2014'),
(48, 35, 500, '12/15/2014'),
(49, 20, 34, '12/10/2014'),
(50, 40, 1000, '01/01/2015'),
(51, 40, 500, '01/13/2015');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `partners_id` int(11) NOT NULL auto_increment,
  `user_name` varchar(20) NOT NULL,
  `invitees` varchar(20) NOT NULL,
  PRIMARY KEY  (`partners_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`partners_id`, `user_name`, `invitees`) VALUES
(67, 'ada', 'adu'),
(66, 'adu', 'ade'),
(65, 'adu', 'ada'),
(64, 'femi', 'goke'),
(63, 'ijidakin', 'de'),
(62, 'ijidakin', 'jaradehr1'),
(58, 'bisi', 'jaradehr1'),
(59, 'bisi', 'ijidakin'),
(60, 'olope', 'bisi'),
(61, 'bisi', 'olope'),
(46, 'ijidakin', 'bisi'),
(68, 'ada', 'ade'),
(69, 'ade', 'adu'),
(70, 'ade', 'ada');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(5) NOT NULL auto_increment,
  `user_typeid` int(3) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_regdate` varchar(50) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_typeid`, `user_name`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_regdate`) VALUES
(1, 1, 'de', 'ade', 'seun', 'ade', 'ade', ''),
(2, 2, 'kunle', 'aduu', 'salu', 'sdfghj', 'dfghj', ''),
(5, 0, 'myboy', 'frank', 'salex', 'ghjk', 'gbhnjm', ''),
(6, 0, 'oboy', 'femi', 'oloye', 'fghj', 'dfghjkl', ''),
(7, 0, 'sunday', 'great', 'yessss', 'dfghj', 'dfghj', ''),
(8, 0, 'monday', 'jolaade', 'igbaro', 'vbnm', 'ghjk', ''),
(9, 0, 'tuesday', 'oremi', 'letsgo', 'dfghjk', 'dfghj', ''),
(10, 0, 'tuesday', 'oremi', 'letsgo', 'dfghjk', 'dfghj', ''),
(11, 0, 'debishop', 'ade', 'adebisi', 'profadexbj@gmai', 'dfc3390bd0e484a', ''),
(12, 0, 'def', 'g', 'h', 'd@gmail.com', 'cef1520a24dc514', ''),
(13, 0, 'prutesh', 'pritesh', 'pritesh', 'p@a.com', '1c0b76fce779f78', ''),
(14, 0, 'fbp', 'a', 'a', 'f@b.p', '1c0b76fce779f78', ''),
(15, 0, 'a', 'a', 'a', 'a@b.com', 'e10adc3949ba59a', ''),
(16, 0, 'w', 'w', 'w', 'w@b.com', '8eed8947370ccf6', ''),
(17, 0, 'test', 'test', 'test', 't@a.com', '1c0b76fce779f78', ''),
(18, 0, 'ilo', 'ilo', 'ilo', 'i@l.com', '1c0b76fce779f78', ''),
(20, 0, 'jaradehr1', 'Riad', 'Jaradeh', 'riadjerade89@ho', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(21, 0, 'ijidakin', 'iji', 'dakin', 'i@yahoo.com', 'dfc3390bd0e484a17bf74e849dfb8cee', ''),
(22, 0, 'bisi', 'ADEBISI', 'ADENIPEKUN', 'p@gmail.com', 'dfc3390bd0e484a17bf74e849dfb8cee', ''),
(23, 0, 'syedsajjad', 'Syed', 'Sajjad', 'sajjads1@mail.montclair.edu', '67ba97f07e9b7de909d3bb4398a4c7be', ''),
(25, 0, 'aloba', 'aloba', 'aloba', 'g@yahoo.com', 'dfc3390bd0e484a17bf74e849dfb8cee', ''),
(26, 0, 'oba', 'oba', 'oba', 'o@yahoo.com', 'dfc3390bd0e484a17bf74e849dfb8cee', ''),
(27, 0, 'jaf', 'Jerry', 'Fails', 'failsj@montclair.edu', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(28, 0, 'sajjads', 'Syed', 'Sajjad', 'syedsjj@hotmail.com', '67ba97f07e9b7de909d3bb4398a4c7be', ''),
(29, 0, 'amar', 'Amarender', 'Nampally', 'amar5445@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(30, 0, 'Testuser', 'Syed ', 'Waqas', 'testuser@yahoo.com', '5d9c68c6c50ed3d02a2fcf54f63993b6', ''),
(31, 0, 'olope', 'olope', 'olope', 'ki@gmail.com', 'dfc3390bd0e484a17bf74e849dfb8cee', ''),
(32, 0, 'goke', 'goke', 'goke', 'gh@gmail.com', 'dfc3390bd0e484a17bf74e849dfb8cee', 'December2014'),
(33, 0, 'ola', 'ola', 'ola', 'ola@gmai.com', 'dfc3390bd0e484a17bf74e849dfb8cee', 'December 2014'),
(34, 0, 'femi', 'femi', 'omotara', 'femi@yahoo.com', 'dfc3390bd0e484a17bf74e849dfb8cee', 'December 2014'),
(35, 0, 'ade', 'Ade', 'Ade', 'kl@yahoo.com', 'dfc3390bd0e484a17bf74e849dfb8cee', 'December 2014'),
(36, 0, 'ada', 'ada', 'ada', 'ada@yahoo.com', 'dfc3390bd0e484a17bf74e849dfb8cee', 'December 2014'),
(37, 0, 'adu', 'adu', 'adu', 'adu@yahoo.com', 'dfc3390bd0e484a17bf74e849dfb8cee', 'December 2014'),
(38, 0, 'gumallett', 'Greg', 'Mallett', 'gumallett@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'December 2014'),
(39, 0, 'jf1234', 'J', 'F', 'f@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'December 2014'),
(40, 0, 'pritesh77', 'pritesh', 'pritesh', 'pritesh@gmail.com', '1c0b76fce779f78f51be339c49445c49', 'January 2015'),
(41, 0, 'riad', 'Riad', 'Jaradeh', 'riadjerade89@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'March 2015');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `user_typeid` int(3) NOT NULL auto_increment,
  `user_type` varchar(10) NOT NULL,
  PRIMARY KEY  (`user_typeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_typeid`, `user_type`) VALUES
(1, 'Primary'),
(2, 'Secondary'),
(3, 'Tertiary');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
