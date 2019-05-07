<?php
require_once 'header.php';
?>


<section class="meu-calendario">
	<div class="primeira-row clearfix mt-5">
		<h2 class="float-left">Meu Calendário</h2>
	</div>
	<div id='calendar' class="my-5"></div>
</section>


<?php

$task = new Task();
$tasks = $task->getAllByAluno($_SESSION['matricula'])->fetchAll(PDO::FETCH_OBJ);


require_once 'footer.php';
?>

