<?php
require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();

// products
$products = $conn->query("SELECT * FROM products");

// main categories
$categories = $conn->query("SELECT * FROM categories WHERE parent_id IS NULL");

// brands
$brands = $conn->query("SELECT * FROM brands");
?>

<!DOCTYPE html>
<html>
<head>
<title>Computer Shop</title>

<link rel="stylesheet" href="../../public/assets/css/style.css">
<script src="../../public/assets/js/app.js"></script>

<style>
body {
    font-family: Arial;
    background: #f4f6f9;
    margin: 0;
}

h2 {
    text-align: center;
    background: #2c3e50;
    color: white;
    padding: 15px;
}

.container {
    display: flex;
    padding: 20px;
}

.sidebar {
    width: 220px;
    background: white;
    padding: 15px;
    border-radius: 10px;
    margin-right: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.sidebar a {
    display: block;
    padding: 8px;
    margin-bottom: 6px;
    border-radius: 6px;
    color: #333;
    text-decoration: none;
    background: #f8f9fa;
    transition: 0.3s;
}

.sidebar a:hover {
    background: #e2e6ea;
}

.main {
    flex: 1;
}

.filters {
    margin-bottom: 15px;
}

.filters input {
    padding: 8px;
    margin-right: 5px;
}

/* 🔥 GRID */
.products {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px,1fr));
    gap: 15px;
}

/* 🔥 CARD */
.card {
    background: white;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
}

/* 🔥 IMAGE FIX */
.card img {
    width: 100%;
    height: 150px;
    object-fit: contain;   /* ✅ FULL IMAGE SHOW */
    background: #f8f9fa;
    padding: 5px;
    border-radius: 8px;
}

.card button {
    background: #27ae60;
    color: white;
    border: none;
    padding: 8px;
    margin-top: 5px;
    cursor: pointer;
    border-radius: 5px;
}

.card button:hover {
    background: #219150;
}
</style>

</head>

<body>

<h2>🛒 Computer Shop</h2>

<div class="container">

<!-- SIDEBAR -->
<div class="sidebar">

    <h3>📂 Categories</h3>
    <?php while($cat = $categories->fetch(PDO::FETCH_ASSOC)){ ?>
        <a href="category.php?id=<?= $cat['id'] ?>">
            <?= htmlspecialchars($cat['name']) ?>
        </a>
    <?php } ?>

    <h3 style="margin-top:15px;">🏷 Brands</h3>
    <?php while($b = $brands->fetch(PDO::FETCH_ASSOC)){ ?>
        <a href="brand.php?id=<?= $b['id'] ?>">
            <?= htmlspecialchars($b['name']) ?>
        </a>
    <?php } ?>

</div>

<!-- MAIN -->
<div class="main">

    <!-- FILTER -->
    <div class="filters">
        <input id="search" onkeyup="searchProducts()" placeholder="Search product...">
        <input id="min" type="number" oninput="searchProducts()" placeholder="Min price">
        <input id="max" type="number" oninput="searchProducts()" placeholder="Max price">
    </div>

    <!-- PRODUCTS -->
    <div id="product-list" class="products">

    <?php if($products->rowCount() == 0){ ?>
        <p>❌ No products found</p>
    <?php } ?>

    <?php while($row = $products->fetch(PDO::FETCH_ASSOC)){ ?>

    <?php
    // 🔥 IMAGE FIX WITH FALLBACK
    $imgPath = "../../public/uploads/products/".$row['image_path'];

    if(empty($row['image_path']) || !file_exists($imgPath)){
        $imgPath = "../../public/assets/no-image.png";
    }
    ?>

    <div class="card">

        <img src="<?= $imgPath ?>" alt="product">

        <h4><?= htmlspecialchars($row['name']) ?></h4>

        <p>💰 <?= $row['price'] ?> ৳</p>

        <a href="product_details.php?id=<?= $row['id'] ?>">View</a>

        <br>

        <button onclick="addToCart(<?= $row['id'] ?>)">
            Add to Cart
        </button>

    </div>

    <?php } ?>

    </div>

</div>

</div>

</body>
</html>