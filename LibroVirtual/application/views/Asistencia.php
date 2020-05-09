<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Asistencia</title>

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
			<?php echo form_open(base_url('Asistencias/tomarAsistencia'))?>
			<input type="hidden" name="refAsignatura" value="<?php echo $refAsignatura?>">
			<div class="py-2">
				<div class="row">
					<strong class="col-md-auto">Fecha</strong>	
					<div class="col-md-auto">			
						<input type="date" class="form-control" name="Fecha" id="Fecha" min="04-03-2020" max="11-12-2020">
					</div>
				</div>
			</div>	
			<table class="table ">
				<thead>
					<tr>
						<th>N°</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
						<th>Nombres</th>
						<th>Asistencia</th>
					</tr>
				</thead>
				<tbody>
					<?php $sl=0; foreach($alumnos as $row):
						@$sl++;
					?>
						<tr>
							<td><?php echo $sl?></td>
							<td> <?php echo $row->apellidoPaterno; ?> </td>
							<td> <?php echo $row->apellidoMaterno; ?> </td>
							<td> <?php echo $row->nombres; ?> </td>
							<td>
								<input type="hidden" name="Id[]" value="<?php echo $row->id;?>">
								<input type="radio" checked value="1" name="<?php echo $sl?>"> &nbsp Presente &nbsp | &nbsp
								<input type="radio" value="0" name="<?php echo $sl?>"> &nbsp Ausente
							</td>
						</tr>
					<?php endforeach;?>
					<tr>
					</tr>
				</tbody>
			</table>
			<div class="container">
				<input type="submit" name="submit" class="btn btn-success" value="Agregar">
			</div>
			<?php echo form_close()?>
		</div>
	</div>

</body>
</html>