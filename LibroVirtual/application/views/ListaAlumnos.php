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
								<a href="<?php echo base_url()?>Observaciones/verHojaVida/<?php echo $row->id?>/<?php echo $refAsignatura?>" class="btn btn-success">Hoja de Vida</a>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>

</body>
</html>
