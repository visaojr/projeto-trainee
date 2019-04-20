<?php
require_once 'header.php';
?>


<section class="todas-as-tarefas">

		<h2 class="text-left mt-5">Todas as tarefas</h2>
		<span class="text-left">Aqui é exibido todas as tarefas criadas de todas as matérias</span>
		
	<table class="table mb-5 mt-2">
		<thead class="thead-principal">
			<tr>
				<th scope="col">Notas</th>
				<th scope="col">Valor (pontos)</th>
				<th scope="col">Data</th>
				<th scope="col">Matéria</th>
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
					<td></td>
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




</section>


<?php
require_once 'footer.php';
?>