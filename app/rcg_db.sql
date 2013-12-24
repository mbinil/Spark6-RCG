-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: custsql-as04
-- Generation Time: Dec 24, 2013 at 02:35 AM
-- Server version: 5.5.32
-- PHP Version: 4.4.9
-- 
-- Database: `rcg_db`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `admins`
-- 

CREATE TABLE `admins` (
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
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- 
-- Dumping data for table `admins`
-- 

INSERT INTO `admins` VALUES (1, 'site', 'admin', 'admin', 'YWRtaW4xMjM=', 'admin@services.com', '2013-02-05 00:00:00', '2013-12-24 01:06:50', 1, 0, 'Gift-Box.png');
INSERT INTO `admins` VALUES (28, 'Charlie', 'Louis', 'charlie', 'MTIzY2hhcmxpZQ==', 'charlie@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 2, 'diff.png');
INSERT INTO `admins` VALUES (31, 'Greg', 'Shin', 'gregshin', 'IVNQQTAxMDRzaDFu', 'greg@spark6.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '028-underdog-2560x1440-B.png');
INSERT INTO `admins` VALUES (32, 'Rachels', 'Stephans', 'rachel', 'MTIzNDU2Nzg5', 'rache@yahoo.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3, 'Untitled3.png');
INSERT INTO `admins` VALUES (33, 'Archie', 'Stephan', 'archie', 'YXJjaGllMTIz', 'ar@yahoo.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 'soft.png');
INSERT INTO `admins` VALUES (41, 'testing', 'd''couth', 'nitha', 'MTIzNDU2', 'nitha@iforce.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'printec3.png');
INSERT INTO `admins` VALUES (42, 'test', 'admin', 'tester', 'dGVzdDEyMw==', 'test@spark6.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 'robot.gif');

-- --------------------------------------------------------

-- 
-- Table structure for table `alerts`
-- 

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `frequency` text NOT NULL,
  `delevery_location` varchar(250) NOT NULL,
  `copy` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `alerts`
-- 

INSERT INTO `alerts` VALUES (1, 'Active Challenges', 'Challenges that a user is currently engaged in', 'Always appear when challenges are active', 'Web App', 'In the header of the dropdown section: "Your Active Challenges", with the names of the challenges listed below that.', 1, '2013-12-09 08:37:16', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (2, ' Challenge Invites', ' A host has invited the user to a challenge', ' Whenever an invite has been recieved and not accepted or declined yet', ' Web App, Facebook, Email', '[user name] has invited you to [challenge name]', 1, '2013-11-25 09:18:27', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (3, 'Challenge Check-Ins', 'Asking the user if they completed the challenge milestone', 'Set in context to the specific challenge but always delivered at 6pm, set to the user''s local clock', 'Web App, Facebook, Email', 'Are you still on track to complete [challenge name] yes/no', 1, '2013-11-25 09:33:33', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (4, ' Challenge Check-In About to Fail', ' If they have not responded to the two check-in notification in a row the third will tell them they are about to be failed out of the challenge', ' After two check-ins that were not responded to', ' Web App, Facebook Email', 'You haven''t checked in for two days and are about to fail [challenge name]. Are you still in it? yes/no', 1, '2013-11-26 02:21:58', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (5, ' Challenge Fail', ' After a user fails to check in for a challenge milestone or clicks "no" on the check-in', ' Upon Challenge Failure', ' Web App, Facebook, Email', ' Oh no! Sorry, nice try but you''ve failed [challenge name]', 1, '2013-11-22 05:30:43', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (6, ' Challenge Success', 'After a user sucessfully completes a challenge', 'After the last check-in on the 21st day of a challenge', 'Web App, Facebook, Email', 'Congratulations! You''ve completed [challenge name]', 1, '2013-11-22 05:31:30', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (7, ' Joined Your Challenge-Invitee', 'When you are a host and someone you invited accepts', 'Upon the invitee joining', 'Web App, Facebook', '[user name] has accepted your invitation to [challenge name]', 1, '2013-11-22 08:58:11', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (8, 'Joined Your Challenge-Any', ' When you are hosting an open challenge and anyone joins', 'Upon the user joining', 'Web App, Facebook', '[user name] has joined you for [challenge name]', 1, '2013-11-22 08:58:11', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (9, ' Challenge is Starting', ' A "this is your first day!" notification on day one', 'On the first Day of your challenge at 8AM', 'Web App, Facebook, Email', 'This is day 1 of 21 for [challenge name]', 1, '2013-11-22 05:32:33', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (10, 'Not Enough Team Members', ' If you are hosting, you need two additional team members to start a challenge. This notification will tell you to invite some more friends', '24 hours before your challenge start-date', 'Web App, Facebook, Email', 'Uh Oh! Your team isn''t big enough for [challenge name] Invite some more people!', 1, '2013-11-22 05:33:21', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (11, 'Invite Declined', 'When you are hosting and an invitee declines your invitation', 'Upon decline of your invite', ' Web App, Facebook, Email', '[user name] has declined your invite to [challenge name]', 1, '2013-11-22 08:58:11', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (12, 'New Badge Notification (points)', 'Notifiying the user that they just recieved a new badge based on a point accumulation', 'After reaching specified number of points', 'Web App, Facebook, Email', 'Congratulations! You have been awarded the [x] points badge!', 1, '2013-11-22 08:58:11', '0000-00-00 00:00:00');
INSERT INTO `alerts` VALUES (13, 'New Level Achieved', 'Notfiying the user when they have reached a new level on the platform', 'Per level acheived', 'Web App, Facebook, Email', 'Way to Go! You have just reached level [level #].', 1, '2013-11-25 11:30:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `badgecombos`
-- 

CREATE TABLE `badgecombos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `comboimg` varchar(255) NOT NULL,
  `gradient` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = Without gradient, 1 = With gradient',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `badgecombos`
-- 

INSERT INTO `badgecombos` VALUES (1, 'color9131386594719.png', 1);
INSERT INTO `badgecombos` VALUES (2, 'color3111386594734.png', 1);
INSERT INTO `badgecombos` VALUES (3, 'color3751386594739.png', 1);
INSERT INTO `badgecombos` VALUES (4, 'color3671386594749.png', 1);
INSERT INTO `badgecombos` VALUES (5, 'color2961386594754.png', 1);
INSERT INTO `badgecombos` VALUES (6, 'color431386594761.png', 1);
INSERT INTO `badgecombos` VALUES (7, 'color2531386595171.png', 0);
INSERT INTO `badgecombos` VALUES (8, 'color7461386595199.png', 0);
INSERT INTO `badgecombos` VALUES (9, 'color2331386595221.png', 0);
INSERT INTO `badgecombos` VALUES (10, 'color1201386595227.png', 0);
INSERT INTO `badgecombos` VALUES (11, 'color6031386595234.png', 0);
INSERT INTO `badgecombos` VALUES (12, 'color4091386595460.png', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `categories`
-- 

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `decal` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `parent` int(1) NOT NULL,
  `badgecolor` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `categories`
-- 

INSERT INTO `categories` VALUES (1, 'Health', 'graph.png', 1, 0, '');
INSERT INTO `categories` VALUES (2, 'Wealth', 'sun.png', 1, 0, '');
INSERT INTO `categories` VALUES (3, 'Relationships', 'heart.png', 1, 0, '');
INSERT INTO `categories` VALUES (4, 'Diet', '', 1, 1, 'color9131386594719.png');
INSERT INTO `categories` VALUES (5, 'Carrier', '', 1, 1, 'color3671386594749.png');
INSERT INTO `categories` VALUES (6, 'Fitness', '', 1, 1, 'color431386594761.png');
INSERT INTO `categories` VALUES (7, 'Friendship', '', 1, 3, 'color2961386594754.png');
INSERT INTO `categories` VALUES (8, 'Parenting', '', 1, 3, 'color3671386594749.png');
INSERT INTO `categories` VALUES (9, 'Test Category', 'robot.gif', 1, 0, '');
INSERT INTO `categories` VALUES (10, 'Test Child', '', 1, 9, 'color2961386594754.png');

-- --------------------------------------------------------

-- 
-- Table structure for table `challenges`
-- 

CREATE TABLE `challenges` (
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
  `child_category` int(11) NOT NULL DEFAULT '0',
  `length_of_challenge` int(5) NOT NULL,
  `host_set_start_date` int(1) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `added_date` datetime NOT NULL,
  `tags` longtext NOT NULL,
  `eligibility` longtext NOT NULL,
  `difficulty` int(5) NOT NULL,
  `pre_checkin_notification` int(11) NOT NULL,
  `checkin_notification` longtext NOT NULL,
  `notification_frequency` int(5) NOT NULL,
  `hero_image` varchar(255) NOT NULL,
  `badge_color` int(5) NOT NULL,
  `permalink` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `challenges`
-- 

INSERT INTO `challenges` VALUES (1, 'Test challenge', 'Test challenge badge', 'Test challenge daily', 'Test challenge why', 'Test challenge how', 'Test challenge learn more', 0, 1, 3, 7, 51, 1, '2013-12-09 00:00:00', '2014-01-28 00:00:00', '2013-12-09 08:23:56', 'School,Teacher,Colleague', '', 1, 1, 'Message two', 3, '909186807spray.png', 12, 'Test-challenge');
INSERT INTO `challenges` VALUES (3, 'Test the challenge module', 'The Tester', 'Spend time testing the site', 'To find bugs', 'http://iforcedev.accountsupport.com/RCG/admin', 'Lorem Ipsum', 0, 1, 1, 4, 90, 1, '2013-12-09 00:00:00', '2014-03-08 00:00:00', '2013-12-09 08:25:00', 'School,Teacher,Colleague,test', '', 3, 1, 'Message one', 1, '1974463016badge.jpg', 10, 'Test-the-challenge-module');
INSERT INTO `challenges` VALUES (4, 'Confirm changes', 'changerific', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce hendrerit euismod elit vel volutpat.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce hendrerit euismod elit vel volutpat. Donec risus velit, fringilla id feugiat ut, tincidunt eu purus. Etiam a erat quam. Ut eget purus arcu. Nam eget odio feugiat, tempor justo in, blandit tellus. Nunc sit amet pellentesque magna. Phasellus quis varius justo. Aenean pretium iaculis ante, ut porta nisl rhoncus non. In sodales fringilla erat, a dictum est facilisis ut. Suspendisse purus justo, pharetra non elementum pretium, tristique vel sem. In hac habitasse platea dictumst. Integer tincidunt semper elit non vulputate.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce hendrerit euismod elit vel volutpat. Donec risus velit, fringilla id feugiat ut, tincidunt eu purus. Etiam a erat quam. Ut eget purus arcu. Nam eget odio feugiat, tempor justo in, blandit tellus. Nunc sit amet pellentesque magna. Phasellus quis varius justo. Aenean pretium iaculis ante, ut porta nisl rhoncus non. In sodales fringilla erat, a dictum est facilisis ut. Suspendisse purus justo, pharetra non elementum pretium, tristique vel sem. In hac habitasse platea dictumst. Integer tincidunt semper elit non vulputate.', 'Nope', 0, 1, 3, 8, 7, 1, '2013-12-09 00:00:00', '2013-12-15 00:00:00', '2013-12-09 08:21:29', 'School,Teacher,Colleague', '', 3, 0, 'This is a message', 1, '1454936522badge2.jpg', 8, 'Confirm-changes');
INSERT INTO `challenges` VALUES (5, 'run', 'jdfhhf', 'dfdfdfdfa', 'dfdfrer', 'dfdgete', 'eteteet', 1, 1, 1, 6, 77, 1, '2013-12-21 00:00:00', '2014-03-07 00:00:00', '2013-12-09 08:22:39', 'School,Teacher,Colleague', '', 1, 2, 'hjjj', 7, '52ab0ffaa330e14030img-24.jpg', 9, 'run');
INSERT INTO `challenges` VALUES (6, '21 days', 'badge title', 'Daily Commitment:', 'why', 'how', 'learn more', 0, 1, 2, 5, 57, 1, '2013-12-09 00:00:00', '2014-02-03 00:00:00', '2013-12-09 08:18:11', 'School,Teacher,Colleague,Teacher6', '', 2, 5, '', 6, '52ab0df336bb252a964da0bdf726698img-02.jpg', 9, '21-days');
INSERT INTO `challenges` VALUES (8, 'Read a book', 'Reader', 'Read 10 pages of a book', 'Reading is good', 'Pick up a book and read it.', 'http://en.wikipedia.org/wiki/Reading_(process)', 1, 1, 1, 4, 90, 1, '2013-12-10 00:00:00', '2014-03-09 00:00:00', '2013-12-10 09:06:16', 'School,Teacher,Colleague', '', 2, 1, '', 10, '1470499831robot.jpg', 8, 'Read-a-book');
INSERT INTO `challenges` VALUES (9, 'test challenge 2', 'robot', 'test a challenge', 'because', 'do it', 'now', 0, 0, 9, 10, 1, 0, '2013-12-10 00:00:00', '2013-12-10 00:00:00', '2013-12-10 11:25:53', 'School,Teacher,Colleague', '', 4, 3, '', 10, '1394682964robot.jpg', 9, 'test-challenge-2');
INSERT INTO `challenges` VALUES (11, 'Quit Smoking', 'Quit Smoking', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus id est imperdiet auctor vitae sed dui.', 0, 1, 1, 6, 90, 1, '2013-12-11 00:00:00', '2014-03-10 00:00:00', '2013-12-11 07:56:39', 'Quit,Smoking,Health,Happy,Safe', '', 3, 2, '', 10, '1036120110img-58.jpg', 8, 'Quit-Smoking');

-- --------------------------------------------------------

-- 
-- Table structure for table `difficulties`
-- 

CREATE TABLE `difficulties` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `points` int(10) NOT NULL,
  `description` longtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `decal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `difficulties`
-- 

INSERT INTO `difficulties` VALUES (1, 'Easy', 300, 'Easy to do the tasks.', 1, 'level-1.png');
INSERT INTO `difficulties` VALUES (2, 'Medium', 600, 'Medium level task to do.', 1, 'level-2.png');
INSERT INTO `difficulties` VALUES (3, 'Hard', 900, 'Hard tasks to do.', 1, 'level-3.png');
INSERT INTO `difficulties` VALUES (4, 'Test Difficulty', 300, 'This is a difficulty to test', 1, 'robot.gif');

-- --------------------------------------------------------

-- 
-- Table structure for table `levels`
-- 

CREATE TABLE `levels` (
  `id` int(5) NOT NULL,
  `LevelThreshold` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `levels`
-- 

INSERT INTO `levels` VALUES (1, 3000);

-- --------------------------------------------------------

-- 
-- Table structure for table `notificationmessages`
-- 

CREATE TABLE `notificationmessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `notificationmessages`
-- 

INSERT INTO `notificationmessages` VALUES (1, 'First message');
INSERT INTO `notificationmessages` VALUES (2, 'Second message');
INSERT INTO `notificationmessages` VALUES (3, 'Third message');
INSERT INTO `notificationmessages` VALUES (4, 'hghtytytry');
INSERT INTO `notificationmessages` VALUES (5, 'test message');

-- --------------------------------------------------------

-- 
-- Table structure for table `userchallenges`
-- 

CREATE TABLE `userchallenges` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `challenge_id` int(8) NOT NULL,
  `user_challenge_hostid` int(8) DEFAULT NULL,
  `user_challenge_status` int(8) NOT NULL,
  `user_challenge_point` int(8) NOT NULL,
  `user_challenge_weekly_goal_completion` int(8) DEFAULT NULL,
  `user_challenge_notification_completion` int(11) DEFAULT NULL,
  `user_challenge_added` datetime NOT NULL,
  `started_date` datetime NOT NULL,
  `started_date_iso` datetime NOT NULL,
  `user_challenge_finished_date` datetime NOT NULL,
  `user_challenge_attempts` int(11) NOT NULL,
  `user_challenge_invitedby` int(11) NOT NULL,
  `user_challenge_private` tinyint(2) NOT NULL,
  `user_challenge_invitees_invite` tinyint(2) NOT NULL,
  `user_challenge_daily_total` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `userchallenges`
-- 

INSERT INTO `userchallenges` VALUES (1, 1, 1, NULL, 8, 0, NULL, NULL, '2013-12-18 09:27:22', '2013-12-19 01:30:00', '2013-12-20 12:00:00', '2014-02-09 12:00:00', 0, 0, 0, 1, 0, 1);
INSERT INTO `userchallenges` VALUES (2, 2, 1, 1, 0, 0, NULL, NULL, '2013-12-18 09:27:22', '2013-12-20 12:00:00', '2013-12-20 12:00:00', '2014-02-09 12:00:00', 0, 1, 0, 1, 0, 1);
INSERT INTO `userchallenges` VALUES (3, 3, 1, 1, 0, 0, NULL, NULL, '2013-12-18 09:27:22', '2013-12-20 12:00:00', '2013-12-20 12:00:00', '2014-02-09 12:00:00', 0, 1, 0, 1, 0, 1);
INSERT INTO `userchallenges` VALUES (4, 3, 5, NULL, 0, 0, NULL, NULL, '2013-12-18 09:29:06', '2013-12-30 06:00:00', '2013-12-30 06:00:00', '2014-03-17 06:00:00', 0, 0, 0, 0, 0, 2);
INSERT INTO `userchallenges` VALUES (5, 1, 5, 3, 0, 0, NULL, NULL, '2013-12-18 09:29:06', '2013-12-30 06:00:00', '2013-12-30 06:00:00', '2014-03-17 06:00:00', 0, 3, 0, 0, 0, 2);
INSERT INTO `userchallenges` VALUES (6, 2, 5, 3, 0, 0, NULL, NULL, '2013-12-18 09:29:06', '2013-12-30 06:00:00', '2013-12-30 06:00:00', '2014-03-17 06:00:00', 0, 3, 0, 0, 0, 2);
INSERT INTO `userchallenges` VALUES (7, 4, 5, 3, 0, 0, NULL, NULL, '2013-12-18 09:29:06', '2013-12-30 06:00:00', '2013-12-30 06:00:00', '2014-03-17 06:00:00', 0, 3, 0, 0, 0, 2);
INSERT INTO `userchallenges` VALUES (8, 1, 11, NULL, 0, 0, NULL, NULL, '2013-12-20 08:10:43', '2013-12-25 13:30:00', '2013-12-25 13:30:00', '2014-03-25 13:30:00', 0, 0, 0, 0, 0, 3);
INSERT INTO `userchallenges` VALUES (9, 3, 11, 1, 0, 0, NULL, NULL, '2013-12-20 08:10:43', '2013-12-25 13:30:00', '2013-12-25 13:30:00', '2014-03-25 13:30:00', 0, 1, 0, 0, 0, 3);
INSERT INTO `userchallenges` VALUES (10, 4, 11, 1, 0, 0, NULL, NULL, '2013-12-20 08:10:43', '2013-12-25 13:30:00', '2013-12-25 13:30:00', '2014-03-25 13:30:00', 0, 1, 0, 0, 0, 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
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
  `user_grd_year` int(11) NOT NULL,
  `user_grd_level` varchar(255) NOT NULL,
  `user_grd_schl` varchar(255) NOT NULL,
  `user_grd_degree` varchar(255) NOT NULL,
  `user_grd_cat` varchar(255) NOT NULL,
  `user_hobbies` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'iforcefb@gmail.com', 'Jack', 'Jill', '0706fd1ff8ac56944e535f9c8a98caf0', 0, 2, 1, '2013-12-12 09:01:37', 0, 0, '52a966ebc1eb9be_great.png', '2013-12-24 12:34:25', 0, '0', 0, 1, 1, 2005, 'bachelor', 'california state university- chico', 'Agriculture', 'Agricultural Economics', 'Agri,Testing,Flowering');
INSERT INTO `users` VALUES (2, 'jackjill@gmai.com', 'Jack', 'Jill', '07c72e30ccfcb9b130abd0a33460aadb', 0, 2, 2, '2013-12-18 09:20:33', 0, 0, 'Letter-Symbol.png', '2013-12-18 09:20:33', 0, '0', 0, 1, 0, 2012, 'masters', 'california state university- chico', 'Architecture', 'Architecture 2', 'Hobbies,Interests');
INSERT INTO `users` VALUES (3, 'milljohn@gmai.com', 'Mill', 'John', 'd2068ba758e968babd68a17479d7cf22', 0, 1, 1, '2013-12-18 09:22:06', 0, 0, 'Yin-and-Yang.png', '2013-12-18 09:22:06', 0, '0', 0, 1, 0, 2012, 'masters', 'california state university- chico', 'Agriculture', 'Agricultural Business ', 'Hobbies');
INSERT INTO `users` VALUES (4, 'jacksparrow@gmai.com', 'Jack', 'Sparrow', 'd34f9f73de4e49c41bb8cb5ae0a156c3', 0, 1, 1, '2013-12-18 09:23:50', 0, 0, 'Goal.png', '2013-12-18 09:23:50', 0, '0', 0, 1, 0, 2010, 'masters', 'california state university- chico', 'Arts', 'Arts 3', 'Interests');
