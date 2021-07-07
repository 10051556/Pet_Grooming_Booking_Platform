-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2019 at 10:48 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepts`
--

CREATE TABLE `accepts` (
  `store_id` int(11) NOT NULL,
  `species_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accepts`
--

INSERT INTO `accepts` (`store_id`, `species_id`, `id`) VALUES
(1, 1, 1),
(2, 1, 2),
(2, 2, 3),
(3, 1, 4),
(3, 2, 5),
(3, 3, 6),
(4, 1, 7),
(4, 2, 8),
(4, 3, 9),
(4, 4, 10),
(5, 1, 16),
(5, 2, 17),
(5, 3, 18),
(5, 4, 19),
(6, 1, 20),
(6, 2, 21),
(6, 3, 22),
(6, 4, 23);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `store_id` int(11) NOT NULL,
  `start_hour` varchar(5) NOT NULL,
  `date` varchar(10) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `selected_services` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='list of all cases/visits';

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`store_id`, `start_hour`, `date`, `remarks`, `id`, `owner_id`, `pet_id`, `status_id`, `total_amount`, `selected_services`) VALUES
(3, '13:00', '2019/08/24', 'She is quite sensitive around the paw so please be gentle.', 17, 1, 1, 1, '1310.00', 'Bath, Dental, Hair Cutting, Ear Cleaning'),
(5, '07:20', '2019/08/31', 'I might be late', 18, 1, 1, 1, '1590.00', 'Dental, Hair Cutting, Nail Clipping'),
(5, '17:00', '2019/09/26', 'She really loves it here!', 19, 1, 1, 1, '1050.00', 'Dental, Hair Cutting'),
(5, '08:20', '2019/10/26', 'My third time here. Any discount?', 20, 1, 1, 1, '540.00', 'Nail Clipping'),
(4, '19:00', '2019/08/29', 'Her breath is terrible. Please fix it', 21, 1, 6, 1, '420.00', 'Dental'),
(4, '17:00', '2019/08/29', '', 23, 2, 7, 1, '410.00', 'Bath'),
(4, '18:00', '2019/09/11', '', 24, 2, 7, 1, '410.00', 'Bath'),
(2, '16:00', '2019/09/11', 'Do not let me down', 25, 2, 3, 1, '430.00', 'Bath, Dental'),
(2, '16:30', '2019/09/25', 'She has met some new friends here. I thought she would appreciate another visit', 26, 2, 3, 1, '430.00', 'Bath, Dental'),
(1, '13:00', '2019/08/28', 'How long can she stay?', 27, 3, 8, 1, '110.00', 'Bath'),
(4, '14:00', '2019/08/24', 'I am the definition of wealthy', 28, 4, 9, 1, '1700.00', 'Bath, Dental, Hair Cutting, Nail Clipping');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `mobile` varchar(64) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `right_id` int(11) NOT NULL DEFAULT 1,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`first_name`, `last_name`, `mobile`, `email`, `password`, `right_id`, `id`) VALUES
('marco', 'chan', '11111111', '1@b.com', 'security', 1, 1),
('king', 'yip', '12345678', '1@d.com', 'ytiruces', 1, 2),
('kenneth', 'chan', '98765432', '1@c.com', 'password', 1, 3),
('ken', 'ng', '12345678', '1@a.com', 'password', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `name` varchar(128) NOT NULL,
  `species_id` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `owner_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`name`, `species_id`, `birth_date`, `owner_id`, `id`) VALUES
