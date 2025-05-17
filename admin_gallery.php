<?php
// Include database connection
include('db_connect.php');
include('auth.php');

if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";  // Make sure this directory exists and is writable
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the uploaded file is a valid image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check !== false) {
        // Try to upload the image
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Insert image details into the gallery table
            $stmt = $conn->prepare("INSERT INTO gallery (title, image_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $target_file);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-3'>Image uploaded and saved successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-warning mt-3'>Sorry, there was an error uploading your file.</div>";
        }
    } else {
        echo "<div class='alert alert-danger mt-3'>File is not an image.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gallery</title>
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

        /* Card styling */
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Form label and button styling */
        .form-label {
            font-weight: bold;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Alert box styling */
        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include('sidebar.php'); ?>

    <!-- Main content container -->
    <div class="main-content">
        <div class="container mt-5">
            <div class="card p-4">
                <h2 class="text-center mb-4">Upload Gallery Image</h2>
                <form action="admin_gallery.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Image Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" name="upload">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>