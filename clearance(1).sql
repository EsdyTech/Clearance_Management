-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2020 at 03:44 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clearance`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE IF NOT EXISTS `adminlogin` (
`id` int(10) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pic` text NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `surname`, `firstname`, `username`, `password`, `pic`, `role`, `status`) VALUES
(1, 'omopariola', 'kayode', 'admin', 'admin', 'uploads/admin2.jpg', 'Super Administrator', 'Activated'),
(3, 'Komolafe', 'Adekunle', 'Ade', 'TgZuWjtU0Q', 'uploads/admin2.jpg', 'Administrator', 'Activated'),
(5, 'sada', 'ismail', 'sada', 'B4N2QMGG22', 'uploads/admin2.jpg', 'Administrator', 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `clearancelist`
--

CREATE TABLE IF NOT EXISTS `clearancelist` (
`clearId` int(10) NOT NULL,
  `reqId` int(10) NOT NULL,
  `matricno` varchar(25) NOT NULL,
  `level` varchar(10) NOT NULL,
  `session` varchar(25) NOT NULL,
  `clearStatus` varchar(25) NOT NULL,
  `dateReg` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `clearancelist`
--

INSERT INTO `clearancelist` (`clearId`, `reqId`, `matricno`, `level`, `session`, `clearStatus`, `dateReg`) VALUES
(5, 4, ' NCSF/15/0032', ' ND1', ' 2018/2019', 'Approved', '2020-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `deadline`
--

CREATE TABLE IF NOT EXISTS `deadline` (
`Id` int(20) NOT NULL,
  `deadlinedate` varchar(255) NOT NULL,
  `session` varchar(25) NOT NULL,
  `level` varchar(10) NOT NULL,
  `penalty` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `dateReg` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `deadline`
--

INSERT INTO `deadline` (`Id`, `deadlinedate`, `session`, `level`, `penalty`, `description`, `status`, `dateReg`) VALUES
(1, '2020-05-08', '2018/2019', 'ND1', '2500', 'A fee of 2500 will be paid if deadlineis exceeded before reactivating a new deadline for clearance', 'Activated', '2019-07-28'),
(3, '2019-08-28', '2018/2019', 'HND2', '', '', 'Activated', '2019-08-04'),
(5, '2020-05-16', '2020/2021', 'HND2', '2500', 'A fee of 2500 will be paid if deadlineis exceeded before reactivating a new deadline for clearance', 'Activated', '2020-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
`id` int(10) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pic` text NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(50) NOT NULL,
  `staffType` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`id`, `surname`, `firstname`, `sex`, `username`, `pic`, `phone`, `password`, `staffType`, `status`) VALUES
(1, 'KAYODE', 'OMOPARIOLA', 'Male', 'ola', 'uploads/lecturer.jpg', '080987466477', 'ola', 'Full Time', 'Activated'),
(2, 'EZEKIEL', 'OLAYINKA', 'Male', 'kayode', 'uploads/lecturer.jpg', '080987466477', 'ada', 'Full Time', 'Activated'),
(3, 'OLA', 'OLA', 'Male', 'olamide', 'uploads/lecturer.jpg', '080987466477', 'olamide', 'Full Time', 'Activated'),
(6, 'Owolabi', 'Thomas', 'Male', 'owolabithomas@yahoo.com', 'uploads/lecturer.jpg', '09067637637', 'owo', 'Part Time', 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
`id` int(5) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE IF NOT EXISTS `requirements` (
`reqid` int(11) NOT NULL,
  `reqName` varchar(255) NOT NULL,
  `reqSession` varchar(25) NOT NULL,
  `reqLevel` varchar(25) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `dateReg` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`reqid`, `reqName`, `reqSession`, `reqLevel`, `status`, `description`, `dateReg`) VALUES
(4, 'Consumables', '2018/2019', 'ND1', 'Activated', '', '2019-07-28'),
(11, 'faculty fee', '2018/2019', 'ND1', 'Activated', '', '2019-07-28'),
(12, 'library pass', '2018/2019', 'ND1', 'Activated', '', '2019-07-28'),
(13, 'Nacoss fee', '2018/2019', 'ND1', 'Activated', '', '2019-07-28'),
(14, 'obligatory fees', '2020/2021', 'HND2', 'Activated', '', '2020-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `requploads`
--

CREATE TABLE IF NOT EXISTS `requploads` (
`upId` int(10) NOT NULL,
  `reqId` int(10) NOT NULL,
  `matricno` varchar(25) NOT NULL,
  `session` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `uploadStatus` varchar(20) NOT NULL,
  `dateReg` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`id` int(10) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `othername` varchar(50) NOT NULL,
  `matricno` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `pic` text NOT NULL,
  `level` varchar(10) NOT NULL,
  `session` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `dateReg` varchar(50) NOT NULL,
  `isCleared` varchar(50) NOT NULL,
  `dateCleared` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `surname`, `firstname`, `othername`, `matricno`, `password`, `sex`, `pic`, `level`, `session`, `status`, `dateReg`, `isCleared`, `dateCleared`) VALUES
(9, 'omopariola', 'tolu', 'josh', 'NCSF/15/0032', 'tolu', 'Male', 'uploads/student.jpg', 'ND1', '2018/2019', 'Activated', '', '', ''),
(12, 'BAMIDELE', 'MOBOLA', 'ZAINAB', 'HCSF/15/0001', 'EW2OS', 'Female', 'uploads/student.jpg', 'HND1', '', 'Activated', '', '', ''),
(19, 'SALISU', 'RASAQ', 'ADEKUNLE', 'HCSF/15/0032', 'vuShI', 'Male', 'uploads/student.jpg', 'HND2', '', 'Activated', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clearancelist`
--
ALTER TABLE `clearancelist`
 ADD PRIMARY KEY (`clearId`);

--
-- Indexes for table `deadline`
--
ALTER TABLE `deadline`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
 ADD PRIMARY KEY (`reqid`);

--
-- Indexes for table `requploads`
--
ALTER TABLE `requploads`
 ADD PRIMARY KEY (`upId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clearancelist`
--
ALTER TABLE `clearancelist`
MODIFY `clearId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `deadline`
--
ALTER TABLE `deadline`
MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
MODIFY `reqid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `requploads`
--
ALTER TABLE `requploads`
MODIFY `upId` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
