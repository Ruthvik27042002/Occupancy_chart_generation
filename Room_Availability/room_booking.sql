-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2023 at 02:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `room_alloc`
--

CREATE TABLE `room_alloc` (
  `id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_alloc`
--

INSERT INTO `room_alloc` (`id`, `room_number`, `start_time`, `end_time`, `date`) VALUES
(1, '101', '10:46:00', '11:46:00', '2023-05-12'),
(2, '104', '09:15:00', '10:15:00', '2023-05-12'),
(3, '103', '01:34:00', '02:34:00', '2023-05-12'),
(4, '102', '01:36:00', '02:36:00', '2023-05-11'),
(5, '106', '11:44:00', '12:44:00', '2023-05-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room_alloc`
--
ALTER TABLE `room_alloc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room_alloc`
--
ALTER TABLE `room_alloc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
