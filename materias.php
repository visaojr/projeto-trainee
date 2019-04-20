<?php

use VisaoJR\Treinee\model\Task;
use VisaoJR\Treinee\model\Matter;

require_once 'model/Matter.php';
require_once 'model/Task.php';


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

	<!-- Normalização de estlitos entre navegadores -->
	<link href="assets/css/bootstrap-reboot.css" rel="stylesheet">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Estilo padrão -->
	<link href="assets/css/style.css" rel="stylesheet">
	<!-- Font Awesome - Fonte com apenas ícones para se usar no sistema inteiro -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


	<title>Meu Calendário</title>
</head>

<body>


	<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">

	<div class="mx-auto mt-5 imagem-perfil">
		<img src="assets/images/perfil.jpg">
	</div>

      <div class="text-center my-3 sidebar-heading">Olá, <br>Henrique</br>
      </div>

      <ul class="list-unstyled list-group">
      	<li>
      		<a href="#"><i class="far fa-calendar mr-4"></i>Meu Calendário</a>
      	</li>

        <li class="active">
        	<a href="#materias_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-graduation-cap mr-4"></i>Matérias</a>
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
    </ul>

<span class="sidebar-separador"></span>

<div class="text-center informacoes-conta">
	<button class="btn botao-sidebar">Minha conta</button>
	<button class="btn botao-sidebar">Sair</button>
</div>

</div>
    <!-- /#sidebar-wrapper -->


		<!-- Page Content -->
		<div id="page-content-wrapper">

			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<button class="btn btn-primary" id="menu-toggle">Menu</button>
			</nav>

			<div class="container-fluid">
				<h1 class="mt-4">Calendário</h1>
				<section>
					<h1>Tarefas</h1>


					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Tarefa</th>
								<th scope="col">Valor (pontos)</th>
								<th scope="col">Data</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody class="table-striped">
							<?php
						        $stmtTarefa = $tarefa->index();
						        while ($row = $stmtTarefa->fetch(PDO::FETCH_OBJ)) {   
						    ?>
							<tr>
								<td><?php echo $row->name; ?></td>
								<td><?php echo $row->nota; ?></td>
								<td><?php echo $row->date; ?></td>
								<td>
									<a class="btn editar-botao" href="#" data-toggle="modal" data-target="#editEscola<?php echo $row->id ?>">Editar</a>
									<a title="Excluir" class="btn excluir-botao" href="#" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
								<?php
									}
								?>
						</tbody>
					</table>


					<h2>Faltas</h2>


				</section>
			</div>
		</div>
		<!-- /#page-content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	<!-- Script para fazer com que o botão esconda a barra lateral -->
	<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
	</script>



</body>

</html>