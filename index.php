<?php 

    include('setup.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Booking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header {
           
            background-size: cover;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }
        header h1 {
            font-size: 3em;
            margin: 0;
        }
        header p {
            font-size: 1.5em;
            margin: 20px 0;
        }
        .cta-button {
            background-color: #006F89;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            font-size: 1.2em;
            margin-top: 20px;
            display: inline-block;
            border-radius: 5px;
        }
        #services, #testimonials {
            padding: 50px 20px;
        }
        .service-card, .review-card {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .service-card img, .review-card img {
            width: 100%;
            max-width: 200px;
            height: auto;
            border-radius: 10px;
        }
        .service-card h3, .review-card h3 {
            font-size: 1.5em;
            margin-top: 10px;
        }
        .review-slider {
            display: flex;
            overflow-x: scroll;
            gap: 20px;
        }
        .service-cards, .testimonial-cards {
            display: flex;
            gap: 20px;
            overflow-x: scroll;
        }
        .cta-section {
            background-color: #f1f1f1;
            text-align: center;
            padding: 40px;
        }
        .cta-section h2 {
            font-size: 2em;
        }
        footer {
            background-color: #006F89;
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
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