('catMarco', 3, '2019-08-12', 1, 1),
('dogYip', 2, '2019-09-15', 2, 3),
('rabbitMarco', 3, '2019-08-12', 1, 6),
('birdYip', 3, '2018-09-30', 2, 7),
('catKenneth', 1, '2018-12-01', 3, 8),
('birdKen', 3, '2018-01-01', 4, 9),
('catKen', 1, '2018-01-01', 4, 10),
('dogKen', 2, '2012-11-03', 4, 11),
('rabbitKen', 4, '2018-01-02', 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `provides`
--

CREATE TABLE `provides` (
  `store_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='list of all services that are provided in that facility';

--
-- Dumping data for table `provides`
--

INSERT INTO `provides` (`store_id`, `service_id`, `fee`, `id`) VALUES
(1, 1, '110.00', 1),
(2, 1, '210.00', 2),
(2, 2, '220.00', 3),
(3, 1, '310.00', 4),
(3, 2, '320.00', 5),
(3, 3, '330.00', 6),
(4, 1, '410.00', 7),
(4, 2, '420.00', 8),
(4, 3, '430.00', 9),
(4, 4, '440.00', 10),
(5, 1, '510.00', 11),
(5, 2, '520.00', 12),
(5, 3, '530.00', 13),
(5, 4, '540.00', 14),
(6, 1, '610.00', 15),
(6, 2, '620.00', 16),
(6, 3, '630.00', 17),
(6, 4, '640.00', 18),
(3, 5, '350.00', 19),
(6, 6, '660.00', 20);

-- --------------------------------------------------------

--
-- Table structure for table `selected`
--

CREATE TABLE `selected` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selected`
--

INSERT INTO `selected` (`id`, `service_id`, `booking_id`) VALUES
(1, 4, 1),
(2, 3, 1),
(3, 3, 2),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `imagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_name`, `description`, `id`, `imagePath`) VALUES
('Bath', 'Bath', 1, 'Bath.jpg'),
('Dental', 'Dental', 2, 'Dental.jpg'),
('Hair Cutting', 'Hair Cutting', 3, 'Hair Cutting.jpg'),
('Nail Clipping', 'Nail Clipping', 4, 'Nail Clipping.jpg'),
('Ear Cleaning', 'Ear Cleaning', 5, 'Ear Cleaning.jpg'),
('Shaving', 'Shaving', 6, 'Shaving.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

CREATE TABLE `species` (
  `species_name` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='e.g. cat, dog, bird - or more detailed if we need it';

--
-- Dumping data for table `species`
--

INSERT INTO `species` (`species_name`, `id`) VALUES
('Bird', 3),
('Cat', 1),
('Dog', 2),
('Rabbit', 4);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Confirm'),
(3, 'Fulfill');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `description` varchar(300) NOT NULL,
  `imagePath` varchar(255) DEFAULT NULL,
  `mapPath` varchar(355) NOT NULL,
  `id` int(11) NOT NULL,
  `duration` int(3) NOT NULL,
  `sat_open_hour` varchar(5) NOT NULL,
  `sun_open_hour` varchar(5) NOT NULL,
  `sat_close_hour` varchar(5) NOT NULL,
  `sun_close_hour` varchar(5) NOT NULL,
  `open_hour` varchar(5) NOT NULL,
  `close_hour` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_name`, `address`, `district`, `region`, `phone`, `email`, `contact_person`, `description`, `imagePath`, `mapPath`, `id`, `duration`, `sat_open_hour`, `sun_open_hour`, `sat_close_hour`, `sun_close_hour`, `open_hour`, `close_hour`) VALUES
('Mega Pet', 'G/F, 110 Man Nin Street, Sai Kung', 'Sai Kung', 'New Territories ', '+852 2626 0818', 'megapet@megapet.com', 'megapet', 'Pet-grooming services for dogs include a bathing package of shampoo, ear cleaning, belly undercoat shaving, claw trimming, gland expression and more ($150-$538). Cat-grooming prices range from $280-$460. Members receive 10 per cent discount.', 'Mega Pet.jpg', '!1m18!1m12!1m3!1d3690.959999654569!2d114.1742893!3d22.317352499999988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x340400c5dc37af69%3A0x2f9e736b10ad6881!2s1+Peace+Ave%2C+Ho+Man+Tin!5e0!3m2!1sen!2shk!4v1423652845518', 1, 60, '11:00', '12:00', '17:00', '17:00', '09:00', '17:00'),
('Kennel Van Dego', '1-3 Shek Hang Village, Yan Yee Road, Tai Mong Tsai, Sai Kung', 'Sai Kung', 'New Territories ', '+852 2792 6889', 'kennelvandego@kennelvandego.com', 'kennelvandego', 'Established in 1981, this popular kennel offers services from boarding to food delivery. Grooming services include clipping, furbrushing, claw trimming, ear cleaning, bathing and flea and tick treatment ($350-$600).', 'Kennel Van Dego.jpg', '!1m18!1m12!1m3!1d3688.9944335842615!2d114.29500081492874!3d22.391567285276224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3404057addcedf9b%3A0x65219593c190e6b5!2z6KW_6LKi5aSn57ay5LuU6LevICYg5LuB576p6Lev!5e0!3m2!1szh-TW!2shk!4v1565245125251!5m2!1szh-TW!2shk', 2, 30, '09:00', '08:00', '15:00', '12:00', '10:00', '17:30'),
('SPCA Hong Kong', '105 Princess Margaret Road, Kowloon', 'Ho Man Tin', 'Kowloon', '+852 2232 5532', 'spca@spca.com', 'spca', 'The animal-protection charity runs a petgrooming service in its Kowloon centre, with services including shampoo, claw clipping, trimming between the paw pads, ear cleaning, brushing and coat clipping. All prices are dependent on breed and size of your pet.', 'SPCA.jpg', '!1m18!1m12!1m3!1d3691.1183080562364!2d114.17541731495484!3d22.311364985317805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x340400c317561e27%3A0x285f364ba1b3d25c!2z5oSb6K235YuV54mp5Y2U5pyDIOS5nem-jeS4reW_gw!5e0!3m2!1szh-TW!2shk!4v1565245512425!5m2!1szh-TW!2shk', 3, 60, '11:00', '10:00', '17:00', '18:00', '11:00', '22:00'),
('Pet Oasis', 'Hing Fu Street, Tuen Mun', 'Tuen Mun', 'New Territories ', '+852 2456 1966', 'pet-oasis@pet-oasis.com', 'pet-oasis', 'Pet Oasis will spoil your pet with a wide array of services from five-star hotel service to pet  parties on its extensive grounds with fields and a doggy swimming pool. Grooming services include a bath, ear cleaning, nail trimming, haircut and gland expre.', 'Pet Oasis.jpg', '!1m18!1m12!1m3!1d3688.4890159627157!2d113.96239901495655!3d22.41061288526629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403fad79b9caaff%3A0xb821017774094e2e!2sPet+Oasis%2C+Natural+Choice+Pet+Hotel!5e0!3m2!1szh-TW!2shk!4v1565245601329!5m2!1szh-TW!2shk', 4, 60, '10:00', '12:00', '17:00', '18:00', '07:30', '21:00'),
('Pets World Resort', '351 Shui Mei Tsuen, Kam Tin, Yuen Long', 'Yuen Long', 'New Territories ', '+852 2470 6928', 'petworldresort@petworldresort.com', 'petworldresort', 'This pet centre offers everything from training to dog-care. Its professional dog groomers aim to make your pet look and feel fabulous. Services include basic grooming (shampoo and conditioner, claw clipping, ear cleaning, gland expression and fluff dry).', 'Pets World Resort.jpg', '!1m18!1m12!1m3!1d3687.4491728249704!2d114.05880931495737!3d22.44974898524619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403f74f8a2c2ba3%3A0xe042b150c0d3f7b3!2sPetworldresort!5e0!3m2!1szh-TW!2shk!4v1565245668190!5m2!1szh-TW!2shk', 5, 20, '07:00', '08:00', '12:30', '16:30', '06:00', '18:00'),
('TOKYO DOG Grooming Salon', 'G/F, 9A Tak Lung Back Street, Sai Kung', 'Sai Kung', 'New Territories ', '+852 2791 6555', 'b-dog@hotmail.co.jp', 'b-dog', 'In Sai Kung old town, this is a Japanese-style, pet-grooming salon for dogs and cats. It offers animal spa services such as shampoo, coat clipping and claw trimming, and has pet products on sale. Prices vary with breed and type of service, ranging from $2.', 'TOKYO DOG Grooming Salon.jpg', '!1m18!1m12!1m3!1d509.96573123852556!2d114.16951315012655!3d22.448271196565873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34040840cdc51bb9%3A0x7926e9893883a7a9!2sbDOG+Tokyo+Grooming+Salon+Tai+Po!5e0!3m2!1szh-TW!2shk!4v1565245815652!5m2!1szh-TW!2shk', 6, 15, '12:00', '09:00', '15:00', '17:30', '11:00', '17:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepts`
--
ALTER TABLE `accepts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accepts_species` (`species_id`),
  ADD KEY `accepts_store` (`store_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `case_ak_1` (`store_id`,`start_hour`),
  ADD KEY `booking_owner` (`owner_id`),
  ADD KEY `booking_pet` (`pet_id`),
  ADD KEY `booking_status` (`status_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_owner` (`owner_id`),
  ADD KEY `pet_species` (`species_id`);

--
-- Indexes for table `provides`
--
ALTER TABLE `provides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provides_facility` (`store_id`),
  ADD KEY `provides_service` (`service_id`);

--
-- Indexes for table `selected`
--
ALTER TABLE `selected`
  ADD PRIMARY KEY (`id`),
  ADD KEY `select_booking` (`booking_id`),
  ADD KEY `select_service` (`service_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_ak_1` (`service_name`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `species_ak_1` (`species_name`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `facility_ak_1` (`store_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepts`
--
ALTER TABLE `accepts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `provides`
--
ALTER TABLE `provides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `selected`
--
ALTER TABLE `selected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `species`
--
ALTER TABLE `species`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accepts`
--
ALTER TABLE `accepts`
  ADD CONSTRAINT `accepts_species` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`),
  ADD CONSTRAINT `accepts_store` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_owner` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`id`),
  ADD CONSTRAINT `booking_pet` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id`),
  ADD CONSTRAINT `booking_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `visit_facility` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_owner` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`id`),
  ADD CONSTRAINT `pet_species` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`);

--
-- Constraints for table `provides`
--
ALTER TABLE `provides`
  ADD CONSTRAINT `provides_facility` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`),
  ADD CONSTRAINT `provides_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `selected`
--
ALTER TABLE `selected`
  ADD CONSTRAINT `select_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `select_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
