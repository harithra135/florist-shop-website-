const products=[
{name:"Blush Garden Bouquet",price:1499,cat:"romantic",emoji:"💐",desc:"Soft pink roses, lilies & seasonal blooms."},
{name:"Sunshine Celebration",price:1199,cat:"birthday",emoji:"🌻",desc:"Bright sunflowers for a cheerful surprise."},
{name:"Forever Roses",price:1799,cat:"romantic",emoji:"🌹",desc:"Classic red roses wrapped with baby's breath."},
{name:"Pastel Dream",price:1399,cat:"gift",emoji:"🌷",desc:"Delicate pastel tulips in a premium wrap."},
{name:"Lavender Love",price:1299,cat:"gift",emoji:"💜",desc:"Lavender tones with fragrant seasonal flowers."},
{name:"Birthday Bloom Box",price:1599,cat:"birthday",emoji:"🎁",desc:"A flower box made for unforgettable smiles."},
{name:"White Elegance",price:1699,cat:"gift",emoji:"🌼",desc:"Elegant white blooms with eucalyptus."},
{name:"Red Romance",price:1999,cat:"romantic",emoji:"🌹",desc:"A luxurious dozen-rose arrangement."}
];
let cart=[];
const productsEl=document.getElementById("products");
function renderProducts(cat="all"){
 productsEl.innerHTML=products.filter(p=>cat==="all"||p.cat===cat).map((p,i)=>`
 <article class="product"><div class="product-img">${p.emoji}</div><div class="product-body">
 <h3>${p.name}</h3><p>${p.desc}</p><div class="product-foot"><span class="price">₹${p.price.toLocaleString("en-IN")}</span>
 <button class="add" onclick="addToCart(${products.indexOf(p)})">Add +</button></div></div></article>`).join("");
}
function addToCart(i){cart.push(products[i]);renderCart()}
function renderCart(){
 document.getElementById("cartCount").textContent=cart.length;
 document.getElementById("cartItems").innerHTML=cart.length?cart.map((p,i)=>`<div class="cart-item"><span class="emoji">${p.emoji}</span><div><b>${p.name}</b><small>₹${p.price.toLocaleString("en-IN")}</small></div><button class="remove" onclick="removeItem(${i})">✕</button></div>`).join(""):`<p style="color:#887976">Your bag is waiting for something beautiful 🌸</p>`;
 document.getElementById("cartTotal").textContent="₹"+cart.reduce((s,p)=>s+p.price,0).toLocaleString("en-IN");
}
function removeItem(i){cart.splice(i,1);renderCart()}
document.querySelectorAll(".filter").forEach(b=>b.onclick=()=>{document.querySelector(".filter.active").classList.remove("active");b.classList.add("active");renderProducts(b.dataset.cat)});
document.getElementById("cartBtn").onclick=()=>{document.getElementById("cartPanel").classList.add("open");document.getElementById("overlay").classList.add("show")};
function closeCart(){document.getElementById("cartPanel").classList.remove("open");document.getElementById("overlay").classList.remove("show")}
document.getElementById("closeCart").onclick=closeCart;document.getElementById("overlay").onclick=closeCart;
document.getElementById("checkout").onclick=()=>{if(!cart.length)return alert("Please add a flower first.");alert("Thank you! Your demo order has been received. Stage 2 can connect this checkout to MySQL.");cart=[];renderCart();closeCart()};
document.getElementById("contactForm").onsubmit=e=>{e.preventDefault();document.getElementById("formStatus").textContent="Thanks! Your enquiry has been validated successfully.";e.target.reset()};
renderProducts();renderCart();