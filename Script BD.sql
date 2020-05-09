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

CREATE TABLE ASISTENCIA(
	refAlumno int NOT NULL REFERENCES alumno(id) ON DELETE CASCADE,
	asistencia int NOT NULL,
	fecha DATE NOT NULL
);

CREATE TABLE EVALUACION(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre varchar(32) NOT NULL,
	fecha DATE NOT NULL,
	refAsignatura int NOT NULL REFERENCES asignatura(id) ON DELETE CASCADE
);

CREATE TABLE CALIFICAREVALUACION(
	refAlumno int NOT NULL REFERENCES alumno(id) ON DELETE CASCADE,
	refAsignatura int NOT NULL REFERENCES asignatura(id) ON DELETE CASCADE,
	refEvaluacion int NOT NULL REFERENCES evaluacion(id) ON DELETE CASCADE,
	nota double(2,1) NOT NULL
);

CREATE TABLE PERIODO(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	inicio DATE NOT NULL,
	fin DATE NOT NULL,
	numDias int NOT NULL
);

CREATE TABLE PROMEDIOASIGNATURA(
	refAlumno int NOT NULL REFERENCES alumno(id) ON DELETE CASCADE,
	refAsignatura int NOT NULL REFERENCES asignatura(id) ON DELETE CASCADE,
	refPeriodo int NOT NULL REFERENCES periodo(id) ON DELETE CASCADE,
	nota double(2,1) NOT NULL
);
