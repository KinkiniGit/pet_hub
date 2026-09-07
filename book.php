<?php
session_start();
require_once 'config/db.php';


$services_query = "SELECT * FROM services";
$services_result = $conn->query($services_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - Pet Hub</title>
    
    
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root{
            primary: color #27ae60;
            primary: hover #219150;
            dark: blue #1b2a4a;
            light: bg #f8f9fa;

        }
       
.main-container {
    flex:1;

}
 .navbar {
            background: #2c3e50;
            padding: 15px 5%;
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
            font-size: 24px;
        }
        .nav-link {
            color: #ecf0f1 !important;
            font-weight: 500;
            margin: 0 5px;
            transition: 0.3s;
        }
 .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .alert { 
            background: #d4edda; 
            color: #155724; 
            padding: 12px; 
            border-radius: 5px; 
            margin-bottom: 20px; 
            text-align: center; 
        }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .form-card { max-width: 500px; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { background: #27ae60; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; }
        .btn:hover { background: #219150; }
        a { color: #3498db; text-decoration: none; display: inline-block; margin-bottom: 15px; }
        
        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 60px;
            font-size: 14px;
        }
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

  <!--footer-->
<footer>
    <p class="mb-0">&copy; <?= date('Y') ?> Pet Hub Care Center. All Rights Reserved.</p>
</footer>

<!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>