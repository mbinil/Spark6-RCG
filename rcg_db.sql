-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 16, 2013 at 02:17 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rcg_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `admin_firstname` varchar(250) NOT NULL,
  `admin_lastname` varchar(250) NOT NULL,
  `admin_user_name` varchar(50) NOT NULL,
  `admin_user_password` varchar(100) NOT NULL,
  `admin_user_email` varchar(80) NOT NULL,
  `admin_user_added` datetime NOT NULL,
  `admin_last_visit` datetime NOT NULL,
  `admin_user_active` tinyint(1) NOT NULL,
  `admin_user_type` int(11) NOT NULL,
  `icon` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_firstname`, `admin_lastname`, `admin_user_name`, `admin_user_password`, `admin_user_email`, `admin_user_added`, `admin_last_visit`, `admin_user_active`, `admin_user_type`, `icon`) VALUES
(1, 'admin', 'admin123', 'admin', 'YWRtaW4xMjM=', 'admin@services.com', '2013-02-05 00:00:00', '2013-12-16 11:06:42', 1, 0, 'Letter-Symbol.png'),
(2, 'adminstrator', 'admin', 'adminstrator', 'YWRtaW5zdHJhdG9y', 'admin@adminstrator.com', '0000-00-00 00:00:00', '2013-11-27 11:59:03', 1, 2, 'color5.png'),
(10, 'Priswin', 'Jose1', 'priswinjose1', 'cHJpc3dpbmpvc2Ux', 'priswinjose1@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 'img-10.png'),
(9, 'Priswin', 'jose', 'priswinjose', 'cHJpc3dpbmpvc2U=', 'priswinjose@gmail.com', '0000-00-00 00:00:00', '2013-11-27 11:58:42', 1, 0, 'img-09.png'),
(7, 'fbxbxcv', 'bxbcb', 'dfgsdgdfg', 'Z2hmZ2poZ2puZ2Y=', 'xcvbxb@fghfh.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 'Yin-and-Yang.png'),
(8, 'zvcxvzv', 'test', 'sdfsdfsdfs', 'ZGZnZA==', 'zcxvxv@dsf.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 'color2.png');

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE IF NOT EXISTS `alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `frequency` varchar(250) NOT NULL,
  `delevery_location` varchar(250) NOT NULL,
  `copy` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `title`, `description`, `frequency`, `delevery_location`, `copy`, `status`, `created_date`, `last_updated`) VALUES
