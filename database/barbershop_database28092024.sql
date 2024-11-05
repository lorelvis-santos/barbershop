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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `appointmentsservices`;
CREATE TABLE `appointmentsservices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `appointmentId` int DEFAULT NULL,
  `serviceId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointmentId` (`appointmentId`),
  KEY `serviceId` (`serviceId`),
  CONSTRAINT `appointmentsservices_ibfk_3` FOREIGN KEY (`appointmentId`) REFERENCES `appointments` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `appointmentsservices_ibfk_4` FOREIGN KEY (`serviceId`) REFERENCES `services` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `availabletimes`;
CREATE TABLE `availabletimes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `roleId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roleId` (`roleId`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `appointments` (`id`, `date`, `totalPrice`, `timeId`, `userId`, `employeeId`) VALUES
(28, '2024-09-28', '600.00', 1, 5, 9);
INSERT INTO `appointments` (`id`, `date`, `totalPrice`, `timeId`, `userId`, `employeeId`) VALUES
(29, '2024-09-28', '600.00', 2, 7, 11);
INSERT INTO `appointments` (`id`, `date`, `totalPrice`, `timeId`, `userId`, `employeeId`) VALUES
(30, '2024-09-28', '600.00', 8, 7, 11);
INSERT INTO `appointments` (`id`, `date`, `totalPrice`, `timeId`, `userId`, `employeeId`) VALUES
(31, '2024-09-28', '600.00', 5, 7, 11),
(32, '2024-09-28', '600.00', 3, 6, 9),
(33, '2024-09-28', '550.00', 9, 6, 9),
(34, '2024-09-28', '650.00', 5, 8, 9),
(35, '2024-10-06', '400.00', 1, 8, 9),
(36, '2024-09-28', '600.00', 4, 8, 9),
(37, '2024-09-28', '400.00', 2, 6, 9);

INSERT INTO `appointmentsservices` (`id`, `appointmentId`, `serviceId`) VALUES
(19, 28, 1);
INSERT INTO `appointmentsservices` (`id`, `appointmentId`, `serviceId`) VALUES
(20, 28, 5);
INSERT INTO `appointmentsservices` (`id`, `appointmentId`, `serviceId`) VALUES
(21, 29, 1);
INSERT INTO `appointmentsservices` (`id`, `appointmentId`, `serviceId`) VALUES
(22, 29, 5),
(23, 30, 1),
(24, 30, 5),
(25, 31, 1),
(26, 31, 5),
(27, 32, 1),
(28, 32, 5),
(29, 33, 1),
(30, 33, 6),
(31, 34, 1),
(32, 34, 4),
(33, 34, 5),
(34, 35, 1),
(35, 36, 1),
(36, 36, 5),
(37, 37, 1);

INSERT INTO `availabletimes` (`id`, `time`) VALUES
(1, '9:00');
INSERT INTO `availabletimes` (`id`, `time`) VALUES
(2, '9:40');
INSERT INTO `availabletimes` (`id`, `time`) VALUES
(3, '10:20');
INSERT INTO `availabletimes` (`id`, `time`) VALUES
(4, '11:00'),
(5, '11:40'),
(6, '14:00'),
(7, '14:40'),
(8, '15:20'),
(9, '16:00'),
(10, '16:40'),
(11, '17:20'),
(12, '18:00'),
(13, '18:40'),
(14, '19:20'),
(15, '20:00');

INSERT INTO `employees` (`id`, `image`, `userId`, `roleId`) VALUES
(9, 'default.jpg', 5, 1);
INSERT INTO `employees` (`id`, `image`, `userId`, `roleId`) VALUES
(10, 'default.jpg', 16, 2);
INSERT INTO `employees` (`id`, `image`, `userId`, `roleId`) VALUES
(11, 'default.jpg', 7, 1);

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Barbero');
INSERT INTO `roles` (`id`, `name`) VALUES
(2, 'Manicurista');


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
(8, 'Uñas', '800.00', 2);

INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `type`, `verified`, `token`) VALUES
(1, 'Lorelvis', 'Santos', '8094069145', 'santoslorelvis@gmail.com', 'pass', 'admin', 1, '');
INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `type`, `verified`, `token`) VALUES
(4, 'Lorenzo', 'Santos', '8097290224', 'lorenzo@gmail.com', '$2y$10$p13KSymwPEj/7gpVfbTVS.s./bLRu4vZcKQ5n3GJmmkEzECsjtnPW', 'admin', 1, '');
INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `type`, `verified`, `token`) VALUES
(5, 'Bryant', 'Almonte', '8094032138', 'bryant@gmail.com', '$2y$10$Kgq2bIPGSPqNvZLg.qHT1uo1aioDujmI0UI2sgt/Th.rWson3n.ga', 'employee', 1, '');
INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `type`, `verified`, `token`) VALUES
(6, 'Marcos', 'Torres', '8097867212', 'marcost@gmail.com', '$2y$10$E3SC2RyrQVSpoKNoNFd2Fu2DszlKzL/mnMCjot8n4x/3tNHfeh2gC', 'customer', 1, ''),
(7, 'Jadiel', 'Calderón ', '8095852810', 'jadielc@gmail.com', '$2y$10$I2CJAU2sSn5kHCkyWiyLBOedfImSpZcC2Xat7di49SEfe/WxtbP3m', 'employee', 1, ''),
(8, 'Elvis', 'Santos', '8094059828', 'lorelvis23@gmail.com', '$2y$10$IBCi6dbLBs/i8w5msAHX1Oxn05N.2JJ4Oi36dNsRv9Vok3b4EU8zS', 'customer', 1, ''),
(9, 'Rayan', 'Ramírez', '8095859212', 'rayanr@gmail.com', '$2y$10$6n3nsbBVSi7AZqZD8NdQbeEuJjn6Fw8lnfIc8Y1cgut6XHu9CKzSe', 'customer', 1, ''),
(10, 'Rayan', 'Ramirez', '8297295224', 'rayanrr18110@gmail.com', '$2y$10$SIyAG6tG/g19FRHs6ImvR.tg9fAvpE6Pzzzf50rl02eWlkxWYuOjG', 'customer', 1, ''),
(11, 'Pablo', 'Trejo', '8095858213', 'pablotrejo@gmail.com', '$2y$10$tFGRy9Hxttkodb9gyBZzZOrZ360E4zzKlf9ky7iCpF0/5tDcywKRe', 'customer', 1, ''),
(12, 'Pablo', 'Trejo', '8095858213', 'prueba123@gmail.com', '$2y$10$3DQrYcWlIDxzyKT.xxKNdu9NHZ.XIVsPKui/159cD5fvTuedjQfou', 'customer', 0, '66d7a49623615'),
(13, 'Alexander', 'Severino', '8092538696', 'alex@eljefe.com', '$2y$10$1pumqNBjSt9xIwzSfQV1KeCwG6nBPtjMyxHdrIpvXIhjuM.gRpri2', 'customer', 1, ''),
(14, 'Deury', 'Ross', '8094069145', 'deuryross@gmail.com', '$2y$10$v1tIv1.iZz7Ulpr5pKzqcOqCqqn1Uj8FI50cj70FCzrOfH0nftu4a', 'customer', 1, ''),
(15, 'Marcos', 'Pereira', '8095852810', 'marcosp@gmail.com', '$2y$10$eFsXlb5vak1b4MIgBlu7S.wP5wGp0aePhARtanLVAIwe4zieBApe6', 'customer', 1, ''),
(16, 'Maria', 'Perez', '8094842838', 'maria@gmail.com', '$2y$10$/8NljU.yTiaIMu2Utv4a7Oupmtb6g32uGf8wQRoGkbIe7EE1K7oti', 'employee', 1, '');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;