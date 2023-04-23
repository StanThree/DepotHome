-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 23, 2023 at 02:10 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homedepotdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressID` int(11) NOT NULL,
  `streetNum` int(11) DEFAULT NULL,
  `streetName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressID`, `streetNum`, `streetName`, `city`, `state`, `zipcode`) VALUES
(1, 123, 'Main Street', 'New York', 'NY', 10001),
(2, 456, 'Broadway', 'New York', 'NY', 10002),
(3, 0, 'strtname', 'city', 'state', 111),
(4, 0, '', '', '', 0),
(5, 0, '', '', '', 0),
(6, 0, '', '', '', 0),
(7, 0, '', '', '', 0),
(8, 0, '', 'testcity', '', 0),
(9, 0, '', '', '', 0),
(10, 0, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `id` int(11) NOT NULL,
  `shoppingCartID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `storeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`id`, `shoppingCartID`, `productID`, `quantity`, `storeID`) VALUES
(1, NULL, 1, 1, 1),
(2, NULL, 3, 1, 1),
(3, 1, 3, 1, 1),
(4, 1, 3, 1, 1),
(5, 1, 3, 1, 1),
(6, 1, 4, 1, 1),
(7, 1, 5, 1, 1),
(8, 1, 4, 1, 1),
(9, 1, 1, 1, 1),
(10, 1, 1, 1, 1),
(11, 1, 1, 1, 1),
(12, 1, 1, 1, 1),
(13, 1, 3, 1, 1),
(14, 1, 4, 1, 1),
(15, 1, 1, 1, 1),
(16, 1, 1, 1, 1),
(17, 1, 1, 1, 1),
(18, 1, 1, 1, 1),
(19, 1, 1, 1, 1),
(20, 2, 1, 1, 1),
(21, 2, 1, 1, 1),
(22, 2, 1, 1, 1),
(23, 2, 1, 1, 1),
(24, 2, 11, 1, 1),
(25, 2, 1, 1, 1),
(26, 2, 3, 1, 1),
(27, 2, 3, 1, 1),
(28, 2, 5, 1, 1),
(29, 1, 1, 1, 1),
(30, 1, 3, 1, 1),
(31, NULL, 1, 1, 1),
(32, NULL, 1, 1, 1),
(33, NULL, 2, 1, 2),
(34, 1, 9, 1, 1),
(35, 3, 6, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phoneNum` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactID`, `email`, `phoneNum`) VALUES
(1, 'john.doe@example.com', 1234567890),
(2, 'jane.smith@example.com', 2345678901),
(23, 'test@test.com', 12346),
(24, 'test2@test2.com', 5),
(25, 't@t.com', NULL),
(26, 'fakeuser@fake.com', 555),
(27, 't@t.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `currentStore` int(11) DEFAULT NULL,
  `customerFirstName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customerLastName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customerAddress` int(11) DEFAULT NULL,
  `customerContact` int(11) DEFAULT NULL,
  `customerPayment` int(11) DEFAULT NULL,
  `customerShoppingCart` int(11) DEFAULT NULL,
  `customerOrderHistory` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `currentStore`, `customerFirstName`, `customerLastName`, `customerAddress`, `customerContact`, `customerPayment`, `customerShoppingCart`, `customerOrderHistory`, `password`) VALUES
(1, 1, 'Mark', 'Doe', 1, 1, 1, 1, 'Order History 1', 'password123'),
(2, 2, 'Jane', 'Smith', 2, 2, 2, 2, 'Order History 2', 'password456'),
(21, 1, 'FirstName', 'Last', 3, 23, NULL, NULL, NULL, 'test'),
(22, 1, 'test2F', 'test2L', 9, 24, NULL, 2, NULL, 'test2'),
(23, 1, 'f', 'f', NULL, 25, NULL, 1, NULL, 'f'),
(24, 2, 'fakeFN', 'fakeLN', 10, 26, NULL, NULL, NULL, 'pass'),
(25, 1, 'tfn', 'tln', NULL, 27, NULL, NULL, NULL, 't');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `dealID` int(11) NOT NULL,
  `dealType` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `discountPercentage` int(11) DEFAULT NULL,
  `dealStart` date DEFAULT NULL,
  `dealEnd` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`dealID`, `dealType`, `discountPercentage`, `dealStart`, `dealEnd`) VALUES
(1, 'Deal Type 1', 10, '2023-04-01', '2023-04-30'),
(2, 'Deal Type 2', 15, '2023-04-15', '2023-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `deptID` int(11) NOT NULL,
  `deptName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`deptID`, `deptName`) VALUES
