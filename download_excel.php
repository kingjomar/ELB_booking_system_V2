<?php
include 'db_connect.php';
include 'auth.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=booking_report.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
    <th>Check-in Date</th>
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
</tr>";

$query = "SELECT check_in_date, booking_number, firstname, lastname, contact, swimming_type, 
        3yrs_old_below, adults, kids_seniors_pwds, cottage_type, room_type, 
        total_pax, total_amount, check_in_time, check_out_time 
        FROM bookings 
        WHERE check_in_date IS NOT NULL
        ORDER BY check_in_date ASC, check_in_time ASC";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $cottage = match ($row['cottage_type']) {
        'Cave' => 'Cave 10 pax',
        'Cave20' => 'Cave 20 pax',
        'Nipa' => 'Nipa 10 pax',
        'Nipa20' => 'Nipa 20 pax',
        default => 'Cabana 10 pax',
    };

    echo "<tr>
        <td>" . htmlspecialchars($row['check_in_date']) . "</td>
        <td>" . htmlspecialchars($row['booking_number']) . "</td>
        <td>" . htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) . "</td>
        <td>" . htmlspecialchars($row['contact']) . "</td>
        <td>" . htmlspecialchars($row['swimming_type']) . "</td>
        <td>" . htmlspecialchars($row['3yrs_old_below']) . "</td>
        <td>" . htmlspecialchars($row['adults']) . "</td>
        <td>" . htmlspecialchars($row['kids_seniors_pwds']) . "</td>
        <td>" . htmlspecialchars($cottage) . "</td>
        <td>" . htmlspecialchars($row['room_type'] ?: 'None') . "</td>
        <td>" . htmlspecialchars($row['total_pax']) . "</td>
        <td>" . number_format($row['total_amount'], 2) . "</td>
        <td>" . (!empty($row['check_in_time']) ? date("g:i A", strtotime($row['check_in_time'])) : 'N/A') . "</td>
        <td>" . (!empty($row['check_out_time']) ? date("g:i A", strtotime($row['check_out_time'])) : 'N/A') . "</td>
    </tr>";
}

echo "</table>";
$conn->close();
?>
