-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2017 at 01:54 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- -----------------------------------------------------
-- Create user and DB
-- -----------------------------------------------------

CREATE USER IF NOT EXISTS 'fitnessuser'@'localhost'
  IDENTIFIED BY 'fitnesspass' ;
CREATE DATABASE IF NOT EXISTS `fitnessdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON `fitnessdb` . * TO 'fitnessuser'@'localhost' ;
use `fitnessdb` ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `place` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `seats` int(11) NOT NULL,
  `image` mediumtext,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `activity`
--

INSERT INTO `activity` (`id`, `id_user`, `name`, `description`, `place`, `type`, `seats`, `image`) VALUES
(1, 3, 'Zumba', 'Descripcion de ZUMBA', 'Gimnasio', 'tipo 3', 49, NULL),
(23, 2, 'aaaa', 'aaaaa', 'aaa', 'aaa', 45, '[\"resources\\/images\\/09-11-2017-21-10-47-Captura de pantalla de 2017-11-07 16-56-42.png\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_resource`
--

CREATE TABLE IF NOT EXISTS `activity_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_activity` int(11) DEFAULT NULL,
  `id_resource` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_activity` (`id_activity`),
  KEY `id_resource` (`id_resource`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `activity_resource`
--

INSERT INTO `activity_resource` (`id`, `id_activity`, `id_resource`, `quantity`) VALUES
(1, 1, 2, 12),
(26, 1, 4, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_schedule`
--

CREATE TABLE IF NOT EXISTS `activity_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_activity` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `start_hour` time NOT NULL,
  `end_hour` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_activity` (`id_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assistance`
--

CREATE TABLE IF NOT EXISTS `assistance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_userActivity` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `assist` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_userActivity` (`id_userActivity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exercise`
--

CREATE TABLE IF NOT EXISTS `exercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `type` varchar(45) NOT NULL,
  `image` mediumtext,
  `video` mediumtext,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exercise`
--

INSERT INTO `exercise` (`id`, `id_user`, `name`, `description`, `type`, `image`, `video`) VALUES
(0, 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exercise_table`
--

CREATE TABLE IF NOT EXISTS `exercise_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_exercise` int(11) DEFAULT NULL,
  `id_workout` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_exercise` (`id_exercise`),
  KEY `id_workout` (`id_workout`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exercise_table`
--

INSERT INTO `exercise_table` (`id`, `id_exercise`, `id_workout`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notification`
--

INSERT INTO `notification` (`id`, `id_user`, `date`, `title`, `content`) VALUES
(0, 0, '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification_user`
--

CREATE TABLE IF NOT EXISTS `notification_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_notification` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_notification` (`id_notification`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notification_user`
--

INSERT INTO `notification_user` (`id`, `id_user`, `id_notification`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `public_info`
--

CREATE TABLE IF NOT EXISTS `public_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `public_info`
--

INSERT INTO `public_info` (`id`, `phone`, `email`, `address`) VALUES
(0, 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `resource`
--

INSERT INTO `resource` (`id`, `name`, `description`, `quantity`) VALUES
(2, 'Res 2', 'fdg', 14),
(3, 'Res3', 'dsaf', 15),
(4, 'res4', 'dvgfdbfdb', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_table` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `duration` time NOT NULL,
  `comment` mediumtext,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_table` (`id_table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `session`
--

INSERT INTO `session` (`id`, `id_user`, `id_table`, `date`, `duration`, `comment`) VALUES
(0, 0, 0, '0000-00-00 00:00:00', '00:00:00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `user_type` tinyint(11) UNSIGNED NOT NULL,
  `athlete_type` tinyint(3) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `email`, `phone`, `dni`, `confirm_date`, `description`, `profile_image`, `user_type`, `athlete_type`) VALUES
(0, 'user', 'usuario', 'Usuario', 'Apel', 'email@correo.com', 649556060, '53111974A', NULL, 'Descripción del usuario.\r\n', '1509576497_1.jpg', 1, 1),
(1, 'user2', 'usuario2', 'Usuario segundo', '', 'mail@mail.com', 0, '', NULL, 'desc2s', NULL, 3, NULL),
(2, 'user3', 'usuario3', 'Usuario Tercero', '', 'mail@mail.com', 0, '', NULL, 'u3.', NULL, 2, 0),
(3, 'user4', 'usuario4', 'usuario Cuarto', 'Apel', 'mail@mail.com', NULL, NULL, NULL, 'd42', '1509668373_4.jpg', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_activity`
--

CREATE TABLE IF NOT EXISTS `user_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_activity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_activity` (`id_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_workout` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_workout` (`id_workout`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_table`
--

INSERT INTO `user_table` (`id`, `id_workout`, `id_user`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workout_table`
--

CREATE TABLE IF NOT EXISTS `workout_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `workout_table`
--

INSERT INTO `workout_table` (`id`, `id_user`, `name`, `type`, `description`) VALUES
(0, 0, '', '', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `activity_resource`
--
ALTER TABLE `activity_resource`
  ADD CONSTRAINT `activity_resource_ibfk_1` FOREIGN KEY (`id_activity`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_resource_ibfk_2` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `activity_schedule`
--
ALTER TABLE `activity_schedule`
  ADD CONSTRAINT `activity_schedule_ibfk_1` FOREIGN KEY (`id_activity`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `assistance`
--
ALTER TABLE `assistance`
  ADD CONSTRAINT `assistance_ibfk_1` FOREIGN KEY (`id_userActivity`) REFERENCES `user_activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `exercise_table`
--
ALTER TABLE `exercise_table`
  ADD CONSTRAINT `exercise_table_ibfk_1` FOREIGN KEY (`id_exercise`) REFERENCES `exercise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exercise_table_ibfk_2` FOREIGN KEY (`id_workout`) REFERENCES `workout_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `notification_user`
--
ALTER TABLE `notification_user`
  ADD CONSTRAINT `notification_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_user_ibfk_2` FOREIGN KEY (`id_notification`) REFERENCES `notification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`id_table`) REFERENCES `user_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `user_activity_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_activity_ibfk_2` FOREIGN KEY (`id_activity`) REFERENCES `activity_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_table`
--
ALTER TABLE `user_table`
  ADD CONSTRAINT `user_table_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_table_ibfk_2` FOREIGN KEY (`id_workout`) REFERENCES `workout_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `workout_table`
--
ALTER TABLE `workout_table`
  ADD CONSTRAINT `workout_table_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
