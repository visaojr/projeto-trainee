<?php
 
namespace VisaoJR\Treinee\Model;

use \PDO;
use \PDOException;

require_once 'Database.php';

class Course{
    private $id;
    private $name;
    private $semesters;
    
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
    public function setSemesters($value){
        $this->semesters = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `Course` VALUES(:name, :semesters)");
            $stmt->bindParam(":name", $this->$name);
            $stmt->bindParam("semesters", $this->semesters);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function delete(){
        try{    
            $stmt = $this->conn->prepare("DELETE FROM `course` WHERE `id` == :id");
            $stmt->execute();
            return 1;
        catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `course` SET `name` == :name, `semesters` == :semesters WHERE `id` == :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->$name);
            $stmt->bindParam("semesters", $this->semesters);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `course` WHERE 1 ORDER BY `name`");
        $stmt->execute();
    }
    

}