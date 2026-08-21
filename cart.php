<?php
session_start();
require_once 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantity'] as $product_id => $qty) {
            $qty = intval($qty);
            if ($qty <= 0) {
                unset($_SESSION['cart'][$product_id]);
            } else {
                $_SESSION['cart'][$product_id] = $qty;
            }
        }
    } elseif (isset($_POST['remove_item'])) {
        $remove_id = intval($_POST['remove_id']);
        unset($_SESSION['cart'][$remove_id]);
    }
}

// Fetch Cart Products from Database
$cart_products = [];
$total_price = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
    $query = "SELECT * FROM products WHERE product_id IN ($ids)";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $cart_products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 6px 12px; cursor: pointer; }
    </style>
</head>
<body>

<a href="shop.php">← Back to Shop</a>
<h2>Your Shopping Cart</h2>

<?php if (empty($cart_products)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <form method="POST" action="cart.php">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_products as $product): 
                    $id = $product['product_id'];
                    $qty = $_SESSION['cart'][$id];
                    $subtotal = $product['price'] * $qty;
                    $total_price += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td>LKR <?= number_format($product['price'], 2) ?></td>
                        <td>
                            <input type="number" name="quantity[<?= $id ?>]" value="<?= $qty ?>" min="0" style="width: 60px;">
                        </td>
                        <td>LKR <?= number_format($subtotal, 2) ?></td>
                        <td>
                            <button type="submit" name="remove_item" class="btn" style="color:red;">Remove</button>
                            <input type="hidden" name="remove_id" value="<?= $id ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total: LKR <?= number_format($total_price, 2) ?></h3>

        <button type="submit" name="update_cart" class="btn">Update Quantities</button>
    </form>
<?php endif; ?>

</body>
</html>