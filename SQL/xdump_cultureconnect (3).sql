-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2026 at 08:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cultureconnect`
--
CREATE DATABASE IF NOT EXISTS `cultureconnect` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cultureconnect`;

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
CREATE TABLE `business` (
  `bus_id_pk` int(11) NOT NULL,
  `bus_name` varchar(100) NOT NULL,
  `counc_id_pk` int(11) NOT NULL,
  `bus_phone` varchar(20) DEFAULT NULL,
  `bus_email` varchar(50) DEFAULT NULL,
  `bus_url` varchar(100) DEFAULT NULL,
  `bus_bio` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`bus_id_pk`, `bus_name`, `counc_id_pk`, `bus_phone`, `bus_email`, `bus_url`, `bus_bio`) VALUES
(1, 'Monica\'s Mugs', 10, '07457 123456', 'contact@monsmugs.co.uk', 'monsmugs.co.uk', 'Monica\'s Mugs is a small business based in Hatfield. We create handcrafted stoneware inspired by the countryside around Hatfield.'),
(2, 'British Schools Museum', 5, '(01462) 420144', 'enquiries@britishschoolsmuseum.org.uk', 'https://britishschoolsmuseum.org.uk/', 'Discover the fascinating story of education through the ages at the British Schools Museum in Hitchin. Housed in a remarkable Grade II* listed building dating back to 1837, the museum is home to the w'),
(3, 'MyBusiness', 10, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `council`
--

DROP TABLE IF EXISTS `council`;
CREATE TABLE `council` (
  `counc_id_pk` int(11) NOT NULL,
  `counc_name` varchar(100) NOT NULL,
  `counc_url` varchar(100) DEFAULT NULL,
  `counc_contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `council`
--

INSERT INTO `council` (`counc_id_pk`, `counc_name`, `counc_url`, `counc_contact`) VALUES
(1, 'Broxbourne Borough Council', 'https://www.broxbourne.gov.uk', 'https://www.broxbourne.gov.uk/contact-us'),
(2, 'Dacorum Borough Council', 'https://www.dacorum.gov.uk', 'https://www.dacorum.gov.uk/home/do-it-online/contact-us'),
(3, 'East Hertfordshire District Council', 'https://www.eastherts.gov.uk', 'https://www.eastherts.gov.uk/contactus'),
(4, 'Hertsmere Borough Council', 'https://www.hertsmere.gov.uk', 'https://www.hertsmere.gov.uk/contact-us'),
(5, 'North Hertfordshire District Council', 'https://www.north-herts.gov.uk', 'https://www.north-herts.gov.uk/contact-us'),
(6, 'St Albans City and District Council', 'https://www.stalbans.gov.uk', 'https://www.stalbans.gov.uk/contact-us'),
(7, 'Stevenage Borough Council', 'https://www.stevenage.gov.uk', 'https://www.stevenage.gov.uk/contact-us'),
(8, 'Three Rivers District Council', 'https://www.threerivers.gov.uk', 'https://www.threerivers.gov.uk/contact-us'),
(9, 'Watford Borough Council', 'https://www.watford.gov.uk', 'https://watfordbc-self.achieveservice.com/service/General_Enquiry'),
(10, 'Welwyn and Hatfield', 'https://www.welhat.gov.uk/', 'https://www.welhat.gov.uk/contact');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
CREATE TABLE `interests` (
  `int_id_pk` int(11) NOT NULL,
  `int_name` varchar(100) NOT NULL,
  `int_product_or_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`int_id_pk`, `int_name`, `int_product_or_service`) VALUES
(1, 'Art classes', 2),
(2, 'Music lessons', 2),
(3, 'Live theatre performances', 2),
(4, 'Concerts', 2),
(5, 'Open mic nights', 2),
(6, 'Guided cultural tours', 2),
(7, 'Museum visits', 2),
(8, 'Gallery visits', 2),
(9, 'Photography services', 2),
(10, 'Videography services', 2),
(11, 'Graphic design', 2),
(12, 'Digital design', 2),
(13, 'Original artwork', 1),
(14, 'Handmade ceramics', 1),
(15, 'Independent books', 1),
(16, 'Local zines and magazines', 1),
(17, 'Limited edition posters', 1),
(18, 'Artisan stationery', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `loc_id_pk` int(11) NOT NULL,
  `loc_name` varchar(100) NOT NULL,
  `counc_id_pk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id_pk`, `loc_name`, `counc_id_pk`) VALUES
(1, 'Welwyn Garden City', 10),
(2, 'Hatfield', 10),
(3, 'Welham Green', 10),
(4, 'Brookmans Park', 10),
(5, 'Hitchin', 5),
(6, 'Letchworth Garden City', 5),
(7, 'Baldock', 5),
(8, 'Royston', 5);

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

DROP TABLE IF EXISTS `offering`;
CREATE TABLE `offering` (
  `of_id_pk` int(11) NOT NULL,
  `bus_id_pk` int(11) NOT NULL,
  `loc_id_pk` int(11) NOT NULL,
  `of_name` varchar(150) NOT NULL,
  `of_category` int(11) NOT NULL,
  `of_description` varchar(100) DEFAULT NULL,
  `of_details` varchar(100) DEFAULT NULL,
  `of_cultural_benefits` varchar(100) DEFAULT NULL,
  `of_price_range` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offering`
--

INSERT INTO `offering` (`of_id_pk`, `bus_id_pk`, `loc_id_pk`, `of_name`, `of_category`, `of_description`, `of_details`, `of_cultural_benefits`, `of_price_range`) VALUES
(1, 1, 2, 'Beautiful handmade ceramics', 14, '????', 'Mugs - £15 each\r\nPlates - £10 each\r\n', 'We are keeping traditional ceramics alive by staying true to the centuries old methods of ????', 1),
(4, 1, 5, 'Test1', 4, 'dfsa', 'sadfsa', 'dasf', 2),
(7, 1, 5, 'fghbsd', 6, 'dsfgsad', 'dfsas', 'dfsa', 3);

-- --------------------------------------------------------

--
-- Table structure for table `offering_prices`
--

DROP TABLE IF EXISTS `offering_prices`;
CREATE TABLE `offering_prices` (
  `of_price_range` int(11) NOT NULL,
  `of_price_range_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offering_prices`
--

INSERT INTO `offering_prices` (`of_price_range`, `of_price_range_description`) VALUES
(1, 'Affordable (less than £50)'),
(2, 'Moderate (£50-£200)'),
(3, 'Premium (more than £200)');

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

DROP TABLE IF EXISTS `resident`;
CREATE TABLE `resident` (
  `res_id_pk` int(11) NOT NULL,
  `user_id_pk` int(11) NOT NULL,
  `loc_id_pk` int(11) NOT NULL,
  `res_yob` int(11) NOT NULL,
  `res_gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`res_id_pk`, `user_id_pk`, `loc_id_pk`, `res_yob`, `res_gender`) VALUES
(4, 2, 2, 1929, 'Female'),
(5, 3, 5, 1935, 'Prefer not'),
(6, 4, 2, 1930, 'Female'),
(7, 5, 2, 1994, 'Female'),
(9, 7, 3, 1928, 'Female'),
(10, 8, 1, 0, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `resident_interests`
--

DROP TABLE IF EXISTS `resident_interests`;
CREATE TABLE `resident_interests` (
  `ri_id_pk` int(11) NOT NULL,
  `res_id_pk` int(11) NOT NULL,
  `int_id_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident_interests`
--

INSERT INTO `resident_interests` (`ri_id_pk`, `res_id_pk`, `int_id_pk`) VALUES
(1, 4, 2),
(2, 4, 5),
(3, 4, 14),
(4, 5, 2),
(5, 5, 5),
(6, 5, 8),
(7, 6, 2),
(8, 6, 5),
(9, 6, 8),
(10, 7, 3),
(11, 7, 6),
(12, 7, 9),
(13, 7, 14),
(14, 9, 2),
(15, 9, 5),
(16, 9, 13),
(17, 9, 14),
(18, 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id_pk` int(11) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_title` varchar(20) DEFAULT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id_pk`, `user_email`, `user_title`, `user_first_name`, `user_last_name`, `user_password`, `user_role`, `role_id`) VALUES
(2, 'kk.smed2@pm.me', '', 'Cat', 'Mort', 'dsafas', 1, 4),
(3, 'ff@c.d', 'Mx', 'ff', 'ff', 'ff', 1, 5),
(4, 'testy@test.com', '', 'cat', 'mortimer', '1234', 1, 6),
(5, 'testy@test1.com', '', 'Cat', 'mortimer', '1234', 1, 7),
(6, 'ff@d.com', '', 'Cat', 'Mort', '1234', 2, 3),
(7, 'testy@test2.com', '', 'Cat', 'Mort', '564645', 1, 9),
(8, 'asfd@b.c', '', 'afsd', 'dfsa', 'fgd', 1, 10);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_offerings`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_offerings`;
CREATE TABLE `view_offerings` (
`of_id_pk` int(11)
,`bus_name` varchar(100)
,`of_name` varchar(150)
,`int_name` varchar(100)
,`loc_name` varchar(100)
,`of_description` varchar(100)
,`of_details` varchar(100)
,`of_cultural_benefits` varchar(100)
,`of_price_range_description` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `view_offerings`
--
DROP TABLE IF EXISTS `view_offerings`;

DROP VIEW IF EXISTS `view_offerings`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_offerings`  AS SELECT `o`.`of_id_pk` AS `of_id_pk`, `b`.`bus_name` AS `bus_name`, `o`.`of_name` AS `of_name`, `i`.`int_name` AS `int_name`, `l`.`loc_name` AS `loc_name`, `o`.`of_description` AS `of_description`, `o`.`of_details` AS `of_details`, `o`.`of_cultural_benefits` AS `of_cultural_benefits`, `op`.`of_price_range_description` AS `of_price_range_description` FROM ((((`offering` `o` join `business` `b`) join `interests` `i`) join `location` `l`) join `offering_prices` `op`) WHERE `o`.`of_price_range` = `op`.`of_price_range` AND `o`.`bus_id_pk` = `b`.`bus_id_pk` AND `o`.`loc_id_pk` = `l`.`loc_id_pk` AND `o`.`of_category` = `i`.`int_id_pk` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`bus_id_pk`),
  ADD KEY `counc_id_pk` (`counc_id_pk`);

--
-- Indexes for table `council`
--
ALTER TABLE `council`
  ADD PRIMARY KEY (`counc_id_pk`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`int_id_pk`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`loc_id_pk`),
  ADD KEY `counc_id_pk` (`counc_id_pk`);

--
-- Indexes for table `offering`
--
ALTER TABLE `offering`
  ADD PRIMARY KEY (`of_id_pk`),
  ADD KEY `bus_id_pk` (`bus_id_pk`),
  ADD KEY `loc_id_pk` (`loc_id_pk`),
  ADD KEY `of_category` (`of_category`),
  ADD KEY `of_price_range` (`of_price_range`);

--
-- Indexes for table `offering_prices`
--
ALTER TABLE `offering_prices`
  ADD PRIMARY KEY (`of_price_range`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`res_id_pk`),
  ADD KEY `user_id_pk` (`user_id_pk`),
  ADD KEY `loc_id_pk` (`loc_id_pk`);

--
-- Indexes for table `resident_interests`
--
ALTER TABLE `resident_interests`
  ADD PRIMARY KEY (`ri_id_pk`),
  ADD KEY `res_id_pk` (`res_id_pk`),
  ADD KEY `int_id_pk` (`int_id_pk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id_pk`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `bus_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `council`
--
ALTER TABLE `council`
  MODIFY `counc_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `int_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `loc_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `offering`
--
ALTER TABLE `offering`
  MODIFY `of_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `offering_prices`
--
ALTER TABLE `offering_prices`
  MODIFY `of_price_range` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `res_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `resident_interests`
--
ALTER TABLE `resident_interests`
  MODIFY `ri_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_ibfk_1` FOREIGN KEY (`counc_id_pk`) REFERENCES `council` (`counc_id_pk`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`counc_id_pk`) REFERENCES `council` (`counc_id_pk`);

--
-- Constraints for table `offering`
--
ALTER TABLE `offering`
  ADD CONSTRAINT `offering_ibfk_1` FOREIGN KEY (`bus_id_pk`) REFERENCES `business` (`bus_id_pk`),
  ADD CONSTRAINT `offering_ibfk_2` FOREIGN KEY (`loc_id_pk`) REFERENCES `location` (`loc_id_pk`),
  ADD CONSTRAINT `offering_ibfk_3` FOREIGN KEY (`of_category`) REFERENCES `interests` (`int_id_pk`),
  ADD CONSTRAINT `offering_ibfk_4` FOREIGN KEY (`of_price_range`) REFERENCES `offering_prices` (`of_price_range`);

--
-- Constraints for table `resident`
--
ALTER TABLE `resident`
  ADD CONSTRAINT `resident_ibfk_1` FOREIGN KEY (`user_id_pk`) REFERENCES `user` (`user_id_pk`),
  ADD CONSTRAINT `resident_ibfk_2` FOREIGN KEY (`loc_id_pk`) REFERENCES `location` (`loc_id_pk`);

--
-- Constraints for table `resident_interests`
--
ALTER TABLE `resident_interests`
  ADD CONSTRAINT `resident_interests_ibfk_1` FOREIGN KEY (`res_id_pk`) REFERENCES `resident` (`res_id_pk`),
  ADD CONSTRAINT `resident_interests_ibfk_2` FOREIGN KEY (`int_id_pk`) REFERENCES `interests` (`int_id_pk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
