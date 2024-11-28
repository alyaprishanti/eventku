-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 03:31 AM
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
-- Database: `eventku`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `kategori` varchar(255) NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(235) NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `booth_count` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `image` varchar(235) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`kategori`, `id`, `title`, `date`, `time_start`, `time_end`, `location`, `price`, `booth_count`, `description`, `image`) VALUES
('ssadad', 30, 'sdad', '1111-01-01', '12:12:00', '23:02:00', 'Surabayas', 23123, 12321, 'Ssnasnaksc', 'uploads/WhatsApp Image 2024-11-20 at 13.48.39_56b0ffac.jpg'),
('sdasdsad', 34, '213', '2332-03-12', '12:03:00', '13:23:00', 'acacscscs', 123, 132, 's', 'uploads/neurologi2.png'),
('katego111', 37, 'sdasd1231231231222', '1232-03-12', '04:02:00', '05:23:00', 'asdc', 123, 3, 'SDSadwads', 'uploads/Screenshot (23).png'),
('sdasdasd', 38, 'nyengir', '1232-03-12', '12:03:00', '23:03:00', 'ascascasc', 123, 124, 'asacas', 'uploads/BYU04889.JPG'),
('asdaa', 39, 'asd1', '2322-03-12', '12:03:00', '05:32:00', 'ascase', 123123, 124124, 'ascasc', 'uploads/gastroenterologi.png'),
('asdaa', 40, 'asd1', '2322-03-12', '12:03:00', '05:32:00', 'ascase', 123123, 124124, 'ascasc', 'uploads/image (15).png'),
('asdaa', 41, 'asd1', '2322-03-12', '12:03:00', '05:32:00', 'ascases', 123123, 124124, 'ascasc', 'uploads/image (15).png'),
('s', 42, 's', '1222-02-02', '02:02:00', '03:03:00', '123', 123, 123, '12', 'uploads/ortopedi2.png'),
('s', 43, 's', '2222-03-12', '03:01:00', '12:04:00', 'asd', 123, 2412, 'asa', 'uploads/JudulAwal.png'),
('asadqw1', 44, '1wdq', '2222-12-12', '12:03:00', '03:14:00', 'acs', 12323, 123, '41dasdssss', 'uploads/neurologi2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
