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
    $room_quantity = !empty($_POST['room_quantity']) ? (int)$_POST['room_quantity'] : 0;
    $cottage_type = !empty($_POST['cottage_type']) ? $_POST['cottage_type'] : NULL;
    $cottage_quantity = !empty($_POST['cottage_quantity']) ? (int)$_POST['cottage_quantity'] : 0;

    // Entrance Fee Pricing
    $adult_price = ($swimming_type == 'daytour') ? 180 : 200;
    $senior_price = ($swimming_type == 'daytour') ? 150 : 160;
    $adults_total = $adults * $adult_price;
    $seniors_total = $seniors * $senior_price;
    $entrance_fee = $adults_total + $seniors_total;

    // Cottage Fee
    $cottage_unit_price = 0;
    if ($cottage_type == 'Nipa' || $cottage_type == 'Cave') $cottage_unit_price = 1000;
    elseif ($cottage_type == 'Nipa20' || $cottage_type == 'Cave20') $cottage_unit_price = 1800;
    elseif ($cottage_type == 'Cabana') $cottage_unit_price = 1200;
    $cottage_fee = $cottage_unit_price * $cottage_quantity;

    // Room Fee
    $room_unit_price = 0;
    if ($room_type == 'Deluxe') $room_unit_price = 3000;
    elseif ($room_type == 'Standard') $room_unit_price = 3500;
    elseif ($room_type == 'Family') $room_unit_price = 5000;
    $room_fee = $room_unit_price * $room_quantity;

    $cottage_room_fee = $cottage_fee + $room_fee;

    // ✅ Room Excess Calculation - updated
    $room_excess_charge = 0;
    if ($room_quantity > 0 && $room_type !== NULL) {
        $room_capacity = 0;
        if ($room_type == 'Deluxe') $room_capacity = 2;
        elseif ($room_type == 'Standard') $room_capacity = 4;
        elseif ($room_type == 'Family') $room_capacity = 7;

        $allowed_room_pax = $room_capacity * $room_quantity;
        $room_excess = max(0, $total_pax - $allowed_room_pax);

        // Charge 350 per excess pax (already includes entrance fee)
        $room_excess_charge = $room_excess * 350;

        // Set entrance fee to 0 for overnight stays with rooms
        if ($swimming_type == 'overnight') {
            $entrance_fee = 0;
        }
    }

    // Cottage Excess Calculation
    $cottage_excess_charge = 0;
    if ($cottage_quantity > 0 && $cottage_type !== NULL) {
        $cottage_capacity = 0;
        if ($cottage_type == 'Nipa' || $cottage_type == 'Cave') $cottage_capacity = 10;
        elseif ($cottage_type == 'Nipa20' || $cottage_type == 'Cave20') $cottage_capacity = 20;
        elseif ($cottage_type == 'Cabana') $cottage_capacity = 10;

        $allowed_cottage_pax = $cottage_capacity * $cottage_quantity;
        $cottage_excess = max(0, $total_pax - $allowed_cottage_pax);
        $cottage_excess_charge = $cottage_excess * 100;
    }

    // Final total
    $total_amount = round($entrance_fee + $cottage_room_fee + $room_excess_charge + $cottage_excess_charge, 2);

    // Booking metadata
    $booking_number = rand(100000, 999999);
    date_default_timezone_set('Asia/Manila');
    $date_of_inquiry = date('Y-m-d H:i:s');

    // Insert query
    $insert = "INSERT INTO bookings (
        firstname, middlename, lastname, contact, address,
        booking_number, date_of_reservation, date_of_inquiry,
        swimming_type, total_pax, `3yrs_old_below`, adults, kids_seniors_pwds,
        cottage_type, cottage_quantity, room_type, room_quantity,
        total_amount, entrance_fee, cottage_room_fee,
        room_excess_charge, cottage_excess_charge, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($insert);
    $status = "pending";

    $stmt->bind_param(
        'sssssisssiiiisisiidddds',
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
        $cottage_type,
        $cottage_quantity,
        $room_type,
        $room_quantity,
        $total_amount,
        $entrance_fee,
        $cottage_room_fee,
        $room_excess_charge,
        $cottage_excess_charge,
        $status
    );

    if ($stmt->execute()) {
        $_SESSION['booking_number'] = $booking_number;
        $_SESSION['success'] = "Booking successful! Your booking number is: $booking_number";
        header("Location: inquiry_form.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
