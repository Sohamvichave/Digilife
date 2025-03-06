<?php
session_start();

// Check if the session contains order details
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "No orders found. Please return to the cart.";
    exit();
}

// Retrieve order details from the session
$totalPrice = $_SESSION['total'];
$products = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <h2>Order Details:</h2>
    <p>Total Price: Rs.<?php echo htmlspecialchars($totalPrice); ?></p>
    <h3>Products:</h3>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?php echo htmlspecialchars($product['name']); ?> - Rs.<?php echo htmlspecialchars($product['price']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
