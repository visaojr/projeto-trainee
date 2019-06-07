<?php


class Database
{
    private $host = "localhost";
    /*"visao-db-03.cft1idki1h3y.us-east-1.rds.amazonaws.com:8080"*/
    private $db_name = "treinamento_trainee";
    private $username = "root";
    /*"visaojr"*/
    private $password = "";
    /*"visaojr2415"*/

    public $conn;

    public function dbSet()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
              echo "Erro na conexão com o banco de dados: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public static function prepare($sql){
        return self::dbSet()->prepare($sql);
    }
}

?>