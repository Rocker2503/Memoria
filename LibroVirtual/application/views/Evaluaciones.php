<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Evaluaciones</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>

	<div class="main">
		<div class="container">
			<div class="py-2">
				<?php foreach($asignatura as $row):?>
				<h2>Evaluaciones de <?php echo $row->nombre ?></h2>
				<?php endforeach;?>
			</div>
		</div>

		<div class="container">
			<div class="py-2">
				<button class="btn btn-success" onclick="agregarEvaluacion(<?=$refAsignatura?>)"><i class="fa fa-plus"></i> Evaluación</button>
				<button class="btn btn-primary" onclick="calcular()"><i class="fa fa-eye"></i> Promedios</button>
			</div>
		</div>

		<div id="accordion" class="container">
			<?php $i=1; foreach($evaluaciones as $row):?>
				<div class="card bg-light">
					<div class="card-header" style="margin-bottom:5px">
						<h5 class="mb-0">
							<?php echo $row->nombre?>
							<button onclick="eliminar(<?=$row->id?>)"class="btn btn-danger pull-right"><i class="fa fa-close"></i></button>
							<button style="margin-right:5px" onclick="editar(<?=$row->id?>)" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i></button>
							<button class="btn btn-success pull-right" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapseOne" style="margin-right:5px" onclick="llenarTabla(<?=$refAsignatura?>,<?=$row->id?>)"><i class="fa fa-check"></i></button>
						</h5>
						<?php $fecha = date('d-m-Y' , strtotime($row->fecha));?>
						<p><?php echo "Fecha: {$fecha}" ?></p>
					</div>
					<div id="collapse<?=$i?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							<div class="container">
								<table id="table<?=$row->id?>" class="table">
									<thead>
										<tr>
											<th>Apellido Paterno</th>
											<th>Apellido Materno</th>
											<th>Nombres</th>
											<th>Nota</th>
										</tr>
									</thead>
									<tbody id="body<?=$row->id?>">
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			<?php $i++; endforeach;?>
		</div>

	</div>
</body>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" id="form" class="form-horizontal">
        	<input type="hidden" name="Id" id="Id" value="">
        	<input type="hidden" name="RefAsignatura" id="RefAsignatura" value="">
        	<div class="form-group col-md-12">
        		<label class="control-label">Nombre</label>
        		<input type="text" name="Nombre" id="Nombre" placeholder="Nombre" class="form-control" required>
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">Fecha</label>
        		<input type="date" name="Fecha" id="Fecha" placeholder="Fecha" class="form-control"required>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" id="btnSave" onclick="guardar()" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" id="form2" class="form-horizontal">
        	<input type="hidden" name="refAsignatura" id="refAsignatura" value="<?php echo $refAsignatura?>">
        	<div class="col-md-12">
        		<label class="control-label">Periodo</label>
        		<select class="form-control" name="refPeriodo" id="refPeriodo">
        			<?php $i=1 ;foreach($periodos as $row):?>
        				<option value="<?php echo $row->id?>"><?php echo $i;?></option>
        			<?php $i++;endforeach;?>
        		</select>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" id="btnAceptar" onclick="seleccionar()" class="btn btn-primary" >Aceptar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


</html>

