<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Observaciones</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

	<div class="main">
		 <div class="container">
		 	<section class="py-2">
		 		<?php foreach($alumno as $row):?>
		 			<h2><?php echo "{$row->nombres} {$row->apellidoPaterno} {$row->apellidoMaterno}" ?></h2>
		 		<?php endforeach; ?>
		 	</section>
		 </div>
		 <div class="container">
		 	<section class="py-2">
		 		<a class="btn btn-outline-primary" onclick="crearObservacion(<?=$refAlumno?>,<?=$asignatura?>)">Anotación</a>
		 	</section>
		 </div>

		 <div class="container">
		 	<table class="table table-striped">
		 		<thead>
		 			<tr>
		 				<th>Asignatura</th>
		 				<th>Fecha</th>
		 				<th>Tipo</th>
		 				<th>Comentario</th>
		 				<th></th>
		 			</tr>
		 		</thead>
		 		<tbody>
		 			<?php foreach($observaciones as $row):?>
		 				<tr>
		 					<td> <?php echo $row->nombre; ?> </td>
		 					<td> <?php echo $row->fecha; ?> </td>
		 					<td>
		 						<?php if($row->tipo == 0){
		 							echo "Negativa";
		 						}else{
		 							echo "Positiva";
		 						}
		 						?>
		 					</td>
		 					<td> <?php echo $row->comentario; ?> </td>
		 					<td>
		 						<?php if($row->refAsignatura == $asignatura):?>
		 							<button class="btn btn-primary">Editar</button>
		 							<button class="btn btn-danger" onclick="eliminarObservacion(<?=$row->id;?>)">Eliminar</button>
		 						<?php endif;?>
		 					</td>
		 				</tr>
		 			<?php endforeach; ?>
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
        	<input type="hidden" id="Id" name="Id" value="">
        	<input type="hidden" id="RefAsignatura" name="RefAsignatura" value="">
        	<input type="hidden" id="RefAlumno" name="RefAlumno" value="">
        	<div class="form-group col-md-12">
        		<label class="control-label">Asignatura</label>
        		<input type="text" id="Asignatura" name="Asignatura" value="" readonly class="form-control">
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">Fecha</label>
        		<input type="date" id="Fecha" name="Fecha" placeholder="Fecha" class="form-control">
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">Tipo</label>
        		<select class="form-control" id="Tipo" name="Tipo">
        			<option value="0">Negativa</option>
        			<option value="1" selected>Positiva</option>
        		</select>
        	</div>
        	<div class="form-group col-md-12">
        		<label class="control-label">Comentario</label>
        		<textarea class="form-control" id="Comentario" name="Comentario" placeholder="Comentario" rows="5"></textarea>
        	</div> 	
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" id="btnSave" onclick="guardar()" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

</html>

<script type="text/javascript">
	
	var save_method;

	function crearObservacion(refAlumno, refAsignatura)
	{
		save_method = "Add";
		var refalumno = refAlumno;
		var refasignatura = refAsignatura;
		var base_url = "<?php echo base_url()?>Observaciones/obtenerDatos/"
		document.getElementById('RefAsignatura').value = refasignatura;
		document.getElementById('RefAlumno').value = refalumno;
		$.ajax({
			url: base_url + refasignatura,
			type: "POST",
			dataType: "JSON",
			success: function(data){
				$('form')[0].reset();
				$('.form-group').removeClass('has-error');
				$('[name=Asignatura]').val(data.nombre);
				$('#myModal').modal('show');
				$('.modal-title').text('Agregar Anotación');
			}
		});
	}

	function guardar()
	{
		$('#btnSave').text('Guardando...');
		$('#btnSave').attr('disabled',true);
		var base_url = "<?php echo base_url()?>Observaciones/agregarObservacion";

		var id = $('#Id').val();
		var refasignatura = $('#RefAsignatura').val();
		var refalumno = $('#RefAlumno').val();
		var fecha = $('#Fecha').val();
		var tipo = $('#Tipo').val();
		var comentario = $('#Comentario').val();

		if(save_method == "Add"){
			$.post(
				base_url,
				{
					refasignatura: refasignatura,
					refalumno: refalumno,
					fecha: fecha,
					tipo: tipo,
					comentario: comentario
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);
		}
	}

	function eliminarObservacion(id)
	{
		if(confirm('¿Está seguro que desea eliminar esta observación?'))
		{
			var base_url = "<?php echo base_url()?>" + "Observaciones/eliminarObservacion";
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