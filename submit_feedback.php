<?php
include 'db_connect.php'; // make sure this connects to your DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message']);
    $rating = intval($_POST['rating']);

    if ($message === '' || $rating < 1 || $rating > 5) {
        echo "Invalid input.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO feedback (message, rating) VALUES (?, ?)");
    $stmt->bind_param("si", $message, $rating);

    if ($stmt->execute()) {
        echo "Thank you for your feedback!";
    } else {
        echo "Failed to submit feedback.";
    }

    $stmt->close();
    $conn->close();
}
