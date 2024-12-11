<?php 

    include('setup.php'); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $service_id = $_POST['service_id'];
        $therapist_id = $_POST['therapist_id'];
        $user_id = 1; // Hardcoded for now (replace with session user_id)
        $date = $_POST['date'];
        $time = $_POST['time'];

        $sql = "INSERT INTO appointments (user_id, therapist_id, service_id, appointment_date, start_time, status) 
                VALUES (?, ?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiss", $user_id, $therapist_id, $service_id, $date, $time);

        if ($stmt->execute()) {
            echo "Booking successful!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
?>
