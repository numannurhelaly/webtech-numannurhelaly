<?php
session_start();
require_once "../../config/database.php";
header("Content-Type: application/json");

$db = new Database();
$conn = $db->connect();

$id = $_POST['product_id'] ?? 0;

$stmt = $conn->prepare("SELECT stock FROM products WHERE id=?");
$stmt->execute([$id]);
$p = $stmt->fetch();

if(!$p){
echo json_encode(["error"=>"Invalid product"]);
exit;
}

if($p['stock'] <= 0){
echo json_encode(["error"=>"Out of stock"]);
exit;
}

$_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;

echo json_encode(["status"=>"added"]);
?>