-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2023 at 12:33 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finallucid`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `contents` varchar(100) NOT NULL,
  `post_id` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reply` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `contents`, `post_id`, `created`, `reply`) VALUES
(2, 3, 'ads', 15, '2023-06-13 07:43:37', 0),
(3, 3, 'asd', 15, '2023-06-13 08:06:25', 0),
(4, 3, 'asd', 13, '2023-06-13 08:27:06', 0),
(5, 3, 'asdfa', 13, '2023-06-13 09:45:23', 0),
(6, 2, 'yes', 15, '2023-06-21 19:44:22', 3),
(7, 4, 'Nice Pic', 18, '2023-06-21 20:00:06', 0),
(8, 4, 'No', 15, '2023-06-21 20:00:20', 6),
(9, 4, 'efg', 15, '2023-06-21 20:00:27', 3);

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

DROP TABLE IF EXISTS `feeds`;
CREATE TABLE IF NOT EXISTS `feeds` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `picture` varchar(100) NOT NULL,
  `userID` int NOT NULL,
  `sharedId` int NOT NULL,
  `message` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`id`, `dname`, `username`, `email`, `content`, `profile`, `date`, `picture`, `userID`, `sharedId`, `message`) VALUES
(1, 'Skydriven', 'tagpuno619', 'tagpuno619@gmail.com', 'Hello World', 'default.png', '2023-06-09 20:19:28', '', 2, 0, 0),
(2, 'Skydriven', 'tagpuno619', 'tagpuno619@gmail.com', 'asdf', 'default.png', '2023-06-09 20:35:12', 'girl meme.jfif', 2, 0, 0),
(3, 'Skydriven', 'tagpuno619', 'tagpuno619@gmail.com', 'adf\r\n', 'default.png', '2023-06-10 10:46:34', '', 2, 0, 0),
(4, 'Skydriven', 'tagpuno619', 'tagpuno619@gmail.com', 'asdf', 'default.png', '2023-06-11 21:49:25', '', 2, 0, 0),
(8, 'Skydriven', 'tagpuno619', 'tagpuno619@gmail.com', 'tt', 'default.png', '2023-06-11 22:04:39', '', 2, 2, 0),
(9, 'Skydriven', 'tagpuno619', 'tagpuno619@gmail.com', 'HAHAHA', 'default.png', '2023-06-11 22:07:36', '', 2, 4, 0),
(10, 'Skydriven', 'tagpuno619', 'tagpuno619@gmail.com', 'asdf', 'default.png', '2023-06-12 21:17:44', '', 2, 0, 0),
(12, 'Skydriven', 'tagpuno619', 'tagpuno619@gmail.com', 'asdf', 'default.png', '2023-06-12 21:18:51', 'DoggoDance.gif', 2, 0, 0),
(13, 'Skygriffin', 'asd', 'skybroken619@gmail.com', 'yeyeye', 'girl meme.jfif', '2023-06-13 07:24:34', '', 3, 12, 0),
(14, 'Skygriffin', 'asd', 'skybroken619@gmail.com', 'heheheh', 'girl meme.jfif', '2023-06-13 07:26:42', '', 3, 0, 0),
(15, 'Skygriffin', 'asd', 'skybroken619@gmail.com', '', 'girl meme.jfif', '2023-06-13 07:26:59', 'arrow.gif', 3, 0, 0),
(17, 'Account number 2', 'acc2', 'skybroken619@gmail.com', 'asdf', 'girl meme.jfif', '2023-06-13 10:55:26', '', 2, 0, 2),
(18, 'Account number 2', 'acc2', 'skybroken619@gmail.com', 'hehehehe', 'girl meme.jfif', '2023-06-13 11:19:53', 'johny.jfif', 2, 0, 2),
(19, 'Shamel', 'sha', 'shamelwildrift@gmail.com', 'Test123\r\n', 'images (6).jpeg', '2023-06-21 19:59:54', 'HNYManny.jpg', 4, 0, 0),
(20, 'Shamel', 'sha', 'shamelwildrift@gmail.com', 'Hello ACCount number 2', 'images (6).jpeg', '2023-06-21 20:01:20', '', 3, 0, 3),
(21, 'Shamel', 'sha', 'shamelwildrift@gmail.com', 'Sharing test', 'images (6).jpeg', '2023-06-21 20:02:01', '', 4, 12, 0),
(22, 'Shamel', 'sha', 'shamelwildrift@gmail.com', 'safdasdf', 'images (6).jpeg', '2023-06-21 20:03:08', '', 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `post_id`, `status`) VALUES
(121, 2, 1, 'like'),
(131, 2, 3, 'like'),
(134, 2, 8, 'like'),
(135, 2, 4, 'like'),
(137, 2, 2, 'like'),
(138, 2, 9, 'like'),
(184, 2, 12, 'like'),
(185, 3, 12, 'like'),
(186, 3, 13, 'like'),
(197, 3, 15, 'like'),
(199, 2, 10, 'like'),
(201, 3, 17, 'like'),
(209, 3, 18, 'like'),
(210, 2, 18, 'like'),
(213, 2, 15, 'like'),
(214, 4, 18, 'like'),
(215, 4, 12, 'like'),
(216, 4, 21, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
CREATE TABLE IF NOT EXISTS `reply` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `comment_id` int NOT NULL,
  `content` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `user_id`, `post_id`, `comment_id`, `content`, `date`) VALUES
(1, 2, 15, 3, 'asdfasdf', '2023-06-21 19:11:32'),
(2, 2, 15, 3, 'asfdasdf', '2023-06-21 19:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile` varchar(100) NOT NULL,
  `background` varchar(100) NOT NULL,
  `bio` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `username`, `password`, `created`, `profile`, `background`, `bio`) VALUES
(2, 'Skydriven', 'tagpuno619@gmail.com', 'tagpuno619', '202cb962ac59075b964b07152d234b70', '2023-06-09 18:56:55', 'default.png', 'defaultBG.jpeg', ''),
(3, 'Account number 2', 'skybroken619@gmail.com', 'acc2', '81dc9bdb52d04dc20036dbd8313ed055', '2023-06-13 07:22:53', 'girl meme.jfif', 'arrow.gif', 'asdfasdg'),
(4, 'Shamel', 'shamelwildrift@gmail.com', 'sha', '202cb962ac59075b964b07152d234b70', '2023-06-21 19:57:41', 'images (6).jpeg', 'sala.jfif', 'TESTING!!!');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
