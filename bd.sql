DROP DATABASE IF EXISTS `u734437104_Comida`;

CREATE DATABASE IF NOT EXISTS `u734437104_Comida` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `u734437104_Comida`;

DROP TABLE IF EXISTS `tblusuarios`;

CREATE TABLE `tblusuarios` (
  `idUsuario` INT(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` VARCHAR(20) DEFAULT NULL,
  `vchApellidos` VARCHAR(20) DEFAULT NULL,
  `vchNoTelefono` VARCHAR(13) DEFAULT NULL,
  `vchEmail` VARCHAR(150) DEFAULT NULL,
  `vchPassword` VARCHAR(300) DEFAULT NULL,
  `vchPreguntaRecup` VARCHAR(100) DEFAULT NULL,
  `vchRespuestaRecup` VARCHAR(100) DEFAULT NULL,
  `TipoUsuario` ENUM('Cliente', 'Empleado', 'Administrador') DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Procedimientos almacenados
DELIMITER $$

CREATE PROCEDURE `spLogin`(IN p_email VARCHAR(150), IN p_password VARCHAR(300), OUT p_respuesta INT)
BEGIN
    SELECT COUNT(*) INTO p_respuesta FROM tblusuarios WHERE vchEmail = p_email AND vchPassword = MD5(p_password);
END$$

CREATE PROCEDURE `spConsultarDatos`(IN p_email VARCHAR(150))
BEGIN
    SELECT idUsuario, vchNombre, vchApellidos, vchNoTelefono, TipoUsuario FROM tblusuarios WHERE vchEmail = p_email;
END$$

CREATE PROCEDURE `spInsertarUsuarios`(IN p_nombre VARCHAR(20), IN p_apellidos VARCHAR(20), IN p_noTelefono VARCHAR(13), IN p_email VARCHAR(150), IN p_password VARCHAR(300), IN p_pregunta VARCHAR(100), IN p_respuesta VARCHAR(100), IN p_tipoUsuario ENUM('Cliente', 'Empleado', 'Administrador'))
BEGIN
    INSERT INTO tblusuarios (vchNombre, vchApellidos, vchNoTelefono, vchEmail, vchPassword, vchPreguntaRecup, vchRespuestaRecup, TipoUsuario) 
    VALUES (p_nombre, p_apellidos, p_noTelefono, p_email, MD5(p_password), p_pregunta, p_respuesta, p_tipoUsuario);
END$$

CREATE PROCEDURE `spConsultarEmail`(IN p_email VARCHAR(150), OUT p_respuesta INT)
BEGIN
    SELECT COUNT(*) INTO p_respuesta FROM tblusuarios WHERE vchEmail = p_email;
END$$

CREATE PROCEDURE `spObtenerPreguntaSecreta`(IN p_email VARCHAR(150))
BEGIN
    SELECT vchPreguntaRecup, vchRespuestaRecup FROM tblusuarios WHERE vchEmail = p_email;
END$$

CREATE PROCEDURE `spGuardarCodigoRecuperacion`(IN p_email VARCHAR(150))
BEGIN
    DECLARE v_codigo VARCHAR(10);
    SET v_codigo = LPAD(FLOOR(RAND() * 1000000), 6, '0');
    UPDATE tblusuarios SET vchPassword = v_codigo WHERE vchEmail = p_email;
    SELECT v_codigo AS TokenGenerado;
END$$

CREATE PROCEDURE `spValidarCodigoRecuperacion`(IN p_email VARCHAR(150), IN p_codigo VARCHAR(10))
BEGIN
    SELECT COUNT(*) AS Valido FROM tblusuarios WHERE vchEmail = p_email AND vchPassword = p_codigo;
END$$

CREATE PROCEDURE `spActualizarPassword`(IN p_email VARCHAR(150), IN p_nuevaPassword VARCHAR(300))
BEGIN
    UPDATE tblusuarios 
    SET vchPassword = MD5(p_nuevaPassword) 
    WHERE vchEmail = p_email;
END $$

DELIMITER ;

-- Inserción de datos en tblusuarios
INSERT INTO `tblusuarios` 
(`idUsuario`, `vchNombre`, `vchApellidos`, `vchNoTelefono`, `vchEmail`, `vchPassword`, `TipoUsuario`, `vchPreguntaRecup`, `vchRespuestaRecup`) 
VALUES 
(1, 'Josmar Aldair', 'Bautista Saavedra', '4831290696', 'josmar050110@gmail.com', 'c30d2d6dfe8c5ae3a3e9b9cef0d36f59', NULL, NULL, 'Administrador'),
(2, 'Josmar', 'Aldair', '7712194196', 'josmar050116@gmail.com', 'b267f8b8d588a1c15bcfa8bff7e5f07b', NULL, NULL, 'Cliente');
 