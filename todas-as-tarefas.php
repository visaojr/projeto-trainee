<?php
require_once 'header.php';

if(isset($_POST['inserir'])){
	$tarefa->setType($_POST['type']);
	$tarefa->setName($_POST['name']);
	$tarefa->setTotal($_POST['total']);
	$tarefa->setNota($_POST['nota']);
	$tarefa->setDate($_POST['data']);
	$tarefa->setColor($_POST['color']);
	$tarefa->setStudent_registration($_POST['student']);
	$tarefa->setMatter_id($_POST['matter']);

	if($tarefa->insert() == 1){
		$result = "Tarefa cadastrado com sucesso!";
    }else{
        $error = "Impossivel cadastrar Tarefa";
    }
}

if(isset($_POST['edit'])){
	$tarefa->setId($_POST['id']);
	$tarefa->setType($_POST['type']);
	$tarefa->setName($_POST['name']);
	$tarefa->setTotal($_POST['total']);
	$tarefa->setNota($_POST['nota']);
	$tarefa->setDate($_POST['data']);
	$tarefa->setColor($_POST['color']);
	$tarefa->setStudent_registration($_POST['student']);
	$tarefa->setMatter_id($_POST['matter']);

	if($tarefa->edit() == 1){
		$result = "Tarefa editada com sucesso!";
    }else{
        $error = "Impossivel editar Tarefa";
    }
}

if(isset($_POST['delete'])){
	if($tarefa->delete($_POST['id'])){
	    $result = "Tarefa removido com sucesso!";
    } else {
        $error = "Houve uma falha ao remover o tarefa. Tente Novamente.";
    }
}



?>

