<?php
session_start();

// Hardcoded admin credentials (replace these with your actual admin credentials)
$admin_username = "admin";
$admin_password_hash = password_hash("admin123", PASSWORD_DEFAULT);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Verify username and password
        if ($_POST["username"] === $admin_username && password_verify($_POST["password"], $admin_password_hash)) {
            // Authentication successful, set session variables
            $_SESSION['admin'] = true;
            // Redirect to admin dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            // Authentication failed, show error message
            $error_message = "Invalid username or password";
        }
    } else {
        // If username or password is not provided, show error message
        $error_message = "Please enter username and password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Admin Login</div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        <?php if (isset($error_message)): ?>
                            <div class="text-danger mt-3"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
