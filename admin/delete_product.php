<?php
// Include the database configuration file
require_once "conn.php";

// Check if product ID is provided
if (!isset($_GET['id'])) {
    echo "Product ID not provided.";
    exit;
}

// Fetch product details based on the provided ID
$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

// Check if the product exists
if ($result->num_rows == 0) {
    echo "Product not found.";
    exit;
}

// Perform the deletion
$delete_sql = "DELETE FROM products WHERE id = $product_id";
if ($conn->query($delete_sql) === TRUE) {
    echo "<script>alert('Product deleted successfully.');</script>";
    // Redirect to products.php
    header("Location:update_product.php");
} else {
    // Display error message in a popup
    echo "<script>alert('Error deleting product: " . $conn->error . "');</script>";
}

// Close the database connection
$conn->close();
?>
