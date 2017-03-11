-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2017 at 04:03 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `forumgroup`
--

CREATE TABLE `forumgroup` (
  `idGroup` varchar(20) NOT NULL,
  `groupName` varchar(20) NOT NULL,
  `totalUser` int(40) NOT NULL,
  `groupAdmin` varchar(30) NOT NULL,
  `mainPost` text NOT NULL,
  `timeStamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `groupId` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userName` varchar(30) NOT NULL,
  `fullName` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthDay` date NOT NULL,
  `passWord` varchar(255) NOT NULL,
  `timeStamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userName`, `fullName`, `email`, `gender`, `birthDay`, `passWord`, `timeStamp`) VALUES
('yoko', 'Kuncoro Yoko', 'yoko@abc.com', 'M', '1996-03-06', 'kuncoro', '2017-03-11 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forumgroup`
--
ALTER TABLE `forumgroup`
  ADD PRIMARY KEY (`idGroup`),
  ADD KEY `grp_usr_idx` (`groupAdmin`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userName`),
  ADD UNIQUE KEY `usr_email_unq` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