(3, 'Home Improvement'),
(5, 'Appliances'),
(7, 'Clothing and Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `homedepot`
--

CREATE TABLE `homedepot` (
  `ID` int(11) NOT NULL,
  `termsOfService` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `store` int(11) DEFAULT NULL,
  `customer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homedepot`
--

INSERT INTO `homedepot` (`ID`, `termsOfService`, `store`, `customer`) VALUES
(1, 'Terms of Service Text 1', 1, 1),
(2, 'Terms of Service Text 2', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `paymentinfo`
--

CREATE TABLE `paymentinfo` (
  `paymentID` int(11) NOT NULL,
  `cardType` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cardNum` bigint(11) DEFAULT NULL,
  `cardFirstName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cardLastName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cardExpiration` date DEFAULT NULL,
  `cardCSV` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentinfo`
--

INSERT INTO `paymentinfo` (`paymentID`, `cardType`, `cardNum`, `cardFirstName`, `cardLastName`, `cardExpiration`, `cardCSV`) VALUES
(1, 'Visa', 1111222233334444, 'John', 'Doe', '2025-12-31', 123),
(2, 'Mastercard', 2222333344445555, 'Jane', 'Smith', '2025-11-30', 456);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `productQuantity` int(11) DEFAULT NULL,
  `deptID` int(11) DEFAULT NULL,
  `imageUrl` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `storeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productPrice`, `productQuantity`, `deptID`, `imageUrl`, `storeID`) VALUES
(1, 'Fridge', 100, 3, 5, 'https://images.thdstatic.com/productImages/cc115637-8405-4a3a-b390-127951ccad8f/svn/stainless-look-magic-chef-mini-fridges-hmdr450se-64_1000.jpg', 1),
(2, 'Lumber', 200, 4, 3, 'https://images.thdstatic.com/productImages/a2cbe832-3921-44ca-9f68-80ac56aa512c/svn/lumber-161640-64_100.jpg', 2),
(3, 'Gloves', 10, 46, 7, 'https://upload.wikimedia.org/wikipedia/commons/b/b0/Antivibration_gloves.jpg', 1),
(4, 'Ladder', 100, 5, 3, 'https://upload.wikimedia.org/wikipedia/commons/5/51/Wooden_ladder_from_the_Roman_era..jpg', 1),
(5, 'Hammer', 20, 19, 3, 'https://upload.wikimedia.org/wikipedia/commons/f/fb/Hammer-1629587.jpg', 1),
(6, 'Screwdriver', 15, 29, 3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Big_flat_screwdriver.jpg/1200px-Big_flat_screwdriver.jpg', 2),
(7, 'Wrench', 25, 15, 3, 'https://upload.wikimedia.org/wikipedia/commons/9/98/Chrome_Vanadium_Adjustable_Wrench.jpg', 2),
(8, 'Drill', 80, 8, 3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Soviet_drill.jpg/1200px-Soviet_drill.jpg', 1),
(9, 'Level', 30, 11, 3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Tool-level.jpg/1200px-Tool-level.jpg', 1),
(10, 'Saw', 50, 7, 3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Pily_rozne_01.jpg/800px-Pily_rozne_01.jpg', 1),
(11, 'Paintbrush', 5, 99, 3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Paintbrush.JPG/1200px-Paintbrush.JPG', 1),
(12, 'Roller', 8, 75, 3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Paint_roller_3.jpg/1024px-Paint_roller_3.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `shoppingCartID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`shoppingCartID`, `customerID`, `creationDate`) VALUES
(1, 23, NULL),
(2, 22, NULL),
(3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `storeId` int(11) NOT NULL,
  `storeAddress` int(11) DEFAULT NULL,
  `storeContact` int(11) DEFAULT NULL,
  `storeHours` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deals` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`storeId`, `storeAddress`, `storeContact`, `storeHours`, `deals`) VALUES
(1, 1, 1, 'Mon-Sat: 9am-9pm, Sun: 10am-8pm', 1),
(2, 2, 2, 'Mon-Sat: 9am-9pm, Sun: 10am-8pm', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressID`);

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shoppingCartID` (`shoppingCartID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `storeID` (`storeID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`),
  ADD KEY `customerAddress` (`customerAddress`),
  ADD KEY `customerPayment` (`customerPayment`),
  ADD KEY `customerShoppingCart` (`customerShoppingCart`),
  ADD KEY `customerContact` (`customerContact`),
  ADD KEY `currentStore` (`currentStore`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`dealID`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`deptID`);

--
-- Indexes for table `homedepot`
--
ALTER TABLE `homedepot`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `store` (`store`),
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `paymentinfo`
--
ALTER TABLE `paymentinfo`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `deptfk` (`deptID`),
  ADD KEY `storefk` (`storeID`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`shoppingCartID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`storeId`),
  ADD KEY `storeAddress` (`storeAddress`),
  ADD KEY `deals` (`deals`),
  ADD KEY `storeContact` (`storeContact`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `shoppingCartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`shoppingCartID`) REFERENCES `shoppingcart` (`shoppingCartID`),
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `cartitems_ibfk_3` FOREIGN KEY (`storeID`) REFERENCES `store` (`storeId`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`customerAddress`) REFERENCES `address` (`addressID`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`customerPayment`) REFERENCES `paymentinfo` (`paymentID`),
  ADD CONSTRAINT `customer_ibfk_5` FOREIGN KEY (`customerContact`) REFERENCES `contact` (`contactID`),
  ADD CONSTRAINT `customer_ibfk_6` FOREIGN KEY (`currentStore`) REFERENCES `store` (`storeId`);

--
-- Constraints for table `homedepot`
--
ALTER TABLE `homedepot`
  ADD CONSTRAINT `homedepot_ibfk_1` FOREIGN KEY (`store`) REFERENCES `store` (`storeId`),
  ADD CONSTRAINT `homedepot_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `deptfk` FOREIGN KEY (`deptID`) REFERENCES `dept` (`deptID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `storefk` FOREIGN KEY (`storeID`) REFERENCES `store` (`storeId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`storeAddress`) REFERENCES `address` (`addressID`),
  ADD CONSTRAINT `store_ibfk_4` FOREIGN KEY (`deals`) REFERENCES `deals` (`dealID`),
  ADD CONSTRAINT `store_ibfk_5` FOREIGN KEY (`storeContact`) REFERENCES `contact` (`contactID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
