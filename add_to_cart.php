<?php
session_start(); // Start session to access cart data

// Check if productName and price are set in POST request
if (isset($_POST['productName']) && isset($_POST['price'])) {
    // Extract product name and price from POST data
    $productName = $_POST['productName'];
    $price = $_POST['price'];

    // Create item array with product name and price
    $item = array(
        'product_name' => $productName,
        'price' => $price
    );

    // Add item to cart session variable
    $_SESSION['cart'][] = $item;

    // Return success response
    http_response_code(200);
    echo "Item added to cart!";
} else {
    // Return error response if productName or price is not set
    http_response_code(400);
    echo "Failed to add item to cart!";
}
?>
