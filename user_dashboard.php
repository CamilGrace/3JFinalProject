<?php
// Assuming the user is authenticated
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connect to the database
require 'db_connection.php';

// Fetch user details and appointments
$userId = $_SESSION['user_id'];

// Fetch upcoming appointments
$upcomingAppointments = $db->query("SELECT * FROM appointments WHERE user_id = $userId AND date >= CURDATE() ORDER BY date ASC");

// Fetch past appointments
$pastAppointments = $db->query("SELECT * FROM appointments WHERE user_id = $userId AND date < CURDATE() ORDER BY date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles/dashboard.css">
</head>
<body>
    <div class="dashboard">
        <h1>Welcome to Your Dashboard</h1>
        
        <!-- Upcoming Appointments -->
        <section class="appointments-section">
            <h2>Upcoming Appointments</h2>
            <div class="appointment-list">
                <?php if ($upcomingAppointments->num_rows > 0): ?>
                    <?php while ($appointment = $upcomingAppointments->fetch_assoc()): ?>
                        <div class="appointment-card">
                            <p><strong>Date:</strong> <?= $appointment['date'] ?></p>
                            <p><strong>Time:</strong> <?= $appointment['time'] ?></p>
                            <button class="btn-cancel">Cancel</button>
                            <button class="btn-reschedule">Reschedule</button>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No upcoming appointments.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Past Appointments -->
        <section class="appointments-section">
            <h2>Past Appointments</h2>
            <div class="appointment-list">
                <?php if ($pastAppointments->num_rows > 0): ?>
                    <?php while ($appointment = $pastAppointments->fetch_assoc()): ?>
                        <div class="appointment-card">
                            <p><strong>Date:</strong> <?= $appointment['date'] ?></p>
                            <p><strong>Time:</strong> <?= $appointment['time'] ?></p>
                            <button class="btn-review">Leave a Review</button>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No past appointments.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Account Settings -->
        <section class="account-settings">
            <h2>Account Settings</h2>
            <button class="btn-edit-profile">Edit Profile</button>
            <button class="btn-change-password">Change Password</button>
        </section>

        <!-- Promotions and Rewards -->
        <section class="promotions-rewards">
            <h2>Promotions and Rewards</h2>
            <p>Check out the latest promotions and loyalty rewards available for you!</p>
        </section>
    </div>
</body>
</html>
