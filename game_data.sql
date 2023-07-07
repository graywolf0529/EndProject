-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-07-07 07:43:57
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `endproject`
--

-- --------------------------------------------------------

--
-- 資料表結構 `game_data`
--

CREATE TABLE `game_data` (
  `sn` int(2) NOT NULL,
  `p_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `p_price` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `p_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `p_note` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img_src` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 傾印資料表的資料 `game_data`
--

INSERT INTO `game_data` (`sn`, `p_name`, `p_price`, `p_number`, `p_note`, `img_src`, `Create_time`) VALUES
(1, 'Apex', 'Free', '9999', 'PC', 'game03.avif', '2023-06-09 08:42:01'),
(2, '薩爾達傳說：王國之淚', '2240', '80', 'Switch', 'game07.jpg', '2023-06-09 08:43:17'),
(3, '薩爾達傳說：曠野之息', '1790', '120', 'Switch', 'game08.jpg', '2023-06-09 08:43:17'),
(4, '地平線 西域禁地', '1190', '35', 'PS5', 'game09.webp', '2023-06-09 08:58:16'),
(5, 'Marvel\'s Spider-Man: Miles Morales', '1490', '66', 'PS5', 'game10.webp', '2023-06-09 08:58:16'),
(6, '艾爾登法環', '1790', '12', 'PC', 'game11.png', '2023-06-09 08:59:13'),
(7, '隻狼', '1490', '69', 'PC', 'Sekiro02.jpg', '2023-06-09 08:59:13'),
(8, 'God of War™ Ragnarök', '1990', '34', 'PS5', 'game12.webp', '2023-06-09 09:02:00'),
(9, 'Halo Infinite', 'Free', '999', 'XBOX;PC', 'game13.jpg', '2023-06-09 09:02:00'),
(10, '暗黑破壞神IV', '2290', '478', 'PC;PS4;XBOX', 'game14.jpg', '2023-06-09 09:04:41'),
(11, 'Halo 5: Guardians', '570', '81', 'XBOX', 'game15.jpg', '2023-06-09 09:04:41'),
(12, '臥龍', '1490', '44', 'PC;PS5', 'game01.jpg', '2023-06-09 15:14:12'),
(13, 'TEST', '0000', '0000', 'TEST', '0302.jpg', '2023-06-09 15:17:14'),
(14, 'TEST2', '0', '0', 'TEST', '0302.jpg', '2023-06-09 16:23:12');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `game_data`
--
ALTER TABLE `game_data`
  ADD PRIMARY KEY (`sn`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `game_data`
--
ALTER TABLE `game_data`
  MODIFY `sn` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
