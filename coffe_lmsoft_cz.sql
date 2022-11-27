-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 07:45 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffe_lmsoft_cz`
--

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `ID` int(5) NOT NULL,
  `date` date NOT NULL,
  `id_people` int(11) NOT NULL,
  `id_types` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`ID`, `date`, `id_people`, `id_types`) VALUES
(11, '2022-09-29', 2, 1),
(12, '2022-09-29', 2, 1),
(13, '2022-09-29', 1, 2),
(14, '2022-09-29', 2, 1),
(15, '2022-09-29', 2, 2),
(16, '2022-09-29', 2, 1),
(17, '2022-09-29', 2, 1),
(18, '2022-09-29', 2, 3),
(19, '2022-09-29', 2, 1),
(20, '2022-09-29', 2, 1),
(21, '2022-09-29', 2, 2),
(22, '2022-09-30', 2, 5),
(23, '2022-09-30', 2, 1),
(24, '2022-09-30', 2, 1),
(25, '2022-09-30', 1, 1),
(26, '2022-10-05', 1, 1),
(27, '2022-10-05', 2, 2),
(28, '2022-10-05', 1, 1),
(29, '2022-10-05', 1, 3),
(30, '2022-10-05', 1, 1),
(31, '2022-10-05', 1, 1),
(32, '2022-10-05', 1, 1),
(33, '2022-10-05', 1, 2),
(34, '2022-10-05', 1, 3),
(35, '2022-10-05', 1, 4),
(36, '2022-10-05', 1, 5),
(37, '2022-10-05', 1, 4),
(38, '2022-10-05', 3, 3),
(39, '2022-10-05', 1, 2),
(40, '2022-10-05', 1, 2),
(41, '2022-10-05', 2, 5),
(42, '2022-10-05', 2, 5),
(43, '2022-10-05', 1, 1),
(44, '2022-10-05', 1, 2),
(45, '2022-10-05', 1, 5),
(46, '2022-10-06', 1, 2),
(47, '2022-10-06', 1, 2),
(48, '2022-10-06', 1, 3),
(49, '2022-10-06', 1, 4),
(50, '2022-10-06', 1, 5),
(51, '2022-10-06', 1, 2),
(52, '2022-10-06', 1, 2),
(53, '2022-10-06', 1, 5),
(54, '2022-10-06', 1, 3),
(55, '2022-10-06', 1, 3),
(56, '2022-10-06', 1, 3),
(57, '2022-10-06', 1, 3),
(58, '2022-10-06', 1, 5),
(59, '2022-10-06', 1, 5),
(60, '2022-10-06', 1, 5),
(61, '2022-10-06', 1, 5),
(62, '2022-10-06', 1, 1),
(63, '2022-10-06', 1, 3),
(64, '2022-10-06', 1, 5),
(65, '2022-10-06', 1, 4),
(66, '2022-10-06', 1, 2),
(67, '2022-10-06', 1, 5),
(68, '2022-10-06', 1, 2),
(69, '2022-10-06', 1, 5),
(70, '2022-10-06', 1, 2),
(71, '2022-10-06', 1, 5),
(72, '2022-10-06', 1, 1),
(73, '2022-10-06', 1, 4),
(74, '2022-10-06', 1, 2),
(75, '2022-10-06', 1, 4),
(76, '2022-10-06', 2, 1),
(77, '2022-10-06', 2, 4),
(78, '2022-10-06', 2, 1),
(79, '2022-10-06', 2, 4),
(80, '2022-10-07', 1, 1),
(81, '2022-10-07', 1, 2),
(82, '2022-10-07', 1, 3),
(83, '2022-10-07', 1, 1),
(84, '2022-10-07', 1, 4),
(85, '2022-10-10', 1, 1),
(86, '2022-10-10', 1, 1),
(87, '2022-10-10', 1, 4),
(88, '2022-10-10', 1, 4),
(89, '2022-10-10', 1, 3),
(90, '2022-10-12', 3, 1),
(91, '2022-10-12', 3, 4),
(92, '2022-10-14', 1, 1),
(93, '2022-10-14', 1, 1),
(94, '2022-10-14', 1, 4),
(95, '2022-10-14', 1, 1),
(96, '2022-10-15', 2, 1),
(97, '2022-10-15', 2, 1),
(98, '2022-10-15', 1, 3),
(99, '2022-10-15', 1, 3),
(100, '2022-10-15', 1, 3),
(101, '2022-10-15', 2, 3),
(102, '2022-10-15', 1, 1),
(103, '2022-10-15', 1, 4),
(104, '2022-10-15', 1, 3),
(105, '2022-10-15', 1, 3),
(106, '2022-10-15', 2, 3),
(107, '2022-10-15', 1, 3),
(108, '2022-10-15', 1, 3),
(109, '2022-10-15', 1, 3),
(110, '2022-10-15', 1, 3),
(111, '2022-10-15', 1, 3),
(112, '2022-10-15', 1, 3),
(113, '2022-10-15', 2, 1),
(114, '2022-10-15', 3, 1),
(115, '2022-10-15', 1, 1),
(116, '2022-10-15', 1, 3),
(117, '2022-10-15', 1, 3),
(118, '2022-10-15', 1, 1),
(119, '2022-10-15', 1, 1),
(120, '2022-10-15', 1, 3),
(121, '2022-10-15', 1, 2),
(122, '2022-10-15', 1, 4),
(123, '2022-10-15', 1, 1),
(124, '2022-10-15', 1, 3),
(125, '2022-10-15', 1, 5),
(126, '2022-10-15', 1, 3),
(127, '2022-10-15', 1, 3),
(128, '2022-10-16', 1, 3),
(129, '2022-10-16', 1, 3),
(130, '2022-10-16', 1, 4),
(131, '2022-10-16', 1, 1),
(132, '2022-10-16', 1, 1),
(133, '2022-10-16', 2, 1),
(134, '2022-10-16', 2, 2),
(135, '2022-10-16', 2, 3),
(136, '2022-10-16', 2, 4),
(137, '2022-10-16', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `paid`
--

CREATE TABLE `paid` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paid`
--

