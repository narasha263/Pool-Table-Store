<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database server is different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "pool table store"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pool Table & Accessories Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Product container */
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        /* Product card */
        .product {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            text-align: center;
            background-color: #fff;
        }

        /* Product image */
        .product img {
            width: 100%;
            border-radius: 5px;
        }

        /* Product name */
        .product h3 {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }

        /* Product price */
        .product p {
            margin-top: 5px;
            font-size: 16px;
            color: #666;
        }

        /* Add to cart button */
        .add-to-cart {
            background-color: green;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .add-to-cart:hover {
            background-color: #0056b3;
        }
    </style>
        <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Pool Table & Accessories Store</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">login</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin/login.php">Admin</a></li>


                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="hero" class="bg-primary text-white py-5">
            <div class="container">
                <h2>Welcome to our Store</h2>
                <p>Find the perfect pool table and accessories for your game room.</p>
                <a href="products.php" class="btn btn-light">Shop Now</a>
            </div>
        </section>

        <section id="featured-products" class="py-5">
            <div class="container">
                <h2>Featured Products</h2>
                <div class="row">
                    <?php
                    // Loop through each product fetched from the database
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>">
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $row['product_name']; ?></h3>
                                    <p class="card-text"><?php echo 'KSH' . $row['price']; ?></p>
                                    <button class="add-to-cart" onclick="addToCart('<?php echo $row['product_name']; ?>', <?php echo $row['price']; ?>)">Add to Cart</button>                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <p>&copy; 2024 Pool Table & Accessories Store. All rights reserved.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and custom JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>

    
<script>
    // Function to add item to cart
    function addToCart(productName, price) {
        // Send AJAX request to PHP script to add item to cart
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert("Item added to cart!");
                } else {
                    alert("Failed to add item to cart!");
                }
            }
        };
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("productName=" + encodeURIComponent(productName) + "&price=" + encodeURIComponent(price));
    }
</script>
</body>
</html>
