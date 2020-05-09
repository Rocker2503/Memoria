<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Observacion');
	}

	function listarAlumnos($id)
	{
		$data['alumnos'] = $this->Observacion->listarAlumnos($id);
		$data['refAsignatura'] = $id;
		$this->load->view('header');
		$this->load->view('Observaciones',$data);
	}

	function ObtenerAnotaciones()
	{
		$refAlumno = $this->input->post('refalumno');
		$data = $this->Observacion->obtenerObservaciones($refAlumno);
		echo json_encode($data);
	}

	function obtenerDatos($refAsignatura)
	{
		$data = $this->Observacion->obtenerDatos($refAsignatura);
		echo json_encode($data);
	}

	function agregarObservacion()
	{
		$refAsignatura = $this->input->post('refasignatura');
		$refAlumno = $this->input->post('refalumno');
		$fecha = $this->input->post('fecha');
		$tipo = $this->input->post('tipo');
		$comentario = $this->input->post('comentario');
		$this->Observacion->agregarObservacion($refAsignatura,$refAlumno,$fecha,$tipo,$comentario);
	}

	function EditAjax($id)
	{
		$data = $this->Observacion->obtenerObservacion($id);
		echo json_encode($data);
	}

	function editarObservacion()
	{
		$id = $this->input->post('id');
		$refAsignatura = $this->input->post('refasignatura');
		$refAlumno = $this->input->post('refalumno');
		$fecha = $this->input->post('fecha');
		$tipo = $this->input->post('tipo');
		$comentario = $this->input->post('comentario');
		$this->Observacion->editarObservacion($id,$refAsignatura,$refAlumno,$fecha,$tipo,$comentario);
	}

	function eliminarObservacion()
	{
		$id = $this->input->post('id');
		$this->Observacion->eliminarObservacion($id);
	}
}

?>