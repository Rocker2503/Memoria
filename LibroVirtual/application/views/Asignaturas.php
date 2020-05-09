<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Asignaturas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <div class="main">
		<div class="container">
			<div class="py-2">
				<?php foreach($curso as $row): ?>
				<h2> Asignaturas de <?php echo "{$row->nombre} {$row->letra}"; ?></h2>
				<?php endforeach;?>
			</div>
		</div>

		<div class="container">
			<div class="py-2">
				<button class="btn btn-success" onclick="agregarAsignatura(<?=$refCurso;?>)"><i class="fa fa-plus"></i> Asignatura</button>
				<a class="btn btn-primary" href="<?php echo base_url();?>alumnos/cargarAlumnos/<?php echo $refCurso?>"><i class="fa fa-eye"></i> Alumnos</a>
			</div>
		</div>


		<div class="container">
			<div class="row" id="listado">
				<?php foreach ($asignaturas as $row): ?>
					<div class="col-4">
					<div class="card flex-row flex-wrap bg-light">
						<div class="card-header border-1">
							<img src="https://image.flaticon.com/icons/svg/2196/2196561.svg" class="card-img-top" height="60" width="60">
						</div>
						<div class="card-block px-2">
							<a href="<?php echo base_url();?>asignaturas/detalles/<?php echo $row->id; ?>"><h5><?php echo "{$row->nombre}";?></h5></a>
							<p> Horas semanales: <?php echo $row->horassemanales;?></p>
							<div style="margin-bottom: 5px">
							<button class="btn btn-primary" onclick="editarAsignatura(<?= $row->id?>)"><i class="fa fa-pencil"></i></button>
							<button class="btn btn-danger" onclick="eliminarAsignatura(<?= $row->id?>)"><i class="fa fa-close"></i></button>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach ?>
			</div>
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
      		<div class="form-group">
      			<label class="control-label col-md-3">Nombre</label>
      			<div class="col-md-9">
      				<input type="text" name="Nombre" id="Nombre" placeholder="Nombre" class="form-control">	
      			</div>
      		</div>
      		<div class="form-group">
      			<label class="control-label col-md-3">Horas Semanales</label>
      			<div class="col-md-9">
      				<input type="number" name="HorasSemanales" id="HorasSemanales" placeholder="Horas Semanales" class="form-control">
      			</div>
      		</div>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" class="btn btn-primary" onclick="guardar()">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

</html>

<script type="text/javascript">
	
	var save_method;

	function agregarAsignatura(refCurso){
		save_method = "Add";
		$('form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('#myModal').modal('show');
		$('.modal-title').text('Agregar Asignatura');
		document.getElementById('RefCurso').value = refCurso;
	}

	function editarAsignatura(id){
		save_method = "Update";
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		var base_url = "<?php echo base_url()?>";
		$.ajax({
			url: base_url + "asignaturas/EditAjax/" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data){
				$('[name=Id]').val(data.id);
				$('[name=Nombre]').val(data.nombre);
				$('[name=HorasSemanales]').val(data.horassemanales);
				$('[name=RefCurso]').val(data.refCurso);
				$('#myModal').modal('show');
				$('.modal-title').text('Editar Asignatura');
			}
		});
	}

	function guardar(){
		$('#btnSave').text('Guardando...');
		$('#btnSave').attr('disabled',true);
		var base_url = "<?php echo base_url()?>";

		var id = $('#Id').val();
		var nombre = $('#Nombre').val();
		var horasSemanales = $('#HorasSemanales').val();
		var refCurso = $('#RefCurso').val();

		if(nombre == "" || horasSemanales == "")
		{
			alert("Todos los campos deben estar completos");
			$('#btnSave').text('Guardar');
			$('#btnSave').attr('disabled',false);
			return;
		}

		if(save_method == "Add"){
			base_url = base_url + "Asignaturas/agregarAsignatura";
			$.post(
				base_url,
				{
					nombre: nombre,
					horasSemanales: horasSemanales,
					refCurso: refCurso
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}else{
			base_url = base_url + "Asignaturas/EditarAsignatura";
			$.post(
				base_url,
				{
					id: id,
					nombre: nombre,
					horasSemanales: horasSemanales,
					refCurso: refCurso
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}
	}

	function eliminarAsignatura(id){
		if(confirm('¿Está seguro que desea eliminar la asignatura?')){
			var base_url = "<?php echo base_url()?>" + "Asignaturas/EliminarAsignatura";
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