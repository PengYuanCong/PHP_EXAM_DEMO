-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2022 年 06 月 19 日 14:22
-- 伺服器版本： 10.5.12-MariaDB
-- PHP 版本： 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `id19070483_foodmap`
--

-- --------------------------------------------------------

--
-- 資料表結構 `comments`
--

CREATE TABLE `comments` (
  `Username` varchar(30) NOT NULL,
  `Resname` varchar(30) NOT NULL,
  `Star` varchar(1) NOT NULL,
  `Msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `comments`
--

INSERT INTO `comments` (`Username`, `Resname`, `Star`, `Msg`) VALUES
('user01', '吉初豆花', '5', '1321321');

-- --------------------------------------------------------

--
-- 資料表結構 `favorite`
--

CREATE TABLE `favorite` (
  `Username` varchar(30) NOT NULL,
  `Resname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `favorite`
--

INSERT INTO `favorite` (`Username`, `Resname`) VALUES
('user01', '吉初豆花');

-- --------------------------------------------------------

--
-- 資料表結構 `nearby`
--

CREATE TABLE `nearby` (
  `Resname` varchar(50) NOT NULL,
  `ResAddress` varchar(50) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `BUS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `nearby`
--

INSERT INTO `nearby` (`Resname`, `ResAddress`, `Phone`, `BUS`) VALUES
('吉初豆花', '高雄市楠梓區惠民路32號', '073648118', NULL),
('好想鍋', '高雄市楠梓區大學東路288號', '073663326', NULL),
('玉豆腐', '高雄市楠梓區藍田路288號', '073646012', NULL),
('素描學派', '高雄市楠梓區藍田路656號', '073608239', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `restaurants`
--

CREATE TABLE `restaurants` (
  `Resname` varchar(30) NOT NULL,
  `ResAddress` varchar(30) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `ResType` varchar(30) NOT NULL,
  `OpenTime` varchar(50) NOT NULL,
  `info` varchar(500) NOT NULL,
  `BUS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `restaurants`
--

INSERT INTO `restaurants` (`Resname`, `ResAddress`, `Phone`, `ResType`, `OpenTime`, `info`, `BUS`) VALUES
('吉初豆花', '高雄市楠梓區惠民路32號', '073648118', '甜點', '平日13:30~晚上23:00 假日12:00~晚上23:00', '一份堅守的心，找回最初的甜。\r\n●使用非基因改造黃豆\r\n●堅持手作傳統豆花\r\n●精選配料細心熬煮', NULL),
('好想鍋', '811高雄市楠梓區大學東路288號', '073663326', '火鍋', '每日11:00~晚上23:00', '好想鍋為高雄人氣火鍋品牌「好好鍋」的二代店。\r\n秉持著讓〝食〞回歸天然原始的精神，從吃食品回到吃食物。呈現給每一位食客「平價消費、霸氣享受」的感受。', NULL),
('玉豆腐', '高雄市楠梓區藍田路288號', '073646012', '韓式料理', '每天11:00-21:00', '【玉豆腐-韓式料理】呈現給您與韓國首爾同步的美食\r\n招牌:明太子起司烘蛋捲、泡菜海鮮煎餅、韓國洋釀炸雞。\r\n以韓國傳統手法自製各式泡菜，手作嫩豆腐，使用韓國進口調味醬料。進口韓國角閃石鍋專用煮飯機，韓國餐具器皿，呈現給您與韓國首爾同步的美味料理。\r\n餐點主軸：韓式泡菜嫩豆腐煲(備有蛋奶素食鍋)、泡菜海鮮煎餅、韓國炸雞、明太子起司烘蛋捲(必點超人氣)、起司辣炒年糕、部隊鍋、五樣精緻小菜、韓國飲品及韓國啤酒...等', '大學東路口'),
('素描學派', '高雄市楠梓區藍田路656號', '073608239', '俄羅斯餐廳', '週一公休，週二~週日下午12:00~15:00，下午17:00~21:00', '素描學派俄羅斯餐廳\r\n電話訂位請於上班時間來電\r\n週五週六本館後半部為繪畫空間，為不影響作畫，故不接待8人以上訂位。上課時段，也請輕聲細語，謝謝您~', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `search`
--

CREATE TABLE `search` (
  `Username` varchar(30) NOT NULL,
  `Resname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `search`
--

INSERT INTO `search` (`Username`, `Resname`) VALUES
('123456789', '玉豆腐'),
('user01', '吉初豆花'),
('user01', '玉豆腐'),
('user01', '素描學派');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `Username` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`Username`, `Email`, `Password`, `Date`) VALUES
('user01', '123456@gmail.com', '987654321', '2022-06-08 00:00:00'),
('admin', '987654321@gmail.com', '987654321', '2022-06-08 00:00:00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Username`,`Resname`) USING BTREE;

--
-- 資料表索引 `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`Username`,`Resname`) USING BTREE;

--
-- 資料表索引 `nearby`
--
ALTER TABLE `nearby`
  ADD PRIMARY KEY (`Resname`);

--
-- 資料表索引 `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`Resname`);

--
-- 資料表索引 `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`Username`,`Resname`) USING BTREE;

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
