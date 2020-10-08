-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2020 at 06:39 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orieldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `filenm`
--

CREATE TABLE `filenm` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `time` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filenm`
--

INSERT INTO `filenm` (`id`, `name`, `time`) VALUES
(1, 'ba95d78a7c942571185308775a97a3a0', '1598542509');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` text NOT NULL,
  `size` bigint(20) NOT NULL,
  `type` text NOT NULL,
  `uploaded_on` date NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `uid`, `name`, `size`, `type`, `uploaded_on`, `link`) VALUES
(1, 46, 'xfd.pptx', 6171, 'pptx', '2017-12-27', '17091167546'),
(2, 46, '12%2023%20ghj.jpg', 35, 'jpg', '2017-12-30', '28140017446'),
(3, 46, 'videos/admin.sql', 2, 'sql', '2017-12-30', '31162783146'),
(4, 46, 'documents/12%2023%20ghj.jpg', 35, 'jpg', '2017-12-30', ''),
(5, 46, 'arif.docx', 22, 'docx', '2018-01-01', ''),
(6, 49, 'amdocs_nikita.pdf', 190, 'pdf', '2020-08-27', '66288090049'),
(7, 49, 'Screenshot%20(1).png', 0, 'png', '2020-08-27', ''),
(8, 49, 'Screenshot%20(2).png', 152, 'png', '2020-08-27', '85588429149'),
(10, 49, 'cd.txt', 2, 'txt', '2020-08-27', '');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `frnd_nm` text NOT NULL,
  `frnd_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `country` text NOT NULL,
  `phone` bigint(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `total` bigint(20) NOT NULL DEFAULT 0,
  `created_on` date NOT NULL,
  `friends` int(11) NOT NULL DEFAULT 0,
  `otp` int(11) NOT NULL,
  `otp_verify` int(11) NOT NULL DEFAULT 0,
  `share_link` text NOT NULL,
  `foldername` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `country`, `phone`, `status`, `total`, `created_on`, `friends`, `otp`, `otp_verify`, `share_link`, `foldername`) VALUES
(36, '1wryg', 'bhoot1', '11111111', 'Gabon', 9999999999, 1, 0, '2017-12-15', 0, 592459, 1, '725736bhoot1184', 'bf9ce4f69ab045fb497f79b7b5d7622e'),
(37, 'imamber.rkmv@gmail.com\r\n', 'IMAMBER', 'rebma9226', 'india', 9955242700, 1, 0, '2017-12-19', 0, 388712, 1, '345237IMAMBER4567', 'b543376b5721da011b230ba7ae9dd619'),
(40, 'qwertyr', 'qwerrt', '11111111', 'India', 1111111111, 1, 0, '2017-12-26', 0, 881576, 1, '430940qwerrt220', '94ef7214c4a90790186e255304f8fd1f'),
(41, 'eee', 'cxvb', '11111111', 'Wallis & Futana Is', 1111111111, 1, 0, '2017-12-26', 0, 884064, 1, '309941cxvb965', 'bb1443cc31d7396bf73e7858cea114e1'),
(42, 'dfg', 'vgg', '11111111', 'Wake Island', 1111111111, 1, 0, '2017-12-27', 0, 768106, 1, '794242vgg932', 'fdbd31f2027f20378b1a80125fc862db'),
(43, 'sdef', 'tfgf', '11111111', 'Denmark', 1111111111, 1, 0, '2017-12-27', 0, 885322, 1, '93584398dce83da57b0395e163467c9dae521b', 'ef70e26a0b5da778eda3f48014d087cd'),
(44, 'asdf', 'df', '11111111', 'Afganistan', 1111111111, 1, 0, '2017-12-27', 0, 300969, 1, '27344e4da3b7fbbce2345d7772b0674a318d5', '20c9f5700da1088260df60fcc5df2b53'),
(45, 'sxd', 'ssz', '11111111', 'East Timor', 1111111111, 1, 0, '2017-12-27', 0, 661297, 1, '5020455624', 'c85b2ea9a678e74fdc8bafe5d0707c31'),
(46, 'admin', 'admin', '11111111', 'Wake Island', 1234567890, 1, 6265, '2017-12-27', 0, 729329, 1, '3937463659', '854f1fb6f65734d9e49f708d6cd84ad6'),
(47, 'wdf', 'fgh', '11111111', 'East Timor', 1234567890, 1, 0, '2017-12-29', 0, 539133, 1, '9510473023', 'b5200c6107fc3d41d19a2b66835c3974'),
(48, 'qswd', 'dxxd', '11111111', 'St Barthelemy', 1234567890, 1, 0, '2017-12-29', 0, 459230, 1, '8547482200', '6738fc33dd0b3906cd3626397cd247a7'),
(49, 'nikki.nikitaagarwal01@gmail.com', 'nikita', '12345678', 'India', 9905931064, 1, 674, '2020-08-27', 0, 632880, 1, '3344498337', 'c7217b04fe11f374f9a6737901025606');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filenm`
--
ALTER TABLE `filenm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
