<?php
include('db_connect.php');

// Set headers for Excel with UTF-8 encoding
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=Monthly_Report_" . date('Y-m-d') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Add UTF-8 BOM to ensure Excel recognizes encoding
echo "\xEF\xBB\xBF";

echo "<table border='1'>";
echo "<tr>
    <th>Date</th>
    <th>Total Bookings</th>
    <th>Total Pax</th>
    <th>Kids</th>
    <th>Adults</th>
    <th>Senior/PWD</th>
    <th>Entrance Fee (₱)</th>
    <th>Unit Rate (₱)</th>
    <th>Total Amount (₱)</th>
    <th>BCOH (₱)</th>
    <th>Expenses (₱)</th>
    <th>Salary (₱)</th>
    <th>REM (₱)</th>
    <th>ECOH (₱)</th>
</tr>";

// Query the database for monthly data
$sql = "SELECT * FROM monthly_report ORDER BY month ASC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . date('M-d', strtotime($row['month'])) . "</td>";
    echo "<td>" . $row['total_bookings'] . "</td>";
    echo "<td>" . $row['total_pax'] . "</td>";
    echo "<td>" . ($row['total_kids'] ?? 0) . "</td>";
    echo "<td>" . ($row['total_adults'] ?? 0) . "</td>";
    echo "<td>" . ($row['total_senior_pwd'] ?? 0) . "</td>";
    echo "<td>₱" . number_format($row['total_entrance'] ?? 0, 2) . "</td>";
    echo "<td>₱" . number_format($row['total_unit_rate'] ?? 0, 2) . "</td>";
    echo "<td>₱" . number_format($row['total_amount'] ?? 0, 2) . "</td>";
    echo "<td>₱" . number_format($row['bcoh'] ?? 0, 2) . "</td>";
    echo "<td>₱" . number_format($row['expenses'] ?? 0, 2) . "</td>";
    echo "<td>₱" . number_format($row['salary'] ?? 0, 2) . "</td>";
    echo "<td>₱" . number_format($row['rem'] ?? 0, 2) . "</td>";
    echo "<td>₱" . number_format($row['ecoh'] ?? 0, 2) . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
