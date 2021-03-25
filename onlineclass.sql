-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 05:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineclass`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `section` varchar(4) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `class_code` varchar(5) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `title`, `class_name`, `section`, `created_by`, `class_code`, `picture`) VALUES
(5, 'rrrr', ' rrr', 'rr', ' Alkuma Akther Munna', 'eq79p', 'https://lh3.googleusercontent.com/a-/AOh14Ghea8EFxo1TdTjby-FkTN0dJkpK1GvWxnw5wB91=s96-c'),
(6, 'NOTHING', ' Simulation', 'E', ' Music', 'fltcs', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(7, 'Robotics', ' Project', '09', ' Music', 'xc5k2', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(8, 'Robotics', ' Project', '09', ' Music', 'ykuwq', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(9, 'Robotics', ' Simulation', '09', ' Music', '6f4lz', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(10, 'Nothing', ' Project', '09', ' Music', 'sq0jr', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(11, 'Nothing', ' Project', '09', ' Music', 'n4tig', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` varchar(255) NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, '0', 'rahat_saqib', 'rahat_saqib', '2020-11-04 12:52:42', 'no', 9),
(2, '0', 'rahat_saqib', 'rahat_saqib', '2020-11-05 08:21:22', 'no', 10),
(3, '0', 'Sakib Uddin Ahmed_171-15-8782', 'Sakib Uddin Ahmed_171-15-8782', '2020-11-21 03:16:46', 'no', 32),
(4, 'Hello', 'Sakib Uddin Ahmed_171-15-8782', 'Music_Loverzz!!!', '2020-11-21 03:45:56', 'no', 29);

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_class`
--

CREATE TABLE `enrolled_class` (
  `ID` int(11) NOT NULL,
  `class_id` varchar(10) NOT NULL,
  `PersonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrolled_class`
--

INSERT INTO `enrolled_class` (`ID`, `class_id`, `PersonID`) VALUES
(1, 'eq79p', 12),
(2, 'fltcs', 12),
(7, 'eq79p', 10),
(8, 'eq79p', 13),
(9, 'fltcs', 10),
(10, '', 12),
(11, 'ykuwq', 12),
(12, '6f4lz', 12),
(13, 'sq0jr', 12),
(14, 'n4tig', 12);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `user` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user`) VALUES
(1, 'rahat_saqib', 'rahat_saqib_1');

-- --------------------------------------------------------

--
-- Table structure for table `keystring`
--

