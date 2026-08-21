<?php
session_start();
require_once 'config/db.php';

// Services ලබාගැනීම
$services_query = "SELECT * FROM services";
$services_result = $conn->query($services_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - Pet Hub</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .form-card { max-width: 500px; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { background: #27ae60; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; }
        .btn:hover { background: #219150; }
        a { color: #3498db; text-decoration: none; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="form-card">
    <a href="index.php">← Back to Home</a>
    <h2>Book a Pet Care Service</h2>
    
    <form action="Confirm_booking.php" method="POST">
        <div class="form-group">
            <label>Select Service:</label>
            <select name="service" required>
                <option value="">-- Choose a Service --</option>
                <?php if ($services_result && $services_result->num_rows > 0): ?>
                    <?php while($row = $services_result->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($row['service_name']) ?>">
                            <?= htmlspecialchars($row['service_name']) ?> - LKR <?= number_format($row['price'], 2) ?>
                        </option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option value="Full Grooming">Full Grooming - LKR 3500.00</option>
                    <option value="Veterinary Checkup">Veterinary Checkup - LKR 2500.00</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Pet Type / Breed:</label>
            <input type="text" name="pet_breed" placeholder="e.g. Labrador / Persian Cat" required>
        </div>

        <div class="form-group">
            <label>Appointment Date:</label>
            <input type="date" name="appointment_date" required>
        </div>

        <div class="form-group">
            <label>Preferred Time Slot:</label>
            <input type="time" name="time_slot" required>
        </div>

        <div class="form-group">
            <label>Phone Number (for SMS confirmation):</label>
            <input type="text" name="phone" placeholder="e.g. 0771234567" required>
        </div>

        <div class="form-group">
            <label>Notes (Optional):</label>
            <textarea name="notes" rows="3" placeholder="Any special instructions..."></textarea>
        </div>

        <button type="submit" name="confirm_booking" class="btn">Confirm & Send Booking</button>
    </form>
</div>

</body>
</html>