-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2026 at 04:32 PM
-- Server version: 10.5.29-MariaDB
-- PHP Version: 8.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CultureConnectProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `businessIdPk` int(13) NOT NULL,
  `businessName` varchar(200) NOT NULL,
  `businessDescription` varchar(200) DEFAULT NULL,
  `businessEmail` varchar(200) DEFAULT NULL,
  `businessPhone` varchar(13) DEFAULT NULL,
  `businessLink` varchar(200) DEFAULT NULL,
  `councilIdPk` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `council`
--

CREATE TABLE `council` (
  `councilIdPk` int(13) NOT NULL,
  `councilName` varchar(200) NOT NULL,
  `councilContact` varchar(200) DEFAULT NULL,
  `councilLink` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `council`
--

INSERT INTO `council` (`councilIdPk`, `councilName`, `councilContact`, `councilLink`) VALUES
(1, 'Broxbourne Borough Council', 'https://www.broxbourne.gov.uk/contact-us', 'https://www.broxbourne.gov.uk'),
(2, 'Dacorum Borough Council', 'https://www.dacorum.gov.uk/home/do-it-online/contact-us', 'https://www.dacorum.gov.uk'),
(3, 'East Hertfordshire District Council', 'https://www.eastherts.gov.uk/contactus', 'https://www.eastherts.gov.uk'),
(4, 'Hertsmere Borough Council', 'https://www.hertsmere.gov.uk/contact-us', 'https://www.hertsmere.gov.uk'),
(5, 'North Hertfordshire District Council', 'https://www.north-herts.gov.uk/contact-us', 'https://www.north-herts.gov.uk'),
(6, 'St Albans City and District Council', 'https://www.stalbans.gov.uk/contact-us', 'https://www.stalbans.gov.uk'),
(7, 'Stevenage Borough Council', 'https://www.stevenage.gov.uk/contact-us', 'https://www.stevenage.gov.uk'),
(8, 'Three Rivers District Council', 'https://www.threerivers.gov.uk/contact-us', 'https://www.threerivers.gov.uk'),
(9, 'Watford Borough Council', 'https://watfordbc-self.achieveservice.com/service/General_Enquiry', 'https://www.watford.gov.uk'),
(10, 'Welwyn and Hatfield', 'https://www.welhat.gov.uk/contact', 'https://www.welhat.gov.uk/');

-- --------------------------------------------------------

--
-- Table structure for table `interestArea`
--

CREATE TABLE `interestArea` (
  `interestAreaIdPk` int(13) NOT NULL,
  `interestAreaName` varchar(200) NOT NULL,
  `InterestAreaProductOrService` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `interestArea`
--

INSERT INTO `interestArea` (`interestAreaIdPk`, `interestAreaName`, `InterestAreaProductOrService`) VALUES
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

CREATE TABLE `location` (
  `locationIdPk` int(13) NOT NULL,
  `locationName` varchar(200) NOT NULL,
  `councilIdPk` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationIdPk`, `locationName`, `councilIdPk`) VALUES
(1, 'Welwyn Garden City', 10),
(2, 'Hatfield', 10),
(3, 'Welham Green', 10),
(4, 'Brookmans Park', 10),
(5, 'Hitchin', 5),
(6, 'Letchworth Garden City', 5),
(7, 'Baldock', 5),
(8, 'Royston', 5),
(17, 'Knebworth', 5),
(18, 'Welwyn Village', 10),
(21, 'Stevenage', 7);

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

CREATE TABLE `offering` (
  `offeringIdPk` int(13) NOT NULL,
  `offeringName` varchar(200) NOT NULL,
  `offeringDescription` varchar(200) DEFAULT NULL,
  `offeringCulturalBenefits` varchar(200) DEFAULT NULL,
  `offeringPriceRange` int(13) NOT NULL,
  `offeringCategory` int(13) NOT NULL,
  `locationIdPk` int(13) NOT NULL,
  `businessIdPk` int(13) NOT NULL,
  `offeringDetails` varchar(255) DEFAULT NULL,
  `offeringAwards` varchar(100) NOT NULL DEFAULT 'None',
  `offeringImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `offeringPricing`
--

CREATE TABLE `offeringPricing` (
  `offeringPriceRange` int(13) NOT NULL,
  `offeringPriceRangeDescription` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `offeringPricing`
--

INSERT INTO `offeringPricing` (`offeringPriceRange`, `offeringPriceRangeDescription`) VALUES
(1, 'Affordable (less than £50)'),
(2, 'Moderate (£50-£200)'),
(3, 'Premium (more than £200)');

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `residentIdPk` int(13) NOT NULL,
  `residentGender` varchar(20) NOT NULL,
  `residentBirthYear` int(4) NOT NULL,
  `locationIdPk` int(13) NOT NULL,
  `userIdPk` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`residentIdPk`, `residentGender`, `residentBirthYear`, `locationIdPk`, `userIdPk`) VALUES
(3, 'Male', 1998, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `residentInterests`
--

CREATE TABLE `residentInterests` (
  `residentInterestIdPk` int(13) NOT NULL,
  `residentIdPk` int(13) NOT NULL,
  `interestAreaIdPk` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `residentInterests`
--

INSERT INTO `residentInterests` (`residentInterestIdPk`, `residentIdPk`, `interestAreaIdPk`) VALUES
(1, 3, 2),
(2, 3, 3),
(3, 3, 6),
(4, 3, 14),
(5, 3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userIdPk` int(13) NOT NULL,
  `userFirstName` varchar(200) NOT NULL,
  `userLastName` varchar(200) NOT NULL,
  `userEmail` varchar(200) NOT NULL,
  `userPassword` varchar(200) NOT NULL,
  `userTitle` varchar(200) NOT NULL,
  `userRole` int(13) NOT NULL,
  `roleId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userIdPk`, `userFirstName`, `userLastName`, `userEmail`, `userPassword`, `userTitle`, `userRole`, `roleId`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '1234', '', 4, 0),
(2, 'ResidentUserFirstName', 'resident', 'user@user.com', '1234', '', 1, 3),
(3, 'BusinessUserFirstName', 'business', 'bus@bus.com', '1234', 'Mrs', 2, 1),
(4, 'CouncilUserFirstName', 'council', 'counc@counc.com', '1234', '', 3, 10);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_locations`
-- (See below for the actual view)
--
CREATE TABLE `view_locations` (
`locationIdPk` int(13)
,`locationName` varchar(200)
,`councilName` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_offerings`
-- (See below for the actual view)
--
CREATE TABLE `view_offerings` (
`offeringIdPk` int(13)
,`businessName` varchar(200)
,`offeringName` varchar(200)
,`interestAreaName` varchar(200)
,`locationName` varchar(200)
,`offeringDescription` varchar(200)
,`offeringDetails` varchar(255)
,`offeringCulturalBenefits` varchar(200)
,`offeringAwards` varchar(100)
,`offeringImage` varchar(255)
,`offeringPriceRangeDescription` varchar(200)
,`yesVotes` decimal(23,0)
,`noVotes` decimal(23,0)
,`displayVotes` decimal(24,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `voteIdPk` int(13) NOT NULL,
  `offeringIdPk` int(13) NOT NULL,
  `residentIdPk` int(13) NOT NULL,
  `vote` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`businessIdPk`),
  ADD KEY `councilIdPk` (`councilIdPk`);

--
-- Indexes for table `council`
--
ALTER TABLE `council`
  ADD PRIMARY KEY (`councilIdPk`);

--
-- Indexes for table `interestArea`
--
ALTER TABLE `interestArea`
  ADD PRIMARY KEY (`interestAreaIdPk`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationIdPk`),
  ADD KEY `councilIdPk` (`councilIdPk`);

--
-- Indexes for table `offering`
--
ALTER TABLE `offering`
  ADD PRIMARY KEY (`offeringIdPk`),
  ADD UNIQUE KEY `uniqueOfferingPerBusiness` (`offeringName`,`businessIdPk`),
  ADD KEY `businessIdPk` (`businessIdPk`),
  ADD KEY `locationIdPk` (`locationIdPk`),
  ADD KEY `offeringPriceRange` (`offeringPriceRange`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`residentIdPk`),
  ADD KEY `locationIdPk` (`locationIdPk`),
  ADD KEY `userIdPk` (`userIdPk`);

--
-- Indexes for table `residentInterests`
--
ALTER TABLE `residentInterests`
  ADD PRIMARY KEY (`residentInterestIdPk`),
  ADD KEY `interestAreaIdPk` (`interestAreaIdPk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userIdPk`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`voteIdPk`),
  ADD KEY `offeringIdPk` (`offeringIdPk`),
  ADD KEY `residentIdPk` (`residentIdPk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `businessIdPk` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `council`
--
ALTER TABLE `council`
  MODIFY `councilIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `interestArea`
--
ALTER TABLE `interestArea`
  MODIFY `interestAreaIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `offering`
--
ALTER TABLE `offering`
  MODIFY `offeringIdPk` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `residentIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `residentInterests`
--
ALTER TABLE `residentInterests`
  MODIFY `residentInterestIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `voteIdPk` int(13) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Structure for view `view_locations`
--
DROP TABLE IF EXISTS `view_locations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_locations`  AS SELECT `l`.`locationIdPk` AS `locationIdPk`, `l`.`locationName` AS `locationName`, `c`.`councilName` AS `councilName` FROM (`location` `l` join `council` `c`) WHERE `l`.`councilIdPk` = `c`.`councilIdPk` ORDER BY 3 ASC, 2 ASC ;

-- --------------------------------------------------------

--
-- Structure for view `view_offerings`
--
DROP TABLE IF EXISTS `view_offerings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_offerings`  AS SELECT `o`.`offeringIdPk` AS `offeringIdPk`, `b`.`businessName` AS `businessName`, `o`.`offeringName` AS `offeringName`, `i`.`interestAreaName` AS `interestAreaName`, `l`.`locationName` AS `locationName`, `o`.`offeringDescription` AS `offeringDescription`, `o`.`offeringDetails` AS `offeringDetails`, `o`.`offeringCulturalBenefits` AS `offeringCulturalBenefits`, `o`.`offeringAwards` AS `offeringAwards`, `o`.`offeringImage` AS `offeringImage`, `op`.`offeringPriceRangeDescription` AS `offeringPriceRangeDescription`, sum(`v`.`vote` = 1) AS `yesVotes`, sum(`v`.`vote` = 0) AS `noVotes`, sum(`v`.`vote` = 1) - sum(`v`.`vote` = 0) AS `displayVotes` FROM (((((`offering` `o` join `business` `b` on(`o`.`businessIdPk` = `b`.`businessIdPk`)) join `interestArea` `i` on(`o`.`offeringCategory` = `i`.`interestAreaIdPk`)) join `location` `l` on(`o`.`locationIdPk` = `l`.`locationIdPk`)) join `offeringPricing` `op` on(`o`.`offeringPriceRange` = `op`.`offeringPriceRange`)) left join `vote` `v` on(`v`.`offeringIdPk` = `o`.`offeringIdPk`)) GROUP BY `o`.`offeringIdPk`, `b`.`businessName`, `o`.`offeringName`, `i`.`interestAreaName`, `l`.`locationName`, `o`.`offeringDescription`, `o`.`offeringDetails`, `o`.`offeringCulturalBenefits`, `o`.`offeringAwards`, `o`.`offeringImage`, `op`.`offeringPriceRangeDescription` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_ibfk_1` FOREIGN KEY (`councilIdPk`) REFERENCES `council` (`councilIdPk`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`councilIdPk`) REFERENCES `council` (`councilIdPk`);

--
-- Constraints for table `offering`
--
ALTER TABLE `offering`
  ADD CONSTRAINT `offering_ibfk_1` FOREIGN KEY (`businessIdPk`) REFERENCES `business` (`businessIdPk`),
  ADD CONSTRAINT `offering_ibfk_2` FOREIGN KEY (`locationIdPk`) REFERENCES `location` (`locationIdPk`),
  ADD CONSTRAINT `offering_ibfk_3` FOREIGN KEY (`offeringPriceRange`) REFERENCES `offering` (`offeringIdPk`);

--
-- Constraints for table `resident`
--
ALTER TABLE `resident`
  ADD CONSTRAINT `resident_ibfk_1` FOREIGN KEY (`locationIdPk`) REFERENCES `location` (`locationIdPk`);

--
-- Constraints for table `residentInterests`
--
ALTER TABLE `residentInterests`
  ADD CONSTRAINT `residentInterests_ibfk_1` FOREIGN KEY (`interestAreaIdPk`) REFERENCES `interestArea` (`interestAreaIdPk`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`offeringIdPk`) REFERENCES `offering` (`offeringIdPk`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`residentIdPk`) REFERENCES `resident` (`residentIdPk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
