<?php
include('setup.php'); // Include database setup

// Start session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$user_sql = "SELECT full_name, email, phone FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

// Fetch upcoming appointments
$upcoming_sql = "SELECT * FROM Appointments WHERE user_id = ? AND date >= CURDATE() ORDER BY date ASC";
$stmt = $conn->prepare($upcoming_sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$upcoming_appointments = $stmt->get_result();

// Fetch past appointments
$past_sql = "SELECT * FROM Appointments WHERE user_id = ? AND date < CURDATE() ORDER BY date DESC";
$stmt = $conn->prepare($past_sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$past_appointments = $stmt->get_result();

// Fetch promotions and rewards
$promotions_sql = "SELECT * FROM Promotions WHERE user_id = ? OR user_id IS NULL";
$stmt = $conn->prepare($promotions_sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$promotions = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="top-nav">
        <div class="container">
            <h1>Booking System</h1>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </nav>

    <main>
        <section class="dashboard">
            <h2>Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h2>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>

            <section class="appointments">
                <h3>Upcoming Appointments</h3>
                <?php if ($upcoming_appointments->num_rows > 0): ?>
                    <ul>
                        <?php while ($appointment = $upcoming_appointments->fetch_assoc()): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($appointment['service_name']); ?></strong> - <?php echo htmlspecialchars($appointment['date']); ?>
                                <a href="reschedule.php?appointment_id=<?php echo $appointment['appointment_id']; ?>">Reschedule</a>
                                <a href="cancel.php?appointment_id=<?php echo $appointment['appointment_id']; ?>">Cancel</a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No upcoming appointments.</p>
                <?php endif; ?>
            </section>

            <section class="appointments">
                <h3>Past Appointments</h3>
                <?php if ($past_appointments->num_rows > 0): ?>
                    <ul>
                        <?php while ($appointment = $past_appointments->fetch_assoc()): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($appointment['service_name']); ?></strong> - <?php echo htmlspecialchars($appointment['date']); ?>
                                <a href="review.php?appointment_id=<?php echo $appointment['appointment_id']; ?>">Leave a Review</a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No past appointments.</p>
                <?php endif; ?>
            </section>

            <section class="account-settings">
                <h3>Account Settings</h3>
                <a href="edit_profile.php">Edit Profile</a><br>
                <a href="change_password.php">Change Password</a>
            </section>

            <section class="promotions">
                <h3>Promotions and Reward</h3>
                <?php if ($promotions->num_rows > 0): ?>
                    <ul>
                        <?php while ($promo = $promotions->fetch_assoc()): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($promo['title']); ?></strong> - <?php echo htmlspecialchars($promo['description']); ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No promotions or rewards available.</p>
                <?php endif; ?>
            </section>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Booking System. All rights reserved.</p>
    </footer>
</body>
</html>
