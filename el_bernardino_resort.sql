-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 04:30 AM
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
-- Database: `el_bernardino_resort`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'king', 'kingjomarcarlos');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `booking_number` int(11) NOT NULL,
  `date_of_reservation` date DEFAULT NULL,
  `date_of_inquiry` timestamp NOT NULL DEFAULT current_timestamp(),
  `check_in_date` date DEFAULT NULL,
  `check_in_time` time DEFAULT NULL,
  `check_out_date` date DEFAULT NULL,
  `check_out_time` time DEFAULT NULL,
  `swimming_type` enum('daytour','night','barkada_package') NOT NULL,
  `total_pax` int(11) NOT NULL,
  `3yrs_old_below` int(250) NOT NULL,
  `adults` int(11) NOT NULL,
  `kids_seniors_pwds` int(11) NOT NULL,
  `cottage_type` varchar(250) DEFAULT NULL,
  `cottage_quantity` int(11) DEFAULT 0,
  `room_type` enum('Deluxe','Standard','Family') DEFAULT NULL,
  `room_quantity` int(11) DEFAULT 0,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','checked_out') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `contact`, `address`, `booking_number`, `date_of_reservation`, `date_of_inquiry`, `check_in_date`, `check_in_time`, `check_out_date`, `check_out_time`, `swimming_type`, `total_pax`, `3yrs_old_below`, `adults`, `kids_seniors_pwds`, `cottage_type`, `cottage_quantity`, `room_type`, `room_quantity`, `total_amount`, `status`) VALUES
(25, 'King', '09068293575', 'asas', 188423, '2025-04-03', '2025-04-03 00:16:38', '0000-00-00', '00:00:14', NULL, NULL, 'night', 10, 0, 1, 9, '', 1, '', 0, 3440.00, 'pending'),
(26, 'King', '09068293575', 'asas', 106977, '2025-04-03', '2025-04-03 00:25:27', '0000-00-00', '00:00:14', NULL, NULL, 'daytour', 10, 0, 1, 9, '', 1, '', 0, 3276.00, 'pending'),
(27, 'king', '09068293575', 'asas', 801103, '2025-04-03', '2025-04-03 00:38:21', '0000-00-00', '00:00:14', NULL, NULL, 'daytour', 10, 0, 1, 9, '0', 1, '', 0, 1476.00, 'pending'),
(28, 'king', '09068293575', 'asas', 942069, '2025-04-03', '2025-04-03 00:42:41', '0000-00-00', '00:00:14', NULL, NULL, 'daytour', 10, 0, 1, 9, '0', 1, '', 0, 1476.00, 'pending'),
(29, 'king', '09068293575', 'asas', 659711, '2025-04-03', '2025-04-03 00:44:27', '0000-00-00', '00:00:14', NULL, NULL, 'night', 10, 0, 1, 9, '0', 1, '', 0, 3440.00, 'pending'),
(30, 'king', '09068293575', 'asas', 155950, '2025-04-03', '2025-04-03 01:24:53', NULL, NULL, NULL, NULL, 'night', 10, 0, 1, 9, '0', 1, '', 0, 3440.00, 'pending'),
(31, 'king', '09068293575', 'asas', 187758, '2025-04-18', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'daytour', 10, 0, 1, 9, '0', 0, 'Standard', 1, 4976.00, 'pending'),
(32, 'King James', '09068293575', '35 Alauli Road Tabuyuc', 976668, '2025-04-08', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'daytour', 6, 1, 1, 5, '0', 0, 'Standard', 1, 4400.00, 'pending'),
(33, 'King James', '09068293575', '35 Alauli Road Tabuyuc', 380845, '2025-04-09', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'night', 6, 1, 1, 5, '0', 1, '', 0, 1000.00, 'pending'),
(34, 'King James', '09068293575', '35 Alauli Road Tabuyuc', 140381, '2025-04-09', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'daytour', 6, 1, 1, 5, 'None', 0, 'Deluxe', 1, 3900.00, 'pending'),
(35, 'King James', '09068293575', '35 Alauli Road Tabuyuc', 197379, '2025-04-09', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'night', 6, 1, 1, 5, 'Nipa20', 1, '', 0, 1000.00, 'pending'),
(36, 'King James', '09068293575', '35 Alauli Road Tabuyuc', 509484, '2025-04-09', '2025-04-08 20:23:22', NULL, NULL, NULL, NULL, 'daytour', 6, 1, 1, 5, 'None', 0, 'Deluxe', 1, 3900.00, 'pending'),
(37, 'King James', '09068293575', '35 Alauli Road Tabuyuc', 520439, '2025-04-17', '2025-04-09 02:25:37', NULL, NULL, NULL, NULL, 'night', 6, 1, 1, 5, 'Cave20', 1, '', 0, 1000.00, 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_number` (`booking_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
