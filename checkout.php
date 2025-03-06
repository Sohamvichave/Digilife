<?php
session_start();
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "Digilife"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $cart = $_SESSION['cart'];

    foreach ($cart as $item) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO orders (name, address, email, phone, product_name, price, quantity, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssssdids", $name, $address, $email, $phone, $item['name'], $item['price'], $item['quantity']);
        
        // Execute the prepared statement
        $stmt->execute();
    }

    // Clear cart after order
    unset($_SESSION['cart']);
    echo "Order placed successfully!";
    header("Location: order_confirmation.php"); // Redirect to confirmation page
    exit();
}

$conn->close();
?>
