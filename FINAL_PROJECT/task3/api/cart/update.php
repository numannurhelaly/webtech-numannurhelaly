<?php
session_start();
header("Content-Type: application/json");

$id = $_POST['product_id'];
$qty = $_POST['qty'];

if($qty <= 0){
echo json_encode(["error"=>"Invalid qty"]);
exit;
}

$_SESSION['cart'][$id] = $qty;

echo json_encode(["status"=>"updated"]);
?>