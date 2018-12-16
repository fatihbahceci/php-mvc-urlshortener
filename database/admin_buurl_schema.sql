-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2018 at 07:43 PM
-- Server version: 10.1.37-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_buurl`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemclickedrequest`
--

CREATE TABLE `itemclickedrequest` (
  `ID` int(11) NOT NULL,
  `ShortURL` varchar(10) NOT NULL,
  `UrlReferrer` varchar(2000) NOT NULL,
  `HttpMethod` varchar(50) NOT NULL,
  `IsLocal` tinyint(1) NOT NULL,
  `RequestDateTime` datetime NOT NULL,
  `RequestURL` varchar(2000) NOT NULL,
  `UserAgent` varchar(2000) DEFAULT NULL,
  `UserHostName` varchar(2000) DEFAULT NULL,
  `UserHostAddress` varchar(100) DEFAULT NULL,
  `AgentType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `surl`
--

CREATE TABLE `surl` (
  `ShortURL` varchar(10) NOT NULL,
  `LongURL` varchar(2000) NOT NULL,
  `Created` datetime NOT NULL,
  `TotalClicks` int(11) NOT NULL,
  `LastClicked` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sysuserdata`
--

CREATE TABLE `sysuserdata` (
  `Id` int(11) NOT NULL,
  `UserName` varchar(60) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemclickedrequest`
--
ALTER TABLE `itemclickedrequest`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `surl`
--
ALTER TABLE `surl`
  ADD PRIMARY KEY (`ShortURL`);

--
-- Indexes for table `sysuserdata`
--
ALTER TABLE `sysuserdata`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itemclickedrequest`
--
ALTER TABLE `itemclickedrequest`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58572;
--
-- AUTO_INCREMENT for table `sysuserdata`
--
ALTER TABLE `sysuserdata`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
