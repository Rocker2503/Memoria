<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cursos</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </style>

</head>
<body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	
	<div class="main">
		<div class="container">
			<section class="py-2">
				<h2>Lista de Cursos</h2>
			</section>
		</div>	
	

	<div class="container">
		<div class="container row" style="margin-bottom:10px">
			<button class="btn btn-success" onclick="agregarCurso()"><i class="fa fa-plus"></i> Agregar</button>
		</div>
	</div>

	
		<div>
		    <div class="container">
		    	<div class="row" id="listado"> 
					<?php $i=0; foreach($cursos as $row): ?>
					<div class="col-4" style="margin-bottom:10px">
						<div class="card flex-row flex-wrap bg-light">
							<div class="card-header border-1">
								<img src="https://image.flaticon.com/icons/svg/1258/1258311.svg" class="card-img-top" height="60" width="60">
							</div>
							<div class="card-block px-2">
								<a href="<?php echo base_url()?>Asignaturas/cargarAsignaturas/<?php echo $row->id ?>"><h5 class="card-title"><?php echo "{$row->nombre} {$row->letra}";?></h5></a>
								<div style="margin-bottom: 5px">
									<button class="btn btn-primary" onclick="editarCurso(<?=$row->id?>)"><i class="fa fa-pencil"></i></button>
									<button class="btn btn-danger" onclick="eliminarCurso(<?=$row->id?>)"><i class="fa fa-close"></i></button>
								</div>
							</div>
						</div>
					</div>
					<? $i++; endforeach;?>
		    	</div>
		    </div>
	    </div>
    </div>
    
</body>
</html>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
        	<input type="hidden" name="Id" id="Id" value="">
        	<div class="form-body">
        		<div class="form-group">
        			<label class="control-label col-md-3">Nivel</label>
        			<div class="col-md-9">
        				<select name="Nivel"  id="Nivel" class="form-control">
        					<option value="0" selected>Pre-Básica</option>
        					<option value="1">Básica</option>
        					<option value="2">Media</option>
        				</select>
        			</div>
        		</div>
        		<div class="form-group">
        			<label class="control-label col-md-3">Nombre</label>
        			<div class="col-md-9">
        				<input type="text" name="Nombre"  id="Nombre" placeholder="Nombre" class="form-control">
        			</div>
        		</div>
        		<div class="form-group">
        			<label class="control-label col-md-3">Letra</label>
        			<div class="col-md-9">
        				<input type="text" name="Letra"  id="Letra" placeholder="Letra" class="form-control">
        			</div>
        		</div>
        		<div class="form-group">
        			<label class="control-label col-md-3">Año</label>
        			<div class="col-md-9">
        				<input type="number" name="Anio" id="Anio" placeholder="Año" class="form-control">
        			</div>
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

<script type="text/javascript">
	
	var save_method;

	function agregarCurso(){
		save_method = "Add";
		$('#form')[0].reset(); // reset form on modal
		$('.form-group').removeClass('has-error');
		$("#myModal").modal('show');
		$('.modal-title').text('Agregar Curso');
	}

	function editarCurso(id){
		save_method="Update";
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		console.log(id);
		var base_url = "<?php echo base_url()?>";
		console.log(base_url);

		$.ajax({
			url: base_url + 'cursos/EditAjax/' + id,
			type: "POST",
			dataType: "JSON",
			success: function (data)
			{
				$('[name=Id]').val(data.id);
				$('[name=Nivel]').val(data.nivel);
				$('[name=Nombre]').val(data.nombre);
				$('[name=Letra]').val(data.letra);
				$('[name=Anio]').val(data.anio);
				$('#myModal').modal('show');
				$('.modal-title').text('Editar Curso');
			}
		});

	}

	function guardar(){
		$('#btnSave').text('Guardando...');
		$('#btnSave').attr('disabled',true);
		var base_url = "<?php echo base_url()?>";

		var id = $("#Id").val();
		var nivel = $("#Nivel").val();
		var nombre = $("#Nombre").val();
		var letra = $("#Letra").val();
		var anio = $("#Anio").val();

		if(nivel == "" || nombre == "" || letra == "" || anio == "")
		{
			alert("Todos los campos deben estar completos");
			$('#btnSave').text('Guardar');
			$('#btnSave').attr('disabled',false);
			return;
		}

		if(save_method == "Add"){
			base_url = base_url + "cursos/agregarCurso";
			$.post(
				base_url,
				{
					nivel : nivel,
					nombre : nombre,
					letra : letra,
					anio : anio
				},function(){
					$("#myModal").modal('hide');
					location.reload();
				}
			);

		}else{
			base_url = base_url + "cursos/EditarCurso";
			$.post(
				base_url,
				{
					id : id,
					nivel : nivel,
					nombre : nombre,
					letra : letra,
					anio : anio
				},function(){
					$('#myModal').modal('hide');
					location.reload();
				}
			);	
		}
	}

	function eliminarCurso(id)
	{
		if(confirm('¿Está seguro que desea eliminar el curso?'))
		{
			var base_url = "<?php echo base_url()?>" + "cursos/EliminarCurso";
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