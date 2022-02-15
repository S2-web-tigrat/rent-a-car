-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 07:04 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent-car`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `chassie_number` varchar(256) NOT NULL,
  `kilometers_passed` varchar(256) NOT NULL,
  `registration` varchar(256) NOT NULL,
  `registration_date` date NOT NULL,
  `registration_due_date` date NOT NULL,
  `availability` bit(1) NOT NULL,
  `image_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `chassie_number`, `kilometers_passed`, `registration`, `registration_date`, `registration_due_date`, `availability`, `image_name`) VALUES
(1, 'MERCEDES S550 benzin-gaz LUK AMG', 'SV30-0169266', '249 999', '05-695-AO', '2021-02-02', '2022-02-05', b'1', 'car1.jpeg'),
(2, 'MERCEDES C 220 CDI AMG LINE 2015', '1HGBH41JXMN109186', '189 999', '01-820-OF', '2021-10-12', '2022-10-25', b'1', 'car2.jpeg'),
(3, 'Audi80', '1.8', '25', '03-184-KS', '2022-02-01', '2036-02-19', b'1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