<section class="todas-as-tarefas">

		<h2 class="text-left mt-5">Todas as tarefas</h2>
		<span class="text-left">Aqui é exibido todas as tarefas criadas de todas as matérias</span>

		<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalInserir">Adicione uma tarefa</button>

		<!-- Modal Inserir-->
		<div class="modal fade" id="modalInserir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">O que voce tem para fazer?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

		      <div class="modal-body">
		        <form action="todas-as-tarefas.php" method="post">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Que tipo de tarefa deseja fazer:</label>
				    <input type="text" class="form-control" name="type" aria-describedby="emailHelp" placeholder="Digite um tipo tarefa">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Qual nome da tarefa que irá realizar:</label>
				    <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Digite a tarefa que irá realizar">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Quantos creditos vale essa tarefa:</label>
				    <input type="number" class="form-control" name="total" aria-describedby="emailHelp" placeholder="Digite o valor de creditos da tarefa">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Qual nota tiraste na tarefa:</label>
				    <input type="number" class="form-control" name="nota" aria-describedby="emailHelp" placeholder="Resultado da tarefa">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Informe a data que irá realiza-la:</label>
				    <input type="date" class="form-control" name="data" aria-describedby="emailHelp">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Informe a cor que irá caracterizá la:</label>
				    <input type="color" class="form-control" name="color" aria-describedby="emailHelp">
				  </div>


				<div class="form-group col-md-4">
			      <label for="inputEstado">Estudante</label>
			      <select name="student" id="student" class="form-control">
			      	<?php 
                    $stmtStudante = $student->view();
                    while ($row = $stmtStudante->fetch(PDO::FETCH_OBJ)){ 
                        ?>
                        <option value="<?php echo $row->registration; ?>"><?php echo $row->name; ?></option>
                        <?php } ?>
			      </select>
			    </div>

			    <div class="form-group col-md-4">
			      <label for="inputEstado">Matéria</label>
			      <select name="matter" id="matter" class="form-control">
			      	<?php 
                    $stmtMatter = $matters->viewMatter();
                    while ($row = $stmtMatter->fetch(PDO::FETCH_OBJ)){ 
                        ?>
                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                        <?php } ?>
			      </select>
			    </div>

				

			    <div class="modal-footer">
				  <button name="inserir" type="submit" class="btn btn-primary">Adicionar Tarefa</button>
				</div>

				</form>
		      </div>

		    </div>
		  </div>
		</div>

	<table class="table mb-5 mt-2">
		<thead class="thead-principal">
			<tr>
				<th scope="col">Tarefa</th>
				<th scope="col">Valor (pontos)</th>
				<th scope="col">Data</th>
				<th scope="col">Matéria</th>
				<th scope="col">Ações</th>
			</tr>
		</thead>
		<tbody class="table-striped">
			<?php
			$stmtTarefa = $tarefa->view();
			while ($row = $stmtTarefa->fetch(PDO::FETCH_OBJ)) {   
				?>
				<tr>
					<td><?php echo $row->name; ?></td>
					<td><?php echo $row->total; ?></td>
					<td><?php echo $row->date; ?></td>
					<td><?php echo $row->matter_id; ?></td>
					<td>
						<a class="btn editar-botao" href="#" data-toggle="modal" data-target="#editTarefa<?php echo $row->id?>">Editar</a>
						<a title="Excluir" class="btn excluir-botao" href="#" data-toggle="modal" data-target="#delete-modal<?php echo $row->id ?>"><i class="fas fa-trash"></i></a>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

	<?php
		$stmtTarefa = $tarefa->view();
		while ($row = $stmtTarefa->fetch(PDO::FETCH_OBJ)) {   
	?>

	<!-- Modal Editar-->
		<div class="modal fade" id="editTarefa<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">O que voce tem para fazer?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

		      <div class="modal-body">
		        <form action="todas-as-tarefas.php" method="post">
		        	
		        	<input type="number" class="form-control" name="id" aria-describedby="emailHelp" value="<?php echo $row->id ?>">

				  <div class="form-group">
				    <label for="exampleInputEmail1">Que tipo de tarefa deseja fazer:</label>
				    <input type="text" class="form-control" name="type" aria-describedby="emailHelp" value="<?php echo $row->type ?>">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Qual nome da tarefa que irá realizar:</label>
				    <input type="text" class="form-control" name="name" aria-describedby="emailHelp" value="<?php echo $row->name ?>">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Quantos creditos vale essa tarefa:</label>
				    <input type="number" class="form-control" name="total" aria-describedby="emailHelp" value="<?php echo $row->total ?>">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Qual nota tiraste na tarefa:</label>
				    <input type="number" class="form-control" name="nota" aria-describedby="emailHelp" value="<?php echo $row->nota ?>">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Informe a data que irá realiza-la:</label>
				    <input type="date" class="form-control" name="data" aria-describedby="emailHelp" value="<?php echo $row->date ?>">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Informe a cor que irá caracterizá la:</label>
				    <input type="color" class="form-control" name="color" aria-describedby="emailHelp">
				  </div>


				<div class="form-group col-md-4">
			      <label for="inputEstado">Estudante</label>
			      <select name="student" id="student" class="form-control">
			      	<?php 
                    $stmtStudante = $student->view();
                    while ($row = $stmtStudante->fetch(PDO::FETCH_OBJ)){ 
                        ?>
                        <option value="<?php echo $row->registration; ?>"><?php echo $row->name; ?></option>
                        <?php } ?>
			      </select>
			    </div>

			    <div class="form-group col-md-4">
			      <label for="inputEstado">Matéria</label>
			      <select name="matter" id="matter" class="form-control">
			      	<?php 
                    $stmtMatter = $matters->viewMatter();
                    while ($row = $stmtMatter->fetch(PDO::FETCH_OBJ)){ 
                        ?>
                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                        <?php } ?>
			      </select>
			    </div>		

			    <div class="modal-footer">
				  <button name="edit" type="submit" class="btn btn-primary">Editar Tarefa</button>
				</div>

				</form>
		      </div>

		    </div>
		  </div>
		</div>
		<!-- Fim modal editar -->

	<?php } ?>

	<?php
		$stmtTarefa = $tarefa->view();
		while ($row = $stmtTarefa->fetch(PDO::FETCH_OBJ)) {   
	?>

	<div class="modal fade" id="delete-modal<?php echo $row->id ?>" tabindex="-1" role="dialog"
         aria-labelledby="modalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalLabel">Deseja realmente excluir essa tarefa?</h4>
                </div>
                <form action="todas-as-tarefas.php" method="post">
                    <div class="modal-body" style="padding: 30px 0">
                        <p>Esta ação não poderá ser desfeita.
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="delete" class="btn btn-primary">Sim</button>
                        <button type="button" class="btn botao-danger" data-dismiss="modal">N&atilde;o
                        </button>
                        <input type="number" name="id" value="<?php echo $row->id; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>

	<?php } ?>

</section>


<?php
require_once 'footer.php';
?>