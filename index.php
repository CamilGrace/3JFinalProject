<?php 
    include('setup.php'); 

    // Fetch the top 3 services from the database (limit to 3)
    $sql = "SELECT service_id, name, description, price, image_url FROM Services LIMIT 3";
    $result = mysqli_query($conn, $sql);

    // Fetch reviews from the database
    $review_sql = "SELECT r.rating, r.comment, u.full_name, u.email FROM Reviews r JOIN Users u ON r.user_id = u.user_id";
    $reviews_result = mysqli_query($conn, $review_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Booking System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Linking external CSS file -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"> <!-- Swiper CSS -->
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="top-nav">
        <div class="container">
            <h1>Booking System</h1>
            <a href="login.php" class="login-button">Login</a>
        </div>
    </nav>

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
                // Limit the services to 3
                $sql = "SELECT service_id, name, description, price, image_url FROM Services LIMIT 3";
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

        <!-- View Services Button -->
        <div class="view-services-btn">
            <a href="services.php" class="cta-button">View All Services</a>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials">
        <h2>Customer Feedback</h2>
        
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                    if ($reviews_result->num_rows > 0) {
                        while ($review = $reviews_result->fetch_assoc()) {
                            echo "
                            <div class='swiper-slide'>
                                <div class='review-card'>
                                    <div class='review-img'>
                                        <img src='https://www.w3schools.com/w3images/avatar2.png' alt='Customer'>
                                    </div>
                                    <h3>{$review['full_name']}</h3>
                                    <div class='rating'>";
                                        for ($i = 0; $i < $review['rating']; $i++) {
                                            echo "<span>⭐</span>";
                                        }
                                        echo "
                                    </div>
                                    <p class='comment'>\"{$review['comment']}\"</p>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<p>No reviews available</p>";
                    }
                ?>
            </div>
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

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> <!-- Swiper JS -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 5000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
</body>
</html>
