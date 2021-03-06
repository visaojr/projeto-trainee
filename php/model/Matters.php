<?php

require_once 'Database.php';

class Matters{
    private $id;
    private $name;
    private $area_id;
    
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

    public function setArea_id($value){
        $this->area_id = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `matters` VALUES(NULL, :name, :area_id)");
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":area_id", $this->area_id); //Adiconado para que enviasse junto a materia.
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();//Para mostrar o erro!
            return 0;
        }
    }

    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `matters` SET `name` = :name, `area_id` = :area_id WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":area_id", $this->area_id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();//Para mostrar o erro!
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `matters`  WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `matters` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

   public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `matters` WHERE 1 ORDER BY `name`");
        $stmt->execute();      
        
        return $stmt;

    }

    public function indexArray(){
        $stmt = $this->conn->prepare("SELECT * FROM `matters` WHERE 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function indexMatters($id){
        $stmt = $this->conn->prepare("SELECT matter.id, matter.name, matter.workload, course.type, course.semester FROM matter, course_has_matter as course WHERE course.course_id = :id AND course.matter_id = matter.id;");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    public function gradeByMateria($id){
        $stmt = $this->conn->prepare("SELECT * FROM course_has_matter WHERE course_id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    public function getStudentsActiveMatters($student_register){
        $stmt = $this->conn->prepare("SELECT * FROM student_attend_matter, matter WHERE student_attend_matter.student_registration = :id AND student_attend_matter.status = 1 AND matter.id = student_attend_matter.matter_id;");
        $stmt->bindValue(':id', $student_register);
        $stmt->execute();
        return $stmt;
    }

}