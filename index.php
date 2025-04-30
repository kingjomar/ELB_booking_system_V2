<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>El Bernardino Resort</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    </script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarNav">
                <ul class="navbar-nav me-3">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Offers</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
                <a href="inquiry_form.php" class="btn custom-btn shadow-sm px-4 py-2">Book Now</a>
            </div>

        </div>
    </nav>

    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                class="active"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/image1.jpg" class="carousel-img d-block w-100" alt="Banner 1">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="title-name">EL BERNARDINO RESORT</h1>
                    <p class="title-caption">"A PLACE TO PAUSE, A MOMENT TO REMEMBER"</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/background2.jpg" class="carousel-img d-block w-100" alt="Banner 2">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="title-name">EL BERNARDINO RESORT</h1>
                    <p class="title-caption">"A PLACE TO PAUSE, A MOMENT TO REMEMBER"</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/image3.jfif" class="carousel-img d-block w-100" alt="Banner 3">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="title-name">EL BERNARDINO RESORT</h1>
                    <p class="title-caption">"A PLACE TO PAUSE, A MOMENT TO REMEMBER"</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container-second">
        <div class="welcome-container d-flex justify-content-center align-items-center">
            <div class="text-center">
                <h1 class="welcome-line-1">Welcome to</h1>
                <h1 class="welcome-line-2">EL BERNARDINO RESORT</h1>
                <p class="text-description">El Bernardino Resort welcomes you to a fresh beautiful place where
                    modern
                    and traditional
                    Filipino styles seamlessly blend. Nestled in a serene setting, this resort boasts homes with a
                    modern sleek look, offering a perfect mix of comfort and elegance. The calm and peaceful ambiance is
                    enhanced by earth tone accents, creating an inviting atmosphere that immediately makes you feel at
                    ease. Picture yourself lounging by the sparkling swimming pool, which is perfect for both kids and
                    adults, surrounded by lush greenery that exudes nature vibes. Imagine spending your days here,
                    enjoying the serene environment and the thoughtfully designed spaces that reflect the beauty of
                    Filipino craftsmanship.</p>
            </div>
        </div>
    </div>

    <div class="container-third">
        <div class="content-container">
            <h5 class="fw-bold">Lorem ipsum</h5>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempora labore nulla, fugit soluta aspernatur
                aliquam nam commodi vitae eveniet architecto maiores modi, reprehenderit error.</p>
            <a href="#" class="text-learn d-flex justify-content-center align-items-center text-decoration-none">Learn
                More</a>
        </div>
    </div>

    <!-- Social Media Section -->
    <div class="container text-center py-5">
        <h5 class="section-title">Follow Us on Social Media</h5>
        <div class="social-icons d-flex justify-content-center gap-4 mb-5">
            <a href="https://facebook.com/elbernardinoresort" class="social-link"><i
                    class="fa-brands fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/explore/locations/105419511079442/the-resort-at-san-bernardino/"
                class="social-link"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="social-link"><i class="fa-brands fa-youtube"></i></a>
        </div>

        <!-- Amenities Section -->
        <h5 class="section-title">Amenities & Services</h5>
        <div class="amenities-wrapper">
            <div class="amenities-row">
                <div class="amenity">
                    <div class="icon-circle"><i class="fa-solid fa-wifi"></i></div>
                    <p class="amenity-text">Free WiFi</p>
                </div>
                <div class="amenity">
                    <div class="icon-circle"><i class="fa-solid fa-child"></i></div>
                    <p class="amenity-text">Playground</p>
                </div>
                <div class="amenity">
                    <div class="icon-circle"><i class="fa-solid fa-basketball"></i></div>
                    <p class="amenity-text">Court</p>
                </div>
                <div class="amenity">
                    <div class="icon-circle"><i class="fa-solid fa-store"></i></div>
                    <p class="amenity-text">Store</p>
                </div>
            </div>

            <div class="amenities-row">
                <div class="amenity">
                    <div class="icon-circle"><i class="fa-solid fa-torii-gate"></i></div>
                    <p class="amenity-text">Inflatable</p>
                </div>
                <div class="amenity">
                    <div class="icon-circle"><i class="fa-solid fa-square-parking"></i></div>
                    <p class="amenity-text">Wide Parking</p>
                </div>
                <div class="amenity">
                    <div class="icon-circle"><i class="fa-solid fa-motorcycle"></i></div>
                    <p class="amenity-text">ATV Ride</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fourth">

    </div>

    <div class="mt-4">
        <h3 class="text-center">OFFERS</h3>
    </div>


    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-1">&copy; 2025 Your Company Name. All rights reserved.</p>
            <p class="mb-0">
                <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>