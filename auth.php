<?php
// auth.php - Protect this page by checking if the admin is logged in

// Check if a session is already started, if not, start it
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it hasn't already been started
}

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: admin_login.php");
    exit(); // Stop further script execution
}
