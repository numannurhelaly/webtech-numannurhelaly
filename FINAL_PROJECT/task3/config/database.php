<?php
class Database {
    private $host = "localhost";
    private $db_name = "computer_shop";
    private $username = "root";
    private $password = "";

    public function connect(){
        return new PDO(
            "mysql:host=".$this->host.";dbname=".$this->db_name,
            $this->username,
            $this->password
        );
    }
}
?>