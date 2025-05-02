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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
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

    .footer {
        background-color: #343a40;
        color: white;
        padding: 20px;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
    </style>
</head>

<body>

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

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 El Bernardino Resort. All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>