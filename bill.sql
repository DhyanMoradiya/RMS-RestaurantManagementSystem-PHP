-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 02:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `BILL_NO` int(255) NOT NULL,
  `TABLE_NO` int(255) NOT NULL,
  `SUBTOTLE` int(255) NOT NULL,
  `GST` float NOT NULL,
  `FINAL_AMOUNT` float NOT NULL,
  `BILL_DATE` date NOT NULL,
  `BILL_TIME` time NOT NULL,
  `CASHIER` varchar(255) NOT NULL DEFAULT '',
  `BILL_STATUS` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`BILL_NO`, `TABLE_NO`, `SUBTOTLE`, `GST`, `FINAL_AMOUNT`, `BILL_DATE`, `BILL_TIME`, `CASHIER`, `BILL_STATUS`) VALUES
(1, 1, 590, 106.2, 696.2, '2022-11-26', '01:56:00', 'Dhyan Moradiya', 1),
(2, 1, 720, 129.6, 849.6, '2022-11-20', '01:58:00', 'Dhyan Moradiya', 1),
(3, 18, 510, 91.8, 601.8, '2022-11-15', '02:08:00', 'Dhyan Moradiya', 1),
(4, 2, 325, 58.5, 383.5, '2022-11-21', '02:33:00', '', 0),
(5, 17, 550, 99, 649, '2022-11-25', '02:33:00', 'Dhyan Moradiya', 1),
(6, 5, 365, 65.7, 430.7, '2022-11-21', '02:34:00', '', 0),
(7, 7, 255, 45.9, 300.9, '2022-11-16', '02:35:00', 'Dhyan Moradiya', 1),
(8, 1, 600, 108, 708, '2022-11-25', '02:36:00', 'Dhyan Moradiya', 1),
(9, 3, 1180, 212.4, 1392.4, '2022-11-08', '02:37:00', 'Dhyan Moradiya', 1),
(10, 6, 660, 118.8, 778.8, '2022-11-17', '02:38:00', 'Dhyan Moradiya', 1),
(11, 20, 605, 108.9, 713.9, '2022-11-07', '02:38:00', 'Dhyan Moradiya', 1),
(12, 15, 380, 68.4, 448.4, '2022-11-25', '02:39:00', 'Dhyan Moradiya', 1),
(13, 13, 850, 153, 1003, '2022-11-21', '02:39:00', '', 0),
(14, 4, 2255, 405.9, 2660.9, '2022-11-11', '02:40:00', 'Dhyan Moradiya', 1),
(15, 8, 430, 77.4, 507.4, '2022-11-25', '02:41:00', 'Dhyan Moradiya', 1),
(16, 22, 730, 131.4, 861.4, '2022-11-18', '02:41:00', 'Dhyan Moradiya', 1),
(17, 18, 615, 110.7, 725.7, '2022-11-25', '02:42:00', 'Dhyan Moradiya', 1),
(18, 23, 430, 77.4, 507.4, '2022-11-26', '02:42:00', 'Dhyan Moradiya', 1),
(19, 16, 990, 178.2, 1168.2, '2022-11-21', '02:43:00', '', 0),
(20, 12, 1910, 343.8, 2253.8, '2022-11-21', '02:43:00', '', 0),
(21, 14, 4565, 821.7, 5386.7, '2022-11-20', '02:44:00', 'Dhyan Moradiya', 1),
(22, 9, 1780, 320.4, 2100.4, '2022-11-21', '02:45:00', '', 0),
(23, 19, 315, 56.7, 371.7, '2022-11-21', '02:45:00', '', 0),
(24, 10, 750, 135, 885, '2022-11-01', '02:45:00', 'Dhyan Moradiya', 1),
(25, 21, 1000, 180, 1180, '2022-11-25', '02:23:00', 'Dhyan Moradiya', 1),
(26, 3, 80, 14.4, 94.4, '2022-11-26', '02:07:00', 'Dhyan Moradiya', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`BILL_NO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
