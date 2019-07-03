-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2019 at 11:04 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Xfcwj45_my_publications`
--
CREATE DATABASE IF NOT EXISTS `Xfcwj45_my_publications` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Xfcwj45_my_publications`;

-- --------------------------------------------------------

--
-- Table structure for table `Game`
--

CREATE TABLE `Game` (
  `gameID` int(10) NOT NULL,
  `gameName` varchar(60) NOT NULL,
  `yearPublished` int(11) NOT NULL,
  `numPlays` int(11) NOT NULL,
  `minPlayers` int(11) NOT NULL,
  `maxPlayers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Game`
--

INSERT INTO `Game` (`gameID`, `gameName`, `yearPublished`, `numPlays`, `minPlayers`, `maxPlayers`) VALUES
(13, 'Catan', 2010, 7, 2, 3),
(111, 'xixixi', 2010, 9, 2, 4),
(634, 'River Dragons', 2000, 10, 2, 6),
(40692, 'Small World', 2009, 12, 2, 5),
(70919, 'Takenoko', 2011, 5, 2, 4),
(123540, 'Tokaido', 2012, 6, 2, 5),
(167791, 'Terraforming Mars', 2016, 8, 1, 5),
(180974, 'Potion Explosion', 2016, 9, 2, 4),
(204583, 'Kingdomino', 2016, 8, 2, 4),
(232043, 'Queendomino', 2015, 4, 2, 4),
(247030, 'Terraforming Mars with Prelude', 2016, 2, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Matches`
--

CREATE TABLE `Matches` (
  `recordID` int(11) NOT NULL,
  `gameID` int(11) NOT NULL,
  `winner` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Matches`
--

INSERT INTO `Matches` (`recordID`, `gameID`, `winner`) VALUES
(1, 634, 'guo'),
(2, 40692, 'user1'),
(3, 204583, 'user1'),
(4, 40692, 'guo'),
(5, 634, 'user7'),
(6, 634, 'guo'),
(7, 111, 'guo'),
(8, 111, 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

CREATE TABLE `Members` (
  `playerID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `permission` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Members`
--

INSERT INTO `Members` (`playerID`, `username`, `password`, `email`, `firstname`, `lastname`, `permission`) VALUES
(1, 'user1', '944574d4a7b9e1fc61e811915925b47dbc27f12ee2eeb2051cadacfaa2e81e6a', 'user1@gmail.com', 'Jonny', 'Depp', 0),
(2, 'guo', '824bfbe7311b0086dccd0537b5f7b43a9c4d51eb34fea647a04decac7147da7d', 'guoxuantong1223@gmail.com', 'Xuantong', 'GUO', 1),
(3, 'user3', '2b01d14227b18c6aacee77b661b80549590d883f7db10380649768e1d5875847', 'user3@gmail.com', 'Angelina', 'Julie', 0),
(4, 'user4', '0272e0f18cab325a35748b01b226d8b006283675ee81a5f0f863524661e7b063', 'user4@gmail.com', 'Chloe', 'Clause', 0),
(5, 'user5', '4b6f94aea6e127c322ca9f3f96603e9e175da77904d57796590f124aa9cd43dc', 'user5@gmail.com', 'Honey', 'House', 0),
(6, 'user6', '696cb225ae8472422ae045478319885da08d20dc3a75561e0ec4882efa416764', 'user6@gmail.com', 'Stella', 'Dear', 0),
(7, 'user7', '96a3ca7ec3a56c9c9723e0c620011153a268cb73a8b20372bcaabeea408547fb', 'user7@gmail.com', 'Dior', 'Christine', 0),
(8, 'user8', '2e67fe0e71cf4229c3c2db7ca5ffd99476198b6388b35ce2ec106897bf14dcf9', 'user8@gmail.com', 'Fine', 'Im', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Records`
--

CREATE TABLE `Records` (
  `recordID` int(11) NOT NULL,
  `playerID` int(11) NOT NULL,
  `matchDate` date NOT NULL,
  `numPlayers` int(11) NOT NULL,
  `result` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Records`
--

INSERT INTO `Records` (`recordID`, `playerID`, `matchDate`, `numPlayers`, `result`) VALUES
(1, 1, '2019-02-14', 3, 'lose'),
(1, 2, '2019-02-14', 3, 'win'),
(1, 3, '2019-02-14', 3, 'lose'),
(2, 1, '2019-03-02', 4, 'win'),
(2, 2, '2019-03-02', 4, 'lose'),
(2, 4, '2019-03-02', 4, 'lose'),
(2, 5, '2019-03-02', 4, 'lose'),
(3, 1, '2019-03-08', 3, 'win'),
(3, 2, '2019-03-08', 3, 'lose'),
(3, 3, '2019-03-08', 3, 'lose'),
(4, 2, '2019-03-12', 2, 'win'),
(4, 4, '2019-03-12', 2, 'lose'),
(5, 2, '2019-03-13', 3, 'lose'),
(5, 4, '2019-03-13', 3, 'lose'),
(5, 7, '2019-03-13', 3, 'win'),
(6, 2, '2019-03-14', 2, 'win'),
(6, 6, '2019-03-14', 2, 'lose'),
(7, 1, '2019-03-20', 4, 'lose'),
(7, 2, '2019-03-20', 4, 'lose'),
(7, 3, '2019-03-20', 4, 'win'),
(7, 4, '2019-03-20', 4, 'lose'),
(8, 1, '2019-03-20', 2, 'win'),
(8, 4, '2019-03-20', 2, 'lose');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Game`
--
ALTER TABLE `Game`
  ADD PRIMARY KEY (`gameID`);

--
-- Indexes for table `Matches`
--
ALTER TABLE `Matches`
  ADD PRIMARY KEY (`recordID`),
  ADD KEY `game_ibfk_1` (`gameID`);

--
-- Indexes for table `Members`
--
ALTER TABLE `Members`
  ADD PRIMARY KEY (`playerID`);

--
-- Indexes for table `Records`
--
ALTER TABLE `Records`
  ADD PRIMARY KEY (`recordID`,`playerID`),
  ADD KEY `player_ibfk_2` (`playerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Game`
--
ALTER TABLE `Game`
  MODIFY `gameID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247031;

--
-- AUTO_INCREMENT for table `Members`
--
ALTER TABLE `Members`
  MODIFY `playerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Matches`
--
ALTER TABLE `Matches`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`gameID`) REFERENCES `Game` (`gameID`);

--
-- Constraints for table `Records`
--
ALTER TABLE `Records`
  ADD CONSTRAINT `player_ibfk_2` FOREIGN KEY (`playerID`) REFERENCES `Members` (`playerID`),
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`recordID`) REFERENCES `Matches` (`recordID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
