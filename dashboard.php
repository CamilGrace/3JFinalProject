<?php 

    include('setup.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Your Appointments</h1>
    <div>
        <?php
        $user_id = 1; // Hardcoded for now (replace with session user_id)
        $sql = "SELECT a.appointment_id, s.service_name, a.appointment_date, a.start_time, a.status 
                FROM appointments a 
                JOIN services s ON a.service_id = s.service_id 
                WHERE a.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<div>
                    <h3>{$row['service_name']}</h3>
                    <p>Date: {$row['appointment_date']} | Time: {$row['start_time']}</p>
                    <p>Status: {$row['status']}</p>
                  </div>";
        }
        ?>
    </div>
</body>
</html>
