-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2021 at 05:57 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kidzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Shakeel Ahmad', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `age_group`
--

CREATE TABLE `age_group` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `age` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `age_group`
--

INSERT INTO `age_group` (`id`, `admin_id`, `age`) VALUES
(1, 1, 'New-born'),
(2, 1, '3 - 9 Months'),
(3, 1, '10 - 18 Months'),
(5, 1, 'Above 3 - 5 Years'),
(6, 1, '1.5 Years - 3 Years');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `admin_id`, `cat_name`) VALUES
(1, 1, 'Action Figures'),
(2, 1, 'Animals'),
(3, 1, 'Cars and radio controlled'),
(4, 1, 'Creative Toys'),
(5, 1, 'Dolls');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Hassan Nawaz', 'mitf19e021@gmail.com', 'Quality', 'Thank you. You are providing quality product to your customer.'),
(2, 'Shakeel Ahmad', 'shakeel13471@gmail.com', 'Services', 'Your services is appreciated.');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email_verify` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `contact`, `password`, `email_verify`) VALUES
(22, 'Shakeel Ahmad', 'shakeel13471@gmail.com', '03435161347', '1adbb3178591fd5bb0c248518f39bf6d', 1),
(23, 'Faisal Hidait', '17bscs25625@gmail.com', '03037676566', '818536cbee9ddb0783b504cd78724e1b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `pro_id`, `qty`) VALUES
(9, 10, 1),
(9, 15, 1),
(10, 15, 1),
(11, 14, 1),
(11, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `txnid` varchar(200) NOT NULL,
  `payment_id` varchar(200) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `added_on` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `customer_id`, `name`, `email`, `contact`, `address`, `zipcode`, `payment_status`, `payment_type`, `txnid`, `payment_id`, `order_status`, `added_on`) VALUES
(9, 22, 'Shakeel Ahmad', 'shakeel13471@gmail.com', '03435161347', 'VPO Mohib Pur Tehsil / District Khushab', '41000', 'complete', 'instamojo', '65f0755d30924465b9ff93e0f2798699', 'MOJO1808805A90827807', 'on the way', '2021-08-08 08:55:36'),
(10, 22, 'Shakeel Ahmad', 'shakeel13471@gmail.com', '03435161347', 'New Satellite Town Sargodha', '4100', 'pending', 'cod', '', '', 'pending', '2021-08-13 08:55:27'),
(11, 22, 'Shakeel Ahmad', 'shakeel13471@gmail.com', '03435161347', 'Johar Town Karachi', '4500', 'complete', 'instamojo', 'd25dfda5a48646cfa4edafe2b0ea684b', 'MOJO1813T05A98425760', 'pending', '2021-08-13 08:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `age_group_id` int(11) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `cat_id`, `age_group_id`, `pro_name`, `price`, `image`, `description`) VALUES
(6, 1, 5, 'Premium Action Hero GRT - TZP1', 1395, '1.jpg', 'This action figure is highly posable and made of very fine material.'),
(7, 1, 5, 'Premium Super Hero IRM - TZP1', 1395, '2.jpg', 'Meet the First Avenger himself! Iron Man fights for justice with superhuman strength, agility, and an indestructible Dress!\r\nHes first super soldier, fighting fearlessly on the side of justice. This Titan Hero Iron Man electronic figure includes exciting phrases and action sound effects. Just press the button on Iron Mans chest to hear a command from Marvels most patriotic Avenger.\r\nIron Man even includes phrases that make it seem like he is interacting with other Titan Hero Series figures like Marvels War Machine, Marvels Falcon, and Spider Man.'),
(8, 1, 5, 'Paw Patrol Family Figure Playset - TZP1', 899, '3.jpg', 'Paw Patrol miniature figures, individually packaged, set of 6 miniature figures includes: Rubble, Chase, Skye, Zuma, Rocky, and Marshall. Re-enact favorite scenes from the TV show and use your bravery, teamwork skills, and imagination to go on a rescue mission with the Paw Patrol.'),
(9, 2, 3, 'Little Alive German Shepherd Dog', 2395, '4.jpg', 'Pet German Shepherd was designed to provide interactive companionship and engagement like that of a real dog. This lovable, animatronic friend responds to both sound and touch just like a real puppy. The Joy For All Companion Pup features a realistic, soft coat,and authentic sounds. the Golden Pup can turn its head and respond to sound just like a real dog.\r\nGive the gift of love to family member for all ages  with Joy For All Companion Pets. At Joy For All, we believe the power of play can bring joy and fun to people at all stages of life.'),
(10, 2, 3, 'Little Alive Punched Face Persian Cat (Black & Green)', 2395, '5.jpg', 'Pet Punched Face Persian Kittens was designed to provide interactive companionship and engagement like that of a real cat. This lovable, animatronic friend responds to both sound and touch just like a real cat. The Joy For All Companion Cat features a realistic, soft coat,and authentic sounds. The Persian Kittens can turn its head and respond to sound just like a real cat.\r\nGive the gift of love to family member for all ages with Joy For All Companion Pets. At Joy For All, we believe the power of play can bring joy and fun to people at all stages of life.'),
(11, 2, 3, 'Little Alive Golden Retriever', 2395, '6.jpg', 'Pet Golden Pup was designed to provide interactive companionship and engagement like that of a real dog. This lovable, animatronic friend responds to both sound and touch just like a real puppy. The Joy For All Companion Pup features a realistic, soft coat,and authentic sounds. the Golden Pup can turn its head and respond to sound just like a real dog.\r\nGive the gift of love to family member for all ages  with Joy For All Companion Pets. At Joy For All, we believe the power of play can bring joy and fun to people at all stages of life.'),
(12, 3, 6, 'RC Convertible Top Sports Car - TZP1', 1950, '7.jpg', 'anti-crash tire, anti-shock car, all these are designed for indoor and outdoor use.Flexible wheels allow you to play no matter matter, sandy beach, areas wet or meadows. ABS plastic and international airlines International Advanced toxic and tasteless spray paint environment.'),
(13, 3, 6, 'RC Metal Body 2.4 GHZ Rechargeable Monster Crawler - TZP1', 4850, '8.jpg', 'Rock crawler high performance truck 2.4 G hz control system with 4 wheel, all weather 1:14 size off road race trunk toys. Drive car are more stable and faster than 2 wheel drive one. The high quality abs material is good for climbing, also leads the anti throw ability. The direction trimmer at the bottom of the car keeps it running a straight line.'),
(14, 3, 6, 'RC Rechargeable SUV Cruiser Scale 1:10 - TZP1', 6750, '9.jpg', 'Radio-controlled high-speed Land Cruiser car 1:10 scale. This is made of very good plastic and powered by Imitated well known sports power technology.'),
(15, 5, 6, 'Holiday Barbie Doll', 5999, '10.jpg', 'For decades, the Holiday Barbie doll has embodied the spirit of a season marked by wonder and celebration. 2019 Holiday Barbie doll shines in an elegant gown with red and white holiday print and silvery sparkle detail. A beautiful bow adorns the gown shoulder and complements a dramatic red train. Her long, blonde hair is styled in waves with a chic side part and silvery chandelier earrings complete the look. Tis the season to smile wider, hug your loved ones a little tighter and savor that magical holiday spirit. Reflecting the sparkle and jubilation of holiday festivities, 2019 Holiday Barbie doll is the definitive celebration of a season full of love. Includes 2019 Holiday Barbie doll, doll stand and certificate of authenticity.'),
(16, 5, 6, 'Mattel Barbie Office and Bedroom With Doll', 3950, '12.jpg', 'Mattel ensures children truly extraordinary moments! With the Mattel FXG52 Barbie Office and Bedroom, the game goes from bedtime to bedtime. It makes everyday situations become something special, just have a little imagination. Besides the beautiful Barbie doll, the office turns into a comfortable bunk. And it even includes small accessories that make all the difference when it comes to playing.'),
(17, 5, 6, 'Barbie Dreamtopia Fashion Princess Doll Set', 7299, '13.jpg', 'Barbie princess doll wears a fantastical gown with a snowflake print, icy-cool colours and a sparkly tulle overlay. Press the button on dolls bodice for a fashion transformation, her dress will fan open. A pink streak in her long, blonde hair adds fantasy flair and a silvery tiara puts the finishing touch');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `pro_id`, `name`, `email`, `rating`, `review`, `date`, `time`) VALUES
(1, 15, 'Shakeel Ahmad', 'shakeel13471@gmail.com', 4, 'Your Services is appreciated. Keep it up.', '2021-08-17', '08:12:00'),
(2, 15, 'Hassan Nawaz', 'hassannawaz321@gmail.com', 3, 'Thanks. I am satisfied on your products.', '2021-08-17', '10:00:00'),
(3, 15, 'Malik Arslan', 'arslan726@gmail.com', 1, 'Appreciated. Stay blessed', '2021-08-17', '20:40:00'),
(4, 15, 'Rao Waqar', 'waqarali4459@gmail.com', 4, 'Excellent Service.', '2021-08-17', '19:53:10'),
(5, 17, 'Asad Ali', 'asadali@gmail.com', 5, 'This doll is very superb. I recommend this product to other customer.', '2021-08-17', '22:57:26'),
(6, 10, 'Amina Batool', 'aminabatool32@gmail.com', 4, 'Very amazing cat. I recommend this item.', '2021-08-17', '23:02:30'),
(7, 14, 'Ali Hamza', 'alihamza@gmail.com', 3, 'This product is awesome. Thanks.', '2021-08-18', '17:00:16'),
(8, 10, 'Sohail Ali', 'sohailali@gmail.com', 2, 'This product is superb.', '2021-08-19', '10:09:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `age_group`
--
ALTER TABLE `age_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`pro_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `age_group_id` (`age_group_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `age_group`
--
ALTER TABLE `age_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `age_group`
--
ALTER TABLE `age_group`
  ADD CONSTRAINT `age_group_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_master` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `order_master`
--
ALTER TABLE `order_master`
  ADD CONSTRAINT `order_master_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`age_group_id`) REFERENCES `age_group` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
