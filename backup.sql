

CREATE DATABASE IF NOT EXISTS `bibliotecapp`;
USE `bibliotecapp`;
drop database bibliotecapp;

/* Tabla : estados */
CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Estados por defecto */
INSERT INTO `estados` (`nombre_estado`) VALUES ('ACTIVO');
INSERT INTO `estados` (`nombre_estado`) VALUES ('INACTIVO');

/* Tabla : users_tipos */
CREATE TABLE IF NOT EXISTS `users_tipos`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_usuario` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Tipos de Usuario por defecto */
INSERT INTO `users_tipos` (`nombre_tipo_usuario`) VALUES ('PROFESOR');
INSERT INTO `users_tipos` (`nombre_tipo_usuario`) VALUES ('ESTUDIANTE');
INSERT INTO `users_tipos` (`nombre_tipo_usuario`) VALUES ('ADMINISTRADOR');
INSERT INTO `users_tipos` (`nombre_tipo_usuario`) VALUES ('SIN ACCESOS');

/* Tabla : users*/
CREATE TABLE IF NOT EXISTS `users`  
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `RutaUserReferencia` varchar(255) NOT NULL DEFAULT '',
  `users_tipos_id` int NOT NULL,
  UNIQUE KEY `emailid` (`emailid`),
  PRIMARY KEY (`id`),
  KEY `fk_users_tipos_id` (`users_tipos_id`),
  CONSTRAINT `fk_users_tipos_id` FOREIGN KEY (`users_tipos_id`) REFERENCES `users_tipos` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* users por defecto*/
INSERT INTO `users` (`password`,`emailid`,`RutaUserReferencia`,`users_tipos_id`) VALUES ('123456789','fericell2909@gmail.com','../assets/img/users/fericell.jpg','3');



/* Tabla : sexos */
CREATE TABLE IF NOT EXISTS `sexos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sexo` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Estados por defecto */
INSERT INTO `sexos` (`nombre_sexo`) VALUES ('MASCULINO');
INSERT INTO `sexos` (`nombre_sexo`) VALUES ('FEMENINO');

/**/

CREATE TABLE IF NOT EXISTS `alumnos`
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) NOT NULL DEFAULT '',
  `ApellidoPaterno` varchar(255) NOT NULL DEFAULT '',
  `ApellidoMaterno` varchar(255) NOT NULL DEFAULT '',
  `sexo_id` int NOT NULL,
  `estado_id` int NOT NULL,
  `FechaNacimiento` varchar(20) DEFAULT NULL,
  `Celular` varchar(9) NOT NULL DEFAULT '999999999',
  `dni` varchar(8) NOT NULL DEFAULT '99999999',
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sexo_id` (`sexo_id`),
  CONSTRAINT `fk_sexo_id` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`id`),
  KEY `fk_estado_id` (`estado_id`),
  CONSTRAINT `fk_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  KEY `fk_alumnos_user_id` (`user_id`),
  CONSTRAINT `fk_alumnos_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;  


CREATE TABLE IF NOT EXISTS `profesores`
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) NOT NULL DEFAULT '',
  `ApellidoPaterno` varchar(255) NOT NULL DEFAULT '',
  `ApellidoMaterno` varchar(255) NOT NULL DEFAULT '',
  `sexo_id` int NOT NULL,
  `estado_id` int NOT NULL,
  `FechaNacimiento` varchar(20) DEFAULT NULL,
  `Celular` varchar(9) NOT NULL DEFAULT '999999999',
  `dni` varchar(8) NOT NULL DEFAULT '99999999',
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profesor_sexo_id` (`sexo_id`),
  CONSTRAINT `fk_profesor_sexo_id` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`id`),
  KEY `fk_profesor_estado_id` (`estado_id`),
  CONSTRAINT `fk_profesor_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  KEY `fk_profesores_user_id` (`user_id`),
  CONSTRAINT `fk_profesores_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* */

CREATE TABLE IF NOT EXISTS `autores`
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) NOT NULL DEFAULT '',
  `ApellidoPaterno` varchar(255) NOT NULL DEFAULT '',
  `ApellidoMaterno` varchar(255) NOT NULL DEFAULT '',
  `sexo_id` int NOT NULL,
  `estado_id` int NOT NULL,
  `FechaNacimiento` varchar(20) DEFAULT NULL,
  `PaisNacimiento` varchar(255) NOT NULL DEFAULT '',
  `Celular` varchar(9) NOT NULL DEFAULT '999999999',
  `Email` varchar(255) NOT NULL DEFAULT '',
   PRIMARY KEY (`id`),
  KEY `fk_autor_sexo_id` (`sexo_id`),
  CONSTRAINT `fk_autor_sexo_id` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`id`),
  KEY `fk_autor_estado_id` (`estado_id`),
  CONSTRAINT `fk_autor_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `editoriales`
