-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 07:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_laibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailplaylist`
--

CREATE TABLE `detailplaylist` (
  `id` int(11) NOT NULL,
  `playlistid` varchar(255) NOT NULL,
  `playlistname` varchar(250) NOT NULL,
  `visibility` varchar(250) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `movieid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailplaylist`
--

INSERT INTO `detailplaylist` (`id`, `playlistid`, `playlistname`, `visibility`, `userid`, `movieid`) VALUES
(13, '6', 'safari', 'private', '4', 'tt9032400'),
(15, '7', 'fav', 'public', '9', 'tt0176741'),
(16, '7', 'fav', 'public', '9', 'tt0441773'),
(17, '8', 'Hollywood', 'public', '4', 'tt1905041'),
(19, '6', 'safari', 'private', '4', 'tt0441773'),
(22, '16', 'fav', 'public', '4', 'tt0286716'),
(23, '16', 'fav', 'public', '4', 'tt0983193'),
(24, '16', 'fav', 'public', '4', 'tt0371746'),
(25, '16', 'fav', 'public', '4', 'tt0304120'),
(26, '8', 'Hollywood', 'public', '4', 'tt9243946'),
(27, '8', 'Hollywood', 'public', '4', 'tt0141926');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `playlistname` varchar(255) NOT NULL,
  `visibility` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `userid`, `playlistname`, `visibility`) VALUES
(6, '4', 'safari', 'private'),
(7, '9', 'fav', 'public'),
(8, '4', 'Hollywood', 'public'),
(16, '4', 'fav', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(4, 'Manulla', 'manulla@gmail.com', '123'),
(9, 'sam', 'sam@gmail.com', '000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailplaylist`
--
ALTER TABLE `detailplaylist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailplaylist`
--
ALTER TABLE `detailplaylist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
