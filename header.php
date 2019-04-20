<?php




use VisaoJR\Treinee\model\Task;
use VisaoJR\Treinee\model\Matter;

require_once 'model/Matter.php';
require_once 'model/Task.php';

$tarefa = new Task();
/*require_once '../autoloader.php';*/

$materia = new Matter();
$tarefa = new Task();

?>
<!DOCTYPE HTML>

<html lang="pt-br">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="theme-color" content="#fb9039">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src='assets/fullcalendar/lib/jquery.min.js'></script>
	<!-- Normalização de estlitos entre navegadores -->
	<link href="assets/css/bootstrap-reboot.css" rel="stylesheet">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Estilo padrão -->
	<link href="assets/css/style.css" rel="stylesheet">
	<!-- Font Awesome - Fonte com apenas ícones para se usar no sistema inteiro -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
	<link href='assets/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

	


	<title>Meu Calendário</title>
</head>

<body>


	<div class="d-flex" id="wrapper">

		<!-- Sidebar -->
		<div id="sidebar-wrapper">

			<div class="mx-auto mt-5 imagem-perfil">
				<img src="assets/images/perfil.jpg">
			</div>

			<div class="text-center my-3 sidebar-heading">Olá,
				<br>Henrique</br>
			</div>

			<ul class="list-unstyled list-group">
				<li>
					<a href="index.php"><i class="far fa-calendar mr-4"></i>Meu Calendário</a>
				</li>


				<li>
					<a href="todas-as-tarefas.php"><i class="fas fa-tasks mr-4"></i>Todas as tarefas</a>
				</li>


				<li class="active">
					<a href="#materias_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-filter mr-4"></i></i>Tarefas por matéria</a>
					<ul class="list-unstyled collapse" id="materias_submenu">
						<?php
						$stmtMateria = $materia->index();
						while ($row = $stmtMateria->fetch(PDO::FETCH_OBJ)) {   
							?>
							<li>
								<a href="#"><?php echo $row->name; ?></a>
							</li>
						<?php } ?>
					</ul>
				</li>



				<li>
					<a href="#"><i class="fas fa-user-graduate mr-4"></i>Grade curricular</a>
				</li>


			</ul>

			<span class="sidebar-separador"></span>

			<div class="text-center informacoes-conta">
				<button class="btn botao-sidebar">Minha conta</button>
				<button class="btn botao-sidebar">Sair</button>
			</div>

		</div>
		<!-- /#sidebar-wrapper -->


		<!-- Conteúdo interno no sistema -->
		<div id="page-content-wrapper">

			<nav class="navbar navbar-expand-sm navbar-light bg-light border-bottom">
				<button class="btn btn-primary" id="menu-toggle">Menu</button>
			</nav>

			

				


