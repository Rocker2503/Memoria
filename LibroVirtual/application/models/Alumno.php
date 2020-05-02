<?php

class Alumno extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	function cargarAlumnos($refCurso)
	{
		$query = "SELECT * FROM Alumno WHERE alumno.refCurso = '$refCurso'";

		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function agregarAlumno($apellidopaterno,$apellidomaterno,$nombres,$rut,$sexo,$fechanacimiento,$direccion,$comuna,$procedencia,$refcurso)
	{
		$data = array(
			'apellidoPaterno' => $apellidopaterno,
			'apellidoMaterno' => $apellidomaterno,
			'nombres' => $nombres,
			'rut' => $rut,
			'sexo' => $sexo,
			'fechaNacimiento' => $fechanacimiento,
			'direccion' => $direccion,
			'comuna' => $comuna,
			'procedencia' => $procedencia,
			'refCurso' => $refcurso
		);

		$this->db->insert('alumno',$data);
	}

	function obtenerAlumno($id)
	{
		$query = "SELECT * FROM Alumno Where alumno.id = '$id'";
		$resultados = $this->db->query($query)->row();
		return $resultados;
	}

	function editarAlumno($id,$apellidopaterno,$apellidomaterno,$nombres,$rut,$sexo,$fechanacimiento,$direccion,$comuna,$procedencia,$refcurso)
	{
		$data = array(
			'id' => $id,
			'apellidoPaterno' => $apellidopaterno,
			'apellidoMaterno' => $apellidomaterno,
			'nombres' => $nombres,
			'rut' => $rut,
			'sexo' => $sexo,
			'fechaNacimiento' => $fechanacimiento,
			'direccion' => $direccion,
			'comuna' => $comuna,
			'procedencia' => $procedencia,
			'refCurso' => $refcurso
		);

		$this->db->where('id',$id);
		$this->db->update('Alumno',$data);
	}

	function eliminarAlumno($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('Alumno');
	}

}
?>