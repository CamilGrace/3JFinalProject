<?php
// Database connection
include 'setup.php';
session_start();

// Assuming user is logged in and user_id is stored in session
$user_id = $_SESSION['user_id']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $therapist_id = $_POST['therapist_id'];
    $service_id = $_POST['service_id'];
    $appointment_date = $_POST['appointment_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $payment_method = $_POST['payment_method']; // 'cash', 'credit_card', or 'paypal'

    // Check therapist availability
    $query = "SELECT * FROM Availability WHERE therapist_id = ? AND date = ? AND start_time = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iss', $therapist_id, $appointment_date, $start_time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Therapist not available at this time
        echo "Sorry, the therapist is not available at the selected time.";
        echo '<br><br><button onclick="window.history.back()" style="background-color: #006F89; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Back</button>';
        exit;
    }
    // Insert appointment
    $query = "INSERT INTO Appointments (user_id, therapist_id, service_id, appointment_date, start_time, end_time, status) 
              VALUES (?, ?, ?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiisss', $user_id, $therapist_id, $service_id, $appointment_date, $start_time, $end_time);
    $stmt->execute();
    $appointment_id = $stmt->insert_id;

    // Get service price
    $query = "SELECT price FROM Services WHERE service_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $service = $result->fetch_assoc();
    $amount = $service['price'];

    // Process payment
    $transaction_id = generate_transaction_id(); // Function to generate transaction ID
    $query = "INSERT INTO Payments (appointment_id, amount, payment_method, payment_status, transaction_id) 
              VALUES (?, ?, ?, 'unpaid', ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('idss', $appointment_id, $amount, $payment_method, $transaction_id);
    $stmt->execute();

    // Redirect to confirmation page
    header("Location: confirmation.php?appointment_id=" . $appointment_id);
    exit;
}

// Function to generate transaction ID (simple random ID for demo purposes)
function generate_transaction_id() {
    return 'TRX' . rand(10000, 99999);
}
?>
