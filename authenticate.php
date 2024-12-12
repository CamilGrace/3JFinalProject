<?php
// Start session
session_start();

// Include database setup
include('setup.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Email and password are required.';
        header('Location: login.php');
        exit();
    }

    // Query database for user
    $sql = "SELECT user_id, full_name, password FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Authentication successful
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['full_name'];

            // Redirect to dashboard
            header('Location: user_dashboard.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid password.';
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'User not found.';
        header('Location: login.php');
        exit();
    }
} else {
    // If accessed without POST request, redirect to login page
    header('Location: login.php');
    exit();
}
?>
