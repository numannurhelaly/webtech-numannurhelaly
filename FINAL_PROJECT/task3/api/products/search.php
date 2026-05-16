<?php
require_once "../../config/database.php";
header("Content-Type: application/json");

$db = new Database();
$conn = $db->connect();

$q = $_GET['q'] ?? "";
$min = $_GET['min'] ?? "";
$max = $_GET['max'] ?? "";

$sql = "SELECT * FROM products WHERE name LIKE ?";
$params = ["%$q%"];

// ✅ MIN filter
if($min !== ""){
    $sql .= " AND price >= ?";
    $params[] = (float)$min;
}

// ✅ MAX filter
if($max !== ""){
    $sql .= " AND price <= ?";
    $params[] = (float)$max;
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));