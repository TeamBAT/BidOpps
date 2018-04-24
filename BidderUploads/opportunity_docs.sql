-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2018 at 04:10 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bidopps_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `opportunity_docs`
--

CREATE TABLE `opportunity_docs` (
  `document_id` int(11) NOT NULL,
  `filename` varchar(45) NOT NULL,
  `filepath` varchar(100) NOT NULL,
  `filetype` varchar(45) NOT NULL,
  `filesize` varchar(45) NOT NULL,
  `subheading` varchar(100) NOT NULL,
  `documentTitle` varchar(100) NOT NULL,
  `data` longblob,
  `opportunity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `opportunity_docs`
--
ALTER TABLE `opportunity_docs`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `opportunity_id_idx` (`opportunity_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `opportunity_docs`
--
ALTER TABLE `opportunity_docs`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `opportunity_docs`
--
ALTER TABLE `opportunity_docs`
  ADD CONSTRAINT `opportunity_id` FOREIGN KEY (`opportunity_id`) REFERENCES `opportunities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
