// 🔍 SEARCH + FILTER (AJAX)
function searchProducts(){

let q = document.getElementById("search").value;
let min = document.getElementById("min").value || 0;
let max = document.getElementById("max").value || 999999;

// JS validation
if(isNaN(min) || isNaN(max) || min < 0 || max < 0){
alert("Invalid price");
return;
}

fetch(`../../api/products/search.php?q=${q}&min=${min}&max=${max}`)
.then(res => res.json())
.then(data => {

let html = "";

if(data.length === 0){
html = "<p>❌ No products found</p>";
}else{

data.forEach(p=>{
html += `
<div class="card">
<h4>${p.name}</h4>
<p>💰 ${p.price} ৳</p>
<img src="../../public/uploads/products/${p.image_path}" width="100">
<br>
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


// 🛒 ADD TO CART (AJAX) ✅ FIXED
function addToCart(id){

fetch("../../api/cart/add.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`product_id=${id}`
})
.then(res => res.json()) // 🔥 IMPORTANT FIX
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


// 🔄 UPDATE CART (LIVE, NO RELOAD)
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

// subtotal update
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


// ❌ REMOVE ITEM (LIVE)
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


// 💰 TOTAL CALCULATE (AUTO)
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