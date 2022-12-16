/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.22-MariaDB : Database - crud_php
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`crud_php` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `crud_php`;

/*Table structure for table `pais` */

DROP TABLE IF EXISTS `pais`;

CREATE TABLE `pais` (
  `idpais` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePais` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `pais` */

LOCK TABLES `pais` WRITE;

insert  into `pais`(`idpais`,`nombrePais`) values (1,'Argentina'),(2,'Portugal'),(3,'Colombia'),(4,'Perus'),(5,'Ecuador'),(6,'Alemania'),(7,'Estados Unidos'),(13,'Francia');

UNLOCK TABLES;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `roles` */

LOCK TABLES `roles` WRITE;

insert  into `roles`(`idRol`,`descripcion`) values (1,'User'),(2,'Admin');

UNLOCK TABLES;

/*Table structure for table `tbl_personal` */

DROP TABLE IF EXISTS `tbl_personal`;

CREATE TABLE `tbl_personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `profesion` varchar(45) DEFAULT NULL,
  `fregis` date DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `pais_idpais` int(11) NOT NULL,
  `roles_idRol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_idRol` (`roles_idRol`),
  KEY `pais_idpais` (`pais_idpais`),
  CONSTRAINT `tbl_personal_ibfk_1` FOREIGN KEY (`roles_idRol`) REFERENCES `roles` (`idRol`),
  CONSTRAINT `tbl_personal_ibfk_2` FOREIGN KEY (`pais_idpais`) REFERENCES `pais` (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_personal` */

LOCK TABLES `tbl_personal` WRITE;

insert  into `tbl_personal`(`id`,`nombres`,`apellidos`,`profesion`,`fregis`,`username`,`password`,`pais_idpais`,`roles_idRol`) values (1,'Lionel Andres','Messi Cuccitini','GOAT','2022-12-02','LM10','1111',1,1),(2,'Cristiano','Ronaldo','Futbolista','2022-12-01','CR7','2222',2,2),(3,'Maria','Cotrina','Sistemas','2019-08-21','MACO','3333',3,1),(4,'Jenifer','Carrillo','Analista','2022-11-15','JENCA','4444',4,1),(5,'Milagros','Ferrer','Economista','2019-08-16','MIFE','5555',1,1),(6,'LeBron','James','Basquetbolista','2022-12-10','LEJA','6666',3,2),(7,'Pedro','Pedraza','Panadero','2022-12-10','PEPE','7777',5,2),(10,'Steven ','Acevedo Alvarado','Panadero','2022-12-16','steven88','3232',2,1),(11,'Antoine','Giezzman','Futbolista','2022-12-16','Grizu','77777',3,1),(12,'pedro','Pedraza','Enfermero','2022-12-16','LM10k','423424',13,1);

UNLOCK TABLES;

/* Procedure structure for procedure `usuarioXRol` */

/*!50003 DROP PROCEDURE IF EXISTS  `usuarioXRol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `usuarioXRol`( in id int(45))
BEGIN

SELECT COUNT(*) as cantidad ,descripcion FROM tbl_personal 
inner join roles
on tbl_personal.roles_idRol = roles.idRol
where roles_idRol=id;


END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
