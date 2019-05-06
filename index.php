<?php
session_start();

if(isset($_SESSION['matricula']) && isset($_SESSION['email'])){
	header("Location: menu.php", true);
}

require_once 'php/controller/loginController.php';
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="theme-color" content="#568bee">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="assets/css/bootstrap-reboot.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<title>Login</title>
</head>

<body>

<style>
	body{
		margin: 0;
		padding: 0;
		background: #568bee;
		display: flex;
		align-items: center;
    	justify-content: center;
	}

	.center-form{
		position: absolute;
		transform: translate(-50%, -50%);
		top: 50%;
		left: 50%;
	}
</style>

<div class="center-form">
	<div class="card" style="width: 18rem;">
		<div class="card">
			<div class="card-header">
				Login
			</div>
			<div class="card-body">
				<form method="post" action="index.php">
					<div class="form-group">
						<label for="my-input1">Matricula</label>
						<input id="my-input1" class="form-control" name="matricula" type="text">
					</div>
					<div class="form-group">
						<label for="my-input2">Senha</label>
						<input id="my-input2" class="form-control" name="pass" type="password">
					</div>
					<button class="btn btn-primary" type="submit" name="login">
							Login
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
<?php

?>