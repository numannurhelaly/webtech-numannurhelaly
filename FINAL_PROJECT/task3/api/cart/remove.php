<?php
session_start();
header("Content-Type: application/json");

$id = $_POST['product_id'];

unset($_SESSION['cart'][$id]);

echo json_encode(["status"=>"removed"]);
?>