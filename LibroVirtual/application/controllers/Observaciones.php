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
		$this->load->view('ListaAlumnos',$data);
	}

	function verHojaVida($refAlumno,$refAsignatura)
	{
		$data['asignatura'] = $refAsignatura;
		$data['refAlumno'] = $refAlumno;
		$data['observaciones'] = $this->Observacion->obtenerObservaciones($refAlumno);
		$data['alumno'] = $this->Observacion->obtenerAlumno($refAlumno);
		
		$this->load->view('header');
		$this->load->view('Observaciones',$data);
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

	function eliminarObservacion()
	{
		$id = $this->input->post('id');
		$this->Observacion->eliminarObservacion($id);
	}
}

?>