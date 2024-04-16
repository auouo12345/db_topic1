-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-04-16 23:24:53
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
(1001, '邏輯設計', '資訊', 1, 3, '王益文', 69, 0, 1),
(1002, '線性代數', '資訊', 1, 3, '洪維志', 65, 0, 1),
(1003, '計算機概論', '資訊', 1, 2, '林峰正', 65, 0, 1),
(1004, '微積分', '資訊', 1, 3, '李英豪', 65, 0, 1),
(1005, '普通物理', '資訊', 1, 3, '胡水上', 65, 0, 1),
(1006, '程式設計', '資訊', 1, 4, '劉明機', 65, 0, 1),
(1007, '互連網路', '資訊', 1, 2, '林峰正', 2, 0, 0),
(1008, '資料統計', '資訊', 1, 2, '薛念林', 1, 1, 0),
(1101, '英文作文', '外語', 1, 2, '蕭碧莉', 67, 2, 1),
(1102, '英文 ', '外語', 1, 2, '陳彥京', 68, 2, 1),
(1103, '英語發音與聽力練習', '外語', 1, 2, '林芷瑩', 71, 2, 1),
(1104, '電腦輔助語言學習', '外語', 1, 2, '林芷瑩', 71, 0, 0),
(1105, '語言學習方法與策略', '外語', 1, 2, '王鈺琪', 71, 0, 0),
(1106, '文學作品導讀', '外語', 1, 2, '林盈萱', 71, 0, 0),
(1107, '西洋文學專論', '外語', 1, 2, '陳柏軒', 71, 0, 0),
(2001, '機率與統計', '資訊', 2, 3, '游景盛', 75, 1, 1),
(2002, '系統程式', '資訊', 2, 3, '劉宗杰', 66, 0, 1),
(2003, '資料庫系統', '資訊', 2, 3, '許懷中', 55, 0, 1),
(2004, '離散數學', '資訊', 2, 3, '游景盛', 55, 0, 1),
(2005, '數位系統設計', '資訊', 2, 3, '游景盛', 58, 0, 0),
(2006, 'UNIX應用與實務', '資訊', 2, 2, '林佩蓉', 63, 0, 0),
(2007, 'Web程式設計', '資訊', 2, 3, '薛念林', 1, 0, 0),
(2008, '物件導向設計', '資訊', 2, 2, '曾昭文', 1, 0, 0),
(2009, '密碼學', '資訊', 2, 3, '李榮三', 60, 0, 0),
(2101, '英語演說', '外語', 2, 2, '陳秋華', 74, 0, 1),
(2102, '英國文學', '外語', 2, 2, '蕭碧莉', 68, 0, 1),
(2103, '第二外語', '外語', 2, 2, '陳彥京', 75, 0, 1),
(2104, '語言學概論', '外語', 2, 2, '陳彥京', 75, 0, 1),
(2105, '文學與地景', '外語', 2, 2, '蕭碧莉', 75, 0, 0),
(2106, '英語語言史', '外語', 2, 2, '林盈萱', 75, 0, 0),
(2107, '散文選讀', '外語', 2, 2, '陳秋華', 75, 0, 0),
(2108, '新聞英文閱讀', '外語', 2, 2, '徐琍沂', 75, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `course_selection`
--

CREATE TABLE `course_selection` (
  `id` int(11) NOT NULL,
  `sid` varchar(8) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `attention` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course_selection`
--

INSERT INTO `course_selection` (`id`, `sid`, `cid`, `name`, `attention`) VALUES
(4, 'D1234568', 1101, '英文作文', 0),
(5, 'D1234568', 1102, '英文 ', 0),
(6, 'D1234568', 1103, '英語發音與聽力練習', 0),
(7, 'D1234569', 1101, '英文作文', 0),
(8, 'D1234569', 1102, '英文 ', 0),
(9, 'D1234569', 1103, '英語發音與聽力練習', 0),
(12, 'D1149754', 2001, '機率與統計', 0),
(29, 'D1234567', 1008, '資料統計', 0),
(30, 'D1149754', 1008, '資料統計', 1);

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
(4, 1001, 1),
(5, 1001, 2),
(6, 1001, 15),
(7, 1002, 16),
(8, 1002, 17),
(9, 1002, 18),
(10, 1003, 6),
(11, 1003, 7),
(12, 1004, 20),
(13, 1004, 21),
(14, 1004, 22),
(15, 1005, 31),
(16, 1005, 32),
(17, 1005, 46),
(18, 1006, 57),
(19, 1006, 58),
(20, 1006, 59),
(21, 1006, 60),
(22, 1007, 62),
(23, 1007, 63),
(24, 1008, 8),
(25, 1008, 9),
(26, 2001, 3),
(27, 2001, 4),
(28, 2001, 18),
(29, 2002, 6),
(30, 2002, 7),
(31, 2002, 20),
(32, 2003, 22),
(33, 2003, 23),
(34, 2003, 24),
(35, 2004, 15),
(36, 2004, 16),
(37, 2004, 17),
(38, 2005, 30),
(39, 2005, 31),
(40, 2005, 32),
(41, 2006, 34),
(42, 2006, 37),
(43, 2007, 38),
(44, 2007, 39),
(45, 2007, 58),
(46, 2008, 59),
(47, 2008, 60),
(48, 2009, 12),
(49, 2009, 13),
(50, 2009, 14),
(51, 1101, 34),
(52, 1101, 35),
(53, 1102, 39),
(54, 1102, 40),
(55, 1103, 48),
(56, 1103, 49),
(57, 1104, 3),
(58, 1104, 4),
(59, 1105, 64),
(60, 1105, 65),
(61, 1106, 1),
(62, 1106, 2),
(63, 1107, 11),
(64, 1107, 12),
(65, 2101, 67),
(66, 2101, 68),
(67, 2102, 39),
(68, 2102, 40),
(69, 2103, 29),
(70, 2103, 30),
(71, 2104, 6),
(72, 2104, 7),
(73, 2105, 43),
(74, 2105, 44),
(75, 2106, 17),
(76, 2106, 18),
(77, 2107, 53),
(78, 2107, 54),
(79, 2108, 62),
(80, 2108, 63);

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
('D1149754', '薛子揚', '資訊', 2, 5, 0, '123456'),
('D1234567', '揚子薛', '資訊', 2, 2, 0, '123456'),
('D1234568', '我是文組', '外語', 1, 6, 0, '123456'),
('D1234569', '我是外國人', '外語', 1, 6, 1, '123456');

-- --------------------------------------------------------

--
-- 資料表結構 `student_timetable`
--

CREATE TABLE `student_timetable` (
  `id` int(11) NOT NULL,
  `sid` varchar(20) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `timeid` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `attention` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `student_timetable`
--

INSERT INTO `student_timetable` (`id`, `sid`, `cid`, `timeid`, `name`, `attention`) VALUES
(10, 'D1234568', 1101, 34, '英文作文', 0),
(11, 'D1234568', 1101, 35, '英文作文', 0),
(12, 'D1234568', 1102, 39, '英文 ', 0),
(13, 'D1234568', 1102, 40, '英文 ', 0),
(14, 'D1234568', 1103, 48, '英語發音與聽力練習', 0),
(15, 'D1234568', 1103, 49, '英語發音與聽力練習', 0),
(16, 'D1234569', 1101, 34, '英文作文', 0),
(17, 'D1234569', 1101, 35, '英文作文', 0),
(18, 'D1234569', 1102, 39, '英文 ', 0),
(19, 'D1234569', 1102, 40, '英文 ', 0),
(20, 'D1234569', 1103, 48, '英語發音與聽力練習', 0),
(21, 'D1234569', 1103, 49, '英語發音與聽力練習', 0),
(24, 'D1149754', 2001, 3, '機率與統計', 0),
(25, 'D1149754', 2001, 4, '機率與統計', 0),
(26, 'D1149754', 2001, 18, '機率與統計', 0),
(63, 'D1234567', 1008, 8, '資料統計', 0),
(64, 'D1234567', 1008, 9, '資料統計', 0),
(65, 'D1149754', 1008, 8, '資料統計', 1),
(66, 'D1149754', 1008, 9, '資料統計', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_timetable`
--
ALTER TABLE `course_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `student_timetable`
--
ALTER TABLE `student_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
