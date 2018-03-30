-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2018 at 04:47 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cashdigi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `master_cardno`
--

CREATE TABLE `master_cardno` (
  `barcode` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_cardno`
--

INSERT INTO `master_cardno` (`barcode`) VALUES
(12345),
(8906002130177),
(9789382157144),
(6048631204912243);

-- --------------------------------------------------------

--
-- Table structure for table `master_usertype`
--

CREATE TABLE `master_usertype` (
  `id` int(11) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_usertype`
--

INSERT INTO `master_usertype` (`id`, `usertype`) VALUES
(1, 'admin'),
(2, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `pay_types`
--

CREATE TABLE `pay_types` (
  `id` int(11) NOT NULL,
  `types` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay_types`
--

INSERT INTO `pay_types` (`id`, `types`) VALUES
(3, 'EXAMFORMFEE'),
(2, 'FINE'),
(7, 'LAB FINE'),
(4, 'LIBRARY FINE'),
(5, 'SPORTS FINE'),
(1, 'TUITION FEE');

-- --------------------------------------------------------

--
-- Table structure for table `std_amount`
--

CREATE TABLE `std_amount` (
  `cardno` bigint(20) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_amount`
--

INSERT INTO `std_amount` (`cardno`, `amount`) VALUES
(12345, 3520),
(9789382157144, 1000),
(6048631204912243, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `student_charge`
--

CREATE TABLE `student_charge` (
  `id` bigint(20) NOT NULL,
  `paytype_id` int(11) NOT NULL,
  `cardno` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  `duedate` date NOT NULL,
  `dueamount` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 unpaid, 1 paid',
  `statustext` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_charge`
--

INSERT INTO `student_charge` (`id`, `paytype_id`, `cardno`, `amount`, `duedate`, `dueamount`, `status`, `statustext`) VALUES
(18, 3, 12345, 100, '2018-03-14', 150, 1, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `student_detail`
--

CREATE TABLE `student_detail` (
  `cardno` bigint(20) NOT NULL,
  `rollno` bigint(20) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `year` bigint(20) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `phno` bigint(20) NOT NULL,
  `studentpassword` varchar(10) NOT NULL,
  `studentimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_detail`
--

INSERT INTO `student_detail` (`cardno`, `rollno`, `sname`, `year`, `branch`, `phno`, `studentpassword`, `studentimage`) VALUES
(12345, 167, 'AMIT', 2018, 'cse', 919691441118, '6u4s@', '15221327332017-02-27-01-08-59-480.jpg'),
(8906002130177, 1233, 'nik', 2018, 'cse', 919090909090, 'gU9Yj', '15221341102017-02-27-01-08-59-480.jpg'),
(9789382157144, 1003, 'nitin radke', 2015, 'cse', 919691317138, '78H6U', '15221556032017-02-27-01-05-31-033.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) NOT NULL,
  `cardno` bigint(20) NOT NULL,
  `chargeid` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` bigint(200) NOT NULL,
  `cardno` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `date` mediumtext NOT NULL,
  `type` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `cardno`, `amount`, `date`, `type`) VALUES
(3, '6048631204912243', 8000, '08-Apr-15', 'recharge'),
(4, '12345', 5000, '27-Mar-18', 'recharge'),
(5, '9789382157144', 1000, '27-Mar-18', 'recharge');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `userpassword` varchar(20) NOT NULL,
  `userphoneno` bigint(20) NOT NULL,
  `useraddress` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `username`, `userpassword`, `userphoneno`, `useraddress`, `email`) VALUES
(1, 'nitin', '4712J', 919691441118, 'durg', 'nikhil.badani@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_cardno`
--
ALTER TABLE `master_cardno`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `master_usertype`
--
ALTER TABLE `master_usertype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usertype` (`usertype`);

--
-- Indexes for table `pay_types`
--
ALTER TABLE `pay_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `types` (`types`);

--
-- Indexes for table `std_amount`
--
ALTER TABLE `std_amount`
  ADD PRIMARY KEY (`cardno`);

--
-- Indexes for table `student_charge`
--
ALTER TABLE `student_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_detail`
--
ALTER TABLE `student_detail`
  ADD PRIMARY KEY (`cardno`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_usertype`
--
ALTER TABLE `master_usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pay_types`
--
ALTER TABLE `pay_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `student_charge`
--
ALTER TABLE `student_charge`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
