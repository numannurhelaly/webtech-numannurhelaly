// 🔍 SEARCH + FILTER (AJAX)
function searchProducts(){

let q = document.getElementById("search").value.trim();

let min = document.getElementById("min").value;
let max = document.getElementById("max").value;

// ✅ FIX: proper null handling
min = min === "" ? "" : parseFloat(min);
max = max === "" ? "" : parseFloat(max);

// validation
if((min !== "" && isNaN(min)) || (max !== "" && isNaN(max))){
    alert("Invalid price");
    return;
}

if(min !== "" && max !== "" && min > max){
    alert("Min price cannot be greater than max price");
    return;
}

// 🔥 API CALL
fetch(`../../api/products/search.php?q=${q}&min=${min}&max=${max}`)
.then(res => res.json())
.then(data => {

let html = "";

// ✅ SHOW COUNT (debug + clarity)
html += `<p style="margin-bottom:10px;">Showing ${data.length} products</p>`;

if(data.length === 0){
    html += "<p>❌ No products found</p>";
}else{

data.forEach(p=>{
html += `
<div class="card">

<img src="../../public/uploads/products/${p.image_path}" 
style="width:100%;height:120px;object-fit:cover;border-radius:6px;">

<h4>${p.name}</h4>

<p>💰 ${p.price} ৳</p>

<a href="product_details.php?id=${p.id}">View</a>

<br><br>

<button onclick="addToCart(${p.id})">Add to Cart</button>

</div>
`;
});

}

document.getElementById("product-list").innerHTML = html;

})
.catch(err => {
console.error("Search error:", err);
});

}


// 🔥 IMPORTANT: AUTO TRIGGER ON INPUT
document.getElementById("search").addEventListener("keyup", searchProducts);
document.getElementById("min").addEventListener("input", searchProducts);
document.getElementById("max").addEventListener("input", searchProducts);


// 🛒 ADD TO CART
function addToCart(id){

fetch("../../api/cart/add.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`product_id=${id}`
})
.then(res => res.json())
.then(data => {

if(data.error){
alert(data.error);
}else{
alert("✅ Added to cart");
}

})
.catch(err => {
console.error("Cart error:", err);
});

}


// 🔄 UPDATE CART
function updateCartLive(id, qty){

if(qty <= 0){
alert("Invalid quantity");
return;
}

fetch("../../api/cart/update.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`product_id=${id}&qty=${qty}`
})
.then(res => res.json())
.then(data => {

if(data.error){
alert(data.error);
return;
}

let subEl = document.getElementById(`sub-${id}`);

if(subEl){
let currentSub = parseFloat(subEl.innerText);
let oldQty = parseFloat(subEl.getAttribute("data-qty")) || qty;

let unitPrice = currentSub / oldQty;
let newSub = unitPrice * qty;

subEl.innerText = newSub;
subEl.setAttribute("data-qty", qty);
}

updateTotal();

})
.catch(err => {
console.error("Update error:", err);
});

}


// ❌ REMOVE ITEM
function removeItemLive(id){

fetch("../../api/cart/remove.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`product_id=${id}`
})
.then(res => res.json())
.then(() => {
location.reload();
})
.catch(err => {
console.error("Remove error:", err);
});

}


// 💰 TOTAL
function updateTotal(){

let subs = document.querySelectorAll("[id^='sub-']");
let total = 0;

subs.forEach(s=>{
let val = parseFloat(s.innerText);
if(!isNaN(val)){
total += val;
}
});

let totalEl = document.getElementById("total");
if(totalEl){
totalEl.innerText = total;
}

}