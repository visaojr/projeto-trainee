<?php
require_once 'php/model/Matter.php';
$Matter = new Matter();
$materia = $Matter->indexById($_GET['id'])->fetch(PDO::FETCH_OBJ);
?>