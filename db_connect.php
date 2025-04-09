<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "el_bernardino_resort";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
