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
            <h2 class="text-center text-success mb-5">El Bernardino Resort Booking</h2>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success" id="alert-success">
                    <?= $_SESSION['success']; ?> <br>
                    Your booking status is: <b><?= $_SESSION['status'] ?? 'N/A'; ?></b>
                </div>
                <?php unset($_SESSION['success'], $_SESSION['status']); ?>
            <?php endif; ?>

            <form action="process_booking.php" method="POST" onsubmit="return confirmBooking(event)">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">First Name:</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Middle Name:</label>
                        <input type="text" name="middle_name" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Last Name:</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
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
                        <input type="radio" name="swimming_type" value="overnight" class="form-check-input" required>
                        <label class="form-check-label">Overnight</label>
                    </div>
                    <!-- <div class="form-check">
                        <input type="radio" name="swimming_type" value="barkada_package" class="form-check-input"
                            required>
                        <label class="form-check-label">Barkada Package</label>
                    </div> -->
                </div>

             <!-- <div class="mb-3" id="barkada-options" style="display: none;">
                    <label class="form-label">Barkada Package Type:</label>
                    <div class="form-check">
                        <input type="radio" name="barkada_type" value="daytour_barkada" class="form-check-input">
                        <label class="form-check-label">Daytour (₱2,500 for 10 pax)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="barkada_type" value="night_barkada" class="form-check-input">
                        <label class="form-check-label">Night Swimming (₱3,000 for 10 pax)</label>
                    </div>
                </div> -->

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
                        <input type="number" name="room_quantity" class="form-control" min="0" disabled>
                    </div>
                </div>
                <div class="cottage_type" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label">Cottage Type:</label>
                        <select name="cottage_type" class="form-select">
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
                        <input type="number" name="cottage_quantity" class="form-control" min="0" disabled>
                    </div>

                </div>




                <div id="excess_room_notice" class="alert alert-warning d-none"></div>
                <div id="excess_cottage_notice" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label class="form-label"><strong>Total Price:</strong></label>
                    <input type="text" id="total_price_display" class="form-control" readonly>
                    <input type="hidden" id="total_price" name="total_price">

                </div>

                <button type="submit" class="btn btn-green w-100">Submit Booking</button>
            </form>

          <script>
    function getNumericValue(selector) {
        const el = document.querySelector(selector);
        return el && !isNaN(parseInt(el.value)) ? parseInt(el.value) : 0;
    }

    function updateTotalPax() {
        const adults = getNumericValue('input[name="adults"]');
        const kidsSeniors = getNumericValue('input[name="kids_seniors_pwds"]');
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
        } else if (swimmingType.value === "overnight") {
            adultPrice = 0;
            seniorPrice = 0;
        }
    }

    console.log("Swimming Type:", swimmingType ? swimmingType.value : "None");
    console.log("Adult Price:", adultPrice);
    console.log("Senior Price:", seniorPrice);

    let adults = getNumericValue('input[name="adults"]');
    let seniors = getNumericValue('input[name="kids_seniors_pwds"]');
    let totalPax = adults + seniors;

    console.log("Adults:", adults);
    console.log("Seniors:", seniors);
    console.log("Total Pax:", totalPax);

    let adultsTotal = adults * adultPrice;
    let seniorsTotal = seniors * seniorPrice;
    total += adultsTotal + seniorsTotal;

    console.log("Adults Total Fee:", adultsTotal);
    console.log("Seniors Total Fee:", seniorsTotal);
    console.log("Entrance Total:", total);

    let selectedAccommodation = document.querySelector('input[name="accommodation_type"]:checked')?.value;
    console.log("Selected Accommodation:", selectedAccommodation);

    if (selectedAccommodation === "room") {
        let roomType = document.querySelector('select[name="room_type"]').value;
        let roomQty = getNumericValue('input[name="room_quantity"]');
        let roomCapacity = 0, roomBaseCost = 0;

        if (roomType === "Deluxe") {
            roomCapacity = 2;
            roomBaseCost = 3000;
        } else if (roomType === "Standard") {
            roomCapacity = 4;
            roomBaseCost = 3500;
        } else if (roomType === "Family") {
            roomCapacity = 7;
            roomBaseCost = 5000;
        }

        console.log("Room Type:", roomType);
        console.log("Room Quantity:", roomQty);
        console.log("Room Capacity per Room:", roomCapacity);
        console.log("Room Base Cost:", roomBaseCost);

        let allowedRoomPax = roomCapacity * roomQty;
        total += roomBaseCost * roomQty;

        console.log("Allowed Room Pax:", allowedRoomPax);
        console.log("Room Fee:", roomBaseCost * roomQty);

        let roomExcess = totalPax > allowedRoomPax ? totalPax - allowedRoomPax : 0;
        let roomExcessCharge = roomExcess * 350;
        total += roomExcessCharge;

        console.log("Room Excess Pax:", roomExcess);
        console.log("Room Excess Charge:", roomExcessCharge);

        const roomNotice = document.getElementById('excess_room_notice');
        if (roomExcess > 0) {
            roomNotice.textContent = `Room excess: ${roomExcess} pax x ₱350 = ₱${roomExcessCharge}`;
            roomNotice.classList.remove('d-none');
        } else {
            roomNotice.classList.add('d-none');
        }

        document.getElementById('excess_cottage_notice').classList.add('d-none');
    } else if (selectedAccommodation === "cottage") {
        let cottageType = document.querySelector('select[name="cottage_type"]').value;
        let cottageQty = getNumericValue('input[name="cottage_quantity"]');
        let cottageCapacity = 0, cottageBaseCost = 0;

        if (["Nipa", "Cave"].includes(cottageType)) {
            cottageCapacity = 10;
            cottageBaseCost = 1000;
        } else if (["Nipa20", "Cave20"].includes(cottageType)) {
            cottageCapacity = 20;
            cottageBaseCost = 1800;
        } else if (cottageType === "Cabana") {
            cottageCapacity = 10;
            cottageBaseCost = 1200;
        }

        console.log("Cottage Type:", cottageType);
        console.log("Cottage Quantity:", cottageQty);
        console.log("Cottage Capacity per Unit:", cottageCapacity);
        console.log("Cottage Base Cost:", cottageBaseCost);

        let allowedCottagePax = cottageCapacity * cottageQty;
        total += cottageBaseCost * cottageQty;

        console.log("Allowed Cottage Pax:", allowedCottagePax);
        console.log("Cottage Fee:", cottageBaseCost * cottageQty);

        let cottageExcess = totalPax > allowedCottagePax ? totalPax - allowedCottagePax : 0;
        let cottageExcessCharge = 0;

        if (cottageExcess > 0) {
            let totalGroup = adults + seniors;
            let adultExcess = totalGroup > 0 ? Math.round((adults / totalGroup) * cottageExcess) : 0;
            let seniorExcess = cottageExcess - adultExcess;

            cottageExcessCharge = cottageExcess * 100;
            total += cottageExcessCharge;

            console.log("Cottage Excess Pax:", cottageExcess);
            console.log("Adult Excess Pax:", adultExcess);
            console.log("Senior Excess Pax:", seniorExcess);
            console.log("Cottage Excess Charge:", cottageExcessCharge);

            document.getElementById('excess_cottage_notice').textContent =
                `Cottage excess: ${cottageExcess} pax = ₱${cottageExcess * 100} + Entrance Fee = ₱${cottageExcessCharge}`;
            document.getElementById('excess_cottage_notice').classList.remove('d-none');
        } else {
            document.getElementById('excess_cottage_notice').classList.add('d-none');
        }

        document.getElementById('excess_room_notice').classList.add('d-none');
    }

    console.log("Total Computed Amount:", total);

    document.getElementById('total_price_display').value = "₱" + total.toLocaleString();
    document.getElementById('total_price').value = total;
}

