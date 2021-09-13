-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2021 at 10:34 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sushidun`
--

-- --------------------------------------------------------

--
-- Table structure for table `chief`
--

CREATE TABLE `chief` (
  `Chief_id` varchar(50) NOT NULL,
  `Name-chief` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Phone_number` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Score_food` double NOT NULL,
  `Score_service` double NOT NULL,
  `Number_of_users_chief` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chief`
--

INSERT INTO `chief` (`Chief_id`, `Name-chief`, `Phone_number`, `Email`, `Password`, `Score_food`, `Score_service`, `Number_of_users_chief`) VALUES
('CH_01', 'A', '088-888-8888', 'A@gmail.com', 'A12345678', 8, 8, 2),
('CH_02', 'B', '011-111-1111', 'B@gmail.com', 'B12345678', 5, 5, 1),
('CH_03', 'C', '099-999-9999', 'C@gmail.com', 'C12345678', 10, 10, 2),
('CH_04', 'D', '077-777-7777', 'D@gmail.com', 'D12345678', 5, 5, 1),
('CH_05', 'E', '055-555-5555', 'E@nu.ac.th', 'E12345678', 10, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Course_id` varchar(50) NOT NULL,
  `Course_name` varchar(50) NOT NULL,
  `Course_price` double NOT NULL,
  `Course_score` double NOT NULL,
  `Number_of_users_course` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`Course_id`, `Course_name`, `Course_price`, `Course_score`, `Number_of_users_course`) VALUES
('C_01', 'A', 999, 5, 1),
('C_02', 'B', 2999, 5, 1),
('C_03', 'C', 3999, 10, 2),
('C_04', 'D', 5999, 14, 3),
('C_05', 'E', 8999, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_menu`
--

CREATE TABLE `course_menu` (
  `cm_id` varchar(50) NOT NULL,
  `Course_id` varchar(50) NOT NULL,
  `Menu_id` varchar(50) NOT NULL,
  `Number` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_menu`
--

INSERT INTO `course_menu` (`cm_id`, `Course_id`, `Menu_id`, `Number`) VALUES
('CM_00', 'C_04', 'M-02', 5),
('CM_01', 'C_01', 'M-01', 2),
('CM_02', 'C_01', 'M-02', 2),
('CM_03', 'C_01', 'M-06', 2),
('CM_04', 'C_01', 'M-08', 2),
('CM_05', 'C_02', 'M-01', 5),
('CM_06', 'C_02', 'M-03', 2),
('CM_07', 'C_02', 'M-02', 5),
('CM_08', 'C_02', 'M-06', 5),
('CM_09', 'C_02', 'M-08', 5),
('CM_10', 'C_03', 'M-01', 5),
('CM_12', 'C_03', 'M-02', 5),
('CM_13', 'C_03', 'M-04', 3),
('CM_14', 'C_03', 'M-07', 1),
('CM_15', 'C_04', 'M-01', 5),
('CM_16', 'C_04', 'M-02', 5),
('CM_17', 'C_04', 'M-04', 1),
('CM_18', 'C_04', 'M-05', 2),
('CM_19', 'C_04', 'M-07', 1),
('CM_20', 'C_05', 'M-01', 5),
('CM_21', 'C_05', 'M-02', 5),
('CM_22', 'C_05', 'M-03', 2),
('CM_23', 'C_05', 'M-04', 3),
('CM_24', 'C_05', 'M-05', 1),
('CM_25', 'C_05', 'M-06', 5),
('CM_26', 'C_05', 'M-07', 1),
('CM_27', 'C_05', 'M-08', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `Ingredients_id` varchar(50) NOT NULL,
  `Ingredients_name` varchar(50) NOT NULL,
  `Ingredients_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`Ingredients_id`, `Ingredients_name`, `Ingredients_value`) VALUES
('ing-01', 'ปลาแซลมอน', 2200),
('ing-02', 'ข้าว', 7250),
('ing-03', 'ไข่ปลาคาเวีย', 1100),
('ing-04', 'ปลาซาบะ', 3800),
('ing-05', 'ผักกาดขาว', 5000),
('ing-06', 'หัวหอมญี่ปุ่น', 5000),
('ing-07', 'เนื้อวัววากิ A4', 500),
('ing-08', 'เนื้อไก่', 1500),
('ing-09', 'กุ้งหนวดขาว', 10000),
('ing-10', 'เส้นราเม็ง', 10000),
('ing-11', 'เนื้อปลาทูน่า', 10000),
('ing-12', 'เนื้อวัววากิ A5', 520),
('ing-13', 'ปลามาคุโล', 1000),
('ing-14', 'น้ำปลา', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `Manager_id` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Phone_number` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`Manager_id`, `Name`, `Phone_number`, `Email`, `Password`) VALUES
('61311266_M', 'Chonlamard', '0861266847', 'Chonlamardb61@nu.ac.th', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `Menu_id` varchar(50) NOT NULL,
  `Menu_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Menu_id`, `Menu_name`) VALUES
('M-01', 'ซูชิปลาแซลมอน'),
('M-02', 'ข้าวปลาซาบะย่าง'),
('M-03', 'ซูชิทูน่า'),
('M-04', 'เนื้อวากิว A4'),
('M-05', 'เนื้อวากิว A5'),
('M-06', 'ราเมง'),
('M-07', 'ซูชิคาเวีย'),
('M-08', 'ไก่ย่างซอสญี่ปุ่น');

-- --------------------------------------------------------

--
-- Table structure for table `menu_ingredients`
--

CREATE TABLE `menu_ingredients` (
  `mi_id` varchar(50) NOT NULL,
  `Ingredients_id` varchar(50) NOT NULL,
  `Menu_id` varchar(50) NOT NULL,
  `Mi_value` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu_ingredients`
--

INSERT INTO `menu_ingredients` (`mi_id`, `Ingredients_id`, `Menu_id`, `Mi_value`) VALUES
('mi-01', 'ing-01', 'M-01', 100),
('mi-02', 'ing-02', 'M-01', 100),
('mi-03', 'ing-02', 'M-02', 100),
('mi-04', 'ing-04', 'M-02', 200),
('mi-05', 'ing-02', 'M-03', 150),
('mi-06', 'ing-11', 'M-03', 120),
('mi-07', 'ing-07', 'M-04', 100),
('mi-08', 'ing-12', 'M-05', 160),
('mi-09', 'ing-05', 'M-06', 180),
('mi-10', 'ing-06', 'M-06', 100),
('mi-11', 'ing-10', 'M-06', 200),
('mi-12', 'ing-02', 'M-07', 100),
('mi-13', 'ing-03', 'M-07', 100),
('mi-14', 'ing-08', 'M-08', 100);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `Queue_id` varchar(50) NOT NULL,
  `User_id` varchar(50) NOT NULL,
  `Chief_id` varchar(50) NOT NULL,
  `Course_id` varchar(50) NOT NULL,
  `Tables` int(11) NOT NULL,
  `Number_of_user` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` varchar(50) NOT NULL,
  `Score_queue` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `check_in` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`Queue_id`, `User_id`, `Chief_id`, `Course_id`, `Tables`, `Number_of_user`, `Date`, `Time`, `Score_queue`, `check_in`) VALUES
('Q-2hUdTT', 'U_c5', 'CH_03', 'C_04', 2, 4, '2021-04-16', '14:05:00-16:00:00', 'ให้คะแนนแล้ว', 'ยังไม่ได้เช็คอิน'),
('Q-6EJBT0', 'U_c5', 'CH_01', 'C_03', 1, 3, '2021-04-14', '14:05:00-16:00:00', 'ยังไม่ให้คะแนน', 'ยังไม่ได้เช็คอิน'),
('Q-71dDbu', 'U_ed', 'CH_01', 'C_03', 2, 1, '2021-03-03', '18:00:00 - 20:05:00', 'ยังไม่ให้คะแนน', 'ยังไม่ได้เช็คอิน'),
('Q-KnOhYR', 'U_c5', 'CH_03', 'C_03', 1, 1, '2021-04-21', '14:05:00-16:00:00', 'ยังไม่ให้คะแนน', 'ยังไม่ได้เช็คอิน'),
('Q-T786fs', 'U_c5', 'CH_01', 'C_03', 1, 5, '2021-04-13', '16:05:00-18:00:00', 'ให้คะแนนแล้ว', 'ยังไม่ได้เช็คอิน');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Phone_number` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Point` int(11) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Name`, `Phone_number`, `Email`, `Point`, `Password`, `Age`) VALUES
('U_01', 'นายธนธร ร่ำรวย', '0861266847', 'Thanathon@nu.ac.th', 71591, '12345678', 35),
('U_1e', 'นายบางแก้ว เด่นชัย', '0324568791', 'two2@gmail.com', 0, '123456', 55),
('U_48', 'นายข้าวมันไก่ แซบปาก', '0324569891', 'kr@gmail.com', 238, '12345', 30),
('U_c5', 'น.ส.ส้มตัม แซบปาก', '0324569891', 'luxifer101@gmail.com', 3103, '1234', 27),
('U_ed', 'นายข้าวมันไก่ ต้มยำกุ้ง', '0876579328', 'asdsadas@email.com', 2511, '12345678', 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chief`
--
ALTER TABLE `chief`
  ADD PRIMARY KEY (`Chief_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Course_id`);

--
-- Indexes for table `course_menu`
--
ALTER TABLE `course_menu`
  ADD PRIMARY KEY (`cm_id`),
  ADD KEY `Course_1` (`Course_id`),
  ADD KEY `Menu_1` (`Menu_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`Ingredients_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`Manager_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Menu_id`);

--
-- Indexes for table `menu_ingredients`
--
ALTER TABLE `menu_ingredients`
  ADD PRIMARY KEY (`mi_id`),
  ADD KEY `Menu` (`Menu_id`),
  ADD KEY `ingredients` (`Ingredients_id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`Queue_id`),
  ADD KEY `User` (`User_id`),
  ADD KEY `Chief` (`Chief_id`),
  ADD KEY `Course_2` (`Course_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_menu`
--
ALTER TABLE `course_menu`
  ADD CONSTRAINT `Course_1` FOREIGN KEY (`Course_id`) REFERENCES `course` (`Course_id`),
  ADD CONSTRAINT `Menu_1` FOREIGN KEY (`Menu_id`) REFERENCES `menu` (`Menu_id`);

--
-- Constraints for table `menu_ingredients`
--
ALTER TABLE `menu_ingredients`
  ADD CONSTRAINT `Menu` FOREIGN KEY (`Menu_id`) REFERENCES `menu` (`Menu_id`),
  ADD CONSTRAINT `ingredients` FOREIGN KEY (`Ingredients_id`) REFERENCES `ingredients` (`Ingredients_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `queue`
--
ALTER TABLE `queue`
  ADD CONSTRAINT `Chief` FOREIGN KEY (`Chief_id`) REFERENCES `chief` (`Chief_id`),
  ADD CONSTRAINT `Course_2` FOREIGN KEY (`Course_id`) REFERENCES `course` (`Course_id`),
  ADD CONSTRAINT `User` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
