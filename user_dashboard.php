<?php
// Start session
session_start();

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Display user details
echo '<h1>Welcome, ' . htmlspecialchars($_SESSION['user_name']) . '!</h1>';
// You can add more dashboard content here as needed.
?>
