<?php 
    include('setup.php'); 

    // Fetch services from the database
    $sql = "SELECT * FROM Services";
    $result = mysqli_query($conn, $sql);

    // Fetch reviews from the database
    $reviews_sql = "SELECT R.rating, R.comment, U.name, U.profile_image
                    FROM Reviews R
                    JOIN Users U ON R.user_id = U.user_id
                    ORDER BY R.created_at DESC
                    LIMIT 10"; // Fetch the latest 10 reviews
    $reviews_result = mysqli_query($conn, $reviews_sql);
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
    <section id="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                if (mysqli_num_rows($reviews_result) > 0) {
                    while ($review = mysqli_fetch_assoc($reviews_result)) {
                        echo "<div class='swiper-slide'>
                                <div class='review-card'>
                                    <img src='{$review['profile_image']}' alt='{$review['name']}' class='review-img'>
                                    <h3>{$review['name']}</h3>
                                    <p class='rating'>" . str_repeat("⭐", $review['rating']) . "</p>
                                    <p class='comment'>\"{$review['comment']}\"</p>
                                </div>
                              </div>";
                    }
                } else {
                    echo "<div class='swiper-slide'>
                            <p>No reviews available yet.</p>
                          </div>";
                }
                ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    </script>
    
</body>
</html>