CREATE TABLE `keystring` (
  `keyid` int(11) NOT NULL,
  `keystring` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keystring`
--

INSERT INTO `keystring` (`keyid`, `keystring`) VALUES
(1, ''),
(2, ''),
(3, 'jvzy1'),
(4, 'cjse2'),
(5, '34gqu'),
(6, 'tvz0p'),
(7, 'r7gse'),
(8, 'ymvno'),
(9, '7erdq'),
(10, 'eq79p'),
(11, 'fltcs'),
(12, 'xc5k2'),
(13, 'ykuwq'),
(14, '6f4lz'),
(15, 'sq0jr'),
(16, 'n4tig');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(6, 'Music_Loverzz!!!', 24),
(7, 'Music_Loverzz!!!', 23),
(9, 'Sakib Uddin Ahmed_171-15-8782', 33);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'rahat_saqib', 'rahat_saqib', 'Hello', '2020-11-17 09:11:02', 'yes', 'yes', 'no'),
(2, 'rahat_saqib', 'rahat_saqib', 'Whats upp?\r\n', '2020-11-17 09:11:12', 'yes', 'yes', 'no'),
(3, 'rahat_saqib', 'rahat_saqib', 'Good', '2020-11-17 09:11:29', 'yes', 'yes', 'no'),
(4, 'rahat_saqib', 'rahat_saqib_1', 'Hey', '2020-11-17 09:13:09', 'yes', 'yes', 'no'),
(5, 'rahat_saqib', 'rahat_saqib_1', 'Wahats up\r\n', '2020-11-17 09:13:17', 'yes', 'yes', 'no'),
(6, 'rahat_saqib_1', 'rahat_saqib', 'good\r\n', '2020-11-17 09:14:22', 'no', 'no', 'no'),
(7, 'rahat_saqib_1', 'rahat_saqib', 'good\r\n', '2020-11-17 09:14:58', 'no', 'no', 'no'),
(8, 'rahat_saqib_1', 'rahat_saqib', 'Hii', '2020-11-17 09:25:50', 'no', 'no', 'no'),
(9, 'rahat_saqib_1', 'rahat_saqib', 'dfsdfsdfsdf', '2020-11-17 09:36:26', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(1, 'Music_Loverzz!!!', 'Sakib Uddin Ahmed_171-15-8782', 'Sakib Uddin Ahmed 171-15-8782 liked your post', 'post.php?id=29', '2020-11-21 03:25:45', 'yes', 'yes'),
(2, 'Music_Loverzz!!!', 'Sakib Uddin Ahmed_171-15-8782', 'Sakib Uddin Ahmed 171-15-8782 commented on your post', 'post.php?id=29', '2020-11-21 03:45:56', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `class_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`, `class_code`) VALUES
(13, 'AAA', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-11-20 13:38:26', 'no', 'no', 0, '', 'fltcs'),
(14, 'AAA', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-11-20 13:38:37', 'no', 'yes', 0, '', 'fltcs'),
(15, 'ased', 'Music_Loverzz!!!', 'none', '2020-11-20 15:21:12', 'no', 'no', 0, '', ''),
(16, 'asdddddd', 'Music_Loverzz!!!', 'none', '2020-11-20 15:22:54', 'no', 'no', 0, '', ''),
(17, 'ssdd', 'Music_Loverzz!!!', 'none', '2020-11-20 15:24:34', 'no', 'no', 0, '', ''),
(18, 'asdsw', 'Music_Loverzz!!!', 'none', '2020-11-20 15:39:43', 'no', 'no', 0, '', ''),
(19, 'zxx', 'Music_Loverzz!!!', 'none', '2020-11-20 15:44:31', 'no', 'no', 0, '', ''),
(20, 'ssddd', 'Music_Loverzz!!!', 'none', '2020-11-20 16:02:06', 'no', 'no', 0, '', ''),
(21, 'asa', 'Music_Loverzz!!!', 'none', '2020-11-20 16:04:10', 'no', 'no', 0, '', '<script>do'),
(22, 'dddf', 'Music_Loverzz!!!', 'none', '2020-11-20 16:06:44', 'no', 'no', 0, '', ''),
(23, 'wer', 'Music_Loverzz!!!', 'none', '2020-11-20 16:24:29', 'no', 'no', 1, '', ''),
(24, 'sr', 'Music_Loverzz!!!', 'none', '2020-11-20 16:31:03', 'no', 'no', 1, '', ''),
(25, 'awed', 'Music_Loverzz!!!', 'none', '2020-11-20 16:34:15', 'no', 'no', 0, '', 'eq79p'),
(26, 'awed', 'Music_Loverzz!!!', 'none', '2020-11-20 16:35:10', 'no', 'no', 0, '', 'eq79p'),
(27, 'awed', 'Music_Loverzz!!!', 'none', '2020-11-20 16:36:29', 'no', 'no', 0, '', 'eq79p'),
(28, 'awed', 'Music_Loverzz!!!', 'none', '2020-11-20 16:36:36', 'no', 'no', 0, '', 'eq79p'),
(29, 'hello', 'Music_Loverzz!!!', 'none', '2020-11-20 16:37:30', 'no', 'no', 0, '', 'fltcs'),
(30, 'Hey', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-11-21 03:09:15', 'no', 'no', 0, '', 'eq79p'),
(31, 'Hey', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-11-21 03:15:21', 'no', 'no', 0, '', 'eq79p'),
(32, 'Is everything okey?', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-11-21 03:16:35', 'no', 'yes', 0, '', 'fltcs'),
(33, 'How was that<br /> ?', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-11-21 03:47:20', 'no', 'no', 1, 'assets/images/posts/5fb88dc8e3a8cbackground.png', 'fltcs');

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `title` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trends`
--

INSERT INTO `trends` (`title`, `hits`) VALUES
('Asda', 1),
('Ssd', 1),
('Hello', 5),
('Sasd', 3),
('Dddd', 7),
('Asd', 3),
('Sadasd', 1),
('Munni', 1),
('Mutkiii', 1),
('Aa', 1),
('Rahat', 16),
('Rrr', 2),
('Aaaa', 1),
('Hellooooo', 1),
('Rtahat', 2),
('Aaa', 5),
('AAAAAA', 1),
('SS', 1),
('AASS', 1),
('SSDD', 2),
('Sssssssssd', 1),
('Sda', 1),
('Xxc', 1),
('Ffbr', 1),
('Eeww', 1),
('Ased', 1),
('Asdddddd', 1),
('Asdsw', 1),
('Zxx', 1),
('Ssddd', 1),
('Asa', 1),
('Dddf', 1),
('Wer', 1),
('Sr', 1),
('Awed', 4),
('Okey', 1),
('Thatbr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `gid` varchar(255) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `gid`, `first_name`, `last_name`, `username`, `email`, `gender`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(10, '112197901429585773209', 'Sakib Uddin Ahmed', '171-15-8782', 'Sakib Uddin Ahmed_171-15-8782', 'sakib15-8782@diu.edu.bd', '', '', '0000-00-00', 'https://lh3.googleusercontent.com/a-/AOh14GiLFsKWTfzMNZxMF-iN4z1aHZXOpDnV6ffv6Q3-=s96-c', 10, 1, '', ''),
(12, '105097088573966577970', 'Music', 'Loverzz!!!', 'Music_Loverzz!!!', 'rahatsaqib78@gmail.com', '', '', '0000-00-00', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c', 28, 2, '', ''),
(13, '106780404570684411121', 'Alkuma Akther Munna', '171-15-8582', 'Alkuma Akther Munna_171-15-8582', 'alkuma15-8582@diu.edu.bd', 'femal', '', '0000-00-00', 'https://lh3.googleusercontent.com/a-/AOh14Ghea8EFxo1TdTjby-FkTN0dJkpK1GvWxnw5wB91=s96-c', 0, 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolled_class`
--
ALTER TABLE `enrolled_class`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keystring`
--
ALTER TABLE `keystring`
  ADD PRIMARY KEY (`keyid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enrolled_class`
--
ALTER TABLE `enrolled_class`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keystring`
--
ALTER TABLE `keystring`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
