<?php

class Database {
    private $host = "localhost";
    private $dbname = "novahealth";
    private $username = "root";
    private $password = "";
    private $conn;

    //Pjesa e konstruktorit qe ekzekutohet kjo pjesa e operatorit pra te objektit te klases
     public function __construct() {
        try {
            $this->conn = new PDO(dsn: "mysql:host={$this->host};dbname={$this->dbname}", username: $this->username, password: $this->password); //perdoret per me kriju nje lidhje te re ne bazen e te dhenave me parametrat host,dbname,username,password.
            $this->conn->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);  //vendos nje atribut qe i thote PDO me e gjujt nje excepetion ne rast se ka ndodh ndonje gabim te lidhjes se serverit ose te ekzekutimit te bazes se te dhenave ose te kodit.

        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
    
        }
     }

     public function getConnection(): PDO{  //Funksioni getConnection e kthen objektin ne connection qe eshte lidhje mes bazes se te dhenave dhe app qe kemi involvuar.
        return $this->conn;

     }



}

?>
