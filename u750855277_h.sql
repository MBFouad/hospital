
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- المزود: localhost
-- أنشئ في: 12 ديسمبر 2015 الساعة 02:13
-- إصدارة المزود: 5.1.61
-- PHP إصدارة: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- قاعدة البيانات: `u750855277_h`
--

-- --------------------------------------------------------

--
-- بنية الجدول `booking_doctor`
--

CREATE TABLE IF NOT EXISTS `booking_doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `booking_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `Customer_id` (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- إرجاع أو استيراد بيانات الجدول `booking_doctor`
--

INSERT INTO `booking_doctor` (`id`, `doctor_id`, `customer_id`, `date`, `booking_number`) VALUES
(1, 4, 9, '2015-10-27', 1),
(2, 4, 9, '2015-10-27', 2),
(3, 2, 9, '2015-10-29', 1),
(4, 2, 9, '2015-10-29', 2);

-- --------------------------------------------------------

--
-- بنية الجدول `doctor_schedule`
--

CREATE TABLE IF NOT EXISTS `doctor_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `saturday` varchar(20) NOT NULL,
  `sunday` varchar(20) NOT NULL,
  `monday` varchar(20) NOT NULL,
  `tuesday` varchar(20) NOT NULL,
  `wednesday` varchar(20) NOT NULL,
  `thursday` varchar(20) NOT NULL,
  `friday` varchar(20) NOT NULL,
  `specialty_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `specialty_id` (`specialty_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- إرجاع أو استيراد بيانات الجدول `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`id`, `user_id`, `saturday`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `specialty_id`) VALUES
(2, 2, '5pm:9pm', '7pm:8pm', '6pm:9pm', '3pm:5pm', '2pm:36pm', '3pm:4pm', '4pm:5pm', 1),
(3, 4, '1pm:3pm', '5pm:7pm', '11am:4pm', '8am:11am', '9pm:11pm', '4pm:10pm', '1pm:7pm', 11),
(4, 8, '1am:5am', '1am:5am', '5pm:9pm', '3pm:8pm', '2pm:7pm', '11am:4pm', '7pm:11pm', 7),
(5, 10, '1pm:6pm', '7am:11am', '8am:3pm', '5pm:11pm', '4pm:10pm', '3pm:9pm', '3pm:pm', 6);

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(250) NOT NULL,
  `product_price` double NOT NULL,
  `product_description` text NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_description`) VALUES
(1, 'Rays X', 100, 'Rays for some Part in Body'),
(2, 'Complete Blood Count', 80, ''),
(3, 'Erythrocyte Sedimentation Rate', 70, ''),
(5, 'Bleeding Time', 30, '');

-- --------------------------------------------------------

--
-- بنية الجدول `specialty`
--

CREATE TABLE IF NOT EXISTS `specialty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specialty_type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- إرجاع أو استيراد بيانات الجدول `specialty`
--

INSERT INTO `specialty` (`id`, `specialty_type`) VALUES
(1, 'Orthopedics'),
(2, 'Vascular'),
(3, 'Cardiothoracic'),
(4, 'Reconstructive'),
(5, 'Oncology'),
(6, 'Neurosurgery'),
(7, 'Anesthesiology & Recovery'),
(8, 'Oncology'),
(9, 'Hematology'),
(10, 'Cardiology'),
(11, 'Rehabilitation Rheumatology'),
(12, 'Pulmonology');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `first_name` varchar(120) NOT NULL,
  `last_name` varchar(120) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `other_details` text NOT NULL,
  `user_type` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_type` (`user_type`),
  KEY `user_type_2` (`user_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `middle_name`, `gender`, `phone_number`, `street`, `city`, `zip_code`, `country`, `other_details`, `user_type`, `active`) VALUES
(1, 'bahaa', 'fbcc4037a97115849a1bd5f5e2529428b539cae3', 'eng.m.bahaa.el.dien@gmail.com', 'bahaa', 'mohamed', 'el-dien', 0, '234234', 'addasd', '', '', '', '', 3, 1),
(2, 'hghgghhg', 'hghghg', 'hghggh', 'Ayman', 'Omar', 'Mohamed', 0, 'ghghghghgh', '', '', '', '', '                ', 2, 1),
(4, 'sss', '85a12e6849725369722ceebce2c904eabe016e20', 'hghggh', 'Ali', 'Mohamed', 'Frg', 0, 'ghghghghgh', '', '', '', '', '                ', 2, 1),
(5, 'hjhjhj', 'e95d45f95e710484b2a79c82e2f59715401e364a', 'hjhjhj', 'dasd', 'hjhjhj', 'hjhjhj', 0, 'hjhjhj', '', '', '', '', '                ', 1, 1),
(6, 'jkjkjk', '0f8950ef42b100fa74070f4302963ad4a043808d', 'jkjkjk', 'dasdas', 'kjkkj', 'jkjkjk', 0, 'jkfdsjkfjks', '', '', '', '', '                ', 1, 1),
(7, 's', '0f8950ef42b100fa74070f4302963ad4a043808d', 'dasd', 'dasdas', 'kjkkj', 'jkjkjk', 0, 'jkfdsjkfjks', '', '', '', '', '                ', 1, 1),
(8, 'bahaa2', 'fbcc4037a97115849a1bd5f5e2529428b539cae3', 'cascsc', 'Mohamed', ' El-Dien', 'Bahaa', 0, 'dasdasdas', '', '', '', '', '                ', 2, 1),
(9, 'bahaa22', 'fbcc4037a97115849a1bd5f5e2529428b539cae3', 'sdfsdf', 'bahaa2', 'fhgf', 'sgsfs', 0, 'fsdfsdfsfs', '', '', '', '', '                ', 1, 1),
(10, 'bahaahkhjk', 'fbcc4037a97115849a1bd5f5e2529428b539cae3', 'dsfsf', 'Sameh', 'El-shal', 'Mohamed', 0, 'sdfsdf', '', '', '', '', '                ', 2, 1),
(11, 'omda', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'semsm_e@yahoo.com', 'omda', 'hamdy', 'sas', 0, '01220675179', 'berket el sabhe', 'manf', '', '', '                ', 1, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `users_type`
--

CREATE TABLE IF NOT EXISTS `users_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_type` (`user_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- إرجاع أو استيراد بيانات الجدول `users_type`
--

INSERT INTO `users_type` (`id`, `user_type`) VALUES
(3, 'ADMIN'),
(2, 'DOCTOR'),
(1, 'USER');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
