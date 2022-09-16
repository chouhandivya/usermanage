-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 16, 2022 at 07:08 PM
-- Server version: 8.0.30-0ubuntu0.20.04.2
-- PHP Version: 7.2.34-28+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_manage`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `date_of_join` date DEFAULT NULL,
  `date_of_leave` date DEFAULT NULL,
  `still_work` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `date_of_join`, `date_of_leave`, `still_work`, `image`, `status`, `created_at`) VALUES
(19, 'bhanupratap singh chouhan', 'abc.123@gmail.com', '2017-10-23', NULL, 1, '192053166326965363237b15009a1.jpeg', 1, '2022-09-15 19:20:53'),
(20, 'divya chouhan', 'ds.123@gmail.com', '2019-01-10', NULL, 1, '192211166326973163237b63d6606.jpeg', 1, '2022-09-15 19:22:11'),
(21, 'RAHUL SINGH', 'ds.123@gmail.com', '2015-07-09', '2022-05-11', 0, '192311166326979163237b9fefd01.jpeg', 1, '2022-09-15 19:23:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
