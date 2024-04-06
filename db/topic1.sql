-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-04-06 22:45:12
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `topic1`
--

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `cid` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `professor` varchar(20) DEFAULT NULL,
  `max_quantity` int(11) DEFAULT NULL,
  `current_quantity` int(11) NOT NULL,
  `required` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`cid`, `name`, `dept`, `credit`, `professor`, `max_quantity`, `current_quantity`, `required`) VALUES
(1, '機率與統計', '資電', 3, '游景盛', 75, 0, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `course_selection`
--

CREATE TABLE `course_selection` (
  `sid` varchar(8) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `course_timetable`
--

CREATE TABLE `course_timetable` (
  `cid` int(11) DEFAULT NULL,
  `timeid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course_timetable`
--

INSERT INTO `course_timetable` (`cid`, `timeid`) VALUES
(1, 3),
(1, 4),
(1, 18);

-- --------------------------------------------------------

--
-- 資料表結構 `students`
--

CREATE TABLE `students` (
  `sid` varchar(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `foreigner` tinyint(1) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `students`
--

INSERT INTO `students` (`sid`, `name`, `dept`, `grade`, `credit`, `foreigner`, `password`) VALUES
('D1149754', '薛子揚', '資電', 2, 0, 0, '123456');

-- --------------------------------------------------------

--
-- 資料表結構 `student_timetable`
--

CREATE TABLE `student_timetable` (
  `sid` varchar(20) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `timeid` int(11) DEFAULT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cid`);

--
-- 資料表索引 `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
