-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jul 25, 2024 at 04:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `burger`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(11) NOT NULL,
  `locked` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pname` varchar(256) NOT NULL,
  `pprice` decimal(10,2) NOT NULL,
  `pqty` int(11) NOT NULL,
  `img` text NOT NULL,
  `p_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_bill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `locked`, `user_id`, `pname`, `pprice`, `pqty`, `img`, `p_date`, `total_bill`) VALUES
(8, 1, 6, 'Tower Burge', 10.00, 1, 'img/tower burger.webp', '2024-07-24 04:20:08', 0),
(7, 0, 7, 'Black Bun Burger', 5.00, 1, 'img/black bun.webp', '2024-07-24 04:52:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `user_id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `card_balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`user_id`, `username`, `email`, `password`, `card_balance`) VALUES
(1, 'moosa', 'moosa@gmail.com', 'moosa', 50),
(2, 'burger', 'burger@gmail.com', 'burger', 50),
(5, 'alvi', 'Moosaalvi96alvi3@gmail.com', 'Moosaalvi96alvi3@gmail.com', 25),
(6, 'm', 'Moosaalvi963m@gmail.com', 'Moosaalvi963m@gmail.com', 50),
(7, 'abdullah', 'abdullah@gmail.com', 'abdullah@gmail.com', 50),
(8, 'haji', 'haji@gmail.com', 'haji', 50),
(9, 'kk', 'k@gmail.com', 'k', 50),
(10, 'sirnabeel', 'sir@gmail.com', 'sir@gmail.com', 50);

-- --------------------------------------------------------

--
-- Table structure for table `fast_food`
--

CREATE TABLE `fast_food` (
  `product_id` int(11) NOT NULL,
  `p_name` varchar(256) NOT NULL,
  `p_qty` varchar(256) NOT NULL,
  `p_price` varchar(256) NOT NULL,
  `p_detail` varchar(255) NOT NULL,
  `p_img` text NOT NULL,
  `p_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fast_food`
--

INSERT INTO `fast_food` (`product_id`, `p_name`, `p_qty`, `p_price`, `p_detail`, `p_img`, `p_date`) VALUES
(6, 'Spicy BBQ Burger', '12', '4', 'A fiery burger packed with flavor! Grilled chicken breast smothered in spicy BBQ sauce.', 'img/burger3.jpg', '2024-06-25 07:11:52'),
(7, 'Black Bun ', '29', '8', 'Black Bun burger packed with flavor! Roasted chicken breast .', 'img/black bun.webp', '2024-06-25 07:14:59'),
(8, 'Tower Burge', '6', '9', 'Tower Burger meal of two persons. Packed with alot of patties.', 'img/tower burger.webp', '2024-06-25 07:16:08'),
(9, 'Blasty Burger', '12', '5', 'A buger blasts in your mouth enlayered with huge cheesy mayo.with three patties', 'img/burger1.jpg', '2024-06-25 07:17:30'),
(10, 'cheesy burg', '17', '6', 'cheesy bowrger', 'img/blast.jpg', '2024-06-25 07:18:51'),
(12, 'cheesy fries', '14', '1', 'Delicious cheesy fries.', 'img/loaded.jpg', '2024-06-25 07:20:44');

-- --------------------------------------------------------

--
-- Table structure for table `locked_products`
--

CREATE TABLE `locked_products` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `cardname` varchar(256) NOT NULL,
  `cardno` int(11) NOT NULL,
  `expdate` date NOT NULL DEFAULT current_timestamp(),
  `cvv` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `email`, `cardname`, `cardno`, `expdate`, `cvv`, `balance`) VALUES
(1, 'moosa@gmail.com', 'moosa', 1111, '2024-07-24', 123, 30);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `message` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`customer_id`, `name`, `email`, `phone_number`, `date`, `time`, `message`) VALUES
(1, 'AHMED MOOSA ADNAN', 'Moosaalvi963@gmail.com', 2147483647, 2024, 11, 'reserve a table for family dinner.');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `p_name` varchar(256) NOT NULL,
  `p_qty` int(11) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_detail` varchar(256) NOT NULL,
  `p_img` text NOT NULL,
  `p_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`user_id`, `product_id`, `p_name`, `p_qty`, `p_price`, `p_detail`, `p_img`, `p_date`) VALUES
(6, 10, 'cheesy burg', 33, 9, 'cheesy bowrger', 'img/blast.jpg', '2024-07-24 04:02:16'),
(10, 11, 'carrrr', 2, 2, 'mmmmm', 'img/img2.jpg', '2024-07-24 11:46:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `fast_food`
--
ALTER TABLE `fast_food`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `locked_products`
--
ALTER TABLE `locked_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fast_food`
--
ALTER TABLE `fast_food`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `locked_products`
--
ALTER TABLE `locked_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
