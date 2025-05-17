<?php
// admin_blog.php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    $imagePath = 'uploads/' . basename($_FILES['image']['name']);

    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

    $stmt = $conn->prepare("INSERT INTO blogs (title, date, content, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $date, $content, $imagePath);
    $stmt->execute();
    echo "<script>alert('Blog added successfully!');window.location='admin_blog.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    /* General body styling */
    body {
        display: flex;
        min-height: 100vh;
        flex-direction: row;
        background-color: #f8f9fa;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    /* Sidebar styling */
    .sidebar {
        background-color: #ffffff;
        color: #495057;
        width: 250px;
        height: 100%;
        padding-top: 30px;
        border-right: 1px solid #ddd;
        position: fixed;
        transition: width 0.3s ease-in-out;
    }

    /* Sidebar header */
    .sidebar h4 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Sidebar links */
    .sidebar a {
        color: #495057;
        text-decoration: none;
        padding: 15px;
        display: block;
        margin-bottom: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-size: 1rem;
    }

    .sidebar a:hover {
        background-color: #f1f3f5;
        color: #007bff;
    }

    /* Accordion button styling */
    .sidebar .accordion-button {
        font-size: 1rem;
        text-align: left;
        background-color: #f8f9fa;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        width: 100%;
    }

    /* Remove box-shadow on focus */
    .sidebar .accordion-button:focus {
        box-shadow: none;
    }

    /* When the accordion is expanded */
    .sidebar .accordion-button:not(.collapsed) {
        background-color: #e9ecef;
        color: #007bff;
    }

    /* Hover effect for accordion button */
    .sidebar .accordion-button:hover {
        background-color: #f1f3f5;
    }

    /* Accordion body styling (optional) */
    .sidebar .accordion-body {
        padding: 15px;
    }

    /* Accordion collapse animation */
    /* .collapse {
            transition: all 0.3s ease;
        } */

    /* Accordion expanded state */
    .sidebar .accordion-button:not(.collapsed) {
        background-color: #e9ecef;
        color: #007bff;
    }

    /* Hover effects for accordion buttons */
    .sidebar .accordion-button:hover {
        background-color: #e2e6ea;
    }

    .main-content {
        margin-left: 260px;
        /* Ensure content starts after the sidebar */
        width: calc(100% - 260px);
        /* Ensure content fills the remaining space */
        padding: 20px;
    }

    .form-card {
        max-width: 700px;
        margin: 0 auto;
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        padding: 2rem;
    }

    .form-label {
        font-weight: 500;
    }

    .preview-img {
        max-height: 250px;
        border-radius: 10px;
        object-fit: cover;
        margin-top: 10px;
    }
    </style>

</head>

<body>
    <?php include('sidebar.php'); ?>
    <div class="main-content ">
        <div class="form-card">
            <h3 class="mb-4 text-center text-primary">📝 Add New Blog Post</h3>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Blog Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter blog title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" rows="6" class="form-control" placeholder="Write your content here..."
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image Upload</label>
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*" required>
                    <img id="preview" class="preview-img d-none" />
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">Add Blog</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Image preview script
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            preview.classList.remove('d-none');
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
            preview.src = '';
        }
    });
    </script>
</body>

</html>