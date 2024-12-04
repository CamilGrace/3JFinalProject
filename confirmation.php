<?php
// Include database connection
include 'setup.php';

if (isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // Fetch appointment details
    $query = "SELECT * FROM Appointments 
              INNER JOIN Services ON Appointments.service_id = Services.service_id
              INNER JOIN Users AS customer ON Appointments.user_id = customer.user_id
              INNER JOIN Users AS therapist ON Appointments.therapist_id = therapist.user_id
              WHERE appointment_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body>

<h2>Booking Confirmation</h2>
<p>Your appointment has been successfully booked!</p>
<p><strong>Service:</strong> <?= $appointment['name'] ?></p>
<p><strong>Therapist:</strong> <?= $appointment['full_name'] ?> (<?= $appointment['role'] ?>)</p>
<p><strong>Appointment Date:</strong> <?= $appointment['appointment_date'] ?></p>
<p><strong>Time:</strong> <?= $appointment['start_time'] ?> to <?= $appointment['end_time'] ?></p>
<p><strong>Total Price:</strong> <?= $appointment['price'] ?> PHP</p>

</body>
</html>
