<?php
class Dbh{
    private $username = "root";
    private $password = "";
    private $host = "localhost";
    private $dbName = "reggaefresh";

    private $pdo;

    protected function connect(){

        try{
            $dsn = 'mysql:host='.$this->host. ';dbname='.$this->dbName;
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;

        }catch( PDOException $e ) {
            print "Error!: ".$e->getMessage()."<br/>"; //handle the error better
            die();
        }
    }
    protected function close_connection(){
        $this->pdo = null;
    }
}