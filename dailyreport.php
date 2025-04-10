<?php
include 'db_connect.php';
include 'auth.php';

// Get total unique check-in dates
$totalDatesQuery = "SELECT COUNT(DISTINCT check_in_date) AS total_dates FROM bookings WHERE check_in_date IS NOT NULL";
$totalDatesResult = $conn->query($totalDatesQuery);
$totalDatesRow = $totalDatesResult->fetch_assoc();
$totalDates = $totalDatesRow['total_dates'];

$limit = 1; // Show one day at a time
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get check-in date for current page
$dateQuery = "
    SELECT DISTINCT check_in_date 
    FROM bookings 
    WHERE check_in_date IS NOT NULL
    ORDER BY check_in_date ASC 
    LIMIT $limit OFFSET $offset";

$dateResult = $conn->query($dateQuery);
$currentDateRow = $dateResult->fetch_assoc();

if (!$currentDateRow) {
    die("<p style='text-align:center; color:red;'>No bookings found.</p>");
}

$currentDate = $currentDateRow['check_in_date'];

// Get total pax breakdown and total amount for the selected date
$summaryQuery = "
    SELECT 
        SUM(3yrs_old_below) AS total_kids, 
        SUM(adults) AS total_adults, 
        SUM(kids_seniors_pwds) AS total_seniors_pwds, 
        SUM(total_pax) AS total_pax, 
        COUNT(*) AS total_bookings, 
        SUM(total_amount) AS total_amount
    FROM bookings 
    WHERE check_in_date = '$currentDate'";
$summaryResult = $conn->query($summaryQuery);
$summaryRow = $summaryResult->fetch_assoc();

// Get booking details for the selected date
$detailsQuery = "
    SELECT booking_number, firstname, lastname, contact, swimming_type, 3yrs_old_below, adults, kids_seniors_pwds, total_pax, total_amount, check_in_time, check_out_time
    FROM bookings 
    WHERE check_in_date = '$currentDate' 
    ORDER BY check_in_time ASC";
$detailsResult = $conn->query($detailsQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report - El Bernardino Resort</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        h2 {
            color: #333;
        }

        .date-header {
            background: #007bff;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            font-size: 18px;
        }

        .summary {
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: bold;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .no-data {
            color: red;
            font-size: 18px;
            margin-top: 20px;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px;
            text-decoration: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
            margin: 0 5px;
        }

        .pagination a.disabled {
            background: #ccc;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Daily Report - Booking Summary</h2>

        <div class="date-header">
            <?php echo date("F j, Y", strtotime($currentDate)); ?>
        </div>
        <p class="summary">
            Kids: <strong><?php echo $summaryRow['total_kids']; ?></strong> |
            Adults: <strong><?php echo $summaryRow['total_adults']; ?></strong> |
            Seniors/PWDs: <strong><?php echo $summaryRow['total_seniors_pwds']; ?></strong> |
            Total Pax: <strong><?php echo $summaryRow['total_pax']; ?></strong> |
            Total Bookings: <strong><?php echo $summaryRow['total_bookings']; ?></strong> |
            Total Amount: <strong>₱<?php echo number_format($summaryRow['total_amount'], 2); ?></strong>
        </p>

        <?php if ($detailsResult->num_rows > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Booking #</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Swimming Type</th>
                        <th>3yrs old</th>
                        <th>Adults</th>
                        <th>Seniors/PWDs</th>
                        <th>Total Pax</th>
                        <th>Total Amount</th>
                        <th>Check-in Time</th>
                        <th>Check-out Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $detailsResult->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['booking_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['firstname']. ' ' . $row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['contact']); ?></td>
                            <td><?php echo htmlspecialchars($row['swimming_type']); ?> swimming</td>
                            <td><?php echo htmlspecialchars($row['3yrs_old_below']); ?></td>
                            <td><?php echo htmlspecialchars($row['adults']); ?></td>
                            <td><?php echo htmlspecialchars($row['kids_seniors_pwds']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_pax']); ?></td>
                            <td>₱<?php echo number_format($row['total_amount'], 2); ?></td>
                            <td>
                                <?php
                                echo !empty($row['check_in_time'])
                                    ? date("g:i A", strtotime($row['check_in_time']))
                                    : 'N/A';
                                ?>
                            </td>

                            <!-- Fix check-out time formatting -->
                            <td>
                                <?php
                                echo !empty($row['check_out_time'])
                                    ? date("g:i A", strtotime($row['check_out_time']))
                                    : 'N/A';
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="no-data">No bookings for this date.</p>
        <?php } ?>

        <div class="pagination">
            <?php if ($page > 1) { ?>
                <a href="?page=<?php echo $page - 1; ?>">← Previous</a>
            <?php } else { ?>
                <a class="disabled">← Previous</a>
            <?php } ?>

            <?php if ($page < $totalDates) { ?>
                <a href="?page=<?php echo $page + 1; ?>">Next →</a>
            <?php } else { ?>
                <a class="disabled">Next →</a>
            <?php } ?>
        </div>
    </div>

</body>

</html>

<?php
$conn->close();
?>