-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 01, 2024 at 08:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'admin', '$2y$10$XeiSYngaHEdP39UIev2HU.2vM2caZkt1sPtteh/4p68VCZW7xDglC', 'Matthew', 'Solar', 'facebook-profile-image.jpeg', '2018-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `age` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `platform` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `fullname`, `age`, `photo`, `platform`) VALUES
(72, 34, 'Vincent Obejera', '20', '', 'I am good'),
(73, 35, 'Earl John Aborca', '21', '', 'I WILL SERVE AS ONE'),
(74, 34, 'Arian Nartea', '21', '', 'WE WILL SERVE AS ONE'),
(75, 35, 'John Doe ', '21', '', 'I will be good'),
(76, 36, 'Jessa Marie Mendoza', '21', 'logo-voting.jpeg', 'WE WILL SERVE AS ONE'),
(78, 36, 'Mon Greg Apilado', '21', '', 'tesafdgshrs'),
(80, 36, 'Elasamie Canamaso', '21', '', 'WE WILL SERVE'),
(81, 42, 'Abegail Parena', '21', '', 'WE WILL'),
(82, 42, 'Keim Afable', '21', '', 'advev e'),
(83, 42, 'Dennis Biscante', '21', '', 'dqcwve'),
(84, 42, 'Rhealyn Dadacay ', '21', '', 'CAWQCVWQ'),
(85, 43, 'Janice Cuizon ', '21', '', 'cwvewv'),
(86, 43, 'Rhealyn Acuin', '21', '', 'fqwqfvew'),
(87, 43, 'Reymark Cabanacan', '21', '', 'cwfewsc'),
(88, 43, 'Sherwin Juli', '21', '', 'mnjfjfhg'),
(89, 63, 'Erica Gayo', '21', '', 'svdsveewf'),
(90, 63, 'Rodel Oriol', '21', '', 'vwevwegvd'),
(91, 63, 'Rollan Erron Arguelles', '21', '', 'vswebvws'),
(92, 63, 'Matthew Solar', '21', '', 'sdvwevwew'),
(93, 62, 'Dannielle Marie Prefetana', '21', '', 'cfwefew'),
(94, 62, 'Fredirick Bravo', '21', '', 'cacsawqca'),
(95, 62, 'Wilson Binban ', '21', '', 'dfacsvas'),
(96, 62, 'Rejay Diegor', '21', '', 'vsvdwsrbws'),
(97, 45, 'Jerome Avila', '21', '', 'vsdewve'),
(98, 45, 'Shanel Rizzie Canas', '21', '', 'cvsvdvd'),
(99, 45, 'Louela Mae Acerden', '21', '', 'svdsdweve'),
(100, 45, 'John Mark Arce', '21', '', 'vsdsvsvwsd');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countdown`
--

CREATE TABLE `countdown` (
  `id` int(50) NOT NULL,
  `countdown` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countdown`
--

INSERT INTO `countdown` (`id`, `countdown`) VALUES
(123, '2024-08-29 15:05:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `max_vote` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `description`, `max_vote`, `priority`) VALUES
(34, 'PRESIDENT', 1, 1),
(35, 'VICE-PRESIDENT', 1, 2),
(36, 'BTVTED_AFA', 2, 3),
(42, 'BSED_MATH ', 2, 4),
(43, 'BSED_SCIENCE', 2, 5),
(45, 'BS_ENTREP ', 2, 6),
(62, 'BSFI ', 2, 7),
(63, 'BSIT', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_image`
--

CREATE TABLE `tb_image` (
  `id` int(11) NOT NULL,
  `camera_upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_image`
--

INSERT INTO `tb_image` (`id`, `camera_upload`) VALUES
(29, '1715427196.jpg'),
(30, '1715427235.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `course` enum('BTVTED_AFA','BSED_MATH','BSED_SCIENCE','BSIT','BS_ENTREP','BSFI') NOT NULL,
  `email` varchar(100) NOT NULL,
  `studentid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `password`, `fullname`, `course`, `email`, `studentid`) VALUES
(87, '$2y$10$orAfzYh7eq7RjrX0d1AYLehE5cycZvYgsl.jkt//W.9ocJms9ujIq', 'Vincent Obejera', 'BSIT', 'matthewsolar@evsu.edu.ph', '2021-25669'),
(89, '$2y$10$4f0bOUzAuheZVWSnVEePeuPrYYmrInebtkMS0zXnJSxm13vLyICy.', 'Rosemarie Rosal', 'BTVTED_AFA', 'matthewsolar@evsu.edu.ph', '2021-25248'),
(90, '$2y$10$eTe7Pu539weMLj8lYYXDt.N5eTp9oxl2/LF.wnenkFbLk5BzUlHKm', 'John', 'BSED_MATH', 'matthewsolar@evsu.edu.ph', '2021-255555'),
(91, '$2y$10$nNx3ZFQAplcJm.PiDBDVj.Anf.r1Mg5Z0vGGP8Bo.6WZuauOb1sQ6', 'Adelfa Astiga ', 'BSED_MATH', 'matthewsolar@evsu.edu.ph', '2021-255559'),
(92, '$2y$10$Lv5lz1yp2o7wNFPduVmZz.8/qRwl4EhHMF6BhGYXkEl8i9uU1I6my', 'Matthew Solar', 'BTVTED_AFA', 'matthewsolar@evsu.edu.ph', '2021-2555555'),
(93, '$2y$10$6bnayaQOMoshwLMWRgBOmu3elQqpVhjfJ1BnGkHXjBgzEuLiIor1q', 'Eric', 'BSED_SCIENCE', 'matthewsolar@evsu.edu.ph', '2021-12345'),
(94, '$2y$10$XPFsG4Suo0/3WsMxlD2VCe6M3B2hmsLA.Gv5EDVDUKBdZ7co53pIa', 'Luisses', 'BS_ENTREP', 'matthewsolar@evsu.edu.ph', '2021-123456'),
(95, '$2y$10$AqSmwwBmLxVpMqQUdL6sIuuKxhv0H06PhgoI70dEb315JEKm.A7QK', 'Goten', 'BS_ENTREP', 'matthewsolar@evsu.edu.ph', '2021-1234567'),
(96, '$2y$10$tR8mUyvDHDE3rfiSqa9S3.UhY/81YCFcVL.9alvCjmM.Y8z4m1BVS', 'Koreek', 'BSED_SCIENCE', 'matthewsolar@evsu.edu.ph', '2021-12345678'),
(97, '$2y$10$wy5gAtBaXMHkjbqi9WUgF.QyCzRW6pTmwUvanycjhrIZRaCPg..SC', 'Kalaw', 'BSFI', 'matthewsolar@evsu.edu.ph', '2021-123456789');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voting_list`
--

CREATE TABLE `voting_list` (
  `id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `countdown`
--
ALTER TABLE `countdown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_image`
--
ALTER TABLE `tb_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting_list`
--
ALTER TABLE `voting_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countdown`
--
ALTER TABLE `countdown`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tb_image`
--
ALTER TABLE `tb_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=429;

--
-- AUTO_INCREMENT for table `voting_list`
--
ALTER TABLE `voting_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
