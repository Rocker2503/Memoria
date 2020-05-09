<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Asignaturas extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Asignatura');
	}

	function cargarAsignaturas($refCurso)
	{
		$data['asignaturas'] = $this->Asignatura->cargarAsignaturas($refCurso);
		$data['curso'] = $this->Asignatura->obtenerCurso($refCurso);
		$data['refCurso'] = $refCurso;
		$this->load->view('header');
		$this->load->view('asignaturas', $data);
	}

	function agregarAsignatura()
	{
		$nombre = $this->input->post('nombre');
		$horasSemanales = $this->input->post('horasSemanales');
		$refCurso = $this->input->post('refCurso');
		$this->Asignatura->agregarAsignatura($nombre,$horasSemanales,$refCurso);
	}

	function EditAjax($id)
	{
		$data = $this->Asignatura->obtenerAsignatura($id);
		echo json_encode($data);
	}

	function EditarAsignatura()
	{
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');
		$horasSemanales = $this->input->post('horasSemanales');
		$refCurso = $this->input->post('refCurso');
		$this->Asignatura->editarAsignatura($id,$nombre,$horasSemanales,$refCurso);
	}

	function EliminarAsignatura()
	{
		$id = $this->input->post('id');
		$this->Asignatura->eliminarAsignatura($id);
	}

	function detalles($id)
	{
		$this->load->view('header');
		$data['id'] = $id;
		$this->load->view('DetalleAsignatura', $data);
	}
}
?>