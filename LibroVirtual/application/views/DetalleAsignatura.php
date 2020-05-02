<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detalle Asignatura</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



    <div class="main">
      <div class="container">
        <section class="py-2">
          <h2>Asignatura</h2>
        </section>
      </div>
    </div>
      <div class="container">
    	   <div class="row">
          <div class="col-md-4">
            <div class="card text-center" style="width: 18rem;">
              <img src="https://image.flaticon.com/icons/svg/782/782760.svg" class="card-img-top"  height="150" width="150">
              <div class="card-body">
                <h5 class="card-title">Evaluaciones</h5>
                <a href="#" class="btn btn-primary">Ver</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center" style="width: 18rem;">
              <img src="https://image.flaticon.com/icons/svg/782/782744.svg" class="card-img-top"  height="150" width="150">
              <div class="card-body">
                <h5 class="card-title">Asistencia</h5>
                <a href="#" class="btn btn-primary">Ver</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
             <div class="card text-center" style="width: 18rem;">
                <img src="https://image.flaticon.com/icons/svg/782/782741.svg" class="card-img-top"  height="150" width="150">
                <div class="card-body">
                  <h5 class="card-title">Observaciones</h5>
                  <a href="<?php echo base_url()?>Observaciones/listarAlumnos/<?php echo $id; ?>" class="btn btn-primary">Ver</a>
                </div>
              </div>
          </div>
      </div>
    </div>

</body>
</html>
