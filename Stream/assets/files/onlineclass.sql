-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2020 at 10:56 PM
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
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `instruction` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `duedate` datetime NOT NULL,
  `uploadedby` varchar(255) NOT NULL,
  `filesid` varchar(100) NOT NULL,
  `class_code` varchar(100) NOT NULL,
  `assignmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `title`, `instruction`, `date`, `duedate`, `uploadedby`, `filesid`, `class_code`, `assignmentID`) VALUES
(43, 'To do a task', 'ASS', '2020-12-27 16:02:16', '0000-00-00 00:00:00', ' 105097088573966577970', '7695081243', 'eq79p', 0),
(44, 'aa', 'aaa', '2020-12-27 16:06:43', '0000-00-00 00:00:00', ' 105097088573966577970', '', 'eq79p', 0),
(45, 'ass', 'ass', '2020-12-27 16:07:20', '0000-00-00 00:00:00', ' 105097088573966577970', '5041387296', 'eq79p', 0),
(46, 'AS', 'SS', '2020-12-27 16:09:54', '0000-00-00 00:00:00', ' 105097088573966577970', '4978021536', 'eq79p', 0),
(47, 'AS', 'SS', '2020-12-27 16:10:46', '0000-00-00 00:00:00', ' 105097088573966577970', '6178035249', 'eq79p', 0),
(48, 'Sangbid votka', 'AAA', '2020-12-28 08:18:25', '0000-00-00 00:00:00', ' 105097088573966577970', '4528396107', 'fltcs', 0),
(49, 's', 's', '2020-12-28 17:38:16', '0000-00-00 00:00:00', ' 105097088573966577970', '1803427659', 'fltcs', 0),
(50, 'Project Presentation', 'About Ai', '2020-12-30 13:55:20', '2021-12-29 21:37:00', ' 106780404570684411121', '8021576394', 'eq79p', 0);

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
(5, 'rrrr', ' rrr', 'rr', '13', 'eq79p', 'https://lh3.googleusercontent.com/a-/AOh14Ghea8EFxo1TdTjby-FkTN0dJkpK1GvWxnw5wB91=s96-c'),
(6, 'NOTHING', ' Simulation', 'E', '12', 'fltcs', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(7, 'Robotics', ' Project', '09', '12', 'xc5k2', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(8, 'Robotics', ' Project', '09', '12', 'ykuwq', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(9, 'Robotics', ' Simulation', '09', '12', '6f4lz', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(10, 'Nothing', ' Project', '09', '12', 'sq0jr', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(11, 'Nothing', ' Project', '09', '12', 'n4tig', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(12, 'Introduction to', ' Compiler', '03', '12', 'u0jae', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(13, 'Introduction to', ' Robotics', 'A', ' Music', '0quc5', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c');

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
  `post_id` int(11) NOT NULL,
  `assignmentID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`, `assignmentID`) VALUES
(1, '0', 'rahat_saqib', 'rahat_saqib', '2020-11-04 12:52:42', 'no', 9, ''),
(2, '0', 'rahat_saqib', 'rahat_saqib', '2020-11-05 08:21:22', 'no', 10, ''),
(3, '0', 'Sakib Uddin Ahmed_171-15-8782', 'Sakib Uddin Ahmed_171-15-8782', '2020-11-21 03:16:46', 'no', 32, ''),
(4, 'Hello', 'Sakib Uddin Ahmed_171-15-8782', 'Music_Loverzz!!!', '2020-11-21 03:45:56', 'no', 29, ''),
(5, 'Nice', 'Music_Loverzz!!!', 'Music_Loverzz!!!', '2020-11-22 19:15:19', 'no', 34, ''),
(6, 'hi', 'Music_Loverzz!!!', 'Sakib Uddin Ahmed_171-15-8782', '2020-12-28 10:06:51', 'no', 42, 'no'),
(7, 'Hi', 'Music_Loverzz!!!', '', '2020-12-28 10:07:19', 'no', 47, 'no'),
(8, 'aa', 'Music_Loverzz!!!', '', '2020-12-28 10:08:19', 'no', 47, 'no'),
(9, 'yes', 'Music_Loverzz!!!', '', '2020-12-28 14:13:40', 'no', 47, 'no'),
(10, 'ss', 'Music_Loverzz!!!', '', '2020-12-28 14:25:21', 'no', 47, 'no'),
(11, 'aa', 'Music_Loverzz!!!', '', '2020-12-28 14:29:00', 'no', 0, '47'),
(12, 'Hellow', 'Music_Loverzz!!!', '', '2020-12-28 14:29:18', 'no', 0, '47'),
(13, 'Hey', 'Music_Loverzz!!!', '', '2020-12-28 14:41:53', 'no', 0, '43'),
(14, 'hI\r\n', 'Music_Loverzz!!!', '', '2020-12-28 15:31:15', 'no', 0, '43'),
(15, 'yes', 'Music_Loverzz!!!', '', '2020-12-28 17:28:02', 'no', 0, '43'),
(16, 'DOne sir', 'Music_Loverzz!!!', '', '2020-12-29 06:15:37', 'no', 0, '43');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_class`
--

