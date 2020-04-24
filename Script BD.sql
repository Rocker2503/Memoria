CREATE TABLE CURSO(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nivel int NOT NULL,
	nombre varchar(32) NOT NULL,
	letra varchar(1) NOT NULL,
	anio int NOT NULL
);

CREATE TABLE ASIGNATURA(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre varchar(16) NOT NULL,
	horassemanales int NOT NULL,
	refCurso int NOT NULL REFERENCES curso(id) ON DELETE CASCADE
);

CREATE TABLE ALUMNO(
	id varchar(16) NOT NULL PRIMARY KEY,
    apellidoPaterno varchar(16) NOT NULL,
    apellidoMaterno varchar(16) NOT NULL,
	nombres varchar(32) NOT NULL,
    sexo varchar(1) NOT NULL,
    fechaNacimiento DATE NOT NULL,
    direccion varchar(32) NOT NULL,
    comuna varchar(16) NOT NULL,
    procedencia varchar(32) NOT NULL,
    refCurso int NOT NULL REFERENCES curso(id) ON DELETE CASCADE
);
