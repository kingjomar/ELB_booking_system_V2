<?php
// Include database connection
include('db_connect.php');

// Fetch all images from the gallery table
$result = $conn->query("SELECT * FROM gallery");

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
    <link rel="stylesheet" href="style.css">
    <style>
        .card {
            height: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 320px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin: 0;
        }

        .card-wrapper {
            margin-bottom: 30px;
            display: flex;
            height: 100%;
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
                    <li class="nav-item"><a class="nav-link" href="offer.php">Offers</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <a href="inquiry_form.php" class="btn custom-btn shadow-sm px-4 py-2">Book Now</a>
            </div>

        </div>
    </nav>
    <div class="container-title d-flex justify-content-center align-items-center">
        <div class="overlay w-100 h-100 d-flex justify-content-center align-items-center">
            <h1 class="text-white display-4 fw-bold">Gallery</h1>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card-wrapper w-100">
                        <div class="card w-100">
                            <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    $conn->close();
    ?>

    <!-- Pagination -->
    <nav class="mt-4 d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link" href="#">Previous</a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
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
        const images = [{
                src: 'images/image1.jpg',
                title: 'Image 1 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 2 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 3 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 4 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 5 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 6 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 7 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 8 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 9 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 10 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 11 Title'
            },
            {
                src: 'images/image1.jpg',
                title: 'Image 12 Title'
            }
        ];

        const itemsPerPage = 6;
        let currentPage = 1;

        function renderGallery(page) {
            const gallery = document.getElementById('gallery');
            gallery.innerHTML = '';

            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageItems = images.slice(start, end);

            pageItems.forEach(image => {
                const col = document.createElement('div');
                col.className = 'col';
                col.innerHTML = `
        <div class="text-center">
          <img src="${image.src}" class="img-fluid rounded shadow" alt="${image.title}">
          <p class="mt-2">${image.title}</p>
        </div>
      `;
                gallery.appendChild(col);
            });
        }

        function renderPagination() {
            const totalPages = Math.ceil(images.length / itemsPerPage);
            const pagination = document.querySelector('.pagination');
            pagination.innerHTML = '';

            const prev = document.createElement('li');
            prev.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prev.innerHTML = `<a class="page-link" href="#">Previous</a>`;
            prev.addEventListener('click', e => {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    renderGallery(currentPage);
                    renderPagination();
                    scrollToGallery();
                }
            });
            pagination.appendChild(prev);

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                li.addEventListener('click', e => {
                    e.preventDefault();
                    currentPage = i;
                    renderGallery(currentPage);
                    renderPagination();
                    scrollToGallery();
                });
                pagination.appendChild(li);
            }

            const next = document.createElement('li');
            next.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            next.innerHTML = `<a class="page-link" href="#">Next</a>`;
            next.addEventListener('click', e => {
                e.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    renderGallery(currentPage);
                    renderPagination();
                    scrollToGallery();
                }
            });
            pagination.appendChild(next);
        }

        function scrollToGallery() {
            const galleryTop = document.getElementById('gallery').offsetTop;
            window.scrollTo({
                top: galleryTop - 100,
                behavior: 'smooth'
            });
        }

        // Initialize
        renderGallery(currentPage);
        renderPagination();
    </script>

</body>

</html>