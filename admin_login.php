<?php
session_start();
include 'db_connect.php';  // Database connection file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query to fetch admin details from the database
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin) {
        // Verify the password
        if ($password === $admin['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];

            // SweetAlert for successful login
            echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>";
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function () {
                    setTimeout(() => {
                        Swal.fire({
                            title: 'Login Successful',
                            text: 'Welcome, " . $admin['username'] . "!',
                            icon: 'success',
                            showConfirmButton: false,
                             timer: 1500
                        }).then(() => {
                            window.location.href = 'admin.php';
                        });
                    }, 100);
                });
            </script>";

            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style_login.css">
    <script>
    // Toggle password visibility
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const toggleIcon = document.getElementById("eye-icon");
        let openEyes = "./images/ic_opened_eye.png";
        let closeEyes = "./images/ic_closed_eye.png";

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.src = openEyes; // Open eye image
        } else {
            passwordField.type = "password";
            toggleIcon.src = closeEyes; // Closed eye image
        }
    }
    </script>
</head>

<body>

    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) {
            echo "<p class='error'>$error</p>";
        } ?>
        <form method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group password-container">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="toggle-password" id="toggle-icon" onclick="togglePassword()">
                    <img src="./images/ic_closed_eye.png" id="eye-icon" alt="Toggle Password" />
                </span>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>