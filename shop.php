<?php
session_start();
require_once 'config/db.php';

// Add to Cart Logic
if (isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
    $msg = "Product added to cart!";
}

// Fetch Products
$products_result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Hub Mart</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f7f6; margin: 0; padding: 20px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-top: 20px; }
        .card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 15px; }
        .card-img { width: 100%; height: 180px; object-fit: cover; border-radius: 6px; }
        .card-title { font-size: 18px; font-weight: bold; margin: 10px 0 5px; color: #2c3e50; }
        .card-desc { font-size: 13px; color: #666; margin-bottom: 10px; height: 36px; overflow: hidden; }
        .card-price { font-size: 16px; color: #27ae60; font-weight: bold; margin-bottom: 10px; }
        .qty-input { width: 50px; padding: 5px; margin-right: 5px; }
        .btn { background: #3498db; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #2980b9; }
    </style>
</head>
<body>

<h2>Available Products</h2>

<div class="product-grid">
    <?php if ($products_result && $products_result->num_rows > 0): ?>
        <?php while ($product = $products_result->fetch_assoc()): ?>
            <div class="card">
                <!-- Image URL හෝ local assets path එක පෙන්වීම -->
                <?php 
                    $img_src = (filter_var($product['image'], FILTER_VALIDATE_URL)) 
                        ? $product['image'] 
                        : 'assets/images/' . $product['image'];
                ?>
                <img src="<?= htmlspecialchars($img_src) ?>" alt="Pet Product" class="card-img" onerror="this.src='https://via.placeholder.com/250x180?text=Pet+Product'">
                
                <div class="card-title"><?= htmlspecialchars($product['name']) ?></div>
                
                <!-- Description එක පෙන්වන කොටස -->
                <div class="card-desc"><?= htmlspecialchars($product['description'] ?? 'High quality pet care essential for your loving pet.') ?></div>
                
                <div class="card-price">LKR <?= number_format($product['price'], 2) ?></div>
                
                <form method="POST" action="shop.php">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <input type="number" name="quantity" value="1" min="1" class="qty-input">
                    <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No products available right now.</p>
    <?php endif; ?>
</div>

</body>
</html>