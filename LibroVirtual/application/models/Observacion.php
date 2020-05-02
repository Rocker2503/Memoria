<?php 

class Observacion extends CI_Model
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
				AND asignatura.refCurso = alumno.refCurso";

		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function obtenerObservaciones($refAlumno)
	{
		$query = "SELECT observacion.id, asignatura.nombre, observacion.refAlumno, observacion.fecha, observacion.tipo, observacion.comentario, observacion.refAsignatura
			FROM observacion, asignatura
			WHERE observacion.refAlumno = '$refAlumno'
			AND observacion.refAsignatura = asignatura.id";

		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function obtenerAlumno($refAlumno)
	{
		$query = "SELECT alumno.nombres, alumno.apellidoPaterno, alumno.apellidoMaterno FROM alumno WHERE alumno.id = '$refAlumno'";
		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function obtenerDatos($refAsignatura)
	{
		$query = "SELECT asignatura.nombre
			FROM asignatura
			WHERE asignatura.id = '$refAsignatura'";

		$resultados = $this->db->query($query)->row();
		return $resultados;
	}

	function agregarObservacion($refAsignatura,$refAlumno,$fecha,$tipo,$comentario)
	{
		$data = array(
			'refAsignatura' => $refAsignatura,
			'refAlumno' => $refAlumno,
			'fecha' => $fecha,
			'tipo' => $tipo,
			'comentario' => $comentario
		);

		$this->db->insert('observacion',$data);
	}

	function eliminarObservacion($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('Observacion');
	}

	
}

?>