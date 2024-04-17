<?php
// Check if the user is logged in as an admin, otherwise redirect to the login page
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit;
}
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
            background-color: #343;
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
    <main>
        <section id="dashboard" class="py-5">
            <div class="container">
                <h2>Welcome to the Admin Dashboard</h2>
                    <p>This is a sample content for the admin dashboard. You can add your own content here to manage products, orders, users, etc.</p>
                    <p>For example, you can display a table of products, list of orders, or statistics related to your admin operations.</p>            </div>
        </section>
    </main>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Admin Dashboard. All rights reserved.</p>
            <!-- Add any footer content here -->
        </div>
    </footer>

    <!-- Bootstrap JS and custom JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
