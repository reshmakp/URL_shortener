-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2021 at 12:47 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Database: `shorten_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `url_shorten`
--

CREATE TABLE `url_shorten` (
  `id` int(11) NOT NULL,
  `url` tinytext NOT NULL,
  `short_code` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL,
  `added_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `url_shorten`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `url_shorten`
--
ALTER TABLE `url_shorten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `url_shorten`
--
ALTER TABLE `url_shorten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;


