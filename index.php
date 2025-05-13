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
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="offer.php">Offers</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
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
                <img src="images/bg1.jfif" class="carousel-img d-block w-100" alt="Banner 1">
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
        <div class="mt-2 mb-2 d-flex justify-content-center">
            <div class="mt-4 d-flex flex-column align-items-center gap-4">

                <!-- Card 1: Image Left -->
                <div class="border shadow p-3 d-flex rounded" style="width: 1200px; height: 300px;">
                    <img src="images/background.jpg" class="rounded"
                        style="width: 300px; height: 100%; object-fit: cover;" alt="Offer Image">
                    <div class="d-flex flex-column justify-content-between ps-3 py-1">
                        <div>
                            <h4 class="fw-semibold mb-2">Special Offer 1</h4>
                            <p class="text-muted" style="max-width: 800px;">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Impedit corrupti ex placeat aut hic, dignissimos dolore perferendis,
                                earum autem, magni aspernatur laborum quae. Iure ullam illo ab eum at, quidem numquam
                                enim!</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm w-25">Claim Offer</button>
                        </div>

                    </div>
                </div>

                <!-- Card 2: Image Right -->
                <div class="border shadow p-3 d-flex flex-row-reverse rounded" style="width: 1200px; height: 300px;">
                    <img src="images/background.jpg" class="rounded"
                        style="width: 300px; height: 100%; object-fit: cover;" alt="Offer Image">
                    <div class="d-flex flex-column justify-content-between pe-3 py-1 text-end">
                        <div>
                            <h4 class="fw-semibold mb-2">Special Offer 2</h4>
                            <p class="text-muted" style="max-width: 800px;">Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit. Blanditiis quaerat soluta sed odio nulla! Animi molestias atque
                                debitis modi tempore doloribus, ducimus culpa, non sed voluptatum repudiandae. Veniam
                                maxime eligendi doloremque autem!</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm w-25">Claim Offer</button>
                        </div>

                    </div>
                </div>

                <!-- Card 3: Image Left (repeat style of card 1) -->
                <div class="border shadow p-3 d-flex rounded" style="width: 1200px; height: 300px;">
                    <img src="images/background.jpg" class="rounded"
                        style="width: 300px; height: 100%; object-fit: cover;" alt="Offer Image">
                    <div class="d-flex flex-column justify-content-between ps-3 py-1">
                        <div>
                            <h4 class="fw-semibold mb-2">Special Offer 3</h4>
                            <p class="text-muted" style="max-width: 800px;">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Delectus distinctio numquam nesciunt modi doloribus repellat ut minus
                                sint officia, eligendi deleniti consectetur nulla culpa mollitia ea asperiores
                                doloremque odit possimus a aperiam!</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm w-25">Claim Offer</button>
                        </div>

                    </div>
                </div>

                <!-- Card 4: Image Right (repeat style of card 2) -->
                <div class="border shadow p-3 d-flex flex-row-reverse rounded" style="width: 1200px; height: 300px;">
                    <img src="images/background.jpg" class="rounded"
                        style="width: 300px; height: 100%; object-fit: cover;" alt="Offer Image">
                    <div class="d-flex flex-column justify-content-between pe-3 py-1 text-end">
                        <div>
                            <h4 class="fw-semibold mb-2">Special Offer 4</h4>
                            <p class="text-muted" style="max-width: 800px;">Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit. Necessitatibus deleniti quo, voluptas nemo atque eius! Minus vel
                                repellendus pariatur minima beatae. Reiciendis iusto consequatur alias dolores dolore
                                dicta amet consectetur autem quia?</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm w-25">Claim Offer</button>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="feedback mt-5 mb-5">
        <h3 class="text-center mb-4">Your Feedback</h3>
        <div class="d-flex justify-content-center ">
            <div class="border shadow p-4 w-75 rounded bg-white">
                <!-- Feedback Form -->
                <div class="mb-3">
                    <div class="d-flex justify-content-center">
                        <label for="feedbackMessage" class="form-label">Your Message</label>
                    </div>
                    <textarea class="form-control" id="feedbackMessage" rows="4"
                        placeholder="Write your feedback..."></textarea>
                </div>

                <!-- Star Rating -->
                <div class="mb-3">
                    <div class="d-flex justify-content-center">
                        <label for="rating" class="form-label">Rating</label>
                    </div>
                    <div id="rating" class="d-flex justify-content-center">
                        <!-- Stars -->
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary w-25">Submit Feedback</button>
                </div>
            </div>
        </div>
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




    <script>
        const stars = document.querySelectorAll('.star');
        let currentRating = 0;

        stars.forEach(star => {
            star.addEventListener('click', () => {
                // Get the rating value from the clicked star
                currentRating = parseInt(star.getAttribute('data-value'));

                // Update the star ratings based on the clicked star
                stars.forEach(star => {
                    const starValue = parseInt(star.getAttribute('data-value'));
                    if (starValue <= currentRating) {
                        star.classList.add('checked');
                    } else {
                        star.classList.remove('checked');
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>