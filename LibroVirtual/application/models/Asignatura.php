<?php

/**
 * 
 */
class Asignatura extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	function cargarAsignaturas($refCurso)
	{
		$query = "SELECT * FROM Asignatura WHERE asignatura.refCurso = '$refCurso'";

		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function obtenerCurso($refCurso)
	{
		$query = "SELECT * FROM Curso WHERE curso.id = '$refCurso'";
		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function agregarAsignatura($nombre, $horasSemanales, $refCurso)
	{
		$data = array(
			'nombre' => $nombre,
			'horasSemanales' => $horasSemanales,
			'refCurso' => $refCurso
		);

		$this->db->insert('asignatura',$data);
	}

	function obtenerAsignatura($id)
	{
		$query = "SELECT * FROM Asignatura WHERE asignatura.id = '$id'";
		$resultados = $this->db->query($query)->row();
		return $resultados;
	}

	function editarAsignatura($id,$nombre, $horasSemanales, $refCurso)
	{
		$data = array(
			'id' => $id,
			'nombre' => $nombre,
			'horasSemanales' => $horasSemanales,
			'refCurso' => $refCurso
		);

		$this->db->where("id",$id);
		$this->db->update('Asignatura',$data);
	}

	function eliminarAsignatura($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('Asignatura');
	}
}

?>