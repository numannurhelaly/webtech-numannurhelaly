<?php
require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();

// products
$products = $conn->query("SELECT * FROM products");

// main categories
$categories = $conn->query("SELECT * FROM categories WHERE parent_id IS NULL");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Computer Shop</title>

    <!-- CSS + JS -->
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <script src="../../public/assets/js/app.js"></script>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
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

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px,1fr));
            gap: 15px;
        }

        .card {
            background: white;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        .card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
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

    <!-- 🔥 ADD THIS PART -->
    <h3 style="margin-top:15px;">🏷 Brands</h3>

    <?php
    $brands = $conn->query("SELECT * FROM brands");
    while($b = $brands->fetch(PDO::FETCH_ASSOC)){
    ?>
        <a href="brand.php?id=<?= $b['id'] ?>">
            <?= htmlspecialchars($b['name']) ?>
        </a>
    <?php } ?>

</div>

    <!-- MAIN CONTENT -->
    <div class="main">

        <!-- SEARCH + FILTER -->
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
            <div class="card">

                <img src="../../public/uploads/products/<?= $row['image_path'] ?>" alt="">

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