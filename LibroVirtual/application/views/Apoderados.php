<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Apoderados</title>

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
				<?php foreach($alumno as $row):?>
				<h2>Apoderado de <?php echo "{$row->nombres} {$row->apellidoPaterno} {$row->apellidoMaterno}";?></h2>
				<?php endforeach;?>
			</div>
		</div>

		<div class="container">
			<div class="py-2">
				<button class="btn btn-success" onclick="agregarApoderado(<?= $refAlumno; ?>)"><i class="fa fa-plus"></i> Apoderado</button>
			</div>
		</div>

		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Dirección</th>
						<th>Teléfono</th>
						<th>Correo</th>
						<th>N° de Emergencia</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($apoderados as $row): ?>
						<tr>
							<td><?php echo $row->nombre; ?></td>
							<td><?php echo $row->direccion; ?></td>
							<td><?php echo $row->telefono; ?></td>
							<td><?php echo $row->email; ?></td>
							<td><?php echo $row->emergencia; ?></td>
							<td>
								<a href="#" class="btn btn-primary" onclick="editarApoderado(<?=$row->id;?>)">Editar</a>
								<a href="#" class="btn btn-danger" onclick="eliminarApoderado(<?=$row->id;?>)">Eliminar</a>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
		
	</div>

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
        	<input type="hidden" name="RefAlumno" id="RefAlumno" value="">
        	<div class="form-group col-md-12">
        		<label class="control-label">Nivel Educacional Padre</label>
        		<input type="text" name="NivelPadre" id="NivelPadre" placeholder="Nivel Educacional del Padre" class="form-control">
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">Nivel Educacional Madre</label>
        		<input type="text" name="NivelMadre" id="NivelMadre" placeholder="Nivel Educacional de la Madre" class="form-control">
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">Nombre</label>
        		<input type="text" name="Nombre" id="Nombre" placeholder="Nombre" class="form-control">
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">RUT</label>
        		<input type="text" name="RUT" id="RUT" placeholder="RUT" class="form-control">
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">Dirección</label>
        		<input type="text" name="Direccion" id="Direccion" placeholder="Dirección" class="form-control">
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">Teléfono</label>
        		<input type="number" name="Telefono" id="Telefono" placeholder="Teléfono" class="form-control">
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">Correo</label>
        		<input type="email" name="Email" id="Email" placeholder="Correo" class="form-control">
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">N° de Emergencia</label>
        		<input type="number" name="Emergencia" id="Emergencia" placeholder="N° de Emergencia" class="form-control">
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

</body>
</html>

<script type="text/javascript">
	
	var save_method;

	function agregarApoderado(refAlumno)
	{
		save_method = "Add";
		$('form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('#myModal').modal('show');
		$('.modal-title').text('Agregar Apoderado');
		document.getElementById('RefAlumno').value = refAlumno;
	}

	function editarApoderado(id)
	{
		save_method="Update";
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		var base_url = "<?php echo base_url()?>";
		$.ajax({
			url: base_url + "Apoderados/EditAjax/" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data){
				$('[name=Id]').val(data.id);
				$('[name=NivelPadre]').val(data.nivelPadre);
				$('[name=NivelMadre]').val(data.nivelMadre);
				$('[name=Nombre]').val(data.nombre);
				$('[name=RUT]').val(data.rut);
				$('[name=Direccion]').val(data.direccion);
				$('[name=Telefono]').val(data.telefono);
				$('[name=Email]').val(data.email);
				$('[name=Emergencia]').val(data.emergencia);
				$('[name=RefAlumno]').val(data.refAlumno);
				$('#myModal').modal('show');
				$('.modal-title').text('Editar Apoderado');
			}
		});
	}

	function guardar()
	{
		$('#btnSave').text('Guardando...');
		$('#btnSave').attr('disabled',true);
		var base_url = "<?php echo base_url()?>";

		var id = $('#Id').val();
		var nivelpadre = $('#NivelPadre').val();
		var nivelmadre = $('#NivelMadre').val();
		var nombre = $('#Nombre').val();
		var rut = $('#RUT').val();
		var direccion = $('#Direccion').val();
		var telefono = $('#Telefono').val();
		var email = $('#Email').val();
		var emergencia = $('#Emergencia').val();
		var refalumno = $('#RefAlumno').val();

		if(nivelpadre == "" || nivelmadre == "" || nombre == "" || rut == "" || direccion == "" || telefono == "" || email == "" || emergencia == "")
		{
			alert("Todos los campos deben estar completos");
			$('#btnSave').text('Guardar');
			$('#btnSave').attr('disabled',false);
			return;
		}

		if(save_method == "Add"){
			base_url = base_url + "Apoderados/agregarApoderado";
			$.post(
				base_url,
				{
					nivelpadre: nivelpadre,
					nivelmadre: nivelmadre,
					nombre: nombre,
					rut: rut,
					direccion: direccion,
					telefono: telefono,
					email: email,
					emergencia: emergencia,
					refalumno: refalumno
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}else{
			base_url = base_url + "Apoderados/editarApoderado";
			$.post(
				base_url,
				{
					id: id,
					nivelpadre: nivelpadre,
					nivelmadre: nivelmadre,
					nombre: nombre,
					rut: rut,
					direccion: direccion,
					telefono: telefono,
					email: email,
					emergencia: emergencia,
					refalumno: refalumno
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}
	}

	function eliminarApoderado(id){
		if(confirm('¿Está seguro que desea eliminar este apoderado?')){
			var base_url = "<?php echo base_url()?>" + "Apoderados/eliminarApoderado";
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