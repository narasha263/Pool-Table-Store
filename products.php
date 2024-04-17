<?php
// Include the database configuration file
require_once "conn.php";

// Include header
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pool Table & Accessories Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>
    <!-- Products section -->
    <div class="products">
        <?php
        // Include the database configuration file
        require_once "conn.php";

        // Fetch products from the database based on the selected category
        $category = $_GET['category'] ?? '';

        $sql = "SELECT * FROM products";

        // Append category condition to the SQL query if a category is selected
        if (!empty($category)) {
            $sql .= " WHERE category = '$category'";
        }

        $result = $conn->query($sql);

        // Display products fetched from the database
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="product">
                    <?php
                    // Display the product image
                    if (!empty($row['image'])) {
                        $imageData = base64_encode($row['image']);
                        $imageSrc = 'data:image/' . $row['image'] . ';base64,' . $imageData;
                        ?>
                         <img src="images/<?php echo $row['image']; ?>"alt="<?php echo $row['product_name']; ?>">
                        <?php
                    } else {
                        // If no image is found, display a placeholder image
                        ?>
                        <img src="images/placeholder.jpg" alt="Placeholder Image">
                        <?php
                    }
                    ?>
                    <h3><?php echo $row['product_name']; ?></h3>
                    <p>KSh <?php echo $row['price']; ?></p>
                    <button class="add-to-cart" onclick="addToCart('<?php echo $row['product_name']; ?>', <?php echo $row['price']; ?>)">Add to Cart</button>
                </div>
                <?php
            }
        } else {
            echo "No products found";
        }
        ?>
    </div>
</div>
<?php
// Include footer
include "footer.php";
?>
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
