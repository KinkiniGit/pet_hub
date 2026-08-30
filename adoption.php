<?php
session_start();
require_once 'config/db.php';


$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adopt_request'])) {
    $pet_name = $_POST['pet_name'];
    $user_phone = $_POST['phone'];
    
    
    $msg = "Thank you! Your adoption request for $pet_name has been submitted. We will contact you via $user_phone soon.";
}

$query = "SELECT * FROM pets_for_adoption WHERE status = 'Available' ORDER BY pet_id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Adoption - Pet Hub</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8f9fa; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .nav-links { margin-bottom: 20px; }
        .nav-links a { margin-right: 15px; color: #2c3e50; text-decoration: none; font-weight: bold; }
        .alert { background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px; text-align: center; }
        .pet-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .pet-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
        .pet-img { width: 100%; height: 200px; object-fit: cover; }
        .pet-body { padding: 15px; }
        .pet-title { font-size: 20px; font-weight: bold; color: #2c3e50; margin-bottom: 5px; }
        .pet-meta { font-size: 13px; color: #7f8c8d; margin-bottom: 10px; }
        .pet-desc { font-size: 14px; color: #555; margin-bottom: 15px; height: 40px; overflow: hidden; }
        .adopt-form input { width: 92%; padding: 8px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .btn-adopt { width: 100%; background: #27ae60; color: white; border: none; padding: 10px; border-radius: 5px; font-weight: bold; cursor: pointer; }
        .btn-adopt:hover { background: #219150; }
    </style>
</head>
<body>

<div class="nav-links">
    <a href="shop.php">← Shop/Mart</a>
    <a href="book.php">Book Appointment</a>
    <a href="my_bookings.php">My Bookings</a>
</div>

<div class="header">
    <h2>🐾 Adopt a Pet & Save a Life</h2>
    <p>Find your new furry best friend today!</p>
</div>

<?php if (!empty($msg)): ?>
    <div class="alert"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="pet-grid">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($pet = $result->fetch_assoc()): ?>
            <div class="pet-card">
                <img src="<?= htmlspecialchars($pet['image']) ?>" alt="<?= htmlspecialchars($pet['pet_name']) ?>" class="pet-img" onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
                <div class="pet-body">
                    <div class="pet-title"><?= htmlspecialchars($pet['pet_name']) ?></div>
                    <div class="pet-meta">
                        <strong>Type:</strong> <?= htmlspecialchars($pet['pet_type']) ?> | 
                        <strong>Breed:</strong> <?= htmlspecialchars($pet['breed']) ?><br>
                        <strong>Age:</strong> <?= htmlspecialchars($pet['age']) ?> | 
                        <strong>Gender:</strong> <?= htmlspecialchars($pet['gender']) ?>
                    </div>
                    <div class="pet-desc"><?= htmlspecialchars($pet['description']) ?></div>
                    
                    <form method="POST" action="adoption.php" class="adopt-form">
                        <input type="hidden" name="pet_name" value="<?= htmlspecialchars($pet['pet_name']) ?>">
                        <input type="text" name="phone" placeholder="Enter Your Phone Number" required>
                        <button type="submit" name="adopt_request" class="btn-adopt">Request Adoption</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center; grid-column: 1 / -1;">No pets available for adoption right now.</p>
    <?php endif; ?>
</div>

</body>
</html>