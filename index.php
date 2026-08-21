<?php
session_start();
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Hub - Your Complete Pet Care Partner</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8f9fa; color: #333; }
        
        /* Navigation Bar */
        .navbar { background: #2c3e50; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar .logo { color: #fff; font-size: 24px; font-weight: bold; text-decoration: none; }
        .nav-links { list-style: none; display: flex; gap: 20px; }
        .nav-links a { color: #ecf0f1; text-decoration: none; font-size: 16px; font-weight: 500; transition: 0.3s; }
        .nav-links a:hover { color: #27ae60; }
        
        /* Hero Section */
        .hero { background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1450778869186-3997d5a518da?w=1200') center/cover no-repeat; height: 75vh; color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 0 20px; }
        .hero h1 { font-size: 48px; margin-bottom: 15px; }
        .hero p { font-size: 20px; margin-bottom: 25px; max-width: 600px; }
        .hero-btns { display: flex; gap: 15px; }
        .btn { padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold; transition: 0.3s; }
        .btn-primary { background: #27ae60; color: white; }
        .btn-primary:hover { background: #219150; }
        .btn-secondary { background: #e74c3c; color: white; }
        .btn-secondary:hover { background: #c0392b; }

        /* Services Grid */
        .container { padding: 60px 5%; max-width: 1200px; margin: auto; }
        .section-title { text-align: center; font-size: 32px; margin-bottom: 40px; color: #2c3e50; }
        .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
        .service-card { background: white; padding: 30px; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: 0.3s; }
        .service-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .service-card .icon { font-size: 40px; margin-bottom: 15px; }
        .service-card h3 { font-size: 20px; margin-bottom: 10px; color: #2c3e50; }
        .service-card p { color: #666; font-size: 14px; margin-bottom: 20px; }
        
        /* Footer */
        footer { background: #2c3e50; color: white; text-align: center; padding: 20px; margin-top: 40px; font-size: 14px; }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="index.php" class="logo">🐾 Pet Hub Care</a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Pet Mart</a></li>
            <li><a href="book.php">Bookings</a></li>
            <li><a href="my_bookings.php">My Appointments</a></li>
            <li><a href="adoption.php">Pet Adoption</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <h1>Everything Your Pet Needs, In One Place</h1>
        <p>Premium pet supplies, professional grooming & healthcare bookings, and loving pet adoption services.</p>
        <div class="hero-btns">
            <a href="shop.php" class="btn btn-primary">Shop Now</a>
            <a href="book.php" class="btn btn-secondary">Book Grooming</a>
        </div>
    </header>

    <!-- Main Features / Services -->
    <main class="container">
        <h2 class="section-title">Our Main Services</h2>
        <div class="services-grid">
            
            <div class="service-card">
                <div class="icon">🛒</div>
                <h3>Pet Supplies Mart</h3>
                <p>High quality food, durable toys, and essential care products for your dogs and cats.</p>
                <a href="shop.php" class="btn btn-primary">Visit Mart</a>
            </div>

            <div class="service-card">
                <div class="icon">✂️</div>
                <h3>Grooming & Care</h3>
                <p>Schedule a professional grooming session with instant SMS confirmation alerts.</p>
                <a href="book.php" class="btn btn-primary">Book Now</a>
            </div>

            <div class="service-card">
                <div class="icon">🐶</div>
                <h3>Pet Adoption</h3>
                <p>Give a homeless pet a second chance. Browse through available pets looking for a home.</p>
                <a href="adoption.php" class="btn btn-primary">Adopt Today</a>
            </div>

            <div class="service-card">
                <div class="icon">📅</div>
                <h3>Appointment History</h3>
                <p>Check your upcoming scheduled care appointments and tracking status seamlessly.</p>
                <a href="my_bookings.php" class="btn btn-primary">View History</a>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date('Y') ?> Pet Hub Care Center. All Rights Reserved.</p>
    </footer>

</body>
</html>