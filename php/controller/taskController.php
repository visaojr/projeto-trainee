<?php 
require_once 'php/model/Task.php';

$Task = new Task();

if(isset($_POST['insert'])){
}

$tasks = $Task->index($_SESSION['matricula'], $_GET['id'])->fetchAll(PDO::FETCH_OBJ);
?>

