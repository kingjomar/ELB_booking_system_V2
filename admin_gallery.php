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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

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

    .container {
        max-width: 600px;
    }

    .alert {
        border-radius: 10px;
    }
    </style>
</head>

<body>
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
                    <button type="submit" class="btn btn-custom" name="upload">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>