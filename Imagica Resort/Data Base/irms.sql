-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 05:20 PM
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
-- Database: `irms`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `ID` int(5) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `BookingNumber` int(50) NOT NULL,
  `cardno` int(20) NOT NULL,
  `cardholder` varchar(120) NOT NULL,
  `month` int(5) NOT NULL,
  `year` int(5) NOT NULL,
  `cvv` int(5) NOT NULL,
  `price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`ID`, `Type`, `BookingNumber`, `cardno`, `cardholder`, `month`, `year`, `cvv`, `price`) VALUES
(1, '', 0, 1234, 'golakiya jensi', 5, 2028, 123, 5000),
(2, 'Event', 594526811, 7894, 'aaaa', 9, 2029, 123, 5000),
(3, 'Event', 420971166, 7845, 'bbbb', 8, 2030, 456, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 5689784592, 'admin@gmail.com', '0604cd7105546c1e9b248d2afd5bf066', '2023-02-01 07:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `ID` int(10) NOT NULL,
  `RoomId` int(5) DEFAULT NULL,
  `BookingNumber` varchar(120) DEFAULT NULL,
  `UserID` int(5) NOT NULL,
  `IDType` varchar(120) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Address` mediumtext DEFAULT NULL,
  `CheckinDate` varchar(200) DEFAULT NULL,
  `CheckoutDate` varchar(200) DEFAULT NULL,
  `BookingDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `payment` varchar(20) DEFAULT NULL COMMENT 'unpaid/paid '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`ID`, `RoomId`, `BookingNumber`, `UserID`, `IDType`, `Gender`, `Address`, `CheckinDate`, `CheckoutDate`, `BookingDate`, `Remark`, `Status`, `UpdationDate`, `payment`) VALUES
(1, 1, '390343987', 3, 'Voter Card', 'Female', 'A 123 Gaur Apartment Ghaziabad UP 201017', '2023-05-10', '2023-05-15', '2023-05-02 07:12:29', 'Booking accepted', 'Approved', '2023-05-02 07:15:51', ''),
(2, 2, '545403040', 4, 'Voter Card', 'Male', 'A 12232 ABC Apartment Mayur Vihar New Delhi', '2023-05-20', '2023-05-25', '2023-05-05 02:50:41', 'Booking Accepted', 'Approved', '2023-05-05 02:51:35', ''),
(3, 6, '578563952', 5, 'Voter Card', 'Female', 'Botad', '2024-03-28', '2024-03-29', '2024-03-27 16:15:36', 'alreay book', 'Cancelled', '2024-03-27 16:19:00', ''),
(5, 4, '945973363', 5, 'Driving Licence Card', 'Female', 'surat', '2024-04-03', '2024-04-06', '2024-03-31 07:29:37', 'Approved', 'Approved', '2024-03-31 07:35:05', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(10) NOT NULL,
  `CategoryName` varchar(120) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `Price` int(5) NOT NULL,
  `Date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `CategoryName`, `Description`, `Price`, `Date`) VALUES
(1, 'Single Room', 'Only for one person', 800, '2023-02-23 06:43:55'),
(2, 'Double Room', 'For Two Person', 1100, '2023-03-23 06:44:55'),
(3, 'Triple Room', 'A room assigned to three people. May have two or more beds.', 1200, '2023-04-01 06:45:27'),
(4, 'Quad Room', 'A room assigned to four people. May have two or more beds.', 1800, '2020-02-28 06:45:56'),
(5, 'Queen Room', 'A room with a queen-sized bed. May be occupied by one or more people', 2000, '2023-05-01 06:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `EnquiryDate` timestamp NULL DEFAULT current_timestamp(),
  `IsRead` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`ID`, `Name`, `MobileNumber`, `Email`, `Message`, `EnquiryDate`, `IsRead`) VALUES
