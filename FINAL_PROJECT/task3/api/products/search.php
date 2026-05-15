<?php
require_once "../../config/database.php";
header("Content-Type: application/json");

$db = new Database();
$conn = $db->connect();

$q = $_GET['q'] ?? "";
$min = $_GET['min'] ?? 0;
$max = $_GET['max'] ?? 999999;

$min = max(0,(int)$min);
$max = max($min,(int)$max);

$stmt = $conn->prepare(
"SELECT * FROM products WHERE name LIKE ? AND price BETWEEN ? AND ?"
);

$stmt->execute(["%$q%",$min,$max]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>