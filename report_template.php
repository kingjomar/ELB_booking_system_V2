<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 1600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin: auto;
        }
        .date-header {
            background: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            font-size: 18px;
        }
        .summary {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background: #007bff;
            color: white;
        }
        th, td {
            padding: 10px;
            text-align: center;
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
            background: #007bff;
            color: white;
            text-decoration: none;
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
    <h2>Booking Report - Summary</h2>

    <div class="date-header">
        <?php echo htmlspecialchars($currentDate); ?>
    </div>

    <p class="summary">
        Total Bookings: <strong><?php echo $summaryRow['total_bookings']; ?></strong> |
        Kids: <strong><?php echo $summaryRow['total_kids']; ?></strong> |
        Adults: <strong><?php echo $summaryRow['total_adults']; ?></strong> |
        Seniors/PWDs: <strong><?php echo $summaryRow['total_seniors_pwds']; ?></strong> |
        Total Pax: <strong><?php echo $summaryRow['total_pax']; ?></strong> |
        Total Entrance Fee: <strong>₱<?php echo number_format($summaryRow['total_entrance'], 2); ?></strong> |
        Total Unit Rate: <strong>₱<?php echo number_format($summaryRow['total_unit_rate'], 2); ?></strong> |
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
                <th>Cottage Type</th>
                <th>Room Type</th>
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
                    <td><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact']); ?></td>
                    <td><?php echo htmlspecialchars($row['swimming_type']); ?> swimming</td>
                    <td><?php echo $row['3yrs_old_below']; ?></td>
                    <td><?php echo $row['adults']; ?></td>
                    <td><?php echo $row['kids_seniors_pwds']; ?></td>
                    <td><?php 
                        $types = [
                            'Cave' => 'Cave 10 pax', 'Cave20' => 'Cave 20 pax',
                            'Nipa' => 'Nipa 10 pax', 'Nipa20' => 'Nipa 20 pax',
                            '' => 'Cabana 10 pax'
                        ];
                        echo $types[$row['cottage_type']] ?? 'Cabana 10 pax';
                    ?></td>
                    <td><?php echo $row['room_type'] === "" ? "None" : $row['room_type']; ?></td>
                    <td><?php echo $row['total_pax']; ?></td>
                    <td>₱<?php echo number_format($row['total_amount'], 2); ?></td>
                    <td><?php echo !empty($row['check_in_time']) ? date("g:i A", strtotime($row['check_in_time'])) : 'N/A'; ?></td>
                    <td><?php echo !empty($row['check_out_time']) ? date("g:i A", strtotime($row['check_out_time'])) : 'N/A'; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="no-data">No bookings for this period.</p>
    <?php } ?>

    <?php if (isset($totalDates)) { ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">← Previous</a>
            <?php else: ?>
                <a class="disabled">← Previous</a>
            <?php endif; ?>

            <?php if ($page < $totalDates): ?>
                <a href="?page=<?php echo $page + 1; ?>">Next →</a>
            <?php else: ?>
                <a class="disabled">Next →</a>
            <?php endif; ?>
        </div>
    <?php } ?>
</div>

</body>
</html>

<?php $conn->close(); ?>
