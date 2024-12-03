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
        <h3><p> "Nurture Your Soul, Renew Your Body" </p></h3>
        <a href="booking.php" class="cta-button">Book Now</a>
        <a href="#services" class="cta-button">View Services</a>
        
    </header>

    <!-- Services Section -->

  <div class= "services">  
  <section id="services">
  <h2>Popular Services</h2>

<body>
    <div class="grid-container">

        <div class="box">Swedish Massage (30 minutes): PHP 500 - 1,000 - A gentle massage to relax muscles and relieve stress. <br></br> <a href="booking.php" class="cta-button">Book Now</a></div> 
        <div class="box">Deep Tissue Massage (60 minutes): PHP 1,000 - 1,500 - Targets deeper muscle layers to alleviate chronic pain and tension.<br></br> <a href="booking.php" class="cta-button">Book Now</a></div>
        <div class="box">Basic Facial (60 minutes): PHP 1,000 - 1,500 - A cleansing, exfoliating, and moisturizing facial. <br></br><a href="booking.php" class="cta-button">Book Now</a></div>
        <div class="box">Anti-Aging Facial (90 minutes): PHP 2,000 - 3,000 - A facial that targets signs of aging, such as wrinkles and fine lines.<br></br> <a href="booking.php" class="cta-button">Book Now</a></div>
        <div class="box">Salt Scrub (60 minutes): PHP 1,500 - 2,000 - Exfoliates the skin to remove dead skin cells and impurities. <br></br><a href="booking.php" class="cta-button">Book Now</a></div>
        <div class="box">Detoxifying Wrap (60 minutes): PHP 1,500 - 2,000 - A detoxifying treatment that helps to remove toxins from the body.<br></br> <a href="booking.php" class="cta-button">Book Now</a></div>

    </div>
</body>
</html>

</section>

    <!-- Testimonials Section -->
</head>
<body>
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