<?php
require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();

$products = $conn->query("SELECT * FROM products");
$categories = $conn->query("SELECT * FROM categories WHERE parent_id IS NULL");
$brands = $conn->query("SELECT * FROM brands"); // 🔥 ADD THIS
?>

<!DOCTYPE html>
<html>
<head>
<title>Computer Shop</title>

<link rel="stylesheet" href="../../public/assets/css/style.css">
<script src="../../public/assets/js/app.js"></script>

<style>

/* HEADER */
.header {
    background: linear-gradient(135deg, #2c3e50, #4ca1af);
    color: white;
    padding: 20px;
    font-size: 28px;
    text-align: center;
    font-weight: bold;
}

/* LAYOUT */
.container {
    display: flex;
    padding: 20px;
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    background: white;
    padding: 15px;
    border-radius: 10px;
    margin-right: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.sidebar h3 {
    margin: 10px 0;
}

.sidebar a {
    display: block;
    padding: 8px;
    border-radius: 6px;
    color: #333;
    text-decoration: none;
}

.sidebar a:hover {
    background: #f1f1f1;
}

/* MAIN */
.main {
    flex: 1;
}

/* FILTER */
.filters input {
    padding: 8px;
    margin: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

/* GRID */
.products {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px,1fr));
    gap: 15px;
}

/* CARD */
.card {
    background: white;
    padding: 12px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

/* IMAGE */
.card img {
    width: 100%;
    height: 130px;
    object-fit: cover;
    border-radius: 8px;
}

.card h4 {
    margin: 10px 0;
}

.card p {
    color: #555;
}

/* BUTTON */
.card button {
    background: #27ae60;
    color: white;
    border: none;
    padding: 8px 10px;
    border-radius: 6px;
    cursor: pointer;
}

.card button:hover {
    background: #219150;
}

.card a {
    display: inline-block;
    margin-top: 5px;
    color: #007bff;
}

</style>

</head>

<body>

<div class="header">💻 Computer Shop</div>

<div class="container">

<!-- SIDEBAR -->
<div class="sidebar">

    <h3>📂 Categories</h3>
    <?php while($cat = $categories->fetch(PDO::FETCH_ASSOC)){ ?>
        <a href="category.php?id=<?= $cat['id'] ?>">
            <?= htmlspecialchars($cat['name']) ?>
        </a>
    <?php } ?>

    <!-- 🔥 BRAND SECTION -->
    <h3>🏷 Brands</h3>
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
        <input id="min" type="number" placeholder="Min price">
        <input id="max" type="number" placeholder="Max price">
    </div>

    <!-- PRODUCTS -->
    <div id="product-list" class="products">

    <?php if($products->rowCount() == 0){ ?>
        <p>❌ No products found</p>
    <?php } ?>

    <?php while($row = $products->fetch(PDO::FETCH_ASSOC)){ ?>

        <?php
        $imgPath = "../../public/uploads/products/".$row['image_path'];
        $imgUrl  = "../../public/uploads/products/".$row['image_path'];

        if(!file_exists($imgPath) || empty($row['image_path'])){
            $imgUrl = "../../public/assets/no-image.png";
        }
        ?>

        <div class="card">

            <img src="<?= $imgUrl ?>" alt="product">

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