<script type="text/javascript">
	
	var save_method;

	function llenarTabla(refAsignatura, refEvaluacion)
	{
		var refasignatura = refAsignatura;
		var refevaluacion = refEvaluacion;

		var base_url = "<?php echo base_url()?>";
		$.ajax({
			url: base_url + "Evaluaciones/verificarEvaluaciones",
			type: "POST",
			data: {refasignatura, refevaluacion},
			success: function(response){
				if(response == 'true')
				{
					$.ajax({
						url: base_url + "Evaluaciones/obtenerCalificaciones",
						type: "POST",
						data: {refasignatura,refevaluacion},
						dataType: "JSON",
						success: function(data)
						{
							var evaluacion_data = '';
							$.each(data,function(key,value){
								evaluacion_data += '<tr>';
								evaluacion_data += '<input type="hidden" id="RefAlumno'+value.id+'" value="'+value.id+'"/>';
								evaluacion_data += '<input type="hidden" id="RefAsignatura" value="'+refasignatura+'"/>';
								evaluacion_data += '<input type="hidden" id="RefEvaluacion" value="'+refevaluacion+'"/>';
								evaluacion_data += '<td>'+value.apellidoPaterno+'</td>';
								evaluacion_data += '<td>'+value.apellidoMaterno+'</td>';
								evaluacion_data += '<td>'+value.nombres+'</td>';
								evaluacion_data += '<td><input type="number" step="0.1" min="1.0" max="7.0" class="form-control" id="nota'+value.id+'" value="'+value.nota+'" onfocusout="obtenerValores('+value.id+')"/>';
								evaluacion_data += '</tr>';
							});
							$('#body'+refevaluacion).empty();
							$('#body'+refevaluacion).append(evaluacion_data);
						}
					});
				}else
				{
					$.ajax({
						url: base_url + "Evaluaciones/obtenerAlumnos",
						type: "POST",
						data: {refasignatura},
						dataType: "JSON",
						success: function(data)
						{
							var evaluacion_data = '';
							$.each(data, function(key,value){
								evaluacion_data += '<tr>';
								evaluacion_data += '<input type="hidden" id="RefAlumno'+value.id+'" value="'+value.id+'"/>';
								evaluacion_data += '<input type="hidden" id="RefAsignatura" value="'+refasignatura+'"/>';
								evaluacion_data += '<input type="hidden" id="RefEvaluacion" value="'+refevaluacion+'"/>';
								evaluacion_data += '<td>'+value.apellidoPaterno+'</td>';
								evaluacion_data += '<td>'+value.apellidoMaterno+'</td>';
								evaluacion_data += '<td>'+value.nombres+'</td>';
								evaluacion_data += '<td><input type="number" step="0.1" min="1.0" max="7.0" id="nota'+value.id+'" onfocusout="obtenerValores('+value.id+')" class="form-control"/>';
								evaluacion_data += '</tr>';
								
							});
							$('#body'+refevaluacion).empty();
							$('#body'+refevaluacion).append(evaluacion_data);
						}
					});
				}
			}
		});
	}

	function obtenerValores(indice)
	{
		var alumno = $('#RefAlumno'+indice).val();
		var asignatura = $('#RefAsignatura').val();
		var evaluacion = $('#RefEvaluacion').val();
		var nota = $('#nota'+indice).val();

		var base_url = "<?php echo base_url()?>Evaluaciones/agregarNota";
		$.post(
			base_url,
			{
				refalumno: alumno,
				refasignatura: asignatura,
				refevaluacion: evaluacion,
				nota: nota
			}
		);
		
	}

	function agregarEvaluacion(refAsignatura)
	{
		save_method = "Add";
		$('form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('#myModal').modal('show');
		$('.modal-title').text('Agregar Evaluación');
		document.getElementById('RefAsignatura').value = refAsignatura;
	}

	function calcular()
	{
		$('form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('#myModal2').modal('show');
		$('.modal-title').text('Seleccione el periodo para calcular promedios');
	}

	function seleccionar()
	{
		var refasignatura = $('#refAsignatura').val();
		var refperiodo = $('#refPeriodo').val();

		var base_url = "<?php echo base_url()?>";
		$.ajax({
			url: base_url + "Evaluaciones/CalcularPromedios",
			type: "POST",
			data: {refasignatura, refperiodo},
			success: function()
			{
				$("#myModal2").modal('hide');
				location = base_url + "Evaluaciones/verPromedios/" + refasignatura + "/" + refperiodo;
			}
		});
	}

	function editar(id)
	{
		save_method = "Update";
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		var base_url = "<?php echo base_url()?>";
		$.ajax({
			url: base_url + "Evaluaciones/EditAjax/" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data){
				$('[name=Id]').val(data.id);
				$('[name=Nombre]').val(data.nombre);
				$('[name=Fecha]').val(data.fecha);
				$('[name=RefAsignatura]').val(data.refAsignatura);
				$('#myModal').modal('show');
				$('.modal-title').text('Editar Evaluación');
			}
		});
	}

	function guardar()
	{
		$('#btnSave').text('Guardando...');
		$('#btnSave').attr('disabled',true);
		var base_url = "<?php echo base_url()?>"

		var id = $('#Id').val();
		var nombre = $('#Nombre').val();
		var fecha = $('#Fecha').val();
		var refasignatura = $('#RefAsignatura').val();

		if(nombre == "" || fecha == ""){
			alert("Todos los campos deben estar completos");
			$('#btnSave').text('Guardar');
			$('#btnSave').attr('disabled',false);
			return;
		}

		if(save_method == "Add"){
			base_url = base_url + "Evaluaciones/agregarEvaluacion";
			$.post(
				base_url,
				{
					nombre: nombre,
					fecha: fecha,	
					refasignatura: refasignatura
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}else{
			base_url = base_url + "Evaluaciones/editarEvaluacion";
			$.post(
				base_url,
				{
					id: id,
					nombre: nombre,
					fecha: fecha,	
					refasignatura: refasignatura
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}
	}

	function eliminar(id)
	{
		if(confirm('¿Está seguro que desea eliminar la evaluación?'))
		{
			var base_url = "<?php echo base_url()?>" + "Evaluaciones/eliminarEvaluacion";
			$.post(
				base_url,
				{
					id: id
				}, function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}
	}

</script>