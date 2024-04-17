<?php
// Start session
session_start();

// Include database connection
include 'conn.php';
include 'header.php';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "Add to Cart" form is submitted
    if (isset($_POST['add_to_cart'])) {
      
        // Create an array to store product details
        $product = [
            'product_name' => $productName,
            'price' => $price
        ];

        // Check if the cart session variable is set
        if (!isset($_SESSION['cart'])) {
            // If cart session variable is not set, initialize it as an empty array
            $_SESSION['cart'] = [];
        }

        // Add the product to the cart session variable
        $_SESSION['cart'][] = $product;
    }

    // Check if the "Empty Cart" form is submitted
    if (isset($_POST['empty_cart'])) {
        // Clear the cart session variable
        unset($_SESSION['cart']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            color: blue;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }

        .checkout-btn, .empty-cart-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
        }

        .checkout-btn:hover, .empty-cart-btn:hover {
            background-color: #45a049;
        }

        .delete-btn {
            color: red;
            cursor: pointer;
        }

        .delete-btn:hover {
            text-decoration: underline;
        }
        .cart-empty-message {
    text-align: center; /* Center the text horizontally */
    padding: 20px; /* Add some padding for spacing */
    font-size: 18px; /* Adjust the font size as needed */
    color: blue; /* Set the text color */
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Pool Table & Accessories Store<br>Shopping Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if cart session variable is set and not empty
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    // Loop through each product in the cart
                    foreach ($_SESSION['cart'] as $product) {
                        echo "<tr>";
                        echo "<td>{$product['product_name']}</td>";
                        echo "<td>{$product['price']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='cart-empty-message'>Your cart is empty</td></tr>";

                }
                ?>
            </tbody>
        </table>
        <form method="post">
            <button type="submit" class="btn btn-success checkout-btn" name="empty_cart">Empty Cart</button>
        </form>
        <a href="M-PESA/checkout.php" class="btn btn-success checkout-btn">Checkout</a>
    </div>
    <?php include 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
