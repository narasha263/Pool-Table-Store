<?php
// Check if the user is logged in as an admin, otherwise redirect to the login page
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit;
}

// Database connection (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$database = "pool table store";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_FILES["image"]["name"]; // File name
    $tmp_name = $_FILES["image"]["tmp_name"]; // Temporary file name
    $image_folder = "images/"; // Folder where images will be stored
    
    // Move uploaded image to the images folder
    if (move_uploaded_file($tmp_name, $image_folder . $image)) {
        // Insert product into the database
        $sql = "INSERT INTO products (product_name, price, image) VALUES ('$product_name', '$price', '$image')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Product added successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
    } else {
        echo "Failed to upload image";
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Custom CSS for sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 50px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #f8f9fa;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="#" class="toggle-sub-menu">Manage Products</a>
        <div class="pl-3 sub-menu">
            <a href="products.php">Add Product</a>
            <a href="update_product.php">Update Product</a>
        </div>
        <a href="#" class="toggle-sub-menu">Manage Users</a>
        <div class="pl-3 sub-menu">
            <a href="add_user.php">Add User</a>
            <a href="delete_user.php">Delete User</a>
        </div>
        <a href="logout.php">Log Out</a>
    </div>
    <div class="content">
        <header>
            <div class="container">
                <h1>Admin Dashboard</h1>
            </div>
        </header>

        <main>
            <section id="dashboard" class="py-5">
                <div class="container">
                    <h2>Add Product</h2>
                   
<!-- Add Product Modal -->

     
      <div class="modal-body">
        <form id="addProductForm" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="name" required>
          </div>
          <div class="form-group">
            <label for="productImage">Product Image</label>
            <input type="file" class="form-control" id="productImage" name="image" required accept="image/*">
          </div>
          <div class="form-group">
            <label for="productPrice">Product Price</label>
            <input type="number" class="form-control" id="productPrice" name="price" step="0.01" required>
          </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
                </div>
            </section>
        </main>

        <footer class="bg-dark text-white py-4">
            <div class="container">
                <p>&copy; <?php echo date("Y"); ?> Admin Dashboard. All rights reserved.</p>
                <!-- Add any footer content here -->
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and custom JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
