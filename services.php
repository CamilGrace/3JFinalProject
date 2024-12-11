<?php
    include('setup.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Services</title>
    <link rel="stylesheet" href="servicestyles.css">
</head>
<body>
    <div class="container">
        <h1>All Services</h1>

        <!-- Filters Section -->
        <div class="filters">
            <select id="service_type" name="service_type">
                <option value="">Service Type</option>
                <option value="massage">Massage</option>
                <option value="facial">Facial</option>
                <option value="scrub">Scrub</option>
            </select>

            <select id="price_range" name="price_range">
                <option value="">Price Range</option>
                <option value="low">Low to High</option>
                <option value="high">High to Low</option>
            </select>

            <select id="duration" name="duration">
                <option value="">Duration</option>
                <option value="short">Short (30-60 min)</option>
                <option value="long">Long (60+ min)</option>
            </select>
        </div>

        <!-- Popular Services Section -->
        <section id="services">
            <h2>Popular Services</h2>

            <div class="grid-container">
                <?php
                    // Fetch all services from the database
                    $sql = "SELECT service_id, name, description, price, image_url FROM Services";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($service = $result->fetch_assoc()) {
                            echo "<div class='service-card'>
                                <img src='{$service['image_url']}' alt='{$service['name']}' class='service-img'>
                                <h3>{$service['name']}</h3>
                                <p>{$service['description']}</p>
                                <p><strong>Price:</strong> PHP {$service['price']} - PHP " . ($service['price'] + 500) . "</p>
                                <a href='booking.php?service_id={$service['service_id']}' class='cta-button'>Book Now</a>
                            </div>";
                        }
                    } else {
                        echo "<p>No services available</p>";
                    }
                ?>
            </div>
        </section>

        <!-- Service List Section (Unchanged) -->
        <div class="service-list">
            <?php
            // Apply sorting or filtering if needed
            $sql = "SELECT service_id, service_name, description, price, duration, image_url FROM services";
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='service-card'>
                            <img src='{$row['image_url']}' alt='{$row['service_name']}'>
                            <h3>{$row['service_name']}</h3>
                            <p class='price'>Price: ₱{$row['price']}</p>
                            <p class='duration'>Duration: {$row['duration']} mins</p>
                            <p class='description'>{$row['description']}</p>
                            <a href='booking.php?service_id={$row['service_id']}' class='btn'>Book Now</a>
                          </div>";
                }
            } else {
                echo "<p>No services available</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
