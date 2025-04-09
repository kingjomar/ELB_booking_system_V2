<?php
session_start();
include 'db_connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Bernardino Resort Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?resort,pool') no-repeat center center/cover;
            min-height: 100vh;
        }

        .booking-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-green {
            background-color: #2e8b57;
            color: white;
        }

        .btn-green:hover {
            background-color: #246b45;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-8 booking-container">
            <h2 class="text-center text-success">El Bernardino Resort Booking</h2>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success" id="alert-success">
                    <?= $_SESSION['success']; ?> <br>
                    Your booking status is: <b><?= $_SESSION['status'] ?? 'N/A'; ?></b>
                </div>
                <?php unset($_SESSION['success'], $_SESSION['status']); ?>
            <?php endif; ?>

            <form action="process_booking.php" method="POST" onsubmit="return confirmBooking(event)">
                <div class="mb-3">
                    <label class="form-label">Customer Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact:</label>
                    <input type="text" name="contact" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address:</label>
                    <input type="text" name="address" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Swimming Type:</label>
                    <div class="form-check">
                        <input type="radio" name="swimming_type" value="daytour" class="form-check-input" required>
                        <label class="form-check-label">Daytour (₱180)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="swimming_type" value="night" class="form-check-input" required>
                        <label class="form-check-label">Night Swimming (₱200)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="swimming_type" value="barkada_package" class="form-check-input" required>
                        <label class="form-check-label">Barkada Package</label>
                    </div>
                </div>

                <div class="mb-3" id="barkada-options" style="display: none;">
                    <label class="form-label">Barkada Package Type:</label>
                    <div class="form-check">
                        <input type="radio" name="barkada_type" value="daytour_barkada" class="form-check-input">
                        <label class="form-check-label">Daytour (₱2,500 for 10 pax)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="barkada_type" value="night_barkada" class="form-check-input">
                        <label class="form-check-label">Night Swimming (₱3,000 for 10 pax)</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Adults:</label>
                        <input type="number" name="adults" class="form-control" required min="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kids/Seniors/PWDs:</label>
                        <input type="number" name="kids_seniors_pwds" class="form-control" required min="0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">3 Years Old Below (Free):</label>
                        <input type="number" name="3yrs_old_below" class="form-control" required min="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Total Pax:</label>
                        <input type="number" name="total_pax" class="form-control" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date of Reservation:</label>
                    <input type="date" name="date_of_reservation" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Accommodation Type:</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="accommodation_type" value="room">
                        <label class="form-check-label">Room</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="accommodation_type" value="cottage">
                        <label class="form-check-label">Cottage</label>
                    </div>
                </div>

                <div class="room_type" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label">Room Type:</label>
                        <select name="room_type" class="form-select">
                            <option value="None">None</option>
                            <option value="Deluxe">Deluxe (₱3,000 for 2 pax)</option>
                            <option value="Standard">Standard (₱3,500 for 4 pax)</option>
                            <option value="Family">Family (₱5,000 for 7 pax)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Room Quantity:</label>
                        <input type="number" name="room_qty" class="form-control" min="0" disabled>
                    </div>
                </div>
                <div class="cottage_type" style="display:none;">
                <div class="mb-3">
                    <label class="form-label">Cottage Type:</label>
                    <select name="cottage_type" class="form-select" >
                        <option value="None">None</option>
                        <option value="Nipa">Nipa (₱1,000 for 10 pax)</option>
                        <option value="Nipa20">Nipa (₱1,800 for 20 pax)</option>
                        <option value="Cave">Cave (₱1,000 for 10 pax)</option>
                        <option value="Cave20">Cave (₱1,800 for 20 pax)</option>
                        <option value="Cabana">Cabana (₱1,200 for 10 pax)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cottage Quantity:</label>
                    <input type="number" name="cottage_qty" class="form-control" min="0" disabled>
                </div>

                </div>

                

               

                <div class="mb-3">
                    <label class="form-label"><strong>Total Price:</strong></label>
                    <input type="text" id="total_price" class="form-control" readonly>
                </div>

                <button type="submit" class="btn btn-green w-100">Submit Booking</button>
            </form>

            <script>
                function updateTotalPax() {
                    const adults = parseInt(document.querySelector('input[name="adults"]').value) || 0;
                    const kidsSeniors = parseInt(document.querySelector('input[name="kids_seniors_pwds"]').value) || 0;
                    const total = adults + kidsSeniors;
                    document.querySelector('input[name="total_pax"]').value = total;
                }

                function calculateTotal() {
                    let total = 0;

                    let swimmingType = document.querySelector('input[name="swimming_type"]:checked');
                    let adultPrice = 0, seniorPrice = 0;

                    if (swimmingType) {
                        if (swimmingType.value === "daytour") {
                            adultPrice = 180;
                            seniorPrice = 150;
                        } else if (swimmingType.value === "night") {
                            adultPrice = 200;
                            seniorPrice = 160;
                        }
                    }

                    let adults = parseInt(document.querySelector('input[name="adults"]').value) || 0;
                    let seniors = parseInt(document.querySelector('input[name="kids_seniors_pwds"]').value) || 0;

                    total += (adults * adultPrice) + (seniors * seniorPrice);

                    let roomType = document.querySelector('select[name="room_type"]').value;
                    let roomQty = parseInt(document.querySelector('input[name="room_qty"]').value) || 0;

                    if (roomType === "Deluxe") total += (3000 * roomQty);
                    if (roomType === "Standard") total += (3500 * roomQty);
                    if (roomType === "Family") total += (5000 * roomQty);

                    let cottageType = document.querySelector('select[name="cottage_type"]').value;
                    let cottageQty = parseInt(document.querySelector('input[name="cottage_qty"]').value) || 0;

                    if (cottageType === "Nipa" || cottageType === "Cave") total += (cottageQty * 1000);
                    if (cottageType === "Nipa20" || cottageType === "Cave20") total += (cottageQty * 1800);
                    if (cottageType === "Cabana") total += (cottageQty * 1200);

                    document.getElementById('total_price').value = "₱" + total.toLocaleString();
                }

                async function confirmBooking(event) {
                    event.preventDefault(); // Prevent the form from submitting immediately

                    const result = await Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to submit this booking?",
                        icon: 'question',  // Set the icon to question mark
                        showCancelButton: true,
                        confirmButtonText: 'Yes, submit it!',
                        cancelButtonText: 'Cancel'
                    });

                    if (result.isConfirmed) {
                        // Show the success message with a delay before submitting the form
                        await Swal.fire({
                            title: 'Submitted!',
                            text: 'Your booking has been submitted.',
                            icon: 'success',
                            showConfirmButton: false,  // Remove the OK button
                            timer: 2000 // Show the success message for 2 seconds
                        });

                        // After the success message timer ends, submit the form
                        event.target.submit(); // This will submit the form
                    } else {
                        // If canceled, you can handle it here (optional)
                        Swal.fire('Cancelled', 'Your booking was not submitted.', 'info');
                    }
                }





                document.addEventListener("DOMContentLoaded", () => {
                        // Barkada Toggle
                        document.querySelectorAll('input[name="swimming_type"]').forEach(radio => {
                            radio.addEventListener('change', () => {
                                document.getElementById("barkada-options").style.display =
                                    radio.value === "barkada_package" ? "block" : "none";
                            });
                        });

                        // Room Type Toggle
                        document.querySelectorAll('input[name="accommodation_type"]').forEach(radio => {
                            radio.addEventListener('change', () => {
                                document.querySelector('.room_type').style.display =
                                    radio.value === "room" ? "block" : "none";
                            });
                        });

                         // Cottage Type Toggle
                         document.querySelectorAll('input[name="accommodation_type"]').forEach(radio => {
                            radio.addEventListener('change', () => {
                                document.querySelector('.cottage_type').style.display =
                                    radio.value === "cottage" ? "block" : "none";
                            });
                        });

                        // 🆕 Room quantity disable based on selection
                        document.querySelector('select[name="room_type"]').addEventListener('change', function () {
                            const roomQty = document.querySelector('input[name="room_qty"]');
                            roomQty.disabled = (this.value === "None");
                            if (this.value === "None") roomQty.value = '';
                        });

                        // 🆕 Cottage quantity disable based on selection
                        document.querySelector('select[name="cottage_type"]').addEventListener('change', function () {
                            const cottageQty = document.querySelector('input[name="cottage_qty"]');
                            cottageQty.disabled = (this.value === "None");
                            if (this.value === "None") cottageQty.value = '';
                        });

                        // Real-Time Calculations
                        document.querySelectorAll('input, select').forEach(el => {
                            el.addEventListener('input', () => {
                                updateTotalPax();
                                calculateTotal();
                            });
                            el.addEventListener('change', () => {
                                updateTotalPax();
                                calculateTotal();
                            });
                        });

                        // Initial trigger on load to set disabled states correctly
                        document.querySelector('select[name="room_type"]').dispatchEvent(new Event('change'));
                        document.querySelector('select[name="cottage_type"]').dispatchEvent(new Event('change'));
                    });

            </script>
        </div>
    </div>
</body>

</html>