(1, 'Active Challenges', 'Challenges that a user is currently engaged in', 'Always appear when challenges are active', 'Web App', 'In the header of the dropdown section: "Your Active Challenges", with the names of the challenges listed below that', 1, '2013-11-25 13:51:12', '0000-00-00 00:00:00'),
(2, ' Challenge Invites', ' A host has invited the user to a challenge', ' Whenever an invite has been recieved and not accepted or declined yet', ' Web App, Facebook, Email', '[user name] has invited you to [challenge name]', 1, '2013-11-25 13:53:33', '0000-00-00 00:00:00'),
(3, 'Challenge Check-Ins', 'Asking the user if they completed the challenge milestone', 'Set in context to the specific challenge but always delivered at 6pm, set to the user''s local clock', 'Web App, Facebook, Email', 'Are you still on track to complete [challenge name] yes/no', 1, '2013-11-22 09:56:13', '0000-00-00 00:00:00'),
(4, ' Challenge Check-In About to Fail', ' If they have not responded to the two check-in notification in a row the third will tell them they are about to be failed out of the challenge', ' After two check-ins that were not responded to', ' Web App, Facebook Email', ' You haven''t checked in for two days and are about to fail [challenge name]. Are you still in it? yes/no', 1, '2013-11-22 10:29:38', '0000-00-00 00:00:00'),
(5, ' Challenge Fail', ' After a user fails to check in for a challenge milestone or clicks "no" on the check-in', ' Upon Challenge Failure', ' Web App, Facebook, Email', ' Oh no! Sorry, nice try but you''ve failed [challenge name]', 1, '2013-11-22 10:30:43', '0000-00-00 00:00:00'),
(6, ' Challenge Success', 'After a user sucessfully completes a challenge', 'After the last check-in on the 21st day of a challenge', 'Web App, Facebook, Email', 'Congratulations! You''ve completed [challenge name]', 1, '2013-11-22 10:31:30', '0000-00-00 00:00:00'),
(7, ' Joined Your Challenge-Invitee', 'When you are a host and someone you invited accepts', 'Upon the invitee joining', 'Web App, Facebook', '[user name] has accepted your invitation to [challenge name]', 1, '2013-11-22 13:58:11', '0000-00-00 00:00:00'),
(8, 'Joined Your Challenge-Any', ' When you are hosting an open challenge and anyone joins', 'Upon the user joining', 'Web App, Facebook', '[user name] has joined you for [challenge name]', 1, '2013-11-22 13:58:11', '0000-00-00 00:00:00'),
(9, ' Challenge is Starting', ' A "this is your first day!" notification on day one', 'On the first Day of your challenge at 8AM', 'Web App, Facebook, Email', 'This is day 1 of 21 for [challenge name]', 1, '2013-11-22 10:32:33', '0000-00-00 00:00:00'),
(10, 'Not Enough Team Members', ' If you are hosting, you need two additional team members to start a challenge. This notification will tell you to invite some more friends', '24 hours before your challenge start-date', 'Web App, Facebook, Email', 'Uh Oh! Your team isn''t big enough for [challenge name] Invite some more people!', 1, '2013-11-22 10:33:21', '0000-00-00 00:00:00'),
(11, 'Invite Declined', 'When you are hosting and an invitee declines your invitation', 'Upon decline of your invite', ' Web App, Facebook, Email', '[user name] has declined your invite to [challenge name]', 1, '2013-11-22 13:58:11', '0000-00-00 00:00:00'),
(12, 'New Badge Notification (points)', 'Notifiying the user that they just recieved a new badge based on a point accumulation', 'After reaching specified number of points', 'Web App, Facebook, Email', 'Congratulations! You have been awarded the [x] points badge!', 1, '2013-11-22 13:58:11', '0000-00-00 00:00:00'),
(13, 'New Level Achieved', 'Notfiying the user when they have reached a new level on the platform', 'Per level acheived', 'Web App, Facebook, Email', 'Way to Go! You have just reached level [level #]', 1, '2013-11-22 13:58:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `badgecombos`
--

CREATE TABLE IF NOT EXISTS `badgecombos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `comboimg` varchar(255) NOT NULL,
  `gradient` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = Without gradient, 1 = With gradient',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `badgecombos`
--

INSERT INTO `badgecombos` (`id`, `comboimg`, `gradient`) VALUES
(1, 'color1501385549514.png', 1),
(2, 'color8141385549533.png', 1),
(5, 'color9401385549551.png', 1),
(8, 'color901385549572.png', 1),
(9, 'color2511385549577.png', 1),
(10, 'color801385549583.png', 1),
(11, 'color9401385549587.png', 1),
(13, 'color531385549603.png', 1),
(16, 'color5621385549638.png', 1),
(19, 'color8051385550781.png', 1),
(33, 'color7151386065723.png', 1),
(36, 'color541386067115.png', 1),
(37, 'color6341386067337.png', 1),
(38, 'color9911386067391.png', 1),
(40, 'color4041386067503.png', 1),
(41, 'color1961386150972.png', 0),
(42, 'color3541386150976.png', 0),
(43, 'color5501386593824.png', 0),
(44, 'color6261386742495.png', 0),
(45, 'color5281386753934.png', 0),
(47, 'color4261386758215.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `decal` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `parent` int(1) NOT NULL,
  `badgecolor` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `decal`, `status`, `parent`, `badgecolor`) VALUES
(1, 'Health', 'graph.png', 1, 0, ''),
(2, 'Wealth', 'sun.png', 1, 0, ''),
(19, 'Relationships', 'heart.png', 1, 0, ''),
(40, 'Carrer', '', 1, 2, 'color901385549572.png'),
(41, 'Diet', '', 1, 1, 'color6341386067337.png'),
(42, 'Fitness', '', 1, 1, 'color9401385549587.png'),
(43, 'Friendship', '', 1, 19, 'color4041386067503.png'),
(44, 'Parenting', '', 1, 19, 'color541386067115.png');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE IF NOT EXISTS `challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `badge_title` varchar(255) NOT NULL,
  `daily_commitment` longtext NOT NULL,
  `why` longtext NOT NULL,
  `how` longtext NOT NULL,
  `learn_more` longtext NOT NULL,
  `repeatable` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `parent_category` int(5) NOT NULL,
  `child_category` int(11) NOT NULL,
  `length_of_challenge` int(5) NOT NULL,
  `host_set_start_date` int(1) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `added_date` datetime NOT NULL,
  `tags` longtext NOT NULL,
  `eligibility` longtext NOT NULL,
  `difficulty` int(5) NOT NULL,
  `pre_checkin_notification` int(11) DEFAULT NULL,
  `checkin_notification` longtext NOT NULL,
  `notification_frequency` int(5) NOT NULL,
  `hero_image` varchar(255) NOT NULL,
  `badge_color` int(5) NOT NULL,
  `permalink` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `name`, `badge_title`, `daily_commitment`, `why`, `how`, `learn_more`, `repeatable`, `status`, `parent_category`, `child_category`, `length_of_challenge`, `host_set_start_date`, `start_date`, `end_date`, `added_date`, `tags`, `eligibility`, `difficulty`, `pre_checkin_notification`, `checkin_notification`, `notification_frequency`, `hero_image`, `badge_color`, `permalink`) VALUES
