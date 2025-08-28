-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2022 at 05:30 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gatepassdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `gatepass`
--

CREATE TABLE `gatepass` (
  `id` int(11) NOT NULL,
  `gatepassCode` varchar(128) NOT NULL,
  `fieldworkDate` varchar(128) NOT NULL,
  `destination` varchar(128) NOT NULL,
  `employeeName` varchar(128) NOT NULL,
  `dept` varchar(128) NOT NULL,
  `employeeSignature` varchar(128) NOT NULL,
  `remarks` varchar(128) NOT NULL,
  `purpose1` varchar(128) NOT NULL,
  `purpose2` varchar(128) NOT NULL,
  `purpose3` varchar(128) NOT NULL,
  `prop1` varchar(128) NOT NULL,
  `prop2` varchar(128) NOT NULL,
  `prop3` varchar(128) NOT NULL,
  `preparedBy` varchar(128) NOT NULL,
  `prepSignature` varchar(128) NOT NULL,
  `gatepassStatus` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `approveBy` varchar(128) NOT NULL,
  `approveBySignature` varchar(128) NOT NULL,
  `departureTime` varchar(128) DEFAULT NULL,
  `departureSignature` varchar(128) DEFAULT NULL,
  `arrivalTime` varchar(128) DEFAULT NULL,
  `arrivalSignature` varchar(128) DEFAULT NULL,
  `securityName` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gatepass`
--

INSERT INTO `gatepass` (`id`, `gatepassCode`, `fieldworkDate`, `destination`, `employeeName`, `dept`, `employeeSignature`, `remarks`, `purpose1`, `purpose2`, `purpose3`, `prop1`, `prop2`, `prop3`, `preparedBy`, `prepSignature`, `gatepassStatus`, `username`, `approveBy`, `approveBySignature`, `departureTime`, `departureSignature`, `arrivalTime`, `arrivalSignature`, `securityName`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Received', '', 'Patrick Buena', '37A--sign5.png', '', '', '', '', ''),
(2, 'PM-HRD-2022-000002', '04-07-2022', 'FVT', 'Employee 1', 'MIS', 'PM-HRD-2022-000002-sign5.png', '', '1. Fix Printers', '2. Setup PC', '3. ', '1. Tools', '2. System Unit', '3. ', 'Employee 1', '35P-PM-HRD-2022-000002-sign5.png', 'Received', 'employee', 'Supervisor 1', '7A-PM-HRD-2022-000002-sign4.png', '', '', '', '', ''),
(3, 'PM-HRD-2022-000002', '04-07-2022', 'FVT', 'Employee 2', 'MIS', 'PM-HRD-2022-000002-sign4.png', '', '1. Fix Printers', '2. Setup PC', '3. ', '1. Tools', '2. System Unit', '3. ', 'Employee 1', '35P-PM-HRD-2022-000002-sign5.png', 'Received', 'employee', 'Supervisor 1', '7A-PM-HRD-2022-000002-sign4.png', '', '', '', '', ''),
(4, 'PM-HRD-2022-000002', '04-07-2022', 'FVT', 'Employee 3', 'MIS', 'PM-HRD-2022-000002-sign3.png', '', '1. Fix Printers', '2. Setup PC', '3. ', '1. Tools', '2. System Unit', '3. ', 'Employee 1', '35P-PM-HRD-2022-000002-sign5.png', 'Received', 'employee', 'Supervisor 1', '7A-PM-HRD-2022-000002-sign4.png', '', '', '', '', ''),
(5, 'PM-HRD-2022-000002', '04-07-2022', 'FVT', 'Employee 4', 'MIS', 'PM-HRD-2022-000002-sign2.png', '', '1. Fix Printers', '2. Setup PC', '3. ', '1. Tools', '2. System Unit', '3. ', 'Employee 1', '35P-PM-HRD-2022-000002-sign5.png', 'Received', 'employee', 'Supervisor 1', '7A-PM-HRD-2022-000002-sign4.png', '', '', '', '', ''),
(6, 'PM-HRD-2022-000002', '04-07-2022', 'FVT', 'Employee 5', 'MIS', 'PM-HRD-2022-000002-sign1.png', '', '1. Fix Printers', '2. Setup PC', '3. ', '1. Tools', '2. System Unit', '3. ', 'Employee 1', '35P-PM-HRD-2022-000002-sign5.png', 'Received', 'employee', 'Supervisor 1', '7A-PM-HRD-2022-000002-sign4.png', '', '', '', '', ''),
(7, 'PM-HRD-2022-000007', '04-12-2022', 'FVT', 'Joshua Daniel Ambrosio', 'MIS', 'PM-HRD-2022-000007-sign1.png', '', '1. Fix Printer', '2. Setup PC', '3.', '1. Tools', '2. System Unit', '3.', 'Joshua Daniel Ambrosio', '83P-PM-HRD-2022-000007-sign1.png', 'Received', 'employee', 'Czar Patrick Buena', '26A-PM-HRD-2022-000007-super.png', '', '', '', '', ''),
(8, 'PM-HRD-2022-000008', '18-05-2022', 'SHS', 'Joshua Daniel Ambrosio', 'MIS', 'PM-HRD-2022-000008-sign1.png', '', '1. Fix Lan Wires', '2. ', '3. ', '1. Tools', '2. ', '3. ', 'Joshua Daniel Ambrosio', 'P-PM-HRD-2022-000008-sign1.png', 'Pending', 'employee', '', '', '', '', '', '', ''),
(9, 'PM-HRD-2022-000009', '18-05-2022', 'SHS', 'Joshua Daniel Ambrosio', 'MIS', 'PM-HRD-2022-000009-sign2.png', '', '1. Fix Aircon', '2. ', '3. ', '1. Tools', '2. ', '3. ', 'Joshua Daniel Ambrosio', 'P-PM-HRD-2022-000009-sign2.png', 'Received', 'employee', 'Czar Patrick Buena', '1A-PM-HRD-2022-000009-super.png', '', '', '', '', ''),
(10, 'PM-HRD-2022-000010', '06/2/2022', 'SFV', 'Joshua Daniel Ambrosio', 'MIS', 'PM-HRD-2022-000010-sign1.png', '', '1. ', '2. ', '3. ', '1. ', '2. ', '3. ', 'Joshua Daniel Ambrosio', 'P-PM-HRD-2022-000010-sign1.png', 'Received', 'employee', 'Czar Patrick Buena', '86A-PM-HRD-2022-000010-super.png', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `userFullname` varchar(128) NOT NULL,
  `dept` varchar(128) NOT NULL,
  `userType` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `userFullname`, `dept`, `userType`) VALUES
(1, 'employee', '1234', 'Employee', 'MIS', 'Employee'),
(2, 'guard', '1234', 'Guard', 'Security', 'Security'),
(3, 'supervisor', '1234', 'Supervisor', 'MIS', 'Supervisor'),
(4, 'executive', '1234', 'Executive', 'All', 'Executive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gatepass`
--
ALTER TABLE `gatepass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gatepass`
--
ALTER TABLE `gatepass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
