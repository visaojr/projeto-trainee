<?php
 
require_once 'Database.php';

class Matter{
    private $id;
    private $name;
    private $workload;
    
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
    public function setWorkload($value){
        $this->workload = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `matter` VALUES(`:name, :workload`)");
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":workload", $this->workload);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `matter` WHERE `id` == :id");
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `matter` SET `name` = :name, `workload` = :workload WHERE `id` == :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":workload", $this->workload);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }
    
    public function indexById($id){
        $stmt = $this->conn->prepare("SELECT * FROM `matter` WHERE id = :id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    public function viewMatter(){
        $stmt = $this->conn->prepare("SELECT * FROM `matter` as m, `student_attend_matter` as sm where sm.matter_id = m.id;");
        $stmt->execute();
        return $stmt;
    }


}