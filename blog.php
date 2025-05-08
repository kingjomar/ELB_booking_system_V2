<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_blog.css">
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
                    <li class="nav-item"><a class="nav-link active" href="#">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <a href="inquiry_form.php" class="btn custom-btn shadow-sm px-4 py-2">Book Now</a>
            </div>

        </div>
    </nav>
    <div class="container-title d-flex justify-content-center align-items-center">
        <div class="overlay w-100 h-100 d-flex justify-content-center align-items-center">
            <h1 class="text-white display-4 fw-bold">Blogs</h1>
        </div>
    </div>

    <div class="container">
        <h4 class="section-title">Our Blog</h4>

        <div id="blogGallery" class="row row-cols-1 row-cols-md-3 g-4"></div>

        <nav>
            <ul class="pagination" id="pagination"></ul>
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
        const blogData = [{
                img: 'images/image1.jpg',
                title: 'Lush Green Villa',
                date: 'April 1, 2025',
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                link: '#'
            },
            {
                img: 'images/image1.jpg',
                title: 'Tropical Escape',
                date: 'April 2, 2025',
                text: 'Suspendisse vitae nisi et lorem feugiat.',
                link: '#'
            },
            {
                img: 'images/image1.jpg',
                title: 'Playground Fun',
                date: 'April 3, 2025',
                text: 'Aliquam erat volutpat. Curabitur feugiat.',
                link: '#'
            },
            {
                img: 'images/image1.jpg',
                title: 'Hidden Paradise',
                date: 'April 4, 2025',
                text: 'Nunc laoreet mi nec ipsum tincidunt.',
                link: '#'
            },
            {
                img: 'images/image1.jpg',
                title: 'Resort Bliss',
                date: 'April 5, 2025',
                text: 'Quisque luctus turpis ut augue tincidunt.',
                link: '#'
            },
            {
                img: 'images/image1.jpg',
                title: 'Tranquil Retreat',
                date: 'April 6, 2025',
                text: 'Etiam vitae ante nec velit lacinia.',
                link: '#'
            },
            {
                img: 'images/image1.jpg',
                title: 'Nature Walk',
                date: 'April 7, 2025',
                text: 'Cras non orci sed nulla finibus.',
                link: '#'
            },
            {
                img: 'images/image1.jpg',
                title: 'Sunny Resort',
                date: 'April 8, 2025',
                text: 'Vestibulum bibendum feugiat libero.',
                link: '#'
            },
            {
                img: 'images/image1.jpg',
                title: 'Tropical Getaway',
                date: 'April 9, 2025',
                text: 'Morbi nec leo nec nulla feugiat.',
                link: '#'
            },
        ];

        const itemsPerPage = 6;
        let currentPage = 1;

        function renderBlogGallery(page) {
            const gallery = document.getElementById('blogGallery');
            gallery.innerHTML = '';

            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageItems = blogData.slice(start, end);

            pageItems.forEach(item => {
                gallery.innerHTML += `
          <div class="col">
            <div class="card h-100">
              <img src="${item.img}" class="card-img-top" alt="${item.title}">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">${item.title}</h5>
                <small class="text-muted">${item.date}</small>
                <p class="card-text mt-2">${item.text}</p>
                <a href="${item.link}" class="btn btn-read mt-auto">Read More</a>
              </div>
            </div>
          </div>
        `;
            });

            // Scroll to top of gallery
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function renderPagination() {
            const totalPages = Math.ceil(blogData.length / itemsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `
          <li class="page-item ${i === currentPage ? 'active' : ''}">
            <button class="page-link" onclick="goToPage(${i})">${i}</button>
          </li>
        `;
            }
        }

        function goToPage(page) {
            currentPage = page;
            renderBlogGallery(page);
            renderPagination();
        }

        // Initial load
        renderBlogGallery(currentPage);
        renderPagination();
    </script>
</body>

</html>