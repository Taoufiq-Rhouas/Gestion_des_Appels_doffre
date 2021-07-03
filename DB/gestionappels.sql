-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2021 at 05:44 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestionappels`
--

-- --------------------------------------------------------

--
-- Table structure for table `appeloffre`
--

CREATE TABLE `appeloffre` (
  `id` int(200) NOT NULL,
  `id_offre` int(200) NOT NULL,
  `nomEntreprise` varchar(200) NOT NULL,
  `budget` float NOT NULL,
  `nom_responsable` varchar(200) NOT NULL,
  `email` varchar(60) NOT NULL,
  `documont` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offre`
--

CREATE TABLE `offre` (
  `id` int(11) NOT NULL,
  `titre_offre` varchar(60) NOT NULL,
  `budget` float NOT NULL,
  `deadline` date NOT NULL,
  `statut` varchar(60) NOT NULL,
  `dateExperation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offre`
--

INSERT INTO `offre` (`id`, `titre_offre`, `budget`, `deadline`, `statut`, `dateExperation`) VALUES
(1, 'site web e-learning', 10081, '2021-07-27', 'active', '2021-07-09'),
(3, 'website file upload', 11280, '2021-08-14', 'active', '2021-04-26'),
(4, 'site web e-commerce', 10000, '2021-08-09', 'active', '2021-07-10'),
(6, 'website online course', 55000, '2021-07-26', 'active', '2021-06-26'),
(7, 'website digital marketing', 1108, '2021-08-12', 'active', '2021-06-27'),
(8, 'site web blog', 6600, '2021-08-28', 'active', '2021-06-28'),
(12, 'site web boutique en ligne', 40000, '2021-09-10', 'active', '2021-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(60) NOT NULL,
  `type` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `status`, `type`) VALUES
(1, 'admin@admin.com', 'admin', 1, 1),
(2, 'user@gmail.com', 'admin', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appeloffre`
--
ALTER TABLE `appeloffre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_offre` (`id_offre`);

--
-- Indexes for table `offre`
--
ALTER TABLE `offre`
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
-- AUTO_INCREMENT for table `appeloffre`
--
ALTER TABLE `appeloffre`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `offre`
--
ALTER TABLE `offre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appeloffre`
--
ALTER TABLE `appeloffre`
  ADD CONSTRAINT `appeloffre_ibfk_1` FOREIGN KEY (`id_offre`) REFERENCES `offre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
