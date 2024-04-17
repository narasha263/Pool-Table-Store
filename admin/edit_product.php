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

// Fetch product details
$product = $result->fetch_assoc();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Update product details in the database
    $update_sql = "UPDATE products SET product_name = '$product_name', price = '$price' WHERE id = $product_id";
    if ($conn->query($update_sql) === TRUE) {
        echo '<script>alert("Product updated successfully.");</script>';
    } else {
        echo '<script>alert("Error updating product: ' . $conn->error . '");</script>';
    }
    
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* Add the CSS code here */
        /* Form container */
        form {
            width: 50%;
            margin: 0 auto;
        }

        /* Form input fields */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Submit button */
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST">
        <label for="name">Product Name:</label><br>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>"><br>
        <label for="price">Product Price:</label><br>
        <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>"><br><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Watch Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom CSS for Admin Panel */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #343a40;
            padding-top: 20px;
            color: #fff;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sub-menu {
            display: none;
            padding-left: 20px;
        }

        .sub-menu.active {
            display: block;
        }

        .container {
            margin-top: 20px;
            margin-left: 270px;
        }

        /* Custom CSS for sidebar toggler */
        .sidebar-toggler {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #fff;
            font-size: 24px;
        }

        .sidebar-toggler:hover {
            color: #ccc;
        }

        /* Custom CSS for dropdown */
        .dropdown-menu {
            background-color: #343a40;
            border: none;
        }

        .dropdown-menu a {
            color: #fff;
        }

        .dropdown-menu a:hover {
            background-color: #495057;
        }

        /* Custom CSS for page content */
        .page-content {
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Responsive CSS */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .container {
                margin-left: 220px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="dahsboard.php">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>

                </ul>
                           </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="#" class="toggle-sub-menu">Manage Products</a>
        <div class="pl-3 sub-menu">
            <a href="product.php">Add Product</a>
            <a href="update_product.php">Update Product</a>
        </div>
        <a href="#" class="toggle-sub-menu">Manage Users</a>
        <div class="pl-3 sub-menu">
            <a href="add_user.php">Add User</a>
            <a href="delete_user.php">Delete User</a>
        </div>
        <a href="logout.php">Log Out</a>
    </div>

    <!-- Bootstrap JS and other JS files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>