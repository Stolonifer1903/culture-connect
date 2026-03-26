-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2026 at 09:03 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

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
(1, 1, 2, 'Beautiful handmade ceramics', 14, '????', 'Mugs - £15 each\r\nPlates - £10 each\r\n', 'We are keeping traditional ceramics alive by staying true to the centuries old methods of ????', 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offering`
--
ALTER TABLE `offering`
  MODIFY `of_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offering`
--
ALTER TABLE `offering`
  ADD CONSTRAINT `offering_ibfk_1` FOREIGN KEY (`bus_id_pk`) REFERENCES `business` (`bus_id_pk`),
  ADD CONSTRAINT `offering_ibfk_2` FOREIGN KEY (`loc_id_pk`) REFERENCES `location` (`loc_id_pk`),
  ADD CONSTRAINT `offering_ibfk_3` FOREIGN KEY (`of_category`) REFERENCES `interests` (`int_id_pk`),
  ADD CONSTRAINT `offering_ibfk_4` FOREIGN KEY (`of_price_range`) REFERENCES `offering_prices` (`of_price_range`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
