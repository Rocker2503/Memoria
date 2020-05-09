<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistencias extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Asistencia');		
	}

	function listarAlumnos($id)
	{
		$data['alumnos'] = $this->Asistencia->listarAlumnos($id);
		$data['refAsignatura'] = $id;
		$this->load->view('header');
		$this->load->view('Asistencia',$data);
	}

	function tomarAsistencia()
	{
		$this->load->helper('url');
		if(isset($_POST['submit'])){
			$stdid = $this->input->post('Id');
			$refAsignatura = $this->input->post('refAsignatura');
			$fecha = $this->input->post('Fecha');
			$rows = count($stdid);
			for($i=0; $i<$rows;$i++){
				$at = $i+1;
				
				$refAlumno = $stdid[$i];
				$asistencia = $_POST[$at];
				$this->Asistencia->actualizarAsistencia($refAlumno,$asistencia,$fecha);				
			}
			
			redirect(base_url().'Asignaturas/detalles/'.$refAsignatura);
		}
	}
}

?>