function getNumericValue(selector) {
    let value = parseInt(document.querySelector(selector).value);
    return isNaN(value) ? 0 : value;
}




    async function confirmBooking(event) {
        event.preventDefault();

        const result = await Swal.fire({
            title: 'Are you sure?',
            text: "You want to submit this booking?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'Cancel'
        });

        if (result.isConfirmed) {
            await Swal.fire({
                title: 'Submitted!',
                text: 'Your booking has been submitted.',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
            event.target.submit();
        } else {
            Swal.fire('Cancelled', 'Your booking was not submitted.', 'info');
        }
    }

    function calculateTotalBarkada() {
        // Placeholder for barkada package logic
    }

    document.addEventListener("DOMContentLoaded", () => {
        function toggleAccommodationSections() {
            const selected = document.querySelector('input[name="accommodation_type"]:checked')?.value;
            document.querySelector('.room_type').style.display = (selected === "room") ? "block" : "none";
            document.querySelector('.cottage_type').style.display = (selected === "cottage") ? "block" : "none";
        }

        document.querySelectorAll('input[name="accommodation_type"]').forEach(radio => {
            radio.addEventListener('change', toggleAccommodationSections);
        });

        document.querySelector('select[name="room_type"]').addEventListener('change', function () {
            const roomQty = document.querySelector('input[name="room_quantity"]');
            roomQty.disabled = (this.value === "None");
            if (this.value === "None") roomQty.value = '';
        });

        document.querySelector('select[name="cottage_type"]').addEventListener('change', function () {
            const cottageQty = document.querySelector('input[name="cottage_quantity"]');
            cottageQty.disabled = (this.value === "None");
            if (this.value === "None") cottageQty.value = '';
        });

        document.querySelectorAll('input, select').forEach(el => {
            el.addEventListener('input', () => {
                updateTotalPax();
                calculateTotal();
                calculateTotalBarkada();
            });
            el.addEventListener('change', () => {
                updateTotalPax();
                calculateTotal();
                calculateTotalBarkada();
            });
        });

        document.querySelectorAll('input[name="swimming_type"]').forEach(radio => {
            radio.addEventListener('change', () => {
                const selectedType = document.querySelector('input[name="swimming_type"]:checked').value;
                const cottageSection = document.querySelector('.cottage_type');
                const roomRadio = document.querySelector('input[name="accommodation_type"][value="room"]');
                const cottageRadio = document.querySelector('input[name="accommodation_type"][value="cottage"]');
                const accommodationRadios = document.querySelectorAll('input[name="accommodation_type"]');
                const roomSection = document.querySelector('.room_type');

                if (selectedType === "overnight") {
                    roomRadio.checked = true;
                    cottageRadio.checked = false;
                    cottageRadio.disabled = true;
                    document.querySelector('.room_type').style.display = "block";
                    document.querySelector('.cottage_type').style.display = "none";
                } else {
                    cottageRadio.disabled = false;
                    const selectedAccommodation = document.querySelector('input[name="accommodation_type"]:checked')?.value;
                    document.querySelector('.room_type').style.display = selectedAccommodation === "room" ? "block" : "none";
                    document.querySelector('.cottage_type').style.display = selectedAccommodation === "cottage" ? "block" : "none";
                }

                accommodationRadios.forEach(el => el.dispatchEvent(new Event('change')));
            });
        });

        // Trigger initial value updates on load
        document.querySelector('select[name="room_type"]').dispatchEvent(new Event('change'));
        document.querySelector('select[name="cottage_type"]').dispatchEvent(new Event('change'));

        // ✅ Initial calculation fix
        updateTotalPax();
        calculateTotal();
        // calculateTotalBarkada();
    });
</script>


        </div>
    </div>
</body>

</html>