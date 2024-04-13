-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-04-14 01:00:02
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
  `grade` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `professor` varchar(20) DEFAULT NULL,
  `max_quantity` int(11) DEFAULT NULL,
  `current_quantity` int(11) DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`cid`, `name`, `dept`, `grade`, `credit`, `professor`, `max_quantity`, `current_quantity`, `required`) VALUES
(1, '機率與統計', '資訊', 2, 3, '游景盛', 75, 1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `course_selection`
--

CREATE TABLE `course_selection` (
  `id` int(11) NOT NULL,
  `sid` varchar(8) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course_selection`
--

INSERT INTO `course_selection` (`id`, `sid`, `cid`, `name`) VALUES
(1, 'D1149754', 1, '機率與統計');

-- --------------------------------------------------------

--
-- 資料表結構 `course_timetable`
--

CREATE TABLE `course_timetable` (
  `id` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `timeid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course_timetable`
--

INSERT INTO `course_timetable` (`id`, `cid`, `timeid`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 1, 18);

-- --------------------------------------------------------

--
-- 資料表結構 `students`
--

CREATE TABLE `students` (
  `sid` char(8) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `foreigner` tinyint(1) DEFAULT 0,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `students`
--

INSERT INTO `students` (`sid`, `name`, `dept`, `grade`, `credit`, `foreigner`, `password`) VALUES
('D1149754', '薛子揚', '資訊', 2, 3, 0, '123456'),
('D1234567', '揚子薛', '資訊', 2, 0, 0, '123456');

-- --------------------------------------------------------

--
-- 資料表結構 `student_timetable`
--

CREATE TABLE `student_timetable` (
  `id` int(11) NOT NULL,
  `sid` varchar(20) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `timeid` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `student_timetable`
--

INSERT INTO `student_timetable` (`id`, `sid`, `cid`, `timeid`, `name`) VALUES
(1, 'D1149754', 1, 3, '機率與統計'),
(2, 'D1149754', 1, 4, '機率與統計'),
(3, 'D1149754', 1, 18, '機率與統計');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cid`);

--
-- 資料表索引 `course_selection`
--
ALTER TABLE `course_selection`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `course_timetable`
--
ALTER TABLE `course_timetable`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `student_timetable`
--
ALTER TABLE `student_timetable`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_selection`
--
ALTER TABLE `course_selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_timetable`
--
ALTER TABLE `course_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `student_timetable`
--
ALTER TABLE `student_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
