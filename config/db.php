<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "pethub_db"; // මෙතැන නම නිවැරදිදැයි බලන්න

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>