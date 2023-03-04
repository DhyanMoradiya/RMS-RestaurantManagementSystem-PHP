-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 02:51 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

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
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `ITEM_NAME` varchar(255) NOT NULL,
  `IMAGE` varchar(255) NOT NULL,
  `PRICE` int(255) NOT NULL,
  `CATEGORY` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ITEM_NAME`, `IMAGE`, `PRICE`, `CATEGORY`, `DESCRIPTION`) VALUES
('Bajra no rotalo', 'Bajrano Rotalo.png', 30, 'Gujarati', ''),
('Bugger', 'burger.png', 80, 'Fast Food', ''),
('Chainese bhel', 'Chainese bhel.png', 130, 'Chainese', ''),
('Chhole bhature', 'Chole bhature.png', 170, 'Panjabi', ''),
('Coffee', 'Coffee.png', 40, 'Drinks', ''),
('Dabeli', 'Dabeli.png', 35, 'Fast Food', ''),
('Dosa', 'dosa.png', 150, 'South Indian', ''),
('Hot Dog', 'hotdog.png', 120, 'Fast Food', ''),
('Idli', 'idli.png', 60, 'South Indian', ''),
('Kaju curry', 'Kaju curry.png', 120, 'Panjabi', ''),
('Khaman', 'Khaman.png', 100, 'Farsan', ''),
('Kulcha', 'Kulcha.png', 30, 'Panjabi', ''),
('Manchav sup', 'Manchav sup.png', 60, 'Drinks', ''),
('Manchurian', 'Manchurian.png', 120, 'Chainese', ''),
('Masala Chaas', 'Masala chaas.png', 25, 'Drinks', ''),
('Panir tikka', 'Panir tikka.png', 100, 'Panjabi', ''),
('Parotha', 'Parotha.png', 20, 'Gujarati', ''),
('Pasta', 'Pasta.png', 50, 'Fast Food', ''),
('Pizza', 'pizza.png', 90, 'Fast Food', ''),
('Ringan no olo', 'Ringan no olo.png', 60, 'Gujarati', ''),
('Samosa', 'samosa.png', 50, 'Farsan', ''),
('Sendwhich', 'Sendwhich.png', 70, 'Fast Food', ''),
('Sev tameta nu shaak', 'Sev tameta nu shaak.png', 40, 'Gujarati', ''),
('Tea', 'Tea.png', 35, 'Drinks', ''),
('Upma', 'Upma.png', 45, 'South Indian', ''),
('Utappam', 'Utappam.png', 50, 'South Indian', ''),
('vadapav', 'Vadapav.png', 35, 'Fast Food', ''),
('Water', 'Water bottel.png', 20, 'Drinks', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ITEM_NAME`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
