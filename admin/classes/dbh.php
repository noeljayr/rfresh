<?php
class Dbh {
    private $host = 'localhost';
    private $dbname = 'reggaefr_dev2024';
    private $username = 'root';
    private $password = '';
    private $pdo;

    protected function connect() {
        try {
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname; // Corrected $dbName to $dbname
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Uncommented error mode setting
            return $this->pdo;
        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage()."<br/>"; // Handle the error better
            die();
        }
    }

    protected function close_connection() {
        $this->pdo = null;
    }
}
?>
