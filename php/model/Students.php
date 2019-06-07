<?php
 
require_once 'Database.php';

class Students{
    private $resgistration;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $course_id;
    private $created_at;

    
    public function __construct()
    {
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    public function setRegistration($value){
        $this->resgistration = $value;
    }

    public function setName($value){
        $this->name = $value;
    }
    public function setSurname($value){
        $this->surname = $value;
    }
    public function setEmail($value){
        $this->email = $value;
    }
    public function setPassword($value){
        $this->password = $value;
    }
    public function setCourse_id($value){
        $this->course_id = $value;
    }
    public function setCreated_at($value){
        $this->created_at = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `student` VALUES (:name, :surname, :email, :password, :course_id, :created_at)");
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":course_id", $this->course_id);
            $stmt->bindParam(":created_at");
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }
    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `student` WHERE `resgistration` = :resgistration");
            $stmt->bindParam("resgistration", $this->resgistration);
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }
    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `students` SET `name` == :name, `surname` == :surme, `email` == :email, `password` == :password, `course_id` == :course_id, `created_at` == :created_at WHERE `resgistration` == resgistration");
            $stmt->bindParam("resgistration", $this->resgistration);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":course_id", $this->course_id);
            $stmt->bindParam(":created_at", $this->created_at);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `student` WHERE 1");
        $stmt->execute();
        return $stmt;
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `student` AS s, `student_attend_matter` AS sm WHERE sm.student_registration = s.registration");
        $stmt->execute();
        return $stmt;
    }

    
}