<?php 
    include('setup.php'); 

    // Fetch services from the database
    $sql = "SELECT * FROM Services";
    $result = mysqli_query($conn, $sql);
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
        <h3><p> "Nurture Your Soul, Renew Your Body" </p></h3>
        <a href="booking.php" class="cta-button">Book Now</a>
        <a href="#services" class="cta-button">View Services</a>
    </header>

    <!-- Services Section -->
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


    <!-- Testimonials Section -->
    <div class="feedback-form">
        <h2>Customer Feedback</h2>
        <form>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating</label>
                <select id="rating" name="rating" required>
                    <option value="" disabled selected>Choose a rating</option>
                    <option value="1">1 - Very Unsatisfied</option>
                    <option value="2">2 - Unsatisfied</option>
                    <option value="3">3 - Neutral</option>
                    <option value="4">4 - Satisfied</option>
                    <option value="5">5 - Very Satisfied</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comments">Comments</label>
                <textarea id="comments" name="comments" placeholder="Share your feedback..." required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Submit Feedback</button>
            </div>
        </form>
    </div>

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
