-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 09, 2018 at 03:23 PM
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
CREATE DATABASE IF NOT EXISTS `fitnessdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `fitnessdb`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `type` int(11) NOT NULL,
  `place` int(11) DEFAULT NULL,
  `seats` int(11) NOT NULL,
  `image` mediumtext COLLATE utf8_spanish_ci
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `id_user`, `name`, `description`, `type`, `place`, `seats`, `image`) VALUES
(1, 2, 'Atletismo', 'O Campus de Ourense conta cunha pista de atletismo onde se poderán practicar as actividades atléticas de carreiras e saltos.', 1, 2, 20, '["resources\\/images\\/21-11-2017-18-59-39-atletismo.jpg"]'),
(2, 2, 'Bailes', '1.- Destinatarias:Persoas con abono Muver, abono ponte en Forma ou cunha entrada multideporte.', 2, 4, 1, '["resources\\/images\\/21-11-2017-19-02-03-pic10.jpg"]'),
(3, 3, 'Ciclo', 'Horario e duración da actividade:\\r\\nImpartiranse catro clases semanais desta actividade dende o 2 de novembro ao 31 de maio (agás periodos non lectivos) nos seguintes horarios:\\r\\n- Luns, martes, mércores e xoves de 21:15 a 22:15 h.', 2, 6, 24, '["resources\\/images\\/21-11-2017-19-03-45-pic3.jpg"]'),
(4, 2, 'Circuit Fit', 'Horario e duración da actividade:Impartiranse dúas clases semanais desta actividade dende o 2 de outubro ao 31 de maio (agás nos periodos non lectivos) no seguinte horario:\\r\\n- Luns e mércores de 19:15 a 20:15 h', 2, 4, 30, '["resources\\/images\\/09-01-2018-14-04-40-1_1509558741_pic2.jpg"]'),
(5, 3, 'Voleibol', '1. Descrición da actividade:Iniciación o deporte de volei pista. ', 2, 3, 30, '["resources\\/images\\/21-11-2017-19-05-36-voleibol.jpg"]'),
(6, 3, 'Zumba', ' Horario e duración da actividade:Impartirase dúas clases semanais desta actividade dende o 23 de outubro e o 31 de maio (agás nos periodos non lectivos) no seguinte horario:\\r\\n- Martes e xoves de 20:15 a 21:15 h.', 2, 4, 30, '["resources\\/images\\/21-11-2017-19-14-00-zumba2.jpg"]'),
(7, 2, 'Gimnasio', 'O Campus de Ourense conta, no interior do pavillón universitario, cunha sala cardio-fitness completamente equipada para o desenvolvemento de diferentes actividades de fitness.', 1, 4, 60, '["resources\\/images\\/21-11-2017-19-06-55-pic9.jpg","resources\\/images\\/21-11-2017-19-06-55-pic16.jpg","resources\\/images\\/21-11-2017-19-06-55-single_class.jpg"]');

-- --------------------------------------------------------

--
-- Table structure for table `activity_resource`
--

DROP TABLE IF EXISTS `activity_resource`;
CREATE TABLE IF NOT EXISTS `activity_resource` (
`id` int(11) NOT NULL,
  `id_activity` int(11) DEFAULT NULL,
  `id_resource` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `activity_resource`
--

INSERT INTO `activity_resource` (`id`, `id_activity`, `id_resource`, `quantity`) VALUES
(1, 3, 7, 15),
(2, 7, 8, 5),
(3, 7, 9, 5),
(4, 7, 7, 15);

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
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `activity_schedule`
--

INSERT INTO `activity_schedule` (`id`, `id_activity`, `date`, `start_hour`, `end_hour`) VALUES
(1, 6, '2017-11-21', '10:00:00', '11:00:00'),
(2, 6, '2017-11-28', '10:00:00', '11:00:00'),
(3, 6, '2017-12-05', '10:00:00', '11:00:00'),
(4, 6, '2017-12-12', '10:00:00', '11:00:00'),
(5, 6, '2017-12-19', '10:00:00', '11:00:00'),
(6, 6, '2017-12-26', '10:00:00', '11:00:00'),
(7, 6, '2018-01-02', '10:00:00', '11:00:00'),
(8, 6, '2018-01-09', '10:00:00', '11:00:00'),
(9, 6, '2018-01-16', '10:00:00', '11:00:00'),
(10, 5, '2017-11-21', '15:00:00', '16:00:00'),
(11, 5, '2017-11-28', '15:00:00', '16:00:00'),
(12, 5, '2017-12-05', '15:00:00', '16:00:00'),
(13, 5, '2017-12-12', '15:00:00', '16:00:00'),
(14, 5, '2017-12-19', '15:00:00', '16:00:00'),
(15, 5, '2017-12-26', '15:00:00', '16:00:00'),
(16, 5, '2018-01-02', '15:00:00', '16:00:00'),
(17, 5, '2018-01-09', '15:00:00', '16:00:00'),
(18, 5, '2018-01-16', '15:00:00', '16:00:00'),
(19, 7, '2017-09-01', '14:00:00', '16:00:00'),
(20, 7, '2017-09-08', '14:00:00', '16:00:00'),
(21, 7, '2017-09-15', '14:00:00', '16:00:00'),
(22, 7, '2017-09-22', '14:00:00', '16:00:00'),
(23, 7, '2017-09-29', '14:00:00', '16:00:00'),
(24, 7, '2017-10-06', '14:00:00', '16:00:00'),
(25, 7, '2017-10-13', '14:00:00', '16:00:00'),
(26, 7, '2017-10-20', '14:00:00', '16:00:00'),
(27, 7, '2017-10-27', '14:00:00', '16:00:00'),
(28, 7, '2017-11-03', '14:00:00', '16:00:00'),
(29, 7, '2017-11-10', '14:00:00', '16:00:00'),
(30, 7, '2017-11-17', '14:00:00', '16:00:00'),
(31, 7, '2017-11-24', '14:00:00', '16:00:00'),
(32, 7, '2017-12-01', '14:00:00', '16:00:00'),
(33, 7, '2017-12-08', '14:00:00', '16:00:00'),
(34, 7, '2017-12-15', '14:00:00', '16:00:00'),
(35, 7, '2017-12-22', '14:00:00', '16:00:00'),
(36, 7, '2017-12-29', '14:00:00', '16:00:00'),
(37, 7, '2018-01-05', '14:00:00', '16:00:00'),
(38, 7, '2018-01-12', '14:00:00', '16:00:00'),
(39, 7, '2018-01-19', '14:00:00', '16:00:00'),
(40, 1, '2017-09-01', '09:00:00', '10:30:00'),
(41, 1, '2017-09-08', '09:00:00', '10:30:00'),
(42, 1, '2017-09-15', '09:00:00', '10:30:00'),
(43, 1, '2017-09-22', '09:00:00', '10:30:00'),
(44, 1, '2017-09-29', '09:00:00', '10:30:00'),
(45, 1, '2017-10-06', '09:00:00', '10:30:00'),
(46, 1, '2017-10-13', '09:00:00', '10:30:00'),
(47, 1, '2017-10-20', '09:00:00', '10:30:00'),
(48, 1, '2017-10-27', '09:00:00', '10:30:00'),
(49, 1, '2017-11-03', '09:00:00', '10:30:00'),
(50, 1, '2017-11-10', '09:00:00', '10:30:00'),
(51, 1, '2017-11-17', '09:00:00', '10:30:00'),
(52, 1, '2017-11-24', '09:00:00', '10:30:00'),
(53, 1, '2017-12-01', '09:00:00', '10:30:00'),
(54, 1, '2017-12-08', '09:00:00', '10:30:00'),
(55, 1, '2017-12-15', '09:00:00', '10:30:00'),
(56, 1, '2017-12-22', '09:00:00', '10:30:00'),
(57, 1, '2017-12-29', '09:00:00', '10:30:00'),
(58, 1, '2018-01-05', '09:00:00', '10:30:00'),
(59, 1, '2018-01-12', '09:00:00', '10:30:00'),
(60, 1, '2018-01-19', '09:00:00', '10:30:00'),
(61, 4, '2018-01-08', '09:00:00', '10:30:00'),
(62, 4, '2018-01-15', '09:00:00', '10:30:00'),
(63, 4, '2018-01-22', '09:00:00', '10:30:00'),
(64, 4, '2018-01-29', '09:00:00', '10:30:00'),
(65, 2, '2018-01-02', '12:00:00', '13:00:00'),
(66, 2, '2018-01-09', '12:00:00', '13:00:00'),
(67, 2, '2018-01-16', '12:00:00', '13:00:00'),
(68, 2, '2018-01-23', '12:00:00', '13:00:00'),
(69, 2, '2018-01-30', '12:00:00', '13:00:00'),
(70, 2, '2018-02-06', '12:00:00', '13:00:00'),
(71, 2, '2018-02-13', '12:00:00', '13:00:00'),
(72, 2, '2018-02-20', '12:00:00', '13:00:00'),
(73, 3, '2018-01-03', '09:00:00', '10:00:00'),
(74, 3, '2018-01-10', '09:00:00', '10:00:00'),
(75, 3, '2018-01-17', '09:00:00', '10:00:00'),
(76, 3, '2018-01-24', '09:00:00', '10:00:00'),
(77, 3, '2018-01-31', '09:00:00', '10:00:00'),
(78, 3, '2018-02-07', '09:00:00', '10:00:00'),
(79, 3, '2018-02-14', '09:00:00', '10:00:00'),
(80, 3, '2018-02-21', '09:00:00', '10:00:00'),
(81, 6, '2018-01-04', '10:00:00', '11:00:00'),
(82, 6, '2018-01-11', '10:00:00', '11:00:00'),
(83, 6, '2018-01-18', '10:00:00', '11:00:00'),
(84, 6, '2018-01-25', '10:00:00', '11:00:00'),
(85, 6, '2018-02-01', '10:00:00', '11:00:00'),
(87, 6, '2018-02-15', '10:00:00', '11:00:00'),
(88, 6, '2018-02-22', '10:00:00', '11:00:00'),
(89, 1, '2018-01-01', '16:00:00', '18:30:00'),
(90, 1, '2018-01-08', '16:00:00', '18:30:00'),
(91, 1, '2018-01-15', '16:00:00', '18:30:00'),
(92, 1, '2018-01-22', '16:00:00', '18:30:00'),
(93, 1, '2018-01-29', '16:00:00', '18:30:00'),
(94, 1, '2018-02-05', '16:00:00', '18:30:00'),
(95, 1, '2018-02-12', '16:00:00', '18:30:00'),
(96, 1, '2018-02-19', '16:00:00', '18:30:00'),
(97, 4, '2018-01-05', '11:00:00', '12:30:00'),
(98, 4, '2018-01-12', '11:00:00', '12:30:00'),
(99, 4, '2018-01-19', '11:00:00', '12:30:00'),
(100, 4, '2018-01-26', '11:00:00', '12:30:00'),
(101, 4, '2018-02-02', '11:00:00', '12:30:00'),
(102, 4, '2018-02-09', '11:00:00', '12:30:00'),
(103, 4, '2018-02-16', '11:00:00', '12:30:00'),
(104, 4, '2018-02-23', '11:00:00', '12:30:00'),
(105, 4, '2018-01-03', '14:00:00', '15:30:00'),
(106, 4, '2018-01-10', '14:00:00', '15:30:00'),
(107, 4, '2018-01-17', '14:00:00', '15:30:00'),
(108, 4, '2018-01-24', '14:00:00', '15:30:00'),
(109, 4, '2018-01-31', '14:00:00', '15:30:00'),
(110, 4, '2018-02-07', '14:00:00', '15:30:00'),
(111, 4, '2018-02-14', '14:00:00', '15:30:00'),
(112, 4, '2018-02-21', '14:00:00', '15:30:00'),
(113, 2, '2018-01-04', '12:00:00', '13:00:00'),
(114, 2, '2018-01-11', '12:00:00', '13:00:00'),
(115, 2, '2018-01-18', '12:00:00', '13:00:00'),
(116, 2, '2018-01-25', '12:00:00', '13:00:00'),
(117, 2, '2018-02-01', '12:00:00', '13:00:00'),
(118, 2, '2018-02-08', '12:00:00', '13:00:00'),
(119, 2, '2018-02-15', '12:00:00', '13:00:00'),
(120, 2, '2018-02-22', '12:00:00', '13:00:00'),
(121, 1, '2018-01-04', '16:00:00', '18:30:00'),
(122, 1, '2018-01-11', '16:00:00', '18:30:00'),
(123, 1, '2018-01-18', '16:00:00', '18:30:00'),
(124, 1, '2018-01-25', '16:00:00', '18:30:00'),
(125, 1, '2018-02-01', '16:00:00', '18:30:00'),
(126, 1, '2018-02-08', '16:00:00', '18:30:00'),
(127, 1, '2018-02-15', '16:00:00', '18:30:00'),
(128, 1, '2018-02-22', '16:00:00', '18:30:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE IF NOT EXISTS `exercise` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `image` mediumtext COLLATE utf8_spanish_ci,
  `video` mediumtext COLLATE utf8_spanish_ci
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`id`, `id_user`, `name`, `description`, `type`, `image`, `video`) VALUES
(1, 1, 'Mountain Climbers', 'Para realizar los mountain climbers de manera perfecta, debemos seguir estos pasos al pie de la letra.\r\n\r\nColócate en posición de puente, como si fueses a realizar una flexión o largatija. Para ello apoya las palmas de la mano sobre el suelo al igual que las puntas de los pies. Con esta posición, el cuerpo debe simular una tabla, por lo que la espalda debe mantenerse recta en todo momento.\r\nA continuación, empezaremos a realizar las elevaciones de rodillas, procurando que estas lleguen a la altura del pecho. Haremos un levantamiento por lado, lo que cuenta como una repetición.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-09-03-ejer1.jpg"]', 'https://www.youtube.com/embed/lD_gfTofg4A'),
(2, 1, 'Aperturas con mancuerna en banco inclinado', 'Siéntate en un banco inclinado con las mancuernas a la altura del pecho.\r\n\r\nAgarra las mancuernas de modo a que las palmas de las manos queden giradas hacia adentro.\r\n\r\nLevanta las dos mancuernas, intentando juntarlas pero sin llegar a tocar cuando los brazos estén completamente extendidos. Regresa lentamente a la posición inicial.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-09-45-ejer2.jpg"]', 'https://www.youtube.com/embed/BHRGm0m6xRc'),
(3, 1, 'Press con barra en banco inclinado', 'Acostados sobre un banco inclinado en ángulo aproximado de 30 a 45°. Separad las piernas ligeramente apoyando los pies sobre el suelo. Las caderas, hombros y cabeza deben reposar sobre el banco.\r\n\r\nAgarrad una barra con agarre prono. Las manos deben estar algo más abiertas que la anchura de vuestros hombros.\r\n\r\nBajad la barra a la parte superior del pecho, tomad aire y retened el aliento cuando subáis el peso hacia el punto de partida. Dirigid los codos hacia los lados y mantenedlos así.\r\n\r\nExpulsad a medida que superéis la parte más difícil de la subida o al extender los brazos.\r\n\r\nDeteneos en la posición final con los brazos extendidos y verticales.\r\n\r\nTomad aire y retened el aliento a medida que bajéis el peso bajo control hasta la parte alta del pecho.\r\n\r\nSi preferís deteneos un instante abajo, expulsad el aire después de llegar allí, tomadlo luego y retened la respiración cuando subáis la barra.\r\n\r\nUtilizad una velocidad moderada, manteniendo siempre el peso bajo control.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-09-56-ejer3.jpg"]', 'https://www.youtube.com/embed/ICaZxO7RmKs'),
(4, 1, 'Curl con barra', 'El curl con barra es un ejercicio muy adecuado para el inicio del entrenamiento.\r\n\r\nInicio: De pie, sujetando una barra con el agarre a la anchura de los hombros y los brazos extendidos hacia abajo. Mantener las rodillas ligeramente flexionadas.\r\n\r\nManteniendo el tronco erguido (no inclinarse hacia atrás al levantar el peso), contraer los bíceps para elevar la barra. Hay que asegurarse de que los codos permanecen pegados a los costados e impedir que se desplacen hacia fuera o que se eleven. Lentamente, bajar el peso a la posición de inicio.\r\n\r\nVariaciones: Utilizar tanto una barra recta como una barra EZ para realizar este ejercicio. Algunos encuentran que ésta resta presión a las muñecas ya que las dirige\r\nen una posición neutra.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-10-06-ejer4.jpg"]', 'https://www.youtube.com/embed/uP4ug_QCad4'),
(5, 1, 'Extensiones en máquina', 'La máquina de extensión de cuadriceps nos permite trabajar el músculo cuadriceps de forma aislada y analítica.\r\n\r\nLa posición sentada permite manejar cargas elevadas sin ningún riesgo de sobrecarga en otras articulaciones.\r\n\r\nUna vez estemos sentado en la máquina debes ajustar los apoyos: el final del asiento debe coincidir con el hueco poplíteo (detrás de la rodilla) y la zona lumbar en contacto con el respaldo, finalmente regula el rodillo del brazo de palanca colocándolo al final de la tibia, en la articulación del tobillo.\r\n\r\nInicia el movimiento de extensión desde una flexión de La rodilla de 90°, no menos y realiza la extensión de la pierna hasta llegar de forma controlada a la extensión completa de la rodilla.\r\n\r\nIntenta que en este movimiento de extensión las dos piernas trabajen por igual, normalmente se tiende a realizar mas esfuerzo con la pierna dominante.', 'Estiramiento', '["resources\\/images\\/21-11-2017-19-10-18-ejer5.jpg"]', 'https://www.youtube.com/embed/1H_7SVn3lfU'),
(6, 1, 'Prensa Inclinada', 'Coloque los pies en la máquina, con las rodillas separadas a la anchura de os hombros y la punta de los pies rectas o ligeramente giradas hacia fuera. Mantenga la zona baja y media de la espalda plana contra el almohadillado del respaldo y la cabeza en posición neutra.\r\n\r\nExtienda los tobillos, rodillas y caderas. Presione con la parte media de los pies sobre la plataforma de la máquina, usando la misma presión de empuje en ambos. Detenga el movimiento justo antes de bloquear las rodillas.\r\n\r\nRegrese lentamente a la posición inicial mediante la flexión de los tobillos, rodillas y caderas.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-10-32-ejer6.jpg"]', 'https://www.youtube.com/embed/VljDsFudTok'),
(7, 1, 'Buenos días con barra y piernas separadas', 'Colocad la barra sobre los soportes de sentadilla, a nivel de los hombros, y agarradla con agarre prono, separando las manos algo más que la anchura de los hombros.\r\n\r\nAgachaos para que la barra se coloque encima de los trapecios, y luego dad dos pasos atrás, lenta y cuidadosamente.\r\n\r\nSeparad las piernas hasta empezar a sentir una ligera tirantez en los aductores y los femorales, y estirad después las piernas.\r\n\r\nElevad el pecho, tomad aire y apretad los abdominales. Mantened las rodillas ligeramente dobladas.\r\n\r\nMantened un arco natural en la espalda baja, e inclinaos lentamente hacia delante. Bajad lo posible al tiempo que mantenéis la espalda baja en su posición. (Para los que tengan los femorales rígidos puede que solo sea unos centímetros)\r\n\r\nDeteneos un instante, con traed con fuerza los femorales y volved luego al punto de partida.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-10-42-ejer7.jpg"]', 'https://www.youtube.com/embed/Ieyn5D84TPU'),
(8, 1, 'Curl de Biceps con barra editado', 'edit flexión', 'Cardiovascular', '[]', 'https://www.youtube.com/embed/a9hli15uWiA'),
(9, 1, 'Ejercicio estiramiento pierna', 'descripción 2', 'Muscular', '[]', 'https://www.youtube.com/embed/txsha7BIlDo');

-- --------------------------------------------------------

--
-- Table structure for table `exercise_table`
--

DROP TABLE IF EXISTS `exercise_table`;
CREATE TABLE IF NOT EXISTS `exercise_table` (
`id` int(11) NOT NULL,
  `id_exercise` int(11) DEFAULT NULL,
  `id_workout` int(11) DEFAULT NULL,
  `series` int(11) DEFAULT NULL,
  `repetitions` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `exercise_table`
--

INSERT INTO `exercise_table` (`id`, `id_exercise`, `id_workout`, `series`, `repetitions`, `duration`) VALUES
(1, 2, 1, 2, 5, NULL),
(2, 3, 1, 3, 6, NULL),
(3, 4, 1, 1, 10, NULL),
(4, 2, 2, 4, 5, 10),
(5, 5, 2, 2, 7, NULL),
(6, 6, 2, 2, 5, NULL),
(7, 7, 2, 2, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `title` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `content` mediumtext COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `id_user`, `date`, `title`, `content`) VALUES
(1, 1, '2017-11-21 00:00:00', 'Clase cancelada', 'La clase de zumba ha sido cancelada'),
(2, 1, '2017-11-14 00:00:00', 'Confirmar Usuario.', 'Nuevo usuario añadido a la aplicación. Por favor, confirme.'),
(3, 1, '2018-01-31 00:00:00', 'Clase de Zumba (31/01) cancelada ', 'La proxima clase de zumba del día 31 de enero se cancela por motivos personales. Se notificará la nueva fecha. \r\nMuchas gracias y diculpen las molestias.');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `notification_user`
--

INSERT INTO `notification_user` (`id`, `id_user`, `id_notification`, `viewed`) VALUES
(1, 1, 2, '2017-11-23'),
(2, 1, 3, NULL),
(3, 2, 3, NULL),
(4, 3, 3, NULL),
(5, 4, 3, NULL),
(6, 5, 3, NULL),
(7, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `public_info`
--

DROP TABLE IF EXISTS `public_info`;
CREATE TABLE IF NOT EXISTS `public_info` (
`id` int(11) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `public_info`
--

INSERT INTO `public_info` (`id`, `phone`, `email`, `address`) VALUES
(1, 649555555, 'mail@mail.com', 'Polideportivo Universitario, Campus As Lagoas, 4.º piso');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

DROP TABLE IF EXISTS `resource`;
CREATE TABLE IF NOT EXISTS `resource` (
`id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `name`, `description`, `quantity`, `type`) VALUES
(1, 'Campo de hierba sintética', 'O Campus de Ourense conta cun campo de herba sintética para a práctica do futbol (7, 8 e 11) e do rugby.', 1, 2),
(2, 'Pista de atletismo', 'O Campus de Ourense conta cunha pista de atletismo onde se poderán practicar as actividades atléticas de carreiras e saltos.', 1, 2),
(3, 'Pista polideportiva', 'O Campus de Ourense conta, no interior do pavillón universitario, cunha pista polideportiva cuberta para a práctica do baloncesto, o voleibol, o futbol sala, o balonmán e o badminton. Para calquera outro tipo de actividades será necesario solicitalo previamente no correo electrónico depor-ou@uvigo.es indicando o tipo e características da actividade que se pretende realizar', 1, 2),
(4, 'Sala cardiofitness', 'O Campus de Ourense conta, no interior do pavillón universitario, cunha sala cardio-fitness completamente equipada para o desenvolvemento de diferentes actividades de fitness.\r\nEsta sala divídese nunha zona de musculación e exercicio cardiovascular e outra onde se imparten actividades dirixidas como zumba, power dumbell, hipopresivos, stretching.', 1, 2),
(5, 'Sala de fisioterapia', 'A área de Benestar, Saúde e Deporte conta, no pavillón universitario, cunha clínica de medicina deportiva e de fisioterapia (nº de rexistro C-36-0015554) onde se realizan valoracións funcionais e tratamentos ás persoas usuarias que así­ o soliciten.', 1, 2),
(6, 'Zona de ciclo indoor', '1.- Destinatarias:Poderán acceder a esta instalación as persoas aboadas ao Servizo de Deportes ou aquelas que dispoñan dunha entrada multideporte de acceso á sala cardio fitness / pista de atletismo.\r\n2. Reserva de praza para as actividades dirixidas:Poderase reservar praza, cun máximo de 24 horas de antelación, para cada un dos dias nos que se imparta esta actividade en: Miña Conta / Histórico / Bonos-Entradas / Nova sesión).\r\n3. Uso libre das bicicletas:Cando non se estea impartindo algunha clase dirixida, poderase autorizar o uso libre das bicicletas ás persoas aboadas á área de Benestar, Saúde e Deporte ou a aquelas que dispoñan dunha entrada multideporte de acceso á sala cardio fitness / pista de atletismo', 1, 2),
(7, 'GROUP CYCLE CONNECT', 'Group Cycle Connect es la única bicicleta estática del mundo que realiza un seguimiento de la sesión deportiva, para que los usuarios puedan mejorar su rendimiento a través de una experiencia de pedaleo totalmente realista. Combina diseño único con conectividad de última generación, una sensación increí­ble y una facilidad de uso inédita.', 30, 1),
(8, 'Multiestación Weider Pro 8700', 'La Weider 8700 es un gimnasio compacto por lo que no ocupa toda la habitación pero mantiene las cualidades esenciales para un entrenamiento de calidad. \r\n\r\nTanto las poleas altas como bajas pueden usarse con los accesorios incluidos. La polea alta es perfecta para ejercicios de tracción lateral, extensiones de tríceps y abdominales crunch. La polea baja es mejor para ejercicios de remo sentado y flexiones de bíceps.', 5, 1),
(9, 'Press de Pecho Inclinado Evolution Bodytone', 'Las máquinas de musculación profesionales Evolution de Bodytone contienen todo lo necesario para equipar tu sala fitness, con más de 20 modelos que agrupan el trabajo de todo el cuerpo, desde los gemelos hasta los hombros.', 5, 1);

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
  `comment` mediumtext COLLATE utf8_spanish_ci
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `id_user`, `id_table`, `date`, `duration`, `comment`) VALUES
(1, 5, 2, '2017-11-22 12:51:00', '01:00:21', 'Productiva'),
(2, 4, 1, '2017-11-22 12:53:00', '01:01:00', 'Mejorar ejercicio2'),
(3, 5, 2, '2017-11-29 09:23:00', '01:30:03', ''),
(4, 5, 2, '2017-12-06 12:24:00', '01:00:04', ''),
(5, 5, 2, '2017-12-20 09:25:00', '00:30:01', ''),
(6, 5, 2, '2017-12-27 09:25:00', '00:45:03', ''),
(7, 5, 2, '2017-12-30 11:26:00', '01:00:00', 'Ultima del año\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `login` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `profile_image` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_type` tinyint(11) DEFAULT NULL,
  `trainer` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `email`, `phone`, `dni`, `description`, `profile_image`, `user_type`, `trainer`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'Administrador', 'asc-ou@uvigo.es', 988387102, NULL, 'Usuario Administrador de FitnesSuite.', 'profile-default.png', 1, NULL),
