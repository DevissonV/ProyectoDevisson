-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.36-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para boletos
CREATE DATABASE IF NOT EXISTS `boletos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `boletos`;

-- Volcando estructura para tabla boletos.reservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `date_reservation` date DEFAULT NULL,
  `date_update` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reserva`),
  UNIQUE KEY `id_ticket` (`id_ticket`),
  KEY `FK_usuario` (`id_user`),
  CONSTRAINT `FK_boleto` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id_ticket`),
  CONSTRAINT `FK_usuario` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla boletos.reservations: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` (`id_reserva`, `id_ticket`, `id_user`, `date_reservation`, `date_update`) VALUES
	(22, 6, 11, '2020-10-21', '2020-10-19 09:01:55'),
	(23, 14, 11, '2020-10-19', '2020-10-19 09:02:01');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;

-- Volcando estructura para tabla boletos.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `state` int(2) DEFAULT '1' COMMENT '1= disponible 0= reservado',
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla boletos.tickets: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` (`id_ticket`, `name`, `description`, `state`) VALUES
	(1, 'Cartagena', 'vuelo a cartagena', 0),
	(2, 'Uraba', 'vuelo a uraba', 0),
	(3, 'los angeles', 'vuelo a los angeles', 0),
	(4, 'paseo santa marta', 'paseo a santa marta', 0),
	(5, 'Dubai', 'Vuelo a Dubay', 1),
	(6, 'Viaje a manrique', 'Este viaje es en buseta', 0),
	(8, 'campo valdes', 'Bus a campo valdes', 0),
	(11, 'calvario', 'Bus que pasa por el calvario', 0),
	(12, 'España', 'Vuelo a españa', 1),
	(13, 'inglaterra', 'Vuelo a inglaterra', 1),
	(14, 'prado', 'bus de prado', 0);
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;

-- Volcando estructura para tabla boletos.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `doc_identity` int(13) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(20) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla boletos.users: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`, `doc_identity`, `name`, `surname`, `email`, `password`, `role`, `birthdate`, `created_at`, `updated_at`) VALUES
	(8, 1036682191, 'Camila', 'Rivera', 'camila@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'ROLE_ADMIN', '2020-10-04', '2020-10-18 22:49:15', '2020-10-18 22:49:15'),
	(9, 232323, 'Carlos', 'Marquez', 'carlos@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'ROLE_COMPRADOR', '2020-10-11', '2020-10-18 23:16:13', '2020-10-18 23:16:13'),
	(10, 23221, 'ana', 'berrio', 'ana@gm.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'ROLE_COMPRADOR', '2020-10-05', '2020-10-18 23:26:03', '2020-10-18 23:26:03'),
	(11, 12146343, 'Natalia', 'Perez', 'natalia@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'ROLE_COMPRADOR', '2020-10-05', '2020-10-19 14:00:19', '2020-10-19 14:02:25'),
	(12, 123455, 'admin', 'admin', 'admin@admin.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'ROLE_ADMIN', '2020-10-05', '2020-10-19 14:00:19', '2020-10-19 14:02:25');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
