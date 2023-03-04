-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 06:17 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `FNAME` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `PHONE` varchar(13) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `POSITION` int(1) NOT NULL,
  `PHOTO` varchar(255) NOT NULL DEFAULT 'NOTSET.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`FNAME`, `LNAME`, `PHONE`, `EMAIL`, `PASSWORD`, `POSITION`, `PHOTO`) VALUES
('Dhyan', 'Moradiya', '9714877117', 'moradiya612@gmail.com', '12345', 0, 'Dhyan Moradiya.jpg'),
('Tusha', 'Mishra', '3247867866', 'tushamishra@gmail.com', '12345', 1, 'NOTSET.png'),
('Nirav', 'Golakiya', '1234567890', 'niravgolakiya@gmail.com', '12345', 1, 'NOTSET.png'),
('Vraj', 'Donda', '1245731711', 'vrajdonda@gmail.com', '12345', 3, 'NOTSET.png'),
('Bhavana', 'Patil', '3462767787', 'bhavanapatil@gmail.com', '12345', 2, 'NOTSET.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`PHONE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
