-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2024 at 05:10 PM
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
-- Database: `student_info`
--

-- --------------------------------------------------------

-- table for admins

CREATE TABLE `ADMINS` (
  `ID` int(11) NOT NULL,
  `EMAIL` varchar(20) NOT NULL DEFAULT 'NULL',
  `PASSWORD` varchar(20) NOT NULL DEFAULT 'NULL',
  `LASTLOGIN` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- insert values into admin
INSERT INTO `ADMINS` (`ID`, `EMAIL`, `PASSWORD`, `LASTLOGIN`) VALUES
(1, 'Theophilus', 'password', '2024-07-14 18:01:37');

--
-- Table structure for table `carDetails`
--

CREATE TABLE `car_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VIN` char(17) NOT NULL UNIQUE,
  `make` varchar(20) NOT NULL ,
  `model` varchar(20) NOT NULL ,
  `year` int(11) NOT NULL ,
  `rate_of_rent_per_day` int(11) NOT NULL,
  `is_available` TINYINT(1) NOT NULL DEFAULT 1,

  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_details`
--

INSERT INTO `car_details` (`ID`, `VIN`, `make`,`model`, `year`, `rate_of_rent_per_day`) VALUES
(1, '1HGCM82633A123456', 'Honda','CRV', '2008','30'),
(2, '1HGCM82633A123356', 'Tesla','model X', '2023','70'),
(3, '1HGCM82633A123756', 'Mustang','corvette', '2018','60');

-- --------------------------------------------------------

--
-- Table structure for table `occupied_Cars`
--

CREATE TABLE `occupied_cars` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VIN` char(17) NOT NULL UNIQUE,
  `License_number` varchar(50) NOT NULL,
  `rate_of_rent_per_day` int(11) NOT NULL ,
  `date_of_rent` date NOT NULL,
  CONSTRAINT `occupied_cars_ID_pk` PRIMARY KEY (`ID`),
  FOREIGN KEY (`VIN`) REFERENCES `car_details`(`VIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Dumping data for table `occupied cars`
--

INSERT INTO `occupied_cars` (`ID`, `VIN`, `License_number`, `rate_of_rent_per_day`,`date_of_rent`) VALUES
(1, '1HGCM82633A123456', 'D0123-45678-90123', '30', CURRENT_DATE);

--
-- Table structure for table `Rental_history`
--
-- (VIN, Driving License, Days of Rent, Total Bill

CREATE TABLE `Rental_History` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VIN` char(17) NOT NULL UNIQUE,
  `License_number` varchar(50) NOT NULL,
  `days_of_rent` int(11) NOT NULL ,
  `total_bill` int(11) NOT NULL,
  CONSTRAINT `Rental_History_ID_pk` PRIMARY KEY (`ID`),
  FOREIGN KEY (`VIN`) REFERENCES `car_details`(`VIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- AUTO_INCREMENT for table `car_Details`
--
ALTER TABLE `car_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `occupied_Cars`
--
ALTER TABLE `occupied_cars`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
