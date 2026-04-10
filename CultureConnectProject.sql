-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2026 at 10:54 AM
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
  `businessEmail` varchar(200) NOT NULL,
  `businessPhone` int(13) DEFAULT NULL,
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
  `councilContact` varchar(200) NOT NULL,
  `councilLink` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `interestArea`
--

CREATE TABLE `interestArea` (
  `interestAreaIdPk` int(13) NOT NULL,
  `interestAreaName` varchar(200) NOT NULL,
  `InterestAreaProductOrService` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationIdPk` int(13) NOT NULL,
  `locationName` varchar(200) NOT NULL,
  `councilIdPk` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `businessIdPk` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `offeringPricing`
--

CREATE TABLE `offeringPricing` (
  `offeringPriceRange` int(13) NOT NULL,
  `offeringPriceRangeDescription` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- Table structure for table `residentInterests`
--

CREATE TABLE `residentInterests` (
  `residentInterestIdPk` int(13) NOT NULL,
  `residentIdPk` int(13) NOT NULL,
  `interestAreaIdPk` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `userRole` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  ADD CONSTRAINT `resident_ibfk_1` FOREIGN KEY (`locationIdPk`) REFERENCES `location` (`locationIdPk`),
  ADD CONSTRAINT `resident_ibfk_2` FOREIGN KEY (`userIdPk`) REFERENCES `user` (`userIdPk`);

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
