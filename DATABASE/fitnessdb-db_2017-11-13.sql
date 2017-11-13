-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2017 at 09:03 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fitnessdb`
--
CREATE DATABASE IF NOT EXISTS `fitnessdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fitnessdb`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `place` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `seats` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `activity`:
--   `id_user`
--       `user` -> `id`
--

--
-- Truncate table before insert `activity`
--

TRUNCATE TABLE `activity`;
--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `id_user`, `name`, `description`, `place`, `type`, `seats`) VALUES
(2, NULL, 'Aerobic', 'Descripcion de AEROBIC', 'no se', 'nose', 50),
(5, 1, 'Fitness', 'descripcion de fitnes', 'qwe', 'grupal', 25),
(6, 1, 'Tono', 'Abdominales, flexiones', 'gimnasio', 'grupal', 30);

-- --------------------------------------------------------

--
-- Table structure for table `activity_resource`
--

DROP TABLE IF EXISTS `activity_resource`;
CREATE TABLE IF NOT EXISTS `activity_resource` (
`id` int(11) NOT NULL,
  `id_activity` int(11) DEFAULT NULL,
  `id_resource` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `activity_resource`:
--   `id_activity`
--       `activity` -> `id`
--   `id_resource`
--       `resource` -> `id`
--

--
-- Truncate table before insert `activity_resource`
--

TRUNCATE TABLE `activity_resource`;
-- --------------------------------------------------------

--
-- Table structure for table `activity_schedule`
--

DROP TABLE IF EXISTS `activity_schedule`;
CREATE TABLE IF NOT EXISTS `activity_schedule` (
`id` int(11) NOT NULL,
  `id_activity` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `start_hour` time NOT NULL,
  `end_hour` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2904 DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `activity_schedule`:
--   `id_activity`
--       `activity` -> `id`
--

--
-- Truncate table before insert `activity_schedule`
--

TRUNCATE TABLE `activity_schedule`;
--
-- Dumping data for table `activity_schedule`
--

INSERT INTO `activity_schedule` (`id`, `id_activity`, `date`, `start_hour`, `end_hour`) VALUES
(2898, 5, '2017-11-13', '19:04:00', '20:04:00'),
(2899, 5, '2017-11-20', '19:04:00', '20:04:00'),
(2900, 5, '2017-11-27', '19:04:00', '20:04:00'),
(2901, 2, '2017-11-13', '09:05:00', '11:05:00'),
(2902, 2, '2017-11-20', '09:05:00', '11:05:00'),
(2903, 2, '2017-11-27', '09:05:00', '11:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `assistance`
--

DROP TABLE IF EXISTS `assistance`;
CREATE TABLE IF NOT EXISTS `assistance` (
`id` int(11) NOT NULL,
  `id_userActivity` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `assist` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `assistance`:
--   `id_userActivity`
--       `user_activity` -> `id`
--

--
-- Truncate table before insert `assistance`
--

TRUNCATE TABLE `assistance`;
-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE IF NOT EXISTS `exercise` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `type` varchar(45) NOT NULL,
  `image` mediumtext,
  `video` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `exercise`:
--   `id_user`
--       `user` -> `id`
--

--
-- Truncate table before insert `exercise`
--

TRUNCATE TABLE `exercise`;
--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`id`, `id_user`, `name`, `description`, `type`, `image`, `video`) VALUES
(0, 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `exercise_table`
--

DROP TABLE IF EXISTS `exercise_table`;
CREATE TABLE IF NOT EXISTS `exercise_table` (
`id` int(11) NOT NULL,
  `id_exercise` int(11) DEFAULT NULL,
  `id_workout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `exercise_table`:
--   `id_exercise`
--       `exercise` -> `id`
--   `id_workout`
--       `workout_table` -> `id`
--

--
-- Truncate table before insert `exercise_table`
--

TRUNCATE TABLE `exercise_table`;
--
-- Dumping data for table `exercise_table`
--

INSERT INTO `exercise_table` (`id`, `id_exercise`, `id_workout`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `notification`:
--   `id_user`
--       `user` -> `id`
--

--
-- Truncate table before insert `notification`
--

TRUNCATE TABLE `notification`;
--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `id_user`, `date`, `title`, `content`) VALUES
(1, 0, '2017-12-14 00:00:00', 'sadf', 'sadfsadfas');

-- --------------------------------------------------------

--
-- Table structure for table `notification_user`
--

DROP TABLE IF EXISTS `notification_user`;
CREATE TABLE IF NOT EXISTS `notification_user` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_notification` int(11) DEFAULT NULL,
  `viewed` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `notification_user`:
--   `id_user`
--       `user` -> `id`
--   `id_notification`
--       `notification` -> `id`
--

--
-- Truncate table before insert `notification_user`
--

TRUNCATE TABLE `notification_user`;
--
-- Dumping data for table `notification_user`
--

INSERT INTO `notification_user` (`id`, `id_user`, `id_notification`, `viewed`) VALUES
(1, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `public_info`
--

DROP TABLE IF EXISTS `public_info`;
CREATE TABLE IF NOT EXISTS `public_info` (
`id` int(11) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `public_info`
--

TRUNCATE TABLE `public_info`;
--
-- Dumping data for table `public_info`
--

INSERT INTO `public_info` (`id`, `phone`, `email`, `address`) VALUES
(0, 649556062, 'uxio.gf@gmail.com', 'direccion za');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

DROP TABLE IF EXISTS `resource`;
CREATE TABLE IF NOT EXISTS `resource` (
`id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `resource`
--

