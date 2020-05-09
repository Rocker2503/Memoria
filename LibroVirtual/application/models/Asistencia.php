<?php

class Asistencia extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	function listarAlumnos($id)
	{
		$query = "SELECT alumno.id, alumno.apellidoPaterno, alumno.apellidoMaterno, alumno.nombres 
				FROM alumno, asignatura 
				WHERE asignatura.id = '$id'
				AND asignatura.refCurso = alumno.refCurso
				ORDER BY alumno.apellidoPaterno ASC";

		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function actualizarAsistencia($refAlumno,$asistencia,$fecha)
	{
		$query = "SELECT * FROM asistencia
			WHERE asistencia.refAlumno = '$refAlumno'
			AND asistencia.fecha = '$fecha'";

		$rows = $this->db->query($query)->num_rows();
		if($rows == 0)
		{
			$data = array(
				'refAlumno' => $refAlumno,
				'fecha'		=> $fecha,
				'asistencia'=> $asistencia
			);

			$this->db->insert('Asistencia',$data);
		}
		else
		{
			$query = "SELECT * FROM asistencia
			WHERE asistencia.refAlumno = '$refAlumno'
			AND asistencia.fecha = '$fecha'
			AND asistencia.asistencia = '0'";

			$rows = $this->db->query($query)->num_rows();
			if($rows == 1)
			{
				$query = "UPDATE asistencia 
				SET asistencia.asistencia = '$asistencia'
				WHERE asistencia.refAlumno = '$refAlumno' AND asistencia.fecha = '$fecha'";

				$this->db->query($query);
			} 	
		}
	}
}

?>