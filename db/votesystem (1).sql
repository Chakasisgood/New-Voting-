-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2024 at 05:11 AM
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
(63, 25, 'Matthew Solar', '20', '', 'Hello'),
(64, 25, 'Jerson Aballa', '20', '', 'John'),
(65, 26, 'John Doe', '20', '', 'We will apply this world'),
(66, 26, 'Hello Catagumpay', '20', '', 'The quick brown fox jump over the lazy dog ');

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
(75, '2024-05-13 04:30:00.000000'),
(76, '2024-05-13 15:43:00.000000'),
(77, '2024-05-13 15:45:00.000000'),
(78, '2024-05-13 15:49:00.000000'),
(79, '2024-05-13 15:52:00.000000'),
(80, '2024-05-14 02:52:00.000000'),
(81, '2024-05-16 14:05:00.000000'),
(82, '2024-05-21 15:59:00.000000'),
(83, '2024-05-23 09:17:00.000000');

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
(25, 'President', 1, 1),
(26, 'Vice President', 1, 2);

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
  `course` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `studentid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `password`, `fullname`, `course`, `email`, `studentid`) VALUES
(51, '$2y$10$eLc8VoLsw1la6tTZ3YzZ4eXTKwEkf7x.M8ZBGRKv3T2/aC8aqhNiK', 'Mattthew Solar', 'BSIT', 'matthewsolar@gmail.com', '2021-25669'),
(52, '$2y$10$qGolI2ICC3kKmJO540ZZIuzt4eG3wvKhdeBYjwbAwkRmD/63j4TX6', 'Rodel Oriol', 'BSIT', 'rodel.oriol@evsu.edu.ph', '2021-25515'),
(53, '$2y$10$zW0mc18BswE/YKd5eh0dNe1Qu5WVqv.uyj42S0zjmpXEysEhTJb26', 'Ronel Colibao', 'BSIT', 'ronel.colibao@evsu.edu.ph', '2021-25152'),
(54, '$2y$10$vk5U6SUsn7ez8fTy0YuD6.wLSStufyNEpYmZwaQCuVq3xt1kaVgta', 'Kyle Norwin J. Quilaquil', 'BSIT', 'kylenorwin.quilaquil@evsu.edu.ph', '2021-25114'),
(55, '$2y$10$NvdB5HmK2jzegeGGhefEluBgLTgy5LL.GE4IS2005e.pPeMYnbosS', 'Rosemarie Rosal', 'BSIT', 'rosemarie.rosal@evsu.edu.ph', '2021-25248'),
(56, '$2y$10$cg3y.RKQXPFIw.Zi2Bog7OkAHTLblsNn6AZIsg/hgAkD4mtOSxb56', 'Radgie Lopez', 'BSIT', 'radgielopez23@evsu.edu.ph', '2021-25382'),
(57, '$2y$10$N/o059jNrkoynQEfaxbaf.MCCuyTEwzJGsipKM5AiAUE2z6K483WO', 'Vincent LoveH', 'BSIT', 'matthewsolar09@gmail.com', '2021-25413');

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

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voters_id`, `candidate_id`, `position_id`) VALUES
(168, 54, 65, 26),
(169, 55, 63, 25),
(170, 55, 65, 26),
(171, 56, 63, 25),
(172, 56, 66, 26);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countdown`
--
ALTER TABLE `countdown`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_image`
--
ALTER TABLE `tb_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `voting_list`
--
ALTER TABLE `voting_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
