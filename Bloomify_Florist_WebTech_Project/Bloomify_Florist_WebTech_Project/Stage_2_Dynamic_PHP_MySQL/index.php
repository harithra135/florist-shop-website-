<?php
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["place_order"])) {
    $customer = trim($_POST["customer"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $product = trim($_POST["product"] ?? "");
    $quantity = max(1, (int)($_POST["quantity"] ?? 1));
    if ($customer && filter_var($email, FILTER_VALIDATE_EMAIL) && $product) {
        $stmt=$conn->prepare("INSERT INTO orders(customer_name,email,product_name,quantity) VALUES(?,?,?,?)");
        $stmt->bind_param("sssi",$customer,$email,$product,$quantity); $stmt->execute(); $stmt->close();
        header("Location: index.php?ordered=1#order"); exit;
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["contact_submit"])) {
    $name=trim($_POST["name"]??""); $email=trim($_POST["email"]??""); $message=trim($_POST["message"]??"");
    if($name && filter_var($email,FILTER_VALIDATE_EMAIL) && $message){
        $stmt=$conn->prepare("INSERT INTO messages(name,email,message) VALUES(?,?,?)");
        $stmt->bind_param("sss",$name,$email,$message);$stmt->execute();$stmt->close();
        header("Location: index.php?sent=1#contact");exit;
    }
}
$flowers=$conn->query("SELECT * FROM flowers ORDER BY id DESC");
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Bloomify | Dynamic Florist</title><link rel="stylesheet" href="css/style.css"><style>
.dbbar{background:#342a2a;color:#fff;padding:9px;text-align:center;font-size:12px}.dbbar span{color:#7be0ae}.server-order{background:#f6eee9;padding:35px 7%}.order-form{max-width:700px;display:grid;grid-template-columns:1fr 1fr;gap:12px}.order-form input,.order-form select{padding:12px;border:1px solid #dfd0ca;border-radius:10px;font:inherit}.order-form button{grid-column:1/-1}.success{color:#23966b;font-weight:700}
</style></head><body>
<div class="dbbar">Bloomify Dynamic Store · PHP + MySQL · <span>● Database Connected</span></div>
<header class="navbar"><a class="logo" href="#">Bloom<span>ify</span><small>FLOWERS & GIFTS</small></a><nav><a href="#shop">Shop</a><a href="#order">Order</a><a href="#contact">Contact</a></nav></header>
<section class="hero"><div class="hero-copy"><p class="eyebrow">DYNAMIC FLORIST STORE</p><h1>Let your feelings <em>bloom.</em></h1>
<p>Flower products and customer orders are now loaded and stored through PHP and MySQL.</p><div class="hero-actions"><a class="btn primary" href="#shop">Browse Flowers</a></div></div><div class="hero-art"><div class="circle c1"></div><div class="circle c2"></div><div class="bouquet">💐</div></div></section>

<section id="shop" class="section"><div class="section-head"><div><p class="eyebrow">MYSQL PRODUCTS</p><h2>Fresh from our collection</h2></div></div>
<div class="products"><?php while($p=$flowers->fetch_assoc()): ?><article class="product"><div class="product-img"><?=htmlspecialchars($p["emoji"])?></div>
<div class="product-body"><h3><?=htmlspecialchars($p["name"])?></h3><p><?=htmlspecialchars($p["description"])?></p>
<div class="product-foot"><span class="price">₹<?=number_format($p["price"])?></span><a class="add" href="#order" onclick="selectFlower('<?=htmlspecialchars($p["name"],ENT_QUOTES)?>')">Order +</a></div></div></article><?php endwhile;?></div></section>

<section id="order" class="server-order"><p class="eyebrow">PHP + MYSQL ORDER FORM</p><h2>Place a flower order</h2>
<?php if(isset($_GET["ordered"])):?><p class="success">Order saved successfully in MySQL.</p><?php endif;?>
<form method="post" class="order-form"><input name="customer" required placeholder="Customer name"><input name="email" required type="email" placeholder="Email">
<select name="product" id="flowerSelect" required><option value="">Select a flower</option><?php $f=$conn->query("SELECT name FROM flowers ORDER BY name");while($x=$f->fetch_assoc()):?><option><?=htmlspecialchars($x["name"])?></option><?php endwhile;?></select>
<input name="quantity" type="number" min="1" value="1" required><button class="btn primary" name="place_order" value="1">Save Order</button></form></section>

<section id="contact" class="contact"><div><p class="eyebrow">CONTACT</p><h2>Need a custom bouquet?</h2><p>Send an enquiry and it will be stored in the MySQL messages table.</p><?php if(isset($_GET["sent"])):?><p class="success">Message saved successfully.</p><?php endif;?></div>
<form method="post"><input name="name" required placeholder="Your name"><input name="email" type="email" required placeholder="Email address"><textarea name="message" rows="4" required placeholder="Your message"></textarea><button class="btn primary" name="contact_submit" value="1">Send Enquiry</button></form></section>
<footer><p>Bloomify · Dynamic PHP + MySQL Florist Store</p></footer>
<script>function selectFlower(n){document.getElementById("flowerSelect").value=n}</script></body></html>
<?php $conn->close();?>