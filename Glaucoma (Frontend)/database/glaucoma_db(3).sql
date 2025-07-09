-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 07:31 AM
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
-- Database: `glaucoma_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('User') DEFAULT 'User',
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `username`, `email`, `phone`, `password`, `user_type`, `status`, `created_at`) VALUES
(1, 'rachitha', 'rachithacharya18@gmail.com', '1236547895', '$2y$10$6h18wFnYfx/uzFAzBPC4s.upHKV7CRT9r7NoTz6dTx4mduZsglH5i', 'User', 'Active', '2025-01-28 06:41:50'),
(2, 'test', 'test@gmail.com', '8521479637', '$2y$10$bdqOsLTCHA86GzfI3VoWK.np3sARyhsjVYM7EGnNZR3Q0VjYTc0a6', 'User', 'Active', '2025-02-12 11:41:11'),
(3, 'geetha', 'geetha@gmail.com', '9519519519', '$2y$10$HLc5HZ7DF4ydBFWnJajI6.RE/6nBB01XTv8NKL1cj9oYmuSpjMkNC', 'User', 'Active', '2025-02-20 06:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `prediction` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `name`, `email`, `age`, `gender`, `description`, `prediction`, `created_at`) VALUES
(1, 'Rachitha R', 'rachithacharya18@gmail.com', 24, 'Female', 'ahvdbsd', 'Glaucoma Detected', '2025-02-20 04:53:52'),
(2, 'Rachitha R', 'rachithacharya18@gmail.com', 24, 'Female', 'adsfv', 'Glaucoma Detected', '2025-02-20 04:57:05'),
(3, 'Rachitha R', 'rachithacharya18@gmail.com', 18, 'Female', '', 'Glaucoma Detected', '2025-02-20 05:13:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
