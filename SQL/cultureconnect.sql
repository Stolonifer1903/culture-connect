-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 08:46 PM
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

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`businessIdPk`, `businessName`, `businessDescription`, `businessEmail`, `businessPhone`, `businessLink`, `councilIdPk`) VALUES
(4, 'The Clay Studio Hatfield', 'A small ceramics studio based in Hatfield offering handmade pottery, clay workshops and bespoke commissions. Founded by local artist Emma Rhodes, the studio celebrates traditional craft techniques wit', 'hello@claystudiohatfield.co.uk', '01707 474000', 'claystudiohatfield.co.uk', 10),
(5, 'Hitchin Printworks', 'An independent print studio in Hitchin specialising in limited edition screen prints, linocuts and original artwork inspired by the Hertfordshire countryside. Run by artist collective of three local c', ' info@hitchinprintworks.co.uk', '01462 159478', 'hitchinprintworks.co.uk', 5),
(6, 'Welwyn Garden City Arts Collective', 'A community arts organisation based in Welwyn Garden City offering gallery visits, live theatre performances and open mic nights. Dedicated to bringing affordable cultural experiences to local residen', 'hello@wgcartsco.uk', '01707 159746', ' wgcartsco.uk', 10),
(7, 'North Herts Bindery', 'A specialist bookbinding and stationery studio based in Letchworth Garden City. Hand-binding bespoke journals, limited edition zines and artisan stationery using traditional techniques and locally sou', 'contact@northhertsbindery.co.uk', '01462 156489', 'northhertsbindery.co.uk', 5),
(8, 'Hatfield Theatre Company', 'A community theatre company based in Hatfield producing live theatre performances, concerts and cultural events throughout the year. Open to performers of all experience levels, with regular workshops', 'hello@hatfieldtheatre.co.uk', '01707 345678', 'hatfieldtheatre.co.uk', 10),
(9, 'Royston Digital Creative Studio', 'A small digital creative agency in Royston offering graphic design, digital design and videography services to local businesses and community organisations. Passionate about telling local stories thro', 'hello@roystondigital.co.uk', '01438 456789', 'roystondigital.co.uk', 5),
(10, 'Letchworth Photography Studio', 'A professional photography studio and training school in Letchworth Garden City offering portrait photography services, videography and photography workshops for beginners and enthusiasts. Also availa', 'hello@letchworthphoto.co.uk', '01462 567890', 'letchworthphoto.co.uk', 5),
(11, 'Hitchin Music Academy', 'A friendly music school in Hitchin offering individual and group music lessons for all ages and abilities, from beginners to advanced. Specialising in piano, guitar, violin and voice, with regular stu', 'hello@hitchinmusicacademy.co.uk', '01462 156496', 'hitchinmusicacademy.co.uk', 5),
(12, 'Welwyn Cultural Tours', 'A guided tour company based in Welwyn Garden City offering walking cultural tours of Hertfordshire\'s historic towns and villages. Tours cover local art, architecture and history, with specialist photo', 'info@welwyncultural.co.uk', '01707 456989', 'welwyncultural.co.uk', 10);

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
-- Table structure for table `interestarea`
--

