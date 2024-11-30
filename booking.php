<?php 

    include('setup.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
</head>
<body>
    <?php
    $service_id = $_GET['service_id'];
    $sql = "SELECT service_name, price FROM services WHERE service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $service = $result->fetch_assoc();
    ?>
    <h1>Book Service: <?php echo $service['service_name']; ?></h1>
    <form method="POST" action="confirm_booking.php">
        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
        <label for="date">Choose a Date:</label>
        <input type="date" name="date" required>
        <label for="time">Choose a Time:</label>
        <input type="time" name="time" required>
        <label for="therapist">Choose a Therapist:</label>
        <select name="therapist_id" required>
            <?php
            $therapists = $conn->query("SELECT user_id, full_name FROM users WHERE role = 'therapist'");
            while ($row = $therapists->fetch_assoc()) {
                echo "<option value='{$row['user_id']}'>{$row['full_name']}</option>";
            }
            ?>
        </select>
        <button type="submit">Confirm Booking</button>
    </form>
</body>
</html>
