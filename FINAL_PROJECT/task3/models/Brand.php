<?php
class Brand {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // সব brand
    public function getAll(){
        return $this->conn->query("SELECT * FROM brands");
    }

    // specific brand
    public function getById($id){
        $stmt = $this->conn->prepare("SELECT * FROM brands WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // category অনুযায়ী brand
    public function getByCategory($category_id){
        $stmt = $this->conn->prepare("SELECT * FROM brands WHERE category_id=?");
        $stmt->execute([$category_id]);
        return $stmt;
    }
}
?>