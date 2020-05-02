<?php


class Apoderado extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	function cargarApoderado($refAlumno)
	{
		$query = "SELECT * FROM Apoderado WHERE apoderado.refAlumno = '$refAlumno'";
		$resultados = $this->db->query($query)->result();
		return $resultados;
	}

	function agregarApoderado($nivelpadre,$nivelmadre,$nombre,$rut,$direccion,$telefono,$email,$emergencia,$refalumno)
	{
		$data = array(
			'nivelPadre' => $nivelpadre,
			'nivelMadre' => $nivelmadre,
			'nombre' => $nombre,
			'rut' => $rut,
			'direccion' => $direccion,
			'telefono' => $telefono,
			'email' => $email,
			'emergencia' => $emergencia,
			'refAlumno' => $refalumno
		);	

		$this->db->insert('Apoderado',$data);
	}

	function obtenerApoderado($id)
	{
		$query = "SELECT * FROM Apoderado WHERE apoderado.id = '$id'";
		$resultados = $this->db->query($query)->row();
		return $resultados;
	}

	function editarApoderado($id,$nivelpadre,$nivelmadre,$nombre,$rut,$direccion,$telefono,$email,$emergencia,$refalumno)
	{
		$data = array(
			'id' => $id,
			'nivelPadre' => $nivelpadre,
			'nivelMadre' => $nivelmadre,
			'nombre' => $nombre,
			'rut' => $rut,
			'direccion' => $direccion,
			'telefono' => $telefono,
			'email' => $email,
			'emergencia' => $emergencia,
			'refAlumno' => $refalumno
		);

		$this->db->where('id',$id);
		$this->db->update('Apoderado',$data);
	}

	function eliminarApoderado($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('Apoderado');
	}
}

?>