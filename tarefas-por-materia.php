<?php
require_once 'header.php';
?>


<section class="tasks">
	<div class="primeira-row clearfix mt-5">

		<h2 class="float-left">Matemática Discreta</h2>
		<button class="btn botao-sistema float-right" data-toggle="modal" data-target="#NovaTarefa">Nova tarefa</button>

		<!-- Modal -->
		<div class="modal fade" id="NovaTarefa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Adicionar uma nova tarefa</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						
						<form>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Nome da tarefa ou da matéria</label>
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
							</div>
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
						<button type="button" class="btn btn-primary">Salvar</button>
					</div>
				</div>
			</div>
		</div>


	</div>
	<table class="table mb-5 mt-2">
		<thead class="thead-principal">
			<tr>
				<th scope="col">Notas</th>
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

	<div class="form-group">
		<label for="exampleSelect1">Selecione a quantidade de faltas que você possuí na matéria</label>
		<select class="form-control" id="exampleSelect1">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			<option>6</option>
			<option>7</option>
			<option>8</option>
			<option>9</option>
		</select>

		<button class="btn botao-sistema" href="#">Salvar</button>
	</div>

	<h5>Você pode faltar mais %X% vezes antes de ser reprovado</h5>
	<h5 style="font-weight: bold; color: red">Você foi reprovado em %NOME DA MATÉRIA% por falta!</h5>


</section>


<?php
require_once 'footer.php';
?>