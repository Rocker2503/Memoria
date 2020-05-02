<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alumnos</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
	
	<div class="main">
		<div class="container">
			<div class="py-2">
				<h2>Lista de Alumnos</h2>
			</div>
		</div>

		<div class="container">
			<div class="py-2">
				<a class="btn btn-outline-primary" onclick="agregarAlumno(<?= $refCurso; ?>)">Agregar Alumno</a>
			</div>
		</div>

		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
						<th>Nombres</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($alumnos as $row):?>
						<tr>
							<td> <?php echo $row->apellidoPaterno; ?> </td>
							<td> <?php echo $row->apellidoMaterno; ?> </td>
							<td> <?php echo $row->nombres; ?> </td>
							<td>
								<a class="btn btn-success" href="<?php echo base_url()?>apoderados/cargarApoderado/<?php echo $row->id?>">Apoderado</a>
								<button class="btn btn-primary" onclick="editarAlumno(<?=$row->id?>)">Editar</button>
								<button class="btn btn-danger" onclick="eliminarAlumno(<?=$row->id?>)">Eliminar</button>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
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
      		<input type="hidden" name="RefCurso" id="RefCurso" value="">
      		<div class="form-group col-md-12">
      			<label class="control-label">Apellido Paterno</label>
      			<input type="text" name="ApellidoPaterno" id="ApellidoPaterno" placeholder="Apellido Paterno" class="form-control">
      		</div>
      		<div class="form-group col-md-12">
      			<label class="control-label">Apellido Materno</label>
      			<input type="text" name="ApellidoMaterno" id="ApellidoMaterno" placeholder="Apellido Materno" class="form-control">
      		</div>
      		<div class="form-group col-md-12">
      			<label class="control-label">Nombres</label>
      			<input type="text" name="Nombres" id="Nombres" placeholder="Nombres" class="form-control">
      		</div>
      		<div class="form-group col-md-12">
      			<label class="control-label">RUT</label>
      			<input type="text" name="RUT" id="RUT" placeholder="RUT" class="form-control">
      		</div>
      		<div class="form-group col-md-12">
      			<label class="control-label">Sexo</label>
      			<select name="Sexo" id="Sexo" class="form-control">
      				<option value="F" selected>Femenino</option>
      				<option value="M">Masculino</option>
      			</select>
      		</div>
      		<div class="form-group col-md-12">
      			<label class="control-label">Fecha de Nacimiento</label>
      			<input type="date" name="FechaNacimiento" id="FechaNacimiento" placeholder="Fecha de Nacimiento" class="form-control">
      		</div>
      		<div class="form-group col-md-12">
      			<label class="control-label">Dirección</label>
      			<input type="text" name="Direccion" id="Direccion" placeholder="Dirección" class="form-control">
      		</div>
      		<div class="form-group col-md-12">
      			<label class="control-label">Comuna</label>
      			<input type="text" name="Comuna" id="Comuna" placeholder="Comuna" class="form-control">
      		</div>
      		<div class="form-group col-md-12">
      			<label class="control-label">Procedencia</label>
      			<input type="text" name="Procedencia" id="Procedencia" placeholder="Procedencia" class="form-control">
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


</html>

<script type="text/javascript">
	
	var save_method;

	function agregarAlumno(refCurso){
		save_method = "Add";
		$('form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('#myModal').modal('show');
		$('.modal-title').text('Agregar Alumno');
		document.getElementById('RefCurso').value = refCurso;
	}

	function editarAlumno(id)
	{
		save_method="Update";
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		var base_url = "<?php echo base_url()?>";
		$.ajax({
			url: base_url + "Alumnos/EditAjax/" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data){
				$('[name=Id]').val(data.id);
				$('[name=ApellidoPaterno]').val(data.apellidoPaterno);
				$('[name=ApellidoMaterno]').val(data.apellidoMaterno);
				$('[name=Nombres]').val(data.nombres);
				$('[name=RUT]').val(data.rut);
				$('[name=Sexo]').val(data.sexo);
				$('[name=FechaNacimiento]').val(data.fechaNacimiento);
				$('[name=Direccion]').val(data.direccion);
				$('[name=Comuna]').val(data.comuna);
				$('[name=Procedencia]').val(data.procedencia);
				$('[name=RefCurso]').val(data.refCurso);
				$('#myModal').modal('show');
				$('.modal-title').text('Editar Alumno');
			}
		});
	}

	function guardar(){
		$('#btnSave').text('Guardando...');
		$('#btnSave').attr('disabled',true);
		var base_url = "<?php echo base_url()?>";

		var id = $('#Id').val();
		var apellidopaterno = $('#ApellidoPaterno').val();
		var apellidomaterno = $('#ApellidoMaterno').val();
		var nombres = $('#Nombres').val();
		var rut = $('#RUT').val();
		var sexo = $('#Sexo').val();
		var fechanacimiento = $('#FechaNacimiento').val();
		var direccion = $('#Direccion').val();
		var comuna = $('#Comuna').val();
		var procedencia = $('#Procedencia').val();
		var refcurso = $('#RefCurso').val();

		console.log(refcurso);

		if(save_method == "Add"){
			base_url = base_url + "Alumnos/agregarAlumno";
			$.post(
				base_url,
				{
					apellidopaterno: apellidopaterno,
					apellidomaterno: apellidomaterno,
					nombres: nombres,
					rut: rut,
					sexo: sexo,
					fechanacimiento: fechanacimiento,
					direccion: direccion,
					comuna: comuna,
					procedencia: procedencia,
					refcurso: refcurso
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}else{
			base_url = base_url + "Alumnos/editarAlumno";
			$.post(
				base_url,
				{
					id: id,
					apellidopaterno: apellidopaterno,
					apellidomaterno: apellidomaterno,
					nombres: nombres,
					rut: rut,
					sexo: sexo,
					fechanacimiento: fechanacimiento,
					direccion: direccion,
					comuna: comuna,
					procedencia: procedencia,
					refcurso: refcurso
				},function(){
					$('#myModal').modal('hide');
					location.reload();	
				}
			);
		}
	}

	function eliminarAlumno(id){
		if(confirm('¿Está seguro que desea eliminar este alumno?')){
			var base_url = "<?php echo base_url()?>" + "Alumnos/eliminarAlumno";
			$.post(
				base_url,
				{
					id: id
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}
	}

</script>