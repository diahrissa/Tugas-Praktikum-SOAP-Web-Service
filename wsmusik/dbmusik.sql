-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2021 at 04:46 PM
-- Server version: 8.0.18
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmusik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_musik`
--

CREATE TABLE `tbl_musik` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `penyanyi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `genre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_musik`
--

INSERT INTO `tbl_musik` (`id`, `title`, `penyanyi`, `genre`) VALUES
(1, 'DYNAMITE', 'BTS', 'Pop-KPop'),
(3, 'Boy With Luv', 'BTS', 'Pop Funk'),
(4, 'Sweet Night', 'BTS-V', 'Rock Ballad'),
(5, 'Beraksi', 'Kotak', 'Rock'),
(15, 'Butter', 'BTS', 'Pop, Funk-Rock'),
(16, 'Life Goes On', 'BTS', 'KPOP'),
(17, 'To The Bone', 'Pamungkas', 'Pop'),
(18, 'Any Song', 'Zico', 'Pop-Kpop'),
(19, 'I Love You 3000', 'Stephanie Poetri', 'Pop'),
(20, 'Lathi', 'Weird Genius ft.Sara Fajira', 'Pop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_musik`
--
ALTER TABLE `tbl_musik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_musik`
--
ALTER TABLE `tbl_musik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
