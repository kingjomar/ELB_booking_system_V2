<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_contact.css">
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
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="offer.php">Offers</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Contact</a></li>
                </ul>
                <a href="inquiry_form.php" class="btn custom-btn shadow-sm px-4 py-2">Book Now</a>
            </div>

        </div>
    </nav>
    <div class="container-title d-flex justify-content-center align-items-center">
        <div class="overlay w-100 h-100 d-flex justify-content-center align-items-center">
            <h1 class="text-white display-4 fw-bold">Contact</h1>
        </div>
    </div>
    <h3 class="text-title ">El Bernardino Resort Map</h3>
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3853.6905296132504!2d120.70287107446254!3d15.009874666926814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f77bfd55f1d3%3A0x2a3032cda796cd8f!2sEL%20Bernardino%20Resort!5e0!3m2!1sen!2sph!4v1745989945461!5m2!1sen!2sph"
            width="1000" height="600" style="border:0; margin-top:20px;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" class=""></iframe>
    </div>

    <div class="container">
        <div class="contact-container">
            <h4 class="contact-title">Contact Information</h4>
            <div class="row">
                <!-- Contact Form -->
                <div class="col-md-8">
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Your Message..." required></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Enter your name" required />
                            </div>
                            <div class="col">
                                <input type="email" class="form-control" placeholder="Email" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter Subject" required />
                        </div>
                        <div class="d-flex justify-content-center"><button type="submit"
                                class="submit-btn">Submit</button></div>

                    </form>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4 contact-info">
                    <p><i class="fas fa-map-marker-alt"></i>San Pedro Road Brgy. San Matias, Sto. Tomas, Pampanga</p>
                    <p><i class="fas fa-phone"></i>0996-811-1116</p>
                    <p><i class="fas fa-envelope"></i>theresort.inquiry@gmail.com</p>
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
</body>

</html>