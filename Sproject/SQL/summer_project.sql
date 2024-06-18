-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2024 at 10:02 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `summer_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin'),
(2, 'shikhar', 'shikhar@gmail.com', 'shikhar');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'book'),
(2, 'copy'),
(3, 'pen'),
(4, 'pencil');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `message`) VALUES
(1, 'Shikhar Shrestha', 'shtshikhar12@gmail.com', 'Hello!'),
(2, 'ram', 'ram@gmail.com', 'Hello 2');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `email`, `address`, `phone`, `password`) VALUES
(1, 'nischal ', 'nischal@gmail.com', 'dhara', '980000000', 'f32ec4d353635f57e4cb21927f5adf9e'),
(2, 'ram', 'ram@gmail.com', 'ktm', '90938746', '4641999a7679fcaef2df0e26d11e3c72'),
(3, 'sadha', 'sadha@gmail.com', 'ktm', '98665522', 'c842b9bfb1ccea1f6a31b68904b5c12b'),
(4, 'user', 'user@gmail.com', 'bkt', '9811110022', 'ee11cbb19052e40b07aac0ca060c23ee'),
(5, 'sita', 'sita@gmail.com', 'lalitpur', '9800000000', '803205ab3f1b9b6fa6990393f5ac6b58');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'Pending ',
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `invoice_no` bigint(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sub_total` float NOT NULL,
  `Product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `status`, `product_name`, `quantity`, `invoice_no`, `price`, `sub_total`, `Product_id`, `customer_id`) VALUES
(2, '2024-02-14 18:43:19', 'Pending ', 'It ends with us', 1, 0, 550, 550, 19, 2),
(15, '2024-02-25 17:41:53', 'Pending ', 'Verity', 2, 0, 450, 900, 34, 2),
(29, '2024-05-25 22:08:41', 'Complete', 'Doms Pencil', 1, 441716654221, 100, 100, 44, 4),
(31, '2024-05-26 10:20:08', 'Complete', 'Doms', 1, 461716698108, 100, 100, 46, 4),
(49, '2024-06-12 21:46:17', 'Complete', 'Techno Tip (Blue)', 1, 351718208077, 20, 20, 35, 4),
(50, '2024-06-12 21:54:26', 'Pending ', 'Doms Pencil', 2, 441718208566, 100, 200, 44, 4),
(51, '2024-06-17 19:31:14', 'Complete', 'Techno Tip (Blue)', 3, 351718631974, 20, 60, 35, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `image_url` varchar(400) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `image_url`, `stock`, `category_id`) VALUES
(11, 'Ugly Love', 550, '../image/ugly_love.jpeg', 3, 1),
(12, 'November 9', 500, '../image/november_9.jpeg', 0, 1),
(13, 'Malala', 450, '../image/malala.webp', 2, 1),
(15, 'Enemies with benefits ', 450, '../image/ewb.jpeg', 2, 1),
(16, 'The Dark Between Stars', 900, '../image/the_dark_between_stars.webp', 7, 1),
(17, 'Pillow Thoughts', 550, '../image/pillow_thoughts.jpeg', 2, 1),
(19, 'It ends with us', 550, '../image/it_ends_with_us.jpeg', 2, 1),
(20, 'Classmate Notecopy', 100, '../image/classmate_notebook.webp', 29, 2),
(21, 'Classmate Notecopy', 50, '../image/classmate_notebook2.avif', 0, 2),
(22, 'Study', 50, '../image/study_copy.jpeg', 100, 2),
(28, 'It starts with us', 600, '../image/it_start_with_us.jpeg', 7, 1),
(34, 'Verity', 450, '../image/verity.jpg', 10, 1),
(35, 'Techno Tip (Blue)', 20, '../image/TECHNO TIP_59d44d12a07d8.png', 138, 3),
(41, 'Techno Tip (Black)', 20, '../image/techo tip black.jpeg', 90, 3),
(44, 'Doms Pencil', 100, '../image/doms.jpeg', 98, 4),
(45, 'Natraj Pencil', 100, '../image/natraj.jpeg', 35, 4),
(46, 'Doms', 100, '../image/doms1.jpeg', 50, 4),
(47, 'Pilot v7 Black', 150, '../image/pilot_v7_black.jpeg', 7, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