(
 
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nombre_editorial` varchar(255) NOT NULL DEFAULT '',
 `estado_id` int NOT NULL,
 PRIMARY KEY (`id`),
 KEY `fk_editorial_estado_id` (`estado_id`),
 CONSTRAINT `fk_editorial_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `editoriales` (`nombre_editorial`,`estado_id`) VALUES ('EJEMPLOS DE EDITORIAL UNO',1);
INSERT INTO `editoriales` (`nombre_editorial`,`estado_id`) VALUES ('EJEMPLOS DE EDITORIAL DOS',1);


CREATE TABLE IF NOT EXISTS `generos`
(
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nombre_genero` varchar(255) NOT NULL DEFAULT '',
 `estado_id` int NOT NULL,
 PRIMARY KEY (`id`),
 KEY `fk_genero_estado_id` (`estado_id`),
 CONSTRAINT `fk_genero_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `generos` (`nombre_genero`,`estado_id`) VALUES ('Aventuras',1);
INSERT INTO `generos` (`nombre_genero`,`estado_id`) VALUES ('Ciencia Ficcion',1);
INSERT INTO `generos` (`nombre_genero`,`estado_id`) VALUES ('Hadas',1);
INSERT INTO `generos` (`nombre_genero`,`estado_id`) VALUES ('Gotica',1);
INSERT INTO `generos` (`nombre_genero`,`estado_id`) VALUES ('Policiales',1);
INSERT INTO `generos` (`nombre_genero`,`estado_id`) VALUES ('Científicas',1);


CREATE TABLE IF NOT EXISTS `libros`
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_libro` varchar(255) NOT NULL DEFAULT '',
  `editorial_id` int NOT NULL,
  `estado_id` int NOT NULL,
  `genero_id` int NOT NULL,
  `numero_paginas` int NOT NULL,
  `anio_edicion` int NOT NULL,
  `FechaPublicacion` varchar(20) DEFAULT NULL, 
  `codigo_isbn` varchar(20) NOT NULL DEFAULT '',
  `resumen` text NOT NULL,
  `bimagenReferencia` int NOT NULL,
  `RutaImagenReferencia` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),  
  KEY `fk_libro_editorial_id` (`editorial_id`),
  CONSTRAINT `fk_libro_editorial_id` FOREIGN KEY (`editorial_id`) REFERENCES `editoriales` (`id`),
  KEY `fk_libros_estado_id` (`estado_id`),
  CONSTRAINT `fk_libros_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  KEY `fk_libros_genero_id` (`genero_id`),
  CONSTRAINT `fk_libros_genero_id` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 


CREATE TABLE IF NOT EXISTS `libro_referencias`
(
  `libro_id` int(11) NOT NULL,
  `correlativo_referencia` int(11) NOT NULL,
  `RutaLibroReferencia` varchar(255) NOT NULL DEFAULT '',
  `estado_id` int NOT NULL,
  PRIMARY KEY (`libro_id`,`correlativo_referencia`),
  KEY `fk_libros_referencia_estado_id` (`estado_id`),
  CONSTRAINT `fk_libros_referencia_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  KEY `fk_libro_referencia_libro_id` (`libro_id`),
  CONSTRAINT `fk_libro_referencia_libro_id` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `libro_autores` (
  `libro_id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL,
  PRIMARY KEY (`libro_id`,`autor_id`),
  KEY `fk_libro_autor_libro_id` (`libro_id`),
  CONSTRAINT `fk_libro_autor_libro_id` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`),
  KEY `fk_libro_autor_autor_id` (`autor_id`),
  CONSTRAINT `fk_libro_autor_autor_id` FOREIGN KEY (`autor_id`) REFERENCES `autores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `estados_solicitudes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nombre_estado_solicitud` varchar(255) NOT NULL DEFAULT '',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `estados_solicitudes` (`nombre_estado_solicitud`) VALUES ('Activado');
INSERT INTO `estados_solicitudes` (`nombre_estado_solicitud`) VALUES ('Anulado');
INSERT INTO `estados_solicitudes` (`nombre_estado_solicitud`) VALUES ('En Espera');

CREATE TABLE IF NOT EXISTS `tipos_solicitudes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nombre_tipo_solicitud` varchar(255) NOT NULL DEFAULT '',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tipos_solicitudes` (`nombre_tipo_solicitud`) VALUES ('ALTA');
INSERT INTO `tipos_solicitudes` (`nombre_tipo_solicitud`) VALUES ('BAJA');


select * from solicitudesbajas;
CREATE TABLE IF NOT EXISTS `solicitudesbajas` (
 `id` int(11) NOT NULL AUTO_INCREMENT, 
 `name_usuario` varchar(255) NOT NULL DEFAULT '',
 `email_usuario` varchar(255) NOT NULL DEFAULT '',
 `estado_solicitud_id` int NOT NULL,
 `estado_solicitud_nombre` varchar(255) NOT NULL DEFAULT ''
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

select * from users;
select * from autores;
select * from alumnos;
select * from users_tipos;
/* users por defecto*/
INSERT INTO `users` (`password`,`emailid`,`RutaUserReferencia`,`users_tipos_id`) 
VALUES ('profesor','profesor@profesor.com','../assets/img/users/a.png','1');
INSERT INTO `users` (`password`,`emailid`,`RutaUserReferencia`,`users_tipos_id`) 
VALUES ('charcape','andres.charcape20@gmail.com','../assets/img/users/charcape_mch15.jpg','3');
INSERT INTO `users` (`password`,`emailid`,`RutaUserReferencia`,`users_tipos_id`) 
VALUES ('messi','messi@gmail.com','../assets/img/users/messi.jpg','2');
INSERT INTO `users` (`password`,`emailid`,`RutaUserReferencia`,`users_tipos_id`) 
VALUES ('ronaldo','ronaldo@gmail.com','../assets/img/users/ronaldo.jpg','2');

INSERT INTO `profesores` (`Nombres`,`ApellidoPaterno`,`ApellidoMaterno`,`sexo_id`,`estado_id`,`FechaNacimiento`,`Celular`,`dni`,`user_id`)
VALUES ('Juan Carlos','Hurtado','Cerdán',1,1,'01-01-1985','999999999','99999999',2);

INSERT INTO `autores` (`Nombres`, `ApellidoPaterno`,`ApellidoMaterno`,`sexo_id`,`estado_id`,`FechaNacimiento`,`PaisNacimiento`,`Celular`,`Email`) 
VALUES ('Marco', 'Estrada' , 'Lopez' , 1 , 1 , '11-05-1987' , 'Peru' , '955453193' , 'fericell2909@gmail.com');

INSERT INTO `alumnos` (`Nombres`, `ApellidoPaterno`,`ApellidoMaterno`,`sexo_id`,`estado_id`,`FechaNacimiento`,`Celular`,`dni`,`user_id`) 
VALUES ('Messi', '' , 'Lionel' , 1 , 1 , '11-05-1983' , '122324242','89765432',4);

INSERT INTO `alumnos` (`Nombres`, `ApellidoPaterno`,`ApellidoMaterno`,`sexo_id`,`estado_id`,`FechaNacimiento`,`Celular`,`dni`,`user_id`) 
VALUES ('Ronaldo', '' , 'Cristiano' , 1 , 1 , '01-05-1982', '955453187' , '12873456',5);


INSERT INTO `autores` (`Nombres`, `ApellidoPaterno`,`ApellidoMaterno`,`sexo_id`,`estado_id`,`FechaNacimiento`,`PaisNacimiento`,`Celular`,`Email`) 
VALUES ('Andres', 'Medina' , 'Charcape' , 1 , 1 , '01-08-1997' , 'Peru' , '943169522' , 'andres.charcape20@gmail.com');


CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ph_name` varchar(500) NOT NULL,
  `ph_address` varchar(500) NOT NULL,
  `ph_telephone` varchar(20) NOT NULL,
  `ph_email` varchar(30) NOT NULL,
  `ph_fax` varchar(20) NOT NULL DEFAULT '',
  `ph_ruc` varchar(11) NOT NULL DEFAULT '',
  `ph_caracteristicas` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`ph_name`, `ph_address`, `ph_telephone`, `ph_email`, `ph_ruc`, `ph_caracteristicas`) 
VALUES ('CENTRO DE COMPUTO DE LA UNS', 
        'Urb. Bellamar, Av. Universitaria S/N- Pabellón de la E.A.P.I.S.I.', '(043) 31-0445', 
        'centro_computo_uns@hotmail.com', '20148309109', 
        'Nuestro centro de estudios cuenta con todo lo que necesitas para aprender de la manera mas cómoda y eficiente!');
       




