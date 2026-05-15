<?php
require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();

// ✅ safe id check
$id = $_GET['id'] ?? null;
if(!$id){
    echo "❌ No category selected";
    exit;
}

// ✅ category + sub-category products
$stmt = $conn->prepare("
SELECT * FROM products WHERE category_id=?
OR category_id IN (SELECT id FROM categories WHERE parent_id=?)
");

$stmt->execute([$id,$id]);
?>

<!DOCTYPE html>
<html>
<head>
<title>Category Products</title>

<link rel="stylesheet" href="../../public/assets/css/style.css">

<style>

/* HEADER */
.header {
    background: linear-gradient(135deg, #2c3e50, #4ca1af);
    color: white;
    padding: 18px;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
}

/* CONTAINER */
.container {
    padding: 20px;
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

/* TEXT */
.card h4 {
    margin: 10px 0;
    color: #222;
}

.card p {
    color: #555;
    margin: 5px 0;
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

<script src="../../public/assets/js/app.js"></script>

</head>

<body>

<div class="header">💻 Computer Shop - Category</div>

<div class="container">

<div class="products">

<?php if($stmt->rowCount() == 0){ ?>
    <p>❌ No products found</p>
<?php } ?>

<?php while($p = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>

<?php
// 🔥 image fix
$imgPath = "../../public/uploads/products/".$p['image_path'];
$imgUrl  = "../../public/uploads/products/".$p['image_path'];

if(!file_exists($imgPath) || empty($p['image_path'])){
    $imgUrl = "../../public/assets/no-image.png";
}
?>

<div class="card">

    <img src="<?= $imgUrl ?>" alt="product">

    <h4><?= htmlspecialchars($p['name']) ?></h4>

    <p>💰 <?= $p['price'] ?> ৳</p>

    <p>📦 Stock: <?= $p['stock'] ?></p>

    <a href="product_details.php?id=<?= $p['id'] ?>">View</a>
    <br>

    <button onclick="addToCart(<?= $p['id'] ?>)">
        Add to Cart
    </button>

</div>

<?php } ?>

</div>

</div>

</body>
</html>