<?php


class Evaluaciones extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Evaluacion');
	}

	function cargarEvaluaciones($refAsignatura)
	{
		$data['evaluaciones'] = $this->Evaluacion->obtenerEvaluaciones($refAsignatura);
		$data['refAsignatura'] = $refAsignatura;
		$data['asignatura'] = $this->Evaluacion->obtenerNombreAsignatura($refAsignatura);
		$data['periodos'] = $this->Evaluacion->obtenerPeriodos();

		$this->load->view('header');
		$this->load->view('Evaluaciones',$data);
	}

	function agregarEvaluacion()
	{
		$nombre = $this->input->post('nombre');
		$fecha = $this->input->post('fecha');
		$refasignatura = $this->input->post('refasignatura');
		$this->Evaluacion->agregarEvaluacion($nombre,$fecha,$refasignatura);
	}

	function eliminarEvaluacion()
	{
		$id = $this->input->post('id');
		$this->Evaluacion->eliminarEvaluacion($id);
	}

	function EditAjax($id)
	{
		$data = $this->Evaluacion->obtenerEvaluacion($id);
		echo json_encode($data);
	}

	function editarEvaluacion()
	{
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');
		$fecha = $this->input->post('fecha');
		$refasignatura = $this->input->post('refasignatura');
		$this->Evaluacion->editarEvaluacion($id,$nombre,$fecha,$refasignatura);
	}

	function verificarEvaluaciones()
	{
		$refAsignatura = $this->input->post('refasignatura');
		$refEvaluacion = $this->input->post('refevaluacion');

		$existe = $this->Evaluacion->existeCalificacion($refAsignatura,$refEvaluacion);
		if($existe == false)
		{
			$response = 'false';
			echo $response;
		}else
		{
			$response = 'true';
			echo $response;
		}
	}

	function obtenerCalificaciones()
	{
		$refAsignatura = $this->input->post('refasignatura');
		$refEvaluacion = $this->input->post('refevaluacion');
		$data = $this->Evaluacion->obtenerNotas($refAsignatura,$refEvaluacion);
		echo json_encode($data);
	}

	function obtenerAlumnos()
	{
		$refAsignatura = $this->input->post('refasignatura');
		$data = $this->Evaluacion->listarAlumnos($refAsignatura);
		echo json_encode($data);
	}

	function agregarNota()
	{
		$refAlumno = $this->input->post('refalumno');
		$refAsignatura = $this->input->post('refasignatura');
		$refEvaluacion = $this->input->post('refevaluacion');
		$nota = $this->input->post('nota');
		$this->Evaluacion->calificarEvaluacion($refAlumno,$refAsignatura,$refEvaluacion,$nota);
	}

	function CalcularPromedios()
	{
		$refAsignatura = $this->input->post('refasignatura');
		$refPeriodo = $this->input->post('refperiodo');

		$promedios = $this->Evaluacion->calcularPromedios($refAsignatura,$refPeriodo);
		foreach($promedios as $row)
		{
			$promedio = round($row->promedio, 1, PHP_ROUND_HALF_UP);
			$refAlumno = $row->id;
			$this->Evaluacion->actualizarPromedioAsignatura($refAlumno,$refAsignatura,$refPeriodo,$promedio);
		}
	}

	function verPromedios($refAsignatura,$refPeriodo)
	{
		$data['promedios'] = $this->Evaluacion->obtenerPromediosAsignatura($refAsignatura,$refPeriodo);
		$data['asignatura'] = $this->Evaluacion->obtenerNombreAsignatura($refAsignatura);
		$this->load->view('header');
		$this->load->view('PromediosAsignatura',$data);
	}
}

?>