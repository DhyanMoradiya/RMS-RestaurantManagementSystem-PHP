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
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `TABLE_NO` int(255) NOT NULL,
  `TABLE_STATUS` int(1) NOT NULL DEFAULT 1,
  `CAPACITY` int(12) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`TABLE_NO`, `TABLE_STATUS`, `CAPACITY`) VALUES
(1, 0, 4),
(2, 1, 4),
(3, 1, 2),
(4, 1, 6),
(5, 0, 2),
(6, 1, 4),
(7, 1, 2),
(8, 1, 2),
(9, 0, 4),
(10, 1, 8),
(11, 1, 8),
(12, 0, 2),
(13, 0, 2),
(14, 1, 2),
(15, 1, 4),
(16, 0, 4),
(17, 1, 6),
(18, 1, 4),
(19, 0, 6),
(20, 1, 2),
(21, 1, 4),
(22, 1, 4),
(23, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`TABLE_NO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
