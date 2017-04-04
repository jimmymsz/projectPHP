-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2017 at 01:46 PM
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

--
-- Dumping data for table `forumgroup`
--

INSERT INTO `forumgroup` (`idGroup`, `groupName`, `totalUser`, `groupAdmin`, `mainPost`, `timeStamp`) VALUES
('dhunter', 'Dragon Hunter', 1, 'yoko', 'abcdef', '2017-03-20 05:50:57'),
('php', 'Grup PHP', 1, 'yoko', '', '2017-03-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `grouptask`
--

CREATE TABLE `grouptask` (
  `taskId` int(11) NOT NULL,
  `taskName` varchar(20) NOT NULL,
  `taskDetail` text,
  `status` tinyint(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  `groupid` varchar(20) NOT NULL,
  `timeStamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grouptask`
--

INSERT INTO `grouptask` (`taskId`, `taskName`, `taskDetail`, `status`, `username`, `groupid`, `timeStamp`) VALUES
(2, 'Save Hypnos', 'Go to Eden', 0, 'feery', 'dhunter', '2017-04-02 20:31:41'),
(3, 'Fetch Dragonslayer', 'Meet the Lucier first', 1, 'yoko', 'dhunter', '2017-04-02 20:38:36'),
(5, 'Join the fray', 'Meet the boss at lv 5', 0, 'yoko', 'dhunter', '2017-04-02 20:42:31'),
(6, 'Clear the Area', '', 0, 'kuncoro', 'dhunter', '2017-04-02 20:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `groupId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberId`, `userName`, `groupId`) VALUES
(1, 'yoko', 'php'),
(3, 'yoko', 'dhunter'),
(4, 'kuncoro', 'dhunter'),
(6, 'kuncoro', 'php'),
(7, 'feery', 'dhunter');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `groupId` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`idPost`, `userName`, `groupId`, `title`, `content`, `timestamp`) VALUES
(2, 'yoko', 'php', '7th Heaven', 'Even if fate wears me down, I won''t stop wishing for my hopes to come true ', '2017-03-11 00:00:00'),
(3, 'yoko', 'php', 'odd and end', 'I am you\r\nYou am I', '2017-03-13 07:09:11'),
(4, 'yoko', 'public', 'Mandi Makan Tidur', 'abis mandi, makan, tidur', '2017-03-14 17:34:24'),
(5, 'laymana', 'public', 'Left and Right', 'Nothing left and Nothing right', '2017-03-19 12:17:58'),
(6, 'yoko', 'public', 'Melt', 'Embrace me, if we hadn''t met, here \r\n', '2017-03-20 04:26:35'),
(7, 'yoko', 'public', 'asdf', 'asdfasdf', '2017-03-20 04:27:24'),
(8, 'yoko', 'php', 'asdfasd', 'asdfadsf', '2017-03-20 04:27:42'),
(15, 'yoko', 'dhunter', 'VFD', 'The Last One', '2017-03-20 06:01:26'),
(16, 'kuncoro', 'public', 'Up and Down', 'Getting up and getting down', '2017-03-20 08:18:32'),
(17, 'kuncoro', 'public', 'Left and Riht', 'flamenwerfen', '2017-03-20 08:20:47'),
(18, 'feery', 'public', 'lol', 'pilkada di batalkan', '2017-03-20 08:46:19');

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
('feery', 'Feery Edwin', 'fycedwin@gmali.com', 'M', '1996-02-22', '$2y$10$StI5H3Dd3usvR9fqT5H9PeDoAikhVhq6puZAXofeLu1rqncNc2pUm', '2017-03-20 08:43:42'),
('kuncoro', 'Kuncoro', 'yoko@yahoo.co.id', 'M', '0000-00-00', '$2y$10$bLE2SzkSiRJD91wf/Cf1BOrJVIN5Pbu8PpbDOSYqKoI0Fg9Yyifdy', '2017-03-19 11:32:41'),
('laymana', 'laymana', 'yoko@yoko.com', 'M', '2017-03-08', '$2y$10$o9/Do8bjqnWiE1zCDDjXsOQ/hh8u32OU/6jdRm3jwFCl3QA/hzTYi', '2017-03-19 12:17:18'),
('yoko', 'Kuncoro Yoko', 'yoko@abc.com', 'M', '1996-03-06', '$2y$10$bLE2SzkSiRJD91wf/Cf1BOrJVIN5Pbu8PpbDOSYqKoI0Fg9Yyifdy', '2017-03-11 00:00:00');

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
-- Indexes for table `grouptask`
--
ALTER TABLE `grouptask`
  ADD PRIMARY KEY (`taskId`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberId`),
  ADD KEY `groupId` (`groupId`);

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
-- AUTO_INCREMENT for table `grouptask`
--
ALTER TABLE `grouptask`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_mbr_grpId_fgrp_idGrp` FOREIGN KEY (`groupId`) REFERENCES `forumgroup` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
