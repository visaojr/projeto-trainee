<?php
require_once 'header.php';
require_once 'php/model/Matters.php';

$matters = new Matters();
$mat = $matters->indexMatters($_SESSION['aluno']->course_id)->fetchAll(PDO::FETCH_OBJ);
?>


<section class="grade-curricular">
		<h2 class="float-left mt-5">Grade Curricular</h2>
</section>

<section class="container">
	<table class="table table-dark">
		<thead class="thead-dark">
			<tr>
				<th>Matéria</th>
				<th>Carga Horária</th>
				<th>Semestre</th>
				<th>Tipo</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($mat as $materia) { ?>
			<tr>
				<td><?=$materia->name?></td>
				<td><?=$materia->workload?></td>
				<td><?=$materia->semester?></td>
				<td><?=$materia->type?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</section>


<?php
require_once 'footer.php';
?>