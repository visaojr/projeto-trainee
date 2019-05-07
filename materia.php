<?php
require_once 'header.php';
require_once 'php/controller/taskController.php';
require_once 'php/controller/matterController.php';
?>

<section class="tasks">
	<div class="primeira-row clearfix mt-5">

		<h2 class="float-left"><?=$materia->name?></h2>
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
								<label for="exampleFormControlTextarea1">Tipo da tarefa</label>
								<input type="text" name="tipo" id="" placeholder=""> 
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Descrição da tarefa</label>
								<input type="text" name="desc" id="" placeholder=""> 
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Valor da tarefa</label>
								<input type="text" name="valor" id="" placeholder=""> 
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Data da tarefa</label>
								<input type="date" name="data" id=""> 
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Nota da tarefa</label>
								<input type="text" name="nota" id="" placeholder=""> 
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Cor (#hexadeciamal)</label>
								<input type="text" name="nota" id="" placeholder=""> 
							</div>
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
						<button type="button" name="insert" class="btn btn-primary">Salvar</button>
					</div>
				</div>
			</div>
		</div>


	</div>
	<table class="table mb-5 mt-2">
		<thead class="thead-principal">
			<tr>
				<th scope="col">Tipo</th>
				<th scope="col">Descrição</th>
				<th scope="col">Valor</th>
				<th scope="col">Data</th>
				<th scope="col">Notas</th>
				<th scope="col">Ações</th>
			</tr>
		</thead>
		<tbody class="table-striped">
			<?php foreach($tasks as $task){ ?>
			<tr>
				<td><?=$task->type?></td>
				<td><?=$task->name?></td>
				<td><?=$task->total?></td>
				<td><?=$task->date?></td>
				<td><?=$task->nota?></td>
				<td>Oi</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>


	<h2>Faltas</h2>

	<div class="faltas">
		<div class="form-group">
			<label for="exampleSelect1">Selecione a quantidade de faltas que você possuí na matéria</label>
			<select class="form-control" id="exampleSelect1">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">Mais do que 9</option>
			</select>

			<button class="btn botao-sistema" href="#">Salvar</button>
		</div>


		<!-- A mensagem abaixo deve ser exibida com 7 ou mais faltas, como forma de aviso ao aluno. -->
		<!-- <h5 style="color:#fe5421">Atenção: com 9 ou mais faltas, você será reprovado em por falta!</h5> -->

		<!-- A mensagem abaixo deve ser exibida  apenas de 1 à 8 -->
		<!-- <h5>Você pode faltar mais %x% vezes antes de ser reprovado.</h5> -->

		<!-- A mensagem abaixo deve ser exibida de 9 ou acima -->
		<!-- <h5 style="color:#F31431">Você foi reprovado por falta em .</h5> -->

	</div>


</section>

<?php
require_once 'footer.php';
?>