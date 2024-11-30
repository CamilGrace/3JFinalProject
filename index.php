<?php 

    include('db_connection.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Booking System</title>
</head>
<body>
    <h1>Welcome to Our Booking System</h1>
    <section id="services">
        <h2>Popular Services</h2>
        <div>
            <?php
            $sql = "SELECT service_id, service_name, description, price FROM services LIMIT 4";
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
    </section>
</body>
</html>
