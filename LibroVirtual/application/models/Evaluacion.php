<?php

class Evaluacion extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	function obtenerEvaluaciones($refAsignatura)
	{
		$query = "SELECT * FROM evaluacion
				WHERE evaluacion.refAsignatura = '$refAsignatura'";

		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function obtenerPeriodos()
	{
		$query = "SELECT * FROM periodo";
		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function obtenerNombreAsignatura($refAsignatura)
	{
		$query = "SELECT asignatura.nombre FROM asignatura
			WHERE asignatura.id = '$refAsignatura'";
		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function agregarEvaluacion($nombre,$fecha,$refasignatura)
	{
		$data = array(
			'nombre' => $nombre,
			'fecha' => $fecha,
			'refAsignatura' => $refasignatura
		);

		$this->db->insert('Evaluacion',$data);	
	}

	function obtenerEvaluacion($id)
	{
		$query = "SELECT * FROM evaluacion WHERE evaluacion.id = '$id'";
		$resultados = $this->db->query($query)->row();
		return $resultados;
	}

	function editarEvaluacion($id,$nombre,$fecha,$refasignatura)
	{
		$data = array(
			'id' => $id,
			'nombre' => $nombre,
			'fecha' => $fecha,
			'refAsignatura' => $refasignatura
		);

		$this->db->where('id',$id);
		$this->db->update('Evaluacion',$data);
	}

	function eliminarEvaluacion($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('Evaluacion');
	}

	function existeCalificacion($refAsignatura, $refEvaluacion)
	{
		$query = "SELECT * FROM calificarevaluacion 
		WHERE calificarevaluacion.refAsignatura = '$refAsignatura'
		AND calificarevaluacion.refEvaluacion = '$refEvaluacion'";

		$rows = $this->db->query($query)->num_rows();
		if($rows == 0)
		{
			return false;
		}else{
			return true;
		}
	}

	function obtenerNotas($refAsignatura, $refEvaluacion)
	{
		$query = "SELECT alumno.id, alumno.apellidoPaterno, alumno.apellidoMaterno, alumno.nombres, calificarevaluacion.nota
			FROM alumno, calificarevaluacion
			WHERE calificarevaluacion.refAsignatura = '$refAsignatura'
			AND calificarevaluacion.refEvaluacion = '$refEvaluacion'
			AND alumno.id = calificarevaluacion.refAlumno";

		$resultados = $this->db->query($query)->result();
		return $resultados;
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

	function calificarEvaluacion($refAlumno,$refAsignatura,$refEvaluacion,$nota)
	{
		$query = "SELECT * FROM calificarevaluacion
		WHERE calificarevaluacion.refAlumno = '$refAlumno'
		AND calificarevaluacion.refAsignatura = '$refAsignatura'
		AND calificarevaluacion.refEvaluacion = '$refEvaluacion'";

		$rows = $this->db->query($query)->num_rows();
		if($rows == 0)
		{
			$data = array(
			'refAlumno' => $refAlumno,
			'refAsignatura' => $refAsignatura,
			'refEvaluacion' => $refEvaluacion,
			'nota' => $nota 
			);

			$this->db->insert('calificarevaluacion',$data);
		}else if($rows == 1)
		{
			$query = "UPDATE calificarevaluacion
			SET calificarevaluacion.nota = '$nota'
			WHERE calificarevaluacion.refAlumno = '$refAlumno'
			AND calificarevaluacion.refAsignatura = '$refAsignatura'
			AND calificarevaluacion.refEvaluacion = '$refEvaluacion'";

			$this->db->query($query);
		}

	}

	function calcularPromedios($refAsignatura,$refPeriodo)
	{
		$query = "SELECT alumno.id, CAST(AVG(calificarevaluacion.nota) AS DOUBLE(3,2)) as promedio 
			FROM alumno, evaluacion, calificarevaluacion, periodo 
			WHERE alumno.id = calificarevaluacion.refAlumno 
			AND periodo.id = '$refPeriodo'
			AND calificarevaluacion.refAsignatura = '$refAsignatura'  
			AND evaluacion.fecha > periodo.inicio 
			AND evaluacion.fecha < periodo.fin 
			AND evaluacion.id = calificarevaluacion.refEvaluacion
			GROUP BY alumno.id
			ORDER BY alumno.apellidoPaterno ASC ";

		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function actualizarPromedioAsignatura($refAlumno,$refAsignatura,$refPeriodo,$promedio)
	{
		$query = "SELECT * FROM promedioasignatura 
			WHERE promedioasignatura.refAlumno = '$refAlumno'
			AND promedioasignatura.refAsignatura = '$refAsignatura'
			AND promedioasignatura.refPeriodo = '$refPeriodo'";

		$rows = $this->db->query($query)->num_rows();
		if($rows == 0)
		{
			$data = array(
				'refAlumno' => $refAlumno,
				'refAsignatura' => $refAsignatura,
				'refPeriodo' => $refPeriodo,
				'nota' => $promedio
			);

			$this->db->insert('promedioasignatura',$data);
		}elseif($rows == 1)
		{
			$query = "UPDATE promedioasignatura
					SET promedioasignatura.nota = '$promedio'
					WHERE promedioasignatura.refAlumno = '$refAlumno'
					AND promedioasignatura.refAsignatura = '$refAsignatura'
					AND promedioasignatura.refPeriodo = '$refPeriodo'";

			$this->db->query($query);
		}
	}

	function obtenerPromediosAsignatura($refAsignatura,$refPeriodo)
	{
		$query = "SELECT alumno.apellidoPaterno, alumno.apellidoMaterno, alumno.nombres,
				promedioasignatura.nota
				FROM promedioasignatura, alumno
				WHERE promedioasignatura.refAlumno = alumno.id
				AND promedioasignatura.refAsignatura = '$refAsignatura'
				AND promedioasignatura.refPeriodo = '$refPeriodo'";

		$resultados = $this->db->query($query)->result();
		return $resultados;

	}

}

?>