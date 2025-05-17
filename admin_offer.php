<?php
include('db_connect.php');
include('auth.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Handle image upload
    if (isset($_FILES['image'])) {
        $image_name = $_FILES['image']['name']; // Get original image name
        $image_temp = $_FILES['image']['tmp_name']; // Temporary file path
        $image_path = "images/" . $image_name; // Destination folder on the server

        // Move the uploaded image to the 'images/' directory
        if (move_uploaded_file($image_temp, $image_path)) {
            // Insert data into the database, including the image path
            $sql = "INSERT INTO offers (title, description, image_url) 
                    VALUES ('$title', '$description', '$image_path')";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success mt-4" role="alert">New offer created successfully!</div>';
            } else {
                echo '<div class="alert alert-danger mt-4" role="alert">Error: ' . $conn->error . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-4" role="alert">Error uploading image!</div>';
        }
    }
}

// Close the connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Offer</title>
    <!-- Bootstrap 5.3.0 CSS -->
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

    /* Content area styling */
    .content {
        margin-left: 250px;
        padding: 20px;
        flex-grow: 1;
        background-color: #f8f9fa;
    }

    /* Header styling */
    .header {
        background-color: #007bff;
        padding: 15px 30px;
        border-bottom: 1px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        color: #fff;
    }

    .header h1 {
        font-size: 1.75rem;
        margin: 0;
        font-weight: bold;
    }

    /* Sidebar and content responsive behavior */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            position: relative;
            height: auto;
            padding-top: 20px;
        }

        .content {
            margin-left: 0;
            padding: 15px;
        }

        .header h1 {
            font-size: 1.5rem;
        }
    }

    /* Main content styling */
    .main-content {
        margin-left: 260px;
        /* Ensure content starts after the sidebar */
        width: calc(100% - 260px);
        /* Ensure content fills the remaining space */
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin-top: 50px;
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #343a40;
    }

    .form-label {
        font-weight: bold;
        color: #495057;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    </style>
</head>

<body>
    <?php include('sidebar.php'); ?>

    <div class="main-content">
        <div class="container">
            <h2 class="text-center mb-4">Add New Offer</h2>

            <!-- Offer Insert Form -->
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Offer Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Offer Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Offer Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Offer</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>