CREATE DATABASE  IF NOT EXISTS `fitnessdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;; 
USE `fitnessdb`;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `activity` (`id`, `id_user`, `name`, `description`, `type`, `place`, `seats`, `image`) VALUES
(1, 2, 'Atletismo Entrada individual', 'O Campus de Ourense conta cunha pista de atletismo onde se poderán practicar as actividades atléticas de carreiras e saltos.', 1, 2, 20, '["resources\\/images\\/21-11-2017-18-59-39-atletismo.jpg"]'),
(2, 2, 'Bailes', '1.- Destinatarias:Persoas con abono Muver, abono ponte en Forma ou cunha entrada multideporte.', 2, 4, 30, '["resources\\/images\\/21-11-2017-19-02-03-pic10.jpg"]'),
(3, 3, 'Ciclo indoor', 'Horario e duración da actividade:\\r\\nImpartiranse catro clases semanais desta actividade dende o 2 de novembro ao 31 de maio (agás periodos non lectivos) nos seguintes horarios:\\r\\n- Luns, martes, mércores e xoves de 21:15 a 22:15 h.', 2, 6, 24, '["resources\\/images\\/21-11-2017-19-03-45-pic3.jpg"]'),
(4, 2, 'Circuit Fit', 'Horario e duración da actividade:Impartiranse dúas clases semanais desta actividade dende o 2 de outubro ao 31 de maio (agás nos periodos non lectivos) no seguinte horario:\\r\\n- Luns e mércores de 19:15 a 20:15 h', 2, 4, 30, NULL),
(5, 3, 'Voleibol Iniciación', '1. Descrición da actividade:Iniciación o deporte de volei pista. ', 2, 3, 30, '["resources\\/images\\/21-11-2017-19-05-36-voleibol.jpg"]'),
(6, 3, 'Zumba', ' Horario e duración da actividade:Impartirase dúas clases semanais desta actividade dende o 23 de outubro e o 31 de maio (agás nos periodos non lectivos) no seguinte horario:\\r\\n- Martes e xoves de 20:15 a 21:15 h.', 2, 4, 30, '["resources\\/images\\/21-11-2017-19-17-00-zumba2.jpg"]'),
(7, 2, 'Sala CardioFitness Entrada Individual', 'O Campus de Ourense conta, no interior do pavillón universitario, cunha sala cardio-fitness completamente equipada para o desenvolvemento de diferentes actividades de fitness.', 1, 4, 60, '["resources\\/images\\/21-11-2017-19-06-55-pic9.jpg","resources\\/images\\/21-11-2017-19-06-55-pic16.jpg","resources\\/images\\/21-11-2017-19-06-55-single_class.jpg"]');


DROP TABLE IF EXISTS `activity_resource`;
CREATE TABLE `activity_resource` (
  `id` int(11) NOT NULL,
  `id_activity` int(11) DEFAULT NULL,
  `id_resource` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `activity_resource` (`id`, `id_activity`, `id_resource`, `quantity`) VALUES
(1, 3, 7, 15),
(2, 7, 8, 5),
(3, 7, 9, 5),
(4, 7, 7, 15);

DROP TABLE IF EXISTS `activity_schedule`;
CREATE TABLE `activity_schedule` (
  `id` int(11) NOT NULL,
  `id_activity` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `start_hour` time NOT NULL,
  `end_hour` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `activity_schedule` (`id`, `id_activity`, `date`, `start_hour`, `end_hour`) VALUES
(1, 6, '2017-11-21', '18:30:00', '19:30:00'),
(2, 6, '2017-11-28', '18:30:00', '19:30:00'),
(3, 6, '2017-12-05', '18:30:00', '19:30:00'),
(4, 6, '2017-12-12', '18:30:00', '19:30:00'),
(5, 6, '2017-12-19', '18:30:00', '19:30:00'),
(6, 6, '2017-12-26', '18:30:00', '19:30:00'),
(7, 6, '2018-01-02', '18:30:00', '19:30:00'),
(8, 6, '2018-01-09', '18:30:00', '19:30:00'),
(9, 6, '2018-01-16', '18:30:00', '19:30:00'),
(10, 5, '2017-11-21', '18:30:00', '19:30:00'),
(11, 5, '2017-11-28', '18:30:00', '19:30:00'),
(12, 5, '2017-12-05', '18:30:00', '19:30:00'),
(13, 5, '2017-12-12', '18:30:00', '19:30:00'),
(14, 5, '2017-12-19', '18:30:00', '19:30:00'),
(15, 5, '2017-12-26', '18:30:00', '19:30:00'),
(16, 5, '2018-01-02', '18:30:00', '19:30:00'),
(17, 5, '2018-01-09', '18:30:00', '19:30:00'),
(18, 5, '2018-01-16', '18:30:00', '19:30:00'),
(19, 7, '2017-09-01', '08:30:00', '23:00:00'),
(20, 7, '2017-09-08', '08:30:00', '23:00:00'),
(21, 7, '2017-09-15', '08:30:00', '23:00:00'),
(22, 7, '2017-09-22', '08:30:00', '23:00:00'),
(23, 7, '2017-09-29', '08:30:00', '23:00:00'),
(24, 7, '2017-10-06', '08:30:00', '23:00:00'),
(25, 7, '2017-10-13', '08:30:00', '23:00:00'),
(26, 7, '2017-10-20', '08:30:00', '23:00:00'),
(27, 7, '2017-10-27', '08:30:00', '23:00:00'),
(28, 7, '2017-11-03', '08:30:00', '23:00:00'),
(29, 7, '2017-11-10', '08:30:00', '23:00:00'),
(30, 7, '2017-11-17', '08:30:00', '23:00:00'),
(31, 7, '2017-11-24', '08:30:00', '23:00:00'),
(32, 7, '2017-12-01', '08:30:00', '23:00:00'),
(33, 7, '2017-12-08', '08:30:00', '23:00:00'),
(34, 7, '2017-12-15', '08:30:00', '23:00:00'),
(35, 7, '2017-12-22', '08:30:00', '23:00:00'),
(36, 7, '2017-12-29', '08:30:00', '23:00:00'),
(37, 7, '2018-01-05', '08:30:00', '23:00:00'),
(38, 7, '2018-01-12', '08:30:00', '23:00:00'),
(39, 7, '2018-01-19', '08:30:00', '23:00:00'),
(40, 1, '2017-09-01', '08:30:00', '23:00:00'),
(41, 1, '2017-09-08', '08:30:00', '23:00:00'),
(42, 1, '2017-09-15', '08:30:00', '23:00:00'),
(43, 1, '2017-09-22', '08:30:00', '23:00:00'),
(44, 1, '2017-09-29', '08:30:00', '23:00:00'),
(45, 1, '2017-10-06', '08:30:00', '23:00:00'),
(46, 1, '2017-10-13', '08:30:00', '23:00:00'),
(47, 1, '2017-10-20', '08:30:00', '23:00:00'),
(48, 1, '2017-10-27', '08:30:00', '23:00:00'),
(49, 1, '2017-11-03', '08:30:00', '23:00:00'),
(50, 1, '2017-11-10', '08:30:00', '23:00:00'),
(51, 1, '2017-11-17', '08:30:00', '23:00:00'),
(52, 1, '2017-11-24', '08:30:00', '23:00:00'),
(53, 1, '2017-12-01', '08:30:00', '23:00:00'),
(54, 1, '2017-12-08', '08:30:00', '23:00:00'),
(55, 1, '2017-12-15', '08:30:00', '23:00:00'),
(56, 1, '2017-12-22', '08:30:00', '23:00:00'),
(57, 1, '2017-12-29', '08:30:00', '23:00:00'),
(58, 1, '2018-01-05', '08:30:00', '23:00:00'),
(59, 1, '2018-01-12', '08:30:00', '23:00:00'),
(60, 1, '2018-01-19', '08:30:00', '23:00:00');


DROP TABLE IF EXISTS `assistance`;
CREATE TABLE `assistance` (
  `id` int(11) NOT NULL,
  `id_userActivity` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `assist` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE `exercise` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `image` mediumtext,
  `video` mediumtext
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `exercise` (`id`, `id_user`, `name`, `description`, `type`, `image`, `video`) VALUES
(1, 1, 'Mountain Climbers', 'Para realizar los mountain climbers de manera perfecta, debemos seguir estos pasos al pie de la letra.\r\n\r\nColócate en posición de puente, como si fueses a realizar una flexión o largatija. Para ello apoya las palmas de la mano sobre el suelo al igual que las puntas de los pies. Con esta posición, el cuerpo debe simular una tabla, por lo que la espalda debe mantenerse recta en todo momento.\r\nA continuación, empezaremos a realizar las elevaciones de rodillas, procurando que estas lleguen a la altura del pecho. Haremos un levantamiento por lado, lo que cuenta como una repetición.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-09-03-ejer1.jpg"]', 'https://www.youtube.com/watch?time_continue=1&v=lD_gfTofg4A'),
(2, 1, 'Aperturas con mancuerna en banco inclinado', 'Siéntate en un banco inclinado con las mancuernas a la altura del pecho.\r\n\r\nAgarra las mancuernas de modo a que las palmas de las manos queden giradas hacia adentro.\r\n\r\nLevanta las dos mancuernas, intentando juntarlas pero sin llegar a tocar cuando los brazos estén completamente extendidos. Regresa lentamente a la posición inicial.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-09-45-ejer2.jpg"]', ''),
(3, 1, 'Press con barra en banco inclinado', 'Acostados sobre un banco inclinado en ángulo aproximado de 30 a 45°. Separad las piernas ligeramente apoyando los pies sobre el suelo. Las caderas, hombros y cabeza deben reposar sobre el banco.\r\n\r\nAgarrad una barra con agarre prono. Las manos deben estar algo más abiertas que la anchura de vuestros hombros.\r\n\r\nBajad la barra a la parte superior del pecho, tomad aire y retened el aliento cuando subáis el peso hacia el punto de partida. Dirigid los codos hacia los lados y mantenedlos así.\r\n\r\nExpulsad a medida que superéis la parte más difícil de la subida o al extender los brazos.\r\n\r\nDeteneos en la posición final con los brazos extendidos y verticales.\r\n\r\nTomad aire y retened el aliento a medida que bajéis el peso bajo control hasta la parte alta del pecho.\r\n\r\nSi preferís deteneos un instante abajo, expulsad el aire después de llegar allí, tomadlo luego y retened la respiración cuando subáis la barra.\r\n\r\nUtilizad una velocidad moderada, manteniendo siempre el peso bajo control.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-09-56-ejer3.jpg"]', ''),
(4, 1, 'Curl con barra', 'El curl con barra es un ejercicio muy adecuado para el inicio del entrenamiento.\r\n\r\nInicio: De pie, sujetando una barra con el agarre a la anchura de los hombros y los brazos extendidos hacia abajo. Mantener las rodillas ligeramente flexionadas.\r\n\r\nManteniendo el tronco erguido (no inclinarse hacia atrás al levantar el peso), contraer los bíceps para elevar la barra. Hay que asegurarse de que los codos permanecen pegados a los costados e impedir que se desplacen hacia fuera o que se eleven. Lentamente, bajar el peso a la posición de inicio.\r\n\r\nVariaciones: Utilizar tanto una barra recta como una barra EZ para realizar este ejercicio. Algunos encuentran que ésta resta presión a las muñecas ya que las dirige\r\nen una posición neutra.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-10-06-ejer4.jpg"]', ''),
(5, 1, 'Extensiones en máquina', 'La máquina de extensión de cuadriceps nos permite trabajar el músculo cuadriceps de forma aislada y analítica.\r\n\r\nLa posición sentada permite manejar cargas elevadas sin ningún riesgo de sobrecarga en otras articulaciones.\r\n\r\nUna vez estemos sentado en la máquina debes ajustar los apoyos: el final del asiento debe coincidir con el hueco poplíteo (detrás de la rodilla) y la zona lumbar en contacto con el respaldo, finalmente regula el rodillo del brazo de palanca colocándolo al final de la tibia, en la articulación del tobillo.\r\n\r\nInicia el movimiento de extensión desde una flexión de La rodilla de 90°, no menos y realiza la extensión de la pierna hasta llegar de forma controlada a la extensión completa de la rodilla.\r\n\r\nIntenta que en este movimiento de extensión las dos piernas trabajen por igual, normalmente se tiende a realizar mas esfuerzo con la pierna dominante.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-10-18-ejer5.jpg"]', ''),
(6, 1, 'Prensa Inclinada', 'Coloque los pies en la máquina, con las rodillas separadas a la anchura de os hombros y la punta de los pies rectas o ligeramente giradas hacia fuera. Mantenga la zona baja y media de la espalda plana contra el almohadillado del respaldo y la cabeza en posición neutra.\r\n\r\nExtienda los tobillos, rodillas y caderas. Presione con la parte media de los pies sobre la plataforma de la máquina, usando la misma presión de empuje en ambos. Detenga el movimiento justo antes de bloquear las rodillas.\r\n\r\nRegrese lentamente a la posición inicial mediante la flexión de los tobillos, rodillas y caderas.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-10-32-ejer6.jpg"]', ''),
(7, 1, 'Buenos días con barra y piernas separadas', 'Colocad la barra sobre los soportes de sentadilla, a nivel de los hombros, y agarradla con agarre prono, separando las manos algo más que la anchura de los hombros.\r\n\r\nAgachaos para que la barra se coloque encima de los trapecios, y luego dad dos pasos atrás, lenta y cuidadosamente.\r\n\r\nSeparad las piernas hasta empezar a sentir una ligera tirantez en los aductores y los femorales, y estirad después las piernas.\r\n\r\nElevad el pecho, tomad aire y apretad los abdominales. Mantened las rodillas ligeramente dobladas.\r\n\r\nMantened un arco natural en la espalda baja, e inclinaos lentamente hacia delante. Bajad lo posible al tiempo que mantenéis la espalda baja en su posición. (Para los que tengan los femorales rígidos puede que solo sea unos centímetros)\r\n\r\nDeteneos un instante, con traed con fuerza los femorales y volved luego al punto de partida.', 'Cardiovascular', '["resources\\/images\\/21-11-2017-19-10-42-ejer7.jpg"]', '');



DROP TABLE IF EXISTS `exercise_table`;
CREATE TABLE `exercise_table` (
  `id` int(11) NOT NULL,
  `id_exercise` int(11) DEFAULT NULL,
  `id_workout` int(11) DEFAULT NULL,
  `series` int(11) DEFAULT NULL,
  `repetitions` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `exercise_table` (`id`, `id_exercise`, `id_workout`, `series`, `repetitions`) VALUES
(1, 2, 1, 2, 5),
(2, 3, 1, 3, 6),
(3, 4, 1, 1, 10),
(4, 2, 2, 4, 5),
(5, 5, 2, 2, 7),
(6, 6, 2, 2, 5),
(7, 7, 2, 2, 6);


DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `notification` (`id`, `id_user`, `date`, `title`, `content`) VALUES
(1, 1, '2017-11-21 00:00:00', 'Clase cancelada', 'La clase de zumba ha sido cancelada'),
(2, 1, '2017-11-14 00:00:00', 'Confirm User.', 'New user added to the app, please, confirm.');

DROP TABLE IF EXISTS `notification_user`;
CREATE TABLE `notification_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_notification` int(11) DEFAULT NULL,
  `viewed` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `notification_user` (`id`, `id_user`, `id_notification`, `viewed`) VALUES
(1, 1, 2, '2017-11-23');


DROP TABLE IF EXISTS `public_info`;
CREATE TABLE `public_info` (
  `id` int(11) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `public_info` (`id`, `phone`, `email`, `address`) VALUES
(1, 649555555, 'mail@mail.com', 'descriptuoin');

DROP TABLE IF EXISTS `resource`;
CREATE TABLE `resource` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `resource` (`id`, `name`, `description`, `quantity`, `type`) VALUES
(1, 'Campo de herba sintÃ©tica', 'O Campus de Ourense conta cun campo de herba sintÃ©tica para a prÃ¡ctica do fÃºtbol (7, 8 e 11) e do rugby.', 1, 2),
(2, 'Pista de atletismo', 'O Campus de Ourense conta cunha pista de atletismo onde se poderÃ¡n practicar as actividades atlÃ©ticas de carreiras e saltos.', 1, 2),
(3, 'Pista polideportiva', 'O Campus de Ourense conta, no interior do pavillÃ³n universitario, cunha pista polideportiva cuberta para a prÃ¡ctica do baloncesto, o voleibol, o fÃºtbol sala, o balonmÃ¡n e o bÃ¡dminton. Para calquera outro tipo de actividades serÃ¡ necesario solicitalo previamente no correo electrÃ³nico depor-ou@uvigo.es indicando o tipo e caracterÃ­sticas da actividade que se pretende realizar', 1, 2),
(4, 'Sala cardio-fitness', 'O Campus de Ourense conta, no interior do pavillÃ³n universitario, cunha sala cardio-fitness completamente equipada para o desenvolvemento de diferentes actividades de fitness.\r\nEsta sala divÃ­dese nunha zona de musculaciÃ³n e exercicio cardiovascular e outra onde se imparten actividades dirixidas como zumba, power dumbell, hipopresivos, stretching.', 1, 2),
(5, 'Sala de fisioterapia', 'A Ãrea de Benestar, SaÃºde e Deporte conta, no pavillÃ³n universitario, cunha clÃ­nica de medicina deportiva e de fisioterapia (nÂº de rexistro C-36-0015554) onde se realizan valoraciÃ³ns funcionais e tratamentos Ã¡s persoas usuarias que asÃ­ o soliciten.', 1, 2),
(6, 'Zona de ciclo indoor', '1.- Destinatarias:PoderÃ¡n acceder a esta instalaciÃ³n as persoas aboadas ao Servizo de Deportes ou aquelas que dispoÃ±an unha entrada multideporte de acceso Ã¡ sala cardio fitness / pista de atletismo.\r\n2. Reserva de praza para as actividades dirixidas:Poderase reservar praza, cun mÃ¡ximo de 24 horas de antelaciÃ³n, para cada un dos dias nos que se imparta esta actividade en: MiÃ±a Conta / HistÃ³rico / Bonos-Entradas / Nova sesiÃ³n).\r\n3. Uso libre das bicicletas:Cando non se estea impartindo algunha clase dirixida, poderase autorizar o uso libre das bicicletas Ã¡s persoas aboadas Ã¡ Ãrea de Benestar, SaÃºde e Deporte ou a aquelas que dispoÃ±an dunha entrada multideporte de acceso Ã¡ sala cardio fitness / pista de atletismo', 1, 2),
(7, 'GROUP CYCLE CONNECT', 'Group Cycleâ„¢ Connect es la Ãºnica bicicleta estÃ¡tica del mundo que realiza un seguimiento de la sesiÃ³n deportiva, para que los usuarios puedan mejorar su rendimiento a travÃ©s de una experiencia de pedaleo totalmente realista. Combina diseÃ±o Ãºnico con conectividad de Ãºltima generaciÃ³n, una sensaciÃ³n increÃ­ble y una facilidad de uso inÃ©dita.', 30, 1),
(8, 'MultiestaciÃ³n Weider Pro 8700', 'La Weider 8700 es un gimnasio compacto por lo que no ocupa toda la habitaciÃ³n pero mantiene las cualidades esenciales para un entrenamiento de calidad. \r\n\r\nTanto las poleas altas como bajas pueden usarse con los accesorios incluidos. La polea alta es perfecta para ejercicios de tracciÃ³n lateral, extensiones de trÃ­ceps y abdominales crunch. La polea baja es mejor para ejercicios de remo sentado y flexiones de bÃ­ceps.', 5, 1),
(9, 'Press de Pecho Inclinado Evolution Bodytone', 'Las mÃ¡quinas de musculaciÃ³n profesionales Evolution de Bodytone contienen todo lo necesario para equipar tu sala fitness, con mÃ¡s de 20 modelos que agrupan el trabajo de todo el cuerpo, desde los gemelos hasta los hombros.', 5, 1);


DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_table` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `duration` time NOT NULL,
  `comment` mediumtext
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `session` (`id`, `id_user`, `id_table`, `date`, `duration`, `comment`) VALUES
(1, 5, 2, '2017-11-22 12:51:00', '01:00:21', 'Productiva'),
(2, 4, 1, '2017-11-22 12:53:00', '01:01:00', 'Mejorar ejercicio2');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `profile_image` varchar(50) DEFAULT NULL,
  `user_type` tinyint(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `email`, `phone`, `dni`, `description`, `profile_image`, `user_type`) VALUES
