-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 05:23 AM
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
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
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
  `status` enum('pending','approved','checked_out') DEFAULT 'pending',
  `entrance_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cottage_room_fee` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `firstname`, `middlename`, `lastname`, `contact`, `address`, `booking_number`, `date_of_reservation`, `date_of_inquiry`, `check_in_date`, `check_in_time`, `check_out_date`, `check_out_time`, `swimming_type`, `total_pax`, `3yrs_old_below`, `adults`, `kids_seniors_pwds`, `cottage_type`, `cottage_quantity`, `room_type`, `room_quantity`, `total_amount`, `status`, `entrance_fee`, `cottage_room_fee`) VALUES
(58, 'king', 'ocampo', 'carlos', '09068293575', '35 Alauli Road Tabuyuc', 640990, '2025-04-26', '2025-04-10 08:07:57', '2025-04-10', '16:11:53', NULL, NULL, 'night', 10, 1, 10, 0, 'Cave20', 1, '', 0, 3800.00, 'approved', 2000.00, 1800.00),
(59, 'king', 'ocampo', 'carlos', '09068293575', '35 Alauli Road Tabuyuc', 103101, '2025-04-10', '2025-04-10 08:09:17', '2025-04-10', '16:11:57', NULL, NULL, 'daytour', 10, 1, 10, 0, 'Nipa', 1, '', 0, 2800.00, 'approved', 1800.00, 1000.00),
(60, 'king', 'ocampo', 'carlos', '09068293575', '35 Alauli Road Tabuyuc', 890980, '2025-04-10', '2025-04-10 09:02:43', '2025-04-10', '17:04:41', NULL, NULL, 'night', 13, 1, 13, 0, 'Cave', 1, 'Standard', 1, 7100.00, 'approved', 2600.00, 4500.00),
(61, 'king', 'ocampo', 'carlos', '09068293575', '35 Alauli Road Tabuyuc', 792038, '2025-04-10', '2025-04-10 09:04:13', NULL, NULL, NULL, NULL, 'night', 13, 1, 13, 0, 'Cave20', 1, '', 0, 4400.00, 'pending', 2600.00, 1800.00);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_report`
--

CREATE TABLE `monthly_report` (
  `id` int(11) NOT NULL,
  `month` varchar(7) NOT NULL,
  `total_bookings` int(11) DEFAULT 0,
  `total_pax` int(11) DEFAULT 0,
  `total_kids` int(11) DEFAULT 0,
  `total_adults` int(11) DEFAULT 0,
  `total_senior_pwd` int(11) DEFAULT 0,
  `total_entrance` decimal(10,2) DEFAULT 0.00,
  `total_unit_rate` decimal(10,2) DEFAULT 0.00,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `bcoh` decimal(10,2) DEFAULT 0.00,
  `expenses` decimal(10,2) DEFAULT 0.00,
  `salary` decimal(10,2) DEFAULT 0.00,
  `rem` decimal(10,2) DEFAULT 0.00,
  `ecoh` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_report`
--

INSERT INTO `monthly_report` (`id`, `month`, `total_bookings`, `total_pax`, `total_kids`, `total_adults`, `total_senior_pwd`, `total_entrance`, `total_unit_rate`, `total_amount`, `bcoh`, `expenses`, `salary`, `rem`, `ecoh`) VALUES
(1, '2025-03', 10, 25, 3, 12, 5, 1500.00, 6000.00, 8000.00, 500.00, 2000.00, 2500.00, 4500.00, 5000.00),
(2, '2025-04', 12, 30, 4, 14, 6, 1800.00, 7200.00, 9000.00, 1000.00, 0.00, 3000.00, 15100.00, 16100.00);

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
-- Indexes for table `monthly_report`
--
ALTER TABLE `monthly_report`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `monthly_report`
--
ALTER TABLE `monthly_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
