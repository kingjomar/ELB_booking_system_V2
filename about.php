<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_about.css">
    <link rel="stylesheet" href="style.css">
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
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="offer.php">Offers</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contanct.php">Contact</a></li>
                </ul>
                <a href="inquiry_form.php" class="btn custom-btn shadow-sm px-4 py-2">Book Now</a>
            </div>

        </div>
    </nav>
    <div class="container-title d-flex justify-content-center align-items-center">
        <div class="overlay w-100 h-100 d-flex justify-content-center align-items-center">
            <h1 class="text-white display-4 fw-bold">About Us</h1>
        </div>
    </div>

    <div class="second-container d-flex flex-wrap justify-content-between align-items-center p-5 bg-light">
        <!-- Text Section -->
        <div class="col-lg-6 mb-4">
            <div class="mx-auto" style="max-width: 90%;">
                <h1 class="text-center fw-bold mb-4">EL Bernardino Resort</h1>
                <p class="text-center text-muted">
                    El Bernardino Resort welcomes you to a fresh beautiful place where modern and traditional Filipino
                    styles seamlessly blend.
                    Nestled in a serene setting, this resort boasts homes with a modern sleek look, offering a perfect
                    mix of comfort and elegance.
                    The calm and peaceful ambiance is enhanced by earth tone accents, creating an inviting atmosphere
                    that immediately makes you feel at ease.
                    Picture yourself lounging by the sparkling swimming pool, which is perfect for both kids and adults,
                    surrounded by lush greenery that exudes nature vibes.
                    Imagine spending your days here, enjoying the serene environment and the thoughtfully designed
                    spaces that reflect the beauty of Filipino craftsmanship.
                </p>
            </div>
        </div>

        <!-- Image Section -->
        <div class="col-lg-6 d-flex justify-content-center gap-3">
            <img src="images/image6.jfif" alt="Resort View 1" class="img-fluid rounded shadow"
                style="width: 48%; height: auto; object-fit: cover;">
            <img src="images/image7.jfif" alt="Resort View 2" class="img-fluid rounded shadow"
                style="width: 48%; height: auto; object-fit: cover;">
        </div>
    </div>

    <div class="container-bg">

    </div>

    <div class="container-third py-5 px-4">
        <div class="row g-5">
            <div class="col-md-6">
                <div class="p-4 bg-white rounded shadow-lg h-100">
                    <h3 class="fw-bold mb-3">Modern Comfort</h3>
                    <p class="text-muted mb-0">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum nulla vero beatae modi?
                        Unde quibusdam optio illo praesentium atque vero harum recusandae repellendus fugit?
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 bg-white rounded shadow-lg h-100">
                    <h3 class="fw-bold mb-3">Natural Tranquility</h3>
                    <p class="text-muted mb-0">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum nulla vero beatae modi?
                        Unde quibusdam optio illo praesentium atque vero harum recusandae repellendus fugit?
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="images d-flex flex-wrap">
        <img src="images/image1.jpg" alt="Image 1" class="img-thumb">
        <img src="images/background.jpg" alt="Image 2" class="img-thumb">
        <img src="images/background2.jfif" alt="Image 3" class="img-thumb">
        <img src="images/background2.jpg" alt="Image 4" class="img-thumb">
        <img src="images/image2.jfif" alt="Image 5" class="img-thumb">
        <img src="images/image5.jfif" alt="Image 6" class="img-thumb">
        <img src="images/image3.jfif" alt="Image 7" class="img-thumb">
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <!-- Left Section: Logo and Facebook Icon -->
                <div class="col-md-4 mb-3 text-center">
                    <img src="images/logo.png" alt="El Bernardino Resort Logo" style="max-width: 170px;">
                    <div class="mt-2">
                        <h5 class=""><i>"A PLACE TO PAUSE, A MOMENT TO REMEMBER"</i></h5>
                        <a href="https://www.facebook.com/elbernardinoresort" target="_blank">
                            <i class="fab fa-facebook fa-2x text-white"></i>
                        </a>
                    </div>
                </div>

                <!-- Middle Section: Contact Info -->
                <div class="col-md-4  text-center">
                    <h5>Contact</h5>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-envelope me-2"></i>
                        <p class="mt-3">theresort.acctg@gmail.com</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-phone-alt me-2"></i>
                        <p class="mt-3">0996-811-1165 / 0960-464-9711</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <p class="mt-3">San Pedro Rd., Brgy. San Matias, Sto. Tomas Pampanga</p>
                    </div>
                </div>

                <!-- Right Section: Latest Offers -->
                <div class="col-md-4 mb-3 text-center">
                    <h5>Get Latest Offers</h5>
                    <p>Sign up to receive the latest offers and news!</p>
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" aria-label="Email">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Full Width Divider -->
            <hr class="footer-divider">

            <!-- Bottom Section: Copyright & Links -->
            <div class="row">
                <div class="col text-center">
                    <p class="mb-1">&copy; 2025 El Bernardino Resort. All rights reserved.</p>
                    <p class="mb-0">
                        <a href="#" class="text-white">Privacy Policy</a> |
                        <a href="#" class="text-white">Terms of Service</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>