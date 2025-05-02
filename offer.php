<?php
$host = "localhost";
$username = "root";  // default for XAMPP
$password = "";      // default for XAMPP
$database = "el_bernardino_resort";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get offer data
$sql = "SELECT * FROM offers";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_offer.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .offer-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            width: 300px;
            margin: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .offer-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .offer-card-content {
            padding: 15px;
        }

        .offer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .book-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .book-button:hover {
            background-color: #218838;
        }
    </style>
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
                    <li class="nav-item"><a class="nav-link active" href="#">Offers</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <a href="inquiry_form.php" class="btn custom-btn shadow-sm px-4 py-2">Book Now</a>
            </div>

        </div>
    </nav>
    <div class="container-title d-flex justify-content-center align-items-center">
        <div class="overlay w-100 h-100 d-flex justify-content-center align-items-center">
            <h1 class="text-white display-4 fw-bold">Offers</h1>
        </div>
    </div>
    <div class="container py-5">
        <h2 class="text-center mb-4">Our Latest Offers</h2>
        <div class="row justify-content-center">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                    <div class="offer-card">
                        <img src="<?php echo $row['image_url']; ?>" alt="Offer Image">
                        <div class="offer-card-content">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <a href="inquiry_form.php" class="book-button">Book Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
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
<?php $conn->close(); ?>