/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : scp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-03-01 07:19:24
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cuentas`
-- ----------------------------
DROP TABLE IF EXISTS `cuentas`;
CREATE TABLE `cuentas` (
  `id_cuenta` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) DEFAULT NULL,
  `descripcion` text,
  `valor` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_cuenta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cuentas
-- ----------------------------
INSERT INTO `cuentas` VALUES ('3', '731', 'gastos indirectos', '15000', '2021-02-22');

-- ----------------------------
-- Table structure for `especialidades`
-- ----------------------------
DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE `especialidades` (
  `id_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of especialidades
-- ----------------------------
INSERT INTO `especialidades` VALUES ('1', 'Eléctrica');
INSERT INTO `especialidades` VALUES ('2', 'Civil');
INSERT INTO `especialidades` VALUES ('3', 'Mecánica');

-- ----------------------------
-- Table structure for `especialistas`
-- ----------------------------
DROP TABLE IF EXISTS `especialistas`;
CREATE TABLE `especialistas` (
  `id_especialista` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(100) NOT NULL,
  `salario_diario` float(8,0) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  PRIMARY KEY (`id_especialista`),
  KEY `Refespecialidades2` (`id_especialidad`),
  CONSTRAINT `Refespecialidades2` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of especialistas
-- ----------------------------
INSERT INTO `especialistas` VALUES ('1', 'Jorge Luis Oliva Matos', '204', '1');
INSERT INTO `especialistas` VALUES ('2', 'Duarte Juan Contreras', '204', '2');
INSERT INTO `especialistas` VALUES ('3', 'Luis Enrique Borrero', '204', '3');

-- ----------------------------
-- Table structure for `proyectos`
-- ----------------------------
DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(150) NOT NULL,
  `valor` float(8,0) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proyectos
-- ----------------------------
INSERT INTO `proyectos` VALUES ('1', 'IPU-03-20210312', 'Sistema de riego central Dos Rios', '150000', '2021-02-19', '2021-02-25', '1');
INSERT INTO `proyectos` VALUES ('2', 'IPU-03-2015487', 'Caseta 4x4 Central America Libre', '45000', '2021-02-11', '2021-02-27', '1');
INSERT INTO `proyectos` VALUES ('3', 'IPU-03-2145', 'Sistema de drenaje UBPC Celia Sanchez(Mella)', '12000', '2021-02-19', '2021-02-19', '1');

-- ----------------------------
-- Table structure for `proyectos_subelemento_gastos`
-- ----------------------------
DROP TABLE IF EXISTS `proyectos_subelemento_gastos`;
CREATE TABLE `proyectos_subelemento_gastos` (
  `id_proyectos_subelemento_gastos` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_subelemento_gasto` int(11) NOT NULL,
  `id_especialista` int(11) NOT NULL,
  `valor` float(8,0) DEFAULT NULL,
  PRIMARY KEY (`id_proyectos_subelemento_gastos`),
  KEY `Refproyectos6` (`id_proyecto`),
  KEY `Refsubelemento_gastos7` (`id_subelemento_gasto`),
  KEY `Refespecialistas8` (`id_especialista`),
  CONSTRAINT `Refespecialistas8` FOREIGN KEY (`id_especialista`) REFERENCES `especialistas` (`id_especialista`),
  CONSTRAINT `Refproyectos6` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`),
  CONSTRAINT `Refsubelemento_gastos7` FOREIGN KEY (`id_subelemento_gasto`) REFERENCES `subelemento_gastos` (`id_subelemento_gasto`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proyectos_subelemento_gastos
-- ----------------------------
INSERT INTO `proyectos_subelemento_gastos` VALUES ('91', '2021-02-08', '1', '4', '2', '12');
INSERT INTO `proyectos_subelemento_gastos` VALUES ('93', '2021-02-08', '1', '4', '1', '3');
INSERT INTO `proyectos_subelemento_gastos` VALUES ('96', '2021-02-22', '1', '2', '2', '3');

-- ----------------------------
-- Table structure for `subelemento_gastos`
-- ----------------------------
DROP TABLE IF EXISTS `subelemento_gastos`;
CREATE TABLE `subelemento_gastos` (
  `id_subelemento_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `nombre` char(50) NOT NULL,
  PRIMARY KEY (`id_subelemento_gasto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subelemento_gastos
-- ----------------------------
INSERT INTO `subelemento_gastos` VALUES ('1', '2001', 'Dieta');
INSERT INTO `subelemento_gastos` VALUES ('2', '5002', 'Hospedaje');
INSERT INTO `subelemento_gastos` VALUES ('3', '5003', 'Diesel');
INSERT INTO `subelemento_gastos` VALUES ('4', '5004', 'Gasolina');
INSERT INTO `subelemento_gastos` VALUES ('5', '5010', 'Salario');

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'jloliva1984', 'Godblessourfate1.*');
