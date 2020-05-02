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
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    apellidoPaterno varchar(16) NOT NULL,
    apellidoMaterno varchar(16) NOT NULL,
	nombres varchar(32) NOT NULL,
	rut varchar(16) NOT NULL,
    sexo varchar(1) NOT NULL,
    fechaNacimiento DATE NOT NULL,
    direccion varchar(32) NOT NULL,
    comuna varchar(16) NOT NULL,
    procedencia varchar(32) NOT NULL,
    refCurso int NOT NULL REFERENCES curso(id) ON DELETE CASCADE
);

CREATE TABLE APODERADO(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nivelPadre varchar(32) NOT NULL,
	nivelMadre varchar(32) NOT NULL,
	nombre varchar(64) NOT NULL,
	rut varchar(16) NOT NULL,
	direccion varchar(32) NOT NULL,
	telefono int NOT NULL,
	email varchar(32) NOT NULL,
	emergencia int NOT NULL,
	refAlumno int NOT NULL REFERENCES alumno(id) ON DELETE CASCADE
);

CREATE TABLE OBSERVACION(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	refAsignatura int NOT NULL REFERENCES asignatura(id) ON DELETE CASCADE,
	refAlumno int NOT NULL REFERENCES alumno(id) ON DELETE CASCADE,
	fecha DATE NOT NULL,
	tipo int NOT NULL,
	comentario text NOT NULL
);