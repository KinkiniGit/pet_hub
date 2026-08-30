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
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #27ae60;
            --primary-hover: #219150;
            --dark-blue: #1b2a4a;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: #333;
        }

        /* Navigation Bar */
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

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1450778869186-3997d5a518da?w=1200') center/cover no-repeat;
            min-height: 60vh;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
        }
        .hero h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 25px;
            max-width: 600px;
        }
        .btn-green {
            background: var(--primary-color);
            color: white;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }
        .btn-green:hover {
            background: var(--primary-hover);
            color: white;
        }
        .btn-red {
            background: #e74c3c;
            color: white;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }
        .btn-red:hover {
            background: #c0392b;
            color: white;
        }

        /* Services Grid Cards */
        .service-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
            height: 100%;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        /* Stats Bar Section */
        .stats-section {
            background-color: var(--dark-blue);
            color: white;
            padding: 40px 0;
        }
        .stat-item h2 {
            font-size: 2.2rem;
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 5px;
        }
        .stat-item p {
            font-size: 0.9rem;
            color: #a0aec0;
            margin: 0;
        }

        /* Featured Products Section */
        .product-card {
            background: white;
            border: 1px solid #edf2f7;
            border-radius: 12px;
            padding: 25px 15px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            transition: 0.3s;
            height: 100%;
        }
        .product-card:hover {
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        .product-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }
        .product-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2d3748;
        }
        .product-price {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        /* Testimonials Section */
        .testimonial-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .stars {
            color: #f6e05e;
            margin-bottom: 12px;
            font-size: 14px;
        }
        .testimonial-text {
            font-size: 0.88rem;
            color: #4a5568;
            font-style: italic;
            margin-bottom: 20px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .avatar-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }
        .user-details h6 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: bold;
        }
        .user-details small {
            color: #a0aec0;
            font-size: 0.75rem;
        }

        /* FAQ Section */
        .accordion-button:not(.collapsed) {
            background-color: transparent;
            color: var(--dark-blue);
            box-shadow: none;
        }
        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0,0,0,.125);
        }
        .accordion-item {
            border: 1px solid #e2e8f0;
            border-radius: 8px !important;
            margin-bottom: 10px;
            overflow: hidden;
        }

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

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand" href="index.php">🐾 Pet Hub Care</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">Pet Mart</a></li>
                    <li class="nav-item"><a class="nav-link" href="book.php">Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="my_bookings.php">My Appointments</a></li>
                    <li class="nav-item"><a class="nav-link" href="adoption.php">Pet Adoption</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <h1>Everything Your Pet Needs, In One Place</h1>
        <p>Premium pet supplies, professional grooming & healthcare bookings, and loving pet adoption services.</p>
        <div class="d-flex gap-3 flex-wrap justify-content-center">
            <a href="shop.php" class="btn btn-green">Shop Now</a>
            <a href="book.php" class="btn btn-red">Book Grooming</a>
        </div>
    </header>

    <!-- Main Services Section -->
    <section class="container my-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="fs-1 mb-2">🛒</div>
                    <h3 class="h5 fw-bold mb-2">Pet Supplies Mart</h3>
                    <p class="text-muted small mb-4">High quality food, durable toys, and essential care products for your dogs and cats.</p>
                    <a href="shop.php" class="btn btn-green w-100">Visit Mart</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="fs-1 mb-2">✂️</div>
                    <h3 class="h5 fw-bold mb-2">Grooming & Care</h3>
                    <p class="text-muted small mb-4">Schedule a professional grooming session with instant SMS confirmation alerts.</p>
                    <a href="book.php" class="btn btn-green w-100">Book Now</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="fs-1 mb-2">🐶</div>
                    <h3 class="h5 fw-bold mb-2">Pet Adoption</h3>
                    <p class="text-muted small mb-4">Give a homeless pet a second chance. Browse through available pets looking for a home.</p>
                    <a href="adoption.php" class="btn btn-green w-100">Adopt Today</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="fs-1 mb-2">📅</div>
                    <h3 class="h5 fw-bold mb-2">Appointment History</h3>
                    <p class="text-muted small mb-4">Check your upcoming scheduled care appointments and tracking status seamlessly.</p>
                    <a href="my_bookings.php" class="btn btn-green w-100">View History</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center gy-4">
                <div class="col-6 col-md-3 stat-item">
                    <h2>12,000+</h2>
                    <p>Happy pets served</p>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <h2>480+</h2>
                    <p>Products in stock</p>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <h2>35+</h2>
                    <p>Partner vets & groomers</p>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <h2>24/7</h2>
                    <p>Booking support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="container my-5 py-3">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Featured Products</h2>
            <p class="text-muted small">A few bestsellers from the Pet Mart, restocked weekly.</p>
        </div>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="product-card">
                    <div class="product-icon">🍖</div>
                    <div class="product-title">Grain-Free Dog Food (5kg)</div>
                    <div class="product-price">Rs. 4,950</div>
                    <a href="shop.php" class="btn btn-green btn-sm px-3">Add To Cart</a>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="product-card">
                    <div class="product-icon">🧸</div>
                    <div class="product-title">Squeaky Chew Toy Set</div>
                    <div class="product-price">Rs. 950</div>
                    <a href="shop.php" class="btn btn-green btn-sm px-3">Add To Cart</a>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="product-card">
                    <div class="product-icon">🧴</div>
                    <div class="product-title">Oatmeal Pet Shampoo</div>
                    <div class="product-price">Rs. 1,750</div>
                    <a href="shop.php" class="btn btn-green btn-sm px-3">Add To Cart</a>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="product-card">
                    <div class="product-icon">🐱</div>
                    <div class="product-title">Cat Scratching Post</div>
                    <div class="product-price">Rs. 3,800</div>
                    <a href="shop.php" class="btn btn-green btn-sm px-3">Add To Cart</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials / What Pet Parents Say -->
    <section class="container my-5 py-3">
        <div class="text-center mb-4">
            <h2 class="fw-bold">What Pet Parents Say</h2>
            <p class="text-muted small">Real feedback from real appointment and mart orders.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div>
                        <div class="stars">★★★★★</div>
                        <p class="testimonial-text">"Booked a grooming session for my golden retriever and got an SMS instantly! The bath process was so smooth."</p>
                    </div>
                    <div class="user-info">
                        <div class="avatar-circle">N</div>
                        <div class="user-details">
                            <h6>Sadeesha P.</h6>
                            <small>Dog owner, Nugegoda</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div>
                        <div class="stars">★★★★★</div>
                        <p class="testimonial-text">"Adopted our cat Milo through this site! The whole process was fast and the pet staff followed up after."</p>
                    </div>
                    <div class="user-info">
                        <div class="avatar-circle">K</div>
                        <div class="user-details">
                            <h6>Kasun S.</h6>
                            <small>Cat owner, Colombo</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div>
                        <div class="stars">★★★★★</div>
                        <p class="testimonial-text">"Delivery food is quick and the entire order experience was super clean. Quality could be a bit better though."</p>
                    </div>
                    <div class="user-info">
                        <div class="avatar-circle">T</div>
                        <div class="user-details">
                            <h6>Tharushi K.</h6>
                            <small>Pet Mart customer</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="container my-5 py-3" style="max-width: 800px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Frequently Asked Questions</h2>
            <p class="text-muted small">Can't find your answer here? Reach out through the contact details at the bottom.</p>
        </div>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeadingOne">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne">
                        How do I book a grooming appointment?
                    </button>
                </h2>
                <div id="faqCollapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted small">
                        You can navigate to the "Bookings" page from the menu, select your preferred service date and time, and complete the form. You will receive a confirmation message once booked.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeadingTwo">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo">
                        Can I cancel or reschedule an appointment?
                    </button>
                </h2>
                <div id="faqCollapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted small">
                        Yes, you can manage or review your appointments under the "My Appointments" section in the menu.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeadingThree">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree">
                        What's the delivery time for Pet Mart orders?
                    </button>
                </h2>
                <div id="faqCollapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted small">
                        Standard delivery usually takes 2-3 business days depending on your location.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; <?= date('Y') ?> Pet Hub Care Center. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.bundle.min.js"></script>
</body>
</html>