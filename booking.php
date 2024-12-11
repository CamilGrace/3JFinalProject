<?php
// Include database connection
include 'setup.php';

// Fetch services and therapists
$services_query = "SELECT * FROM Services";
$services_result = $conn->query($services_query);

$therapists_query = "SELECT * FROM Users WHERE role = 'therapist'";
$therapists_result = $conn->query($therapists_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link rel="stylesheet" href="booking_styles.css">
</head>
<body>

<form action="process_booking.php" method="POST" class="booking-form">
    <!-- Step 1: Select Service and Therapist -->
    <div class="booking-step active" id="step1">
        <h2>Select Service and Therapist</h2>
        <div class="service-selection">
            <?php while ($service = $services_result->fetch_assoc()) { ?>
                <div class="service-card">
                    <img src="<?= $service['image_url'] ?>" alt="<?= $service['name'] ?>">
                    <div class="service-name"><?= $service['name'] ?></div>
                    <div class="service-price"><?= $service['price'] ?> PHP</div>
                    <input type="radio" name="service_id" value="<?= $service['service_id'] ?>" required>
                </div>
            <?php } ?>
        </div>

        <div class="therapist-selection">
            <h3>Select Therapist</h3>
            <select name="therapist_id" required>
                <?php while ($therapist = $therapists_result->fetch_assoc()) { ?>
                    <option value="<?= $therapist['user_id'] ?>"><?= $therapist['full_name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <button type="button" class="booking-btn" onclick="goToStep(2)">Next</button>
    </div>

    <div class="booking-step" id="step2">
    <h2>Choose Date and Time</h2>
    <input type="date" name="appointment_date" required>
    <input type="time" name="start_time" id="start_time" required>
    <input type="time" name="end_time" id="end_time" readonly>
    
    <button type="button" class="booking-btn" onclick="goToStep(1)">Back</button>
    <button type="submit" class="booking-btn">Confirm Booking</button>
</div>
</form>

<script>
    function goToStep(step) {
        document.querySelector('.booking-step.active').classList.remove('active');
        document.getElementById('step' + step).classList.add('active');
    }

    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');

    startTimeInput.addEventListener('input', () => {
        const startTime = startTimeInput.value;
        if (startTime) {
            // Parse the start time
            const [hours, minutes] = startTime.split(':').map(Number);
            let endHours = hours + 1;
            let period = 'AM';

            // Adjust for 12-hour format and AM/PM
            if (endHours >= 12) {
                period = endHours >= 24 ? 'AM' : 'PM';
                endHours = endHours > 12 ? endHours - 12 : endHours;
            }
            if (hours >= 12) {
                period = hours >= 24 ? 'AM' : 'PM';
            }

            // Format end time as HH:MM AM/PM
            const formattedEndTime = `${endHours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')} ${period}`;
            endTimeInput.value = formattedEndTime;
        }
    });
</script>

</body>
</html>