(6, 'Learn To Snowboard', 'Learn To Snowboard', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 0, 1, 2, 40, 30, 1, '2013-12-11 00:00:00', '2014-01-09 00:00:00', '2013-12-11 03:39:33', 'School,Teacher,Colleague', '', 2, 1, '', 8, '52a96712546cc31636img-38.jpg', 43, ''),
(7, 'Run For The Love', 'Run For The Love', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 0, 1, 19, 43, 40, 1, '2013-12-09 00:00:00', '2014-01-17 00:00:00', '2013-12-09 06:25:03', 'School,Teacher,Colleague', '', 1, NULL, 'Typing a text message', 6, '14030img-24.jpg', 45, ''),
(8, 'Taste the fruits', 'Taste the fruits', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 0, 1, 1, 41, 35, 1, '2013-12-11 00:00:00', '2014-01-14 00:00:00', '2013-12-11 11:45:33', 'Fruits,Diet,Fitness,Health', '', 3, 1, '', 10, '52a964da0bdf726698img-02.jpg', 42, ''),
(9, 'vxzcvxvvxc', 'vvzxcv', 'xvzxvx', 'cvzxcvxz', 'zvxcvzv', 'zvxcvzvx', 0, 0, 1, 42, 1, 1, '2013-12-11 00:00:00', '2013-12-11 00:00:00', '2013-12-11 04:05:38', 'School,Teacher,Colleague', '', 1, 1, '', 1, '17483img-06.png', 47, '');

-- --------------------------------------------------------

--
-- Table structure for table `difficulties`
--

CREATE TABLE IF NOT EXISTS `difficulties` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `points` int(10) NOT NULL,
  `description` longtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `decal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `difficulties`
--

INSERT INTO `difficulties` (`id`, `title`, `points`, `description`, `status`, `decal`) VALUES
(1, 'Easy', 200, 'Decal and points added to badges to denote difficulty type.', 1, 'level-1.png'),
(2, 'Medium', 400, 'Decal and points added to badges to denote difficulty type.', 1, 'level-2.png'),
(3, 'Easy', 200, 'Decal and points added to badges to denote difficulty type.', 1, 'level-3.png');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
  `id` int(5) NOT NULL,
  `LevelThreshold` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `LevelThreshold`) VALUES
(1, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `notificationmessages`
--

CREATE TABLE IF NOT EXISTS `notificationmessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `notificationmessages`
--

INSERT INTO `notificationmessages` (`id`, `message`) VALUES
(1, 'Second message'),
(2, 'Third message');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(80) NOT NULL,
  `user_firstname` varchar(80) NOT NULL,
  `user_lastname` varchar(80) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_gender` tinyint(4) NOT NULL,
  `user_business_unit` tinyint(4) NOT NULL,
  `user_business_loc` tinyint(4) NOT NULL,
  `user_added` datetime NOT NULL,
  `user_points` int(11) NOT NULL,
  `user_level` int(11) NOT NULL,
  `user_profile_picture` varchar(255) NOT NULL,
  `user_last_login` datetime NOT NULL,
  `user_timezone` float NOT NULL,
  `user_timezone_hs` varchar(7) NOT NULL,
  `user_total_challenges` int(8) NOT NULL,
  `user_active` tinyint(1) NOT NULL,
  `user_notification` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_email`, `user_firstname`, `user_lastname`, `user_password`, `user_gender`, `user_business_unit`, `user_business_loc`, `user_added`, `user_points`, `user_level`, `user_profile_picture`, `user_last_login`, `user_timezone`, `user_timezone_hs`, `user_total_challenges`, `user_active`, `user_notification`) VALUES
(1, 'pjose@iforceproservices.com', 'Priswin', 'Jose', 'c740eaf7e5ad0b4512ae88370f8a1a10', 0, 1, 1, '2013-12-11 08:07:56', 0, 0, 'be_great.png', '2013-12-11 08:07:56', 0, '0', 0, 1, 0),
(2, 'priswinjose@gmail.com', 'Jack', 'Jill', '07c72e30ccfcb9b130abd0a33460aadb', 0, 1, 1, '2013-12-12 07:07:17', 0, 0, 'invite_firends.png', '2013-12-12 07:07:17', 0, '0', 0, 1, 0),
(3, 'sukith@gmail.com', 'Sukith', 'Sukesh', 'cf7d48e1528ede1df6417d3839168823', 0, 1, 1, '2013-12-12 07:25:56', 0, 0, 'discover.png', '2013-12-12 07:25:56', 0, '0', 0, 1, 1),
(4, 'milljohn@gmai.com', 'Mill', 'John', 'd2068ba758e968babd68a17479d7cf22', 1, 1, 1, '2013-12-13 10:52:20', 0, 0, 'color5631385549545.png', '2013-12-13 10:52:20', 0, '0', 0, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
