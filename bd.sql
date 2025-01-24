/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - bdcomida
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdcomida` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `bdcomida`;

/*Table structure for table `tblusuarios` */

DROP TABLE IF EXISTS `tblusuarios`;

CREATE TABLE `tblusuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(20) DEFAULT NULL,
  `vchApellidos` varchar(20) DEFAULT NULL,
  `vchNoTelefono` varchar(13) DEFAULT NULL,
  `vchEmail` varchar(150) DEFAULT NULL,
  `vchPassword` varchar(300) DEFAULT NULL,
  `TipoUsuario` enum('Cliente','Empleado','Administrador') DEFAULT NULL,
  `vchPreguntaRecup` varchar(100) DEFAULT NULL,
  `vchRespuestaRecup` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblusuarios` */

insert  into `tblusuarios`(`idUsuario`,`vchNombre`,`vchApellidos`,`vchNoTelefono`,`vchEmail`,`vchPassword`,`TipoUsuario`,`vchPreguntaRecup`,`vchRespuestaRecup`) values 
(1,'Josmar','Saavedra','7712194196','20230026@uthh.edu.mx','4fc0dff8cd76a365bce38a5c5e9a39f7','Cliente',NULL,NULL),
(2,'Josmar Aldair','Bautista Saavedra','4831290696','josmar050110@gmail.com','c30d2d6dfe8c5ae3a3e9b9cef0d36f59','Administrador',NULL,NULL),
(3,'Josmar','Aldair','7712194196','josmar050116@gmail.com','b267f8b8d588a1c15bcfa8bff7e5f07b','Cliente',NULL,NULL);

/* Procedure structure for procedure `spActualizarUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarUsuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarUsuario`(
    IN p_idUsuario INT,
    IN p_nombre VARCHAR(20),
    IN p_apellido VARCHAR(20),
    IN p_tel VARCHAR(13),
    IN p_email VARCHAR(150),
    IN p_tipoUsuario ENUM('Cliente', 'Empleado'),
    IN p_preguntaRecup VARCHAR(100),
    IN p_respuestaRecup VARCHAR(100)
)
BEGIN
    UPDATE tblusuarios 
    SET vchNombre = p_nombre,
        vchApellidos = p_apellido,
        vchNoTelefono = p_tel,
        vchEmail = p_email,
        TipoUsuario = p_tipoUsuario,
        vchPreguntaRecup = p_preguntaRecup,
        vchRespuestaRecup = p_respuestaRecup
    WHERE idUsuario = p_idUsuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarDatos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarDatos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarDatos`(
    IN email VARCHAR(200)
)
BEGIN
    SELECT idUsuario, vchNombre, TipoUsuario 
    FROM tblusuarios
    WHERE vchEmail = email;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarUsuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarUsuario`(
    IN p_idUsuario INT
)
BEGIN
    SELECT idUsuario, vchNombre, vchApellidos, vchNoTelefono, vchEmail, TipoUsuario, vchPreguntaRecup, vchRespuestaRecup
    FROM tblusuarios
    WHERE idUsuario = p_idUsuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarUsuarios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarUsuarios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarUsuarios`(
    IN nombre VARCHAR(20),
    IN apellido VARCHAR(20),
    IN tel VARCHAR(13),
    IN email VARCHAR(150),
    IN pass VARCHAR(500),
    IN tipoU ENUM('Cliente', 'Empleado')
)
BEGIN
    INSERT INTO tblusuarios (vchNombre, vchApellidos, vchNoTelefono, vchEmail, vchPassword, TipoUsuario)
    VALUES (nombre, apellido, tel, email, MD5(pass), tipoU);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spLogin` */

/*!50003 DROP PROCEDURE IF EXISTS  `spLogin` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spLogin`(
    IN email VARCHAR(200), 
    IN pass VARCHAR(200), 
    OUT respuesta BOOL
)
BEGIN
    IF EXISTS (SELECT vchEmail FROM tblusuarios 
               WHERE vchEmail = email AND vchPassword = MD5(pass)) THEN
        SET respuesta = TRUE;
    ELSE
        SET respuesta = FALSE;
    END IF;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
