-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: mysql51-121.wc1:3306
-- Generation Time: Jan 06, 2015 at 07:28 AM
-- Server version: 5.1.70
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `352062_blacksociety`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `userName`, `password`) VALUES
(2, 'admin25', 'admin25');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('03fa13a6b356519a7ff8997049f2fd15', '66.249.69.177', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420508134, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('046038115b0dfa21777fbd01393e5a8f', '188.165.15.231', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420504681, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('057edea5be436e7e387e689765b25a6f', '207.46.13.142', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1420501815, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('0758f9952facd630074524a896cd4f67', '66.249.69.161', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420508141, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('09fadbdd2ec4ebda79c9481d19262f6a', '66.249.69.177', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420508111, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('18e6a816d706fb8b322a94609e1f4eb8', '66.249.69.177', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420539861, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('18f12224bdec3a11596dcadd60a553f2', '188.165.15.66', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420536895, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('19587016bed79aef82843c457d53245a', '66.249.69.177', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420514667, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('1cf11e254d991fff42d53c9b69db4d71', '188.165.15.23', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420536725, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('1fffb787b99c99a2bd9b089c0353df35', '66.249.69.145', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420528650, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('2936407eaf01024a702d03863df3865e', '66.249.69.145', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420495979, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('32550152ced77a9642ae3c01c4ea7f4d', '188.165.15.43', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420511588, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('33da1da1af68c1e0fc3bb84afe9c3017', '188.165.15.43', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420525063, 'a:3:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;s:13:"cart_contents";a:3:{s:32:"45c48cce2e2d7fbdea1afc51c7c6ad26";a:6:{s:5:"rowid";s:32:"45c48cce2e2d7fbdea1afc51c7c6ad26";s:2:"id";s:1:"9";s:3:"qty";s:1:"1";s:5:"price";s:2:"25";s:4:"name";s:11:"TicketThree";s:8:"subtotal";i:25;}s:11:"total_items";i:1;s:10:"cart_total";i:25;}}'),
('365e9c00d6dcd6a7e64c9d2868137286', '188.165.15.97', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420545857, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('3864aea4658358a91d061467003cd3bc', '188.165.15.207', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420547290, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('42acebc7fd4add01fca719d1c92c7439', '188.165.15.223', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420503054, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('438cd3efec1fd6eea39c5659e4430270', '66.249.69.145', 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5376e', 1420546648, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('4a29b158d202d28e186a33e060a12272', '66.249.69.177', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420518879, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('4e23f67352827483dbdfe3dc21a85fca', '188.165.15.66', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420510665, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('58469d68148eef5732e99e1ebf43dfe5', '66.249.69.161', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420539654, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('5e771780dcfdb6404fea51b486d7c479', '188.165.15.187', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420539614, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('5f169fc6b1e81a09419960e3cfa4ce3c', '188.165.15.207', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420512622, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('67580514a310af59025eff4c6d7f089c', '188.165.15.43', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420496645, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('740e57a681ab3ae123052faddf165154', '66.249.69.145', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420520592, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('7879b3595c93c33a2bb6f16e69d67a29', '188.165.15.211', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420545345, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('7ae0c3e54bafa96f2122986d4931635b', '100.43.85.5', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 1420530236, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('7fbfda9c30a9861e2beef7568b8fee33', '188.165.15.238', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420541710, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('805d61650df70030ce77dc3f70abe7d8', '66.249.69.161', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420516290, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('84cb706cb00046ba277dcc2772eda191', '188.165.15.43', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420498949, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('85a5051b9266f3d5b01858a50f9c9f6a', '188.165.15.85', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420535686, 'a:3:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;s:13:"cart_contents";a:3:{s:32:"d3d9446802a44259755d38e6d163e820";a:6:{s:5:"rowid";s:32:"d3d9446802a44259755d38e6d163e820";s:2:"id";s:2:"10";s:3:"qty";s:1:"1";s:5:"price";s:2:"15";s:4:"name";s:11:"Wingsoffire";s:8:"subtotal";i:15;}s:11:"total_items";i:1;s:10:"cart_total";i:15;}}'),
('8b2b2287476eb21caab07e919677fe61', '188.165.15.211', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420532019, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('93082073ce87c61f56025e9dbe832bf8', '188.165.15.211', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420498985, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('9ac93905f5b2f83739c71e5d87f18cba', '188.165.15.23', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420537228, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('a32f9406fbdc32479be43152b1f7013f', '66.249.69.145', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420549764, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('b14215e0cbe303534b7e7f62597b0ff6', '66.249.69.161', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420501742, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('b3b17b1912178e59fa38e5ce526e3359', '188.165.15.85', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420541501, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('b995ceda6cdc3ca86a811e58f52f74c7', '188.165.15.238', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420506225, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('bb2126296ef97f9622d7dd37d09ac6fd', '188.165.15.43', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420533476, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('bd338259bce75145d23991cf40df2933', '180.76.6.52', 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)', 1420501264, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('c0e2688c52f371f9be946f260059d7fe', '188.165.15.85', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420532996, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('c12e2cc4347b2285cd027880384189b3', '66.249.69.177', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420509009, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('cac38eb8d9a0356d668439270ac77e00', '188.165.15.23', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420533555, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('cdb2caae5d0b5953599d8be44350340d', '188.165.15.211', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420546160, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('ce287c3e870dc1204ba1c874cf17f3b1', '66.249.69.161', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420528639, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('d1e6edc840c1eb7db1b9b051b36fb83a', '188.165.15.187', 'Mozilla/5.0 (compatible; AhrefsBot/5.0; +http://ahrefs.com/robot/)', 1420510967, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('dbd68e53790ae49d40392fa687716256', '66.249.69.161', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420511058, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('e2b556301f48346aa20a3875e9c8b972', '180.76.6.140', 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)', 1420503105, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('e43456a05df0924faea6c7e4f68ba5d4', '180.76.6.64', 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)', 1420548183, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('e8f028ada9c0d4656386157c33debe2d', '66.249.69.161', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420549694, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('f1696b39b31ab47f57b27eb6b4a677aa', '180.76.6.62', 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)', 1420525839, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('f5b9d438b7e4b1efe8d86f2e8578539d', '66.249.69.145', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420501694, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('f7434446a31ca931e54a5c23cbbaa46d', '66.249.69.161', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420514707, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('fab5cef57cee3a347e3d17cf249d20e8', '66.249.69.177', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420549746, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}'),
('fe0c632ddb2a825e499bca008e3e2030', '66.249.69.177', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1420518901, 'a:2:{s:9:"user_data";s:0:"";s:12:"membershipID";i:1000;}');

-- --------------------------------------------------------

--
-- Table structure for table `listingDetails`
--

CREATE TABLE IF NOT EXISTS `listingDetails` (
  `listingID` int(11) NOT NULL AUTO_INCREMENT,
  `listingName` varchar(100) NOT NULL,
  `listingAddr` varchar(500) NOT NULL,
  `listingNo` varchar(25) NOT NULL,
  `listingDesc` varchar(500) NOT NULL,
  `listingWebsite` varchar(200) NOT NULL,
  `listingImg` varchar(200) NOT NULL,
  `listingUrl` varchar(255) NOT NULL,
  `listingEmail` varchar(150) NOT NULL,
  `listingCountry` varchar(100) NOT NULL,
  `listingState` varchar(100) NOT NULL,
  `listingCity` varchar(100) NOT NULL,
  PRIMARY KEY (`listingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=243 ;

--
-- Dumping data for table `listingDetails`
--

INSERT INTO `listingDetails` (`listingID`, `listingName`, `listingAddr`, `listingNo`, `listingDesc`, `listingWebsite`, `listingImg`, `listingUrl`, `listingEmail`, `listingCountry`, `listingState`, `listingCity`) VALUES
(1, 'Tom Hanks', 'Third Floor     Magdalen House  136 Tooley Street     London SE1 2TU', '98300 28525', 'This is demo listing information for Tom Hanks', 'http://google.com', 'tomhanks.jpg', 'http://www.youtube.com/watch?v=W0Gms9jn9lg', 'wbnaren@gmail.com', '', '', ''),
(2, 'Morgan Freeman', 'Third Floor     Magdalen House  136 Tooley Street     London SE1 2TU', '98300 28525', 'This is demo listing information for Morgan Freeman', 'http://google.com', 'listing2.jpg', 'https://www.youtube.com/watch?v=l1RZqwZUATM', '', '', '', ''),
(3, 'Will Smith', 'Third Floor     Magdalen House  136 Tooley Street     London SE1 2TU', '98300 28525', 'This is demo listing information for Will Smith', 'http://google.com', 'listing3.jpg', 'https://www.youtube.com/watch?v=lNrBVFP6GOs', '', '', '', ''),
(4, 'Viv Richards', 'Third Floor     Magdalen House  136 Tooley Street     London SE1 2TU', '98300 28525', 'This is demo listing information for Viv Richards', 'http://google.com', 'listing4.jpg', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', '', '', ''),
(5, 'Garry Sobers', 'Third Floor     Magdalen House  136 Tooley Street     London SE1 2TU', '98300 28525', 'This is demo listing information for Garry Sobers', 'http://google.com', 'listing5.jpg', '', '', '', '', ''),
(6, 'Katie Ambrose', 'Third Floor     Magdalen House  136 Tooley Street     London SE1 2TU', '98300 28525', 'This is demo listing information for Katie Ambrose', 'http://google.com', 'listing6.jpg', '', '', '', '', ''),
(7, 'Shatanik Ghosh', '34b roy bahadur road,ps- behala,kolkata-34', '9830028525', 'demo description for shatanik', 'http://google.com', 'Koala.jpg', '', '', '', '', ''),
(8, 'Shatanik Ghosh', '34b roy bahadur road', '9831344294', 'Demo demo', 'http://google.com', 'shutterstock_191167964-e1412070963620.jpg', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', '', '', ''),
(9, 'Test', 'g.kg/.l?jl', 'khv.kvk.v', 'jgff.jv.jhv', 'globalblackenterprises.com', 'Aff woman-who-is-posing-covered-with-blue-and-gold-paint-153661535.jpg', 'https://www.youtube.com/watch?v=hf0Tnhro0gc', '', '', '', ''),
(10, 'Sharukh Khan', 'hghg', '9831344294', 'ytytyt', 'http://google.com', '', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', '', '', ''),
(11, 'Amir Khan', '221b Baker Street, London NW1,United Kingdom', '9831344294', 'weqweqw', 'http://google.com', 'shutterstock_191167964-e1412070963620.jpg', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', '', '', ''),
(12, 'jkflyf;l', 'gcdljgvlkhb.kjb.', 'jflljhb;kjhb;k', 'gckg, .b .', ',gjc,hjv.khv', 'GBE AfropunkFestgoer.jpg', 'https://www.youtube.com/watch?v=uRNaDEOdj8E', '', '', '', ''),
(13, 'Sharukh Khan', '221b Baker Street, London NW1,United Kingdom', '123456', 'dsfsdfsd', 'http://en.wikipedia.org/wiki/Statistical_hypothesis_testing', 'WIN_20141031_061106.JPG', 'http://en.wikipedia.org/wiki/Statistical_hypothesis_testing', '', '', '', ''),
(14, 'Morgan Freeman', '34 b roy bahadur road', '9831344294', 'blabla blabla blabla', 'http://google.com', 'index.jpg', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', '', '', ''),
(15, 'Jono', 'jyedfykugh.lh', 'ytugkhu', 'tdrtfjkhl', 'Test', '1476238_10152365944292377_8622317496740749703_n.jpg', 'https://www.youtube.com/watch?v=vK0FYCBSfQU', '', '', '', ''),
(16, 'Jono', 'jyedfykugh.lh', 'ytugkhu', 'tdrtfjkhl', 'Jono', '', 'https://www.youtube.com/watch?v=vK0FYCBSfQU', '', '', '', ''),
(17, 'Aamir Khan', '34 b roy bahadur road', '9831344294', 'bla bla aamir', 'http://google.com', 'aamir.jpg', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', '', '', ''),
(18, 'Shahid Kapoor', '34b roy bahadur road', '9830028525', 'bla bla', 'http://google.com', 'shahid-kapoor-230414.jpg', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', '', '', ''),
(20, 'John Abraham', '34b roy bahadur road', '9830028525', 'bla bla', 'http://google.com', 'john-abraham-280212.jpg', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', '', '', ''),
(21, 'TaxPlus Accounting Services', '21 Drury St.\nSpringfield\nMA 01129\nUnited States', '413-787-1778', 'Accounting and tax preparation services. Small business and personal income tax preparation with electronic filing. Visit our office for our personal professional service or file your taxes on-line via our secure website.', 'http://taxplus1040.com', '195_IMG_0265.JPG', '', '', '', '', ''),
(22, 'Amitabh Bachchan', '34b roy bahadur road', '9830028525', 'bla bla Amitabh Bachchan', 'http://google.com', 'MV5BNTk1OTUxMzIzMV5BMl5BanBnXkFtZTcwMzMxMjI0Nw@@._V1_SY317_CR8,0,214,317_AL_.jpg', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', 'United kingdom', 'State A', 'City A'),
(23, 'Utranazz Concrete Equipment Specialist', 'Tingewick Road\r\nIndustrial Park\r\n', '+44 (0)1280820770', 'Utranazz supplies a range of new, second-hand and ex-demonstration concrete equipment from concrete mixers to concrete pumps and batching plants. Used equipment is available to buy in its existing off-site condition or fully-reconditioned and repainted to customer specifications.', 'Utranazz Concrete Equipment Specialist', '', '', '', 'United kingdom', '', 'City of London'),
(24, 'Utranazz Concrete Equipment Specialist', 'Tingewick Road\nIndustrial Park\nBuckingham, Buckingham MK181SU\nBuckingham', '+44 (0)1280820770', 'Utranazz supplies a range of new, second-hand and ex-demonstration concrete equipment from concrete mixers to concrete pumps and batching plants. Used equipment is available to buy in its existing off-site condition or fully-reconditioned and repainted to customer specifications.', 'Utranazz Concrete Equipment Specialist', '', '', '', 'United kingdom', '', 'Aberdeen'),
(25, 'Utranazz Concrete Equipment Specialist', 'Tingewick Road\nIndustrial Park\nBuckingham, Buckingham MK181SU\nBuckingham', '+44 (0)1280820770', 'Utranazz supplies a range of new, second-hand and ex-demonstration concrete equipment from concrete mixers to concrete pumps and batching plants. Used equipment is available to buy in its existing off-site condition or fully-reconditioned and repainted to customer specifications.', 'Utranazz Concrete Equipment Specialist', '', '', '', 'United kingdom', '', 'Aberdeen'),
(26, 'Himadri das', '', '', '', 'http://google.com', 'Koala.jpg', 'http://www.youtube.com/watch?v=82ZEDGPCkT8', '', 'United kingdom', '', 'Aberdeen'),
(27, 'Ayan Goswami', '223 elton street', '9831344294', '', '', 'Penguins.jpg', '', '', 'United kingdom', '', 'Aberdeen'),
(28, 'ODS - Overseas Development Solutions', '81 Oxford Street', '44 (0) 207 531 9711', 'Overseas Development Solutions (ODS) facilitates business to business trade and investment links between the UK and selected overseas countries with a particular focus on Africa.', '', '', '', '', 'United kingdom', '', 'Londonderry'),
(29, 'ODS - Overseas Development Solutions', '81 Oxford Street', '44 (0) 207 531 9711', 'Overseas Development Solutions (ODS) facilitates business to business trade and investment links between the UK and selected overseas countries with a particular focus on Africa.', 'ODS - Overseas Development Solutions', '', '', '', 'United kingdom', '', 'Aberdeen'),
(30, 'Scaffolding Pipe', 'Guankengcun,Daqiuzhuang Town,Jinghai County\n310006', '862583557300', 'Scaffolding Pipe have many different sizes,such as:48.3*3.0mm,48.3*3.2mm,48.6*3.0mm,60.3*2.0mm ect,all of the steel pipe can be finished by electro gal,hot dip gal,or painting on request.\nAny more,pls contact us.', '', '', '', '', 'United kingdom', '', 'Aberdeen'),
(31, 'Motomech AutoCentre', '', '0121 333 7777', '', '', '', '', '', 'United kingdom', '', 'Aberdeen'),
(32, 'One Stop Driver', '', '07789803600   07963251652', '', 'Motomech AutoCentre', '', '', '', 'United kingdom', '', 'Aberdeen'),
(33, 'All Nations Nails & Beauty', 'Unit 18-19, IN SHOPS, ONE STOP, 2 WALSALL RD,', '0121 331 4525', '', 'One Stop Driver', '', '', '', 'United kingdom', '', 'Bakersfield'),
(34, 'Better Cut Barbers', '470 DUDLEY RD, WINSON GREEN', '0789 5201 037', '', 'All Nations Nails & Beauty', '', 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '', 'United kingdom', '', 'Wakefield'),
(35, 'Blaque 2 Natural', '446 BIRCHFIELD ROAD, PERRY BARR', '07947 817 701', '', 'Better Cut Barbers', '', 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '', 'United kingdom', '', 'Bath'),
(36, 'Carmen''s Beauty Care', '225B Lozells RD', '0121 551 1946', '', 'Blaque 2 Natural', '', 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '', 'United kingdom', '', 'Aberdeen'),
(37, 'Get Cutt', '30 GLEBE FARM ROAD, STECHFORD', '0121 244 7605', '', 'Carmen''s Beauty Care', '', 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '', 'United kingdom', '', 'Aberdeen'),
(38, 'Dudley Road Barbers', '351 DUDLEY RD, WINSON GREEN', '0121 572 9614', '', 'Get Cutt', '', 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '', 'United kingdom', '', 'Aberdeen'),
(39, 'Hand Of God Hair & Nail Salon', '351 BIRCHFIELD RD, PERRY BARR,', '0121 356 1304', '', 'Dudley Road Barbers', '', 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '', 'United kingdom', '', 'Aberdeen'),
(40, 'Hair Plus', 'NORTHFIELD MARKET, 855-857 BRISTOL ROAD SOUTH,', '07974 672 482', '', 'Hand Of God Hair & Nail Salon', '', 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '', 'United kingdom', '', 'Newry'),
(41, 'A & A Collision Center', '9640 South Vermont Blvd.', '', 'Auto Body and Repair + Paint Free Towing With all Major Jobs Insurance Repair Quotes', '', '', '', '', 'USA', '', 'Los Angeles'),
(42, 'Kings Unisex Hair Salon', '22 HOLLOWAY CIRCUS, QUEENSWAY,', '0121 643 6668', '', 'Hair Plus', '', 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '', 'United kingdom', '', 'Aberdeen'),
(43, 'Lola: Hairdresser', '6A ASTON LANE, PERRY BARR,', '0778 7921 283', '', 'Kings Unisex Hair Salon', '', '', '', 'United kingdom', '', 'Aberdeen'),
(44, 'DETAIL TRAILER WORK', '3120 loganwood dr.\ncolonial heights', '(804)796-1596', 'I own A singal 16000 lb. box truck which I''ve stocked with all the nessary tools to be on my own, so that I may have the oppotunity to show and guide my grand chidren and others how to dream and be succesful. theres still room.', 'A & A Collision Center', '', '', '', 'USA', '', 'Vancouver'),
(45, 'Soho Barbers', '338B SOHO RD, HANDSWORTH', '0121 448 0072', '', 'Lola: Hairdresser', '', '', '', 'United kingdom', '', 'Aberdeen'),
(46, 'BESHOFF MOTORCARS', '3000 East Capitol Expressway\nSan Jose', '(804)796-1596', 'Beshoff MotorCars MBZ is the most successful new dealership launch in Mercedes Benz history! We may be short on history but we are very long on customer service. This Dealership has built a reputation on providing courteous, honest service.', 'http://www.beshoffmotorcars.com/', '', '', '', 'USA', '', 'Cambridge'),
(47, 'The Elegant Empress', '241 - 243 DUDLEY RD, WINSON GREEN,', '0121 455 8218', '', 'Soho Barbers', '', '', '', 'United kingdom', '', 'Aberdeen'),
(48, 'Total Empress Hair Salon', '433-435 DUDLEY RD, WINSON GREEN', '0121 588 7888', '', 'The Elegant Empress', '', '', '', 'United kingdom', '', 'Aberdeen'),
(49, 'Bill Perkins Automotive Group The', '13801 Telegraph Road', '734-287-2600', '', '', '', '', '', 'USA', '', 'Miami'),
(50, 'AbeizaBodyZone', 'BRANSTON COURT, JEWELLERY QUARTER,', '0121 554 9192', '', 'Total Empress Hair Salon', '', '', '', 'United kingdom', '', 'Aberdeen'),
(51, 'BMW of The Hudson Valley', '2068 South Rd.\nPoughkeepsie', '845-462-1030', '', '', '', '', '', 'USA', '', 'New York'),
(52, 'Ace Fitness FIT4LIFE', 'INTENSE ONE 2 ONE AND GROUP FITNESS', '0794 751; 07859 138 021', '', 'AbeizaBodyZone', '', '', '', 'United kingdom', '', 'Aberdeen'),
(53, 'Chandler Lee Buick-Pontiac-GMC Inc.', '8800 Ridge Road\nEllicott City', '410-465-9100', '', '', '', '', '', 'USA', '', 'Modesto'),
(54, 'eSCENTials From Kush', 'Incense and Body Oils', '0794 0086 358', '', 'Ace Fitness FIT4LIFE', '', '', '', 'United kingdom', '', 'Aberdeen'),
(55, 'East Tulsa Dodge Inc.', '4627 S. Memorial\nTulsa', '918-663-6343', '', '', '', '', '', 'USA', '', 'Oklahoma City'),
(56, 'Jen''s Salon', 'PACE HEALTH CLUB,\nPARK INN BIRMINGHAM WEST, EUROPA AVENUE,', '07932 024', '', 'eSCENTials From Kush', '', '', '', 'United kingdom', '', 'Aberdeen'),
(57, 'Family Automotive Group', '33395 Camino Capistrano\nSan Juan Capistrano', '949-493-4100', '', '', '', '', '', 'USA', '', 'Cambridge'),
(58, 'Fitzpatrick Dealership Group', 'Modesto', '', '', '', '', '', '', 'USA', '', 'Cambridge'),
(59, 'Marks School of Black Belts', 'MARTIAL ARTS SCHOOL, ACROSS', '07549 009', '', 'Jen''s Salon', '', '', '', 'United kingdom', '', 'Aberdeen'),
(60, 'Folsom Buick-Pontiac-GMC Inc.', '12640 Auto Mall cir\nFolsom', '916-355-1414', '', '', '', '', '', 'USA', '', 'Cambridge'),
(61, 'Satellite Life Coaching & Training', 'DIGBETH COURT BUSINESS CENTRE, 162 HIGH STREET, DERITEND', '0121 441 9500', '', 'Marks School of Black Belts', '', '', '', 'United kingdom', '', 'Aberdeen'),
(62, 'Franklin Greene Automotive Group', 'West Des Moines', '', '', '', '', '', '', 'USA', '', 'Irving'),
(63, 'Sedonah', 'Indulge in exclusive handmade products', '07932 983 997', '', 'Satellite Life Coaching & Training', '', '', '', 'United kingdom', '', 'Aberdeen'),
(64, 'Freehold Chevrolet', '3712 Route 9\nFreehold', '732-462-1324', '', '', '', '', '', 'USA', '', 'Newport News'),
(65, 'F3 49-50 BRADFORD STREET, BUSINESS CENTRE,', 'WALSALL, WS1 3QD', '01922 276 121', '', 'Sedonah', '', '', '', 'United kingdom', '', 'Aberdeen'),
(66, 'Global Automotive Alliance LLC', 'Detroit', '732-462-1324', '', '', '', '', '', 'USA', '', 'Midland'),
(67, 'Global Automotive Alliance LLC', '3708 E. 30th St\nIndianapolis', '317-545-4555', 'Sell new and used cars. Auto body repair/Painting.', '', '', '', '', 'USA', '', 'Indianapolis'),
(68, 'Hubbard Automotive LLC', 'Charlotte', '', '', '', '', '', '', 'USA', '', 'North Charleston'),
(69, 'Caribana', '32-34 HOLLOWAY CIRCUS, QUEENSWAY,', '0121 448 7608', '', '', '', '', '', 'United kingdom', '', 'Aberdeen'),
(70, 'JMC Auto Group', 'Austin', '', '', '', '', '', '', 'USA', '', 'Torrance'),
(71, 'Carib Grill', '2-4 MARYS ROW, MOSELEY,', '0121 449 8818', '', 'Caribana', '', '', '', 'United kingdom', '', 'Aberdeen'),
(72, 'LBT HOUSE OF IMPORTS INC.', '9253 HERMOSA AVENUE SUITE #E\nRANCHO CUCAMONGA', '909-483-8285', 'AUTO DEALERSHIP DESIGNED FOR BUYERS PROVIDING THEIR OWN FINANCING & WANTING THE PERSONAL SERVICES OF AN AUTOMOTIVE SHOPPER. AS MEMBERS OF MANHEIM, THE LARGEST DEALER AUTO AUCTION IN THE UNITED STATES, WE HAVE ACCESS TO NUMEROUS YEARS, MADES & MODELS OF QUALITY PRE-OWNED AND NEW LUXURY VEHICLES WITH LOW MILES & EXISTING WARRANTIES.', '', '', '', '', 'USA', '', 'Cambridge'),
(73, 'Caribbean Taste', '57 GLEBE FARM ROAD, STETCHFORD', '0121 786 2294', '', 'Carib Grill', '', '', '', 'United kingdom', '', 'Aberdeen'),
(74, 'Lexus of Memphis', '2711 Mendenhall Road South\nMemphis', '901-362-8833', '', '', '', '', '', 'USA', '', 'Tempe'),
(75, 'Martin Automotive Group', '2201 Scottsville Rd.\nBowling Green', '270-842-6323', '', '', '', '', '', 'USA', '', 'Kansas City'),
(76, 'Crown & Cushion', 'BIRCHFIELD RD, PERRY BARR,', '0121 344 7831', '', 'Caribbean Taste', '', '', '', 'United kingdom', '', 'Aberdeen'),
(77, 'Deep Experience', '34 BRISTOL STREET,', '0121 622 3332', '', 'Crown & Cushion', '', '', '', 'United kingdom', '', 'Aberdeen'),
(78, 'Matthews Automotive Group The', 'Daytona Beach', '', '', '', '', '', '', 'USA', '', 'Fort Lauderdale'),
(79, 'Devine African Restaurant & Bar', '325 SOHO RD, HANDSWORTH,', '0121 439 1140', '', 'Deep Experience', '', '', '', 'United kingdom', '', 'Aberdeen'),
(80, 'Mike Johnson Auto Group', 'New Baltimore', '', '', '', '', '', '', 'USA', '', 'Miami'),
(81, 'LaCarib Express', '427 DUDLEY, RD, WINSON', '0121 558 5414', '', 'Devine African Restaurant & Bar', '', '', '', 'United kingdom', '', 'Aberdeen'),
(82, 'Lick Your Finger', '184-188 DUDLEY RD, WINSON GREEN', '0121 454 9355', '', 'LaCarib Express', '', '', '', 'United kingdom', '', 'Aberdeen'),
(83, 'Mt. Kisco Chevrolet- Cadillac-Hummer Inc.', '175 North Bedford Rd.\nMt. Kisco', '914-241-9500', '', '', '', '', '', 'USA', '', 'New York'),
(84, 'New Castle Ford-Lincoln-Mercury Inc.', '221 N Memorial Dr\nNew Castle', '765-529-3673', '', '', '', '', '', 'USA', '', 'Indianapolis'),
(85, 'Panhandle Automotive Inc.', 'Crestview', '765-529-3673', '', '', '', '', '', 'USA', '', 'Fort Lauderdale'),
(86, 'Poughkeepsie Chevrolet- Oldsmobile-Cadillac Inc.', '791 South Rd\nPoughkeepsie', '845-298-1193', '', '', '', '', '', 'USA', '', 'New York'),
(87, 'Poughkeepsie Ford Inc.', '641 South Road\nPoughkeepsie', '845-462-1900', '', '', '', '', '', 'USA', '', 'New York'),
(88, 'Prestige Automotive', '10457 Gratiot Avenue\nDetroit', '', '', '', '', '', '', 'USA', '', 'Miami'),
(89, 'Reid Automotive Group', 'Rome', '', '', '', '', '', '', 'USA', '', 'Gainesville'),
(90, 'Shamrock Ford-Lincoln-Mercury Inc.', '829 Tecumseh\nClinton', '517-456-7414', '', '', '', '', '', 'USA', '', 'Midland'),
(91, 'Southgate Automotive Group', '13252 Eureka Road,\nSouthgate', '517-456-7414', '', '', '', '', '', 'USA', '', 'Miami'),
(92, 'Stephens Automotive Group', '1302 K Avenue\nPlano', '972-633-9857', '', '', '', '', '', 'USA', '', 'Tempe'),
(93, 'Texoma Ford Inc.', '215 N US Highway 75\nDenison', '903-465-5671', '', '', '', '', '', 'USA', '', 'Torrance'),
(94, 'The Pampered Image, Inc.', 'P.O. Box 451411', '310-216-4922', 'Female owned used car dealership located in Westchester, California, near LAX. We offer good running used cars at bargain low prices. We have all makes and models and years. Call Us Now!', 'http://www.pamperedimage.com', '', '', '', 'USA', '', 'Los Angeles'),
(95, 'University Automotive Group', 'Snellville', '', '', '', '', '', '', 'USA', '', 'Garland'),
(96, 'Vicksburg Chrysler-Dodge-Jeep Inc.', '13475 Portage Rd\nVicksburg', '269-649-2000', '', '', '', '', '', 'USA', '', 'Minneapolis'),
(97, 'Westminster Buick-Pontiac-GMC Inc.', '15550 Beach Blvd\nWestminster', '714-894-3341', '', '', '', '', '', 'USA', '', 'Cambridge'),
(98, 'Lick Your Finger', '184-188 DUDLEY RD, WINSON GREEN', '0121 454 9355', '', '', '', '', '', 'United kingdom', '', 'Aberdeen'),
(99, 'Paradise Kitchen', 'NORTHFIELD MARKET, 855-857 BRISTOL ROAD SOUTH', '0787 633 5966', '', 'Lick Your Finger', '', '', '', 'United kingdom', '', 'Aberdeen'),
(100, 'DNext Level Mobile Detail', '3816 Walsingham dr.\nMemphis', '901-388-4054', 'I do mobile detailing inside and out on cars, trucks,and SUV''s. I wet sand vehicles with new paint jobs and buff them all over. And there''s more of what my mobile business consists of.', '', 'DNext Level Mobile Detail.jpg', '', '', 'USA', '', 'Thornton'),
(101, 'Portland Lagoon Caribbean Eatery & Takeaway', '9 GREAT HAMPTON STREET, HOCKLEY', '0121 236 8119', '', 'Paradise Kitchen', '', '', '', 'United kingdom', '', 'Aberdeen'),
(102, 'Plates of the Caribbean', '494 COVENTRY RD, SMALL HEATH', '0121 771 0772', '', 'Portland Lagoon Caribbean Eatery & Takeaway', '', '', '', 'United kingdom', '', 'Aberdeen'),
(103, 'Talk Of The Town', '391 DUDLEY RD', '0121 565 2300', '', 'Plates of the Caribbean', '', '', '', 'United kingdom', '', 'Aberdeen'),
(104, 'Dri Wash n Guard Int. - Showroom Shine Auto Detailing Srv LLC', '2415 Minerva Park Place\nColumbus', '901-388-4054', 'Wash and detail vehicles with Dri Wash n Guard Waterless Car products.Interested in people who want to start their own Detail/Wash Business. I''ll personally come and help you set up Shop $2k investment. Start making money in 2 days. Be your own Boss!', 'http://ricswaterlesshine.dwgint.net', '', '', '', 'USA', '', 'Omaha'),
(105, 'J. Rucker Mobile Detailing', 'PO Box 712992\nSan Diego', '', 'This is a small black owned business that has been around for a few months in san diego county. It is looking to expand and provide convenient and quality service.', '', '', '', '', 'USA', '', 'Cambridge'),
(106, 'Top Taste', '391 DUDLEY RD', '0121 565 2300', '', 'Talk Of The Town', '', '', '', 'United kingdom', '', 'Bath'),
(107, 'RTP Cleaning & Detail Service', '914 North Pollock Street\nSelma', '919-965-4691', 'Also offering mobile detailing, power washing, and window tinting.', '', '', '', '', 'USA', '', 'North Charleston'),
(108, 'YAM! Till Your Belly Full', '1402 PERSHORE ROAD, STIRCHLEY', '07505 819 150', '', 'Top Taste', '', '', '', 'United kingdom', '', 'Aberdeen'),
(109, 'Morris Upholstery Manufacturers', '1402 PERSHORE ROAD, STIRCHLEY', '0750 430 1251   0121 533 ', '', 'YAM! Till Your Belly Full', '', '', '', 'United kingdom', '', 'Aberdeen'),
(110, 'Bright Driver Safety School', '432 Main Street\nGrapevine', '877-270-0667', 'Defensive Driving for Corporate Safety Transportation Departments. Defensive Driving for Auto Insurance Discounts and Traffic Ticket Dismissal.', 'http://brightdriversafety.com', '', '', '', 'USA', '', 'Tallahassee'),
(111, 'AUTOMOTIVE JEWELRY', '504 NORTH McPHERSON CHURCH RD.\nFAYETTEVILLE', '910-825-6613 message line', 'CUSTOM RIMS/TIRES SPOILER KITS AUTO ACCESSORIES', '', '', '', '', 'USA', '', 'North Charleston'),
(112, 'Sound Chamber Car Audio', '1101 E Hudson Street\nColumbus', '614-586-1105', 'Car audio, mobile video, wheels, tires, alarms, remote start systems.', 'http://www.merchantcircle.com/business/Sound.Chamber.Car.Audio.Columbus.OH.614-586-1105', '', '', '', 'USA', '', 'Omaha'),
(113, 'Sound Chamber Car Audio', '1101 E Hudson Street\nColumbus', '614-586-1105', 'Car audio, mobile video, wheels, tires, alarms, remote start systems.', 'http://www.merchantcircle.com/business/Sound.Chamber.Car.Audio.Columbus.OH.614-586-1105', '', '', '', 'USA', '', 'Omaha'),
(114, 'AAA Transmissions', '2794 CLEVELAND AVENUE\nColumbus', '614-263-1831', 'All automotive repair & transmission specialist, clutch replacement service', '', '', '', '', 'USA', '', 'Omaha'),
(115, 'Auto EXCHANGE Service Center', '1225 E. 23rd\nLawrence', '(785) 832.1010', 'Our Employees Have a Combined Experience of Nearly 75 Years! Come See Us For All Your Automotive Needs.', '', '', '', '', 'USA', '', 'Killeen'),
(116, 'Ethos Fuel Saver - Independent Distributor', '', '', 'This proprietary product cleans and lubricates the Fuel System and Engine Crankcase. This includes fuel lines, filters, carburetors, spark plugs, injectors, engine seals and all moving parts, causing improved combustion, horsepower and increasing miles or hours per gallon.\n\nWorks with All Fuels & All Engine Oils -- Cars, Trucks, Buses, RV’s, Ships, Trains, Generators, Landscaping, Construction and Farm Equipment\nExtends the life of your engine and engine oil\nHelps to lubricate Ultra Low Sulfur D', 'http://www.wisconsingreenfuelsaver.com', 'Ethos Fuel Saver - Independent Distributor.jpg', '', '', 'USA', '', 'Wilmington'),
(117, 'MonaVie Independent Distributor - Andrea Mack', '', '770 884-7428', 'Cleanses & detoxifies the body, Helps build a strong body by providing protein, Enhances muscle contractions & muscle regeneration, Increase energy & stamina, Stress relief, Improves sexual health, Aids body synergy, A potent anti-aging food, May help prevent prostate enlargement, Helps prevent osteoporosis, Menstrual cycles, May help prevent causes of heart disease, Reduces bad cholesterol, Sterols may lower blood pressure, Protects blood vessels, Helps thwart retinopathy, Improves glucose lipi', 'http://www.mymonavie.com/andreamack', '', '', '', 'USA', '', 'Anchorage'),
(118, 'Agel', '', '770 884-7428', 'Based on our proprietary Suspension Gel Technology formula, we presently provide nutritional supplements made of the finest vitamins, minerals, and herbs from around the globe. No taking pills, drinking shakes, protein bars, or wearing patches. Rip and Sip. Do Life and Be Healthy.', 'http://agel.com', 'Agel.gif', '', '', 'USA', '', 'Stockton'),
(119, 'AMERIPLAN HEALTH -TEAGUE AND ASSOCIATES', '7115 W NORTH AVENUE #177', '888-516-6042', 'DISCOUNT HEALTH PLAN - DENTAL PLANS 19.95/MO FAMILY AND 11.95/MO INCLUDES FREE VISION, RX AND CHIROPRACTIC PLAN', 'http://WWW.EVERYONEBENEFITS.COM/AFFORDABLEHEALTHPLANS', '', '', '', 'USA', '', 'Overland Park'),
(120, 'Avalaura’s Healing Center', '', '301-675-8723', 'Discover how we can jumpstart your healing today. Avalaura’s Healing Center is a holistic healing and wellness center that treats the mind, body and spirit.\n\nOur mission is to assist individuals in achieving genuine healing of mind, body and spirit by utilizing natural, holistic, therapeutic services, classes and products.\n\nWe guide you through a natural and holistic healing process that is deep, effective and transforming. We integrate various spiritual and therapeutic modalities to customize a', 'http://www.avalaura.com', 'Avalaura’s Healing Center.jpg', '', '', 'USA', '', 'College Station'),
(121, 'Divine Splendor Healing', 'East Palo Alto', '650-862-8036', 'Helping people heal their multi-generational pain and release their divine splendor so that they become the full expression of who they are meant to be here on earth using several energy clearing modalities including a technique called Emotional Freedom & Healing.', 'http://www.divinesplendorhealing.com', 'Divine Splendor Healing.jpg', '', '', 'USA', '', 'Cambridge'),
(122, 'Road to Consciousness', '', '', 'Afrocentric bookstore', 'http://www.road2consciousness.com', '', '', '', 'USA', '', 'Cambridge'),
(123, 'Double Rainbow Enterprises International', '304 Leta Street', '863-808-6507', 'Organo Gold is on a mission, spreading the knowledge of Ganoderma to the four corners of the world. By using the cost effective network distribution system to deliver these Ganoderma products, more of every dollar is shared with our growing Organo Gold family world-wide.\n\nThink about your future. Where will you and your family be in 5 years from right now? You may know where you want to be, but do you know how you are going to get there? Do you have a plan? Now more than ever it’s up to you to d', 'http://TharsGoldInThatCup.OrganoGold.com', 'Double Rainbow Enterprises International.jpg', '', '', 'USA', '', 'Fullerton'),
(124, 'Your Excellent Health', '', '', 'Health screens, Vaccinations, Occupational health', 'http://www.yourexcellenthealth.co.uk', '', '', '', 'United kingdom', '', 'City of London'),
(125, 'Live Blood Test', '', '', '', 'http://www.livebloodtest.com', '', '', '', 'United kingdom', '', 'Aberdeen'),
(126, 'Brent Black African & Caribbean Mental Health Consortium', '', '', 'Health Support Group', '', '', '', '', 'United kingdom', '', 'City of London'),
(127, 'Brent Black African & Caribbean Mental Health Consortium', '', '', 'Health Support Group', 'Brent Black African & Caribbean Mental Health Consortium', '', '', '', 'United kingdom', '', 'City of London'),
(128, 'Sandwell African Caribbean Mental Health Foundation', 'West Bromwich,', '', 'Support Group', 'Brent Black African & Caribbean Mental Health Consortium', '', '', '', 'United kingdom', '', 'Aberdeen'),
(129, 'Sandra Webb Hair & beauty', 'West Bromwich,', '', 'Salon', 'http://www.sandrawebb.com', '', '', '', 'United kingdom', '', 'City of London'),
(130, 'Splinters Partnership', 'West Bromwich,', '', 'Hair,Nail and Beauty', 'http://splinterspartnership.com', '', '', '', 'United kingdom', '', 'City of London'),
(131, 'May''s Motion Hair Design & Beauty Supplies', 'West Bromwich,', '', 'Hair and Beauty products', '', '', '', '', 'Canada', '', 'Ontario'),
(132, 'Coca Blitz Hair Design', 'Calgary', '', 'Hair stylist', '', '', '', '', 'Canada', '', 'Alexandria'),
(133, 'Rayman''s West Indian Variety Store', 'Toronto', '', 'Cosmetic Retailer', '', '', '', '', 'Canada', '', 'Ontario'),
(134, 'Morris Roots Academy Branch', 'Tooting Broadway', '', 'Salon', 'http://morris-roots.com', '', '', '', 'United kingdom', '', 'City of London'),
(135, 'Morris Roots (Highgate Branch)', 'Highgate', '', 'Salon', 'http://morris-roots.com/contact', '', '', '', 'United kingdom', '', 'City of London'),
(136, 'Morris Roots (Fulham Branch)', 'Fulham', '', 'Salon', 'http://morris-roots.com/contact', '', '', '', 'United kingdom', '', 'City of London'),
(137, 'Morris Roots (Tooting Branch)', 'Tooting', '', 'Salon', 'http://morris-roots.com/', '', '', '', 'United kingdom', '', 'City of London'),
(138, 'Harriet Kessie Hairdressing', 'Edmonton', '', 'Salon', 'http://www.harrietkessie.com', '', '', '', 'United kingdom', '', 'City of London'),
(139, 'D''Hub Hair and Beauty Paradise', 'Edmonton', '', 'Salon', 'http://www.dhubhair.co.uk/', '', '', '', 'United kingdom', '', 'City of London'),
(140, 'CE''NJU ORGANIC SKINCARE for Women of Colour', 'Hampshire', '', 'Beauty Service', 'http://www.cenjuskincare.co.uk', '', '', '', 'United kingdom', '', 'Aberdeen'),
(141, 'Brides and Beauty', 'Berkshire', '', 'Beauty Service', 'http://www.bridesandbeauty.co.uk', '', '', '', 'United kingdom', '', 'Aberdeen'),
(142, 'Bespoke Beauty', '', '', 'Beauty Service', 'http://www.bespokebeauty.co.nr', '', '', '', 'United kingdom', '', 'City of London'),
(143, 'Beautyrose', '', '', 'Salon', 'http://www.beautyrose.co.uk', '', '', '', 'United kingdom', '', 'City of London'),
(144, 'AJ Nails', '', '', 'Beauty service', 'http://www.freewebs.com/ajnails', '', '', '', 'United kingdom', '', 'Aberdeen'),
(145, 'ABENI -UK', 'Fulham', '', 'Beauty Products', 'AJ Nails', '', 'http://www.abeni.co.uk', '', 'United kingdom', '', 'City of London'),
(146, 'SALON 5011', '', '', 'Salon', 'ABENI -UK', '', 'http://www.abeni.co.uk', '', 'USA', '', 'Aberdeen'),
(147, 'Arlene Joyce Creations', '', '', 'Fashion Designer', 'SALON 5011', '', 'http://www.abeni.co.uk', '', 'USA', '', 'Aberdeen'),
(148, 'Lauren Bailey Styling', '', '', 'Styling service', 'Arlene Joyce Creations', '', 'http://www.abeni.co.uk', '', 'United kingdom', '', 'City of London'),
(149, 'Potential U', '', '', 'Styling Service', 'Lauren Bailey Styling', '', 'http://www.abeni.co.uk', '', 'United kingdom', '', 'Aberdeen'),
(150, 'Samantha Jewellery Emporium', '', '', 'Jewellery Retailer', 'http://www.samanthasjewelleryemporium.com', '', '', '', 'United kingdom', '', 'City of London'),
(151, 'Catherine Marche Designs', '', '', 'Jeweller', 'http://bijoux.catherinemarche-designs.com', '', '', '', 'United kingdom', '', 'Aberdeen'),
(152, 'Elisha Francis', '', '', 'Jeweller', 'http://www.elishafrancis.com/contact.html', '', '', '', 'United kingdom', '', 'City of London'),
(153, 'I Love Crystal Ltd', 'Kensington', '', 'Jeweller', 'http://www.ilovecrystal.co.uk', '', '', '', 'United kingdom', '', 'City of London'),
(154, 'House of ilona', 'Milton Keynes', '', 'Fashion and design', 'I Love Crystal Ltd', '', '', '', 'United kingdom', '', 'Aberdeen'),
(155, 'Joy Prime', 'Milton Keynes', '', 'Fashion designer', 'http://www.joyprime.com/', '', '', '', 'United kingdom', '', 'City of London'),
(156, 'Camer Couture', '', '', 'Fashion and Design', 'http://www.camercouture.com', '', '', '', 'United kingdom', '', 'City of London'),
(157, 'Freedom Style', 'Highams Park', '', 'Hair Salon', 'http://www.freedomstyle.co.uk', '', '', '', 'United kingdom', '', 'City of London'),
(158, 'The Caribbean', 'Okehampton', '', 'Beauty Salons', '', '', '', '', 'United kingdom', '', 'Derby'),
(159, 'Floes African Hut', 'Manchester', '', 'Fabric Shops', '', '', '', '', 'United kingdom', '', 'Aberdeen'),
(160, 'Faze 2 African Barbers', '', '', 'Hairdressers', '', '', '', '', 'United kingdom', '', 'City of London'),
(161, 'African Vogue Ltd', '', '', 'Hairdressers', '', '', '', '', 'United kingdom', '', 'City of London'),
(162, 'Vinnie Bernards Afro Caribbean & European Hair', '', '', 'Hairdressers', '', '', '', '', 'United kingdom', '', 'Coventry'),
(163, 'Judith African Caribbean Hair Design', '', '', 'Hairdresser', '', '', '', '', 'United kingdom', '', 'Aberdeen'),
(164, 'Vinnie Bernards Afro Caribbean & European Hair', '', '', 'Hairdressers', '', '', '', '', 'United kingdom', '', 'Coventry'),
(165, 'Vinnie Bernards Afro Caribbean & European Hair', '', '', 'Hairdressers', '', '', '', '', 'United kingdom', '', 'Bristol'),
(166, 'Vinnie Bernards Afro Caribbean & European HairAfrican Hairlines', '', '', 'Barber', '', '', '', '', 'United kingdom', '', 'City of London'),
(167, 'African Fabric Shop', '', '', 'Fabric Shop', '', '', '', '', 'United kingdom', '', 'City of London'),
(168, 'Vinnie Bernards Afro Caribbean & European Hair', '', '', 'Hair Salon', '', '', '', '', 'United kingdom', '', 'Coventry'),
(169, 'Mobile Afro Caribbean Hair Stylist', 'Nottingham,', '', 'Mobile Hairdresser', '', '', '', '', 'United kingdom', '', 'Nottingham'),
(170, 'Vinnie Bernards Afro Caribbean & European Hair', '', '', 'Hairdressers', '', '', '', '', 'United kingdom', '', 'Coventry'),
(171, 'Charles Gordon Estates', 'Catford', '', 'Estates Agent', 'http://www.charlesgordonestates.co.uk', '', '', '', 'United kingdom', '', 'City of London'),
(172, 'Westside Estates', 'Wembly', '', 'Estate Agent', 'http://westsideestates.co.uk', '', '', '', 'United kingdom', '', 'Aberdeen'),
(173, 'FitVegans', 'P.O. Box 8371', '626-354-4215', 'Fitness training, nutritional supplements and herbal medicinals, holistic dietary consultation', 'http://Www.fitvegans.com', '', '', '', 'USA', '', 'Clearwater'),
(174, 'Food for Hearts, Holistic Health, Wellness and Education Consultants', 'P.O. Box 3752\nUrbandale', '773-531-2492', 'FOOD FOR HEARTS is a holistic health, wellness and education consultant company owned by Marie D. McCohnell.\n\nDear Sister and Brother Friends,\nMy name is Marie D. McCohnell. I will gently provide you with the assistance that you need in bringing your body, mind and emotions into total balance via optimum holistic wellness practices and therapies. I offer in person counseling or via the telephone. We fun and informative workshops and learning events. Over the years, I have personally dedicated my', 'http://foodforhearts.com', 'Food for Hearts, Holistic Health, Wellness and Education Consultants.jpg', '', '', 'USA', '', 'Irvine'),
(175, 'Forbes Healthy Trend', 'PO Box 970757', '', 'Wild Harvest Herbs for Weight loss, Diabetes, Prostate Health, High Blood Pressure, Hair re-growth and much more. No Organic pesticides or chemicals added', 'http://forbeshealthytrend.com', 'Forbes Healthy Trend.jpg', '', '', 'USA', '', 'Miami'),
(176, 'Clearview Properties', 'Beckenham', '', 'Estate Agent', 'http://www.clearview-properties.co.uk', '', '', '', 'United kingdom', '', 'Aberdeen'),
(177, 'Healthiersteps', '155 Hartland Lakeview Dr.', '540-661-0383', 'Provide Gluten free Vegan recipes, cookbook also coming soon. Also dedicated to providing natural hair,skin and body care products.', 'http://www.healthiersteps.com', 'Healthiersteps.jpg', '', '', 'USA', '', 'Virginia Beach'),
(178, 'Hypnotherapy4Health', '3075-H Colonial Way', '404-290-1655', 'Clinical Hypnotherapist/Coach works with various mental and emotional health related issues - abuse, addiction, anger, allergies, confidence, depression, fear/phobias, obsessive thoughts, panic attacks, sports/talent and weight loss', 'http://www.hypnotizeanybody.com', 'Hypnotherapy4Health.jpg', '', '', 'USA', '', 'Grand Rapids'),
(179, 'Toad Hall Caribbean', 'Kingsbridge', '', 'Property - Overseas', '', '', '', '', 'United kingdom', '', 'Aberdeen'),
(180, 'LifeWave', '3075-H Colonial Way', '', 'Breakthroughs in Health and Lifestyle: LifeWave was founded on the principle of breakthrough personal-improvement technology that helps people all over the world to feel great and live well. Our products create a world-class financial opportunity for anyone who wants to share in our mission. We believe strongly in our values of the highest integrity, superior quality, and service to others. Our company follows the age-old philosophy of The Golden Rule: Do unto others as you would have them do un', 'http://www.lifewave.com/build4wealth', 'LifeWave.JPG', '', '', 'USA', '', 'Allentown'),
(181, 'African Palms Ltd', 'Kingsbridge', '', 'Church Craftsmen & Restorers', '', '', '', '', 'United kingdom', '', 'City of London'),
(182, 'Mother Knows Best Herbal Solutions - Nature Sunshine Products', 'Dixmoor', '708-299-7319', 'Herbal Supplements, Colon Cleanses, Weight loss products and more.', 'http://www.motherknowsbest.net', '', '', '', 'USA', '', 'Arvada'),
(183, 'African Girl Ltd', 'Woking', '', 'Property Development', '', '', '', '', 'United kingdom', '', 'Aberdeen'),
(184, 'African Chic', 'Kings Langley', '', 'Garden Services', '', '', '', '', 'United kingdom', '', 'Hereford'),
(185, 'MR Rand Enterprises', '225 19th Ave', '732-836-9211', 'My aim is to provide information to those who have an open mind and interest in exploring alternative health options. Natural alternatives that can be used with or instead of drugs. People who are concerned with improving and maintaining their health, and would like to attain and maintain their ideal weight. Exceptional products and business opportunity for the right person.', 'http://www.maxforlife.net', '', '', '', 'USA', '', 'Newark'),
(186, 'Caribbean Dreams Ltd', 'Upminster,', '', 'Caribbean Property Sales', 'African Chic', '', '', '', 'United kingdom', '', 'Aberdeen'),
(187, 'Caribbean Dreams Ltd', 'Upminster,', '', 'Caribbean Property Sales', 'http://old.caribbeandreamsproperty.com', '', '', '', 'United kingdom', '', 'Aberdeen'),
(188, 'Mrrand Enterprises-Health Advisor', '', '732-836-9211', 'Looking for a brand new marketing program, one involving an exciting new product that can help improve your health and the health of those around you. Look no further....MaxGXL International could be for you. Residual income and health...a great combination. This young company also has plans to expand internationally so if you have friends abroad, it would put you in a good position to expand our markets. The company now also features a state of the art weight control product to help you take of', 'http://www.maxforlife.net', 'Mrrand Enterprises-Health Advisor.jpg', '', '', 'USA', '', 'Norfolk'),
(189, 'My Nutrition Store - Sean D.', '', '910-840-4923', 'My online fitness and nutrition portal has opened for business, changing forever the distribution model for dietary supplements and functional foods. I am an independent store owner which allows me to deliver great products and nutrition advice. We harness technology to offer customers the most extensive free data base of clinical test information on the internet. My "virtual reality website uses web 2.0 technology which allows me to create my own personalized storefront just like you could a My', 'http://mynutritionstore.com/seand', 'My Nutrition Store - Sean D..jpg', '', '', 'USA', '', 'North Charleston'),
(190, 'Sankofa Healing and Enrichment, Inc.', '2932 N Clough Bay Rd', '(912) 284-1172', 'Bed and Breakfast Retreat, Sanctuary and Natural Healing Spa. Perfect Getaway from the stresses of everyday life. Take an opportunity to get your life and your health back on track. We provide a variety of retreat packages and the opportunity to work with a natural wellness consultant on ways to improve your health. A variety of natural therapies are available on site, ranging from massage to colon hydrotherapy and much more.', 'http://www.sankofahealing.com', 'Sankofa Healing and Enrichment, Inc..png', '', '', 'USA', '', 'Gainesville'),
(191, 'Stylistics Full Service Salon', '1160 Kemper Meadow Drive', '(513) 858-6399', 'Preventitive Health Care Services, including:\n\nFull Body Massage & Chair/Massage\nSKIN CARE & Facials\nHair Services\nHealing Touch Sessions\nEpilation (Waxing)\nTake care of your body. It is a "Sarcred Temple.''', 'http://www.imagroupmembers.com/sandaradev', '', '', '', 'USA', '', 'Olathe'),
(192, 'Sundial Herbs', '3609 Boston Rd.', '718-798-3962', '"Natural and Traditional Remedies Coming To You From The Laboratory of The Most High For What Might Be Ailing You"\n\nSundial Herbs and Herbal Products International has been in existence since the early 1970’s. However, the recipes from our products go back at least 100-years. It has been handed down from our Great-Great-Grandfather, who was the family healer, and descent of the Koromantee Tribe (Maroons) in Jamaica, West Indies. In countries and areas outside the United States most people try to', 'http://sundialherbs.com', 'Sundial Herbs.jpg', '', '', 'USA', '', 'New York'),
(193, 'SUR-BET Health & Well Being', 'PO Box 830063', '904-638-2385', 'Certified Wholistic Health Consulting Services along with Full Life Health Recovery Assistance. Herbal, Energetic and Dietary traditional healing methods -- drug free wellness balancing. We also offer Bio-Magnetic healing techniques and products including ''Soul Stones'', diodes & a multitude of commercial bio-magnetic tools/enhancements!', 'http://www.sur-bet.org/HealthandWellBeing', 'SUR-BET Health & Well Being.jpg', '', '', 'USA', '', 'Garland'),
(194, 'The Wellness Center at Seven Oaks', '156 Pinecove Avenue', '410-305-0422', 'Whole Body Health Assessments (Eye, Face & tongue Analysis); Nutrition Consulting, Shiatsu, Ear Candling, Hair Analysis, Homeopathic Encoded Remedies... and MORE. Health and Wellness - Naturally!', '', '', '', '', 'USA', '', 'Midland'),
(195, 'Warm Spirit - Fruits of Wisdom', '2334A Apollo Ave', '808-423-8844', 'We are a health and Wellness company, teaching men and women to care for and nurture themselves, we do not just pamper you , we provide the oppurtunity of empowerment for you,your family and community.', 'http://www.warmspirit.org/fruitsofwisdom', '', '', '', 'USA', '', 'Hialeah'),
(196, 'Well Being, Center through Reiki', '10999 Reed Hartman Highway, Ste 309D', '', 'Reiki Master/Teacher and holistic life coach. Reiki is an energy-based practice involving breathing and meditational techniques and non-invasive energy balancing for well-being. Best way to learn about Reiki is to experience it. Coaching for individuals in personal development; workshops in well-being techniques and methods available. Coaching sessions by phone also.', 'http://www.centerthroughreiki.net', 'Well Being, Center through Reiki.JPG', '', '', 'USA', '', 'Omaha'),
(197, 'Whole Life Empowerment, Inc.', 'P.O. Box 561', '866-626-3996', 'We offer motivational services to help caregivers and healthcare organizations reach their highest potential and to help them realize their ultimate life''s purpose as they care for others. From health and wellness related issues to relationship enrichment, we have programs to 1)improve patient satisfaction 2)motivate caregivers 3) educate on how to maintain good physical and mental health.', 'http://www.wholelifeempowerment.com', '', '', '', 'USA', '', 'Inglewood'),
(198, 'Your Healthier You!', '518 Ryers Avenue', '215 490-2233', 'Your Healthier You! Specializing in Internal Cleansing Consultations Iridology Reflexology Diet & Weight Management Classes Seminars', 'http://www.yourhealthieryou.com', '', '', '', 'USA', '', 'Palm Bay'),
(199, 'Zija - Drink Life In!!', '', '3018501264', 'Drink Life In\nZija\n\nZija is overflowing with cell-ready nutrients, antioxidants, and vital proteins.\n\nZija is the first­–and only–company to channel Moringa''s dramatic nutritional properties into a refreshing, nourishing beverage for everyday use.\n\nZija is Convenient\n\nNo Mixing—Just Shake and Drink! \n100% Natural with only 19 Calories \nGreat In-Between Meal Supplement \nKosher and Halal Certified', 'http://www.myzija.com/lc', '', '', '', 'USA', '', 'Miramar'),
(200, 'Ameriplan - Independent Business Owner', '1821 Beaver Dam Rd.', '706-474-3620', '#1 Leading Health Care Provider in the United States is seeking Health Represenatives that want to work from home. Our company has been in business for 14 years with over 1 million satisfied customers. We provide dicount health care plans and help people save money on health care.', 'http://www.DeliveringOnThePromise.com/40575344', '', '', '', 'USA', '', 'Glendale'),
(201, 'Stat Medical Staffing LLC', 'P.O. Box 760569', '866-633-5629', 'Provide RN''s, LPN''s, amd CENA''s on a temporary basis to hospitals, doctors offices, and nursing homes in the metropolitan Detroit area.', '', '', '', '', 'USA', '', 'Miami'),
(202, 'Medical Transcription Specialists', '3032 Clarke Drive', '757-651-1227', 'We provide quality transcription services to fit your documentation needs. We offer a digital dictation system using either portable handheld recorders and/or a call-in system. All essential pieces needed for dictation are provided. All work is returned through our secure dictation software. Please contact me for more information.', '', '', '', '', 'USA', '', 'Vallejo'),
(203, 'The Troutman Group', '5109 Forrest Grove Place', '502 544 8570', 'Consulting firm in Health administration, community and pubic health program development, public speaking and coalition building', '', '', '', '', 'USA', '', 'Kent'),
(204, 'Xclusive Management & Creations', '3005 Poole Road', '919-889-8329', 'We specialize in medical billing, medical and legal transcription, and office support.', '', '', '', '', 'USA', '', 'North Charleston'),
(205, 'Anointed Hands Home Healthare', '1816 high vista court', '817-733-9737', 'Home healthcare business that provides skilled services to homebound patients.', '', '', '', '', 'USA', '', 'Thornton'),
(206, 'Covenant Group Enterprise LLC', '2873 Suwanee Rd', '817-733-9737', 'Home Health Care and Adult Day Care. A health Care Agency with a promise of quality care for the people you love.', '', '', '', '', 'USA', '', 'Columbus'),
(207, 'Diana Hayes Wheels of Caregiving', '406 SW 2nd St. Apt.B', '(863)425-0836', 'I care the elderly, new moms, post-surgical. I do light house keeping, cooking, errands, basically whatever is needed.', '', '', '', '', 'USA', '', 'Fort Lauderdale'),
(208, 'Goldenhearts Elderly Care Services, Inc.', '244 5th Avenue, Suite G256', '866-531-4620', 'We are a small, minority owned and operated custodial care agency to the elderly, handicapped and others in the NYC area. Our PCA and HHA are all backgrounded check and certified. They offer the highest caliber of care and compassion. Our rates are affordable and reasonable! Please visit our website for more information.', 'http://www.goldenelderlycare.com', 'Goldenhearts Elderly Care Services, Inc..jpg', '', '', 'USA', '', 'New York'),
(209, 'Kalimah Non Medical Home Care Services', '7912 W Lumbee St', '623-326-3127', 'We provide you or your loved one with honest, quality care. We want to make your days and nights a lot easier.', '', 'Kalimah Non Medical Home Care Services.jpg', '', '', 'USA', '', 'Arlington'),
(210, 'Sophie Loving Care, LLC', '1136 Castle Wood Ter. Suite 212', '407-485-0285', 'Sophie Loving Care can help with compassionate, home elder care services delivered right in your loved one''s home. Whether a few hours a day or long-term care 24 hours a day, a CAREgiver can assist you. All CAREgivers are thoroughly screened, extensively trained, matched to your preferences, professional and reliable.', 'http://www.sophielovingcare.com', 'Sophie Loving Care, LLC.jpg', '', '', 'USA', '', 'Fort Lauderdale'),
(211, 'Uptown Medical Supplys & Services Inc.,', 'P.O. Box 202938', '303-388-7318', 'Uptown Medical Supplys & Services is a leading provider of comprehensive, full-service Home Medical Equipment that also provides patient training, specialized clinical services, and 24 hour availability. Uptown has centralized customer service, order intake and billing with one 800 number, so you can call a centralized customer service representative for quick and efficient service.', 'http://www.uptownmedical.com', '', '', '', 'USA', '', 'Denver'),
(212, 'Community Transit LLC', 'P.o. Box 0662', '615-366-2077', 'ParaTransit. Door-to-Door Specialized transportation for the Elderly and Disabled.', 'http://www.communitytransitllc.com', '', '', '', 'USA', '', 'Antioch'),
(213, 'E-Fitness home of Exoticise', '3430 East Jefferson #316', '313.879.5446', 'We teach women exotic dance for fun and fitness. Classes include Fit-Tease, Video Vixen, Pole Position, & Lap Dance. We also have an online store for dance poles, instructional videos, personal care products, and other goodies!', 'http://www.exoticise.net', '', '', '', 'USA', '', 'Miami'),
(214, 'Fun Fitness Biz', '3430 East Jefferson #316', '410-877-6065', 'Get paid to get in shape! My business will get you in shape and help you in your body transformations goals. At the same time we show you how to help and inspire others and get paid for doing so! Interested in winning $300 or $1000 just for simply working out? check us out we give money and prizes away daily absolutely FREE!!', 'http://FunFitnessBiz.com', 'Fun Fitness Biz.png', '', '', 'USA', '', 'Arlington'),
(215, 'HomeBodiez Inc', '700 Glendon Way Apt. 712', '919-673-5054', 'HomeBodiez Inc, is the premier fitness company in its area. We offer our clients fitness solutions never seen by the fitness industry. We have options for clients at every level. Contact us for more information.', 'http://www.homebodiezinc.com', '', '', '', 'USA', '', 'North Charleston'),
(216, 'Journeys Fitness', '2723 Gregway Lane', '832-883-3470', 'Journeys Fitness is owned and operated by Raychelle Muhammad, a Certified Personal Trainer and Sports Nutritionist from Houston, Texas. She specializes in total body workouts, flexibility, and core training.\n\nThe Journeys Fitness philosophy is simple: the road to good health and fitness is a life-long process. Each client is unique and every plan is customized to accommodate health, lifestyle, and personal goals.', 'http://journeysfit.com', 'Journeys Fitness.jpg', '', '', 'USA', '', 'Tallahassee'),
(217, 'Status-Quo-Athletics', '2723 Gregway Lane', '336-765-7986', 'We offer complete fitness programs that benefit your:\n\nMind - Develop greater discipline, concentration, and self-respect\nBody - Increase your flexibility, endurance, and muscle tone\nSoul - Increase Self-Awareness\nThrough extensive training practices.', 'http://www.status-quo-athletics.org', 'Status-Quo-Athletics.jpg', '', '', 'USA', '', 'Winston–Salem');
INSERT INTO `listingDetails` (`listingID`, `listingName`, `listingAddr`, `listingNo`, `listingDesc`, `listingWebsite`, `listingImg`, `listingUrl`, `listingEmail`, `listingCountry`, `listingState`, `listingCity`) VALUES
(218, 'www.21weekchallenge.com', '', '', 'www.21weekchallenge.com is a workout website that offers free online personal training and rapid weigth loss systems from certified personal trainers.', 'http://www.21weekchallenge.com', 'www.21weekchallenge.jpg', '', '', 'USA', '', 'Arlington'),
(219, 'ConsumersDiscountRx - Ajaa', 'p.o. box 4873', '3143237307', 'SAVE UP TO 60% ON PERSCRIPTION MEDCATIONS! PRESCRIPTIONS CAN BE DELIVERED THE NEXT DAY. FOR MORE IMFORMATION CALL 1-800-771-3299. GIVE CODE AJAA', 'http://www.consumersdiscountrx.com/ajaa', '', '', '', 'USA', '', 'St. Louis'),
(220, 'NuLegacy - Sharon E. Smoot', 'P.O. Box 1125', '404-375-9370', 'NuLegacy offers a prescription discount card that is absolutely free to the consumer. The NuLegacy Rx Card can be used by consumers to save up 60 75% on prescriptions at over 56,000 pharmacies nationwide. It can also be used to get discounts on lab tests, diagnostic imaging, and diabetic testing supplies.', 'http://nulegacyrxcard.com/rx4free', '', '', '', 'USA', '', 'Garland'),
(221, 'Akiiki Spinal Care', '713 NW Evangeline Trwy Suite A', '337-205-2114', 'Chiropractic Health Care', 'http://akiikispinalcare.com', 'Akiiki Spinal Care.jpeg', '', '', 'USA', '', 'Lafayette'),
(222, 'Harris Health Center', '1221 Cleveland Street', '727 467-0775', 'Physical Medecine Center Chiropractic, Physical therapy, Stretch, Massage, Pilates', '', '', '', '', 'USA', '', 'Fort Lauderdale'),
(223, 'Center For Psychotherapy', '123 Linden Blvd. #103', '718-940-2812', 'Culturally sensitive Private Practice serving individuals, couples, groups,and adolescence.', 'http://www.Center-for-psychotherapy.com', 'Center For Psychotherapy.jpg', '', '', 'USA', '', 'New York'),
(224, 'Shawn White-Muhammed, LCSW', '2700 West Pleasant Run Road, Suite 300', '214-295-4916', 'Compassionate, Confidential Counseling Services for Adults.', 'http://www.ckubedcounseling.com', 'Shawn White-Muhammed, LCSW.JPG', '', '', 'USA', '', 'Las Cruces'),
(225, 'Sports and Spine Physical Therapy Inc.', '3355 Richmond Rd. #101A', '216-593-7070', 'At Sports and Spine Physical Therapy Inc. we are committed to assisting our patients achieve their optimal level of functioning. Our objective is to provide physical therapy programs in a professional and enjoyable setting. We assess each patient’s unique condition and design the appropriate level of orthopedic, sports or industrial therapy programs.', 'http://www.sportspine.com', '', '', '', 'USA', '', 'Oklahoma City'),
(226, 'BellMont Speech-Language Partners', '3540 Crain Highway #414', '(301) 254-9931', 'We are a private practice of speech-language pathologists, who specialize in evaluation and treatment of speech & language impairments within pediatric and adult populations. All speech therapists are board certified and licensed to practice in Virginia, Maryland and the District of Columbia. We offer an array of therapeutic and consultative services.', '', '', '', '', 'USA', '', 'Midland'),
(227, 'Portia J. Bell, DDS, INC', '2714 crossroads Plaza Drive', '614-471-1161', 'General dental practice. Family-oriented, personalized care in a caring and modern environment. Most insurances accepted.', '', '', '', '', 'USA', '', 'Columbus'),
(228, 'S. L. C. Professional Consultations and Referral Services', 'P.O. Box 870182', '614-471-1161', 'S. L. C. Professional Consultations and Referral Services provides Speech-Language Pathology Evaluations and referrals for adult and pediatric therapy services. Only the most qualified individuals will interact with your child and family. Well connected in the community and with major business organizations.', 'http://www.home.bellsouth.net/p/pwp-slcreferrals', '', '', '', 'USA', '', 'Garland'),
(229, 'ASD Concepts, LLC', '59 Mullock Rd Middletown', '845 978-3182', 'African American family run website shares large collection of credible pages on autism information, treatment options, resources and tips with parents and caregivers of individuals living with autism to help empower, support, network and inform.', 'http://www.AutismConcepts.com', '', '', '', 'USA', '', 'New York'),
(230, 'Focus On Healing, Inc.', 'Post Office Box 26132', '301-779-8005', 'Focus On Healing is a nonprofit education and resource organization on a mission to train, document and education the community in prevention and wellness approaches that lead to healthy life style changes needed for a better quality of life.', 'http://www.focusonhealing.com', 'Focus On Healing, Inc..jpg', '', '', 'USA', '', 'Washington'),
(231, 'Heavy Divas by design', '3158 College Ave., Sutie A', '301-779-8005', 'Heavy Divas by design~and Heavy G''s by design The Quarterly Online by and for Plus Size women and large men plus yahoo group where women and men of all sizes meet focusing on health/wellness/prevention, beauty/grooming, diet/exercise and moral/spiritual support. Feature articles on finance, healthy recipes and more. Please visit and sign our guestbook, email comments and suggestions or submit your book excerpt or poetry for our literary lounge. We''d be happy to meet your acquaintance.', 'http://heavydivasbydesign.com', '', '', '', 'USA', '', 'Cambridge'),
(232, 'COACH Consulting Services', '2517 5th Ave', '(206) 384-9469', 'As a Corporate Health and Fitness Consultant, I work with clients on an individual, group, and/or organizational level, to invigorate and improve overall health and productivity, which I call energy.', 'http://www.coachstacey.net', 'COACH Consulting Services.jpg', '', '', 'USA', '', 'Washington'),
(233, 'COACH K! Virtual Office', '', '', 'I am a wellness coach/consultant. I specialize in working with people who are living with a chronic condition. My goal in serving you is to support you in living happier, healthier and more productive lives.', 'http://www.liveperson.com/keesha-michelle', 'COACH K! Virtual Office.jpg', '', '', 'USA', '', 'Anchorage'),
(234, 'Hol-Life Industries, LLC', '', '877-334-9355', 'I promote holistic living and sustainable food through online and event products.\nI help artisanal organic, natural, and veg*n purveyors build brand awareness and customer relationships through targeted social media and product demonstrations.\n\nI produce/run/organize the following projects:\n\nVegetarianHealthCoach.net \nMy own website/blog promoting the Vita-Mix 5200 for healthy plant-based diets.\n\nHoneybeeHolistic.info \nMy own blog offering tips, resources, and reviews of the latest topics in hol', 'http://www.Hol-Life.com', '', '', '', 'USA', '', 'New York'),
(235, 'NaturallyMe Beautifully (NMB)', '', '', 'A SiSTAR Speaks was created by NaturallyMe Beautifully to serve as a means for families to become educated and informed on Holistic Living through affordable and custom services. We will explore spiritual, emotional, physical, social and mental wellness! Coping methods are taught in a practical, simple to apply, for every moment use way. Principles are taught from an African perspective encompassing the Principles of MAAT and the 7 Principles of the Nguzo Saba.', 'http://www.naturallymebeautifully.org', 'NaturallyMe Beautifully (NMB).jpg', '', '', 'USA', '', 'Burbank'),
(236, 'Norma Marie Life Coaching', '1017 E. 46th Street, Suite 1S', '773-624-4151', 'Spiritual LIfe Coaching Services - specializing in supporting person on the path to discovering their life purpose and their individual path in life.', '', '', '', '', 'USA', '', 'Chicago'),
(237, 'Pauline Haynes, Certified Life Coach', 'PO Box 163779', '(916) 452-5278', 'As a Life Coach, I work with people who are overwhelmed, stuck, unfulfilled in life, work or relationship. When you work with me, you set deliberate intentions, take necessary actions to improve and/or regain your motivation to be self-realized and unleash your magnificence!', 'http://www.paulinehaynes.com', 'Pauline Haynes, Certified Life Coach.jpg', '', '', 'USA', '', 'Cambridge'),
(238, 'RG Personal Development - Certified Life Coach & Speaker', '', '', 'RG Personal Development offers life coaching, workshops, and motivational speaking. We have the skills and passion to work in various areas and approaches to assure individuals become aware of what can be accomplished and find alternative ways of dealing with situations that will lead to their success. For more information, visit www.rgpersonaldevelopment.com.', 'http://www.rgpersonaldevelopment.com', 'RG Personal Development - Certified Life Coach & Speaker.jpg', '', '', 'USA', '', 'Boulder'),
(239, 'Gaya Art Cafe', '', '', '', 'http://guaranteedgambian.com/', '', '', '', 'Gambia', '', 'Banjul'),
(240, 'Guaranteed Gambian', '', '', '', 'http://guaranteedgambian.com/', '', '', '', 'Gambia', '', 'Farafenni'),
(241, 'HG Creation', '', '', '', '', '', '', '', 'Gambia', '', 'Banjul'),
(242, 'Caribbean Dreams Ltd', 'Upminster,', '', 'Caribbean Property Sales', 'http://old.caribbeandreamsproperty.com', '', '', '', 'United kingdom', '', 'Exeter');

-- --------------------------------------------------------

--
-- Table structure for table `listingUrls`
--

CREATE TABLE IF NOT EXISTS `listingUrls` (
  `lisUrlID` int(11) NOT NULL AUTO_INCREMENT,
  `lisMemID` int(11) NOT NULL,
  `lisUrl` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`lisUrlID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=245 ;

--
-- Dumping data for table `listingUrls`
--

INSERT INTO `listingUrls` (`lisUrlID`, `lisMemID`, `lisUrl`, `status`) VALUES
(1, 11, 'http://www.afrowebb.com/welcome/viewDetail/CreativeDetail/7', '1'),
(2, 11, 'http://www.afrowebb.com/welcome/viewDetail/CreativeDetail/5', '1'),
(3, 1, 'http://www.afrowebb.com/welcome/viewSubDetail/House/5', '1'),
(4, 1, 'http://www.afrowebb.com/welcome/viewSubDetail/Hiphop/5', '1'),
(5, 1, 'http://www.afrowebb.com/welcome/viewSubDetail/AfroPunk/5', '1'),
(6, 1, 'http://www.afrowebb.com/welcome/viewSubDetail/DeepHouse/5', ''),
(7, 1, 'http://www.afrowebb.com/welcome/viewSubDetail/Afrobeat/5', '1'),
(8, 1, 'http://www.afrowebb.com/welcome/viewSubDetail/Techno/5', ''),
(9, 1, 'http://www.afrowebb.com/welcome/viewSubDetail/RnBSoulFunk/5', '1'),
(10, 12, 'http://www.afrowebb.com/welcome/viewSubDetail/Reggae/5', '1'),
(11, 13, 'http://www.afrowebb.com/welcome/viewDetail/CreativeDetail/5', '1'),
(12, 14, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(13, 14, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/7', '1'),
(14, 15, 'http://www.afrowebb.com/welcome/viewDetail/CreativeDetail/5', '1'),
(15, 16, 'http://www.afrowebb.com/welcome/viewSubDetail/Reggae/5', '1'),
(16, 17, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(17, 18, 'http://www.afrowebb.com/welcome/viewSubDetail/Hiphop/5', '1'),
(18, 18, 'http://www.afrowebb.com/welcome/viewSubDetail/AfroPunk/5', '1'),
(21, 20, 'http://www.afrowebb.com/welcome/viewSubDetail/Hiphop/5', '1'),
(22, 20, 'http://www.afrowebb.com/welcome/viewSubDetail/AfroPunk/5', '1'),
(23, 21, '', '1'),
(24, 22, 'http://www.afrowebb.com/welcome/viewDetail/CreativeDetail/6', '1'),
(25, 23, 'http://www.afrowebb.com/welcome/viewDetail/Residential/5', '1'),
(26, 24, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(27, 25, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(28, 26, 'http://www.afrowebb.com/welcome/viewDetail/CreativeDetail/7', '1'),
(29, 27, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/14', '1'),
(30, 28, 'http://www.afrowebb.com/welcome/viewDetail/Residential/5', '1'),
(31, 29, '', '1'),
(32, 30, ' http://www.afrowebb.com/welcome/viewDetail/Residential/5', '1'),
(33, 31, 'http://www.afrowebb.com/welcome/viewDetail/Residential/5', '1'),
(34, 32, 'http://www.afrowebb.com/welcome/viewDetail/Residential/5', '1'),
(35, 33, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(36, 34, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(37, 35, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(38, 36, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(39, 37, '', '1'),
(40, 38, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(41, 39, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(42, 40, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(43, 41, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(44, 42, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(45, 43, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(46, 44, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(47, 45, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(48, 46, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(49, 47, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(50, 48, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(51, 49, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(52, 50, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(53, 51, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(54, 52, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(55, 53, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(56, 54, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(57, 55, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(58, 56, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(59, 57, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(60, 58, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(61, 59, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(62, 60, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(63, 61, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(64, 62, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(65, 63, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(66, 64, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(67, 65, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(68, 66, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(69, 67, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(70, 68, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(71, 69, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(72, 70, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(73, 71, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(74, 72, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(75, 73, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(76, 74, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(77, 75, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(78, 76, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(79, 77, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(80, 78, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(81, 79, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(82, 80, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(83, 81, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(84, 82, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(85, 83, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(86, 84, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(87, 85, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(88, 86, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(89, 87, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(90, 88, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(91, 89, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(92, 90, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(93, 91, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(94, 92, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(95, 93, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(96, 94, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(97, 95, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(98, 96, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(99, 97, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(100, 98, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(101, 99, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(102, 100, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(103, 101, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(104, 102, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(105, 103, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(106, 104, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(107, 105, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(108, 106, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(109, 107, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(110, 108, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(111, 109, 'http://www.afrowebb.com/welcome/viewDetail/Fashion/27', '1'),
(112, 110, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(113, 111, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(114, 112, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(115, 113, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(116, 114, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(117, 115, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(118, 116, 'http://www.afrowebb.com/welcome/viewDetail/Residential/8', '1'),
(119, 117, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(120, 118, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(121, 119, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(122, 120, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(123, 121, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(124, 122, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(125, 123, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(126, 124, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(127, 125, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(128, 126, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(129, 127, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(130, 128, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(131, 129, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(132, 130, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(133, 131, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(134, 132, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(135, 133, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(136, 134, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(137, 135, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(138, 136, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(139, 137, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(140, 138, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(141, 139, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(142, 140, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(143, 141, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(144, 142, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(145, 143, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(146, 144, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(147, 145, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(148, 146, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(149, 147, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(150, 148, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(151, 149, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(152, 150, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(153, 151, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(154, 152, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(155, 153, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(156, 154, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(157, 155, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(158, 156, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(159, 157, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(160, 158, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(161, 159, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(162, 160, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(163, 161, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(164, 162, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(165, 163, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(166, 164, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(167, 165, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(168, 166, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(169, 167, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(170, 168, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(171, 169, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(172, 170, 'http://www.afrowebb.com/welcome/viewDetail/HairBeauty/1', '1'),
(173, 171, 'http://www.afrowebb.com/welcome/viewDetail/Residential/4', '1'),
(174, 172, 'http://www.afrowebb.com/welcome/viewDetail/Residential/4', '1'),
(175, 173, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(176, 174, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(177, 175, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(178, 176, 'http://www.afrowebb.com/welcome/viewDetail/Residential/4', '1'),
(179, 177, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(180, 178, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(181, 179, 'http://www.afrowebb.com/welcome/viewDetail/Residential/4', '1'),
(182, 180, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(183, 181, 'http://www.afrowebb.com/welcome/viewDetail/Residential/4', '1'),
(184, 182, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(185, 183, 'http://www.afrowebb.com/welcome/viewDetail/Residential/4', '1'),
(186, 184, 'http://www.afrowebb.com/welcome/viewDetail/Residential/4', '1'),
(187, 185, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(188, 186, '', '1'),
(189, 187, 'http://www.afrowebb.com/welcome/viewDetail/Residential/4', '1'),
(190, 188, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(191, 189, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(192, 190, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(193, 191, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(194, 192, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(195, 193, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(196, 194, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(197, 195, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(198, 196, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(199, 197, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(200, 198, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(201, 199, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(202, 200, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(203, 201, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(204, 202, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(205, 203, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(206, 204, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(207, 205, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(208, 206, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(209, 207, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(210, 208, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(211, 209, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(212, 210, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(213, 211, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(214, 212, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(215, 213, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(216, 214, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(217, 215, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(218, 216, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(219, 217, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(220, 218, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(221, 219, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(222, 220, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(223, 221, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(224, 222, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(225, 223, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(226, 224, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(227, 225, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(228, 226, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(229, 227, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(230, 228, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(231, 229, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(232, 230, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(233, 231, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(234, 232, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(235, 233, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(236, 234, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(237, 235, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(238, 236, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(239, 237, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(240, 238, 'http://www.afrowebb.com/welcome/viewDetail/Wellness/4', '1'),
(241, 239, 'http://www.afrowebb.com/welcome/viewDetail/CreativeDetail/3', '1'),
(242, 240, 'http://www.afrowebb.com/welcome/viewDetail/CreativeDetail/3', '1'),
(243, 241, 'http://www.afrowebb.com/welcome/viewDetail/CreativeDetail/3', '1'),
(244, 242, 'http://www.afrowebb.com/welcome/viewDetail/Residential/4', '1');

-- --------------------------------------------------------

--
-- Table structure for table `menuManagement`
--

CREATE TABLE IF NOT EXISTS `menuManagement` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `parentMenuID` int(11) NOT NULL,
  `menuName` varchar(100) NOT NULL,
  `menuStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `menuManagement`
--

INSERT INTO `menuManagement` (`menuID`, `parentMenuID`, `menuName`, `menuStatus`) VALUES
(1, 0, 'Creatives', '1'),
(2, 0, 'Events', '1'),
(3, 0, 'Wellness', '1'),
(4, 0, 'Fashion', '1'),
(5, 0, 'Holidays', '1'),
(6, 0, 'Book', '1'),
(7, 0, 'Mentorship', '1'),
(8, 0, 'Carnivals', '1'),
(9, 0, 'Residential', '1'),
(10, 0, 'Hair & Beauty', '1'),
(11, 0, 'Business Consultant', '1'),
(12, 0, 'Website Builders', '1'),
(13, 0, 'Annual Celebrations', '1'),
(14, 0, 'Food', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orderDetails`
--

CREATE TABLE IF NOT EXISTS `orderDetails` (
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `addr1` varchar(255) NOT NULL,
  `addr2` varchar(255) NOT NULL,
  `country` varchar(150) NOT NULL,
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` varchar(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `orderDetails`
--

INSERT INTO `orderDetails` (`fname`, `lname`, `email`, `addr1`, `addr2`, `country`, `orderID`, `productID`, `status`) VALUES
('shatanik', 'ghosh', 'swgghosh@gmail.com', 'ad', 'ad', 'United Kingdom', 1, '11', '0'),
('shatanik', 'ghosh', 'emailswapan01@gmail.com', 'ad', 'ad', 'India', 2, '11', '0'),
('sad', 'sds', 'sdas', 'sdsd', 'sdas', 'United Kingdom', 3, '13', '0'),
('shatanik', 'ghosh', 'emailswapan01@gmail.com', 'ad', 'ad', 'United Kingdom', 4, '', '0'),
('shatanik', 'ghosh', 'emailswapan01@gmail.com', 'ad', 'ad', 'United Kingdom', 5, '5', '0'),
('shatanik', 'ghosh', 'emailswapan01@gmail.com', 'ad', 'ad', 'United Kingdom', 6, '5,6', '0'),
('JOB 1', 'sdfsdf', 'infoshatanik@gmail.com', 'dsfsdf', 'asdasd', 'United Kingdom', 7, '8', '0'),
('jgf.kg.lbjkkj', ',jgc.,hjkv.vb.', 'dfjdfjf@gmail.com', 'hktf.jkhv', 'kufj.hv.', 'United Kingdom', 8, '7', '0'),
('aaa', 'asdas', 'infoshatanik@gmail.com', 'dsasd', 'sdfsdf', 'United Kingdom', 9, '8,9', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 10, '9', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 11, '9', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 12, '9', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 13, '', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 14, '', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 15, '', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 16, '9', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 17, '9', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 18, '', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 19, '8', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 20, '', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 21, '', '0'),
('shatanik', 'ghosh', 'infoshatanik@gmail.com', 'ad', 'ad', 'United Kingdom', 22, '9', '0'),
('asd', 'asdas', 'infoshatanik@gmail.com', 'dsasd', 'asdasd', 'United Kingdom', 23, '8', '0');

-- --------------------------------------------------------

--
-- Table structure for table `otherArticles`
--

CREATE TABLE IF NOT EXISTS `otherArticles` (
  `otherArticleID` int(11) NOT NULL AUTO_INCREMENT,
  `otherArticleTitle` varchar(100) NOT NULL,
  `otherArticleDesc` longtext NOT NULL,
  `otherArticleImg` varchar(100) NOT NULL,
  `otherArticleStatus` enum('0','1') NOT NULL,
  PRIMARY KEY (`otherArticleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `otherArticles`
--

INSERT INTO `otherArticles` (`otherArticleID`, `otherArticleTitle`, `otherArticleDesc`, `otherArticleImg`, `otherArticleStatus`) VALUES
(1, 'Business Consultant', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'consulting.jpg', '1'),
(2, 'GBE Virtual Assistance', '<p>            <strong>Designers</strong>\r\nLorem ipsum nunc\r\nDonec mollis aliquet\r\nMaecenas adipiscing\r\nNunc quis sem nec\r\nDuis mollis aliquet</p>\r\n<p><strong>Models</strong>\r\nCras nisl eros\r\nSed pellentesque\r\nDonec a purus vel\r\nSed pretium\r\nNulla sed leo sed</p>', '', '1'),
(3, 'Black Inventors', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'blackinventors.jpg', '1'),
(4, 'Special Dates', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'SpecialDates.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `prePhase`
--

CREATE TABLE IF NOT EXISTS `prePhase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `whoInvieYou` varchar(100) NOT NULL,
  `contactNo` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `prePhase`
--

INSERT INTO `prePhase` (`id`, `name`, `surname`, `whoInvieYou`, `contactNo`, `email`, `city`) VALUES
(1, 'Shatanik', 'Ghosh', 'Otiz FAngel', '+919830028525', 'infoshatanik@gmail.com', 'Kolkata'),
(2, 'Narendra Nath', 'Das', 'Shatanik Ghosh', '9830028526', 'wbnaren@gmail.com', 'Kolkata'),
(3, '', '', '', '', '', ''),
(4, 'Ken', 'Hinds', 'Jonathan Hinds', '07977494814', 'kenhinds5@gmail.com', 'London'),
(5, 'Carole', 'McGowan', 'Jonathan Hinds', '07951906076', 'joyfulmackie@gmail.com', 'London'),
(6, 'Jazine', 'Lowe', 'Jonathan Hinds', '07583209778', 'jazine15@gmail.com', 'London'),
(7, 'Soloman', 'Gamra', 'Jazine Lowe', '07462536739', 'solomon_gamra@hotmail.com', 'London'),
(8, 'Lorna', 'Walker', 'Jonathan Hinds', '07932053929', 'lorna-walker@virginmedia.com', 'London'),
(9, 'Candice', 'Stewart', 'Jonathan Hinds', '07534356640', 'candy@hotmail.co.uk', 'London'),
(10, 'Kever', 'Peters', 'Candice Stewart', '07940774917', 'radypeters@hotmail.com', 'London'),
(11, 'Jonathan', 'Hinds', 'Ortiz F Angel', '07466032702', 'jonostar1@gmail.com', 'London'),
(12, 'Jonathan', 'Hinds', 'Ortiz F Angel', '07466032702', 'jonostar1@gmail.com', 'London'),
(13, 'RAFAT', 'SAI', 'DANIEL PALMER', '07506631453', 'rafat.sai@gmail.com', 'LONDON'),
(14, '', '', '', '', '', ''),
(15, 'Alvin', 'Elcock', 'Ken Hinds', '07904733997', 'alvinbantu@btinternet.com', 'London'),
(16, 'Ian', 'Charles', 'Dean Williams', '07939862939', 'iancharles@hotmail.com', 'London'),
(17, 'Matthew', 'Hypolite', 'Ken Hinds', '', '', ''),
(18, 'Matthew', 'Hypolite', 'Ken Hinds', '07752151551', 'hypolink@hotmail.com', 'London'),
(19, 'Des', 'Pemberton', 'Dean Williams', '07984470288', 'dezpemberton@aol.com', 'London'),
(20, 'Hesketh', 'Benoit', 'Ken Hinds', '07905250042', 'hj.benoit1@yahoo.co.uk', 'London'),
(21, 'Sylvia', 'Williams', 'Carole McGowan', '07762563780', 'sylviawill@btinternet.com', 'London'),
(22, 'McKala', 'McLeod', 'Dean Williams', '07950792951', 'mack_kala@hotmail.co.uk', 'London'),
(23, 'Paul', 'Mison', 'DANIEL PALMER', '07961791124', 'mison38@hotmail.com', 'London'),
(24, 'Kenn', 'Obi', 'Isaac Botchey', '07727629212', 'kenn_obi@hotmail.co.uk', 'London'),
(25, 'Isaac', 'Botchey', 'Dean Williams', '07958505332', 'isaac_botchey@hotmail.co.uk', 'London'),
(26, 'Dominic', 'Hinds', 'Jonathan Hinds', '07963935150', 'dominichinds@hotmail.co.uk', 'London'),
(27, 'Courtney', 'Hinds', 'Jonathan Hinds', '07772385604', 'courtneynh@live.co.uk', 'London'),
(28, 'Gary', 'Boothe', 'Jonathan Hinds', '07775368784', 'gboothe35@hotmail.co.uk', 'London'),
(29, 'CHRISTOPHER', 'HINDS', 'DOMINIC', '07538433781', 'chris@live.co.uk', 'LONDON'),
(30, 'JONATHAN', 'GYIMAH', 'HESKETH BENOIT', '07791138929', 'jonathangyimah@gmail.com', 'LONDON'),
(31, 'ALVIN', 'JOSEPH', 'DOMINIC HINDS', '07513289369', 'PAULPIERCE19@HOTMAIL.COM', 'LONDON/ WORMLEY'),
(32, 'KENNETH', 'SIMON', 'ALVIN JOSEPH', '07534522463', 'SKIP602@YAHOO.COM', 'LONDON'),
(33, 'Tony', 'Josephs', 'Bevis', '', 'normajoe1@hotmail.com', 'Luton'),
(34, 'Norma', 'Josephs', 'Bevis', '', 'normajoe1@hotmail.com', 'Luton'),
(35, 'Makonnen', 'Sankofa', 'Bevis', '', 'makonnen@lutonblackmen.org', 'Luton'),
(36, 'Kim', 'Watson', 'Bevis', '', 'pimpmygems@gmail.com', 'Luton'),
(37, 'Clive', 'Vassell', 'Bevis', '', 'vasselc@gmail.com', 'Luton'),
(38, 'Marshalee', 'Reid', 'Bevis', '', 'marshaleereid@hotmail.co.uk', 'Luton'),
(39, 'Nakiliah', 'Reid', 'Bevis', '', 'nakiliah@googlemail.com', 'Luton'),
(40, 'MP', '', 'Bevis', '', 'mp@lutonblackmen.org', 'Luton'),
(41, 'Daley', 'Carnigie', 'Bevis', '', 'daley@lutonblackmen.org', 'Luton'),
(42, 'Ryan', 'Mosely', 'Bevis', '', 'mosley.ryan@gmail.com', 'Luton');

-- --------------------------------------------------------

--
-- Table structure for table `productAdvertisement`
--

CREATE TABLE IF NOT EXISTS `productAdvertisement` (
  `advertisementId` int(11) NOT NULL AUTO_INCREMENT,
  `advertisementTitle` varchar(150) NOT NULL,
  `advertisementImg` varchar(255) NOT NULL,
  `advertisementDesc` longtext NOT NULL,
  `advertisementStatus` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`advertisementId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `productAdvertisement`
--

INSERT INTO `productAdvertisement` (`advertisementId`, `advertisementTitle`, `advertisementImg`, `advertisementDesc`, `advertisementStatus`) VALUES
(20, 'Rave Story Novel', 'bookfrontss.jpg', 'The Ascent of Humanity is about Separation: its origins, its evolution, its ideology, its effects, its consummation and resolution, and its cosmic purpose. What is the purpose of the grandeur and the ruin we have wrought? If civilization is to collapse, Why? and What for? Will we then go back to the Stone Age, or will we be born into something entirely new? This book draws from mythological sources, as well as natural processes of birth and transformation, to offer a narrative framework for the majesty and madness of human civilization.', '1'),
(21, 'Motivation', 'think.jpg', 'Discover the best Motivational Self-Help in Best Sellers.', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productArticle`
--

CREATE TABLE IF NOT EXISTS `productArticle` (
  `articleID` int(11) NOT NULL AUTO_INCREMENT,
  `articleTitle` varchar(150) NOT NULL,
  `articleDesc` longtext NOT NULL,
  `articleAuthor` varchar(150) NOT NULL,
  `articleImg` varchar(100) NOT NULL,
  `articleDate` varchar(100) NOT NULL,
  `articleStatus` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`articleID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `productArticle`
--

INSERT INTO `productArticle` (`articleID`, `articleTitle`, `articleDesc`, `articleAuthor`, `articleImg`, `articleDate`, `articleStatus`) VALUES
(1, 'Man Who hated Britain', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H.', 'Angel', '210759.jpg', '11, June 2014 , 3:22 PM', '1'),
(3, '12 years of Slaves', 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Jason', 'DJ_Lord_Fotor.jpg', '11, June 2014 , 3:23 PM', '1'),
(5, '5 Reasons Summer Is Overrated for Teachers', 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Sata', 'dj-drops.jpg', '11, June 2014 , 5:45 PM', '1'),
(4, 'Brave Heart', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'Sandy', 'Disc-Jockey-4356.jpg', '11, June 2014 , 3:23 PM', '1'),
(6, 'LA COUR DES MIRACLES 58', 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Andrew', 'dj-2512.jpg', '11, June 2014 , 5:48 PM', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productArticleMap`
--

CREATE TABLE IF NOT EXISTS `productArticleMap` (
  `mapID` int(11) NOT NULL AUTO_INCREMENT,
  `productTypeID` varchar(100) NOT NULL,
  `tableID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`mapID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `productArticleMap`
--

INSERT INTO `productArticleMap` (`mapID`, `productTypeID`, `tableID`, `articleID`, `status`) VALUES
(1, '1', 1, 5, '1'),
(2, '2', 1, 7, '1'),
(3, '2', 1, 11, '1'),
(4, '2', 1, 3, '1'),
(5, '2', 1, 24, '1'),
(6, '2', 2, 4, '1'),
(7, '2', 2, 5, '1'),
(8, '2', 2, 6, '1'),
(9, '2', 2, 7, '1'),
(10, '2', 2, 8, '1'),
(11, '2', 2, 9, '1'),
(12, '2', 2, 10, '1'),
(13, '2', 2, 11, '1'),
(14, '2', 2, 12, '1'),
(15, '2', 2, 13, '1'),
(16, '2', 3, 1, '1'),
(17, '2', 3, 2, '1'),
(18, '2', 3, 4, '1'),
(19, '2', 4, 16, '1'),
(20, '9', 4, 1, '1'),
(21, '9', 7, 1, '1'),
(22, '9', 11, 3, '1'),
(23, '9', 11, 4, '1'),
(24, '9', 11, 9, '1'),
(25, '9', 11, 11, '1'),
(26, '9', 11, 12, '1'),
(27, '9', 14, 2, '1'),
(28, '6', 4, 14, '1'),
(29, '6', 4, 17, '1'),
(30, '6', 4, 18, '1');

-- --------------------------------------------------------

--
-- Table structure for table `productBusiness`
--

CREATE TABLE IF NOT EXISTS `productBusiness` (
  `businessID` int(11) NOT NULL AUTO_INCREMENT,
  `businessTitle` varchar(150) NOT NULL,
  `businessDesc` longtext NOT NULL,
  `businessImg` varchar(100) NOT NULL,
  `businessStatus` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`businessID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `productBusiness`
--

INSERT INTO `productBusiness` (`businessID`, `businessTitle`, `businessDesc`, `businessImg`, `businessStatus`) VALUES
(1, 'Business Consultants', 'Many start up businesses find things difficult at first, Angel Business Consultancy ''ABC'' can help. \nOur team of professionally trained consultants have extensive knowledge, giving you the right steps to take to establish a company. We provide support and information to assist in the birth or smooth running of any sized business. From business plans to HR, event management to project management, individual entrepreneurs to organizations, no job is to large or too small.\n<p>From analysis, strategies through to implementation, let ABC improve the performance of your business.</p>', 'consulting.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productCreative`
--

CREATE TABLE IF NOT EXISTS `productCreative` (
  `creativeID` int(11) NOT NULL AUTO_INCREMENT,
  `creativeTitle` varchar(150) NOT NULL,
  `creativeDesc` longtext NOT NULL,
  `creativeImg` varchar(100) NOT NULL,
  `creativeStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`creativeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `productCreative`
--

INSERT INTO `productCreative` (`creativeID`, `creativeTitle`, `creativeDesc`, `creativeImg`, `creativeStatus`) VALUES
(5, 'Music  <br/>& Labels', 'Music & Labels\nFor over 80 years, ''Black music'' has been increasingly pigeon holed, first by White people then by Black people themselves.  It''s always the same - Soul, Gospel, Reggae, Jazz, Hip-Hop & RnB - is that it?   Many people don''t know that Rock n Roll - which later became Rock music, was defined by Black men like Lil Richard, Fats Domino and Chuck Berry. Jimi Hendrix, the greatest guitarist the world has ever seen was a Black man. House music, Techno, Rave, Jungle Drum n Bass, Dubstep, Trap and Afro punk are all genres that stem from Black origins.  It''s even come to light that Punk Rock was originally inspired by a band called Death, a Black punk band.  With our musical diversity finally surfacing GBE & Afrowebb proudly promote our musical creativity in all genres. \n\nTo have your music listed and sold you must be a GBE member. \nWe do NOT TOUCH music that refers to people as the N-Word. \nSo please, Be Intelligent! Browse through and buy Music, in the section below.', 'Music.jpeg', '1'),
(6, 'Films <br/>& Videos', 'GBE and Afrowebb feature producers, studios, music video makers and production companies.\nWe support diversity in filmmaking and use this online resource to market talent from the black, film community.\nTo feature or sell your films here you must be a GBE member.', 'Film.jpg', '1'),
(7, 'Dance <br/>& Motion', 'GBE''s Dance Directory is where you''ll discover all things "Dance" - From Schools to dance companies, dancers, troops, crews and choreographers, \nWe focus various styles including Street & Club dance, Traditional, Ballet & Contemporary and Latin styles. \nIf you''re a dancer,choreographer, dance class or simply just love dance, this is where you will be kept in the loop.\nBrowse our listings below. ', 'Dance.jpg', '1'),
(2, 'Progressive <br/>Word', '''Progressive word'' is motivational poetry. This new fusion of artistic poetry and motivational speaking  aims to create 100% positive energy for it''s listener. \nUnlike many ''Spoken word poems'', Progressive is constantly upbeat, focuses solely on positive messages, staying clear of the subjects of deities, negative life experiences, hang-ups or bad relationships.\n''Progressive Word'' aims to express that all life is sacred and one with the universe.\n\nFirst conceived in London UK by poets in the Morpheus Society, progressive word has grown in popularity and spread internationally. \n\nCommon topics include:\n\nDetermination to succeed, \nTriumph over adversity\nUnity\nScience\nUniverse \\ Cosmo \nJustice & Respect for all.\nFreedom\nLove\nLaw of Attraction\n\nProgressive word often includes collaboration and experimentation with other art forms such as?music, theatre, even dance. \nRemember, Words are very powerful. When spoken to the masses, words can heal, create and motivate.', 'progressiveword.jpg', '1'),
(9, 'Theatre <br/>& Drama', 'yftluf.', 'Theatre.jpg', '1'),
(10, 'DJ <br/>List', 'This list consists of DJs & music professionals in the GBE. Many of these artists perform or are known to perform at nightclub venues.', 'DJ-List.jpg', '1'),
(11, 'Performers <br/>& Entertainers', 'We list entertainers, Fire performers, Acrobats, Magicians and jugglers who are members of GBE. \n\nThese performers are great for weddings, parties, corporate events, music festivals, street festivals and any other event that you are planning.\nIf you want to be listed in this section join GBE', 'performers.jpg', '1'),
(12, 'Club <br/>Snappers', 'liyflff', 'clubsnappers.jpg', '1'),
(3, 'Arts <br />& Crafts', 'GBE focuses on showcasing visual arts, which includes the creation of images or objects.\nWe features artist form all categories\nincluding painting, sculpture, printmaking, photography, and other forms of visual media.\nTo be listed you must be a GME member.\n\nBrowse below to find artists and info', 'art.jpg', '1'),
(24, 'Comedy<br />Stand Up', 'This section focuses on Black Comedians and Comedic Actors both new and famous, past and present. You can also find local shows to enjoy.', 'comedy.jpeg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productDetails`
--

CREATE TABLE IF NOT EXISTS `productDetails` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `productTypeID` int(11) NOT NULL,
  `vendorID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productDesc` varchar(255) NOT NULL,
  `productImg` varchar(100) NOT NULL,
  `productMusic` varchar(100) NOT NULL,
  `productCurrencyType` varchar(50) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productColour` varchar(100) NOT NULL,
  `productSize` varchar(100) NOT NULL,
  `productCommission` varchar(10) NOT NULL,
  `productOffer` varchar(10) NOT NULL,
  `productYoutubeUrl` varchar(100) NOT NULL,
  `productStatus` enum('0','1') NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `productDetails`
--

INSERT INTO `productDetails` (`productID`, `productTypeID`, `vendorID`, `productName`, `productDesc`, `productImg`, `productMusic`, `productCurrencyType`, `productPrice`, `productColour`, `productSize`, `productCommission`, `productOffer`, `productYoutubeUrl`, `productStatus`) VALUES
(1, 1, 0, 'Bob Dylon Collection', 'Bob Dylon demo description', 'bobdylan1.jpg', '16Hz-20kHz-Exp-CA-10sec.mp3', 'Dollars', 20, '', '', '2', '', '', '1'),
(2, 1, 0, 'Bryan Adams Collection', 'Bryan Adams demo desc', 'briyanadams.jpeg', '16Hz-20kHz-Lin-CA-10sec.mp3', 'Dollars', 50, '', '', '10', '', '', '1'),
(5, 6, 0, 'Jeans', 'Jeans Description', 'index.jpg', '', 'Dollars', 100, 'Red,Black,Green,Yellow', '36,38,40,42', '15', '', '', '1'),
(6, 6, 0, 'T-Shirt', 'T-Shirt Description', 'mainImage_francis_bacon_t_shirt__1348658252.jpg', '', 'Dollars', 80, 'Red,Black', '36,38,40,42', '8', '', '', '1'),
(7, 2, 0, 'Ticket One', 'Demo ticket One', 'ticket_one.jpg', '', 'Dollars', 0, '', '', '3', '', '', '1'),
(8, 2, 0, 'Ticket Two', 'Demo Ticket Two', 'ticket_two.jpg', '', 'Dollars', 20, '', '', '4', '', '', '1'),
(9, 2, 0, 'Ticket Three', 'Demo Ticket Three', 'ticket_three.jpg', '', 'Dollars', 25, '', '', '9', '', '', '1'),
(10, 9, 0, 'Wings of fire', 'Demo Wings of fire', 'wofcover.jpg', '', 'Dollars', 15, '', '', '5', '', '', '1'),
(11, 9, 0, 'Interpreter of Maladies', 'Demo Interpreter of Maladies', 'coverMaladies.jpg', '', 'Dollars', 20, '', '', '5', '', '', '1'),
(12, 9, 0, 'Alchemist by paulo Coelho', 'Demo Alchemist by paulo Coelho', 'alchemistCover.jpg', '', 'Dollars', 32, '', '', '12', '', '', '1'),
(13, 6, 0, 'Short Shirt', 'Demo Short Shirt', 'ShortShirtCover.jpg', '', 'Dollars', 30, '', '', '15', '', '', '1'),
(14, 4, 0, 'Flicker Web', 'Demo Flicker Web', 'flicker.jpg', 'flicker_web.wmv', 'Dollars', 15, '', '', '2', '', '', '1'),
(15, 4, 0, 'Roving', 'Demo Roving', 'roving.jpg', 'roving_web.wmv', 'Dollars', 45, '', '', '20', '', '', '1'),
(16, 4, 0, 'Wonderland', 'Demo Wonderland', 'wonderlan.jpg', 'wonderland_web.wmv', 'Dollars', 45, '', '', '20', '', '', '1'),
(18, 6, 0, 'Formal Shirt 1', 'Demo Formal Shirt 1', 'FSCover.jpg', '', 'Dollars', 15, '', '', '5', '', '', '1'),
(19, 6, 0, 'Formal Shirt 2', 'Demo Formal Shirt 2', 'FS2.jpg', '', 'Dollars', 12, 'Red,Black,Green,Yellow', '36,38,40,42', '4', '', '', '1'),
(22, 6, 0, 'White Sweater', 'demo White Sweater', 'sweaterCover.jpg', '', 'Dollars', 1212, 'Red,Black,Green,Yellow', '36,38,40,42', '12', '', '', '1'),
(23, 6, 0, 'White Sweater 2', 'Demo White Sweater 2', 'sweaterCover.jpg', '', 'Dollars', 12, 'Red,Black,Green,Yellow', '36,38,40,42', '6', '', '', '1'),
(25, 6, 1, 'Trouser1', 'demo description for Trouser1', 'trouserMain.jpg', '', 'Dollars', 150, 'Red,Black,Green,Yellow', '36,38,40,42', '50', 'Yes', '', '1'),
(26, 1, 0, 'Test', 'Test1', 'Splinter photo.jpg', '', 'Dollars', 10, '', '', '5', '0', '', '1'),
(31, 5, 8, 'Marcus Garvey', 'Black people unite', '', '', 'Dollars', 0, '', '', '10', 'Yes', '', '1'),
(33, 1, 8, 'Marcus Garvey', 'Black people unite', 'Marcus_lowres.jpg', '', 'Dollars', 20, '', '', '10', '0', '', '1'),
(34, 6, 1, 'Test Clothes', 'demo test clothes', 'shutterstock_125083457-e1412070851374.jpg', '', 'Euro', 27, '', '', '23', 'Yes', '', '1'),
(35, 6, 1, 'fyf.kgk', 'jflyf/.kgb/.lb', 'afro wall paper.jpg', '', 'Make a Donation', 10, 'Red', '36', '3', '0', '', '1'),
(36, 6, 1, 'fyf.kgk', 'jflyf/.kgb/.lb', 'afro wall paper.jpg', '', 'Make a Donation', 10, 'Red', '36', '3', '0', '', '1'),
(37, 6, 1, 'New Port', 'Demo New Port New Port New Port', 'jeans111.jpg', '', 'Dollars', 100, 'Red,Black,Green,Yellow', '36,38,40,42', '10', 'No', 'https://www.youtube.com/watch?v=A4LgvX3Xt_o', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productEvent`
--

CREATE TABLE IF NOT EXISTS `productEvent` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `eventTitle` varchar(150) NOT NULL,
  `eventDesc` longtext NOT NULL,
  `eventImg` varchar(100) NOT NULL,
  `eventStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`eventID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `productEvent`
--

INSERT INTO `productEvent` (`eventID`, `eventTitle`, `eventDesc`, `eventImg`, `eventStatus`) VALUES
(4, 'Black Business Week', 'Black Business Week is an annual event that celebrates the growth of our business community. the  This 7 day summit provides an unparalleled opportunity to network with professionals, entrepreneurs and business owners. It also gives our GBE members time to consolidate and nurture their online business by training with our team of online marketers. With high profile events hosted everyday, participants can benefit from unlimited deals and opportunities. \nDuring the week, companies from all cultures are invited to cement new bonds and network with professionals from the GBE community. \n\nDuring the week, ticket holders can gain valuable knowledge while enjoying events such as \nthe Black Velvet Ball, Fashion Shows, Black Business Conference,  Afro Yoga Rave, Intelligent Black Music Awards, Afro Film Festival, Black Business Banquet & the Neo-Nubian Food Expo.\n\nThe Black business week is celebrated annually on the second week of February in the United States & Canada, and on the second week of October in the United Kingdom & the Caribbean Islands.', 'Businessweek.jpg', '1'),
(5, 'GBE Business Conference', 'This high powered 1 day business summit is designed to deliver an unprecedented networking space for deals, opportunities and knowledge sharing.\nDuring the day, speakers provide practical solutions and strategies to help attendees push their GBE business forward. There are also seminars for people wishing to start a business, build a business, create a secondary income stream, reduce / optimise costs or improve the implementation of particular strategies. \nThe GBE Business Conference is hosted on the third day of Black Business Week.\n\nFind the nearest ''GBE Business Conference'' near you, in the section below.', 'GBEConference.jpg', '1'),
(6, 'Black Velvet Ball', 'The Black Velvet Ball is a spectacular annual event which brings together GBE entrepreneurs, their partners, guests and invited business owners. \nThis event offers the chance for members to celebrate, network and make life long contacts.\nAttendees can enjoy drinks reception, entertainment provided by top DJs, live performances, food and dancing. \nThis is a ticket only event.\n\n\nThe Black Velvet Ball kicks off on the first night of Black Business Week.\nDressed to impress. \n\ncode\nFor gentlemen, black-tie, smart suit .\nFor ladies, Dresses and gowns.\n\nFind the nearest Black Velvet Ball near you, in the section below.', 'Blackvelvet.JPG', '1'),
(7, 'Afro Fashion Expo', 'Our Afro Fashion Expo is an annual buyers market that showcases the years top designers from Afrowebb. This compilation of style is dedicated to promoting luxury sustainable fashion. We feature No leather, No fur & No Toxic materials. With Fashion shows and live performances you will be dazzled by a day of glamour and urban chic.\n\nThe Afro Fashion Expo is held annually and occurs during the Black Business Week.', 'AfroFashion.jpg', '1'),
(8, 'GBE Business Banquet', 'Our annual ''GBE Business Banquet''  is a large feast complete with delicious Neo-nubian main courses and tasty desserts. This event is held on the last night of ''Black Business Week''. \nAfter the ceremonious feast, guest are able to enjoy an evening of networking, drinks and dance.\n\n''GBE Business Banquet'' is hosted on the six day of the Black Business Week.\n\nThe dress code for this banquet is formal wear.\nWomen - dress or a gown.\nMen - nice suit or tuxedo.\n\nFind the nearest ''GBE Business Banquet'' near you, in the section below.', 'banquet.jpg', '1'),
(9, 'I.B.M.A. Music Awards', 'The ''I.B.M.A'' - Intelligent Black Music Awards is an accolade presented by GBE to honour the biggest hit-makers throughout the Afrowebb network.\nMusic fans from around the world vote for the winners in 17 major categories via any one of the thousands of Afrowebb personalised websites and can vote online or by SMS?text messaging.\nThe awards ceremony is held annually and occurs during the Black Business Week. \nFind the nearest ''I.B.M.A Music Awards'' near you, in the section below.', 'IBMA.jpg', '1'),
(10, 'Afro Film Festival', 'Every year it is our privilege to welcome GBE members, residents and visitors from around the globe to Afro Film Fest.\nThe festival is a prominent showcase for filmmakers to show their works to an enthusiastic audience. This event is a forum for filmmakers, scholars and organizations to present information and promote artistic expression.\nWhile cultivating national and international interest for  black and bi-racial filmmakers, Afro Film Fest provides a unique window into the world in which we live, offering a new source of creativity to the screen.\n\nThe Afro Film Fest is held annually and occurs during the Black Business Week.', 'Afrofilmfest1.jpg', '1'),
(11, 'Neo-Nubian Food Expo', 'Neo Nubian Food Expo celebrates modern fusions of healthy African, Creole & Caribbean food. \nThis annual event is the premiere trade show for retailers, restaurant, institutional and commercial food service buyers, chefs and industry pros!\nAt this event, you''ll find everything you need to create Neo-Nubian food, find partners your your business, satisfy your customers and bring in new ones.\n\nWith industry professionals from across the food service market, Neo-Nubian Expo has a comprehensive focus that includes multi and single-unit restaurants, cooking schools and universities, grocery and supermarkets, distributors, wholesalers and nutrition experts. \nNeo-Nubian Expo takes place during Black Business Week.\nFind the nearest ''Neo-Nubian Food Expo'' near you, in the section below.', 'FoodExpo.jpg', '1'),
(12, 'Black & Green Expo', 'The Black & Green show is an international trading platform that showcases the latest innovations in environmental protection from around the world. Businesses, agencies, and organizations provide activities, information, and goods that make it easier for you to go green. The event covers subjects like Air & Water Quality solutions, Eco-friendly Products, Energy Efficiency & Energy, Green Building as well as Waste Management and Recycling.\nBring your friends and family and Come enjoy great music, locally sourced food, dozens of hands-on activities and pick up green goodies.\nThis event is sponsored by local businesses and eco organizations.\n\nFind the nearest ''Black & Green Show'' near you, in the section below.', 'Black&Green.jpg', '1'),
(13, 'AfroYoga Rave', '''AfroYoga Rave'' brings the spiritual element to Black Business Week. \nThis movement encourages all people to come together, sharing yoga , music and motions to experience a deeper connection with the universe.\nAt this event you can gather then release your energy and tension to obtain the calm focus needed to succeed in all areas of your life.\nWith ancient postures and a comfortable atmosphere Afro Yoga Rave can help you re-find your natural enthusiasm on your journey to a more enlightened state of mind”.\n\nFind the nearest ''Afro Yoga Rave'' near you, in the section below.', 'yoga-rave.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productFashion`
--

CREATE TABLE IF NOT EXISTS `productFashion` (
  `fashionID` int(11) NOT NULL AUTO_INCREMENT,
  `fashionTitle` varchar(150) NOT NULL,
  `fashionDesc` longtext NOT NULL,
  `fashionPosition` varchar(25) NOT NULL,
  `fashionImg` varchar(100) NOT NULL,
  `fashionStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`fashionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `productFashion`
--

INSERT INTO `productFashion` (`fashionID`, `fashionTitle`, `fashionDesc`, `fashionPosition`, `fashionImg`, `fashionStatus`) VALUES
(1, 'Hair & Beauty', 'You can choose from a wide range of high-quality hair and beauty products from nail treatments, cosmetics to skincare products and waxing, courtesy of GBE & ????. \nWe provide beauty tips, sell products for our best hairdressers and barbers and list high quality GBE salons', 'secondPosition', 'blackhairsalon.jpg', '1'),
(4, 'Seraphim Perfume Oil', 'The Seraphim collection of perfume oils is made from natural extracts and essential oils.\nForever subtle but sensual, this luxury brand provides a variety of soft velvety signature fragrances. \nSeraphim is loved the world over as a perfume brand that exudes status and style.\nThere something for every woman, for every man and for every moment. \nThe benefits using perfume oils is they are the strongest and longest lasting form of fragrance.\nAlcohol-free, they are ideal for use on skin sensitive to alcohol-based fragrances.\n\nBrowse through our selection and choose the scent thats right for you', 'secondPosition', 'seraphimoil.jpg', '1'),
(6, 'Neo-Nubian Cuisine', '<p>Within the last year chefs and nutritionists in Morpheus Society  have worked to create tasty yet healthy ways to recreate and modernise our  cultural cuisines.   <br />\nIts called Neo-Nubic cuisine – and its truly Soul Food.   <br />\nNeo-Nubian Cuisine consists of traditional African, Creole and the  Caribbean recipes, famous for the rich tastes and subtle nuances.<br />\nNeo-Nubian recipes achieve traditional flavours yet only use the  finest ingredients, lean meats, omega-3 packed fish and organic produce.  <br />\nAs a priority, Neo-nubic practitioners are encouraged to source local foods and use ingredients that  measure high in antioxidants, nutrients and beneficial enzymes.', 'thirdPosition', 'neonubiccuisine.jpg', '1'),
(23, 'Make Up', 'Discover the latest must-have beauty products on the Afrowebb.  \nLet Afrowebb become your premier beauty destination for the newest and best makeup for face, eyes, cheeks, lips, nails and body products.', 'secondPosition', 'makeup.jpg', '1'),
(7, 'Model Agency', '<p>New Breed Models is an  international agency for black, bi-racial and Latino models.<br />\n<p>We can supply a wide range of  Male and female models for;  </p>\n<ul>\n  <li>Fashion Shows  </li>\n  <li>Photographic Shoots  </li>\n  <li>Glamour Photography  </li>\n  <li>Commercial Shoots  </li>\n  <li>Editorial Features  </li>\n  <li>Casting services for modelling assignments, film, TV &  commercials  </li>', 'firstPosition', 'afrohairstyle.jpg', '1'),
(9, 'Divine Kitchen', '<p>Although the Neo-Nubian food movement is growing fast, there are very few restaurants where you can enjoy this cuisine. Now a brand called Divine Kitchen has pushed forward, becoming the spearhead of Neo-Nubian, fine dining. \nDivine Kitchen started as a pop-up restaurant that featured highly trained Black chefs at festivals and corporate events. Now empowered by GBE, Divine Kitchen offers restaurants the opportunity to become part of their high quality, fine dining experience. Using choice cuts, no bones and the freshest ingredients, the Divine Kitchen brand excites and unites People of all cultures while exuding a new era of cutting edge style and sophistication. By introducing people to different cultural tastes, food fusions and high quality service, Divine Kitchen aims to help reshape the Black-owned restaurant landscape. Through flavours Divine Kitchen aims to bridge borders, install new found respect & open minds.</p>', 'thirdPosition', 'Divinosun.jpg', '1'),
(10, 'Nutrition', '<p>Nutrition is a subject that has been over looked by many black families. Now, using GBE, we focus on understanding food components and their affect when ingestion to be?assimilated?by our bodies.  \nBy teaching a modern healthy diet, and keeping up with new advancements in nutrition we aim help to our people avoid many of the common health issues of today. </p>\n<p>Our food suggestions are always safe, evidence-based and give you a wide selection of?foods.</p>', 'thirdPosition', 'nutrition.jpeg', '1'),
(14, 'Seasonal Fashion', 'Scarves are one of the most versatile accessories you can have in your closet. No longer reserved for cold winters, scarves are widely available in a range of chic fabrics, colors\nWe’ve all seen plenty of them on Pinterest: pristine closets overflowing with color-coordinated clothing and rows upon rows of beautifully displayed', 'firstPosition', 'mens-clothing-for-scoliosis.jpg', '1'),
(27, 'Restaurants & Takeaways', 'Beat the Crowd, Book A Table Now! Read reviews for Black-owned Restaurants and explore tasty dishes to take away.', 'thirdPosition', 'restaurant.jpeg', '1'),
(15, 'Fashion designers', 'This section is for Fashion designers who create original clothing, accessories or footwear. \nWe support stylist diversity and garments that are environmentally friendly.\nBrowse through our list on designers and see their work featured at our local fashion shows\n\nYou must have a GBE membership the list yourself as a fashion designer here on Afrowebb.', 'firstPosition', 'FashionDesigners.jpg', '1'),
(16, 'Fashion Shows', 'A fashion show is an event put on by a fashion designer to showcase his or her upcoming line of clothing during Fashion Week. Fashion shows debut every season, particularly the Spring/Summer and Fall/Winter seasons. This is where the latest fashion trends are made. The two most influential fashion weeks are Paris Fashion Week and New York Fashion Week, which are both semiannual events. Also the Milan, London and Berlin Fashion Week are of global importance.\nIn a typical fashion show, models walk the catwalk dressed in the clothing created by the designer.', 'firstPosition', 'AfroFashion.jpg', '1'),
(17, 'Mens wear', 'Menswear is more than just shirts and ties - it encompasses style and sensibility through cut, proportion, and fabric. This section focuses on current trends and new fashions', 'firstPosition', 'Menswear.jpg', '1'),
(24, 'African Massage', 'With stress as one our biggest enemies, what better tool to use as a defence and conquer stress with a deep tissue massage.\nAfrican Massage is a system using a unique wooden baton, the Rungu.', 'secondPosition', 'Africanmassage.jpg', '1'),
(20, 'Nail Care', 'Nail care is extremely important because your hands are always visible. Improve the overall look and feel of your nails and learn how you can get a saloon-like nail polish finish at-home with our essential nail care, and nail polishing tips.', 'secondPosition', 'nails.jpg', '1'),
(19, 'Accessories & Jewellery', 'Our Jewellery writers through their appealing and genuine descriptions can propel your online success. Appropriately using the keywords in your listing title, they help your buyers discover your jewellery and watch items. Using the characters wisely in their listing description, they make sure that it is concise, well structured, and easy-to-read, embracing both basic information like material, brand, size, certification, retail price, and fascinating niceties about your item from the buyer’s perspective.', 'firstPosition', 'bridal-asccessories.jpg', '1'),
(18, 'Womans wear', 'Afrowebb features popular trends and distinctive fashion for the Summer.\nGBE''s fashion editors tell you how to look smokin'' hot this summer with tips on latest clothing, swimwear, footwear, accessories and makeup.', 'firstPosition', 'Summer-Fashion-Trends-2013.jpg', '1'),
(21, 'Waxing & Threading', 'Waxing is a form of semi-permanent hair removal which removes the hair from the root. New hair will not grow back in the previously waxed area for four to six weeks, although some people will start to see regrowth in only a week due to some of their hair being on a different growth cycle. Almost any area of the body can be waxed, including eyebrows, face, pubic area (called bikini waxing), legs, arms, back, abdomen and feet. There are many types of waxing suitable for removing unwanted hair.', 'secondPosition', 'wax.jpg', '1'),
(22, 'Facial Care', 'A facial is a great way to take care of your skin. Most procedures involving a variety of skin treatments, including: steam, exfoliation, extraction, creams, lotions, facial masks, peels, and massage.', 'secondPosition', 'Facials.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productMentorship`
--

CREATE TABLE IF NOT EXISTS `productMentorship` (
  `mentorID` int(11) NOT NULL AUTO_INCREMENT,
  `mentorTitle` varchar(150) NOT NULL,
  `mentorDesc` longtext NOT NULL,
  `mentorImg` varchar(100) NOT NULL,
  `mentorStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`mentorID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `productMentorship`
--

INSERT INTO `productMentorship` (`mentorID`, `mentorTitle`, `mentorDesc`, `mentorImg`, `mentorStatus`) VALUES
(1, 'Regenesis Program', 'The Re-genesis Program is designed to help you reboot and start again, this time stronger, wiser and fully equipped for what ever comes your way.  \nOur 12 step program enables GBE members to gain control, gain sovereignty of their thoughts and take massive action to better their life. \nCourses include \n \n•	Heritage,  \n•	Self defence \n•	Awareness  \n•	Environment \n•	Nutrition  \n•	Cooking \n•	Grooming  \n•	Etiquette \n•	Customer service \n•	Business \n•	Salsa dance \n•	Community safety  \n \nThese courses are host by top professionals in their field.  \nRe-genesis courses are exclusively for GBE members, their partners and their children. \nThere is mentorship for children from 6-12yrs, teen classes from 12 – 18yrs and Adult mentorship', 'canstockphoto15167410.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productMenuContent`
--

CREATE TABLE IF NOT EXISTS `productMenuContent` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(150) NOT NULL,
  `url` varchar(300) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `productMenuContent`
--

INSERT INTO `productMenuContent` (`id`, `menu_id`, `title`, `description`, `image`, `url`, `status`, `created_date`, `updated_date`) VALUES
(1, 1, 'Music  <br/>& Labels', 'Music & Labels\nFor over 80 years, ''Black music'' has been increasingly pigeon holed, first by White people then by Black people themselves.  It''s always the same - Soul, Gospel, Reggae, Jazz, Hip-Hop & RnB - is that it?   Many people don''t know that Rock n Roll - which later became Rock music, was defined by Black men like Lil Richard, Fats Domino and Chuck Berry. Jimi Hendrix, the greatest guitarist the world has ever seen was a Black man. House music, Techno, Rave, Jungle Drum n Bass, Dubstep, Trap and Afro punk are all genres that stem from Black origins.  It''s even come to light that Punk Rock was originally inspired by a band called Death, a Black punk band.  With our musical diversity finally surfacing GBE & Afrowebb proudly promote our musical creativity in all genres. \n\nTo have your music listed and sold you must be a GBE member. \nWe do NOT TOUCH music that refers to people as the N-Word. \nSo please, Be Intelligent! Browse through and buy Music, in the section below.', 'Music.jpeg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(2, 1, 'Films <br/>& Videos', 'GBE and Afrowebb feature producers, studios, music video makers and production companies.\nWe support diversity in filmmaking and use this online resource to market talent from the black, film community.\nTo feature or sell your films here you must be a GBE member.', 'Film.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(3, 1, 'Dance <br/>& Motion', 'GBE''s Dance Directory is where you''ll discover all things "Dance" - From Schools to dance companies, dancers, troops, crews and choreographers, \nWe focus various styles including Street & Club dance, Traditional, Ballet & Contemporary and Latin styles. \nIf you''re a dancer,choreographer, dance class or simply just love dance, this is where you will be kept in the loop.\nBrowse our listings below. ', 'Dance.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(4, 1, 'Progressive <br/>Word', '''Progressive word'' is motivational poetry. This new fusion of artistic poetry and motivational speaking  aims to create 100% positive energy for it''s listener. \nUnlike many ''Spoken word poems'', Progressive is constantly upbeat, focuses solely on positive messages, staying clear of the subjects of deities, negative life experiences, hang-ups or bad relationships.\n''Progressive Word'' aims to express that all life is sacred and one with the universe.\n\nFirst conceived in London UK by poets in the Morpheus Society, progressive word has grown in popularity and spread internationally. \n\nCommon topics include:\n\nDetermination to succeed, \nTriumph over adversity\nUnity\nScience\nUniverse \\ Cosmo \nJustice & Respect for all.\nFreedom\nLove\nLaw of Attraction\n\nProgressive word often includes collaboration and experimentation with other art forms such as?music, theatre, even dance. \nRemember, Words are very powerful. When spoken to the masses, words can heal, create and motivate.', 'progressiveword.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(5, 1, 'Theatre <br/>& Drama', 'yftluf.', 'Theatre.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(6, 1, 'DJ <br/>List', 'This list consists of DJs & music professionals in the GBE. Many of these artists perform or are known to perform at nightclub venues.', 'DJ-List.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(7, 1, 'Performers <br/>& Entertainers', 'We list entertainers, Fire performers, Acrobats, Magicians and jugglers who are members of GBE. \n\nThese performers are great for weddings, parties, corporate events, music festivals, street festivals and any other event that you are planning.\nIf you want to be listed in this section join GBE', 'performers.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(8, 1, 'Club <br/>Snappers', 'liyflff', 'clubsnappers.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(9, 1, 'Arts <br />& Crafts', 'GBE focuses on showcasing visual arts, which includes the creation of images or objects.\nWe features artist form all categories\nincluding painting, sculpture, printmaking, photography, and other forms of visual media.\nTo be listed you must be a GME member.\n\nBrowse below to find artists and info', 'art.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(10, 1, 'Comedy<br />Stand Up', 'This section focuses on Black Comedians and Comedic Actors both new and famous, past and present. You can also find local shows to enjoy.', 'comedy.jpeg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(17, 2, 'Black Business Week', 'Black Business Week is an annual event that celebrates the growth of our business community. the  This 7 day summit provides an unparalleled opportunity to network with professionals, entrepreneurs and business owners. It also gives our GBE members time to consolidate and nurture their online business by training with our team of online marketers. With high profile events hosted everyday, participants can benefit from unlimited deals and opportunities. \nDuring the week, companies from all cultures are invited to cement new bonds and network with professionals from the GBE community. \n\nDuring the week, ticket holders can gain valuable knowledge while enjoying events such as \nthe Black Velvet Ball, Fashion Shows, Black Business Conference,  Afro Yoga Rave, Intelligent Black Music Awards, Afro Film Festival, Black Business Banquet & the Neo-Nubian Food Expo.\n\nThe Black business week is celebrated annually on the second week of February in the United States & Canada, and on the second week of October in the United Kingdom & the Caribbean Islands.', 'Businessweek.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(18, 2, 'GBE Business Conference', 'This high powered 1 day business summit is designed to deliver an unprecedented networking space for deals, opportunities and knowledge sharing.\nDuring the day, speakers provide practical solutions and strategies to help attendees push their GBE business forward. There are also seminars for people wishing to start a business, build a business, create a secondary income stream, reduce / optimise costs or improve the implementation of particular strategies. \nThe GBE Business Conference is hosted on the third day of Black Business Week.\n\nFind the nearest ''GBE Business Conference'' near you, in the section below.', 'GBEConference.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(19, 2, 'Black Velvet Ball', 'The Black Velvet Ball is a spectacular annual event which brings together GBE entrepreneurs, their partners, guests and invited business owners. \nThis event offers the chance for members to celebrate, network and make life long contacts.\nAttendees can enjoy drinks reception, entertainment provided by top DJs, live performances, food and dancing. \nThis is a ticket only event.\n\n\nThe Black Velvet Ball kicks off on the first night of Black Business Week.\nDressed to impress. \n\ncode\nFor gentlemen, black-tie, smart suit .\nFor ladies, Dresses and gowns.\n\nFind the nearest Black Velvet Ball near you, in the section below.', 'Blackvelvet.JPG', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(20, 2, 'Afro Fashion Expo', 'Our Afro Fashion Expo is an annual buyers market that showcases the years top designers from Afrowebb. This compilation of style is dedicated to promoting luxury sustainable fashion. We feature No leather, No fur & No Toxic materials. With Fashion shows and live performances you will be dazzled by a day of glamour and urban chic.\n\nThe Afro Fashion Expo is held annually and occurs during the Black Business Week.', 'AfroFashion.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(21, 2, 'GBE Business Banquet', 'Our annual ''GBE Business Banquet''  is a large feast complete with delicious Neo-nubian main courses and tasty desserts. This event is held on the last night of ''Black Business Week''. \nAfter the ceremonious feast, guest are able to enjoy an evening of networking, drinks and dance.\n\n''GBE Business Banquet'' is hosted on the six day of the Black Business Week.\n\nThe dress code for this banquet is formal wear.\nWomen - dress or a gown.\nMen - nice suit or tuxedo.\n\nFind the nearest ''GBE Business Banquet'' near you, in the section below.', 'banquet.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(22, 2, 'I.B.M.A. Music Awards', 'The ''I.B.M.A'' - Intelligent Black Music Awards is an accolade presented by GBE to honour the biggest hit-makers throughout the Afrowebb network.\nMusic fans from around the world vote for the winners in 17 major categories via any one of the thousands of Afrowebb personalised websites and can vote online or by SMS?text messaging.\nThe awards ceremony is held annually and occurs during the Black Business Week. \nFind the nearest ''I.B.M.A Music Awards'' near you, in the section below.', 'IBMA.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(23, 2, 'Afro Film Festival', 'Every year it is our privilege to welcome GBE members, residents and visitors from around the globe to Afro Film Fest.\nThe festival is a prominent showcase for filmmakers to show their works to an enthusiastic audience. This event is a forum for filmmakers, scholars and organizations to present information and promote artistic expression.\nWhile cultivating national and international interest for  black and bi-racial filmmakers, Afro Film Fest provides a unique window into the world in which we live, offering a new source of creativity to the screen.\n\nThe Afro Film Fest is held annually and occurs during the Black Business Week.', 'Afrofilmfest1.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(24, 2, 'Neo-Nubian Food Expo', 'Neo Nubian Food Expo celebrates modern fusions of healthy African, Creole & Caribbean food. \nThis annual event is the premiere trade show for retailers, restaurant, institutional and commercial food service buyers, chefs and industry pros!\nAt this event, you''ll find everything you need to create Neo-Nubian food, find partners your your business, satisfy your customers and bring in new ones.\n\nWith industry professionals from across the food service market, Neo-Nubian Expo has a comprehensive focus that includes multi and single-unit restaurants, cooking schools and universities, grocery and supermarkets, distributors, wholesalers and nutrition experts. \nNeo-Nubian Expo takes place during Black Business Week.\nFind the nearest ''Neo-Nubian Food Expo'' near you, in the section below.', 'FoodExpo.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(25, 2, 'Black & Green Expo', 'The Black & Green show is an international trading platform that showcases the latest innovations in environmental protection from around the world. Businesses, agencies, and organizations provide activities, information, and goods that make it easier for you to go green. The event covers subjects like Air & Water Quality solutions, Eco-friendly Products, Energy Efficiency & Energy, Green Building as well as Waste Management and Recycling.\nBring your friends and family and Come enjoy great music, locally sourced food, dozens of hands-on activities and pick up green goodies.\nThis event is sponsored by local businesses and eco organizations.\n\nFind the nearest ''Black & Green Show'' near you, in the section below.', 'Black&Green.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(26, 2, 'AfroYoga Rave', '''AfroYoga Rave'' brings the spiritual element to Black Business Week. \nThis movement encourages all people to come together, sharing yoga , music and motions to experience a deeper connection with the universe.\nAt this event you can gather then release your energy and tension to obtain the calm focus needed to succeed in all areas of your life.\nWith ancient postures and a comfortable atmosphere Afro Yoga Rave can help you re-find your natural enthusiasm on your journey to a more enlightened state of mind”.\n\nFind the nearest ''Afro Yoga Rave'' near you, in the section below.', 'yoga-rave.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(31, 4, 'Hair & Beauty', 'You can choose from a wide range of high-quality hair and beauty products from nail treatments, cosmetics to skincare products and waxing, courtesy of GBE & ????. \nWe provide beauty tips, sell products for our best hairdressers and barbers and list high quality GBE salons', 'blackhairsalon.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(32, 4, 'Seraphim Perfume Oil', 'The Seraphim collection of perfume oils is made from natural extracts and essential oils.\nForever subtle but sensual, this luxury brand provides a variety of soft velvety signature fragrances. \nSeraphim is loved the world over as a perfume brand that exudes status and style.\nThere something for every woman, for every man and for every moment. \nThe benefits using perfume oils is they are the strongest and longest lasting form of fragrance.\nAlcohol-free, they are ideal for use on skin sensitive to alcohol-based fragrances.\n\nBrowse through our selection and choose the scent thats right for you', 'seraphimoil.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(33, 4, 'Neo-Nubian Cuisine', '<p>Within the last year chefs and nutritionists in Morpheus Society  have worked to create tasty yet healthy ways to recreate and modernise our  cultural cuisines.   <br />\nIts called Neo-Nubic cuisine – and its truly Soul Food.   <br />\nNeo-Nubian Cuisine consists of traditional African, Creole and the  Caribbean recipes, famous for the rich tastes and subtle nuances.<br />\nNeo-Nubian recipes achieve traditional flavours yet only use the  finest ingredients, lean meats, omega-3 packed fish and organic produce.  <br />\nAs a priority, Neo-nubic practitioners are encouraged to source local foods and use ingredients that  measure high in antioxidants, nutrients and beneficial enzymes.', 'neonubiccuisine.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(34, 4, 'Make Up', 'Discover the latest must-have beauty products on the Afrowebb.  \nLet Afrowebb become your premier beauty destination for the newest and best makeup for face, eyes, cheeks, lips, nails and body products.', 'makeup.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(35, 4, 'Model Agency', '<p>New Breed Models is an  international agency for black, bi-racial and Latino models.<br />\n<p>We can supply a wide range of  Male and female models for;  </p>\n<ul>\n  <li>Fashion Shows  </li>\n  <li>Photographic Shoots  </li>\n  <li>Glamour Photography  </li>\n  <li>Commercial Shoots  </li>\n  <li>Editorial Features  </li>\n  <li>Casting services for modelling assignments, film, TV &  commercials  </li>', 'afrohairstyle.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(36, 4, 'Divine Kitchen', '<p>Although the Neo-Nubian food movement is growing fast, there are very few restaurants where you can enjoy this cuisine. Now a brand called Divine Kitchen has pushed forward, becoming the spearhead of Neo-Nubian, fine dining. \nDivine Kitchen started as a pop-up restaurant that featured highly trained Black chefs at festivals and corporate events. Now empowered by GBE, Divine Kitchen offers restaurants the opportunity to become part of their high quality, fine dining experience. Using choice cuts, no bones and the freshest ingredients, the Divine Kitchen brand excites and unites People of all cultures while exuding a new era of cutting edge style and sophistication. By introducing people to different cultural tastes, food fusions and high quality service, Divine Kitchen aims to help reshape the Black-owned restaurant landscape. Through flavours Divine Kitchen aims to bridge borders, install new found respect & open minds.</p>', 'Divinosun.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(37, 4, 'Nutrition', '<p>Nutrition is a subject that has been over looked by many black families. Now, using GBE, we focus on understanding food components and their affect when ingestion to be?assimilated?by our bodies.  \nBy teaching a modern healthy diet, and keeping up with new advancements in nutrition we aim help to our people avoid many of the common health issues of today. </p>\n<p>Our food suggestions are always safe, evidence-based and give you a wide selection of?foods.</p>', 'nutrition.jpeg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(38, 4, 'Seasonal Fashion', 'Scarves are one of the most versatile accessories you can have in your closet. No longer reserved for cold winters, scarves are widely available in a range of chic fabrics, colors\nWe’ve all seen plenty of them on Pinterest: pristine closets overflowing with color-coordinated clothing and rows upon rows of beautifully displayed', 'mens-clothing-for-scoliosis.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(39, 4, 'Restaurants & Takeaways', 'Beat the Crowd, Book A Table Now! Read reviews for Black-owned Restaurants and explore tasty dishes to take away.', 'restaurant.jpeg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(40, 4, 'Fashion designers', 'This section is for Fashion designers who create original clothing, accessories or footwear. \nWe support stylist diversity and garments that are environmentally friendly.\nBrowse through our list on designers and see their work featured at our local fashion shows\n\nYou must have a GBE membership the list yourself as a fashion designer here on Afrowebb.', 'FashionDesigners.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(41, 4, 'Fashion Shows', 'A fashion show is an event put on by a fashion designer to showcase his or her upcoming line of clothing during Fashion Week. Fashion shows debut every season, particularly the Spring/Summer and Fall/Winter seasons. This is where the latest fashion trends are made. The two most influential fashion weeks are Paris Fashion Week and New York Fashion Week, which are both semiannual events. Also the Milan, London and Berlin Fashion Week are of global importance.\nIn a typical fashion show, models walk the catwalk dressed in the clothing created by the designer.', 'AfroFashion.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(42, 4, 'Mens wear', 'Menswear is more than just shirts and ties - it encompasses style and sensibility through cut, proportion, and fabric. This section focuses on current trends and new fashions', 'Menswear.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(43, 4, 'African Massage', 'With stress as one our biggest enemies, what better tool to use as a defence and conquer stress with a deep tissue massage.\nAfrican Massage is a system using a unique wooden baton, the Rungu.', 'Africanmassage.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(44, 4, 'Nail Care', 'Nail care is extremely important because your hands are always visible. Improve the overall look and feel of your nails and learn how you can get a saloon-like nail polish finish at-home with our essential nail care, and nail polishing tips.', 'nails.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(45, 4, 'Accessories & Jewellery', 'Our Jewellery writers through their appealing and genuine descriptions can propel your online success. Appropriately using the keywords in your listing title, they help your buyers discover your jewellery and watch items. Using the characters wisely in their listing description, they make sure that it is concise, well structured, and easy-to-read, embracing both basic information like material, brand, size, certification, retail price, and fascinating niceties about your item from the buyer’s perspective.', 'bridal-asccessories.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(46, 4, 'Womans wear', 'Afrowebb features popular trends and distinctive fashion for the Summer.\nGBE''s fashion editors tell you how to look smokin'' hot this summer with tips on latest clothing, swimwear, footwear, accessories and makeup.', 'Summer-Fashion-Trends-2013.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(47, 4, 'Waxing & Threading', 'Waxing is a form of semi-permanent hair removal which removes the hair from the root. New hair will not grow back in the previously waxed area for four to six weeks, although some people will start to see regrowth in only a week due to some of their hair being on a different growth cycle. Almost any area of the body can be waxed, including eyebrows, face, pubic area (called bikini waxing), legs, arms, back, abdomen and feet. There are many types of waxing suitable for removing unwanted hair.', 'wax.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(48, 4, 'Facial Care', 'A facial is a great way to take care of your skin. Most procedures involving a variety of skin treatments, including: steam, exfoliation, extraction, creams, lotions, facial masks, peels, and massage.', 'Facials.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(62, 7, 'Regenesis Program', 'The Re-genesis Program is designed to help you reboot and start again, this time stronger, wiser and fully equipped for what ever comes your way.  \nOur 12 step program enables GBE members to gain control, gain sovereignty of their thoughts and take massive action to better their life. \nCourses include \n \n•	Heritage,  \n•	Self defence \n•	Awareness  \n•	Environment \n•	Nutrition  \n•	Cooking \n•	Grooming  \n•	Etiquette \n•	Customer service \n•	Business \n•	Salsa dance \n•	Community safety  \n \nThese courses are host by top professionals in their field.  \nRe-genesis courses are exclusively for GBE members, their partners and their children. \nThere is mentorship for children from 6-12yrs, teen classes from 12 – 18yrs and Adult mentorship', 'canstockphoto15167410.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(63, 9, 'Local Party Events', 'Our local event section features events hosted by GBE members who have reached level 3, a high standard of our online business.  With the vast training and support available from our network, these events are high quality and full of fun.  Find the nearest ''Local events'' near you, in the section below.', 'Localnight.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(64, 9, 'Safe Neighbourhoods', 'We must all unite and create communities where there is no place for murderous criminals to hide, whether they are young or old.\r\nOnyx Council is a Neighbourhood & Home Watch network, where GBE members and their neighbours come together, to create strong, friendly, active communities where crime and anti-social behaviours are not tolerated. By people looking out for each other, crossing barriers of age, race and class, we can create real communities that benefit everyone. \r\nGBE believe strongly that no one should have to feel afraid, vulnerable or isolated in the area they live.\r\nOur vision is that of a caring society that is focused on trust and respect in which people are safe from crime and enjoy a good quality of life.  \r\nWe are happy to work other neighbourhood watch schemes, anti gun & knife organisations, anti crime groups, police and local partners, to build safe and friendly communities \r\nJoin onyx council of start a chapter in your area by calling.', 'Neighbourhood.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(65, 9, 'Real Estate Agents', 'On this page you can find high quality property managers who are members of GBE, real estate agents or local realtors to assist you in all aspects of renting, home buying or home selling.Agents. You must be a GBE member to be added to this list sign up or call.', 'real_estate.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(66, 9, 'Builders & Decorators', 'This section is for skilled, reliable and professional tradesmen who can deal with all types of building work. \r\n\r\nWe list Painter, \r\nPlastering,\r\nWindow Fitting', 'decorpaint.jpeg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(67, 9, 'Interior & Architecture', 'The professions of Interior Design and Architecture are constantly evolving. This section lists practitioners who are on the cutting edge of their craft.', 'IneriorDecoraction.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(68, 9, 'Car Machanics', 'Afrowebb features local car machanics who specialize in maintaining and repairing popular makes and models.\r\nWe are an invaluable motoring resource that appeals to GBE members and Afrowebb visitors.', 'machanic.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(69, 9, 'Sports & lessons', 'You can find info on local sports clubs and a comprehensive list of sports instructors.\r\n\r\nYou can find info on local sports clubs and a comprehensive list of sports instructors.', 'sports.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(70, 9, 'Motorcycle Clubs', 'The rise black motorcycle clubs is a phenomenon. So, Afrowebb has put together a list showing the best black motorcycle clubs that can be found in cities near you.', 'motorcycle.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(71, 9, 'Doctors & Dentists', 'On this page you can find high quality property managers who are members of GBE, real estate agents or local realtors to assist you in all aspects of renting, home buying or home selling. Agents. You must be a GBE member to be added to this list sign up or call.', 'Doctors.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(72, 9, 'Lawyers', 'On this page you can find high quality property managers who are members of GBE, real estate agents or local realtors to assist you in all aspects of renting, home buying or home selling.Agents. You must be a GBE member to be added to this list sign up or call. ', 'lawyer.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(73, 9, 'Radio Stations', 'Find radio stations from all over the world, who are members of GBE.', 'radio.jpg', '', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(78, 12, 'Celestial Technologies', 'Celestial Technologies is a dedicated team of skilled developers and designers based in the UK & US. \r\nWe specialise in website development and design. Are energetic and dynamic organisation aim is to develop and deliver web-based systems, built to excellent standards, whilst keeping the project cost effective.\r\nWe provide dynamic and data driven web applications. Our services include \r\n\r\n•	graphic design,\r\n•	website design\r\n•	E-commerce solutions,\r\n•	web development.\r\n•	Php, Java, Html,\r\n \r\nWith over 7 years of experience in their respective field of expertise we are experts in handling complex projects. Let us build your website today. \r\n', 'webbiz.jpg', 'http://www.youtube.com/embed/qOcM-L-Ss1o', 1, '2014-07-17 13:41:46', '0000-00-00 00:00:00'),
(79, 9, 'GBE Networking Events', 'Once monthly, GBE host Networking events in selected cities. These gatherings enable attendees to meet valuable new contacts, exchange knowledge and a chance to build successful business partnerships.\nUpon arrival, you will be personally greeted by our hosts and introduced to other members.\n\nOur events provide something for anyone considering GBE as a way to make money online. \nAnyone interested in building a business\nAnyone looking to scale a business through the GBE framework.\nAnyone interested in networking and meeting business professionals,\n\nCome and meet professional, like-minded new friends, investors and entrepreneurs, all connected to GBE.\n\nFind the nearest GBE Networking event near you, in the section below.', 'blackbiz17.jpg', '', 1, '2014-12-02 13:18:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `productNews`
--

CREATE TABLE IF NOT EXISTS `productNews` (
  `newsID` int(11) NOT NULL AUTO_INCREMENT,
  `newsTitle` varchar(150) NOT NULL,
  `newsDesc` longtext NOT NULL,
  `newsImg` varchar(100) NOT NULL,
  `newsStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`newsID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `productNews`
--

INSERT INTO `productNews` (`newsID`, `newsTitle`, `newsDesc`, `newsImg`, `newsStatus`) VALUES
(1, 'Mind Set', 'The benefits of Meditation are innumerable. In ancient times our ancestors harnessed this practice to a-line their body, mind and spirit with the universe. However, with the uptake of superstition, religions and slavery, meditation faded from our culture. \n<p>Now, in modern black communities meditation is reappearing as a way to heal and rest deeper than the deepest sleep. </p>\n<p>Meditation de-stresses the body and mind and prevents stress from getting back into the system. \nIt has been proven to lower high blood pressure and the levels of blood lactate which reduces anxiety attacks. Meditation improves the immune system and emotional stability making problems seem smaller and making them easier to deal with. It fills the cells in the body with more energy resulting in joy, peace, enthusiasm.  </p>\n<p> \nFind Meditation courses in your area hosted by GBE members  \nIf there are none close to you, enjoy a free Meditation exercises below to help you relax and achieve peace of mind.  </p>', 'Mindsetmeditation.jpg', '1'),
(2, 'African Yoga', 'Its finally becoming clear that against popular belief, Yoga first began in Africa, specifically in the Kemet region (ancient Egypt). \n<p>On wall paintings and sculptures we see figures in positions that we now know to be Yoga postures. Kemetic Yoga is expressed in the artwork and spiritual writings found in the ancient tombs and temples. Young Egyptian aristocrats (Kamites) of North Eastern Africa were made to acquire a high level of competency in Yoga before they were considered mentally and spiritually prepared to master the rigors of mathematics, engineering, medicine, astronomy, astrology, architecture, literature, metaphysics, ethics and philosophy. Many of these ancient Africans migrated to India and became what are now known as the Dravidian Indians who passed on teachings of their spiritual practices, later evolving into Hindu beliefs and the practice of yoga. </p>\n<p>GBE are working have to see more people of African descent reclaim this ancient holistic practice.  \nIf you are a Yoga practitioner and want to inquire more call \n</p>', 'african-yoga.jpg', '1'),
(4, 'Health & Fitness', 'Afrowebb is a source for exercise, health and nutrition advice. \nWe provide information on exercise programs, athletic performance and diet for GBE members and Afrowebb visitors.\n\nEvery month Afrowebb will showcase experts in body toning, fitness, pilates, diet plans, toning exercise, weight loss, exercise, toning, body toning, muscle tone, personal trainer, gym, arm exercises, workout, weight lifting.', 'healthFitness.jpg', '1'),
(5, 'Environmental- Black & Green', 'Many black people have been active in the campaign for environmental issues, but more recently some have become major players in areas ranging from green jobs, to urban gardens to heading the EPA.  \n \n<p>The environment may not sound like a priority issue for people, but it definitely is.  \nConsider this: Our communities suffer from health effects caused by pollution and in countries less likely have access to fresh foods and water we see malnourishment, sickness and famine.  </p>\n<p>So you see, caring about the environment is just as important as fighting for equal rights. After all, without clean air, water and food, it''s over, for everyone. </p>\n \n<p>Black & Green is tasked to help reduce your carbon foot print by introducing your to environmental products , conservation awareness and initiatives to plant trees and save the rainforest. </p>\n \n<p>Be responsible and help us look after the bio diversity of earth. Be responsible for reducing climate change.  \nBe part of GBE  </p>', 'environment.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productResidential`
--

CREATE TABLE IF NOT EXISTS `productResidential` (
  `residentialId` int(11) NOT NULL AUTO_INCREMENT,
  `residentialTitle` varchar(150) NOT NULL,
  `residentialDesc` longtext NOT NULL,
  `residentialImage` varchar(100) NOT NULL,
  `residentialStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`residentialId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `productResidential`
--

INSERT INTO `productResidential` (`residentialId`, `residentialTitle`, `residentialDesc`, `residentialImage`, `residentialStatus`) VALUES
(1, 'Local Party Events', 'Our local event section features events hosted by GBE members who have reached level 3, a high standard of our online business.  With the vast training and support available from our network, these events are high quality and full of fun.  Find the nearest ''Local events'' near you, in the section below.', 'Localnight.jpg', '1'),
(3, 'Safe Neighbourhoods', 'We must all unite and create communities where there is no place for murderous criminals to hide, whether they are young or old.\r\nOnyx Council is a Neighbourhood & Home Watch network, where GBE members and their neighbours come together, to create strong, friendly, active communities where crime and anti-social behaviours are not tolerated. By people looking out for each other, crossing barriers of age, race and class, we can create real communities that benefit everyone. \r\nGBE believe strongly that no one should have to feel afraid, vulnerable or isolated in the area they live.\r\nOur vision is that of a caring society that is focused on trust and respect in which people are safe from crime and enjoy a good quality of life.  \r\nWe are happy to work other neighbourhood watch schemes, anti gun & knife organisations, anti crime groups, police and local partners, to build safe and friendly communities \r\nJoin onyx council of start a chapter in your area by calling.', 'Neighbourhood.jpg', '1'),
(4, 'Real Estate Agents', 'On this page you can find high quality property managers who are members of GBE, real estate agents or local realtors to assist you in all aspects of renting, home buying or home selling.Agents. You must be a GBE member to be added to this list sign up or call.', 'real_estate.jpg', '1'),
(5, 'Painters & Decorators', 'This section is for skilled, reliable and professional tradesmen who can deal with all types of building work. \n\nWe list Painter, \nPlastering,\nWindow Fitting', 'decorpaint.jpeg', '1'),
(7, 'Interior & Architecture', 'The professions of Interior Design and Architecture are constantly evolving. This section lists practitioners who are on the cutting edge of their craft.', 'IneriorDecoraction.jpg', '1'),
(8, 'Car Machanics', 'Afrowebb features local car machanics who specialize in maintaining and repairing popular makes and models.\r\nWe are an invaluable motoring resource that appeals to GBE members and Afrowebb visitors.', 'machanic.jpg', '1'),
(9, 'Sports & lessons', 'You can find info on local sports clubs and a comprehensive list of sports instructors.\r\n\r\nYou can find info on local sports clubs and a comprehensive list of sports instructors.', 'sports.jpg', '1'),
(10, 'Motorcycle Clubs', 'The rise black motorcycle clubs is a phenomenon. So, Afrowebb has put together a list showing the best black motorcycle clubs that can be found in cities near you.', 'motorcycle.jpg', '1'),
(11, 'Doctors & Dentists', 'On this page you can find high quality property managers who are members of GBE, real estate agents or local realtors to assist you in all aspects of renting, home buying or home selling. Agents. You must be a GBE member to be added to this list sign up or call.', 'Doctors.jpg', '1'),
(12, 'Lawyers', 'On this page you can find high quality property managers who are members of GBE, real estate agents or local realtors to assist you in all aspects of renting, home buying or home selling.Agents. You must be a GBE member to be added to this list sign up or call. ', 'lawyer.jpg', '1'),
(14, 'Radio Stations', 'Find radio stations from all over the world, who are members of GBE.', 'radio.jpg', '1'),
(15, 'Builders & Construction', 'We list companies that pride themselves on being able to provide every type of home construction and earthwork services that you may need.', 'gbebuilders.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productSecondaryImages`
--

CREATE TABLE IF NOT EXISTS `productSecondaryImages` (
  `prodSeconImgID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  `productImg` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`prodSeconImgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `productSecondaryImages`
--

INSERT INTO `productSecondaryImages` (`prodSeconImgID`, `ProductID`, `productImg`, `status`) VALUES
(1, 5, 'index1.jpg', '1'),
(2, 5, 'index2.jpg', '1'),
(3, 5, 'index3.jpg', '1'),
(4, 6, 'apple-tshirt.jpg', '1'),
(5, 6, '4001_102.jpg', '1'),
(6, 10, 'wof1.png', '1'),
(7, 10, 'wof1.jpg', '1'),
(8, 11, 'im1.jpg', '1'),
(9, 11, 'ip2.jpg', '1'),
(10, 11, 'im3.jpg', '1'),
(11, 12, 'alchemist1.jpg', '1'),
(12, 12, 'alchemist2.jpg', '1'),
(13, 13, 'shortShirt1.jpg', '1'),
(14, 13, 'shortshirt2.jpg', '1'),
(15, 18, 'FS1.jpg', '1'),
(16, 18, 'FS2.jpg', '1'),
(17, 18, 'FS3.jpg', '1'),
(18, 19, 'FSCover.jpg', '1'),
(19, 19, 'FS3.jpg', '1'),
(20, 19, 'FS1.jpg', '1'),
(21, 23, 'sweater1.jpg', '1'),
(22, 23, 'sweater2.jpg', '1'),
(23, 25, 'trouserOne.jpg', '1'),
(24, 25, 'trouserTwo.jpg', '1'),
(25, 34, 'Desert.jpg', '1'),
(26, 34, 'Lighthouse.jpg', '1'),
(27, 37, 'jeans222.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productSecurity`
--

CREATE TABLE IF NOT EXISTS `productSecurity` (
  `securityId` int(11) NOT NULL AUTO_INCREMENT,
  `securityTitle` varchar(150) NOT NULL,
  `securityImg` varchar(100) NOT NULL,
  `securityUrl` varchar(100) NOT NULL,
  `securityStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`securityId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `productSecurity`
--

INSERT INTO `productSecurity` (`securityId`, `securityTitle`, `securityImg`, `securityUrl`, `securityStatus`) VALUES
(8, 'Arc-Angels Security', 'security.jpg', 'http://www.youtube.com/embed/qOcM-L-Ss1o', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productStyleBanner`
--

CREATE TABLE IF NOT EXISTS `productStyleBanner` (
  `bannerID` int(11) NOT NULL AUTO_INCREMENT,
  `bannerPosition` varchar(25) NOT NULL,
  `bannerImage` varchar(150) NOT NULL,
  `BannerStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`bannerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `productStyleBanner`
--

INSERT INTO `productStyleBanner` (`bannerID`, `bannerPosition`, `bannerImage`, `BannerStatus`) VALUES
(3, 'firstPosition', 'fashion.jpg', '1'),
(4, 'firstPosition', 'FashionDesigners.jpg', '1'),
(6, 'firstPosition', 'HM-magazine-summer-2010-the-beach-editorial-130510-2.jpg', '0'),
(13, 'secondPosition', '2.jpg', '1'),
(14, 'secondPosition', '2seraphimoil.jpg', '1'),
(15, 'secondPosition', 'Beauty3.jpg', '1'),
(17, 'thirdPosition', 'chefswanted.jpg', '1'),
(18, 'thirdPosition', 'continental-food-large.jpg', '1'),
(19, 'thirdPosition', 'RumKitchen_Food-5.jpg', '1'),
(20, 'firstPosition', '049_Claire_AfroPunk-176.jpg', '1'),
(23, 'secondPosition', 'PunkAfroHairstyle.jpg', '1'),
(25, 'thirdPosition', 'hailetoasting2.jpg', '1'),
(26, 'firstPosition', 'modelswanted.jpg', '1'),
(28, 'thirdPosition', 'nnubique.jpeg', '1'),
(29, 'thirdPosition', 'ChefsWanted.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productTrip`
--

CREATE TABLE IF NOT EXISTS `productTrip` (
  `tripID` int(11) NOT NULL AUTO_INCREMENT,
  `tripTitle` varchar(150) NOT NULL,
  `tripDesc` longtext NOT NULL,
  `tripImg` varchar(100) NOT NULL,
  `tripStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`tripID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `productTrip`
--

INSERT INTO `productTrip` (`tripID`, `tripTitle`, `tripDesc`, `tripImg`, `tripStatus`) VALUES
(1, 'Caribbean', 'Candy-coloured cocktails sipped in seaside watering holes. Carefree days followed by calypso-flavoured nights. These are the siren songs that lure anyone yearning to escape to the incomparable Caribbean Islands. GBE invite you to join us on a Caribbean Holiday & Cruise.  \nStarting on the beautiful island of Jamaica, members can bask in the sun while finding time to re-energise.\nWhether you’re sailing through turquoise waters, lazing on powdery white beaches, the glamorous harbors and unknown coves of this area remain a hidden treasure.', 'caribbean_.jpg', '1'),
(2, 'Rio - Brazil', 'RIO DE JANEIRO has one of the most stunning settings in the world. Sitting on the southern shore of the magnificent Guanabara Bay, then extending for 20km along an alluvial strip, Rio thrives between the sea and forest-clad mountains.  \n \nOut in the bay there are many rocky islands fringed with white sand. The city''s streets and buildings have been moulded around the foothills of the mountain range that provides its backdrop. The aerial views over Rio are breathtaking, and even the concrete skyscrapers add to the attraction. Rio has a remarkable architectural heritage, some of the country''s best museums and galleries, superb restaurants, vibrant nightlife and legendary beaches. With so much to see and do, Rio can easily occupy you and on this GBE trip, you may well find it difficult to drag yourself away.', 'Rio-de-Janeiro.jpg', '1'),
(4, 'Gambia - Africa', 'Come and Explore the natural beauty of Africa and visit The Gambia with us. \nYou can embark on a fascinating voyage of discovery up-river in search of hippos, monkeys, baboons and chimpanzees, or relax as The Gambia offers miles of the most outstanding, golden beaches in Africa. \nThis habitats makes this country a birdwatcher''s paradise.\nThe Restaurants are very low priced so sample the wide variety of Gambian and international cuisine.\nThe Gambia coast and the vibrancy of Bakau, Serrekunda, Kololi and the capital, Banjul, is as colourfully African as you might imagine. During the day, fish for Barracuda on the Atlantic Ocean, strike a bargain in one of the many markets and in the evening you can party till dawn.', 'gambia.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productType`
--

CREATE TABLE IF NOT EXISTS `productType` (
  `productTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `productTypeName` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`productTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `productType`
--

INSERT INTO `productType` (`productTypeID`, `productTypeName`, `status`) VALUES
(1, 'Music', '1'),
(2, 'Tickets', '1'),
(3, 'Black cinema', '1'),
(4, 'Rent movies', '1'),
(5, 'Pictures ', '1'),
(6, 'Clothes', '1'),
(7, 'Jewellery', '1'),
(8, 'Hair Products', '1'),
(9, 'Books', '1'),
(10, 'Purfume ', '1'),
(11, 'Make Up', '1'),
(12, 'Oils ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productWebBuilder`
--

CREATE TABLE IF NOT EXISTS `productWebBuilder` (
  `builderId` int(11) NOT NULL AUTO_INCREMENT,
  `builderTitle` varchar(150) NOT NULL,
  `builderImg` varchar(100) NOT NULL,
  `builderDesc` longtext NOT NULL,
  `builderUrl` varchar(100) NOT NULL,
  `builderStatus` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`builderId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `productWebBuilder`
--

INSERT INTO `productWebBuilder` (`builderId`, `builderTitle`, `builderImg`, `builderDesc`, `builderUrl`, `builderStatus`) VALUES
(1, 'Celestial Technologies', 'webbiz.jpg', 'Celestial Technologies is a dedicated team of skilled developers and designers based in the UK & US. \r\nWe specialise in website development and design. Are energetic and dynamic organisation aim is to develop and deliver web-based systems, built to excellent standards, whilst keeping the project cost effective.\r\nWe provide dynamic and data driven web applications. Our services include \r\n\r\n•	graphic design,\r\n•	website design\r\n•	E-commerce solutions,\r\n•	web development.\r\n•	Php, Java, Html,\r\n \r\nWith over 7 years of experience in their respective field of expertise we are experts in handling complex projects. Let us build your website today. \r\n', 'http://www.youtube.com/embed/qOcM-L-Ss1o', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tableDetails`
--

CREATE TABLE IF NOT EXISTS `tableDetails` (
  `tableID` int(11) NOT NULL AUTO_INCREMENT,
  `tableName` varchar(100) NOT NULL,
  `fieldTitle` varchar(100) NOT NULL,
  `fieldID` varchar(100) NOT NULL,
  `menuName` varchar(100) NOT NULL,
  `tableStatus` enum('0','1') NOT NULL,
  PRIMARY KEY (`tableID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tableDetails`
--

INSERT INTO `tableDetails` (`tableID`, `tableName`, `fieldTitle`, `fieldID`, `menuName`, `tableStatus`) VALUES
(1, 'productCreative', 'creativeTitle', 'creativeID', 'Creatives', '1'),
(2, 'productEvent', 'eventTitle', 'eventID', 'Events', '1'),
(3, 'productTrip', 'tripTitle', 'tripID', 'Trips & Holidays', '1'),
(4, 'productFashion', 'fashionTitle', 'fashionID', 'Fashion', '1'),
(5, 'productStyleBanner', '', '', 'Fashion Banner', '1'),
(6, 'productNews', 'newsTitle', 'newsID', 'News', '1'),
(7, 'productMentorship', 'mentorTitle', 'mentorID', 'Mentorship', '1'),
(8, 'productBusiness', 'businessTitle', 'businessID', 'Business Consultant', '1'),
(9, 'productArticle', 'articleTitle', 'articleID', 'Article', '1'),
(10, 'productWebBuilder', 'builderTitle ', 'builderId', 'Website Builders', '1'),
(11, 'productResidential', 'residentialTitle', 'residentialId', 'Residential', '1'),
(12, 'productSecurity', 'securityTitle ', 'securityId ', 'Security', '1'),
(13, 'productAdvertisement', 'advertisementTitle', 'advertisementId', 'Advertisement', '1'),
(14, 'productNews', 'newsTitle', 'newsID', 'Wellness', '1');

-- --------------------------------------------------------

--
-- Table structure for table `userAdvert`
--

CREATE TABLE IF NOT EXISTS `userAdvert` (
  `advertID` int(11) NOT NULL AUTO_INCREMENT,
  `advertTitle` varchar(100) NOT NULL,
  `advertImg` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`advertID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `userAdvert`
--

INSERT INTO `userAdvert` (`advertID`, `advertTitle`, `advertImg`, `status`) VALUES
(1, 'Black Society1', 'tmb6418336320140102-00-08-39.jpg', '1'),
(2, 'Black Society2', 'tmb7402021120140102-00-05-16.jpg', '1'),
(21, 'dvds', '1404371936Doctors.jpg', '1'),
(4, 'Black Society', 'tmb49286150620140102-00-10-43.jpg', '1'),
(14, 'tgtgtgddddddddddd', '1400695518Meaningful-Beauty-Maintenance-Night-Cream-Cindy-Crawford-signature-cream.jpg', '1'),
(20, 'tvtvtv', '1400695345Medium_signal-128.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `userBanner`
--

CREATE TABLE IF NOT EXISTS `userBanner` (
  `bannerID` int(11) NOT NULL AUTO_INCREMENT,
  `bannerImg` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`bannerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `userBanner`
--

INSERT INTO `userBanner` (`bannerID`, `bannerImg`, `status`) VALUES
(1, 'add1.gif', '1'),
(2, 'add2.gif', '1'),
(3, 'add3.gif', '1'),
(4, 'add4.gif', '1');

-- --------------------------------------------------------

--
-- Table structure for table `userCountryCode`
--

CREATE TABLE IF NOT EXISTS `userCountryCode` (
  `ccID` int(11) NOT NULL AUTO_INCREMENT,
  `uID` int(11) NOT NULL,
  `countryCode` varchar(100) NOT NULL,
  PRIMARY KEY (`ccID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `userCountryCode`
--

INSERT INTO `userCountryCode` (`ccID`, `uID`, `countryCode`) VALUES
(1, 1000, 'Bangladesh'),
(2, 1001, 'Bahrain'),
(3, 1003, 'United States'),
(4, 1002, 'Afghanistan'),
(5, 1011, 'United Kingdom');

-- --------------------------------------------------------

--
-- Table structure for table `userInfo`
--

CREATE TABLE IF NOT EXISTS `userInfo` (
  `uID` bigint(20) NOT NULL AUTO_INCREMENT,
  `referarID` bigint(20) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `emailID` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `webUrl` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL DEFAULT 'member_img.png',
  `paypalAC` varchar(100) NOT NULL,
  `switchOnPayment` enum('0','1') NOT NULL DEFAULT '0',
  `tenDollerPayment` enum('0','1') NOT NULL DEFAULT '0',
  `afrooPaymentStatus` enum('1','0') NOT NULL DEFAULT '0',
  `membershipStatus` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`uID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1024 ;

--
-- Dumping data for table `userInfo`
--

INSERT INTO `userInfo` (`uID`, `referarID`, `firstName`, `lastName`, `userName`, `emailID`, `password`, `phone`, `gender`, `occupation`, `address`, `city`, `state`, `country`, `zip`, `webUrl`, `profile`, `paypalAC`, `switchOnPayment`, `tenDollerPayment`, `afrooPaymentStatus`, `membershipStatus`, `status`) VALUES
(999, 0, 'Angel ', 'Francis ', 'Angel ', 'otizfangel@googlemail.com', '123456', '1234567890', 'Male', 'Business', 'demo lane 1', 'London', 'London', 'United Kindom', 'Nj45', 'http://www.facebook.com/otizfangel', '1488035_425572574242162_670331311_n.jpg', 'paytestevika-facilitator@gmail.com', '0', '0', '1', 'MorpheusSociety', '1'),
(1000, 0, 'Otiz f', 'Angel', 'otiz', 'otizfangel@gmail.com', '123456', '1234567890', 'male', 'Business', 'demo lane 1', 'London', 'London', 'United Kindom', 'Nj45', 'http://www.facebook.com/otizfangel', 'Ranbir-Kapoor-17.jpg', 'paytestevika-facilitator@gmail.com', '0', '1', '1', 'BlackSociety', '1'),
(1001, 1000, 'Shatanik', 'Ghosh', 'sata', 'shatanikg@evikasystems.co.in', '123456', '9830028525', 'Male', '', '', 'Kolkata', '', 'India', '', '', '92051709_3.jpg', 'paypersonalevika@gmail.com', '0', '1', '1', 'BlackSociety', '1'),
(1002, 1001, 'Naren', 'Das', 'naren', 'narend@evika.co.in', '123456', '9836886162', 'Male', '', '', 'Kolkata', '', 'India', '', '', 'member_img.png', 'paypersonalevika@gmail.com', '0', '0', '0', 'BlackSociety', '1'),
(1003, 1002, 'Moloy', 'Mondal', 'Molly', 'moloym@evikasystems.co.in', '123456', '9831777674', 'Male', '', '', 'Kolkata', '', 'India', '', '', 'member_img.png', 'paypersonalevika@gmail.com', '0', '0', '0', 'BlackSociety', '1'),
(1004, 1003, 'Pintu', 'Naskar', 'Pintu', 'pintun@evikasystems.co.in', '123456', '9874761964', 'Male', '', '', 'Kolkata', '', 'India', '', '', 'member_img.png', 'paypersonalevika@gmail.com', '0', '0', '0', 'BlackSociety', '1'),
(1005, 1004, 'Swatilekha', 'Saha', 'swati', 'swatilekhas@evikasystems.co.in', '123456', '98300 98300', 'Female', '', '', 'Kolkata', '', 'India', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1006, 1005, 'Nabaruna', 'Sinha', 'Naba', 'nabarunas@evikasystems.co.in', '123456', '9830198301', 'Female', '', '', 'Kolkata', '', 'India', '', '', 'member_img.png', 'paypersonalevika@gmail.com', '0', '0', '0', 'BlackSociety', '1'),
(1007, 1006, 'Kollol', 'Biswas', 'kolu', 'kollolb@evikasystems.co.in', '123456', '9830298302', 'Male', '', '', 'Kolkata', '', 'India', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1008, 999, 'Siddhartha', 'Kar', 'sid', 'siddharthak@evikasystems.co.in', '123456', '9830098305', 'Male', '', '', 'Kolkata', '', 'India', '', '', 'member_img.png', '', '0', '0', '0', 'MorpheusSociety', '1'),
(1009, 1000, 'pritam', 'deb', 'pritam_deb', 'pritam25071992@gmail.com', '12345678', '8013686098', 'Male', '', '', 'kolkata', '', 'India', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1010, 1000, 'Swapan', 'Ghosh', 'Swapan', 'infoshatanik@gmail.com', '123456', '98300 98300', 'Male', '', '', 'kolkata', '', 'UK', '', '', 'member_img.png', '', '0', '0', '1', 'BlackSociety', '1'),
(1011, 1000, 'Jonathan', 'Hinds', 'JonoStar', 'Mrjahinds@AOL.co.uk', 'Arsenal13', '07466032702', 'Male', '', '', 'London', '', 'UK', '', '', '10262225_10152086414776254_1246035770155557677_n.jpg', 'Nokiaeye@hotmail.com', '0', '0', '0', 'BlackSociety', '1'),
(1012, 1000, 'Debra', 'Evans', 'Debra55Evans', 'debraevansRI@gmail.com', 'Ammie123', '2693647062', 'Female', '', '', 'Charlestown, Rhode Island', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1013, 1000, 'Vee', 'Wright-Moven', 'Vee', 'velmawright@hotmail.com', 'V3lm4W', '07729957216', 'Female', '', '', 'London', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1014, 1000, 'Roy', 'Jame', 'Working', 'datasheet.hiphop@gmail.com', 'Angelz777', '07875769', 'Male', '', '', 'London', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1015, 1000, 'Abdul Assis', 'Jatta', 'assisqo', 'assisqo1@gmail.com', 'Sweetima1', '+2207777151', 'Male', '', '', 'Portsmouths', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1016, 1000, 'YUSUPHA', 'JAMMEH', 'yusjam', 'yusjam40@hotmail.com', 'ykj021', '+2203100913 /6806767', 'Male', '', '', 'Banjul, the Gambia', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1017, 1000, 'musa', 'mendy', 'mmendy', 'mmendy01@hotmail.com', 'm4372697', '+2207717761', 'Male', '', '', 'Banjul', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1018, 1000, 'Ebrima S.', 'Dem', 'gamjobs.com', 'ebrimadem@gmail.com', 'connectingjobseekers', '+34652828525', 'Male', '', '', 'Barcelona', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1019, 1000, 'mams', 'manneh', 'mamsmanneh@yahoo.com', 'mamsmanneh@yahoo.com', 'abcdef', '2131029', 'Male', '', '', 'banjul', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1020, 1000, 'mams', 'manneh', 'mams', 'mamsmanneh1@yahoo.com', 'abcdef', '2131029', 'Male', '', '', 'banjul', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1021, 1000, 'mams', 'manneh', 'mams', 'mamsmanneh21@yahoo.com', 'abcdef', '2131029', 'Male', '', '', 'banjul', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1022, 1000, 'mams', 'manneh', 'mams manneh', 'mamsmanneh@GBE.com', 'abcdef', '2131029', 'Male', '', '', 'banjul', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1'),
(1023, 1000, 'mams', 'manneh', 'mamsmanneh', 'mamsmanneh100@yahoo.com', '2131029', '2131029', 'Male', '', '', 'banjul', '', 'UK', '', '', 'member_img.png', '', '0', '0', '0', 'BlackSociety', '1');

-- --------------------------------------------------------

--
-- Table structure for table `userTCPearl`
--

CREATE TABLE IF NOT EXISTS `userTCPearl` (
  `pearlID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `refID` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`pearlID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `userTCPearl`
--

INSERT INTO `userTCPearl` (`pearlID`, `UID`, `refID`, `code`) VALUES
(1, 1000, 0, 100285),
(2, 1001, 1000, 100286),
(3, 1003, 1002, 200200);

-- --------------------------------------------------------

--
-- Table structure for table `userTCSilver`
--

CREATE TABLE IF NOT EXISTS `userTCSilver` (
  `silverID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `refID` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`silverID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `userTCSilver`
--

INSERT INTO `userTCSilver` (`silverID`, `UID`, `refID`, `code`) VALUES
(1, 1000, 0, 100291),
(2, 1001, 1000, 100292),
(3, 1003, 1002, 300300);

-- --------------------------------------------------------

--
-- Table structure for table `userYouTube`
--

CREATE TABLE IF NOT EXISTS `userYouTube` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `youtubeName` varchar(100) NOT NULL,
  `youtubeUrl` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `userYouTube`
--

INSERT INTO `userYouTube` (`id`, `youtubeName`, `youtubeUrl`, `status`) VALUES
(1, 'Title 1 ', 'http://www.youtube.com/embed/rneECZ94E4U', '1'),
(2, 'Title 2', '//www.youtube.com/embed/qOcM-L-Ss1o', '1'),
(3, 'Title 3', '//www.youtube.com/embed/FfnQemkjPjM', '1'),
(4, 'Title 4', '//www.youtube.com/embed/KP6LBYoqBl0', '1'),
(5, 'Title 5 ', '//www.youtube.com/embed/09zOOveEVew', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vendorsList`
--

CREATE TABLE IF NOT EXISTS `vendorsList` (
  `vendorsID` int(11) NOT NULL AUTO_INCREMENT,
  `vendorName` varchar(200) NOT NULL,
  `vendorNo` varchar(20) NOT NULL,
  `vendorAddr` varchar(500) NOT NULL,
  `vendorCity` varchar(100) NOT NULL,
  `vendorCountry` varchar(100) NOT NULL,
  `vendorZip` varchar(100) NOT NULL,
  `vendorEmail` varchar(100) NOT NULL,
  `vendorWebsite` varchar(200) NOT NULL,
  PRIMARY KEY (`vendorsID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `vendorsList`
--

INSERT INTO `vendorsList` (`vendorsID`, `vendorName`, `vendorNo`, `vendorAddr`, `vendorCity`, `vendorCountry`, `vendorZip`, `vendorEmail`, `vendorWebsite`) VALUES
(1, 'Vendor A', '9830028525', '34b roy bahadur Road,ps- Behala , kolkata', 'kolkata', 'india', '700034', 'infoshatanik@gmail.com', 'http://google.com'),
(2, 'Vendor B', '9830028526', '34 c roy bahadur road,p.s-behala,kolkata', 'Delhi', 'india', '1234567', 'wbnaren@gmail.com', 'http://google.com'),
(3, 'kjgfjgf', ';ugl;iyf', ';oug;liyf;.k', 'tflff.v', ',jfyligk', 'ljyf.f.', 'yflyf', 'yf;iyg;g'),
(4, 'ofl;ugb/', 'lfjvk/jb', 'lcjv.kjb/bn', 'utflkug;k', 'utf;khl', 'kjvk,', 'ktcv;k.jb', ',gc,vj,'),
(5, 'jdhflv,kjb.', 'khjv.', 'kjy.k', 'ktfk.', 'hkfcgvh.b', 'khcgv.jb', 'kjtflk.b', 'kuyflk'),
(6, 'Test', 'klglkhb', 'jglv.kv', 'kt,jvh', 'hkgc,', 'hkflj', 'kjv', 'hfc,'),
(7, 'Test1', 'Test1', 'Test1', 'Test1', 'Test1', 'Test1', 'Test1', 'Test1'),
(8, 'Vname', 'vnum', 'vad1', 'Vcity', 'vcountry', 'vzip', 'vemail.com', 'vebsite');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
