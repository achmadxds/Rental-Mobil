-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2021 at 04:26 AM
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
  `id_cs` int(11) NOT NULL,
  `id_car` int(11) NOT NULL,
  `name` text NOT NULL,
  `identity` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `totalPrice` int(11) DEFAULT NULL,
  `status_cs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_customer`
--

INSERT INTO `data_customer` (`id_cs`, `id_car`, `name`, `identity`, `address`, `phone`, `checkin`, `checkout`, `days`, `totalPrice`, `status_cs`) VALUES
(1, 7, 'Tzuyu', 'Tzuyu.jpeg', 'Mejobo', '08392483899', '2021-01-01', NULL, NULL, NULL, 'Berjalan'),
(2, 6, 'John', 'Alexander.jpeg', 'Jepang', '08829774899', '2021-01-08', '2021-01-11', 3, 300000, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `mobil_data`
--

CREATE TABLE `mobil_data` (
  `id_mobil` int(11) NOT NULL,
  `car_name` text NOT NULL,
  `license_number` text NOT NULL,
  `rental_price` int(11) NOT NULL,
  `type_car` text NOT NULL,
  `status` text NOT NULL,
  `description` text DEFAULT NULL,
  `car_img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobil_data`
--

INSERT INTO `mobil_data` (`id_mobil`, `car_name`, `license_number`, `rental_price`, `type_car`, `status`, `description`, `car_img`) VALUES
(4, 'Avansa', 'K 6666 KU', 125000, 'Sedan', 'Tersedia', 'Avansa V1', 'avansa.jpeg'),
(5, 'Calya', 'k 5555 JY', 150000, 'Sedan', 'Tersedia', 'Avansa Lite Version', 'calya.jpeg'),
(6, 'Granmax', 'K 6666 KU', 100000, 'PickUp', 'Tersedia', 'Mobil Kuda', 'granmax.jpeg'),
(7, 'Ferrari', 'K 3333 KY', 300000, 'Sedan', 'Terpakai', 'Mobil Kuda Pro Edition', 'ferrari.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
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
  MODIFY `id_cs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mobil_data`
--
ALTER TABLE `mobil_data`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