INSERT INTO `paid` (`id`, `people_id`, `price`, `date`) VALUES
(1, 1, 0, '2022-11-22'),
(2, 1, 0, '2022-11-22'),
(3, 1, 1000, '2022-11-22'),
(4, 1, 500, '2022-11-22'),
(5, 2, 10, '2022-11-22'),
(6, 2, 250, '2022-11-22'),
(7, 1, 1000, '2022-11-27'),
(8, 1, 1000, '2022-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `ID` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logged` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`ID`, `name`, `email`, `password`, `logged`) VALUES
(1, 'Masopust Lukáš', 'masopust@spsejecna.cz', '', 0),
(2, 'Molič Jan', 'molic@spsejecna.cz', '', 0),
(3, 't', 'e', '', 0),
(4, 'coffemaster', 'coffemaster@coffe.cz', 'coffe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `ID` int(5) NOT NULL,
  `typ` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`ID`, `typ`, `price`, `weight`) VALUES
(1, 'Mléko', 10, 50),
(2, 'Espresso', 12, 7),
(3, 'Coffe', 24, 14),
(4, 'Long', 10, 14),
(5, 'Doppio+', 65, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_types` (`id_types`),
  ADD KEY `fk_people` (`id_people`);

--
-- Indexes for table `paid`
--
ALTER TABLE `paid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `people_id_fk` (`people_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `paid`
--
ALTER TABLE `paid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drinks`
--
ALTER TABLE `drinks`
  ADD CONSTRAINT `fk_people` FOREIGN KEY (`id_people`) REFERENCES `people` (`ID`),
  ADD CONSTRAINT `fk_types` FOREIGN KEY (`id_types`) REFERENCES `types` (`ID`);

--
-- Constraints for table `paid`
--
ALTER TABLE `paid`
  ADD CONSTRAINT `people_id_fk` FOREIGN KEY (`people_id`) REFERENCES `people` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
