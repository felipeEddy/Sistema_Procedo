# Host: localhost  (Version 5.5.16)
# Date: 2019-04-17 17:18:29
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "cliente"
#

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `cnpj` varchar(15) NOT NULL DEFAULT '',
  `telefone` varchar(15) DEFAULT NULL,
  `origem` varchar(10) DEFAULT NULL,
  `uf` char(2) NOT NULL DEFAULT '',
  `cidade` varchar(255) NOT NULL DEFAULT '',
  `situacao` varchar(10) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "cliente"
#

INSERT INTO `cliente` VALUES (2,'Maria Leite','maria.leite@email.com','45789548/0000','14996921256','IndicaÃ§Ã£','RJ','Barra Mansa','ativo','');

#
# Structure for table "usuario"
#

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `senha` varchar(255) NOT NULL DEFAULT '',
  `sexo` char(1) NOT NULL DEFAULT '',
  `telefone` varchar(20) DEFAULT NULL,
  `uf` char(2) NOT NULL DEFAULT '',
  `cidade` varchar(255) NOT NULL DEFAULT '',
  `situacao` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

#
# Data for table "usuario"
#

INSERT INTO `usuario` VALUES (36,'UsuÃ¡rio','usuario@email.com','202cb962ac59075b964b07152d234b70','m','14997315948','SP','Bauru',1);