CREATE TABLE `interestarea` (
  `interestAreaIdPk` int(13) NOT NULL,
  `interestAreaName` varchar(200) NOT NULL,
  `InterestAreaProductOrService` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `interestarea`
--

INSERT INTO `interestarea` (`interestAreaIdPk`, `interestAreaName`, `InterestAreaProductOrService`) VALUES
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

--
-- Dumping data for table `offering`
--

INSERT INTO `offering` (`offeringIdPk`, `offeringName`, `offeringDescription`, `offeringCulturalBenefits`, `offeringPriceRange`, `offeringCategory`, `locationIdPk`, `businessIdPk`, `offeringDetails`, `offeringAwards`, `offeringImage`) VALUES
(3, 'Handmade Ceramic Mugs', 'Beautiful hand-thrown ceramic mugs made in our Hatfield studio. Each piece is unique and finished with our signature earthy glazes.', 'Supports traditional craft skills and promotes local artisan culture.', 1, 14, 2, 4, 'Available in sets of 2 or 4. \r\nChoose from a range of glaze colours.', 'Highly Commended, Hertfordshire Craft Awards 2023', '3.jpg'),
(4, 'Pottery Workshop for Beginners', 'A two-hour introduction to hand-building pottery techniques. No experience needed — just bring your creativity! All materials provided.', 'Encourages creative expression and provides a relaxing cultural experience for local residents.', 2, 14, 2, 4, 'Sessions run every Saturday 10am-12pm. Maximum 8 participants.', 'None', '4.jpg'),
(5, 'Hertfordshire Landscape Print', 'A limited edition screen print of the Hitchin countryside, hand-pulled by our studio artists. Each print is numbered and signed.', 'Celebrates the local landscape and supports independent printmaking as a traditional art form.', 2, 13, 5, 5, 'Available in A3 and A2. Edition of 50.', 'Winner, North Herts Arts Prize 2022', '5.jpg'),
(6, 'Limited Edition Botanical Poster', 'A hand-printed botanical poster featuring wildflowers native to Hertfordshire. Printed using traditional linocut techniques on recycled paper.', 'Raises awareness of local biodiversity and supports sustainable printmaking practices.', 1, 17, 5, 5, 'A2 size. Edition of 30. Unframed.', 'Shortlisted, Independent Print Awards 2023', '6.jpg'),
(7, 'Summer Theatre Evening', 'An outdoor live theatre performance of a classic play performed by our community theatre group in Welwyn Garden City. Bring a picnic and enjoy the show!', 'Brings the community together through shared cultural experiences and supports local performing arts.', 1, 3, 1, 6, 'Runs Friday and Saturday evenings in July and August. Gates open 6pm, performance starts 7:30pm.', 'Best Community Event, Welwyn Garden City Arts Festival 2023', '7.jpg'),
(8, 'Monthly Open Mic Night', 'A relaxed and welcoming open mic night for musicians, poets and spoken word artists of all levels. Held monthly at our WGC arts space.', 'Provides a platform for local creative talent and fosters a sense of community.', 1, 5, 1, 6, 'First Friday of every month. Doors open 7pm. Sign up to perform on the door.', 'Highly Commended, British Bookbinding Awards 2022', '8.jpg'),
(9, 'Bespoke Hand-bound Journal', 'A beautifully hand-bound journal made to order in our Letchworth studio. Choose your cover fabric, paper type and size for a truly personal item.', 'Keeps traditional bookbinding craft alive and supports sustainable, locally made stationery.', 2, 18, 6, 7, 'A5 or A4. Choice of fabric covers. 4-6 week lead time.', 'None', '9.jpg'),
(10, 'Letchworth Local Zine', 'A quarterly zine celebrating local arts, culture and community in Letchworth and North Hertfordshire. Written and designed by local contributors.', 'Amplifies local voices and celebrates the creative community of North Hertfordshire.', 1, 16, 6, 7, 'A5 format. 32 pages. New edition every quarter.', 'None', NULL),
(11, 'Winter Pantomime', 'Our annual family pantomime performed by our community theatre group. A festive tradition in Hatfield for over 10 years!', 'Brings families together through live performance and celebrates a beloved British cultural tradition.', 1, 3, 2, 8, 'Runs for two weeks in December. Matinee and evening performances available.', 'None', '11.jpg'),
(12, 'Summer Concert Series', 'A series of outdoor concerts featuring local musicians performing across a range of genres, from classical to folk to jazz.', 'Supports local musicians and makes live music accessible to all members of the community.', 1, 4, 2, 8, 'Every Sunday afternoon in July. Free entry. Donations welcome.', 'None', '12.jpg'),
(13, 'Brand Identity Design Package', 'A complete brand identity design service for local businesses and community organisations, including logo, colour palette and typography.', 'Helps local businesses establish a strong visual identity and supports the growth of the local economy.', 2, 11, 8, 9, 'Includes 3 concept designs and 2 rounds of revisions. 4-week turnaround.', 'None', NULL),
(14, 'Community Event Videography', 'Professional videography service for local community events, festivals and cultural occasions. We capture the moments that matter.', 'Preserves important cultural moments and creates lasting memories for the local community.', 3, 10, 8, 9, 'Full day coverage. Edited highlight reel delivered within 2 weeks.', 'None', '14.jpg'),
(15, 'Portrait Photography Session', 'A professional portrait photography session in our Letchworth studio or at a location of your choice in Hertfordshire.', 'Celebrates individual stories and supports professional photography as a cultural art form.', 2, 9, 6, 10, '1 hour session. 10 edited digital images included. Additional images available.', 'None', '15.jpg'),
(16, 'Guitar Lessons for Beginners', 'Weekly one-to-one guitar lessons for complete beginners of all ages. Our patient and experienced tutors will have you playing your favourite songs in no time.', 'Promotes music education and supports the development of lifelong creative skills.', 1, 2, 5, 11, '30 or 60 minute sessions available. Weekly or fortnightly slots.', 'None', '16.jpg'),
(17, 'Welwyn Garden City Heritage Walk', 'A guided walking tour of Welwyn Garden City exploring its unique Arts and Crafts architecture, garden city heritage and cultural history. Led by our expert local guides.', 'Celebrates the unique cultural and architectural heritage of Welwyn Garden City and promotes local history.', 1, 6, 1, 12, 'Tours run every Saturday at 10am. Approximately 2 hours. Maximum 12 participants.', 'None', '17.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `offeringpricing`
--

CREATE TABLE `offeringpricing` (
  `offeringPriceRange` int(13) NOT NULL,
  `offeringPriceRangeDescription` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `offeringpricing`
--

INSERT INTO `offeringpricing` (`offeringPriceRange`, `offeringPriceRangeDescription`) VALUES
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
(3, 'Male', 1998, 8, 2),
(5, 'Female', 1986, 2, 9),
(6, 'Male', 2009, 7, 10),
(7, 'Female', 1973, 1, 11),
(8, 'Male', 2000, 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `residentinterests`
--

CREATE TABLE `residentinterests` (
  `residentInterestIdPk` int(13) NOT NULL,
  `residentIdPk` int(13) NOT NULL,
  `interestAreaIdPk` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `residentinterests`
--

INSERT INTO `residentinterests` (`residentInterestIdPk`, `residentIdPk`, `interestAreaIdPk`) VALUES
(30, 5, 1),
(31, 5, 5),
(32, 5, 6),
(33, 5, 13),
(34, 5, 14),
(35, 6, 2),
(36, 6, 7),
(37, 6, 9),
(38, 6, 11),
(39, 6, 16),
(40, 7, 4),
(41, 7, 7),
(42, 7, 11),
(43, 7, 12),
(44, 7, 16),
(45, 7, 18),
(46, 8, 2),
(47, 8, 7),
(48, 8, 9),
(49, 8, 13),
(50, 8, 15),
(51, 3, 2),
(52, 3, 3),
(53, 3, 5),
(54, 3, 6),
(55, 3, 14),
(56, 3, 15);

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
(1, 'Tina', 'Jones', 'admin@admin.com', '1234', 'Ms', 4, 0),
(2, 'Chloe', 'Davis', 'user@user.com', '1234', '', 1, 3),
(3, 'Daniel', 'Foster', 'bus@bus.com', '1234', 'Mr', 2, 5),
(4, 'Greg', 'Jones', 'counc@counc.com', '1234', 'Mr', 3, 10),
(9, 'Sarah', 'Thompson', 'sarah.tompson@email.com', '1234', 'Ms', 1, 5),
(10, 'James', 'Patel', 'jp@gmail.com', '1234', '', 1, 6),
(11, 'Amara', 'Okafor', 'miss_a@yahoo.com', '1234', 'Mrs', 1, 7),
(12, 'Liam', 'O\'Brien', 'liamb654@mail.com', '1234', 'Mr', 1, 8),
(13, 'Emma', 'Rhodes', 'emma.rhodes@claystudiohatfield.co.uk', '1234', 'Ms', 2, 4),
(14, 'Sophie', 'Adeyemi', 'sophie.adeyemi@wgcartsco.uk', '1234', 'Ms', 2, 6),
(15, 'Robert', 'Lawson', 'robert.lawson@northhertsbindery.co.uk', '1234', '', 2, 7),
(16, 'Mia', 'Chen', 'mia.chen@roystondigital.co.uk', '1234', '', 2, 9),
(17, 'Marcus', 'Webb', 'marcus.webb@hitchinmusicacademy.co.uk', '1234', '', 2, 11),
(18, 'Anita', 'Patel', 'anita.patel@welwyncultural.co.uk', '1234', '', 2, 12),
(19, 'James', 'Thornton', 'james.thornton@hatfieldtheatre.co.uk', '1234', 'Mr', 2, 8),
(20, 'Laura', 'Smith', 'lauras@claystudiohatfield.co.uk', '1234', 'Mrs', 2, 4),
(21, 'Felicity', 'Rainer', 'felr@nhdc.gov.uk', '12347', 'Ms', 3, 5);

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
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`voteIdPk`, `offeringIdPk`, `residentIdPk`, `vote`) VALUES
(1, 11, 3, 1),
(2, 7, 3, 1),
(3, 12, 3, 1),
(4, 17, 3, 1),
(5, 8, 3, 0),
(6, 16, 3, 1),
(7, 4, 3, 1),
(8, 3, 3, 1),
(9, 17, 5, 1),
(10, 5, 5, 1),
(11, 8, 5, 0),
(12, 10, 5, 1),
(13, 11, 5, 1),
(14, 4, 5, 1);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_offerings`  AS SELECT `o`.`offeringIdPk` AS `offeringIdPk`, `b`.`businessName` AS `businessName`, `o`.`offeringName` AS `offeringName`, `i`.`interestAreaName` AS `interestAreaName`, `l`.`locationName` AS `locationName`, `o`.`offeringDescription` AS `offeringDescription`, `o`.`offeringDetails` AS `offeringDetails`, `o`.`offeringCulturalBenefits` AS `offeringCulturalBenefits`, `o`.`offeringAwards` AS `offeringAwards`, `o`.`offeringImage` AS `offeringImage`, `op`.`offeringPriceRangeDescription` AS `offeringPriceRangeDescription`, sum(`v`.`vote` = 1) AS `yesVotes`, sum(`v`.`vote` = 0) AS `noVotes`, sum(`v`.`vote` = 1) - sum(`v`.`vote` = 0) AS `displayVotes` FROM (((((`offering` `o` join `business` `b` on(`o`.`businessIdPk` = `b`.`businessIdPk`)) join `interestarea` `i` on(`o`.`offeringCategory` = `i`.`interestAreaIdPk`)) join `location` `l` on(`o`.`locationIdPk` = `l`.`locationIdPk`)) join `offeringpricing` `op` on(`o`.`offeringPriceRange` = `op`.`offeringPriceRange`)) left join `vote` `v` on(`v`.`offeringIdPk` = `o`.`offeringIdPk`)) GROUP BY `o`.`offeringIdPk`, `b`.`businessName`, `o`.`offeringName`, `i`.`interestAreaName`, `l`.`locationName`, `o`.`offeringDescription`, `o`.`offeringDetails`, `o`.`offeringCulturalBenefits`, `o`.`offeringAwards`, `o`.`offeringImage`, `op`.`offeringPriceRangeDescription` ;

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
-- Indexes for table `interestarea`
--
ALTER TABLE `interestarea`
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
-- Indexes for table `residentinterests`
--
ALTER TABLE `residentinterests`
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
  MODIFY `businessIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `council`
--
ALTER TABLE `council`
  MODIFY `councilIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `interestarea`
--
ALTER TABLE `interestarea`
  MODIFY `interestAreaIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `offering`
--
ALTER TABLE `offering`
  MODIFY `offeringIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `residentIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `residentinterests`
--
ALTER TABLE `residentinterests`
  MODIFY `residentInterestIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `voteIdPk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `offering_ibfk_2` FOREIGN KEY (`locationIdPk`) REFERENCES `location` (`locationIdPk`);

--
-- Constraints for table `resident`
--
ALTER TABLE `resident`
  ADD CONSTRAINT `resident_ibfk_1` FOREIGN KEY (`locationIdPk`) REFERENCES `location` (`locationIdPk`);

--
-- Constraints for table `residentinterests`
--
ALTER TABLE `residentinterests`
  ADD CONSTRAINT `residentInterests_ibfk_1` FOREIGN KEY (`interestAreaIdPk`) REFERENCES `interestarea` (`interestAreaIdPk`);

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
