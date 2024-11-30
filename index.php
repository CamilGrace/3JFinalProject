<?php 

    include('setup.php'); 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Booking System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Linking external CSS file -->
</head>
<body>
    <!-- Hero Section -->
    <header>
        <h1>Welcome to Our Booking System</h1>
        <p>Your Wellness Journey Starts Here</p>
        <a href="booking.php" class="cta-button">Book Now</a>
        <a href="#services" class="cta-button">View Services</a>
    </header>

    <!-- Services Section -->
    <section id="services">
        <h2>Popular Services</h2>
        <div class="service-cards">
            <?php
            $sql = "SELECT service_id, service_name, description, price, image_url FROM services LIMIT 4";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='service-card'>
                            <img src='{$row['image_url']}' alt='{$row['service_name']}'>
                            <h3>{$row['service_name']}</h3>
                            <p>{$row['description']}</p>
                            <p>Price: {$row['price']}</p>
                            <a href='booking.php?service_id={$row['service_id']}' class='cta-button'>Book Now</a>
                          </div>";
                }
            } else {
                echo "<p>No services available</p>";
            }
            ?>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="review-slider">
            <?php
            // Add some sample testimonials or fetch from a database
            $testimonials = [
                ['name' => 'John Doe', 'rating' => 5, 'comment' => 'Amazing service! Highly recommended.', 'image_url' => 'path/to/profile-pic.jpg'],
                ['name' => 'Jane Smith', 'rating' => 4, 'comment' => 'A very relaxing experience.', 'image_url' => 'path/to/profile-pic2.jpg']
            ];

            foreach ($testimonials as $testimonial) {
                echo "<div class='review-card'>
                        <img src='{$testimonial['image_url']}' alt='{$testimonial['name']}'>
                        <h3>{$testimonial['name']} - {$testimonial['rating']} stars</h3>
                        <p>{$testimonial['comment']}</p>
                      </div>";
            }
            ?>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <h2>Start Your Journey Today</h2>
        <p>Ready to book your first session? It's easy to get started!</p>
        <a href="signup.php" class="cta-button">Create an Account</a>
    </section>

    <footer>
        <p>&copy; 2024 Booking System. All rights reserved.</p>
    </footer>
</body>
</html>
