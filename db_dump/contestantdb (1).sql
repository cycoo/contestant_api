-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2017 at 05:21 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contestantdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contestant`
--

CREATE TABLE `contestant` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'0',
  `district_id` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `photo_url` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contestant`
--

INSERT INTO `contestant` (`id`, `firstname`, `lastname`, `dob`, `is_active`, `district_id`, `gender`, `photo_url`, `address`) VALUES
(2, 'Manish', 'Maharjan', '2017-06-09', b'1', 8, 'Male', 'contestant-30510.jpg', 'manamiju'),
(3, 'Roshan', 'Maharjan', '2017-06-09', b'0', 1, 'Male', 'contestant-26025.png', 'sanepa'),
(4, 'Durga', 'Dangol', '2017-01-02', b'1', 2, 'Female', 'contestant-25904.png', 'sainbu'),
(10, 'Omkar', 'Dangol', '2017-06-09', b'1', 2, 'Female', 'contestant-8819.jpg', 'sainbu'),
(11, 'Narayan', 'Dangol', '2017-06-09', b'0', 2, 'Female', 'contestant-20194.png', 'sainbu');

-- --------------------------------------------------------

--
-- Table structure for table `contestant_rating`
--

CREATE TABLE `contestant_rating` (
  `id` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `rated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contestant_rating`
--

INSERT INTO `contestant_rating` (`id`, `contestant_id`, `rating`, `rated_date`) VALUES
(1, 11, 2, '2017-06-01'),
(2, 10, 5, '2017-06-11'),
(3, 10, 5, '2017-06-11'),
(4, 10, 5, '2017-06-11'),
(5, 10, 5, '2017-06-11'),
(6, 10, 4, '2017-06-11'),
(7, 10, 4, '2017-06-11'),
(8, 10, 2, '2017-06-01'),
(9, 10, 1, '2017-06-11'),
(10, 10, 1, '2017-06-11'),
(11, 10, 1, '2017-06-11'),
(12, 10, 1, '2017-06-11'),
(13, 10, 1, '2017-06-11'),
(14, 10, 1, '2017-06-11'),
(15, 10, 1, '2017-06-11'),
(16, 10, 1, '2017-06-11'),
(17, 10, 1, '2017-06-11'),
(18, 4, 2, '2017-06-11'),
(19, 4, 3, '2017-06-11'),
(20, 4, 1, '2017-06-11'),
(21, 4, 2, '2017-06-11'),
(22, 4, 1, '2017-06-11'),
(23, 4, 5, '2017-06-11'),
(24, 2, 5, '2017-06-01'),
(25, 2, 2, '2017-06-06'),
(26, 2, 3, '2017-06-01'),
(27, 2, 5, '2017-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`) VALUES
(1, 'Kathmandu'),
(2, 'Lalitpur'),
(3, 'Bhaktapur'),
(4, 'Dhadhing'),
(5, 'Shindupalchowk'),
(6, 'Kavrepalnchowk'),
(7, 'Rasuwa'),
(8, 'Nuwakot');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contestant`
--
ALTER TABLE `contestant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contestant_rating`
--
ALTER TABLE `contestant_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contestant`
--
ALTER TABLE `contestant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `contestant_rating`
--
ALTER TABLE `contestant_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