CREATE TABLE `enrolled_class` (
  `ID` int(11) NOT NULL,
  `class_id` varchar(10) NOT NULL,
  `PersonID` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrolled_class`
--

INSERT INTO `enrolled_class` (`ID`, `class_id`, `PersonID`, `status`) VALUES
(1, 'eq79p', 12, 'enroled'),
(2, 'fltcs', 12, 'enroled'),
(7, 'eq79p', 10, 'enroled'),
(8, 'eq79p', 13, 'enroled'),
(9, 'fltcs', 10, 'enroled'),
(10, '', 12, 'enroled'),
(11, 'ykuwq', 12, 'enroled'),
(12, '6f4lz', 12, 'enroled'),
(13, 'sq0jr', 12, 'enroled'),
(14, 'n4tig', 12, 'enroled'),
(15, 'u0jae', 12, 'enroled'),
(16, 'u0jae', 10, 'enroled'),
(17, '0quc5', 12, 'enroled'),
(18, '0quc5', 12, 'enroled'),
(19, 'n4tig', 10, 'enroled');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `assignmentID` varchar(100) NOT NULL,
  `files` varchar(255) NOT NULL,
  `submittedID` varchar(100) NOT NULL,
  `postid` varchar(10) NOT NULL,
  `submittedby` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `assignmentID`, `files`, `submittedID`, `postid`, `submittedby`) VALUES
(57, '1803427659', '—Pngtree—office paper icon design_4739568.png', '', '', ''),
(61, '', 'scheduled.sql', '43', '', '105097088573966577970'),
(62, '', '—Pngtree—office paper icon design_4739568.png', '43', '', '105097088573966577970'),
(63, '', 'LOGO.png', '43', '', '105097088573966577970'),
(75, '', 'bitnami.css', '43', '', '105097088573966577970'),
(76, '', 'index.php', '43', '', '105097088573966577970'),
(80, '8021576394', '', '', '', ''),
(86, '', 'covid.docx', '', '4168037259', ''),
(87, '', 'Sakib Uddin Ahmed.docx', '', '2047816593', ''),
(88, '', 'CSE444-O9-171-15-8782-final.pdf', '', '0721683495', ''),
(89, '', 'cERTIFICATE.jpg', '', '5123970648', ''),
(90, '', 'CSE444-O9-171-15-8782-final.pdf', '', '5367012894', ''),
(91, '', 'CSE498-O9-171-15-8782-final.pdf', '', '5367012894', ''),
(92, '', 'covid.docx', '', '8426097315', ''),
(93, '', 'covid.docx', '', '4723861590', ''),
(94, '', 'covid.docx', '', '9458613270', ''),
(95, '', '171-15-8782-O9-Term Paper.pdf', '', '2035471986', '');

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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `groupid` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdby` varchar(100) NOT NULL,
  `groupname` varchar(100) NOT NULL,
  `class_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `groupid`, `userid`, `createdby`, `groupname`, `class_code`) VALUES
(2, 'Group1', 0, '12', 'Thesis Group 2', 'fltcs'),
(5, 'Group2', 0, '13', 'Project', 'eq79p');

-- --------------------------------------------------------

--
-- Table structure for table `group_messages`
--

CREATE TABLE `group_messages` (
  `id` int(11) NOT NULL,
  `group_id` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `class_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_messages`
--

INSERT INTO `group_messages` (`id`, `group_id`, `userid`, `class_code`) VALUES
(15, 'Group1', 12, 'fltcs'),
(16, 'Group1', 10, 'fltcs'),
(19, 'Group2', 13, 'eq79p'),
(20, 'Group2', 12, 'eq79p'),
(21, 'Group2', 10, 'eq79p');

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
(16, 'n4tig'),
(17, 'u0jae'),
(18, '0quc5');

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
(9, 'Sakib Uddin Ahmed_171-15-8782', 33),
(10, 'Music_Loverzz!!!', 34),
(11, 'Alkuma Akther Munna_171-15-8582', 42),
(12, 'Music_Loverzz!!!', 42);

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
  `deleted` varchar(3) NOT NULL,
  `class_code` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `files` varchar(100) NOT NULL,
  `user_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`, `class_code`, `type`, `files`, `user_pic`) VALUES
(98, 'Sakib Uddin Ahmed_171-15-8782', 'Music_Loverzz!!!', 'Hey', '2020-12-30 18:59:22', 'no', 'yes', 'no', 'fltcs', '', '', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(100, 'Sakib Uddin Ahmed_171-15-8782', 'Music_Loverzz!!!', 'How is going', '2020-12-30 19:05:43', 'no', 'yes', 'no', 'eq79p', '', '', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c'),
(101, 'Music_Loverzz!!!', 'Alkuma Akther Munna_171-15-8582', 'Hey bro', '2020-12-30 20:19:28', 'no', 'yes', 'no', 'eq79p', '', '', 'https://lh3.googleusercontent.com/a-/AOh14Ghea8EFxo1TdTjby-FkTN0dJkpK1GvWxnw5wB91=s96-c'),
(102, 'Group2', 'Alkuma Akther Munna_171-15-8582', 'hEY', '2020-12-30 20:26:01', 'no', 'no', 'no', 'eq79p', 'group', '', 'https://lh3.googleusercontent.com/a-/AOh14Ghea8EFxo1TdTjby-FkTN0dJkpK1GvWxnw5wB91=s96-c'),
(103, 'Group2', 'Alkuma Akther Munna_171-15-8582', 'hEY', '2020-12-30 20:28:17', 'no', 'no', 'no', 'eq79p', 'group', '', 'https://lh3.googleusercontent.com/a-/AOh14Ghea8EFxo1TdTjby-FkTN0dJkpK1GvWxnw5wB91=s96-c'),
(104, 'Group2', 'Alkuma Akther Munna_171-15-8582', 'hEY', '2020-12-30 20:29:38', 'no', 'no', 'no', 'eq79p', 'group', '', 'https://lh3.googleusercontent.com/a-/AOh14Ghea8EFxo1TdTjby-FkTN0dJkpK1GvWxnw5wB91=s96-c'),
(105, 'Group2', 'Sakib Uddin Ahmed_171-15-8782', 'yes', '2020-12-30 20:39:50', 'no', 'no', 'no', 'eq79p', 'group', '', 'https://lh3.googleusercontent.com/a-/AOh14GiLFsKWTfzMNZxMF-iN4z1aHZXOpDnV6ffv6Q3-=s96-c');

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
  `viewed` varchar(3) NOT NULL,
  `class_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`, `class_code`) VALUES
(1, 'Music_Loverzz!!!', 'Sakib Uddin Ahmed_171-15-8782', 'Sakib Uddin Ahmed 171-15-8782 liked your post', 'post.php?id=29', '2020-11-21 03:25:45', 'yes', 'yes', ''),
(2, 'Music_Loverzz!!!', 'Sakib Uddin Ahmed_171-15-8782', 'Sakib Uddin Ahmed 171-15-8782 commented on your post', 'post.php?id=29', '2020-11-21 03:45:56', 'yes', 'yes', ''),
(3, 'Sakib Uddin Ahmed_171-15-8782', 'Alkuma Akther Munna_171-15-8582', 'Alkuma Akther Munna 171-15-8582 liked your post', 'post.php?id=42', '2020-12-27 16:45:34', 'yes', 'yes', ''),
(4, 'Sakib Uddin Ahmed_171-15-8782', 'Music_Loverzz!!!', 'Music Loverzz!!! liked your post', 'post.php?id=42', '2020-12-28 04:58:44', 'yes', 'yes', 'eq79p'),
(5, 'Music_Loverzz!!!', 'Sakib Uddin Ahmed_171-15-8782', 'Sakib Uddin Ahmed 171-15-8782 liked your post', 'post.php?id=43', '2020-12-28 05:58:13', 'yes', 'yes', 'eq79p'),
(6, '', 'Music_Loverzz!!!', 'Music Loverzz!!! liked your post', 'post.php?id=$id', '2020-12-28 08:49:07', 'no', 'no', 'eq79p'),
(7, '', 'Music_Loverzz!!!', 'Music Loverzz!!! liked your post', 'post.php?id=$id', '2020-12-28 09:37:30', 'no', 'no', 'eq79p'),
(8, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=47', '2020-12-28 09:48:46', 'no', 'no', 'eq79p'),
(9, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your profile post', 'post.php?id=47', '2020-12-28 09:48:46', 'no', 'no', 'eq79p'),
(10, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=47', '2020-12-28 09:55:24', 'no', 'no', 'eq79p'),
(11, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your profile post', 'post.php?id=47', '2020-12-28 09:55:24', 'no', 'no', 'eq79p'),
(12, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=47', '2020-12-28 09:58:49', 'no', 'no', 'eq79p'),
(13, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your profile post', 'post.php?id=47', '2020-12-28 09:58:49', 'no', 'no', 'eq79p'),
(14, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=47', '2020-12-28 10:00:07', 'no', 'no', 'eq79p'),
(15, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your profile post', 'post.php?id=47', '2020-12-28 10:00:07', 'no', 'no', 'eq79p'),
(16, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=47', '2020-12-28 10:05:08', 'no', 'no', 'eq79p'),
(17, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your profile post', 'post.php?id=47', '2020-12-28 10:05:08', 'no', 'no', 'eq79p'),
(18, 'Sakib Uddin Ahmed_171-15-8782', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=42', '2020-12-28 10:06:01', 'no', 'yes', 'eq79p'),
(19, 'Sakib Uddin Ahmed_171-15-8782', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=42', '2020-12-28 10:06:51', 'no', 'yes', 'eq79p'),
(20, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=47', '2020-12-28 10:07:19', 'no', 'no', 'eq79p'),
(21, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your profile post', 'post.php?id=47', '2020-12-28 10:07:19', 'no', 'no', 'eq79p'),
(22, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=47', '2020-12-28 10:08:19', 'no', 'no', 'eq79p'),
(23, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your profile post', 'post.php?id=47', '2020-12-28 10:08:19', 'no', 'no', 'eq79p'),
(24, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=47', '2020-12-28 14:13:40', 'no', 'no', 'eq79p'),
(25, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your profile post', 'post.php?id=47', '2020-12-28 14:13:40', 'no', 'no', 'eq79p'),
(26, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your post', 'post.php?id=47', '2020-12-28 14:25:21', 'no', 'no', 'eq79p'),
(27, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your profile post', 'post.php?id=47', '2020-12-28 14:25:21', 'no', 'no', 'eq79p'),
(28, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your Assignment', 'view_assignment.php?id=47', '2020-12-28 14:29:00', 'no', 'no', 'eq79p'),
(29, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your Assignment', 'view_assignment.php?id=47', '2020-12-28 14:29:18', 'no', 'no', 'eq79p'),
(30, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your Assignment', 'view_assignment.php?id=43', '2020-12-28 14:41:53', 'no', 'no', 'eq79p'),
(31, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your Assignment', 'view_assignment.php?id=43', '2020-12-28 15:31:15', 'no', 'no', 'eq79p'),
(32, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your Assignment', 'view_assignment.php?id=43', '2020-12-28 17:28:02', 'no', 'no', 'eq79p'),
(33, '', 'Music_Loverzz!!!', 'Music Loverzz!!! commented on your Assignment', 'view_assignment.php?id=43', '2020-12-29 06:15:37', 'no', 'no', 'eq79p'),
(34, 'Music_Loverzz!!!', 'Sakib Uddin Ahmed_171-15-8782', 'Sakib Uddin Ahmed 171-15-8782 liked your post', 'post.php?id=49', '2020-12-30 15:52:55', 'yes', 'yes', 'eq79p');

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
  `files` varchar(255) NOT NULL,
  `class_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`, `files`, `class_code`) VALUES
(52, '', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-12-30 17:00:37', 'no', 'no', 0, '0721683495', '', 'eq79p'),
(53, '', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-12-30 17:27:42', 'no', 'yes', 0, '5123970648', '', 'eq79p'),
(54, '', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-12-30 17:28:48', 'no', 'yes', 0, '5367012894', '', 'eq79p'),
(55, '', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-12-30 18:17:27', 'no', 'no', 0, '8426097315', '', 'eq79p'),
(56, '', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-12-30 18:17:31', 'no', 'yes', 0, '4723861590', '', 'eq79p'),
(57, '', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-12-30 18:17:55', 'no', 'yes', 0, '9458613270', '', 'eq79p'),
(58, '', 'Sakib Uddin Ahmed_171-15-8782', 'none', '2020-12-30 18:19:09', 'no', 'yes', 0, '2035471986', '', 'eq79p');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` int(11) NOT NULL,
  `assignmentID` varchar(100) NOT NULL,
  `submittedBy` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mark` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`id`, `assignmentID`, `submittedBy`, `status`, `date`, `mark`) VALUES
(39, '43', '105097088573966577970', '', '2020-12-30 19:23:41', '20');

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
('Aa', 2),
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
('Thatbr', 1),
('Assignmentbr', 1),
('Null', 3),
('Bg', 1),
('Aaaq', 1);

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
(10, '112197901429585773209', 'Sakib Uddin Ahmed', '171-15-8782', 'Sakib Uddin Ahmed_171-15-8782', 'sakib15-8782@diu.edu.bd', '', '', '0000-00-00', 'https://lh3.googleusercontent.com/a-/AOh14GiLFsKWTfzMNZxMF-iN4z1aHZXOpDnV6ffv6Q3-=s96-c', 24, 3, 'no', ''),
(12, '105097088573966577970', 'Music', 'Loverzz!!!', 'Music_Loverzz!!!', 'rahatsaqib78@gmail.com', '', '', '0000-00-00', 'https://lh3.googleusercontent.com/a-/AOh14GhpF1Krm8bciR2BQClDZcj8IEAS1lbkzSAddwwH=s96-c', 39, 3, 'no', ''),
(13, '106780404570684411121', 'Alkuma Akther Munna', '171-15-8582', 'Alkuma Akther Munna_171-15-8582', 'alkuma15-8582@diu.edu.bd', 'femal', '', '0000-00-00', 'https://lh3.googleusercontent.com/a-/AOh14Ghea8EFxo1TdTjby-FkTN0dJkpK1GvWxnw5wB91=s96-c', 0, 0, 'no', ''),
(15, '1', 'Rahat', 'Saqib', 'rahat_saqib', 'A@gmail.com', 'none', '76eb1a4739f33c9a24ac3af3b47fd41d', '2020-11-24', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_messages`
--
ALTER TABLE `group_messages`
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
-- Indexes for table `submission`
--
ALTER TABLE `submission`
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
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `enrolled_class`
--
ALTER TABLE `enrolled_class`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_messages`
--
ALTER TABLE `group_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `keystring`
--
ALTER TABLE `keystring`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
