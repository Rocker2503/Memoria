<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Apoderados extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Apoderado');
	}

	function cargarApoderado($refAlumno)
	{
		$data['apoderados'] = $this->Apoderado->cargarApoderado($refAlumno);
		$data['refAlumno'] = $refAlumno;
		$this->load->view('header');
		$this->load->view('Apoderados',$data);
	}

	function agregarApoderado()
	{
		$nivelpadre = $this->input->post('nivelpadre');
		$nivelmadre = $this->input->post('nivelmadre');
		$nombre = $this->input->post('nombre');
		$rut = $this->input->post('rut');
		$direccion = $this->input->post('direccion');
		$telefono = $this->input->post('telefono');
		$email = $this->input->post('email');
		$emergencia = $this->input->post('emergencia');
		$refalumno = $this->input->post('refalumno');
		$this->Apoderado->agregarApoderado($nivelpadre,$nivelmadre,$nombre,$rut,$direccion,$telefono,$email,$emergencia,$refalumno);
	}

	function EditAjax($id)
	{
		$data = $this->Apoderado->obtenerApoderado($id);
		echo json_encode($data);
	}

	function editarApoderado()
	{
		$id = $this->input->post('id');
		$nivelpadre = $this->input->post('nivelpadre');
		$nivelmadre = $this->input->post('nivelmadre');
		$nombre = $this->input->post('nombre');
		$rut = $this->input->post('rut');
		$direccion = $this->input->post('direccion');
		$telefono = $this->input->post('telefono');
		$email = $this->input->post('email');
		$emergencia = $this->input->post('emergencia');
		$refalumno = $this->input->post('refalumno');
		$this->Apoderado->editarApoderado($id,$nivelpadre,$nivelmadre,$nombre,$rut,$direccion,$telefono,$email,$emergencia,$refalumno);
	}

	function eliminarApoderado()
	{
		$id = $this->input->post('id');
		$this->Apoderado->eliminarApoderado($id);
	}
}

?>