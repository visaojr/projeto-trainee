<?php

require_once 'Database.php';

class Login{

    private $matricula;
    private $name;
    private $email;
    private $pass;

    public $conn;
    
    public function __construct(){
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    public function setMatricula($matricula){
        $this->matricula = $matricula;
    }

    public function setPass($pass){
        $this->pass = $pass;
    }

    public function verifyLogin(){
        $stmt = $this->conn->prepare("SELECT * FROM `student` WHERE `registration` = :matricula AND `password` = :password");
        $stmt->bindParam(":matricula", $this->matricula);
        $stmt->bindParam(":password", $this->pass);
        $stmt->execute();
        return $stmt;
    }

}