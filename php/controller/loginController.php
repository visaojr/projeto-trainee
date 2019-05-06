<?php 
require_once 'php/model/Login.php';

$login = new Login();

if(isset($_POST['login'])){

    $matricula = $_POST['matricula'];
    $pass = $_POST['pass'];

    $login->setMatricula($matricula);
    $login->setPass(sha1($pass));

    $dados = $login->verifyLogin()->fetch(PDO::FETCH_OBJ);
    var_dump($dados);
    if($dados){
        $_SESSION['matricula'] = $dados->registration;
        $_SESSION['email'] = $dados->email;
        $_SESSION['aluno'] = $dados;
    }else{
        echo "oi";
    }

}
?>