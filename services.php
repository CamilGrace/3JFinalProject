<?php 

    include('setup.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
</head>
<body>
    <h1>All Services</h1>
    <div>
        <?php
        $sql = "SELECT service_id, service_name, description, price FROM services";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>
                        <h3>{$row['service_name']}</h3>
                        <p>{$row['description']}</p>
                        <p>Price: {$row['price']}</p>
                        <a href='booking.php?service_id={$row['service_id']}'>Book Now</a>
                      </div>";
            }
        } else {
            echo "<p>No services available</p>";
        }
        ?>
    </div>
</body>
</html>
