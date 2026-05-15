<?php
class Product {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        return $this->conn->query("SELECT * FROM products");
    }

    public function getById($id){
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search($q,$min,$max){
        $min = max(0,(int)$min);
        $max = max($min,(int)$max);

        $stmt = $this->conn->prepare(
            "SELECT * FROM products WHERE name LIKE ? AND price BETWEEN ? AND ?"
        );
        $stmt->execute(["%$q%",$min,$max]);
        return $stmt;
    }
}
?>