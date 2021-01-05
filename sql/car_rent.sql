-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2021 at 10:56 AM
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
  `address` varchar(100) NOT NULL,
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
(1, 1, 'Rais', 'rais.jpg', 'Mejobo', '0893589745', '2021-01-01', '2021-01-05', 4, 40000, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `mobil_data`
--

CREATE TABLE `mobil_data` (
  `id` int(11) NOT NULL,
  `car_name` text NOT NULL,
  `plate_number` varchar(11) NOT NULL,
  `rental_price` int(11) NOT NULL,
  `type_car` text NOT NULL,
  `status` text NOT NULL,
  `description` text DEFAULT NULL,
  `car_img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobil_data`
--

INSERT INTO `mobil_data` (`id`, `car_name`, `plate_number`, `rental_price`, `type_car`, `status`, `description`, `car_img`) VALUES
(1, 'Avansa', 'K 8888 KO', 10000, 'Sedan', 'Tersedia', 'Mobil Terbaik Kamu yang kami rangkai', 'avansa.jpeg'),
(2, 'Granmax', 'K 7777 KO', 80000, 'Sedan', 'Tersedia', 'Mobil Terbaik Kamu yang kami rangkai', 'granmax.jpeg'),
(3, 'Ferrari', 'L 6000 KS', 1000000, 'Sedan', 'Tersedia', 'Mobil Mahal yang bikin pemilik nya aja jarang naek. sial emang', 'ferrari.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(1, 'admin@admin.com', 'admin', 'admin');

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
-- AUTO_INCREMENT for table `data_customer`
--
ALTER TABLE `data_customer`
  MODIFY `id_cs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobil_data`
--
ALTER TABLE `mobil_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_customer`
--
ALTER TABLE `data_customer`
  ADD CONSTRAINT `join_id` FOREIGN KEY (`id_car`) REFERENCES `mobil_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
