-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2023 at 01:21 PM
-- Server version: 5.7.42
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrazzak_bball`
--

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

CREATE TABLE `conference` (
  `conference_id` int(11) NOT NULL,
  `conference_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`conference_id`, `conference_name`) VALUES
(1, 'West'),
(2, 'East');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `playerId` int(11) NOT NULL,
  `player_name` varchar(45) DEFAULT NULL,
  `conference_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `ppg` double DEFAULT NULL,
  `apg` double DEFAULT NULL,
  `rpg` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`playerId`, `player_name`, `conference_id`, `team_id`, `ppg`, `apg`, `rpg`) VALUES
(140, 'Kevin Durant', 1, 24, 29.06, 5, 6.66),
(145, 'Joel Embiid', 2, 23, 33.08, 4.15, 10.15),
(237, 'LeBron James', 1, 14, 28.93, 6.8, 8.34),
(278, 'Damian Lillard', 1, 25, 32.17, 7.33, 4.78);

-- --------------------------------------------------------

--
-- Table structure for table `starting_five`
--

CREATE TABLE `starting_five` (
  `temp` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `player_name` varchar(45) NOT NULL,
  `conference` int(11) NOT NULL,
  `team` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `starting_five`
--

INSERT INTO `starting_five` (`temp`, `user_id`, `player_name`, `conference`, `team`) VALUES
(1, 1, 'Stephen Curry', 1, 10),
(2, 1, 'Klay Thompson', 1, 10),
(3, 1, 'Andrew Wiggins', 1, 10),
(4, 1, 'Draymond Green', 1, 10),
(5, 1, 'Kevon Looney', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`) VALUES
(1, 'Atlanta Hawks'),
(2, 'Boston Celtics'),
(3, 'Brooklyn Nets'),
(4, 'Charlotte Hornets'),
(5, 'Chicago Bulls'),
(6, 'Cleveland Cavaliers'),
(7, 'Dallas Mavericks'),
(8, 'Denver Nuggets'),
(9, 'Detroit Pistons'),
(10, 'Golden State Warriors'),
(11, 'Houston Rockets'),
(12, 'Indiana Pacers'),
(13, 'Los Angeles Clippers'),
(14, 'Los Angeles Lakers'),
(15, 'Memphis Grizzlies'),
(16, 'Miami Heat'),
(17, 'Milwaukee Bucks'),
(18, 'Minnesota Timberwolves'),
(19, 'New Orleans Pelicans'),
(20, 'New York Knicks'),
(21, 'Oklahoma City Thunder'),
(22, 'Orlando Magic'),
(23, 'Philadelphia 76ers'),
(24, 'Phoenix Suns'),
(25, 'Portland Trail Blazers'),
(26, 'Sacramento Kings'),
(27, 'San Antonio Spurs'),
(28, 'Toronto Raptors'),
(29, 'Utah Jazz'),
(30, 'Washington Wizards');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'hrazzak', 'hrazzak@usc.edu', '123'),
(2, 'testtest', 'test@gmail', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`conference_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`playerId`);

--
-- Indexes for table `starting_five`
--
ALTER TABLE `starting_five`
  ADD PRIMARY KEY (`temp`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
