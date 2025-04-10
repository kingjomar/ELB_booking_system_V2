<?php
session_start();
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['first_name'];
    $middlename = $_POST['middle_name'];
    $lastname = $_POST['last_name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $swimming_type = $_POST['swimming_type'];
    $total_pax = (int)$_POST['total_pax'];
    $three_yrs = (int)$_POST['3yrs_old_below'];
    $adults = (int)$_POST['adults'];
    $seniors = (int)$_POST['kids_seniors_pwds'];
    $date_of_reservation = $_POST['date_of_reservation'];
    $room_type = !empty($_POST['room_type']) ? $_POST['room_type'] : NULL;
    $room_qty = !empty($_POST['room_qty']) ? (int)$_POST['room_qty'] : 0;
    $cottage_type = !empty($_POST['cottage_type']) ? $_POST['cottage_type'] : NULL;
    $cottage_qty = !empty($_POST['cottage_qty']) ? (int)$_POST['cottage_qty'] : 0;
    $total_amount = (int)$_POST['total_price'];

    // Validate total pax count
    $calculated_pax = $adults + $seniors;
    if ($total_pax !== $calculated_pax) {
        $_SESSION['error'] = "Total pax count is incorrect.";
        header("Location: index.php");
        exit();
    }

    // Auto-generated booking details
    $booking_number = rand(100000, 999999);
    date_default_timezone_set('Asia/Manila');
    $date_of_inquiry = date('Y-m-d H:i:s');

    // Pricing logic
    $adult_price = ($swimming_type == 'daytour') ? 180 : 200;
    $senior_price = $adult_price * 0.8;
    $seniors_total = $seniors * $senior_price;
    $adults_total = $adults * $adult_price;

    // Cottage pricing
    $cottage_price = 0;
    if ($cottage_type == 'Nipa' || $cottage_type == 'Cave') {
        $cottage_price = ($cottage_qty == 10) ? 1000 : 1800;
    } elseif ($cottage_type == 'Cabana') {
        $cottage_price = 1200;
    }
    $cottage_price *= $cottage_qty;

    // Room pricing
    $room_price = 0;
    if ($room_type == 'Deluxe') $room_price = 3000;
    elseif ($room_type == 'Standard') $room_price = 3500;
    elseif ($room_type == 'Family') $room_price = 5000;
    $room_price *= $room_qty;

    // ✅ Final Total Amount - use this for database insert
    $total_amount = $adults_total + $seniors_total + $cottage_price + $room_price;


    // Insert into database
    $query = "INSERT INTO bookings (
        firstname, middlename, lastname, contact, address, booking_number, date_of_reservation, date_of_inquiry,
        swimming_type, total_pax, 3yrs_old_below, adults, kids_seniors_pwds,
        room_type, room_quantity, cottage_type, cottage_quantity, total_amount, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
    
    // Prepare the statement
    $stmt = $conn->prepare($query);
    
    // Bind parameters (16 in total, excluding the 'Pending' status)
    $stmt->bind_param(
        "sssssssssiiiisssii",
        $firstname,
        $middlename,
        $lastname,
        $contact,
        $address,
        $booking_number,
        $date_of_reservation,
        $date_of_inquiry,
        $swimming_type,
        $total_pax,
        $three_yrs,
        $adults,
        $seniors,
        $room_type,
        $room_qty,
        $cottage_type,
        $cottage_qty,
        $total_amount
    );
    


    if ($stmt->execute()) {
        // Store booking details in session to show on index.php
        $_SESSION['booking_number'] = $booking_number;
        $_SESSION['status'] = 'Pending'; // Default is pending
        $_SESSION['success'] = "Booking successful! Your booking number is: $booking_number";

        // Redirect back to booking form
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