(1, 'Joh Doe', 1425365412, 'johnd@test.com', 'I want o stay in hotel', '2023-05-05 02:53:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblevent`
--

CREATE TABLE `tblevent` (
  `ID` int(10) NOT NULL,
  `EventType` int(10) NOT NULL,
  `EventName` varchar(200) NOT NULL,
  `EventDesc` mediumtext NOT NULL,
  `Image` varchar(200) NOT NULL,
  `EventFacility` varchar(200) NOT NULL,
  `ECreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblevent`
--

INSERT INTO `tblevent` (`ID`, `EventType`, `EventName`, `EventDesc`, `Image`, `EventFacility`, `ECreationDate`) VALUES
(2, 6, 'Garden Terrace', 'A garden terrace is a fantastic outdoor outdoor space within a resort that is perfect for hosting events.It\'s a beautiful and picturesque setting,adorned with lush greenery and vibrant flowerss.Guesets can enjoy the fresh air,mingle with others, and take in the scenic views.', '3d726c688d055a57db52d29b349e68981711913033jpeg', 'Free wireless internet access', '2024-03-31 19:23:53'),
(3, 5, 'Phoolside Pavillion', 'A phoolside Pavillion is a Fantasic outdoor structure located near the resort\'s swimming phool.It serves as a versatile space for hosting various events and gatherinds.', '8b9fa3eb60ac8a259a3651fbca261cfc1711911724jpeg', '24-Hour room service', '2024-03-31 19:02:04'),
(4, 2, 'Banquet Hall', 'A banquet Hall is a is a spacious indoor venue within the resort that is specifically designed for hosting arger events and gatherinds.The banQuet hall can accommodate a significant number of guests and is perfect for weddings,conferences,or formal parties.', '67287e823b3c25da787a025a368e75631711911990jpeg', 'Free wireless internet access', '2024-03-31 19:06:30'),
(5, 3, 'Conference Room', 'A Conference Room is a dedicated space within the resort that is specifically designed for hosting mettingds.seminars,and business events.', 'e98b25145bf421cd3f61220efb77a8301711912239jpeg', 'Free wireless internet access', '2024-03-31 19:10:39'),
(6, 4, 'Beachside Cabbanas ', 'A Beachside Cabbanas  are cozy and private little huts located right by the beach at the resort.They provides a relaxing and intimate space for gusests to enjoy the sun,sand and ocean breeze.They\'re perfect for samll gathrinds,romantic dinners,or simply lounging by the beach.\r\n', '671b914d9048169367b9f75de4aa62121711912975jpeg', 'Airport transfers', '2024-03-31 19:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbleventbooking`
--

CREATE TABLE `tbleventbooking` (
  `ID` int(10) NOT NULL,
  `EventID` int(5) DEFAULT NULL,
  `BookingNumber` varchar(120) DEFAULT NULL,
  `UserId` int(5) NOT NULL,
  `IDType` varchar(120) DEFAULT NULL,
  `Address` mediumtext DEFAULT NULL,
  `CheckinDate` varchar(200) DEFAULT NULL,
  `CheckoutDate` varchar(200) DEFAULT NULL,
  `BookingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Remark` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Time` datetime DEFAULT NULL,
  `payment` varchar(20) NOT NULL COMMENT 'unpaid/Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbleventbooking`
--

INSERT INTO `tbleventbooking` (`ID`, `EventID`, `BookingNumber`, `UserId`, `IDType`, `Address`, `CheckinDate`, `CheckoutDate`, `BookingDate`, `Remark`, `Status`, `Time`, `payment`) VALUES
(1, 1, '594526811', 5, 'Adhar Card', 'Botad', '2024-03-28', '2024-03-29', '2024-03-27 05:41:21', 'Approve', 'Approved', '0000-00-00 00:00:00', ''),
(3, 1, '420971166', 5, 'Voter Card', 'aaaa', '2024-04-01', '2024-04-02', '2024-03-31 07:32:00', 'Approved', 'Approved', NULL, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `tbleventcategory`
--

CREATE TABLE `tbleventcategory` (
  `ID` int(10) NOT NULL,
  `CategoryName` varchar(120) NOT NULL,
  `Decsription` mediumtext NOT NULL,
  `Price` int(5) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbleventcategory`
--

INSERT INTO `tbleventcategory` (`ID`, `CategoryName`, `Decsription`, `Price`, `Date`) VALUES
(2, 'Banquet Hall', 'Banquet Hall', 10000, '2024-03-31 18:35:02'),
(3, 'Conference Room', 'Conference Room', 15000, '2024-03-31 18:36:30'),
(4, 'Beachside Cabbanas', 'Beachside Cabbanas', 25000, '2024-03-31 18:37:04'),
(5, 'Phoolside Pavillion', 'Phoolside Pavillion', 20000, '2024-03-31 18:38:07'),
(6, 'Garden Terrace', 'Garden Terrace', 30000, '2024-03-31 18:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblfacility`
--

CREATE TABLE `tblfacility` (
  `ID` int(10) NOT NULL,
  `FacilityTitle` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblfacility`
--

INSERT INTO `tblfacility` (`ID`, `FacilityTitle`, `Description`, `Image`, `CreationDate`) VALUES
(1, '24-Hour room service', '24-Hour room service available', 'b9fb9d37bdf15a699bc071ce49baea531582890659.jpg', '2023-04-29 11:54:05'),
(2, 'Free wireless internet access', 'Free wireless internet access available in room restro area', '7fdc1a630c238af0815181f9faa190f51582890845.jpg', '2023-04-29 11:54:05'),
(3, 'Laundry service', 'Free Laundry service available for a customer who book queen and king size room', '3c7baecb174a0cbcc64507e9c3308c4b1582890987.jpg', '2023-04-29 11:54:05'),
(4, 'Tour & excursions', 'vehicle are available for tour and travels', '1e6ae4ada992769567b71815f124fac51582891174.jpg', '2023-04-29 11:54:05'),
(5, 'Airport transfers', 'Airport transfers facility available on demand', 'c9e82378a39eec108727a123b09056651582891272.jpg', '2023-04-29 11:54:05'),
(6, 'Babysitting on request', 'Babysitting on request', 'c26be60cfd1ba40772b5ac48b95ab19b1582891331.png', '2023-04-29 11:54:05'),
(7, '24-Hour doctor on call', '24-Hour doctor on call', '55ccf27d26d7b23839986b6ae2e447ab1582891425.jpg', '2023-04-29 11:54:05'),
(8, 'Meeting facilities', 'Meeting facilities available for company person', 'efc1a80c391be252d7d777a437f868701582891713.jpg', '2023-04-29 11:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(120) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About Us', 'We have 72 comfortably equipped rooms, including two suites: The President Suite and the Ambassador Suite, with over one hundred metres of surface area, which are sure to awe even the most demanding Guests. We offer 7 rooms, where we have been preparing family and business meetings already for 15 years.', NULL, NULL, NULL),
(2, 'contactus', 'Contact Us', 'D-204, Hole Town South West,Delhi-110096,India', 'info@gmail.com', 8529631236, '2023-04-30 14:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblroom`
--

CREATE TABLE `tblroom` (
  `ID` int(10) NOT NULL,
  `RoomType` int(10) DEFAULT NULL,
  `RoomName` varchar(200) DEFAULT NULL,
  `MaxAdult` int(5) DEFAULT NULL,
  `MaxChild` int(5) DEFAULT NULL,
  `RoomDesc` mediumtext DEFAULT NULL,
  `NoofBed` int(5) DEFAULT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `RoomFacility` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblroom`
--

INSERT INTO `tblroom` (`ID`, `RoomType`, `RoomName`, `MaxAdult`, `MaxChild`, `RoomDesc`, `NoofBed`, `Image`, `RoomFacility`, `CreationDate`) VALUES
(1, 1, 'Single Room for one person', 1, 2, 'A single room is for one person and contains a single bed, and will usually be quite small', 1, '9196f0473a317c1c8158db04d5d2ef881711556431.jpg', '24-Hour room service,Free wireless internet acces', '2023-04-29 11:33:14'),
(2, 2, 'Double Room', 2, 2, 'A double room is a room intended for two people, usually a couple, to stay in. One person occupying a double room has to pay a supplement.', 2, '74375080377499ab76dad37484ee7f151582982180.jpg', '24-Hour room service,Free wireless internet acces', '2023-04-29 11:33:14'),
(3, 3, 'triple room', 4, 2, 'A triple room is a hotel room that is made to comfortably accommodate three people. The triple room , simply called a triple, at times, may be configured with different bed sizes to ensure three hotel guests can be accommodated comfortably.', 3, '5ebc75f329d3b6f84d44c2c2e9764d4f1582976638.jpg', '24-Hour room service,Free wireless internet access,Laundry service,Babysitting on request,24-Hour doctor on call,Meeting facilities', '2023-04-29 11:33:14'),
(4, 4, 'Quad Room', 6, 3, 'A quad, when referring to hotel rooms, is a room that can accommodate four people. The quad room may be configured with different bed sizes to ensure four hotel guests can be accommodated comfortably:', 4, '0cdcf50ea65522a6e15d4e0ac383a30e1582976749.jpg', '24-Hour room service,Free wireless internet access,Laundry service,Tour & excursions,Airport transfers,Babysitting on request,24-Hour doctor on call,Meeting facilities', '2023-04-29 11:33:14'),
(5, 5, 'Queen Room', 2, 1, 'A room with a queen-size bed. It may be occupied by one or more people (Size: 153 x 203 cm). King:', 1, '7edd3d2f392c4a07d107f07cbe764fa51582977081.jpg', '24-Hour room service,Free wireless internet access,Laundry service,Tour & excursions,Airport transfers,Babysitting on request,24-Hour doctor on call,Meeting facilities', '2023-04-29 11:33:14'),
(6, 1, 'Single Room with Balcony', 1, 2, 'Each room is equipped with satellite TV, minibar and a tea/coffee maker. Ironing facilities are provided in all rooms.\r\n\r\nTreebo Select Royal Garden offers a well-equipped business centre. Guests can make travel arrangements at the tour desk.\r\n\r\nCheckers Restaurant serves a variety of Indian, Chinese and Continental dishes.', 1, 'ca3de1cf40a0af9351083d4b0e95736c1583047692.jpg', '24-Hour doctor on call', '2023-04-29 11:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FullName`, `MobileNumber`, `Email`, `Password`, `RegDate`) VALUES
(3, 'Anuj Kumar', 1234569871, 'Test@test.com', 'f925916e2754e5e03f75dd58a5733251', '2023-05-01 14:53:36'),
(4, 'John Doe', 4125365412, 'johndeo@test.com', 'f925916e2754e5e03f75dd58a5733251', '2023-05-05 02:49:44'),
(5, 'Jensi', 1234567890, 'jensi@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-03-27 04:43:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblevent`
--
ALTER TABLE `tblevent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbleventbooking`
--
ALTER TABLE `tbleventbooking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbleventcategory`
--
ALTER TABLE `tbleventcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblfacility`
--
ALTER TABLE `tblfacility`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblroom`
--
ALTER TABLE `tblroom`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RoomType` (`RoomType`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblevent`
--
ALTER TABLE `tblevent`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbleventbooking`
--
ALTER TABLE `tbleventbooking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbleventcategory`
--
ALTER TABLE `tbleventcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblfacility`
--
ALTER TABLE `tblfacility`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblroom`
--
ALTER TABLE `tblroom`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
