<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or another appropriate destination
header("Location: login.php"); // Change "login.php" to the appropriate URL
exit;
?>
