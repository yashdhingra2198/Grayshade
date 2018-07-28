-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 14, 2018 at 10:21 AM
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
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `initialised_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`, `initialised_by`) VALUES
(57, 'yash_dhingra', 'himanshi_gupta', 'hey ', '2018-02-11 06:01:36', 'yes', 'yes', 'no', 'himanshi_gupta'),
(58, 'himanshi_gupta', 'yash_dhingra', 'hello', '2018-02-11 06:02:18', 'yes', 'yes', 'no', 'himanshi_gupta'),
(59, 'himanshi_gupta', 'yash_dhingra', 'hqqqqqqq', '2018-02-11 06:08:29', 'yes', 'yes', 'no', 'yash_dhingra'),
(60, 'yash_dhingra', 'himanshi_gupta', 'burrrr', '2018-02-11 06:17:45', 'yes', 'yes', 'no', 'yash_dhingra');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `anonymous_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `anonymous_profile_pic` varchar(255) NOT NULL,
  `user_closed` text NOT NULL,
  `isEmailConfirmed` tinyint(4) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `anonymous_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `anonymous_profile_pic`, `user_closed`, `isEmailConfirmed`, `token`) VALUES
(11, 'Yashu', 'Dhingra', 'founder', 'yash_dhingra', 'Yash@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2018-02-06', 'assets/images/profile_pics/yash_dhingra61841f00c8782c03ebddcdd9bbacf5e6n.jpeg', 'assets/images/profile_pics/defaults/head_deep_blue.png', 'no', 0, ''),
(12, 'Himanshi', 'Gupta', 'Ballu1234', 'himanshi_gupta', 'Him@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2018-02-06', 'assets/images/profile_pics/himanshi_gupta296014413fdd219278b1f198e5bee340n.jpeg', 'assets/images/profile_pics/defaults/head_deep_blue.png', 'no', 0, ''),
(13, 'Ayan', 'Chopra', 'Gandu', 'ayan_chopra', 'Ayan@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2018-02-08', 'assets/images/profile_pics/defaults/head_deep_blue.png', 'assets/images/profile_pics/defaults/head_deep_blue.png', 'no', 0, ''),
(21, 'Tanya', 'Gupta', 'Hitler', 'tanya_gupta', 'yashdhingra2198@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2018-02-11', 'assets/images/profile_pics/defaults/head_emerald.png', 'assets/images/profile_pics/defaults/head_emerald.png', 'no', 0, 'NKCs7EY80x'),
(22, 'Yash', 'Dhingra', 'Ceo', 'yash_dhingra_1', 'yash1@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2018-02-12', 'assets/images/profile_pics/defaults/head_emerald.png', 'assets/images/profile_pics/defaults/head_emerald.png', 'no', 0, 'jhNGEwqPBI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
