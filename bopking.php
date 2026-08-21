<?php
session_start();
require_once 'config/db.php';

// Temporary Mock User ID (Replace with $_SESSION['user_id'] after implementing login)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 

$message = "";
$error = "";

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_service'])) {
    $service_id = intval($_POST['service_id']);
    $pet_type   = trim($_POST['pet_type']);
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $notes        = trim($_POST['notes']);

    // Server-side validation
    if (empty($service_id) || empty($pet_type) || empty($booking_date) || empty($booking_time)) {
        $error = "Please fill in all required fields.";
    } elseif ($booking_date < date('Y-m-d')) {
        $error = "You cannot book an appointment for a past date.";
    } else {
        // Prepared Statement to prevent SQL Injection
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, service_id, pet_type, booking_date, booking_time, notes, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->bind_param("iissss", $user_id, $service_id, $pet_type, $booking_date, $booking_time, $notes);

        if ($stmt->execute()) {
            $message = "Appointment booked successfully!";
        } else {
            $error = "Booking failed. Please try again.";
        }
        $stmt->close();
    }
}

// Fetch Services from MySQL
$services_result = $conn->query("SELECT * FROM services");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Care Service Booking</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f9f9f9; }
        .container { max-width: 550px; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="date"], input[type="time"], select, textarea {
            width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;
        }
        button { background-color: #28a745; color: white; border: none; padding: 12px 20px; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%; }
        button:hover { background-color: #218838; }
        .success { color: green; font-weight: bold; }
        .danger { color: red; font-weight: bold; }
        .nav { margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container">
    <div class="nav">
        <a href="booking.php">Book Appointment</a> | 
        <a href="my_bookings.php">View My Bookings</a>
    </div>

    <h2>Book a Pet Care Service</h2>

    <?php if (!empty($message)): ?>
        <p class="success"><?= $message ?></p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p class="danger"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="booking.php">
        <div class="form-group">
            <label for="service_id">Select Service *</label>
            <select name="service_id" id="service_id" required>
                <option value="">-- Choose a Service --</option>
                <?php while ($service = $services_result->fetch_assoc()): ?>
                    <option value="<?= $service['service_id'] ?>">
                        <?= htmlspecialchars($service['service_name']) ?> - LKR <?= number_format($service['price'], 2) ?> (<?= $service['duration_minutes'] ?> mins)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="pet_type">Pet Type & Breed *</label>
            <input type="text" name="pet_type" id="pet_type" placeholder="e.g., Dog (Persian Cat, Golden Retriever)" required>
        </div>

        <div class="form-group">
            <label for="booking_date">Appointment Date *</label>
            <input type="date" name="booking_date" id="booking_date" min="<?= date('Y-m-d') ?>" required>
        </div>

        <div class="form-group">
            <label for="booking_time">Preferred Time Slot *</label>
            <input type="time" name="booking_time" id="booking_time" min="08:00" max="18:00" required>
            <small>Available Hours: 08:00 AM - 06:00 PM</small>
        </div>

        <div class="form-group">
            <label for="notes">Special Instructions / Medical Notes</label>
            <textarea name="notes" id="notes" rows="3" placeholder="Any allergies, behaviors, or specific requests..."></textarea>
        </div>

        <form method="POST" action="">
    <div style="margin-bottom: 15px;">
        <label>Mobile Number *</label><br>
        <input type="text" name="phone" placeholder="0712345678" required style="width: 100%; padding: 8px;">

    </div>


    
    <button type="submit" name="confirm_booking" class="btn">Confirm Booking</button>
</form>


       
    </form>
</div>



</body>
</html>