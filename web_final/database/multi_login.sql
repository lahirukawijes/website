-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2018 at 10:41 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply_details`
--

CREATE TABLE `apply_details` (
  `apply_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `JobCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply_details`
--

INSERT INTO `apply_details` (`apply_id`, `id`, `JobCode`) VALUES
(5, 6, '1234'),
(6, 6, 'IS1102'),
(7, 6, 'Is1234');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `tel` int(12) DEFAULT NULL,
  `gender` text,
  `user_type` text NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `address`, `email`, `tel`, `gender`, `user_type`, `password`) VALUES
(1, 'Admin', 'galle south', 'admin@company.com', 717608795, 'Male', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(6, 'Lahiruka', 'Temple Rd, Kaluwella, Galle.', 'lahiruka.wijesinghe@gmail.com', 213456789, 'Female', 'user', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `JobCode` varchar(10) NOT NULL,
  `position` varchar(100) NOT NULL,
  `ClosingDate` date NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`JobCode`, `position`, `ClosingDate`, `description`) VALUES
('1234', 'pissek', '2018-11-30', 'qwertyu werty'),
('IS1102', 'Excecutive officer', '2018-11-30', ''),
('Is1234', 'qwertyui', '2018-11-29', 'qwertyu wertyuiop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply_details`
--
ALTER TABLE `apply_details`
  ADD PRIMARY KEY (`apply_id`),
  ADD KEY `JobCode` (`JobCode`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`JobCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply_details`
--
ALTER TABLE `apply_details`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply_details`
--
ALTER TABLE `apply_details`
  ADD CONSTRAINT `JobCode` FOREIGN KEY (`JobCode`) REFERENCES `vacancies` (`JobCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
