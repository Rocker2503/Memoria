<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Libro Virtual</title>

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	

    <style type="text/css">
	body {
		color: #4e4e4e;
		background: #ffffff;
		font-family: 'Roboto', sans-serif;
	}
    .form-control {
		background: #f2f2f2;
        font-size: 16px;
		border-color: transparent;
		box-shadow: none !important;
	}
	.form-control:focus {
		border-color: #91d5a8;
        background: #e9f5ee;
	}
    .form-control, .btn {        
        border-radius: 2px;
    }
	.login-form {
		width: 380px;
		margin: 0 auto;
	}
    .login-form h2 {
        margin: 0;
        padding: 30px 0;
        font-size: 34px;
    }
	.login-form .avatar {
		margin: 0 auto 30px;
		width: 100px;
		height: 100px;
		border-radius: 50%;
		z-index: 9;
		background: #4aba70;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
	.login-form .avatar img {
		width: 100%;
	}
    .login-form form {
		color: #7a7a7a;
		border-radius: 4px;
    	margin-bottom: 20px;
        background: #fff;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;		
    }
    .login-form .btn {
		font-size: 16px;
		line-height: 26px;
		min-width: 120px;
        font-weight: bold;
		background: #4aba70;
		border: none;		
    }
	.login-form .btn:hover, .login-form .btn:focus{
		background: #40aa65;
        outline: none !important;
	}
	.checkbox-inline {
		margin-top: 14px;
	}
	.checkbox-inline input {
		margin-top: 3px;
	}	
	.login-form a:hover {
		text-decoration: underline;
	}
	.hint-text {
		color: #999;
        text-align: center;
		padding-bottom: 15px;
	}
	</style>
</head>
<body>

<div id="container">
	<div class="login-form">
		<h2 class="text-center">Libro Virtual</h2>
	    <form action="/examples/actions/confirmation.php" method="post">
			<div class="avatar">
				<img src="https://image.flaticon.com/icons/png/512/1077/1077114.png" alt="Avatar">
			</div>           
	        <div class="form-group">
	        	<input type="text" class="form-control input-lg" name="username" placeholder="Username" required="required">	
	        </div>
			<div class="form-group">
	            <input type="password" class="form-control input-lg" name="password" placeholder="Password" required="required">
	        </div>        
	        <div class="form-group clearfix">
				<label class="pull-left checkbox-inline"><input type="checkbox"> Recordarme</label>
	            <a href="<?php echo base_url()?>Cursos/index" class="btn btn-success pull-right">Iniciar Sesión</a>
	        </div>		
	    </form>
	</div>
</div>

</body>
</html>