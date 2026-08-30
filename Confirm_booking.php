<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_booking'])) {
    $service          = $_POST['service'];
    $pet_breed        = $_POST['pet_breed'];
    $appointment_date = $_POST['appointment_date'];
    $time_slot        = $_POST['time_slot'];
    $notes            = $_POST['notes'];
    $user_phone       = $_POST['phone'];

    
    $query = "INSERT INTO bookings (service, pet_breed, appointment_date, time_slot, notes, phone) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $service, $pet_breed, $appointment_date, $time_slot, $notes, $user_phone);

    if ($stmt->execute()) {
        $user_id   = "YOUR_NOTIFY_USER_ID";
        $api_key   = "YOUR_NOTIFY_API_KEY";
        $sender_id = "NotifyDEMO";

        $message = "Pet Hub Care: Your booking for $service on $appointment_date at $time_slot has been confirmed. Thank you!";

        $url = "https://app.notify.lk/api/v1/send?user_id=" . $user_id . "&api_key=" . $api_key . "&sender_id=" . $sender_id . "&to=" . $user_phone . "&message=" . urlencode($message);

        // cURL SMS API call
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
         
        echo "<script>alert('Booking Confirmed & SMS Sent Successfully!'); window.location.href='my_bookings.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>