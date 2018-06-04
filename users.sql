-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018 年 6 月 04 日 16:30
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
-- Database: `missyou`
--

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
  `introduction` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img_name`, `introduction`, `created`, `updated`) VALUES
(25, '小西', 'laugh@laugh', '$2y$10$EWmm11D9eEodKDpjKj0pU.DM3bcAUjT8mlN8NTVGDB4uahT1qSA22', '20180530115129JPEGイメージ-45F58F0FB8AA-1.jpeg', '', '2018-05-30 11:55:22', '2018-05-30 03:55:22'),
(26, 'koni0', 'koni0@koni0', '$2y$10$6vpc2pCN5cEZNRa2cxjPq..17MIiUG37XPIhn6jdS4ofx2mvshHW2', '20180530190704IMG_5281.JPG', '', '2018-05-30 19:07:11', '2018-05-30 11:07:11'),
(27, 'だてちゃん', 'date@date', '$2y$10$2cO9300YFc1q7rDIi9dwGep9isOkCrTVXOQzZR9vP2QSvYzSa0DW2', '20180530210433JPEGイメージ-5B215ADF9648-1.jpg', '', '2018-05-30 21:04:40', '2018-05-30 13:04:40'),
(28, 'taichi', 'taichi@taichi', '$2y$10$6xUq/OG2l9cvbkLf0v9QK.7A3ZlIT4epYYfIIP14OCmNkNCn8PS5i', '20180530215242IMG_9989.JPG', '', '2018-05-30 21:52:46', '2018-05-30 13:52:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
