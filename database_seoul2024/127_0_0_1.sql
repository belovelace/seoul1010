-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-10-10 08:40
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `seoul2024`
--
CREATE DATABASE IF NOT EXISTS `seoul2024` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `seoul2024`;

-- --------------------------------------------------------

--
-- 테이블 구조 `admin`
--

CREATE TABLE `admin` (
  `ID` varchar(100) NOT NULL,
  `PWD` varchar(100) NOT NULL,
  `PHONE_NUM` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `admin`
--

INSERT INTO `admin` (`ID`, `PWD`, `PHONE_NUM`) VALUES
('admin1', '1111', '01012345678'),
('admin2', '1112', '01073478565'),
('admin3', '1113', '01064434986'),
('admin4', '1114', '01098877654');

-- --------------------------------------------------------

--
-- 테이블 구조 `machine`
--

CREATE TABLE `machine` (
  `CODE` varchar(100) NOT NULL,
  `STATE_NUM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `machine`
--

INSERT INTO `machine` (`CODE`, `STATE_NUM`) VALUES
('1112', 1),
('1211', 1),
('1224', 1),
('2112', 1),
('2124', 1),
('2212', 1),
('3111', 1),
('3122', 1),
('3123', 1),
('3222', 1),
('3224', 1),
('4112', 1),
('4211', 1),
('4222', 1),
('5121', 1),
('5123', 1),
('5211', 1),
('6111', 1),
('6112', 1),
('6121', 1),
('6122', 1),
('6123', 1),
('6124', 1),
('6212', 1),
('1124', 2),
('2111', 2),
('2122', 2),
('2221', 2),
('3112', 2),
('3211', 2),
('3212', 2),
('3223', 2),
('4121', 2),
('4124', 2),
('4221', 2),
('4224', 2),
('5112', 2),
('5122', 2),
('5212', 2),
('5221', 2),
('5222', 2),
('5223', 2),
('6211', 2),
('1111', 3),
('1121', 3),
('1122', 3),
('1123', 3),
('1212', 3),
('1221', 3),
('2121', 3),
('2123', 3),
('2211', 3),
('2222', 3),
('2223', 3),
('2224', 3),
('3121', 3),
('3124', 3),
('3221', 3),
('4111', 3),
('4122', 3),
('4123', 3),
('4212', 3),
('4223', 3),
('5111', 3),
('5124', 3),
('5224', 3),
('6221', 3),
('6222', 3),
('6223', 3),
('6224', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `park`
--

CREATE TABLE `park` (
  `CODE` varchar(100) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `LATITUDE` double DEFAULT NULL,
  `LONGITUDE` double DEFAULT NULL,
  `TOILET_NUM` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `park`
--

INSERT INTO `park` (`CODE`, `NAME`, `LATITUDE`, `LONGITUDE`, `TOILET_NUM`) VALUES
('1', '상암근린공원', 37.57053, 126.8853, '11'),
('2', '부엉이근린공원', 37.58555, 126.8835, '21'),
('3', '구룡근린공원', 37.58293, 126.8837, '31'),
('4', '노을공원', 37.57439, 126.8756, '41'),
('5', '하늘공원', 37.56797, 126.8858, '51'),
('6', '난지한강공원', 37.56636, 126.8766, '61');

-- --------------------------------------------------------

--
-- 테이블 구조 `state`
--

CREATE TABLE `state` (
  `STATE_CODE` int(11) NOT NULL,
  `STATE_CONTENT` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `state`
--

INSERT INTO `state` (`STATE_CODE`, `STATE_CONTENT`) VALUES
(1, '없음'),
(2, '부족'),
(3, '많음');

-- --------------------------------------------------------

--
-- 테이블 구조 `toilet`
--

CREATE TABLE `toilet` (
  `CODE` varchar(100) NOT NULL,
  `LATITUDE` double DEFAULT NULL,
  `LONGITUDE` double DEFAULT NULL,
  `MACHINE_NUM` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `toilet`
--

INSERT INTO `toilet` (`CODE`, `LATITUDE`, `LONGITUDE`, `MACHINE_NUM`) VALUES
('11', 37.57618, 126.8871, '1111'),
('12', 37.57867, 126.8842, '1211'),
('21', 37.58644, 126.8839, '1211'),
('22', 37.58479, 126.8832, '2211'),
('31', 37.58316, 126.8827, '3111'),
('32', 37.58261, 126.8839, '3211'),
('41', 37.57439, 126.8756, '4111'),
('42', 37.57738, 126.8789, '4211'),
('51', 37.58674, 126.8878, '5111'),
('52', 37.56642, 126.8888, '5221'),
('61', 37.56738, 126.8737, '6111'),
('62', 37.56574, 126.8788, '6211');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `PWD` (`PWD`),
  ADD UNIQUE KEY `PHONE_NUM` (`PHONE_NUM`);

--
-- 테이블의 인덱스 `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`CODE`),
  ADD UNIQUE KEY `CODE` (`CODE`),
  ADD KEY `STATE_NUM_FK` (`STATE_NUM`);

--
-- 테이블의 인덱스 `park`
--
ALTER TABLE `park`
  ADD PRIMARY KEY (`CODE`),
  ADD UNIQUE KEY `CODE` (`CODE`),
  ADD KEY `TOILET_NUM_FK` (`TOILET_NUM`);

--
-- 테이블의 인덱스 `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`STATE_CODE`),
  ADD UNIQUE KEY `STATE_NUM_UNIQUE` (`STATE_CODE`);

--
-- 테이블의 인덱스 `toilet`
--
ALTER TABLE `toilet`
  ADD PRIMARY KEY (`CODE`),
  ADD UNIQUE KEY `CODE` (`CODE`),
  ADD KEY `MACHINE_NUM_FK` (`MACHINE_NUM`);

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `machine`
--
ALTER TABLE `machine`
  ADD CONSTRAINT `STATE_NUM_FK` FOREIGN KEY (`STATE_NUM`) REFERENCES `state` (`STATE_CODE`);

--
-- 테이블의 제약사항 `park`
--
ALTER TABLE `park`
  ADD CONSTRAINT `TOILET_NUM_FK` FOREIGN KEY (`TOILET_NUM`) REFERENCES `toilet` (`CODE`) ON DELETE CASCADE;

--
-- 테이블의 제약사항 `toilet`
--
ALTER TABLE `toilet`
  ADD CONSTRAINT `MACHINE_NUM_FK` FOREIGN KEY (`MACHINE_NUM`) REFERENCES `machine` (`CODE`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
