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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">
    <h2>Add New Blog</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" rows="5" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Blog</button>
    </form>
</body>

</html>