(2, 'afsobrino', '7bbc79e35574de3c8babe4616d9de940', 'Andrés', 'Fernández Sobrino', 'afsobrino@esei.uvigo.es', 698457129, '56987418K', 'Adestrador de FitnesSuite.', '1511286585_andres.jpg', 2, NULL),
(3, 'uxiogf', 'd1e6b388dde8639b8b8a554c42567029', 'Uxio', 'González', 'uxio.gf@gmail.com', 654124789, '32145689D', 'Adestrador de FitnesSuite.', '1511286706_Entrenador2.jpg', 2, NULL),
(4, 'iagofer', 'bceb88388a0d59cfe91791e210c106ab', 'Iago', 'Fernández', 'iago.fernandez.92@gmail.com', 654927816, '45786129R', 'Atleta TDU: con tarjeta deportiva universitaria.', '1511286808_atleta1.jpg', 3, NULL),
(5, 'spgiraldez', '8072295b39009724d108047160289130', 'Sandra', 'Pastoriza', 'sandracangas@gmail.com', 649800066, '39468127N', 'Atleta PEF: UTILIZAN PONTE EN FORMA', '1511286893_atleta2.jpg', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE IF NOT EXISTS `user_activity` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_activity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `id_user`, `id_activity`) VALUES
(1, 4, 19),
(2, 4, 20),
(3, 5, 19),
(4, 5, 20),
(7, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

DROP TABLE IF EXISTS `user_table`;
CREATE TABLE IF NOT EXISTS `user_table` (
`id` int(11) NOT NULL,
  `id_workout` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `id_workout`, `id_user`) VALUES
(1, 1, 4),
(2, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `workout_table`
--

DROP TABLE IF EXISTS `workout_table`;
CREATE TABLE IF NOT EXISTS `workout_table` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `description` mediumtext COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `workout_table`
--

INSERT INTO `workout_table` (`id`, `id_user`, `name`, `type`, `description`) VALUES
(1, 2, 'Tabla muscular', 'standard', 'Tabla con ejercicios de tipo muscular'),
(2, 3, 'Tabla muscular personalizada', 'customized', 'Tabla personalizada con ejercicios de tipo muscular'),
(3, 3, 'Tabla de ejercicios muscular standard', 'standard', '  Tabla de ejercicios nueva modificada');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`id_user`), ADD KEY `activity_ibfk_2` (`place`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `activity_resource`
--
ALTER TABLE `activity_resource`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `activity_schedule`
--
ALTER TABLE `activity_schedule`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `assistance`
--
ALTER TABLE `assistance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `exercise_table`
--
ALTER TABLE `exercise_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notification_user`
--
ALTER TABLE `notification_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `public_info`
--
ALTER TABLE `public_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `workout_table`
--
ALTER TABLE `workout_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`place`) REFERENCES `resource` (`id`);

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
ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
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
ADD CONSTRAINT `user_table_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `user_table_ibfk_2` FOREIGN KEY (`id_workout`) REFERENCES `workout_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workout_table`
--
ALTER TABLE `workout_table`
ADD CONSTRAINT `workout_table_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

GRANT ALL PRIVILEGES ON `fitnessdb` . * TO 'fitnessuser'@'localhost'  IDENTIFIED BY 'fitnesspass' ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
