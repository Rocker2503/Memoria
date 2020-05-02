<?php
	/**
	 * 
	 */
class Curso extends CI_Model
{
		
	function __construct()
	{
		$this->load->database();
	}

	function cargarCursos(){
		$query = "Select * from curso";

		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function agregarCurso($nivel,$nombre,$letra,$anio)
	{
		$data = array(
			'nivel' => $nivel,
			'nombre' => $nombre,
			'letra' => $letra,
			'anio' => $anio
		);

		$this->db->insert('curso', $data);
	}

	function obtenerCurso($id)
	{
		$query = "SELECT * from Curso WHERE curso.id = '$id'";

		$resultados = $this->db->query($query)->row();
		return $resultados;
	}

	function editarCurso($id,$nivel,$nombre,$letra,$anio)
	{
		$data = array(
			'id' => $id,
			'nivel' => $nivel,
			'nombre' => $nombre,
			'letra' => $letra,
			'anio' => $anio
		);

		$this->db->where("id",$id);
		$this->db->update("Curso",$data);
	}

	function eliminarCurso($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('Curso');
	}

}
?>