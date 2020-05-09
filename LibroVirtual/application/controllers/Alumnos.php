<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Alumnos extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Alumno');
	}

	function cargarAlumnos($refCurso)
	{
		$data['alumnos'] = $this->Alumno->cargarAlumnos($refCurso);
		$data['curso'] = $this->Alumno->obtenerCurso($refCurso);
		$data['refCurso'] = $refCurso;
		$this->load->view('header');
		$this->load->view('alumnos',$data);
	}

	function agregarAlumno()
	{
		$apellidopaterno = $this->input->post('apellidopaterno');
		$apellidomaterno = $this->input->post('apellidomaterno');
		$nombres = $this->input->post('nombres');
		$rut = $this->input->post('rut');
		$sexo = $this->input->post('sexo');
		$fechanacimiento = $this->input->post('fechanacimiento');
		$direccion = $this->input->post('direccion');
		$comuna = $this->input->post('comuna');
		$procedencia = $this->input->post('procedencia');
		$refcurso = $this->input->post('refcurso');
		$this->Alumno->agregarAlumno($apellidopaterno,$apellidomaterno,$nombres,$rut,$sexo,$fechanacimiento,$direccion,$comuna,$procedencia,$refcurso);
 	}

 	function EditAjax($id)
 	{
 		$data = $this->Alumno->obtenerAlumno($id);
 		echo json_encode($data);
 	}

 	function editarAlumno()
 	{
 		$id = $this->input->post('id');
 		$apellidopaterno = $this->input->post('apellidopaterno');
		$apellidomaterno = $this->input->post('apellidomaterno');
		$nombres = $this->input->post('nombres');
		$rut = $this->input->post('rut');
		$sexo = $this->input->post('sexo');
		$fechanacimiento = $this->input->post('fechanacimiento');
		$direccion = $this->input->post('direccion');
		$comuna = $this->input->post('comuna');
		$procedencia = $this->input->post('procedencia');
		$refcurso = $this->input->post('refcurso');
		$this->Alumno->editarAlumno($id,$apellidopaterno,$apellidomaterno,$nombres,$rut,$sexo,$fechanacimiento,$direccion,$comuna,$procedencia,$refcurso);
 	}

 	function eliminarAlumno()
 	{
 		$id = $this->input->post('id');
 		$this->Alumno->eliminarAlumno($id);
 	}
}


?>