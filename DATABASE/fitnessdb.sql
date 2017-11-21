CREATE DATABASE  IF NOT EXISTS `fitnessdb` USE `fitnessdb`;


DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `type` int(11) NOT NULL,
  `place` int(11) DEFAULT NULL,
  `seats` int(11) NOT NULL,
  `image` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `activity` (`id`, `id_user`, `name`, `description`, `type`, `place`, `seats`, `image`) VALUES
(1, 3, 'Cardio ', 'Descripcion de ZUMBA', 2, 5, 49, 'NULL'),
(23, 2, 'Spinning', 'aaaaa', 2, 5, 45, 'NULL'),
(24, 2, 'Pilates', 'asd', 1, 5, 12, NULL),
(25, 2, 'Boxing', 'asd', 2, 6, 123, NULL),
(26, 2, 'Aerobics', 'asd', 2, 6, 123, NULL),
(27, 2, 'Kik Boxing', '23', 2, 6, 123, NULL),
(28, 2, 'Crossfit', '23', 2, 5, 123, NULL),
(29, 2, 'Yoga', 'asd', 2, 5, 123, NULL);

DROP TABLE IF EXISTS `activity_resource`;
CREATE TABLE `activity_resource` (
  `id` int(11) NOT NULL,
  `id_activity` int(11) DEFAULT NULL,
  `id_resource` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `activity_resource` (`id`, `id_activity`, `id_resource`, `quantity`) VALUES
(27, 1, 2, 12);

DROP TABLE IF EXISTS `activity_schedule`;
CREATE TABLE `activity_schedule` (
  `id` int(11) NOT NULL,
  `id_activity` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `start_hour` time NOT NULL,
  `end_hour` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `activity_schedule` (`id`, `id_activity`, `date`, `start_hour`, `end_hour`) VALUES
(1, 1, '2017-11-20', '17:46:00', '17:47:00'),
(2, 23, '2017-11-20', '17:47:00', '17:48:00'),
(3, 23, '2017-11-27', '17:47:00', '17:48:00'),
(4, 23, '2017-12-04', '17:47:00', '17:48:00');

DROP TABLE IF EXISTS `assistance`;
CREATE TABLE `assistance` (
  `id` int(11) NOT NULL,
  `id_userActivity` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `assist` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE `exercise` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `type` varchar(45) NOT NULL,
  `image` mediumtext,
  `video` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `exercise` (`id`, `id_user`, `name`, `description`, `type`, `image`, `video`) VALUES
(0, 0, '', '', '', '', '');

DROP TABLE IF EXISTS `exercise_table`;
CREATE TABLE `exercise_table` (
  `id` int(11) NOT NULL,
  `id_exercise` int(11) DEFAULT NULL,
  `id_workout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `exercise_table` (`id`, `id_exercise`, `id_workout`) VALUES
(0, 0, 0);

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `notification` (`id`, `id_user`, `date`, `title`, `content`) VALUES
(1, 1, '2017-11-16 00:00:00', 'Clase cancelada', 'aaaaa');

DROP TABLE IF EXISTS `notification_user`;
CREATE TABLE `notification_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_notification` int(11) DEFAULT NULL,
  `viewed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `notification_user` (`id`, `id_user`, `id_notification`, `viewed`) VALUES
(1, 1, 1, '2017-11-16');

DROP TABLE IF EXISTS `public_info`;
CREATE TABLE `public_info` (
  `id` int(11) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `public_info` (`id`, `phone`, `email`, `address`) VALUES
(0, 649555555, 'mail@mail.com', 'descriptuoin');

DROP TABLE IF EXISTS `resource`;
CREATE TABLE `resource` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `resource` (`id`, `name`, `description`, `quantity`, `type`) VALUES
(2, 'Res 2', 'fdg', 14, 1),
(3, 'Res3', 'dsaf', 16, 1),
(4, 'res4', 'dvgfdbfdb', 20, 1),
(5, 'Sala 1', 'sala', 1, 2),
(6, 'Sala 2', 'sala 2', 1, 2);

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_table` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `duration` time NOT NULL,
  `comment` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `session` (`id`, `id_user`, `id_table`, `date`, `duration`, `comment`) VALUES
(0, 0, 0, '0000-00-00 00:00:00', '00:00:00', '');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
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
  `user_type` tinyint(11) UNSIGNED NOT NULL,
  `athlete_type` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `email`, `phone`, `dni`, `confirm_date`, `description`, `profile_image`, `user_type`, `athlete_type`) VALUES
(0, 'user', 'usuario', 'Usuario', 'Apel', 'email@correo.com', 649556060, '53111974A', NULL, 'Descripción del usuario.\r\n', '1509576497_1.jpg', 1, 1),
(1, 'user2', 'usuario2', 'Usuario segundo', '', 'mail@mail.com', 0, '', NULL, 'desc2s', NULL, 3, NULL),
(2, 'user3', 'usuario3', 'Usuario Tercero', '', 'mail@mail.com', 0, '', NULL, 'u3.', NULL, 2, 0),
(3, 'user4', 'usuario4', 'usuario Cuarto', 'Apel', 'mail@mail.com', 0, '', NULL, 'd42', '1509668373_4.jpg', 2, 0);

DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_activity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_table`;
CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `id_workout` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user_table` (`id`, `id_workout`, `id_user`) VALUES
(0, 0, 0);

DROP TABLE IF EXISTS `workout_table`;
CREATE TABLE `workout_table` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `workout_table` (`id`, `id_user`, `name`, `type`, `description`) VALUES
(0, 0, '', '', '');


ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `activity_ibfk_2` (`place`);

ALTER TABLE `activity_resource`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_activity` (`id_activity`),
  ADD KEY `id_resource` (`id_resource`);

ALTER TABLE `activity_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_activity` (`id_activity`);

ALTER TABLE `assistance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_userActivity` (`id_userActivity`);

ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

ALTER TABLE `exercise_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_exercise` (`id_exercise`),
  ADD KEY `id_workout` (`id_workout`);

ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

ALTER TABLE `notification_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_notification` (`id_notification`);

ALTER TABLE `public_info`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `resource`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_table` (`id_table`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_activity` (`id_activity`);

ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_workout` (`id_workout`);

ALTER TABLE `workout_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);


ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
ALTER TABLE `activity_resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
ALTER TABLE `activity_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `assistance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `exercise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `exercise_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `notification_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `public_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `workout_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`place`) REFERENCES `resource` (`id`);

ALTER TABLE `activity_resource`
  ADD CONSTRAINT `activity_resource_ibfk_1` FOREIGN KEY (`id_activity`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_resource_ibfk_2` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `activity_schedule`
  ADD CONSTRAINT `activity_schedule_ibfk_1` FOREIGN KEY (`id_activity`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `assistance`
  ADD CONSTRAINT `assistance_ibfk_1` FOREIGN KEY (`id_userActivity`) REFERENCES `user_activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `exercise_table`
  ADD CONSTRAINT `exercise_table_ibfk_1` FOREIGN KEY (`id_exercise`) REFERENCES `exercise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exercise_table_ibfk_2` FOREIGN KEY (`id_workout`) REFERENCES `workout_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `notification_user`
  ADD CONSTRAINT `notification_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_user_ibfk_2` FOREIGN KEY (`id_notification`) REFERENCES `notification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`id_table`) REFERENCES `user_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `user_activity`
  ADD CONSTRAINT `user_activity_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_activity_ibfk_2` FOREIGN KEY (`id_activity`) REFERENCES `activity_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `user_table`
  ADD CONSTRAINT `user_table_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_table_ibfk_2` FOREIGN KEY (`id_workout`) REFERENCES `workout_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `workout_table`
  ADD CONSTRAINT `workout_table_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

CREATE USER IF NOT EXISTS 'fitnessuser'@'localhost' IDENTIFIED BY 'fitnesspass' ;
GRANT ALL PRIVILEGES ON `fitnessdb` . * TO 'fitnessuser'@'localhost' ;
