-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema proyecto
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema proyecto
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `proyecto` ;

-- -----------------------------------------------------
-- Table `proyecto`.`login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`login` (
  `idlogin` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NOT NULL,
  `password` VARCHAR(90) NOT NULL,
  `tipo` INT NOT NULL,
  PRIMARY KEY (`idlogin`, `usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`hoteles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`hoteles` (
  `nombre` VARCHAR(45) NOT NULL,
  `habitaciones` INT NOT NULL,
  `ciudad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`nombre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`empleados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`empleados` (
  `idempleados` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(90) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `hoteles_nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idempleados`),
  FOREIGN KEY (`hoteles_nombre`) REFERENCES `proyecto`.`hoteles` (`nombre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`clientes` (
  `idclientes` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(90) NOT NULL,
  `dni` VARCHAR(10) NOT NULL,
  `tarjeta` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idclientes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`habitaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`habitaciones` (
  `idhabitaciones` INT NOT NULL AUTO_INCREMENT,
  `hoteles_nombre` VARCHAR(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idhabitaciones`),
  FOREIGN KEY (`hoteles_nombre`) REFERENCES `proyecto`.`hoteles` (`nombre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`reservas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`reservas` (
  `idreserva` INT NOT NULL AUTO_INCREMENT,
  `clientes_idclientes` INT NOT NULL,
  `habitaciones_idhabitaciones` INT NOT NULL,
  PRIMARY KEY (`idreserva`),
    FOREIGN KEY (`clientes_idclientes`) REFERENCES `proyecto`.`clientes` (`idclientes`),
    FOREIGN KEY (`habitaciones_idhabitaciones`) REFERENCES `proyecto`.`habitaciones` (`idhabitaciones`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- -----------------------------------------------------
-- Data for table `proyecto`.`hoteles`
-- -----------------------------------------------------
START TRANSACTION;
USE `proyecto`;
INSERT INTO `proyecto`.`hoteles` (`nombre`, `habitaciones`, `ciudad`) VALUES ('Pinzones', 15, 'Valladolid');
INSERT INTO `proyecto`.`hoteles` (`nombre`, `habitaciones`, `ciudad`) VALUES ('Balago', 10, 'Valladolid');

COMMIT;


-- -----------------------------------------------------
-- Data for table `proyecto`.`empleados`
-- -----------------------------------------------------
START TRANSACTION;
USE `proyecto`;
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (1, 'Alfred', 'Bat Man', 'Recepción', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (2, 'Gloria', 'Fuertes Olores', 'Limpieza', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (3, 'Amanda', 'Huevos Claros', 'Recepción', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (4, 'Feliz', 'Arias Vaquero', 'Limpeza', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (5, 'Lidia', 'Arce Fuente', 'Mantenimiento', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (6, 'Yolanda', 'Larrea Murcia', 'Mantenimiento', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (7, 'Aitor', 'Guaman Torregrosa', 'Cocina', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (8, 'Maria Dolores', 'Andreu Berna', 'Cocina', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (9, 'Maria Teresa', 'Bailon Roncero', 'Mantenimiento', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (10, 'Alejandro', 'Piñero Caballero', 'Recepcion', 'Pinzones');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (11, 'Ines', 'Torrenjon Tamariz', 'Recepcion', 'Balago');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (12, 'Juan Antonio', 'Moratalla Troya', 'Recepcion', 'Balago');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (13, 'Silvia', 'Aramburu Carranza', 'Limpieza', 'Balago');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (14, 'Maria Luisa', 'Anguita Bernardo', 'Limpieza', 'Balago');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (15, 'Catalina', 'Albarracin Zamora', 'Mantenimiento', 'Balago');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (16, 'Angel', 'Mengual Bello', 'Mantenimiento', 'Balago');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (17, 'Aurora', 'Alfonso Torrecilla', 'Cocina', 'Balago');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (18, 'Eva Maria', 'Guaman Bilbao', 'Cocina', 'Balago');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (19, 'Juan', 'Perona Grau', 'Limpieza', 'Balago');
INSERT INTO `proyecto`.`empleados` (`idempleados`, `nombre`, `apellidos`, `tipo`, `hoteles_nombre`) VALUES (20, 'Alejandro', 'Calvet Miguelez', 'Mantenimiento', 'Balago');

COMMIT;


-- -----------------------------------------------------
-- Data for table `proyecto`.`clientes`
-- -----------------------------------------------------
START TRANSACTION;
USE `proyecto`;
INSERT INTO `proyecto`.`clientes` (`idclientes`, `nombre`, `apellidos`, `dni`, `tarjeta`) VALUES (1, 'Jose Ignacio', 'Murillo Cubas', '18541600N', '4532 8832 6116 1895');
INSERT INTO `proyecto`.`clientes` (`idclientes`, `nombre`, `apellidos`, `dni`, `tarjeta`) VALUES (2, 'Esteban', 'De Lucas Del Rey', '28823226V', '4532 4648 2515 2249');
INSERT INTO `proyecto`.`clientes` (`idclientes`, `nombre`, `apellidos`, `dni`, `tarjeta`) VALUES (3, 'Alvaro', 'Rojo Quiñones', '28304611Y', '4556 7445 1086 1407');
INSERT INTO `proyecto`.`clientes` (`idclientes`, `nombre`, `apellidos`, `dni`, `tarjeta`) VALUES (4, 'Inmaculada', 'Girbert Hita', '27475564V', '4929 9925 9375 1678');
INSERT INTO `proyecto`.`clientes` (`idclientes`, `nombre`, `apellidos`, `dni`, `tarjeta`) VALUES (5, 'Josefa', 'Seco Codina', '00264496L', '4556 5719 7623 2272');

COMMIT;


-- -----------------------------------------------------
-- Data for table `proyecto`.`habitaciones`
-- -----------------------------------------------------
START TRANSACTION;
USE `proyecto`;
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (1, 'Pinzones', 'Ocupada');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (2, 'Pinzones', 'Ocupada');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (3, 'Pinzones', 'Ocupada');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (4, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (5, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (6, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (7, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (8, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (9, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (10, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (11, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (12, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (13, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (14, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (15, 'Pinzones', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (16, 'Balago', 'Ocupada');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (17, 'Balago', 'Ocupada');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (18, 'Balago', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (19, 'Balago', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (20, 'Balago', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (21, 'Balago', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (22, 'Balago', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (23, 'Balago', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (24, 'Balago', 'Libre');
INSERT INTO `proyecto`.`habitaciones` (`idhabitaciones`, `hoteles_nombre`, `estado`) VALUES (25, 'Balago', 'Libre');

COMMIT;


-- -----------------------------------------------------
-- Data for table `proyecto`.`reservas`
-- -----------------------------------------------------
START TRANSACTION;
USE `proyecto`;
INSERT INTO `proyecto`.`reservas` (`idreserva`, `clientes_idclientes`, `habitaciones_idhabitaciones`) VALUES (1, 1, 1);
INSERT INTO `proyecto`.`reservas` (`idreserva`, `clientes_idclientes`, `habitaciones_idhabitaciones`) VALUES (2, 2, 2);
INSERT INTO `proyecto`.`reservas` (`idreserva`, `clientes_idclientes`, `habitaciones_idhabitaciones`) VALUES (3, 3, 3);
INSERT INTO `proyecto`.`reservas` (`idreserva`, `clientes_idclientes`, `habitaciones_idhabitaciones`) VALUES (4, 4, 16);
INSERT INTO `proyecto`.`reservas` (`idreserva`, `clientes_idclientes`, `habitaciones_idhabitaciones`) VALUES (5, 5, 17);

COMMIT;