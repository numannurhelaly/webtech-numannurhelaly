<?php
require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$p){
    echo "Not found";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> Product Details</title>
<link rel="stylesheet" href="../../public/assets/css/style.css">
</head>

<body>

<!-- 🔥 HEADER (OUTSIDE EVERYTHING) -->
<div class="header">
    💻 Computer Shop
</div>

<div class="container">

    <div class="product-details">

        <div class="product-image">
            <img src="../../public/uploads/products/<?= $p['image_path'] ?>">
        </div>

        <div class="product-info">

            <h2><?= htmlspecialchars($p['name']) ?></h2>

            <p class="desc">Description: <?= htmlspecialchars($p['description']) ?></p>

            <p class="review">📝 Review: <?= htmlspecialchars($p['manufacturer_review']) ?></p>

            <p class="price">💰 Price: <?= $p['price'] ?> ৳</p>

            <p class="stock">📦 Stock: <?= $p['stock'] ?></p>

            <button onclick="addToCart(<?= $p['id'] ?>)">
                🛒 Add to Cart
            </button>

        </div>

    </div>

</div>

<script>
function addToCart(id){
    fetch("../../api/cart/add.php", {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: "product_id=" + id
    })
    .then(res=>res.json())
    .then(data=>{
        alert("Added to cart ✅ Total: " + data.count);
    });
}
</script>

</body>
</html>