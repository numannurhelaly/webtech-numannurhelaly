<?php
class Category {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // all category 
    public function getAll(){
        return $this->conn->query("SELECT * FROM categories");
    }

    // single category
    public function getById($id){
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // sub-category 
    public function getSubCategories($parent_id){
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE parent_id=?");
        $stmt->execute([$parent_id]);
        return $stmt;
    }

    // parent categories (main category)
    public function getParentCategories(){
        return $this->conn->query("SELECT * FROM categories WHERE parent_id IS NULL");
    }
}
?>