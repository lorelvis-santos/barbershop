/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `totalPrice` decimal(5,2) DEFAULT NULL,
  `timeId` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `employeeId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `timeId` (`timeId`),
  KEY `employeeId` (`employeeId`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`timeId`) REFERENCES `availabletimes` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`employeeId`) REFERENCES `employees` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `appointmentsservices`;
CREATE TABLE `appointmentsservices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `appointmentId` int DEFAULT NULL,
  `serviceId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointmentId` (`appointmentId`),
  KEY `serviceId` (`serviceId`),
  CONSTRAINT `appointmentsservices_ibfk_5` FOREIGN KEY (`appointmentId`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `appointmentsservices_ibfk_6` FOREIGN KEY (`serviceId`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `availabletimes`;
CREATE TABLE `availabletimes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `roleId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `roleId` (`roleId`),
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `roleId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roleId` (`roleId`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `token` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `appointments` (`id`, `date`, `totalPrice`, `timeId`, `userId`, `employeeId`) VALUES
(57, '2024-11-03', '400.00', 2, 8, 9);
INSERT INTO `appointments` (`id`, `date`, `totalPrice`, `timeId`, `userId`, `employeeId`) VALUES
(60, '2024-11-10', '400.00', 4, 17, 12);
INSERT INTO `appointments` (`id`, `date`, `totalPrice`, `timeId`, `userId`, `employeeId`) VALUES
(64, '2024-11-03', '400.00', 5, 6, 9);
INSERT INTO `appointments` (`id`, `date`, `totalPrice`, `timeId`, `userId`, `employeeId`) VALUES
(67, '2024-11-03', '400.00', 1, 8, 9),
(70, '2024-11-04', '400.00', 1, 30, 9);

INSERT INTO `appointmentsservices` (`id`, `appointmentId`, `serviceId`) VALUES
(57, 57, 1);
INSERT INTO `appointmentsservices` (`id`, `appointmentId`, `serviceId`) VALUES
(60, 60, 1);
INSERT INTO `appointmentsservices` (`id`, `appointmentId`, `serviceId`) VALUES
(64, 64, 1);
INSERT INTO `appointmentsservices` (`id`, `appointmentId`, `serviceId`) VALUES
(67, 67, 1),
(70, 70, 1);

INSERT INTO `availabletimes` (`id`, `time`) VALUES
(1, '09:00:00');
INSERT INTO `availabletimes` (`id`, `time`) VALUES
(2, '09:40:00');
INSERT INTO `availabletimes` (`id`, `time`) VALUES
(3, '10:20:00');
INSERT INTO `availabletimes` (`id`, `time`) VALUES
(4, '11:00:00'),
(5, '11:40:00'),
(6, '14:00:00'),
(7, '14:40:00'),
(8, '15:20:00'),
(9, '16:00:00'),
(10, '16:40:00'),
(11, '17:20:00'),
(12, '18:00:00'),
(13, '18:40:00'),
(14, '19:20:00'),
(15, '20:00:00');

INSERT INTO `employees` (`id`, `image`, `userId`, `roleId`) VALUES
(9, 'default.jpg', 5, 1);
INSERT INTO `employees` (`id`, `image`, `userId`, `roleId`) VALUES
(10, 'default.jpg', 16, 2);
INSERT INTO `employees` (`id`, `image`, `userId`, `roleId`) VALUES
(11, 'default.jpg', 7, 1);
INSERT INTO `employees` (`id`, `image`, `userId`, `roleId`) VALUES
(12, 'default.jpg', 4, 1),
(15, 'default.jpg', 11, 11),
(16, 'default.jpg', 9, 1);

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Barbero');
INSERT INTO `roles` (`id`, `name`) VALUES
(2, 'Manicurista');
INSERT INTO `roles` (`id`, `name`) VALUES
(11, 'Pedicurista');

INSERT INTO `services` (`id`, `name`, `price`, `roleId`) VALUES
(1, 'Corte para hombres', '400.00', 1);
INSERT INTO `services` (`id`, `name`, `price`, `roleId`) VALUES
(2, 'Corte para niños', '300.00', 1);
INSERT INTO `services` (`id`, `name`, `price`, `roleId`) VALUES
(3, 'Cerquillo', '150.00', 1);
INSERT INTO `services` (`id`, `name`, `price`, `roleId`) VALUES
(4, 'Arreglo de cejas', '50.00', 1),
(5, 'Arreglo de barba', '200.00', 1),
(6, 'Tinte de barba', '150.00', 1),
(7, 'Tratamiento capilar', '150.00', 1),
(8, 'Uñas', '850.00', 2),
(27, 'Corte de uñas', '400.00', 11);

INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `type`, `verified`, `token`) VALUES
(1, 'Lorelvis', 'Santos', '8094069145', 'santoslorelvis@gmail.com', '$2y$10$eZqOfzN3mwWYaczI2XVjP..KcM5kgtrN/wYohGho8znTot7GRuuo.', 'admin', 1, '');
INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `type`, `verified`, `token`) VALUES
(4, 'Lorenzo', 'Santos', '8094341224', 'lorenzo@gmail.com', '$2y$10$p13KSymwPEj/7gpVfbTVS.s./bLRu4vZcKQ5n3GJmmkEzECsjtnPW', 'admin', 1, '');
INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `type`, `verified`, `token`) VALUES
(5, 'Bryant', 'Almonte', '8094032138', 'bryant@gmail.com', '$2y$10$Kgq2bIPGSPqNvZLg.qHT1uo1aioDujmI0UI2sgt/Th.rWson3n.ga', 'employee', 1, '');
INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `type`, `verified`, `token`) VALUES
(6, 'Marcos', 'Torres', '8097867212', 'marcost@gmail.com', '$2y$10$E3SC2RyrQVSpoKNoNFd2Fu2DszlKzL/mnMCjot8n4x/3tNHfeh2gC', 'customer', 1, ''),
(7, 'Jadiel', 'Calderón', '8093822304', 'jadielc@gmail.com', '$2y$10$B4wf60e2vwOuBkW4A4FyD.nFFdOQCK18VEg0lkIVFu.qEjI/fQIRS', 'employee', 1, ''),
(8, 'Elvis', 'Santos', '8094059828', 'lorelvis23@gmail.com', '$2y$10$IBCi6dbLBs/i8w5msAHX1Oxn05N.2JJ4Oi36dNsRv9Vok3b4EU8zS', 'customer', 1, ''),
(9, 'Rayan', 'Ramírez', '8095859212', 'rayanr@gmail.com', '$2y$10$6n3nsbBVSi7AZqZD8NdQbeEuJjn6Fw8lnfIc8Y1cgut6XHu9CKzSe', 'employee', 1, ''),
(11, 'Pablo', 'Trejo', '8095858213', 'pablotrejo@gmail.com', '$2y$10$tFGRy9Hxttkodb9gyBZzZOrZ360E4zzKlf9ky7iCpF0/5tDcywKRe', 'employee', 1, ''),
(13, 'Alexander', 'Severino', '8092538696', 'alex@eljefe.com', '$2y$10$1pumqNBjSt9xIwzSfQV1KeCwG6nBPtjMyxHdrIpvXIhjuM.gRpri2', 'customer', 1, ''),
(14, 'Deury', 'Ross', '8094069145', 'deuryross@gmail.com', '$2y$10$v1tIv1.iZz7Ulpr5pKzqcOqCqqn1Uj8FI50cj70FCzrOfH0nftu4a', 'customer', 1, ''),
(15, 'Marcos', 'Pereira', '8095852810', 'marcosp@gmail.com', '$2y$10$eFsXlb5vak1b4MIgBlu7S.wP5wGp0aePhARtanLVAIwe4zieBApe6', 'customer', 1, ''),
(16, 'Maria', 'Perez', '8094842838', 'maria@gmail.com', '$2y$10$/8NljU.yTiaIMu2Utv4a7Oupmtb6g32uGf8wQRoGkbIe7EE1K7oti', 'employee', 1, ''),
(17, 'Pedro Luis', 'Cruz Custodio', '8092832250', 'pedroluiscruz1206@gmail.com', '$2y$10$9PO9uoVSz6dcKBIJKEl8Pu5W424hxq8xFMBGl54gJRDMv0gygU97W', 'customer', 1, ''),
(18, 'Alexander', 'Severino', '8292656800', 'severino24xr@gmail.com', '$2y$10$qKUbc4QytQgobBbFfrVUX.XnwuNqq6KILGdCj6f8tnjpYIsoqbwUm', 'customer', 1, ''),
(19, 'Juana', 'Nuñez', '8095859323', 'juana@gmail.com', '$2y$10$.ty8cM61P8.Z/wBhfFZoPu/tZRx0G4AKLzcEbt5vPUH9BqN9DjiMq', 'customer', 0, '6725d8bc50943'),
(20, 'Fredelina', 'Estevez', '8093846782', 'fredelina@gmail.com', '$2y$10$.7g/owSbknGVaEU6aBbE6.VumVrT7QbkC8373wga69QUU3xZBdaL6', 'customer', 0, '6725da62dc7cb'),
(21, 'Justin', 'Almonte', '8098321234', 'justin@gmail.com', '$2y$10$fYlKxNLMieW8GkIinfHQQOJIRbGKIggae/gUl3jv4.8bhee00/Dpy', 'customer', 1, ''),
(22, 'Aslhy', 'Marcelle', '8094832831', 'aslhy@gmail.com', '$2y$10$zT8UB5bj/NA4JvWm05ggmuEMGJAxlRdHoOjjt4O32xcw0rPltqwPu', 'customer', 1, ''),
(23, 'Khristina', 'Torres', '8099832912', 'khristina@gmail.com', '$2y$10$pnciapPviu9EZwQ5KO5uzOhcmkHTZQfd7ZfZUOBoGyoqGU0oihMe2', 'customer', 1, ''),
(24, 'Airon', 'Torres', '8092382121', 'airon@gmail.com', '$2y$10$TDJeT29Kk9750f6Dq7b8QO1G1TlefHSBgqLSDHnTkhjgcCw5x9GOe', 'customer', 1, ''),
(26, 'Jhanfrelis', 'Silverio Batista', '8297131088', 'jhanfrelis.silverio@gmail.com', '$2y$10$scggEnoIprYQliGjoEXPd.IHbFdtKNOBzwUMJ.gmNP/uNO1UjJC8S', 'customer', 1, ''),
(28, 'Bryant', 'Almonte', '7869160229', 'bryantalmonte6@gmail.co', '$2y$10$uYdlt0fz.qjeyAKzbUMxT.I31JJXMUIKrmd2FQCpqlylRMHpHNuU.', 'customer', 0, '672827b4d2a43'),
(30, 'Mariangel', 'Grullón', '8092441909', 'mariangel@gmail.com', '$2y$10$C/rsjssNzcua6B/UJMAyT.bh4VNROEjrPhpkIGVQENnCyI9m9CVLq', 'customer', 1, '');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;