TRUNCATE TABLE `resource`;
--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `name`, `description`) VALUES
(0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_table` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `duration` time NOT NULL,
  `comment` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `session`:
--   `id_user`
--       `user` -> `id`
--   `id_table`
--       `user_table` -> `id`
--

--
-- Truncate table before insert `session`
--

TRUNCATE TABLE `session`;
--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `id_user`, `id_table`, `date`, `duration`, `comment`) VALUES
(0, 0, 0, '0000-00-00 00:00:00', '00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `confirm_date` datetime DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `profile_image` varchar(50) DEFAULT NULL,
  `user_type` tinyint(11) unsigned NOT NULL,
  `athlete_type` tinyint(3) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `email`, `phone`, `dni`, `confirm_date`, `description`, `profile_image`, `user_type`, `athlete_type`) VALUES
(0, 'user', 'usuario', 'Usuario', 'Apel', 'email@correo.com', 649556060, '53111974A', NULL, 'Descripción del usuario.\r\n', '1509576497_1.jpg', 1, 0),
(1, 'user2', 'usuario2', 'Usuario segundo', '', 'mail@mail.com', 23, '', NULL, 'desc2s', NULL, 2, 0),
(2, 'user3', 'usuario3', 'Usuario Tercero', '', 'mail@mail.com', 4, '', NULL, 'u3.', NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE IF NOT EXISTS `user_activity` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_activity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `user_activity`:
--   `id_user`
--       `user` -> `id`
--   `id_activity`
--       `activity_schedule` -> `id`
--

--
-- Truncate table before insert `user_activity`
--

TRUNCATE TABLE `user_activity`;
-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

DROP TABLE IF EXISTS `user_table`;
CREATE TABLE IF NOT EXISTS `user_table` (
`id` int(11) NOT NULL,
  `id_workout` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `user_table`:
--   `id_user`
--       `user` -> `id`
--   `id_workout`
--       `workout_table` -> `id`
--

--
-- Truncate table before insert `user_table`
--

TRUNCATE TABLE `user_table`;
--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `id_workout`, `id_user`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `workout_table`
--

DROP TABLE IF EXISTS `workout_table`;
CREATE TABLE IF NOT EXISTS `workout_table` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `workout_table`:
--   `id_user`
--       `user` -> `id`
--

--
-- Truncate table before insert `workout_table`
--

TRUNCATE TABLE `workout_table`;
--
-- Dumping data for table `workout_table`
--

INSERT INTO `workout_table` (`id`, `id_user`, `name`, `type`, `description`) VALUES
(0, 0, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `activity_resource`
--
ALTER TABLE `activity_resource`
 ADD PRIMARY KEY (`id`), ADD KEY `id_activity` (`id_activity`), ADD KEY `id_resource` (`id_resource`);

--
-- Indexes for table `activity_schedule`
--
ALTER TABLE `activity_schedule`
 ADD PRIMARY KEY (`id`), ADD KEY `id_activity` (`id_activity`);

--
-- Indexes for table `assistance`
--
ALTER TABLE `assistance`
 ADD PRIMARY KEY (`id`), ADD KEY `id_userActivity` (`id_userActivity`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `exercise_table`
--
ALTER TABLE `exercise_table`
 ADD PRIMARY KEY (`id`), ADD KEY `id_exercise` (`id_exercise`), ADD KEY `id_workout` (`id_workout`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `notification_user`
--
ALTER TABLE `notification_user`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`), ADD KEY `id_notification` (`id_notification`);

--
-- Indexes for table `public_info`
--
ALTER TABLE `public_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`), ADD KEY `id_table` (`id_table`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`), ADD KEY `id_activity` (`id_activity`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`), ADD KEY `id_workout` (`id_workout`);

--
-- Indexes for table `workout_table`
--
ALTER TABLE `workout_table`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `activity_resource`
--
ALTER TABLE `activity_resource`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `activity_schedule`
--
ALTER TABLE `activity_schedule`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2904;
--
-- AUTO_INCREMENT for table `assistance`
--
ALTER TABLE `assistance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exercise_table`
--
ALTER TABLE `exercise_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notification_user`
--
ALTER TABLE `notification_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `public_info`
--
ALTER TABLE `public_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `workout_table`
--
ALTER TABLE `workout_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `activity_resource`
--
ALTER TABLE `activity_resource`
ADD CONSTRAINT `activity_resource_ibfk_1` FOREIGN KEY (`id_activity`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `activity_resource_ibfk_2` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activity_schedule`
--
ALTER TABLE `activity_schedule`
ADD CONSTRAINT `activity_schedule_ibfk_1` FOREIGN KEY (`id_activity`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assistance`
--
ALTER TABLE `assistance`
ADD CONSTRAINT `assistance_ibfk_1` FOREIGN KEY (`id_userActivity`) REFERENCES `user_activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exercise`
--
ALTER TABLE `exercise`
ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `exercise_table`
--
ALTER TABLE `exercise_table`
ADD CONSTRAINT `exercise_table_ibfk_1` FOREIGN KEY (`id_exercise`) REFERENCES `exercise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `exercise_table_ibfk_2` FOREIGN KEY (`id_workout`) REFERENCES `workout_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `notification_user`
--
ALTER TABLE `notification_user`
ADD CONSTRAINT `notification_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `notification_user_ibfk_2` FOREIGN KEY (`id_notification`) REFERENCES `notification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`id_table`) REFERENCES `user_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_activity`
--
ALTER TABLE `user_activity`
ADD CONSTRAINT `user_activity_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_activity_ibfk_2` FOREIGN KEY (`id_activity`) REFERENCES `activity_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_table`
--
ALTER TABLE `user_table`
ADD CONSTRAINT `user_table_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `user_table_ibfk_2` FOREIGN KEY (`id_workout`) REFERENCES `workout_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workout_table`
--
ALTER TABLE `workout_table`
ADD CONSTRAINT `workout_table_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
