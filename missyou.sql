-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018 年 5 月 29 日 05:39
-- サーバのバージョン： 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LearnSNS`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `feeds`
--

CREATE TABLE `feeds` (
  `id` int(11) NOT NULL,
  `feed` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `img_name` varchar(255) DEFAULT NULL,
  `like_count` int(11) NOT NULL DEFAULT '0',
  `comment_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `feeds`
--

INSERT INTO `feeds` (`id`, `feed`, `user_id`, `img_name`, `like_count`, `comment_count`, `created`, `updated`) VALUES
(78, '危な', 20, NULL, 0, 0, '2018-05-22 09:18:51', '2018-05-22 01:18:51'),
(79, '検索もできんし', 20, NULL, 0, 0, '2018-05-22 09:21:30', '2018-05-22 01:21:30'),
(81, 'プログラム勉強したい', 20, NULL, 0, 0, '2018-05-22 09:21:55', '2018-05-22 01:21:55'),
(83, 'まじで本当にどうしよ', 20, NULL, 0, 0, '2018-05-22 09:40:48', '2018-05-22 01:40:48'),
(93, 'ここににしし', 20, NULL, 0, 0, '2018-05-28 08:57:18', '2018-05-28 00:57:18'),
(94, '秋すての', 20, NULL, 0, 0, '2018-05-28 08:57:30', '2018-05-28 00:57:30'),
(95, 'カカカカk', 20, NULL, 0, 0, '2018-05-28 08:57:37', '2018-05-28 00:57:37');

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `feed_id`) VALUES
(1, 20, 77),
(2, 20, 77),
(3, 20, 80),
(4, 23, 77),
(5, 21, 77),
(6, 21, 77),
(7, 21, 77),
(8, 21, 77),
(9, 21, 77),
(10, 20, 92),
(11, 20, 92),
(12, 20, 91),
(13, 20, 92),
(14, 20, 92),
(15, 20, 92),
(16, 20, 92),
(17, 20, 92),
(18, 20, 92),
(21, 20, 92),
(22, 20, 80),
(24, 20, 80),
(25, 20, 80),
(26, 20, 80),
(29, 20, 83),
(31, 20, 93),
(33, 20, 81),
(37, 20, 95);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img_name`, `created`, `updated`) VALUES
(3, 'mfvldんかおn', 'nodnfo@fnii', '', '20180426100938buta.jpg', '2018-04-26 10:21:45', '2018-04-26 02:21:45'),
(4, 'nosnon', 'gsnponi@ako', '', '20180426102212buta.jpg', '2018-04-26 10:22:13', '2018-04-26 02:22:13'),
(5, 'nosnon', 'gsnponi@ako', '', '20180426102212buta.jpg', '2018-04-26 10:22:14', '2018-04-26 02:22:14'),
(6, 'nosnon', 'gsnponi@ako', 'fmpampm', '20180426103730buta.jpg', '2018-04-26 10:37:30', '2018-04-26 02:37:30'),
(7, 'nosnon', 'gsnponi@ako', 'fmpampm', '20180426103730buta.jpg', '2018-04-26 10:37:33', '2018-04-26 02:37:33'),
(8, 'konipon', 'anfoooj@ngon', 'mpampn', '20180426104236buta.jpg', '2018-04-26 10:42:37', '2018-04-26 02:42:37'),
(9, 'fmpaom', 'kafpn@fnon', 'a,pmfp', '20180426104502buta.jpg', '2018-04-26 10:45:03', '2018-04-26 02:45:03'),
(10, 'fmpaom', 'kafpn@fnon', 'fnolanl', '20180426104517buta.jpg', '2018-04-26 10:45:18', '2018-04-26 02:45:18'),
(11, 'fmpaom', 'kafpn@fnon', 'mmpnmpn', '20180426104613buta.jpg', '2018-04-26 10:46:15', '2018-04-26 02:46:15'),
(12, 'nfo@:;jk', 'fnoon@dnoooon', 'cnonsd', '20180426104740IMG_9917.PNG', '2018-04-26 10:47:43', '2018-04-26 02:47:43'),
(13, 'gninii', 'anofno@fnono', '$2y$10$ybPs33YedG9WvKkO7/SwcOsZOGpb5wMYM2CE/84o7Ua0aB0sGM4ZO', '20180426105112IMG_8948.JPG', '2018-04-26 10:51:13', '2018-04-26 02:51:13'),
(14, 'afnono', 'konio@gmail.com', '$2y$10$Ht.RTeDgDQhKE.jG5FiDd.MLTVt3TN7GMvjv4OSWg.ObFdCrDgzJy', '20180427102514IMG_7138.JPG', '2018-04-27 10:25:19', '2018-04-27 02:25:19'),
(15, 'foanfo', 'konio@gmail.com', '$2y$10$f0Q.Kgi0rBcQMJ17M8yyYOR0knBI4dWxHdQDLoL.Lr7vt3OMBV2hS', '20180427102701buta.jpg', '2018-04-27 10:27:02', '2018-04-27 02:27:02'),
(16, 'fnanoni', 'konio@gmail.com', '$2y$10$tUG39CMBQmgmRTaqvMZnpO5dATA9RyvSvQL4OV7LXmaLE8hpgS6ny', '20180427104100IMG_9917.PNG', '2018-04-27 10:41:03', '2018-04-27 02:41:03'),
(17, 'vふぉあい', 'konio@gmail.com', '$2y$10$7bIOfXofInu5dB/qn9Zf8eEWjS7gjiLQJWM6l..bQPqjaglDYKh2q', '20180427104720buta.jpg', '2018-04-27 10:47:22', '2018-04-27 02:47:22'),
(18, 'kodai', 'kodai@kodai', '$2y$10$wpk0wqzo79i9jJggFu0kQ.JRvn88pTfdVxYBFKOsyfwRCA6DIMpjW', '20180502113154buta.jpg', '2018-05-02 11:31:55', '2018-05-02 03:31:55'),
(19, 'konikonikoni', 'konikoni@koni', '$2y$10$IJOS5XL3p8s9Zrc1bTPlD.M80JV6q0bBhLrhW5sz89i5qPHU/qp16', '20180502113551buta.jpg', '2018-05-02 11:35:53', '2018-05-02 03:35:53'),
(20, 'コニシ', 'laugh@laugh', '$2y$10$PW4TxVfV/k9h24Ib0d7W2.phibhLmHTpPf9HFayycDu12lcjCrjLi', '20180503035816buta.jpg', '2018-05-03 03:58:18', '2018-05-02 19:58:18'),
(21, 'mpamgpao', 'mpamf@mfako', '$2y$10$GMItHs5y.iIHWdRw1QT9i.gvE2lNjIjnguWBKr8eu.CitJvFIBlDu', '20180503112155IMG_0029.jpg', '2018-05-03 11:24:48', '2018-05-03 03:24:48'),
(22, 'konitan', 'konitan@konitan', '$2y$10$56edRtY21RIavBhjqX.zLu/GlfPKMlCAjQWH57WPZ410dnVOjz.8q', '20180511063750filmarkslogo.jpg', '2018-05-11 06:37:52', '2018-05-10 22:37:52'),
(23, '小西', 'konishi@konishi', '$2y$10$t.SE9QocNfISNdmKW6OCBeiRa3CsAgMGbCdfqJpVYCWm5C3Sp8P1y', '20180513184541IMG_0030.jpg', '2018-05-13 18:45:42', '2018-05-13 10:45:42'),
(24, 'ラフ', 'laugh913@laugh', '$2y$10$MHEB3cwpnrRXgHKRxiObgO8zO3rebGxGMM0MxLrnU4SPIO9qDaVK6', '20180518093401IMG_8948 (1).JPG', '2018-05-18 09:34:03', '2018-05-18 01:34:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feeds`
--
ALTER TABLE `feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feeds`
--
ALTER TABLE `feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
