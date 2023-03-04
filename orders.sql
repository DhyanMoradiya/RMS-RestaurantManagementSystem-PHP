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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `TABLE_NO` int(255) NOT NULL,
  `ORDER_NO` int(255) NOT NULL,
  `BILL_NO` int(255) NOT NULL,
  `ITEM_NAME` varchar(255) NOT NULL,
  `PRICE` int(255) NOT NULL,
  `QUANTITY` int(255) NOT NULL,
  `ORDER_SUBTOTLE` int(255) NOT NULL,
  `STATUS` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`TABLE_NO`, `ORDER_NO`, `BILL_NO`, `ITEM_NAME`, `PRICE`, `QUANTITY`, `ORDER_SUBTOTLE`, `STATUS`) VALUES
(1, 89, 1, 'Ringan no olo', 60, 3, 180, 4),
(1, 90, 1, 'Bugger', 80, 2, 160, 4),
(1, 91, 1, 'Sendwhich', 70, 1, 70, 4),
(1, 94, 2, 'Ringan no olo', 60, 2, 120, 4),
(18, 95, 3, 'Sev tameta nu shaak', 40, 3, 120, 4),
(1, 96, 2, 'Bugger', 80, 2, 160, 4),
(18, 97, 3, 'Bugger', 80, 2, 160, 4),
(18, 98, 3, 'Dabeli', 35, 2, 70, 4),
(1, 99, 2, 'Dabeli', 35, 2, 70, 4),
(18, 100, 3, 'Bugger', 80, 2, 160, 4),
(1, 101, 2, 'Ringan no olo', 60, 2, 120, 4),
(1, 102, 2, 'Ringan no olo', 60, 2, 120, 4),
(1, 103, 2, 'Chainese bhel', 130, 1, 130, 4),
(17, 108, 5, 'Bugger', 80, 3, 240, 4),
(17, 109, 5, 'vadapav', 35, 2, 70, 4),
(17, 110, 5, 'Sendwhich', 70, 2, 140, 4),
(17, 111, 5, 'Samosa', 50, 2, 100, 4),
(5, 112, 6, 'Water', 20, 1, 20, 2),
(5, 113, 6, 'Dosa', 150, 2, 300, 2),
(5, 114, 6, 'Upma', 45, 1, 45, 2),
(7, 115, 7, 'vadapav', 35, 1, 35, 4),
(7, 116, 7, 'Bajra no rotalo', 30, 2, 60, 4),
(7, 117, 7, 'Sev tameta nu shaak', 40, 1, 40, 4),
(7, 118, 7, 'Ringan no olo', 60, 2, 120, 4),
(1, 119, 8, 'Bugger', 80, 1, 80, 4),
(1, 120, 8, 'Pizza', 90, 2, 180, 4),
(1, 121, 8, 'Hot Dog', 120, 1, 120, 4),
(1, 122, 8, 'Pasta', 50, 3, 150, 4),
(1, 123, 8, 'Sendwhich', 70, 1, 70, 4),
(3, 124, 9, 'Manchav sup', 60, 4, 240, 4),
(3, 125, 9, 'Masala Chaas', 25, 4, 100, 4),
(3, 126, 9, 'Kaju curry', 120, 3, 360, 4),
(3, 127, 9, 'Kulcha', 30, 6, 180, 4),
(3, 128, 9, 'Panir tikka', 100, 3, 300, 4),
(6, 129, 10, 'Kaju curry', 120, 2, 240, 4),
(6, 130, 10, 'Water', 20, 3, 60, 4),
(6, 131, 10, 'Coffee', 40, 4, 160, 4),
(6, 132, 10, 'Samosa', 50, 4, 200, 4),
(20, 133, 11, 'Parotha', 20, 3, 60, 4),
(20, 134, 11, 'Hot Dog', 120, 2, 240, 4),
(20, 135, 11, 'vadapav', 35, 1, 35, 4),
(20, 136, 11, 'Bugger', 80, 3, 240, 4),
(20, 137, 11, 'Bajra no rotalo', 30, 1, 30, 4),
(15, 138, 12, 'Water', 20, 1, 20, 4),
(15, 139, 12, 'Pasta', 50, 3, 150, 4),
(15, 140, 12, 'Sendwhich', 70, 1, 70, 4),
(15, 141, 12, 'Dabeli', 35, 3, 105, 4),
(15, 142, 12, 'vadapav', 35, 1, 35, 4),
(13, 143, 13, 'Dosa', 150, 3, 450, 2),
(13, 144, 13, 'Idli', 60, 4, 240, 3),
(13, 145, 13, 'Masala Chaas', 25, 4, 100, 2),
(13, 146, 13, 'Water', 20, 3, 60, 2),
(4, 147, 14, 'Samosa', 50, 3, 150, 4),
(4, 148, 14, 'Bugger', 80, 2, 160, 4),
(4, 149, 14, 'Dabeli', 35, 2, 70, 4),
(4, 150, 14, 'Hot Dog', 120, 2, 240, 4),
(4, 151, 14, 'Pasta', 50, 2, 100, 4),
(4, 152, 14, 'Pizza', 90, 2, 180, 4),
(4, 153, 14, 'Sendwhich', 70, 1, 70, 4),
(4, 154, 14, 'vadapav', 35, 1, 35, 4),
(4, 155, 14, 'Chainese bhel', 130, 1, 130, 4),
(4, 156, 14, 'Sendwhich', 70, 1, 70, 4),
(4, 157, 14, 'Kaju curry', 120, 1, 120, 4),
(4, 158, 14, 'Kulcha', 30, 1, 30, 4),
(4, 159, 14, 'Panir tikka', 100, 1, 100, 4),
(4, 160, 14, 'Chhole bhature', 170, 1, 170, 4),
(4, 161, 14, 'Chhole bhature', 170, 1, 170, 4),
(4, 162, 14, 'Manchurian', 120, 3, 360, 4),
(4, 163, 14, 'Water', 20, 5, 100, 4),
(8, 164, 15, 'Chhole bhature', 170, 1, 170, 4),
(8, 165, 15, 'Parotha', 20, 1, 20, 4),
(8, 166, 15, 'Sev tameta nu shaak', 40, 3, 120, 4),
(8, 167, 15, 'Parotha', 20, 6, 120, 4),
(22, 168, 16, 'Bajra no rotalo', 30, 3, 90, 4),
(22, 169, 16, 'Kaju curry', 120, 3, 360, 4),
(22, 170, 16, 'Utappam', 50, 3, 150, 4),
(22, 171, 16, 'Chainese bhel', 130, 1, 130, 4),
(18, 172, 17, 'Kaju curry', 120, 1, 120, 3),
(18, 173, 17, 'Chhole bhature', 170, 1, 170, 2),
(18, 174, 17, 'Chhole bhature', 170, 1, 170, 1),
(18, 175, 17, 'Dabeli', 35, 1, 35, 2),
(18, 176, 17, 'Kaju curry', 120, 1, 120, 3),
(23, 177, 18, 'Chainese bhel', 130, 3, 390, 4),
(23, 178, 18, 'Water', 20, 2, 40, 4),
(16, 179, 19, 'Chhole bhature', 170, 3, 510, 1),
(16, 180, 19, 'Manchav sup', 60, 2, 120, 1),
(16, 181, 19, 'Pizza', 90, 4, 360, 1),
(12, 182, 20, 'Chainese bhel', 130, 5, 650, 1),
(12, 183, 20, 'Hot Dog', 120, 3, 360, 1),
(12, 184, 20, 'Sendwhich', 70, 3, 210, 1),
(12, 185, 20, 'Bugger', 80, 3, 240, 1),
(12, 186, 20, 'Pizza', 90, 5, 450, 1),
(14, 187, 21, 'Water', 20, 8, 160, 4),
(14, 188, 21, 'Masala Chaas', 25, 15, 375, 4),
(14, 189, 21, 'Manchav sup', 60, 16, 960, 4),
(14, 190, 21, 'Kaju curry', 120, 7, 840, 4),
(14, 191, 21, 'Kulcha', 30, 25, 750, 4),
(14, 192, 21, 'Panir tikka', 100, 10, 1000, 4),
(14, 193, 21, 'Manchurian', 120, 4, 480, 4),
(9, 194, 22, 'Bugger', 80, 3, 240, 1),
(9, 195, 22, 'Bajra no rotalo', 30, 2, 60, 1),
(9, 196, 22, 'Kaju curry', 120, 4, 480, 1),
(9, 197, 22, 'Chhole bhature', 170, 5, 850, 1),
(9, 198, 22, 'Kulcha', 30, 5, 150, 1),
(19, 199, 23, 'Dabeli', 35, 3, 105, 1),
(19, 200, 23, 'Sendwhich', 70, 3, 210, 1),
(10, 201, 24, 'Manchurian', 120, 3, 360, 4),
(10, 202, 24, 'Chainese bhel', 130, 3, 390, 4),
(21, 203, 25, 'Bugger', 80, 5, 400, 1),
(21, 204, 25, 'Hot Dog', 120, 5, 600, 1),
(1, 210, 8, 'Bugger', 80, 1, 80, 0),
(3, 218, 26, 'Bugger', 80, 1, 80, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ORDER_NO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ORDER_NO` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
