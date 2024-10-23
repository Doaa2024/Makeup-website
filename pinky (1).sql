-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 06:05 AM
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
-- Database: `pinky`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category`, `Image`) VALUES
('Eyes', 'image10.png'),
('Face', 'image9.png'),
('Lips', 'image11.png');

-- --------------------------------------------------------

--
-- Table structure for table `cus`
--

CREATE TABLE `cus` (
  `UserName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cus`
--

INSERT INTO `cus` (`UserName`, `quantity`, `price`, `title`, `description`, `Image`, `id`) VALUES
('Noha Baydoun1', 2, '3.5$', 'Double-Color Eyeshadow', 'Our mini eyeshadow, would be your always choice', 'http://localhost/Menu/image22.png', 3),
('Noha Baydoun1', 8, '15$', 'Glam Eyeshadow Palette', 'Experience a range of vibrant and neutral shades.', 'http://localhost/Menu/image14.png', 5),
('Noha Baydoun1', 6, '9$', 'Powder Blush', 'Add a light color for your look', 'http://localhost/Menu/image21.png', 6),
('Noha Baydoun1', 1, '5$', 'Primer Forever', 'To have a healthy skin, use our primer', 'http://localhost/Menu/image18.png', 7),
('Noha Baydoun1', 4, '2.5$', 'Red Lipstick', 'Your choice for a hot look', 'http://localhost/Menu/image17.png', 8),
('Noha Baydoun1', 20, '10$', 'Silky Smooth Foundation', 'Achieve a flawless complexion with our Silky Smooth Foundation', 'http://localhost/Menu/image15.png', 9),
('Doaa', 4, '3.5$', 'Double-Color Eyeshadow', 'Our mini eyeshadow, would be your always choice', 'http://localhost/Menu/image22.png', 14),
('Doaa', 1, '20$', 'Forever Matte Luxe Lipstick', 'Experience the rich color and moisturizing benefits with our Luxe Lipstick', 'http://localhost/Menu/image13.png', 15);

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`Title`, `Description`, `Image`, `ID`) VALUES
('Exclusive Deals', 'Special offers you will not find anywhere else  ', 'image6.png', 2),
('Happy Customers', 'Pick our brushes and draw your smile', 'image4.png', 3),
('Quality Products', 'Choose the best for your skin ', 'image8.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `total_price` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `username`, `location`, `total_price`) VALUES
(1, 'Doaa', 'Tyre', '141'),
(2, 'Doaa', 'Tyre', '141'),
(3, 'Doaa', 'Tyre', '14100'),
(5, 'Doaa', 'Tyre', '141'),
(6, 'Doaa', 'Lebanon', '141'),
(7, 'Doaa', 'Erlanda', '142'),
(8, 'Noha Baydoun1', 'Erlanda', '71'),
(9, 'Noha Baydoun1', 'Lebanon', '170'),
(10, 'Noha Baydoun1', 'Tyre', '190.00'),
(11, 'Noha', 'Tyre', '280.00'),
(12, 'Noha Baydoun1', 'Lebanon', '340.00'),
(13, 'Doaa', 'Tyre', '200.00'),
(14, 'Doaa', 'Lebanon', '200.00'),
(15, 'Doaa', 'Lebanon', '200.00'),
(16, 'Doaa', 'Lebanon', '200.00'),
(17, 'Doaa', 'Lebanon', '200.00'),
(18, 'Doaa', 'Lebanon', '200.00'),
(19, 'Doaa', 'Lebanon', '200.00'),
(20, 'Doaa', 'Lebanon', '200.00'),
(21, 'Doaa', 'Lebanon', '200.00'),
(22, 'Doaa', 'Lebanon', '200.00'),
(23, 'Doaa', 'Tyre', '76.00'),
(24, 'Doaa', 'Lebanon', '34.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Name`, `Description`, `Price`, `Image`, `Category`) VALUES
(1, 'Forever Matte Luxe Lipstick', 'Experience the rich color and moisturizing benefits with our Luxe Lipstick', '20$', 'image13.png', 'Lips'),
(2, 'Glam Eyeshadow Palette', 'Experience a range of vibrant and neutral shades.', '15$', 'image14.png', 'Eyes'),
(3, 'Silky Smooth Foundation', 'Achieve a flawless complexion with our Silky Smooth Foundation', '10$', 'image15.png', 'Face'),
(4, 'Volumizing Mascara', 'Add volume and length to your lashes.', '10$', 'image16.png', 'Eyes'),
(17, 'Red Lipstick', 'Your choice for a hot look', '2.5$', 'image17.png', 'Lips'),
(18, 'Primer Forever', 'To have a healthy skin, use our primer', '5$', 'image18.png', 'Face'),
(19, 'Hana Highliter', 'Glow your skin with Hana highliter', '7$', 'image20.png', 'Face'),
(20, 'EveryDay Concealer ', 'Our EveryDay concealer, light your face all the day', '8$', 'image19.png', 'Face'),
(21, 'Powder Blush', 'Add a light color for your look', '9$', 'image21.png', 'Face'),
(22, 'Double-Color Eyeshadow', 'Our mini eyeshadow, would be your always  choice', '3.5', 'image22.png', 'Eyes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone Number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserName`, `Password`, `Email`, `Phone Number`) VALUES
('Ali', '$2y$10$2oIlww4JGKBdYxF08KViPugLOk1UyCEZsnO/2PjfwiEUJ3Jd24FKK', 'clahroyale084@gmail.com', '78991778'),
('Doaa', '$2y$10$5IVyYTbW0DBGz.gABbBkOObtZp6ZSn4TWw2.q3BEHNgr3ElnUNm1O', 'doaaakhashab@gmail.com', '70131623'),
('Doaa Khashab', '$2y$10$UcOezjY25E3fpR096BMYueJoJRTq3ySOey2p9/QyJTlUG5qlQ7WL6', 'doaaakhashab@gmail.com', '70131623'),
('dof', '$2y$10$FJdTN6PjNwrrFZmdsxoIPen2Hi2edxh/2/nWXuim3QLZ1lxhgXnNe', 'doaaakhashab@gmail.com', '1221323'),
('Lina', '$2y$10$5uX3f4sVhUYqjg5cMIrJW.eOqYIZNNQrQufzUAtqyByH0GYj6kULW', 'lina@gmail.com', '71722303'),
('Noha', '$2y$10$KWaESdPa1kBKQPETznxEtebbvLS5lsI91eXjscfESTlFIere/KDay', 'noha@gmail.com', '71604224'),
('Noha Baydoun', '$2y$10$YO8R5WkGQGSxKWE4mrilbuWpEoSb8K87YYbHvetX6amXfvsHJkZnK', 'samra@gmail.com', '70131623'),
('Noha Baydoun1', '$2y$10$kUP9xBPQoaxIOUO2kp1ojO2pAlXU4jFcpnTSGblLK5..cZfWidktG', 'doaaakhashab@gmail.com', '78991778');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category`);

--
-- Indexes for table `cus`
--
ALTER TABLE `cus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cus`
--
ALTER TABLE `cus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `general`
--
ALTER TABLE `general`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
