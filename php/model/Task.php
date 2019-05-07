<?php

require_once 'Database.php';

class Task{
    private $id;
    private $type;
    private $name;
    private $total;
    private $nota;
    private $date;
    private $color;
    private $student_registration;
    private $matter_id;
    
    public function __construct()
    {
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setName($value){
        $this->name = $value;
    }
    public function setType($value){
        $this->type = $value;
    }
    public function setTotal($value){
        $this->total = $value;
    }
    public function setNota($value){
        $this->nota = $value;
    }
    public function setDate($value){
        $this->date = $value;
    }
    public function setColor($value){
        $this->color = $value;
    }
    public function setStudent_registration($value){
        $this->student_registration = $value;
    }
    public function setMatter_id($value){
        $this->matter_id = $value;
    }

    public function insert(){
        try{
        $stmt = $this->conn->prepare("INSERT INTO `task` VALUES (:type, :name, :total, :nota, :date, :color, :student_registration, :matter_id)");
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":nota", $this->date);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":student_registration", $this->student_registration);
        $stmt->bindParam(":matter_id", $this->matter_id);
        $stmt->execute();
        return 1;    
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function delete($id){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `task` WHERE `id` == :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->prepare();    
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function edit(){
        try{    
            $stmt = $this->conn->prepare("UPDATE `task` SET `type` = :type, `name` == :name, `total` == :total, `nota` == :nota, `date` == :date, `color` == :color, `student_registration` == :student_registration, `matter_id` ==:matter_id WHERE `id` == :id ");
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":total", $this->total);
            $stmt->bindParam(":nota", $this->date);
            $stmt->bindParam(":color", $this->color);
            $stmt->bindParam(":student_registration", $this->student_registration);
            $stmt->bindParam(":matter_id", $this->matter_id);
            $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function index($reg, $id){
        $stmt = $this->conn->prepare("SELECT * FROM `task` WHERE student_registration = :reg AND matter_id = :id");
        $stmt->bindParam(":reg", $reg);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    public function getAllByAluno($reg){
        $stmt = $this->conn->prepare("SELECT * FROM `task` WHERE student_registration = :reg");
        $stmt->bindParam(":reg", $reg);
        $stmt->execute();
        return $stmt;
    }
        

    

   
}