(1, 'admin', 'admin', 'Administrador', 'Administrador', 'asc-ou@uvigo.es', 988387102, NULL, 'Usuario Administrador de FitnesSuite.', 'profile-default.png', 1),
(2, 'afsobrino', 'afsobrino', 'Andrés', 'Fernández Sobrino', 'afsobrino@esei.uvigo.es', 698457129, '56987418K', '', '1511286585_andres.jpg', 2),
(3, 'uxiogf', 'uxiogf', 'Uxio', 'González', 'uxio.gf@gmail.com', 654124789, '32145689D', 'Adesttrador de FitnesSuite.', '1511286706_Entrenador2.jpg', 2),
(4, 'iagofer', 'iagofer', 'Iago', 'Fernández', 'iago.fernandez.92@gmail.com', 654927816, '45786129R', 'Atleta TDU: con tarjeta deportiva universitaria.', '1511286808_atleta1.jpg', 3),
(5, 'spgiraldez', 'spgiraldez', 'Sandra', 'Pastoriza', 'sandracangas@gmail.com', 649800066, '39468127N', 'Atleta PEF: UTILIZAN PONTE EN FORMA', '1511286893_atleta2.jpg', 4);


DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_activity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `user_activity` (`id`, `id_user`, `id_activity`) VALUES
(1, 4, 19),
(2, 4, 20),
(3, 5, 19),
(4, 5, 20);


DROP TABLE IF EXISTS `user_table`;
CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `id_workout` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `user_table` (`id`, `id_workout`, `id_user`) VALUES
(1, 1, 4),
(2, 2, 5);


DROP TABLE IF EXISTS `workout_table`;
CREATE TABLE `workout_table` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE utf8_spanish_ci;

INSERT INTO `workout_table` (`id`, `id_user`, `name`, `type`, `description`) VALUES
(1, 2, 'Tabla muscular', 'standard', 'Tabla con ejercicios de tipo muscular'),
(2, 3, 'Tabla muscular personalizada', 'customized', 'Tabla personalizada con ejercicios de tipo muscular');


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
 MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
ALTER TABLE `activity_resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `activity_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
ALTER TABLE `assistance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `exercise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
ALTER TABLE `exercise_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `notification_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `public_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `workout_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

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

CREATE USER 'fitnessuser'@'localhost' IDENTIFIED BY 'fitnesspass' ;
GRANT USAGE ON *.* TO 'fitnessuser'@'localhost';
GRANT ALL PRIVILEGES ON `fitnessdb` . * TO 'fitnessuser'@'localhost' ;
