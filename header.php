<?php
session_start();

require_once 'php/model/Matters.php';
require_once 'php/model/Task.php';
require_once 'php/model/Students.php';

$matters = new Matters();
$tarefa = new Task();
$student = new Students();


/*$studentsMatters = $matters->getStudentsActiveMatters($_SESSION['matricula'])->fetchAll(PDO::FETCH_OBJ);*/
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<!-- Padronizações modernas para informar aos navegadores a codigicação e o tipo da página. Por exemplo, isso faz com que o browser não carregue a página como um PDF ou XML, e sim como um HTML. -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Adicionar uma cor tema do site para alterar a cor da barra de navegação do Chrome para Android e/ou outros aplicativos que necessitam saber a cor principal do site para fins de personalização da experiência do usuário. -->
	<meta name="theme-color" content="#568bee">
	<!-- Informar ao navegador como a página deve se comportar ao exibir o conteúdo da página -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Normalização de estilos entre navegadores para Boostrap -->
	<link href="assets/css/bootstrap-reboot.css" rel="stylesheet">
	<!-- Estilo padrão do Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Estilo padrão do site-->
	<link href="assets/css/style.css" rel="stylesheet">
	<!-- Font Awesome - Fonte com apenas ícones para se usar no sistema inteiro -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- Estilo padrão do Full Calendar -->
	<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
	<link href='assets/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
	<!-- Título da página que será exibido nas abas e interpretado pelos motores de busca -->
	<title>Meu Calendário</title>
</head>

<body>
	<div class="d-flex" id="wrapper">

		<!-- Início da barra lateral -->
		<div id="sidebar-wrapper">

			<!-- Sessão com a imagem de perfil -->
			<div class="mx-auto mt-5 imagem-perfil">
				<img src="assets/images/perfil.jpg">
			</div>
			<div class="text-center my-3 sidebar-heading">Olá, Vinicius
				<br><!-- <?=$_SESSION['aluno']->name?> <?=$_SESSION['aluno']->surname?>  -->
			</div>

			<!-- Lista de itens do menu principal -->
			<ul class="list-unstyled list-group">
				<li>
					<a href="index.php"><i class="far fa-calendar mr-4"></i>Meu Calendário</a>
				</li>
				<li>
					<a href="todas-as-tarefas.php"><i class="fas fa-tasks mr-4"></i>Todas as matérias</a>
				</li>
				<!-- Ítem do menu que usa PHP para buscar as materias do banco de dados e popular as opções -->

				<li class="">
					<a href="#materias_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-graduation-cap mr-4"></i></i>Minhas Matérias</a>
					
					<ul class="list-unstyled collapse" id="materias_submenu">
					<?php foreach($studentsMatters as $materiaAtiva) { ?>
						<li>
							<a href="materia.php?id=<?=$materiaAtiva->matter_id?>"><?=$materiaAtiva->name?></a>
						</li>
					<?php } ?>
					</ul>
				</li>
				<li>
					<a href="grade-curricular.php"><i class="fas fa-user-graduate mr-4"></i>Grade curricular</a>
				</li>
			</ul>

			<span class="sidebar-separador"></span>

			<!-- Botões principais do menu -->
			<div class="text-center informacoes-conta">
				<button class="btn botao-sidebar">Minha conta</button>
				<button class="btn botao-sidebar">Sair</button>
			</div>

		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Conteúdo interno no sistema (lado direito) -->
		<div id="page-content-wrapper">

			<!-- Botão que mostra/oculta sidebar apenas es telas pequenas -->
			<nav class="navbar navbar-expand-sm navbar-light bg-light border-bottom">
				<button class="btn botao-sistema" id="menu-toggle"><i class="fas fa-bars"></i></button>
			</nav>

			

				


