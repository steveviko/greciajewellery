<?php
// used to get mysql database connection
class Database{
 
    // specify database credentials/properties
    private $host = "remotemysql.com";
    private $db_name = "vvUhx6iGfj";
    private $username = "vvUhx6iGfj";
    private $password = "f4VccaNSzz";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>
