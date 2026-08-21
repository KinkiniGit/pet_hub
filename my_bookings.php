<?php
session_start();
require_once 'config/db.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 

// Database එකෙන් Bookings දත්ත ලබාගැනීම
$query = "SELECT b.booking_id, b.phone, s.service_name, s.price, b.pet_type, b.booking_date, b.booking_time, b.status 
          FROM bookings b 
          INNER JOIN services s ON b.service_id = s.service_id 
          WHERE b.user_id = ? 
          ORDER BY b.booking_date DESC, b.booking_time DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .badge { padding: 4px 8px; border-radius: 4px; font-weight: bold; text-transform: capitalize; }
        .badge-pending { background-color: #fff3cd; color: #856404; }
        .badge-confirmed { background-color: #d4edda; color: #155724; }
        .badge-sms { background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-weight: bold; }
    </style>
</head>
<body>

<a href="book.php">← Back to Booking Page</a>
<h2>My Scheduled Appointments</h2>

<table border="1">
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Service</th>
            <th>Pet Type</th>
            <th>Phone Number</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>
            <th>Status</th>
            <th>SMS Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?= htmlspecialchars($row['booking_id']) ?></td>
                    <td><?= htmlspecialchars($row['service_name']) ?></td>
                    <td><?= htmlspecialchars($row['pet_type']) ?></td>
                    <td><?= htmlspecialchars($row['phone'] ?? '0712345678') ?></td>
                    <td><?= htmlspecialchars($row['booking_date']) ?></td>
                    <td><?= htmlspecialchars($row['booking_time']) ?></td>
                    <td>LKR <?= number_format($row['price'], 2) ?></td>
                    <td>
                        <span class="badge badge-<?= strtolower($row['status'] ?? 'pending') ?>">
                            <?= htmlspecialchars($row['status'] ?? 'Pending') ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge-sms">
                            Message Sent OK
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" style="text-align: center;">No appointments found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>