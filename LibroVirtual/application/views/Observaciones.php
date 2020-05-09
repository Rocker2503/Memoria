<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alumnos</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
	
	<div class="main">
		<div class="container" style="margin-bottom:10px">
			<div class="py-2">
				<h2>Observaciones</h2>
			</div>
		</div>

		<div id="accordion" class="container">
			<?php $i=1;foreach($alumnos as $row):?>
				<div class="card bg-light">
        			<div class="card-header" style="margin-bottom:5px">
            			<h5 class="mb-0">
            				<?php echo "{$row->apellidoPaterno} {$row->apellidoMaterno} {$row->nombres}";?>
        					<button class="btn btn-outline-primary pull-right" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapseOne" onclick="llenarTabla(<?=$refAsignatura?>,<?=$row->id?>)">
         					 <i class="fa fa-eye"></i>
        					</button>
      					</h5>
        			</div>
        			<div id="collapse<?=$i?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
	      				<div class="card-body">
	       					<div class="container">
	       						<div class="container row" style="margin-bottom:10px">
	       							<button class="btn btn-success" onclick="crearObservacion(<?=$row->id?>,<?=$refAsignatura?>)"><i class="fa fa-plus"></i> Agregar</button>
	       						</div>
	       					</div>
	       					<div class="container">
	       						<table id="table<?=$row->id?>" class="table">
	       							<thead>
	       								<tr>
	       									<th>Asignatura</th>
		 									<th>Fecha</th>
		 									<th>Tipo</th>
		 									<th>Comentario</th>
		 									<th></th>
	       								</tr>
	       							</thead>
	       							<tbody id="body<?=$row->id?>">
	       			
	       							</tbody>
	       						</table>
	       					</div>
	      				</div>
    				</div>
   				</div>
			<?php $i++;endforeach;?>
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
</body>
</html>

<script type="text/javascript">
	
	function llenarTabla(refAsignatura,refAlumno)
	{
		var refalumno = refAlumno;
		var refasignatura = refAsignatura;

		var base_url = "<?php echo base_url()?>Observaciones/ObtenerAnotaciones/";
		$.ajax({
			url: base_url,
			type: "POST",
			data: { refalumno },
			dataType: "JSON",
			success: function(data)
			{
				var observacion_data = '';
				$.each(data,function(key,value){
					observacion_data += '<tr>';
					observacion_data += '<td>'+value.nombre+'</td>';
					observacion_data += '<td>'+value.fecha+'</td>';
					if(value.tipo == 0)
					{
						observacion_data += '<td>'+'Negativa'+'</td>';
					}else{
						observacion_data += '<td>'+'Positiva'+'</td>';
					}
					observacion_data += '<td>'+value.comentario+'</td>';
					if(value.refAsignatura == refasignatura)
					{
						observacion_data += '<td><button style="margin-right:5px" class="btn btn-primary" onclick="editarObservacion('+value.id+')"><i class="fa fa-pencil"></i></button>';
						observacion_data += '<button class="btn btn-danger" onclick="eliminarObservacion('+value.id+')"><i class="fa fa-close"></i></button></td>'
					}
					observacion_data += '</tr>';
				});
				
				$("#body"+refalumno).empty();
				$("#body"+refalumno).html(observacion_data);				
			}
		});
	}


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

	function editarObservacion(id)
	{
		save_method = "Update";
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		var base_url = "<?php echo base_url()?>";
		$.ajax({
			url: base_url + "Observaciones/EditAjax/" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
			{
				$('[name=Id]').val(data.id);
				$('[name=RefAsignatura]').val(data.refAsignatura);
				$('[name=Asignatura]').val(data.nombre);
				$('[name=RefAlumno]').val(data.refAlumno);
				$('[name=Fecha]').val(data.fecha);
				$('[name=Tipo]').val(data.tipo);
				$('[name=Comentario]').val(data.comentario);
				$('#myModal').modal('show');
				$('.modal-title').text('Editar Anotación');
			}
		});
	}

	function guardar()
	{
		$('#btnSave').text('Guardando...');
		$('#btnSave').attr('disabled',true);
		var base_url = "<?php echo base_url()?>";

		var id = $('#Id').val();
		var refasignatura = $('#RefAsignatura').val();
		var refalumno = $('#RefAlumno').val();
		var fecha = $('#Fecha').val();
		var tipo = $('#Tipo').val();
		var comentario = $('#Comentario').val();

		if(fecha == "" || tipo == "" || comentario == "")
		{
			alert("Todos los campos deben estar completos");
			$('#btnSave').text('Guardar');
			$('#btnSave').attr('disabled',false);
			return;
		}

		if(save_method == "Add"){
			base_url = base_url  + "Observaciones/agregarObservacion";
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
		}else{
			base_url = base_url + "Observaciones/editarObservacion";
			$.post(
				base_url,
				{
					id: id,
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
