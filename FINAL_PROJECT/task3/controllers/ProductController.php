<?php
require_once "../models/Product.php";

class ProductController {
    private $model;

    public function __construct($db){
        $this->model = new Product($db);
    }

    // সব product
    public function index(){
        return $this->model->getAll();
    }

    // single product
    public function show($id){
        return $this->model->getById($id);
    }

    // search (AJAX use)
    public function search($q, $min, $max){
        return $this->model->search($q, $min, $max);
    }
}
?>