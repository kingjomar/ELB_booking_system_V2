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
        header("Location: inquiry_form.php");
        exit();
    }

    // Auto-generated booking details
    $booking_number = rand(100000, 999999);
    date_default_timezone_set('Asia/Manila');
    $date_of_inquiry = date('Y-m-d H:i:s');

    // Entrance Fee (adults + seniors only)
    $adult_price = ($swimming_type == 'daytour') ? 180 : 200;
    $senior_price = $adult_price * 0.8;

    $adults_total = $adults * $adult_price;
    $seniors_total = $seniors * $senior_price;
    $entrance_fee = $adults_total + $seniors_total;

    // Cottage Pricing
    $cottage_unit_price = 0;
    if ($cottage_type == 'Nipa' || $cottage_type == 'Cave') $cottage_unit_price = 1000;
    elseif ($cottage_type == 'Nipa20' || $cottage_type == 'Cave20') $cottage_unit_price = 1800;
    elseif ($cottage_type == 'Cabana') $cottage_unit_price = 1200;
    $cottage_fee = $cottage_unit_price * $cottage_qty;

    // Room Pricing
    $room_unit_price = 0;
    if ($room_type == 'Deluxe') $room_unit_price = 3000;
    elseif ($room_type == 'Standard') $room_unit_price = 3500;
    elseif ($room_type == 'Family') $room_unit_price = 5000;
    $room_fee = $room_unit_price * $room_qty;

    // Cottage + Room Fee
    $cottage_room_fee = $cottage_fee + $room_fee;

    // Final Total Amount
    $total_amount = $entrance_fee + $cottage_room_fee;


    // Insert into database
    $cottage_room_fee = $cottage_fee + $room_fee;

    $insertBooking = "INSERT INTO bookings (
        booking_number, first_name, middle_name, last_name, contact, address,
        swimming_type, total_pax, 3yrs_old_below, adults, kids_seniors_pwds,
        date_of_reservation, room_type, room_qty, cottage_type, cottage_qty,
        entrance_fee, cottage_room_fee, total_amount, date_of_inquiry
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";
    $stmt = $conn->prepare($insertBooking);
    $stmt->bind_param(
        "sssssssiiiissisiddds",
        $booking_number,
        $firstname,
        $middlename,
        $lastname,
        $contact,
        $address,
        $swimming_type,
        $total_pax,
        $three_yrs,
        $adults,
        $seniors,
        $date_of_reservation,
        $room_type,
        $room_qty,
        $cottage_type,
        $cottage_qty,
        $entrance_fee,
        $cottage_room_fee,
        $total_amount,
        $date_of_inquiry
    );




    if ($stmt->execute()) {
        $_SESSION['booking_number'] = $booking_number;
        $_SESSION['status'] = 'Pending'; // Default is pending
        $_SESSION['success'] = "Booking successful! Your booking number is: $booking_number";

        // Redirect back to booking form
        header("Location: inquiry_form.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}