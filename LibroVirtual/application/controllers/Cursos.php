<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Curso');
	}

	function index(){
		$data['cursos'] = $this->Curso->cargarCursos();
		$this->load->view('header');
		$this->load->view('cursos',$data);
	}

	function agregarCurso()
	{
		$nivel = $this->input->post('nivel');
		$nombre = $this->input->post('nombre');
		$letra = $this->input->post('letra');
		$anio = $this->input->post('anio');

		$this->Curso->agregarCurso($nivel,$nombre,$letra,$anio);	
	}

	function EditAjax($id)
	{
		$data = $this->Curso->obtenerCurso($id);
		echo json_encode($data);
	}

	function EditarCurso()
	{
		$id = $this->input->post('id');
		$nivel = $this->input->post('nivel');
		$nombre = $this->input->post('nombre');
		$letra = $this->input->post('letra');
		$anio = $this->input->post('anio');

		$this->Curso->editarCurso($id,$nivel,$nombre,$letra,$anio);
	}

	function EliminarCurso()
	{
		$id = $this->input->post('id');
		$this->Curso->eliminarCurso($id);
	}
}

?>