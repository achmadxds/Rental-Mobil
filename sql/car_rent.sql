-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2021 at 06:44 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_customer`
--

CREATE TABLE `data_customer` (
  `id_cs` int(11) UNSIGNED NOT NULL,
  `id_car` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `identity` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL DEFAULT '0000-00-00',
  `days` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `totalPrice` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `status_cs` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_customer`
--

INSERT INTO `data_customer` (`id_cs`, `id_car`, `name`, `identity`, `address`, `phone`, `checkin`, `checkout`, `days`, `totalPrice`, `status_cs`) VALUES
(1, 1, 'Tzuyu', 'Tzuyu.jpeg', 'Mejobo', '0895396291491', '2021-01-01', '2021-01-11', 10, 1500000, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `mobil_data`
--

CREATE TABLE `mobil_data` (
  `id_mobil` int(11) NOT NULL,
  `car_name` varchar(30) NOT NULL,
  `license_number` varchar(15) NOT NULL,
  `rental_price` int(11) NOT NULL,
  `type_car` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `description` text NOT NULL DEFAULT 'The Description Must Good!',
  `car_img` varchar(100) NOT NULL DEFAULT 'The char from image must bu less than 100 char!!'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobil_data`
--

INSERT INTO `mobil_data` (`id_mobil`, `car_name`, `license_number`, `rental_price`, `type_car`, `status`, `description`, `car_img`) VALUES
(1, 'Avansa', 'K 7777 KU', 150000, 'Sedan', 'Tersedia', 'The Description Must Good!', 'The char from image must bu less than 100 char!!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(2, 'rais@admin.com', 'rais', 'c0257943d80dbccbba5f1e25d962b991'),
(3, 'admin@admin.com', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_customer`
--
ALTER TABLE `data_customer`
  ADD PRIMARY KEY (`id_cs`),
  ADD KEY `id_car` (`id_car`);

--
-- Indexes for table `mobil_data`
--
ALTER TABLE `mobil_data`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_customer`
--
ALTER TABLE `data_customer`
  MODIFY `id_cs` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobil_data`
--
ALTER TABLE `mobil_data`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_customer`
--
ALTER TABLE `data_customer`
  ADD CONSTRAINT `join_id` FOREIGN KEY (`id_car`) REFERENCES `mobil_data` (`id_mobil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
