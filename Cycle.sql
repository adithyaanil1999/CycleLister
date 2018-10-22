-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2018 at 02:46 AM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Cycle`
--

-- --------------------------------------------------------

--
-- Table structure for table `cycle_list`
--

CREATE TABLE `cycle_list` (
  `Chasis_no` varchar(30) DEFAULT NULL,
  `reg_no` varchar(15) DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `location` varchar(5) DEFAULT NULL,
  `available` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cycle_rec`
--

CREATE TABLE `cycle_rec` (
  `id` int(11) NOT NULL,
  `chasis_no` varchar(30) DEFAULT NULL,
  `sponsor_reg` varchar(20) DEFAULT NULL,
  `renter_reg` varchar(20) DEFAULT NULL,
  `start_Time` timestamp NULL DEFAULT NULL,
  `end_Time` timestamp NULL DEFAULT NULL,
  `ret_status` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `renter`
--

CREATE TABLE `renter` (
  `id_renter` varchar(15) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `block` varchar(2) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_login`
--

CREATE TABLE `r_login` (
  `reg_r` varchar(15) NOT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `id_sponsor` varchar(15) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `block` varchar(2) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `wallet_sponsor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s_login`
--

CREATE TABLE `s_login` (
  `reg_s` varchar(15) NOT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trans_cycle`
--

CREATE TABLE `trans_cycle` (
  `id_trans` int(11) NOT NULL,
  `t_diff` int(40) DEFAULT NULL,
  `total` int(30) DEFAULT NULL,
  `id_rec` varchar(30) NOT NULL,
  `t_status` varchar(3) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cycle_list`
--
ALTER TABLE `cycle_list`
  ADD UNIQUE KEY `Chasis_no` (`Chasis_no`),
  ADD KEY `reg_no` (`reg_no`);

--
-- Indexes for table `cycle_rec`
--
ALTER TABLE `cycle_rec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renter`
--
ALTER TABLE `renter`
  ADD KEY `id_renter` (`id_renter`);

--
-- Indexes for table `r_login`
--
ALTER TABLE `r_login`
  ADD PRIMARY KEY (`reg_r`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id_sponsor`);

--
-- Indexes for table `s_login`
--
ALTER TABLE `s_login`
  ADD PRIMARY KEY (`reg_s`);

--
-- Indexes for table `trans_cycle`
--
ALTER TABLE `trans_cycle`
  ADD PRIMARY KEY (`id_trans`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cycle_rec`
--
ALTER TABLE `cycle_rec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trans_cycle`
--
ALTER TABLE `trans_cycle`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cycle_list`
--
ALTER TABLE `cycle_list`
  ADD CONSTRAINT `cycle_list_ibfk_1` FOREIGN KEY (`reg_no`) REFERENCES `s_login` (`reg_s`) ON DELETE CASCADE;

--
-- Constraints for table `renter`
--
ALTER TABLE `renter`
  ADD CONSTRAINT `renter_ibfk_1` FOREIGN KEY (`id_renter`) REFERENCES `r_login` (`reg_r`) ON DELETE CASCADE;

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `sponsor_ibfk_1` FOREIGN KEY (`id_sponsor`) REFERENCES `s_login` (`reg_s`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
