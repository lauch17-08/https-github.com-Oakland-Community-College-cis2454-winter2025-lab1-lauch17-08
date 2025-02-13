-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 13, 2025 at 10:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Stocks`
--

-- --------------------------------------------------------

--
-- Table structure for table `Stocks`
--

CREATE TABLE `Stocks` (
  `Symbol` varchar(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Current_Price` decimal(18,4) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Stocks`
--

INSERT INTO `Stocks` (`Symbol`, `Name`, `Current_Price`, `ID`) VALUES
('GME', 'GamesTop Corp', 26.3200, 1),
('Tesla', 'Tesla Inc', 354.2600, 2),
('HP', 'HP Inc', 33.3000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE `Transactions` (
  `user_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `Quantity` decimal(16,4) NOT NULL,
  `Price` decimal(16,4) NOT NULL,
  `Timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Transactions`
--

INSERT INTO `Transactions` (`user_id`, `stock_id`, `Quantity`, `Price`, `Timestamp`, `ID`) VALUES
(2, 2, 10.0000, 353.8200, '2025-02-13 05:00:00.000000', 1),
(1, 3, 13.0000, 33.3000, '2025-02-13 21:08:54.498946', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Name` varchar(100) NOT NULL,
  `Emailadress` varchar(100) NOT NULL,
  `CashBalance` decimal(16,4) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Name`, `Emailadress`, `CashBalance`, `ID`) VALUES
('Laura', 'lauch.1708@gmail.com', 9000.0000, 1),
('Andrea', 'unzueta.chavez@student.oaklandcc.edu', 6000.0000, 2),
('Eva', 'eed@gmail.com', 12000.0000, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Stocks`
--
ALTER TABLE `Stocks`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `stock_symbol` (`Symbol`);

--
-- Indexes for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `stock_id` (`stock_id`),
  ADD KEY `user_id` (`user_id`,`stock_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_email` (`Emailadress`) USING BTREE,
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Stocks`
--
ALTER TABLE `Stocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Transactions`
--
ALTER TABLE `Transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
