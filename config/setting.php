<?php

class database{
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $charset;
    protected function connect(){
        $this->host = 'localhost';
        $this->username = 'root' ;
        $this->passsword = '';
        $this->dbname = 'student_dbms';
        $this->charset = 'utf8';
        try{
            $db = "mysql:host=".$this->host.";dbname=".$this->dbname.";charset".$this->charset;
            $conn = new PDO($db, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            die("Can't connect to ".$e->getMessage());
        }
    }
}
?>